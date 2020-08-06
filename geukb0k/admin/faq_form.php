<?php	// FAQ관리
include "path.php";

$write = sql_fetch("select * from nfor_faq where wr_id='$wr_id'");

if($mode=="insert"){
	sql_query("insert nfor_faq set ca_name='$ca_name',wr_subject='$wr_subject',wr_memo='$wr_memo',wr_rank='$wr_rank', wr_view='$wr_view', wr_best='$wr_best'");
	alert("정상적으로 등록 되었습니다","faq_list.php?$qstr");
	exit;
}

if($mode=="update"){
	sql_query("update nfor_faq set ca_name='$ca_name',wr_subject='$wr_subject',wr_memo='$wr_memo',wr_rank='$wr_rank', wr_view='$wr_view', wr_best='$wr_best' where wr_id='$wr_id'");
	alert("정상적으로 수정 되었습니다","faq_form.php?wr_id=$wr_id&$qstr");
	exit;
}

include "head.php";

echo cheditor1('wr_memo', '100%', '450px');
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function fsubmit(f){

	if(!$("#ca_name").val()){
		alert("분류를 입력해주세요");
		return false;
	}
	if(!$("#wr_subject").val()){
		alert("제목을 입력해주세요");
		return false;
	}

    <?
    echo cheditor3('wr_memo');
    ?>

	f.action = "faq_form.php";
	return true;

}	
//-->
</SCRIPT>
<form name="fwrite" method="post" onsubmit="return fsubmit(this)" enctype="multipart/form-data">
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
	<th>분류</th>
	<td>
	<select name="ca_name" id="ca_name" onchange="search.submit()"  required itemname="분류">
	<option value="">문의분류
	<?
	for($i=0; $i<count($nfor[faq]); $i++){
	?>	
	<option value="<?=$nfor[faq][$i]?>" <? if($write[ca_name]==$nfor[faq][$i]) echo "selected"; ?>><?=$nfor[faq][$i]?>
	<? } ?>
	</select>
	</td>
</tr>
<tr>
	<th>제목</th>
	<td><input type="text" class="input_txt" name="wr_subject" id="wr_subject" value="<?=$write[wr_subject]?>" style="width:98%;" required itemname="제목"></td>
</tr>
<tr>
	<th>내용</th>
	<td><?=cheditor2('wr_memo', $write[wr_memo]);?></td>
</tr>
<tr>
	<th>우선순위</th>
	<td><input type="text" class="input_txt" name="wr_rank" id="wr_rank" value="<?=$write[wr_rank]?>" style="width:50px;" required itemname="우선순위"> ※ 높을수록 우선출력</td>
</tr>

<tr>
	<th>베스트순위</th>
	<td><input type="text" class="input_txt" name="wr_best" id="wr_best" value="<?=$write[wr_best]?>" style="width:50px;" required itemname="베스트순위"> ※ 높을수록 우선출력</td>
</tr>

<tr>
	<th>미노출</th>
	<td><input type="checkbox" name="wr_view" value="1" <?=$write[wr_view]?"checked":""?>> 체크시 미노출</td>
</tr>







</table>
<div class="btn_cen"><input type="image" src="img/dong_btn.gif"> <a href="faq_list.php?<?=$qstr?>"><img src="img/list.gif"></a></div>
</form>

<?
include "tail.php";
?>