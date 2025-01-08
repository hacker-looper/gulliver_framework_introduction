<?php

require_once "classes/class.Utils.php";

class gulliver {
	/**
	 * Timezone time auto-caculator
	 * 
	 * example: echo gulliver::timezone('now', 'Y-m-d h:i:s', SYS_TIMEZONE, 'Asia/Shanghai');
	 * @see  /gulliver/gulliver.ini
	 * @see  DB: ADMIN/ADMIN_WORKSPACE#WS_TIMEZONE
	 * @see  /gulliver/multi-tendency.php#date_default_timezone_set();
	 * 
	 * @author Looper
	 * @since  2014-06-18T15:08:22+0800
	 * @param  string                   $time     		[description]
	 * @param  string                   $timezoneFrom 	[description]
	 * @param  string                   $timezoneTo 	[description]
	 * @return [type]                             		[description]
	 **/
	public static function timezone($time='now', $format='Y-m-d H:i:s', $timezoneFrom= SYS_TIMEZONE, $timezoneTo = 'UTC'){
		$now = new DateTime($time, new DateTimeZone($timezoneFrom));
		$now->setTimezone(new DateTimeZone($timezoneTo));
		return $now->format($format);
	}

	// Function to remove folders and files 
    public static function rrmdir($dir) {
        if (is_dir($dir)) {
            $files = scandir($dir);
            foreach ($files as $file)
                if ($file != "." && $file != "..") self::rrmdir("$dir/$file");
            rmdir($dir);
        }
        else if (file_exists($dir)) unlink($dir);
    }

    /**
	 * [Copy floder]
	 * @param  [type] $source [description]
	 * @param  [type] $destination [description]
	 * @param  boolean $child [description]
	 * @return [type] [description]
	 *
	 * @author Garry
	 * @since  2014-03-06T17:01:41+0800
	 */
	public static function xCopy($source, $destination, $child = true){ 

		if(!is_dir($source)){
			return false;
		}

		if(!is_dir($destination)){
			@mkdir($destination, 0777);
		}

		$handle=dir($source);   
		while($entry=$handle->read()) {   
			if(($entry!=".")&&($entry!="..")){   
				if(is_dir($source."/".$entry)){   
					if($child)   
						self::xCopy($source."/".$entry,$destination."/".$entry,$child);   
				}else{
					@copy($source."/".$entry,$destination."/".$entry);   
				}
			}
		}
	 
	 	return true;
	}

    // Function to Copy folders and files       
    public static function rcopy($src, $dst) {
        if (file_exists ( $dst ))
            self::rrmdir ( $dst );
        if (is_dir ( $src )) {
            mkdir ( $dst );
            $files = scandir ( $src );
            foreach ( $files as $file )
                if ($file != "." && $file != "..")
                    self::rcopy ( "$src/$file", "$dst/$file" );
        } else if (file_exists ( $src ))
            copy ( $src, $dst );
    }

	// <TODO>
	// Windows PHP 5.3.1 可以在 Windows 上跨驱动器 rename() 文件
	// @see http://us3.php.net/rename
	public static function moveDir($source, $destination){
		// Error: There was an error moving from C:\Users\looper\AppData\Local\Temp\1D46.tmp\ 
		// to D:\WorkPrograms\wamp\www\gulliver\shared/sites\gulliver3
		if ( PHP_OS !== 'WINNT' ) {
			rename($source,$destination);
		}else {
		   // print "source: $source"; print "destination: $destination";
	       self::rcopy($source, $destination);
	       self::rrmdir($source);
   		}
	}

	/**
	 * [get files in a directory]
	 * @param  [string] $directory [dir]
	 * @param  [boolean] $recursive [true to get child-dir]
	 * @return [type] [description]
	 *
	 * @author Garry
	 * @since  2014-03-05T17:40:49+0800
	 */
	public static function getFilesInFloder($directory, $recursive = false) {
	    $array_items = array();
	    if ($handle = opendir($directory)) {
	        while (false !== ($file = readdir($handle))) {
	            if ($file != "." && $file != "..") {
	                if (is_dir($directory. "/" . $file)) {
	                    if($recursive) {
	                        $array_items = array_merge($array_items, self::getFilesInFloder($directory. "/" . $file, $recursive));
	                    }
	                    $file = $directory . "/" . $file;
	                    $array_items[] = preg_replace("/\/\//si", "/", $file);
	                } else {
	                    $file = $directory . "/" . $file;
	                    $array_items[] = preg_replace("/\/\//si", "/", $file);
	                }
	            }
	        }
	        closedir($handle);
	    }
	    return $array_items;
	}
	
	public static function verifyPath($strPath, $createPath = false) {
		$folder_path = strstr ( $strPath, '.' ) ? dirname ( $strPath ) : $strPath;
		
		if (file_exists ( $strPath ) || @is_dir ( $strPath )) {
			return true;
		} else {
			if ($createPath) {
				//TODO:: Define Environment constants: Devel (0777), Production (0770), ...
				self::mk_dir ( $strPath, 0777 );
			} else
				return false;
		}
		return false;
	}
	
