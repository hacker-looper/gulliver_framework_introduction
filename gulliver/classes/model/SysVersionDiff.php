<?php

require_once 'classes/model/om/BaseSysVersionDiff.php';


/**
 * Skeleton subclass for representing a row from the 'SYS_VERSION_DIFF' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    classes.model
 */
class SysVersionDiff extends BaseSysVersionDiff {
	/**
	 * 差异包编辑
	 *
	 * [返回字段说明]
	 * @Author   wangjia
	 * @DateTime 2019-10-28
	 * @param    [array]     $aData 版本信息
	 * @return   Object
	 */
	public static function editPackage($aData){
		if(isset($aData['DVER_UID'])) {
			//编辑
			$oVender =  SysVersionDiffPeer::retrieveByPK($aData['DVER_UID']);
		}else{
			$oVender = new SysVersionDiff();
            $aData['DVER_UID'] = gulliver::generateUniqueID();
            $aData['CREATE_DATE'] = date("Y-m-d H:i:s");
		}
		$oVender->fromArray($aData, BasePeer::TYPE_FIELDNAME);
        $oVender->save();
        return array('success'=>true,'message'=>'','data'=>$aData['DVER_UID']);
	}

	/**
	 * [差异包列表]
	 *
	 * [返回字段说明]
	 * @Author   wangjia
	 * @DateTime 2019-10-28
	 * @param    string     $VER_UID [description]
	 * @return   [type]              [description]
	 */
	public static function getPackList($VER_UID=''){
		$oVender = new Criteria(SysVersionDiffPeer::DATABASE_NAME);

		if($VER_UID) $oVender->add(SysVersionDiffPeer::VER_UID, $VER_UID);
		$oVender->addDescendingOrderByColumn(SysVersionDiffPeer::CREATE_DATE);
		$aData = SysVersionDiffPeer::doSelectRS($oVender);
		$aData -> setFetchmode(ResultSet::FETCHMODE_ASSOC);
		$aData -> next();

		$aResult =array();
		while (is_array($row = $aData->getRow())) {
		   $row['DVER_URL'] = json_decode($row['DVER_URL'],true);
		   $row['URL'] = $row['DVER_URL']['url'];
		   $aResult [] = $row;
		   $aData -> next();
		}
		return $aResult;
	}

	/**
	 * [删除差异包]
	 *
	 * [返回字段说明]
	 * @Author   wangjia
	 * @DateTime 2019-10-28
	 * @param    [type]     $DVER_UID [description]
	 * @return   [type]               [description]
	 */
	public static function deletePackage($DVER_UID){
		$oVender = SysVersionDiffPeer::retrieveByPK($DVER_UID);
		if($oVender){
			$oVender->delete();
			return true;
		}
		return false;
	}
	public static function get($verUid,$from,$to) {
		$oCriteria = new Criteria('app');
		$oCriteria->add( SysVersionDiffPeer::VER_UID, $verUid, Criteria::EQUAL );
		$oCriteria->add( SysVersionDiffPeer::DVER_UPGRADE_FROM, $from, Criteria::EQUAL );
		$oCriteria->add( SysVersionDiffPeer::DEVR_UPGRADE_TO, $to, Criteria::EQUAL );
		$aData = SysVersionDiffPeer::doSelectRS($oCriteria);
		$aData->setFetchmode( ResultSet::FETCHMODE_ASSOC );
		$aData->next();
		$re=$aData->getRow();
		return $re;	
	}
} // SysVersionDiff
