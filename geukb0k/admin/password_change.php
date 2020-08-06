<?php	// 비밀번호 변경
include "path.php";

if($mode=="update"){
	if(!$password_1) alert("현 비밀번호를 입력하셔야 수정이 가능합니다.");
	if(!$password_2) alert("새 비밀번호를 입력하셔야 수정이 가능합니다.");
	if(sql_password($password_1) != $member[mb_password]) alert("입력하신 현 비밀번호가 일치하지 않습니다.");
	if($password_2<>$password_3) alert("입력하신 새 비밀번호가 서로 일치하지 않습니다.");
	sql_query("update nfor_member set mb_password=password('$password_3') where mb_no='$member[mb_no]'");
	alert("패스워드가 정상적으로 변경되었습니다.","password_change.php");
	exit;
}

include "head.php";
?>
<form name="fwrite" method="post" action="password_change.php">
<input TYPE="hidden" NAME="mode" value="update">
<table class="tbl_type" border="1" cellspacing="0">
<colgroup>
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th>현 비밀번호</th>
	<td><input name="password_1" type="password" id="password_1" class="input_txt"size="18" required itemname="현 비밀번호"><span class="tex01">&nbsp;&nbsp;현재 비밀번호를 입력해 주세요.</span></td>
</tr>
<tr>
	<th>새 비밀번호</th>
	<td><input name="password_2" type="password" id="password_2" class="input_txt"size="18" required itemname="새 비밀번호"><span class="tex01">&nbsp;&nbsp;새 비밀번호를 입력해 주세요.</span></td>
</tr>
<tr>
	<th>새 비밀번호확인</th>
	<td><input name="password_3" type="password" id="password_3" class="input_txt"size="18" required itemname="새 비밀번호확인"><span class="tex01">&nbsp;&nbsp;위에 입력한 새 비밀번호와 동일하게 다시 입력해 주세요.</span></td>
</tr>
</table>
<div class="btn_cen"><input type="image" src="img/pw_btn.gif"> <a href="#" onclick="reset()"><img src="img/cen_btn.gif"></a></div>
</form>
<?
include "tail.php";
?>