	public static function mk_dir( $strPath, $rights = 0777)
	  {
	    $folder_path = array($strPath);
	    $oldumask    = umask(0);
	    while(!@is_dir(dirname(end($folder_path)))
	          && dirname(end($folder_path)) != '/'
	          && dirname(end($folder_path)) != '.'
	          && dirname(end($folder_path)) != '')
	      array_push($folder_path, dirname(end($folder_path))); //var_dump($folder_path); die;
	      
	    while($parent_folder_path = array_pop($folder_path))
	      if(!@is_dir($parent_folder_path))
	        if(!@mkdir($parent_folder_path, $rights))
	    //trigger_error ("Can't create folder \"$parent_folder_path\".", E_USER_WARNING);
	    umask($oldumask);
	  }
	  
	/**
	* Upload a file and then copy to path+ nameToSave
   	*
   	* @author Mauricio Veliz <mauricio@colosa.com>
   	* @access public
   	* @param  string $file
   	* @param  string $path
   	* @param  string $nameToSave
   	* @param  integer $permission
   	* @return void
   	*/
  	function uploadFile($file, $path ,$nameToSave, $permission = 0666) {
	    try {
	      if ($file == '') {
	        throw new Exception('The filename is empty!');
	      }
	      if (filesize($file) > ((((ini_get('upload_max_filesize') + 0)) * 1024) * 1024)) {
	        throw new Exception('The size of upload file exceeds the allowed by the server!');
	      }
	      $oldumask = umask(0);
	      if (!is_dir($path)) {
	        self::verifyPath($path, true);
	      }
	      move_uploaded_file($file , $path . "/" . $nameToSave);
	      chmod($path . "/" . $nameToSave , $permission);
	      umask($oldumask);
	    }
	    catch (Exception $oException) {
	      throw $oException;
	    }
  	}
	
	/**
	 * sendHeaders
	 *
	 * @param  string  $filename
	 * @param  string  $contentType default value ''
	 * @param  boolean $download default value false
	 * @param  string  $downloadFileName default value ''
	 *
	 * @return void
	 */
	static function sendHeaders($filename, $contentType = '', $download = false, $downloadFileName = '') {
		if ($download) {
			if ($downloadFileName == '') {
				$aAux = explode ( '/', $filename );
				$downloadFileName = $aAux [count ( $aAux ) - 1];
			}
			header ( 'Content-Disposition: attachment; filename="' . $downloadFileName . '"' );
		}

		header ( 'Content-Type: ' . $contentType );
		

		//if userAgent (BROWSER) is MSIE we need special headers to avoid MSIE behaivor.
	    $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
	    if ( preg_match("/msie/i", $userAgent)) {
	    //if ( ereg("msie", $userAgent)) {
	      header('Pragma: cache');

	      $mtime = @filemtime($filename);
	      $gmt_mtime = gmdate("D, d M Y H:i:s", $mtime ) . " GMT";
	      header('ETag: "' . md5 ($mtime . $filename ) . '"' );
	      header("Last-Modified: " . $gmt_mtime );
	      header('Cache-Control: public');
	      header("Expires: " . gmdate("D, d M Y H:i:s", time () + 60*10 ) . " GMT"); //ten minutes
	      return;
	    }
	    
	    if (!$download) {

	      header('Pragma: cache');

	      if ( file_exists($filename) )
	        $mtime = @filemtime($filename);
	      else
	        $mtime = date('U');
	      $gmt_mtime = gmdate("D, d M Y H:i:s", $mtime ) . " GMT";
	      header('ETag: "' . md5 ($mtime . $filename ) . '"' );
	      header("Last-Modified: " . $gmt_mtime );
	      header('Cache-Control: public');
	      header("Expires: " . gmdate("D, d M Y H:i:s", time () + 90*60*60*24 ) . " GMT");
	      if( isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ) {
	        if ($_SERVER['HTTP_IF_MODIFIED_SINCE'] == $gmt_mtime) {
	          header('HTTP/1.1 304 Not Modified');
	          exit();
	        }
	      }

	      if (isset($_SERVER['HTTP_IF_NONE_MATCH'])) {
	        if ( str_replace('"', '', stripslashes($_SERVER['HTTP_IF_NONE_MATCH'])) == md5( $mtime . $filename))  {
	          header("HTTP/1.1 304 Not Modified");
	          exit();
	        }
	      }
	    }
	}
	
