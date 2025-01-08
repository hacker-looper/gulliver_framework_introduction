<?php

/***************************************************************************************************
 * 系统变量初始化脚本
 * 
 * @author looper <looper@iething.com>
 * @since [Gulliver V1.0]
 **************************************************************************************************/

$GLOBAL_SETTING = array();
foreach (glob(PATH_CONFIG.'*.ini') as $k=>$v) {
	$GLOBAL_SETTING = array_merge($GLOBAL_SETTING, parse_ini_file($v));
}

if($GLOBAL_SETTING['TIMEZONE']) {
	date_default_timezone_set($GLOBAL_SETTING['TIMEZONE']);
}
