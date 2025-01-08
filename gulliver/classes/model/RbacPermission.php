<?php

require_once 'classes/model/om/BaseRbacPermission.php';


/**
 * Skeleton subclass for representing a row from the 'RBAC_PERMISSION' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    classes.model
 */
class RbacPermission extends BaseRbacPermission {

	public static function getList($aData){
        $oCriteria = new Criteria('app');

        if($aData['PER_NAME']){
            $oCriteria->add(RbacPermissionPeer::PER_NAME,'%'.$aData['PER_NAME'].'%',Criteria::LIKE);
        }

        if($aData['PER_NAME_DISPLAY']){
            $oCriteria->add(RbacPermissionPeer::PER_NAME_DISPLAY,'%'.$aData['PER_NAME_DISPLAY'].'%',Criteria::LIKE);
        }

        if($aData['PER_STATUS']!==NULL){
            $oCriteria->add(RbacPermissionPeer::PER_STATUS, $aData['PER_STATUS']);
        }
        
        $total = RbacPermissionPeer::doCount($oCriteria);
        
        if($aData['OFFSET'])           $oCriteria->setOffset($aData['OFFSET']);
        if($aData['PAGESIZE'])         $oCriteria->setLimit($aData['PAGESIZE']);

        $aData = RbacPermissionPeer::doSelectRS($oCriteria);
        $aData->setFetchmode( ResultSet::FETCHMODE_ASSOC );

        $aData->next();
        $list = array();
        while(is_array($row = $aData->getRow())){
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

		$sort_column = isset($aData['SORT_COLUMN:'])?$aData['SORT_COLUMN:']:'PER_NAME';
		$sort_type = isset($aData['SORT_TYPE'])?$aData['SORT_TYPE']:'ASC';

		$con = Propel::getConnection('system');
		$stmt = $con->createStatement();

		$sql = 'SELECT * FROM RBAC_PERMISSION WHERE 1=1 ';
		$sqlTotal = 'SELECT COUNT(*) AS  TOTAL FROM RBAC_PERMISSION WHERE 1=1 ';
		
		// 查询相关
		if($search){
			$sql .= "AND (PER_NAME LIKE '%$search%' OR PER_NAME_DISPLAY LIKE '%$search%') ";
			$sqlTotal .= "AND (PER_NAME LIKE '%$search%' OR PER_NAME_DISPLAY LIKE '%$search%') ";
		}

		$sql .= "ORDER BY CREATE_DATE DESC LIMIT $start,$end";
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

	public static function addedit($aData) {

		try {

			$uid = isset($aData['PER_UID'])?$aData['PER_UID']:'';
			$name = isset($aData['PER_NAME'])?$aData['PER_NAME']:'';
			$namedisplay = isset($aData['PER_NAME_DISPLAY'])?$aData['PER_NAME_DISPLAY']:'';
			$desc = isset($aData['PER_DESC'])?$aData['PER_DESC']:'';
			$status = isset($aData['PER_STATUS'])?$aData['PER_STATUS']:'1';

			if(! $uid){
				$aPer = self::_getPermissionByName($name);
				if($aPer){
					return array('success' => false, 'message' => $aPer['PER_NAME'] . ' 已经存在，请检查！');
				}

				$per = new RbacPermission();
				$per->setPerUid(gulliver::generateUniqueID());
			}else{
				$per = RbacPermissionPeer::retrieveByPK($uid);
			}

			$per->setPerName($name);
			$per->setPerNameDisplay($namedisplay);
			$per->setPerDesc($desc);
			$per->setPerStatus($status);
			$per->setCreateDate(date('Y-m-d H:i:s'));
			$per->save();

			return array('success' => true, 'message' => '创建权限成功!');
		} catch (Exception $e) {
			return array('success' => false, 'message' => $e->getMessage());
		}
	}

	public static function get($PER_UID) {
		$oPermission = RbacPermissionPeer::retrieveByPK($PER_UID);

		$aData = array();
		if($oPermission){
			$aData['PER_UID'] = $oPermission->getPerUid();
			$aData['PER_NAME'] = $oPermission->getPerName();
			$aData['PER_NAME_DISPLAY'] = $oPermission->getPerNameDisplay();
			$aData['PER_DESC'] = $oPermission->getPerDesc();
			$aData['CREATE_DATE'] = $oPermission->getCreateDate();
			$aData['MODIFIED_AT'] = $oPermission->getModifiedAt();
			$aData['MODIFIED_BY'] = $oPermission->getModifiedBy();
		}
		
		return $aData;
	}

	public static function del($aData){
		try {

			$a = array('success'=>false, 'message'=>'');
			$PER_UID = $aData['PER_UID'];

			$o = RbacPermissionPeer::retrieveByPK($PER_UID);

			if($o){
				$o->delete();
				$a['success'] = true;
				$a['message'] = '删除成功！';
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

		$sql = 'SELECT * FROM RBAC_PERMISSION WHERE 1=1 ';
		$rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

		$res = array();
		while ($rs->next()) {
			$res[] = $rs->getRow();
		}

		return $res;
	}

	private static function _getPermissionByName($rCode){
		$oCriteria = new Criteria('app');
		$oCriteria->add( RbacPermissionPeer::PER_NAME, $rCode, Criteria::EQUAL );
		$oCriteria->addAscendingOrderByColumn(RbacPermissionPeer::PER_NAME);
			
		$aData = RbacPermissionPeer::doSelectRS($oCriteria);
		$aData->setFetchmode( ResultSet::FETCHMODE_ASSOC );
		$aData->next();
			
		return $aData->getRow();	
	}

} // RbacPermission
