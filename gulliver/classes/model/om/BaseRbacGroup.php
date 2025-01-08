<?php

require_once 'propel/om/BaseObject.php';

require_once 'propel/om/Persistent.php';


include_once 'propel/util/Criteria.php';

include_once 'classes/model/RbacGroupPeer.php';

/**
 * Base class that represents a row from the 'RBAC_GROUP' table.
 *
 * 
 *
 * @package    workflow.classes.model.om
 */
abstract class BaseRbacGroup extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        RbacGroupPeer
	 */
	protected static $peer;


	/**
	 * The value for the grp_uid field.
	 * @var        string
	 */
	protected $grp_uid;


	/**
	 * The value for the grp_name field.
	 * @var        string
	 */
	protected $grp_name = '';


	/**
	 * The value for the grp_type field.
	 * @var        string
	 */
	protected $grp_type = '';


	/**
	 * The value for the grp_desc field.
	 * @var        string
	 */
	protected $grp_desc;


	/**
	 * The value for the grp_parent field.
	 * @var        string
	 */
	protected $grp_parent;


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
	 * Get the [grp_uid] column value.
	 * 
	 * @return     string
	 */
	public function getGrpUid()
	{

		return $this->grp_uid;
	}

	/**
	 * Get the [grp_name] column value.
	 * 
	 * @return     string
	 */
	public function getGrpName()
	{

		return $this->grp_name;
	}

	/**
	 * Get the [grp_type] column value.
	 * 
	 * @return     string
	 */
	public function getGrpType()
	{

		return $this->grp_type;
	}

	/**
	 * Get the [grp_desc] column value.
	 * 
	 * @return     string
	 */
	public function getGrpDesc()
	{

		return $this->grp_desc;
	}

	/**
	 * Get the [grp_parent] column value.
	 * 
	 * @return     string
	 */
	public function getGrpParent()
	{

		return $this->grp_parent;
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
	 * Set the value of [grp_uid] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setGrpUid($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->grp_uid !== $v) {
			$this->grp_uid = $v;
			$this->modifiedColumns[] = RbacGroupPeer::GRP_UID;
		}

	} // setGrpUid()

	/**
	 * Set the value of [grp_name] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setGrpName($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->grp_name !== $v || $v === '') {
			$this->grp_name = $v;
			$this->modifiedColumns[] = RbacGroupPeer::GRP_NAME;
		}

	} // setGrpName()

	/**
	 * Set the value of [grp_type] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setGrpType($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->grp_type !== $v || $v === '') {
			$this->grp_type = $v;
			$this->modifiedColumns[] = RbacGroupPeer::GRP_TYPE;
		}

	} // setGrpType()

	/**
	 * Set the value of [grp_desc] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setGrpDesc($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->grp_desc !== $v) {
			$this->grp_desc = $v;
			$this->modifiedColumns[] = RbacGroupPeer::GRP_DESC;
		}

	} // setGrpDesc()

	/**
	 * Set the value of [grp_parent] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setGrpParent($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->grp_parent !== $v) {
			$this->grp_parent = $v;
			$this->modifiedColumns[] = RbacGroupPeer::GRP_PARENT;
		}

	} // setGrpParent()

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
			$this->modifiedColumns[] = RbacGroupPeer::CREATE_DATE;
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
			$this->modifiedColumns[] = RbacGroupPeer::MODIFIED_BY;
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
			$this->modifiedColumns[] = RbacGroupPeer::MODIFIED_AT;
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

			$this->grp_uid = $rs->getString($startcol + 0);

			$this->grp_name = $rs->getString($startcol + 1);

			$this->grp_type = $rs->getString($startcol + 2);

			$this->grp_desc = $rs->getString($startcol + 3);

			$this->grp_parent = $rs->getString($startcol + 4);

			$this->create_date = $rs->getTimestamp($startcol + 5, null);

			$this->modified_by = $rs->getString($startcol + 6);

			$this->modified_at = $rs->getTimestamp($startcol + 7, null);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 8; // 8 = RbacGroupPeer::NUM_COLUMNS - RbacGroupPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating RbacGroup object", $e);
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
			$con = Propel::getConnection(RbacGroupPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RbacGroupPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(RbacGroupPeer::DATABASE_NAME);
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
					$pk = RbacGroupPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += RbacGroupPeer::doUpdate($this, $con);
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


			if (($retval = RbacGroupPeer::doValidate($this, $columns)) !== true) {
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
		$pos = RbacGroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getGrpUid();
				break;
			case 1:
				return $this->getGrpName();
				break;
			case 2:
				return $this->getGrpType();
				break;
			case 3:
				return $this->getGrpDesc();
				break;
			case 4:
				return $this->getGrpParent();
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
		$keys = RbacGroupPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getGrpUid(),
			$keys[1] => $this->getGrpName(),
			$keys[2] => $this->getGrpType(),
			$keys[3] => $this->getGrpDesc(),
			$keys[4] => $this->getGrpParent(),
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
		$pos = RbacGroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setGrpUid($value);
				break;
			case 1:
				$this->setGrpName($value);
				break;
			case 2:
				$this->setGrpType($value);
				break;
			case 3:
				$this->setGrpDesc($value);
				break;
			case 4:
				$this->setGrpParent($value);
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
		$keys = RbacGroupPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setGrpUid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setGrpName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setGrpType($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setGrpDesc($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setGrpParent($arr[$keys[4]]);
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
		$criteria = new Criteria(RbacGroupPeer::DATABASE_NAME);

		if ($this->isColumnModified(RbacGroupPeer::GRP_UID)) $criteria->add(RbacGroupPeer::GRP_UID, $this->grp_uid);
		if ($this->isColumnModified(RbacGroupPeer::GRP_NAME)) $criteria->add(RbacGroupPeer::GRP_NAME, $this->grp_name);
		if ($this->isColumnModified(RbacGroupPeer::GRP_TYPE)) $criteria->add(RbacGroupPeer::GRP_TYPE, $this->grp_type);
		if ($this->isColumnModified(RbacGroupPeer::GRP_DESC)) $criteria->add(RbacGroupPeer::GRP_DESC, $this->grp_desc);
		if ($this->isColumnModified(RbacGroupPeer::GRP_PARENT)) $criteria->add(RbacGroupPeer::GRP_PARENT, $this->grp_parent);
		if ($this->isColumnModified(RbacGroupPeer::CREATE_DATE)) $criteria->add(RbacGroupPeer::CREATE_DATE, $this->create_date);
		if ($this->isColumnModified(RbacGroupPeer::MODIFIED_BY)) $criteria->add(RbacGroupPeer::MODIFIED_BY, $this->modified_by);
		if ($this->isColumnModified(RbacGroupPeer::MODIFIED_AT)) $criteria->add(RbacGroupPeer::MODIFIED_AT, $this->modified_at);

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
		$criteria = new Criteria(RbacGroupPeer::DATABASE_NAME);

		$criteria->add(RbacGroupPeer::GRP_UID, $this->grp_uid);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getGrpUid();
	}

	/**
	 * Generic method to set the primary key (grp_uid column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setGrpUid($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of RbacGroup (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setGrpName($this->grp_name);

		$copyObj->setGrpType($this->grp_type);

		$copyObj->setGrpDesc($this->grp_desc);

		$copyObj->setGrpParent($this->grp_parent);

		$copyObj->setCreateDate($this->create_date);

		$copyObj->setModifiedBy($this->modified_by);

		$copyObj->setModifiedAt($this->modified_at);


		$copyObj->setNew(true);

		$copyObj->setGrpUid(NULL); // this is a pkey column, so set to default value

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
	 * @return     RbacGroup Clone of current object.
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
	 * @return     RbacGroupPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RbacGroupPeer();
		}
		return self::$peer;
	}

} // BaseRbacGroup
