<?php

require_once 'classes/model/om/BaseSysConfiguration.php';
require_once 'classes/model/SysConfigurationPeer.php';


/**
 * Skeleton subclass for representing a row from the 'SYS_CONFIGURATION' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    classes.model
 */
class SysConfiguration extends BaseSysConfiguration {

	public static function getList($aData){
        $oCriteria = new Criteria('app');

        if($aData['CON_KEY']){
            $oCriteria->add(SysConfigurationPeer::CON_KEY,'%'.$aData['CON_KEY'].'%',Criteria::LIKE);
        }
        
        $total = SysConfigurationPeer::doCount($oCriteria);
        
        if($aData['OFFSET'])           $oCriteria->setOffset($aData['OFFSET']);
        if($aData['PAGESIZE'])         $oCriteria->setLimit($aData['PAGESIZE']);

        $aData = SysConfigurationPeer::doSelectRS($oCriteria);
        $aData->setFetchmode( ResultSet::FETCHMODE_ASSOC );

        $aData->next();
        $list = array();
        while(is_array($row = $aData->getRow())){
            $list[] = $row;
            $aData->next();
        }

        return array('data'=>$list, 'total'=>$total);
    }

    // @deprecated
	public static function datatable($aData){
		// jquery.datatable parameters
		$start = isset($aData['start'])?$aData['start']:0;
		$end = isset($aData['length'])?$aData['length']:10;
		$search = isset($aData['search']['value'])?$aData['search']['value']:'';
		// $regex = isset($aData['search[regex]'])?$aData['search[regex]']:'';

		$sort_column = isset($aData['SORT_COLUMN:'])?$aData['SORT_COLUMN:']:'CON_KEY';
		$sort_type = isset($aData['SORT_TYPE'])?$aData['SORT_TYPE']:'ASC';

		$con = Propel::getConnection('system');
		$stmt = $con->createStatement();

		$sql = 'SELECT * FROM SYS_CONFIGURATION WHERE 1=1 ';
		$sqlTotal = 'SELECT COUNT(*) AS  TOTAL FROM SYS_CONFIGURATION WHERE 1=1 ';
		
		// 查询相关
		if($search){
			$sql .= "AND (CON_KEY LIKE '%$search%' OR CON_TITLE LIKE '%$search%') ";
			$sqlTotal .= "AND (CON_KEY LIKE '%$search%' OR CON_TITLE LIKE '%$search%') ";
		}

		$rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

		$res = array();
		$index = 1;

		while ($rs->next()) {
			$row = $rs->getRow();

			$res[] = $row;
			$index++;
		}

		//get Ttotal
		$rs = $stmt->executeQuery($sqlTotal, ResultSet::FETCHMODE_ASSOC);

		$total = 0;
		if($rs->next()) {
			$row = $rs->getRow();
			$total = intval($row['TOTAL']);
		}

		return array('iTotalRecords'=>intval($end), //本次加载记录数量  
					 'iTotalDisplayRecords'=>$total, //总记录数量  
					 'aaData'=> $res);
	}

    // @deprecated
	public static function addedit($aData) {

		try {

			$key = isset($aData['CON_KEY'])?$aData['CON_KEY']:'';
			$value = isset($aData['CON_VALUE'])?$aData['CON_VALUE']:'';
			$title = isset($aData['CON_TITLE'])?$aData['CON_TITLE']:'';
			$desc = isset($aData['CON_DESC'])?$aData['CON_DESC']:'';
			$module = isset($aData['CON_MODULE'])?$aData['CON_MODULE']:'';

			if($key){
				$aSysConf = self::_getSysConfByKey($key);
				if($aSysConf){
					return array('success' => false, 'message' => $aSysConf['CON_KEY'] . ' 已经存在，请检查！');
				}

				$con = new SysConfiguration();
				$con->setConKey($key);
				$con->setCreateDate(date('Y-m-d H:i:s'));
			}else{
				$con = SysConfigurationPeer::retrieveByPK($key);
			}

			$con->setConValue($value);
			$con->setConTitle($title);
			$con->setConDesc($desc);
			$con->setConModule($module);
			
			$con->save();
			return array('success' => true, 'message' => '创建成功!');
		} catch (Exception $e) {
			return array('success' => false, 'message' => $e->getMessage());
		}
	}

