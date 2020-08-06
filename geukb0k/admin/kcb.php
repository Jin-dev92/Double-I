<?php	// KCB 실명인증
include "path.php";

if($mode=="update"){	
	sql_query("update nfor_config set cf_ipin_use='$cf_ipin_use', cf_hp_use='$cf_hp_use', cf_check_code='$cf_check_code'");	
	alert("정상적으로 수정되었습니다",$_SERVER[PHP_SELF]);
}

include "head.php";
?>







<form name="fwrite" method="post" action="<?=$_SERVER[PHP_SELF]?>">
<input type="hidden" name="mode" value="update">
<div class="s_title"><img src="img/dot.gif" align="absmiddle"><span class="tex02">KCB 아이핀 & 핸드폰 본인인증 설정</span></div>
<table class="tbl_type" border="1" cellspacing="0">
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th scope="row">아이핀 사용여부</th>
	<td><input type="radio" class="input_rdo" name="cf_ipin_use" value="1" <?=$config[cf_ipin_use]?"checked":""?>>사용 <input type="radio" class="input_rdo" name="cf_ipin_use" value="0" <?=!$config[cf_ipin_use]?"checked":""?>>미사용 
	<span class="tex01">&nbsp;KCB의 아이핀 인증을 사용합니다.</span>
	</td>
</tr>

<tr>
	<th scope="row">휴대폰 본인확인 사용여부</th>
	<td><input type="radio" class="input_rdo" name="cf_hp_use" value="1" <?=$config[cf_hp_use]?"checked":""?>>사용 <input type="radio" class="input_rdo" name="cf_hp_use" value="0" <?=!$config[cf_hp_use]?"checked":""?>>미사용 
	<span class="tex01">&nbsp;KCB의 휴대폰 본인확인 인증을 사용합니다.</span>
	</td>
</tr>
<tr>
	<th scope="row">KCB 회원사코드</th>
	<td><input type="text" class="input_txt" name="cf_check_code" value="<?=$config[cf_check_code]?>" size="20" itemname="KCB 회원사코드"> <span class="tex01">KCB 실명인증 및 아이핀 서비스는 필수가 아닌 선택적 부가서비스입니다</span> <a href="http://ok-name.co.kr" target="_blank" class="btn_sml"><span>KCB 서비스 신청 02-708-6087</span></a>
</td>
</tr>
</table>
<div class="btn_cen"><input type="image" src="img/con_btn.gif"></div>
</form>
<?
include "tail.php";
?>