<?php

/***********************************************************
 * PHP内置服务器：php>=5.4.0
 * php -S 127.0.0.1:2016 -t . route-web.php
 * @see http://laravelacademy.org/post/4422.html
 * @author Looper Lvy
 * @since  2016-05-22
 ***********************************************************/


if($_SERVER['REQUEST_URI']=='/php.php') {
	require_once 'php.php';
}

if($_SERVER['REQUEST_URI']=='/favicon.ico') return;

$i = strripos($_SERVER["REQUEST_URI"], '/');
if ($i!==0) {
	require_once './sysGeneric.php';
}else{
	if($_SERVER['REQUEST_URI']=='/'){
		require_once './index.php';
	}else{
		require_once '.'.$_SERVER['REQUEST_URI'];
	}
}