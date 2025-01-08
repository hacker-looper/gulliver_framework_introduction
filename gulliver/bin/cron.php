<?php

/***
 * 0 1 0 0 0 php -f /CSDA_IOTAPI/bin/cron.php test
 */

$docuroot =  realpath(dirname(__FILE__) . '/../'); // path to /crisisgo
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
set_time_limit(0);
ini_set('memory_limit', '1024M'); // nore: this may need to be higher for many projects
$mem_limit = (int) ini_get('memory_limit');

require $docuroot . '/config/paths.php';
require $docuroot . '/config/define.php';
require $docuroot . '/classes/class.gulliver.php';

$db = 'CSDA_IOT';
$argsx = '';
for($i=1; $i<count($argv); $i++){
  if( strpos($argv[$i], '+w') !== false){
    $db = substr($argv[$i],2);
  } else {
    $argsx .= ' '.$argv[$i];
  }
}
system('php -f ' . $docuroot . '/bin' . PATH_SEP . 'cron_single.php ' . $db . ' ' . $argsx, $returnVal);
eprintln("Finished workspaces processed.");
