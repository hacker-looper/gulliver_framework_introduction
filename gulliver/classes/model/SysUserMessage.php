<?php

require_once 'classes/model/om/BaseSysUserMessage.php';


/**
 * Skeleton subclass for representing a row from the 'SYS_USER_MESSAGE' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    classes.model
 */
class SysUserMessage extends BaseSysUserMessage {
    /**
     * 写入用户关联信息
     * @author WangJia
     * @since  2019-05-17T11:50:08+0800
     * @return [type]                   [description]
     */
    public static function insertUserMessage($msg_id,$users){        
        foreach ($users as $key => $value) {
            $aData = array();
            $oVendor = new SysUserMessage();
            $aData['MSG_ID'] = $msg_id;
            $aData['USR_ID'] = $value;
            $oVendor->fromArray($aData,BasePeer::TYPE_FIELDNAME);
            $oVendor->save();
        }
    }

    /**
     * 删除用户消息关联关系
     * @author WangJia
     * @since  2019-05-17T11:53:43+0800
     * @param  [type]                   $msg_id [description]
     * @return [type]                           [description]
     */
    public static function deleteUserMessage($msg_id){
        $oCriteria = new Criteria(SysUserMessagePeer::DATABASE_NAME);
        $oCriteria->add(SysUserMessagePeer::MSG_ID, $msg_id, Criteria::EQUAL);
        SysUserMessagePeer::doDelete($oCriteria);
    } 

    /**
     * 指定信息
     * @author WangJia
     * @since  2019-05-17T13:29:39+0800
     * @param  [type]                   $msg_id [description]
     * @param  [type]                   $usr_id [description]
     * @return [type]                           [description]
     */
    public static function getOne($msg_id,$usr_id){
        $oCriteria = new Criteria(SysUserMessagePeer::DATABASE_NAME);
        $oCriteria->add(SysUserMessagePeer::MSG_ID, $msg_id, Criteria::EQUAL);
        $oCriteria->add(SysUserMessagePeer::USR_ID, $usr_id, Criteria::EQUAL);

        $aData = SysUserMessagePeer::doSelectRS($oCriteria);
        $aData->setFetchmode( ResultSet::FETCHMODE_ASSOC );

        $aData->next();
        $row = $aData->getRow();

        return $row;
    }

    /**
     * 修改消息状态为已读
     * @author WangJia
     * @since  2019-05-17T13:15:10+0800
     * @param  [type]                   $msg_id [description]
     * @param  [type]                   $usr_id [description]
     */
    public static function setMessageStatus($MSG_UID,$USR_UID){
        $select = new Criteria(SysUserMessagePeer::DATABASE_NAME);
        $select->add(SysUserMessagePeer::MSG_ID, $MSG_UID, Criteria::EQUAL);
        $select->add(SysUserMessagePeer::USR_ID, $USR_UID, Criteria::EQUAL);

        $update = new Criteria(SysUserMessagePeer::DATABASE_NAME);
        $update->add(SysUserMessagePeer::STATUS, '1');

        $con = Propel::getConnection(SysUserMessagePeer::DATABASE_NAME);
        $rs = BasePeer::doUpdate($select,$update,$con);
        return $rs;
    }  

} // SysUserMessage
