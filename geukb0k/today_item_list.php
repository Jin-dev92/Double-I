<?php
include_once "path.php";

$sql_common = " from nfor_item ";
$sql_search = " where it_paydate <='$nfor[ymdhis]' and it_payenddate >='$nfor[ymdhis]' and it_view='0' and it_hot>0";
if(!$sst){
	$sst = "it_hot";
	$sod = "desc";
}
$sql_order = " order by $sst $sod ";
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

$nfor[title] = "오늘의상품";

include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>