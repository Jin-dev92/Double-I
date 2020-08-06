<?php
include_once $nfor[skin_path]."head.php";
?>



<ul class="item_list3">
<?
for($i=0; $row=sql_fetch_array($result); $i++){
	$item = sql_fetch("select * from nfor_item where it_id='$row[it_id]'");

	// 판매량
	$item[it_sales_volume] = it_change_volume($item[it_id])+it_sales_volume($item[it_id]);

	$item[url] = "item.php?it_id=$item[it_id]";
?>
<?
$sql2 = "select * from  (select * from nfor_item) a , nfor_item_category where wr_depth='2' and a.category_id1 = category_id and  a.it_id='$item[it_id]' ";
$row2 = sql_fetch($sql2);
?>
<li>

	<a href="<?=$item[url]?>">

		<div class="img_wrap">

			<img src="<?=$item[it_img_l_m]?"$nfor[path]/data/list_m/$item[it_img_l_m]":"$nfor[path]/img/item_list_noimg.jpg"?>" alt="" class="img2 lazy">

			<ul class="icon_wrap">
				<li class="ico1"><?=delivery_type($item)?></li>
			</ul>
		</div>
		<span class="it_title" style="line-height:10px; color:rgba(212, 147, 89, 0.92); font-size:14px;">[&nbsp;<?=$row2[wr_category]?><?=$row[wr_name]?>&nbsp;]</span>
		<div class="it_description"><?=$item[it_description]?></div>
		<div class="it_name"><?=$item[it_name]?></div>
		<div class="price_wrap">
			<span class="it_discount_rate"><?=$item[it_discount_rate]?><b>%</b></span>
			<div class="it_price">
				<!--<div class="it_price1"><?=number_format($item[it_price1])?><span>원</span></div>-->
				<div class="it_price2"><?=number_format($item[it_price2])?><span>원</span></div>
			</div>
			<div class="it_sales_volume"><b><?=number_format($item[it_sales_volume])?></b>개 구매</div>
		</div> 

	</a>

</li>
<?
} 
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?page=");
?>
</ul>


<div style="margin:0 auto; text-align:center; padding:10px;"><?=$pagelist?></div>


<?
include_once $nfor[skin_path]."tail.php";
?>