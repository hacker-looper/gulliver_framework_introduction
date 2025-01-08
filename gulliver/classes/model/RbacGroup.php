<?php

require_once 'classes/model/om/BaseRbacGroup.php';
require_once 'classes/model/RbacGroupPeer.php';

/**
 * Skeleton subclass for representing a row from the 'RBAC_GROUP' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    classes.model
 */
class RbacGroup extends BaseRbacGroup {
	// 根据组名查找group
	public static function getGroupByName($GRP_NAME){
		$GRP_NAME = mysql_escape_string($GRP_NAME);
		$sql = "SELECT * FROM RBAC_GROUP WHERE GRP_NAME = '$GRP_NAME'";
		return PropelUtil::excuteRS($sql);
	}

    /**
     * 子集GROUP列表
     * @author WangJia
     * @since  2018-12-12T19:49:11+0800
     * @return [type]                   [description]
     */
    public static function getOrganizationList($GRP_PARENT,$GRP_UID,$GRP_NAME,$OFFSET,$PAGESIZE){
        $criteria = new Criteria(RbacGroupPeer::DATABASE_NAME);
        $group_parent_name = '';

        if($GRP_PARENT){
            $criteria->add(RbacGroupPeer::GRP_PARENT,$GRP_PARENT);
            $RbacGroupPeer = RbacGroupPeer::retrieveByPK($GRP_PARENT);
            if($RbacGroupPeer){
                $data = $RbacGroupPeer->toArray();
                $group_parent_name = "[" . $data['GrpUid'] . "]" . $data['GrpName'];
            }
        } 
        if($GRP_UID) $criteria->add(RbacGroupPeer::GRP_UID,$GRP_UID);
        if($GRP_NAME) $criteria->add(RbacGroupPeer::GRP_NAME,'%' . $GRP_NAME . '%',Criteria::LIKE);
        
        $total = RbacGroupPeer::doCount ($criteria);

        if($aData['OFFSET'])           $criteria->setOffset($aData['OFFSET']);
        if($aData['PAGESIZE'])         $criteria->setLimit($aData['PAGESIZE']);

        $aData = RbacGroupPeer::doSelectRS($criteria);
        $aData->setFetchmode( ResultSet::FETCHMODE_ASSOC );

        $aData->next();
        $list = array();
        while(is_array($row = $aData->getRow())){
            if($group_parent_name){
                $row['GROUP_PARENT_NAME'] = $group_parent_name;
            }
            $list[] = $row;
            $aData->next();
        }

        $result['data'] = $list;
        $result['total'] = $total;
        return $result;
    }

    /**
     * 新增 / 编辑 组
     * @author WangJia
     * @since  2018-12-12T20:11:57+0800
     * @return [type]                   [description]
     */
    public static function editOrganization($aData){
        $is_edit = isset($aData['IS_EDIT']) ? true : false;
        $result = array("success"=>false);

        $RbacGroupPeer = RbacGroupPeer::retrieveByPK($aData['GrpUid']);
        if($RbacGroupPeer && !$is_edit){
            $result['message'] = "组织编号已存在！";
        }else{
            if(!$RbacGroupPeer){
                $RbacGroupPeer = new RbacGroup();
                $aData['CreateDate'] = date("Y-m-d H:i:s",time());
            }
            $RbacGroupPeer->fromArray($aData);
            if($RbacGroupPeer->save()){
                $result['success'] = true;
                $result['message'] = "保存成功！";
            }else{
                $result['message'] = "保存失败！";
            }
        }
        return $result; 
    }

    /**
     * 删除组 
     * @author WangJia
     * @since  2018-12-12T20:28:16+0800
     * @return [type]                   [description]
     */
    public static function delOrganization($GRP_UID){
        $rs = false;
        $rbacGroupPeer = RbacGroupPeer::retrieveByPK($GRP_UID);
        if($rbacGroupPeer){
            $rbacGroupPeer->delete();
            $rs = true;
        }
        return $rs;
    }   

