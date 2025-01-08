<?php

require_once 'classes/model/om/BaseSysMessage.php';
require_once 'classes/model/RbacUser.php';
require_once 'classes/model/SysUserMessage.php';


/**
 * Skeleton subclass for representing a row from the 'SYS_MESSAGE' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    classes.model
 */
class SysMessage extends BaseSysMessage {

	public static function getMyList($aData){
        $sql = "SELECT A.* FROM SYS_MESSAGE A , SYS_USER_MESSAGE B WHERE MES_PUBLISH_STATUS='1' AND FIND_IN_SET('".$aData['USR_UID']."', MES_TO_VALUE) AND B.USR_ID='{$aData['USR_UID']}' AND A.MES_UID=B.MSG_ID AND B.STATUS='0' ORDER BY CREATE_DATE DESC LIMIT 0,5";
        $aData = PropelUtil::excuteRS($sql);

        return array('data'=>$aData, 'total'=>count($aData));
    }

	public static function getList($aData){
        $oCriteria = new Criteria('app');

        $oCriteria->addSelectColumn(SysMessagePeer::CREATE_DATE);
        $oCriteria->addSelectColumn(SysMessagePeer::MES_BODY);
        $oCriteria->addSelectColumn(SysMessagePeer::MES_FROM_USER);
        $oCriteria->addSelectColumn(SysMessagePeer::MES_PUBLISH_DATE);
        $oCriteria->addSelectColumn(SysMessagePeer::MES_PUBLISH_STATUS);
        $oCriteria->addSelectColumn(SysMessagePeer::MES_SOURCE);
        $oCriteria->addSelectColumn(SysMessagePeer::MES_TITLE);
        $oCriteria->addSelectColumn(SysMessagePeer::MES_TO_KEY);
        $oCriteria->addSelectColumn(SysMessagePeer::MES_TO_VALUE);
        $oCriteria->addSelectColumn(SysMessagePeer::MES_UID);
        $oCriteria->addSelectColumn(RbacUserPeer::USR_FULLNAME);

        $total = SysMessagePeer::doCount($oCriteria);

        $user_id = isset($aData['USR_UID']) ? $aData['USR_UID'] : '';
        
        if($user_id){
            $UMSG = $oCriteria->getNewCriterion(SysMessagePeer::MES_TO_VALUE, $user_id , Criteria::LIKE);
            $UMSG->addOr($oCriteria->getNewCriterion(SysMessagePeer::MES_FROM_USER,$user_id));
            $oCriteria->add($UMSG);
        } 
        if($aData['SEARCH']){
            $oCriteria->add(SysMessagePeer::MES_TITLE,$aData['SEARCH'],Criteria::LIKE);
        }         
        if($aData['OFFSET'])           $oCriteria->setOffset($aData['OFFSET']);
        if($aData['PAGESIZE'])         $oCriteria->setLimit($aData['PAGESIZE']);

        $oCriteria->addDescendingOrderByColumn(SysMessagePeer::CREATE_DATE);

        $oCriteria->addJoin(SysMessagePeer::MES_FROM_USER,RbacUserPeer::USR_UID,Criteria::LEFT_JOIN);

        $aData = SysMessagePeer::doSelectRS($oCriteria);
        $aData->setFetchmode( ResultSet::FETCHMODE_ASSOC );

        $aData->next();
        $list = array();
        while(is_array($row = $aData->getRow())){
            $row['MSG_STATUS'] = 2;                 //默认消息已读(发布者)
        	$_to = explode(",",$row['MES_TO_VALUE']);
        	$_to_names = array();
        	foreach ($_to as $_v) {
        		$_x = RbacUser::getUserInfo($_v);
        		$_to_names[] = $_x['USR_FULLNAME'];
        	}        	
        	$row['MES_TO_USERNAMES'] = implode(",", $_to_names);
            //如果当前用户是接收者，那么读取MESSAGE对应的状态
            $status = SysUserMessage::getOne($row['MES_UID'],$user_id);
            if($status){
                $row['MSG_STATUS'] = $status['STATUS'];
            }

            $list[] = $row;
            $aData->next();
        }
        return array('data'=>$list, 'total'=>$total);
    }

    /**
	 * 创建/编辑
	 * @param array 表字段为KEY的数组， 数组key不存在则不更新表字段
	 **/
	public static function saveInfo($aData=array()){
        //开启事务
        $con = Propel::getConnection(SysMessagePeer::DATABASE_NAME);
        $con->begin();
        // var_dump($aData);
        try{
            $mes_id  = isset($aData['MES_UID']) ? $aData['MES_UID'] : '';
            $oVendor = SysMessagePeer::retrieveByPK($mes_id);
            $users   = explode(',', $aData['MES_TO_VALUE']); 
            if(!$oVendor){
                $oVendor = new SysMessage();
                $aData['MES_UID'] = gulliver::generateUniqueID();
                $aData['CREATE_DATE'] = date('Y-m-d H:i:s');
            }else{
                //删除关联关系
                SysUserMessage::deleteUserMessage($aData['MES_UID']);
            }
            SysUserMessage::insertUserMessage($aData['MES_UID'],$users);
            $aData['MODIFIED_AT'] = date('Y-m-d H:i:s');
            $aData['MES_FROM_USER'] = $aData['USR_UID'];
            unset($aData['USR_UID']);
            $oVendor->fromArray($aData,BasePeer::TYPE_FIELDNAME);
            $oVendor->save();	
            $con->commit();	
        }catch(Exception $e){
            $con->rollback();
            throw $e;
        }
	}

	// 发布消息
	public static function publish($MES_UID){
        try{
            $obj = SysMessagePeer::retrieveByPK($MES_UID);
            $obj->setMesPublishStatus('1');
            $obj->setMesPublishDate(date('Y-m-d H:i:s'));
            $obj->save();
            return true;
        }catch(Exception $e){
            throw $e;
        }
    }    

	public static function removeByPK($MES_UID){
        try{
            $obj = SysMessagePeer::retrieveByPK($MES_UID);
            if($obj) $obj->delete();
            return true;
        }catch(Exception $e){
            throw $e;
        }
    }
} // SysMessage
