<?php	// 매출현황
include "path.php";




include "head.php";
?>



판매수량 상위
<table border="0" cellspacing="0" class="tbl_typeB">
<tr>
	<th>상품코드</th>
	<th>판매수량</th>
	<th>판매합산</th>
	<th>정산합산</th>
</tr>
<?	
$sql_common = " from nfor_cart a, nfor_order b ";
$sql_search = " where a.cart_id=b.cart_id and b.pay_step='1' ";
if($od_sdate and $od_edate)  $sql_search .= " and date_format(od_paydatetime,'%Y-%m-%d')>='$od_sdate' and date_format(od_paydatetime,'%Y-%m-%d')<='$od_edate' ";
if($stx) $sql_search .= " and $sfl like '%$stx%' ";

$sql_search .= " group by a.it_id";

if(!$sst){
	$sst = "sum(option_cnt)";
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
$sql = " select it_id, sum(option_cnt) as option_cnt_s, sum(option_price*option_cnt) as option_price_s, sum(supply_price*option_cnt) as supply_price_s 
			  $sql_common
			  $sql_search
			  $sql_order";

$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++){	
?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
	<td><?=$row[it_id]?></td>
	<td><?=number_format($row[option_cnt_s])?>개</td>
	<td><?=number_format($row[option_price_s])?>원</td>
	<td><?=number_format($row[supply_price_s])?>원</td>
</tr>
<?
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<div class="btn_cen"><?=$pagelist?></div>















판매합산 상위
<table border="0" cellspacing="0" class="tbl_typeB">
<tr>
	<th>상품코드</th>
	<th>판매수량</th>
	<th>판매합산</th>
	<th>정산합산</th>
</tr>
<?	
$sql_common = " from nfor_cart a, nfor_order b ";
$sql_search = " where a.cart_id=b.cart_id and b.pay_step='1' ";
if($od_sdate and $od_edate)  $sql_search .= " and date_format(od_paydatetime,'%Y-%m-%d')>='$od_sdate' and date_format(od_paydatetime,'%Y-%m-%d')<='$od_edate' ";
if($stx) $sql_search .= " and $sfl like '%$stx%' ";

$sql_search .= " group by a.it_id";

if(!$sst){
	$sst = "sum(option_price*option_cnt)";
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
$sql = " select it_id, sum(option_cnt) as option_cnt_s, sum(option_price*option_cnt) as option_price_s, sum(supply_price*option_cnt) as supply_price_s 
			  $sql_common
			  $sql_search
			  $sql_order";

$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++){	
?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
	<td><?=$row[it_id]?></td>
	<td><?=number_format($row[option_cnt_s])?>개</td>
	<td><?=number_format($row[option_price_s])?>원</td>
	<td><?=number_format($row[supply_price_s])?>원</td>
</tr>
<?
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<div class="btn_cen"><?=$pagelist?></div>







일별 판매합산 상위
<table border="0" cellspacing="0" class="tbl_typeB">
<tr>
	<th>날짜</th>
	<th>상품코드</th>
	<th>판매수량</th>
	<th>판매합산</th>
	<th>정산합산</th>
</tr>
<?	
$sql_common = " from nfor_cart a, nfor_order b ";
$sql_search = " where a.cart_id=b.cart_id and b.pay_step='1' ";
if($od_sdate and $od_edate)  $sql_search .= " and date_format(od_paydatetime,'%Y-%m-%d')>='$od_sdate' and date_format(od_paydatetime,'%Y-%m-%d')<='$od_edate' ";
if($stx) $sql_search .= " and $sfl like '%$stx%' ";

$sql_search .= " group by date_format(b.od_paydatetime,'%Y-%m-%d'), a.it_id";

if(!$sst){
	$sst = "date_format(b.od_paydatetime,'%Y-%m-%d')";
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
$sql = " select date_format(b.od_paydatetime,'%Y-%m-%d') as paydate, it_id, sum(option_cnt) as option_cnt_s, sum(option_price*option_cnt) as option_price_s, sum(supply_price*option_cnt) as supply_price_s 
			  $sql_common
			  $sql_search
			  $sql_order";

$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++){	
?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
	<td><?=$row[paydate]?></td>
	<td><?=$row[it_id]?></td>
	<td><?=number_format($row[option_cnt_s])?>개</td>
	<td><?=number_format($row[option_price_s])?>원</td>
	<td><?=number_format($row[supply_price_s])?>원</td>
</tr>
<?
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<div class="btn_cen"><?=$pagelist?></div>








결제수단별 매출통계





<?
include "tail.php";
?>