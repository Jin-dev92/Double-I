<?
include_once "path.php";

$ct = sql_fetch("select * from nfor_cart where ct_id='$ct_id'");
$order = sql_fetch("select * from nfor_order where cart_id='$ct[cart_id]'");


if($mode=="update"){
	sql_query("update nfor_cart set ticket_used='$ticket_used' where ct_id='$ct_id'");	// 티켓사용수량변경
	sql_query("insert nfor_ticket_ea set od_id='$od_id', ct_id='$ct_id', mb_no='$member[mb_no]', ticket_used='$ticket_used', wr_datetime=NOW()"); // 로그남김
	nfor_send("ticket_use",$order[od_email],$order[od_hp],$order[mb_no],$order[od_id],$ct_id);
	alert_close_refresh("티켓상태가 변경되었습니다");
	exit;
}

include_once "$nfor[path]/html_head.php";
?>

<style>

.tbl_type,.tbl_type th,.tbl_type td{border:0}
.tbl_type{width:100%;border-bottom:1px solid #dddee2;font-family:'돋움',dotum;font-size:12px;}
.tbl_type caption{display:none}
.tbl_type th{padding:8px 0 5px 20px;border-top:1px solid #dddee2;background:#f5f7f9;color:#666;font-weight:bold;text-align:left;vertical-align:top}
.tbl_type td{padding:8px 5px 5px 12px;border-top:1px solid #dddee2;line-height:16px;vertical-align:top}
.title{font-family:'돋움',dotum;font-size:12px}

.tbl_typeB,.tbl_typeB th,.tbl_typeB td{border:0}
.tbl_typeB{width:100%;border-bottom:2px solid #dcdcdc;font-family:'돋움',dotum;font-size:12px;text-align:center;border-collapse:collapse}
.tbl_typeB caption{display:none}
.tbl_typeB tfoot{background-color:#f5f7f9;font-weight:bold}
.tbl_typeB th{padding:7px 0 4px;border-top:2px solid #dcdcdc;border-right:1px solid #dcdcdc;border-left:1px solid #dcdcdc;background-color:#f5f7f9;color:#666;font-family:'돋움',dotum;font-size:12px;font-weight:bold}
.tbl_typeB td{padding:6px 0 4px;border:1px solid #e5e5e5;color:#4c4c4c}
.tbl_typeB td.ranking{font-weight:bold}

</style>

<form method="post" action="ticket_change.php">
<input type="hidden" name="mode" value="update">
<input type="hidden" name="ct_id" value="<?=$ct[ct_id]?>">
<input type="hidden" name="od_id" value="<?=$order[od_id]?>">



<div class="s_title"><img src="img/dot.gif" align="absmiddle"><span class="tex02">주문내역</span></div>

<table class="tbl_type" border="1" cellspacing="0">
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th>주문번호</th>
	<td><?=$order[od_id]?></td>
</tr>

<tr>
	<th>티켓번호</th>
	<td><?=$ct[ticket_number]?$ct[ticket_number]:strtoupper(sql_old_password($ct[ct_id]))?></td>
</tr>
<tr>
	<th>사용자정보</th>
	<td><?=order_us($order)?></td>
</tr>
<tr>
	<th>상품명</th>
	<td><a href="<?=item_link($ct[it_id])?>" target="_blank"><?=item_name($ct[it_id])?></a></td>
</tr>
<tr>
	<th>옵션명</th>
	<td><?=option_select($ct)?></td>
</tr>
<tr>
	<th>구매수량</th>
	<td><?=number_format($ct[option_cnt])?>개</td>
</tr>
<tr>
	<th>사용수량</th>
	<td>
	<select name="ticket_used">
	<option value="">0개
	<?
	for($i=1; $i<=$ct[option_cnt]; $i++){
	?>
	<option value="<?=$i?>"><?=$i?>개
	<? } ?>
	</select>
	</td>
</tr>
</table>
<br>
<center><input type="submit" value="티켓사용수량변경"></center>
</form>

<br><br>

<div class="s_title"><img src="img/dot.gif" align="absmiddle"><span class="tex02">변경이력</span></div>
<table class="tbl_typeB">
<tr align="center">
	<th>변경아이디</th>
	<th>변경수량</td>
	<th>변경시간</th>
</tr>
<?
$que = sql_query("select * from nfor_ticket_ea where ct_id='$ct_id' order by wr_datetime desc");
while($data = sql_fetch_array($que)){
?>
<tr>
	<td><?=$data[mb_no]?></td>
	<td><?=$data[ticket_used]?></td>	
	<td><?=$data[wr_datetime]?></td>
</tr>
<? } ?>
</table>


<?
include_once "$nfor[path]/html_tail.php";
?>