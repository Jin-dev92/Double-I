<?php // 상품코드검색
include_once "path.php";
include_once "$nfor[path]/html_head.php";

$qstr .= "&key=$key";

$sql_common = " from nfor_item_category ";
$sql_search = " where (1) ";
if($stx) $sql_search .= " and $sfl like '%$stx%' ";
if(!$sst){
	$sst = "wr_id";
	$sod = "desc";
}
$sql_order = " order by $sst $sod ";
$sql = " select count(*) as cnt
						 $sql_common
						 $sql_search
						 $sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];
$rows = 10;
$total_page  = ceil($total_count / $rows);
if(!$page) $page = 1;
$from_record = ($page - 1) * $rows;
$sql = " select *
				  $sql_common
				  $sql_search
				  $sql_order
				  limit $from_record, $rows ";
$result = sql_query($sql);
?>

<form method="get" action="<?=$PHP_SELF?>">
<input type="hidden" name="key" value="<?=$key?>">
<select name="sfl">
	<option value="wr_category" <?=$sfl=="wr_category"?"selected":""?>>분류명
	<option value="category_id" <?=$sfl=="category_id"?"selected":""?>>분류코드
</select>
<input type="text" name="stx" value="<?=$stx?>">
<input type="submit" value="검색">
</form>

<table border="1">
<tr>
	<th>분류명</th>
	<th>분류코드</th>
	<th>선택</th>
</tr>
<?	for($i=0; $row=sql_fetch_array($result); $i++){	?>
<tr>
	<td><?=$row[wr_category]?></td>
	<td><?=$row[category_id]?></td>
	<td><input type="button" value="선택" onclick="insert_val('<?=$key?>','<?=$row[category_id]?>')"></td>
</tr>
<?
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<?=$pagelist?>

<?
include_once "$nfor[path]/html_tail.php";
?>