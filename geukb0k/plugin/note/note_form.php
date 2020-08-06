<?php	// 쪽지
include "path.php";

$title = "쪽지보내기";

if($mode=="insert"){
	$mb = member("mb_id", $mb_id);
	if(!$mb[mb_no] or !$mb_id) alert("잘못된 아이디입니다");
	if(!$wr_memo) alert("내용을 입력해주세요");

	$receive_no = $mb[mb_no];
	sql_query("insert nfor_note set send_no='$member[mb_no]', receive_no='$receive_no', wr_memo='$wr_memo', send_datetime=NOW()");
	alert("쪽지를 발송하였습니다","note_send_list.php");
	exit;
}

include "head.php";

if($mb_no){
	$mb = member("mb_no", $mb_no);
}
?>

<form method="post" action="note_form.php">
<input type="hidden" name="mode" value="insert">
<table cellpadding="0" cellspacing="0" border="0" class="tbl_typeE" style="width:96%;" align="center">
<tr>
	<th width="120">받는회원아이디</th>
	<td><input type="text" name="mb_id" value="<?=$mb[mb_id]?>"></td>
</tr>
<tr>
	<th>쪽지내용</th>
	<td><textarea name="wr_memo" rows="17" style="width:100%"></textarea></td>
</tr>
</table>


<table cellpadding="0" cellspacing="0" border="0" style="width:96%; margin-top:20px;" align="center">
<tr>
	<td align="center">
	<input type="submit" value="쪽지보내기">
	<input type="button" value="창닫기" onclick="window.close()">
	</td>
</tr>
</table>





</form>

<?php
include "tail.php";
?>