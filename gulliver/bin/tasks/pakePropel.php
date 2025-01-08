<?php

pake_desc('create classes for current model');
pake_task('propel-build-model', 'project_exists');


/** Generate Propel Class File Based Upon schema.xml **/
function run_propel_build_model($task, $args)
{
  _run_propel_build_schema($task, $args);
  _call_phing($task, 'om', $sModule);
}

/** Generate Propel Class File Based Upon mysql db **/
function _run_propel_build_schema($task, $args)
{
  global $GLOBAL_SETTING;

  $propelIniFile = 'propel.ini';
  $propelIniFilePath = PATH_HOME . 'config' . PATH_SEP . $propelIniFile;

  pake_echo_action('propel.ini', "using the file : $propelIniFilePath ");
  _call_phing($task, 'creole', false, $propelIniFile);

  // fix database name
  if (file_exists(PATH_HOME . 'config' . PATH_SEP .'schema.xml'))
  {
    $schema = file_get_contents(PATH_HOME . 'config' . PATH_SEP .'schema.xml');
    $schema = preg_replace('/<database\s+name="[^"]+"/s', '<database name="app"', $schema);
    // $schema = preg_replace('/<database\s+name="[^"]+"/s', '<database name="'.$sModule.'"', $schema);

    // propel-gen unsupport default-value of timestamp
    /****************************************************************************************************
    <column name="MODIFIED_AT" type="TIMESTAMP" required="true" default="CURRENT_TIMESTAMP">
      <vendor type="mysql">
        <parameter name="Field" value="MODIFIED_AT"/>
        <parameter name="Type" value="timestamp"/>
        <parameter name="Null" value="NO"/>
        <parameter name="Key" value=""/>
        <parameter name="Default" value="CURRENT_TIMESTAMP"/>
        <parameter name="Extra" value="on update CURRENT_TIMESTAMP"/>
      </vendor>
    </column>

    <column name="LAST_MODIFIED" type="TIMESTAMP">
      <vendor type="mysql">
        <parameter name="Field" value="LAST_MODIFIED"/>
        <parameter name="Type" value="datetime"/>
        <parameter name="Null" value="YES"/>
        <parameter name="Key" value=""/>
        <parameter name="Default" value=""/>
        <parameter name="Extra" value=""/>
      </vendor>
    </column>
    ****************************************************************************************************/

    $schema = str_replace('type="TIMESTAMP" required="true" default="CURRENT_TIMESTAMP"', ' type="TIMESTAMP"', $schema);
    $schema = str_replace('<parameter name="Default" value="CURRENT_TIMESTAMP"/>', '<parameter name="Default" value=""/>', $schema);
    $schema = str_replace('default="CURRENT_TIMESTAMP"', 'default=""', $schema);
    $schema = str_replace('<parameter name="Extra" value="on update CURRENT_TIMESTAMP"/>', '<parameter name="Extra" value=""/>', $schema);

    file_put_contents(PATH_HOME . 'config' . PATH_SEP .'schema.xml', $schema);
  }
}

/**
 * 调用phing工具方法
 *
 * @author Looper
 * @since  2014-02-16T20:00:28+0800
 * @param  [type]                   $task            [description]
 * @param  [type]                   $task_name       [description] 
 * @param  boolean                  $check_schema    [description]
 * @param  string                   $propelIni       [description]
 * @param  string                   $propelDirectory [如果为空则为系统，否则为plugin机制]
 * @return [type]                                    [description]
 */
function _call_phing($task, $task_name, $check_schema = true, $propelIni = 'propel.ini' , $propelDirectory = '' )
{
  $sParentPath = PATH_HOME;
  $schemas = pakeFinder::type('file')->name('*schema.xml')->follow_link()->in($sParentPath . 'config');
  if ($check_schema && !$schemas)
  {
    throw new Exception('You must create a schema.yml or schema.xml file at:'. $sParentPath . 'config/*schema.xml');
  }

  // call phing targets
  pake_import('Phing', false);
  global $GLOBAL_SETTING;

  if ( $propelDirectory == '' ){
    $options = array(
      'project.dir'       => $sParentPath . 'config',
      'build.properties'  => $propelIni,
      'propel.output.dir' => $sParentPath,
      'propel.database'   => $GLOBAL_SETTING['DB_TYPE'],
      'propel.database.createUrl'  => "mysql://".$GLOBAL_SETTING['DB_USERNAME'].":".$GLOBAL_SETTING['DB_PASSWD']."@".$GLOBAL_SETTING['DB_HOST'].":".$GLOBAL_SETTING['DB_PORT']."/",
      'propel.database.url'        => "mysql://".$GLOBAL_SETTING['DB_USERNAME'].":".$GLOBAL_SETTING['DB_PASSWD']."@".$GLOBAL_SETTING['DB_HOST'].":".$GLOBAL_SETTING['DB_PORT']."/".$GLOBAL_SETTING['DB_DATABASE']

    );
  } else {
    $options = array(
      'project.dir'       => $propelDirectory . 'config',
      'build.properties'  => $propelIni,
      'propel.output.dir' => $propelDirectory ,
      'propel.database'   => $GLOBAL_SETTING['DB_TYPE'],
      'propel.database.createUrl'  => "mysql://".$GLOBAL_SETTING['DB_USERNAME'].":".$GLOBAL_SETTING['DB_PASSWD']."@".$GLOBAL_SETTING['DB_HOST'].":".$GLOBAL_SETTING['DB_PORT']."/",
      'propel.database.url'        => "mysql://".$GLOBAL_SETTING['DB_USERNAME'].":".$GLOBAL_SETTING['DB_PASSWD']."@".$GLOBAL_SETTING['DB_HOST'].":".$GLOBAL_SETTING['DB_PORT']."/".$GLOBAL_SETTING['DB_DATABASE']
    );
  }
    

  pakePhingTask::call_phing($task, array($task_name), PATH_LIBRARY . 'propel-generator/build.xml', $options);
  // @chdir( PATH_APP . 'system' . PATH_SEP );
}