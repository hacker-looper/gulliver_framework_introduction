<?php

  // include base peer class
  require_once 'classes/model/om/BaseRbacGroupUserPeer.php';

  // include object class
  include_once 'classes/model/RbacGroupUser.php';


/**
 * Skeleton subclass for performing query and update operations on the 'RBAC_GROUP_USER' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    classes.model
 */
class RbacGroupUserPeer extends BaseRbacGroupUserPeer {


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
		$obj = RbacGroupUserPeer::retrieveByPK($PK);
		return $obj;
	}
	
} // RbacGroupUserPeer
