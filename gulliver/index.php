<?php

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);

$home =  __DIR__.'/';
require_once $home.'config/paths.php';
require_once $home.'config/lib.php';
require_once PATH_CONFIG."define.php";
require_once PATH_HOME.'classes/class.RBAC.php';
require_once PATH_HOME."classes/class.gulliver.php";
require_once PATH_VENDOR.'autoload.php';
require_once PATH_HOME.'classes/class.log4.php';

use Luracast\Restler\Restler;
use Luracast\Restler\iAuthenticate;
require_once 'vendor/restler.php';

gulliver::loadModule_Propel();

$r = new StdClass();
Defaults::$useUrlBasedVersioning = true;           // 基于Version访问
Defaults::$cacheDirectory = PATH_SITES . 'cache';  // 接口缓存m目录

global $GLOBAL_SETTING;
if($GLOBAL_SETTING['RELEASE_MODEL'] == 'prod'){
  gulliver::verifyPath(PATH_SITES.'cache', true);
  $r = new Restler(true,  false);      // prod model
}else{
  $r = new Restler(false, true);       // dev  model
}

$aFiles = gulliver::getFilesInFloder(PATH_HOME.'service/', true);
foreach($aFiles as $file){
  if(strpos($file, '.php',1) && !strpos($file, 'Peer.php',1) ) {
    require_once($file);
    $className = str_replace(".php", "", basename($file));
    $namespace = "Services_Rest_";
    $classNameAuth = $namespace . $className;

    if(class_exists($classNameAuth)){
      $r->addAPIClass($classNameAuth);
    }
  }
}

//this creates resources.json at API Root
$r->addAPIClass('Luracast\\Restler\\Resources');
$r->setSupportedFormats('JsonFormat', 'UploadFormat');
$r->setAPIVersion($GLOBAL_SETTING['VERSION']); // api_version: v1
$r->addAuthenticationClass('Services_Rest_Auth');
$r->handle();