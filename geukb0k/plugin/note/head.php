<?php
include "../../html_head.php";

$receive = sql_fetch("select count(*) as cnt from nfor_note where receive_no='$member[mb_no]' and receive_datetime='0000-00-00 00:00:00'and receive_del='0'");

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td style="height:40px;" bgcolor="#66666">&nbsp;&nbsp;<span style="font-weight:bold; font-size:12px;color:#ffffff;font-family:'trebuchet MS',dotum">| <?=$title?></span></td>
</tr>
</table>




<table cellpadding="0" cellspacing="0" border="0" style="width:96%; margin-bottom:20px; margin-top:20px;" align="center">
<tr>
	<td align="left">

	<a href="note_receive_list.php" style="<?=basename($PHP_SELF)=="note_receive_list.php" || basename($PHP_SELF)=="note_receive_view.php"?"font-weight:bold;":""?>">받은쪽지함 <?=$receive[cnt]?"[".number_format($receive[cnt])."]":""?></a> | <a href="note_send_list.php" style="<?=basename($PHP_SELF)=="note_send_list.php" || basename($PHP_SELF)=="note_send_view.php"?"font-weight:bold;":""?>">보낸쪽지함</a> | <a href="note_form.php" style="<?=basename($PHP_SELF)=="note_form.php"?"font-weight:bold;":""?>">쪽지보내기</a>

	</td>
</tr>
</table>



<?
if($receive[cnt]){
	echo "<embed src='note.swf' width='0' height='0'>";
}
?>
