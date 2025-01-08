<?php

require_once 'propel/map/MapBuilder.php';
include_once 'creole/CreoleTypes.php';


/**
 * This class adds structure of 'RBAC_PERMISSION' table to 'app' DatabaseMap object.
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
class RbacPermissionMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'classes.model.map.RbacPermissionMapBuilder';

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

		$tMap = $this->dbMap->addTable('RBAC_PERMISSION');
		$tMap->setPhpName('RbacPermission');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('PER_UID', 'PerUid', 'string', CreoleTypes::VARCHAR, true, 32);

		$tMap->addColumn('PER_NAME', 'PerName', 'string', CreoleTypes::VARCHAR, true, 50);

		$tMap->addColumn('PER_NAME_DISPLAY', 'PerNameDisplay', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('PER_STATUS', 'PerStatus', 'string', CreoleTypes::CHAR, false, 1);

		$tMap->addColumn('PER_CATEGORY', 'PerCategory', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('PER_DESC', 'PerDesc', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREATE_DATE', 'CreateDate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('MODIFIED_BY', 'ModifiedBy', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('MODIFIED_AT', 'ModifiedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} // doBuild()

} // RbacPermissionMapBuilder
