<?php
/**
 * class.email.php
 */

require_once ('classes/model/Message.php');
class emailRun {
  private $config;
  private $fileData;
  private $spool_id;
  public  $status;
  public  $error;
  
  private $ExceptionCode = Array (); //Array to define the Expetion codes
  private $aWarnings = Array (); //Array to store the warning that were throws by the class

  private $longMailEreg;
  private $mailEreg;
  

  /**
   * Class constructor - iniatilize default values
   * @param none
   * @return none
   */
  function __construct() {
    $this->config = array ();
    $this->fileData = array ();
    $this->spool_id = '';
    $this->status = 'pending';
    $this->error = '';
    
    $this->ExceptionCode['FATAL']   = 1;
    $this->ExceptionCode['WARNING'] = 2;
    $this->ExceptionCode['NOTICE']  = 3;

    $this->longMailEreg = '/([\"\w\W\s]*\s*)?(<([\w\-\.]+@[\.-\w]+\.\w{2,3})+>)/';
    $this->mailEreg     = '/^([\w\-_\.]+@[\.-\w]+\.\w{2,3}+)$/';
  }
  
  /**
   * get all files into spool in a list
   * @param none
   * @return none
   */
  public function getSpoolFilesList() {
    $sql = "SELECT * FROM MESSAGE WHERE MSG_STATUS ='pending'";
    
    $con = Propel::getConnection("crisisgo");
    $stmt = $con->prepareStatement($sql);
    $rs = $stmt->executeQuery();
    
    while( $rs->next() ) {
      $this->spool_id = $rs->getString('MSG_UID');
      $this->fileData['subject'] = $rs->getString('MSG_SUBJECT');
      $this->fileData['from'] = $rs->getString('MSG_FROM');
      $this->fileData['to'] = $rs->getString('MSG_TO');
      $this->fileData['body'] = $rs->getString('MSG_BODY');
      $this->fileData['date'] = $rs->getString('MSG_DATE');
      $this->fileData['cc'] = $rs->getString('MSG_CC');
      $this->fileData['bcc'] = $rs->getString('MSG_BCC');
//      $this->fileData['template'] = $rs->getString('MSG_TEMPLATE');
      $this->fileData['attachments'] = array (); //$rs->getString('APP_MSG_ATTACH');
      if( $this->config['MESS_ENGINE'] == 'OPENMAIL' ) {
        if( $this->config['MESS_SERVER'] != '' ) {
          if( ($sAux = @gethostbyaddr($this->config['MESS_SERVER'])) ) {
            $this->fileData['domain'] = $sAux;
          } else {
            $this->fileData['domain'] = $this->config['MESS_SERVER'];
          }
        } else {
          $this->fileData['domain'] = gethostbyaddr('127.0.0.1');
        }
      }
      $this->sendMail();
    }
  }
  
  /**
   * create a msg record for spool
   * @param array $aData
   * @return none
   */
  public function create($aData) {
    $sUID = $this->db_insert($aData);
    $aData['msg_date'] = isset($aData['msg_date']) ? $aData['msg_date'] : '';
    
    if( isset($aData['msg_status']) ) {
      $this->status = strtolower($aData['msg_status']);
    }
    
    $this->setData($sUID, $aData['msg_subject'], $aData['msg_from'], $aData['msg_to'], $aData['msg_body'], $aData['msg_date'], $aData['msg_cc'], $aData['msg_bcc'], $aData['msg_template'], $aData['workspace']);
  }
  
  /**
   * set configuration
   * @param array $aConfig
   * @return none
   */
  public function setConfig($aConfig) {
    $this->config = $aConfig;
  }
  
  /**
   * set email parameters
   * @param string $sMsgUid, $sSubject, $sFrom, $sTo, $sBody, $sDate, $sCC, $sBCC, $sTemplate
   * @return none
   */
  public function setData($sMsgUid, $sSubject, $sFrom, $sTo, $sBody, $sDate = '', $sCC = '', $sBCC = '', $sTemplate = '',$sWorkspace) {
    $this->spool_id = $sMsgUid;
    $this->fileData['subject'] = $sSubject;
    $this->fileData['from'] = $sFrom;
    $this->fileData['to'] = $sTo;
    $this->fileData['body'] = $sBody;
    $this->fileData['date'] = ($sDate != '' ? $sDate : date('Y-m-d H:i:s'));
    $this->fileData['cc'] = $sCC;
    $this->fileData['bcc'] = $sBCC;
    $this->fileData['template'] = $sTemplate;
    $this->fileData['attachments'] = array ();
    $this->fileData['workspace'] = $sWorkspace;
    
    if( $this->config['MESS_ENGINE'] == 'OPENMAIL' ) {
      if( $this->config['MESS_SERVER'] != '' ) {
        if( ($sAux = @gethostbyaddr($this->config['MESS_SERVER'])) ) {
          $this->fileData['domain'] = $sAux;
        } else {
          $this->fileData['domain'] = $this->config['MESS_SERVER'];
        }
      } else {
        $this->fileData['domain'] = gethostbyaddr('127.0.0.1');
      }
    }
  }
  
