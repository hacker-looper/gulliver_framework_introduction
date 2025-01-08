<?php

require_once 'classes/model/om/BaseRbacRole.php';
require_once 'classes/model/RbacRolePermissionPeer.php';


/**
 * Skeleton subclass for representing a row from the 'RBAC_ROLE' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    classes.model
 */
class RbacRole extends BaseRbacRole {

	// 获取角色详情(包含权限)
	public static function getDetail($ROLE_UID){
		require_once 'classes/model/RbacRolePeer.php';
        $obj = RbacRolePeer::retrieveByPK($ROLE_UID);
        $aData = $obj ? $obj->toArray(BasePeer::TYPE_FIELDNAME) : array();
        if($obj) $aData['ROLE_PERMISSIONS'] = self::getRolePermissions($ROLE_UID);
        return $aData;
    }

	public static function getList($aData){
        $oCriteria = new Criteria('app');

        if($aData['ROLE_NAME']){
            $oCriteria->add(RbacRolePeer::ROLE_NAME,'%'.$aData['ROLE_NAME'].'%',Criteria::LIKE);
        }

        if($aData['ROLE_NAME_DISPLAY']){
            $oCriteria->add(RbacRolePeer::ROLE_NAME_DISPLAY,'%'.$aData['ROLE_NAME_DISPLAY'].'%',Criteria::LIKE);
        }

        if($aData['ROLE_STATUS']!==NULL){
            $oCriteria->add(RbacRolePeer::ROLE_STATUS, $aData['ROLE_STATUS']);
        }
        if($aData['ROLE_UID']){
            $oCriteria->add(RbacRolePeer::ROLE_UID, $aData['ROLE_UID']);
        }
        
        $total = RbacRolePeer::doCount($oCriteria);
        $oCriteria->addDescendingOrderByColumn(RbacRolePeer::CREATE_DATE);

        if($aData['OFFSET'])           $oCriteria->setOffset($aData['OFFSET']);
        if($aData['PAGESIZE'])         $oCriteria->setLimit($aData['PAGESIZE']);

        $aData = RbacRolePeer::doSelectRS($oCriteria);
        $aData->setFetchmode( ResultSet::FETCHMODE_ASSOC );

        $aData->next();
        $list = array();
        while(is_array($row = $aData->getRow())){
        	$row['ROLE_PERMISSIONS'] = self::getRolePermissions($row['ROLE_UID']);
            $list[] = $row;
            $aData->next();
        }
        return array('data'=>$list, 'total'=>$total);
    }

