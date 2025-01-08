<?php

require_once 'classes/model/om/BaseSysLog.php';


/**
 * Skeleton subclass for representing a row from the 'SYS_LOG' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    classes.model
 */
class SysLog extends BaseSysLog {
	public static function datatable($aData){
		// jquery.datatable parameters
		$start = isset($aData['start'])?$aData['start']:0;
		$end = isset($aData['length'])?$aData['length']:20;
		$search = isset($aData['search']['value'])?$aData['search']['value']:'';
		// $regex = isset($aData['search[regex]'])?$aData['search[regex]']:'';

		$sort_column = isset($aData['SORT_COLUMN:'])?$aData['SORT_COLUMN:']:'CON_KEY';
		$sort_type = isset($aData['SORT_TYPE'])?$aData['SORT_TYPE']:'ASC';

		$con = Propel::getConnection('system');
		$stmt = $con->createStatement();

		$sql = "SELECT L.*, U.USR_FULLNAME FROM SYS_LOG L LEFT JOIN RBAC_USER U ON L.USR_UID=U.USR_UID WHERE 1=1 ORDER BY CREATE_DATE DESC ";
		$sqlTotal = 'SELECT COUNT(*) AS  TOTAL FROM SYS_LOG WHERE 1=1 ';

		$sql .= "LIMIT $start,$end";
		// var_dump($sql);

		$rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

		$res = array();
		$index = 1;

		while ($rs->next()) {
			$row = $rs->getRow();

			$res[] = $row;
			$index++;
		}

		//get Ttotal
		$rs = $stmt->executeQuery($sqlTotal, ResultSet::FETCHMODE_ASSOC);

		$total = 0;
		if($rs->next()) {
			$row = $rs->getRow();
			$total = intval($row['TOTAL']);
		}

		return array('iTotalRecords'=>intval($end), //本次加载记录数量  
					 'iTotalDisplayRecords'=>$total, //总记录数量  
					 'aaData'=> $res);
	}

	/**
	 * 统计当前年份用户总的登录次数
	 * @author WangJia
	 * @since  2019-06-21T14:11:35+0800
	 * @return [type]                   [description]
	 */
	public static function logCount($date){
        $oVender = new Criteria(SysLogPeer::DATABASE_NAME);

        $oVender->add(SysLogPeer::SL_MODULE, '用户管理');
        $oVender->add(SysLogPeer::CREATE_DATE, '%'. $date .'%' ,Criteria::LIKE);
        $total = SysLogPeer::doCount($oVender);
        return $total;
	}
} // SysLog
