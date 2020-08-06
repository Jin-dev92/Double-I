<?php
include "path.php";

$item = sql_fetch("select * from nfor_item where it_id='$it_id'");

item_access($item[it_id]);

if($mode=="config_update"){
	sql_query("update nfor_item set it_add_option1='$it_add_option1'
									, it_add_option2='$it_add_option2'
									, it_add_option3='$it_add_option3'
									, it_add_option4='$it_add_option4' where it_id='$it_id'");
	alert("가격옵션 설정이 수정되었습니다.","$PHP_SELF?it_id=$it_id");
	exit;
}

if($mode=="list_delete"){
	$g = 0;
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		if(it_sales_volume($it_id,$_POST['option_id'][$k])){
			$g++;
		} else{
			sql_query("delete from nfor_item_option where option_id='{$_POST['option_id'][$k]}'");
		}
	}
	if($g){
		alert("판매가 진행된 옵션 $g 건을 제외한 나머지 선택 옵션이 삭제되었습니다","$PHP_SELF?it_id=$it_id");
	} else{
		alert("선택하신 옵션이 삭제되었습니다","$PHP_SELF?it_id=$it_id");
	}
	exit;
}

if($mode=="list_update"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		sql_query("update nfor_item_option set option_select='{$_POST['option_select'][$k]}'
												, option_name1='{$_POST['option_name1'][$k]}'
												, option_name2='{$_POST['option_name2'][$k]}'
												, option_name3='{$_POST['option_name3'][$k]}'
												, option_name4='{$_POST['option_name4'][$k]}'
												, price='{$_POST['price'][$k]}'
												, supply_price='{$_POST['supply_price'][$k]}'
												, stock='{$_POST['stock'][$k]}'
												, option_view='{$_POST['option_view'][$k]}'
												, option_rank='{$_POST['option_rank'][$k]}'
												, option_tobe='{$_POST['option_tobe'][$k]}'
												, option_soldout='{$_POST['option_soldout'][$k]}' where option_id='{$_POST['option_id'][$k]}'");
	}
	alert("선택하신 옵션이 수정되었습니다","$PHP_SELF?it_id=$it_id");
	exit;
}

if($mode=="delete"){
	if(it_sales_volume($it_id,$option_id)){
		alert("이미 구매하신 사용자가 있어 삭제가 불가능합니다","$PHP_SELF?it_id=$it_id");
	} else{
		sql_query("delete from nfor_item_option where option_id='$option_id'");
		alert("선택하신 옵션이 삭제되었습니다","$PHP_SELF?it_id=$it_id");
	}
	exit;
}

if($mode=="insert"){
	sql_query("insert nfor_item_option set it_id='$it_id'
											, option_select='$option_select'
											, option_name1='$option_name1'
											, option_name2='$option_name2'
											, option_name3='$option_name3'
											, option_name4='$option_name4'
											, price='$price'
											, supply_price='$supply_price'
											, stock='$stock'
											, option_view='$option_view'
											, option_rank='$option_rank'
											, option_tobe='$option_tobe'
											, option_soldout='$option_soldout'");
	goto_url("$PHP_SELF?it_id=$it_id");
	exit;
}

if($mode=="excel"){
	require_once "$nfor[path]/PHPExcel.php";
	$objPHPExcel = new PHPExcel();
	$result = sql_query("select * from nfor_item_option where it_id='$it_id' and option_type='0' order by option_id asc");
	$cnt = @sql_num_rows($result);
	if(!$cnt) alert("출력할 내역이 없습니다.");

	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue("A1", "고유번호")
				->setCellValue("B1", "상품코드")
				->setCellValue("C1", "구분")
				->setCellValue("D1", "추가옵션")
				->setCellValue("E1", "판매가격(고객구매가격)")
				->setCellValue("F1", "공급가격(정산금액)")
				->setCellValue("G1", "전체수량(판매전체수량)")
				->setCellValue("H1", "판매수량(판매된수량)")
				->setCellValue("I1", "노출상태(0노출/1미노출)")
				->setCellValue("J1", "우선순위")
				->setCellValue("K1", "입고예정(0판매/1입고예정)")
				->setCellValue("L1", "품절(0판매/1품절)");

	for($i=2; $row=sql_fetch_array($result); $i++){
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue("A$i", "$row[option_id]")
					->setCellValue("B$i", "$row[it_id]")
					->setCellValue("C$i", "$row[option_select]")
					->setCellValue("D$i", "$row[option_name1]")
					->setCellValue("E$i", "$row[price]")
					->setCellValue("F$i", "$row[supply_price]")
					->setCellValue("G$i", "$row[stock]")
					->setCellValue("H$i", it_sales_volume($row[it_id],$row[option_id]))
					->setCellValue("I$i", "$row[option_view]")
					->setCellValue("J$i", "$row[option_rank]")
					->setCellValue("K$i", "$row[option_tobe]")
					->setCellValue("L$i", "$row[option_soldout]");
	}
	$objPHPExcel->getActiveSheet()->setTitle($menu_code[access_text]); // 시트이름
	$objPHPExcel->setActiveSheetIndex(0);
	$filename = urlencode($menu_code[access_text]); // 파일명
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	exit;
}

if($mode=="excel_update"){
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
				if($str[0] and $str[1]){
					sql_query("update nfor_item_option set option_select='$str[2]'
						, option_name1='$str[3]' 
						, price='$str[4]' 
						, supply_price='$str[5]' 
						, stock='$str[6]' 
						, option_view='$str[8]'
						, option_rank='$str[9]'
						, option_tobe='$str[10]'
						, option_soldout='$str[11]'
						, option_type='0' 
						, org_price='0'
						where option_id='$str[0]' and it_id='$str[1]'");
				} else{
					if($str[1]){
						sql_query("insert nfor_item_option set it_id='$str[1]'
						, option_select='$str[2]'
						, option_name1='$str[3]' 
						, price='$str[4]' 
						, supply_price='$str[5]' 
						, stock='$str[6]' 
						, option_view='$str[8]'
						, option_rank='$str[9]'
						, option_tobe='$str[10]'
						, option_soldout='$str[11]'
						, option_type='0' 
						, org_price='0'");
					}
				}
			}
			$i++;
		}
    } catch(exception $e){
        alert("엑셀파일을 읽는도중 오류가 발생하였습니다.");
    }
	alert("정상적으로 등록되었습니다.","$PHP_SELF?it_id=$it_id&$qstr");
}

