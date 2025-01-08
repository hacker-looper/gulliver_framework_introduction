<?php

/**
 * 数据库操作工具类：Propel
 * 
 * @author Looper Lvy
 * @since  2016-06-09
 **/ 
class PropelUtil{

	/**
	 * Propel查询方法工具类，根据key-value查询一组记录
	 * 
	 * <code>
	 *	require_once "classes/model/ExamExamPeer.php";
	 *	$oCriteria = new Criteria('app');
	 *	$oCriteria->add(ExamExamPeer::EM_CODE, $EM_CODE, Criteria::EQUAL);
	 *	return PropelUtil::query(ExamExamPeer, $oCriteria);	
	 * </code>
	 * 
	 * 
	 * @param $PEER | string | 数据表操作对象, 比如：RBAC_USER则为RbacUserPeer
	 * @param $oCriteria | Criteria | 查询对象
	 * @return  array()
	 * @see  Criteria
	 */ 
	public static function query($PEER, $oCriteria){
		$aData = $PEER::doSelectRS($oCriteria);
		$aData->setFetchmode( ResultSet::FETCHMODE_ASSOC );
		$aData->next();
		
		$aRS = array();
		while(is_array($row = $aData->getRow())){
			$aRS[] = $row;
			$aData->next();
		}
			
		return $aRS;	
	}

	/**
	 * Propel查询方法工具类，执行sql语句，不返回数据
	 * 
	 * <code>
	 * 	PropelUtil::excute("UPDATE TABLE SET MDOFIED_BY='000001'");	
	 * </code>
	 * 
	 * 
	 * @param $sql | string | 数据库ddl语句
	 * @return  array()
	 * @see  Propel
	 */ 
	public static function excute($sql){
		$con = Propel::getConnection('app');
		$stmt = $con->createStatement();
		$stmt->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);
	}

	/**
	 * Propel查询方法工具类，执行sql语句，并返回一个对象
	 * 
	 * <code>
	 *	return PropelUtil::excuteRFS("SELECT * FROM TABLE SET WHERE XXX='000001'");	
	 * </code>
	 * 
	 * 
	 * @param $sql | string | 数据库ddl语句
	 * @param $conn | string | 数据库连接:app,system
	 * @return  OBJECT
	 * @see  Propel
	 */ 
	public static function excuteRFS($sql,$conn='app'){
        $con = Propel::getConnection($conn);
        $stmt = $con->createStatement();
		$aData = $stmt->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);
		
		$aData->next();
		return $aData->getRow();
	}

	/**
	 * Propel查询方法工具类，执行sql语句，并返回一个数组
	 * 
	 * <code>
	 *	return PropelUtil::excuteRS("SELECT * FROM TABLE SET XXX='000001'");	
	 * </code>
	 * 
	 * 
	 * @param $sql | string | 数据库ddl语句
	 * @return  array
	 * @see  Propel
	 */ 
	public static function excuteRS($sql){
		$con = Propel::getConnection('app');
		$stmt = $con->createStatement();
		$rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

		$aData = array();
		while ($rs->next()) {
			$aData[] = $rs->getRow();
		}

		return $aData;
	}
}

/**
 * 自动索引工具类
 * 
 * @author Looper Lvy
 * @since  2016-06-09
 **/ 
class IndexUtil {

	/**
	 * 自动索引工具类，根据不同的key自动累加分组索引
	 * GS:公司，YG:员工，KS:考试
	 * <code>
	 * echo IndexUtil::auto('GS',6);die;
	 * </code>
	 * 
	 * @param $key string 分组标志，比如：COM,COU,CS等
	 * @param $length int 长度，不足自动补0，比如6则为000001
	 * @return   description
	 */ 
	public static function auto($key, $length=6) {
		require_once "classes/model/SysConfigurationPeer.php";

		$sysConfig = SysConfigurationPeer::retrieveByPK('SYS_AUTOINDEX');
		if(! $sysConfig){
			$sysConfig = new SysConfiguration();
			$sysConfig->setConKey('SYS_AUTOINDEX');
		}

		if($sysConfig->getConValue()){
			$oSysConfig = json_decode($sysConfig->getConValue());
			@$oSysConfig->$key=$oSysConfig->$key+1;
		}else{
			$oSysConfig=new stdclass();
			$oSysConfig->$key = 1;
		}

		$sysConfig->setConValue(json_encode($oSysConfig,JSON_FORCE_OBJECT));
		$sysConfig->save();

		return "$key".str_pad($oSysConfig->$key,$length,0,STR_PAD_LEFT);
	} 
}

