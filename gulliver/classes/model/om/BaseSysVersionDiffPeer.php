<?php

require_once 'propel/util/BasePeer.php';
// The object class -- needed for instanceof checks in this class.
// actual class may be a subclass -- as returned by SysVersionDiffPeer::getOMClass()
include_once 'classes/model/SysVersionDiff.php';

/**
 * Base static class for performing query and update operations on the 'SYS_VERSION_DIFF' table.
 *
 * 
 *
 * @package    workflow.classes.model.om
 */
abstract class BaseSysVersionDiffPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'app';

	/** the table name for this class */
	const TABLE_NAME = 'SYS_VERSION_DIFF';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'classes.model.SysVersionDiff';

	/** The total number of columns. */
	const NUM_COLUMNS = 15;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the DVER_UID field */
	const DVER_UID = 'SYS_VERSION_DIFF.DVER_UID';

	/** the column name for the VER_UID field */
	const VER_UID = 'SYS_VERSION_DIFF.VER_UID';

	/** the column name for the VER_CODE field */
	const VER_CODE = 'SYS_VERSION_DIFF.VER_CODE';

	/** the column name for the DVER_NAME field */
	const DVER_NAME = 'SYS_VERSION_DIFF.DVER_NAME';

	/** the column name for the DVER_CODE field */
	const DVER_CODE = 'SYS_VERSION_DIFF.DVER_CODE';

	/** the column name for the DVER_BUILD field */
	const DVER_BUILD = 'SYS_VERSION_DIFF.DVER_BUILD';

	/** the column name for the DVER_MODULE field */
	const DVER_MODULE = 'SYS_VERSION_DIFF.DVER_MODULE';

	/** the column name for the DVER_DESC field */
	const DVER_DESC = 'SYS_VERSION_DIFF.DVER_DESC';

	/** the column name for the DVER_URL field */
	const DVER_URL = 'SYS_VERSION_DIFF.DVER_URL';

	/** the column name for the DVER_SIZE field */
	const DVER_SIZE = 'SYS_VERSION_DIFF.DVER_SIZE';

	/** the column name for the DVER_UPGRADE_FROM field */
	const DVER_UPGRADE_FROM = 'SYS_VERSION_DIFF.DVER_UPGRADE_FROM';

	/** the column name for the DEVR_UPGRADE_TO field */
	const DEVR_UPGRADE_TO = 'SYS_VERSION_DIFF.DEVR_UPGRADE_TO';

	/** the column name for the CREATE_DATE field */
	const CREATE_DATE = 'SYS_VERSION_DIFF.CREATE_DATE';

	/** the column name for the MODIFIED_BY field */
	const MODIFIED_BY = 'SYS_VERSION_DIFF.MODIFIED_BY';

	/** the column name for the MODIFIED_AT field */
	const MODIFIED_AT = 'SYS_VERSION_DIFF.MODIFIED_AT';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('DverUid', 'VerUid', 'VerCode', 'DverName', 'DverCode', 'DverBuild', 'DverModule', 'DverDesc', 'DverUrl', 'DverSize', 'DverUpgradeFrom', 'DevrUpgradeTo', 'CreateDate', 'ModifiedBy', 'ModifiedAt', ),
		BasePeer::TYPE_COLNAME => array (SysVersionDiffPeer::DVER_UID, SysVersionDiffPeer::VER_UID, SysVersionDiffPeer::VER_CODE, SysVersionDiffPeer::DVER_NAME, SysVersionDiffPeer::DVER_CODE, SysVersionDiffPeer::DVER_BUILD, SysVersionDiffPeer::DVER_MODULE, SysVersionDiffPeer::DVER_DESC, SysVersionDiffPeer::DVER_URL, SysVersionDiffPeer::DVER_SIZE, SysVersionDiffPeer::DVER_UPGRADE_FROM, SysVersionDiffPeer::DEVR_UPGRADE_TO, SysVersionDiffPeer::CREATE_DATE, SysVersionDiffPeer::MODIFIED_BY, SysVersionDiffPeer::MODIFIED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('DVER_UID', 'VER_UID', 'VER_CODE', 'DVER_NAME', 'DVER_CODE', 'DVER_BUILD', 'DVER_MODULE', 'DVER_DESC', 'DVER_URL', 'DVER_SIZE', 'DVER_UPGRADE_FROM', 'DEVR_UPGRADE_TO', 'CREATE_DATE', 'MODIFIED_BY', 'MODIFIED_AT', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('DverUid' => 0, 'VerUid' => 1, 'VerCode' => 2, 'DverName' => 3, 'DverCode' => 4, 'DverBuild' => 5, 'DverModule' => 6, 'DverDesc' => 7, 'DverUrl' => 8, 'DverSize' => 9, 'DverUpgradeFrom' => 10, 'DevrUpgradeTo' => 11, 'CreateDate' => 12, 'ModifiedBy' => 13, 'ModifiedAt' => 14, ),
		BasePeer::TYPE_COLNAME => array (SysVersionDiffPeer::DVER_UID => 0, SysVersionDiffPeer::VER_UID => 1, SysVersionDiffPeer::VER_CODE => 2, SysVersionDiffPeer::DVER_NAME => 3, SysVersionDiffPeer::DVER_CODE => 4, SysVersionDiffPeer::DVER_BUILD => 5, SysVersionDiffPeer::DVER_MODULE => 6, SysVersionDiffPeer::DVER_DESC => 7, SysVersionDiffPeer::DVER_URL => 8, SysVersionDiffPeer::DVER_SIZE => 9, SysVersionDiffPeer::DVER_UPGRADE_FROM => 10, SysVersionDiffPeer::DEVR_UPGRADE_TO => 11, SysVersionDiffPeer::CREATE_DATE => 12, SysVersionDiffPeer::MODIFIED_BY => 13, SysVersionDiffPeer::MODIFIED_AT => 14, ),
		BasePeer::TYPE_FIELDNAME => array ('DVER_UID' => 0, 'VER_UID' => 1, 'VER_CODE' => 2, 'DVER_NAME' => 3, 'DVER_CODE' => 4, 'DVER_BUILD' => 5, 'DVER_MODULE' => 6, 'DVER_DESC' => 7, 'DVER_URL' => 8, 'DVER_SIZE' => 9, 'DVER_UPGRADE_FROM' => 10, 'DEVR_UPGRADE_TO' => 11, 'CREATE_DATE' => 12, 'MODIFIED_BY' => 13, 'MODIFIED_AT' => 14, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'classes/model/map/SysVersionDiffMapBuilder.php';
		return BasePeer::getMapBuilder('classes.model.map.SysVersionDiffMapBuilder');
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
			$map = SysVersionDiffPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. SysVersionDiffPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(SysVersionDiffPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(SysVersionDiffPeer::DVER_UID);

		$criteria->addSelectColumn(SysVersionDiffPeer::VER_UID);

		$criteria->addSelectColumn(SysVersionDiffPeer::VER_CODE);

		$criteria->addSelectColumn(SysVersionDiffPeer::DVER_NAME);

		$criteria->addSelectColumn(SysVersionDiffPeer::DVER_CODE);

		$criteria->addSelectColumn(SysVersionDiffPeer::DVER_BUILD);

		$criteria->addSelectColumn(SysVersionDiffPeer::DVER_MODULE);

		$criteria->addSelectColumn(SysVersionDiffPeer::DVER_DESC);

		$criteria->addSelectColumn(SysVersionDiffPeer::DVER_URL);

		$criteria->addSelectColumn(SysVersionDiffPeer::DVER_SIZE);

		$criteria->addSelectColumn(SysVersionDiffPeer::DVER_UPGRADE_FROM);

		$criteria->addSelectColumn(SysVersionDiffPeer::DEVR_UPGRADE_TO);

		$criteria->addSelectColumn(SysVersionDiffPeer::CREATE_DATE);

		$criteria->addSelectColumn(SysVersionDiffPeer::MODIFIED_BY);

		$criteria->addSelectColumn(SysVersionDiffPeer::MODIFIED_AT);

	}

	const COUNT = 'COUNT(SYS_VERSION_DIFF.DVER_UID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT SYS_VERSION_DIFF.DVER_UID)';

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
			$criteria->addSelectColumn(SysVersionDiffPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SysVersionDiffPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SysVersionDiffPeer::doSelectRS($criteria, $con);
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
	 * @return     SysVersionDiff
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = SysVersionDiffPeer::doSelect($critcopy, $con);
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
		return SysVersionDiffPeer::populateObjects(SysVersionDiffPeer::doSelectRS($criteria, $con));
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
			SysVersionDiffPeer::addSelectColumns($criteria);
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
		$cls = SysVersionDiffPeer::getOMClass();
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
		return SysVersionDiffPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a SysVersionDiff or Criteria object.
	 *
	 * @param      mixed $values Criteria or SysVersionDiff object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build Criteria from SysVersionDiff object
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
	 * Method perform an UPDATE on the database, given a SysVersionDiff or Criteria object.
	 *
	 * @param      mixed $values Criteria or SysVersionDiff object containing data that is used to create the UPDATE statement.
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

			$comparison = $criteria->getComparison(SysVersionDiffPeer::DVER_UID);
			$selectCriteria->add(SysVersionDiffPeer::DVER_UID, $criteria->remove(SysVersionDiffPeer::DVER_UID), $comparison);

		} else { // $values is SysVersionDiff object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the SYS_VERSION_DIFF table.
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
			$affectedRows += BasePeer::doDeleteAll(SysVersionDiffPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a SysVersionDiff or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or SysVersionDiff object or primary key or array of primary keys
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
			$con = Propel::getConnection(SysVersionDiffPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof SysVersionDiff) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(SysVersionDiffPeer::DVER_UID, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given SysVersionDiff object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      SysVersionDiff $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(SysVersionDiff $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SysVersionDiffPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SysVersionDiffPeer::TABLE_NAME);

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

		return BasePeer::doValidate(SysVersionDiffPeer::DATABASE_NAME, SysVersionDiffPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      Connection $con the connection to use
	 * @return     SysVersionDiff
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(SysVersionDiffPeer::DATABASE_NAME);

		$criteria->add(SysVersionDiffPeer::DVER_UID, $pk);


		$v = SysVersionDiffPeer::doSelect($criteria, $con);

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
			$criteria->add(SysVersionDiffPeer::DVER_UID, $pks, Criteria::IN);
			$objs = SysVersionDiffPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseSysVersionDiffPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseSysVersionDiffPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'classes/model/map/SysVersionDiffMapBuilder.php';
	Propel::registerMapBuilder('classes.model.map.SysVersionDiffMapBuilder');
}
