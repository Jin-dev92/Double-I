<?php	// 고객문의관리
include "path.php";
$qstr .= "&ca_name=$ca_name&wr_is_reply=$wr_is_reply";

if($wr_id) $write = sql_fetch("select * from nfor_customer where wr_id='$wr_id'");

if($mode=="update"){
	sql_query("update nfor_customer set reply_no='$member[mb_no]', wr_reply_memo='$wr_reply_memo', wr_reply_datetime=NOW(), wr_is_reply='2' where wr_id='$wr_id'");
	
	if($send_mail){
		$nfor[wr_memo] = $wr_reply_memo;
		nfor_send("customer",$write[wr_email],$write[wr_tel],$write[mb_no]);
	}

	alert("답변이 완료되었습니다","customer_form.php?wr_id=$wr_id&$qstr");
	exit;
}

include "head.php";

echo cheditor1('wr_reply_memo', '100%', '450px');
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function fsubmit(f){
    <?
    echo cheditor3('wr_reply_memo');
    ?>	
	f.action = "customer_form.php";
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
<input type="hidden" name="ca_name" value="<?=$ca_name?>">
<input type="hidden" name="wr_is_reply" value="<?=$wr_is_reply?>">
<table class="tbl_type" border="0" cellspacing="0">
<colgroup>
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th>아이디</th>
	<td><?=mb_id($write[mb_no])?></td>
</tr>
<tr>
	<th>이름</th>
	<td><?=$write[wr_name]?></td>
</tr>
<tr>
	<th>연락처</th>
	<td><?=$write[wr_tel]?></td>
</tr>
<tr>
	<th>이메일</th>
	<td><?=$write[wr_email]?></td>
</tr>
<tr>
	<th>분류</th>
	<td><?=$write[ca_name]?></td>
</tr>
<?
if($write[it_id]){
	$item = item($write[it_id]);
?>
<tr>
	<th>상품</th>
	<td><a href="<?=$nfor[load]?>?it_id=<?=$item[it_id]?>" target="_blank"><?=$item[it_name]?></a></td>
</tr>
<? } ?>
<tr>
	<th>제목</th>
	<td><?=$write[wr_subject]?></td>
</tr>
<tr>
	<th>내용</th>
	<td><?=nl2br($write[wr_memo])?></td>
</tr>
<tr>
	<th>메일발송</th>
	<td><input type="checkbox" name="send_mail" value="1"> 메일발송</td>
</tr>
<tr>
	<th>답변내용</th>
	<td><?=cheditor2('wr_reply_memo', $write[wr_reply_memo]);?></td>
</tr>
<? if($write[reply_no]){ ?>
<tr>
	<th>답변시간</th>
	<td><?=$write[wr_reply_datetime]?></td>
</tr>
<tr>
	<th>답변자</th>
	<td><?=reply_name($write[reply_no])?></td>
</tr>
<? } ?>
</table>
<div class="btn_cen"><input type="image" src="img/dong_btn.gif"> <a href="customer_list.php?<?=$qstr?>"><img src="img/list.gif"></a></div>
</form>
<?
include "tail.php";
?>