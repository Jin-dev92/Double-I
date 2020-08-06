<?php	// 메일보내기
include_once "path.php";

if($mode=="insert"){
	$mail_send_memo = nl2br($mail_send_memo);
	mailer($mail_send_name1, $mail_send_email1, $mail_send_email2, $mail_send_subject, $mail_send_memo, 1);
	alert("성공적으로 전송되었습니다");
	exit;
}

include_once "mb_head.php";
?>

<form name="fwrite" method="post" action="mb_mail.php" onsubmit="return fsubmit(this)">
<input type="hidden" name="mode" value="insert">
<input type="hidden" name="mb_no" value="<?=$mb[mb_no]?>">
<table cellspacing="0" cellpadding="0" border="0" width="100%" class="order_list_tbl9" align="center">
<tr>
	<th width="100">보내는분</th>
	<td>
		<table class="tbl_typeC" border='0' cellpadding='0' cellspacing='0'>
		<tr>
			<td>이름</td>
			<td><input type="text" name="mail_send_name1" id="mail_send_name1" style="width:80px" value="<?=$config[cf_name]?>"></td>
		</tr>
		<tr>
			<td>이메일</td>
			<td><input type="text" name="mail_send_email1" id="mail_send_email1" style="width:200px" value="<?=$config[cf_email]?>"></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<th>받는분</th>
	<td>
		<table class="tbl_typeC" border='0' cellpadding='0' cellspacing='0'>
		<tr>
			<td>이름</td>
			<td><input type="text" name="mail_send_name2" id="mail_send_name2" style="width:80px" value="<?=$mb[mb_name]?>"></td>
		</tr>
		<tr>
			<td>이메일</td>
			<td><input type="text" name="mail_send_email2" id="mail_send_email2" style="width:200px" value="<?=$mb[mb_email]?>"></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<th>제목</th>
	<td><input type="text" name="mail_send_subject" id="mail_send_subject" style="width:95%"></td>
</tr>
<tr>
	<th>내용</th>
	<td><textarea name="mail_send_memo" id="mail_send_memo" rows="12" style="width:95%"></textarea></td>
</tr>
</table>
<br>
<p align="center"><input type="image" src="img/sand_btn.gif"></p>
<br>
</form>



<SCRIPT LANGUAGE="JavaScript">
<!--

function fsubmit(f){

	if(!$('#mail_send_name1').val()){
		alert("보내는분 이름을 입력해주세요");
		$('#mail_send_name1').focus();
		return false;
	}

	if(!$('#mail_send_email1').val()){
		alert("보내는분 메일주소를 입력해주세요");
		$('#mail_send_email1').focus();
		return false;
	}

	var email_chk = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i; 
	var email = $('#mail_send_email1').val();
	if(!email_chk.test(email)){
		alert("보내는분 메일주소가 잘못입력되었습니다");
		$('#mail_send_email1').focus();
		return false;
	} 

	if(!$('#mail_send_name2').val()){
		alert("받는분 이름을 입력해주세요");
		$('#mail_send_name2').focus();
		return false;
	}

	if(!$('#mail_send_email2').val()){
		alert("받는분 메일주소를 입력해주세요");
		$('#mail_send_email2').focus();
		return false;
	}

	var email_chk = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i; 
	var email = $('#mail_send_email2').val();
	if(!email_chk.test(email)){
		alert("받는분 메일주소가 잘못입력되었습니다");
		$('#mail_send_email2').focus();
		return false;
	} 

	if(!$('#mail_send_subject').val()){
		alert("메일 제목을 입력해주세요");
		$('#mail_send_subject').focus();
		return false;
	}

	if(!$('#mail_send_memo').val()){
		alert("메일 내용을 입력해주세요");
		$('#mail_send_memo').focus();
		return false;
	}

	f.action = "mb_mail.php";
	return true;

}	
//-->
</SCRIPT>

<?
include "mb_tail.php";
?>