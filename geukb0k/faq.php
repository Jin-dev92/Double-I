<?php
include "path.php";

$qstr = "ca_name=$ca_name";

$nfor[title] = "자주묻는질문";

$sql_common = " from nfor_faq ";
$sql_search = " where wr_view='0' ";
if($ca_name){
	$sql_search .= " and ca_name='$ca_name'";
}
if($keyword) $sql_search .= " and (wr_subject like '%$keyword%' or wr_memo like '%$keyword%' or ca_name like '%$keyword%')";

if(!$sst){
	$sst = "wr_best desc, wr_rank";
	$sod = "desc";
}

$sql_order = " order by $sst $sod ";
$sql = " select count(*) as cnt
					$sql_common
					$sql_search
					$sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];

if($ajax){
	$rows = 4;
} else{
	$rows = $config[cf_page_rows];
}


$total_page  = ceil($total_count / $rows);
if(!$page) $page = 1;
$from_record = ($page - 1) * $rows;
$sql = " select *
				$sql_common
				$sql_search
				$sql_order
				limit $from_record, $rows ";
$result = sql_query($sql);

if($ajax){
	include_once $nfor[skin_path]."faq_ajax.php";
} else{
	include_once $nfor[skin_path]."faq.php";
}
?>