	/**
	 * streaming a file
	 *
	 * @author Fernando Ontiveros Lira <fernando@colosa.com>
	 * @access public
	 * @param  string $file
	 * @param  boolean $download
	 * @param  string $downloadFileName
	 * @return string
	 */
	static function streamFile($file, $download = false, $downloadFileName = '') {
		$typearray = explode ( '.', basename ( $file ) );
		$typefile = $typearray [count ( $typearray ) - 1];
		
		if(! file_exists($file)){
			$filename = PATH_SYSTEM . substr ( $file, 1 );
		}else{
			$filename = $file;
		}
		if(! file_exists($filename)){
			$filename = PATH_APP . substr ( $file, 1 );
		}
		if(! file_exists($filename)){
			$filename = PATH_ADMIN . substr ( $file, 1 );
		}
		if(! file_exists($filename)){
			$filename = PATH_VIP . substr ( $file, 1 );
		}
		if(! file_exists($filename)){
			$filename = PATH_SITES . substr ( $file, 1 );
		}
		switch (strtolower ( $typefile )) {
			case 'swf' :
				self::sendHeaders ( $filename, 'application/x-shockwave-flash', $download, $downloadFileName );
				break;
			case 'js' :
				self::sendHeaders ( $filename, 'text/javascript', $download, $downloadFileName );
				break;
			case 'htm' :
			case 'html' :
				self::sendHeaders ( $filename, 'text/html', $download, $downloadFileName );
				break;
			case 'htc' :
				self::sendHeaders ( $filename, 'text/plain', $download, $downloadFileName );
				break;
			case 'json' :
				self::sendHeaders ( $filename, 'text/plain', $download, $downloadFileName );
				break;
			case 'gif' :
				self::sendHeaders ( $filename, 'image/gif', $download, $downloadFileName );
				break;
			case 'png' :
				self::sendHeaders ( $filename, 'image/png', $download, $downloadFileName );
				break;
			case 'jpg' :
				self::sendHeaders ( $filename, 'image/jpg', $download, $downloadFileName );
				break;
			case 'css' :
				self::sendHeaders ( $filename, 'text/css', $download, $downloadFileName );
				break;
			case 'xml' :
				self::sendHeaders ( $filename, 'text/xml', $download, $downloadFileName );
				break;
			case 'txt' :
				self::sendHeaders ( $filename, 'text/html', $download, $downloadFileName );
				break;
			case 'doc' :
			case 'pdf' :
				if (isset ( $_REQUEST ['PREVIEW_TYPE'] ) && $_REQUEST ['PREVIEW_TYPE']) {
					self::sendHeaders ( $filename, 'application/pdf', $download, $downloadFileName );
				} else {
					self::sendHeaders ( $filename, 'application/octet-stream', $download, $downloadFileName );
				}
				break;
			case 'php' :
				if ($download) {
					self::sendHeaders ( $filename, 'text/plain', $download, $downloadFileName );
				} else {
					require_once ($filename);
					return;
				}
				break;
			case 'tar' :
				self::sendHeaders ( $filename, 'application/x-tar', $download, $downloadFileName );
				break;
			case 'xls' :
				self::sendHeaders ( $filename, 'application/vnd.ms-excel', $download, $downloadFileName );
				break;
			case 'xlsx' :
			case 'csv':
				self::sendHeaders ( $filename, 'application/octet-stream', $download, $downloadFileName );
				break;
			default :
				//throw new Exception ( "Unknown type of file '$file'. " );
				self::sendHeaders ( $filename, 'application/octet-stream', $download, $downloadFileName );
				break;
		}
		
		require_once (PATH_LIBRARY . 'minify/JSMin.php');
		switch ( strtolower($typefile ) ) {
	      	case "js" :
		        $paths  = explode ( '/', $filename);
		        $jsName = $paths[ count ($paths) -1 ];
		        $output = '';
		        switch ( $jsName ) {
		        	case 'translation.js': // @see http://{$host}/assets/js/translation.js?lang=en
		        		$lang = isset($_REQUEST['lang']) ? $_REQUEST['lang'] : 'en';
		        		
		        		// 开发版本
		        		load_translation($lang);
		        		global $G_TRANSLATION;
		        		$sContent =  'var T='.json_encode($G_TRANSLATION).';';
		        		echo $sContent; die;
		        		
		        		/* 上线版本
		        		$translation = PATH_SHARED . "translation-$lang.js";
		        		if(! file_exists($translation)){
		        			load_translation($lang);
		        			global $G_TRANSLATION;
		        			$sContent =  'var T='.json_encode($G_TRANSLATION).';';
		        			@file_put_contents($translation, $sContent);
		        		}
		        		
		        		echo @file_get_contents($translation); die;
		        		*/
		        		break;
		        	
		        	case 'jquery-all.js' : // complie all the jquery related javascript in one file
			        	echo @file_get_contents(PATH_SHARED . 'jquery-all-' . $_GET['t'] . '.js'); die;
			        break;

			        case 'bootstrap-all.js' : // complie all the bootstrap related javascript in one file
			        	echo @file_get_contents(PATH_SHARED . 'bootstrap-all-' . $_GET['t'] . '.js'); die;
			        break;

			          default:
			      		if(! file_exists($filename)) { // bussiness module javascript
			      			$filename = PATH_ADMIN . $file; // !\/ issue!
			      			if(! file_exists($filename))
			      				$filename = PATH_APP . $file;
			      		}
			      	  break;
		      	}

		      	// echo @JSMin::minify(file_get_contents($filename));
		      	echo @file_get_contents ( $filename );
	      	break;

	      	case 'css':
	      		$paths  = explode ( '/', $filename);
		        $cssName = $paths[ count ($paths) -1 ];
		        $output = '';

	      		switch ( $cssName ) {

	      			default:
	      				if(! file_exists($filename)) { // bussiness module css
			      			$filename = PATH_ADMIN . substr($file, 1);
			      			if(! file_exists($filename))
			      				$filename = PATH_APP . substr($file, 1);
			      		}
	      			break;

	      		}

	      		// echo JSMin::minify(file_get_contents($filename));
	      		echo @file_get_contents ( $filename );
	      	break;

	      	default:
	      		echo @file_get_contents($filename); // <ISSUE>: 图片编码格式为ANSI,被强制转换成了UTF-8
	      	break;
      	}
	}

