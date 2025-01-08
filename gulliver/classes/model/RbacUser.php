<?php

require_once 'classes/model/om/BaseRbacUser.php';
require_once 'classes/model/RbacUserPeer.php';


/**
 * Skeleton subclass for representing a row from the 'RBAC_USER' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    classes.model
 */
class RbacUser extends BaseRbacUser {

	public static function datatable($aData){
		require_once "classes/model/RbacRole.php";
		$aRolesCache = RbacRole::allIndexByID();

		// jquery.datatable parameters
		$start = isset($aData['start'])?$aData['start']:0;
		$end = isset($aData['length'])?$aData['length']:10;
		$search = isset($aData['search']['value'])?$aData['search']['value']:'';
		// $regex = isset($aData['search[regex]'])?$aData['search[regex]']:'';

		$sort_column = isset($aData['SORT_COLUMN:'])?$aData['SORT_COLUMN:']:'USR_USERNAME';
		$sort_type = isset($aData['SORT_TYPE'])?$aData['SORT_TYPE']:'ASC';

		$con = Propel::getConnection('system');
		$stmt = $con->createStatement();

		$sql = 'SELECT * FROM RBAC_USER U WHERE 1=1 ';
		$sqlTotal = 'SELECT COUNT(*) AS  TOTAL FROM RBAC_USER U WHERE 1=1 ';
		
		// 查询相关
		if($search){
			$sql .= "AND (U.USR_USERNAME LIKE '%$search%' OR U.USR_FULLNAME LIKE '%$search%') ";
			$sqlTotal .= "AND (U.USR_USERNAME LIKE '%$search%' OR U.USR_FULLNAME LIKE '%$search%') ";
		}

		$sql .= "LIMIT $start,$end";
		$rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

		$res = array();
		$index = 1;

		while ($rs->next()) {
			$row = $rs->getRow();
			$USR_ROLES = $row['USR_ROLES'];
			if(strpos($USR_ROLES, ',')!==false){
				$_a = explode(',', $USR_ROLES);
				$_aRolesName = array();
				foreach ($_a as $_k => $_v) {
					$_aRolesName[] .= $aRolesCache[$_v]['ROLE_NAME_DISPLAY'];
				}

				$row['USR_ROLES_NAME'] = implode(',', $_aRolesName);
			}else{
				$row['USR_ROLES_NAME'] = $aRolesCache[$USR_ROLES]['ROLE_NAME_DISPLAY'];
			}

			$res[] = $row;
			$index++;
		}

		//get Ttotal
		$rs = $stmt->executeQuery($sqlTotal, ResultSet::FETCHMODE_ASSOC);

		$total = 0;
		if($rs->next()) {
			$row = $rs->getRow();
			$total = intval($row['TOTAL']);
		}

		return array('iTotalRecords'=>intval($end), //本次加载记录数量  
					 'iTotalDisplayRecords'=>$total, //总记录数量  
					 'aaData'=> $res);
	}

	public static function get($USR_UID) {
		$oUser = RbacUserPeer::retrieveByPK($USR_UID);
		$aData = array();
		if($oUser){
			$aData['USR_UID'] = $oUser->getUsrUid();
			$aData['USR_USERNAME'] = $oUser->getUsrUsername();
			$aData['USR_FULLNAME'] = $oUser->getUsrFullname();
			$aData['USR_SELFDESC'] = $oUser->getUsrSelfdesc();
			$aData['USR_PASSWORD'] = $oUser->getUsrPassword();
			$aData['USR_SEX'] 	= $oUser->getUsrSex();
			$aData['USR_EMAIL'] = $oUser->getUsrEmail();
			$aData['USR_PHONE'] = $oUser->getUsrPhone();
			$aData['USR_ROLES'] = $oUser->getUsrRoles();
			$aData['USR_STATUS'] = $oUser->getUsrStatus();
			$aData['USR_IMAGE'] = $oUser->getUsrImage();
			$aData['USR_ADDRESS'] = $oUser->getUsrAddress();

			$aData['CREATE_DATE'] = $oUser->getCreateDate();
			$aData['MODIFIED_AT'] = $oUser->getModifiedAt();
			$aData['MODIFIED_BY'] = $oUser->getModifiedBy();
		}
		
		return $aData;
	}

