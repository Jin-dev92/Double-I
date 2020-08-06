<?php	// 상품분류설정
include "path.php";

if($mode=="list_update"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		sql_query("update nfor_item_category set wr_rank='{$_POST['wr_rank'][$k]}', 
										wr_use='{$_POST['wr_use'][$k]}',
										wr_category='{$_POST['wr_category'][$k]}'
										where wr_id='{$_POST['wr_id'][$k]}'");
	}
	alert("정상적으로 수정되었습니다","item_category_list.php?$qstr");
	exit;
}

if($mode=="list_delete"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		sql_query("delete from nfor_item_category where wr_id='{$_POST['wr_id'][$k]}'");
	}
	alert("정상적으로 삭제되었습니다","item_category_list.php?$qstr");
	exit;
}

if($mode=="delete"){
	sql_query("delete from nfor_item_category where wr_id='$wr_id'");
	alert("정상적으로 삭제되었습니다","item_category_list.php?$qstr");
	exit;
}

$sql_common = " from nfor_item_category ";
$sql_search = " where 1 ";



if($depth_id){
	$exp = explode("_",$depth_id);
	$depth_id = $exp[count($exp)-1];
	$sql_search .= " and depth_id = '$depth_id'";
} else{
	$sql_search .= " and depth_id =''";
}


if($stx) $sql_search .= " and $sfl like '%$stx%' ";
if (!$sst) {
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

include "head.php";
?>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td height="50">
	<form name="search" method="get" action="item_category_list.php">




		<select name="depth_id" onchange="search.submit()">
			<option value="">상품분류
			<? 
			$que = sql_query("select * from nfor_item_category order by category_id, wr_rank desc");
			while($data = sql_fetch_array($que)){
			?>
			<option value="<?=$data[wr_id]?>" <? if($data[wr_id]==$depth_id) echo "selected"; ?>>
			<?
			if($data[depth_id]){
				for($i=0; $i<$data[wr_depth]; $i++){
					echo "└";	
				}
			}
			echo " ".$data[wr_category];
			?>
			<? } ?>
		</select>






	</form>
	</td>
	<td height="50" align="right">
	<form name="fsearch" method="get">
	<input type="hidden" name="depth_id" value="<?=$depth_id?>">
	<select name="sfl">
	<?
	$sfl_txt_array = array("분류이름");
	$sfl_val_array = array("wr_category");
	for($i=0; $i<count($sfl_txt_array); $i++){
	?>	
	<option value="<?=$sfl_val_array[$i]?>" <? if($sfl==$sfl_val_array[$i]) echo "selected"; ?>><?=$sfl_txt_array[$i]?>
	<? } ?>
	</select>
	<input type="text" name="stx" value="<?=$stx?>">
	<input type="image" src="img/gum_btn.gif" align="absmiddle">
	</form>
	</td>
</tr>
</table>

<form name="flist" id="flist" method="post" action="item_category_list.php">
<input type="hidden" name="mode" id="mode">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="depth_id" value="<?=$depth_id?>">
<table border="1" cellspacing="0" class="tbl_typeB">
<tr>
	<th scope="col"><input type="checkbox" name="chkall" value="1" onclick="check_all(this.form)"></td>
	
	<th scope="col">출력순위</th>
	<th scope="col">노출여부</th>
	<th scope="col">분류이름</th>




	<th scope="col">생성</th>
	<th scope="col">상세</th>

	<th scope="col">수정</th>
	<th scope="col">삭제</th>
</tr>
<? 
for($i=0; $row=sql_fetch_array($result); $i++){
?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
	<td><input type="checkbox" name="chk[]" value="<?=$i?>"><input type="hidden" name="wr_id[<?=$i?>]" value="<?=$row[wr_id]?>"></td>
	<td><input type="text" name="wr_rank[<?=$i?>]" value="<?=abs($row[wr_rank])?>" class="input_txt" style="width:30px;"></td>
	<td><input type="checkbox" name="wr_use[<?=$i?>]" value="1" <? if($row[wr_use]) echo "checked"; ?>></td>
	<td><input type="text" name="wr_category[<?=$i?>]" value="<?=$row[wr_category]?>" class="input_txt" style="width:150px;"></td>




	<td><a href="item_category_form.php?depth_id=<?=$row[wr_id]?>&<?=$qstr?>">생성</a></td>
	<td><a href="item_category_list.php?depth_id=<?=$row[wr_id]?>&<?=$qstr?>">상세</a></td>
	<td><a href="item_category_form.php?wr_id=<?=$row[wr_id]?>&<?=$qstr?>"><img src="img/su_btn.gif"></a></td>
	<td><a href="javascript:del('item_category_list.php?mode=delete&wr_id=<?=$row[wr_id]?>&<?=$qstr?>')"><img src="img/del_btn.gif"></a></td>
</tr>
<?
}
$qstr = "depth_id=$depth_id";
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<div class="btn_cen"><?=$pagelist?></div>
<div class="btn_cen">
<a href="javascript:nfor_list('수정','list_update')"><img src="img/sun_update.jpg" alt="선택수정"></a>
<a href="javascript:nfor_list('삭제','list_delete')"><img src="img/sun_del.gif" alt="선택삭제"></a>
<a href="item_category_form.php?depth_id=<?=$depth_id?>&<?=$qstr?>"><img src="img/dong_btn.gif"></a>
</div>
</form>
<?
include "tail.php";
?>