<?
include_once "path.php";

$wr_category = sql_fetch("select * from nfor_item_category where category_id='$category_id'");
$best_title = $wr_category[wr_category];
?>





<!-- 인덱스배너3 -->

<div class="best_category_wrap">

	<ul class="best_category">
		<li><a data-category_id=""><p <? if(!$category_id){ ?>class="ov"<? } ?>>전체보기</p></a></li>
	<?
	$que = sql_query("select * from nfor_item_category where wr_depth='0' and wr_use='1'");
	while($data = sql_fetch_array($que)){
	?>
		<li><a data-category_id="<?=$data[category_id]?>"><p <? if($data[category_id]==$category_id){ ?>class="ov"<? } ?>><?=$data[wr_category]?></p></a></li>
	<? 
	}
	?>
	</ul>

</div>

<style>
.best_category_wrap { padding:10px; }
.best_category { width:100%; overflow:hidden; border-bottom:solid 1px #f7f7f7; box-sizing:border-box; }
.best_category li{ float:left; width:33.3333%; text-align:center; background-color:#fff; margin:0px 0px 0px -1px; border-left:solid 1px #f7f7f7; border-top:solid 1px #f7f7f7; height:36px; line-height:36px;  }
.best_category li p { color:#777; font-size:13px; } 
.best_category li p.ov { color:#ec3940; font-size:13px; } 

.best_category:after { display:block; clear:both; content:''; }
</style>
<!-- 인덱스배너3 -->







<div class="best_title"><?=$best_title?$best_title." ":""?>베스트 TOP 100</div>
<style>
.best_title { padding:0px 10px; font-size:14px; color:#555; font-weight:bold; letter-spacing:-1px; }
</style>







<ul class="item_list2">
<?
$sql_common = " from nfor_item ";
$sql_search = " where it_paydate <='$nfor[ymdhis]' and it_payenddate >='$nfor[ymdhis]' and it_view='0' ";
if($category_id){
	$sql_search .= category_sql($category_id);
}
if($config[cf_best]=="1"){
	$sst = "it_best";
} else{
	$sst = "it_sales_volume";
}
$sod = "desc";
$sql_order = " order by $sst $sod ";
$sql = " select *
				  $sql_common
				  $sql_search
				  $sql_order
				  limit 100 ";
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
			<div class="rank"><?=$i+1?></div>

			<img data-original="<?=$item[it_img_l_m]?"$nfor[path]/data/list_m/$item[it_img_l_m]":"$nfor[path]/img/item_list_noimg.jpg"?>" alt="" class="img1 lazy">
			<img data-original="<?=$item[it_img_l]?"$nfor[path]/data/list/$item[it_img_l]":"$nfor[path]/img/item_list_noimg.jpg"?>" alt="" class="img2 lazy">

			<ul class="icon_wrap">
				<li class="ico1"><?=delivery_type($item)?></li>
				<li class="ico2">쿠폰할인</li>
			</ul>
		</div>
		<div class="it_description"><?=$item[it_description]?></div>
		<div class="it_name"><?=$item[it_name]?></div>
		<div class="price_wrap">
			<span class="it_discount_rate"><?=$item[it_discount_rate]?><b>%</b></span>
			<div class="it_price">
				<div class="it_price1"><?=number_format($item[it_price1])?><span>원</span></div>
				<div class="it_price2"><?=number_format($item[it_price2])?><span>원</span></div>
			</div>
			<div class="it_sales_volume"><b><?=number_format($item[it_sales_volume])?></b>개 구매</div>
		</div> 

	</a>

</li>
<? } ?>
</ul>


