<?php

require_once 'propel/om/BaseObject.php';

require_once 'propel/om/Persistent.php';


include_once 'propel/util/Criteria.php';

include_once 'classes/model/SysMessagePeer.php';

/**
 * Base class that represents a row from the 'SYS_MESSAGE' table.
 *
 * 
 *
 * @package    workflow.classes.model.om
 */
abstract class BaseSysMessage extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SysMessagePeer
	 */
	protected static $peer;


	/**
	 * The value for the mes_uid field.
	 * @var        string
	 */
	protected $mes_uid = '';


	/**
	 * The value for the mes_to_key field.
	 * @var        string
	 */
	protected $mes_to_key = '';


	/**
	 * The value for the mes_to_value field.
	 * @var        string
	 */
	protected $mes_to_value;


	/**
	 * The value for the mes_type_key field.
	 * @var        string
	 */
	protected $mes_type_key = '';


	/**
	 * The value for the mes_type_value field.
	 * @var        string
	 */
	protected $mes_type_value = '';


	/**
	 * The value for the mes_title field.
	 * @var        string
	 */
	protected $mes_title = '';


	/**
	 * The value for the mes_body field.
	 * @var        string
	 */
	protected $mes_body = '';


	/**
	 * The value for the mes_source field.
	 * @var        string
	 */
	protected $mes_source = '0';


	/**
	 * The value for the mes_publish_status field.
	 * @var        string
	 */
	protected $mes_publish_status = '0';


	/**
	 * The value for the mes_publish_date field.
	 * @var        string
	 */
	protected $mes_publish_date = '';


	/**
	 * The value for the mes_from_user field.
	 * @var        string
	 */
	protected $mes_from_user;


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
	 * Get the [mes_uid] column value.
	 * 
	 * @return     string
	 */
	public function getMesUid()
	{

		return $this->mes_uid;
	}

	/**
	 * Get the [mes_to_key] column value.
	 * 
	 * @return     string
	 */
	public function getMesToKey()
	{

		return $this->mes_to_key;
	}

	/**
	 * Get the [mes_to_value] column value.
	 * 
	 * @return     string
	 */
	public function getMesToValue()
	{

		return $this->mes_to_value;
	}

	/**
	 * Get the [mes_type_key] column value.
	 * 
	 * @return     string
	 */
	public function getMesTypeKey()
	{

		return $this->mes_type_key;
	}

	/**
	 * Get the [mes_type_value] column value.
	 * 
	 * @return     string
	 */
	public function getMesTypeValue()
	{

		return $this->mes_type_value;
	}

	/**
	 * Get the [mes_title] column value.
	 * 
	 * @return     string
	 */
	public function getMesTitle()
	{

		return $this->mes_title;
	}

	/**
	 * Get the [mes_body] column value.
	 * 
	 * @return     string
	 */
	public function getMesBody()
	{

		return $this->mes_body;
	}

	/**
	 * Get the [mes_source] column value.
	 * 
	 * @return     string
	 */
	public function getMesSource()
	{

		return $this->mes_source;
	}

	/**
	 * Get the [mes_publish_status] column value.
	 * 
	 * @return     string
	 */
	public function getMesPublishStatus()
	{

		return $this->mes_publish_status;
	}

	/**
	 * Get the [mes_publish_date] column value.
	 * 
	 * @return     string
	 */
	public function getMesPublishDate()
	{

		return $this->mes_publish_date;
	}

	/**
	 * Get the [mes_from_user] column value.
	 * 
	 * @return     string
	 */
	public function getMesFromUser()
	{

		return $this->mes_from_user;
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
	 * Set the value of [mes_uid] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setMesUid($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->mes_uid !== $v || $v === '') {
			$this->mes_uid = $v;
			$this->modifiedColumns[] = SysMessagePeer::MES_UID;
		}

	} // setMesUid()

	/**
	 * Set the value of [mes_to_key] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setMesToKey($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->mes_to_key !== $v || $v === '') {
			$this->mes_to_key = $v;
			$this->modifiedColumns[] = SysMessagePeer::MES_TO_KEY;
		}

	} // setMesToKey()

	/**
	 * Set the value of [mes_to_value] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setMesToValue($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->mes_to_value !== $v) {
			$this->mes_to_value = $v;
			$this->modifiedColumns[] = SysMessagePeer::MES_TO_VALUE;
		}

	} // setMesToValue()

	/**
	 * Set the value of [mes_type_key] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setMesTypeKey($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->mes_type_key !== $v || $v === '') {
			$this->mes_type_key = $v;
			$this->modifiedColumns[] = SysMessagePeer::MES_TYPE_KEY;
		}

	} // setMesTypeKey()

	/**
	 * Set the value of [mes_type_value] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setMesTypeValue($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->mes_type_value !== $v || $v === '') {
			$this->mes_type_value = $v;
			$this->modifiedColumns[] = SysMessagePeer::MES_TYPE_VALUE;
		}

	} // setMesTypeValue()

	/**
	 * Set the value of [mes_title] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setMesTitle($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->mes_title !== $v || $v === '') {
			$this->mes_title = $v;
			$this->modifiedColumns[] = SysMessagePeer::MES_TITLE;
		}

	} // setMesTitle()

	/**
	 * Set the value of [mes_body] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setMesBody($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->mes_body !== $v || $v === '') {
			$this->mes_body = $v;
			$this->modifiedColumns[] = SysMessagePeer::MES_BODY;
		}

	} // setMesBody()

	/**
	 * Set the value of [mes_source] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setMesSource($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->mes_source !== $v || $v === '0') {
			$this->mes_source = $v;
			$this->modifiedColumns[] = SysMessagePeer::MES_SOURCE;
		}

	} // setMesSource()

	/**
	 * Set the value of [mes_publish_status] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setMesPublishStatus($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->mes_publish_status !== $v || $v === '0') {
			$this->mes_publish_status = $v;
			$this->modifiedColumns[] = SysMessagePeer::MES_PUBLISH_STATUS;
		}

	} // setMesPublishStatus()

	/**
	 * Set the value of [mes_publish_date] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setMesPublishDate($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->mes_publish_date !== $v || $v === '') {
			$this->mes_publish_date = $v;
			$this->modifiedColumns[] = SysMessagePeer::MES_PUBLISH_DATE;
		}

	} // setMesPublishDate()

	/**
	 * Set the value of [mes_from_user] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setMesFromUser($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->mes_from_user !== $v) {
			$this->mes_from_user = $v;
			$this->modifiedColumns[] = SysMessagePeer::MES_FROM_USER;
		}

	} // setMesFromUser()

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
			$this->modifiedColumns[] = SysMessagePeer::CREATE_DATE;
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
			$this->modifiedColumns[] = SysMessagePeer::MODIFIED_BY;
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
			$this->modifiedColumns[] = SysMessagePeer::MODIFIED_AT;
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

			$this->mes_uid = $rs->getString($startcol + 0);

			$this->mes_to_key = $rs->getString($startcol + 1);

			$this->mes_to_value = $rs->getString($startcol + 2);

			$this->mes_type_key = $rs->getString($startcol + 3);

			$this->mes_type_value = $rs->getString($startcol + 4);

			$this->mes_title = $rs->getString($startcol + 5);

			$this->mes_body = $rs->getString($startcol + 6);

			$this->mes_source = $rs->getString($startcol + 7);

			$this->mes_publish_status = $rs->getString($startcol + 8);

			$this->mes_publish_date = $rs->getString($startcol + 9);

			$this->mes_from_user = $rs->getString($startcol + 10);

			$this->create_date = $rs->getTimestamp($startcol + 11, null);

			$this->modified_by = $rs->getString($startcol + 12);

			$this->modified_at = $rs->getTimestamp($startcol + 13, null);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 14; // 14 = SysMessagePeer::NUM_COLUMNS - SysMessagePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating SysMessage object", $e);
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
			$con = Propel::getConnection(SysMessagePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SysMessagePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(SysMessagePeer::DATABASE_NAME);
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
					$pk = SysMessagePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += SysMessagePeer::doUpdate($this, $con);
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


			if (($retval = SysMessagePeer::doValidate($this, $columns)) !== true) {
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
		$pos = SysMessagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getMesUid();
				break;
			case 1:
				return $this->getMesToKey();
				break;
			case 2:
				return $this->getMesToValue();
				break;
			case 3:
				return $this->getMesTypeKey();
				break;
			case 4:
				return $this->getMesTypeValue();
				break;
			case 5:
				return $this->getMesTitle();
				break;
			case 6:
				return $this->getMesBody();
				break;
			case 7:
				return $this->getMesSource();
				break;
			case 8:
				return $this->getMesPublishStatus();
				break;
			case 9:
				return $this->getMesPublishDate();
				break;
			case 10:
				return $this->getMesFromUser();
				break;
			case 11:
				return $this->getCreateDate();
				break;
			case 12:
				return $this->getModifiedBy();
				break;
			case 13:
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
		$keys = SysMessagePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getMesUid(),
			$keys[1] => $this->getMesToKey(),
			$keys[2] => $this->getMesToValue(),
			$keys[3] => $this->getMesTypeKey(),
			$keys[4] => $this->getMesTypeValue(),
			$keys[5] => $this->getMesTitle(),
			$keys[6] => $this->getMesBody(),
			$keys[7] => $this->getMesSource(),
			$keys[8] => $this->getMesPublishStatus(),
			$keys[9] => $this->getMesPublishDate(),
			$keys[10] => $this->getMesFromUser(),
			$keys[11] => $this->getCreateDate(),
			$keys[12] => $this->getModifiedBy(),
			$keys[13] => $this->getModifiedAt(),
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
		$pos = SysMessagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setMesUid($value);
				break;
			case 1:
				$this->setMesToKey($value);
				break;
			case 2:
				$this->setMesToValue($value);
				break;
			case 3:
				$this->setMesTypeKey($value);
				break;
			case 4:
				$this->setMesTypeValue($value);
				break;
			case 5:
				$this->setMesTitle($value);
				break;
			case 6:
				$this->setMesBody($value);
				break;
			case 7:
				$this->setMesSource($value);
				break;
			case 8:
				$this->setMesPublishStatus($value);
				break;
			case 9:
				$this->setMesPublishDate($value);
				break;
			case 10:
				$this->setMesFromUser($value);
				break;
			case 11:
				$this->setCreateDate($value);
				break;
			case 12:
				$this->setModifiedBy($value);
				break;
			case 13:
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
		$keys = SysMessagePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setMesUid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setMesToKey($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setMesToValue($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setMesTypeKey($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setMesTypeValue($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setMesTitle($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setMesBody($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setMesSource($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setMesPublishStatus($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setMesPublishDate($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setMesFromUser($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCreateDate($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setModifiedBy($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setModifiedAt($arr[$keys[13]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(SysMessagePeer::DATABASE_NAME);

		if ($this->isColumnModified(SysMessagePeer::MES_UID)) $criteria->add(SysMessagePeer::MES_UID, $this->mes_uid);
		if ($this->isColumnModified(SysMessagePeer::MES_TO_KEY)) $criteria->add(SysMessagePeer::MES_TO_KEY, $this->mes_to_key);
		if ($this->isColumnModified(SysMessagePeer::MES_TO_VALUE)) $criteria->add(SysMessagePeer::MES_TO_VALUE, $this->mes_to_value);
		if ($this->isColumnModified(SysMessagePeer::MES_TYPE_KEY)) $criteria->add(SysMessagePeer::MES_TYPE_KEY, $this->mes_type_key);
		if ($this->isColumnModified(SysMessagePeer::MES_TYPE_VALUE)) $criteria->add(SysMessagePeer::MES_TYPE_VALUE, $this->mes_type_value);
		if ($this->isColumnModified(SysMessagePeer::MES_TITLE)) $criteria->add(SysMessagePeer::MES_TITLE, $this->mes_title);
		if ($this->isColumnModified(SysMessagePeer::MES_BODY)) $criteria->add(SysMessagePeer::MES_BODY, $this->mes_body);
		if ($this->isColumnModified(SysMessagePeer::MES_SOURCE)) $criteria->add(SysMessagePeer::MES_SOURCE, $this->mes_source);
		if ($this->isColumnModified(SysMessagePeer::MES_PUBLISH_STATUS)) $criteria->add(SysMessagePeer::MES_PUBLISH_STATUS, $this->mes_publish_status);
		if ($this->isColumnModified(SysMessagePeer::MES_PUBLISH_DATE)) $criteria->add(SysMessagePeer::MES_PUBLISH_DATE, $this->mes_publish_date);
		if ($this->isColumnModified(SysMessagePeer::MES_FROM_USER)) $criteria->add(SysMessagePeer::MES_FROM_USER, $this->mes_from_user);
		if ($this->isColumnModified(SysMessagePeer::CREATE_DATE)) $criteria->add(SysMessagePeer::CREATE_DATE, $this->create_date);
		if ($this->isColumnModified(SysMessagePeer::MODIFIED_BY)) $criteria->add(SysMessagePeer::MODIFIED_BY, $this->modified_by);
		if ($this->isColumnModified(SysMessagePeer::MODIFIED_AT)) $criteria->add(SysMessagePeer::MODIFIED_AT, $this->modified_at);

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
		$criteria = new Criteria(SysMessagePeer::DATABASE_NAME);

		$criteria->add(SysMessagePeer::MES_UID, $this->mes_uid);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getMesUid();
	}

	/**
	 * Generic method to set the primary key (mes_uid column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setMesUid($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of SysMessage (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setMesToKey($this->mes_to_key);

		$copyObj->setMesToValue($this->mes_to_value);

		$copyObj->setMesTypeKey($this->mes_type_key);

		$copyObj->setMesTypeValue($this->mes_type_value);

		$copyObj->setMesTitle($this->mes_title);

		$copyObj->setMesBody($this->mes_body);

		$copyObj->setMesSource($this->mes_source);

		$copyObj->setMesPublishStatus($this->mes_publish_status);

		$copyObj->setMesPublishDate($this->mes_publish_date);

		$copyObj->setMesFromUser($this->mes_from_user);

		$copyObj->setCreateDate($this->create_date);

		$copyObj->setModifiedBy($this->modified_by);

		$copyObj->setModifiedAt($this->modified_at);


		$copyObj->setNew(true);

		$copyObj->setMesUid(''); // this is a pkey column, so set to default value

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
	 * @return     SysMessage Clone of current object.
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
	 * @return     SysMessagePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SysMessagePeer();
		}
		return self::$peer;
	}

} // BaseSysMessage
