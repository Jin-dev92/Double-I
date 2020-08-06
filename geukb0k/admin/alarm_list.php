<?php
include_once "path.php";

include_once "inc_item_update.php";

include "head.php";
?>	

<?
include_once "inc_item_search.php";
?>

<form name="flist" id="flist" method="post">
<input type="hidden" name="mode" id="mode">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="area_id" value="<?=$area_id?>">
<input type="hidden" name="category_id" value="<?=$category_id?>">
<input type="hidden" name="supply_no" value="<?=$supply_no?>">	
<input type="hidden" name="it_view" value="<?=$it_view?>">
<input type="hidden" name="it_state" value="<?=$it_state?>">	
<table class="tbl_typeB">
<tr align="center">	
	<th>상품코드</th>
	<th>판매기간</th>
	<th>상품이미지</td>
	<th>상품정보</th>
	<th>판매가격</th>
	<th>할인정보</th>
	<th>재고량</th>
	<th>판매량</th>
	<th>알림인원</th>	
</tr>
<?
for($i=0; $row=sql_fetch_array($result); $i++){
?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">	
	<td><?=$row[it_id]?></td>
	<td><?=substr($row[it_paydate],0,10)?><br><?=substr($row[it_payenddate],0,10)?></td>
	<td><a href="<?="$nfor[path]/$nfor[load]"?>?it_id=<?=$row[it_id]?>&<?=$qstr?>" target="_blank"><img src="<?=thumbnail("$nfor[path]/data/list/$row[it_img_l]","100","","0","1")?>" width="100"></a></td>
	<td style="text-align:left; padding-left:10px;">
	<?=$row[it_name]?><br><br>
	<?
	if(trim($row[it_category])){
	$it_category_exp = explode("_",trim($row[it_category]));
	for($i=0; $i<count($it_category_exp)-1; $i++){
		$cate_id = $it_category_exp[$i];
		$catename = sql_fetch("select * from nfor_item_category where category_id='$cate_id'");
	?>
	<?=category_id_name($cate_id)?><br>
	<?
	}
	}
	?>
	</td>
	<td><s><?=number_format($row[it_price1])?>원</s><br><?=number_format($row[it_price2])?>원</td>
	<td><?=number_format($row[it_discount_want])?>명이상<br><?=$row[it_discount_rate]?>% 할인</td>
	<td><?=number_format($row[it_stock])?>개</td>
	<td><?=number_format(it_sales_volume($row[it_id]))?>개</td>
	<td><a href="alarm_view.php?it_id=<?=$row[it_id]?>&<?=$qstr?>"><?=number_format($row[it_alarm])?>명</a></td>
</tr>
<?
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<div class="btn_cen"><?=$pagelist?></div>
</form>
<?
include "tail.php";
?>
