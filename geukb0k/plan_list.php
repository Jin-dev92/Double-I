<?php
include_once "path.php";

$nfor[title] = "기획전";

$sql_common = " from nfor_plan ";
$sql_search = " where wr_use='1' and wr_sdate<='$nfor[ymdhis]' and wr_edate>='$nfor[ymdhis]' ";
if(!$sst){
	$sst = "wr_rank";
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

include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>