  /**
   * send mail
   * @param none
   * @return boolean true or exception
   */
  public function sendMail($aAttachments = array()) {
  	
    try {
      $this->handleFrom();
      $this->handleEnvelopeTo();
      $this->handleMail($aAttachments);
      $this->updateSpoolStatus();
      return true;
    } catch( Exception $e ) {
      //add by jake@2012-12-29 when send email occur error, update email status
      $this->updateMessageStatus($this->spool_id, 'error', $e->getMessage());
    }
  }
  
  /**
   * update the status to spool
   * @param none
   * @return none
   * modify by jake@2013-03-07
   */
  private function updateSpoolStatus() {
  	$con = Propel::getConnection ( 'admin' );
  	$oCriteria = new Criteria('admin');
  	$oCriteria->add(MessagePeer::MSG_UID,$this->spool_id,Criteria::EQUAL);
  	$oMessage = MessagePeer::doSelectOne($oCriteria,$con);
//    $oMessage = MessagePeer::retrieveByPK($this->spool_id);
    if($oMessage->getMsgStatus() == 'pending'){
	    array_push($this->aWarnings, '$this->spool_id:'.$this->spool_id.',status:'.$this->status);
    	$oMessage->setMsgStatus($this->status);
    	$oMessage->setMsgSendDate(date('Y-m-d H:i:s'));
    	$oMessage->save($con);
    }
  }

  /**
   * when send email occur error, update email status
   * @param $sMegUid
   * @param $sStatus
   * @author jake
   * @since 2012-12-29
   */
  private function updateMessageStatus($sMegUid, $sStatus, $sMessage=''){
  	array_push($this->aWarnings, 'fatal error ' . $sMessage . ' $this->spool_id:'.$sMegUid.',status:'.$sStatus);
    $oMessage = MessagePeer::retrieveByPK($sMegUid);
    $oMessage->setMsgStatus($sStatus);
    $oMessage->setMsgSendDate(date('Y-m-d H:i:s'));
    $oMessage->save();
  }
  
  /**
   * check email format
   * @param $sMail
   * @author jake
   * @since 2013-03-06
   */
  private function checkMail($sMail){
    if( strpos($sMail, '<') !== false ) {      
      preg_match($this->longMailEreg, $sMail, $matches);      
      if( ! isset($matches[3]) ) {
        throw new Exception('Invalid email address in parameter (' . $sMail . ')');
      }
      $this->fileData['from_email'] = trim($matches[3]);
    } else {
      preg_match($this->mailEreg, $sMail, $matches);
      if( ! isset($matches[0]) ) {
        throw new Exception('Invalid email address in parameter (' . $sMail . ')');
      }
    }
  }
  
  /**
   * handle the email that was set in "TO" parameter 
   * @param none
   * @return boolean true or exception
   */
  private function handleFrom() {
    if( strpos($this->fileData['from'], '<') !== false ) {      
      //to validate complex email address i.e. Erik A. O <erik@colosa.com>
      preg_match($this->longMailEreg, $this->fileData['from'], $matches);
      if( isset($matches[1]) && $matches[1] != '' ) {
        //drop the " characters if they exist
        $this->fileData['from_name'] = trim(str_replace('"', '', $matches[1]));
      } else { //if the from name was not set
        $this->fileData['from_name'] = 'Processmaker';
      }
      
      if( ! isset($matches[3]) ) {
        throw new Exception('Invalid email address in FROM parameter (' . $this->fileData['from'] . ')', $this->ExceptionCode['WARNING']);
      }
      
      $this->fileData['from_email'] = trim($matches[3]);
    } else {
      //to validate simple email address i.e. erik@colosa.com
      preg_match($this->mailEreg, $this->fileData['from'], $matches);
      
      if( ! isset($matches[0]) ) {
        throw new Exception('Invalid email address in FROM parameter (' . $this->fileData['from'] . ')', $this->ExceptionCode['WARNING']);
      }
      
      $this->fileData['from_name'] = 'Processmaker Web boot';
      $this->fileData['from_email'] = $matches[0];
    }
  
  }
  
