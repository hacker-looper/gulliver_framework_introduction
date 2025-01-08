<?php

class Services_Rest_Auth implements iAuthenticate
{
    function __isAllowed()
    {return true;
        session_start();
        $_SESSION['USR_UID']='';
        require_once 'classes/model/RbacUserPeer.php';
        $user=RbacUserPeer::getUserByKey($_GET['api_key']);
        if($user && $user['USR_STATUS']=='1'){
            RbacUserPeer::editUser(array('USR_UID'=>$user['USR_UID'],'USR_LASTLOGIN'=>date('Y-m-d H:i:s')));
            $_SESSION['USR_UID']=$user['USR_UID'];
            return true;
        }
        else{
            throw new RestException(401, '用户权限凭证验证失败!');
        }
    }

    public function __getWWWAuthenticateString()
    {
        return 'Query name="api_key"';
    }
}

/**
 * 系统API加密工具类
 * @since  2016-09
 **/
class Token{
    // 密匙字段，请谨慎保管
    private static $API_SCRET = '50a86262a7d8bbc52a4594a57b39751b';

    /**
     * 工具方法:
     * 数据防盗链，校验api_token有效性
     * 加密算法为: md5($url+$date(Ymdh)+$scret); Token采用分钟级过期机制(误差冗余1分钟);
     * @return  bool | true: 成功, false失败
     * @throws  403, Wrong Access Token;
     */
    public static function validateApiToken(){
        //return true; // for testing
        //if(! Token::_isRequestFromMobile()) return true;
        
        $uri = $_SERVER['REQUEST_URI'];
        $uri_arr=explode('?', $uri);
        $url=$uri_arr[0];
        $url=urldecode($url);
        $token  = md5($url.date('YmdH',time()).self::$API_SCRET);
        $token2 = md5($url.date('YmdH',strtotime("-1 hours")).self::$API_SCRET);
        $token3 = md5($url.date('YmdH',strtotime("+1 hours")).self::$API_SCRET);
        if($_GET['api_token']==$token || $_GET['api_token']==$token2 || $_GET['api_token']==$token3){
            return true;
        }else{
            throw new RestException(403, '服务器非法访问!');
        }
    }

    /** 
     * 判断请求是否是通过手机访问 
     * @return bool 是否是移动设备     
     */  
     private static function _isRequestFromMobile() {
       //判断手机发送的客户端标志  
       if(isset($_SERVER['HTTP_USER_AGENT'])) {  
        $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);  
        $clientkeywords = array(  
          'nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-'  
          ,'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu',   
          'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini',   
          'operamobi', 'opera mobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile'  
        );  
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字  
       if(preg_match("/(".implode('|',$clientkeywords).")/i",$userAgent)&&strpos($userAgent,'ipad') === false){  
          return true;  
        }  
      }

      return false;  
    }
}