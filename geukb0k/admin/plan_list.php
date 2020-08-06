<?php	// 상품리스트
include "path.php";


if($mode=="list_delete"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		$plan = sql_fetch("select * from nfor_plan where wr_id='{$_POST['wr_id'][$k]}'");
		@unlink($nfor[path]."/data/plan/".$plan[wr_img]);
		sql_query("delete from nfor_plan where wr_id='{$_POST['wr_id'][$k]}'");
	}
	alert("정상적으로 삭제되었습니다.","plan_list.php?$qstr");
	exit;
}

if($mode=="delete"){

	$plan = sql_fetch("select * from nfor_plan where wr_id='$wr_id'");
	if(!$plan[wr_id]) alert("존재하지 않는 상품입니다");
	sql_query("delete from nfor_plan where wr_id='$wr_id'");

	alert("정상적으로 삭제되었습니다.","plan_list.php?$qstr");
	exit;
}




$sql_common = " from nfor_plan ";
$sql_search = " where 1 ";

if($stx) $sql_search .= " and $sfl like '%$stx%' ";

if(!$sst){
    $sst = "wr_id";
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


include "head.php";
?>				
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td height="50">

	</td>
	<td>
	<form name="fsearch" method="get">
	<p align="right">
	<select name="sfl">
	<?
	$sfl_txt_array = array("기획전명");
	$sfl_val_array = array("wr_subject");
	for($i=0; $i<count($sfl_txt_array); $i++){
	?>
	<option value="<?=$sfl_val_array[$i]?>" <? if($sfl==$sfl_val_array[$i]) echo "selected"; ?>><?=$sfl_txt_array[$i]?>
	<? } ?>
	</select>
	<input type="text" name="stx" value="<?=$stx?>">
	<input type="image" src="img/gum_btn.gif" align="absmiddle">
	</form>
	</td>
</TR>
</table>

<form name="flist" id="flist" method="post">
<input type="hidden" name="mode" id="mode">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<table class="tbl_typeB">
<tr align="center">	
	<th width="40"><input type="checkbox" name="chkall" value="1" onclick="check_all(this.form)"></th>
	<th>기획전 이미지</td>
	<th>기획전명</th>
	<th>노출기간</th>
	<th>노출여부</th>
	<th>정렬순위</th>

	<th>수정</th>	
	<th>삭제</th>
</tr>
<?
for($i=0; $row=sql_fetch_array($result); $i++){
?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">	
	<td><input type="checkbox" name="chk[]" value="<?=$i?>"><input type="hidden" name="wr_id[<?=$i?>]" value="<?=$row[wr_id]?>"></td>
	<td><a href="<?=$nfor[path]?>/plan.php?wr_id=<?=$row[wr_id]?>" target="_blank"><img src="<?=$nfor[path]?>/data/plan/<?=$row[wr_img]?>" height="60"></a></td>
	<td><a href="<?=$nfor[path]?>/plan.php?wr_id=<?=$row[wr_id]?>" target="_blank"><?=$row[wr_subject]?></a></td>

	<td><?=$row[wr_sdate]?>~<?=$row[wr_edate]?></td>
	<td><?=$row[wr_use]?"예":"아니오"?></td>
	<td><?=$row[wr_rank]?></td>


	<td><a href="plan_form.php?wr_id=<?=$row[wr_id]?>"><img src='img/su_btn.gif' alt='수정'></a></td>
	<td><a href="javascript:del('plan_list.php?mode=delete&wr_id=<?=$row[wr_id]?>')"><img src='img/del_btn.gif' alt='삭제'></a></td>
</tr>
<?
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<div class="btn_cen"><?=$pagelist?></div>
<div class="btn_cen"><a href="javascript:nfor_list('삭제','list_delete')"><img src="img/sun_del.gif" alt="선택삭제"></a> <a href="plan_form.php"><img src="img/dong_btn.gif"></a></div>

</form>
<?
include "tail.php";
?>
