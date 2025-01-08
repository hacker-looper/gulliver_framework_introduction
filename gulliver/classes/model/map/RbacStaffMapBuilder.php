<?php

require_once 'propel/map/MapBuilder.php';
include_once 'creole/CreoleTypes.php';


/**
 * This class adds structure of 'RBAC_STAFF' table to 'app' DatabaseMap object.
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
class RbacStaffMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'classes.model.map.RbacStaffMapBuilder';

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

		$tMap = $this->dbMap->addTable('RBAC_STAFF');
		$tMap->setPhpName('RbacStaff');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('USR_UID', 'UsrUid', 'string', CreoleTypes::VARCHAR, true, 32);

		$tMap->addColumn('STF_CODE', 'StfCode', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('STF_STATUS', 'StfStatus', 'string', CreoleTypes::CHAR, false, 1);

		$tMap->addColumn('GRP_UID', 'GrpUid', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('STF_JOB', 'StfJob', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('STF_HOMETOWN', 'StfHometown', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('STF_SEX', 'StfSex', 'string', CreoleTypes::CHAR, false, 1);

		$tMap->addColumn('STF_BOD', 'StfBod', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('STF_ENTERYDATE', 'StfEnterydate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('STF_NATION', 'StfNation', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('STF_IDCARD', 'StfIdcard', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('STF_POLITICAL', 'StfPolitical', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('STF_EDU', 'StfEdu', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('STF_MARRIED', 'StfMarried', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('STF_EDU_SCHOOL', 'StfEduSchool', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('STF_EDU_MASTER', 'StfEduMaster', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('STF_SALARYCARD', 'StfSalarycard', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('STF_SOCIALCARD', 'StfSocialcard', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('STF_CONTRACTDATE', 'StfContractdate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('STF_MEDICALCARD', 'StfMedicalcard', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('STF_TRIALDAYS', 'StfTrialdays', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('STF_ADDRESS', 'StfAddress', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('STF_DESC', 'StfDesc', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREATE_DATE', 'CreateDate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('MODIFIED_BY', 'ModifiedBy', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('MODIFIED_AT', 'ModifiedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} // doBuild()

} // RbacStaffMapBuilder
