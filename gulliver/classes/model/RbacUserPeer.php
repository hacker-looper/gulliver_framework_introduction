<?php

  // include base peer class
  require_once 'classes/model/om/BaseRbacUserPeer.php';

  // include object class
  include_once 'classes/model/RbacUser.php';


/**
 * Skeleton subclass for performing query and update operations on the 'RBAC_USER' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    classes.model
 */
class RbacUserPeer extends BaseRbacUserPeer {
	/**获取用户信息(根据账号)
	 * [getUserByphone description]
	 * @author xu_zlong
	 * @since  2016-05-25T10:23:40+0800
	 * @param  [type]                   $username [description]
	 * @return [type]                          [description]
	 */
	public static function getUserByUsername($username){
		$oCriteria = new Criteria('app');
		$oCriteria->add( RbacUserPeer::USR_USERNAME,$username, Criteria::EQUAL );
		$aData = RbacUserPeer::doSelectRS($oCriteria);
		$aData->setFetchmode( ResultSet::FETCHMODE_ASSOC );
		$aData->next();
		return $aData->getRow();	
	}

	public static function getUserByKey($key){
		$oCriteria = new Criteria('app');
		$oCriteria->add( RbacUserPeer::USR_API_KEY,$key, Criteria::EQUAL );
		$aData = RbacUserPeer::doSelectRS($oCriteria);
		$aData->setFetchmode( ResultSet::FETCHMODE_ASSOC );
		$aData->next();
		return $aData->getRow();	
	}

