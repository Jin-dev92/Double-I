<?php	// 시간별
include "path.php";
include "head.php";

if(!$sdate) $sdate = date("Y-m-d");
if(!$edate) $edate = date("Y-m-d");

$sdate="$sdate 00:00:00";
$edate="$edate 23:59:59";
?>
<script type="text/javascript">
jQuery(function($){
	$.datepicker.regional['ko'] = {
		closeText: '닫기',
		prevText: '이전달',
		nextText: '다음달',
		currentText: '오늘',
		monthNames: ['1월(JAN)','2월(FEB)','3월(MAR)','4월(APR)','5월(MAY)','6월(JUN)',
		'7월(JUL)','8월(AUG)','9월(SEP)','10월(OCT)','11월(NOV)','12월(DEC)'],
		monthNamesShort: ['1월','2월','3월','4월','5월','6월',
		'7월','8월','9월','10월','11월','12월'],
		dayNames: ['일','월','화','수','목','금','토'],
		dayNamesShort: ['일','월','화','수','목','금','토'],
		dayNamesMin: ['일','월','화','수','목','금','토'],
		weekHeader: 'Wk',
		dateFormat: 'yy-mm-dd',
		firstDay: 0,
		isRTL: false,
		showMonthAfterYear: true,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['ko']);

	$(function() {
		var dates = $( "#sdate, #edate" ).datepicker({
			showOn: 'button',
			buttonImage: 'img/calendar.gif',
			buttonImageOnly: true,
			buttonText: "달력",
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 1,
			onSelect: function( selectedDate ) {
				var option = this.id == "edate" ? "maxDate" : "minDate",
					instance = $( this ).data( "datepicker" );
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
	});
});
</script>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td height="50" align="right">
	<form method="get" action="<?=$_SERVER[PHP_SELF]?>">
	<input type=text class="border" NAME="sdate" id="sdate" value="<?=substr($sdate,0,10)?>" style="width:70px;"> ~ <input type=text class="border" NAME="edate" id="edate" value="<?=substr($edate,0,10)?>" style="width:70px;">
	<input type="image" src="img/jo_btn.gif" value="조회하기" align="absmiddle">
	</form>
	</td>
</tr>
</table>

<table border="0" cellspacing="0" class="tbl_typeB">
<tr>
    <th>시간</td>
    <th>방문자수</th>
    <th>비율(%)</th>
    <th>그래프</th>
</tr>
<?
$max = 0;
$sum_count = 0;
$sql = " select SUBSTRING(wr_datetime,12,2) as wr_hour, count(wr_id) as cnt from nfor_count where wr_datetime between '$sdate' and '$edate' group by wr_hour order by wr_hour ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$arr[$row[wr_hour]] = $row[cnt];
    if ($row[cnt] > $max) $max = $row[cnt];
    $sum_count += $row[cnt];
}

for($i=0; $i<24; $i++) {
	$hour = sprintf("%02d", $i);
	$count = (int)$arr[$hour];
?>
<tr>
	<td><?=$hour?>시</td>
	<td><?=number_format($count)?>명</td>
	<td><?=number_format(@($count / $sum_count * 100), 1)?>%</td>
	<td align="left" style="padding-right:5px;"><img src='img/graph.gif' width='<?=(int)($count / $max * 100)?>%' height='18'></td>
</tr>
<? } ?>
</table>
<?
include "tail.php";
?>