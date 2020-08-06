<?php	// 쪽지
include "path.php";

$title = "받은쪽지함";

if($mode=="delete"){
	sql_query("update nfor_note set receive_del='1' where wr_id='$wr_id'");
	alert("삭제되엇습니다","note_receive_list.php");
	exit;
}

$note = sql_fetch("select * from nfor_note where wr_id='$wr_id'");

if($note[receive_no] <> $member[mb_no]) alert("잘못된 접근입니다");

if($note[receive_datetime]=="0000-00-00 00:00:00"){
	sql_query("update nfor_note set receive_datetime=NOW() where wr_id='$wr_id'");
}

include "head.php";

$mb = member("mb_no", $note[send_no]);
?>

<?=$mb[mb_id]?>님께서 <?=$note[send_datetime]?> 보낸 쪽지

<table>
<tr>
	<td><?=$note[wr_memo]?></td>
</tr>
</table>

<a href="note_receive_list.php">목록보기</a>

<a href="note_form.php?mb_no=<?=$note[send_no]?>">답장하기</a>

<a href="javascript:del('note_receive_view.php?mode=delete&wr_id=<?=$note[wr_id]?>')">삭제</a>

<a href="javascript:window.close()">창닫기</a>

<?php
include "tail.php";
?>