<?php
include_once $nfor[skin_path]."head.php";


?>


<style>
.plan_tit { width:100%; margin:0px 0px 10px 0px; }
.plan_tit img{ width:100%; }
</style>




<div class="plan_tit"><img src="<?="$nfor[path]/data/plan/$plan[wr_img_m]"?>" alt=""></div>

<ul class="item_list3">
<?
$exp = explode("|",trim($plan[wr_item_list]));
for($i=0; $i<count($exp); $i++){

	$it_id = trim($exp[$i]);

	$item = sql_fetch("select * from nfor_item where it_id='$it_id'");
	if($item[it_id]){

		// 판매량
		$item[it_sales_volume] = it_change_volume($item[it_id])+it_sales_volume($item[it_id]);
		// 남은수량정의
		$item[it_stock_now] = $item[it_stock]-$item[it_sales_volume];

		$item[url] = "item.php?it_id=$item[it_id]&amp;category_id=$item[category_id]&amp;area_id=$item[area_id]";
?>
<li>

	<a href="<?=$item[url]?>">

		<div class="img_wrap">
			<img data-original="<?=$item[it_img_l_m]?"$nfor[path]/data/list_m/$item[it_img_l_m]":"$nfor[path]/img/item_list_noimg.jpg"?>" alt="" class="img1 lazy">
			<!--<img src="<?=$item[it_img_l]?"$nfor[path]/data/list/$item[it_img_l]":"$nfor[path]/img/item_list_noimg.jpg"?>" alt="" class="img2 lazy">-->

			<ul class="icon_wrap">
				<li class="ico1"><?=delivery_type($item)?></li>
				<li class="ico2">쿠폰할인</li>
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
} 
?>
</ul>



<?
include_once $nfor[skin_path]."tail.php";
?>