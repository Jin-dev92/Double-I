<?php
include_once "path.php";

$qstr .= "&category_id=$category_id&supply_no=$supply_no&it_view=$it_view&it_state=$it_state";

if($mode=="list_update"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];

		item_access($_POST['it_id'][$k]);

		sql_query("update nfor_item set it_hit='{$_POST['it_hit'][$k]}',
										it_best='{$_POST['it_best'][$k]}',
										it_new='{$_POST['it_new'][$k]}',
										it_hot='{$_POST['it_hot'][$k]}',
										it_good='{$_POST['it_good'][$k]}',
										it_set='{$_POST['it_set'][$k]}',
										it_rank='{$_POST['it_rank'][$k]}',
										it_view='{$_POST['it_view'][$k]}'
										where it_id='{$_POST['it_id'][$k]}'");
	}

	alert("정상적으로 수정되었습니다","$PHP_SELF?$qstr");
	exit;
}

if(basename($PHP_SELF)=="delivery_item_list.php"){
	$it_delivery = 1;
} elseif(basename($PHP_SELF)=="ticket_item_list.php"){
	$it_delivery = 0;
} else{

}

if($mode=="update"){
	$add_sql = "";

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

			if($i){
				
				if($str[0]){

					$chk_it_id = sql_fetch("select * from nfor_item where it_id='$str[0]'");
					if($chk_it_id[it_id]){
						sql_query("update nfor_item set 
													it_delivery='$str[1]',
													category_id='$str[2]',
													area_id='$str[3]',
													supply_no='$str[4]',
													md_no='$str[5]',
													it_price_type='$str[6]',
													it_price1='$str[7]',
													it_price2='$str[8]',
													it_name='$str[9]',
													it_description='$str[10]',
													it_discount_want='$str[11]',
													it_discount_rate='$str[12]',
													it_buy_qty='$str[13]',
													it_stock='$str[14]',
													it_paydate='$str[15]',
													it_payenddate='$str[16]',
													it_money_type='$str[17]',
													it_money_per='$str[18]',
													it_money='$str[19]',
													it_other_use='$str[20]',
													it_other='$str[21]',
													it_ticket_type='$str[22]',
													it_now_supply_sms='$str[23]',
													it_now_mb_sms='$str[24]',
													it_address='$str[25]',
													it_x_point='$str[26]',
													it_y_point='$str[27]',
													it_startdate='$str[28]',
													it_enddate='$str[29]',
													ticket_when='$str[30]',
													it_delivery_type='$str[31]',
													it_delivery_price='$str[32]',
													it_delivery_total='$str[33]',
													it_payment='$str[34]',
													it_rule='$str[35]',
													it_memo='$str[36]',
													it_premium_use='$str[37]',
													it_img_p='$str[38]',
													it_img_m1='$str[39]',
													it_img_m2='$str[40]',
													it_img_m3='$str[41]',
													it_img_m4='$str[42]',
													it_img_m5='$str[43]',
													it_img_l='$str[44]',
													it_img_name='$str[45]'
													where it_id='$str[0]' ");

						sql_query("update nfor_item_option set price='$str[8]', stock='$str[14]' where it_id='$str[0]' and option_type='1'");
					} else{
						sql_query("insert nfor_item set 
													it_id='$str[0]',
													it_delivery='$str[1]',
													category_id='$str[2]',
													area_id='$str[3]',
													supply_no='$str[4]',
													md_no='$str[5]',
													it_price_type='$str[6]',
													it_price1='$str[7]',
													it_price2='$str[8]',
													it_name='$str[9]',
													it_description='$str[10]',
													it_discount_want='$str[11]',
													it_discount_rate='$str[12]',
													it_buy_qty='$str[13]',
													it_stock='$str[14]',
													it_paydate='$str[15]',
													it_payenddate='$str[16]',
													it_money_type='$str[17]',
													it_money_per='$str[18]',
													it_money='$str[19]',
													it_other_use='$str[20]',
													it_other='$str[21]',
													it_ticket_type='$str[22]',
													it_now_supply_sms='$str[23]',
													it_now_mb_sms='$str[24]',
													it_address='$str[25]',
													it_x_point='$str[26]',
													it_y_point='$str[27]',
													it_startdate='$str[28]',
													it_enddate='$str[29]',
													ticket_when='$str[30]',
													it_delivery_type='$str[31]',
													it_delivery_price='$str[32]',
													it_delivery_total='$str[33]',
													it_payment='$str[34]',
													it_rule='$str[35]',
													it_memo='$str[36]',
													it_premium_use='$str[37]',
													it_img_p='$str[38]',
													it_img_m1='$str[39]',
													it_img_m2='$str[40]',
													it_img_m3='$str[41]',
													it_img_m4='$str[42]',
													it_img_m5='$str[43]',
													it_img_l='$str[44]',
													it_img_name='$str[45]' ");

						sql_query("insert nfor_item_option set it_id='$str[0]', option_name1='$str[9]', price='$str[8]', stock='$str[14]', option_type='1'");

					}
				}
			}
			$i++;
		}

    } catch(exception $e){
        alert("엑셀파일을 읽는도중 오류가 발생하였습니다.");
    }

	alert("정상적으로 수정되었습니다.","$PHP_SELF?$qstr");

}

