<?php // 자주묻는질문
include_once "path.php";
?><table class="faq_list">
<?
for($i=1; $row=sql_fetch_array($result); $i++){
?>
<tr class="faq_q">
	<td class="left"><a href="javascript:faq_show('.faq_tr','<?=$row[wr_id]?>');">Q <?=$row[wr_subject]?></a></td>
</tr>
<tr class="faq_tr faq_tr_<?=$row[wr_id]?>">
	<td><?=$row[wr_memo]?></td>
</tr>
<?	
}
?>
</table>
<style>
.faq_top_q td, .faq_q td{ border-bottom:solid 1px #ccc; text-align:center; padding:10px; }
.faq_top_q a, .faq_q a{ display:block; }
.faq_tr, .faq_top_tr { display:none; }
.faq_tr td, .faq_top_tr td{ border-bottom:solid 1px #ccc; text-align:left; padding:20px; background-color:#ededed; }
.faq_list { width:100%; }
.faq_list .left{ text-align:left; }
</style>