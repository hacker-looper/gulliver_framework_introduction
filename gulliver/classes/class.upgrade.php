<?php

class upgrade {

	public static function packAppModule(){
		require_once 'pear/Archive/Tar.php';
		if(! file_exists(PATH_APP . 'VERSION')) die('/app/VERSION is missing, please check!');

		crisisgo::verifyPath(PATH_UPGRADE, 1);
		$version = file_get_contents(PATH_APP . 'VERSION');
		if(file_exists(PATH_UPGRADE."app_$version.tar")) unlink(PATH_UPGRADE."app_$version.tar");
	    $tar = new Archive_Tar(PATH_UPGRADE."app_$version.tar");

	    self::_tarFolder($tar, PATH_APP, PATH_HOME);

	    $aFiles = $tar->listContent();
	    $total = 0;
	    foreach( $aFiles as $key => $val ) {
	      $total += $val['size'];
	    }

	    printf("%20s %s \n", 'Backup File', PATH_UPGRADE."app_$version.tar<br/>");
	    printf("%20s %s \n", 'Files in Backup', count($aFiles)."<br/>");
	    printf("%20s %s \n", 'Total Filesize', sprintf("%5.2f MB", $total / 1024 / 1024)."<br/>");
	    printf("%20s %s \n", 'Backup Filesize', sprintf("%5.2f MB", filesize(PATH_UPGRADE."app_$version.tar") / 1024 / 1024)."<br/>");
	}

	public static function upgradeAppModule($version="2.0.0"){
		require_once 'pear/Archive/Tar.php';
		$tar = new Archive_Tar(PATH_UPGRADE."app_$version.tar");

		// 备份现在的代码 /app to /app_backup
		rename(PATH_HOME . 'app', PATH_HOME . 'app_backup');

		// 解压升级包到 /app
		$tar->extract(PATH_HOME);

		// 需要解决2个问题： 
		// js/css 缓存
		// mysql数据库同步问题
	}

	/**
	 * TAR FOLDER TO *.tar.gz
	 *
	 * @author Looper
	 * @since  2014-07-10T14:56:54+0800
	 * @param  [type]                   $tar      [description]
	 * @param  [type]                   $pathBase [description]
	 * @param  [type]                   $pathHome   [description]
	 * @return [type]                             [description]
	 **/
	private static function _tarFolder($tar, $pathBase, $pathHome) {
	  $empty = true;
	  if( $handle = @opendir($pathBase) ) {
	    while( false !== ($file = readdir($handle)) ) {
	      if($file == '.svn') continue;
	      if(is_file($pathBase . $file)) {
	        $empty = false;
	        $tar->addModify(array($pathBase . $file), '', $pathHome);
	      }
	      if( is_dir($pathBase . $file) && $file != '..' && $file != '.' ) {
	        //print "dir $pathBase$file \n";
	        self::_tarFolder($tar, $pathBase . $file . PATH_SEP, $pathHome);
	        $empty = false;
	      }
	    }
	    closedir($handle);
	  }
	  if( $empty /*&& $pathBase . $file != $pathHome */) {
	    @$tar->addModify(array($pathBase . $file), '', $pathHome);
	  }
	}



}