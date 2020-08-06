<?php
include "path.php";

$nfor[title] = "찜한상품";

if(!$member[mb_no]) goto_url("login.php?url=zzim_list.php");

if($mode=="delete"){
	sql_query("delete from nfor_zzim where wr_id='$wr_id' and mb_no='$member[mb_no]'");
	goto_url("$PHP_SELF");
	exit;
}

$sql_common = " from nfor_zzim ";
$sql_search = " where mb_no='$member[mb_no]' ";
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