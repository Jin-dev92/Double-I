<?php	// 구매내역
include_once "path.php";
include_once "mb_head.php";

$sql_common = " from nfor_order ";
$sql_search = " where pay_step > 0 and mb_no='$mb[mb_no]'";
if(!$sst){
	$sst = "od_datetime";
	$sod = "desc";
}
$sql_order = " order by $sst $sod ";
$sql = " select count(*) as cnt
						$sql_common
						$sql_search
						$sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];
$rows = $config[cf_page_rows];
$total_page  = ceil($total_count / $rows);
if (!$page) $page = 1; 
$from_record = ($page - 1) * $rows;
$sql = " select *
				$sql_common
				$sql_search
				$sql_order
				limit $from_record, $rows ";
$result = sql_query($sql);
?>







<? 
for($i=0; $order=sql_fetch_array($result); $i++){
?>



	<table cellspacing="0" cellpadding="0" border="0" width="100%" class="order_list_tbl" align="center">
	<tr>
		<th>주문번호</th>
		<th>상품명 / 옵션정보</th>
		<th>상품금액</th>
		<th>배송비</th>
	</tr>
	<?
	$que = sql_query("select * from nfor_cart where cart_id='$order[cart_id]' group by it_id");
	while($cart = sql_fetch_array($que)){
		$item = sql_fetch("select * from nfor_item where it_id='$cart[it_id]'");
		$dy_price = sql_fetch("select * from nfor_dy_price where cart_id='$cart[cart_id]' and it_id='$cart[it_id]'");	
	?>
	<tr>
		<td><?=$order[od_id]?></td>
		<td>
		
			<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td style="border:0px; width:70px;"><a href="/admin/order_form.php?od_id=<?=$order[od_id]?>" target="_blank"><img src="<?=$item[it_img_l]?"$nfor[path]/data/list/$item[it_img_l]":"$nfor[path]/img/it_img_l_no.jpg"?>" style="width:50px;"></a></td>
				<td style="border:0px; text-align:left;">
				<a href="/admin/order_form.php?od_id=<?=$order[od_id]?>" style="font-weight:bold;" target="_blank"><?=$item[it_name]?></a>
				</td>
			</tr>
			</table>
		
			<table cellspacing="0" cellpadding="0" border="0" width="100%" class="tbl_ct">
			<?
			$que2 = sql_query("select * from nfor_cart where cart_id='$order[cart_id]' and it_id='$cart[it_id]'");
			while($ct = sql_fetch_array($que2)){
			?>
			<tr>				
				<td><?=$ct[option_select1]?> <?=$ct[option_select2]?> <?=$ct[option_select3]?> <?=$ct[option_select4]?></td>
				<td><?=number_format($ct[option_price])?>원</td>
				<td><?=number_format($ct[option_cnt])?>개</td>
				<td><?=number_format($ct[option_price]*$ct[option_cnt])?>원</td>
			</tr>
			<? } ?>
			</table>

		
		</td>
		<td><?
		echo number_format($dy_price[it_price])."원";
		?></td>
		<td><?
		echo $dy_price[dy_state];
		?></td>
	</tr>
	<? } ?>
	</table>


<? 
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<p align="center"><?=$pagelist?></p>








<?
include "mb_tail.php";
?>