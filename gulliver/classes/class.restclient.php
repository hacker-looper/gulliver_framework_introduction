<?php

/**
 * Class RestClient
 */
class RestClient
{

    private $curl;
    private $url;
    private $response = "";
    private $headers = array ();
    private $token = null;

    private $method = "GET";
    private $params = null;
    private $contentType = null;
    private $file = null;
    private $timeout = 100;

    /**
     * Private Constructor, sets default options
     */
    public function __construct ()
    {
        $this->curl = curl_init();
        curl_setopt( $this->curl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $this->curl, CURLOPT_AUTOREFERER, true ); // This make sure will follow redirects
        curl_setopt( $this->curl, CURLOPT_FOLLOWLOCATION, true ); // This too
        curl_setopt( $this->curl, CURLOPT_HEADER, true ); // THis verbose option for extracting the headers
        curl_setopt( $this->curl, CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt( $this->curl, CURLOPT_TIMEOUT, $this->timeout);
    }

    /**
     * Execute the call to the webservice
     *
     * @return RestClient
     */
    public function execute ()
    {
        if ($this->method === "POST") {
            curl_setopt( $this->curl, CURLOPT_POST, true );
            curl_setopt( $this->curl, CURLOPT_POSTFIELDS, $this->params );
            //var_dump($this->params);
            //die;
        } elseif ($this->method == "GET") {
            curl_setopt( $this->curl, CURLOPT_HTTPGET, true );
            $this->treatURL();
        } elseif ($this->method === "PUT") {
            curl_setopt( $this->curl, CURLOPT_PUT, true );
            $this->treatURL();
            $this->file = tmpFile();
            fwrite( $this->file, $this->params );
            fseek( $this->file, 0 );
            curl_setopt( $this->curl, CURLOPT_INFILE, $this->file );
            curl_setopt( $this->curl, CURLOPT_INFILESIZE, strlen( $this->params ) );
        } else {
            curl_setopt( $this->curl, CURLOPT_CUSTOMREQUEST, $this->method );
        }
        
        $aHeader = array();
        if ($this->contentType != null) {
            $aHeader[] = "Content-Type: " . $this->contentType;
            $aHeader[] = "SKEY: 8QRtY5zXyViZ9fjYou";
        }
        
        if ($this->token != null) {
            $aHeader[] = "AUTH_KEY: " . $this->token;
        }

        if($this->headers){
            $aHeader = array_merge($aHeader,$this->headers);
        }
        
        if($aHeader) {
            curl_setopt( $this->curl, CURLOPT_HTTPHEADER, array_values($aHeader));
        }
        
        curl_setopt( $this->curl, CURLOPT_URL, $this->url );
        //Add time out for curl
        curl_setopt( $this->curl, CURLOPT_TIMEOUT, $this->timeout);
        $r = curl_exec( $this->curl );
        if ($this->method !== "DELETE") {
            $this->treatResponse( $r ); // Extract the headers and response
            return $this;
        } else {
            return $this;
        }
    }

    /**
     * Treats URL
     */
    private function treatURL ()
    {
        if (is_array( $this->params ) && count( $this->params ) >= 1) {
            // Transform parameters in key/value pars in URL
            if (! strpos( $this->url, '?' )) {
                $this->url .= '?';
            }
            foreach ($this->params as $k => $v) {
                $this->url .= "&" . urlencode( $k ) . "=" . urlencode( $v );
            }
        }
        return $this->url;
    }

    /*
      * Treats the Response for extracting the Headers and Response
      */
    private function treatResponse ($r)
    {
        if ($r == null or strlen( $r ) < 1) {
            return;
        }
        $parts = explode( "\n\r", $r ); // HTTP packets define that Headers end in a blank line (\n\r) where starts the body
        while (preg_match( '@HTTP/1.[0-1] 100 Continue@', $parts[0] ) or preg_match( "@Moved@", $parts[0] )) {
            // Continue header must be bypass
            for ($i = 1; $i < count( $parts ); $i ++) {
                $parts[$i - 1] = trim( $parts[$i] );
            }
            unset( $parts[count( $parts ) - 1] );
        }
        preg_match( "@Content-Type: ([a-zA-Z0-9-]+/?[a-zA-Z0-9-]*)@", $parts[0], $reg ); // This extract the content type
        $this->headers['content-type'] = $reg[1];
        preg_match( "@HTTP/1.[0-1] ([0-9]{3}) ([a-zA-Z ]+)@", $parts[0], $reg ); // This extracts the response header Code and Message
        $this->headers['code'] = $reg[1];
        $this->headers['message'] = $reg[2];
        $this->response = "";
        for ($i = 1; $i < count( $parts ); $i ++) {
            //This make sure that exploded response get back togheter
            if ($i > 1) {
                $this->response .= "\n\r";
            }
            $this->response .= $parts[$i];
        }
    }

    /*
      * @return array
      */
    public function getHeaders ()
    {
        return $this->headers;
    }

    /*
      * @return string
      */
    public function getResponse ()
    {
        return $this->response;
    }

    /*
      * HTTP response code (404,401,200,etc)
      * @return int
      */
    public function getResponseCode ()
    {
        return (int) $this->headers['code'];
    }

    /*
      * HTTP response message (Not Found, Continue, etc )
      * @return string
      */
    public function getResponseMessage ()
    {
        return $this->headers['message'];
    }

    /*
      * Content-Type (text/plain, application/xml, etc)
      * @return string
      */
    public function getResponseContentType ()
    {
        return $this->headers['content-type'];
    }

    /**
     * This sets that will not follow redirects
     *
     * @return RestClient
     */
    public function setNoFollow ()
    {
        curl_setopt( $this->curl, CURLOPT_AUTOREFERER, false );
        curl_setopt( $this->curl, CURLOPT_FOLLOWLOCATION, false );
        return $this;
    }

    /**
     * This closes the connection and release resources
     *
     * @return RestClient
     */
    public function close ()
    {
        curl_close( $this->curl );
        $this->curl = null;
        if ($this->file != null) {
            fclose( $this->file );
        }
        return $this;
    }

    /**
     * Sets the URL to be Called
     *
     * @return RestClient
     */
    public function setUrl ($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Set timtout for rest
     * @param  [int]                   $timeout
     *
     * @anchor Garry
     * @since  2013-11-20T10:37:25+0800
     */
    public function setTimeout ($timeout){
        $this->timeout = $timeout;
        return $this;
    }
    
    public function setToken ($token){
        $this->token = $token;
        return $this;
    }

    /**
     * Set the Content-Type of the request to be send
     * Format like "application/xml" or "text/plain" or other
     *
     * @param string $contentType
     * @return RestClient
     */
    public function setContentType ($contentType)
    {
        $this->contentType = $contentType;
        return $this;
    }

    // 设置cookie
    public function setCookie($cookie_file){
        curl_setopt($this->curl, CURLOPT_COOKIEFILE,$cookie_file); //可以用cookie文件
        return $this;
    }

    /**
     * Set the Credentials for BASIC Authentication
     *
     * @param string $user
     * @param string $pass
     * @return RestClient
     */
    public function setCredentials ($user, $pass)
    {
        if ($user != null) {
            curl_setopt( $this->curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC );
            curl_setopt( $this->curl, CURLOPT_USERPWD, "{$user}:{$pass}" );
        }
        return $this;
    }

    /**
     * Set the Request HTTP Method
     * For now, only accepts GET and POST
     *
     * @param string $method
     * @return RestClient
     */
    public function setMethod ($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * Set the Request HTTP Header
     * For now, only accepts GET and POST
     *
     * @author wesley
     * @since 2013-6-19 16:37:43
     * @param array $aHeaders
     * @return RestClient
     */
    public function appendHeader ($sHeader){
        $this->headers[] = $sHeader;
        return $this;
    }

    /**
     * Set Parameters to be send on the request
     * It can be both a key/value par array (as in array("key"=>"value"))
     * or a string containing the body of the request, like a XML, JSON or other
     * Proper content-type should be set for the body if not a array
     *
     * @param mixed $params
     * @return RestClient
     */
    public function setParameters ($params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * Creates the RESTClient
     *
     * @param string $url=null [optional]
     * @return RestClient
     */
    public static function createClient ($url = null)
    {
        $client = new RestClient();
        if ($url != null) {
            $client->setUrl( $url );
        }
        return $client;
    }

    /**
     * Convenience method wrapping a commom POST call
     *
     * @param string $url
     * @param mixed params
     * @param string $user=null [optional]
     * @param string $password=null [optional]
     * @param string $contentType="multpary/form-data" [optional] commom post (multipart/form-data) as default
     * @return RestClient
     */
    //public static function post($url,$params=null,$user=null,$pwd=null,$contentType="multipart/form-data") {
    public static function post ($url, $params, $user, $pwd, $contentType = "multipart/form-data")
    {
        //return self::call("POST",$url,$params,$user,$pwd,$contentType);
        return self::call( "POST", $url, $params, $user, $pwd, $contentType );
    }

    /**
     * Convenience method wrapping a commom PUT call
     *
     * @param string $url
     * @param string $body
     * @param string $user=null [optional]
     * @param string $password=null [optional]
     * @param string $contentType=null [optional]
     * @return RestClient
     */
    public static function put ($url, $body, $user = null, $pwd = null, $contentType = null)
    {
        return self::call( "PUT", $url, $body, $user, $pwd, $contentType );
    }

    /**
     * Convenience method wrapping a commom GET call
     *
     * @param string $url
     * @param array params
     * @param string $user=null [optional]
     * @param string $password=null [optional]
     * @return RestClient
     */
    //public static function get($url,array $params=null,$user=null,$pwd=null,$contentType=null) {
    public static function get ($url, $user, $pwd, $contentType = null)
    {
        //return self::call("GET",$url,$params,$user,$pwd,$contentType);
        return self::call( "GET", $url, null, $user, $pwd, $contentType );
    }

    /**
     * Convenience method wrapping a commom delete call
     *
     * @param string $url
     * @param array params
     * @param string $user=null [optional]
     * @param string $password=null [optional]
     * @return RestClient
     */
    public static function delete ($url, $user = null, $pwd = null, $contentType = null)
    {
        return self::call( "DELETE", $url, null, $user, $pwd, $contentType );
    }

    /**
     * Convenience method wrapping a commom custom call
     *
     * @param string $method
     * @param string $url
     * @param string $body
     * @param string $user=null [optional]
     * @param string $password=null [optional]
     * @param string $contentType=null [optional]
     * @return RestClient
     */
    public static function call ($method, $url, $body, $user = null, $pwd = null, $contentType = null)
    {
        return self::createClient( $url )->setParameters( $body )->setMethod( $method )->setCredentials( $user, $pwd )->setContentType( $contentType )->execute()->close();
    }
}

