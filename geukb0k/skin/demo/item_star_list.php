<?
for($i=0; $data=sql_fetch_array($result); $i++){
?>
<li class="q_li">

	<div style="margin-bottom:10px;">
		<span class="star_list_name"><b class="staricon"><em style="width:<?=$data[wr_star]*20?>%;"></em></b> <?=print_mb_info($data)?></span>
		<span class="star_list_date"><?=substr($data[wr_datetime],0,10)?></span>
		<div style="clear:both;"></div>
	</div>

	<div class="star_list_comment_update" id="update_star_<?=$data[wr_id]?>"></div>

	<div class="title_content">

	<div class="title">
		<? if($data[wr_img]){ ?>
		<div class="title_wrap">

			<div class="photo_wrap"><img src="<?="$nfor[path]/data/star/$data[wr_img]"?>"></div>
			<div class="star_memo" id="star_memo_<?=$data[wr_id]?>"><?=item_star_memo($data)?></div>
			
		</div>
		<? } else{ ?>
		<div class="star_memo" id="star_memo_<?=$data[wr_id]?>"><?=nl2br(item_star_memo($data))?></div>
		<? } ?>
	</div>

	
	<!-- <div class="content">
		
		<div class="star_memo"><?=item_star_memo($data)?></div>
		<? if($data[wr_img]){ ?><img src="<?="$nfor[path]/data/star/$data[wr_img]"?>" style="width:100%;"><? } ?>
	
	</div> -->

	</div>



	<? if(($member[mb_no] and $data[mb_no]==$member[mb_no]) or $is_admin){ ?>
	<div class="star_list_btn">
		<button type="button" class="star_update" data-mode="update" data-wr_id="<?=$data[wr_id]?>">수정</button>
		<button type="button" class="star_delete" data-mode="delete" data-wr_id="<?=$data[wr_id]?>">삭제</button>
	</div>
	<? } ?>

	<div class="star_list_comment_reply" id="reply_star_<?=$data[wr_id]?>"></div>

</li>
<?
}
?>


<?=ajax_get_paging("star",$config[cf_write_pages], $page, $total_page, "?$qstr&page=")?>