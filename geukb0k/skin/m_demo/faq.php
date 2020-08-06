<?php
include_once $nfor[skin_path]."head.php";
?>






<div class="wrap_faq">


	<div id="faq_search">
		<form name="faq.php">
			<input type="search" name="keyword" placeholder="검색어를 입력하세요" value="<?=$keyword?>" class="search_input">
			<a class="search_btn"></a>
		</form>
	</div>




	<ul class="faq_menu">
		<li <?=!$ca_name?"class='on'":""?>><a href="<?=$PHP_SELF?>">전체</a></li>
		<?
		for($i=0; $i<count($nfor[faq]); $i++){
			$href = $PHP_SELF."?ca_name=".urlencode($nfor[faq][$i]);
		?>	
		<li <?=$ca_name==$nfor[faq][$i]?"class='on'":""?>><a href="<?=$href?>"><?=$nfor[faq][$i]?></a></li>
		<? } ?>
		<?
		for($g=0; $g<2-($i%3); $g++){
		?>
		<li><a></a></li>
		<? } ?>
	
	</ul>
	<div style="clear:both;"></div>


	<ul class="faq_list">
	<?
	for($i=1; $row=sql_fetch_array($result); $i++){
	?>
		<li class="faq_q">
			<? if($row[wr_best]){ ?><i>BEST</i><? } else{ ?><b>Q</b><? } ?>
			<a href="javascript:faq_show('.faq_a','<?=$row[wr_id]?>');"><?=$row[wr_subject]?></a>
		</li>
		<li class="faq_a faq_a_<?=$row[wr_id]?>">
			<?=$row[wr_memo]?>
		</li>
	<?	
	}
	$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");		
	?>
	</ul>
	<div style="margin:0 auto; text-align:center; padding:10px;"><?=$pagelist?></div>






</div>



<?php
include_once $nfor[skin_path]."tail.php";
?>