<?php

class Services_Rest_File
{
    function __construct() {
        // Token::validateApiToken();
    }

   /**
     * 上传文件接口
     * <code>
     * $r->setSupportedFormats('JsonFormat', 'UploadFormat');
     * </code>
     * @url POST /upload
     * @return object
     */
   public static  function post(){
        try{
            global $GLOBAL_SETTING;
            if(isset($_REQUEST['path'])){
                $uploadDir = PATH_SHARED.'upload/' . $_REQUEST['path'] . "/";
                if(!file_exists($uploadDir)){
                    mkdir($uploadDir,0777);
                }
            }else{
                $uploadDir = PATH_SHARED.'upload/'.date('Ymd').'/';
            }
            gulliver::verifyPath($uploadDir, true);

            if(! $_FILES) {
                return array('success' => false, 'message'=> '请上传文件!', 'data'=> new stdClass(),'code'=>'500');
            }

            $file_path = array();
            $file_full_path = array();

            foreach ($_FILES as $f) { 
                if ($f['error'] == '0') { 
                    $tmp_name = $f["tmp_name"]; 
                    $fileName = $f["name"];
                    $fileExt = explode('.', $fileName);
                    $fileE = $fileExt[count($fileExt)-1];
                    if(isset($_REQUEST['path'])){
                        $file = $uploadDir. $fileName;
                        if(file_exists($file)){
                            @unlink($file);
                        }
                        array_push($file_path, $file);
                        array_push($file_full_path, $GLOBAL_SETTING['FILE_PATH'].$file);
                        if(move_uploaded_file($tmp_name, $file)){
                            //删除目录下的其他文件
                            if(@$handle = opendir($uploadDir)) { //注意这里要加一个@，不然会有warning错误提示：）
                                while(($file = readdir($handle)) !== false) {
                                    if($file != ".." && $file != ".") { //排除根目录；
                                        if($file != $fileName){
                                            @unlink($uploadDir. $file);
                                        }
                                    }
                                }
                                closedir($handle);
                            }
                        }
                    }else{    
                        $fileE = $fileE==''? 'jpg':$fileE; 
                        $fileUID =  gulliver::generateUniqueID();
                        $newName = $fileUID.'.'.$fileE;
                        $file = $uploadDir. $newName;
                        // var_dump($file);
                        $_a = explode("shared", $file);
                        // var_dump($_a);
                        array_push($file_path, $file);
                        array_push($file_full_path, $GLOBAL_SETTING['FILE_PATH'].'/shared'.$_a[1]);
                        move_uploaded_file($tmp_name, $uploadDir. $newName);
                    }
                } 
            } 
            
            $path=implode(',', $file_path);
            $full_path=implode(',', $file_full_path);

            return array('success' => true, 'message'=>'上传文件成功', 'data'=> array('file'=>$path,'fullPath'=>$full_path),'code'=>'200');
        }catch(RestException $e){
            return array('success' => false, 'message'=> '服务器异常，请稍后重试', 'data'=> new stdClass(),'500');
        }
    }

}