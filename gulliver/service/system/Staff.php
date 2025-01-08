<?php
require_once 'classes/model/RbacStaff.php';
class Services_Rest_Staff{

    /**
     * 员工树(包含组织结构)
     * @author looper
     * @since  2019-02-21
     * @url GET /tree
     * @return
     */
    public function getStaffTree(){
        try{
            $aData = RbacStaff::getStaffTree();
            return array('success'=>true,
                        'message'=>'成功获取数据',
                        'data'=>$aData,
                        'code'=>'200'
                    );
        }catch (Exception $e) {
            var_dump($e);
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 更新用户最后上线时间
     * @url POST /UpdateLastTime
     * @return
     */
    public function UpdateLastTime(){
        try{
            $date = date('Y-m-d H:i:s');
            $sql = "UPDATE RBAC_STAFF SET MODIFIED_AT = '$date' WHERE STF_CODE='0001'";
            PropelUtil::excute($sql);
            return array('success'=>true,
                        'message'=>'更新用户登录时间成功',
                        'code'=>'200'
                    );
        }catch (Exception $e) {
            // var_dump($e);
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 查询员工对象
     * @author zou_mzhu
     * @since  2018-12-26T10:56:10+0800
     * @param  $USR_UID 员工uid {@from url}
     * @url GET /{USR_UID}
     * @return          
     */
    public function getStaffPK($USR_UID){
        try{
            $aData = RbacStaff::getByPK($USR_UID);
            return array('success'=>true,
                        'message'=>'成功获取数据',
                        'data'=>$aData,
                        'code'=>'200'
                    );
        }catch (Exception $e) {
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 删除员工对象(物理删除)
     * @author zou_mzhu
     * @since  2018-12-26T10:56:49+0800
     * @param  $USR_UID 员工uid {@from url}
     * @url DELETE /delete/{USR_UID}
     * @return          
     */
    public function delStaffById($USR_UID){
        try{
            $aData = RbacStaff::removeByPK($USR_UID);
            
            return array('success'=>$aData,
                        'message'=>$aData?'成功删除数据！':'删除失败！',
                        'data'=>Array(),
                        'code'=>'200'
                    );
        }catch (Exception $e) {
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }
    /**
     * 查询人员列表(List)
     * @param $USR_UID           员工UID {@from body}
     * @param $STF_CODE          员工编号 {@from body}
     * @param $STF_STATUS        用户状态，1：激活，0：注销 {@from body}
     * @param $GRP_UID           所属部门UID {@from body}
     * @param $STF_JOB           工作职务 {@from body}
     * @param $GRP_NAME          部门名称 {@from body}
     * @param $USR_FULLNAME      员工全名 {@from body}
     * @param $page              分页   {@from body}
     * @param $pagesize          单页数量 {@from body}
     * @url POST /list
     * @return object
     */
    public function getStaffList($USR_UID='',$STF_CODE='',$STF_STATUS='',$GRP_UID='',$STF_JOB='',$GRP_NAME='',$USR_FULLNAME='',$page=1,$pagesize=10){
        $aData = array(
            'USR_UID'              => $USR_UID,
            'STF_CODE'             => $STF_CODE,
            'STF_STATUS'           => $STF_STATUS,
            'GRP_UID'              => $GRP_UID,
            'STF_JOB'              => $STF_JOB,
            'GRP_NAME'             => $GRP_NAME,
            'USR_FULLNAME'         => $USR_FULLNAME,
            'OFFSET'               => ($page - 1) * $pagesize,
            'PAGESIZE'             => $pagesize
           );
        try{
           $data = RbacStaff::getList($aData);
           return array(
                    'success'=>true,
                    'message'=>'成功获取数据',
                    'data'=>$data['data'],
                    'page'=>$page,
                    'pagesize'=>$pagesize,
                    'code'=>'200',
                    'total'=>$data['total'],
                );
        }catch (Exception $e) {
            
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }
    /**
     * 查询人员角色(List)
     * @url POST /listrole
     * @return object
     */
    public function getRoleList(){
        try{
            $aData=array();
            require_once 'classes/model/RbacRole.php';
            $data = RbacRole::getList($aData);
            return array(
                    'success'=>true,
                    'message'=>'成功获取数据',
                    'data'=>$data['data'],
                    'page'=>$page,
                    'pagesize'=>$pagesize,
                    'code'=>'200',
                    'total'=>$data['total'],
                );
        }catch (Exception $e) {
            var_dump($e);die;
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 头像上传
     * @param $USR_UID               用户编号
     * 
     * @url POST /{USR_UID}/image
     * @return object
     **/
     public function image($USR_UID){
        
        global $GLOBAL_SETTING;
        $http_addr = $GLOBAL_SETTING['FILE_PATH'];
        
        try{
            global $GLOBAL_SETTING;
            if(isset($_REQUEST['path'])){
                $uploadDir = PATH_SHARED.'upload/' . $_REQUEST['path'] . "/";
                if(!file_exists($uploadDir)){
                    mkdir($uploadDir,0777);
                }
            }else{
                $uploadDir = PATH_SHARED.'upload/staff/';
            }
            gulliver::verifyPath($uploadDir, true);

            if(! $_FILES) {
                return array('success' => false, 'message'=> '请上传文件!', 'data'=> new stdClass(),'code'=>'500');
            }

            $file_path = array();
            $file_full_path = array();

            foreach ($_FILES as $f) {
                if ($f['error'] == '0') { 
                    $tmp_name = $f["tmp_name"]; 
                    $fileName = $f["name"];
                    $fileExt = explode('.', $fileName);
                    $fileE = $fileExt[count($fileExt)-1];
                    if(isset($_REQUEST['path'])){
                        $file = $uploadDir. $fileName;
                        if(file_exists($file)){
                            @unlink($file);
                        }
                        array_push($file_path, $file);
                        array_push($file_full_path, $GLOBAL_SETTING['FILE_PATH'].$file);
                        if(move_uploaded_file($tmp_name, $file)){
                            //删除目录下的其他文件
                            if(@$handle = opendir($uploadDir)) { //注意这里要加一个@，不然会有warning错误提示：）
                                while(($file = readdir($handle)) !== false) {
                                    if($file != ".." && $file != ".") { //排除根目录；
                                        if($file != $fileName){
                                            @unlink($uploadDir. $file);
                                        }
                                    }
                                }
                                closedir($handle);
                            }
                        }
                    }else{    
                        $fileE = $fileE==''? 'jpg':$fileE; 
                        $fileUID =  $USR_UID;
                        $newName = $fileUID.'.'.$fileE;
                        $file = $uploadDir. $newName;
                        array_push($file_path, $file);
                        array_push($file_full_path, $http_addr.'/shared/upload/staff/'.$newName);
                        move_uploaded_file($tmp_name, $uploadDir. $newName);
                    }
                } 
            } 
            
            $path=implode(',', $file_path);
            $full_path=implode(',', $file_full_path);
            
            // TODO: 更新用户详情
            require_once 'classes/model/RbacUser.php';
            RbacUser::addedit(array('USR_UID'=>$USR_UID, 'USR_IMAGE'=>$full_path."?v=".date('YmdHis')));
            
            return array('success' => true, 'message'=>'上传文件成功', 'data'=> array('file'=>$path,'fullPath'=>$full_path),'code'=>'200');
        }catch(Exception $e){
            return array('success' => false, 'message'=> '服务器异常，请稍后重试', 'data'=> new stdClass(),'500');
        }
     }

    /**
     * 新增 / 编辑员工
     * @param $USR_USERNAME       用户账号 {@from body}
     * @param $USR_PASSWORD       密码 {@from body}
     * @param $STF_CODE           员工编号 {@from body}
     * @param $STF_STATUS         员工状态1：在职0离职 {@from body} 
     * @param $GRP_UID            所属部门UID {@from body}
     * @param $STF_JOB            工作职务 {@from body}
     * @param $STF_HOMETOWN       籍贯 {@from body}
     * @param $STF_SEX            性别1男0女 {@from body}
     * @param $STF_BOD            出生年月 {@from body}
     * @param $STF_ENTERYDATE     入职日期 {@from body}
     * @param $STF_NATION         民族 {@from body}
     * @param $USR_PHONE          手机号码{@from body}
     * @param $STF_IDCARD         身份证号码{@from body}
     * @param $STF_POLITICAL      政治面貌 {@from body}
     * @param $STF_EDU            教育程度 {@from body}
     * @param $STF_MARRIED        婚姻状况{@from body}
     * @param $STF_EDU_SCHOOL     毕业院校{@from body}
     * @param $STF_EDU_MASTER     所学专业{@from body}
     * @param $STF_SALARYCARD     工资银行卡号{@from body}
     * @param $STF_SOCIALCARD     社保卡号{@from body}
     * @param $STF_CONTRACTDATE   日期合同{@from body}
     * @param $STF_MEDICALCARD    医疗保险账号{@from body}
     * @param $STF_TRIALDAYS      试用期时间{@from body}
     * @param $STF_ADDRESS        地址{@from body}
     * @param $STF_DESC           备注说明{@from body}
     * @param $CREATE_DATE        创建时间{@from body}
     * @param $USR_UID            用户UID（编辑）{@from body}
     * @param $USR_FULLNAME       姓名{@from body}
     * @param $USR_STATUS         用户状态1激活0注销{@from body}
     * @param $USR_EMAIL          邮箱{@from body}
     * @param $USR_ROLES          角色{@from body}
     * @author zou_mzhu
     * @since  2019-02-11T14:18:25+0800
     * @url  POST /info
     * @return [type]                         [description]
     */
    public function saveStaff($USR_USERNAME, $USR_PASSWORD='',$STF_CODE='',$STF_STATUS='',$GRP_UID='',$STF_JOB='',$STF_HOMETOWN='',$STF_SEX='',$STF_BOD='',$STF_ENTERYDATE='',$STF_NATION='',$USR_PHONE='',$STF_IDCARD='',$STF_POLITICAL='',$STF_EDU='',$STF_MARRIED='',$STF_EDU_SCHOOL='',$STF_EDU_MASTER='',$STF_SALARYCARD='',$STF_SOCIALCARD='',$STF_CONTRACTDATE='',$STF_MEDICALCARD='',$STF_TRIALDAYS='',$STF_ADDRESS='',$STF_DESC='',$CREATE_DATE='',$USR_UID='',$USR_FULLNAME='',$USR_STATUS='',$USR_EMAIL='',$USR_ROLES=''){
        try{
            $aaData=array();
            $aaData['USR_USERNAME']=$USR_USERNAME;
            $aaData['USR_UID']=$USR_UID;
            $aaData['USR_PASSWORD']=$USR_PASSWORD;
            $aaData['USR_FULLNAME']=$USR_FULLNAME;
            $aaData['USR_STATUS']=$USR_STATUS;
            $aaData['USR_SEX']=$STF_SEX;
            $aaData['USR_PHONE']=$USR_PHONE;
            $aaData['USR_ADDRESS']=$STF_ADDRESS;
            $aaData['USR_EMAIL']=$USR_EMAIL;
            $aaData['USR_ROLES']=$USR_ROLES;
            $rest=false;
            $con=Propel::getConnection(RbacUserPeer::DATABASE_NAME);
            $con->begin();
            $res = RbacUser::addedit($aaData);
            if ($res['success']) {
                $aData = array();
                $aData['STF_CODE']              = $STF_CODE;
                $aData['STF_STATUS']            = $STF_STATUS;
                $aData['GRP_UID']               = $GRP_UID;
                $aData['STF_JOB']               = $STF_JOB;
                $aData['STF_HOMETOWN']          = $STF_HOMETOWN;
                $aData['STF_SEX']               = $STF_SEX;
                $aData['STF_BOD']               = $STF_BOD;
                $aData['STF_ENTERYDATE']        = $STF_ENTERYDATE;
                $aData['STF_NATION']            = $STF_NATION;
                $aData['STF_IDCARD']            = $STF_IDCARD;
                $aData['STF_POLITICAL']         = $STF_POLITICAL;
                $aData['STF_EDU']               = $STF_EDU;
                $aData['STF_MARRIED']           = $STF_MARRIED;
                $aData['STF_EDU_SCHOOL']        = $STF_EDU_SCHOOL;
                $aData['STF_EDU_MASTER']        = $STF_EDU_MASTER;
                $aData['STF_SALARYCARD']        = $STF_SALARYCARD;
                $aData['STF_SOCIALCARD']        = $STF_SOCIALCARD;
                $aData['STF_CONTRACTDATE']      = $STF_CONTRACTDATE;
                $aData['STF_MEDICALCARD']       = $STF_MEDICALCARD;
                $aData['STF_TRIALDAYS']         = $STF_TRIALDAYS;
                $aData['STF_ADDRESS']           = $STF_ADDRESS;
                $aData['STF_DESC']              = $STF_DESC;
                $aData['CREATE_DATE']           = $res['CREATE_DATE'];
                $aData['USR_UID']               = $res['data'];
                $rs = RbacStaff::saveStaff($aData);

                $_sMsg = $USR_UID ? '编辑用户' : '创建用户';
                LogUtil::Log('人员管理','DEBUG',"$_sMsg : $USR_FULLNAME"."($USR_USERNAME)  成功!");
                $rest=true;
            }
            $con->commit();           
            return  $result = array(
                    'success'=>$rest,
                    'message'=>$res['message'],
                    'data'=>array(),
                    'code'=>$res['code'],
                    'CREATE_DATE'=>$res['CREATE_DATE']);
        }catch (Exception $e) {
            $con->rollback();
            return array('success'=>$rest, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }


    /**
     * 修改密码
     * @param $USR_UID            用户UID {@from body}    
     * @param $USR_PASSWORD       密码 {@from body}
     * @author zou_mzhu
     * @since  2019-02-11T14:18:25+0800
     * @url  POST /updatapass
     * @return [type]                         [description]
     */
    public function savePassword($USR_UID,$USR_PASSWORD){
        
        $aaData=array();
        $aaData['USR_UID']=$USR_UID;
        $aaData['USR_PASSWORD']=md5($USR_PASSWORD);

        try{
            $res = RbacUser::updatePassword($aaData);
            return  $result = array(
                    'success'=>$res['success'],
                    'message'=>$res['message'],
                    'data'=>array(),
                    'code'=>$res['code']);
        }catch (Exception $e) {
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 账号状态
     * @param $USR_UID            用户UID {@from body}    
     * @param $USR_STATUS         状态0注销1激活 {@from body}
     * @author zou_mzhu
     * @since  2019-02-11T14:18:25+0800
     * @url  POST /updatastatus
     * @return [type]                         [description]
     */
    public function saveStatus($USR_UID,$USR_STATUS){
        
        $aaData=array();
        $aaData['USR_UID']=$USR_UID;
        $aaData['USR_STATUS']=$USR_STATUS;

        try{
            $res = RbacUser::updateStatus($aaData);
            // 同步更新staff表
            if($res['success']){
                $res2 = RbacStaff::updateStatus($aaData);
            }
            return  $result = array(
                    'success'=>$res2['success'],
                    'message'=>$res2['message'],
                    'data'=>array(),
                    'code'=>'200'
                );
        }catch (Exception $e) {
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }
   
    

}