if($mode=="list_delete"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		item_delete($_POST['it_id'][$k]);
	}
	alert("정상적으로 삭제되었습니다.","$PHP_SELF?$qstr");
	exit;
}

if($mode=="delete"){
	item_delete($it_id);
	alert("정상적으로 삭제되었습니다.","$PHP_SELF?$qstr");
	exit;
}

$sql_common = " from nfor_item ";
$sql_search = " where 1 ";


if($member[is_supply]=="1") $sql_search .= " and supply_no='$member[mb_no]' ";
if($member[is_supply]=="2") $sql_search .= " and md_no='$member[mb_no]' ";



if(basename($PHP_SELF)=="zzim_list.php"){
	$sql_search .= " and it_zzim > 0";
	$sst = "it_zzim";
    $sod = "desc";
} elseif(basename($PHP_SELF)=="alarm_list.php"){
	$sql_search .= " and it_alarm > 0";
	$sst = "it_alarm";
    $sod = "desc";
} elseif(basename($PHP_SELF)=="print_item_list.php"){

} else{
	$sql_search .= " and it_delivery='$it_delivery'";
}


if($it_state){
	if($it_state=="1"){
		$sql_search .= " and it_paydate <='$nfor[ymdhis]' and it_payenddate >='$nfor[ymdhis]'"; // 판매중
	} elseif($it_state=="2"){
		$sql_search .= " and it_paydate > '$nfor[ymdhis]'"; // 판매예정
	} elseif($it_state=="3"){
		$sql_search .= " and it_payenddate < '$nfor[ymdhis]'"; // 판매종료
	} else{

	}
}

if($it_view){
	if($it_view=="1"){
		$sql_search .= " and it_view='0'";
	} elseif($it_view=="2"){
		$sql_search .= " and it_view='1'";
	} else{

	}
}

if($category_id){
	$sql_search .= category_sql($category_id);
}

if($supply_no) $sql_search .= " and supply_no='$supply_no'";
if($stx) $sql_search .= " and $sfl like '%$stx%' ";

if(!$sst){
    $sst = "it_datetime";
    $sod = "desc";
}
$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = $config[cf_page_rows];
$total_page  = ceil($total_count / $rows);
if (!$page) $page = 1;
$from_record = ($page - 1) * $rows;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order";



