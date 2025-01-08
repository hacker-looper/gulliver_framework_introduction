<?php

require_once 'propel/om/BaseObject.php';

require_once 'propel/om/Persistent.php';


include_once 'propel/util/Criteria.php';

include_once 'classes/model/RbacUserPeer.php';

/**
 * Base class that represents a row from the 'RBAC_USER' table.
 *
 * 
 *
 * @package    workflow.classes.model.om
 */
abstract class BaseRbacUser extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        RbacUserPeer
	 */
	protected static $peer;


	/**
	 * The value for the usr_uid field.
	 * @var        string
	 */
	protected $usr_uid = '';


	/**
	 * The value for the usr_username field.
	 * @var        string
	 */
	protected $usr_username = '';


	/**
	 * The value for the usr_password field.
	 * @var        string
	 */
	protected $usr_password = '';


	/**
	 * The value for the usr_fullname field.
	 * @var        string
	 */
	protected $usr_fullname = '';


	/**
	 * The value for the usr_nickname field.
	 * @var        string
	 */
	protected $usr_nickname = '';


	/**
	 * The value for the usr_nickname_isuse field.
	 * @var        string
	 */
	protected $usr_nickname_isuse = '0';


	/**
	 * The value for the usr_sex field.
	 * @var        string
	 */
	protected $usr_sex = '1';


	/**
	 * The value for the usr_email field.
	 * @var        string
	 */
	protected $usr_email = '';


	/**
	 * The value for the usr_phone field.
	 * @var        string
	 */
	protected $usr_phone = '';


	/**
	 * The value for the usr_roles field.
	 * @var        string
	 */
	protected $usr_roles;


	/**
	 * The value for the usr_remember_token field.
	 * @var        string
	 */
	protected $usr_remember_token = '';


	/**
	 * The value for the usr_status field.
	 * @var        string
	 */
	protected $usr_status = '1';


	/**
	 * The value for the usr_image field.
	 * @var        string
	 */
	protected $usr_image = '';


	/**
	 * The value for the usr_selfdesc field.
	 * @var        string
	 */
	protected $usr_selfdesc = '';


	/**
	 * The value for the usr_address field.
	 * @var        string
	 */
	protected $usr_address;


	/**
	 * The value for the usr_sns_wechat field.
	 * @var        string
	 */
	protected $usr_sns_wechat = '';


	/**
	 * The value for the usr_sns_weibo field.
	 * @var        string
	 */
	protected $usr_sns_weibo = '';


	/**
	 * The value for the usr_sns_qq field.
	 * @var        string
	 */
	protected $usr_sns_qq = '';


	/**
	 * The value for the usr_goal field.
	 * @var        int
	 */
	protected $usr_goal = 0;


	/**
	 * The value for the usr_level field.
	 * @var        int
	 */
	protected $usr_level = 1;


	/**
	 * The value for the usr_coin field.
	 * @var        int
	 */
	protected $usr_coin = 0;


	/**
	 * The value for the usr_expire_date field.
	 * @var        int
	 */
	protected $usr_expire_date;


	/**
	 * The value for the usr_account_balance field.
	 * @var        double
	 */
	protected $usr_account_balance = 0;


	/**
	 * The value for the usr_api_key field.
	 * @var        string
	 */
	protected $usr_api_key;


	/**
	 * The value for the usr_lastlogin field.
	 * @var        int
	 */
	protected $usr_lastlogin;


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
	 * Get the [usr_username] column value.
	 * 
	 * @return     string
	 */
	public function getUsrUsername()
	{

		return $this->usr_username;
	}

	/**
	 * Get the [usr_password] column value.
	 * 
	 * @return     string
	 */
	public function getUsrPassword()
	{

		return $this->usr_password;
	}

	/**
	 * Get the [usr_fullname] column value.
	 * 
	 * @return     string
	 */
	public function getUsrFullname()
	{

		return $this->usr_fullname;
	}

	/**
	 * Get the [usr_nickname] column value.
	 * 
	 * @return     string
	 */
	public function getUsrNickname()
	{

		return $this->usr_nickname;
	}

	/**
	 * Get the [usr_nickname_isuse] column value.
	 * 
	 * @return     string
	 */
	public function getUsrNicknameIsuse()
	{

		return $this->usr_nickname_isuse;
	}

	/**
	 * Get the [usr_sex] column value.
	 * 
	 * @return     string
	 */
	public function getUsrSex()
	{

		return $this->usr_sex;
	}

	/**
	 * Get the [usr_email] column value.
	 * 
	 * @return     string
	 */
	public function getUsrEmail()
	{

		return $this->usr_email;
	}

	/**
	 * Get the [usr_phone] column value.
	 * 
	 * @return     string
	 */
	public function getUsrPhone()
	{

		return $this->usr_phone;
	}

	/**
	 * Get the [usr_roles] column value.
	 * 
	 * @return     string
	 */
	public function getUsrRoles()
	{

		return $this->usr_roles;
	}

	/**
	 * Get the [usr_remember_token] column value.
	 * 
	 * @return     string
	 */
	public function getUsrRememberToken()
	{

		return $this->usr_remember_token;
	}

	/**
	 * Get the [usr_status] column value.
	 * 
	 * @return     string
	 */
	public function getUsrStatus()
	{

		return $this->usr_status;
	}

	/**
	 * Get the [usr_image] column value.
	 * 
	 * @return     string
	 */
	public function getUsrImage()
	{

		return $this->usr_image;
	}

	/**
	 * Get the [usr_selfdesc] column value.
	 * 
	 * @return     string
	 */
	public function getUsrSelfdesc()
	{

		return $this->usr_selfdesc;
	}

	/**
	 * Get the [usr_address] column value.
	 * 
	 * @return     string
	 */
	public function getUsrAddress()
	{

		return $this->usr_address;
	}

	/**
	 * Get the [usr_sns_wechat] column value.
	 * 
	 * @return     string
	 */
	public function getUsrSnsWechat()
	{

		return $this->usr_sns_wechat;
	}

	/**
	 * Get the [usr_sns_weibo] column value.
	 * 
	 * @return     string
	 */
	public function getUsrSnsWeibo()
	{

		return $this->usr_sns_weibo;
	}

	/**
	 * Get the [usr_sns_qq] column value.
	 * 
	 * @return     string
	 */
	public function getUsrSnsQq()
	{

		return $this->usr_sns_qq;
	}

	/**
	 * Get the [usr_goal] column value.
	 * 
	 * @return     int
	 */
	public function getUsrGoal()
	{

		return $this->usr_goal;
	}

	/**
	 * Get the [usr_level] column value.
	 * 
	 * @return     int
	 */
	public function getUsrLevel()
	{

		return $this->usr_level;
	}

	/**
	 * Get the [usr_coin] column value.
	 * 
	 * @return     int
	 */
	public function getUsrCoin()
	{

		return $this->usr_coin;
	}

	/**
	 * Get the [optionally formatted] [usr_expire_date] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getUsrExpireDate($format = 'Y-m-d')
	{

		if ($this->usr_expire_date === null || $this->usr_expire_date === '') {
			return null;
		} elseif (!is_int($this->usr_expire_date)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->usr_expire_date);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [usr_expire_date] as date/time value: " . var_export($this->usr_expire_date, true));
			}
		} else {
			$ts = $this->usr_expire_date;
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
	 * Get the [usr_account_balance] column value.
	 * 
	 * @return     double
	 */
	public function getUsrAccountBalance()
	{

		return $this->usr_account_balance;
	}

	/**
	 * Get the [usr_api_key] column value.
	 * 
	 * @return     string
	 */
	public function getUsrApiKey()
	{

		return $this->usr_api_key;
	}

	/**
	 * Get the [optionally formatted] [usr_lastlogin] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getUsrLastlogin($format = 'Y-m-d H:i:s')
	{

		if ($this->usr_lastlogin === null || $this->usr_lastlogin === '') {
			return null;
		} elseif (!is_int($this->usr_lastlogin)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->usr_lastlogin);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [usr_lastlogin] as date/time value: " . var_export($this->usr_lastlogin, true));
			}
		} else {
			$ts = $this->usr_lastlogin;
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
			$this->modifiedColumns[] = RbacUserPeer::USR_UID;
		}

	} // setUsrUid()

	/**
	 * Set the value of [usr_username] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUsrUsername($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->usr_username !== $v || $v === '') {
			$this->usr_username = $v;
			$this->modifiedColumns[] = RbacUserPeer::USR_USERNAME;
		}

	} // setUsrUsername()

	/**
	 * Set the value of [usr_password] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUsrPassword($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->usr_password !== $v || $v === '') {
			$this->usr_password = $v;
			$this->modifiedColumns[] = RbacUserPeer::USR_PASSWORD;
		}

	} // setUsrPassword()

	/**
	 * Set the value of [usr_fullname] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUsrFullname($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->usr_fullname !== $v || $v === '') {
			$this->usr_fullname = $v;
			$this->modifiedColumns[] = RbacUserPeer::USR_FULLNAME;
		}

	} // setUsrFullname()

	/**
	 * Set the value of [usr_nickname] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUsrNickname($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->usr_nickname !== $v || $v === '') {
			$this->usr_nickname = $v;
			$this->modifiedColumns[] = RbacUserPeer::USR_NICKNAME;
		}

	} // setUsrNickname()

	/**
	 * Set the value of [usr_nickname_isuse] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUsrNicknameIsuse($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->usr_nickname_isuse !== $v || $v === '0') {
			$this->usr_nickname_isuse = $v;
			$this->modifiedColumns[] = RbacUserPeer::USR_NICKNAME_ISUSE;
		}

	} // setUsrNicknameIsuse()

	/**
	 * Set the value of [usr_sex] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUsrSex($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->usr_sex !== $v || $v === '1') {
			$this->usr_sex = $v;
			$this->modifiedColumns[] = RbacUserPeer::USR_SEX;
		}

	} // setUsrSex()

	/**
	 * Set the value of [usr_email] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUsrEmail($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->usr_email !== $v || $v === '') {
			$this->usr_email = $v;
			$this->modifiedColumns[] = RbacUserPeer::USR_EMAIL;
		}

	} // setUsrEmail()

	/**
	 * Set the value of [usr_phone] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUsrPhone($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->usr_phone !== $v || $v === '') {
			$this->usr_phone = $v;
			$this->modifiedColumns[] = RbacUserPeer::USR_PHONE;
		}

	} // setUsrPhone()

	/**
	 * Set the value of [usr_roles] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUsrRoles($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->usr_roles !== $v) {
			$this->usr_roles = $v;
			$this->modifiedColumns[] = RbacUserPeer::USR_ROLES;
		}

	} // setUsrRoles()

	/**
	 * Set the value of [usr_remember_token] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUsrRememberToken($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->usr_remember_token !== $v || $v === '') {
			$this->usr_remember_token = $v;
			$this->modifiedColumns[] = RbacUserPeer::USR_REMEMBER_TOKEN;
		}

	} // setUsrRememberToken()

	/**
	 * Set the value of [usr_status] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUsrStatus($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->usr_status !== $v || $v === '1') {
			$this->usr_status = $v;
			$this->modifiedColumns[] = RbacUserPeer::USR_STATUS;
		}

	} // setUsrStatus()

	/**
	 * Set the value of [usr_image] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUsrImage($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->usr_image !== $v || $v === '') {
			$this->usr_image = $v;
			$this->modifiedColumns[] = RbacUserPeer::USR_IMAGE;
		}

	} // setUsrImage()

	/**
	 * Set the value of [usr_selfdesc] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUsrSelfdesc($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->usr_selfdesc !== $v || $v === '') {
			$this->usr_selfdesc = $v;
			$this->modifiedColumns[] = RbacUserPeer::USR_SELFDESC;
		}

	} // setUsrSelfdesc()

	/**
	 * Set the value of [usr_address] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUsrAddress($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->usr_address !== $v) {
			$this->usr_address = $v;
			$this->modifiedColumns[] = RbacUserPeer::USR_ADDRESS;
		}

	} // setUsrAddress()

	/**
	 * Set the value of [usr_sns_wechat] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUsrSnsWechat($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->usr_sns_wechat !== $v || $v === '') {
			$this->usr_sns_wechat = $v;
			$this->modifiedColumns[] = RbacUserPeer::USR_SNS_WECHAT;
		}

	} // setUsrSnsWechat()

	/**
	 * Set the value of [usr_sns_weibo] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUsrSnsWeibo($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->usr_sns_weibo !== $v || $v === '') {
			$this->usr_sns_weibo = $v;
			$this->modifiedColumns[] = RbacUserPeer::USR_SNS_WEIBO;
		}

	} // setUsrSnsWeibo()

	/**
	 * Set the value of [usr_sns_qq] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUsrSnsQq($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->usr_sns_qq !== $v || $v === '') {
			$this->usr_sns_qq = $v;
			$this->modifiedColumns[] = RbacUserPeer::USR_SNS_QQ;
		}

	} // setUsrSnsQq()

	/**
	 * Set the value of [usr_goal] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setUsrGoal($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->usr_goal !== $v || $v === 0) {
			$this->usr_goal = $v;
			$this->modifiedColumns[] = RbacUserPeer::USR_GOAL;
		}

	} // setUsrGoal()

	/**
	 * Set the value of [usr_level] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setUsrLevel($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->usr_level !== $v || $v === 1) {
			$this->usr_level = $v;
			$this->modifiedColumns[] = RbacUserPeer::USR_LEVEL;
		}

	} // setUsrLevel()

	/**
	 * Set the value of [usr_coin] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setUsrCoin($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->usr_coin !== $v || $v === 0) {
			$this->usr_coin = $v;
			$this->modifiedColumns[] = RbacUserPeer::USR_COIN;
		}

	} // setUsrCoin()

	/**
	 * Set the value of [usr_expire_date] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setUsrExpireDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [usr_expire_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->usr_expire_date !== $ts) {
			$this->usr_expire_date = $ts;
			$this->modifiedColumns[] = RbacUserPeer::USR_EXPIRE_DATE;
		}

	} // setUsrExpireDate()

	/**
	 * Set the value of [usr_account_balance] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setUsrAccountBalance($v)
	{

		if ($this->usr_account_balance !== $v || $v === 0) {
			$this->usr_account_balance = $v;
			$this->modifiedColumns[] = RbacUserPeer::USR_ACCOUNT_BALANCE;
		}

	} // setUsrAccountBalance()

	/**
	 * Set the value of [usr_api_key] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUsrApiKey($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->usr_api_key !== $v) {
			$this->usr_api_key = $v;
			$this->modifiedColumns[] = RbacUserPeer::USR_API_KEY;
		}

	} // setUsrApiKey()

	/**
	 * Set the value of [usr_lastlogin] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setUsrLastlogin($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [usr_lastlogin] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->usr_lastlogin !== $ts) {
			$this->usr_lastlogin = $ts;
			$this->modifiedColumns[] = RbacUserPeer::USR_LASTLOGIN;
		}

	} // setUsrLastlogin()

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
			$this->modifiedColumns[] = RbacUserPeer::CREATE_DATE;
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
			$this->modifiedColumns[] = RbacUserPeer::MODIFIED_BY;
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
			$this->modifiedColumns[] = RbacUserPeer::MODIFIED_AT;
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

			$this->usr_username = $rs->getString($startcol + 1);

			$this->usr_password = $rs->getString($startcol + 2);

			$this->usr_fullname = $rs->getString($startcol + 3);

			$this->usr_nickname = $rs->getString($startcol + 4);

			$this->usr_nickname_isuse = $rs->getString($startcol + 5);

			$this->usr_sex = $rs->getString($startcol + 6);

			$this->usr_email = $rs->getString($startcol + 7);

			$this->usr_phone = $rs->getString($startcol + 8);

			$this->usr_roles = $rs->getString($startcol + 9);

			$this->usr_remember_token = $rs->getString($startcol + 10);

			$this->usr_status = $rs->getString($startcol + 11);

			$this->usr_image = $rs->getString($startcol + 12);

			$this->usr_selfdesc = $rs->getString($startcol + 13);

			$this->usr_address = $rs->getString($startcol + 14);

			$this->usr_sns_wechat = $rs->getString($startcol + 15);

			$this->usr_sns_weibo = $rs->getString($startcol + 16);

			$this->usr_sns_qq = $rs->getString($startcol + 17);

			$this->usr_goal = $rs->getInt($startcol + 18);

			$this->usr_level = $rs->getInt($startcol + 19);

			$this->usr_coin = $rs->getInt($startcol + 20);

			$this->usr_expire_date = $rs->getDate($startcol + 21, null);

			$this->usr_account_balance = $rs->getFloat($startcol + 22);

			$this->usr_api_key = $rs->getString($startcol + 23);

			$this->usr_lastlogin = $rs->getTimestamp($startcol + 24, null);

			$this->create_date = $rs->getTimestamp($startcol + 25, null);

			$this->modified_by = $rs->getString($startcol + 26);

			$this->modified_at = $rs->getTimestamp($startcol + 27, null);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 28; // 28 = RbacUserPeer::NUM_COLUMNS - RbacUserPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating RbacUser object", $e);
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
			$con = Propel::getConnection(RbacUserPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RbacUserPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(RbacUserPeer::DATABASE_NAME);
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
					$pk = RbacUserPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += RbacUserPeer::doUpdate($this, $con);
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


			if (($retval = RbacUserPeer::doValidate($this, $columns)) !== true) {
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
		$pos = RbacUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getUsrUsername();
				break;
			case 2:
				return $this->getUsrPassword();
				break;
			case 3:
				return $this->getUsrFullname();
				break;
			case 4:
				return $this->getUsrNickname();
				break;
			case 5:
				return $this->getUsrNicknameIsuse();
				break;
			case 6:
				return $this->getUsrSex();
				break;
			case 7:
				return $this->getUsrEmail();
				break;
			case 8:
				return $this->getUsrPhone();
				break;
			case 9:
				return $this->getUsrRoles();
				break;
			case 10:
				return $this->getUsrRememberToken();
				break;
			case 11:
				return $this->getUsrStatus();
				break;
			case 12:
				return $this->getUsrImage();
				break;
			case 13:
				return $this->getUsrSelfdesc();
				break;
			case 14:
				return $this->getUsrAddress();
				break;
			case 15:
				return $this->getUsrSnsWechat();
				break;
			case 16:
				return $this->getUsrSnsWeibo();
				break;
			case 17:
				return $this->getUsrSnsQq();
				break;
			case 18:
				return $this->getUsrGoal();
				break;
			case 19:
				return $this->getUsrLevel();
				break;
			case 20:
				return $this->getUsrCoin();
				break;
			case 21:
				return $this->getUsrExpireDate();
				break;
			case 22:
				return $this->getUsrAccountBalance();
				break;
			case 23:
				return $this->getUsrApiKey();
				break;
			case 24:
				return $this->getUsrLastlogin();
				break;
			case 25:
				return $this->getCreateDate();
				break;
			case 26:
				return $this->getModifiedBy();
				break;
			case 27:
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
		$keys = RbacUserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getUsrUid(),
			$keys[1] => $this->getUsrUsername(),
			$keys[2] => $this->getUsrPassword(),
			$keys[3] => $this->getUsrFullname(),
			$keys[4] => $this->getUsrNickname(),
			$keys[5] => $this->getUsrNicknameIsuse(),
			$keys[6] => $this->getUsrSex(),
			$keys[7] => $this->getUsrEmail(),
			$keys[8] => $this->getUsrPhone(),
			$keys[9] => $this->getUsrRoles(),
			$keys[10] => $this->getUsrRememberToken(),
			$keys[11] => $this->getUsrStatus(),
			$keys[12] => $this->getUsrImage(),
			$keys[13] => $this->getUsrSelfdesc(),
			$keys[14] => $this->getUsrAddress(),
			$keys[15] => $this->getUsrSnsWechat(),
			$keys[16] => $this->getUsrSnsWeibo(),
			$keys[17] => $this->getUsrSnsQq(),
			$keys[18] => $this->getUsrGoal(),
			$keys[19] => $this->getUsrLevel(),
			$keys[20] => $this->getUsrCoin(),
			$keys[21] => $this->getUsrExpireDate(),
			$keys[22] => $this->getUsrAccountBalance(),
			$keys[23] => $this->getUsrApiKey(),
			$keys[24] => $this->getUsrLastlogin(),
			$keys[25] => $this->getCreateDate(),
			$keys[26] => $this->getModifiedBy(),
			$keys[27] => $this->getModifiedAt(),
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
		$pos = RbacUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setUsrUsername($value);
				break;
			case 2:
				$this->setUsrPassword($value);
				break;
			case 3:
				$this->setUsrFullname($value);
				break;
			case 4:
				$this->setUsrNickname($value);
				break;
			case 5:
				$this->setUsrNicknameIsuse($value);
				break;
			case 6:
				$this->setUsrSex($value);
				break;
			case 7:
				$this->setUsrEmail($value);
				break;
			case 8:
				$this->setUsrPhone($value);
				break;
			case 9:
				$this->setUsrRoles($value);
				break;
			case 10:
				$this->setUsrRememberToken($value);
				break;
			case 11:
				$this->setUsrStatus($value);
				break;
			case 12:
				$this->setUsrImage($value);
				break;
			case 13:
				$this->setUsrSelfdesc($value);
				break;
			case 14:
				$this->setUsrAddress($value);
				break;
			case 15:
				$this->setUsrSnsWechat($value);
				break;
			case 16:
				$this->setUsrSnsWeibo($value);
				break;
			case 17:
				$this->setUsrSnsQq($value);
				break;
			case 18:
				$this->setUsrGoal($value);
				break;
			case 19:
				$this->setUsrLevel($value);
				break;
			case 20:
				$this->setUsrCoin($value);
				break;
			case 21:
				$this->setUsrExpireDate($value);
				break;
			case 22:
				$this->setUsrAccountBalance($value);
				break;
			case 23:
				$this->setUsrApiKey($value);
				break;
			case 24:
				$this->setUsrLastlogin($value);
				break;
			case 25:
				$this->setCreateDate($value);
				break;
			case 26:
				$this->setModifiedBy($value);
				break;
			case 27:
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
		$keys = RbacUserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setUsrUid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUsrUsername($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUsrPassword($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUsrFullname($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUsrNickname($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUsrNicknameIsuse($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUsrSex($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUsrEmail($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUsrPhone($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUsrRoles($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setUsrRememberToken($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setUsrStatus($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setUsrImage($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setUsrSelfdesc($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setUsrAddress($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setUsrSnsWechat($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setUsrSnsWeibo($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setUsrSnsQq($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setUsrGoal($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setUsrLevel($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setUsrCoin($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setUsrExpireDate($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setUsrAccountBalance($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setUsrApiKey($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setUsrLastlogin($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setCreateDate($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setModifiedBy($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setModifiedAt($arr[$keys[27]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(RbacUserPeer::DATABASE_NAME);

		if ($this->isColumnModified(RbacUserPeer::USR_UID)) $criteria->add(RbacUserPeer::USR_UID, $this->usr_uid);
		if ($this->isColumnModified(RbacUserPeer::USR_USERNAME)) $criteria->add(RbacUserPeer::USR_USERNAME, $this->usr_username);
		if ($this->isColumnModified(RbacUserPeer::USR_PASSWORD)) $criteria->add(RbacUserPeer::USR_PASSWORD, $this->usr_password);
		if ($this->isColumnModified(RbacUserPeer::USR_FULLNAME)) $criteria->add(RbacUserPeer::USR_FULLNAME, $this->usr_fullname);
		if ($this->isColumnModified(RbacUserPeer::USR_NICKNAME)) $criteria->add(RbacUserPeer::USR_NICKNAME, $this->usr_nickname);
		if ($this->isColumnModified(RbacUserPeer::USR_NICKNAME_ISUSE)) $criteria->add(RbacUserPeer::USR_NICKNAME_ISUSE, $this->usr_nickname_isuse);
		if ($this->isColumnModified(RbacUserPeer::USR_SEX)) $criteria->add(RbacUserPeer::USR_SEX, $this->usr_sex);
		if ($this->isColumnModified(RbacUserPeer::USR_EMAIL)) $criteria->add(RbacUserPeer::USR_EMAIL, $this->usr_email);
		if ($this->isColumnModified(RbacUserPeer::USR_PHONE)) $criteria->add(RbacUserPeer::USR_PHONE, $this->usr_phone);
		if ($this->isColumnModified(RbacUserPeer::USR_ROLES)) $criteria->add(RbacUserPeer::USR_ROLES, $this->usr_roles);
		if ($this->isColumnModified(RbacUserPeer::USR_REMEMBER_TOKEN)) $criteria->add(RbacUserPeer::USR_REMEMBER_TOKEN, $this->usr_remember_token);
		if ($this->isColumnModified(RbacUserPeer::USR_STATUS)) $criteria->add(RbacUserPeer::USR_STATUS, $this->usr_status);
		if ($this->isColumnModified(RbacUserPeer::USR_IMAGE)) $criteria->add(RbacUserPeer::USR_IMAGE, $this->usr_image);
		if ($this->isColumnModified(RbacUserPeer::USR_SELFDESC)) $criteria->add(RbacUserPeer::USR_SELFDESC, $this->usr_selfdesc);
		if ($this->isColumnModified(RbacUserPeer::USR_ADDRESS)) $criteria->add(RbacUserPeer::USR_ADDRESS, $this->usr_address);
		if ($this->isColumnModified(RbacUserPeer::USR_SNS_WECHAT)) $criteria->add(RbacUserPeer::USR_SNS_WECHAT, $this->usr_sns_wechat);
		if ($this->isColumnModified(RbacUserPeer::USR_SNS_WEIBO)) $criteria->add(RbacUserPeer::USR_SNS_WEIBO, $this->usr_sns_weibo);
		if ($this->isColumnModified(RbacUserPeer::USR_SNS_QQ)) $criteria->add(RbacUserPeer::USR_SNS_QQ, $this->usr_sns_qq);
		if ($this->isColumnModified(RbacUserPeer::USR_GOAL)) $criteria->add(RbacUserPeer::USR_GOAL, $this->usr_goal);
		if ($this->isColumnModified(RbacUserPeer::USR_LEVEL)) $criteria->add(RbacUserPeer::USR_LEVEL, $this->usr_level);
		if ($this->isColumnModified(RbacUserPeer::USR_COIN)) $criteria->add(RbacUserPeer::USR_COIN, $this->usr_coin);
		if ($this->isColumnModified(RbacUserPeer::USR_EXPIRE_DATE)) $criteria->add(RbacUserPeer::USR_EXPIRE_DATE, $this->usr_expire_date);
		if ($this->isColumnModified(RbacUserPeer::USR_ACCOUNT_BALANCE)) $criteria->add(RbacUserPeer::USR_ACCOUNT_BALANCE, $this->usr_account_balance);
		if ($this->isColumnModified(RbacUserPeer::USR_API_KEY)) $criteria->add(RbacUserPeer::USR_API_KEY, $this->usr_api_key);
		if ($this->isColumnModified(RbacUserPeer::USR_LASTLOGIN)) $criteria->add(RbacUserPeer::USR_LASTLOGIN, $this->usr_lastlogin);
		if ($this->isColumnModified(RbacUserPeer::CREATE_DATE)) $criteria->add(RbacUserPeer::CREATE_DATE, $this->create_date);
		if ($this->isColumnModified(RbacUserPeer::MODIFIED_BY)) $criteria->add(RbacUserPeer::MODIFIED_BY, $this->modified_by);
		if ($this->isColumnModified(RbacUserPeer::MODIFIED_AT)) $criteria->add(RbacUserPeer::MODIFIED_AT, $this->modified_at);

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
		$criteria = new Criteria(RbacUserPeer::DATABASE_NAME);

		$criteria->add(RbacUserPeer::USR_UID, $this->usr_uid);

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
	 * @param      object $copyObj An object of RbacUser (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setUsrUsername($this->usr_username);

		$copyObj->setUsrPassword($this->usr_password);

		$copyObj->setUsrFullname($this->usr_fullname);

		$copyObj->setUsrNickname($this->usr_nickname);

		$copyObj->setUsrNicknameIsuse($this->usr_nickname_isuse);

		$copyObj->setUsrSex($this->usr_sex);

		$copyObj->setUsrEmail($this->usr_email);

		$copyObj->setUsrPhone($this->usr_phone);

		$copyObj->setUsrRoles($this->usr_roles);

		$copyObj->setUsrRememberToken($this->usr_remember_token);

		$copyObj->setUsrStatus($this->usr_status);

		$copyObj->setUsrImage($this->usr_image);

		$copyObj->setUsrSelfdesc($this->usr_selfdesc);

		$copyObj->setUsrAddress($this->usr_address);

		$copyObj->setUsrSnsWechat($this->usr_sns_wechat);

		$copyObj->setUsrSnsWeibo($this->usr_sns_weibo);

		$copyObj->setUsrSnsQq($this->usr_sns_qq);

		$copyObj->setUsrGoal($this->usr_goal);

		$copyObj->setUsrLevel($this->usr_level);

		$copyObj->setUsrCoin($this->usr_coin);

		$copyObj->setUsrExpireDate($this->usr_expire_date);

		$copyObj->setUsrAccountBalance($this->usr_account_balance);

		$copyObj->setUsrApiKey($this->usr_api_key);

		$copyObj->setUsrLastlogin($this->usr_lastlogin);

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
	 * @return     RbacUser Clone of current object.
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
	 * @return     RbacUserPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RbacUserPeer();
		}
		return self::$peer;
	}

} // BaseRbacUser