  /**
   * handle all recipients to compose the mail
   * @param none
   * @return boolean true or exception
   */
  private function handleEnvelopeTo() {
    $hold = array ();
    $holdcc = array ();
    $holdbcc = array ();
    $text = trim($this->fileData['to']);
    
    $textcc ='';
    $textbcc='';    
    if( isset($this->fileData['cc']) && trim($this->fileData['cc']) != '' ) {
      $textcc = trim($this->fileData['cc']);
    }

    if( isset($this->fileData['bcc']) && trim($this->fileData['bcc']) != '' ) {
      $textbcc = trim($this->fileData['bcc']);
    }
    
    if( false !== (strpos($text, ',')) ) {
      $hold = explode(',', $text);
      
      foreach( $hold as $val ) {
        if( strlen($val) > 0 ) {
					$this->checkMail($val); //add by jake@2013-03-06
          $this->fileData['envelope_to'][] = "$val";
        }
      }
    } else if($text != '') {
			$this->checkMail($text); //add by jake@2013-03-06
      $this->fileData['envelope_to'][] = "$text";
    } else {
			throw new Exception('Invalid email address in parameter');//add by jake@2013-03-06
      $this->fileData['envelope_to'] = Array();
    }
    
    //CC
    if( false !== (strpos($textcc, ',')) ) {
      $holdcc = explode(',', $textcc);

      foreach( $holdcc as $valcc ) {
        if( strlen($valcc) > 0 ) {
					$this->checkMail($valcc); //add by jake@2013-03-06
          $this->fileData['envelope_cc'][] = "$valcc";
        }
      }
    } else if($textcc != '') {
			$this->checkMail($textcc); //add by jake@2013-03-06
      $this->fileData['envelope_cc'][] = "$textcc";
    } else {
      $this->fileData['envelope_cc'] = Array();
    }
    
    //BCC
    if( false !== (strpos($textbcc, ',')) ) {
      $holdbcc = explode(',', $textbcc);

      foreach( $holdbcc as $valbcc ) {
        if( strlen($valbcc) > 0 ) {
					$this->checkMail($valbcc); //add by jake@2013-03-06
          $this->fileData['envelope_bcc'][] = "$valbcc";
        }
      }
    } else if($textbcc != '') {
			$this->checkMail($textbcc); //add by jake@2013-03-06
      $this->fileData['envelope_bcc'][] = "$textbcc";
    } else { 
      $this->fileData['envelope_bcc'] = Array();
    }


  }
  