	/**
	 * Debug Printing
	 *
	 * @author Looper
	 * @since  2014-02-07T14:28:43+0800
	 * @param  [Object]                 $varible [Varible to be debug]
	 * @param  boolean                  $die     [if die]
	 * @return [type]                            [description]
	 */
	public static function pr($varible, $die = false) {
		print "<pre/>";
		print_r ( $varible );
		if ($die)
			die ();
	}
	
	/**
	 * Debug Timing
	 * 
	 * @see  /log/time.log
	 * @author Looper
	 * @since  2014-02-07T14:44:54+0800
	 * @return [type]                   [description]
	 */
	public static function logTimeByPage() {
		$serverAddr = $_SERVER ['SERVER_ADDR'];
		global $startingTime;
		$endTime = array_sum ( explode ( ' ', microtime () ) );
		$time = $endTime - $startingTime;
		$fpt = fopen ( PATH_LOG . 'time.log', 'a' );
		fwrite ( $fpt, sprintf ( "%s.%03d %15s %s %5.3f %s\n", date ( 'H:i:s' ), $time, getenv ( 'REMOTE_ADDR' ), substr ( $serverAddr, - 4 ), $time, $_SERVER ['REQUEST_URI'] ) );
		fclose ( $fpt );
	}
	
	/**
	 * 加载模块： Propel
	 *
	 * @author Looper
	 * @since  2014-02-17T09:11:44+0800
	 * @return [type]                   [description]
	 */
	public static function loadModule_Propel(){
	  require_once PATH_LIBRARY . 'propel/Propel.php';
	  require_once PATH_LIBRARY . 'creole/Creole.php';

	  global $GLOBAL_SETTING;
	  /**
	   * DEBUG PROPEL日志
	   * @see  /gulliver/app/log/propel.log
	   * @see  /gulliver/app/config/gulliver.ini
	   **/
	  if ($GLOBAL_SETTING['DEBUG_SQL'] ) {
	    define('PM_PID', mt_rand(1,999999));
	    require_once PATH_LIBRARY . 'pear/Log.php';
	  
	    // register debug connection decorator driver
	    Creole::registerDriver('*', 'creole.contrib.DebugConnection');
	  
	    // initialize Propel with converted config file
	    Propel::init(PATH_CONFIG . 'databases.php');
	  
	    // unified log file for all databases
	    $logFile = PATH_LOG . 'propel.log';
	    gulliver::verifyPath(PATH_DB . 'log', 1);
	    $logger = Log::singleton('file', $logFile, 'gulliver', null, PEAR_LOG_INFO);

	    // log file for workflow database
	    $con = Propel::getConnection('system');
	    if ($con instanceof DebugConnection) {
	      $con->setLogger($logger);
	    }

	    /* log file for Manager Console database
	    $con = Propel::getConnection('admin');
	    if ($con instanceof DebugConnection) {
	      $con->setLogger($logger);
	    }
	    */
	  }

	  Creole::registerDriver('*', 'creole.contrib.DebugConnection');
	  Propel::init(PATH_CONFIG . 'databases.php');
	}
	
	/**
	 * Debug Propel
	 * 
	 * @see  /log/propel.log
	 * @author Looper
	 * @since  2014-02-07T14:44:54+0800
	 * @return [type]                   [description]
	 */
	public static function logPropel() {
		$serverAddr = $_SERVER ['SERVER_ADDR'];
		global $startingTime;
		$endTime = array_sum ( explode ( ' ', microtime () ) );
		$time = $endTime - $startingTime;
		$fpt = fopen ( PATH_LOG . 'propel.log', 'a' );
		fwrite ( $fpt, sprintf ( "%s.%03d %15s %s %5.3f %s\n", date ( 'H:i:s' ), $time, getenv ( 'REMOTE_ADDR' ), substr ( $serverAddr, - 4 ), $time, $_SERVER ['REQUEST_URI'] ) );
		fclose ( $fpt );
	}

	
	/**
	 * Multi-System-Modules Support: 获取系统所有业务模块: system/app/{module}
	 * 
	 * @param $path string "dashboard/index"
	 * @param $path type "template/methods/..."
	 * @see  /log/propel.log
	 * @author Looper
	 * @since  2016-06-30
	 * @return [type]                   [description]
	 */
	public static function getSystemMultiModule(){
		$aModules = array();
		$aFiles = glob(PATH_HOME.'*/methods');
		foreach ($aFiles as $v) {
			$a = explode('/methods', $v);
			$aModules[] = basename($a[0]);
		}

		return $aModules;
	}

