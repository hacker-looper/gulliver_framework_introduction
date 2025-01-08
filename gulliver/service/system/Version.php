<?php
require_once 'classes/model/SysVersion.php';
require_once 'classes/model/SysVersionDiff.php';

/**
 * 版本更新接口类
 */
class Services_Rest_Version
{
    function __construct() {
        // Token::validateApiToken();
    }

     /**
     * 版本更新（列表）
     * @since  2019-01-30 10:00:00 
     *
     * @param $page            页码{ @from path }
     * @param $pageSize        每页条数{ @from path }
     * @url POST /list
     * @return [type]                            [description]
     */
    public function getVersionList($page=1, $pagesize=10){
        require_once 'classes/model/SysVersion.php';
        require_once 'classes/model/SysVersionDiff.php';
        try{
            $aData = array(
                'OFFSET' => ($page - 1) * $pagesize,
                'PAGESIZE'=> $pagesize
            );
            $list = SysVersion::getList($aData);
            foreach ($list['data'] as $key => $value) {
                $packList = SysVersionDiff::getPackList($value['VER_UID']);
                $list['data'][$key]['packageList'] = $packList;
            }
            return array(
                'success'   =>  true,
                'message'   =>  '成功',
                'total'     =>  $list['total'],
                'page'      =>  $page ,
                'pagesize'  =>  $pagesize,
                'data'      =>  $list['data'],
                'code'      =>  '200'
            );

        }catch (Exception $e) {
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 版本更新（新增）
     * @since  2019-01-30 10:00:00 
     *
     * @param $VER_NAME            版本名称{ @from body }
     * @param $VER_CODE            版本编号{ @from body }
     * @param $VER_DESC            版本描述{ @from body }
     * @param $VER_URL             下载地址{ @from body }
     * @url POST /add
     * @return [type]                            [description]
     */
    public function addVersion($VER_NAME='', $VER_CODE='', $VER_DESC='', $VER_URL=''){
        require_once 'classes/model/SysVersion.php';

        try{
            // unset($VER_URL['file']);
            $aData = array(
                'VER_NAME' => $VER_NAME,
                'VER_CODE' => $VER_CODE,
                'VER_DESC' => $VER_DESC,
                'VER_SIZE' => $VER_URL['fileList'][0]['size']/1024,
                'VER_MODULE' => 'ANDROID'
            );

            $file = array(
                'uid' => $VER_URL['fileList'][0]['uid'],
                'name' => $VER_URL['fileList'][0]['name'],
                'url' => $VER_URL['fileList'][0]['response']['data']['fullPath'],
                'status' => 'done'
            );
            $aData['VER_URL'] = json_encode($file);
            $res = SysVersion::editVersion($aData);
            return array(
                'success'   =>  true,
                'message'   =>  '成功',
                'data'      =>  array(),
                'code'      =>  '200'
            );
        }catch (Exception $e) {
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 版本更新（编辑）
     * @since  2019-01-30 10:00:00 
     *
     * @param $VER_UID             版本ID{ @from body }
     * @param $VER_NAME            版本名称{ @from body }
     * @param $VER_CODE            版本编号{ @from body }
     * @param $VER_DESC            版本描述{ @from body }
     * @param $VER_URL             下载地址{ @from body }
     * @url POST /edit
     * @return [type]                            [description]
     */
    public function editVersion($VER_UID='', $VER_NAME='', $VER_CODE='', $VER_DESC='', $VER_URL=''){
        require_once 'classes/model/SysVersion.php';

        try{
            if(isset($VER_URL['file'])){
                unset($VER_URL['file']);
                $file = array(
                    'uid' => $VER_URL['fileList'][0]['uid'],
                    'name' => $VER_URL['fileList'][0]['name'],
                    'url' => $VER_URL['fileList'][0]['url'],
                    'status' => 'done'
                );
            }else{
                $file = $VER_URL[0];
            }
            $aData = array(
                'VER_UID'  => $VER_UID,
                'VER_NAME' => $VER_NAME,
                'VER_CODE' => $VER_CODE,
                'VER_DESC' => $VER_DESC,
                'VER_SIZE' => $VER_URL['fileList'] ? $VER_URL['fileList'][0]['size']/1024 : null,
                'VER_MODULE' => 'ANDROID'
            );
            foreach ($aData as $key => $value) {
                if (is_null($value)) {
                    unset($aData[$key]);
                }
            }
            
            $aData['VER_URL'] = json_encode($file);
            $res = SysVersion::editVersion($aData);
            return array(
                'success'   =>  true,
                'message'   =>  '成功',
                'data'      =>  array(),
                'code'      =>  '200'
            );
        }catch (Exception $e) {
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 版本删除
     * @since  2019-01-30 10:00:00 
     *
     * @param $VER_UID            版本名称{ @from path }
     * @url DELETE /{VER_UID}
     * @return [type]                            [description]
     */
    public function deleteVersion($VER_UID){
        require_once 'classes/model/SysVersion.php';

        try{
            $res = SysVersion::deleteVersion($VER_UID);
            return array(
                'success'   =>  true,
                'message'   =>  '删除成功',
                'data'      =>  array(),
                'code'      =>  '200'
            );
        }catch (Exception $e) {
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 差异包删除
     * @since  2019-01-30 10:00:00 
     *
     * @param $DVER_UID           差异包ID{ @from path }
     * @url DELETE /package/{DVER_UID}
     * @return [type]                            [description]
     */
    public function deletePackage($DVER_UID){
        require_once 'classes/model/SysVersionDiff.php';

        try{
            $res = SysVersionDiff::deletePackage($DVER_UID);
            return array(
                'success'   =>  $res,
                'message'   =>  $res ? '删除成功' : '删除失败',
                'data'      =>  array(),
                'code'      =>  '200'
            );
        }catch (Exception $e) {
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 差异包（新增）
     * @since  2019-01-30 10:00:00 
     *
     * @param $VER_UID             版本ID{ @from body }
     * @param $VER_CODE            版本编号{ @from body }
     * @param $DVER_URL            差异包{ @from body }
     * @param $DVER_UPGRADE_FROM   起始编号{ @from body }
     * @param $DEVR_UPGRADE_TO     目标编号{ @from body }
     * @url POST /package
     * @return [type]                            [description]
     */
    public function addPackage($VER_UID, $VER_CODE='', $DVER_URL='', $DVER_UPGRADE_FROM='', $DEVR_UPGRADE_TO=''){
        require_once 'classes/model/SysVersionDiff.php';

        try{
            $aData = array(
                'VER_UID' => $VER_UID,
                'VER_CODE' => $VER_CODE,
                'DVER_UPGRADE_FROM' => $DVER_UPGRADE_FROM,
                'DEVR_UPGRADE_TO' => $DEVR_UPGRADE_TO,
            );

            $aData['DVER_NAME'] = 'v' . $DVER_UPGRADE_FROM . '-v' . $DEVR_UPGRADE_TO;
            $aData['DVER_MODULE'] = 'ANDROID';
            $aData['DVER_SIZE'] = $DVER_URL['fileList'][0]['size']/1024;

            $file = array(
                'uid' => $DVER_URL['fileList'][0]['uid'],
                'name' => $DVER_URL['fileList'][0]['name'],
                'url' => $DVER_URL['fileList'][0]['url'],
                'status' => 'done'
            );
            $aData['DVER_URL'] = json_encode($file);
            $res = SysVersionDiff::editPackage($aData);
            return array(
                'success'   =>  true,
                'message'   =>  '添加成功!',
                'data'      =>  array(),
                'code'      =>  '200'
            );
        }catch (Exception $e) {
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 检查版本更新
     *
     * verName:版本名称     type:更新方式1:完整更新 0:差异更新     desc:更新描述   url:更新包地址    isNewest:是否最新   size:文件大小KB
     * @Author   xue_long
     * @DateTime 2018-11-27T13:49:32+0800
     * @param    $version 当前版本号 {@from path}
     * @param    $useDiff 是否应用差异包 {@from path}
     * @url GET  /check
     * @return   json
     */
    public static function doAppVersion($version,$useDiff=true){
        try {
            $current_version = explode('.', $version);
            if(count($current_version)!=3){
                return array('success'=>false, 'message'=>'版本号有误', 'data'=>new stdClass(),'code'=>'-2');
            }
            global $GLOBAL_SETTING;
            //获取所有版本
            $lastVersion=SysVersion::getList();
            $lastVersion=$lastVersion['data'];
            //由小到大排序版本号
            $Allversion = array_column($lastVersion, 'VER_CODE');
            usort($Allversion, function($a,$b){
                return version_compare($a, $b);
            });
            //取版本号最大的版本
            $last_version = end($Allversion);
            
            if(version_compare($version, $last_version)>-1||empty($lastVersion)){
                return array('success'=>false, 'message'=>'当前版本已是最新版本', 'data'=>array('isNewest'=> true),'code'=>'-1');
            }
            $newVersion = array();
            foreach ($lastVersion as $key => $value) {
                if ($value['VER_CODE']==$last_version) {
                    $newVersion = $value;
                }
            }

            $url="";//更新包url
            $desc="";//更新内容描述
            $type=0;//更新方式 1:完整更新 0:差异更新
            $size=0;
            //是否有对应版本的差分包
            $diff=SysVersionDiff::get($newVersion['VER_UID'],$version,$newVersion['VER_CODE']);
            if($diff&&$useDiff){
                $url  =$diff['DVER_URL'];
                $url  = json_decode($url,true);
                $url  = $url['url'];
                $desc =$diff['DVER_DESC']!=''? $diff['DVER_DESC']:'';
                $size =$diff['DVER_SIZE'];
            }else{//完整更新
                $url = $newVersion['VER_URL'];
                $url = $url['url'];
                $type=1;
                $size=$newVersion['VER_SIZE'];
            }
            $desc=$desc==''? $newVersion['VER_DESC']:$desc;
            //返回值
            $rdata=array(
                'verCode'   => $newVersion['VER_CODE'],
                'type'      => $type,
                'desc'      => $desc,
                'url'       => $url,
                'isNewest'  => false,
                'size'      => $size,
                );
            return array('success'=>true, 'message'=>'有新的更新', 'data'=>$rdata,'code'=>'200');
        } catch (Exception $e) {
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }
}