  /**
   * handle and compose the email content and parameters
   * @param none
   * @return none
   */
  private function handleMail($aAttachments = array()) {
    if( count($this->fileData['envelope_to']) > 0 ) {
          crisisgo::LoadThirdParty('phpmailer', 'class.phpmailer');
          $oPHPMailer = new PHPMailer(true);
          $oPHPMailer->Mailer = 'smtp';
          $oPHPMailer->SMTPAuth = (isset($this->config['SMTPAuth']) ? $this->config['SMTPAuth'] : '');
          
          
          /**
           * Posible Options for SMTPSecure are: "", "ssl" or "tls"
           */
          if (isset($this->config['SMTPSecure']) && preg_match('/^(ssl|tls)$/', $this->config['SMTPSecure'])) {
            $oPHPMailer->SMTPSecure = $this->config['SMTPSecure'];
          }
          
          $oPHPMailer->Host = $this->config['MESS_SERVER'];
          $oPHPMailer->Port = $this->config['MESS_PORT'];
          $oPHPMailer->Username = $this->config['MESS_ACCOUNT'];
          $oPHPMailer->Password = $this->config['MESS_PASSWORD'];
          $oPHPMailer->From = $this->fileData['from_email'];
          $oPHPMailer->FromName = utf8_decode($this->fileData['from_name']);
          $oPHPMailer->Subject = utf8_decode($this->fileData['subject']);
          //$oPHPMailer->Body = utf8_decode($this->fileData['body']);
		  /*********************************************************************************************************
          * Adding static suffix message to every email for alerting customers no to reply our system information
          * Only take case of PHPMail sending
          * @author Looper Lv
          * @since  2013-02-21
          *********************************************************************************************************/
          $sBody = $this->fileData['body'];
          $suffix = '<p style="font-weight: bold;">This e-mail is an automated notification, which is unable to receive replies.  If you have any questions or concerns, please contact us directly at <a href="support@edautomate.com">support@crisisgo.com</a> or <a href="#">618-997-2114</a>.</p>';
          $i = strpos($this->fileData['body'], 'support@edautomate.com');
          if(! $i) $sBody = $this->fileData['body'] . '<br /><br />' . $suffix;
          $oPHPMailer->Body = utf8_decode($sBody);

      	  // add attachment to email!
          foreach ($aAttachments as $aFile){
                $path=$aFile[0];
            //add by jake@2012-12-29 for email throw exception then update status to error
            if(!@is_file($path))
              throw new Exception('Attachment ' . $path . 'does not exist!');
            //-------------------------------------------------------------------------------------
                $filename=$aFile[1];
                $oPHPMailer->AddAttachment($path,$filename);
          }
          
          foreach( $this->fileData['envelope_to'] as $sEmail ) {
            $evalMail = strpos($sEmail, '<');
            
            if( strpos($sEmail, '<') !== false ) {
              preg_match($this->longMailEreg, $sEmail, $matches);
              $sTo = trim($matches[3]);
              $sToName = trim($matches[1]);
              $oPHPMailer->AddAddress($sTo, $sToName);
            } else {
              $oPHPMailer->AddAddress($sEmail);
            }
          }
          
          //CC
          foreach( $this->fileData['envelope_cc'] as $sEmail ) {
            $evalMail = strpos($sEmail, '<');

            if( strpos($sEmail, '<') !== false ) {
              preg_match($this->longMailEreg, $sEmail, $matches);
              $sTo = trim($matches[3]);
              $sToName = trim($matches[1]);
              $oPHPMailer->AddCC($sTo, $sToName);
            } else {
              $oPHPMailer->AddCC($sEmail);
            }
          }
          
          //BCC
          foreach( $this->fileData['envelope_bcc'] as $sEmail ) {
            $evalMail = strpos($sEmail, '<');

            if( strpos($sEmail, '<') !== false ) {
              preg_match($this->longMailEreg, $sEmail, $matches);
              $sTo = trim($matches[3]);
              $sToName = trim($matches[1]);
              $oPHPMailer->AddBCC($sTo, $sToName);
            } else {
              $oPHPMailer->AddBCC($sEmail);
            }
          }
 
          $oPHPMailer->IsHTML(true);
          if( $oPHPMailer->Send() ) {
            $this->error = '';
            $this->status = 'sent';
          } else {
            $this->error = $oPHPMailer->ErrorInfo;
            $this->status = 'failed';
          }

    }
  }
  
  /**
   * try resend the emails from spool
   * @param none
   * @return none or exception
   * @author looper@edautomate.net 2011-12-1 copy add from PM-V2.0.34
   */
  function resendEmails() {
//    require_once 'classes/model/Configuration.php';
//    $oConfiguration = new Configuration();
//    $aConfiguration = $oConfiguration->load('Emails', '', '', '', '');
//    $aConfiguration = unserialize($aConfiguration['CFG_VALUE']);
    
//    if( $aConfiguration['MESS_ENABLED'] == '1' ) {
      $this->setConfig(array (
        'MESS_ENGINE' => MESS_ENGINE, 
        'MESS_SERVER' => MESS_SERVER, 
        'MESS_PORT' => MESS_PORT, 
        'MESS_ACCOUNT' => MESS_ACCOUNT, 
        'MESS_PASSWORD' => MESS_PASSWORD,
        'SMTPAuth'      => MESS_RAUTH // BUGS fixed for cron resending eMails 2011-0919 by looper__Lv.  
      ));
      require_once 'classes/model/Message.php';
      $oCriteria = new Criteria('crisisgo');
      $oCriteria->add(MessagePeer::MSG_STATUS, 'pending', Criteria::EQUAL);
      $oCriteria->setLimit(100);//add by jake@2013-03-07
      $oDataset = MessagePeer::doSelectRS($oCriteria);
      $oDataset->setFetchmode(ResultSet::FETCHMODE_ASSOC);
      
      while( $oDataset->next() ) {
        $aRow = $oDataset->getRow();
        try {
        // add by looper@edautomate.net 2011-11-14 for Lazy eMail pool
    	// --------------------------------------------------------------------
  		$this->fileData = array();
  		// --------------------------------------------------------------------
          $this->setData($aRow['MSG_UID'], $aRow['MSG_SUBJECT'], $aRow['MSG_FROM'], $aRow['MSG_TO'], $aRow['MSG_BODY']);
          $this->sendMail(unserialize($aRow['MSG_ATTACH']));
        } catch( Exception $oException ) {
          //add by jake@2012-12-29 for email throw exception then update status to error
          $this->updateMessageStatus($aRow['MSG_UID'], 'error');
          //-------------------------------------------------------------------------------------
          if( $oException->getCode() == $this->ExceptionCode['WARNING'] ) {
            array_push($this->aWarnings, 'Spool::resendEmails(): Using ' . $aConfiguration['MESS_ENGINE'] . ' for MGS_UID=' . $aRow['MSG_UID'] . ' -> With message: ' . $oException->getMessage());
            continue;
          } else {
            throw $oException;
          }
        }
      }
//    }
  }
  

