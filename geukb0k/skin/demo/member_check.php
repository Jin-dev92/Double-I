<?php
include_once $nfor[skin_path]."member_head.php";
?>
<style>
.member_check .title { font-size:16px; color:#666; }
.member_check .sub_title { font-size:13px; color:#999; }
.member_check .msg { font-size:13px; color:#999; }

.btn_submit { background-color:#c98aff; border:solid 1px #c98aff; color:#fff; font-size:16px; font-weight:bold; height:50px; width:100%; }

.spacing10 { margin:20px 0px; }
</style>

<div class="member_check">

	<b class="title">원하시는 인증방법을 선택해주세요</b>
	<p class="sub_title">회원가입을 위해서는 실명인증을 반드시 진행해주셔야 합니다</p>

	<div class="line"></div>

	<div class="table spacing10">
	<div class="table-row">
		<? if($config[cf_hp_use]){ ?><div class="table-cell"><input type="button" value="휴대폰인증" class="btn_submit" onclick="javascript:kcb_hp_win()"></div><? } ?>
		<? if($config[cf_ipin_use]){ ?><div class="table-cell"><input type="button" value="아이핀인증" class="btn_submit" onclick="javascript:kcb_ipin_win()"></div><? } ?>
	</div>
	</div>

	<div class="line"></div>

	<p class="msg">정보통신망 이용 촉진 및 정보보호 등에 관한 법류 제 23조의 2(주민등록번호의 사용 제한)에 따라 아이핀 서비스를 이용하여 주민등록번호를 입력하지 않고도 사이트 가입할수 있습니다.</p>
	<br>
	<p class="msg">휴대폰 본인인증 또는 아이핀에 문제가 발생하면 아래의 고객센터로 문의해 주시기 바랍니다.</p>
	<p class="msg">아이핀 서비스는 신용평가회사인 KCB가 제공합니다.</p>
	<p class="msg">문의전화 : 02-708-1000, 팩스 : 02-708-1111</p>


</div>


<?
include_once $nfor[skin_path]."member_tail.php";
?>