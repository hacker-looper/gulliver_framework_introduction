<?php

pake_desc('gulliver version');
pake_task('version', 'project_exists');

// pake_desc('create new module');
// pake_task('create-module', 'project_exists');

if(PHP_OS == 'WINNT'){
  pake_desc("run webserver with php(5.4+) webserver: usage: gulliver.bat start-webserver 127.0.0.1:2016");  
}else{
  pake_desc("run webserver with php(5.4+) webserver: usage: ./gulliver   start-webserver 127.0.0.1:2016");
}
pake_task('start-webserver', 'project_exists');


if(PHP_OS == 'WINNT'){
  pake_desc("run apiserver with php(5.4+) apiserver: usage: gulliver.bat start-apiserver 127.0.0.1:2017");  
}else{
  pake_desc("run apiserver with php(5.4+) apiserver: usage: ./gulliver   start-apiserver 127.0.0.1:2017");
}
pake_task('start-apiserver', 'project_exists');

pake_desc("backup a workspace\n   args: [-c|--compress] <workspace> [<backup-name>|<backup-filename>]");
pake_task('workspace-backup', 'project_exists');

//pake_desc("restore a previously backed-up workspace\n   args: [-o|--overwrite] <filename> <workspace>");
//pake_task('workspace-restore', 'project_exists');


/**
 * Function run_version, access public
 *
 * @author Looper
 * @since  2014-02-16T19:45:10+0800
 * @param  [type]                   $task [description]
 * @param  [type]                   $args [description]
 * @return [type]                         [description]
 */
function run_version($task, $args) {
  global $GLOBAL_SETTING;
  printf("Gulliver Framework Version %s\n", pakeColor::colorize($GLOBAL_SETTING['VERSION'], 'INFO'));
  exit(0);
}

/**
 * 创建新业务模块, 用于扩展多业务场景
 * Function run_create_module, access public
 *
 * @author Looper
 * @since  2014-02-16T19:45:10+0800
 * @param  [type]                   $task [description]
 * @param  [type]                   $args [description]
 * @return [type]                         [description]
 */
function run_create_module($task, $args) {
  if(! $args[0]){
    printf("Create Gulliver New Module Field: (Error ModuleName) %s\n", pakeColor::colorize('./gulliver create-module modulename', 'ERROR'));
    exit(0);
  }

  // 在项目根目录创建最新模块: /iething/{$module}
  gulliver::verifyPath(PATH_HOME.$args[0], true);
  gulliver::xCopy(PATH_SHARED.'resource'.PATH_SEP.'module', PATH_HOME.$args[0], true);

  printf("Create Gulliver New Module: %s AT %s\n", pakeColor::colorize($args[0], 'INFO'), PATH_HOME.$args[0]);
  exit(0);
}

/**
 * Function run_webserver, access public
 *
 * @author Looper
 * @since  2018-03-24T19:45:10+0800
 * @param  [type]                   $task [description]
 * @param  [type]                   $args [description]
 * @return [type]                         [description]
 */
function run_start_webserver($task, $args){
  if(! $args[0]){
    $args[0] = "127.0.0.1:2016";
  }

  printf("Run Gulliver WebServer: %s\n", pakeColor::colorize($args[0], 'INFO'));
  $cmd = "php -S ".$args[0]." -t . config/route-web.php";
  exec($cmd);
}

/**
 * Function run_api, access public
 *
 * @author Looper
 * @since  2018-03-24T19:45:10+0800
 * @param  [type]                   $task [description]
 * @param  [type]                   $args [description]
 * @return [type]                         [description]
 */
function run_start_apiserver($task, $args){
  if(! $args[0]){
    $args[0] = "127.0.0.1:2017";
  }

  printf("Run Gulliver WebServer: %s\n", pakeColor::colorize($args[0], 'INFO'));
  $cmd = "php -S ".$args[0]." -t . config/route-api.php";
  exec($cmd);
}

/**
 * [run_workspace_backup description]
 *
 * Notice: deprecate re-name backup tar file feature, format as {$workspace}-timestamp.tar
 * gulliver.bat workspace-backup [-c] gulliver2   ->  /gulliver/shared/backup/gulliver2-20140422121311.tar[.gz]
 * 
 * @author Looper
 * @since  gulliver V2.0.0 2014-04-22T14:13:29+0800
 * @param  [type]                   $task [description]
 * @param  [type]                   $args [description]
 * @return [type]                         [description]
 */