class LogUtil {

	/**
	 * Record action log
	 * <code>
	 *	LogUtil::Log('RBAC.USER','DEBUG','TEST MESSAGE ...');	
	 * </code>
	 * 
	 * @param  string $module | Module Type: CRISIS, ROLE, CONTACT, SPONSOR, ROSTER, PUBLISH, OTHER
	 * @param  string $message [description]
	 *
	 * @author Looper Lvy
	 * @since  2016-06-30
	 */
	public static function Log( $module, $level='DEBUG', $message=''){
		$con = Propel::getConnection('system');
		$stmt = $con->createStatement();

		$user_uid = isset($_SESSION['Login']['USR_UID']) ? $_SESSION['Login']['USR_UID'] : 'System';
		$uid = gulliver::generateUniqueID();
		$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';

		$sql = "INSERT INTO SYS_LOG (SL_UID, SL_MODULE, SL_LEVEL, SL_LOG, SL_ACCESS_IP, USR_UID, CREATE_DATE) VALUES ( '$uid', '$module', '$level', '".mysql_real_escape_string($message)."', '$ip', '$user_uid',NOW())";
		$stmt->executeQuery($sql);
	}

	/**
	 * get log records
	 * @param  datetime $dateStart | like 2014-01-01 12:05:02 if not set, then get publish log
	 * @param  datetime $dateEnd   | like 2014-01-01 12:05:02
	 * @return array
	 *
	 * @author Looper Lvy
	 * @since  2016-06-30
	 */
	public static function getLog( $dateStart = '', $dateEnd = '' ) {

		$con = Propel::getConnection('system');
		$stmt = $con->createStatement();

		if( $dateStart && $dateEnd ) {
			$sql = 'SELECT * FROM SYS_LOG WHERE `LAST_MODIFIED` >= \''.$dateStart.'\' 
			AND `LAST_MODIFIED` <= \''.$dateEnd.'\' AND `LOG_MODULE` != \'PUBLISH\' ORDER BY LAST_MODIFIED DESC ';
		}else{
			$sql = 'SELECT * FROM SYS_LOG WHERE 1=1 ORDER BY LAST_MODIFIED DESC ';
		}
		$rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

		$result = array();
		while ($rs->next()) {
			$row = $rs->getRow();
			$result[] = $row;
		}

		return $result;
	}

}

/**
 * 文件操作工具类
 * 
 * @author Looper Lvy
 * @since  2016-06-09
 **/ 
class IOUtil{
	public static function read_content($filename){
		$handle = fopen($filename,"r");
		$content = @fread($handle,filesize($filename));
		return $content;
	}

	public static function write_content($content, $filename){
		$handle = fopen($filename,"w");
		fseek($handle,0);
		fwrite($handle, $content);
		return $content;
	}
}

/**
 * Log Tool for Log4PHP Library
 * 后台详细日志工具类，用于记录到滚动日志文件;
 * 日志存放: /shared/logs/*.log
 * 
 * <code>
 * 	Log4PHP::getInstance()->debug("message here");
 * 	Log4PHP::getInstance()->info("message here");
 * 	Log4PHP::getInstance()->error("message here");
 * 	Log4PHP::getInstance()->warn("message here");
 * 	Log4PHP::getInstance()->trace("message here");
 * 	Log4PHP::getInstance()->fatal("message here");
 * </code>
 * 
 * @author Looper Lvy
 * @since  2016-10-08
 * @see    http://logging.apache.org/log4php/quickstart.html
 **/
class Log4PHP{
	private static $aInstance = array();
	private static $bInited   = false;

	public static function getInstance($module='CSDA_IOT'){
		if(! self::$bInited) {
			gulliver::verifyPath(PATH_HOME."shared/logs", true);
			Logger::configure(PATH_HOME.'config/log4php2.xml');
			self::$bInited = true;
		}

		if(! isset(self::$aInstance[$module])){
			self::$aInstance[$module] = Logger::getLogger($module);
		}
		return self::$aInstance[$module];
	}

	public function debug($message=""){
		self::$aInstance->debug($message);
	}

	public function info($message=""){
		self::$aInstance->info($message);
	}

	public function error($message=""){
		self::$aInstance->error($message);
	}

	public function warn($message=""){
		self::$aInstance->warn($message);	
	}

	public function trace($message=""){
		self::$aInstance->trace($message);
	}

	public function fatal($message=""){
		self::$aInstance->fatal($message);
	}
}