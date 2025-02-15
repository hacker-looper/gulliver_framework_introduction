<?php

require_once 'propel/map/MapBuilder.php';
include_once 'creole/CreoleTypes.php';


/**
 * This class adds structure of 'RBAC_ROLE' table to 'app' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    workflow.classes.model.map
 */
class RbacRoleMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'classes.model.map.RbacRoleMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('app');

		$tMap = $this->dbMap->addTable('RBAC_ROLE');
		$tMap->setPhpName('RbacRole');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('ROLE_UID', 'RoleUid', 'string', CreoleTypes::VARCHAR, true, 32);

		$tMap->addColumn('ROLE_NAME', 'RoleName', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('ROLE_NAME_DISPLAY', 'RoleNameDisplay', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('ROLE_SYSTEM', 'RoleSystem', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('ROLE_STATUS', 'RoleStatus', 'string', CreoleTypes::CHAR, false, 1);

		$tMap->addColumn('ROLE_PARENT', 'RoleParent', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('ROLE_DESC', 'RoleDesc', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREATE_DATE', 'CreateDate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('MODIFIED_BY', 'ModifiedBy', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('MODIFIED_AT', 'ModifiedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} // doBuild()

} // RbacRoleMapBuilder