function run_workspace_backup($task, $args) {
  try {
    ini_set('display_errors', 'on');
    ini_set('error_reporting', E_ALL);

    // step1, 解析命令行参数
    /* Look for -c and --compress in arguments */
    $compress = array_search('-c', $args);
    if ($compress === false) $compress = array_search('--compress', $args);
    if ($compress !== false) {
      unset($args[$compress]);
      /* We need to reorder the args if we removed the compress switch */
      $args = array_values($args);
      $compress = true;
    }

    /* Look for -c and --compress in arguments */
    $overwrite = array_search('-o', $args);
    if ($overwrite === false) $overwrite = array_search('--overwrite', $args);
    if ($overwrite !== false) {
      unset($args[$overwrite]);
      /* We need to reorder the args if we removed the compress switch */
      $args = array_values($args);
      $overwrite = true;
    }

    if (array_search('compress', $args)) {
      echo pakeColor::colorize("Compress is no longer an option, check if this is what you want\n", 'ERROR');
    }

    if (count($args) >= 2 || count($args) == 0) throw (new Exception('wrong arguments specified')); // 不支持重命名功能

    $workspace = $args[0];
    define('SYS_SYS', $workspace);

    /* Use system gzip if not in Windows */
    if ($compress && strtolower(reset(explode(' ',php_uname('s')))) != "windows") {
      /* Find the system gzip */
      exec("whereis -b gzip", $whereisGzip);
      $gzipPaths = explode(' ', $whereisGzip[0]);
      if (isset($gzipPaths[1]))
        $gzipPath = $gzipPaths[1];
      if (isset($gzipPath)) echo "Using system gzip in $gzipPath\n";
    }

    // step2, 准备打包环境
    if(! file_exists(PATH_BACKUP)) gulliver::mk_dir(PATH_BACKUP);
    
    $fileBase = PATH_BACKUP . $workspace . '-' . date('YmdHis') .'.tar';
    $fileTar = $fileBase;
    if ($compress) $fileTar .= '.gz';
    printf("Backing up workspace %s to %s\n", pakeColor::colorize($workspace, 'INFO'), pakeColor::colorize($fileTar, 'INFO'));
      
    /* To avoid confusion, we remove both .tar and .tar.gz */
    if (!$overwrite && (file_exists($fileBase) || file_exists($fileBase.'.gz'))) {
        $overwrite = strtolower(prompt('Backup file already exists, do you want to overwrite? [Y/n]'));
        if( array_search(trim($overwrite), array("y", "")) === false ) die();
        $overwrite = true;
    }
    
    if (file_exists($fileBase)) unlink($fileBase);
    if (file_exists($fileBase.".gz")) unlink($fileBase.'.gz');

    /* Remove the backup file before backing up. Previous versions didn't do
     * this, so backup files would increase indefinetely as new data was
     * appended to the tar file instead of replaced.
     */
    if (file_exists($fileTar)) unlink($fileTar);

    /* If using the system gzip, create the tar using a temporary filename */
    if (isset($gzipPath)) {
      $gzipFinal = $fileTar;
      $fileTar = tempnam(__FILE__, '');
    }

    // Step3, 准备运行环境
    global $GLOBAL_SETTING;
    /*$siteWSFolder = PATH_DB . $workspace . PATH_SEP;
    if( ! file_exists($siteWSFolder) ) {
      throw (new Exception("Invalid workspace, CHECKING: $siteWSFolder"));
    }*/
    
    require_once 'classes/class.dbMaintenance.php';
    $oDbMaintainer = new DataBaseMaintenance($GLOBAL_SETTING['DB_HOST'], $GLOBAL_SETTING['DB_USERNAME'], $GLOBAL_SETTING['DB_PASSWD']);
    try{
      $oDbMaintainer->setDbName($workspace);
      $oDbMaintainer->connect();
    } catch(Exception $e){
      echo "Problems contacting the database with the administrator user\n";
      echo "The response was: {$e->getMessage()}\n";
    }
    
    require_once ("propel/Propel.php");
    Propel::init(PATH_HOME . "config/databases.php");
    $configuration = Propel::getConfiguration();
    $connectionDSN = $configuration['datasources']['gulliver']['connection'];
    printf("using DSN Connection %s \n", pakeColor::colorize($connectionDSN, 'INFO'));

    // sys_get_temp_dir: php>=5.2.1
    if(! function_exists('sys_get_temp_dir'))
      throw (new Exception("unable to use sys_get_temp_dir, make sure php version >= 5.2.1"));
    $tmpDir = sys_get_temp_dir() . '_db_backup' . PATH_SEP;
    if(! file_exists($tmpDir)) gulliver::mk_dir($tmpDir);

    $fileMetadata = $tmpDir . 'metadata';
    $sMetadata = file_put_contents($fileMetadata, 'gulliver Version Backup Workspace: '.$workspace);
    if ($sMetadata === false) {
      throw new Exception("$fileMetadata file could not be written");
    }

    require_once 'pear/Archive/Tar.php';
    $tar = new Archive_Tar($fileTar);
    if (!isset($gzipPath)) $tar->_compress = $compress;
    
    /*** gulliver DATABASE BACKUP ***/
    $dbSettings = _getDataBaseConfiguration($configuration['datasources']['app']['connection']);
    _backupWorkspaceDB($GLOBAL_SETTING['DB_HOST'], $GLOBAL_SETTING['DB_USERNAME'], $GLOBAL_SETTING['DB_PASSWD'], $workspace, $tmpDir);
    printf("Copying folder: %s \n", pakeColor::colorize( $tmpDir, 'INFO'));
    _backupAddTarFolder( $tar, $tmpDir . $dbSettings['dbname'] . PATH_SEP, $tmpDir );
    
    $pathSharedBase = PATH_DB . $workspace . PATH_SEP;
    printf("copying folder: %s \n", pakeColor::colorize($pathSharedBase, 'INFO'));
    _backupAddTarFolder($tar, $pathSharedBase, PATH_DB);
    
    _backupAddTarFolder($tar, $fileMetadata, dirname($fileMetadata));
    unlink($fileMetadata);
    $aFiles = $tar->listContent();
    
    $total = 0;
    foreach( $aFiles as $key => $val ) {
      $total += $val['size']; // printf( " %6d %s \n", $val['size'], pakeColor::colorize( $val['filename'], 'INFO') );
    }

    /* If using system gzip, compress the temporary tar to the original
     * filename.
     */
    if (isset($gzipPath)) {
      exec("gzip -c \"$fileTar\" > $gzipFinal", $output, $ret);
      if ($ret != 0) {
        /* The error message is in stderr, which should be displayed already */
        echo pakeColor::colorize("Error compressing backup", "ERROR") . "\n";
        die(1);
      }
      unlink($fileTar);
      $fileTar = $gzipFinal;
    }

    printf("%20s %s \n", 'Backup File', pakeColor::colorize($fileTar, 'INFO'));
    printf("%20s %s \n", 'Files in Backup', pakeColor::colorize(count($aFiles), 'INFO'));
    printf("%20s %s \n", 'Total Filesize', pakeColor::colorize(sprintf("%5.2f MB", $total / 1024 / 1024), 'INFO'));
    printf("%20s %s \n", 'Backup Filesize', pakeColor::colorize(sprintf("%5.2f MB", filesize($fileTar) / 1024 / 1024), 'INFO'));
  
  } catch( Exception $e ) {
    printf("Error: %s\n", pakeColor::colorize($e->getMessage(), 'ERROR'));
    exit(0);
  }
}

