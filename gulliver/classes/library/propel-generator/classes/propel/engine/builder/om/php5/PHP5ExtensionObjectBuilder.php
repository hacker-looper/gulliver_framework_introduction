<?php

/*
 *  $Id: PHP5ExtensionObjectBuilder.php 536 2007-01-10 14:30:38Z heltem $
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the LGPL. For more information please see
 * <http://propel.phpdb.org>.
 */

require_once 'propel/engine/builder/om/ObjectBuilder.php';

/**
 * Generates the empty PHP5 stub object class for user object model (OM).
 *
 * This class produces the empty stub class that can be customized with application
 * business logic, custom behavior, etc.
 *
 * This class replaces the ExtensionObject.tpl, with the intent of being easier for users
 * to customize (through extending & overriding).
 *
 * @author     Hans Lellelid <hans@xmpl.org>
 * @package    propel.engine.builder.om.php5
 */
class PHP5ExtensionObjectBuilder extends ObjectBuilder {

	/**
	 * Returns the name of the current class being built.
	 * @return     string
	 */
	public function getClassname()
	{
		return $this->getTable()->getPhpName();
	}

	/**
	 * Adds the include() statements for files that this class depends on or utilizes.
	 * @param      string &$script The script will be modified in this method.
	 */
	protected function addIncludes(&$script)
	{
		$script .= "
require_once '".$this->getObjectBuilder()->getClassFilePath()."';
require_once 'classes/model/".$this->getClassname()."Peer.php';
";
	} // addIncludes()