include "head.php";
?>
<style>
.it_add_option1 { width:200px; }
.it_add_option2 { width:200px; }
.it_add_option3 { width:200px; }
.it_add_option4 { width:200px; }

.option_name1 { width:200px; }
.option_name2 { width:200px; }
.option_name3 { width:200px; }
.option_name4 { width:200px; }
.price { width:70px; }
.supply_price { width:70px; }
.stock { width:50px; }
.option_rank { width:40px; }
</style>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td height="50">
	<form method="post" action="<?=$PHP_SELF?>" enctype="multipart/form-data">
	<input type="hidden" name="it_id" value="<?=$item[it_id]?>">
	<input type="hidden" name="mode" value="excel_update">
	<input type="file" name="delivery_upload" class="input_txt">
	<input type="image" src="img/ex_up.gif" align="absmiddle">
	<a href="<?=$nfor[path]?>/sample/option_sample.xls"><span class="tex01"># 업로드 엑셀양식 다운로드</span></a>
	</form>
	</td>
</tr>
</table>

<a href="<?=$nfor[load]?>?it_id=<?=$it_id?>" target="_blank" style="font-size:20px; font-weight:bold;"><?=$item[it_name]?> 추가옵션관리</a>

<form name="fconfig" id="fconfig" method="post" action="<?=$PHP_SELF?>">
<input type="hidden" name="mode" value="config_update">
<input type="hidden" name="it_id" value="<?=$it_id?>">
<table class="tbl_typeB">
<tr>
	<th>1차옵션명</th>
	<th>2차옵션명</th>
	<th>3차옵션명</th>
	<th>4차옵션명</th>
</tr>
<tr>
	<td><input type="text" name="it_add_option1" class="it_add_option1" value="<?=$item[it_add_option1]?>"></td>
	<td><input type="text" name="it_add_option2" class="it_add_option2" value="<?=$item[it_add_option2]?>"></td>
	<td><input type="text" name="it_add_option3" class="it_add_option3" value="<?=$item[it_add_option3]?>"></td>
	<td><input type="text" name="it_add_option4" class="it_add_option4" value="<?=$item[it_add_option4]?>"></td>
</tr>
</table>
<div class="btn_cen"><input type="submit" value="가격옵션수정"></div>
</form>

<a href="<?=$PHP_SELF?>?mode=excel&it_id=<?=$item[it_id]?>&<?=$qstr?>"><img src="img/ex_down.gif" alt="엑셀다운" align="absmiddle"></a>

<table class="tbl_typeB">
<tr align="center">
	<th>전체선택</th>
	<th>구분</th>
	<th>추가옵션</th>
	<th>판매가격</th>
	<th>공급가격</th>
	<th>전체수량</th>
	<th>판매수량</th>
	<th>노출상태</th>
	<th>우선순위</th>
	<th>입고예정</th>
	<th>품절</th>
	<th>등록/삭제</th>
