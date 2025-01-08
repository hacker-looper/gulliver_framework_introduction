<?php

require_once 'classes/model/om/BaseRbacMenu.php';


/**
 * Skeleton subclass for representing a row from the 'RBAC_MENU' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    classes.model
 */
class RbacMenu extends BaseRbacMenu {

	public static function datatable($aData){
		// jquery.datatable parameters
		$start = isset($aData['start'])?$aData['start']:0;
		$end = isset($aData['length'])?$aData['length']:10;
		$search = isset($aData['search[value]'])?$aData['search[value]']:'';
		$regex = isset($aData['search[regex]'])?$aData['search[regex]']:'';

		$sort_column = isset($aData['SORT_COLUMN:'])?$aData['SORT_COLUMN:']:'PER_NAME';
		$sort_type = isset($aData['SORT_TYPE'])?$aData['SORT_TYPE']:'ASC';

		$con = Propel::getConnection('system');
		$stmt = $con->createStatement();

		$sql = 'SELECT * FROM RBAC_MENU M LEFT JOIN RBAC_PERMISSION P ON M.MENU_PERMISSION=P.PER_UID WHERE 1=1 ';
		$sqlTotal = 'SELECT COUNT(*) AS  TOTAL FROM RBAC_MENU M LEFT JOIN RBAC_PERMISSION P ON M.MENU_PERMISSION=P.PER_UID WHERE 1=1 ';
	
		$rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

		$res = array();
		$index = 1;

		while ($rs->next()) {
			$row = $rs->getRow();

			if($row['MENU_STATUS'] == 1) {
				$row['STATUS'] = '激活';
				$row['CSS_STATUS'] = 'success';
			}else if ($row['MENU_STATUS'] == 0) {
				$row['STATUS'] = '非激活';
				$row['CSS_STATUS'] = 'important';
			}else{
				$row['STATUS'] = '未验证';
				$row['CSS_STATUS'] = 'warning';
			}
			$row['INDEX'] = $index;

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

	public static function get($MENU_UID) {
		$oMenu = RbacMenuPeer::retrieveByPK($MENU_UID);

		$aData = array();
		if($oMenu){
			$aData['MENU_UID'] = $oMenu->getMenuUid();
			$aData['MENU_CODE'] = $oMenu->getMenuCode();
			$aData['MENU_TITLE'] = $oMenu->getMenuTitle();
			$aData['MENU_DESC'] = $oMenu->getMenuDesc();
			$aData['MENU_URL'] = $oMenu->getMenuUrl();
			$aData['MENU_PERMISSION'] = $oMenu->getMenuPermission();

			$aData['CREATE_DATE'] = $oMenu->getCreateDate();
			$aData['MODIFIED_AT'] = $oMenu->getModifiedAt();
			$aData['MODIFIED_BY'] = $oMenu->getModifiedBy();
		}
		
		return $aData;
	}

	public static function addedit($aData) {

		try {

			$uid = isset($aData['MENU_UID'])?$aData['MENU_UID']:'';
			$index = isset($aData['MENU_INDEX'])?$aData['MENU_INDEX']:'0';
			$name = isset($aData['MENU_CODE'])?$aData['MENU_CODE']:'';
			$type = isset($aData['MENU_TYPE'])?$aData['MENU_TYPE']:'';
			$parent = isset($aData['MENU_PARENT'])?$aData['MENU_PARENT']:'';

			$namedisplay = isset($aData['MENU_TITLE'])?$aData['MENU_TITLE']:'';
			$desc = isset($aData['MENU_DESC'])?$aData['MENU_DESC']:'';
			$url = isset($aData['MENU_URL'])?$aData['MENU_URL']:'';
			$status = isset($aData['MENU_STATUS'])?$aData['MENU_STATUS']:'1';
			$permission = isset($aData['MENU_PERMISSION'])?$aData['MENU_PERMISSION']:'';
			
			if(! $uid){
				$aMenu = self::_getMenuByName($name);
				if($aMenu){
					return array('success' => false, 'message' => $aMenu['MENU_CODE'] . ' 已经存在，请检查！');
				}

				$oMenu = new RbacMenu();
				$oMenu->setMenuUid(gulliver::generateUniqueID());
			}else{
				$oMenu = RbacMenuPeer::retrieveByPK($uid);
			}

			$oMenu->setMenuIndex($index);
			$oMenu->setMenuCode($name);
			$oMenu->setMenuTitle($namedisplay);
			$oMenu->setMenuType($type);
			$oMenu->setMenuParent($parent);
			$oMenu->setMenuPermission($permission);
			$oMenu->setMenuDesc($desc);
			$oMenu->setMenuUrl($url);
			$oMenu->setMenuStatus($status);
			$oMenu->setCreateDate(date('Y-m-d H:i:s'));
			$oMenu->save();

			return array('success' => true, 'message' => '操作成功!');
		} catch (Exception $e) {
			return array('success' => false, 'message' => $e->getMessage());
		}
	}

	public static function del($aData){
		try {

			$a = array('success'=>false, 'message'=>'');
			$menu_uid = $aData['MENU_UID'];
			
			// 如果是目录则需要检测是否有子节点
			$isDir = $aData['MENU_TYPE']==='0'?true:false;
			if($isDir){
				$children = self::getMenuTreeByParent($aData['MENU_UID']);
				if($children){
					$a = array('success'=>false, 'message'=>'无法删除一个非空目录！');
					return $a;
				}
			}

			$o = RbacMenuPeer::retrieveByPK($menu_uid);

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

	public static function all() {
		$con = Propel::getConnection('system');
		$stmt = $con->createStatement();

		$sql = 'SELECT * FROM RBAC_MENU WHERE 1=1 ORDER BY MENU_INDEX ASC';
		$rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

		$res = array();
		while ($rs->next()) {
			$res[] = $rs->getRow();
		}

		return $res;
	}

	/**
	 * 获得菜单父目录，包含根目录:/
	 **/ 	
	public static function getMenuParents(){
		$con = Propel::getConnection('system');
		$stmt = $con->createStatement();

		$sql = "SELECT * FROM RBAC_MENU WHERE MENU_PARENT='/' AND MENU_TYPE='0' ORDER BY MENU_INDEX ASC ";
		$rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

		$res = array();
		$res[0] = array('MENU_UID'=>'/','MENU_TITLE'=>'/');
		
		while ($rs->next()) {
			$r = $rs->getRow();
			$res[] = array('MENU_UID'=>$r['MENU_UID'],'MENU_TITLE'=>$r['MENU_TITLE']);
		}
		
		return $res;
	}

	public static function getMenuTreeByParent($parent_id){
		$con = Propel::getConnection('system');
		$stmt = $con->createStatement();

		$sql = "SELECT * FROM RBAC_MENU WHERE MENU_PARENT='$parent_id' ORDER BY MENU_INDEX ASC ";
		$rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

		$res = array();
		while ($rs->next()) {
			$r = $rs->getRow();
			$bFolder = $r['MENU_TYPE']==='0'?true:false;
			$a=array(
				'id'=>$r['MENU_UID'],
				'text'=>$r['MENU_TITLE'],
				"icon" => $bFolder?"fa fa-folder icon-lg icon-state-file":"fa fa-file fa-large icon-state-default",
				'children'=>$bFolder,
				'data'=>$r
			);
			$res[] = $a;
		}
		
		return $res;
	}

	/*
	 * TODO: ...
	 * 获得递归目录树: 过滤权限
	 */
	public static function getMenuTreePermission(){
		$aMenu = self::all();
		$aMenuFilter = array();
		foreach ($aMenu as $k => $v) {
			if(! RBAC::userCanAccess($v['MENU_PERMISSION'])){
				continue;
			}

			array_push($aMenuFilter, $v);
		}

		$t = self::_tree($aMenuFilter, '/');
		$tFilter = array();
		foreach ($t as $k => $v) {
			if($v['MENU_TYPE']==='0' && (! $v['children'])){
				continue;
			}

			array_push($tFilter, $v);
		}

		return $tFilter;
	}

	/*
	 * 获得递归目录树
	 */
	public static function getMenuTree(){
		$aMenu = self::all();
		return self::_tree($aMenu, '/');
	}

	/**
	 * 递归生成树形结构, 查找子节点， pid=父节点id
	 */
	private static function _tree($arr, $p_id='/'){
		$tree = array();
		foreach ($arr as $row) {
			if($row['MENU_PARENT']==$p_id){
				$tmp = self::_tree($arr, $row['MENU_UID']);
				if($tmp){
					$row['children'] = $tmp;
				}

				$tree[] = $row;
			}
			
		}

		return $tree;
	}

	private static function _getMenuByName($name){
		$oCriteria = new Criteria('app');
		$oCriteria->add( RbacMenuPeer::MENU_CODE, $name, Criteria::EQUAL );
		$oCriteria->addAscendingOrderByColumn(RbacMenuPeer::MENU_CODE);
			
		$aData = RbacMenuPeer::doSelectRS($oCriteria);
		$aData->setFetchmode( ResultSet::FETCHMODE_ASSOC );
		$aData->next();
			
		return $aData->getRow();	
	}

} // RbacMenu
