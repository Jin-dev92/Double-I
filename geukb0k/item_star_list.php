<?php	// 상품평
include_once "path.php";

$sql_common = " from nfor_item_star ";
$sql_search = " where it_id='$it_id' and wr_datetime <= '$nfor[ymdhis]' and wr_reply='0' and wr_view='0' ";

if($wr_type=="best"){
	$sql_search .= " and wr_best > 0 ";
} elseif($wr_type=="photo"){
	$sql_search .= " and wr_img <> '' ";
} else{
	
}

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
$rows = 20;
$total_page  = ceil($total_count / $rows);
if(!$page) $page = 1;
$from_record = ($page - 1) * $rows;
$sql = " select *
				  $sql_common
				  $sql_search
				  $sql_order
				  limit $from_record, $rows ";
$result = sql_query($sql);

$item = sql_fetch("select * from nfor_item where it_id='$it_id'");

include_once $nfor[skin_path]."item_star_list.php";
?>