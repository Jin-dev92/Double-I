<?php	// 매출현황
include "path.php";

if(!$year) $year = date("Y");
if(!$month) $month = date("m");
if(!$day) $day = date("d");

for($i=0; $i<=23; $i++){
	$ymdh = $year.sprintf("%02d",$month).sprintf("%02d",$day).sprintf("%02d",$i);
	$sql = "select count(*) as order_cnt, sum(delivery_price) as delivery_price, sum(cancel_price) as cancel_price, sum(total_price) as total_price, sum(money_price) as money_price, sum(card_price) as card_price, sum(iche_price) as iche_price, sum(banking_price) as banking_price from nfor_order where pay_step='1' and DATE_FORMAT(od_paydatetime,'%Y%m%d%H')='$ymdh'";

	$row = sql_fetch($sql);

	$rows[$i][order_cnt] += $row[order_cnt];
	$rows[$i][money_price] += $row[money_price];
	$rows[$i][card_price] += $row[card_price];
	$rows[$i][iche_price] += $row[iche_price];
	$rows[$i][banking_price] += $row[banking_price];
	$rows[$i][total_price] += $row[total_price];
	$rows[$i][cancel_price] += $row[cancel_price];
	$rows[$i][delivery_price] += $row[delivery_price];

	$order_cnt += $row[order_cnt];
	$money_price += $row[money_price];
	$card_price += $row[card_price];
	$iche_price += $row[iche_price];
	$banking_price += $row[banking_price];
	$total_price += $row[total_price];
	$cancel_price += $row[cancel_price];
	$delivery_price += $row[delivery_price];

	if($row[total_price] > $max) $max = $row[total_price];

}


if($mode=="excel"){

	require_once "$nfor[path]/PHPExcel.php";
	$objPHPExcel = new PHPExcel();

	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue("A1", "월")
				->setCellValue("B1", "주문건수")
				->setCellValue("C1", "적립금결제금액")
				->setCellValue("D1", "카드결제금액")
				->setCellValue("E1", "계좌이체금액")
				->setCellValue("F1", "무통장금액")
				->setCellValue("G1", "합산결제금액")
				->setCellValue("H1", "취소금액")
				->setCellValue("I1", "배송금액")
				->setCellValue("J1", "PG수수료")
				->setCellValue("K1", "순매출액");

	$i = 0;
	for($k=2; $k<=25; $k++){    

		$pg_card_iche = (($rows[$i][card_price]/100)*$config[cf_pg_card])+(($rows[$i][iche_price]/100)*$config[cf_pg_iche]);

		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue("A$k", "{$year}년 {$month}월 {$day}일 {$i}시")
					->setCellValue("B$k", $rows[$i][order_cnt])			
					->setCellValue("C$k", $rows[$i][money_price])
					->setCellValue("D$k", $rows[$i][card_price])
					->setCellValue("E$k", $rows[$i][iche_price])
					->setCellValue("F$k", $rows[$i][banking_price])
					->setCellValue("G$k", $rows[$i][total_price])
					->setCellValue("H$k", $rows[$i][cancel_price])
					->setCellValue("I$k", $rows[$i][delivery_price])
					->setCellValue("J$k", $pg_card_iche)
					->setCellValue("K$k", ($rows[$i][total_price]-$rows[$i][cancel_price]-$rows[$i][delivery_price]-$pg_card_iche));
		$i++;

	}

	// 시트이름
	$objPHPExcel->getActiveSheet()->setTitle($menu_code[access_text]);

	$objPHPExcel->setActiveSheetIndex(0);

	// 파일명
	$filename = urlencode($menu_code[access_text]);

	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');

	exit;
}

include "head.php";

$qstr .= "&year=$year&month=$month&day=$day";
?>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td height="50" align="left">
	<form name="fsearch" method="get">
	<select name="year" onchange="fsearch.submit();">
	<option value="">선택
	<? for($i=date("Y")-2; $i<=date("Y"); $i++){ ?>
	<option value="<?=$i?>" <? if($i==$year) echo "selected"; ?>><?=$i?>년
	<? } ?>
	</select>
	<select name="month" onchange="fsearch.submit();">
	<option value="">선택
	<? for($i=1; $i<=12; $i++){ ?>
	<option value="<?=$i?>" <? if($i==$month) echo "selected"; ?>><?=$i?>월
	<? } ?>
	</select>
	<select name="day" onchange="fsearch.submit();">
	<option value="">선택
	<? for($i=1; $i<=31; $i++){ ?>
	<option value="<?=$i?>" <? if($i==$day) echo "selected"; ?>><?=$i?>일
	<? } ?>
	</select>

	<a href="calculate_day.php?mode=excel&<?=$qstr?>"><img src="img/ex_down.gif" alt="엑셀다운" align="absmiddle"></a>
	</form>
	</td>
</tr>
</table>

<table border="1" cellspacing="0" class="tbl_typeB">
<tr>
	<th>월</th>
	<th>주문건수</th>
	<th>적립금결제금액</th>
	<th>카드결제금액</th>
	<th>계좌이체금액</th>
	<th>무통장금액</th>
	<th>합산결제금액</th>   
	<th>취소금액</th>
	<th>배송금액</th>
	<th>PG수수료</th>
	<th>순매출액</th>
	<th width="200">그래프</th>
</tr>
<?
for($i=0; $i<=23; $i++){
	$pg_card_iche = (($rows[$i][card_price]/100)*$config[cf_pg_card])+(($rows[$i][iche_price]/100)*$config[cf_pg_iche]);
	$pg_card_iche_price += $pg_card_iche;
?>
<tr>
	<td><?=$year?>년 <?=$month?>월 <?=$day?>일 <?=$i?>시</td>
	<td><?=number_format($rows[$i][order_cnt])?>건</td>
	<td><?=number_format($rows[$i][money_price])?>원</td>
	<td><?=number_format($rows[$i][card_price])?>원</td>
	<td><?=number_format($rows[$i][iche_price])?>원</td>
	<td><?=number_format($rows[$i][banking_price])?>원</td>
	<td><?=number_format($rows[$i][total_price])?>원</td>
	<td><?=number_format($rows[$i][cancel_price])?>원</td>
	<td><?=number_format($rows[$i][delivery_price])?>원</td>
	<td><?=number_format($pg_card_iche)?>원</td>
	<td><?=number_format($rows[$i][total_price]-$rows[$i][cancel_price]-$rows[$i][delivery_price]-$pg_card_iche)?>원</td>
	<td align="left"><img src='img/graph.gif' width='<?=(int)($rows[$i][total_price] / $max * 100)?>%' height='18'></td>
</tr>
<? 
}
?>
<tr>
	<td><?=$year?>년 <?=$month?>월 <?=$day?>일 전체</td>
	<td><?=number_format($order_cnt)?>건</td>
	<td><?=number_format($money_price)?>원</td>
	<td><?=number_format($card_price)?>원</td>
	<td><?=number_format($iche_price)?>원</td>
	<td><?=number_format($banking_price)?>원</td>
	<td><?=number_format($total_price)?>원</td>
	<td><?=number_format($cancel_price)?>원</td>
	<td><?=number_format($delivery_price)?>원</td>
	<td><?=number_format($pg_card_iche_price)?>원</td>
	<td><?=number_format($total_price-$cancel_price-$delivery_price-$pg_card_iche_price)?>원</td>
	<td></td>
</tr>
</table>




<?
include "tail.php";
?>