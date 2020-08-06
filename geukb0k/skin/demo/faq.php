<?php
include_once $nfor[skin_path]."cus_head.php";
?>


		<table class="faq_list">
		<?
		for($i=1; $row=sql_fetch_array($result); $i++){
		?>
		<tr class="faq_q">
			<td style="text-align:left;"><a href="javascript:faq_show('.faq_tr','<?=$row[wr_id]?>');"><span style="color:#666;font-weight:bold; font-size:16px;">Q</span> <?=$row[wr_subject]?></a></td>
		</tr>
		<tr class="faq_tr faq_tr_<?=$row[wr_id]?>">
			<td><span style="color:#ff0000;font-weight:bold; font-size:16px;">A.</span><?=$row[wr_memo]?></td>
		</tr>
		<?	
		}
		$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");		
		?>
		</table>
		<div style="margin:0 auto; text-align:center; padding:10px;"><?=$pagelist?></div>
	


<?
include_once $nfor[skin_path]."cus_tail.php";
?>