</tr>
<form action="<?=$PHP_SELF?>" method="post">
<input type="hidden" name="mode" value="insert">
<input type="hidden" name="it_id" value="<?=$it_id?>">
<tr>
	<td><input type="checkbox" name="chkall" value="1" onclick="check_all(this.form)"></td>
	<td>
		<select name="option_select" class="option_select">
			<option value="1">추가옵션1
			<option value="2">추가옵션2
			<option value="3">추가옵션3
			<option value="4">추가옵션4
		</select>
	</td>
	<td><input type="text" name="option_name1" class="option_name1"></td>
	<td><input type="text" name="price" class="price"></td>
	<td><input type="text" name="supply_price" class="supply_price"></td>
	<td><input type="text" name="stock" class="stock"></td>
	<td>-</td>
	<td>
		<select name="option_view" class="option_view">
			<option value="0">노출
			<option value="1">미노출
		</select>
	</td>
	<td><input type="text" name="option_rank" class="option_rank"></td>
	<td><input type="checkbox" name="option_tobe" value="1"></td>
	<td><input type="checkbox" name="option_soldout" value="1"></td>
	<td><input type="submit" value="옵션등록"></td>
</tr>
</form>

<form name="flist" id="flist" method="post" action="<?=$php_self?>">
<input type="hidden" name="mode" id="mode">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="it_id" value="<?=$it_id?>">
<?
$sql = "select * from nfor_item_option where it_id='$it_id' and option_type='0' and option_select>'0' order by option_id asc";
$que= sql_query($sql);
while($data = sql_fetch_array($que)){
	if(it_sales_volume($item[it_id],$data[option_id])){
		$del_btn_link = "javascript:alert('이미 판매된 상품이 존재하여 삭제가 불가능합니다.\n재고수량을 조절하여 주시거나 상품판매를 종료하여주세요')";
	} else{
		$del_btn_link = "{$PHP_SELF}?it_id={$it_id}&mode=delete&option_id={$data[option_id]}";
	}
?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#ffffff">
	<td><input type="checkbox" name="chk[]" value="<?=$i?>"><input type="hidden" name="option_id[<?=$i?>]" value="<?=$data[option_id]?>"></td>
	<td>
		<select name="option_select[<?=$i?>]" class="option_select">
		<option value="1" <?=$data[option_select]=="1"?"selected":""?>>추가옵션1
		<option value="2" <?=$data[option_select]=="2"?"selected":""?>>추가옵션2
		<option value="3" <?=$data[option_select]=="3"?"selected":""?>>추가옵션3
		<option value="4" <?=$data[option_select]=="4"?"selected":""?>>추가옵션4
		</select>
	</td>
	<td><input type="text" name="option_name1[<?=$i?>]" value="<?=$data[option_name1]?>" class="option_name1"></td>
	<td><input type="text" name="price[<?=$i?>]" value="<?=$data[price]?>" class="price"></td>
	<td><input type="text" name="supply_price[<?=$i?>]" value="<?=$data[supply_price]?>" class="supply_price"></td>
	<td><input type="text" name="stock[<?=$i?>]" value="<?=$data[stock]?>" class="stock"></td>
	<td><?=number_format(it_sales_volume($item[it_id],$data[option_id]))?>개 판매</td>	
	<td>
		<select name="option_view[<?=$i?>]" class="option_view">
		<option value="0" <?=$data[option_view]=="0"?"selected":""?>>노출
		<option value="1" <?=$data[option_view]=="1"?"selected":""?>>미노출
		</select>
	</td>
	<td><input type="text" name="option_rank[<?=$i?>]" value="<?=$data[option_rank]?>" class="option_rank"></td>
	<td><input type="checkbox" name="option_tobe[<?=$i?>]" value="1" <?=$data[option_tobe]?"checked":""?>></td>
	<td><input type="checkbox" name="option_soldout[<?=$i?>]" value="1" <?=$data[option_soldout]?"checked":""?>></td>
	<td><a href="<?=$del_btn_link?>"><img src="img/mi_btn.gif"></a></td>
</tr>
<? 
	$i++;	
} 
?>
</table>
<div class="btn_cen">
<a href="javascript:nfor_list('수정','list_update')"><img src="img/ji_btn02.gif" alt="선택수정"></a>
<a href="javascript:nfor_list('삭제','list_delete')"><img src="img/sun_del.gif" alt="선택삭제"></a>
<?
if(substr(basename($PHP_SELF),0,6)=="ticket"){
	$list_btn = "ticket_item_list.php";
} else{
	$list_btn = "delivery_item_list.php";
}
?>
<a href="<?=$list_btn?>"><img src="img/list.gif"></a>
</div>
</form>
<?
include "tail.php";
?>