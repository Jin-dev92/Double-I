<?php	// 상품분류설정
include "path.php";

if($wr_id){
	$write = sql_fetch("select * from nfor_banking where wr_id='$wr_id'");
}

if($mode=="insert"){
	$wr_rank = $wr_rank*-1;
	sql_query("insert nfor_banking set wr_bank='$wr_bank', wr_number='$wr_number', wr_name='$wr_name', wr_rank='$wr_rank', wr_use='$wr_use'");
	alert("정상적으로 등록되었습니다","banking_list.php?$qstr");
	exit;
}

if($mode=="update"){
	$wr_rank = $wr_rank*-1;
	sql_query("update nfor_banking set wr_bank='$wr_bank', wr_number='$wr_number', wr_name='$wr_name', wr_rank='$wr_rank', wr_use='$wr_use' where wr_id='$wr_id'");
	alert("정상적으로 수정되었습니다","banking_list.php?wr_id=$wr_id&$qstr");
	exit;
}

include "head.php";
?>
<form name="fwrite" method="post" action="banking_form.php" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$write[wr_id]?"update":"insert"?>">
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
	<th scope="row">은행명</th> 
	<td><input type="text" class="input_txt" name="wr_bank" value="<?=$write[wr_bank]?>" required itemname="분류이름"></td>
</tr>
<tr>
	<th scope="row">계좌번호</th> 
	<td><input type="text" class="input_txt" name="wr_number" value="<?=$write[wr_number]?>" required itemname="계좌번호"></td>
</tr>
<tr>
	<th scope="row">예금주</th> 
	<td><input type="text" class="input_txt" name="wr_name" value="<?=$write[wr_name]?>" required itemname="예금주"></td>
</tr>

<tr>
	<th scope="row">출력순위</th> 
	<td><input type="text"  class="input_txt" name="wr_rank" value="<?=$write[wr_rank]?$write[wr_rank]*-1:""?>" style="width:40px;" required numeric itemname="출력순위"><b> 순위 </b><br><span class="tex01">※숫자가 높을 수록 우선 출력됩니다. <br>※10 또는 20단위로 순위를 정하시면 좋습니다.</span></td>
</tr>
<tr>
	<th scope="row">노출여부</th> 
	<td><input type="checkbox"  name="wr_use" value="1" <? if($write[wr_use]) echo "checked"; ?>></td>
</tr>
</table>
<div class="btn_cen"><input type="image" src="img/dong_btn.gif"> <a href="banking_list.php?<?=$qstr?>"><img src="img/list.gif" alt="목록보기"></a></div>
</form>
<?
include "tail.php";
?>