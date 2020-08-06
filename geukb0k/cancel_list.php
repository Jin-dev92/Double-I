<?php	// 취소목록
include_once "path.php";

$nfor[title] = "취소/반품 현황";

if(!$member[mb_no]) goto_url("login.php?url=cancel_list.php");

$sql_common = " from nfor_order ";
$sql_search = " where od_view='0' and pay_step>'0' and is_cancel='1' and mb_no='$member[mb_no]' ";

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
if(!$page) $page = 1;
$from_record = ($page - 1) * $rows;
$sql = " select *
				  $sql_common
				  $sql_search
				  $sql_order
				  limit $from_record, $rows ";
$result = sql_query($sql);

include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>