<?
include_once "path.php";
?>


<?
$austday = strtotime(date("Y-m-d 23:59:59"))*1000;
echo "<script type='text/javascript'>
	var austDay = new Date({$austday});
	$('#countdown').countdown({until: austDay,  layout: '<span>{hnn}</span> : <span>{mnn}</span> : <span>{snn}</span>' });
</script>";
?>

<style>
.it_newpro_tit { width:100%; height:50px; text-align:center; padding:10px 0px 0px 0px; }
.it_newpro_tit span{ line-height:45px; height:45px; font-size:18px; vertical-align:baseline; color:#343434; }
.it_newpro_tit span b{ color:#ec1d28; }
.it_newpro_tit img { width:35px; vertical-align:-8px; margin-right:5px; }
</style>


<div class="it_newpro_tit"><img src="/skin/m_demo/img/time.png"><span><b>마감</b>전까지 <span id='countdown'><span></span> : <span></span> : <span></span></span> 남음</span></div>


<ul class="item_list3">
<?
$sql = " select * from nfor_item where it_paydate <='$nfor[ymdhis]' and it_payenddate >='$nfor[ymdhis]' and it_view='0' order by rand() limit 100";
$result = sql_query($sql);

for($i=0; $item=sql_fetch_array($result); $i++){

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
			<!--<img data-original="<?=$item[it_img_l]?"$nfor[path]/data/list/$item[it_img_l]":"$nfor[path]/img/item_list_noimg.jpg"?>" alt="" class="img2 lazy">-->

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
<? } ?>
</ul>


