<?
include_once "path.php";
?>
<ul class="faq_list">
<? for($i=1; $row=sql_fetch_array($result); $i++){ ?>
	<li class="faq_q">
		<? if($row[wr_best]){ ?><i>BEST</i><? } else{ ?><b>Q</b><? } ?>
		<a href="javascript:faq_show('.faq_a','<?=$row[wr_id]?>');"><?=$row[wr_subject]?></a>
	</li>
	<li class="faq_a faq_a_<?=$row[wr_id]?>"><?=$row[wr_memo]?></li>
<? } ?>
</ul>