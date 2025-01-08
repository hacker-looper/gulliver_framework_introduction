<?php
require_once 'classes/model/SysUserMessage.php';

class Services_Rest_System
{

    function __construct() {
        // Token::validateApiToken();
    }

    /**
     * 系统日志（列表）
     * @since  2019-02-11 13:00:00 
     * @param  $page            分页     {@from body}
     * @param  $pagesize        单页数量.{@from body}
     * 
     * @url POST /syslog/list
     * @return [type]                            [description]
     */
    public function getSysLogList($page=1,$pagesize=20){
        try{
           require_once 'classes/model/SysLog.php';
           $offset = ($page - 1) * $pagesize;
           $aData = array(
                'start'=>$offset,
                'length'=>$pagesize
           );
           $data = SysLog::datatable($aData);
           return array(
                        'success'   =>  true,
                        'message'   =>  '成功',
                        'total'     =>  $data['iTotalDisplayRecords'],
                        'page'      =>  $page ,
                        'pagesize'  =>  $pagesize,
                        'data'      =>  $data['aaData'],
                        'code'      =>  '200'
                    );

        }catch (Exception $e) {
            var_dump($e->getMessage());
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 我的消息（列表）
     * @since  2019-03-05 13:00:00 
     * @param  $USR_UID         用户ID  {@from url}
     * 
     * @url GET /sysmessage/mylist/{$USR_UID}
     * @return [type]                            [description]
     */
    public function getMySysMessageList($USR_UID){
        try{
           require_once 'classes/model/SysMessage.php';
           $offset = ($page - 1) * $pagesize;
           $aData = array(
                'USR_UID'=>$USR_UID
           );
           $data = SysMessage::getMyList($aData);
           return array(
                        'success'   =>  true,
                        'message'   =>  '成功',
                        'total'     =>  $data['total'],
                        'data'      =>  $data['data'],
                        'code'      =>  '200'
                    );

        }catch (Exception $e) {
            var_dump($e->getMessage());
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 系统消息（列表）
     * @since  2019-02-11 13:00:00 
     * @param  $USR_UID         用户ID   {@from body}
     * @param  $SEARCH          搜索关键字   {@from body}
     * @param  $page            分页     {@from body}
     * @param  $pagesize        单页数量.{@from body}
     * 
     * @url POST /sysmessage/list
     * @return [type]                            [description]
     */
    public function getSysMessageList($USR_UID='',$SEARCH='',$page=1,$pagesize=10){
        try{
           require_once 'classes/model/SysMessage.php';
           $offset = ($page - 1) * $pagesize;
           $aData = array(
                'USR_UID'=>$USR_UID,
                'SEARCH' => $SEARCH,
                'OFFSET'=>$offset,
                'PAGESIZE'=>$pagesize
           );
           $data = SysMessage::getList($aData);
           return array(
                        'success'   =>  true,
                        'message'   =>  '成功',
                        'total'     =>  $data['total'],
                        'page'      =>  $page ,
                        'pagesize'  =>  $pagesize,
                        'data'      =>  $data['data'],
                        'code'      =>  '200'
                    );

        }catch (Exception $e) {
            var_dump($e->getMessage());
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * @deprecated
     * 新增/编辑 系统消息
     * @param $MES_UID              PK {@from body}
     * @param $MES_TO_KEY           消息接收者类型，比如: 组:GRP_UID，用户：USR_UID等 {@from body}
     * @param $MES_TO_VALUE         消息接收者ID值:19604492156fcd43d410584031164743, 多个以逗号分隔 {@from body}
     * @param $MES_TYPE_KEY         消息类型，比如：资讯:NEWS_UID等 {@from body}
     * @param $MES_TYPE_VALUE       消息类型值，比如：XXX_UID对应的UID值：19604492156fcd43d410584031164743 {@from body}
     * @param $MES_TITLE            推送消息标题 {@from body}
     * @param $MES_BODY             推送消息内容 {@from body}
     * @param $MES_SOURCE           消息来源，1：页面添加(显示在WEB页面上)，0，后台业务 {@from body}
     * @param $MES_PUBLISH_STATUS   发布状态，1：已发布，0：未发布 {@from body}
     * @param $MES_PUBLISH_DATE     发布时间 {@from body}
     * 
     * @since  2019-01-30 11:24:00
     * 
     * @url POST /sysmessage/info2
     * @return [type]                   [description]
     */
    public function editSysMessage($MES_UID=NULL, $MES_TO_KEY=NULL,$MES_TO_VALUE=NULL,$MES_TYPE_KEY=NULL,$MES_TYPE_VALUE=NULL, $MES_TITLE=NULL, $MES_BODY=NULL, $MES_SOURCE=NULL, $MES_PUBLISH_STATUS=NULL,$MES_PUBLISH_DATE=NULL){
        try{
            $aData = array(
                'MES_UID'=>$MES_UID,
                'MES_TO_KEY'=>$MES_TO_KEY,
                'MES_TO_VALUE'=>$MES_TO_VALUE,
                'MES_TYPE_KEY'=>$MES_TYPE_KEY,
                'MES_TYPE_VALUE'=>$MES_TYPE_VALUE,
                'MES_TITLE'=>$MES_TITLE,
                'MES_BODY'=>$MES_BODY,
                'MES_SOURCE'=>$MES_SOURCE,
                'MES_PUBLISH_STATUS'=>$MES_PUBLISH_STATUS,
                'MES_PUBLISH_DATE'=>$MES_PUBLISH_DATE
            );
            require_once 'classes/model/SysMessage.php';
            $rs = SysMessage::saveInfo($aData);

            return array('success'=>true,
                        'message'=>'保存成功!',
                        'data'=>array(),
                        'code'=>'200');
        }catch (Exception $e) {
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 新增/编辑 系统消息
     * @param $USR_UID              发送者ID {@from body}
     * @param $MES_UID              PK {@from body}
     * @param $MES_TO               收件人(USR_UID, 多个以逗号分隔) {@from body}
     * @param $MES_TITLE            推送消息标题 {@from body}
     * @param $MES_BODY             推送消息内容 {@from body}
     * @param $MES_SOURCE           消息来源，1：页面添加(显示在WEB页面上)，0，后台业务 {@from body}
     * @param $MES_PUBLISH_STATUS   发布状态，1：已发布，0：未发布 {@from body}
     * @param $MES_PUBLISH_DATE     发布时间 {@from body}
     * 
     * @since  2019-02-21 15:27:00
     * 
     * @url POST /sysmessage/info
     * @return [type]                   [description]
     */
    public function saveSysMessage($USR_UID,$MES_UID=NULL, $MES_TO=NULL, $MES_TITLE=NULL, $MES_BODY=NULL, $MES_SOURCE=NULL){
        try{
            $aData = array(
                'USR_UID'=>$USR_UID,
                'MES_UID'=>$MES_UID,
                'MES_TO_KEY'=>'USR_UID',
                'MES_TO_VALUE'=>implode(",",$MES_TO),
                'MES_TITLE'=>$MES_TITLE,
                'MES_BODY'=>$MES_BODY,
                'MES_SOURCE'=>$MES_SOURCE
            );
            require_once 'classes/model/SysMessage.php';
            $rs = SysMessage::saveInfo($aData);

            return array('success'=>true,
                        'message'=>'保存成功!',
                        'data'=>array(),
                        'code'=>'200');
        }catch (Exception $e) {
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 发布系统消息
     * 
     * @param $MES_UID 配置key {@from url}
     * 
     * @url GET /sysmessage/publish/{MES_UID}
     * @return object
     */
    public function publishSysMessage($MES_UID){

        try{
           require_once 'classes/model/SysMessage.php';
           $b = SysMessage::publish($MES_UID);
           return array('success'=>$b,
                        'message'=>$b ? '成功发布消息!' : '发布消息!',
                        'data'=>array(),
                        'code'=>'200');
        }catch (Exception $e) {
            var_dump($e);die;
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 删除系统消息
     * 
     * @param $MES_UID 配置key {@from url}
     * 
     * @url DELETE /sysmessage/delete/{MES_UID}
     * @return object
     */
    public function removeSysMessage($MES_UID){

        try{
           require_once 'classes/model/SysMessage.php';
           $b = SysMessage::removeByPK($MES_UID);
           return array('success'=>$b,
                        'message'=>$b ? '成功删除数据!' : '删除失败!',
                        'data'=>array(),
                        'code'=>'200');
        }catch (Exception $e) {
            var_dump($e);die;
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 数据字典（列表）
     * @since  2019-01-30 10:00:00 
     * @param  $CON_KEY       配置key   {@from body}
     * @param  $page            分页     {@from body}
     * @param  $pagesize        单页数量.{@from body}
     * 
     * @url POST /sysconf/list
     * @return [type]                            [description]
     */
    public function getSysConfList($CON_KEY='',$page=1,$pagesize=10){
        try{
           require_once 'classes/model/SysConfiguration.php';
           $offset = ($page - 1) * $pagesize;
           $aData = array(
           		'CON_KEY'=>$CON_KEY,
           		'OFFSET'=>$offset,
           		'PAGESIZE'=>$pagesize
           );
           $data = SysConfiguration::getList();
           return array(
                        'success'   =>  true,
                        'message'   =>  '成功',
                        'total'     =>  $data['total'],
                        'page'      =>  $page ,
                        'pagesize'  =>  $pagesize,
                        'data'      =>  $data['data'],
                        'code'      =>  '200'
                    );

        }catch (Exception $e) {
            var_dump($e->getMessage());
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 新增/编辑 数据字典
     * @param $CON_KEY              配置key {@from body}
     * @param $CON_TITLE            配置title {@from body}
     * @param $CON_MODULE           所属模块 {@from body}
     * @param $CON_VALUE            配置内容 {@from body}
     * @param $CON_DESC             备注说明 {@from body}
     * 
     * @since  2019-01-30 11:24:00
     * 
     * @url POST /sysconf/info
     * @return [type]                   [description]
     */
    public function editSysConf($CON_KEY,$CON_TITLE=NULL,$CON_MODULE=NULL,$CON_VALUE=NULL, $CON_DESC=NULL){
        try{
            $aData = array(
            	'CON_KEY'=>$CON_KEY,
            	'CON_TITLE'=>$CON_TITLE,
            	'CON_MODULE'=>$CON_MODULE,
            	'CON_VALUE'=>$CON_VALUE,
            	'CON_DESC'=>$CON_DESC
            );
            require_once 'classes/model/SysConfiguration.php';
            $rs = SysConfiguration::saveInfo($aData);

            return array('success'=>true,
                        'message'=>'保存成功!',
                        'data'=>array(),
                        'code'=>'200');
        }catch (Exception $e) {
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 删除记录(List)
     * 
     * @param $CON_KEY 配置key {@from url}
     * 
     * @url DELETE /sysconf/delete/{CON_KEY}
     * @return object
     */
    public function removeSysConf($CON_KEY){

        try{
           require_once 'classes/model/SysConfiguration.php';
           $b = SysConfiguration::removeByPK($CON_KEY);
           return array('success'=>$b,
                        'message'=>$b ? '成功删除数据!' : '删除失败!',
                        'data'=>array(),
                        'code'=>'200');
        }catch (Exception $e) {
            var_dump($e);die;
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 配置详情(List)
     * 
     * @param $CON_KEY 配置key {@from url}
     * 
     * @url GET /sysconf/area/info
     * @return object
     */
    public function getSysAreaConf(){
        try{
           require_once 'classes/model/SysConfiguration.php';
           $b = SysConfiguration::get('CSDA_AREA');

           if(!$b) throw new Exception('');
           $areas = explode("\n", $b['CON_VALUE']);

           $result = array();
           $pos = 0;
           foreach ($areas as $key => $value) {
               if(strpos($value, '--') !== false){
                //设备
                $ar = array();
                $value = str_replace('--', '', $value);
                $ar['value'] = $value;
                $ar['label'] = $value;
                $result[$pos - 1]['disabled'] = false;
                array_push($result[$pos - 1]['children'], $ar);
               }else{
                //层
                $result[$pos] = [];
                $result[$pos]['value'] = $value;
                $result[$pos]['label'] = $value;
                $result[$pos]['disabled'] = true;
                $result[$pos]['children'] = array();
                $pos++;
               }
           }

           return array('success'=>true,
                        'message'=>'',
                        'data'=>$result,
                        'code'=>'200');
        }catch (Exception $e) {
            var_dump($e);die;
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 配置详情(List)
     * 
     * @param $CON_KEY 配置key {@from url}
     * 
     * @url GET /sysconf/alerm/info
     * @return object
     */
    public function getSysAlermConf(){
        try{
           require_once 'classes/model/SysConfiguration.php';
           $b = SysConfiguration::get('CSDA_ALARM');

           if(!$b) throw new Exception('');
           $alerms = explode("\n", $b['CON_VALUE']);
           $result = [];
           foreach ($alerms as $key => $value) {
               $v = explode(':', $value);
               $ar = [];
               $ar['label'] = $v[1];
               $ar['value'] = $v[0];
               array_push($result, $ar);
           }
           return array('success'=>true,
                        'message'=>'',
                        'data'=>$result,
                        'code'=>'200');
        }catch (Exception $e) {
            var_dump($e);die;
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    // RBAC
    // ------------------------------------------------------------------------
    /**
     * rbac-role角色详情（包含权限）
     * @since  2019-01-31 10:00:00 
     * @param  $ROLE_UID           角色ID   {@from url}
     * 
     * @url GET /rbac/role/detail/{ROLE_UID}
     * @return [type]                            [description]
     */
    public function getRbacRoleDetail($ROLE_UID=''){
        try{
           require_once 'classes/model/RbacRole.php';
           $data = RbacRole::getDetail($ROLE_UID);
           return array(
                        'success'   =>  true,
                        'message'   =>  '成功!',
                        'data'      =>  $data,
                        'code'      =>  '200'
                    );

        }catch (Exception $e) {
            var_dump($e->getMessage());
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }


    /**
     * rbac-role角色（列表）
     * @since  2019-01-31 10:00:00 
     * @param  $ROLE_NAME           角色编号   {@from body}
     * @param  $ROLE_NAME_DISPLAY   角色名称   {@from body}
     * @param  $ROLE_STATUS   角色状态1:激活/0:注销   {@from body}
     * @param  $page                分页      {@from body}
     * @param  $pagesize            单页数量   {@from body}
     * 
     * @url POST /rbac/role/list
     * @return [type]                            [description]
     */
    public function getRbacRoleList($ROLE_NAME='',$ROLE_NAME_DISPLAY='',$ROLE_STATUS=NULL, $page=1,$pagesize=10){
        try{
           require_once 'classes/model/RbacRole.php';
           $offset = ($page - 1) * $pagesize;
           $aData = array(
                'ROLE_NAME'=>$ROLE_NAME,
                'ROLE_NAME_DISPLAY'=>$ROLE_NAME_DISPLAY,
                'ROLE_STATUS'=>$ROLE_STATUS,
                'OFFSET'=>$offset,
                'PAGESIZE'=>$pagesize
           );
           $data = RbacRole::getList($aData);
           return array(
                        'success'   =>  true,
                        'message'   =>  '成功!',
                        'total'     =>  $data['total'],
                        'page'      =>  $page ,
                        'pagesize'  =>  $pagesize,
                        'data'      =>  $data['data'],
                        'code'      =>  '200'
                    );

        }catch (Exception $e) {
            var_dump($e->getMessage());
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 新增/编辑 rbac-role角色
     * @param $ROLE_UID              角色id，为空表示创建，非空表示编辑 {@from body}
     * @param $ROLE_NAME             角色编号 {@from body}
     * @param $ROLE_NAME_DISPLAY     角色标题 {@from body}
     * @param $ROLE_SYSTEM           角色模块 {@from body}
     * @param $ROLE_STATUS           角色状态，1:激活，0:注销 {@from body}
     * @param $ROLE_DESC             备注说明 {@from body}
     * @param $ROLE_PERMISSIONS      角色关联权限(字符串格式，多个角色以逗号","分隔) {@from body}
     * 
     * @since  2019-01-31 11:24:00
     * 
     * @url POST /rbac/role/info
     * @return [type]                   [description]
     */
    public function editRbacRole($ROLE_UID=NULL,$ROLE_NAME=NULL,$ROLE_NAME_DISPLAY=NULL,$ROLE_SYSTEM=NULL, $ROLE_STATUS=NULL, $ROLE_DESC=NULL, $ROLE_PERMISSIONS=NULL){
        try{
            $aData = array(
                'ROLE_UID'=>$ROLE_UID,
                'ROLE_NAME'=>$ROLE_NAME,
                'ROLE_NAME_DISPLAY'=>$ROLE_NAME_DISPLAY,
                'ROLE_SYSTEM'=>$ROLE_SYSTEM,
                'ROLE_STATUS'=>$ROLE_STATUS,
                'ROLE_DESC'=>$ROLE_DESC,
                'ROLE_PERMISSIONS'=>$ROLE_PERMISSIONS
            );
            require_once 'classes/model/RbacRole.php';
            $rs = RbacRole::addedit($aData);

            return array('success'=>true,
                        'message'=>'保存成功!',
                        'data'=>array(),
                        'code'=>'200');
        }catch (Exception $e) {
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 删除记录(List)
     * 
     * @param $ROLE_UID 配置key {@from url}
     * 
     * @url DELETE /rbac/role/delete/{ROLE_UID}
     * @return object
     */
    public function removeRbacRole($ROLE_UID){

        try{
           require_once 'classes/model/RbacRole.php';
           $b = RbacRole::del(array('ROLE_UID'=>$ROLE_UID));
           return array('success'=>$b,
                        'message'=>$b ? '成功删除数据!' : '删除失败!',
                        'data'=>array(),
                        'code'=>'200');
        }catch (Exception $e) {
            var_dump($e);die;
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * rbac-permission权限（列表）
     * @since  2019-01-31 10:00:00 
     * @param  $PER_NAME           权限编号   {@from body}
     * @param  $PER_NAME_DISPLAY   权限名称   {@from body}
     * @param  $PER_STATUS         权限名称1:激活／0:注销   {@from body}
     * @param  $ROLE_UID           角色ID    {@from body}
     * @param  $page               分页      {@from body}
     * @param  $pagesize           单页数量   {@from body}
     * 
     * @url POST /rbac/permission/list
     * @return [type]                            [description]
     */
    public function getRbacPermissionList($PER_NAME=NULL,$PER_NAME_DISPLAY=NULL,$PER_STATUS=NULL,$ROLE_UID=NULL,$page=1,$pagesize=10){
        try{
           require_once 'classes/model/RbacRole.php';
           require_once 'classes/model/RbacPermission.php';

           $offset = ($page - 1) * $pagesize;
           $aData = array(
                'PER_NAME'=>$PER_NAME,
                'PER_NAME_DISPLAY'=>$PER_NAME_DISPLAY,
                'PER_STATUS'=>$PER_STATUS,
                'OFFSET'=>$offset,
                'PAGESIZE'=>$pagesize
           );
           $data = RbacPermission::getList($aData);
           if($ROLE_UID !== NULL){
               $role_permission = RbacRole::getRolePermissions($ROLE_UID);
               $pids = array();
               foreach ($role_permission as $key => $value) {
                   array_push($pids,$value['PER_UID']);
               }
               $per_arr = array();
               //处理DATA
               foreach ($data['data'] as $key => $value) {
                    $name = $value['PER_NAME'];
                    $checked = in_array($value['PER_UID'], $pids);
                    if(!isset($per_arr[$value['PER_CATEGORY']])) $per_arr[$value['PER_CATEGORY']] = array();

                    if(strstr($name,"_VIEW") !== false || strstr($name,"_EDIT") !== false){
                        $name = substr($name, 0, strlen($name) - 5);

                        $per_arr[$value['PER_CATEGORY']][$name][] = array(
                            'PER_UID' => $value['PER_UID'],
                            'PER_NAME_DISPLAY' => $value['PER_NAME_DISPLAY'],
                            'PER_STATUS' => $value['PER_STATUS'],
                            'PER_NAME' => $value['PER_NAME'],
                            'PARENT' => false,
                            'CHECKED' => $checked
                        );
                    }else{
                        $per_arr[$value['PER_CATEGORY']][$name][] = array(
                            'PER_UID' => $value['PER_UID'],
                            'PER_NAME'=> $value['PER_NAME'],
                            'PER_NAME_DISPLAY' => $value['PER_NAME_DISPLAY'],
                            'PER_STATUS' => $value['PER_STATUS'],
                            'PARENT' => true,
                            'CHECKED' => $checked                            
                        );
                    }              
               }
               $data['data'] = $per_arr;
            }
           return array(
                        'success'   =>  true,
                        'message'   =>  '成功',
                        'total'     =>  $data['total'],
                        'page'      =>  $page ,
                        'pagesize'  =>  $pagesize,
                        'data'      =>  $data['data'],
                        'code'      =>  '200'
                    );

        }catch (Exception $e) {
            var_dump($e->getMessage());
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 新增/编辑 rbac-permission权限
     * @param $PER_UID              角色id，为空表示创建，非空表示编辑 {@from body}
     * @param $PER_NAME             角色编号 {@from body}
     * @param $PER_NAME_DISPLAY     角色标题 {@from body}
     * @param $PER_STATUS           角色状态，1:激活，0:注销 {@from body}
     * @param $PER_DESC             备注说明 {@from body}
     * 
     * @since  2019-01-31 11:24:00
     * 
     * @url POST /rbac/permission/info
     * @return [type]                   [description]
     */
    public function editRbacPermission($PER_UID=NULL,$PER_NAME=NULL,$PER_NAME_DISPLAY=NULL,$PER_STATUS=NULL, $PER_DESC=NULL){
        try{
            $aData = array(
                'PER_UID'=>$PER_UID,
                'PER_NAME'=>$PER_NAME,
                'PER_NAME_DISPLAY'=>$PER_NAME_DISPLAY,
                'PER_STATUS'=>$PER_STATUS,
                'PER_DESC'=>$PER_DESC
            );
            require_once 'classes/model/RbacPermission.php';
            $rs = RbacPermission::addedit($aData);

            return array('success'=>true,
                        'message'=>'保存成功!',
                        'data'=>array(),
                        'code'=>'200');
        }catch (Exception $e) {
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 删除记录(List)
     * 
     * @param $PER_UID 权限id {@from url}
     * 
     * @url DELETE /rbac/role/permission/{PER_UID}
     * @return object
     */
    public function removeRbacPermission($PER_UID){

        try{
           require_once 'classes/model/RbacPermission.php';
           $b = RbacPermission::del(array('PER_UID'=>$PER_UID));
           return array('success'=>$b,
                        'message'=>$b ? '成功删除数据!' : '删除失败!',
                        'data'=>array(),
                        'code'=>'200');
        }catch (Exception $e) {
            var_dump($e);die;
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }


    /*************************************************************************************************************

        USER_MESSAGE 

    *************************************************************************************************************/

    /**
     * 修改消息状态为已读(List)
     * 
     * @param $MES_UID 权限id {@from body}
     * @param $USR_UID 用户id {@from body}
     * 
     * @url POST /message/setmsgstatus
     * @return object
     */
    public function setMessageStatus($MES_UID,$USR_UID){
        try{
           $res = SysUserMessage::setMessageStatus($MES_UID,$USR_UID);
           // return array('success'=>$b,
           //              'message'=>$b ? '成功删除数据!' : '删除失败!',
           //              'data'=>array(),
           //              'code'=>'200');
        }catch (Exception $e) {
            var_dump($e);die;
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }
}