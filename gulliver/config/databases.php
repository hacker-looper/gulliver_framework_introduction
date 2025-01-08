<?php

/**
 * PROPEL-MULTITENDENCY 数据库配置
 **/

global $GLOBAL_SETTING;

$pro ['datasources']['app']['connection'] = 'mysql://'.$GLOBAL_SETTING['DB_USERNAME'] . ':' . $GLOBAL_SETTING['DB_PASSWD'] . '@'.$GLOBAL_SETTING['DB_HOST'] .':'.$GLOBAL_SETTING['DB_PORT'] .'/' . $GLOBAL_SETTING['DB_DATABASE'] . '?encoding=utf8';
$pro ['datasources']['app']['adapter']    = 'mysql'; 

$pro ['datasources']['system']['connection'] = 'mysql://'.$GLOBAL_SETTING['DB_USERNAME'] . ':' . $GLOBAL_SETTING['DB_PASSWD'] . '@'.$GLOBAL_SETTING['DB_HOST'] .':'.$GLOBAL_SETTING['DB_PORT'] .'/' . $GLOBAL_SETTING['DB_DATABASE'] . '?encoding=utf8';
$pro ['datasources']['system']['adapter']    = 'mysql'; 

return $pro;
?>