/**
 * [run_workspace_restore description]
 * gulliver.bat workspace-restore Looper-20140428035235.tar Looper
 * ./gulliver workspace-restore Looper-20140624135307.tar.gz Looper
 * 
 * @author Looper
 * @since  gulliver2 2014-04-22T14:13:33+0800
 * @param  [type]                   $task [description]
 * @param  [type]                   $args [description]
 * @return [type]                         [description]
 **/
function run_workspace_restore($task, $args) {
  try {
    ini_set('display_errors', 'on');
    ini_set('error_reporting', E_ALL);
    
    $overwrite = array_search('-o', $args);
    if ($overwrite === false)
      $overwrite = array_search('--overwrite', $args);
    if ($overwrite !== false) {
      unset($args[$overwrite]);
      $args = array_values($args);
      $overwrite = true;
    }

    $backupFile = PATH_BACKUP . $args[0];
    // 必须为2个参数: 1,tar包名  2,workspace名  
    if (count($args) != 2) throw (new Exception('Wrong number of arguments specified'));
    if (!file_exists($backupFile)) throw(new Exception("Backup file not found."));

    $targetWorkspaceName = isset($args[1]) ? $args[1] : NULL;
    if($targetWorkspaceName) define('SYS_SYS', $targetWorkspaceName);

    printf("Restore %s BY file %s \n", $backupFile, pakeColor::colorize($backupFile, 'INFO'));
    
    if( _workspaceRestore($backupFile, $targetWorkspaceName, $overwrite) ) {
      printf("Successfully restored %s from file %s \n", $backupFile, pakeColor::colorize($backupFile, 'INFO'));
    } else {
      throw (new Exception('There was an error in file descompression. '));
    }
  } catch( Exception $e ) {
    printf("Error: %s\n", pakeColor::colorize($e->getMessage(), 'ERROR'));
    exit(0);
  }
}

