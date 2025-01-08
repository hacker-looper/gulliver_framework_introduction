<?php

require_once 'classes/model/RbacUserPeer.php';
require_once 'classes/model/SysNotificationPeer.php';

/**
 * TODO: ...
 * @public
 */
class Services_Rest_UserPassword
{	
	function __construct() {
        
    }
	/*
     * 忘记密码/修改密码
     * @author xu_zlong
     * @since  2016-05-25T09:57:22+0800
     * @param  string                   $phone       手机号
     * @param  string                   $password    密码
     * @param  int                      $code        验证码
     * @param  string                   $flag        changepsw：修改，forget：忘记密码
     * @param  string                   $oldpassword 旧密码
     * @return [type]                                
     */
    public static function post($phone, $password, $flag, $code='' ,$oldpassword='') {
        if(!isset($phone)){
            return array('success' => false, 'message'=> '手机号不正确');
        }
        if(!isset($password)){
            return array('success' => false, 'message'=> '密码不正确');
        }
        if(!isset($code)){
            return array('success' => false, 'message'=> '验证码不正确');
        }
        if(!isset($flag)){
            return array('success' => false, 'message'=> '参数错误');
        }
        try{
            switch ($flag) {
                /*忘记密码*/
                case 'forget' :
                    $row = SysNotificationPeer::Getnotice($phone);
                    if($code != $row['SN_COREDATA']){
                        return array('success' => false, 'message'=> '验证码错误');
                    }
                    $row = RbacUserPeer::getUserByphone($phone);
                    $data = array(
                        'USR_UID' => $row['USR_UID'],
                        'PASSWORD' => $password,
                    );
                    $row2=RbacUserPeer::editUserPass($data);
                break;
                /*修改密码*/
                case 'changepsw' :
                    $row = RbacUserPeer::getUserByphone($phone);
                    if($row['USR_PASSWORD'] != $oldpassword){
                        return array('success' => false, 'message'=> '原密码错误');
                    }
                    $data = array(
                        'USR_UID' => $row['USR_UID'],
                        'PASSWORD' => $password,
                    );
                    $row2=RbacUserPeer::editUserPass($data);
                break; 
            }  
            return array('success' => true, 'message'=> $row2['message']);    
        }catch (RestException $e) {
            return array('success' => false, 'message'=> $e->getMessage());
        }
    }
}