<?php	// 제휴문의관리
include "path.php";
$qstr .= "&ca_name=$ca_name&wr_is_reply=$wr_is_reply";

if($wr_id) $write = sql_fetch("select * from nfor_cooperation where wr_id='$wr_id'");

if($mode=="update"){
	sql_query("update nfor_cooperation set reply_no='$member[mb_no]', wr_reply_memo='$wr_reply_memo', wr_reply_datetime=NOW(), wr_is_reply='2' where wr_id='$wr_id'");		

	if($send_mail){
		$nfor[wr_memo] = $wr_reply_memo;
		nfor_send("cooperation",$write[wr_email],$write[wr_tel],$write[mb_no]);
	}

	alert("답변이 완료되었습니다","cooperation_form.php?wr_id=$wr_id&$qstr");
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
	f.action = "cooperation_form.php";
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
<? if($write[ca_name]){ ?>
<tr>
	<th>분류</th>
	<td><?=$write[ca_name]?></td>
</tr>
<? } ?>
<? if($write[wr_company]){ ?>
<tr>
	<th>회사명</th>
	<td><?=$write[wr_company]?></td>
</tr>
<? } ?>
<tr>
	<th>담당자명</th>
	<td><?=$write[wr_name]?></td>
</tr>
<? if($write[wr_tel]){ ?>
<tr>
	<th>연락처</th>
	<td><?=$write[wr_tel]?></td>
</tr>
<? } ?>
<? if($write[wr_email]){ ?>
<tr>
	<th>이메일</th>
	<td><?=$write[wr_email]?></td>
</tr>
<? } ?>
<? if($write[wr_homepage]){ ?>
<tr>
	<th>홈페이지</th>
	<td><?=url_auto_link($write[wr_homepage])?></td>
</tr>
<? } ?>

<? if($write[wr_upload]){ ?>
<tr>
	<th>첨부파일</th>
	<td><a href="<?=download_url("cooperation",$write[wr_upload],$write[wr_filename])?>" target="_blank"><?=$write[wr_filename]?></a></td>
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
	<td><input type="checkbox" name="send_mail" value="1"> 답변안내 문자발송</td>
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
<div class="btn_cen"><input type="image" src="img/dong_btn.gif"> <a href="cooperation_list.php?<?=$qstr?>"><img src="img/list.gif"></a></div>
</form>
<?
include "tail.php";
?>