function _workspaceRestore($backupFilename, $targetWorkspace, $overwrite) {
  global $GLOBAL_SETTING;
  $tempDirectory = tempnam(__FILE__, '');
  if (file_exists($tempDirectory)) {
    unlink($tempDirectory);
  }
  
  if (file_exists($tempDirectory)) gulliver::rrmdir($tempDirectory);
  gulliver::mk_dir($tempDirectory);
  
  require_once 'pear/Archive/Tar.php';  
  $tar = new Archive_Tar($backupFilename);
  $res = $tar->extract($tempDirectory);
  
  $metadataFilename = $tempDirectory . PATH_SEP . 'metadata';
  if (!file_exists($metadataFilename)) {
    throw (new Exception("Metadata file was not found in backup, its not a ligel gulliver2 workspace backup tar!"));
  }
  
  echo "Restoring to workspace:   ".pakeColor::colorize($targetWorkspace, 'INFO')."\n";
  
  //moving the site files
  $backupWorkspaceDir = $tempDirectory . PATH_SEP . SYS_SYS;
  $targetWorkspaceDir = PATH_SHARED . 'sites' . PATH_SEP . $targetWorkspace;

  if (!$overwrite && file_exists($targetWorkspaceDir)) {
    $overwrite = strtolower(prompt('Workspace:' . $targetWorkspaceDir . ' already exists, do you want to overwrite? [Y/n]'));
    if( array_search(trim($overwrite), array("y", "")) === false ) die();
    $overwrite = true;
  }

  printf("Moving files to %s \n", pakeColor::colorize($targetWorkspaceDir, 'INFO'));
  
  /* We already know we will be overwriting the new workspace if we reach this
   * point, so remove the workspace directory if it exists.
   */
  if (file_exists($targetWorkspaceDir)) {
    gulliver::rrmdir($targetWorkspaceDir);
  }

  try{
    gulliver::moveDir($backupWorkspaceDir, $targetWorkspaceDir);
  } catch(Exception $e) {
    throw (new Exception("There was an error moving from $backupWorkspaceDir to $targetWorkspaceDir ,Exception:".$e->getMessage()));
  }
 
  require_once 'classes/class.dbMaintenance.php';
  $oDbMaintainer = new DataBaseMaintenance($GLOBAL_SETTING['DB']['DB_HOST'], $GLOBAL_SETTING['DB']['DB_USERNAME'], $GLOBAL_SETTING['DB']['DB_PASSWD']);
  _restoreDB($GLOBAL_SETTING['DB']['DB_HOST'], $oDbMaintainer, $targetWorkspace, $targetWorkspace, $GLOBAL_SETTING['DB']['DB_USERNAME'], $GLOBAL_SETTING['DB']['DB_PASSWD'], $tempDirectory, $overwrite);

  // <TODO> INSERT OR REPLACE INTO ADMIN_WORKSPACE
  $adminSQL = "UPDATE `ADMIN_WORKSPACE` SET WS_STATUS = '1' WHERE WS_CODE = '$targetWorkspace';";
  $oDbMaintainer->connect('Admin');
  $oDbMaintainer->query($adminSQL);

  echo "\n";
  return true;
}

