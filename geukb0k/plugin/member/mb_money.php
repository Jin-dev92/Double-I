<?php	// 적립금내역
include_once "path.php";
include_once "mb_head.php";

$sql_common = " from nfor_money a, nfor_member b ";
$sql_search = " where a.mb_no=b.mb_no ";
if($stx) $sql_search .= " and $sfl like '%$stx%' ";
if($mb_no) $sql_search .= " and a.mb_no='$mb_no' ";
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
if(!$page) $page = 1;
$from_record = ($page - 1) * $rows;
$sql = " select *
				  $sql_common
				  $sql_search
				  $sql_order
				  limit $from_record, $rows ";
$result = sql_query($sql);
?>


<table cellspacing="0" cellpadding="0" border="0" width="100%" class="order_list_tbl" align="center">
<tr>
	<th>적립내용</th>
	<th>부여적립금</th>
	<th>사용적립금</th>
	<th>남은적립금</th>
	<th>적립/사용일시</th>
	<th>만료일시</th>
</tr>
<? 
for($i=0; $row=sql_fetch_array($result); $i++){
?>
<tr>
	<td style="text-align:left; padding-left:10px;"><span class="tex02"><?=$row[memo]?></td>
	<td><? if($row[money]>0){ ?><?=number_format($row[money])?>원<? } ?></td>
	<td><? if($row[money]<0){ ?><?=number_format($row[money])?>원<? } ?></td>
	<td><? if($row[money]>0){ ?><?=number_format($row[use_money])?>원<? } ?></td>
	<td><?=$row[wr_datetime]?></td>
	<td><?=$row[end_datetime]?></td>
</tr>
<? 
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<div class="btn_cen"><?=$pagelist?></div>

<?
include "mb_tail.php";
?>