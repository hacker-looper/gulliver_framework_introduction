<?php

/***********************************************************
 * PHP内置服务器：php>=5.4.0
 * php -S 127.0.0.1:2017 -t . route-api.php
 * @see http://laravelacademy.org/post/4422.html
 * @author Looper Lvy
 * @since  2016-05-22
 ***********************************************************/

if ( PHP_OS == 'WINNT' ) define('PATH_SEP', '\\'); else define('PATH_SEP', '/');

$docRoot = dirname(dirname(__FILE__));
if($_SERVER['REQUEST_URI']=='/favicon.ico') return;

{
	// http://127.0.0.1:2017/css/1.css
	// http://127.0.0.1:2017/xxx.js
	// http://127.0.0.1:2017/lib/xxx
	// http://127.0.0.1:2017/images/xxx
	if(file_exists($docRoot.'/doc'.$_SERVER['REQUEST_URI'])){
		echo file_get_contents($docRoot.PATH_SEP.'doc'.$_SERVER['REQUEST_URI']);
	}else{

		// http://127.0.0.1:2017/doc
		if($_SERVER['REQUEST_URI']=='/doc'){
			echo file_get_contents($docRoot.PATH_SEP.'doc'.PATH_SEP.'index.html');
		}

		// http://127.0.0.1:2017
		else{
			require_once $docRoot.PATH_SEP.'index.php';
		}

	}
}
