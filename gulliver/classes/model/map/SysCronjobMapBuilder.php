<?php

require_once 'propel/map/MapBuilder.php';
include_once 'creole/CreoleTypes.php';


/**
 * This class adds structure of 'SYS_CRONJOB' table to 'app' DatabaseMap object.
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
class SysCronjobMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'classes.model.map.SysCronjobMapBuilder';

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

		$tMap = $this->dbMap->addTable('SYS_CRONJOB');
		$tMap->setPhpName('SysCronjob');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('SC_UID', 'ScUid', 'string', CreoleTypes::VARCHAR, true, 32);

		$tMap->addColumn('SC_INTERVAL', 'ScInterval', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SC_INTERVAL_UNIT', 'ScIntervalUnit', 'string', CreoleTypes::CHAR, false, 1);

		$tMap->addColumn('SC_COMMAND', 'ScCommand', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('SC_COMMAND_LASTRUN', 'ScCommandLastrun', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CREATE_DATE', 'CreateDate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('MODIFIED_BY', 'ModifiedBy', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('MODIFIED_AT', 'ModifiedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} // doBuild()

} // SysCronjobMapBuilder
