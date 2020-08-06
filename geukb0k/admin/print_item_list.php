<?php	// 상품리스트
include_once "path.php";

include_once "inc_item_update.php";

include_once "head.php";
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
<table class="tbl_typeB">
<tr align="center">
	<th width="40"><input type="checkbox" name="chkall" value="1" onclick="check_all(this.form)"></th>
	<th>상품코드</th>
	<th>판매기간</th>
	<th>상품이미지</td>
	<th>상품정보</th>
	<th>판매가격</th>
	<th>할인정보</th>
	<th>재고량</th>
	<th>판매량</th>
	<th>미노출</th>
	<th>베스트 상품</th>
	<th>추천 상품</th>
	<th>오늘의 상품</th>
	<th>카테고리</th>
	<th>모바일메인추출</th>
	<th>여분</th>
	<th>여분</th>
</tr>
<?
for($i=0; $row=sql_fetch_array($result); $i++){
?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#ffffff">
	<td><input type="checkbox" name="chk[]" value="<?=$i?>"><input type="hidden" name="it_id[<?=$i?>]" value="<?=$row[it_id]?>"></td>
	<td><?=$row[it_id]?></td>
	<td><?=substr($row[it_paydate],0,10)?><br><?=substr($row[it_payenddate],0,10)?></td>
	<td><a href="<?="$nfor[path]/$nfor[load]"?>?it_id=<?=$row[it_id]?>&<?=$qstr?>" target="_blank"><img src="<?=thumbnail("$nfor[path]/data/list/$row[it_img_l]","100","","0","1")?>" width="100"></a></td>
	<td style="text-align:left; padding-left:10px;">
	<?=$row[it_name]?><br><br>
	<?
	if(trim($row[it_category])){
	$it_category_exp = explode("_",trim($row[it_category]));
	for($k=0; $k<count($it_category_exp)-1; $k++){
		$cate_id = $it_category_exp[$k];
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
	<td><?=number_format(($row[it_sales_volume]))?>개</td>
	<td><input type="checkbox" name="it_view[<?=$i?>]" class="check_view" value="<?=$row[it_view]?>" <?=$row[it_view]==1?"checked":""?>></td>
	<td><input type="text" class="input_txt" name="it_hit[<?=$i?>]" value="<?=$row[it_hit]?>" size="4"></td>
	<td><input type="text" class="input_txt" name="it_good[<?=$i?>]" value="<?=$row[it_good]?>" size="4"></td>
	<td><input type="text" class="input_txt" name="it_new[<?=$i?>]" value="<?=$row[it_new]?>" size="4"></td>
	<td><input type="text" class="input_txt" name="it_hot[<?=$i?>]" value="<?=$row[it_hot]?>" size="4"></td>
	<td><input type="text" class="input_txt" name="it_rank[<?=$i?>]" value="<?=$row[it_rank]?>" size="4"></td>
	<td><input type="text" class="input_txt" name="it_set[<?=$i?>]" value="<?=$row[it_set]?>" size="4"></td>
	<td><input type="text" class="input_txt" name="it_best[<?=$i?>]" value="<?=$row[it_best]?>" size="4"></td>
</tr>
<?
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<div class="btn_cen"><a href="javascript:nfor_list('수정','list_update')"><img src="img/sun_update.jpg" alt="선택수정"></a></div>
<div class="btn_cen"><?=$pagelist?></div>
</form>
<script type="text/javascript">
	$('.check_view').click(function(){
		if($(this).val()=='0'){
			$(this).val('1');
		} else 
			$(this).val('0');
	});
</script>
<?
include "tail.php";
?>