<?php

require_once 'classes/model/RbacUserPeer.php';
require_once 'classes/model/RbacUser.php';
require_once 'classes/model/SysNotificationPeer.php';

/**
 * TODO: ...
 * @public
 */
class Services_Rest_User
{
	function __construct() {
        
    }
    
    /*
     * 获取个人信息
     * @author xu_zlong
     * @since  2016-05-25T10:03:24+0800
     * @param  string                  $id 用户id
     * @return [type]           
     */
    protected static function get($id){
        if(!isset($id)){
            return array('success' => false, 'message'=> '参数错误','data' => array());
        }

        try{
            $data = RbacUserPeer::getUserByid($id);
            $sql = "SELECT GRP_NAME FROM `RBAC_GROUP_USER` a LEFT JOIN RBAC_GROUP b ON a.`GRP_UID` = b.`GRP_UID` WHERE a.USR_UID='$id';";

            $_aa = array();
            $_aGrpNames = PropelUtil::excuteRS($sql);
            foreach ($_aGrpNames as $key => $value) {
                $_aa[] = $value['GRP_NAME'];
            }

            $_aa = array_unique($_aa);
            sort($_aa);
            $data['USR_GRPNAMES'] = implode(",",$_aa);
            $data->USR_PASSWORD="******";
            $data->USR_FULLNAME=$username;
            return array('success' => true, 'message'=>'', 'data'=> $data);
        }catch(RestException $e){
            return array('success' => false, 'message'=> $e->getMessage(),'data'=> array());
        }
    }

