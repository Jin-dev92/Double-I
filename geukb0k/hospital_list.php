<?php
include_once "path.php";

?>
<?
$qstr = "category_id=$category_id";

$sql_common = " from nfor_member ";
$sql_search = " where is_supply >0 and is_supply < 10";

if($_GET[category_id]){
	$sql_search .= category_sql($_GET[category_id]);
}

if($_GET[keyword]) $sql_search .= " and (supply_name like '%$_GET[keyword]%') ";
if(!$sst){
	$sst = "mb_datetime";
	$sod = "desc";
}
$sql_order = " order by rand() ";
$sql = " select count(*) as cnt
						$sql_common
						$sql_search
						$sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];
$rows = 200;
$total_page  = ceil($total_count / $rows);
if(!$page) $page = 1;
$from_record = ($page - 1) * $rows;
$sql = " select *
				$sql_common
				$sql_search
				$sql_order
				limit $from_record, $rows ";
$result = sql_query($sql);

$wr_category = sql_fetch("select * from nfor_item_category where category_id='".substr($category_id,0,6)."'");
$nfor[title] = $wr_category[wr_category];
include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>
