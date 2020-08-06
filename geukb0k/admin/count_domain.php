<?php	// 도메인별
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
    <th>순위</th>
    <th>접속 도메인</th>
    <th>방문자수</th>
    <th>비율(%)</th>
    <th>그래프</th>
</tr> 
<?
$max = 0;
$sum_count = 0;
$sql = " select * from nfor_count where wr_datetime between '$sdate' and '$edate' ";
$result = sql_query($sql);
while ($row=sql_fetch_array($result)) {
    $str = $row[wr_referer];
    preg_match("/^http[s]*:\/\/([\.\-\_0-9a-zA-Z]*)\//", $str, $match);
    $s = $match[1];
    $s = preg_replace("/^(www\.|search\.|dirsearch\.|dir\.search\.|dir\.|kr\.search\.|myhome\.)(.*)/", "\\2", $s);
    $arr[$s]++;
    if ($arr[$s] > $max) $max = $arr[$s];
    $sum_count++;
}

$i = 0;
$save_count = -1;
if (count($arr)) {
    arsort($arr);
    foreach ($arr as $key=>$value) {
        $count = $arr[$key];
        if ($save_count != $count) {
            $i++;
            $no = $i;
            $save_count = $count;
        } else {
            $no = "";
        }
        if (!$key) {
            $link = "";
            $key = "직접"; 
        } else {
            $link = "<a href='http://$key' target='_blank'>";
        }
        $rate = ($count / $sum_count * 100);
        $s_rate = number_format($rate, 1);
        $bar = (int)($count / $max * 100);
?>
<tr>
	<td><?=$no?></td>
	<td align=left><?="$link$key"?></a></td>
	<td><?=$count?></td>
	<td><?=$s_rate?></td>
	<td align="left" style="padding-right:5px;"><img src='img/graph.gif' width='<?=$bar?>%' height='18'></td>
</tr>
<?
    }
}
?>
</table>
<?
include "tail.php";
?>