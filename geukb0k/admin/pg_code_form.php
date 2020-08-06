<?php	// 공지사항
include "path.php";

if($mode=="insert"){	
	sql_query("insert nfor_pg_code set pg_type='$pg_type',pg_payment_type='$pg_payment_type',pg_name='$pg_name',pg_code='$pg_code',pg_rank='$pg_rank'");
	alert("정상적으로 등록 되었습니다","pg_code_list.php?$qstr");
	exit;
}

if($mode=="update"){
	sql_query("update nfor_pg_code set pg_type='$pg_type',pg_payment_type='$pg_payment_type',pg_name='$pg_name',pg_code='$pg_code',pg_rank='$pg_rank' where pg_id='$pg_id'");
	alert("정상적으로 수정 되었습니다","pg_code_form.php?pg_id=$pg_id&$qstr");
	exit;
}

if($pg_id) $write = sql_fetch("select * from nfor_pg_code where pg_id='$pg_id'");

include "head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function fsubmit(f){

	f.action = "pg_code_form.php";
	return true;	    
}	
//-->
</SCRIPT>
<form name="fwrite" method="post" onsubmit="return fsubmit(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$write[pg_id]?"update":"insert"?>">
<input type="hidden" name="pg_id" value="<?=$write[pg_id]?>">
<input type="hidden" name="pg_type" value="kcp">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<table class="tbl_type" border="1" cellspacing="0">
<colgroup>
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th>구분</th>
	<td>
	<select name="pg_payment_type" required itemname="구분">
	<option value="">선택
	<option value="vbanking" <?=$write[pg_payment_type]=="vbanking"?"selected":""?>>은행
	<option value="card" <?=$write[pg_payment_type]=="card"?"selected":""?>>신용카드
	</select>
	</td>
</tr>
<tr>
	<th>은행명</th>
	<td><input type="text" class="input_txt" name="pg_name" id="pg_name" value="<?=$write[pg_name]?>" style="width:100%;" required itemname="은행명"></td>
</tr>
<tr>
	<th>은행코드</th>
	<td><input type="text" class="input_txt" name="pg_code" id="pg_code" value="<?=$write[pg_code]?>" style="width:100%;" required itemname="은행코드"></td>
</tr>
<tr>
	<th>정렬순위</th>
	<td><input type="text" class="input_txt" name="pg_rank" id="pg_rank" value="<?=$write[pg_rank]?>" style="width:50px" required itemname="정렬순위"></td>
</tr>
</table>
<div class="btn_cen"><input type="image" src="img/dong_btn.gif"> <a href="pg_code_list.php?<?=$qstr?>"><img src="img/list.gif"></a></div>
</form>
<?
include "tail.php";
?>