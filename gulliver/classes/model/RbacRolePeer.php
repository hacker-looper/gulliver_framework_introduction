<?php

  // include base peer class
  require_once 'classes/model/om/BaseRbacRolePeer.php';

  // include object class
  include_once 'classes/model/RbacRole.php';


/**
 * Skeleton subclass for performing query and update operations on the 'RBAC_ROLE' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    classes.model
 */
class RbacRolePeer extends BaseRbacRolePeer {
	/**
	 * 根据SYSTEM获取角色
	 * @author xue_long
	 * @since  2016-06-10T10:17:53+0800
	 * @param  [String] $system 所属模块
	 * @return [array]
	 */
	public static function getRoleBySystem($system){
		$oCriteria = new Criteria('app');
		$oCriteria->add( RbacRolePeer::ROLE_SYSTEM, $system, Criteria::EQUAL );
		$oCriteria->addAscendingOrderByColumn(RbacRolePeer::ROLE_NAME);
			
		$aData = RbacRolePeer::doSelectRS($oCriteria);
		$aData->setFetchmode( ResultSet::FETCHMODE_ASSOC );
		$res=array();
		while ($aData->next()) {
			$row = $aData->getRow();
			$res[] = $row;
		}
		return $res;
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



} // RbacRolePeer
