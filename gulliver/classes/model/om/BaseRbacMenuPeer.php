<?php

require_once 'propel/util/BasePeer.php';
// The object class -- needed for instanceof checks in this class.
// actual class may be a subclass -- as returned by RbacMenuPeer::getOMClass()
include_once 'classes/model/RbacMenu.php';

/**
 * Base static class for performing query and update operations on the 'RBAC_MENU' table.
 *
 * 
 *
 * @package    workflow.classes.model.om
 */
abstract class BaseRbacMenuPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'app';

	/** the table name for this class */
	const TABLE_NAME = 'RBAC_MENU';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'classes.model.RbacMenu';

	/** The total number of columns. */
	const NUM_COLUMNS = 13;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the MENU_UID field */
	const MENU_UID = 'RBAC_MENU.MENU_UID';

	/** the column name for the MENU_CODE field */
	const MENU_CODE = 'RBAC_MENU.MENU_CODE';

	/** the column name for the MENU_INDEX field */
	const MENU_INDEX = 'RBAC_MENU.MENU_INDEX';

	/** the column name for the MENU_TITLE field */
	const MENU_TITLE = 'RBAC_MENU.MENU_TITLE';

	/** the column name for the MENU_TYPE field */
	const MENU_TYPE = 'RBAC_MENU.MENU_TYPE';

	/** the column name for the MENU_DESC field */
	const MENU_DESC = 'RBAC_MENU.MENU_DESC';

	/** the column name for the MENU_PERMISSION field */
	const MENU_PERMISSION = 'RBAC_MENU.MENU_PERMISSION';

	/** the column name for the MENU_URL field */
	const MENU_URL = 'RBAC_MENU.MENU_URL';

	/** the column name for the MENU_STATUS field */
	const MENU_STATUS = 'RBAC_MENU.MENU_STATUS';

	/** the column name for the MENU_PARENT field */
	const MENU_PARENT = 'RBAC_MENU.MENU_PARENT';

	/** the column name for the CREATE_DATE field */
	const CREATE_DATE = 'RBAC_MENU.CREATE_DATE';

	/** the column name for the MODIFIED_BY field */
	const MODIFIED_BY = 'RBAC_MENU.MODIFIED_BY';

	/** the column name for the MODIFIED_AT field */
	const MODIFIED_AT = 'RBAC_MENU.MODIFIED_AT';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('MenuUid', 'MenuCode', 'MenuIndex', 'MenuTitle', 'MenuType', 'MenuDesc', 'MenuPermission', 'MenuUrl', 'MenuStatus', 'MenuParent', 'CreateDate', 'ModifiedBy', 'ModifiedAt', ),
		BasePeer::TYPE_COLNAME => array (RbacMenuPeer::MENU_UID, RbacMenuPeer::MENU_CODE, RbacMenuPeer::MENU_INDEX, RbacMenuPeer::MENU_TITLE, RbacMenuPeer::MENU_TYPE, RbacMenuPeer::MENU_DESC, RbacMenuPeer::MENU_PERMISSION, RbacMenuPeer::MENU_URL, RbacMenuPeer::MENU_STATUS, RbacMenuPeer::MENU_PARENT, RbacMenuPeer::CREATE_DATE, RbacMenuPeer::MODIFIED_BY, RbacMenuPeer::MODIFIED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('MENU_UID', 'MENU_CODE', 'MENU_INDEX', 'MENU_TITLE', 'MENU_TYPE', 'MENU_DESC', 'MENU_PERMISSION', 'MENU_URL', 'MENU_STATUS', 'MENU_PARENT', 'CREATE_DATE', 'MODIFIED_BY', 'MODIFIED_AT', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('MenuUid' => 0, 'MenuCode' => 1, 'MenuIndex' => 2, 'MenuTitle' => 3, 'MenuType' => 4, 'MenuDesc' => 5, 'MenuPermission' => 6, 'MenuUrl' => 7, 'MenuStatus' => 8, 'MenuParent' => 9, 'CreateDate' => 10, 'ModifiedBy' => 11, 'ModifiedAt' => 12, ),
		BasePeer::TYPE_COLNAME => array (RbacMenuPeer::MENU_UID => 0, RbacMenuPeer::MENU_CODE => 1, RbacMenuPeer::MENU_INDEX => 2, RbacMenuPeer::MENU_TITLE => 3, RbacMenuPeer::MENU_TYPE => 4, RbacMenuPeer::MENU_DESC => 5, RbacMenuPeer::MENU_PERMISSION => 6, RbacMenuPeer::MENU_URL => 7, RbacMenuPeer::MENU_STATUS => 8, RbacMenuPeer::MENU_PARENT => 9, RbacMenuPeer::CREATE_DATE => 10, RbacMenuPeer::MODIFIED_BY => 11, RbacMenuPeer::MODIFIED_AT => 12, ),
		BasePeer::TYPE_FIELDNAME => array ('MENU_UID' => 0, 'MENU_CODE' => 1, 'MENU_INDEX' => 2, 'MENU_TITLE' => 3, 'MENU_TYPE' => 4, 'MENU_DESC' => 5, 'MENU_PERMISSION' => 6, 'MENU_URL' => 7, 'MENU_STATUS' => 8, 'MENU_PARENT' => 9, 'CREATE_DATE' => 10, 'MODIFIED_BY' => 11, 'MODIFIED_AT' => 12, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'classes/model/map/RbacMenuMapBuilder.php';
		return BasePeer::getMapBuilder('classes.model.map.RbacMenuMapBuilder');
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
			$map = RbacMenuPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. RbacMenuPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(RbacMenuPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(RbacMenuPeer::MENU_UID);

		$criteria->addSelectColumn(RbacMenuPeer::MENU_CODE);

		$criteria->addSelectColumn(RbacMenuPeer::MENU_INDEX);

		$criteria->addSelectColumn(RbacMenuPeer::MENU_TITLE);

		$criteria->addSelectColumn(RbacMenuPeer::MENU_TYPE);

		$criteria->addSelectColumn(RbacMenuPeer::MENU_DESC);

		$criteria->addSelectColumn(RbacMenuPeer::MENU_PERMISSION);

		$criteria->addSelectColumn(RbacMenuPeer::MENU_URL);

		$criteria->addSelectColumn(RbacMenuPeer::MENU_STATUS);

		$criteria->addSelectColumn(RbacMenuPeer::MENU_PARENT);

		$criteria->addSelectColumn(RbacMenuPeer::CREATE_DATE);

		$criteria->addSelectColumn(RbacMenuPeer::MODIFIED_BY);

		$criteria->addSelectColumn(RbacMenuPeer::MODIFIED_AT);

	}

	const COUNT = 'COUNT(RBAC_MENU.MENU_UID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT RBAC_MENU.MENU_UID)';

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
			$criteria->addSelectColumn(RbacMenuPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RbacMenuPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = RbacMenuPeer::doSelectRS($criteria, $con);
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
	 * @return     RbacMenu
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = RbacMenuPeer::doSelect($critcopy, $con);
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
		return RbacMenuPeer::populateObjects(RbacMenuPeer::doSelectRS($criteria, $con));
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
			RbacMenuPeer::addSelectColumns($criteria);
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
		$cls = RbacMenuPeer::getOMClass();
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
		return RbacMenuPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a RbacMenu or Criteria object.
	 *
	 * @param      mixed $values Criteria or RbacMenu object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build Criteria from RbacMenu object
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
	 * Method perform an UPDATE on the database, given a RbacMenu or Criteria object.
	 *
	 * @param      mixed $values Criteria or RbacMenu object containing data that is used to create the UPDATE statement.
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

			$comparison = $criteria->getComparison(RbacMenuPeer::MENU_UID);
			$selectCriteria->add(RbacMenuPeer::MENU_UID, $criteria->remove(RbacMenuPeer::MENU_UID), $comparison);

		} else { // $values is RbacMenu object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the RBAC_MENU table.
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
			$affectedRows += BasePeer::doDeleteAll(RbacMenuPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a RbacMenu or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or RbacMenu object or primary key or array of primary keys
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
			$con = Propel::getConnection(RbacMenuPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof RbacMenu) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(RbacMenuPeer::MENU_UID, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given RbacMenu object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      RbacMenu $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(RbacMenu $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RbacMenuPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RbacMenuPeer::TABLE_NAME);

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

		return BasePeer::doValidate(RbacMenuPeer::DATABASE_NAME, RbacMenuPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      Connection $con the connection to use
	 * @return     RbacMenu
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(RbacMenuPeer::DATABASE_NAME);

		$criteria->add(RbacMenuPeer::MENU_UID, $pk);


		$v = RbacMenuPeer::doSelect($criteria, $con);

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
			$criteria->add(RbacMenuPeer::MENU_UID, $pks, Criteria::IN);
			$objs = RbacMenuPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseRbacMenuPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseRbacMenuPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'classes/model/map/RbacMenuMapBuilder.php';
	Propel::registerMapBuilder('classes.model.map.RbacMenuMapBuilder');
}
