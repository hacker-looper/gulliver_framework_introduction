<?php

require_once 'propel/om/BaseObject.php';

require_once 'propel/om/Persistent.php';


include_once 'propel/util/Criteria.php';

include_once 'classes/model/SysVersionPeer.php';

/**
 * Base class that represents a row from the 'SYS_VERSION' table.
 *
 * 
 *
 * @package    workflow.classes.model.om
 */
abstract class BaseSysVersion extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SysVersionPeer
	 */
	protected static $peer;


	/**
	 * The value for the ver_uid field.
	 * @var        string
	 */
	protected $ver_uid;


	/**
	 * The value for the ver_name field.
	 * @var        string
	 */
	protected $ver_name = '';


	/**
	 * The value for the ver_code field.
	 * @var        string
	 */
	protected $ver_code;


	/**
	 * The value for the ver_module field.
	 * @var        string
	 */
	protected $ver_module = '';


	/**
	 * The value for the ver_desc field.
	 * @var        string
	 */
	protected $ver_desc;


	/**
	 * The value for the ver_url field.
	 * @var        string
	 */
	protected $ver_url;


	/**
	 * The value for the ver_size field.
	 * @var        double
	 */
	protected $ver_size = 0;


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
	 * Get the [ver_uid] column value.
	 * 
	 * @return     string
	 */
	public function getVerUid()
	{

		return $this->ver_uid;
	}

	/**
	 * Get the [ver_name] column value.
	 * 
	 * @return     string
	 */
	public function getVerName()
	{

		return $this->ver_name;
	}

	/**
	 * Get the [ver_code] column value.
	 * 
	 * @return     string
	 */
	public function getVerCode()
	{

		return $this->ver_code;
	}

	/**
	 * Get the [ver_module] column value.
	 * 
	 * @return     string
	 */
	public function getVerModule()
	{

		return $this->ver_module;
	}

	/**
	 * Get the [ver_desc] column value.
	 * 
	 * @return     string
	 */
	public function getVerDesc()
	{

		return $this->ver_desc;
	}

	/**
	 * Get the [ver_url] column value.
	 * 
	 * @return     string
	 */
	public function getVerUrl()
	{

		return $this->ver_url;
	}

	/**
	 * Get the [ver_size] column value.
	 * 
	 * @return     double
	 */
	public function getVerSize()
	{

		return $this->ver_size;
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
	 * Set the value of [ver_uid] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setVerUid($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ver_uid !== $v) {
			$this->ver_uid = $v;
			$this->modifiedColumns[] = SysVersionPeer::VER_UID;
		}

	} // setVerUid()

	/**
	 * Set the value of [ver_name] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setVerName($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ver_name !== $v || $v === '') {
			$this->ver_name = $v;
			$this->modifiedColumns[] = SysVersionPeer::VER_NAME;
		}

	} // setVerName()

	/**
	 * Set the value of [ver_code] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setVerCode($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ver_code !== $v) {
			$this->ver_code = $v;
			$this->modifiedColumns[] = SysVersionPeer::VER_CODE;
		}

	} // setVerCode()

	/**
	 * Set the value of [ver_module] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setVerModule($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ver_module !== $v || $v === '') {
			$this->ver_module = $v;
			$this->modifiedColumns[] = SysVersionPeer::VER_MODULE;
		}

	} // setVerModule()

	/**
	 * Set the value of [ver_desc] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setVerDesc($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ver_desc !== $v) {
			$this->ver_desc = $v;
			$this->modifiedColumns[] = SysVersionPeer::VER_DESC;
		}

	} // setVerDesc()

	/**
	 * Set the value of [ver_url] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setVerUrl($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ver_url !== $v) {
			$this->ver_url = $v;
			$this->modifiedColumns[] = SysVersionPeer::VER_URL;
		}

	} // setVerUrl()

	/**
	 * Set the value of [ver_size] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setVerSize($v)
	{

		if ($this->ver_size !== $v || $v === 0) {
			$this->ver_size = $v;
			$this->modifiedColumns[] = SysVersionPeer::VER_SIZE;
		}

	} // setVerSize()

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
			$this->modifiedColumns[] = SysVersionPeer::CREATE_DATE;
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
			$this->modifiedColumns[] = SysVersionPeer::MODIFIED_BY;
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
			$this->modifiedColumns[] = SysVersionPeer::MODIFIED_AT;
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

			$this->ver_uid = $rs->getString($startcol + 0);

			$this->ver_name = $rs->getString($startcol + 1);

			$this->ver_code = $rs->getString($startcol + 2);

			$this->ver_module = $rs->getString($startcol + 3);

			$this->ver_desc = $rs->getString($startcol + 4);

			$this->ver_url = $rs->getString($startcol + 5);

			$this->ver_size = $rs->getFloat($startcol + 6);

			$this->create_date = $rs->getTimestamp($startcol + 7, null);

			$this->modified_by = $rs->getString($startcol + 8);

			$this->modified_at = $rs->getTimestamp($startcol + 9, null);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 10; // 10 = SysVersionPeer::NUM_COLUMNS - SysVersionPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating SysVersion object", $e);
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
			$con = Propel::getConnection(SysVersionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SysVersionPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(SysVersionPeer::DATABASE_NAME);
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
					$pk = SysVersionPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += SysVersionPeer::doUpdate($this, $con);
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


			if (($retval = SysVersionPeer::doValidate($this, $columns)) !== true) {
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
		$pos = SysVersionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getVerUid();
				break;
			case 1:
				return $this->getVerName();
				break;
			case 2:
				return $this->getVerCode();
				break;
			case 3:
				return $this->getVerModule();
				break;
			case 4:
				return $this->getVerDesc();
				break;
			case 5:
				return $this->getVerUrl();
				break;
			case 6:
				return $this->getVerSize();
				break;
			case 7:
				return $this->getCreateDate();
				break;
			case 8:
				return $this->getModifiedBy();
				break;
			case 9:
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
		$keys = SysVersionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getVerUid(),
			$keys[1] => $this->getVerName(),
			$keys[2] => $this->getVerCode(),
			$keys[3] => $this->getVerModule(),
			$keys[4] => $this->getVerDesc(),
			$keys[5] => $this->getVerUrl(),
			$keys[6] => $this->getVerSize(),
			$keys[7] => $this->getCreateDate(),
			$keys[8] => $this->getModifiedBy(),
			$keys[9] => $this->getModifiedAt(),
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
		$pos = SysVersionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setVerUid($value);
				break;
			case 1:
				$this->setVerName($value);
				break;
			case 2:
				$this->setVerCode($value);
				break;
			case 3:
				$this->setVerModule($value);
				break;
			case 4:
				$this->setVerDesc($value);
				break;
			case 5:
				$this->setVerUrl($value);
				break;
			case 6:
				$this->setVerSize($value);
				break;
			case 7:
				$this->setCreateDate($value);
				break;
			case 8:
				$this->setModifiedBy($value);
				break;
			case 9:
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
		$keys = SysVersionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setVerUid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setVerName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setVerCode($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setVerModule($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setVerDesc($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setVerUrl($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setVerSize($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreateDate($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setModifiedBy($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setModifiedAt($arr[$keys[9]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(SysVersionPeer::DATABASE_NAME);

		if ($this->isColumnModified(SysVersionPeer::VER_UID)) $criteria->add(SysVersionPeer::VER_UID, $this->ver_uid);
		if ($this->isColumnModified(SysVersionPeer::VER_NAME)) $criteria->add(SysVersionPeer::VER_NAME, $this->ver_name);
		if ($this->isColumnModified(SysVersionPeer::VER_CODE)) $criteria->add(SysVersionPeer::VER_CODE, $this->ver_code);
		if ($this->isColumnModified(SysVersionPeer::VER_MODULE)) $criteria->add(SysVersionPeer::VER_MODULE, $this->ver_module);
		if ($this->isColumnModified(SysVersionPeer::VER_DESC)) $criteria->add(SysVersionPeer::VER_DESC, $this->ver_desc);
		if ($this->isColumnModified(SysVersionPeer::VER_URL)) $criteria->add(SysVersionPeer::VER_URL, $this->ver_url);
		if ($this->isColumnModified(SysVersionPeer::VER_SIZE)) $criteria->add(SysVersionPeer::VER_SIZE, $this->ver_size);
		if ($this->isColumnModified(SysVersionPeer::CREATE_DATE)) $criteria->add(SysVersionPeer::CREATE_DATE, $this->create_date);
		if ($this->isColumnModified(SysVersionPeer::MODIFIED_BY)) $criteria->add(SysVersionPeer::MODIFIED_BY, $this->modified_by);
		if ($this->isColumnModified(SysVersionPeer::MODIFIED_AT)) $criteria->add(SysVersionPeer::MODIFIED_AT, $this->modified_at);

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
		$criteria = new Criteria(SysVersionPeer::DATABASE_NAME);

		$criteria->add(SysVersionPeer::VER_UID, $this->ver_uid);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getVerUid();
	}

	/**
	 * Generic method to set the primary key (ver_uid column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setVerUid($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of SysVersion (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setVerName($this->ver_name);

		$copyObj->setVerCode($this->ver_code);

		$copyObj->setVerModule($this->ver_module);

		$copyObj->setVerDesc($this->ver_desc);

		$copyObj->setVerUrl($this->ver_url);

		$copyObj->setVerSize($this->ver_size);

		$copyObj->setCreateDate($this->create_date);

		$copyObj->setModifiedBy($this->modified_by);

		$copyObj->setModifiedAt($this->modified_at);


		$copyObj->setNew(true);

		$copyObj->setVerUid(NULL); // this is a pkey column, so set to default value

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
	 * @return     SysVersion Clone of current object.
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
	 * @return     SysVersionPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SysVersionPeer();
		}
		return self::$peer;
	}

} // BaseSysVersion
