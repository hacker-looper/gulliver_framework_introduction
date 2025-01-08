<?php

require_once 'propel/util/BasePeer.php';
// The object class -- needed for instanceof checks in this class.
// actual class may be a subclass -- as returned by SysMessagePeer::getOMClass()
include_once 'classes/model/SysMessage.php';

/**
 * Base static class for performing query and update operations on the 'SYS_MESSAGE' table.
 *
 * 
 *
 * @package    workflow.classes.model.om
 */
abstract class BaseSysMessagePeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'app';

	/** the table name for this class */
	const TABLE_NAME = 'SYS_MESSAGE';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'classes.model.SysMessage';

	/** The total number of columns. */
	const NUM_COLUMNS = 14;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the MES_UID field */
	const MES_UID = 'SYS_MESSAGE.MES_UID';

	/** the column name for the MES_TO_KEY field */
	const MES_TO_KEY = 'SYS_MESSAGE.MES_TO_KEY';

	/** the column name for the MES_TO_VALUE field */
	const MES_TO_VALUE = 'SYS_MESSAGE.MES_TO_VALUE';

	/** the column name for the MES_TYPE_KEY field */
	const MES_TYPE_KEY = 'SYS_MESSAGE.MES_TYPE_KEY';

	/** the column name for the MES_TYPE_VALUE field */
	const MES_TYPE_VALUE = 'SYS_MESSAGE.MES_TYPE_VALUE';

	/** the column name for the MES_TITLE field */
	const MES_TITLE = 'SYS_MESSAGE.MES_TITLE';

	/** the column name for the MES_BODY field */
	const MES_BODY = 'SYS_MESSAGE.MES_BODY';

	/** the column name for the MES_SOURCE field */
	const MES_SOURCE = 'SYS_MESSAGE.MES_SOURCE';

	/** the column name for the MES_PUBLISH_STATUS field */
	const MES_PUBLISH_STATUS = 'SYS_MESSAGE.MES_PUBLISH_STATUS';

	/** the column name for the MES_PUBLISH_DATE field */
	const MES_PUBLISH_DATE = 'SYS_MESSAGE.MES_PUBLISH_DATE';

	/** the column name for the MES_FROM_USER field */
	const MES_FROM_USER = 'SYS_MESSAGE.MES_FROM_USER';

	/** the column name for the CREATE_DATE field */
	const CREATE_DATE = 'SYS_MESSAGE.CREATE_DATE';

	/** the column name for the MODIFIED_BY field */
	const MODIFIED_BY = 'SYS_MESSAGE.MODIFIED_BY';

	/** the column name for the MODIFIED_AT field */
	const MODIFIED_AT = 'SYS_MESSAGE.MODIFIED_AT';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('MesUid', 'MesToKey', 'MesToValue', 'MesTypeKey', 'MesTypeValue', 'MesTitle', 'MesBody', 'MesSource', 'MesPublishStatus', 'MesPublishDate', 'MesFromUser', 'CreateDate', 'ModifiedBy', 'ModifiedAt', ),
		BasePeer::TYPE_COLNAME => array (SysMessagePeer::MES_UID, SysMessagePeer::MES_TO_KEY, SysMessagePeer::MES_TO_VALUE, SysMessagePeer::MES_TYPE_KEY, SysMessagePeer::MES_TYPE_VALUE, SysMessagePeer::MES_TITLE, SysMessagePeer::MES_BODY, SysMessagePeer::MES_SOURCE, SysMessagePeer::MES_PUBLISH_STATUS, SysMessagePeer::MES_PUBLISH_DATE, SysMessagePeer::MES_FROM_USER, SysMessagePeer::CREATE_DATE, SysMessagePeer::MODIFIED_BY, SysMessagePeer::MODIFIED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('MES_UID', 'MES_TO_KEY', 'MES_TO_VALUE', 'MES_TYPE_KEY', 'MES_TYPE_VALUE', 'MES_TITLE', 'MES_BODY', 'MES_SOURCE', 'MES_PUBLISH_STATUS', 'MES_PUBLISH_DATE', 'MES_FROM_USER', 'CREATE_DATE', 'MODIFIED_BY', 'MODIFIED_AT', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('MesUid' => 0, 'MesToKey' => 1, 'MesToValue' => 2, 'MesTypeKey' => 3, 'MesTypeValue' => 4, 'MesTitle' => 5, 'MesBody' => 6, 'MesSource' => 7, 'MesPublishStatus' => 8, 'MesPublishDate' => 9, 'MesFromUser' => 10, 'CreateDate' => 11, 'ModifiedBy' => 12, 'ModifiedAt' => 13, ),
		BasePeer::TYPE_COLNAME => array (SysMessagePeer::MES_UID => 0, SysMessagePeer::MES_TO_KEY => 1, SysMessagePeer::MES_TO_VALUE => 2, SysMessagePeer::MES_TYPE_KEY => 3, SysMessagePeer::MES_TYPE_VALUE => 4, SysMessagePeer::MES_TITLE => 5, SysMessagePeer::MES_BODY => 6, SysMessagePeer::MES_SOURCE => 7, SysMessagePeer::MES_PUBLISH_STATUS => 8, SysMessagePeer::MES_PUBLISH_DATE => 9, SysMessagePeer::MES_FROM_USER => 10, SysMessagePeer::CREATE_DATE => 11, SysMessagePeer::MODIFIED_BY => 12, SysMessagePeer::MODIFIED_AT => 13, ),
		BasePeer::TYPE_FIELDNAME => array ('MES_UID' => 0, 'MES_TO_KEY' => 1, 'MES_TO_VALUE' => 2, 'MES_TYPE_KEY' => 3, 'MES_TYPE_VALUE' => 4, 'MES_TITLE' => 5, 'MES_BODY' => 6, 'MES_SOURCE' => 7, 'MES_PUBLISH_STATUS' => 8, 'MES_PUBLISH_DATE' => 9, 'MES_FROM_USER' => 10, 'CREATE_DATE' => 11, 'MODIFIED_BY' => 12, 'MODIFIED_AT' => 13, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'classes/model/map/SysMessageMapBuilder.php';
		return BasePeer::getMapBuilder('classes.model.map.SysMessageMapBuilder');
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
			$map = SysMessagePeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. SysMessagePeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(SysMessagePeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(SysMessagePeer::MES_UID);

		$criteria->addSelectColumn(SysMessagePeer::MES_TO_KEY);

		$criteria->addSelectColumn(SysMessagePeer::MES_TO_VALUE);

		$criteria->addSelectColumn(SysMessagePeer::MES_TYPE_KEY);

		$criteria->addSelectColumn(SysMessagePeer::MES_TYPE_VALUE);

		$criteria->addSelectColumn(SysMessagePeer::MES_TITLE);

		$criteria->addSelectColumn(SysMessagePeer::MES_BODY);

		$criteria->addSelectColumn(SysMessagePeer::MES_SOURCE);

		$criteria->addSelectColumn(SysMessagePeer::MES_PUBLISH_STATUS);

		$criteria->addSelectColumn(SysMessagePeer::MES_PUBLISH_DATE);

		$criteria->addSelectColumn(SysMessagePeer::MES_FROM_USER);

		$criteria->addSelectColumn(SysMessagePeer::CREATE_DATE);

		$criteria->addSelectColumn(SysMessagePeer::MODIFIED_BY);

		$criteria->addSelectColumn(SysMessagePeer::MODIFIED_AT);

	}

	const COUNT = 'COUNT(SYS_MESSAGE.MES_UID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT SYS_MESSAGE.MES_UID)';

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
			$criteria->addSelectColumn(SysMessagePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SysMessagePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SysMessagePeer::doSelectRS($criteria, $con);
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
	 * @return     SysMessage
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = SysMessagePeer::doSelect($critcopy, $con);
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
		return SysMessagePeer::populateObjects(SysMessagePeer::doSelectRS($criteria, $con));
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
			SysMessagePeer::addSelectColumns($criteria);
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
		$cls = SysMessagePeer::getOMClass();
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
		return SysMessagePeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a SysMessage or Criteria object.
	 *
	 * @param      mixed $values Criteria or SysMessage object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build Criteria from SysMessage object
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
	 * Method perform an UPDATE on the database, given a SysMessage or Criteria object.
	 *
	 * @param      mixed $values Criteria or SysMessage object containing data that is used to create the UPDATE statement.
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

			$comparison = $criteria->getComparison(SysMessagePeer::MES_UID);
			$selectCriteria->add(SysMessagePeer::MES_UID, $criteria->remove(SysMessagePeer::MES_UID), $comparison);

		} else { // $values is SysMessage object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the SYS_MESSAGE table.
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
			$affectedRows += BasePeer::doDeleteAll(SysMessagePeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a SysMessage or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or SysMessage object or primary key or array of primary keys
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
			$con = Propel::getConnection(SysMessagePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof SysMessage) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(SysMessagePeer::MES_UID, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given SysMessage object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      SysMessage $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(SysMessage $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SysMessagePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SysMessagePeer::TABLE_NAME);

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

		return BasePeer::doValidate(SysMessagePeer::DATABASE_NAME, SysMessagePeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      Connection $con the connection to use
	 * @return     SysMessage
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(SysMessagePeer::DATABASE_NAME);

		$criteria->add(SysMessagePeer::MES_UID, $pk);


		$v = SysMessagePeer::doSelect($criteria, $con);

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
			$criteria->add(SysMessagePeer::MES_UID, $pks, Criteria::IN);
			$objs = SysMessagePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseSysMessagePeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseSysMessagePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'classes/model/map/SysMessageMapBuilder.php';
	Propel::registerMapBuilder('classes.model.map.SysMessageMapBuilder');
}
