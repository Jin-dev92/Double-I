<?php	// 나이통계
include "path.php";

for($i=1; $i<10; $i++){

	$age = $i*10;
	$sdate = (date("Y")-($age+9))."1231";
	$edate = (date("Y")-$age)."0101";
	$m_age = sql_fetch("select count(*) as cnt from nfor_member where mb_sex='M' and mb_birth > '$sdate' and mb_birth < '$edate'");
	$f_age = sql_fetch("select count(*) as cnt from nfor_member where mb_sex='F' and mb_birth > '$sdate' and mb_birth < '$edate'");
	$row[$i][age] = $age;
	$row[$i][m] = $m_age[cnt];
	$row[$i][f] = $f_age[cnt];
	$row[$i][total] = $m_age[cnt]+$f_age[cnt];


	$total_m += $m_age[cnt];
	$total_f += $f_age[cnt];
}

include "head.php";
?>
<table border="0" cellspacing="0" class="tbl_typeB">
<tr>
    <th>연령</td>
    <th>남자</th>
    <th>여자</th>
    <th>합산</th>
</tr>
<?
for($i=1; $i<10; $i++){
?>
<tr>
	<td><?=$row[$i][age]?>대</td>
	<td><?=number_format($row[$i][m])?>명</td>
	<td><?=number_format($row[$i][f])?>명</td>
	<td><?=number_format($row[$i][total])?>명</td>	
</tr>
<? } ?>
<tr>
	<td>전체</td>
	<td><?=number_format($total_m)?>명</td>
	<td><?=number_format($total_f)?>명</td>
	<td><?=number_format($total_m+$total_f)?>명</td>	
</tr>
</table>
<?
include "tail.php";
?>