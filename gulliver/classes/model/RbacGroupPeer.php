<?php

  // include base peer class
  require_once 'classes/model/om/BaseRbacGroupPeer.php';

  // include object class
  include_once 'classes/model/RbacGroup.php';


/**
 * Skeleton subclass for performing query and update operations on the 'RBAC_GROUP' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    classes.model
 */
class RbacGroupPeer extends BaseRbacGroupPeer {

	/**
	 * [AutoCode]
	 *
	 * 根据P获取数据库表对象
	 * @param PK 主键
	 * @return Object
	 * @author Gulliver2
	 * @since  20-07-04 16:01:39
	 **/
	public static function getObjByPk($PK){
		if(! $PK) return null;
		$obj = RbacGroupPeer::retrieveByPK($PK);
		return $obj;
	}


	public static function getGroup4Select(){
		$sql = "SELECT * FROM RBAC_GROUP ";
		$aData = PropelUtil::excuteRS($sql);
		$aTree = self::_tree4select($aData, '');

		return $aTree;
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
                $tree_row['label']   = $row['GRP_NAME'];
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
	 * vuejs+antd
	 **/ 
	public static function getGroup4Tree($haveStaff=false){
		$sql = "SELECT * FROM RBAC_GROUP ";
		$aData = PropelUtil::excuteRS($sql);
		$aTree = self::_tree($aData, '', $haveStaff);

		return $aTree;
	}

} // RbacGroupPeer
