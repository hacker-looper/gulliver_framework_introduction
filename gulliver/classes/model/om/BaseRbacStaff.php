<?php

require_once 'propel/om/BaseObject.php';

require_once 'propel/om/Persistent.php';


include_once 'propel/util/Criteria.php';

include_once 'classes/model/RbacStaffPeer.php';

/**
 * Base class that represents a row from the 'RBAC_STAFF' table.
 *
 * 
 *
 * @package    workflow.classes.model.om
 */
abstract class BaseRbacStaff extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        RbacStaffPeer
	 */
	protected static $peer;


	/**
	 * The value for the usr_uid field.
	 * @var        string
	 */
	protected $usr_uid = '';


	/**
	 * The value for the stf_code field.
	 * @var        string
	 */
	protected $stf_code = '';


	/**
	 * The value for the stf_status field.
	 * @var        string
	 */
	protected $stf_status = '';


	/**
	 * The value for the grp_uid field.
	 * @var        string
	 */
	protected $grp_uid = '';


	/**
	 * The value for the stf_job field.
	 * @var        string
	 */
	protected $stf_job = '';


	/**
	 * The value for the stf_hometown field.
	 * @var        string
	 */
	protected $stf_hometown = '';


	/**
	 * The value for the stf_sex field.
	 * @var        string
	 */
	protected $stf_sex = '';


	/**
	 * The value for the stf_bod field.
	 * @var        int
	 */
	protected $stf_bod;


	/**
	 * The value for the stf_enterydate field.
	 * @var        int
	 */
	protected $stf_enterydate;


	/**
	 * The value for the stf_nation field.
	 * @var        string
	 */
	protected $stf_nation = '';


	/**
	 * The value for the stf_idcard field.
	 * @var        string
	 */
	protected $stf_idcard = '';


	/**
	 * The value for the stf_political field.
	 * @var        string
	 */
	protected $stf_political = '';


	/**
	 * The value for the stf_edu field.
	 * @var        string
	 */
	protected $stf_edu = '';


	/**
	 * The value for the stf_married field.
	 * @var        string
	 */
	protected $stf_married = '';


	/**
	 * The value for the stf_edu_school field.
	 * @var        string
	 */
	protected $stf_edu_school = '';


	/**
	 * The value for the stf_edu_master field.
	 * @var        string
	 */
	protected $stf_edu_master = '';


	/**
	 * The value for the stf_salarycard field.
	 * @var        string
	 */
	protected $stf_salarycard = '';


	/**
	 * The value for the stf_socialcard field.
	 * @var        string
	 */
	protected $stf_socialcard = '';


	/**
	 * The value for the stf_contractdate field.
	 * @var        int
	 */
	protected $stf_contractdate;


	/**
	 * The value for the stf_medicalcard field.
	 * @var        string
	 */
	protected $stf_medicalcard = '';


	/**
	 * The value for the stf_trialdays field.
	 * @var        int
	 */
	protected $stf_trialdays = 0;


	/**
	 * The value for the stf_address field.
	 * @var        string
	 */
	protected $stf_address;


	/**
	 * The value for the stf_desc field.
	 * @var        string
	 */
	protected $stf_desc;


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
	 * Get the [usr_uid] column value.
	 * 
	 * @return     string
	 */
	public function getUsrUid()
	{

		return $this->usr_uid;
	}

	/**
	 * Get the [stf_code] column value.
	 * 
	 * @return     string
	 */
	public function getStfCode()
	{

		return $this->stf_code;
	}

	/**
	 * Get the [stf_status] column value.
	 * 
	 * @return     string
	 */
	public function getStfStatus()
	{

		return $this->stf_status;
	}

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
	 * Get the [stf_job] column value.
	 * 
	 * @return     string
	 */
	public function getStfJob()
	{

		return $this->stf_job;
	}

	/**
	 * Get the [stf_hometown] column value.
	 * 
	 * @return     string
	 */
	public function getStfHometown()
	{

		return $this->stf_hometown;
	}

	/**
	 * Get the [stf_sex] column value.
	 * 
	 * @return     string
	 */
	public function getStfSex()
	{

		return $this->stf_sex;
	}

	/**
	 * Get the [optionally formatted] [stf_bod] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getStfBod($format = 'Y-m-d')
	{

		if ($this->stf_bod === null || $this->stf_bod === '') {
			return null;
		} elseif (!is_int($this->stf_bod)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->stf_bod);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [stf_bod] as date/time value: " . var_export($this->stf_bod, true));
			}
		} else {
			$ts = $this->stf_bod;
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
	 * Get the [optionally formatted] [stf_enterydate] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getStfEnterydate($format = 'Y-m-d')
	{

		if ($this->stf_enterydate === null || $this->stf_enterydate === '') {
			return null;
		} elseif (!is_int($this->stf_enterydate)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->stf_enterydate);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [stf_enterydate] as date/time value: " . var_export($this->stf_enterydate, true));
			}
		} else {
			$ts = $this->stf_enterydate;
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
	 * Get the [stf_nation] column value.
	 * 
	 * @return     string
	 */
	public function getStfNation()
	{

		return $this->stf_nation;
	}

	/**
	 * Get the [stf_idcard] column value.
	 * 
	 * @return     string
	 */
	public function getStfIdcard()
	{

		return $this->stf_idcard;
	}

	/**
	 * Get the [stf_political] column value.
	 * 
	 * @return     string
	 */
	public function getStfPolitical()
	{

		return $this->stf_political;
	}

	/**
	 * Get the [stf_edu] column value.
	 * 
	 * @return     string
	 */
	public function getStfEdu()
	{

		return $this->stf_edu;
	}

	/**
	 * Get the [stf_married] column value.
	 * 
	 * @return     string
	 */
	public function getStfMarried()
	{

		return $this->stf_married;
	}

	/**
	 * Get the [stf_edu_school] column value.
	 * 
	 * @return     string
	 */
	public function getStfEduSchool()
	{

		return $this->stf_edu_school;
	}

	/**
	 * Get the [stf_edu_master] column value.
	 * 
	 * @return     string
	 */
	public function getStfEduMaster()
	{

		return $this->stf_edu_master;
	}

	/**
	 * Get the [stf_salarycard] column value.
	 * 
	 * @return     string
	 */
	public function getStfSalarycard()
	{

		return $this->stf_salarycard;
	}

	/**
	 * Get the [stf_socialcard] column value.
	 * 
	 * @return     string
	 */
	public function getStfSocialcard()
	{

		return $this->stf_socialcard;
	}

	/**
	 * Get the [optionally formatted] [stf_contractdate] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getStfContractdate($format = 'Y-m-d')
	{

		if ($this->stf_contractdate === null || $this->stf_contractdate === '') {
			return null;
		} elseif (!is_int($this->stf_contractdate)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->stf_contractdate);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [stf_contractdate] as date/time value: " . var_export($this->stf_contractdate, true));
			}
		} else {
			$ts = $this->stf_contractdate;
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
	 * Get the [stf_medicalcard] column value.
	 * 
	 * @return     string
	 */
	public function getStfMedicalcard()
	{

		return $this->stf_medicalcard;
	}

	/**
	 * Get the [stf_trialdays] column value.
	 * 
	 * @return     int
	 */
	public function getStfTrialdays()
	{

		return $this->stf_trialdays;
	}

	/**
	 * Get the [stf_address] column value.
	 * 
	 * @return     string
	 */
	public function getStfAddress()
	{

		return $this->stf_address;
	}

	/**
	 * Get the [stf_desc] column value.
	 * 
	 * @return     string
	 */
	public function getStfDesc()
	{

		return $this->stf_desc;
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
	 * Set the value of [usr_uid] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUsrUid($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->usr_uid !== $v || $v === '') {
			$this->usr_uid = $v;
			$this->modifiedColumns[] = RbacStaffPeer::USR_UID;
		}

	} // setUsrUid()

	/**
	 * Set the value of [stf_code] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setStfCode($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stf_code !== $v || $v === '') {
			$this->stf_code = $v;
			$this->modifiedColumns[] = RbacStaffPeer::STF_CODE;
		}

	} // setStfCode()

	/**
	 * Set the value of [stf_status] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setStfStatus($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stf_status !== $v || $v === '') {
			$this->stf_status = $v;
			$this->modifiedColumns[] = RbacStaffPeer::STF_STATUS;
		}

	} // setStfStatus()

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

		if ($this->grp_uid !== $v || $v === '') {
			$this->grp_uid = $v;
			$this->modifiedColumns[] = RbacStaffPeer::GRP_UID;
		}

	} // setGrpUid()

	/**
	 * Set the value of [stf_job] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setStfJob($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stf_job !== $v || $v === '') {
			$this->stf_job = $v;
			$this->modifiedColumns[] = RbacStaffPeer::STF_JOB;
		}

	} // setStfJob()

	/**
	 * Set the value of [stf_hometown] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setStfHometown($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stf_hometown !== $v || $v === '') {
			$this->stf_hometown = $v;
			$this->modifiedColumns[] = RbacStaffPeer::STF_HOMETOWN;
		}

	} // setStfHometown()

	/**
	 * Set the value of [stf_sex] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setStfSex($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stf_sex !== $v || $v === '') {
			$this->stf_sex = $v;
			$this->modifiedColumns[] = RbacStaffPeer::STF_SEX;
		}

	} // setStfSex()

	/**
	 * Set the value of [stf_bod] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setStfBod($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [stf_bod] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->stf_bod !== $ts) {
			$this->stf_bod = $ts;
			$this->modifiedColumns[] = RbacStaffPeer::STF_BOD;
		}

	} // setStfBod()

	/**
	 * Set the value of [stf_enterydate] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setStfEnterydate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [stf_enterydate] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->stf_enterydate !== $ts) {
			$this->stf_enterydate = $ts;
			$this->modifiedColumns[] = RbacStaffPeer::STF_ENTERYDATE;
		}

	} // setStfEnterydate()

	/**
	 * Set the value of [stf_nation] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setStfNation($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stf_nation !== $v || $v === '') {
			$this->stf_nation = $v;
			$this->modifiedColumns[] = RbacStaffPeer::STF_NATION;
		}

	} // setStfNation()

	/**
	 * Set the value of [stf_idcard] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setStfIdcard($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stf_idcard !== $v || $v === '') {
			$this->stf_idcard = $v;
			$this->modifiedColumns[] = RbacStaffPeer::STF_IDCARD;
		}

	} // setStfIdcard()

	/**
	 * Set the value of [stf_political] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setStfPolitical($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stf_political !== $v || $v === '') {
			$this->stf_political = $v;
			$this->modifiedColumns[] = RbacStaffPeer::STF_POLITICAL;
		}

	} // setStfPolitical()

	/**
	 * Set the value of [stf_edu] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setStfEdu($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stf_edu !== $v || $v === '') {
			$this->stf_edu = $v;
			$this->modifiedColumns[] = RbacStaffPeer::STF_EDU;
		}

	} // setStfEdu()

	/**
	 * Set the value of [stf_married] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setStfMarried($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stf_married !== $v || $v === '') {
			$this->stf_married = $v;
			$this->modifiedColumns[] = RbacStaffPeer::STF_MARRIED;
		}

	} // setStfMarried()

	/**
	 * Set the value of [stf_edu_school] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setStfEduSchool($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stf_edu_school !== $v || $v === '') {
			$this->stf_edu_school = $v;
			$this->modifiedColumns[] = RbacStaffPeer::STF_EDU_SCHOOL;
		}

	} // setStfEduSchool()

	/**
	 * Set the value of [stf_edu_master] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setStfEduMaster($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stf_edu_master !== $v || $v === '') {
			$this->stf_edu_master = $v;
			$this->modifiedColumns[] = RbacStaffPeer::STF_EDU_MASTER;
		}

	} // setStfEduMaster()

	/**
	 * Set the value of [stf_salarycard] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setStfSalarycard($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stf_salarycard !== $v || $v === '') {
			$this->stf_salarycard = $v;
			$this->modifiedColumns[] = RbacStaffPeer::STF_SALARYCARD;
		}

	} // setStfSalarycard()

	/**
	 * Set the value of [stf_socialcard] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setStfSocialcard($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stf_socialcard !== $v || $v === '') {
			$this->stf_socialcard = $v;
			$this->modifiedColumns[] = RbacStaffPeer::STF_SOCIALCARD;
		}

	} // setStfSocialcard()

	/**
	 * Set the value of [stf_contractdate] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setStfContractdate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [stf_contractdate] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->stf_contractdate !== $ts) {
			$this->stf_contractdate = $ts;
			$this->modifiedColumns[] = RbacStaffPeer::STF_CONTRACTDATE;
		}

	} // setStfContractdate()

	/**
	 * Set the value of [stf_medicalcard] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setStfMedicalcard($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stf_medicalcard !== $v || $v === '') {
			$this->stf_medicalcard = $v;
			$this->modifiedColumns[] = RbacStaffPeer::STF_MEDICALCARD;
		}

	} // setStfMedicalcard()

	/**
	 * Set the value of [stf_trialdays] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setStfTrialdays($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->stf_trialdays !== $v || $v === 0) {
			$this->stf_trialdays = $v;
			$this->modifiedColumns[] = RbacStaffPeer::STF_TRIALDAYS;
		}

	} // setStfTrialdays()

	/**
	 * Set the value of [stf_address] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setStfAddress($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stf_address !== $v) {
			$this->stf_address = $v;
			$this->modifiedColumns[] = RbacStaffPeer::STF_ADDRESS;
		}

	} // setStfAddress()

	/**
	 * Set the value of [stf_desc] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setStfDesc($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stf_desc !== $v) {
			$this->stf_desc = $v;
			$this->modifiedColumns[] = RbacStaffPeer::STF_DESC;
		}

	} // setStfDesc()

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
			$this->modifiedColumns[] = RbacStaffPeer::CREATE_DATE;
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
			$this->modifiedColumns[] = RbacStaffPeer::MODIFIED_BY;
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
			$this->modifiedColumns[] = RbacStaffPeer::MODIFIED_AT;
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

			$this->usr_uid = $rs->getString($startcol + 0);

			$this->stf_code = $rs->getString($startcol + 1);

			$this->stf_status = $rs->getString($startcol + 2);

			$this->grp_uid = $rs->getString($startcol + 3);

			$this->stf_job = $rs->getString($startcol + 4);

			$this->stf_hometown = $rs->getString($startcol + 5);

			$this->stf_sex = $rs->getString($startcol + 6);

			$this->stf_bod = $rs->getDate($startcol + 7, null);

			$this->stf_enterydate = $rs->getDate($startcol + 8, null);

			$this->stf_nation = $rs->getString($startcol + 9);

			$this->stf_idcard = $rs->getString($startcol + 10);

			$this->stf_political = $rs->getString($startcol + 11);

			$this->stf_edu = $rs->getString($startcol + 12);

			$this->stf_married = $rs->getString($startcol + 13);

			$this->stf_edu_school = $rs->getString($startcol + 14);

			$this->stf_edu_master = $rs->getString($startcol + 15);

			$this->stf_salarycard = $rs->getString($startcol + 16);

			$this->stf_socialcard = $rs->getString($startcol + 17);

			$this->stf_contractdate = $rs->getDate($startcol + 18, null);

			$this->stf_medicalcard = $rs->getString($startcol + 19);

			$this->stf_trialdays = $rs->getInt($startcol + 20);

			$this->stf_address = $rs->getString($startcol + 21);

			$this->stf_desc = $rs->getString($startcol + 22);

			$this->create_date = $rs->getTimestamp($startcol + 23, null);

			$this->modified_by = $rs->getString($startcol + 24);

			$this->modified_at = $rs->getTimestamp($startcol + 25, null);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 26; // 26 = RbacStaffPeer::NUM_COLUMNS - RbacStaffPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating RbacStaff object", $e);
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
			$con = Propel::getConnection(RbacStaffPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RbacStaffPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(RbacStaffPeer::DATABASE_NAME);
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
					$pk = RbacStaffPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += RbacStaffPeer::doUpdate($this, $con);
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


			if (($retval = RbacStaffPeer::doValidate($this, $columns)) !== true) {
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
		$pos = RbacStaffPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getUsrUid();
				break;
			case 1:
				return $this->getStfCode();
				break;
			case 2:
				return $this->getStfStatus();
				break;
			case 3:
				return $this->getGrpUid();
				break;
			case 4:
				return $this->getStfJob();
				break;
			case 5:
				return $this->getStfHometown();
				break;
			case 6:
				return $this->getStfSex();
				break;
			case 7:
				return $this->getStfBod();
				break;
			case 8:
				return $this->getStfEnterydate();
				break;
			case 9:
				return $this->getStfNation();
				break;
			case 10:
				return $this->getStfIdcard();
				break;
			case 11:
				return $this->getStfPolitical();
				break;
			case 12:
				return $this->getStfEdu();
				break;
			case 13:
				return $this->getStfMarried();
				break;
			case 14:
				return $this->getStfEduSchool();
				break;
			case 15:
				return $this->getStfEduMaster();
				break;
			case 16:
				return $this->getStfSalarycard();
				break;
			case 17:
				return $this->getStfSocialcard();
				break;
			case 18:
				return $this->getStfContractdate();
				break;
			case 19:
				return $this->getStfMedicalcard();
				break;
			case 20:
				return $this->getStfTrialdays();
				break;
			case 21:
				return $this->getStfAddress();
				break;
			case 22:
				return $this->getStfDesc();
				break;
			case 23:
				return $this->getCreateDate();
				break;
			case 24:
				return $this->getModifiedBy();
				break;
			case 25:
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
		$keys = RbacStaffPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getUsrUid(),
			$keys[1] => $this->getStfCode(),
			$keys[2] => $this->getStfStatus(),
			$keys[3] => $this->getGrpUid(),
			$keys[4] => $this->getStfJob(),
			$keys[5] => $this->getStfHometown(),
			$keys[6] => $this->getStfSex(),
			$keys[7] => $this->getStfBod(),
			$keys[8] => $this->getStfEnterydate(),
			$keys[9] => $this->getStfNation(),
			$keys[10] => $this->getStfIdcard(),
			$keys[11] => $this->getStfPolitical(),
			$keys[12] => $this->getStfEdu(),
			$keys[13] => $this->getStfMarried(),
			$keys[14] => $this->getStfEduSchool(),
			$keys[15] => $this->getStfEduMaster(),
			$keys[16] => $this->getStfSalarycard(),
			$keys[17] => $this->getStfSocialcard(),
			$keys[18] => $this->getStfContractdate(),
			$keys[19] => $this->getStfMedicalcard(),
			$keys[20] => $this->getStfTrialdays(),
			$keys[21] => $this->getStfAddress(),
			$keys[22] => $this->getStfDesc(),
			$keys[23] => $this->getCreateDate(),
			$keys[24] => $this->getModifiedBy(),
			$keys[25] => $this->getModifiedAt(),
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
		$pos = RbacStaffPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setUsrUid($value);
				break;
			case 1:
				$this->setStfCode($value);
				break;
			case 2:
				$this->setStfStatus($value);
				break;
			case 3:
				$this->setGrpUid($value);
				break;
			case 4:
				$this->setStfJob($value);
				break;
			case 5:
				$this->setStfHometown($value);
				break;
			case 6:
				$this->setStfSex($value);
				break;
			case 7:
				$this->setStfBod($value);
				break;
			case 8:
				$this->setStfEnterydate($value);
				break;
			case 9:
				$this->setStfNation($value);
				break;
			case 10:
				$this->setStfIdcard($value);
				break;
			case 11:
				$this->setStfPolitical($value);
				break;
			case 12:
				$this->setStfEdu($value);
				break;
			case 13:
				$this->setStfMarried($value);
				break;
			case 14:
				$this->setStfEduSchool($value);
				break;
			case 15:
				$this->setStfEduMaster($value);
				break;
			case 16:
				$this->setStfSalarycard($value);
				break;
			case 17:
				$this->setStfSocialcard($value);
				break;
			case 18:
				$this->setStfContractdate($value);
				break;
			case 19:
				$this->setStfMedicalcard($value);
				break;
			case 20:
				$this->setStfTrialdays($value);
				break;
			case 21:
				$this->setStfAddress($value);
				break;
			case 22:
				$this->setStfDesc($value);
				break;
			case 23:
				$this->setCreateDate($value);
				break;
			case 24:
				$this->setModifiedBy($value);
				break;
			case 25:
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
		$keys = RbacStaffPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setUsrUid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setStfCode($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setStfStatus($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setGrpUid($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setStfJob($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setStfHometown($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setStfSex($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setStfBod($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setStfEnterydate($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setStfNation($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setStfIdcard($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setStfPolitical($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setStfEdu($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setStfMarried($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setStfEduSchool($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setStfEduMaster($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setStfSalarycard($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setStfSocialcard($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setStfContractdate($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setStfMedicalcard($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setStfTrialdays($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setStfAddress($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setStfDesc($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setCreateDate($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setModifiedBy($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setModifiedAt($arr[$keys[25]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(RbacStaffPeer::DATABASE_NAME);

		if ($this->isColumnModified(RbacStaffPeer::USR_UID)) $criteria->add(RbacStaffPeer::USR_UID, $this->usr_uid);
		if ($this->isColumnModified(RbacStaffPeer::STF_CODE)) $criteria->add(RbacStaffPeer::STF_CODE, $this->stf_code);
		if ($this->isColumnModified(RbacStaffPeer::STF_STATUS)) $criteria->add(RbacStaffPeer::STF_STATUS, $this->stf_status);
		if ($this->isColumnModified(RbacStaffPeer::GRP_UID)) $criteria->add(RbacStaffPeer::GRP_UID, $this->grp_uid);
		if ($this->isColumnModified(RbacStaffPeer::STF_JOB)) $criteria->add(RbacStaffPeer::STF_JOB, $this->stf_job);
		if ($this->isColumnModified(RbacStaffPeer::STF_HOMETOWN)) $criteria->add(RbacStaffPeer::STF_HOMETOWN, $this->stf_hometown);
		if ($this->isColumnModified(RbacStaffPeer::STF_SEX)) $criteria->add(RbacStaffPeer::STF_SEX, $this->stf_sex);
		if ($this->isColumnModified(RbacStaffPeer::STF_BOD)) $criteria->add(RbacStaffPeer::STF_BOD, $this->stf_bod);
		if ($this->isColumnModified(RbacStaffPeer::STF_ENTERYDATE)) $criteria->add(RbacStaffPeer::STF_ENTERYDATE, $this->stf_enterydate);
		if ($this->isColumnModified(RbacStaffPeer::STF_NATION)) $criteria->add(RbacStaffPeer::STF_NATION, $this->stf_nation);
		if ($this->isColumnModified(RbacStaffPeer::STF_IDCARD)) $criteria->add(RbacStaffPeer::STF_IDCARD, $this->stf_idcard);
		if ($this->isColumnModified(RbacStaffPeer::STF_POLITICAL)) $criteria->add(RbacStaffPeer::STF_POLITICAL, $this->stf_political);
		if ($this->isColumnModified(RbacStaffPeer::STF_EDU)) $criteria->add(RbacStaffPeer::STF_EDU, $this->stf_edu);
		if ($this->isColumnModified(RbacStaffPeer::STF_MARRIED)) $criteria->add(RbacStaffPeer::STF_MARRIED, $this->stf_married);
		if ($this->isColumnModified(RbacStaffPeer::STF_EDU_SCHOOL)) $criteria->add(RbacStaffPeer::STF_EDU_SCHOOL, $this->stf_edu_school);
		if ($this->isColumnModified(RbacStaffPeer::STF_EDU_MASTER)) $criteria->add(RbacStaffPeer::STF_EDU_MASTER, $this->stf_edu_master);
		if ($this->isColumnModified(RbacStaffPeer::STF_SALARYCARD)) $criteria->add(RbacStaffPeer::STF_SALARYCARD, $this->stf_salarycard);
		if ($this->isColumnModified(RbacStaffPeer::STF_SOCIALCARD)) $criteria->add(RbacStaffPeer::STF_SOCIALCARD, $this->stf_socialcard);
		if ($this->isColumnModified(RbacStaffPeer::STF_CONTRACTDATE)) $criteria->add(RbacStaffPeer::STF_CONTRACTDATE, $this->stf_contractdate);
		if ($this->isColumnModified(RbacStaffPeer::STF_MEDICALCARD)) $criteria->add(RbacStaffPeer::STF_MEDICALCARD, $this->stf_medicalcard);
		if ($this->isColumnModified(RbacStaffPeer::STF_TRIALDAYS)) $criteria->add(RbacStaffPeer::STF_TRIALDAYS, $this->stf_trialdays);
		if ($this->isColumnModified(RbacStaffPeer::STF_ADDRESS)) $criteria->add(RbacStaffPeer::STF_ADDRESS, $this->stf_address);
		if ($this->isColumnModified(RbacStaffPeer::STF_DESC)) $criteria->add(RbacStaffPeer::STF_DESC, $this->stf_desc);
		if ($this->isColumnModified(RbacStaffPeer::CREATE_DATE)) $criteria->add(RbacStaffPeer::CREATE_DATE, $this->create_date);
		if ($this->isColumnModified(RbacStaffPeer::MODIFIED_BY)) $criteria->add(RbacStaffPeer::MODIFIED_BY, $this->modified_by);
		if ($this->isColumnModified(RbacStaffPeer::MODIFIED_AT)) $criteria->add(RbacStaffPeer::MODIFIED_AT, $this->modified_at);

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
		$criteria = new Criteria(RbacStaffPeer::DATABASE_NAME);

		$criteria->add(RbacStaffPeer::USR_UID, $this->usr_uid);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getUsrUid();
	}

	/**
	 * Generic method to set the primary key (usr_uid column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setUsrUid($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of RbacStaff (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setStfCode($this->stf_code);

		$copyObj->setStfStatus($this->stf_status);

		$copyObj->setGrpUid($this->grp_uid);

		$copyObj->setStfJob($this->stf_job);

		$copyObj->setStfHometown($this->stf_hometown);

		$copyObj->setStfSex($this->stf_sex);

		$copyObj->setStfBod($this->stf_bod);

		$copyObj->setStfEnterydate($this->stf_enterydate);

		$copyObj->setStfNation($this->stf_nation);

		$copyObj->setStfIdcard($this->stf_idcard);

		$copyObj->setStfPolitical($this->stf_political);

		$copyObj->setStfEdu($this->stf_edu);

		$copyObj->setStfMarried($this->stf_married);

		$copyObj->setStfEduSchool($this->stf_edu_school);

		$copyObj->setStfEduMaster($this->stf_edu_master);

		$copyObj->setStfSalarycard($this->stf_salarycard);

		$copyObj->setStfSocialcard($this->stf_socialcard);

		$copyObj->setStfContractdate($this->stf_contractdate);

		$copyObj->setStfMedicalcard($this->stf_medicalcard);

		$copyObj->setStfTrialdays($this->stf_trialdays);

		$copyObj->setStfAddress($this->stf_address);

		$copyObj->setStfDesc($this->stf_desc);

		$copyObj->setCreateDate($this->create_date);

		$copyObj->setModifiedBy($this->modified_by);

		$copyObj->setModifiedAt($this->modified_at);


		$copyObj->setNew(true);

		$copyObj->setUsrUid(''); // this is a pkey column, so set to default value

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
	 * @return     RbacStaff Clone of current object.
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
	 * @return     RbacStaffPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RbacStaffPeer();
		}
		return self::$peer;
	}

} // BaseRbacStaff
