<?php
/**
 * SMS module
 **/
class SMS {
	function __construct() {
        // require_once './CCPRestSmsSDK.php';
  }
   // public static function Sendsms($SM_COREDATA,$phonenum) {
   //  $SMS_ACCOUNT='WWEIPHONE';
   //  $SMS_PASSWORD = 'pass1234';
   //  $SN_MESSAGE="您的验证码是：".$SM_COREDATA."。请不要把验证码泄露给其他人。如非本人操作，可不用理会！"; 
   //  header("Content-Type:text/html;charset=utf-8");
   //  $SN_MESSAGE=mb_convert_encoding($SN_MESSAGE, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5' );  
   //  $url="http://sms.106jiekou.com/utf8/sms.aspx?account=".$SMS_ACCOUNT."&password=".$SMS_PASSWORD."&mobile=".$phonenum."&content=".$SN_MESSAGE;
   //  $res=file_get_contents($url);
   // }
   public static function Sendsms($to,$datas,$tempId) {
    // 初始化REST SDK
     global $GLOBAL_SETTING;
     require_once 'CCPRestSmsSDK.php';
     $rest = new REST($GLOBAL_SETTING['SMS_SERVER_IP'],$GLOBAL_SETTING['SMS_SERVER_PORT'],$GLOBAL_SETTING['SMS_VERSION']);
     $rest->setAccount($GLOBAL_SETTING['SMS_ACCOUNT_SID'],$GLOBAL_SETTING['SMS_ACCOUNT_TOKEN']);
     $rest->setAppId($GLOBAL_SETTING['SMS_APPID']);
     // 发送模板短信
     $result = $rest->sendTemplateSMS($to,$datas,$tempId);
     if($result == NULL ) {
         echo "result error!";
         break;
     }
     if($result->statusCode!=0) {
         //TODO 添加错误处理逻辑
     }else{
         echo "Sendind TemplateSMS success!<br/>";
         // 获取返回信息
         $smsmessage = $result->TemplateSMS;
         //TODO 添加成功处理逻辑
     }
   }
}