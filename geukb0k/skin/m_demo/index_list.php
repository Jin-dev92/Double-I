<?php
include_once "path.php";
?><ul class="item_list3">
<?
$sql = "select * from nfor_item where it_paydate <='$nfor[ymdhis]' and it_payenddate >='$nfor[ymdhis]' and it_view='0' and it_set>0";
$sql .= category_sql("$category_id");
$sql .= " order by it_set desc";
$result = sql_query($sql);
for($i=0; $item=sql_fetch_array($result); $i++){

	// 판매량
	$item[it_sales_volume] = it_change_volume($item[it_id])+it_sales_volume($item[it_id]);
	// 남은수량정의
	$item[it_stock_now] = $item[it_stock]-$item[it_sales_volume];

	$item[url] = "item.php?it_id=$item[it_id]&amp;category_id=$item[category_id]&amp;area_id=$item[area_id]";
?>
<?
$sql2 = "select * from  (select * from nfor_item) a , nfor_item_category where wr_depth='2' and a.category_id1 = category_id and  a.it_id='$item[it_id]' ";
$row2 = sql_fetch($sql2);
?>
<li>

	<a href="<?=$item[url]?>">

		<div class="img_wrap">
			<img src="<?=$item[it_img_l_m]?"$nfor[path]/data/list_m/$item[it_img_l_m]":"$nfor[path]/img/item_list_noimg.jpg"?>" alt="" class="img1 lazy">

			<ul class="icon_wrap">
				<li class="ico1"><?=delivery_type($item)?></li>
			</ul>
		</div>
		<span class="it_title" style="line-height:10px; color:rgba(212, 147, 89, 0.92); font-size:14px;">[&nbsp;<?=$row2[wr_category]?><?=$row[wr_name]?>&nbsp;]</span>
		<div class="it_description"><?=$item[it_description]?></div>
		<div class="it_name"><?=$item[it_name]?></div>
		
		<div class="price_wrap">
			<div class="it_price">
				<div class="it_price2"><?=number_format($item[it_price2])?><span>원</span></div>
			</div>
			<div class="it_sales_volume"><b><?=number_format($item[it_sales_volume])?></b>개 구매</div>
		</div> 
	</a>

</li>
<? } ?>
</ul>