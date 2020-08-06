<?
include_once "path.php";

$sql_common = " from nfor_plan ";
$sql_search = " where wr_use='1' and wr_sdate<='$nfor[ymdhis]' and wr_edate>='$nfor[ymdhis]' ";
if(!$sst){
	$sst = "wr_rank";
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

?>
<style>
.plan_list_ul { width:100%; margin:10px 0px; }
.plan_list_ul li { position:relative; margin:0px 10px 10px 10px; }
.plan_list_ul li a { display:block; overflow:hidden; }
.plan_list_ul li img { width:100%; }
</style>

<ul class="plan_list_ul">
<?
for ($i=0; $row=sql_fetch_array($result); $i++) {
?>
<li><a href="plan.php?wr_id=<?=$row[wr_id]?>"><img src="<?="$nfor[path]/data/plan/$row[wr_img_m]"?>" class="lazy" alt="<?=$row[wr_subject]?>"></a></li>
<? } ?>
</ul>
