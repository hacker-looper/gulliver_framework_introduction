<?php

require_once 'propel/util/BasePeer.php';
// The object class -- needed for instanceof checks in this class.
// actual class may be a subclass -- as returned by RbacUserPeer::getOMClass()
include_once 'classes/model/RbacUser.php';

/**
 * Base static class for performing query and update operations on the 'RBAC_USER' table.
 *
 * 
 *
 * @package    workflow.classes.model.om
 */
abstract class BaseRbacUserPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'app';

	/** the table name for this class */
	const TABLE_NAME = 'RBAC_USER';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'classes.model.RbacUser';

	/** The total number of columns. */
	const NUM_COLUMNS = 28;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the USR_UID field */
	const USR_UID = 'RBAC_USER.USR_UID';

	/** the column name for the USR_USERNAME field */
	const USR_USERNAME = 'RBAC_USER.USR_USERNAME';

	/** the column name for the USR_PASSWORD field */
	const USR_PASSWORD = 'RBAC_USER.USR_PASSWORD';

	/** the column name for the USR_FULLNAME field */
	const USR_FULLNAME = 'RBAC_USER.USR_FULLNAME';

	/** the column name for the USR_NICKNAME field */
	const USR_NICKNAME = 'RBAC_USER.USR_NICKNAME';

	/** the column name for the USR_NICKNAME_ISUSE field */
	const USR_NICKNAME_ISUSE = 'RBAC_USER.USR_NICKNAME_ISUSE';

	/** the column name for the USR_SEX field */
	const USR_SEX = 'RBAC_USER.USR_SEX';

	/** the column name for the USR_EMAIL field */
	const USR_EMAIL = 'RBAC_USER.USR_EMAIL';

	/** the column name for the USR_PHONE field */
	const USR_PHONE = 'RBAC_USER.USR_PHONE';

	/** the column name for the USR_ROLES field */
	const USR_ROLES = 'RBAC_USER.USR_ROLES';

	/** the column name for the USR_REMEMBER_TOKEN field */
	const USR_REMEMBER_TOKEN = 'RBAC_USER.USR_REMEMBER_TOKEN';

	/** the column name for the USR_STATUS field */
	const USR_STATUS = 'RBAC_USER.USR_STATUS';

	/** the column name for the USR_IMAGE field */
	const USR_IMAGE = 'RBAC_USER.USR_IMAGE';

	/** the column name for the USR_SELFDESC field */
	const USR_SELFDESC = 'RBAC_USER.USR_SELFDESC';

	/** the column name for the USR_ADDRESS field */
	const USR_ADDRESS = 'RBAC_USER.USR_ADDRESS';

	/** the column name for the USR_SNS_WECHAT field */
	const USR_SNS_WECHAT = 'RBAC_USER.USR_SNS_WECHAT';

	/** the column name for the USR_SNS_WEIBO field */
	const USR_SNS_WEIBO = 'RBAC_USER.USR_SNS_WEIBO';

	/** the column name for the USR_SNS_QQ field */
	const USR_SNS_QQ = 'RBAC_USER.USR_SNS_QQ';

	/** the column name for the USR_GOAL field */
	const USR_GOAL = 'RBAC_USER.USR_GOAL';

	/** the column name for the USR_LEVEL field */
	const USR_LEVEL = 'RBAC_USER.USR_LEVEL';

	/** the column name for the USR_COIN field */
	const USR_COIN = 'RBAC_USER.USR_COIN';

	/** the column name for the USR_EXPIRE_DATE field */
	const USR_EXPIRE_DATE = 'RBAC_USER.USR_EXPIRE_DATE';

	/** the column name for the USR_ACCOUNT_BALANCE field */
	const USR_ACCOUNT_BALANCE = 'RBAC_USER.USR_ACCOUNT_BALANCE';

	/** the column name for the USR_API_KEY field */
	const USR_API_KEY = 'RBAC_USER.USR_API_KEY';

	/** the column name for the USR_LASTLOGIN field */
	const USR_LASTLOGIN = 'RBAC_USER.USR_LASTLOGIN';

	/** the column name for the CREATE_DATE field */
	const CREATE_DATE = 'RBAC_USER.CREATE_DATE';

	/** the column name for the MODIFIED_BY field */
	const MODIFIED_BY = 'RBAC_USER.MODIFIED_BY';

	/** the column name for the MODIFIED_AT field */
	const MODIFIED_AT = 'RBAC_USER.MODIFIED_AT';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('UsrUid', 'UsrUsername', 'UsrPassword', 'UsrFullname', 'UsrNickname', 'UsrNicknameIsuse', 'UsrSex', 'UsrEmail', 'UsrPhone', 'UsrRoles', 'UsrRememberToken', 'UsrStatus', 'UsrImage', 'UsrSelfdesc', 'UsrAddress', 'UsrSnsWechat', 'UsrSnsWeibo', 'UsrSnsQq', 'UsrGoal', 'UsrLevel', 'UsrCoin', 'UsrExpireDate', 'UsrAccountBalance', 'UsrApiKey', 'UsrLastlogin', 'CreateDate', 'ModifiedBy', 'ModifiedAt', ),
		BasePeer::TYPE_COLNAME => array (RbacUserPeer::USR_UID, RbacUserPeer::USR_USERNAME, RbacUserPeer::USR_PASSWORD, RbacUserPeer::USR_FULLNAME, RbacUserPeer::USR_NICKNAME, RbacUserPeer::USR_NICKNAME_ISUSE, RbacUserPeer::USR_SEX, RbacUserPeer::USR_EMAIL, RbacUserPeer::USR_PHONE, RbacUserPeer::USR_ROLES, RbacUserPeer::USR_REMEMBER_TOKEN, RbacUserPeer::USR_STATUS, RbacUserPeer::USR_IMAGE, RbacUserPeer::USR_SELFDESC, RbacUserPeer::USR_ADDRESS, RbacUserPeer::USR_SNS_WECHAT, RbacUserPeer::USR_SNS_WEIBO, RbacUserPeer::USR_SNS_QQ, RbacUserPeer::USR_GOAL, RbacUserPeer::USR_LEVEL, RbacUserPeer::USR_COIN, RbacUserPeer::USR_EXPIRE_DATE, RbacUserPeer::USR_ACCOUNT_BALANCE, RbacUserPeer::USR_API_KEY, RbacUserPeer::USR_LASTLOGIN, RbacUserPeer::CREATE_DATE, RbacUserPeer::MODIFIED_BY, RbacUserPeer::MODIFIED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('USR_UID', 'USR_USERNAME', 'USR_PASSWORD', 'USR_FULLNAME', 'USR_NICKNAME', 'USR_NICKNAME_ISUSE', 'USR_SEX', 'USR_EMAIL', 'USR_PHONE', 'USR_ROLES', 'USR_REMEMBER_TOKEN', 'USR_STATUS', 'USR_IMAGE', 'USR_SELFDESC', 'USR_ADDRESS', 'USR_SNS_WECHAT', 'USR_SNS_WEIBO', 'USR_SNS_QQ', 'USR_GOAL', 'USR_LEVEL', 'USR_COIN', 'USR_EXPIRE_DATE', 'USR_ACCOUNT_BALANCE', 'USR_API_KEY', 'USR_LASTLOGIN', 'CREATE_DATE', 'MODIFIED_BY', 'MODIFIED_AT', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('UsrUid' => 0, 'UsrUsername' => 1, 'UsrPassword' => 2, 'UsrFullname' => 3, 'UsrNickname' => 4, 'UsrNicknameIsuse' => 5, 'UsrSex' => 6, 'UsrEmail' => 7, 'UsrPhone' => 8, 'UsrRoles' => 9, 'UsrRememberToken' => 10, 'UsrStatus' => 11, 'UsrImage' => 12, 'UsrSelfdesc' => 13, 'UsrAddress' => 14, 'UsrSnsWechat' => 15, 'UsrSnsWeibo' => 16, 'UsrSnsQq' => 17, 'UsrGoal' => 18, 'UsrLevel' => 19, 'UsrCoin' => 20, 'UsrExpireDate' => 21, 'UsrAccountBalance' => 22, 'UsrApiKey' => 23, 'UsrLastlogin' => 24, 'CreateDate' => 25, 'ModifiedBy' => 26, 'ModifiedAt' => 27, ),
		BasePeer::TYPE_COLNAME => array (RbacUserPeer::USR_UID => 0, RbacUserPeer::USR_USERNAME => 1, RbacUserPeer::USR_PASSWORD => 2, RbacUserPeer::USR_FULLNAME => 3, RbacUserPeer::USR_NICKNAME => 4, RbacUserPeer::USR_NICKNAME_ISUSE => 5, RbacUserPeer::USR_SEX => 6, RbacUserPeer::USR_EMAIL => 7, RbacUserPeer::USR_PHONE => 8, RbacUserPeer::USR_ROLES => 9, RbacUserPeer::USR_REMEMBER_TOKEN => 10, RbacUserPeer::USR_STATUS => 11, RbacUserPeer::USR_IMAGE => 12, RbacUserPeer::USR_SELFDESC => 13, RbacUserPeer::USR_ADDRESS => 14, RbacUserPeer::USR_SNS_WECHAT => 15, RbacUserPeer::USR_SNS_WEIBO => 16, RbacUserPeer::USR_SNS_QQ => 17, RbacUserPeer::USR_GOAL => 18, RbacUserPeer::USR_LEVEL => 19, RbacUserPeer::USR_COIN => 20, RbacUserPeer::USR_EXPIRE_DATE => 21, RbacUserPeer::USR_ACCOUNT_BALANCE => 22, RbacUserPeer::USR_API_KEY => 23, RbacUserPeer::USR_LASTLOGIN => 24, RbacUserPeer::CREATE_DATE => 25, RbacUserPeer::MODIFIED_BY => 26, RbacUserPeer::MODIFIED_AT => 27, ),
		BasePeer::TYPE_FIELDNAME => array ('USR_UID' => 0, 'USR_USERNAME' => 1, 'USR_PASSWORD' => 2, 'USR_FULLNAME' => 3, 'USR_NICKNAME' => 4, 'USR_NICKNAME_ISUSE' => 5, 'USR_SEX' => 6, 'USR_EMAIL' => 7, 'USR_PHONE' => 8, 'USR_ROLES' => 9, 'USR_REMEMBER_TOKEN' => 10, 'USR_STATUS' => 11, 'USR_IMAGE' => 12, 'USR_SELFDESC' => 13, 'USR_ADDRESS' => 14, 'USR_SNS_WECHAT' => 15, 'USR_SNS_WEIBO' => 16, 'USR_SNS_QQ' => 17, 'USR_GOAL' => 18, 'USR_LEVEL' => 19, 'USR_COIN' => 20, 'USR_EXPIRE_DATE' => 21, 'USR_ACCOUNT_BALANCE' => 22, 'USR_API_KEY' => 23, 'USR_LASTLOGIN' => 24, 'CREATE_DATE' => 25, 'MODIFIED_BY' => 26, 'MODIFIED_AT' => 27, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'classes/model/map/RbacUserMapBuilder.php';
		return BasePeer::getMapBuilder('classes.model.map.RbacUserMapBuilder');
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
			$map = RbacUserPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. RbacUserPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(RbacUserPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(RbacUserPeer::USR_UID);

		$criteria->addSelectColumn(RbacUserPeer::USR_USERNAME);

		$criteria->addSelectColumn(RbacUserPeer::USR_PASSWORD);

		$criteria->addSelectColumn(RbacUserPeer::USR_FULLNAME);

		$criteria->addSelectColumn(RbacUserPeer::USR_NICKNAME);

		$criteria->addSelectColumn(RbacUserPeer::USR_NICKNAME_ISUSE);

		$criteria->addSelectColumn(RbacUserPeer::USR_SEX);

		$criteria->addSelectColumn(RbacUserPeer::USR_EMAIL);

		$criteria->addSelectColumn(RbacUserPeer::USR_PHONE);

		$criteria->addSelectColumn(RbacUserPeer::USR_ROLES);

		$criteria->addSelectColumn(RbacUserPeer::USR_REMEMBER_TOKEN);

		$criteria->addSelectColumn(RbacUserPeer::USR_STATUS);

		$criteria->addSelectColumn(RbacUserPeer::USR_IMAGE);

		$criteria->addSelectColumn(RbacUserPeer::USR_SELFDESC);

		$criteria->addSelectColumn(RbacUserPeer::USR_ADDRESS);

		$criteria->addSelectColumn(RbacUserPeer::USR_SNS_WECHAT);

		$criteria->addSelectColumn(RbacUserPeer::USR_SNS_WEIBO);

		$criteria->addSelectColumn(RbacUserPeer::USR_SNS_QQ);

		$criteria->addSelectColumn(RbacUserPeer::USR_GOAL);

		$criteria->addSelectColumn(RbacUserPeer::USR_LEVEL);

		$criteria->addSelectColumn(RbacUserPeer::USR_COIN);

		$criteria->addSelectColumn(RbacUserPeer::USR_EXPIRE_DATE);

		$criteria->addSelectColumn(RbacUserPeer::USR_ACCOUNT_BALANCE);

		$criteria->addSelectColumn(RbacUserPeer::USR_API_KEY);

		$criteria->addSelectColumn(RbacUserPeer::USR_LASTLOGIN);

		$criteria->addSelectColumn(RbacUserPeer::CREATE_DATE);

		$criteria->addSelectColumn(RbacUserPeer::MODIFIED_BY);

		$criteria->addSelectColumn(RbacUserPeer::MODIFIED_AT);

	}

	const COUNT = 'COUNT(RBAC_USER.USR_UID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT RBAC_USER.USR_UID)';

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
			$criteria->addSelectColumn(RbacUserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RbacUserPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = RbacUserPeer::doSelectRS($criteria, $con);
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
	 * @return     RbacUser
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = RbacUserPeer::doSelect($critcopy, $con);
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
		return RbacUserPeer::populateObjects(RbacUserPeer::doSelectRS($criteria, $con));
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
			RbacUserPeer::addSelectColumns($criteria);
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
		$cls = RbacUserPeer::getOMClass();
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
		return RbacUserPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a RbacUser or Criteria object.
	 *
	 * @param      mixed $values Criteria or RbacUser object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build Criteria from RbacUser object
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
	 * Method perform an UPDATE on the database, given a RbacUser or Criteria object.
	 *
	 * @param      mixed $values Criteria or RbacUser object containing data that is used to create the UPDATE statement.
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

			$comparison = $criteria->getComparison(RbacUserPeer::USR_UID);
			$selectCriteria->add(RbacUserPeer::USR_UID, $criteria->remove(RbacUserPeer::USR_UID), $comparison);

		} else { // $values is RbacUser object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the RBAC_USER table.
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
			$affectedRows += BasePeer::doDeleteAll(RbacUserPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a RbacUser or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or RbacUser object or primary key or array of primary keys
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
			$con = Propel::getConnection(RbacUserPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof RbacUser) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(RbacUserPeer::USR_UID, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given RbacUser object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      RbacUser $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(RbacUser $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RbacUserPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RbacUserPeer::TABLE_NAME);

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

		return BasePeer::doValidate(RbacUserPeer::DATABASE_NAME, RbacUserPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      Connection $con the connection to use
	 * @return     RbacUser
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(RbacUserPeer::DATABASE_NAME);

		$criteria->add(RbacUserPeer::USR_UID, $pk);


		$v = RbacUserPeer::doSelect($criteria, $con);

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
			$criteria->add(RbacUserPeer::USR_UID, $pks, Criteria::IN);
			$objs = RbacUserPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseRbacUserPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseRbacUserPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'classes/model/map/RbacUserMapBuilder.php';
	Propel::registerMapBuilder('classes.model.map.RbacUserMapBuilder');
}