    /*
     * 修改个人信息
     * @author xu_zlong
     * @since  2016-05-25T10:03:49+0800
     * @param  string                   $usr_uid  用户id
     * @param  string                   $nickname 昵称
     * @param  string                   $nicktype 是否使用全名
     * @param  string                   $selfdesc 签名
     * @param  string                   $sex      性别
     * @param  string                   $wechat   微信
     * @param  string                   $headpic  头像
     * @return [type]                   
     */
    public static function post($usr_uid, $nickname='', $nicktype='', $selfdesc='', $sex='', $wechat='', $headpic='') {
        if(!isset($usr_uid)){
            return array('success' => false, 'message'=> '参数错误','data'=>array());
        }

    	try{
            if($headpic != ''){
                if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $headpic, $result)){
                    $type = $result[2];
                    $uploadDir = PATH_SHARED.'/headpic/';
                    $picid = gulliver::generateUniqueID();
                    $picname = $picid.'.'.$type;
                    $newPath =  $uploadDir . DIRECTORY_SEPARATOR .date('Ymd').'/';
                    if(!file_exists($newPath)){
                        mkdir($newPath,0777,true);
                    }
                    $imageurl = $uploadDir . DIRECTORY_SEPARATOR .date('Ymd').'/'. $picname;
                    file_put_contents($imageurl, base64_decode(str_replace($result[1], '', $content)));
                }
                $image = '/'.'shared/headpic'.DIRECTORY_SEPARATOR .date('Ymd').'/'. $picname;
            }
            $row = RbacUserPeer::getUserByid($usr_uid);
            $userdata = array(
                'USR_UID' => $usr_uid,
                'USR_NICKNAME' => $nickname,
                'USR_NICKNAME_ISUSE' => $nicktype,
                'USR_SELFDESC' => $selfdesc,
                'USR_SEX' => $sex,
                'USR_SNS_WECHAT' => $wechat,
                'USR_IMAGE' => $image
            );
            $row2 = RbacUserPeer::editUser($userdata);
    		return array('success' => true, 'message'=>$row2['message'] ,'data'=>array());
    	}catch(RestException $e){
    		 return array('success' => false, 'message'=> $e->getMessage(),'data'=>array());
    	}
    }

    /*
     * 注册
     * @author xu_zlong
     * @since  2016-05-25T09:58:30+0800
     * @param  [type]                   $phone    手机号
     * @param  [type]                   $password 密码
     * @param  [type]                   $code     验证码
     * @return [type]                             
     */
    public static function put($phone, $password,$code) {
        if(!isset($phone)){
            return array('success' => false, 'message'=> '手机号不正确');
        }
        if(!isset($password)){
            return array('success' => false, 'message'=> '密码不正确');
        }
        if(!isset($code)){
            return array('success' => false, 'message'=> '验证码不正确');
        }
        try{
            $row = RbacUserPeer::getUserByphone($phone);
            if($row){
                if($row['USR_STATUS'] ==1){
                    return array('success' => true, 'message'=> '该手机号已注册');
                }else{
                    $row2 = SysNotificationPeer::Getnotice($phone);
                    if($code != $row2['SN_COREDATA']){
                        return array('success' => false, 'message'=> '验证码错误');
                    }else{
                        $zero1 = strtotime(date('y-m-d H:i:s'));
                        $zero2 = strtotime($row2['MODIFIED_AT']);
                        $guonian=ceil(($zero1-$zero2)/60);
                        if($guonian > 5){
                            return array('success' => false, 'message'=> '验证码过期,请重新获取验证码');
                        }
                    }
                    $row3 = RbacUserPeer::editstatus($row['USR_UID'],$password);
                    if($row3['success']){
                        return array('success' => true, 'message'=> '注册成功');
                    }
                }
                
            }else{
                $row2 = SysNotificationPeer::Getnotice($phone);
                if($code != $row2['SN_COREDATA']){
                    return array('success' => false, 'message'=> '验证码错误');
                }else{
                    $zero1 = strtotime(date('y-m-d H:i:s'));
                    $zero2 = strtotime($row2['MODIFIED_AT']);
                    $guonian=ceil(($zero1-$zero2)/60);
                    if($guonian > 5){
                        return array('success' => false, 'message'=> '验证码过期,请重新获取验证码');
                    }
                }
                $userdata = array(
                    'USR_USERNAME'=> $phone,
                    'USR_PASSWORD' => $password,
                    'USR_PHONE' => $phone
                );
                $row3 = RbacUserPeer::Adduser($userdata);
                return array('success' => true, 'message'=> '注册成功');
            }  
        }catch (RestException $e) {
            return array('success' => false, 'message'=> $e->getMessage());
        }
    }

    /**
     * 人员列表
     *
     * @param $USR_UID              人员ID {@from body}
     * @param $USR_FULLNAME         用户全名 {@from body}
     * @param $USR_NICKNAME         用户昵称 {@from body}
     * @param $USR_SEX              性别，1：男，0：女 {@from body}
     * @param $USR_EMAIL            用户邮箱 {@from body}
     * @param $USR_PHONE            用户手机号码 {@from body}
     * @param $USR_ROLES            用户角色 {@from body}
     * @param $page                 分页 {@from body}
     * @param $pagesize             单页数量 {@from body}
     * 
     * @author WangJia
     * @since  2019-01-05T14:11:42+0800
     * 
     * @url POST /user/list
     * @return [type]                   [description]
     */
    public function userList($USR_UID=NULL,$USR_FULLNAME=NULL,$USR_NICKNAME=NULL,$USR_SEX=NULL,$USR_EMAIL=NULL,$USR_PHONE=NULL,$USR_ROLES=NULL,$page=1,$pagesize=10){
        try{
           $aData = array();
           $aData['OFFSET']     = ($page - 1) * $pagesize;
           $aData['PAGESIZE']   = $pagesize;
           
           if($USR_UID != NULL)      $aData['USR_UID'] = $USR_UID;
           if($USR_FULLNAME != NULL) $aData['USR_FULLNAME'] = $USR_FULLNAME;
           if($USR_NICKNAME != NULL) $aData['USR_NICKNAME'] = $USR_NICKNAME;
           if($USR_SEX != NULL)      $aData['USR_SEX'] = $USR_SEX;
           if($USR_EMAIL != NULL)    $aData['USR_EMAIL'] = $USR_EMAIL;
           if($USR_PHONE != NULL)    $aData['USR_PHONE'] = $USR_PHONE;
           if($USR_ROLES != NULL)    $aData['USR_ROLES'] = $USR_ROLES;
           $data = RbacUser::getUserList($aData);
           return array(
                    'success'   =>  true,
                    'message'   =>  '查询成功！',
                    'total'     =>  $data['total'],
                    'page'      =>  $page ,
                    'pagesize'  =>  $pagesize,
                    'data'      =>  $data['data'],
                    'code'      =>  '200'
                );

        }catch (Exception $e) {
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }
}