	/**
	 * 创建/编辑
	 * @param array 表字段为KEY的数组， 数组key不存在则不更新表字段
	 **/
	public static function saveInfo($aData=array()){
		$PK = isset($aData['CON_KEY']) ? $aData['CON_KEY'] : '';
		$bNew = false;

		$obj = null;
		if($PK) {
			$obj = SysConfigurationPeer::retrieveByPK($PK);
			if(! $obj) $bNew = true;
		}else{
			$bNew = true;
		}

		if($bNew){
			$obj = new SysConfiguration();
			$obj->setConKey($PK);
			$obj->setCreateDate(date('Y-m-d H:i:s'));
		}

		if(isset($aData['CON_VALUE'])){ $obj->setConValue($aData['CON_VALUE']);}
		if(isset($aData['CON_TITLE'])){ $obj->setConTitle($aData['CON_TITLE']);}
		if(isset($aData['CON_DESC'])) { $obj->setConDesc($aData['CON_DESC']);}
        if(isset($aData['CON_MODULE'])){ $obj->setConModule($aData['CON_MODULE']);}

		$obj->save();
	}

	public static function removeByPK($CON_KEY){
        try{
            $oConf = SysConfigurationPeer::retrieveByPK($CON_KEY);
            if($oConf) $oConf->delete();
            return true;
        }catch(Exception $e){
            throw $e;
        }
    }

	public static function get($CON_KEY) {
		$oSysConf = SysConfigurationPeer::retrieveByPK($CON_KEY);
		$aData = array();
		if($oSysConf){
			$aData['CON_KEY'] = $oSysConf->getConKey();
			$aData['CON_VALUE'] = $oSysConf->getConValue();
			$aData['CON_TITLE'] = $oSysConf->getConTitle();
			$aData['CON_DESC'] = $oSysConf->getConDesc();
			$aData['CON_MODULE'] = $oSysConf->getConModule();
			$aData['CREATE_DATE'] = $oSysConf->getCreateDate();
			$aData['MODIFIED_AT'] = $oSysConf->getModifiedAt();
			$aData['MODIFIED_BY'] = $oSysConf->getModifiedBy();
		}
		return $aData;
	}

	public static function all() {
		$con = Propel::getConnection('system');
		$stmt = $con->createStatement();

		$sql = 'SELECT * FROM SYS_CONFIGURATION WHERE 1=1 ';
		$rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

		$res = array();
		while ($rs->next()) {
			$res[] = $rs->getRow();
		}

		return $res;
	}

	// @deprecated
	public static function del($aData){
		try {

			$a = array('success'=>false, 'message'=>'');
			$con_key = $aData['CON_KEY'];

			$o = SysConfigurationPeer::retrieveByPK($con_key);

			if($o){
				$o->delete();
				$a['success'] = true;
				$a['message'] = '删除成功！';
			}
		} catch (Exception $e) {
			$a['success'] = false;
			$a['message'] = '删除失败：'+$e->getMessage();
		}

		return $a;
	}

	private static function _getSysConfByKey($key){
		$oCriteria = new Criteria('app');
		$oCriteria->add( SysConfigurationPeer::CON_KEY, $key, Criteria::EQUAL );
		$oCriteria->addAscendingOrderByColumn(SysConfigurationPeer::CON_KEY);
			
		$aData = SysConfigurationPeer::doSelectRS($oCriteria);
		$aData->setFetchmode( ResultSet::FETCHMODE_ASSOC );
		$aData->next();
			
		return $aData->getRow();	
	}

} // SysConfiguration
