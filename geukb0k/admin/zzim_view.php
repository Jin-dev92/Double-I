<?php
include "path.php";
$qstr .= "&it_id=$it_id&it_type=$it_type&area_id=$area_id&category_id=$category_id";

$sql_common = " from nfor_zzim a, nfor_member b ";
$sql_search = " where a.it_id='$it_id' and a.mb_no=b.mb_no ";

if($stx) $sql_search .= " and $sfl like '%$stx%' ";

if(!$sst){
    $sst = "a.wr_id";
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

$item = sql_fetch("select * from nfor_item where it_id='$it_id'");

include "head.php";
?>				




<table class="tbl_type" border="1" cellspacing="0">
<colgroup>
<col width="180" align="center">
<col align="left"style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th>상품명</th>
	<td><a href="<?=$nfor[load]?>?it_id=<?=$item[it_id]?>" target="_blank"><?=$item[it_name]?></a></td>
</tr>
<tr>
	<th>판매일자</th>
	<td><?=$item[it_paydate]?> ~ <?=$item[it_payenddate]?></td>
</tr>
<tr>
	<th>정상가격</th>
	<td><?=number_format($item[it_price1])?>원</td>
</tr>
<tr>
	<th>판매가격</th>
	<td><?=number_format($item[it_price2])?>원</td>
</tr>
<tr>
	<th>할인조건</th>
	<td><?=number_format($item[it_discount_want])?>명 이상 <?=$item[it_discount_rate]?>% 할인</td>
</tr>
</table>	

<br>	

<table class="tbl_typeB">
<tr align="center">
	<th width="20%">번호</th>	
	<th width="20%">아이디</th>
	<th width="20%">이름</th>
	<th width="20%">등록일자</th>
	<th width="20%">상세정보</th>
</tr>
<?
for($i=0; $row=sql_fetch_array($result); $i++){
	$row[num] = $total_count - ($page - 1) * $config[cf_page_rows] - $i;
?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
	<td><?=$row[num]?></td>
	<td><a href="javascript:member('<?=$row[mb_no]?>')"><?=$nfor[id_type]=="mb_email"?$row[mb_email]:$row[mb_id]?></a></td>
	<td><a href="javascript:member('<?=$row[mb_no]?>')"><?=$row[mb_name]?></a></td>
	<td><?=$row[wr_datetime]?></td>
	<td><a href="javascript:member('<?=$row[mb_no]?>')"><img src="img/sang_btn.jpg" alt="상세정보"></a></td>
</tr>
<?
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<div class="btn_cen"><?=$pagelist?></div>
<div class="btn_cen"><a href="zzim_list.php?<?=$qstr?>"><img src="img/list.gif" alt="목록보기"></a></div>

<?
include "tail.php";
?>
