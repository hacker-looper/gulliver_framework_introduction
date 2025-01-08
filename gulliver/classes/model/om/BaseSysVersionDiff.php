<?php

require_once 'propel/om/BaseObject.php';

require_once 'propel/om/Persistent.php';


include_once 'propel/util/Criteria.php';

include_once 'classes/model/SysVersionDiffPeer.php';

/**
 * Base class that represents a row from the 'SYS_VERSION_DIFF' table.
 *
 * 
 *
 * @package    workflow.classes.model.om
 */
abstract class BaseSysVersionDiff extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SysVersionDiffPeer
	 */
	protected static $peer;


	/**
	 * The value for the dver_uid field.
	 * @var        string
	 */
	protected $dver_uid = '';


	/**
	 * The value for the ver_uid field.
	 * @var        string
	 */
	protected $ver_uid = '';


	/**
	 * The value for the ver_code field.
	 * @var        string
	 */
	protected $ver_code = '';


	/**
	 * The value for the dver_name field.
	 * @var        string
	 */
	protected $dver_name = '';


	/**
	 * The value for the dver_code field.
	 * @var        string
	 */
	protected $dver_code = '';


	/**
	 * The value for the dver_build field.
	 * @var        int
	 */
	protected $dver_build = 0;


	/**
	 * The value for the dver_module field.
	 * @var        string
	 */
	protected $dver_module = '';


	/**
	 * The value for the dver_desc field.
	 * @var        string
	 */
	protected $dver_desc;


	/**
	 * The value for the dver_url field.
	 * @var        string
	 */
	protected $dver_url;


	/**
	 * The value for the dver_size field.
	 * @var        double
	 */
	protected $dver_size = 0;


	/**
	 * The value for the dver_upgrade_from field.
	 * @var        string
	 */
	protected $dver_upgrade_from = '';


	/**
	 * The value for the devr_upgrade_to field.
	 * @var        string
	 */
	protected $devr_upgrade_to = '';


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
	 * Get the [dver_uid] column value.
	 * 
	 * @return     string
	 */
	public function getDverUid()
	{

		return $this->dver_uid;
	}

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
	 * Get the [ver_code] column value.
	 * 
	 * @return     string
	 */
	public function getVerCode()
	{

		return $this->ver_code;
	}

	/**
	 * Get the [dver_name] column value.
	 * 
	 * @return     string
	 */
	public function getDverName()
	{

		return $this->dver_name;
	}

	/**
	 * Get the [dver_code] column value.
	 * 
	 * @return     string
	 */
	public function getDverCode()
	{

		return $this->dver_code;
	}

	/**
	 * Get the [dver_build] column value.
	 * 
	 * @return     int
	 */
	public function getDverBuild()
	{

		return $this->dver_build;
	}

	/**
	 * Get the [dver_module] column value.
	 * 
	 * @return     string
	 */
	public function getDverModule()
	{

		return $this->dver_module;
	}

	/**
	 * Get the [dver_desc] column value.
	 * 
	 * @return     string
	 */
	public function getDverDesc()
	{

		return $this->dver_desc;
	}

	/**
	 * Get the [dver_url] column value.
	 * 
	 * @return     string
	 */
	public function getDverUrl()
	{

		return $this->dver_url;
	}

	/**
	 * Get the [dver_size] column value.
	 * 
	 * @return     double
	 */
	public function getDverSize()
	{

		return $this->dver_size;
	}

	/**
	 * Get the [dver_upgrade_from] column value.
	 * 
	 * @return     string
	 */
	public function getDverUpgradeFrom()
	{

		return $this->dver_upgrade_from;
	}

	/**
	 * Get the [devr_upgrade_to] column value.
	 * 
	 * @return     string
	 */
	public function getDevrUpgradeTo()
	{

		return $this->devr_upgrade_to;
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
	 * Set the value of [dver_uid] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setDverUid($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->dver_uid !== $v || $v === '') {
			$this->dver_uid = $v;
			$this->modifiedColumns[] = SysVersionDiffPeer::DVER_UID;
		}

	} // setDverUid()

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

		if ($this->ver_uid !== $v || $v === '') {
			$this->ver_uid = $v;
			$this->modifiedColumns[] = SysVersionDiffPeer::VER_UID;
		}

	} // setVerUid()

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

		if ($this->ver_code !== $v || $v === '') {
			$this->ver_code = $v;
			$this->modifiedColumns[] = SysVersionDiffPeer::VER_CODE;
		}

	} // setVerCode()

	/**
	 * Set the value of [dver_name] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setDverName($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->dver_name !== $v || $v === '') {
			$this->dver_name = $v;
			$this->modifiedColumns[] = SysVersionDiffPeer::DVER_NAME;
		}

	} // setDverName()

	/**
	 * Set the value of [dver_code] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setDverCode($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->dver_code !== $v || $v === '') {
			$this->dver_code = $v;
			$this->modifiedColumns[] = SysVersionDiffPeer::DVER_CODE;
		}

	} // setDverCode()

	/**
	 * Set the value of [dver_build] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setDverBuild($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->dver_build !== $v || $v === 0) {
			$this->dver_build = $v;
			$this->modifiedColumns[] = SysVersionDiffPeer::DVER_BUILD;
		}

	} // setDverBuild()

	/**
	 * Set the value of [dver_module] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setDverModule($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->dver_module !== $v || $v === '') {
			$this->dver_module = $v;
			$this->modifiedColumns[] = SysVersionDiffPeer::DVER_MODULE;
		}

	} // setDverModule()

	/**
	 * Set the value of [dver_desc] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setDverDesc($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->dver_desc !== $v) {
			$this->dver_desc = $v;
			$this->modifiedColumns[] = SysVersionDiffPeer::DVER_DESC;
		}

	} // setDverDesc()

	/**
	 * Set the value of [dver_url] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setDverUrl($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->dver_url !== $v) {
			$this->dver_url = $v;
			$this->modifiedColumns[] = SysVersionDiffPeer::DVER_URL;
		}

	} // setDverUrl()

	/**
	 * Set the value of [dver_size] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setDverSize($v)
	{

		if ($this->dver_size !== $v || $v === 0) {
			$this->dver_size = $v;
			$this->modifiedColumns[] = SysVersionDiffPeer::DVER_SIZE;
		}

	} // setDverSize()

	/**
	 * Set the value of [dver_upgrade_from] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setDverUpgradeFrom($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->dver_upgrade_from !== $v || $v === '') {
			$this->dver_upgrade_from = $v;
			$this->modifiedColumns[] = SysVersionDiffPeer::DVER_UPGRADE_FROM;
		}

	} // setDverUpgradeFrom()

	/**
	 * Set the value of [devr_upgrade_to] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setDevrUpgradeTo($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->devr_upgrade_to !== $v || $v === '') {
			$this->devr_upgrade_to = $v;
			$this->modifiedColumns[] = SysVersionDiffPeer::DEVR_UPGRADE_TO;
		}

	} // setDevrUpgradeTo()

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
			$this->modifiedColumns[] = SysVersionDiffPeer::CREATE_DATE;
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
			$this->modifiedColumns[] = SysVersionDiffPeer::MODIFIED_BY;
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
			$this->modifiedColumns[] = SysVersionDiffPeer::MODIFIED_AT;
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

			$this->dver_uid = $rs->getString($startcol + 0);

			$this->ver_uid = $rs->getString($startcol + 1);

			$this->ver_code = $rs->getString($startcol + 2);

			$this->dver_name = $rs->getString($startcol + 3);

			$this->dver_code = $rs->getString($startcol + 4);

			$this->dver_build = $rs->getInt($startcol + 5);

			$this->dver_module = $rs->getString($startcol + 6);

			$this->dver_desc = $rs->getString($startcol + 7);

			$this->dver_url = $rs->getString($startcol + 8);

			$this->dver_size = $rs->getFloat($startcol + 9);

			$this->dver_upgrade_from = $rs->getString($startcol + 10);

			$this->devr_upgrade_to = $rs->getString($startcol + 11);

			$this->create_date = $rs->getTimestamp($startcol + 12, null);

			$this->modified_by = $rs->getString($startcol + 13);

			$this->modified_at = $rs->getTimestamp($startcol + 14, null);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 15; // 15 = SysVersionDiffPeer::NUM_COLUMNS - SysVersionDiffPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating SysVersionDiff object", $e);
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
			$con = Propel::getConnection(SysVersionDiffPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SysVersionDiffPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(SysVersionDiffPeer::DATABASE_NAME);
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
					$pk = SysVersionDiffPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += SysVersionDiffPeer::doUpdate($this, $con);
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


			if (($retval = SysVersionDiffPeer::doValidate($this, $columns)) !== true) {
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
		$pos = SysVersionDiffPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getDverUid();
				break;
			case 1:
				return $this->getVerUid();
				break;
			case 2:
				return $this->getVerCode();
				break;
			case 3:
				return $this->getDverName();
				break;
			case 4:
				return $this->getDverCode();
				break;
			case 5:
				return $this->getDverBuild();
				break;
			case 6:
				return $this->getDverModule();
				break;
			case 7:
				return $this->getDverDesc();
				break;
			case 8:
				return $this->getDverUrl();
				break;
			case 9:
				return $this->getDverSize();
				break;
			case 10:
				return $this->getDverUpgradeFrom();
				break;
			case 11:
				return $this->getDevrUpgradeTo();
				break;
			case 12:
				return $this->getCreateDate();
				break;
			case 13:
				return $this->getModifiedBy();
				break;
			case 14:
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
		$keys = SysVersionDiffPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getDverUid(),
			$keys[1] => $this->getVerUid(),
			$keys[2] => $this->getVerCode(),
			$keys[3] => $this->getDverName(),
			$keys[4] => $this->getDverCode(),
			$keys[5] => $this->getDverBuild(),
			$keys[6] => $this->getDverModule(),
			$keys[7] => $this->getDverDesc(),
			$keys[8] => $this->getDverUrl(),
			$keys[9] => $this->getDverSize(),
			$keys[10] => $this->getDverUpgradeFrom(),
			$keys[11] => $this->getDevrUpgradeTo(),
			$keys[12] => $this->getCreateDate(),
			$keys[13] => $this->getModifiedBy(),
			$keys[14] => $this->getModifiedAt(),
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
		$pos = SysVersionDiffPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setDverUid($value);
				break;
			case 1:
				$this->setVerUid($value);
				break;
			case 2:
				$this->setVerCode($value);
				break;
			case 3:
				$this->setDverName($value);
				break;
			case 4:
				$this->setDverCode($value);
				break;
			case 5:
				$this->setDverBuild($value);
				break;
			case 6:
				$this->setDverModule($value);
				break;
			case 7:
				$this->setDverDesc($value);
				break;
			case 8:
				$this->setDverUrl($value);
				break;
			case 9:
				$this->setDverSize($value);
				break;
			case 10:
				$this->setDverUpgradeFrom($value);
				break;
			case 11:
				$this->setDevrUpgradeTo($value);
				break;
			case 12:
				$this->setCreateDate($value);
				break;
			case 13:
				$this->setModifiedBy($value);
				break;
			case 14:
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
		$keys = SysVersionDiffPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setDverUid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setVerUid($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setVerCode($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDverName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDverCode($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDverBuild($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDverModule($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setDverDesc($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setDverUrl($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setDverSize($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setDverUpgradeFrom($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setDevrUpgradeTo($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCreateDate($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setModifiedBy($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setModifiedAt($arr[$keys[14]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(SysVersionDiffPeer::DATABASE_NAME);

		if ($this->isColumnModified(SysVersionDiffPeer::DVER_UID)) $criteria->add(SysVersionDiffPeer::DVER_UID, $this->dver_uid);
		if ($this->isColumnModified(SysVersionDiffPeer::VER_UID)) $criteria->add(SysVersionDiffPeer::VER_UID, $this->ver_uid);
		if ($this->isColumnModified(SysVersionDiffPeer::VER_CODE)) $criteria->add(SysVersionDiffPeer::VER_CODE, $this->ver_code);
		if ($this->isColumnModified(SysVersionDiffPeer::DVER_NAME)) $criteria->add(SysVersionDiffPeer::DVER_NAME, $this->dver_name);
		if ($this->isColumnModified(SysVersionDiffPeer::DVER_CODE)) $criteria->add(SysVersionDiffPeer::DVER_CODE, $this->dver_code);
		if ($this->isColumnModified(SysVersionDiffPeer::DVER_BUILD)) $criteria->add(SysVersionDiffPeer::DVER_BUILD, $this->dver_build);
		if ($this->isColumnModified(SysVersionDiffPeer::DVER_MODULE)) $criteria->add(SysVersionDiffPeer::DVER_MODULE, $this->dver_module);
		if ($this->isColumnModified(SysVersionDiffPeer::DVER_DESC)) $criteria->add(SysVersionDiffPeer::DVER_DESC, $this->dver_desc);
		if ($this->isColumnModified(SysVersionDiffPeer::DVER_URL)) $criteria->add(SysVersionDiffPeer::DVER_URL, $this->dver_url);
		if ($this->isColumnModified(SysVersionDiffPeer::DVER_SIZE)) $criteria->add(SysVersionDiffPeer::DVER_SIZE, $this->dver_size);
		if ($this->isColumnModified(SysVersionDiffPeer::DVER_UPGRADE_FROM)) $criteria->add(SysVersionDiffPeer::DVER_UPGRADE_FROM, $this->dver_upgrade_from);
		if ($this->isColumnModified(SysVersionDiffPeer::DEVR_UPGRADE_TO)) $criteria->add(SysVersionDiffPeer::DEVR_UPGRADE_TO, $this->devr_upgrade_to);
		if ($this->isColumnModified(SysVersionDiffPeer::CREATE_DATE)) $criteria->add(SysVersionDiffPeer::CREATE_DATE, $this->create_date);
		if ($this->isColumnModified(SysVersionDiffPeer::MODIFIED_BY)) $criteria->add(SysVersionDiffPeer::MODIFIED_BY, $this->modified_by);
		if ($this->isColumnModified(SysVersionDiffPeer::MODIFIED_AT)) $criteria->add(SysVersionDiffPeer::MODIFIED_AT, $this->modified_at);

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
		$criteria = new Criteria(SysVersionDiffPeer::DATABASE_NAME);

		$criteria->add(SysVersionDiffPeer::DVER_UID, $this->dver_uid);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getDverUid();
	}

	/**
	 * Generic method to set the primary key (dver_uid column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setDverUid($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of SysVersionDiff (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setVerUid($this->ver_uid);

		$copyObj->setVerCode($this->ver_code);

		$copyObj->setDverName($this->dver_name);

		$copyObj->setDverCode($this->dver_code);

		$copyObj->setDverBuild($this->dver_build);

		$copyObj->setDverModule($this->dver_module);

		$copyObj->setDverDesc($this->dver_desc);

		$copyObj->setDverUrl($this->dver_url);

		$copyObj->setDverSize($this->dver_size);

		$copyObj->setDverUpgradeFrom($this->dver_upgrade_from);

		$copyObj->setDevrUpgradeTo($this->devr_upgrade_to);

		$copyObj->setCreateDate($this->create_date);

		$copyObj->setModifiedBy($this->modified_by);

		$copyObj->setModifiedAt($this->modified_at);


		$copyObj->setNew(true);

		$copyObj->setDverUid(''); // this is a pkey column, so set to default value

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
	 * @return     SysVersionDiff Clone of current object.
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
	 * @return     SysVersionDiffPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SysVersionDiffPeer();
		}
		return self::$peer;
	}

} // BaseSysVersionDiff
