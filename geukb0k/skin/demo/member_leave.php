<?php
include_once $nfor[skin_path]."head.php";
?>





<form name="fsecession" method="post" action="member_leave.php" autocomplete="off">
<input type="hidden" name="mode" value="update">
<table border="0" cellpadding="0" cellspacing="0">
<tr>
	<th>패스워드</th>
	<td><input type="password" name="mb_password"></td>
</tr>
<tr>
	<th>탈퇴사유</th>
	<td><textarea name="mb_secession" id="mb_secession" rows="5"></textarea></td>
</tr>
</table>


<input type="submit" value="회원탈퇴"> 

</form>


<?php
include_once $nfor[skin_path]."tail.php";
?>