	/**
	 * Multi-System-Modules Support
	 * 
	 * @param $path string "dashboard/index"
	 * @param $path type "template/methods/..."
	 * @see  /log/propel.log
	 * @author Looper
	 * @since  2016-06-30
	 * @return [type]                   [description]
	 */
	public static function checkSystemMultiModule($path, $type) {
		$aModules = self::getSystemMultiModule();

		$_a = array();
		if(! is_array($aModules)){
			$_a[0] = $aModules;
		}else{
			$_a = $aModules;
		}

		$file = "";
		foreach ($_a as $k => $v) {
			if($type=='methods'){
				$extension = "php";
			}else if($type=='template'){
				$extension = "tpl";
			}

			$file = PATH_HOME . $v . PATH_SEP . $type . PATH_SEP . $path . '.' .$extension;
			if(file_exists($file)){
				return $file;
			}
		}

		if(! file_exists($file)) {
			die('!404! Cannot find file with path:'.$path.',type:'.$type);
		}else{
			return $file;
		}
	}
	
	/**
	 * Render Notification Bar under Top menu
	 *
	 * @author Looper
	 * @since  2014-02-07T17:06:38+0800
	 * @param  [type]                   $sMsg   [description]
	 * @param  string                   $level  [info/success/error]
	 * @param  boolean                  $bClose [description]
	 * @return [type]                           [description]
	 */
	public static function renderNotificationBar($sMsg, $level = "info", $bClose = true) {
		if ($sMsg) {
			$sCloseBtn = $bClose ? '<button type="button" class="close" data-dismiss="alert">&times;</button>' : '';
			$HTML = '<div class="container">
					    <div class="alert alert-' . $level . ' bs-alert-old-docs">' . $sCloseBtn . '
					      <strong>Heads up!</strong> ' . $sMsg . '
					    </div>
					 </div>';
			echo $HTML;
		}
	}
	
	/**
	 * Render Temporal Notification Bar under Top menu
	 *
	 * @author Looper
	 * @since  2014-02-25
	 * @param  [type]                   $sMsg   [description]
	 * @param  string                   $level  [info/success/error]
	 * @param  int						$seconds[timer seconds]
	 * @return [type]                           [description]
	 */
	public static function renderTemporalNotificationBar($sMsg, $level = "info", $seconds = 3) {
		if ($sMsg) {
			$HTML = '<div class="container" id="temporalMessageDiv" style="width:100%">
					    <div class="alert alert-' . $level . ' bs-alert-old-docs">'  . $sMsg . '
					    </div>
					 </div><script>PMOS_TemporalMessage(' . $seconds . ')</script>';
			return $HTML;
		}
	}

	/**
	 * render module title
	 * @param  string $mudule
	 * @return html
	 *
	 * @author Garry
	 * @since  2014-04-30T15:18:12+0800
	 */
	public static function renderModuleTitle($mudule = 'dashboard',$mudule1) {
		
		$moduleSetting = array(
			'dashboard' => array( 
				'title'      => T("T_MENU_DASHBOARD"), 
				'desc'       => '', 
				'reloadeUrl' => '../dashboard/index'
			),
			'event'     => array( 
				'title'      => T("T_MENU_EVENT"), 
				'desc'       => T("T_MENU_EVENT_DESC"), 
				'reloadeUrl' => '../event/index'
			),
			'crisis'    => array( 
				'title'      => T("T_DASHBOARD_CRISIS"), 
				'desc'       => T("T_MENU_CRISIS_DESC"), 
				'reloadeUrl' => '../crisis/index'
			),
			'map'       => array( 
				'title'      => T("T_MENU_MAP"), 
				'desc'       => T("T_MENU_MAP_DESC"), 
				'reloadeUrl' => '../map/index'
			),
			 'roster'    => array( 
			 	'title'      => T("T_MENU_ROSTER"), 
			 	'desc'       => T("T_ROSTER_ROSTER_MODULE"), 
			 	'reloadeUrl' => '../roster/index'
			),
			'user'      => array( 
				'title'      => T("T_MENU_ORGUSER") , 
				'desc'       => T("T_MENU_USEROLE_DESC"), 
				'reloadeUrl' => '../user/index'
			),
			'publish'      => array( 
				'title'      => T("T_MENU_PUBLISH") , 
				'desc'       => T("T_MENU_PUBLISH_DESC"), 
				'reloadeUrl' => '../publish/index'
			),
			'system'      => array( 
				'title'      => T("T_MENU_SYSEMAIL") , 
				'desc'       => T("T_MENU_EMAIL_DESC"), 
				'reloadeUrl' => '../system/index'
			),
			'rbac'      => array( 
				'title'      => T("T_MENU_RBAC") , 
				'desc'       => T("T_MENU_RBAC_DESC"), 
				'reloadeUrl' => '../rbac/index'
			)
		);

		if(@$moduleSetting[$mudule] ) {

				return '
						<div class="row">
							<div class="">
								<h3 class="page-title"> '.$moduleSetting[$mudule]['title'].'  
						        	<small>'.$moduleSetting[$mudule]['desc'].'</small>
						        </h3>
						        <ul class="breadcrumb">
							        <li><a href="../dashboard/index">'.T('T_USER_HOME').'</a><span class="divider">/</span></li>
							        <li class="active">'.$moduleSetting[$mudule]['title'].'</li>
							        <li style="float:right;">
										<a class="videoGuide" href="javascript:void(0);" data-toggle="tooltip" title="'.T('T_MENU_GUIDE_VIDEO').'"><i class="icon-film"></i></a>
									</li>
						      	</ul>
							</div>
						</div>';
			}else{
			return '';
		}

	}
	
