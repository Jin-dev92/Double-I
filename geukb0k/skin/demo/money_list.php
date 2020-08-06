<?php	// 적립금
include_once $nfor[skin_path]."mypage_head.php";
?>


<table cellpadding="0" cellspacing="0" border="0" class="money_wrap">
<colgroup>
	<col></col>
	<col width="120"></col>
	<col width="120"></col>
	<col width="120"></col>
	<col width="120"></col>
	<col width="120"></col>
</colgroup>
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
	<td><?=$row[memo]?></td>
	<td><em><? if($row[money]>0){ ?>+<?=number_format($row[money])?>원<? } ?></em></td>
	<td><b><? if($row[money]<0){ ?><?=number_format($row[money])?>원<? } ?></b></td>
	<td><? if($row[money]>0){ ?><?=number_format($row[use_money])?>원<? } ?></td>
	<td><?=substr($row[wr_datetime],0,10)?></td>
	<td><?=substr($row[end_datetime],0,10)?></td>
</tr>
<?
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?page=");
?>
</table>

<div style="margin:0 auto; text-align:center; padding:10px;"><?=$pagelist?></div>


<?php
include_once $nfor[skin_path]."mypage_tail.php";
?>