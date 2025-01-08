<?php

require_once 'classes/model/RbacStaffPeer.php';
require_once 'classes/model/om/BaseRbacStaff.php';

/**
 * Skeleton subclass for representing a row from the 'rbac_staff' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    classes.model
 */
class RbacStaff extends BaseRbacStaff {
	// 查询人员根据ID
    public static function getByPK($USR_UID){
        $oVendor = RbacStaffPeer::retrieveByPK($USR_UID);
        return $oVendor ? $oVendor->toArray(BasePeer::TYPE_FIELDNAME) : array();
    }

    // 查询员工树
    public static function getStaffTree(){
       require_once 'classes/model/RbacGroup.php';
       return RbacGroup::getGroup4Tree(true);
    }

	// 删除
	public static function removeByPK($USR_UID){
    	try{
    		$oVendor = RbacStaffPeer::retrieveByPK($USR_UID);
        	if($oVendor) $oVendor->delete();            
        	return true;
    	}catch(Exception $e){
    		throw $e;
    	}
    }

    // 列表
    public static function getList($aData){
        require_once 'classes/model/RbacRole.php';
    	require_once 'classes/model/RbacGroupPeer.php';

        $start = isset($aData['OFFSET'])?$aData['OFFSET']:0;
        $limit = isset($aData['PAGESIZE'])?$aData['PAGESIZE']:10;
        $USR_UID = isset($aData['USR_UID'])?$aData['USR_UID']:'';
        $STF_CODE = isset($aData['STF_CODE'])?$aData['STF_CODE']:'';
        $STF_STATUS = isset($aData['STF_STATUS'])?$aData['STF_STATUS']:'';
        $GRP_UID = isset($aData['GRP_UID'])?$aData['GRP_UID']:'';
        $STF_JOB = isset($aData['STF_JOB'])?$aData['STF_JOB']:'';
        $GRP_NAME = isset($aData['GRP_NAME'])?$aData['GRP_NAME']:'';
        $USR_FULLNAME = isset($aData['USR_FULLNAME'])?$aData['USR_FULLNAME']:'';
        //连接数据库
        $oCriteria = new Criteria ( 'app' );

        $oCriteria->addAlias('RG', RbacGroupPeer::TABLE_NAME);
        $oCriteria->addAlias('RU', RbacUserPeer::TABLE_NAME);

        $oCriteria->addAsColumn ('GRP_NAME', 'RG.GRP_NAME');//订单编号
        $oCriteria->addAsColumn ('USR_FULLNAME', 'RU.USR_FULLNAME');//全名
        $oCriteria->addAsColumn ('USR_USERNAME', 'RU.USR_USERNAME');//全名
        $oCriteria->addAsColumn ('USR_PASSWORD', 'RU.USR_PASSWORD');//密码
        $oCriteria->addAsColumn ('USR_PHONE', 'RU.USR_PHONE');//手机号码
        $oCriteria->addAsColumn ('USR_STATUS', 'RU.USR_STATUS');//状态
        $oCriteria->addAsColumn ('USR_ROLES', 'RU.USR_ROLES');//状态
        $oCriteria->addAsColumn ('USR_IMAGE', 'RU.USR_IMAGE');//状态

        //连表查询
        $bConditions   = array();
        $bConditions[] = array(RbacStaffPeer::GRP_UID, 'RG.GRP_UID');
        $oCriteria->addJoinMC($bConditions, Criteria::LEFT_JOIN);

        $bConditions   = array();
        $bConditions[] = array(RbacStaffPeer::USR_UID, 'RU.USR_UID');
        $oCriteria->addJoinMC($bConditions, Criteria::LEFT_JOIN);

        if($aData['USR_UID']) {
            $oCriteria->add (RbacStaffPeer::USR_UID, $aData['USR_UID']);
        }
        if($STF_CODE!=''){
            $oCriteria->add (RbacStaffPeer::STF_CODE, '%' . $STF_CODE . "%", Criteria::LIKE);
        }
        if($STF_STATUS!==''){
            $oCriteria->add (RbacStaffPeer::STF_STATUS,$STF_STATUS, Criteria::EQUAL);
        }
        if($GRP_NAME){
            $oCriteria->add ('RG.GRP_NAME','%'.$GRP_NAME."%", Criteria::LIKE);
        }
        if($GRP_UID){
            $oCriteria->add (RbacStaffPeer::GRP_UID,$GRP_UID, Criteria::EQUAL);
        }
        if($USR_FULLNAME){
            $oCriteria->add ('RU.USR_FULLNAME','%' .  $USR_FULLNAME . "%", Criteria::LIKE);
        }
        if($STF_JOB){
            $oCriteria->add (RbacStaffPeer::STF_JOB, $STF_JOB , Criteria::EQUAL);
        }

        // 计数: COUNT, 用于列表分页计算
        $totalCount = RbacStaffPeer::doCount ( $oCriteria );
       
        // 排序: ORDER BY CREATE_DATE DESC
        $oCriteria->addDescendingOrderByColumn(RbacStaffPeer::CREATE_DATE);
        // $oCriteria->add ( EmailUserFilterPeer::PRO_UID, $proUID );
        $oCriteria->setOffset($start); // 开始索引
        $oCriteria->setLimit($limit);  // 每页的行数

        $oDataset = RbacStaffPeer::doSelectRS ( $oCriteria );
        $oDataset->setFetchmode ( ResultSet::FETCHMODE_ASSOC );
        $oDataset->next ();
        $aResult = array();
        $role=array();
        $aGroup = RbacGroup::getAll();
        $aRole = RbacRole::all();
        while ( is_array ( $row = $oDataset->getRow () ) ) {          
            $row['GRP_TITLE'] = isset($aGroup[$row['GRP_UID']]['GRP_TITLE'])?$aGroup[$row['GRP_UID']]['GRP_TITLE']:'';
            $row['GRP_PATH'] = $aGroup[$row['GRP_UID']]['GRP_PATH'];
            $role=explode(',',$row['USR_ROLES']);
            
            $_aRole = array();
            if($role)foreach ($role as $k => $v) {
                $_aRole[$v]['ROLE_UID'] = $aRole[$v]['ROLE_UID'];
                $_aRole[$v]['ROLE_NAME'] = $aRole[$v]['ROLE_NAME'];
                $_aRole[$v]['ROLE_NAME_DISPLAY'] = $aRole[$v]['ROLE_NAME_DISPLAY'];
            }
            $row['ROLE']=array();
            if($role[0]!=''){
                $row['ROLE_DETAIL']=$_aRole;
				$row['ROLE']=$role;
            }
            $aResult [] = $row;
            $oDataset->next ();
        }     
        $data ['data'] = $aResult;
        $data ['total'] = $totalCount;
        return $data;
    }