	/**
   	* Generate random number
   	*
   	* @author Fernando Ontiveros Lira <fernando@colosa.com>
   	* @access public
   	* @return int
   	*/
  	public static function generateUniqueID() {
    	do {
    		$sUID = str_replace('.', '0', uniqid(rand(0, 999999999), true));
    	} while (strlen($sUID) != 32);
		return $sUID;
    	//return strtoupper(substr(uniqid(rand(0, 9), false),0,14));
	}
  
	/**
	* send message
	* @param string $caseId 
	* @param string $sFrom  
	* @param string $sTo
	* @param string $sCc 
	* @param string $sBcc 
	* @param string $sSubject 
	* @param string $sTemplate 
	* @param $appFields = null 
	* @return $result will return an object
	*/
  	public static function sendMessage( $sFrom, $sTo, $sCc, $sBcc, $sSubject,$sType,$sPath, $sTemplate, $aFields = array(),$aAttachments = array(),$iLazy= false,$workspace=SYS_SYS ){
  	 	require_once PATH_LIBRARY . 'smarty/libs/Smarty.class.php';
  	 	require_once 'classes/class.email.php';
  	 
  	 	try{
  	  		global $GLOBAL_SETTING;
  	  		$oEmail = new emailRun();
      		$oEmail->setConfig(array(
        		'MESS_ENGINE'   => $GLOBAL_SETTING['MESS_ENGINE'],
		        'MESS_SERVER'   => $GLOBAL_SETTING['MESS_SERVER'],
		        'MESS_PORT'     => $GLOBAL_SETTING['MESS_PORT'],
		        'MESS_ACCOUNT'  => $GLOBAL_SETTING['MESS_ACCOUNT'],
		        'MESS_PASSWORD' => $GLOBAL_SETTING['MESS_PASSWORD'],
		        'SMTPAuth'      => $GLOBAL_SETTING['MESS_RAUTH']
      		));
      
      
			$fileTemplate = $sPath . $sTemplate;
			  if ($sFrom != '') {
			$sFrom = $sFrom . ' <' . $GLOBAL_SETTING['MESS_ACCOUNT'] . '>';
			} 
			else {
			$sFrom = $GLOBAL_SETTING['MESS_ACCOUNT'];
			}
			$smarty = new Smarty();
			//	self::pr($smarty);
			if($GLOBAL_SETTING['DEBUG'] && $GLOBAL_SETTING['DEBUG_SMARTY']) $smarty->debugging = true;

			$smarty->force_compile = true; // 需要修改成配置项
			$smarty->caching = false;
			$smarty->cache_lifetime = 120;
			if(defined('PATH_SITES_CACHE')) $smarty->cache_dir = PATH_SITES_CACHE;
			if(defined('PATH_SITES_CACHE')) $smarty->compile_dir = PATH_SITES_CACHE;
			//	$smarty->templateFile = $fileTemplate;
			$smarty->assign($aFields);
			$sBody = $smarty->fetch($fileTemplate);
  			$messageArray = array(
				'msg_uid'          => '',
				'msg_type'     => $sType,
				'msg_subject'  => $sSubject,
				'msg_from'     => $sFrom,
				'msg_to'       => $sTo,
				'msg_body'     => $sBody,
				'msg_cc'       => $sCc,
				'msg_bcc'      => $sBcc,
				'msg_attach'   => serialize($aAttachments),
				'msg_status'   => 'pending',
				'workspace'	   => $workspace
      		);

			$oEmail->create( $messageArray );
			// Add by looper__Lv for lazy sending eMail inner Trigger/WebService
			// -------------------------------------------------------------------------------------
			if($iLazy == true){
			// return new wsResponse (0, "message pending to be send by cron : $sTo" );
			}
      		// -------------------------------------------------------------------------------------
            $result=$oEmail->sendMail($aAttachments);

			// if ( $oSpool->status == 'sent' )
			// $result = new wsResponse (0, "message sent : $sTo" );
			// else
			// 	$result = new wsResponse (29, $oSpool->status . ' ' . $oSpool->error . print_r ($aSetup ,1 ) );
      		return $result;
    	}catch ( Exception $e ) {
			// $result = new wsResponse (100, $e->getMessage());
			return $e->getMessage();
    	}
      
  	}
  
