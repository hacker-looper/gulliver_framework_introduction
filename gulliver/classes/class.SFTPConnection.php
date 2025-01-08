<?php
/** 
* @class SFTPConnection : sftp connection
*
* @author jason
* @since 2013-10-12
*  
*/
class SFTPConnection {
    /**
     * get file list from ftp
     * @param $sett
     * @param $conn
     * @return array|null
     */
    public static function getFileListFromFtp($sett,$fCheck) {
        if (!(isset($sett) && is_array($sett)))
            return null;
        $ftp_path = isset($sett['Path']) ? $sett['Path'] . '/' : '/';
        $pattern = isset($sett['Pattern']) ? $sett['Pattern'] : '';
        $roster_Pattern = isset($pattern['ROSTER']) ? $pattern['ROSTER'] : '';
        $absence_pattern = isset($pattern['ABSENCE']) ? $pattern['ABSENCE'] : '';
        $aPath['ROSTER'] = $ftp_path.$roster_Pattern;
        $aPath['ABSENCE'] = $ftp_path.$absence_pattern;
        return self::getFileListRecursiveFromFtp($aPath,$fCheck);
    }
	
	/**
	 * get file list from ftp
	 * @param $sett
	 * @param $conn
	 * @return array|null
	 */
	public static function getFileListRecursiveFromFtp($aPath,$fCheck) {
		$fls = array ();
		$aFileRoster = array();
		$flagFile = true;
		$roster_path = $aPath['ROSTER'];
		$absence_path = $aPath['ABSENCE'];
		if ($roster_path!='/') $rosterFiles = glob($roster_path);
		if($fCheck){
			foreach ($rosterFiles as $rosterfile){
				$datePattern = substr($rosterfile,strpos($rosterfile,'.')-8,8);
				if(self::_checkFileName($datePattern))
					$aFileRoster[$datePattern] = $rosterfile;
				else{
					CLog::singleton()->warning('file:'.$rosterfile.' name not match'); 
					$flagFile = false;
				}
			}
		}else{
			$aFileRoster = $rosterFiles;
		}
		if ($flagFile){
			if ($absence_path!='/') $absenceFiles = glob($absence_path);
			if(!empty($aFileRoster)) ksort($aFileRoster);
			$fls['ROSTER'] = $aFileRoster;
			$fls['ABSENCE'] = $absenceFiles;
		}
		return $fls;
	}
	
	/**
	 * check the file name
	 * @param $datePattern
	 * @return true/false
	 */
	private static function _checkFileName($datePattern){
		return preg_match('/^\d{4}(0*[1-9]|1[0-2])(0*[1-9]|[1-2]\d|3[0-1])$/', $datePattern);//like '20140414'
	}
}