<?php

/**
 * Cron Single Script Running for Specific WorkSpace
 * php -f ./cron_single.php $workspace $args
 * like:
 * php -f ./cron_single.php CrisisGo email
 * 
 * @author Looper Lvy <looper@edautomate.com>
 * @since  CrisisGo2.0
 * @see    cron.php
 **/

$docuroot =  realpath(dirname(__FILE__) . '/../'); // path to /crisisgo
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
set_time_limit(0);
ini_set('memory_limit', '2000M'); // nore: this may need to be higher for many projects
$mem_limit = (int) ini_get('memory_limit');

require $docuroot . '/config/paths.php';
require $docuroot . '/config/define.php';
require $docuroot . '/classes/class.gulliver.php';


try{

  if (! defined('SYS_SYS')) {
    $sWS = $argv[1];
    $args = '';
    
    for($i=2; $i<count($argv); $i++) $args .= ' '.$argv[$i];

    $args = trim($args);
    // running bussiness cron script by $args
    $script = PATH_HOME . 'cron' . PATH_SEP . 'cron_' . $args . '.php';
    eprint(date('Y-m-d H:i:sP')."|Running CronJob SYS_SYS:".$sWS.':' . $script);
    if(! file_exists($script)) throw new Exception('Error: couldnt found cron script BY:' . $script);
    include $script;

    $status = true;
    $message = $args.' successful.';
  
  } else {
    throw new Exception('Error: No Workspace Found, Please Check!');
  }

}catch(Exception $e){
  $status = false;
  $message = 'Error:'.$args.' Failed, Exception:'.$e->getMessage();
}

$aAux[SYS_SYS][$args]['status'] = $status; // false;
$aAux[SYS_SYS][$args]['message'] = $message; // false;
$aAux[SYS_SYS][$args]['last_execution'] = date('Y-m-d H:i:s');

eprint(date('Y-m-d H:i:sP')."|"."CMD RUN RESULT: ".serialize($aAux));