  /**
   * try resend the emails from spool
   * @param none
   * @return none or exception
   */
  function resendEmails2() {
    
//    require_once 'classes/model/Configuration.php';
//    $oConfiguration = new Configuration();
//    $aConfiguration = $oConfiguration->load('Emails', '', '', '', '');
//    $aConfiguration = unserialize($aConfiguration['CFG_VALUE']);
  
//    if( $aConfiguration['MESS_ENABLED'] == '1' ) {
      $this->setConfig(array (
        'MESS_ENGINE' => MESS_ENGINE, 
        'MESS_SERVER' => MESS_SERVER, 
        'MESS_PORT' => MESS_PORT, 
        'MESS_ACCOUNT' => MESS_ACCOUNT, 
        'MESS_PASSWORD' => MESS_PASSWORD,
	'SMTPAuth'      => MESS_RAUTH // BUGS fixed for cron resending eMails 2011-0919 by looper__Lv. 
      ));
      require_once 'classes/model/Message.php';
      $oCriteria = new Criteria('crisisgo');
      $oCriteria->add(MessagePeer::MSG_STATUS, 'sent', Criteria::NOT_EQUAL);
      $oCriteria->add(MessagePeer::MSG_TO,'',Criteria::NOT_EQUAL);
      $oDataset = MessagePeer::doSelectRS($oCriteria);
      $oDataset->setFetchmode(ResultSet::FETCHMODE_ASSOC);
      
      while( $oDataset->next() ) {
        $aRow = $oDataset->getRow();
        try{  
	  $this->setData($aRow['MSG_UID'], $aRow['MSG_SUBJECT'], $aRow['MSG_FROM'], $aRow['MSG_TO'], $aRow['MSG_BODY']);
      	  array_push($this->aWarnings, '[TEST]Spool::resendEmails(): MSG_SUBJECT:' . $aRow['MSG_SUBJECT'] . ',MSG_TO:'.$aRow['MSG_TO'].', for MGS_UID=' . $aRow['MSG_UID'] . ' -> With message: ' );
	  $this->sendMail();
        } catch( Exception $oException ) {
          if( $oException->getCode() == $this->ExceptionCode['WARNING'] ) {
            array_push($this->aWarnings, 'Spool::resendEmails(): Using ' . $aConfiguration['MESS_ENGINE'] . ' for MGS_UID=' . $aRow['MSG_UID'] . ' -> With message: ' . $oException->getMessage());
            continue;
          } else {
            throw $oException;
          }
        }
      }
//    }
  }
  
  /**
   * gets all warnings
   * @param none
   * @return string $this->aWarnings 
   */
  function getWarnings() {
    if( sizeof($this->aWarnings) != 0 ) {
      return $this->aWarnings;
    }
    return false;
  }
  
  /**
    * db_insert
    *
    * @param  array  $db_spool
    * @return string $sUID;
    */
    public function db_insert($db_spool)
    {
      $con = Propel::getConnection ( 'admin' );
      $sUID  = crisisgo::generateUniqueID();
      $spool = new Message();
      $spool->setMsgUid($sUID);
      $spool->setMsgType($db_spool['msg_type']);
      $spool->setMsgSubject($db_spool['msg_subject']);
      $spool->setMsgFrom($db_spool['msg_from']);
      $spool->setMsgTo($db_spool['msg_to']);
      $spool->setMsgBody($db_spool['msg_body']);
      $spool->setMsgDate(date('Y-m-d H:i:s'));
      $spool->setMsgCc($db_spool['msg_cc']);
      $spool->setMsgBcc($db_spool['msg_bcc']);
      $spool->setMsgAttach($db_spool['msg_attach']);
//      $spool->setAppMsgTemplate($db_spool['app_msg_template']);
      $spool->setMsgStatus($db_spool['msg_status']);
      $spool->setMsgSendDate(date('Y-m-d H:i:s')); // Add by Ankit
      $spool->setWorkspace($db_spool['workspace']);

      if(!$spool->validate()) {
        $errors       = $spool->getValidationFailures();
        $this->status = 'error';

        foreach($errors as $key => $value) {
          echo "Validation error - " . $value->getMessage($key) . "\n";
        }
      }
      else {
              //echo "Saving - validation ok\n";
        $this->status = 'success';
              $spool->save($con);
      }
      return $sUID;

    }
}
?>