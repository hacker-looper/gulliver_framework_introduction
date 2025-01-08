<?php

require_once 'classes/model/om/BaseSysSyncdata.php';
require_once 'classes/model/SysSyncdataPeer.php';

/**
 * [AutoCode]
 * 数据库MODEL自动生成操作方法；请在此文件基础上修改以实现业务需求；
 * Skeleton subclass for representing a row from the 'SYS_SYNCDATA' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    classes.model
 * @author     Gulliver2
 * @since      20-09-30 17:22:08
 */
class SysSyncdata extends BaseSysSyncdata {

	/**
	 * [AutoCode]
	 *
	 * PK: 当前表的表名
	 * @author Gulliver2
	 * @since  20-09-30 17:22:08
	 **/
	public static $TABLE = 'SYS_SYNCDATA';

	/**
	 * [AutoCode]
	 *
	 * PK: 当前表的主键(String格式，多个以逗号分隔)
	 * 注：注意主键可能为：无主键、单主键、多主键等情况
	 * @author Gulliver2
	 * @since  20-09-30 17:22:08
	 **/
	public static $PK = 'SYNC_UID';

	/**
	 * [AutoCode]
	 *
	 * PK: 当前表的表字段(String格式，多个以逗号分隔)
	 * 注：注意主键可能为：无主键、单主键、多主键等情况
	 * @author Gulliver2
	 * @since  20-09-30 17:22:08
	 **/
	public static $COLUMN = 'SYNC_UID,SYNC_URL,SYNC_DESC,CREATE_DATE,MODIFIED_AT';

	/**
	 * [AutoCode]
	 *
	 * 查询列表(支持分页+检索)
	 * @since  20-09-30 17:22:08
	 * @Author   Gulliver2
	 * @return   Array
	 */
	public static function getList($aData){
		try{
			$obj = new Criteria(SysSyncdataPeer::DATABASE_NAME);

			$total = SysSyncdataPeer::doCount($obj);
			if(isset($aData['OFFSET'])){
				$obj->setOffset($aData['OFFSET']);
				$obj->setLimit($aData['PAGESIZE']);
			}

			$obj->addDescendingOrderByColumn(SysSyncdataPeer::CREATE_DATE);
			
			$aaData = SysSyncdataPeer::doSelectRS($obj);
			$aaData -> setFetchmode(ResultSet::FETCHMODE_ASSOC);
			$aaData -> next();

			$aResult =array();
			while (is_array($row = $aaData->getRow())) {
			   $aResult [] = $row;
			   $aaData -> next();
			}

			$aResult = array('success'=>true,
						 'data'=>$aResult,
						 'total'=>$total
					);

	        return $aResult;
		}catch(Exception $e){
			throw $e;
		}
	}

	/**
	 * [AutoCode]
	 *
	 * 根据主键(PK)查询详情
	 * @param $PK 主键 PK主键参数: Array/String
	 * @return Array
	 * @author Gulliver2
	 * @since  20-09-30 17:22:08
	 **/
	public static function get($PK) {
		$oData = self::getObjByPk($PK);
		if(!$oData) return array();
		return $oData->toArray(BasePeer::TYPE_FIELDNAME);
	}

	/**
	 * [AutoCode]
	 *
	 * 根据主键(PK)删除对象
	 * @param $PK 主键 PK主键参数 Array/String
	 * @return Boolean
	 * @author Gulliver2
	 * @since  20-09-30 17:22:08
	 **/
	public static function del($PK){
		$oData = self::getObjByPk($PK);
		if($oData) {$oData->delete();return true;}
		else return false;
	}

	/**
	 * [AutoCode]
	 *
	 * 创建/编辑基本信息
	 * @param array 表字段为KEY的数组， 数组key不存在则不更新表字段
	 * @return Boolean
	 * @author Gulliver2
	 * @since  20-09-30 17:22:08
	 **/
	public static function addedit($aData=array()){
		try{
			$aPKColumns = explode(',', self::$PK);
			$_b = 1; foreach($aPKColumns as $_p){
				$_bb = isset($aData[$_p])?1:0;
				$_b = $_b && $_bb;
			}

			if($_b){ // 主键存在，执行编辑操作
				$bNew = false;
				$oRec = self::getObjByPk($aData[self::$PK]);
				if(! $oRec) $bNew = true;
			}else{   // 主键不存在，执行新建操作
				$bNew = true;
			}

			if($bNew){
				require_once 'classes/model/SysSyncdata.php';
				$oRec = new SysSyncdata();

				// 设置主键；
				$uid = gulliver::generateUniqueID();
				$oRec->setByName(self::$PK, $uid, BasePeer::TYPE_FIELDNAME);
				$oRec->setCreateDate(date('Y-m-d H:i:s'));
			}else{
				$oRec = self::getObjByPk($aData[self::$PK]);
			}

			$oRec->fromArray($aData, BasePeer::TYPE_FIELDNAME);
	        $oRec->save();

			$sMsg = $bNew ? '创建数据成功!':'更新数据成功!';
	        return array('success'=>true,'message'=>$sMsg,'data'=>array());
		}catch(Exception $e){
			return array('success'=>false,'message'=>$e->getMessage(),'data'=>array());
		}
	}

	/**
	 * [AutoCode]
	 *
	 * 根据P获取数据库表对象
	 * @param PK 主键
	 * @return Object
	 * @author Gulliver2
	 * @since  20-09-30 17:22:08
	 **/
	protected static function getObjByPk($PK){
		if(! $PK) return null;
		$obj = SysSyncdataPeer::retrieveByPK($PK);
		return $obj;
	}

} // SysSyncdata
