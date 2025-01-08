<?php


class Services_Rest_Base
{
    private $_cache_treenode = array();

    function __construct() {
        // Token::validateApiToken();
    }

    /**
     * 新增 / 编辑部门
     * @since  2018-12-12T19:38:35+0800
     * @param  $GRP_UID         GROUP_ID {@from body}
     * @param  $GRP_NAME        分组名称 {@from body}
     * @param  $GRP_TYPE        分组类型 {@from body}
     * @param  $GRP_TYPE        分组描述 {@from body}
     * @param  $GRP_PARENT      父级ID   {@from body}
     * @param  $IS_EDIT         编辑状态   {@from body}
     
     * 
     * @url POST /Organization/info
     * @return [type]                            [description]
     */
    public function editOrganization($GRP_UID,$GRP_NAME=NULL,$GRP_TYPE=NULL,$GRP_DESC=NULL,$GRP_PARENT=NULL,$IS_EDIT=NULL){
        try{
            require_once 'classes/model/RbacGroup.php';

            $aData = array();
            if($GRP_UID != NULL)                $aData['GrpUid'] = $GRP_UID;
            if($GRP_NAME != NULL)               $aData['GrpName'] = $GRP_NAME;
            if($GRP_TYPE != NULL)               $aData['GrpCode'] = $GRP_TYPE;
            if($GRP_DESC != NULL)               $aData['GrpDesc'] = $GRP_DESC;
            if($GRP_PARENT != NULL)             $aData['GrpParent'] = $GRP_PARENT;
            if($IS_EDIT != NULL)                $aData['IS_EDIT'] = $IS_EDIT;

            $rs = RbacGroup::editOrganization($aData);
            return array('success'=>$rs['success'],
                        'message'=>$rs['message'],
                        'data'=>[],
                        'code'=>'200');

        }catch (Exception $e) {
            var_dump($e->getMessage());
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 删除部门
     * @since  2018-12-12T19:38:35+0800
     * @param  $GRP_UID         GROUP_ID {@from path}
     * 
     * @url DELETE /Organization/delete/{GRP_UID}
     * @return [type]                            [description]
     */
    public function delOrganization($GRP_UID){
        try{
            require_once 'classes/model/RbacGroup.php';
            $rs = RbacGroup::delOrganization($GRP_UID);
            return array('success'=>$rs,
                            'message'=>$rs ? '删除成功!' : '删除失败！',
                            'data'=>array(),
                            'code'=>'200');

        }catch (Exception $e) {
            var_dump($e->getMessage());
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 部门列表（列表）
     * @since  2018-12-12T19:38:35+0800     
     * @param  $GRP_PARENT      父级ID   {@from body}
     * @param  $GRP_UID         GROUP_ID {@from body}
     * @param  $GRP_NAME        部门名称 {@from body}
     * @param  $page            分页     {@from body}
     * @param  $pagesize        单页数量.{@from body}
     * 
     * @url POST /Organization/list
     * @return [type]                            [description]
     */
    public function getOrganizationList($GRP_PARENT=NULL,$GRP_UID=NULL,$GRP_NAME=NULL,$page=1,$pagesize=10){
        try{
           require_once 'classes/model/RbacGroup.php';
           $GRP_PARENT = $GRP_PARENT === "" ? '/' : $GRP_PARENT;
           $offset = ($page - 1) * $pagesize;
           $data = RbacGroup::getOrganizationList($GRP_PARENT,$GRP_UID,$GRP_NAME,$offset,$pagesize);
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
     * 查询部门列表(Select)
     * 
     * @url GET /organization_select 
     * @return object
     */
    public function getBaseOrganizationSelect(){
        try{
           require_once 'classes/model/RbacGroup.php';
           $aTreeData = RbacGroup::getGroup4Select();
           return array('success'=>true,
                        'message'=>'数据查询成功!',
                        'data'=>$aTreeData,
                        'code'=>'200');

        }catch (Exception $e) {
            var_dump($e->getMessage());
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 查询部门列表(Tree)
     * 
     * @url GET /organization_tree
     * @return object
     */
    public function getBaseOrganizationTree(){
        try{
           require_once 'classes/model/RbacGroup.php';
           $aTreeData = RbacGroup::getGroup4Tree();
           return array('success'=>true,
                        'message'=>'数据查询成功!',
                        'data'=>$aTreeData,
                        'code'=>'200');

        }catch (Exception $e) {
            var_dump($e->getMessage());
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 查询产品分类列表(Select)
     * 
     * @url GET /category_select
     * @return object
     */
    public function getBaseCategorySelect(){
        try{

           $aData = $this->_get_category();
           $aTreeData = $this->_tree4Select($aData, '/');

           return array('success'=>true,
                        'message'=>'数据查询成功!',
                        'data'=>$aTreeData,
                        'code'=>'200');

        }catch (Exception $e) {
            var_dump($e->getMessage());
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 查询产品分类列表(Tree)
     * 
     * @url GET /category_tree
     * @return object
     */
    public function getBaseCategoryTree(){
        try{

           $aData = $this->_get_category();
           $aTreeData = $this->_tree4Tree($aData, '/');

           return array('success'=>true,
                        'message'=>'数据查询成功!',
                        'data'=>$aTreeData,
                        'code'=>'200');

        }catch (Exception $e) {
            var_dump($e->getMessage());
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 查询产品分类列表
     * 
     * @param $CAT_PARENT 父节点cat_uid {@from body}
     * @param $CAT_CODE 节点编号,支持模糊查询 {@from body}
     * @param $CAT_NAME 节点名称,支持模糊查询 {@from body}
     * @param $page 分页 {@from body}
     * @param $pagesize 单页数量 {@from body}
     * @url POST /category_list
     * @return object
     */
    public function getBaseCategory($CAT_PARENT='/',$CAT_CODE=NULL,$CAT_NAME=NULL,$page=1,$pagesize=10){
        try{
           if(! $CAT_PARENT) $CAT_PARENT = '/';
           $aData = array();
           $aData['CAT_PARENT'] = $CAT_PARENT;
           $aData['OFFSET']     = ($page - 1) * $pagesize;
           $aData['PAGESIZE']   = $pagesize;
           
           if($CAT_CODE != NULL) $aData['CAT_CODE'] = $CAT_CODE;
           if($CAT_NAME != NULL) $aData['CAT_NAME'] = $CAT_NAME;
           $data = ImBaseCategory::cateGoryList($aData);
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

    /**
     * 删除产品
     * @param $CAT_UID           产品ID {@from url}
     * @since  2018-11-22T14:53:40+0800
     * 
     * @url DELETE /category/delete/{CAT_UID}
     * @return [type]                   [description]
     */
    public function delCategory($CAT_UID){
        try{
            $rs = ImBaseCategory::delCategory($CAT_UID);
            //缺少关联删除BOM
            return array('success'=>$rs['success'],
                        'message'=>$rs['message'],
                        'data'=>array(),
                        'code'=>'200');
        }catch (Exception $e) {
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

    /**
     * 新增 / 编辑 产品
     * @param $CAT_UID              产品ID {@from body}
     * @param $CAT_NAME             产品名称 {@from body}
     * @param $CAT_PARENT           产品父级ID {@from body}
     * @param $CAT_DESC             产品描述 {@from body}
     * @param $IS_EDIT              1 : 编辑 {@from body}
     * 
     * @since  2018-11-22T14:53:40+0800
     * 
     * @url POST /category/info
     * @return [type]                   [description]
     */
    public function editCategory($CAT_UID,$CAT_NAME=NULL,$CAT_PARENT=NULL,$CAT_DESC=NULL,$IS_EDIT=0){
        try{
            $aData = array();
            $aData['IS_EDIT'] = $IS_EDIT;
            if($CAT_UID != NULL)                $aData['CatUid'] = $CAT_UID;
            if($CAT_NAME != NULL)               $aData['CatName'] = $CAT_NAME;
            if($CAT_CODE != NULL)               $aData['CatUid'] = $CAT_UID;
            if($CAT_PARENT != NULL)             $aData['CatParent'] = $CAT_PARENT;
            if($CAT_DESC != NULL)               $aData['CatDesc'] = $CAT_DESC;
            $rs = ImBaseCategory::editCategory($aData);
            //缺少关联删除BOM
            return array('success'=>$rs['success'],
                        'message'=>$rs['message'],
                        'data'=>array(),
                        'code'=>'200');
        }catch (Exception $e) {
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }


    /**
     * 查询IM_BOM_CATEGORY信息
     **/ 
    private function _get_category($CAT_PARENT='', $CAT_CODE='', $CAT_NAME=''){
        require_once 'classes/model/ImBaseCategory.php';
        $aData = ImBaseCategory::getData($CAT_PARENT, $CAT_CODE, $CAT_NAME);
        return $aData;
    }

    /**
     * 递归生成树形结构, 查找子节点， CAT_PARENT=父节点CAT_UID
     */
    private function _tree4Select($arr, $p_id='/'){
        $tree = array();
        foreach ($arr as $row) {
            if($row['CAT_PARENT']==$p_id){
                $this->_cache_treenode[$row['CAT_UID']] = $row['CAT_NAME'];
                $tmp = self::_tree4Select($arr, $row['CAT_UID']);

                $tree_row = array();
                $tree_row['key']     = $row['CAT_UID'];
                $tree_row['value']   = $row['CAT_UID'];
                $tree_row['label']   = "[".$row['CAT_UID']."]".$row['CAT_NAME'];
                $tree_row['parent']  = $row['CAT_PARENT'];

                /*if($tree_row['parent']!='/'){
                    $tree_row['value'] = "[".$row['CAT_PARENT']."]".$this->_cache_treenode[$row['CAT_PARENT']]."/".$tree_row['label'];
                }*/

                if($tmp){
                    $tree_row['children']= $tmp;
                }                

                $tree[] = $tree_row;
            }
            
        }

        return $tree;
    }

    /**
     * 递归生成树形结构, 查找子节点， CAT_PARENT=父节点CAT_UID
     */
    private function _tree4Tree($arr, $p_id='/'){
        $tree = array();
        foreach ($arr as $row) {
            if($row['CAT_PARENT']==$p_id){
                $tmp = self::_tree4Tree($arr, $row['CAT_UID']);

                $tree_row = array();
                $tree_row['key']     = $row['CAT_UID'];
                $tree_row['title']   = "[".$row['CAT_UID']."]".$row['CAT_NAME'];
                $tree_row['parent']   = $row['CAT_PARENT'];

                if($tmp){
                    $tree_row['children']= $tmp;
                }                

                $tree[] = $tree_row;
            }
            
        }

        return $tree;
    }

    /**
     * 控制台统计数据
     * @since  2018-12-12T19:38:35+0800
     * @param  $GRP_UID         GROUP_ID {@from path}
     * 
     * @url get /chartdata
     * @return [type]                            [description]
     */
    public function chartdata(){
        try{
            $result = array();
            //STEP1 : 订单数量及其转化率
            $res = ImSaleOrder::getCountAndRate();
            $result['ORDER']['order_count'] = $res['total'];
            $result['ORDER']['order_rate'] = $res['rate'] . '%';
            
            //STEP2 : 订单准点率
            $res = ImSaleOrder::getOrderFP();
            $result['ORDER']['on_time'] = $res['arate'] . '%';
            $result['ORDER']['last_rate'] = $res['lrate'];
            $result['ORDER']['curr_rate'] = $res['crate'];
            
            //STEP3 : 生产进度
            $res = ImMrpProduceformDetail::getProgress();
            $result['produce']['rate'] = $res['rate'];
            $result['produce']['curr_rate'] = $res['curr_rate'];
            $result['produce']['last_rate'] = $res['last_rate'];
            $result['produce']['mrate'] = $res['mrate'];
            $result['produce']['prate'] = $res['curr_rate'];

            $log_count = Syslog::logCount(date("Y-m-d",time()));

            $mini_data = ImSaleOrder::getCountOrderByMonth();
            $result['minidata'] = $mini_data;
            $result['usercount'] = $log_count;
            return array('success'=>true, 'message'=>'', 'data'=>$result,'code'=>'200');
        }catch (Exception $e) {
            return array('success'=>false, 'message'=>'服务器异常，请稍后重试', 'data'=>new stdClass(),'code'=>'500');
        }
    }

}