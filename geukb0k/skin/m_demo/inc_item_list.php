<?
include_once "path.php";

if($sort=="1"){
	$sst = "it_hit";
	$sod = "desc";
} elseif($sort=="2"){
	$sst = "it_paydate";
	$sod = "desc";
} elseif($sort=="3"){
	$sst = "it_payenddate";
	$sod = "asc";
} elseif($sort=="4"){
	$sst = "it_price2";
	$sod = "asc";
} elseif($sort=="5"){
	$sst = "it_price2";
	$sod = "desc";
} else{
	$sst = "it_hit";
	$sod = "desc";
}

$sql_common = " from nfor_item ";
$sql_search = " where it_paydate <='$nfor[ymdhis]' and it_payenddate >='$nfor[ymdhis]' and it_view='0' ";

if($_GET[category_id]){
	$sql_search .= category_sql($_GET[category_id]);
}

$sql_order = " order by $sst $sod ";
$sql = " select count(*) as cnt
						$sql_common
						$sql_search
						$sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];
$rows = 100;
$total_page  = ceil($total_count / $rows);
if(!$page) $page = 1;
$from_record = ($page - 1) * $rows;
$sql = " select *
				$sql_common
				$sql_search
				$sql_order  limit $from_record, $rows "; 
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
			<img src="<?=$item[it_img_l_m]?"$nfor[path]/data/list_m/$item[it_img_l_m]":"$nfor[path]/img/item_list_noimg.jpg"?>" alt="" class="img2 lazy">

			<ul class="icon_wrap">
				<li class="ico1"><?=delivery_type($item)?></li>
			</ul>
		</div>
		<span class="it_title" style="line-height:10px; color:rgba(212, 147, 89, 0.92); font-size:14px;">[&nbsp;<?=$row2[wr_category]?><?=$row[wr_name]?>&nbsp;]</span>
		<div class="it_description"><?=$item[it_description]?></div>
		<div class="it_name"><?=$item[it_name]?></div>
		
		<div class="price_wrap">
		
			<!--<span class="it_discount_rate"><?=$item[it_discount_rate]?><b>%</b></span>-->
		
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