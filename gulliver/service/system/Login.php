<?php 

require_once 'classes/model/RbacUserPeer.php';

class Services_Rest_Login {
    
    function __construct() {
    }

    /*
     * 登录
     * @author xu_zlong
     * @since  2016-05-25T10:02:01+0800
     * @param  string                   $usr_username    用户名
     * @param  string                   $usr_password    密码（MD5）
     * @return [type]        
     */
    public static function post($usr_username, $usr_password){
        try {
            require_once "classes/model/RbacUserPeer.php";
            require_once "classes/model/RbacRolePeer.php";
            
            $row = RbacUserPeer::getUserByUsername($usr_username);
            
            if($row){
                if($row['USR_PASSWORD']!==md5($usr_password)) {
                    return array('success' => false, 'message' => '对不起，密码错误!','data' => array());
                }

                if($row['USR_STATUS'] == 0){
                    return array('success' => false, 'message' => '对不起，帐号已注销!','data' => array());
                }

                $_aRoleName = "";
                $_aPermission = array();
                if($row['USR_ROLES']){
                    $aUsrRoles = explode(",", $row['USR_ROLES']);
                    foreach ($aUsrRoles as $r) {
                        $sql = 'SELECT PER_NAME FROM RBAC_PERMISSION, RBAC_ROLE_PERMISSION WHERE RBAC_PERMISSION.PER_UID = RBAC_ROLE_PERMISSION.PER_UID AND  RBAC_ROLE_PERMISSION.ROLE_UID = \''.$r.'\' ';
                        $_p = PropelUtil::excuteRS($sql);

                        if($_p)foreach ($_p as $_pp) {
                            array_push($_aPermission, $_pp['PER_NAME']);
                        }

                        $_x = RbacRole::get($r);
                        $_aRoleName[] = $_x['ROLE_NAME_DISPLAY'];
                    }
                }

                $row['USR_ROLENAMES']   = implode(",", $_aRoleName);
                $row['USR_PERMISSIONS'] = array_unique($_aPermission);
                sort($row['USR_PERMISSIONS']);
                $row['USR_PASSWORD']    = "******";

                LogUtil::Log('用户管理','DEBUG',"用户账号:$usr_username 登录成功!");
                $sql = "UPDATE RBAC_USER SET USR_LASTLOGIN = NOW() WHERE USR_USERNAME= '".mysql_real_escape_string(trim($usr_username))."'";
                PropelUtil::excute($sql);
                return array('success' => true,'message' =>'登陆成功!', 'data' => $row);
            }else{
                return array('success' => false, 'message' => '用户未注册','data' => array());
            }
        } catch (Exception $e) {
            return array('success'=>false, 'message'=>$e->getMessage(), 'data'=>array());
        }
    }
    
}