	// @deprecated
	public static function datatable($aData){
		// jquery.datatable parameters
		$start = isset($aData['start'])?$aData['start']:0;
		$end = isset($aData['length'])?$aData['length']:10;
		$search = isset($aData['search']['value'])?$aData['search']['value']:'';
		// $regex = isset($aData['search[regex]'])?$aData['search[regex]']:'';

		$sort_column = isset($aData['SORT_COLUMN:'])?$aData['SORT_COLUMN:']:'ROLE_NAME';
		$sort_type = isset($aData['SORT_TYPE'])?$aData['SORT_TYPE']:'ASC';

		$con = Propel::getConnection('system');
		$stmt = $con->createStatement();

		$sql = 'SELECT * FROM RBAC_ROLE WHERE 1=1 ';
		$sqlTotal = 'SELECT COUNT(*) AS  TOTAL FROM RBAC_ROLE WHERE 1=1 ';
		
		// 查询相关
		if($search){
			$sql .= "AND (ROLE_NAME LIKE '%$search%' OR ROLE_NAME_DISPLAY LIKE '%$search%') ";
			$sqlTotal .= "AND (ROLE_NAME LIKE '%$search%' OR ROLE_NAME_DISPLAY LIKE '%$search%') ";
		}



		$sql .= "ORDER BY CREATE_DATE DESC LIMIT $start,$end";
		$rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

		$res = array();
		$index = 1;

		while ($rs->next()) {
			$row = $rs->getRow();

			if($row['ROLE_STATUS'] == 1) {
				$row['STATUS'] = '激活';
				$row['CSS_STATUS'] = 'success';
			}else if ($row['ROLE_STATUS'] == 0) {
				$row['STATUS'] = '非激活';
				$row['CSS_STATUS'] = 'important';
			}else{
				$row['STATUS'] = '未验证';
				$row['CSS_STATUS'] = 'warning';
			}
			$row['INDEX'] = $index;

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

	public static function get($ROLE_UID) {
		$oRole = RbacRolePeer::retrieveByPK($ROLE_UID);

		$aData = array();
		if($oRole){
			$aData['ROLE_UID'] = $oRole->getRoleUid();
			$aData['ROLE_NAME'] = $oRole->getRoleName();
			$aData['ROLE_NAME_DISPLAY'] = $oRole->getRoleNameDisplay();
			$aData['ROLE_DESC'] = $oRole->getRoleDesc();
			$aData['CREATE_DATE'] = $oRole->getCreateDate();
			$aData['MODIFIED_AT'] = $oRole->getModifiedAt();
			$aData['MODIFIED_BY'] = $oRole->getModifiedBy();
		}
		
		return $aData;
	}

 	/**
 	 * 获得当前角色下的所有权限列表
 	 * @param $ROLE_UID string 角色id
 	 * @return array() 权限列表
 	 **/
	public static function getRolePermissions($ROLE_UID){
		$con = Propel::getConnection('system');
		$stmt = $con->createStatement();

		$sql = "SELECT * FROM RBAC_ROLE_PERMISSION RP LEFT JOIN RBAC_PERMISSION P ON RP.PER_UID=P.PER_UID WHERE RP.ROLE_UID='$ROLE_UID';";

		$rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

		$res = array();
		while ($rs->next()) {
			$res[] = $rs->getRow();
		}

		return $res;
	}

	public static function addedit($aData) {

		try {

			$uid = isset($aData['ROLE_UID'])?$aData['ROLE_UID']:'';
			$name = isset($aData['ROLE_NAME'])?$aData['ROLE_NAME']:'';
			$namedisplay = isset($aData['ROLE_NAME_DISPLAY'])?$aData['ROLE_NAME_DISPLAY']:'';
			$desc = isset($aData['ROLE_DESC'])?$aData['ROLE_DESC']:'';
			$status = isset($aData['ROLE_STATUS'])?$aData['ROLE_STATUS']:'1';
			$permissions = isset($aData['ROLE_PERMISSIONS'])?$aData['ROLE_PERMISSIONS']:'';
			$system = isset($aData['ROLE_SYSTEM'])?$aData['ROLE_SYSTEM']:'';
			$permissions = isset($aData['ROLE_PERMISSIONS'])?$aData['ROLE_PERMISSIONS'] : '';
			

			if(! $uid){
				$uid = gulliver::generateUniqueID();
				$aPer = self::_getRoleByName($name);
				if($aPer){
					return array('success' => false, 'message' => $aPer['ROLE_NAME'] . ' 已经存在，请检查！');
				}

				$per = new RbacRole();
				$per->setRoleUid($uid);
				$per->setCreateDate(date('Y-m-d H:i:s'));
			}else{
				$per = RbacRolePeer::retrieveByPK($uid);
			}

			$per->setRoleName($name);
			$per->setRoleNameDisplay($namedisplay);
			$per->setRoleDesc($desc);
			$per->setRoleStatus($status);
			$per->setRoleSystem($system);
			$per->save();

			// 创建permission
			RbacRolePermission::delByRole($uid);
			if($permissions){
				$_a = explode(',', $permissions);
				foreach ($_a as $k=>$v) {
					$_o = RbacRolePermissionPeer::retrieveByPK($uid, $v);
					if(! $_o) {
						$_o = new RbacRolePermission();
						$_o->setRoleUid($uid);
						$_o->setPerUid($v);
						$_o->setCreateDate(date('Y-m-d H:i:s'));
						$_o->save();
					}
				}
			}

			return array('success' => true, 'message' => '创建角色成功!');
		} catch (Exception $e) {
			return array('success' => false, 'message' => $e->getMessage());
		}
	}

	public static function del($aData){
		try {

			$a = array('success'=>false, 'message'=>'');
			$ROLE_UID = $aData['ROLE_UID'];

			$o = RbacRolePeer::retrieveByPK($ROLE_UID);

			if($o){
				$o->delete();

				$sql = "DELETE FROM RBAC_ROLE_PERMISSION WHERE ROLE_UID='$ROLE_UID' ";
				PropelUtil::excute($sql);

				$a['success'] = true;
				$a['message'] = '删除成功!';
			}
		} catch (Exception $e) {
			$a['success'] = false;
			$a['message'] = '删除失败：'+$e->getMessage();
		}

		return $a;
	}

	public static function all() {
		$con = Propel::getConnection('system');
		$stmt = $con->createStatement();

		$sql = 'SELECT * FROM RBAC_ROLE WHERE 1=1 ';
		$rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

		$res = array();
		while ($rs->next()) {
			$_a = $rs->getRow();
			$res[$_a['ROLE_UID']] = $_a; 
		}

		return $res;
	}

	public static function allIndexByID() {
		$con = Propel::getConnection('system');
		$stmt = $con->createStatement();

		$sql = 'SELECT * FROM RBAC_ROLE WHERE 1=1 ';
		$rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

		$res = array();
		while ($rs->next()) {
			$row = $rs->getRow();
			$res[$row['ROLE_UID']] = $row;
		}

		return $res;
	}

	private static function _getRoleByName($name){
		$oCriteria = new Criteria('app');
		$oCriteria->add( RbacRolePeer::ROLE_NAME, $name, Criteria::EQUAL );
		$oCriteria->addAscendingOrderByColumn(RbacRolePeer::ROLE_NAME);
			
		$aData = RbacRolePeer::doSelectRS($oCriteria);
		$aData->setFetchmode( ResultSet::FETCHMODE_ASSOC );
		$aData->next();
			
		return $aData->getRow();	
	}

} // RbacRole
