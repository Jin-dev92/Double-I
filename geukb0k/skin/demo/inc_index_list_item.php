<ul>
<?
for($i=0; $item=sql_fetch_array($result); $i++){

	// 판매량
	// $item[it_sales_volume] = it_change_volume($item[it_id])+it_sales_volume($item[it_id]);
	// 남은수량정의
	$item[it_stock_now] = $item[it_stock]-$item[it_sales_volume];



	if($i and $i%4==0) echo "";

	$align_number = $i%4;
	if($align_number=="0"){
	$align = "margin-right:24px;";
	} elseif($align_number=="1"){
	$align = "margin-right:24px;";
	} elseif($align_number=="2"){
	$align = "margin-right:24px;";
	} elseif($align_number=="3"){
	$align = "margin-right:0px;";
	} else{

	}

	if($item[it_new_win]){
		$item[url] = "move.php?it_id=$item[it_id]";
	} else{
		$item[url] = "item.php?it_id=$item[it_id]&category_id=$category_id";
	}
?>
<li style="<?=$align?>">

	<a href="<?=$item[url]?>" target="<?=$item[it_new_win]?"_blank":"_self"?>">

	<img src="<?=$item[it_img_l]?"$nfor[path]/data/list/$item[it_img_l]":"$nfor[path]/img/item_list_noimg.jpg"?>" alt="" class="it_img">


<?
	$sql = "select * from nfor_item_location where it_id='$item[it_id]'";
	$row = sql_fetch($sql);
?>

<?
$sql2 = "select * from  (select * from nfor_item) a , nfor_item_category where wr_depth='2' and a.category_id1 = category_id and  a.it_id='$item[it_id]'";
$row2 = sql_fetch($sql2);

?>

	<div class="it_info">
	<span class="it_title" style="line-height:10px;">[&nbsp;<?=$row2[wr_category]?><?=$row[wr_name]?>&nbsp;]</span>
	<span class="it_name" style="line-height:20px;"><?=$item[it_name]?></span>
	<span class="it_description" style="margin-top:5px;"><?=cut_str($item[it_description],60)?></span>
	<span class="it_price_info">
	<!--<span class="it_discount_rate"><?=$item[it_discount_rate]?><span>%</span></span> -->
	<? if(number_format($item[it_price2]) != 0){?>
		<span class="it_price">
		<!--<span class="it_price1"><?=number_format($item[it_price1])?><span>원</span></span> -->
			<span class="it_price2"><?=number_format($item[it_price2])?><span>원</span></span>
		</span>
		<span class="it_sales_volume"><b><?=number_format($item[it_sales_volume])?></b>개 구매</span>
	<?}?>
	</span>
	</div>
	</a>

</li>
<? } ?>
</ul>
