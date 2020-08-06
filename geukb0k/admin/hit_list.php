<?php	// 실시간 인기순위
include "path.php";

if($mode=="list_update"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		sql_query("update nfor_item set it_hit='{$_POST['it_hit'][$k]}', it_hit_move='{$_POST['it_hit_move'][$k]}' where it_id='{$_POST['it_id'][$k]}'");
	}
	alert("정상적으로 수정되었습니다","hit_list.php?$qstr");
	exit;
}

$date = date("Y-m-d");

$sql_common = " from nfor_item ";
$sql_search = " where it_paydate<='$date' and it_payenddate>='$date' ";
$sql_search .= " and it_stock > it_sales_volume ";	// 재고가 없으면 순위에서 빠짐

if($stx) $sql_search .= " and $sfl like '%$stx%' ";
if (!$sst) {
	$sst = "it_sales_volume+it_hit";
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


include "head.php";
?>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td height="50" align="right">
	<form name="fsearch" method="get">
	<select name="sfl">
	<?
	$sfl_txt_array = array("상품이름");
	$sfl_val_array = array("it_name");
	for($i=0; $i<count($sfl_txt_array); $i++){
	?>	
	<option value="<?=$sfl_val_array[$i]?>" <? if($sfl==$sfl_val_array[$i]) echo "selected"; ?>><?=$sfl_txt_array[$i]?>
	<? } ?>
	</select>
	<input type="text" name="stx" value="<?=$stx?>">
	<input type="image" src="img/gum_btn.gif" align="absmiddle">
	</form>
	</td>
</tr>
</table>

<form name="flist" id="flist" method="post" action="hit_list.php">
<input type="hidden" name="mode" id="mode">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<table border="1" cellspacing="0" class="tbl_typeB">
<tr>
	<th width="40"><input type="checkbox" name="chkall" value="1" onclick="check_all(this.form)"></th>
	<th>순위</th>
	<th>상품명</th>
	<th>재고</th>
	<th>판매량</th>
	<th>순위조정</th>
	<th>변동</th>
	<th>원래가격</th>
	<th>판매가격</th>
	<th>할인률</th>
	<th width="100">수정</th>
</tr>
<?
for($i=0; $row=sql_fetch_array($result); $i++){ 
    $row[num] = $total_count - ($page - 1) * $config[cf_page_rows] - $i;
	$row[num] = $total_count-$row[num]+1
?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
	<td><input type="checkbox" name="chk[]" value="<?=$i?>"><input type="hidden" name="it_id[<?=$i?>]" value="<?=$row[it_id]?>"></td>
	<td><?=$row[num]?></td>
	<td><a href="<?="$nfor[path]/$nfor[load]"?>?it_id=<?=$row[it_id]?>" target="_blank"><?=$row[it_name]?></a></td>
	<td><?=number_format($row[it_stock])?>개</td>
	<td><?=number_format($row[it_sales_volume])?>개</td>	
	<td><input type="text" class="input_txt" name="it_hit[<?=$i?>]" value="<?=$row[it_hit]?>" size="4"></td>
	<td><input type="text" class="input_txt" name="it_hit_move[<?=$i?>]" value="<?=$row[it_hit_move]?>" size="4"></td>
	<td><?=number_format($row[it_price1])?>원</td>
	<td><?=number_format($row[it_price2])?>원</td>
	<td><?=$row[it_discount_rate]?>%</td>
	<td><a href="item_form.php?mode=update_form&it_id=<?=$row[it_id]?>"><img src="img/su_btn.gif" alt="수정"></a></td>
</tr>
<?
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<div class="btn_cen"><?=$pagelist?></div>
<span class="tex01">&nbsp;※ 인기순위는 기본적으로 판매량을 기준으로 결정되지만 상단에 상단에 위치한 순위조정이라는 필드를 통해서 임의 정렬이 가능합니다</span>
<div class="btn_cen"><a href="javascript:nfor_list('수정','list_update')"><img src="img/ji_btn02.gif" alt="선택수정"></a></div>
</form>

<?php
include "tail.php";
?>