<?php

/**
 * rbac module
 * @since  CrisisGo V2.0
 **/
class RBAC {
 /**
  * authentication of an user through of class RBAC_user
  *
  * checking that an user has right to start an applicaton
  *
  * @author Fernando Ontiveros Lira <fernando@colosa.com>
  * @access public
  *
  * @param  string $strUser    UserId  (login) an user
  * @param  string $strPass    Password
  * @return array
  */
  public static function VerifyUserLogin( $strUser, $strPass, $remember)
  {
    require_once 'classes/model/RbacUser.php';
    $result = RbacUser::doLogin($strUser, $strPass, $remember);

    return $result;
  }

  /**
   * 根据PER_CODE获取人员信息
   * @param  $PER_CODE  权限名称
   * @return array();
   */
  public static function getUsersByPermission($PER_CODE){
    $data=array();
    $sql="SELECT * FROM `RBAC_ROLE_PERMISSION` b, `RBAC_PERMISSION` a WHERE b.PER_UID = a.PER_UID AND a.PER_NAME = '".$PER_CODE."' ";
    $aData = PropelUtil::excuteRS($sql);
    $sql="";
    if($aData){
      foreach ($aData as $row){
        $sql.="OR"." FIND_IN_SET('".$row['ROLE_UID']."', USR_ROLES) ";
      }
      $sql=substr($sql,2);
    }
    
    $sql="SELECT * FROM RBAC_USER WHERE".$sql." ";
    $data = PropelUtil::excuteRS($sql);
    return $data;
  }

    /**
     * [userCanAccess description]
     * @param  [type] $permission [description]
     * @return [type] [description]
     *
     * @author Garry
     * @since  2014-06-12T16:49:04+0800
     */
   public static function userCanAccess($permission) {
    if(! isset($_SESSION['Login'])) {
      unset($_SESSION);
      header('location: /sys/zh/classic/rbac/login');
    }

    if(! $permission) return true;
    $aRole = explode(',', $_SESSION['Login']['USR_ROLES']);
    if(is_array($aRole) && in_array('00000000000000000000000000000001', $aRole)) return true;
    if('00000000000000000000000000000001'==$_SESSION['Login']['USR_ROLES']) return true;
    
    return in_array($permission, $_SESSION['Login']['PERMISSION']);
   }

   /**
     * [创建rbac.user用户]
     * @param  [type] $aData [array]
     * @return [type] [description]
     *
     * @author Garry
     * @since  2014-06-12T16:49:04+0800
     */
   public static function createUser($aData) {
      require_once 'classes/model/RbacUser.php';
      $result = RbacUser::addedit($aData);
   }



   /**
    * 获得系统菜单目录树
    * @see RBACMenu.php
    * @return array();
    * $author looper lvy
    * @since  2016-05-23
    **/
   public static function getMenus(){
      if(false && isset($_SESSION['MENU'])){
        return $_SESSION['MENU'];
      }

      require_once('classes/model/RbacMenu.php');
      $_SESSION['MENU'] = RbacMenu::getMenuTreePermission();
      return $_SESSION['MENU'];
   }

   /**
    * 根据当前请求url获得菜单对象
    * @see RBACMenu.php
    * @return array();
    * $author looper lvy
    * @since  2016-05-23
    **/
   public static function getMenuByPath($url){
      require_once('classes/model/RbacMenu.php');
      $aMenu = RbacMenu::all();

      foreach ($aMenu as $k=>$v) {
        if($v['MENU_URL'] == $url){
          return $v;
        }
      }

      return array();
   }

}