	/**获取用户信息(用户id)
	 * [getUserByid description]
	 * @author xu_zlong
	 * @since  2016-05-25T10:23:49+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public static function getUserByid($id){
		$oCriteria = new Criteria('app');
		$oCriteria->add( RbacUserPeer::USR_UID,$id, Criteria::EQUAL );
		$aData = RbacUserPeer::doSelectRS($oCriteria);
		$aData->setFetchmode( ResultSet::FETCHMODE_ASSOC );
		$aData->next();
		return $aData->getRow();	
	}
	/**注册用户
	 * [Adduser description]
	 * @author xu_zlong
	 * @since  2016-05-25T10:24:03+0800
	 * @param  [type]                   $data [description]
	 */
	public static function Adduser($data){
		require_once 'classes/model/RbacUserPeer.php';
		$username = isset($data['USR_USERNAME'])?$data['USR_USERNAME']:'';
		$password = isset($data['USR_PASSWORD'])?$data['USR_PASSWORD']:'';
		$address = isset($data['USR_ADDRESS'])?$data['USR_ADDRESS']:'';
		$fullname = isset($data['USR_FULLNAME'])?$data['USR_FULLNAME']:'';
		$email = isset($data['USR_EMAIL'])?$data['USR_EMAIL']:'';
		$phone = isset($data['USR_PHONE'])?$data['USR_PHONE']:'';
		$usruid = gulliver::generateUniqueID();
		$oNewUser = new RbacUser();
		$oNewUser->setUsrUid($usruid);
		$oNewUser->setUsrUsername($username);
		$oNewUser->setUsrFullname($fullname);
		$oNewUser->setUsrEmail($email);
		$oNewUser->setUsrPhone($phone);
		$oNewUser->setUsrPassword($password);
		$oNewUser->setUsrAddress($address);
		$oNewUser->setUsrStatus('1');
		$oNewUser->setCreateDate(date('Y-m-d H:i:s'));
		$oNewUser->save();	
		return $usruid;
	}
	/**修改密码
	 * [editUserPass description]
	 * @author xu_zlong
	 * @since  2016-05-25T10:23:15+0800
	 * @param  [type]                   $aData [description]
	 * @return [type]                          [description]
	 */
	public static function editUserPass($aData) {
		try {
			$con = Propel::getConnection('system');
			$stmt = $con->createStatement();
			$userUid = isset($aData['USR_UID'])?$aData['USR_UID']:'';
			$oUser = RbacUserPeer::retrieveByPK($userUid);
			if($aData['PASSWORD']){
				$oUser->setUsrPassword($aData['PASSWORD']);
			}
			$oUser->setModifiedAt(date('Y-m-d H:i:s'));
			$oUser->save();	
			return array('success' => true, 'message' => '修改密码成功');
		} catch (Exception $e) {
			return array('success' => false, 'message' => $e->getMessage());
		}
	}
	/**修改个人信息
	 * [editUser description]
	 * @author xu_zlong
	 * @since  2016-05-25T10:24:17+0800
	 * @param  [type]                   $aData [description]
	 * @return [type]                          [description]
	 */
	public static function editUser($aData) {
		try {
			$userUid = isset($aData['USR_UID'])?$aData['USR_UID']:'';
			$nickName = isset($aData['USR_NICKNAME'])?$aData['USR_NICKNAME']:'';
			$nickIsuse = isset($aData['USR_NICKNAME_ISUSE'])?$aData['USR_NICKNAME_ISUSE']:'0';	
			$selfdesc = isset($aData['USR_SELFDESC'])?$aData['USR_SELFDESC']:'';
			$sex = isset($aData['USR_SEX'])?$aData['USR_SEX']:'1';
			$wechat = isset($aData['USR_SNS_WECHAT'])?$aData['USR_SNS_WECHAT']:'';
			$image = isset($aData['USR_IMAGE'])?$aData['USR_IMAGE']:'';
			

			$oUser = RbacUserPeer::retrieveByPK($userUid);
			$oUser->setUsrNickName($nickName);
			$oUser->setUsrNickNameIsuse($nickIsuse);
			$oUser->setUsrSelfdesc($selfdesc);
			$oUser->setUsrSex($sex);
			$oUser->setUsrSnsWechat($wechat);
			if($image !=''){
				$oUser->setUsrImage($image);
			}
			$oUser->setModifiedAt(date('Y-m-d H:i:s'));
			$oUser->save();
			return array('success' => true, 'message' => "修改成功");

		} catch (Exception $e) {
			return array('success' => false, 'message' => $e->getMessage());
		}
	}
	/**获取我的考试列表
	 * [Getexam description]
	 * @author xu_zlong
	 * @since  2016-05-25T10:24:26+0800
	 * @param  [type]                   $userid [description]
	 * @param  [type]                   $type   [description]
	 * @param  [type]                   $start  [description]
	 * @param  [type]                   $end    [description]
	 */
    public static function Getexam($userid,$type,$start,$end) {
        try {
            $con = Propel::getConnection('system');
            $stmt = $con->createStatement();
            //查询用户的推送考试
			$sqlDelivery = 'SELECT EM_UID,MODIFIED_AT FROM JCKT_EXAM_DELIVERY WHERE ED_VALUE=\''.$userid.'\'';
			//查询用户的课程考试
			$sqlClassExam = 'SELECT c.EM_UID,c.MODIFIED_AT FROM JCKT_CLASS_USER u LEFT JOIN JCKT_CLASS_EXAM c ON c.CS_UID=u.CS_UID WHERE u.USR_UID=\''.$userid.'\' AND c.EM_PUSHTIME < NOW()';
			//考试分类查询及分页
			$sql = 'SELECT e.EM_UID FROM (('.$sqlClassExam.') union ('.$sqlDelivery.')) x LEFT JOIN EXAM_EXAM e ON x.EM_UID=e.EM_UID WHERE e.EM_TYPE=\''.$type.'\' ORDER BY x.MODIFIED_AT LIMIT '.$start.','.$end;
			$sql2 = 'SELECT count(*) as total  FROM (('.$sqlClassExam.') union ('.$sqlDelivery.')) x LEFT JOIN EXAM_EXAM e ON x.EM_UID=e.EM_UID WHERE e.EM_TYPE=\''.$type.'\' ORDER BY x.MODIFIED_AT';
            $rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);
           
            while ($rs->next()) {
                $row = $rs->getRow();
                $res[] = $row;
            }
            $rs2 = $stmt->executeQuery($sql2, ResultSet::FETCHMODE_ASSOC);
            $total = 0;
            if($rs2->next()) {
                $row = $rs2->getRow();
                $total = (int)$row['total'];
            }
            return array('data'=> $res,'total' => $total);
        }catch (Exception $e) {
            return array('success' => false, 'message' => $e->getMessage());
        }
    }
} // RbacUserPeer