function _restoreDB($dbHost, $dbMaintainer, $dbOldName, $dbName, $dbUser, $dbPass, $tempDirectory, $overwrite) {
  printf("Restoring database %s to %s\n", $dbOldName, pakeColor::colorize($dbName, 'INFO'));

  /* Check if the hostname is local (localhost or 127.0.0.1) */
  $islocal = (strcmp(substr($dbHost, 0, strlen('localhost')),'localhost')===0) ||
             (strcmp(substr($dbHost, 0, strlen('127.0.0.1')),'127.0.0.1')===0);

  $dbMaintainer->connect('mysql');

  $result = $dbMaintainer->query("SELECT * FROM `user` WHERE user='$dbUser' AND password=PASSWORD('{$dbPass}')");
  if( ! isset($result[0]) ){ //the user doesn't exist
    $dbHostPerm = $islocal ? "localhost":"%";
    $dbMaintainer->query("INSERT INTO user VALUES('$dbHostPerm','$dbUser',PASSWORD('{$dbPass}'),'Y','Y','N','N','N','N','N','N','N','N','N','N','N','N','N','N','N','N','N','N','N','N','N','N','N','N','','','','',0,0,0,0);");
  }
  $dbMaintainer->query("GRANT ALL PRIVILEGES ON `$dbUser`.* TO $dbName@'localhost' IDENTIFIED BY '{$dbPass}' WITH GRANT OPTION");

  if( $overwrite ) {
    $dbMaintainer->createDb($dbName, true);
  } else {
    $dbMaintainer->createDb($dbName);
  }

  $dbMaintainer->connect($dbName);
  $dbMaintainer->setTempDir($tempDirectory . PATH_SEP . $dbOldName . PATH_SEP);
  $dbMaintainer->restoreFromSql(PATH_SHARED . 'sites' . PATH_SEP . $dbName  . PATH_SEP . 'app.sql');
  $dbMaintainer->restoreAllData('sql');
}

/**
 * Parse and get the database parameters from a dns connection
 * dsn sample  mysql://wf_os:w9j14dkf5v0m@localhost:3306/Barrington?encoding=utf8
 **/
function _getDataBaseConfiguration($dsn) {
  $dsn = trim($dsn);
  $tmp = explode(':', $dsn);
  $tmp2 = str_replace('//', '', $tmp[1]);
  $result["user"] = $tmp2;
  $tmp2 = explode('@', $tmp[2]);
  $result["passwd"] = $tmp2[0];
  $result["host"] = $tmp2[1];
  $tmp2 = explode('?', $tmp[3]);
  $tmp2 = explode('/', $tmp2[0]);
  $result["port"] = $tmp2[0];
  $result["dbname"] = $tmp2[1];
  
  return $result;
}

function _backupWorkspaceDB($host, $user, $passwd, $dbname, $tmpDir){
  require_once 'classes/class.dbMaintenance.php';
  $oDbMaintainer = new DataBaseMaintenance($host, $user, $passwd);
  //stablishing connetion with host
  $oDbMaintainer->connect($dbname);
  //set temporal dir. for maintenance for oDbMaintainer object
  $oDbMaintainer->setTempDir($tmpDir . $dbname . PATH_SEP);
  //create the backup
  $oDbMaintainer->backupDataBase($oDbMaintainer->getTempDir() . "app.sql");
  $oDbMaintainer->backupSqlData();
}

function _backupAddTarFolder($tar, $pathBase, $pluginHome) {
  $empty = true;
  print "  " . str_replace($pluginHome, '', $pathBase) . "\n";
  if( $handle = @opendir($pathBase) ) {
    while( false !== ($file = readdir($handle)) ) {
      if( is_file($pathBase . $file) ) {
        $empty = false;
        $tar->addModify(array($pathBase . $file), '', $pluginHome);
      }
      if( is_dir($pathBase . $file) && $file != '..' && $file != '.' ) {
        //print "dir $pathBase$file \n";
        _backupAddTarFolder($tar, $pathBase . $file . PATH_SEP, $pluginHome);
        $empty = false;
      }
    }
    closedir($handle);
  }
  if( $empty /*&& $pathBase . $file != $pluginHome */) {
    @$tar->addModify(array($pathBase . $file), '', $pluginHome);
  }

}

function prompt_win($text) {
  
  print $text;
  flush();
  @ob_flush();
  $read = trim(fgets(STDIN));
  return $read;

}

function prompt($text) {
  
  if( ! (PHP_OS == "WINNT") ) {
    printf("$text%s ", pakeColor::colorize(':', 'INFO'));
    # 4092 max on win32 fopen
    

    //$fp=fopen("php://stdin", "r");
    $fp = fopen("/dev/tty", "r");
    $in = fgets($fp, 4094);
    fclose($fp);
    
    # strip newline
    (PHP_OS == "WINNT") ? ($read = str_replace("\r\n", "", $in)) : ($read = str_replace("\n", "", $in));
  } else {
    $read = prompt_win($text);
  }
  
  return $read;
}
