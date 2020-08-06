<?php	// 좌측 리프트
include_once "path.php";
$que = sql_query("select * from nfor_banner where wr_use='1' and wr_code='right_top' and wr_sdate<='$datetime' and wr_edate>='$datetime' order by wr_rank");
$num_rows = sql_num_rows($que);
?>
<table>
<tr>
<?
while($banner = sql_fetch_array($que)){
?>
<tr>
	<td><a href="<?=$banner[wr_banner_link]?>" target="<?=$banner[wr_target]?>"><img src="<?="$nfor[path]/data/banner/$banner[wr_banner_img]"?>" alt="<?=$banner[wr_name]?>"></a></td>
</tr>
<?
}		
?>
</tr>
</table>