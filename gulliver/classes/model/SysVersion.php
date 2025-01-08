<?php

require_once 'classes/model/om/BaseSysVersion.php';


/**
 * Skeleton subclass for representing a row from the 'SYS_VERSION' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    classes.model
 */
class SysVersion extends BaseSysVersion {
	/**
	 * 发布版本编辑
	 *
	 * [返回字段说明]
	 * @Author   wangjia
	 * @DateTime 2019-10-28
	 * @param    [array]     $aData 版本信息
	 * @return   Object
	 */
	public static function editVersion($aData){
		if(isset($aData['VER_UID'])) {
			//编辑
			$oVender =  SysVersionPeer::retrieveByPK($aData['VER_UID']);
		}else{
			$oVender = new SysVersion();
            $aData['VER_UID'] = gulliver::generateUniqueID();
            $aData['CREATE_DATE'] = date("Y-m-d H:i:s");
		}
		$oVender->fromArray($aData, BasePeer::TYPE_FIELDNAME);
        $oVender->save();
        return array('success'=>true,'message'=>'','data'=>$aData['VER_UID']);
	}

	/**
	 * [列表]
	 *
	 * [返回字段说明]
	 * @Author   wangjia
	 * @DateTime 2019-10-28
	 * @return   [type]     [description]
	 */
	public static function getList($aData){
		$oVender = new Criteria(SysVersionPeer::DATABASE_NAME);

		$total = SysVersionPeer::doCount($oVender);
		if(isset($aData['OFFSET'])){
			$oVender->setOffset($aData['OFFSET']);
			$oVender->setLimit($aData['PAGESIZE']);
		}

		$oVender->addDescendingOrderByColumn(SysVersionPeer::CREATE_DATE);
		$aData = SysVersionPeer::doSelectRS($oVender);
		$aData -> setFetchmode(ResultSet::FETCHMODE_ASSOC);
		$aData -> next();

		$aResult =array();
		while (is_array($row = $aData->getRow())) {
		   $row['VER_URL'] = json_decode($row['VER_URL'],true);
		   $row['URL'] = $row['VER_URL']['url'];
		   $aResult [] = $row;
		   $aData -> next();
		}
		return array('success'=>true,'data'=>$aResult,'total'=>$total);
	}

	/**
	 * [删除版本]
	 *
	 * [返回字段说明]
	 * @Author   wangjia
	 * @DateTime 2019-10-28
	 * @param    [type]     $VER_UID [description]
	 * @return   [type]              [description]
	 */
	public static function deleteVersion($VER_UID){
		$oVender =  SysVersionPeer::retrieveByPK($VER_UID);
		if($oVender){
			$oVender->delete();
		}
	}
	/**
	 * 获取最新版本
	 * @Author   xue_long
	 * @DateTime 2018-11-27T14:06:36+0800
	 * @param    string 	$module 模块
	 * @return   object
	 */
	public static function getLastVersion($module='ANDROID'){
		$oCriteria = new Criteria('app');
		$oCriteria->add( SysVersionPeer::VER_MODULE, $module, Criteria::EQUAL );
		$oCriteria -> setLimit(1);  // 每页的行数
		$oCriteria -> addDescendingOrderByColumn(SysVersionPeer::VER_CODE);
		$aData = SysVersionPeer::doSelectRS($oCriteria);
		$aData->setFetchmode( ResultSet::FETCHMODE_ASSOC );
		$aData->next();
		$re=$aData->getRow();
		return $re;
	}
} // SysVersion
