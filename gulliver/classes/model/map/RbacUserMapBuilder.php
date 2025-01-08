<?php

require_once 'propel/map/MapBuilder.php';
include_once 'creole/CreoleTypes.php';


/**
 * This class adds structure of 'RBAC_USER' table to 'app' DatabaseMap object.
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
class RbacUserMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'classes.model.map.RbacUserMapBuilder';

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

		$tMap = $this->dbMap->addTable('RBAC_USER');
		$tMap->setPhpName('RbacUser');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('USR_UID', 'UsrUid', 'string', CreoleTypes::VARCHAR, true, 32);

		$tMap->addColumn('USR_USERNAME', 'UsrUsername', 'string', CreoleTypes::VARCHAR, true, 50);

		$tMap->addColumn('USR_PASSWORD', 'UsrPassword', 'string', CreoleTypes::VARCHAR, true, 100);

		$tMap->addColumn('USR_FULLNAME', 'UsrFullname', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('USR_NICKNAME', 'UsrNickname', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('USR_NICKNAME_ISUSE', 'UsrNicknameIsuse', 'string', CreoleTypes::CHAR, false, 1);

		$tMap->addColumn('USR_SEX', 'UsrSex', 'string', CreoleTypes::CHAR, false, 1);

		$tMap->addColumn('USR_EMAIL', 'UsrEmail', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('USR_PHONE', 'UsrPhone', 'string', CreoleTypes::VARCHAR, false, 15);

		$tMap->addColumn('USR_ROLES', 'UsrRoles', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('USR_REMEMBER_TOKEN', 'UsrRememberToken', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('USR_STATUS', 'UsrStatus', 'string', CreoleTypes::CHAR, false, 1);

		$tMap->addColumn('USR_IMAGE', 'UsrImage', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('USR_SELFDESC', 'UsrSelfdesc', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('USR_ADDRESS', 'UsrAddress', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('USR_SNS_WECHAT', 'UsrSnsWechat', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('USR_SNS_WEIBO', 'UsrSnsWeibo', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('USR_SNS_QQ', 'UsrSnsQq', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('USR_GOAL', 'UsrGoal', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('USR_LEVEL', 'UsrLevel', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('USR_COIN', 'UsrCoin', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('USR_EXPIRE_DATE', 'UsrExpireDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('USR_ACCOUNT_BALANCE', 'UsrAccountBalance', 'double', CreoleTypes::DECIMAL, false, 10);

		$tMap->addColumn('USR_API_KEY', 'UsrApiKey', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('USR_LASTLOGIN', 'UsrLastlogin', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CREATE_DATE', 'CreateDate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('MODIFIED_BY', 'ModifiedBy', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('MODIFIED_AT', 'ModifiedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} // doBuild()

} // RbacUserMapBuilder