if($mode=="excel"){

	require_once "$nfor[path]/PHPExcel.php";
	$objPHPExcel = new PHPExcel();

	$result = sql_query($sql);
	$cnt = @sql_num_rows($result);
	if(!$cnt) alert("출력할 내역이 없습니다.");

	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue("A1", "상품코드")
				->setCellValue("B1", "상품형태")
				->setCellValue("C1", "상품분류코드")
				->setCellValue("D1", "지역분류코드")
				->setCellValue("E1", "공급업체")
				->setCellValue("F1", "담당MD")
				->setCellValue("G1", "기준가격설정")	
				->setCellValue("H1", "정상가격")
				->setCellValue("I1", "판매가격")
				->setCellValue("J1", "상품명")
				->setCellValue("K1", "상품간단설명")
				->setCellValue("L1", "할인조건")
				->setCellValue("M1", "할인율")
				->setCellValue("N1", "개인구매제한")
				->setCellValue("O1", "전체판매수량")
				->setCellValue("P1", "판매시작일시")
				->setCellValue("Q1", "판매종료일시")
				->setCellValue("R1", "적립금형태")
				->setCellValue("S1", "적립금1(퍼센트)")
				->setCellValue("T1", "적립금2(원)")
				->setCellValue("U1", "관련상품임의지정사용여부")
				->setCellValue("V1", "관련상품")
				->setCellValue("W1", "티켓발급형태")
				->setCellValue("X1", "공급업체문자발송")
				->setCellValue("Y1", "사용자문자발송")
				->setCellValue("Z1", "상품지도주소")
				->setCellValue("AA1", "상품지도X")
				->setCellValue("AB1", "상품지도Y")
				->setCellValue("AC1", "티켓사용시작일시")
				->setCellValue("AD1", "티켓사용종료일시")
				->setCellValue("AE1", "티켓다운시점")
				->setCellValue("AF1", "배송형태")
				->setCellValue("AG1", "배송금액")
				->setCellValue("AH1", "배송비조건")				
				->setCellValue("AI1", "가격상세설명")
				->setCellValue("AJ1", "사용조건")
				->setCellValue("AK1", "상품상세설명")
				->setCellValue("AL1", "프리미엄상품사용여부")
				->setCellValue("AM1", "프리미엄상품이미지")
				->setCellValue("AN1", "상품메인이미지")
				->setCellValue("AO1", "상품메인기타이미지1")
				->setCellValue("AP1", "상품메인기타이미지2")
				->setCellValue("AQ1", "상품메인기타이미지3")
				->setCellValue("AR1", "상품메인기타이미지4")
				->setCellValue("AS1", "상품리스트이미지")
				->setCellValue("AT1", "상품타이틀이미지");

	for($i=2; $row=sql_fetch_array($result); $i++){    

		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue("A$i", "$row[it_id]")
					->setCellValue("B$i", "$row[it_delivery]")
					->setCellValue("C$i", "$row[category_id]")
					->setCellValue("D$i", "$row[area_id]")
					->setCellValue("E$i", "$row[supply_no]")
					->setCellValue("F$i", "$row[md_no]")
					->setCellValue("G$i", "$row[it_price_type]")
					->setCellValue("H$i", "$row[it_price1]")
					->setCellValue("I$i", "$row[it_price2]")
					->setCellValue("J$i", "$row[it_name]")
					->setCellValue("K$i", "$row[it_description]")
					->setCellValue("L$i", "$row[it_discount_want]")
					->setCellValue("M$i", "$row[it_discount_rate]")
					->setCellValue("N$i", "$row[it_buy_qty]")
					->setCellValue("O$i", "$row[it_stock]")
					->setCellValue("P$i", "$row[it_paydate]")
					->setCellValue("Q$i", "$row[it_payenddate]")
					->setCellValue("R$i", "$row[it_money_type]")
					->setCellValue("S$i", "$row[it_money_per]")
					->setCellValue("T$i", "$row[it_money]")
					->setCellValue("U$i", "$row[it_other_use]")
					->setCellValue("V$i", "$row[it_other]")
					->setCellValue("W$i", "$row[it_ticket_type]")
					->setCellValue("X$i", "$row[it_now_supply_sms]")
					->setCellValue("Y$i", "$row[it_now_mb_sms]")
					->setCellValue("Z$i", "$row[it_address]")
					->setCellValue("AA$i", "$row[it_x_point]")
					->setCellValue("AB$i", "$row[it_y_point]")
					->setCellValue("AC$i", "$row[it_startdate]")
					->setCellValue("AD$i", "$row[it_enddate]")
					->setCellValue("AE$i", "$row[ticket_when]")
					->setCellValue("AF$i", "$row[it_delivery_type]")
					->setCellValue("AG$i", "$row[it_delivery_price]")
					->setCellValue("AH$i", "$row[it_delivery_total]")
					->setCellValue("AI$i", "$row[it_payment]")
					->setCellValue("AJ$i", "$row[it_rule]")
					->setCellValue("AK$i", "$row[it_memo]")
					->setCellValue("AL$i", "$row[it_premium_use]")
					->setCellValue("AM$i", "$row[it_img_p]")
					->setCellValue("AN$i", "$row[it_img_m1]")
					->setCellValue("AO$i", "$row[it_img_m2]")
					->setCellValue("AP$i", "$row[it_img_m3]")
					->setCellValue("AQ$i", "$row[it_img_m4]")
					->setCellValue("AR$i", "$row[it_img_m5]")
					->setCellValue("AS$i", "$row[it_img_l]")
					->setCellValue("AT$i", "$row[it_img_name]");
	}

	// 시트이름
	$objPHPExcel->getActiveSheet()->setTitle($menu_code[access_text]);

	$objPHPExcel->setActiveSheetIndex(0);

	// 파일명
	$filename = urlencode($menu_code[access_text]);

	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');

	exit;
}




$sql .= " limit $from_record, $rows ";
$result = sql_query($sql);


$row = sql_fetch(" select count(*) as cnt
         $sql_common
         $sql_search and it_paydate <='$nfor[ymdhis]' and it_payenddate >='$nfor[ymdhis]'");
$sale_count = $row[cnt];

?>