    /**
	 * 创建/编辑员工信息
	 * @param array 表字段为KEY的数组， 数组key不存在则不更新表字段
	 **/
	public static function saveStaff($aData=array()){
		try{
			$USR_UID = isset($aData['USR_UID']) ? $aData['USR_UID'] : '';
			$obj = null;
			if($USR_UID) {
				$obj = RbacStaffPeer::retrieveByPK($USR_UID);
            }
			if($obj==null){
				$obj = new RbacStaff();
            }
            if (isset($aData['CREATE_DATE'])) {
		       $obj->setCreateDate($aData['CREATE_DATE']);
            }
			if(isset($aData['STF_CODE'])){$obj->setStfCode($aData['STF_CODE']);}
            if($aData['STF_STATUS']=='')$aData['STF_STATUS']='1';
            if(isset($aData['STF_STATUS'])){ $obj->setStfStatus($aData['STF_STATUS']);}
            if(isset($aData['GRP_UID'])){ $obj->setGrpUid($aData['GRP_UID']);}
			if(isset($aData['USR_UID'])){ $obj->setUsrUid($aData['USR_UID']);}
			
            if(isset($aData['STF_JOB'])){ $obj->setStfJob($aData['STF_JOB']);}
			if(isset($aData['STF_HOMETOWN'])){ $obj->setStfHometown($aData['STF_HOMETOWN']);}
			if(isset($aData['STF_SEX'])){ $obj->setStfSex($aData['STF_SEX']);}
			if($aData['STF_BOD']){ $obj->setStfBod($aData['STF_BOD']);}
            if($aData['STF_ENTERYDATE']!=''){ $obj->setStfEnterydate($aData['STF_ENTERYDATE']);}
			if(isset($aData['STF_NATION'])){ $obj->setStfNation($aData['STF_NATION']);}
			if(isset($aData['STF_IDCARD'])){ $obj->setStfIdcard($aData['STF_IDCARD']);}  
			if(isset($aData['STF_POLITICAL'])){ $obj->setStfPolitical($aData['STF_POLITICAL']);}  
			if(isset($aData['STF_EDU'])){ $obj->setStfEdu($aData['STF_EDU']);}
			if(isset($aData['STF_MARRIED'])){ $obj->setStfMarried($aData['STF_MARRIED']);}  
			if(isset($aData['STF_EDU_SCHOOL'])){ $obj->setStfEduSchool($aData['STF_EDU_SCHOOL']);}  
			if(isset($aData['STF_EDU_MASTER'])){ $obj->setStfEduMaster($aData['STF_EDU_MASTER']);}  
			if(isset($aData['STF_SALARYCARD'])){ $obj->setStfSalarycard($aData['STF_SALARYCARD']);}  
			if(isset($aData['STF_SOCIALCARD'])){ $obj->setStfSocialcard($aData['STF_SOCIALCARD']);}  
            if($aData['STF_CONTRACTDATE']!=''){ $obj->setStfContractdate($aData['STF_CONTRACTDATE']);}
            if(isset($aData['STF_MEDICALCARD'])){ $obj->setStfMedicalcard($aData['STF_MEDICALCARD']);}
            if(isset($aData['STF_TRIALDAYS'])){ $obj->setStfTrialdays($aData['STF_TRIALDAYS']);}
            if(isset($aData['STF_ADDRESS'])){ $obj->setStfAddress($aData['STF_ADDRESS']);}
            if(isset($aData['STF_DESC'])){ $obj->setStfDesc($aData['STF_DESC']);}
			$iAffectedRows = $obj->save();
            if($iAffectedRows!=1){
                throw new Exception("保存用户信息失败", 1);
            }
			return array('success'=>true,'message'=>'保存成功','data'=>$USR_UID,'code'=>'200');
		}catch(Exception $e){
			return array('success'=>false,'message'=>$e->getMessage(),'data'=>'','code'=>'500');
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
                $obj = RbacStaffPeer::retrieveByPK($USR_UID);
            }
            $obj->setStfStatus($aData['USR_STATUS']);
            $obj->save();
           return array('success'=>true,'message'=>'修改成功','data'=>$USR_UID,'code'=>'200');
        }catch(Exception $e){
            return array('success'=>false,'message'=>$e->getMessage(),'data'=>'');
        }
    }
} // RbacStaff