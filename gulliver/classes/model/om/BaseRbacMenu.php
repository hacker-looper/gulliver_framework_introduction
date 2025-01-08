<?php

require_once 'propel/om/BaseObject.php';

require_once 'propel/om/Persistent.php';


include_once 'propel/util/Criteria.php';

include_once 'classes/model/RbacMenuPeer.php';

/**
 * Base class that represents a row from the 'RBAC_MENU' table.
 *
 * 
 *
 * @package    workflow.classes.model.om
 */
abstract class BaseRbacMenu extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        RbacMenuPeer
	 */
	protected static $peer;


	/**
	 * The value for the menu_uid field.
	 * @var        string
	 */
	protected $menu_uid = '';


	/**
	 * The value for the menu_code field.
	 * @var        string
	 */
	protected $menu_code = '';


	/**
	 * The value for the menu_index field.
	 * @var        int
	 */
	protected $menu_index = 0;


	/**
	 * The value for the menu_title field.
	 * @var        string
	 */
	protected $menu_title = '';


	/**
	 * The value for the menu_type field.
	 * @var        string
	 */
	protected $menu_type = '0';


	/**
	 * The value for the menu_desc field.
	 * @var        string
	 */
	protected $menu_desc;


	/**
	 * The value for the menu_permission field.
	 * @var        string
	 */
	protected $menu_permission;


	/**
	 * The value for the menu_url field.
	 * @var        string
	 */
	protected $menu_url = '';


	/**
	 * The value for the menu_status field.
	 * @var        string
	 */
	protected $menu_status = '0';


	/**
	 * The value for the menu_parent field.
	 * @var        string
	 */
	protected $menu_parent = '';


	/**
	 * The value for the create_date field.
	 * @var        int
	 */
	protected $create_date;


	/**
	 * The value for the modified_by field.
	 * @var        string
	 */
	protected $modified_by = '';


	/**
	 * The value for the modified_at field.
	 * @var        int
	 */
	protected $modified_at;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Get the [menu_uid] column value.
	 * 
	 * @return     string
	 */
	public function getMenuUid()
	{

		return $this->menu_uid;
	}

	/**
	 * Get the [menu_code] column value.
	 * 
	 * @return     string
	 */
	public function getMenuCode()
	{

		return $this->menu_code;
	}

	/**
	 * Get the [menu_index] column value.
	 * 
	 * @return     int
	 */
	public function getMenuIndex()
	{

		return $this->menu_index;
	}

	/**
	 * Get the [menu_title] column value.
	 * 
	 * @return     string
	 */
	public function getMenuTitle()
	{

		return $this->menu_title;
	}

	/**
	 * Get the [menu_type] column value.
	 * 
	 * @return     string
	 */
	public function getMenuType()
	{

		return $this->menu_type;
	}

	/**
	 * Get the [menu_desc] column value.
	 * 
	 * @return     string
	 */
	public function getMenuDesc()
	{

		return $this->menu_desc;
	}

	/**
	 * Get the [menu_permission] column value.
	 * 
	 * @return     string
	 */
	public function getMenuPermission()
	{

		return $this->menu_permission;
	}

	/**
	 * Get the [menu_url] column value.
	 * 
	 * @return     string
	 */
	public function getMenuUrl()
	{

		return $this->menu_url;
	}

	/**
	 * Get the [menu_status] column value.
	 * 
	 * @return     string
	 */
	public function getMenuStatus()
	{

		return $this->menu_status;
	}

	/**
	 * Get the [menu_parent] column value.
	 * 
	 * @return     string
	 */
	public function getMenuParent()
	{

		return $this->menu_parent;
	}

	/**
	 * Get the [optionally formatted] [create_date] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCreateDate($format = 'Y-m-d H:i:s')
	{

		if ($this->create_date === null || $this->create_date === '') {
			return null;
		} elseif (!is_int($this->create_date)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->create_date);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [create_date] as date/time value: " . var_export($this->create_date, true));
			}
		} else {
			$ts = $this->create_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	/**
	 * Get the [modified_by] column value.
	 * 
	 * @return     string
	 */
	public function getModifiedBy()
	{

		return $this->modified_by;
	}

	/**
	 * Get the [optionally formatted] [modified_at] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getModifiedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->modified_at === null || $this->modified_at === '') {
			return null;
		} elseif (!is_int($this->modified_at)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->modified_at);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [modified_at] as date/time value: " . var_export($this->modified_at, true));
			}
		} else {
			$ts = $this->modified_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	/**
	 * Set the value of [menu_uid] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setMenuUid($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->menu_uid !== $v || $v === '') {
			$this->menu_uid = $v;
			$this->modifiedColumns[] = RbacMenuPeer::MENU_UID;
		}

	} // setMenuUid()

	/**
	 * Set the value of [menu_code] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setMenuCode($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->menu_code !== $v || $v === '') {
			$this->menu_code = $v;
			$this->modifiedColumns[] = RbacMenuPeer::MENU_CODE;
		}

	} // setMenuCode()

	/**
	 * Set the value of [menu_index] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setMenuIndex($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->menu_index !== $v || $v === 0) {
			$this->menu_index = $v;
			$this->modifiedColumns[] = RbacMenuPeer::MENU_INDEX;
		}

	} // setMenuIndex()

	/**
	 * Set the value of [menu_title] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setMenuTitle($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->menu_title !== $v || $v === '') {
			$this->menu_title = $v;
			$this->modifiedColumns[] = RbacMenuPeer::MENU_TITLE;
		}

	} // setMenuTitle()

	/**
	 * Set the value of [menu_type] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setMenuType($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->menu_type !== $v || $v === '0') {
			$this->menu_type = $v;
			$this->modifiedColumns[] = RbacMenuPeer::MENU_TYPE;
		}

	} // setMenuType()

	/**
	 * Set the value of [menu_desc] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setMenuDesc($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->menu_desc !== $v) {
			$this->menu_desc = $v;
			$this->modifiedColumns[] = RbacMenuPeer::MENU_DESC;
		}

	} // setMenuDesc()

	/**
	 * Set the value of [menu_permission] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setMenuPermission($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->menu_permission !== $v) {
			$this->menu_permission = $v;
			$this->modifiedColumns[] = RbacMenuPeer::MENU_PERMISSION;
		}

	} // setMenuPermission()

	/**
	 * Set the value of [menu_url] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setMenuUrl($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->menu_url !== $v || $v === '') {
			$this->menu_url = $v;
			$this->modifiedColumns[] = RbacMenuPeer::MENU_URL;
		}

	} // setMenuUrl()

	/**
	 * Set the value of [menu_status] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setMenuStatus($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->menu_status !== $v || $v === '0') {
			$this->menu_status = $v;
			$this->modifiedColumns[] = RbacMenuPeer::MENU_STATUS;
		}

	} // setMenuStatus()

	/**
	 * Set the value of [menu_parent] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setMenuParent($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->menu_parent !== $v || $v === '') {
			$this->menu_parent = $v;
			$this->modifiedColumns[] = RbacMenuPeer::MENU_PARENT;
		}

	} // setMenuParent()

	/**
	 * Set the value of [create_date] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCreateDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [create_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->create_date !== $ts) {
			$this->create_date = $ts;
			$this->modifiedColumns[] = RbacMenuPeer::CREATE_DATE;
		}

	} // setCreateDate()

	/**
	 * Set the value of [modified_by] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setModifiedBy($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->modified_by !== $v || $v === '') {
			$this->modified_by = $v;
			$this->modifiedColumns[] = RbacMenuPeer::MODIFIED_BY;
		}

	} // setModifiedBy()

	/**
	 * Set the value of [modified_at] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setModifiedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [modified_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->modified_at !== $ts) {
			$this->modified_at = $ts;
			$this->modifiedColumns[] = RbacMenuPeer::MODIFIED_AT;
		}

	} // setModifiedAt()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (1-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      ResultSet $rs The ResultSet class with cursor advanced to desired record pos.
	 * @param      int $startcol 1-based offset column which indicates which restultset column to start with.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->menu_uid = $rs->getString($startcol + 0);

			$this->menu_code = $rs->getString($startcol + 1);

			$this->menu_index = $rs->getInt($startcol + 2);

			$this->menu_title = $rs->getString($startcol + 3);

			$this->menu_type = $rs->getString($startcol + 4);

			$this->menu_desc = $rs->getString($startcol + 5);

			$this->menu_permission = $rs->getString($startcol + 6);

			$this->menu_url = $rs->getString($startcol + 7);

			$this->menu_status = $rs->getString($startcol + 8);

			$this->menu_parent = $rs->getString($startcol + 9);

			$this->create_date = $rs->getTimestamp($startcol + 10, null);

			$this->modified_by = $rs->getString($startcol + 11);

			$this->modified_at = $rs->getTimestamp($startcol + 12, null);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 13; // 13 = RbacMenuPeer::NUM_COLUMNS - RbacMenuPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating RbacMenu object", $e);
		}
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      Connection $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RbacMenuPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RbacMenuPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Stores the object in the database.  If the object is new,
	 * it inserts it; otherwise an update is performed.  This method
	 * wraps the doSave() worker method in a transaction.
	 *
	 * @param      Connection $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RbacMenuPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Stores the object in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      Connection $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave($con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RbacMenuPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += RbacMenuPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = RbacMenuPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RbacMenuPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getMenuUid();
				break;
			case 1:
				return $this->getMenuCode();
				break;
			case 2:
				return $this->getMenuIndex();
				break;
			case 3:
				return $this->getMenuTitle();
				break;
			case 4:
				return $this->getMenuType();
				break;
			case 5:
				return $this->getMenuDesc();
				break;
			case 6:
				return $this->getMenuPermission();
				break;
			case 7:
				return $this->getMenuUrl();
				break;
			case 8:
				return $this->getMenuStatus();
				break;
			case 9:
				return $this->getMenuParent();
				break;
			case 10:
				return $this->getCreateDate();
				break;
			case 11:
				return $this->getModifiedBy();
				break;
			case 12:
				return $this->getModifiedAt();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param      string $keyType One of the class type constants TYPE_PHPNAME,
	 *                        TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RbacMenuPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getMenuUid(),
			$keys[1] => $this->getMenuCode(),
			$keys[2] => $this->getMenuIndex(),
			$keys[3] => $this->getMenuTitle(),
			$keys[4] => $this->getMenuType(),
			$keys[5] => $this->getMenuDesc(),
			$keys[6] => $this->getMenuPermission(),
			$keys[7] => $this->getMenuUrl(),
			$keys[8] => $this->getMenuStatus(),
			$keys[9] => $this->getMenuParent(),
			$keys[10] => $this->getCreateDate(),
			$keys[11] => $this->getModifiedBy(),
			$keys[12] => $this->getModifiedAt(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RbacMenuPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setMenuUid($value);
				break;
			case 1:
				$this->setMenuCode($value);
				break;
			case 2:
				$this->setMenuIndex($value);
				break;
			case 3:
				$this->setMenuTitle($value);
				break;
			case 4:
				$this->setMenuType($value);
				break;
			case 5:
				$this->setMenuDesc($value);
				break;
			case 6:
				$this->setMenuPermission($value);
				break;
			case 7:
				$this->setMenuUrl($value);
				break;
			case 8:
				$this->setMenuStatus($value);
				break;
			case 9:
				$this->setMenuParent($value);
				break;
			case 10:
				$this->setCreateDate($value);
				break;
			case 11:
				$this->setModifiedBy($value);
				break;
			case 12:
				$this->setModifiedAt($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME,
	 * TYPE_NUM. The default key type is the column's phpname (e.g. 'authorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RbacMenuPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setMenuUid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setMenuCode($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setMenuIndex($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setMenuTitle($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setMenuType($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setMenuDesc($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setMenuPermission($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setMenuUrl($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setMenuStatus($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setMenuParent($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCreateDate($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setModifiedBy($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setModifiedAt($arr[$keys[12]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(RbacMenuPeer::DATABASE_NAME);

		if ($this->isColumnModified(RbacMenuPeer::MENU_UID)) $criteria->add(RbacMenuPeer::MENU_UID, $this->menu_uid);
		if ($this->isColumnModified(RbacMenuPeer::MENU_CODE)) $criteria->add(RbacMenuPeer::MENU_CODE, $this->menu_code);
		if ($this->isColumnModified(RbacMenuPeer::MENU_INDEX)) $criteria->add(RbacMenuPeer::MENU_INDEX, $this->menu_index);
		if ($this->isColumnModified(RbacMenuPeer::MENU_TITLE)) $criteria->add(RbacMenuPeer::MENU_TITLE, $this->menu_title);
		if ($this->isColumnModified(RbacMenuPeer::MENU_TYPE)) $criteria->add(RbacMenuPeer::MENU_TYPE, $this->menu_type);
		if ($this->isColumnModified(RbacMenuPeer::MENU_DESC)) $criteria->add(RbacMenuPeer::MENU_DESC, $this->menu_desc);
		if ($this->isColumnModified(RbacMenuPeer::MENU_PERMISSION)) $criteria->add(RbacMenuPeer::MENU_PERMISSION, $this->menu_permission);
		if ($this->isColumnModified(RbacMenuPeer::MENU_URL)) $criteria->add(RbacMenuPeer::MENU_URL, $this->menu_url);
		if ($this->isColumnModified(RbacMenuPeer::MENU_STATUS)) $criteria->add(RbacMenuPeer::MENU_STATUS, $this->menu_status);
		if ($this->isColumnModified(RbacMenuPeer::MENU_PARENT)) $criteria->add(RbacMenuPeer::MENU_PARENT, $this->menu_parent);
		if ($this->isColumnModified(RbacMenuPeer::CREATE_DATE)) $criteria->add(RbacMenuPeer::CREATE_DATE, $this->create_date);
		if ($this->isColumnModified(RbacMenuPeer::MODIFIED_BY)) $criteria->add(RbacMenuPeer::MODIFIED_BY, $this->modified_by);
		if ($this->isColumnModified(RbacMenuPeer::MODIFIED_AT)) $criteria->add(RbacMenuPeer::MODIFIED_AT, $this->modified_at);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RbacMenuPeer::DATABASE_NAME);

		$criteria->add(RbacMenuPeer::MENU_UID, $this->menu_uid);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getMenuUid();
	}

	/**
	 * Generic method to set the primary key (menu_uid column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setMenuUid($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of RbacMenu (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setMenuCode($this->menu_code);

		$copyObj->setMenuIndex($this->menu_index);

		$copyObj->setMenuTitle($this->menu_title);

		$copyObj->setMenuType($this->menu_type);

		$copyObj->setMenuDesc($this->menu_desc);

		$copyObj->setMenuPermission($this->menu_permission);

		$copyObj->setMenuUrl($this->menu_url);

		$copyObj->setMenuStatus($this->menu_status);

		$copyObj->setMenuParent($this->menu_parent);

		$copyObj->setCreateDate($this->create_date);

		$copyObj->setModifiedBy($this->modified_by);

		$copyObj->setModifiedAt($this->modified_at);


		$copyObj->setNew(true);

		$copyObj->setMenuUid(''); // this is a pkey column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     RbacMenu Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     RbacMenuPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RbacMenuPeer();
		}
		return self::$peer;
	}

} // BaseRbacMenu
