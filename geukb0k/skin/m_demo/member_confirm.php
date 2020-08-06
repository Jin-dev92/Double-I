<?php
include_once $nfor[skin_path]."head.php";
?>

<div id="member_confirm">

	<b class="title">회원정보확인</b>
	<p class="sub_title">정보를 안전하게 보호하기 위해 비밀번호를 다시 한번 입력해주세요</p>
	<div class="line"></div>
	<form name="fmember_confirm" id="fmember_confirm" method="post" onsubmit="return fmember_confirm_submit()">
	<input type="hidden" name="mode" value="member_confirm">
	<input type="password" name="mb_password" id="mb_password" placeholder="비밀번호" value="<?=$mb_password?>">
	<input type="submit" value="확인" id="member_confirm_btn">
	</form>

</div>

<SCRIPT LANGUAGE="JavaScript">
<!--
function fmember_confirm_submit(){
	if(!$("#mb_password").val()){
		alert("비밀번호를 입력해주세요");
		$("#mb_password").focus();
		return false;
	}
	return true;
}
//-->
</SCRIPT>
<?
include_once $nfor[skin_path]."tail.php";
?>