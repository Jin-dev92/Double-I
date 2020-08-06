<?php	// 티켓목록
include "path.php";
ini_set('memory_limit', -1);

if($mode=="update"){

    include_once "$nfor[path]/PHPExcel.php";
    include_once "$nfor[path]/PHPExcel/IOFactory.php";

    $filename = $_FILES['delivery_upload']['tmp_name']; // 업로드 된 파일

    try{
        $objReader = PHPExcel_IOFactory::createReaderForFile($filename);
        $objReader->setReadDataOnly(true);
        $objExcel = $objReader->load($filename);
        $objExcel->setActiveSheetIndex(0);
        $objWorksheet = $objExcel->getActiveSheet();
        $rowIterator = $objWorksheet->getRowIterator();

		$i = 0;
        foreach($rowIterator as $row){
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); 
			$str = "";
			$k = 0;
            foreach($cellIterator as $cell){
				$str[$k] = $cell->getValue(); 
				$k++;
			}

			if($i and $str[0] and $str[23]){

				$chk_delivery = sql_fetch("select ct_id from nfor_cart where ct_id='$str[0]'");
				if($chk_delivery[ct_id]){					
					$payment_date = date("Y-m-d");
					sql_query("update nfor_cart set payment_ok='2', payment_date='$payment_date', payment_chk='$str[23]' where ct_id='$str[0]'"); // payment_date='$str[22]',
				}
			
			}
			$i++;
		}

    } catch(exception $e){
        alert("엑셀파일을 읽는도중 오류가 발생하였습니다.");
    }

	alert("정상적으로 등록되었습니다.","ticket_payment_upload.php");

}

include "head.php";
?>		
	<form method="post" action="ticket_payment_upload.php" enctype="multipart/form-data">
	<input type="hidden" name="mode" value="update">
	<input type="file" name="delivery_upload" class="input_txt">
	<input TYPE="image" src="img/ex_up.gif" align="absmiddle">
	</form>
<?
include "tail.php";
?>