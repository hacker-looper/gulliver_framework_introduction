<?php


if ( PHP_OS == 'WINNT' ) define('PATH_SEP', '\\'); else define('PATH_SEP', '/');

define('PATH_HOME',    			dirname(dirname(__FILE__)) . PATH_SEP);  # path to /
define('PATH_CONFIG',     		PATH_HOME. 'config' . PATH_SEP);  		 # path to /config

if(! defined('PATH_GULLIVER_BIN')) 
define('PATH_GULLIVER_BIN',  	PATH_HOME . 'bin' . PATH_SEP );   		 # path to /bin

define('PATH_VENDOR', 			PATH_HOME . 'classes/vendor/' );         # path to /vendor

### 多空间相关
define('PATH_SHARED', 			PATH_HOME   . 'shared/' );
define('PATH_BACKUP', 			PATH_SHARED . 'backup/' );
define('PATH_UPGRADE', 			PATH_SHARED . 'upgrade/' );
define('PATH_SITES', 			PATH_SHARED . 'sites/' );
define('PATH_DB', 			PATH_SHARED . 'sites/' );
define('PATH_LOG', 				PATH_SHARED . 'logs/' );
define('PATH_LIBRARY', 			PATH_HOME 	. 'classes/library/' );


### 系统加载路径
set_include_path(
	PATH_HOME    . PATH_SEPARATOR .
    PATH_LIBRARY . PATH_SEPARATOR .
    PATH_LIBRARY . 'propel-generator' . PATH_SEP . 'classes' . PATH_SEP . PATH_SEPARATOR .
    PATH_LIBRARY . 'pear'    . PATH_SEP . PATH_SEPARATOR .
    get_include_path()
);