	/**
	 * Adds class phpdoc comment and openning of class.
	 * @param      string &$script The script will be modified in this method.
	 */
	protected function addClassOpen(&$script)
	{
		$table = $this->getTable();
		$tableName = $table->getName();
		$tableDesc = $table->getDescription();

		$baseClassname = $this->getObjectBuilder()->getClassname();

		$script .= "
/**
 * [AutoCode]
 * 数据库MODEL自动生成操作方法；请在此文件基础上修改以实现业务需求；
 * Skeleton subclass for representing a row from the '$tableName' table.
 *
 * $tableDesc
 *";
		if ($this->getBuildProperty('addTimeStamp')) {
			$now = strftime('%c');
			$script .= "
 * This class was autogenerated by Propel on:
 *
 * $now
 *";
		}
		$script .= "
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    ".$this->getPackage()."
 * @author     Gulliver2
 * @since      ".date('y-m-d H:i:s')."
 */
class ".$this->getClassname()." extends $baseClassname {
";
	}

	/**
	 * Specifies the methods that are added as part of the stub object class.
	 *
	 * By default there are no methods for the empty stub classes; override this method
	 * if you want to change that behavior.
	 *
	 * @see        ObjectBuilder::addClassBody()
	 */
	protected function addClassBody(&$script)
	{
		$CLASS_NAME = $this->getClassname();
		$sTable     = $this->getTable()->getName();
		$aPK        = $this->getTable()->getPrimaryKey();
		$aColumns   = $this->getTable()->getColumns();

		$_PK = array(); foreach ($aPK as $k => $p) {
			$_PK[] = $p->getName();
		}

		$_Col = array(); foreach ($aColumns as $k => $c) {
			$_Col[] = $c->getName();
		}

		$script .= "
	/**
	 * [AutoCode]
	 *
	 * PK: 当前表的表名
	 * @author Gulliver2
	 * @since  ".date('y-m-d H:i:s')."
	 **/
	public static \$TABLE = '".$sTable."';

	/**
	 * [AutoCode]
	 *
	 * PK: 当前表的主键(String格式，多个以逗号分隔)
	 * 注：注意主键可能为：无主键、单主键、多主键等情况
	 * @author Gulliver2
	 * @since  ".date('y-m-d H:i:s')."
	 **/
	public static \$PK = '".implode(",", $_PK)."';

	/**
	 * [AutoCode]
	 *
	 * PK: 当前表的表字段(String格式，多个以逗号分隔)
	 * 注：注意主键可能为：无主键、单主键、多主键等情况
	 * @author Gulliver2
	 * @since  ".date('y-m-d H:i:s')."
	 **/
	public static \$COLUMN = '".implode(",", $_Col)."';

	/**
	 * [AutoCode]
	 *
	 * 查询列表(支持分页+检索)
	 * @since  ".date('y-m-d H:i:s')."
	 * @Author   Gulliver2
	 * @return   Array
	 */
	public static function getList(\$aData){
		try{
			\$obj = new Criteria(".$CLASS_NAME."Peer::DATABASE_NAME);

			\$total = ".$CLASS_NAME."Peer::doCount(\$obj);
			if(isset(\$aData['OFFSET'])){
				\$obj->setOffset(\$aData['OFFSET']);
				\$obj->setLimit(\$aData['PAGESIZE']);
			}

			\$obj->addDescendingOrderByColumn(".$CLASS_NAME."Peer::CREATE_DATE);
			
			\$aaData = ".$CLASS_NAME."Peer::doSelectRS(\$obj);
			\$aaData -> setFetchmode(ResultSet::FETCHMODE_ASSOC);
			\$aaData -> next();

			\$aResult =array();
			while (is_array(\$row = \$aaData->getRow())) {
			   \$aResult [] = \$row;
			   \$aaData -> next();
			}

			\$aResult = array('success'=>true,
						 'data'=>\$aResult,
						 'total'=>\$total
					);

	        return \$aResult;
		}catch(Exception \$e){
			throw \$e;
		}
	}

	/**
	 * [AutoCode]
	 *
	 * 根据主键(PK)查询详情
	 * @param \$PK 主键 PK主键参数: Array/String
	 * @return Array
	 * @author Gulliver2
	 * @since  ".date('y-m-d H:i:s')."
	 **/
	public static function get(\$PK) {
		\$oData = self::getObjByPk(\$PK);
		if(!\$oData) return array();
		return \$oData->toArray(BasePeer::TYPE_FIELDNAME);
	}

	/**
	 * [AutoCode]
	 *
	 * 根据主键(PK)删除对象
	 * @param \$PK 主键 PK主键参数 Array/String
	 * @return Boolean
	 * @author Gulliver2
	 * @since  ".date('y-m-d H:i:s')."
	 **/
	public static function del(\$PK){
		\$oData = self::getObjByPk(\$PK);
		if(\$oData) {\$oData->delete();return true;}
		else return false;
	}

	/**
	 * [AutoCode]
	 *
	 * 创建/编辑基本信息
	 * @param array 表字段为KEY的数组， 数组key不存在则不更新表字段
	 * @return Boolean
	 * @author Gulliver2
	 * @since  ".date('y-m-d H:i:s')."
	 **/
	public static function addedit(\$aData=array()){
		try{
			\$aPKColumns = explode(',', self::\$PK);
			\$_b = 1; foreach(\$aPKColumns as \$_p){
				\$_bb = isset(\$aData[\$_p])?1:0;
				\$_b = \$_b && \$_bb;
			}

			if(\$_b){ // 主键存在，执行编辑操作
				\$bNew = false;
				\$oRec = self::getObjByPk(\$aData[self::\$PK]);
				if(! \$oRec) \$bNew = true;
			}else{   // 主键不存在，执行新建操作
				\$bNew = true;
			}

			if(\$bNew){
				require_once 'classes/model/".$CLASS_NAME.".php';
				\$oRec = new ".$CLASS_NAME."();

				// 设置主键；
				\$uid = gulliver::generateUniqueID();
				\$oRec->setByName(self::\$PK, \$uid, BasePeer::TYPE_FIELDNAME);
				\$oRec->setCreateDate(date('Y-m-d H:i:s'));
			}else{
				\$oRec = self::getObjByPk(\$aData[self::\$PK]);
			}

			\$oRec->fromArray(\$aData, BasePeer::TYPE_FIELDNAME);
	        \$oRec->save();

			\$sMsg = \$bNew ? '创建数据成功!':'更新数据成功!';
	        return array('success'=>true,'message'=>\$sMsg,'data'=>array());
		}catch(Exception \$e){
			return array('success'=>false,'message'=>\$e->getMessage(),'data'=>array());
		}
	}

	/**
	 * [AutoCode]
	 *
	 * 根据P获取数据库表对象
	 * @param PK 主键
	 * @return Object
	 * @author Gulliver2
	 * @since  ".date('y-m-d H:i:s')."
	 **/
	protected static function getObjByPk(\$PK){
		if(! \$PK) return null;
		\$obj = ".$CLASS_NAME."Peer::retrieveByPK(\$PK);
		return \$obj;
	}
";
	}

	/**
	 * Closes class.
	 * @param      string &$script The script will be modified in this method.
	 */
	protected function addClassClose(&$script)
	{
		$script .= "
} // " . $this->getClassname() . "
";
	}

} // PHP5ExtensionObjectBuilder
