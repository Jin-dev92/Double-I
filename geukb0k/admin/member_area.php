<?php	// 나이통계
include "path.php";

$k = 0;
$que = sql_query("select * from `nfor_zipcode` group by sido order by zipcode");
while($data = sql_fetch_array($que)){

	$m_age = sql_fetch("select count(*) as cnt from nfor_member where mb_sex='M' and mb_addr1 like '$data[sido]%'");
	$f_age = sql_fetch("select count(*) as cnt from nfor_member where mb_sex='F' and mb_addr1 like '$data[sido]%'");
	$row[$k][sido] = $data[sido];
	$row[$k][m] = $m_age[cnt];
	$row[$k][f] = $f_age[cnt];
	$row[$k][total] = $m_age[cnt]+$f_age[cnt];


	$total_m += $m_age[cnt];
	$total_f += $f_age[cnt];
	
	$k++;
}

include "head.php";
?>

<table border="0" cellspacing="0" class="tbl_typeB">
<tr>
    <th>지역</td>
    <th>남자</th>
    <th>여자</th>
    <th>합산</th>
</tr>
<?
for($i=0; $i<$k; $i++){
?>
<tr>
	<td><?=$row[$i][sido]?></td>
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