<?php 
class  executeCronClass{
	/**
     * check sftp file list with log
     * @author Jason Hu
     * @since 2013-10-12
     */
    public static function executeSchedulerJob($type) {
    	CLog::singleton()->info('begin execute cron');
        //eprint('* Executing '.$type.' timing job....'.date('Y-m-d H:i:s'), 'white');
        //eprintln("[BEGIN]", "green");
        try{
	        require_once PATH_APP . 'classes' . PATH_SEP . 'model' . PATH_SEP . 'Configuration.php';
	        $aSetting = Configuration::getSynchronizeInfo();
        }catch (Exception $e){
        	CLog::singleton()->err( 'get ftp setting:'.$e->getMessage() );  
        }
        if ($type == 'clever'){
        	$tokens = Configuration::getToken();
        	require_once PATH_APP . 'classes' . PATH_SEP . 'roster' . PATH_SEP . "class.Clever.php";
            
            //取出多个token对应的数据
            if(strstr($tokens,',')){
                $tokens = explode(',', $tokens);
            	foreach ($tokens as $token) {
                    $obj = new Clever($token);
                    $obj->doSynchronous();
                }
            }else{
                $obj = new Clever($tokens);
                $obj->doSynchronous();
            }
            
        }else{
        	self::mainFtpFunction($aSetting,$type);
        }
        //eprint("* Executing $type timing job.......".date('Y-m-d H:i:s'), "white");
        //eprintln("[DONE]", "green");
    }
    
    
    public static function mainFtpFunction($aSetting,$type) {
    	
        if (!isset($aSetting) || !is_array($aSetting) || !$aSetting['Path']) {
        	eprintln ( 'No config SFTP info', 'red' );
            return;
        }
        $aPattern = $aSetting['Pattern'];
        $analyseType = $aPattern ? $aPattern['ANALYSE_TYPE'] : '';
        if (!$analyseType) {
        	eprintln( "[UNKNOW] No Data Provider configuration", 'red' );
            return;
        }
        $sConnType = 'SFTP';
        switch ($sConnType) {
            case "SFTP":
            	require_once PATH_APP . 'classes' . PATH_SEP . 'class.SFTPConnection.php';
				$analyseType = self::_getAnalyseType($analyseType);
            	if ($type == 'analyze'){
					$files = SFTPConnection::getFileListFromFtp ($aSetting,true);
					self::handlerToAnalyseFile($files, $analyseType);
            	}else if($type == 'publish'){
					$aFiles = SFTPConnection::getFileListFromFtp ( $aSetting,false );
					if (empty($aFiles['ROSTER'])||empty($aFiles['ABSENCE']))
						self::handlerToPublish($analyseType);
            	}
                break;
            default:
                eprintln("This version can not support connection without '$sConnType'.", "red");
        }
    }
    
    public static function _getAnalyseType($analyseType){
    	switch ($analyseType) {
            default:
            	$analyseType = 'CSVImporting';
            	break;
    	};
    	return $analyseType;
    }
    
    public static function handlerToAnalyseFile($files, $analyseType) {
    	if (!isset($files['ROSTER'])||!isset($files['ABSENCE'])||((!is_array($files['ROSTER'])||empty($files['ROSTER']))&&(!is_array($files['ABSENCE'])||empty($files['ABSENCE'])))) {
            eprintln('IGNORE with no Roster/Absence file from SFTP');
            return;
        }
    	$dataprovider = PATH_APP . 'classes' . PATH_SEP . 'roster' . PATH_SEP . "class." . $analyseType . ".php";
		if (file_exists ( $dataprovider )) {
			require_once $dataprovider;
			$obj = new $analyseType();
			$obj->doAnalyze ( $files );
            eprint('Import Roster/Absence ', 'white');
			eprintln( "[SUCCESSFUL]", 'green');
		} else {
			eprintln ( "Couldnt find data provider class: $dataprovider", 'red' );
		}
    }
    
    public static function handlerToPublish($analyseType){
    	global $GLOBAL_SETTING;
    	$dataprovider = PATH_APP . 'classes' . PATH_SEP . 'roster' . PATH_SEP . "class." . $analyseType . ".php";
		if (file_exists ( $dataprovider )) {
			require_once $dataprovider;
			$obj = new $analyseType();
			$obj->doPublish ( $GLOBAL_SETTING['URL_ROSTER_TYPE'],$GLOBAL_SETTING['URL_ROSTER_HOST'] );
			eprintln ( "Execute timing job to publish roster and absence successful!", 'blue' );
		} else {
			eprintln ( "Couldnt find data provider class: $dataprovider", 'red' );
		}
    }
}
?>