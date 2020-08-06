<?php
include_once $nfor[skin_path]."head.php";
?>
<style>

#member_confirm { width:1338px; margin:10px auto 10px; }
.title {display:block; margin-top:20px; text-align:center;}
.okbtn { display:block; margin-top:10px; margin-bottom:10px; width:350px; height:45px; font-size:1.1em; color:#fff; font-weight: bold;cursor: pointer; border-radius:3px; -webkit-border-radius: 3px; background: #d32f2f;border:0px;}
#left_banner { display: none; }
#right_banner { display: none;}

</style>


<div id="member_confirm">

	<div class="title">
	<img src="/skin/demo/img/cotit.png">

			<div style="border:solid 1px #DCDCDC; padding:25px;width:350px;margin:25px auto 120px; background-color:#FFFFFF;">
			<form name="fmember_confirm" id="fmember_confirm" method="post" onsubmit="return fmember_confirm_submit()">
			<input type="hidden" name="mode" value="member_confirm">
			<input type="password" name="mb_password" id="mb_password" placeholder="비밀번호" value="<?=$mb_password?>" style="height:28px;width:345px;"><br>
			<input type="submit" value="확인" id="member_confirm_btn" class="okbtn" >
			</form>
			</div>
	</div>
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