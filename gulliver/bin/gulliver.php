<?php

  if (! PATH_LIBRARY ) {
    die("You must launch Gulliver command line with the gulliver script\n");
  }
  
  // set magic_quotes_runtime to off
  ini_set('magic_quotes_runtime', 'Off');
  
   /**
   * require_once pakeFunction.php
   */
    require_once( PATH_LIBRARY . 'pake' . PATH_SEP . 'pakeFunction.php');
    require_once( PATH_LIBRARY . 'pake' . PATH_SEP . 'pakeGetopt.class.php');

  // trap -V before pake @see /crisisgo/VERSION
  if (in_array('-V', $argv) || in_array('--version', $argv))
  {
    global $GLOBAL_SETTING;
    printf("Gulliver version %s\n", pakeColor::colorize($GLOBAL_SETTING['VERSION'], 'INFO'));
    exit(0);
  }

  if (count($argv) <= 1)
  {
    $argv[] = '-T';
  }


  // register tasks
  $dir = PATH_HOME . 'bin' . PATH_SEP . 'tasks';
  $tasks = pakeFinder::type('file')->name( 'pake*.php' )->in($dir);

  foreach ($tasks as $task) {
    include_once($task);
  }

  // run task
  pakeApp::get_instance()->run(null, null, false);
  exit(0);