	/**
	* Loads a Class. If the class is not defined by the aplication, it
	* attempt to load the class from gulliver.system
	*
	* @author Fernando Ontiveros Lira <fernando@colosa.com>, David S. Callizaya
	* @access public
	* @param  string $strClass
	* @return void
	*/
	public static function LoadThirdParty( $sPath , $sFile ) {
		$classfile = PATH_LIBRARY . $sPath .'/'. $sFile .
	            ( (substr($sFile,0,-4)!=='.php')? '.php': '' );
		return require_once( $classfile );
	}
  
	/**
	* If the class is not defined by the aplication, it
	* attempt to load the class from gulliver.system
	*
	* @author Fernando Ontiveros Lira <fernando@colosa.com>, David S. Callizaya
	* @access public
	* @param  string $strClass
	* @return void
	*/
  	public static function LoadClass( $strClass ) {
		$classfile = self::ExpandPath( "classes" ) . 'class.' . $strClass . '.php';
		if (!file_exists( $classfile )) {
		  	if (file_exists( PATH_GULLIVER . 'class.' . $strClass . '.php' ))
		    	return require_once( PATH_GULLIVER . 'class.' . $strClass . '.php' );
		  	else
		    	return false;
		} else {
		  	return require_once( $classfile );
		}
  	}
  
	/**
	* Expand the path using the path constants
	*
	* @author Fernando Ontiveros Lira <fernando@colosa.com>
	* @access public
	* @param  string $strPath
	* @return string
	*/
  	public static function expandPath( $strPath = '' ) {
		$res = "";
		$res = PATH_SYSTEM;
		if( $strPath != "" )
		{
		  $res .= $strPath . "/";
		}
		return $res;
  	}
  
  	/**
   	* isHttpRequest
   	*
   	* @return boolean true or false
   	*/
  	static function isHttpRequest(){
  		if( isset($_SERVER['SERVER_SOFTWARE']) && strpos(strtolower($_SERVER['SERVER_SOFTWARE']), 'apache') !== false ){
      		return true;
    	}
    	return false;
  	}
  
	/**
	 * save changed roster record
	 * @param  array         | $arr  sort array
	 * @param  string        | $keys sort key
	 * @param  string        | $type sort order
	 * @return
	 *
	 * @anchor Amy
	 * @since  2014-03-10
	 */
	function array_sort($arr,$keys,$type='asc'){ 
		$keysvalue = $new_array = array();
		foreach ($arr as $k=>$v){
			$keysvalue[$k] = $v[$keys];
		}
		if($type == 'asc'){
			asort($keysvalue);
		}else{
			arsort($keysvalue);
		}
		reset($keysvalue);
		foreach ($keysvalue as $k=>$v){
			$new_array[$k] = $arr[$k];
		}
		return $new_array; 
	}
  
