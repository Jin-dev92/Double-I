<?php	// 공지사항
include "path.php";

if($mode=="insert"){
	
	$add_sql = "";
	if($wr_datetime){
		$add_sql .= ", wr_datetime='$wr_datetime'";
	} else{
		$add_sql .= ", wr_datetime=NOW()";
	}

	if($wr_hit){
		$add_sql .= ", wr_hit='$wr_hit'";
	}

	sql_query("insert nfor_notice set ca_name='$ca_name',wr_subject='$wr_subject',wr_memo='$wr_memo',wr_memo_m='$wr_memo_m',wr_view='$wr_view' $add_sql");
	alert("정상적으로 등록 되었습니다","notice_list.php?$qstr");
	exit;
}

if($mode=="update"){
	
	$add_sql = "";
	if($wr_datetime){
		$add_sql .= ", wr_datetime='$wr_datetime'";
	} else{
		$add_sql .= ", wr_datetime=NOW()";
	}
	if($wr_hit){
		$add_sql .= ", wr_hit='$wr_hit'";
	}


	sql_query("update nfor_notice set ca_name='$ca_name',wr_subject='$wr_subject',wr_memo='$wr_memo',wr_memo_m='$wr_memo_m',wr_view='$wr_view' $add_sql where wr_id='$wr_id'");
	alert("정상적으로 수정 되었습니다","notice_form.php?wr_id=$wr_id&$qstr");
	exit;
}

if($wr_id) $write = sql_fetch("select * from nfor_notice where wr_id='$wr_id'");

include "head.php";

echo cheditor1('wr_memo', '100%', '250px');
echo cheditor1('wr_memo_m', '100%', '250px');


?>
<SCRIPT LANGUAGE="JavaScript">
<!--

$(function(){
    $('#wr_datetime').datetimepicker({
        showOn: 'button',
		buttonImage: 'img/calendar.gif',
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
    echo cheditor3('wr_memo_m');	
    ?>
	f.action = "notice_form.php";
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
	<th>미노출</th>
	<td><input type="checkbox" name="wr_view" id="wr_view" value="1" <? if($write[wr_view]) echo "checked"; ?>> <label for="wr_view">체크시 미노출</label></td>
</tr>
<tr>
	<th>분류</th>
	<td><input type="text" class="input_txt" name="ca_name" id="ca_name" value="<?=$write[ca_name]?>" style="width:100%;" required itemname="분류"></td>
</tr>
<tr>
	<th>제목</th>
	<td><input type="text" class="input_txt" name="wr_subject" id="wr_subject" value="<?=$write[wr_subject]?>" style="width:100%;" required itemname="제목"></td>
</tr>
<tr>
	<th>내용(PC)</th>
	<td><?=cheditor2('wr_memo', $write[wr_memo]);?></td>
</tr>

<tr>
	<th>내용(모바일)</th>
	<td><?=cheditor2('wr_memo_m', $write[wr_memo_m]);?></td>
</tr>

<tr>
	<th>조회수</th>
	<td><INPUT TYPE="text" NAME="wr_hit" value="<?=$write[wr_hit]?>" size="4"></td>
</tr>
<tr>
	<th>등록일시</th>
	<td><input type="text" name="wr_datetime" id="wr_datetime" value="<?=$write[wr_datetime]?$write[wr_datetime]:date("Y-m-d H:i:s");?>"></td>
</tr>
</table>
<div class="btn_cen"><input type="image" src="img/dong_btn.gif"> <a href="notice_list.php?<?=$qstr?>"><img src="img/list.gif"></a></div>
</form>
<?
include "tail.php";
?>