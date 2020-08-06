<?php
include_once "path.php";
?>
<?
for($i=0; $data=sql_fetch_array($result); $i++){
?>
<li class="q_li">

	<div>
		<span class="qna_list_name"><b></b> <?=print_mb_info($data)?></span>
		<span class="qna_list_date"><?=$data[wr_datetime]?></span>
		<div style="clear:both;"></div>
	</div>

	<div class="qna_list_comment_update" id="update_qna_<?=$data[wr_id]?>"></div>

	<div class="qna_memo" id="qna_memo_<?=$data[wr_id]?>"><?=item_qna_memo($data)?></div>

	<? $data = str_replace("<br>","",$data);?>
	<? if(($member[mb_no] and $data[mb_no]==$member[mb_no]) or $is_admin){ ?>
	<div class="qna_list_btn">
		<button type="button" class="reply" data-mode="reply" data-wr_id="<?=$data[wr_id]?>">답변</button>
		<button type="button" class="update" data-mode="update" data-wr_id="<?=$data[wr_id]?>">수정</button>
		<button type="button" class="delete" data-mode="delete" data-wr_id="<?=$data[wr_id]?>">삭제</button>
	</div>
	<? } ?>

	<div class="qna_list_comment_reply" id="reply_qna_<?=$data[wr_id]?>"></div>

</li>
<?
$que2 = sql_query("select * from nfor_item_qna where wr_reply='$data[wr_id]'");
while($data2 = sql_fetch_array($que2)){
?>
<li class="a_li">

	<div>
		<span class="qna_list_name"><i></i><b></b> &nbsp;<?=print_mb_info($data2,$data)?></span>
		<span class="qna_list_date"><?=$data2[wr_datetime]?></span>
		<div style="clear:both;"></div>
	</div>

	<div class="qna_list_comment_update" id="update_qna_<?=$data2[wr_id]?>"></div>

	
	<div class="qna_memo" id="qna_memo_<?=$data2[wr_id]?>"><?=item_qna_memo($data2,$data)?></div>
	<? if(($member[mb_no] and $data2[mb_no]==$member[mb_no]) or $is_admin){ ?>
	<div class="qna_list_btn">
		<button type="button" class="update" data-mode="update" data-wr_id="<?=$data[wr_id]?>">수정</button>

		<button type="button" class="delete" data-mode="delete" data-wr_id="<?=$data2[wr_id]?>">삭제</button>
	</div>
	<? } ?>
	
</li>
<? } ?>
<?
}
?>


<?=ajax_get_paging("qna",$config[cf_write_pages], $page, $total_page, "?$qstr&page=")?>