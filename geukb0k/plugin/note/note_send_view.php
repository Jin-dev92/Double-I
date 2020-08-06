<?php	// 쪽지
include "path.php";

$title = "보낸쪽지함";

if($mode=="delete"){
	sql_query("update nfor_note set send_del='1' where wr_id='$wr_id'");
	alert("삭제되엇습니다","note_send_list.php");
	exit;
}

include "head.php";
$note = sql_fetch("select * from nfor_note where wr_id='$wr_id'");

if($note[send_no] <> $member[mb_no]) alert("잘못된 접근입니다");

$mb = member("mb_no", $note[receive_no]);
?>

<?=$mb[mb_id]?>님께 <?=$note[send_datetime]?> 보낸 쪽지

<table>
<tr>
	<td><?=$note[wr_memo]?></td>
</tr>
</table>

<a href="note_send_list.php">목록보기</a>

<a href="javascript:del('note_send_view.php?mode=delete&wr_id=<?=$note[wr_id]?>')">삭제</a>

<a href="javascript:window.close()">창닫기</a>

<?php
include "tail.php";
?>