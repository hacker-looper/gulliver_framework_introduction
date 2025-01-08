<?php

function array_to_object($e){
    if( gettype($e)!='array' ) return;
    foreach($e as $k=>$v){
        if( gettype($v)=='array' || getType($v)=='object' )
            $e[$k]=(object)array_to_object($v);
    }
    return (object)$e;
}
 
function object_to_array($e){
    $e=(array)$e;
    foreach($e as $k=>$v){
        if( gettype($v)=='resource' ) return;
        if( gettype($v)=='object' || gettype($v)=='array' )
            $e[$k]=(array)object_to_array($v);
    }
    return $e;
}

/** 
 * 加载国际化文件, Translation文件放在 /app|admin/translation/en.ini
 * @since  2016-04-28
 **/
function load_translation($language='en'){
	$sTranslationFile = PATH_APP . 'translations'.PATH_SEP.$language.'.ini';
	
	if(! file_exists($sTranslationFile)){
		$sTranslationFile = PATH_APP . '/translations/en.ini';
	}
	
	global $G_TRANSLATION; $G_TRANSLATION = parse_ini_file($sTranslationFile, false);
}

/** 
 * 国际化客户端方法, Translation文件放在 /app|admin/translation/en.ini
 * @since  2014-04-22
 **/
function T($sLabel){
	$sLabel = trim($sLabel);
	global $G_TRANSLATION;
	return $G_TRANSLATION[$sLabel] ? $G_TRANSLATION[$sLabel] : '**'. $sLabel .'**'; 
}