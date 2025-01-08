<?php

require_once 'classes/model/om/BaseRbacRolePermission.php';


/**
 * Skeleton subclass for representing a row from the 'RBAC_ROLE_PERMISSION' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    classes.model
 */
class RbacRolePermission extends BaseRbacRolePermission {

	/**
	 * 删除与role相关的permission关系
	 * @param $ROLE_UID string
	 */
	public static function delByRole($ROLE_UID){
		$con = Propel::getConnection('system');
		$stmt = $con->createStatement();

		$sql = "DELETE FROM RBAC_ROLE_PERMISSION WHERE ROLE_UID='$ROLE_UID'";
		$stmt->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);
	}

} // RbacRolePermission