	public static function getAll(){
		$sql = "SELECT * FROM RBAC_GROUP ";
		$aData = PropelUtil::excuteRS($sql);

		$_cache = array();
		foreach ($aData as $v) {
			$_cache[$v['GRP_UID']] = $v;
		}

		foreach ($_cache as $k=>$v) {
			if($v['GRP_PARENT']){
				$_cache[$k]['GRP_TITLE']  = '/'."[".$v['GRP_PARENT']."]".$_cache[$v['GRP_PARENT']]['GRP_NAME']."/"."[".$v['GRP_UID']."]".$v['GRP_NAME'];
				$_cache[$k]['GRP_TITLE2'] = '/'.$_cache[$v['GRP_PARENT']]['GRP_NAME']."/".$v['GRP_NAME'];
				$_cache[$k]['GRP_TITLE2'] = str_replace("//", "/", $_cache[$k]['GRP_TITLE2']);
			}else{
				$_cache[$k]['GRP_TITLE']  = '/'."[".$v['GRP_UID']."]".$v['GRP_NAME'];
				$_cache[$k]['GRP_TITLE2'] = '/'.$v['GRP_NAME'];
				$_cache[$k]['GRP_TITLE2'] = str_replace("//", "/", $_cache[$k]['GRP_TITLE2']);
			}

			if($v['GRP_PARENT']){
				if($v['GRP_PARENT']=='/'){
					$_cache[$k]['GRP_PATH'] = $v['GRP_PARENT'].','.$v['GRP_UID'];
				}else{
					$_cache[$k]['GRP_PATH'] = '/,'.$v['GRP_PARENT'].','.$v['GRP_UID'];
				}
				
			}else{
				$_cache[$k]['GRP_PATH'] = $v['GRP_UID'];
			}
			
		}

		return $_cache;
	}

	/**
	 * vuejs+antd
	 **/ 
	public static function getGroup4Tree($haveStaff=false){
		$sql = "SELECT * FROM RBAC_GROUP ";
		$aData = PropelUtil::excuteRS($sql);
		$aTree = self::_tree($aData, '', $haveStaff);

		return $aTree;
	}

	/**
	 * vuejs+antd
	 **/ 
	public static function getGroup4Select(){
		$sql = "SELECT * FROM RBAC_GROUP ";
		$aData = PropelUtil::excuteRS($sql);
		$aTree = self::_tree4select($aData, '');

		return $aTree;
	}

    /**
     * 递归生成树形结构, 查找子节点， CAT_PARENT=父节点CAT_UID
     */
    private static function _tree($arr, $p_id='/', $staff=false){
        $tree = array();
        foreach ($arr as $row) {
            if($row['GRP_PARENT']==$p_id){
                $tmp = self::_tree($arr, $row['GRP_UID'], $staff);

                $tree_row = array();
                $tree_row['key']     = $row['GRP_UID'];
                $tree_row['value']   = $row['GRP_UID'];
                $tree_row['type']    = 'GRP_UID';
                $tree_row['title']   = "[".$row['GRP_UID']."]".$row['GRP_NAME'];
                $tree_row['parent']  = $row['GRP_PARENT'];

                if($tmp){
                    $tree_row['children']= $tmp;
                }

                if($staff){
                	$_x = self::getGroupUsers($row['GRP_UID']);
                	foreach ($_x as $_xx) {
                		$tree_row['children'][] = $_xx;
                	}
                }

                $tree[] = $tree_row;
            }
            
        }
        return $tree;
    }

    public static function getGroupUsers($GRP_UID){
    	$sql = "SELECT * FROM RBAC_STAFF a, RBAC_USER b WHERE a.USR_UID=b.USR_UID AND a.GRP_UID='$GRP_UID' ORDER BY a.STF_CODE ASC ";
    	$aUsers = PropelUtil::excuteRS($sql);
    	$aData = array();
    	foreach ($aUsers as $v) {
    		$_a['key']   = $v['USR_UID'];
    		$_a['value'] = $v['USR_UID'];
    		$_a['type']  = 'USR_UID';
    		$_a['title'] = "[".$v['STF_CODE']."]".$v['USR_FULLNAME'];
    		$aData[] = $_a;
    	}

    	return $aData;
    }

    /**
     * 递归生成树形结构, 查找子节点， CAT_PARENT=父节点CAT_UID
     */
    private static function _tree4select($arr, $p_id='/'){
        $tree = array();
        foreach ($arr as $row) {
            if($row['GRP_PARENT']==$p_id){
                $tmp = self::_tree4select($arr, $row['GRP_UID']);

                $tree_row = array();
                $tree_row['value']   = $row['GRP_UID'];
                $tree_row['label']   = "[".$row['GRP_UID']."]".$row['GRP_NAME'];
                $tree_row['parent']  = $row['GRP_PARENT'];
                if($tmp){
                    $tree_row['children']= $tmp;
                }                

                $tree[] = $tree_row;
            }
            
        }

        return $tree;
    }