	/**
	 * [renderTemplate Display the front page with Template]
	 *
	 * @author Looper
	 * @since  2014-02-06T17:08:43+0800
	 * @param  [String]                   $path [short path of the template, like: 'roster/absence']
	 * @param  [Array]                    $aData[array data of the template, like: array(data=>array()), key by data]
	 * @param  boolean                    $raw  [raw or not, true means render all the related js/css, otherwise only related html generated]
	 * @param  String 					  $sModule module name of the template, "app" as default
	 * @return [String]                         [HTML Snippt]
	 **/
	public static function renderTemplate($path, $aData=array(), $raw=false, $sModule='system'){
		global $GLOBAL_SETTING;
		$sParent = PATH_HOME . $sModule . PATH_SEP;
		$file = gulliver::checkSystemMultiModule($path, 'template');

		if(file_exists($file)){
			require PATH_LIBRARY . 'smarty/libs/Smarty.class.php';
			$smarty = new Smarty;
			if($GLOBAL_SETTING['DEBUG_SMARTY']) $smarty->debugging = true;

			// open caching for performance 20 times improved @see /gulliver.ini
			if(true || $GLOBAL_SETTING['DEBUG']) {
				$smarty->compile_check = false;
				$smarty->force_compile = true; // 需要修改成配置项
				$smarty->caching = false;
			} else {
				$smarty->compile_check = true;
				$smarty->force_compile = false; // 需要修改成配置项
				$smarty->caching = true;
				$smarty->cache_lifetime = 3600; // 1h
			}

			if(defined('PATH_SITES_CACHE')) $smarty->cache_dir = PATH_SITES_CACHE;
			if(defined('PATH_SITES_CACHE')) $smarty->compile_dir = PATH_SITES_CACHE;

			$smarty->assign("data",$aData);
			$url=md5($_SERVER['REQUEST_URI']); // @see http://www.cnblogs.com/luowei/archive/2012/04/18/2456108.html

			if($raw) {
				// 渲染部分页面,不包含header/footer
				$file = gulliver::checkSystemMultiModule($path, 'template');
				$smarty->display($file, $url);
			}
			else {
				// 渲染整张页面
				$oHeadPublisher =& headPublisher::getSingleton();
				$cssHeader = $oHeadPublisher->printCssHeader();
			    $jsHeader = $oHeadPublisher->printJSHeader();

			    // 获取当前模块,like dashboard/index, 即为dashboard模块
			    $aModule = explode('/', $path);
				$_s = new stdClass();

				$_s->login = $_SESSION['Login'] ;
				$_s->USR_UID = $_SESSION['USR_UID'];
				$_s->title = $GLOBAL_SETTING['PROJECT_NAME'];
				$_s->url = $path;
				$_s->CURRENT_MENU_CODE = str_replace("/", ".", $path);

				$_s->cssHeader = $cssHeader;
				$_s->jsHeader  = $jsHeader;
				$_s->aSideBar   = RBAC::getMenus();

				$aMenu = RBAC::getMenuByPath('/'.$path);
				$_s->menuTitle = $aMenu['MENU_TITLE'];
				$_s->menuUrl = $aMenu['MENU_URL'];
				$_s->module   = $aModule[0];

				$file = gulliver::checkSystemMultiModule($path, 'template');
				$_s->mainContentLink = $file;

				$lang_list = json_decode(str_replace("'", '"', $GLOBAL_SETTING['LANG_LIST']),true); // TODO: ...
				$_s->langList = json_encode($lang_list);
				$_s->langLocal = SYS_LANG;
				
				$smarty->assign('_s', $_s);
				$smarty->display(PATH_SYSTEM . 'template/index.tpl', $url);
			}
		}else{
			die("Couldn't get the template file: $path from " . $sParent . 'template/' . $path . '.tpl');
		}
	}

	/**
	 * mulri sort array
	 * @anchor Garry
	 * @since  2013-11-12T09:09:36+0800
	 * @param  array        	$multi_array 
	 * @param  key      	    $sort_key    
	 * @param  type 	        $sort        
	 * @return array
	 */
	public static function multi_array_sort($multi_array,$sort_key,$sort=SORT_ASC){
		if(is_array($multi_array)){
			if(count($multi_array) > 0){
				foreach ($multi_array as $row_array){
					if(is_array($row_array)){
						$key_array[] = $row_array[$sort_key];
					}else{
						return false;
					}
				}
			}else{
				return $multi_array;
			}
		}else{
			return false;
		}
		array_multisort($key_array,$sort,$multi_array);
		return $multi_array;
	}

	// End class gulliver 
}


/**
 * eprint
 *
 * @param  string $s default value ''
 * @param  string $c default value null
 *
 * @return void
 */
function eprint($s = "", $c = null){
  if( gulliver::isHttpRequest() ){
    if(isset($c)){
      echo "<pre style='color:$c'>$s</pre>";
    } else
      echo "<pre>$s</pre>";
  } else {
    if(isset($c)){
      switch($c){
        case 'green':
          printf("\033[0;35;32m$s\033[0m");
          return;
        case 'red':
          printf("\033[0;35;31m$s\033[0m");
          return;
        case 'blue':
          printf("\033[0;35;34m$s\033[0m");
          return;
        default: print "$s";
      }
    } else
      print "$s";
  }
}

/**
 * println
 *
 * @param  string $s
 *
 * @return eprintln($s)
 */
function println($s){
  return eprintln($s);
}

/**
 * eprintln
 *
 * @param  string $s
 * @param  string $c
 *
 * @return void
 */
function eprintln($s="", $c=null){
	if( gulliver::isHttpRequest() ){
		if(isset($c)){
		  	echo "<pre style='color:$c'>$s</pre>";
		} else
		  	echo "<pre>$s</pre>";
	} else {
		if(isset($c) && (PHP_OS != 'WINNT')){
		  	switch($c){
			    case 'green':
			      	printf("\033[0;35;32m$s\033[0m\n");
		     	 	return;
			    case 'red':
			      	printf("\033[0;35;31m$s\033[0m\n");
			      	return;
			    case 'blue':
			      	printf("\033[0;35;34m$s\033[0m\n");
			      	return;
		  	}
		}
		print "$s\n";
	}
}

?>