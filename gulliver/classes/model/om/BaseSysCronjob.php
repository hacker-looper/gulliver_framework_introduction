<?php

require_once 'propel/om/BaseObject.php';

require_once 'propel/om/Persistent.php';


include_once 'propel/util/Criteria.php';

include_once 'classes/model/SysCronjobPeer.php';

/**
 * Base class that represents a row from the 'SYS_CRONJOB' table.
 *
 * 
 *
 * @package    workflow.classes.model.om
 */
abstract class BaseSysCronjob extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SysCronjobPeer
	 */
	protected static $peer;


	/**
	 * The value for the sc_uid field.
	 * @var        string
	 */
	protected $sc_uid;


	/**
	 * The value for the sc_interval field.
	 * @var        int
	 */
	protected $sc_interval = 0;


	/**
	 * The value for the sc_interval_unit field.
	 * @var        string
	 */
	protected $sc_interval_unit = 'M';


	/**
	 * The value for the sc_command field.
	 * @var        string
	 */
	protected $sc_command = '';


	/**
	 * The value for the sc_command_lastrun field.
	 * @var        int
	 */
	protected $sc_command_lastrun;


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
	 * Get the [sc_uid] column value.
	 * 
	 * @return     string
	 */
	public function getScUid()
	{

		return $this->sc_uid;
	}

	/**
	 * Get the [sc_interval] column value.
	 * 
	 * @return     int
	 */
	public function getScInterval()
	{

		return $this->sc_interval;
	}

	/**
	 * Get the [sc_interval_unit] column value.
	 * 
	 * @return     string
	 */
	public function getScIntervalUnit()
	{

		return $this->sc_interval_unit;
	}

	/**
	 * Get the [sc_command] column value.
	 * 
	 * @return     string
	 */
	public function getScCommand()
	{

		return $this->sc_command;
	}

	/**
	 * Get the [optionally formatted] [sc_command_lastrun] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getScCommandLastrun($format = 'Y-m-d H:i:s')
	{

		if ($this->sc_command_lastrun === null || $this->sc_command_lastrun === '') {
			return null;
		} elseif (!is_int($this->sc_command_lastrun)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->sc_command_lastrun);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [sc_command_lastrun] as date/time value: " . var_export($this->sc_command_lastrun, true));
			}
		} else {
			$ts = $this->sc_command_lastrun;
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
	 * Set the value of [sc_uid] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setScUid($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sc_uid !== $v) {
			$this->sc_uid = $v;
			$this->modifiedColumns[] = SysCronjobPeer::SC_UID;
		}

	} // setScUid()

	/**
	 * Set the value of [sc_interval] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setScInterval($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sc_interval !== $v || $v === 0) {
			$this->sc_interval = $v;
			$this->modifiedColumns[] = SysCronjobPeer::SC_INTERVAL;
		}

	} // setScInterval()

	/**
	 * Set the value of [sc_interval_unit] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setScIntervalUnit($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sc_interval_unit !== $v || $v === 'M') {
			$this->sc_interval_unit = $v;
			$this->modifiedColumns[] = SysCronjobPeer::SC_INTERVAL_UNIT;
		}

	} // setScIntervalUnit()

	/**
	 * Set the value of [sc_command] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setScCommand($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sc_command !== $v || $v === '') {
			$this->sc_command = $v;
			$this->modifiedColumns[] = SysCronjobPeer::SC_COMMAND;
		}

	} // setScCommand()

	/**
	 * Set the value of [sc_command_lastrun] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setScCommandLastrun($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [sc_command_lastrun] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->sc_command_lastrun !== $ts) {
			$this->sc_command_lastrun = $ts;
			$this->modifiedColumns[] = SysCronjobPeer::SC_COMMAND_LASTRUN;
		}

	} // setScCommandLastrun()

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
			$this->modifiedColumns[] = SysCronjobPeer::CREATE_DATE;
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
			$this->modifiedColumns[] = SysCronjobPeer::MODIFIED_BY;
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
			$this->modifiedColumns[] = SysCronjobPeer::MODIFIED_AT;
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

			$this->sc_uid = $rs->getString($startcol + 0);

			$this->sc_interval = $rs->getInt($startcol + 1);

			$this->sc_interval_unit = $rs->getString($startcol + 2);

			$this->sc_command = $rs->getString($startcol + 3);

			$this->sc_command_lastrun = $rs->getTimestamp($startcol + 4, null);

			$this->create_date = $rs->getTimestamp($startcol + 5, null);

			$this->modified_by = $rs->getString($startcol + 6);

			$this->modified_at = $rs->getTimestamp($startcol + 7, null);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 8; // 8 = SysCronjobPeer::NUM_COLUMNS - SysCronjobPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating SysCronjob object", $e);
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
			$con = Propel::getConnection(SysCronjobPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SysCronjobPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(SysCronjobPeer::DATABASE_NAME);
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
					$pk = SysCronjobPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += SysCronjobPeer::doUpdate($this, $con);
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


			if (($retval = SysCronjobPeer::doValidate($this, $columns)) !== true) {
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
		$pos = SysCronjobPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getScUid();
				break;
			case 1:
				return $this->getScInterval();
				break;
			case 2:
				return $this->getScIntervalUnit();
				break;
			case 3:
				return $this->getScCommand();
				break;
			case 4:
				return $this->getScCommandLastrun();
				break;
			case 5:
				return $this->getCreateDate();
				break;
			case 6:
				return $this->getModifiedBy();
				break;
			case 7:
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
		$keys = SysCronjobPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getScUid(),
			$keys[1] => $this->getScInterval(),
			$keys[2] => $this->getScIntervalUnit(),
			$keys[3] => $this->getScCommand(),
			$keys[4] => $this->getScCommandLastrun(),
			$keys[5] => $this->getCreateDate(),
			$keys[6] => $this->getModifiedBy(),
			$keys[7] => $this->getModifiedAt(),
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
		$pos = SysCronjobPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setScUid($value);
				break;
			case 1:
				$this->setScInterval($value);
				break;
			case 2:
				$this->setScIntervalUnit($value);
				break;
			case 3:
				$this->setScCommand($value);
				break;
			case 4:
				$this->setScCommandLastrun($value);
				break;
			case 5:
				$this->setCreateDate($value);
				break;
			case 6:
				$this->setModifiedBy($value);
				break;
			case 7:
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
		$keys = SysCronjobPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setScUid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setScInterval($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setScIntervalUnit($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setScCommand($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setScCommandLastrun($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreateDate($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setModifiedBy($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setModifiedAt($arr[$keys[7]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(SysCronjobPeer::DATABASE_NAME);

		if ($this->isColumnModified(SysCronjobPeer::SC_UID)) $criteria->add(SysCronjobPeer::SC_UID, $this->sc_uid);
		if ($this->isColumnModified(SysCronjobPeer::SC_INTERVAL)) $criteria->add(SysCronjobPeer::SC_INTERVAL, $this->sc_interval);
		if ($this->isColumnModified(SysCronjobPeer::SC_INTERVAL_UNIT)) $criteria->add(SysCronjobPeer::SC_INTERVAL_UNIT, $this->sc_interval_unit);
		if ($this->isColumnModified(SysCronjobPeer::SC_COMMAND)) $criteria->add(SysCronjobPeer::SC_COMMAND, $this->sc_command);
		if ($this->isColumnModified(SysCronjobPeer::SC_COMMAND_LASTRUN)) $criteria->add(SysCronjobPeer::SC_COMMAND_LASTRUN, $this->sc_command_lastrun);
		if ($this->isColumnModified(SysCronjobPeer::CREATE_DATE)) $criteria->add(SysCronjobPeer::CREATE_DATE, $this->create_date);
		if ($this->isColumnModified(SysCronjobPeer::MODIFIED_BY)) $criteria->add(SysCronjobPeer::MODIFIED_BY, $this->modified_by);
		if ($this->isColumnModified(SysCronjobPeer::MODIFIED_AT)) $criteria->add(SysCronjobPeer::MODIFIED_AT, $this->modified_at);

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
		$criteria = new Criteria(SysCronjobPeer::DATABASE_NAME);

		$criteria->add(SysCronjobPeer::SC_UID, $this->sc_uid);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getScUid();
	}

	/**
	 * Generic method to set the primary key (sc_uid column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setScUid($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of SysCronjob (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setScInterval($this->sc_interval);

		$copyObj->setScIntervalUnit($this->sc_interval_unit);

		$copyObj->setScCommand($this->sc_command);

		$copyObj->setScCommandLastrun($this->sc_command_lastrun);

		$copyObj->setCreateDate($this->create_date);

		$copyObj->setModifiedBy($this->modified_by);

		$copyObj->setModifiedAt($this->modified_at);


		$copyObj->setNew(true);

		$copyObj->setScUid(NULL); // this is a pkey column, so set to default value

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
	 * @return     SysCronjob Clone of current object.
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
	 * @return     SysCronjobPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SysCronjobPeer();
		}
		return self::$peer;
	}

} // BaseSysCronjob
