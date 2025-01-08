<?php

  // include base peer class
  require_once 'classes/model/om/BaseSysNotificationPeer.php';

  // include object class
  include_once 'classes/model/SysNotification.php';


/**
 * Skeleton subclass for performing query and update operations on the 'SYS_NOTIFICATION' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    classes.model
 */
class SysNotificationPeer extends BaseSysNotificationPeer {
	/**根据手机号码获取notice
	 * [Getnotice description]
	 * @param [type] $phonenum [description]
	 */
	public static function Getnotice($phonenum){
		$oCriteria = new Criteria('app');
		$oCriteria->add( SysNotificationPeer::SN_TO,$phonenum, Criteria::EQUAL);
		$aData = SysNotificationPeer::doSelectRS($oCriteria);
		$aData->setFetchmode( ResultSet::FETCHMODE_ASSOC);
		$aData->next();
		return $aData->getRow();
	}
	/**保存notice
	 * [Addnotice description]
	 * @param [type] $type        [description]
	 * @param [type] $phonenum    [description]
	 * @param [type] $message     [description]
	 * @param [type] $coredata    [description]
	 * @param [type] $attachments [description]
	 * @param [type] $modifiedby  [description]
	 */
	public static function Addnotice($type,$phonenum,$message,$coredata,$attachments,$modifiedby){
		require_once 'classes/model/SysNotificationPeer.php';
		$SN_UID = gulliver::generateUniqueID();
		$oEmailUserFilter = new SysNotification();
		$oEmailUserFilter->setSnUid($SN_UID);
		$oEmailUserFilter->setSnType($type);
		$oEmailUserFilter->setSnTo($phonenum);
		$oEmailUserFilter->setSnMessage($message);
		$oEmailUserFilter->setSnCoredata($coredata);
		$oEmailUserFilter->setSnAttachments($attachments);
		$oEmailUserFilter->setCreateDate(date('Y-m-d H:i:s'));
		$oEmailUserFilter->setModifiedBy($modifiedby);
		$oEmailUserFilter->setModifiedAt(date('Y-m-d H:i:s'));
		$oEmailUserFilter->save();
	}
	/**编辑notice
	 * [editArtical description]
	 * @param  [type] $snuid    [description]
	 * @param  [type] $message  [description]
	 * @param  [type] $coredata [description]
	 * @return [type]           [description]
	 */
	public static function editnotice($snuid,$type,$phonenum,$message,$coredata,$attachments,$modifiedby){
		require_once 'classes/model/SysNotificationPeer.php';
		$artpublish = SysNotificationPeer::retrieveByPK($snuid);
		$artpublish->setSnType($type);
		$artpublish->setSnTo($phonenum);
		$artpublish->setSnMessage($message);
		$artpublish->setSnCoredata($coredata);
		$artpublish->setSnAttachments($attachments);
		$artpublish->setModifiedBy($modifiedby);
		$artpublish->setModifiedAt(date('Y-m-d H:i:s'));
		$artpublish->save();
	}
} // SysNotificationPeer
