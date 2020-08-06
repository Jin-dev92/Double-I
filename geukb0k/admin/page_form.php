<?php	// 공지사항
include "path.php";

if($mode=="insert"){
	sql_query("insert nfor_page set wr_code='$wr_code',wr_subject='$wr_subject',wr_memo='$wr_memo',wr_datetime=NOW(),wr_view='$wr_view'");
	alert("정상적으로 등록 되었습니다","page_list.php?$qstr");
	exit;
}

if($mode=="update"){
	sql_query("update nfor_page set wr_code='$wr_code',wr_subject='$wr_subject',wr_memo='$wr_memo', wr_view='$wr_view' where wr_id='$wr_id'");
	alert("정상적으로 수정 되었습니다","page_form.php?wr_id=$wr_id&$qstr");
	exit;
}

if($wr_id) $write = sql_fetch("select * from nfor_page where wr_id='$wr_id'");

include "head.php";

echo cheditor1('wr_memo', '100%', '450px');
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function fsubmit(f){
	if(!$("#wr_code").val()){
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

	f.action = "page_form.php";
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
	<th>호출코드</th>
	<td><input type=text class="input_txt" name="wr_code" id="wr_code" value="<?=$write[wr_code]?>" style="width:100%;" required itemname="호출코드"></td>
</tr>
<tr>
	<th>제목</th>
	<td><input type=text class="input_txt" name="wr_subject" id="wr_subject" value="<?=$write[wr_subject]?>" style="width:100%;" required itemname="제목"></td>
</tr>
<tr>
	<th>내용</th>
	<td><?=cheditor2('wr_memo', $write[wr_memo]);?></td>
</tr>
</table>
<div class="btn_cen"><input type="image" src="img/dong_btn.gif"> <a href="page_list.php?<?=$qstr?>"><img src="img/list.gif"></a></div>
</form>
<?
include "tail.php";
?>