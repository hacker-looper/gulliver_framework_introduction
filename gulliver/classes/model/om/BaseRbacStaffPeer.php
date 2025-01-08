<?php

require_once 'propel/util/BasePeer.php';
// The object class -- needed for instanceof checks in this class.
// actual class may be a subclass -- as returned by RbacStaffPeer::getOMClass()
include_once 'classes/model/RbacStaff.php';

/**
 * Base static class for performing query and update operations on the 'RBAC_STAFF' table.
 *
 * 
 *
 * @package    workflow.classes.model.om
 */
abstract class BaseRbacStaffPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'app';

	/** the table name for this class */
	const TABLE_NAME = 'RBAC_STAFF';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'classes.model.RbacStaff';

	/** The total number of columns. */
	const NUM_COLUMNS = 26;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the USR_UID field */
	const USR_UID = 'RBAC_STAFF.USR_UID';

	/** the column name for the STF_CODE field */
	const STF_CODE = 'RBAC_STAFF.STF_CODE';

	/** the column name for the STF_STATUS field */
	const STF_STATUS = 'RBAC_STAFF.STF_STATUS';

	/** the column name for the GRP_UID field */
	const GRP_UID = 'RBAC_STAFF.GRP_UID';

	/** the column name for the STF_JOB field */
	const STF_JOB = 'RBAC_STAFF.STF_JOB';

	/** the column name for the STF_HOMETOWN field */
	const STF_HOMETOWN = 'RBAC_STAFF.STF_HOMETOWN';

	/** the column name for the STF_SEX field */
	const STF_SEX = 'RBAC_STAFF.STF_SEX';

	/** the column name for the STF_BOD field */
	const STF_BOD = 'RBAC_STAFF.STF_BOD';

	/** the column name for the STF_ENTERYDATE field */
	const STF_ENTERYDATE = 'RBAC_STAFF.STF_ENTERYDATE';

	/** the column name for the STF_NATION field */
	const STF_NATION = 'RBAC_STAFF.STF_NATION';

	/** the column name for the STF_IDCARD field */
	const STF_IDCARD = 'RBAC_STAFF.STF_IDCARD';

	/** the column name for the STF_POLITICAL field */
	const STF_POLITICAL = 'RBAC_STAFF.STF_POLITICAL';

	/** the column name for the STF_EDU field */
	const STF_EDU = 'RBAC_STAFF.STF_EDU';

	/** the column name for the STF_MARRIED field */
	const STF_MARRIED = 'RBAC_STAFF.STF_MARRIED';

	/** the column name for the STF_EDU_SCHOOL field */
	const STF_EDU_SCHOOL = 'RBAC_STAFF.STF_EDU_SCHOOL';

	/** the column name for the STF_EDU_MASTER field */
	const STF_EDU_MASTER = 'RBAC_STAFF.STF_EDU_MASTER';

	/** the column name for the STF_SALARYCARD field */
	const STF_SALARYCARD = 'RBAC_STAFF.STF_SALARYCARD';

	/** the column name for the STF_SOCIALCARD field */
	const STF_SOCIALCARD = 'RBAC_STAFF.STF_SOCIALCARD';

	/** the column name for the STF_CONTRACTDATE field */
	const STF_CONTRACTDATE = 'RBAC_STAFF.STF_CONTRACTDATE';

	/** the column name for the STF_MEDICALCARD field */
	const STF_MEDICALCARD = 'RBAC_STAFF.STF_MEDICALCARD';

	/** the column name for the STF_TRIALDAYS field */
	const STF_TRIALDAYS = 'RBAC_STAFF.STF_TRIALDAYS';

	/** the column name for the STF_ADDRESS field */
	const STF_ADDRESS = 'RBAC_STAFF.STF_ADDRESS';

	/** the column name for the STF_DESC field */
	const STF_DESC = 'RBAC_STAFF.STF_DESC';

	/** the column name for the CREATE_DATE field */
	const CREATE_DATE = 'RBAC_STAFF.CREATE_DATE';

	/** the column name for the MODIFIED_BY field */
	const MODIFIED_BY = 'RBAC_STAFF.MODIFIED_BY';

	/** the column name for the MODIFIED_AT field */
	const MODIFIED_AT = 'RBAC_STAFF.MODIFIED_AT';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('UsrUid', 'StfCode', 'StfStatus', 'GrpUid', 'StfJob', 'StfHometown', 'StfSex', 'StfBod', 'StfEnterydate', 'StfNation', 'StfIdcard', 'StfPolitical', 'StfEdu', 'StfMarried', 'StfEduSchool', 'StfEduMaster', 'StfSalarycard', 'StfSocialcard', 'StfContractdate', 'StfMedicalcard', 'StfTrialdays', 'StfAddress', 'StfDesc', 'CreateDate', 'ModifiedBy', 'ModifiedAt', ),
		BasePeer::TYPE_COLNAME => array (RbacStaffPeer::USR_UID, RbacStaffPeer::STF_CODE, RbacStaffPeer::STF_STATUS, RbacStaffPeer::GRP_UID, RbacStaffPeer::STF_JOB, RbacStaffPeer::STF_HOMETOWN, RbacStaffPeer::STF_SEX, RbacStaffPeer::STF_BOD, RbacStaffPeer::STF_ENTERYDATE, RbacStaffPeer::STF_NATION, RbacStaffPeer::STF_IDCARD, RbacStaffPeer::STF_POLITICAL, RbacStaffPeer::STF_EDU, RbacStaffPeer::STF_MARRIED, RbacStaffPeer::STF_EDU_SCHOOL, RbacStaffPeer::STF_EDU_MASTER, RbacStaffPeer::STF_SALARYCARD, RbacStaffPeer::STF_SOCIALCARD, RbacStaffPeer::STF_CONTRACTDATE, RbacStaffPeer::STF_MEDICALCARD, RbacStaffPeer::STF_TRIALDAYS, RbacStaffPeer::STF_ADDRESS, RbacStaffPeer::STF_DESC, RbacStaffPeer::CREATE_DATE, RbacStaffPeer::MODIFIED_BY, RbacStaffPeer::MODIFIED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('USR_UID', 'STF_CODE', 'STF_STATUS', 'GRP_UID', 'STF_JOB', 'STF_HOMETOWN', 'STF_SEX', 'STF_BOD', 'STF_ENTERYDATE', 'STF_NATION', 'STF_IDCARD', 'STF_POLITICAL', 'STF_EDU', 'STF_MARRIED', 'STF_EDU_SCHOOL', 'STF_EDU_MASTER', 'STF_SALARYCARD', 'STF_SOCIALCARD', 'STF_CONTRACTDATE', 'STF_MEDICALCARD', 'STF_TRIALDAYS', 'STF_ADDRESS', 'STF_DESC', 'CREATE_DATE', 'MODIFIED_BY', 'MODIFIED_AT', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('UsrUid' => 0, 'StfCode' => 1, 'StfStatus' => 2, 'GrpUid' => 3, 'StfJob' => 4, 'StfHometown' => 5, 'StfSex' => 6, 'StfBod' => 7, 'StfEnterydate' => 8, 'StfNation' => 9, 'StfIdcard' => 10, 'StfPolitical' => 11, 'StfEdu' => 12, 'StfMarried' => 13, 'StfEduSchool' => 14, 'StfEduMaster' => 15, 'StfSalarycard' => 16, 'StfSocialcard' => 17, 'StfContractdate' => 18, 'StfMedicalcard' => 19, 'StfTrialdays' => 20, 'StfAddress' => 21, 'StfDesc' => 22, 'CreateDate' => 23, 'ModifiedBy' => 24, 'ModifiedAt' => 25, ),
		BasePeer::TYPE_COLNAME => array (RbacStaffPeer::USR_UID => 0, RbacStaffPeer::STF_CODE => 1, RbacStaffPeer::STF_STATUS => 2, RbacStaffPeer::GRP_UID => 3, RbacStaffPeer::STF_JOB => 4, RbacStaffPeer::STF_HOMETOWN => 5, RbacStaffPeer::STF_SEX => 6, RbacStaffPeer::STF_BOD => 7, RbacStaffPeer::STF_ENTERYDATE => 8, RbacStaffPeer::STF_NATION => 9, RbacStaffPeer::STF_IDCARD => 10, RbacStaffPeer::STF_POLITICAL => 11, RbacStaffPeer::STF_EDU => 12, RbacStaffPeer::STF_MARRIED => 13, RbacStaffPeer::STF_EDU_SCHOOL => 14, RbacStaffPeer::STF_EDU_MASTER => 15, RbacStaffPeer::STF_SALARYCARD => 16, RbacStaffPeer::STF_SOCIALCARD => 17, RbacStaffPeer::STF_CONTRACTDATE => 18, RbacStaffPeer::STF_MEDICALCARD => 19, RbacStaffPeer::STF_TRIALDAYS => 20, RbacStaffPeer::STF_ADDRESS => 21, RbacStaffPeer::STF_DESC => 22, RbacStaffPeer::CREATE_DATE => 23, RbacStaffPeer::MODIFIED_BY => 24, RbacStaffPeer::MODIFIED_AT => 25, ),
		BasePeer::TYPE_FIELDNAME => array ('USR_UID' => 0, 'STF_CODE' => 1, 'STF_STATUS' => 2, 'GRP_UID' => 3, 'STF_JOB' => 4, 'STF_HOMETOWN' => 5, 'STF_SEX' => 6, 'STF_BOD' => 7, 'STF_ENTERYDATE' => 8, 'STF_NATION' => 9, 'STF_IDCARD' => 10, 'STF_POLITICAL' => 11, 'STF_EDU' => 12, 'STF_MARRIED' => 13, 'STF_EDU_SCHOOL' => 14, 'STF_EDU_MASTER' => 15, 'STF_SALARYCARD' => 16, 'STF_SOCIALCARD' => 17, 'STF_CONTRACTDATE' => 18, 'STF_MEDICALCARD' => 19, 'STF_TRIALDAYS' => 20, 'STF_ADDRESS' => 21, 'STF_DESC' => 22, 'CREATE_DATE' => 23, 'MODIFIED_BY' => 24, 'MODIFIED_AT' => 25, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'classes/model/map/RbacStaffMapBuilder.php';
		return BasePeer::getMapBuilder('classes.model.map.RbacStaffMapBuilder');
	}
	/**
	 * Gets a map (hash) of PHP names to DB column names.
	 *
	 * @return     array The PHP to DB name map for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @deprecated Use the getFieldNames() and translateFieldName() methods instead of this.
	 */
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = RbacStaffPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants TYPE_PHPNAME,
	 *                         TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants TYPE_PHPNAME,
	 *                      TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. RbacStaffPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(RbacStaffPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      criteria object containing the columns to add.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(RbacStaffPeer::USR_UID);

		$criteria->addSelectColumn(RbacStaffPeer::STF_CODE);

		$criteria->addSelectColumn(RbacStaffPeer::STF_STATUS);

		$criteria->addSelectColumn(RbacStaffPeer::GRP_UID);

		$criteria->addSelectColumn(RbacStaffPeer::STF_JOB);

		$criteria->addSelectColumn(RbacStaffPeer::STF_HOMETOWN);

		$criteria->addSelectColumn(RbacStaffPeer::STF_SEX);

		$criteria->addSelectColumn(RbacStaffPeer::STF_BOD);

		$criteria->addSelectColumn(RbacStaffPeer::STF_ENTERYDATE);

		$criteria->addSelectColumn(RbacStaffPeer::STF_NATION);

		$criteria->addSelectColumn(RbacStaffPeer::STF_IDCARD);

		$criteria->addSelectColumn(RbacStaffPeer::STF_POLITICAL);

		$criteria->addSelectColumn(RbacStaffPeer::STF_EDU);

		$criteria->addSelectColumn(RbacStaffPeer::STF_MARRIED);

		$criteria->addSelectColumn(RbacStaffPeer::STF_EDU_SCHOOL);

		$criteria->addSelectColumn(RbacStaffPeer::STF_EDU_MASTER);

		$criteria->addSelectColumn(RbacStaffPeer::STF_SALARYCARD);

		$criteria->addSelectColumn(RbacStaffPeer::STF_SOCIALCARD);

		$criteria->addSelectColumn(RbacStaffPeer::STF_CONTRACTDATE);

		$criteria->addSelectColumn(RbacStaffPeer::STF_MEDICALCARD);

		$criteria->addSelectColumn(RbacStaffPeer::STF_TRIALDAYS);

		$criteria->addSelectColumn(RbacStaffPeer::STF_ADDRESS);

		$criteria->addSelectColumn(RbacStaffPeer::STF_DESC);

		$criteria->addSelectColumn(RbacStaffPeer::CREATE_DATE);

		$criteria->addSelectColumn(RbacStaffPeer::MODIFIED_BY);

		$criteria->addSelectColumn(RbacStaffPeer::MODIFIED_AT);

	}

	const COUNT = 'COUNT(RBAC_STAFF.USR_UID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT RBAC_STAFF.USR_UID)';

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RbacStaffPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RbacStaffPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = RbacStaffPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      Connection $con
	 * @return     RbacStaff
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = RbacStaffPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Method to do selects.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      Connection $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return RbacStaffPeer::populateObjects(RbacStaffPeer::doSelectRS($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect()
	 * method to get a ResultSet.
	 *
	 * Use this method directly if you want to just get the resultset
	 * (instead of an array of objects).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      Connection $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     ResultSet The resultset object with numerically-indexed fields.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			RbacStaffPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a Creole ResultSet, set to return
		// rows indexed numerically.
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = RbacStaffPeer::getOMClass();
		$cls = Propel::import($cls);
		// populate the object(s)
		while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}
	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 * This uses a dot-path notation which is tranalted into a path
	 * relative to a location on the PHP include_path.
	 * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
	 *
	 * @return     string path.to.ClassName
	 */
	public static function getOMClass()
	{
		return RbacStaffPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a RbacStaff or Criteria object.
	 *
	 * @param      mixed $values Criteria or RbacStaff object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from RbacStaff object
		}


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a RbacStaff or Criteria object.
	 *
	 * @param      mixed $values Criteria or RbacStaff object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(RbacStaffPeer::USR_UID);
			$selectCriteria->add(RbacStaffPeer::USR_UID, $criteria->remove(RbacStaffPeer::USR_UID), $comparison);

		} else { // $values is RbacStaff object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the RBAC_STAFF table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->begin();
			$affectedRows += BasePeer::doDeleteAll(RbacStaffPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a RbacStaff or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or RbacStaff object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      Connection $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(RbacStaffPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof RbacStaff) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(RbacStaffPeer::USR_UID, (array) $values, Criteria::IN);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given RbacStaff object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      RbacStaff $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(RbacStaff $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RbacStaffPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RbacStaffPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		return BasePeer::doValidate(RbacStaffPeer::DATABASE_NAME, RbacStaffPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      Connection $con the connection to use
	 * @return     RbacStaff
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(RbacStaffPeer::DATABASE_NAME);

		$criteria->add(RbacStaffPeer::USR_UID, $pk);


		$v = RbacStaffPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      Connection $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(RbacStaffPeer::USR_UID, $pks, Criteria::IN);
			$objs = RbacStaffPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseRbacStaffPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseRbacStaffPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'classes/model/map/RbacStaffMapBuilder.php';
	Propel::registerMapBuilder('classes.model.map.RbacStaffMapBuilder');
}