	public static function addedit($aData) {
		try {
			$uid = isset($aData['USR_UID'])?$aData['USR_UID']:'';
			$name = isset($aData['USR_USERNAME'])?$aData['USR_USERNAME']:'';
			$password = isset($aData['USR_PASSWORD'])?$aData['USR_PASSWORD']:'';
			$fullname = isset($aData['USR_FULLNAME'])?$aData['USR_FULLNAME']:'';
			$desc = isset($aData['USR_SELFDESC'])?$aData['USR_SELFDESC']:'';
			$status = isset($aData['USR_STATUS'])?$aData['USR_STATUS']:'';
			$sex = isset($aData['USR_SEX'])?$aData['USR_SEX']:'';
			$email = isset($aData['USR_EMAIL'])?$aData['USR_EMAIL']:'';
			$phone = isset($aData['USR_PHONE'])?$aData['USR_PHONE']:'';
			$roles = isset($aData['USR_ROLES'])?$aData['USR_ROLES']:'';
			$address = isset($aData['USR_ADDRESS'])?$aData['USR_ADDRESS']:'';
			$image = isset($aData['USR_IMAGE'])?$aData['USR_IMAGE']:'';
			$expireDate = isset($aData['USR_EXPIRE_DATE'])?$aData['USR_EXPIRE_DATE']:'';

			if(! $uid){
				$aUser = self::_getUserByName($name);
				if($aUser){
					return array('success' => false, 'message' => $aUser['USR_USERNAME'] . ' 已经存在，请检查！');
				}

				$bNew = true;
			}else{
				$per = RbacUserPeer::retrieveByPK($uid);
				if($per) $bNew = false;
				else $bNew = true;
			}

			if($bNew){
				$per = new RbacUser();
				$uid=gulliver::generateUniqueID();
				$per->setUsrUid($uid);
				$CREATE_DATE=date('Y-m-d H:i:s');
				$per->setCreateDate($CREATE_DATE);
				$per->setUsrExpireDate(date("Y-m-d H:i:s",strtotime("+10 year")));
			}
			
			if($name!='') $per->setUsrUsername($name);
			if($fullname!='') $per->setUsrFullname($fullname);
			if($desc!='') $per->setUsrSelfdesc($desc);
			if($status!='') $per->setUsrStatus($status);
			if($sex!='') $per->setUsrSex($sex);
			if($email!='') $per->setUsrEmail($email);
			if($phone!='') $per->setUsrPhone($phone);
			if($roles!='') $per->setUsrRoles($roles);
			if($password!='') $per->setUsrPassword(md5($password));
			if($address!='') $per->setUsrAddress($address);
			if($image!='') $per->setUsrImage($image);
			if($expireDate!='') $per->setUsrExpireDate($expireDate);
			$per->setCreateDate(date('Y-m-d H:i:s'));
			$per->save();

			// update session if self-editing profile
			if($_SESSION['Login']['USR_UID'] == $uid){
				$con = Propel::getConnection('system');
				$stmt = $con->createStatement();

				$sql = 'SELECT * FROM RBAC_USER WHERE USR_USERNAME = \''.mysql_real_escape_string(trim($name)).'\'  LIMIT 1';
				$rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);
				$rs->next();
				$row = $rs->getRow();

				$_SESSION['Login'] = $row;
				$roles = RbacRolePeer::retrieveByPK($row['USR_ROLES']);
				if($roles) {
					Session::set('ROLE_NAME', $roles->getRoleName(), 'Login');
					Session::set('ROLE_NAME_DISPLAY', $roles->getRoleNameDisplay(), 'Login');

					$sql = 'SELECT PER_NAME FROM RBAC_PERMISSION, RBAC_ROLE_PERMISSION WHERE RBAC_PERMISSION.PER_UID = RBAC_ROLE_PERMISSION.PER_UID AND RBAC_ROLE_PERMISSION.ROLE_UID = \''.$row['USR_ROLES'].'\' ';
					$rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

					$pers = array();
					while ($rs->next()) {
						$perRow = $rs->getRow();
						array_push($pers, $perRow['PER_NAME']);
					}

					$_SESSION['Login']['PERMISSION'] = $pers;
					$_SESSION['LOGINED'] = true;
				}
			}

			return array('success' => true, 'message' => $bNew?'创建成功!':'更新成功','data' => $uid,'CREATE_DATE'=>$CREATE_DATE,'code'=>'200');
		} catch (Exception $e) {
			return array('success' => false, 'message' => $e->getMessage());
		}
	}

	public static function del($aData){
		try {

			$a = array('success'=>false, 'message'=>'');
			$USR_UID = $aData['USR_UID'];

			$o = RbacUserPeer::retrieveByPK($USR_UID);

			if($o){
				$o->delete();
				$a['success'] = true;
				$a['message'] = '删除成功！';
			}
		} catch (Exception $e) {
			$a['success'] = false;
			$a['message'] = '删除失败：'+$e->getMessage();
		}

		return $a;
	}

	/**
	 * do login function with post data
	 * @param  string $user_name
	 * @param  string $user_password
	 * @param  string $user_rememberme
	 * @return boolen
	 *
	 * @author Garry
	 * @since  2014-06-09T11:59:43+0800
	 */
	public static function doLogin($user_name, $user_password, $user_rememberme){
		require_once 'classes/model/RbacRolePeer.php';

		$con = Propel::getConnection('system');
		$stmt = $con->createStatement();

		$sql = 'SELECT * FROM RBAC_USER WHERE USR_USERNAME = \''.mysql_real_escape_string(trim($user_name)).'\'  LIMIT 1';
		$rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);
		$rs->next();
		$row = $rs->getRow();

		if($row) {
			// incorrect password
			if($row['USR_PASSWORD'] !== ($user_password)) {
				return array('success' => false, 'TAG' => '1', 'message' => '密码错误!');
			}
			// inactive user
			if($row['USR_STATUS'] == 0) {
				return array('success' => false, 'TAG' => '2', 'message' => '账号未激活!');
			}
			// expired
			if(strtotime($row['USR_EXPIRE_DATE']) < time()) {
				return array('success' => false, 'TAG' => '3', 'message' => '账号过期!');
			}

			// login process, write user data to session
			Session::init();
			$_SESSION['Login'] = $row;

			$roles = RbacRolePeer::retrieveByPK($row['USR_ROLES']);
			if($roles) {
				Session::set('ROLE_NAME', $roles->getRoleName(), 'Login');
				Session::set('ROLE_NAME_DISPLAY', $roles->getRoleNameDisplay(), 'Login');

				// Session::set('ROLE_SYSTEM', $roles->getRolSystem(), 'Login');

				$sql = 'SELECT PER_NAME FROM RBAC_PERMISSION, RBAC_ROLE_PERMISSION
				 WHERE RBAC_PERMISSION.PER_UID = RBAC_ROLE_PERMISSION.PER_UID AND 
				RBAC_ROLE_PERMISSION.ROLE_UID = \''.$row['USR_ROLES'].'\' ';
				$rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

				$pers = array();
				while ($rs->next()) {
					$perRow = $rs->getRow();
					array_push($pers, $perRow['PER_NAME']);
				}

				$_SESSION['Login']['PERMISSION'] = $pers;
				$_SESSION['LOGINED'] = true;

				if($user_rememberme) {
					// set cookie
					// COOKIE RUNTIME(7 days)
					$runTime = 7*24*60*60;

	                setcookie('remmember_gulliver_user', $row['USR_UID'], time() + $runTime, "/");
				}else{
	                setcookie('remmember_gulliver_user', $row['USR_UID'], time() + $runTime, "/");
				}

				// maybe need record login here

				$sql = "UPDATE RBAC_USER SET USR_LASTLOGIN = NOW() WHERE USR_USERNAME= '".mysql_real_escape_string(trim($user_name))."'";
				PropelUtil::excute($sql);

				return array('success' => true, 'message' => '检查成功');
			}else{
				Session::destroy();
				return array('success' => false, 'TAG' => '2', 'message' => '用户角色未激活!');
			}

		}else{
			return array('success' => false, 'TAG' => '4', 'message' => '用户未注册!');
		}
	}

	public static function datatableUserByGroup($aData){
		$start = isset($aData['start'])?$aData['start']:0;
		$end = isset($aData['length'])?$aData['length']:10;
		$KEY = isset($aData['KEY'])?$aData['KEY']:'';
		$GRP_UID = isset($aData['GRP_UID'])?$aData['GRP_UID']:'';

		$con = Propel::getConnection('system');
		$stmt = $con->createStatement();
		$sql = "SELECT * FROM RBAC_USER U LEFT JOIN RBAC_ROLE R ON U.USR_ROLES=R.ROLE_UID  WHERE U.USR_UID IN (SELECT USR_UID FROM RBAC_GROUP_USER WHERE GRP_UID='$GRP_UID') ";
		$sqlTotal = "SELECT COUNT(*) FROM RBAC_USER U LEFT JOIN RBAC_ROLE R ON U.USR_ROLES=R.ROLE_UID  WHERE U.USR_UID IN (SELECT USR_UID FROM RBAC_GROUP_USER WHERE GRP_UID='$GRP_UID') ";

		if($KEY !=''){
			$sql .="AND LOCATE('$KEY',U.USR_FULLNAME) > 0 ";
			$sqlTotal .="AND LOCATE('$KEY',U.USR_FULLNAME) > 0 ";
		}

		$sql.="LIMIT $start,$end";
		$rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

		$res = array();
		$index = 1;

		while ($rs->next()) {
			$row = $rs->getRow();
			$res[] = $row;
			$index++;
		}

		//get Ttotal
		$rs = $stmt->executeQuery($sqlTotal, ResultSet::FETCHMODE_ASSOC);

		$total = 0;
		if($rs->next()) {
			$row = $rs->getRow();
			$total = intval($row['TOTAL']);
		}

		return array('iTotalRecords'=>intval($end), //本次加载记录数量  
					 'iTotalDisplayRecords'=>$total, //总记录数量  
					 'aaData'=> $res);	
	}

	private static function _getUserByName($name){
		$oCriteria = new Criteria('app');
		$oCriteria->add( RbacUserPeer::USR_USERNAME, $name, Criteria::EQUAL );
		$oCriteria->addAscendingOrderByColumn(RbacUserPeer::USR_USERNAME);
			
		$aData = RbacUserPeer::doSelectRS($oCriteria);
		$aData->setFetchmode( ResultSet::FETCHMODE_ASSOC );
		$aData->next();
			
		return $aData->getRow();	
	}

	/**
	 * get user information
	 * @param  string $userUid
	 * @return array
	 *
	 * @author Garry
	 * @since  2014-06-12T09:28:42+0800
	 */
	public static function getUserInfo($userUid) {

		$con = Propel::getConnection('system');
		$stmt = $con->createStatement();

		$sql = 'SELECT * FROM RBAC_USER WHERE USR_UID = \''.$userUid.'\' LIMIT 1';
		$rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);
		$rs->next();
		$row = $rs->getRow();

		require_once 'classes/model/RbacRolePeer.php';
		$role = RbacRolePeer::retrieveByPK($row['USR_ROLES']);
		$row['ROLE_NAME'] = $role?$role->getRoleName():'';

		return $row;
	}

	/**
	 * edit user
	 * @param  array $aData
	 *
	 * @author Garry
	 * @since  2014-06-12T10:04:32+0800
	 */
	public static function editUser($aData) {
		try {
			$con = Propel::getConnection('system');
			$stmt = $con->createStatement();
			$userUid = isset($aData['USR_UID'])?$aData['USR_UID']:'';
			$uName = isset($aData['USER_NAME'])?$aData['USER_NAME']:'';
			$rUid = isset($aData['ROLE_CODE'])?$aData['ROLE_CODE']:'';
			$fName = isset($aData['USR_FULLNAME'])?$aData['USR_FULLNAME']:'';
			$phone = isset($aData['USR_PHONE'])?$aData['USR_PHONE']:'';
			$sex = isset($aData['USR_SEX'])?$aData['USR_SEX']:'';
			$phone = str_replace("-","",$phone);
			$email = isset($aData['USR_EMAIL'])?$aData['USR_EMAIL']:'';	
			$address = isset($aData['USR_ADDRESS'])?$aData['USR_ADDRESS']:'';
			$dueDate = isset($aData['USR_EXPIRE_DATE'])?$aData['USR_EXPIRE_DATE']:'';

			$oUser = RbacUserPeer::retrieveByPK($userUid);
			$oUser->setUsrSex($sex);
			$oUser->setUsrEmail($email);
			$oUser->setUsrPhone($phone);
			$oUser->setUsrExpireDate($due);

			if($aData['PASSWORD']){
				$oUser->setUsrPassword($aData['PASSWORD']);
			}

			if($dueDate) $oUser->setUsrExpireDate($dueDate);
			$oUser->setUsrAddress($address);
			$oUser->save();

			return array('success' => true, 'message' => "修改成功");

		} catch (Exception $e) {
			return array('success' => false, 'message' => $e->getMessage());
		}
	}

	/**
	 * 修改用户密码
	 * @author looper_lvy
	 * @since  2016-05-26T14:22:11+0800
	 * @param  [type]
	 * @return array()
	 */
	public static function changeUserPassword($aData){
		$aRes = array('success'=>false,'message'=>'');

		try {

			$aUser = self::get($aData['USR_UID']);
			if(! $aUser){
				$aRes['success'] = false;
				$aRes['message'] = "用户不存在，请检查重试！";
				return $aRes;
			}

			if($aUser['USR_PASSWORD'] != $aData['USR_PASSWORD']){
				$aRes['success'] = false;
				$aRes['message'] = "原始密码错误，请检查重试！";
				return $aRes;
			}

			$oUser = RbacUserPeer::retrieveByPK($aData['USR_UID']);
			$oUser->setUsrPassword($aData['USR_PASSWORD_NEW']);
			$oUser->save();

			$aRes['success'] = true;
			$aRes['message'] = "修改成功！";
			return $aRes;
		
		} catch (Exception $e) {
			$aRes['success'] = false;
			$aRes['message'] = "修改用户密码失败：".$e->getMessage();
			return $aRes;
		}
	}
	
	/**
	 * 用户列表 
	 * @author WangJia
	 * @since  2019-01-05T14:25:42+0800
	 * @param  [type]                   $aData [description]
	 * @return [type]                          [description]
	 */
	public static function getUserList($aData){
		$result = array("success"=>false);
        try{
            $CAT_PARENT_NAME = '';
            $criteria = new Criteria(RbacUserPeer::DATABASE_NAME);
    
            if(isset($aData['USR_UID']))      $criteria->add(RbacUserPeer::USR_UID,$aData['USR_UID']);
            if(isset($aData['USR_FULLNAME']))      $criteria->add(RbacUserPeer::USR_FULLNAME,'%' . $aData['USR_FULLNAME'] . '%',Criteria::LIKE);
            if(isset($aData['USR_NICKNAME']))      $criteria->add(RbacUserPeer::USR_NICKNAME,'%' . $aData['USR_NICKNAME'] . '%',Criteria::LIKE);
            if(isset($aData['USR_SEX']))      $criteria->add(RbacUserPeer::USR_SEX,$aData['USR_SEX']);
            if(isset($aData['USR_EMAIL']))      $criteria->add(RbacUserPeer::USR_EMAIL,$aData['USR_EMAIL']);
            if(isset($aData['USR_PHONE']))      $criteria->add(RbacUserPeer::USR_PHONE,$aData['USR_PHONE']);
			if(isset($aData['USR_ROLES']))      $criteria->add(RbacUserPeer::USR_ROLES,'%' . $aData['USR_ROLES'] . '%',Criteria::LIKE);
			      
            $total = RbacUserPeer::doCount($criteria);

            if(isset($aData['OFFSET']))    $criteria->setOffset($aData['OFFSET']);
            if(isset($aData['PAGESIZE']))  $criteria->setLimit($aData['PAGESIZE']);
            $criteria->addDescendingOrderByColumn(RbacUserPeer::CREATE_DATE);

            $aData = RbacUserPeer::doSelectRS($criteria);
            $aData->setFetchmode( ResultSet::FETCHMODE_ASSOC );

            $aData->next();
            $list = array();
            while(is_array($row = $aData->getRow())){
            	$row['CAT_PARENT_NAME'] = $CAT_PARENT_NAME;
                $list[] = $row;
                $aData->next();
            }

            $result['success'] = true;
            $result['total'] = $total;
            $result['data'] = $list;
            return $result;
        }catch(Exception $e){
            $result['message'] = $e->getMessage();
            return $result;
        }
	}	

	/**
     * 修改密码
     * @param array 表字段为KEY的数组， 数组key不存在则不更新表字段
     **/
    public static function updatePassword($aData){
        try{
            $USR_UID = isset($aData['USR_UID']) ? $aData['USR_UID'] : '';
            $USR_PASSWORD = isset($aData['USR_PASSWORD']) ? $aData['USR_PASSWORD'] : '';

            if($aData['USR_UID']) {
                $obj = RbacUserPeer::retrieveByPK($USR_UID);
                $USR_FULLNAME = $obj -> getUsrFullname();
            }
            if(isset($aData['USR_PASSWORD'])){ $obj->setUsrPassword($aData['USR_PASSWORD']);}

            $obj->save();
            LogUtil::Log('人员管理','DEBUG',"用户:$USR_FULLNAME 密码修改成功!");
           return array('success'=>true,'message'=>'修改成功','data'=>$USR_UID,'code'=>'200');
        }catch(Exception $e){
            return array('success'=>false,'message'=>$e->getMessage(),'data'=>'');
        }
    }

    /**
     * 修改状态
     * @param array 表字段为KEY的数组， 数组key不存在则不更新表字段
     **/
    public static function updateStatus($aData){
        try{
            $USR_UID = isset($aData['USR_UID']) ? $aData['USR_UID'] : '';
            $USR_STATUS = isset($aData['USR_STATUS']) ? $aData['USR_STATUS'] : '';

            if($aData['USR_UID']) {
                $obj = RbacUserPeer::retrieveByPK($USR_UID);
                $USR_FULLNAME = $obj -> getUsrFullname();
            }
            if(isset($aData['USR_STATUS'])){ $obj->setUsrStatus($aData['USR_STATUS']);}
            $obj->save();
            $aData['USR_STATUS']==0?$TITLE="注销":$TITLE="激活";

            LogUtil::Log('人员管理','DEBUG',"用户:$USR_FULLNAME ".$TITLE."成功!");
           return array('success'=>true,'message'=>'修改成功','data'=>$USR_UID,'code'=>'200');
        }catch(Exception $e){
            return array('success'=>false,'message'=>$e->getMessage(),'data'=>'');
        }
    }
} // RbacUser
