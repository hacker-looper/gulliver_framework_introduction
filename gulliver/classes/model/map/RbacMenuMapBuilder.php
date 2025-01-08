<?php

require_once 'propel/map/MapBuilder.php';
include_once 'creole/CreoleTypes.php';


/**
 * This class adds structure of 'RBAC_MENU' table to 'app' DatabaseMap object.
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
class RbacMenuMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'classes.model.map.RbacMenuMapBuilder';

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

		$tMap = $this->dbMap->addTable('RBAC_MENU');
		$tMap->setPhpName('RbacMenu');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('MENU_UID', 'MenuUid', 'string', CreoleTypes::VARCHAR, true, 32);

		$tMap->addColumn('MENU_CODE', 'MenuCode', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('MENU_INDEX', 'MenuIndex', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('MENU_TITLE', 'MenuTitle', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('MENU_TYPE', 'MenuType', 'string', CreoleTypes::CHAR, false, 1);

		$tMap->addColumn('MENU_DESC', 'MenuDesc', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('MENU_PERMISSION', 'MenuPermission', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('MENU_URL', 'MenuUrl', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('MENU_STATUS', 'MenuStatus', 'string', CreoleTypes::CHAR, false, 1);

		$tMap->addColumn('MENU_PARENT', 'MenuParent', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('CREATE_DATE', 'CreateDate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('MODIFIED_BY', 'ModifiedBy', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('MODIFIED_AT', 'ModifiedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} // doBuild()

} // RbacMenuMapBuilder
