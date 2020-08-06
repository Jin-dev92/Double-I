<?php
include_once $nfor[skin_path]."head.php";
?>

<style>
.member_confirm { margin:0px; padding:10px; width:100%; box-sizing:border-box; -webkit-box-sizing:border-box;  }

.confirm_title { font-weight:normal; font-size:16px; }
.confirm_sub_title { font-size:13px; color:#666; }

.member_confirm_line { border-top:solid 1px #ccc; margin:10px 0px; }

.member_confirm_btn { display:block; width:100%; height:40px; line-height:40px; text-align:center; padding:0px; margin:0px; margin:15px 0px; font-size:16px; font-weight:bold; background-color:#d32f2f; border:solid 1px #d32f2f; color:#fff; }

.mb_name { margin-bottom:10px; }
</style>

<form name="fwrite" method="post">
<div class="member_confirm">



	<b class="confirm_title">휴대폰번호로 패스워드찾기</b>
	<p class="confirm_sub_title">가입시 입력한 휴대폰번호와 이름을 입력해 주세요</p>
	<div class="member_confirm_line"></div>

	<input type="text" name="mb_name" id="mb_name_1" class="mb_name" placeholder="이름">

	<input type="number" pattern="[0-9]*" name="mb_hp" id="mb_hp" placeholder="휴대폰번호 (-없이 입력)">

	<input type="button" value="확인" class="member_confirm_btn" id="hp_check_btn">

	<div style="height:10px;"></div>


	<b class="confirm_title">이메일주소로 패스워드찾기</b>
	<p class="confirm_sub_title">가입시 입력한 이메일주소와 이름을 입력해 주세요</p>
	<div class="member_confirm_line"></div>

	<input type="text" name="mb_name" id="mb_name_2" class="mb_name" placeholder="이름">

	<input type="email" name="mb_email" id="mb_email" placeholder="이메일">

	<input type="button" value="확인" class="member_confirm_btn" id="email_check_btn">



</div>
</form>


<script type="text/javascript">
<!--
$(document).on("click","#hp_check_btn",function(){
	find_password("hp_check");
});

$(document).on("click","#email_check_btn",function(){
	find_password("email_check");
});
//-->
</script>
<?
include_once $nfor[skin_path]."tail.php";
?>