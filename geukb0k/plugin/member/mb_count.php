<?php	// 접속경로
include_once "path.php";
include_once "mb_head.php";

$sql_common = " from nfor_count ";
$sql_search = " where (1) ";
$sql_search .= " and wr_ip='$mb[mb_ip]' ";

$sql_order = " order by wr_id desc ";
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
	<th width="140">접속일자</th>
	<th>이전주소</th>
</tr>
<? 
for($i=0; $row=sql_fetch_array($result); $i++){
?>
<tr>
	<td style="font-size:11px;letter-spacing:-1px"><?=$row[wr_datetime]?></td>
	<td><?=$row[wr_referer]?$row[wr_referer]:"직접 또는 즐겨찾기를 통한 방문"?></td>
</tr>
<? 
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<p align="center"><?=$pagelist?></p>

<?
include "mb_tail.php";
?>