<?php

require_once 'propel/om/BaseObject.php';

require_once 'propel/om/Persistent.php';


include_once 'propel/util/Criteria.php';

include_once 'classes/model/SysNotificationPeer.php';

/**
 * Base class that represents a row from the 'SYS_NOTIFICATION' table.
 *
 * 
 *
 * @package    workflow.classes.model.om
 */
abstract class BaseSysNotification extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SysNotificationPeer
	 */
	protected static $peer;


	/**
	 * The value for the sn_uid field.
	 * @var        string
	 */
	protected $sn_uid;


	/**
	 * The value for the sn_type field.
	 * @var        string
	 */
	protected $sn_type = '';


	/**
	 * The value for the sn_to field.
	 * @var        string
	 */
	protected $sn_to = '';


	/**
	 * The value for the sn_message field.
	 * @var        string
	 */
	protected $sn_message;


	/**
	 * The value for the sn_coredata field.
	 * @var        string
	 */
	protected $sn_coredata = '';


	/**
	 * The value for the sn_senddate field.
	 * @var        int
	 */
	protected $sn_senddate;


	/**
	 * The value for the sn_attachments field.
	 * @var        string
	 */
	protected $sn_attachments;


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
	 * Get the [sn_uid] column value.
	 * 
	 * @return     string
	 */
	public function getSnUid()
	{

		return $this->sn_uid;
	}

	/**
	 * Get the [sn_type] column value.
	 * 
	 * @return     string
	 */
	public function getSnType()
	{

		return $this->sn_type;
	}

	/**
	 * Get the [sn_to] column value.
	 * 
	 * @return     string
	 */
	public function getSnTo()
	{

		return $this->sn_to;
	}

	/**
	 * Get the [sn_message] column value.
	 * 
	 * @return     string
	 */
	public function getSnMessage()
	{

		return $this->sn_message;
	}

	/**
	 * Get the [sn_coredata] column value.
	 * 
	 * @return     string
	 */
	public function getSnCoredata()
	{

		return $this->sn_coredata;
	}

	/**
	 * Get the [optionally formatted] [sn_senddate] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getSnSenddate($format = 'Y-m-d H:i:s')
	{

		if ($this->sn_senddate === null || $this->sn_senddate === '') {
			return null;
		} elseif (!is_int($this->sn_senddate)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->sn_senddate);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [sn_senddate] as date/time value: " . var_export($this->sn_senddate, true));
			}
		} else {
			$ts = $this->sn_senddate;
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
	 * Get the [sn_attachments] column value.
	 * 
	 * @return     string
	 */
	public function getSnAttachments()
	{

		return $this->sn_attachments;
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
	 * Set the value of [sn_uid] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setSnUid($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sn_uid !== $v) {
			$this->sn_uid = $v;
			$this->modifiedColumns[] = SysNotificationPeer::SN_UID;
		}

	} // setSnUid()

	/**
	 * Set the value of [sn_type] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setSnType($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sn_type !== $v || $v === '') {
			$this->sn_type = $v;
			$this->modifiedColumns[] = SysNotificationPeer::SN_TYPE;
		}

	} // setSnType()

	/**
	 * Set the value of [sn_to] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setSnTo($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sn_to !== $v || $v === '') {
			$this->sn_to = $v;
			$this->modifiedColumns[] = SysNotificationPeer::SN_TO;
		}

	} // setSnTo()

	/**
	 * Set the value of [sn_message] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setSnMessage($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sn_message !== $v) {
			$this->sn_message = $v;
			$this->modifiedColumns[] = SysNotificationPeer::SN_MESSAGE;
		}

	} // setSnMessage()

	/**
	 * Set the value of [sn_coredata] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setSnCoredata($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sn_coredata !== $v || $v === '') {
			$this->sn_coredata = $v;
			$this->modifiedColumns[] = SysNotificationPeer::SN_COREDATA;
		}

	} // setSnCoredata()

	/**
	 * Set the value of [sn_senddate] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setSnSenddate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [sn_senddate] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->sn_senddate !== $ts) {
			$this->sn_senddate = $ts;
			$this->modifiedColumns[] = SysNotificationPeer::SN_SENDDATE;
		}

	} // setSnSenddate()

	/**
	 * Set the value of [sn_attachments] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setSnAttachments($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sn_attachments !== $v) {
			$this->sn_attachments = $v;
			$this->modifiedColumns[] = SysNotificationPeer::SN_ATTACHMENTS;
		}

	} // setSnAttachments()

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
			$this->modifiedColumns[] = SysNotificationPeer::CREATE_DATE;
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
			$this->modifiedColumns[] = SysNotificationPeer::MODIFIED_BY;
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
			$this->modifiedColumns[] = SysNotificationPeer::MODIFIED_AT;
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

			$this->sn_uid = $rs->getString($startcol + 0);

			$this->sn_type = $rs->getString($startcol + 1);

			$this->sn_to = $rs->getString($startcol + 2);

			$this->sn_message = $rs->getString($startcol + 3);

			$this->sn_coredata = $rs->getString($startcol + 4);

			$this->sn_senddate = $rs->getTimestamp($startcol + 5, null);

			$this->sn_attachments = $rs->getString($startcol + 6);

			$this->create_date = $rs->getTimestamp($startcol + 7, null);

			$this->modified_by = $rs->getString($startcol + 8);

			$this->modified_at = $rs->getTimestamp($startcol + 9, null);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 10; // 10 = SysNotificationPeer::NUM_COLUMNS - SysNotificationPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating SysNotification object", $e);
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
			$con = Propel::getConnection(SysNotificationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SysNotificationPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(SysNotificationPeer::DATABASE_NAME);
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
					$pk = SysNotificationPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += SysNotificationPeer::doUpdate($this, $con);
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


			if (($retval = SysNotificationPeer::doValidate($this, $columns)) !== true) {
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
		$pos = SysNotificationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getSnUid();
				break;
			case 1:
				return $this->getSnType();
				break;
			case 2:
				return $this->getSnTo();
				break;
			case 3:
				return $this->getSnMessage();
				break;
			case 4:
				return $this->getSnCoredata();
				break;
			case 5:
				return $this->getSnSenddate();
				break;
			case 6:
				return $this->getSnAttachments();
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
		$keys = SysNotificationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getSnUid(),
			$keys[1] => $this->getSnType(),
			$keys[2] => $this->getSnTo(),
			$keys[3] => $this->getSnMessage(),
			$keys[4] => $this->getSnCoredata(),
			$keys[5] => $this->getSnSenddate(),
			$keys[6] => $this->getSnAttachments(),
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
		$pos = SysNotificationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setSnUid($value);
				break;
			case 1:
				$this->setSnType($value);
				break;
			case 2:
				$this->setSnTo($value);
				break;
			case 3:
				$this->setSnMessage($value);
				break;
			case 4:
				$this->setSnCoredata($value);
				break;
			case 5:
				$this->setSnSenddate($value);
				break;
			case 6:
				$this->setSnAttachments($value);
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
		$keys = SysNotificationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setSnUid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setSnType($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSnTo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSnMessage($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSnCoredata($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSnSenddate($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setSnAttachments($arr[$keys[6]]);
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
		$criteria = new Criteria(SysNotificationPeer::DATABASE_NAME);

		if ($this->isColumnModified(SysNotificationPeer::SN_UID)) $criteria->add(SysNotificationPeer::SN_UID, $this->sn_uid);
		if ($this->isColumnModified(SysNotificationPeer::SN_TYPE)) $criteria->add(SysNotificationPeer::SN_TYPE, $this->sn_type);
		if ($this->isColumnModified(SysNotificationPeer::SN_TO)) $criteria->add(SysNotificationPeer::SN_TO, $this->sn_to);
		if ($this->isColumnModified(SysNotificationPeer::SN_MESSAGE)) $criteria->add(SysNotificationPeer::SN_MESSAGE, $this->sn_message);
		if ($this->isColumnModified(SysNotificationPeer::SN_COREDATA)) $criteria->add(SysNotificationPeer::SN_COREDATA, $this->sn_coredata);
		if ($this->isColumnModified(SysNotificationPeer::SN_SENDDATE)) $criteria->add(SysNotificationPeer::SN_SENDDATE, $this->sn_senddate);
		if ($this->isColumnModified(SysNotificationPeer::SN_ATTACHMENTS)) $criteria->add(SysNotificationPeer::SN_ATTACHMENTS, $this->sn_attachments);
		if ($this->isColumnModified(SysNotificationPeer::CREATE_DATE)) $criteria->add(SysNotificationPeer::CREATE_DATE, $this->create_date);
		if ($this->isColumnModified(SysNotificationPeer::MODIFIED_BY)) $criteria->add(SysNotificationPeer::MODIFIED_BY, $this->modified_by);
		if ($this->isColumnModified(SysNotificationPeer::MODIFIED_AT)) $criteria->add(SysNotificationPeer::MODIFIED_AT, $this->modified_at);

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
		$criteria = new Criteria(SysNotificationPeer::DATABASE_NAME);

		$criteria->add(SysNotificationPeer::SN_UID, $this->sn_uid);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getSnUid();
	}

	/**
	 * Generic method to set the primary key (sn_uid column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setSnUid($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of SysNotification (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setSnType($this->sn_type);

		$copyObj->setSnTo($this->sn_to);

		$copyObj->setSnMessage($this->sn_message);

		$copyObj->setSnCoredata($this->sn_coredata);

		$copyObj->setSnSenddate($this->sn_senddate);

		$copyObj->setSnAttachments($this->sn_attachments);

		$copyObj->setCreateDate($this->create_date);

		$copyObj->setModifiedBy($this->modified_by);

		$copyObj->setModifiedAt($this->modified_at);


		$copyObj->setNew(true);

		$copyObj->setSnUid(NULL); // this is a pkey column, so set to default value

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
	 * @return     SysNotification Clone of current object.
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
	 * @return     SysNotificationPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SysNotificationPeer();
		}
		return self::$peer;
	}

} // BaseSysNotification
