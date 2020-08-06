<?php	// 판매증가예약
include "path.php";

if($wr_id) $write = sql_fetch("select * from nfor_false_item where wr_id='$wr_id'");

if($it_id) $item = sql_fetch("select * from nfor_item where it_id='$row[it_id]'");


item_access($it_id);

if($mode=="insert"){
	sql_query("insert nfor_false_item set supply_no='$item[supply_no]', it_sales_volume='$it_sales_volume', it_id='$it_id', wr_datetime='$wr_datetime'");
	alert("정상적으로 등록 되었습니다","false_item_list.php?$qstr");
	exit;
}

if($mode=="update"){
	sql_query("update nfor_false_item set supply_no='$item[supply_no]', it_sales_volume='$it_sales_volume', it_id='$it_id', wr_datetime='$wr_datetime' where wr_id='$wr_id'");
	alert("정상적으로 수정 되었습니다","false_item_form.php?wr_id=$wr_id&$qstr");
	exit;
}

include "head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--

$(function(){
    $('#wr_datetime').datetimepicker({
        showOn: 'button',
		buttonImage: './img/calendar.gif',
		buttonImageOnly: true,
        buttonText: "달력",
        changeMonth: true,
		changeYear: true,
        showButtonPanel: true,
		dateFormat: 'yy-mm-dd',
		timeFormat: 'hh:mm:ss'
    }); 

});	

function fsubmit(f){
	if(!$("#it_id").val()){
		alert("상품을 선택해주세요");
		return false;
	}

	f.action = "false_item_form.php";
	return true;
		    
}	
//-->
</SCRIPT>
<form name="fwrite" method="post" onsubmit="return fsubmit(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode=="update_form"?"update":"insert"?>">
<input type="hidden" name="wr_id" value="<?=$write[wr_id]?>">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<table class="tbl_type" border="1" cellspacing="0">
<colgroup>
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th>상품선택</th>
	<td>

		<? if($member[is_supply]>1){ ?>

			<?	
			if($write[wr_id]){
				$item = sql_fetch("select it_name from nfor_item where it_id='$write[it_id]'");
				$write[it_subject] = $item[it_name];
			}	
			?>
			<input type="hidden" name="it_id" id="it_id" value="<?=$write[it_id]?>">
			<input type="text" class="input_txt" name="it_subject" id="it_subject" value="<?=$write[it_subject]?>" style="width:200px;" onclick="it_id_search();" readonly>
			<a href="javascript:it_id_search();" class="btn_sml"><span>조회하기</span></a>

		<? } else{ ?>

			<select name="it_id" id="it_id">
			<option value="">상품선택
			<?
			$que = sql_query("select * from nfor_item where supply_no='$member[mb_no]'");
			while($data = sql_fetch_array($que)){
			?>
			<option value="<?=$data[it_id]?>" <?=$data[it_id]==$write[it_id]?"selected":""?>><?=$data[it_name]?> - <?=$data[it_id]?>
			<? } ?>
			</select>

		<? } ?>

	</td>
</tr>
<tr>
	<th>증가수량</th>
	<td><input type="text" class="input_txt" name="it_sales_volume" id="it_sales_volume" value="<?=$write[it_sales_volume]?>" style="width:50px;" required itemname="증가수량">개</td>
</tr>
<tr>
	<th>등록일시</th>
	<td><input type="text" class="input_txt" name="wr_datetime" id="wr_datetime" value="<?=$write[wr_datetime]?>" style="width:120px;" required itemname="등록일자"></td>
</tr>
</table>
<div class="btn_cen"><input type="image" src="img/dong_btn.gif"> <a href="false_item_list.php?<?=$qstr?>"><img src="img/list.gif"></a></div>
</form>
<?
include "tail.php";
?>