	/**
	 * 获得父组，包含根目录:/
	 * jquery
	 **/ 	
	public static function getGroupTreeByParent($GRP_PARENT='/'){
		$con = Propel::getConnection('system');
		$stmt = $con->createStatement();

		$sql = "SELECT G.* FROM RBAC_GROUP G WHERE G.GRP_PARENT='$GRP_PARENT' ";
		$rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

		$res = array();
		while ($rs->next()) {
			$r = $rs->getRow();
			$bFolder = true;
			$a=array(
				'id'=>$r['GRP_UID'],
				'text'=>$r['GRP_NAME'],
				"icon" => $bFolder?"fa fa-folder icon-lg icon-state-file":"fa fa-file fa-large icon-state-default",
				'children'=>$bFolder,
				'data'=>$r
			);
			$res[] = $a;
		}
		
		return $res;
	}

	public static function addEdit($aData){
		try {
			$GRP_UID = isset($aData['GRP_UID'])?$aData['GRP_UID']:'';//pk,32uuid
			$GRP_NAME = isset($aData['GRP_NAME'])?$aData['GRP_NAME']:'';//公司编号
			$GRP_DESC = isset($aData['GRP_DESC'])?$aData['GRP_DESC']:'';//组描述
			$GRP_TYPE = isset($aData['GRP_TYPE'])?$aData['GRP_TYPE']:'';//组类型，‘0’:集团公司，‘1’：子公司，‘2’：部门
			$GRP_PARENT = isset($aData['GRP_PARENT'])?$aData['GRP_PARENT']:'';//组描述
			$MODIFIED_BY = isset($aData['MODIFIED_BY'])?$aData['MODIFIED_BY']:'';//最后修改人, USR_UID
			$TYPE = isset($aData['TYPE'])?$aData['TYPE']:'0';//‘0’为新增，‘1’为修改
			if($TYPE=='0'){
				$per = new RbacGroup();
				if($GRP_UID=='') $GRP_UID=gulliver::generateUniqueID();
				$per->setGrpUid($GRP_UID);
				$per->setCreateDate(date('Y-m-d H:i:s'));
				$mes="创建组成功！";
			}else{
				$per = RbacGroupPeer::retrieveByPK($GRP_UID);
				$mes="修改组成功！";
			}
			if($GRP_NAME!='') $per->setGrpName($GRP_NAME);
			if($GRP_DESC!='') $per->setGrpDesc($GRP_DESC);
			if($GRP_TYPE!='') $per->setGrpType($GRP_TYPE);
			if($GRP_PARENT!='') $per->setGrpParent($GRP_PARENT);
			if($MODIFIED_BY!='') $per->setModifiedBy($MODIFIED_BY);
			$per->save();
			return array('success' => true, 'message' => $mes, 'data'=>$GRP_UID);
		} catch (Exception $e) {
			return array('success' => false, 'message' => $e->getMessage());
		}
	}

	public static function get($GRP_UID) {
		$oCriteria = new Criteria('app');
		$oCriteria->add( RbacGroupPeer::GRP_UID, $GRP_UID, Criteria::EQUAL );
		$aData = RbacGroupPeer::doSelectRS($oCriteria);
		$aData->setFetchmode( ResultSet::FETCHMODE_ASSOC );
		$aData->next();
		$re=$aData->getRow();
		return $re;	
	}

	public static function getParentUids($uid){
		$group=self::get($uid);
		$parent_id=$group['GRP_PARENT'];
		$pids = '';
		if($parent_id!='/'){
			$pids .= $parent_id;
			$npids=self::getParentUids($group['GRP_PARENT']);
	        if(isset($npids) && $npids!=''){
	        	$pids .= ','.$npids;
	        }
		}
		return $pids;
	}

	public static function del($GRP_UID){
		try {
			$oCriteria = new Criteria('app');
			$oCriteria->add( RbacGroupPeer::GRP_UID, $GRP_UID, Criteria::EQUAL);
			RbacGroupPeer::doDelete($oCriteria);
			return array('success' => true, 'message' => '删除成功');
		} catch (Exception $e) {
			return array('success' => false, 'message' => '删除失败');
		}
	}

	/**
	 * 获取部门对应的最近一级子公司或总公司
	 * @author xue_long
	 * @since  2016-06-24T16:31:10+0800
	 * @param  [String] $uid 部门uid
	 * @return [array]
	 */
	public static function getParent($uid) {
		$r = self::get($uid);
		if(!($r['GRP_TYPE'] == '0' || $r['GRP_TYPE'] == '1')) return self::getParent($r['GRP_PARENT']);
		return $r;
	}

} // RbacGroup
