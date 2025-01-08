<?php

class handleExcel {

	/**
	 * 上传
	 * @return [type]                   [description]
	 */
	public static function analyzeExcel($file_path){
		try {	
				require_once PATH_SYSTEM.'library/phpexcel/PHPExcel.php';
				require_once PATH_SYSTEM.'library/phpexcel/PHPExcel/Reader/Excel5.php';

				$filename = basename($file_path);
				$fileExt = explode('.', $filename);
				$fileE = $fileExt[count($fileExt)-1];

				if($fileE=='xls'||$fileE=='xlsx'){
					$PHPExcel = new PHPExcel();
					$PHPReader = new PHPExcel_Reader_Excel2007();
					if(!$PHPReader->canRead($fileTempName)){
						$PHPReader = new PHPExcel_Reader_Excel5();
						if(!$PHPReader->canRead($fileTempName)){
							$res['success'] = false;
							$res['message'] = "IMPORT_FILE_NOT_READ";
							return $res;
						}
					}

					$PHPExcel = $PHPReader->load($fileTempName);
					$sheets = $PHPReader->listWorksheetNames($fileTempName);
						
					foreach ($sheets as $key => $sheetName) {	
						$currentSheet = $PHPExcel->setActiveSheetIndex($key);
						$allColumn = $currentSheet->getHighestColumn();
						$allRow = $currentSheet->getHighestRow();

						$a=array();
						$columnCount= 'A';
						for($i= 2; $i<= $allRow; $i++){
							$title = $currentSheet->getCellByColumnAndRow(ord($columnCount) - 65,$i)->getValue();
										
							if(!$title){
								continue;
							}
							$a[]=$i;
						}

						$a[]=$allRow;

						// 遍歷excel行数据
						foreach ($a as $k => $v) {
							$start = $v;
							$end = $a[$k+1]-1;
							$index = $k;
									
							$aData = array();
							for($_i=$start; $_i<=$end; $_i++){
								$title = $currentSheet->getCellByColumnAndRow(ord('A') - 65,$start)->getValue();
								$type  = $sQITYPE;
								$_index = $_i-$start;
								$aData[$_index]['ANSWER'] = $currentSheet->getCellByColumnAndRow(ord('B') - 65,$_i)->getValue();
								$aData[$_index]['ISRIGHT'] = $currentSheet->getCellByColumnAndRow(ord('C') - 65,$_i)->getValue();
										}
										
									}
							}

						var_dump($aData);die;
						$res['success'] = true;
						$res['message'] = "IMPORT_SUCCESSFUL";
					}

					{
						$res['success'] = false;
						$res['message'] = "IMPORT_SUPPORT_TYPE";
					}
			} catch (Exception $e) {
				return array('success'=>false, 'message' => $e->getMessage());
			}

			return $aData;
	}
}