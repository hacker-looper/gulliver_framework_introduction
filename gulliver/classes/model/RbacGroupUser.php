<?php

require_once 'classes/model/om/BaseRbacGroupUser.php';
require_once 'classes/model/RbacUser.php';


/**
 * Skeleton subclass for representing a row from the 'RBAC_GROUP_USER' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    classes.model
 */
class RbacGroupUser extends BaseRbacGroupUser {
	public static function add($aData){
		try {

			$GRP_UID = isset($aData['GRP_UID'])?$aData['GRP_UID']:'';
			$USR_UID = isset($aData['USR_UID'])?$aData['USR_UID']:'';
			$per = new RbacGroupUser();
			$per->setCreateDate(date('Y-m-d H:i:s'));
			if($GRP_UID!='') $per->setGrpUid($GRP_UID);
			if($USR_UID!='') $per->setUsrUid($USR_UID);
			if($MODIFIED_BY!='') $per->setModifiedBy($MODIFIED_BY);
			$per->save();
			return array('success' => true, 'message' => "创建成功！");
		} catch (Exception $e) {
			return array('success' => false, 'message' => $e->getMessage());
		}
	}
	public static function update($aData){
		$sql="UPDATE RBAC_GROUP_USER SET ";
		if(isset($aData['USR_UID'])){
			$sql.="USR_UID='".$aData['USR_UID']."' ";
		}
		if(isset($aData['GRP_UID'])){
			if(isset($aData['USR_UID'])){
				$sql.=",";
			}
			$sql.="GRP_UID='".$aData['GRP_UID']."' ";
		}
		$sql.="WHERE GRP_UID='".$aData['OLD_GRP_UID']."' AND USR_UID='".$aData['OLD_USR_UID']."'";
		PropelUtil::excute($sql);
	}
	public static function get($GRP_UID,$USR_UID) {
		$oCriteria = new Criteria('app');
		$oCriteria->add( RbacGroupUserPeer::GRP_UID, $GRP_UID, Criteria::EQUAL );
		$oCriteria->add( RbacGroupUserPeer::USR_UID, $USR_UID, Criteria::EQUAL );
		$aData = RbacGroupUserPeer::doSelectRS($oCriteria);
		$aData->setFetchmode( ResultSet::FETCHMODE_ASSOC );
		$aData->next();
		$re=$aData->getRow();
		return $re;	
	}
	public static function getByUsrUid($USR_UID) {
		$oCriteria = new Criteria('app');
		$oCriteria->add( RbacGroupUserPeer::USR_UID, $USR_UID, Criteria::EQUAL );
		$aData = RbacGroupUserPeer::doSelectRS($oCriteria);
		$aData->setFetchmode( ResultSet::FETCHMODE_ASSOC );
		$aData->next();
		$re=$aData->getRow();
		return $re;	
	}
	public static function delByUsrUid($USR_UID){
		try {
			$oCriteria = new Criteria('app');
			$oCriteria->add( RbacGroupUserPeer::USR_UID, $USR_UID, Criteria::EQUAL);
			RbacGroupUserPeer::doDelete($oCriteria);

			return array('success' => true, 'message' => '删除成功');

		} catch (Exception $e) {
			return array('success' => false, 'message' => '删除失败');
		}
	}

	/**
	 * 获取对应组下的人员列表
	 * @author WangJia
	 * @since  2019-03-12T09:59:21+0800
	 * @param  [type]                   $GROUP_ID [description]
	 * @return [type]                             [description]
	 */
	public static function getListByGroup($GROUP_ID){
		$oCriteria = new Criteria('app');

		$oCriteria->addSelectColumn(RbacUserPeer::USR_UID);
		$oCriteria->addSelectColumn(RbacUserPeer::USR_FULLNAME);

		$oCriteria->add( RbacGroupUserPeer::GRP_UID, $GROUP_ID, Criteria::EQUAL );
		$oCriteria->addJoin(RbacGroupUserPeer::USR_UID, RbacUserPeer::USR_UID, Criteria::LEFT_JOIN);
		$aData = RbacGroupUserPeer::doSelectRS($oCriteria);
		$aData->setFetchmode( ResultSet::FETCHMODE_ASSOC );

		$aData->next();
        $list = array();
        while(is_array($row = $aData->getRow())){
            $list[] = $row;
            $aData->next();
        }

        $result['data'] = $list;
        return $result;
	}
} // RbacGroupUser
