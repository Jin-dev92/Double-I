<?php	// 관리자메뉴설정
include "path.php";

$qstr .= "&gp_id_select=$gp_id_select&access_code_select=$access_code_select";

if($mode=="list_update"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		sql_query("update nfor_access set access_rank='{$_POST['access_rank'][$k]}',
										  gp_id='{$_POST['gp_id'][$k]}',
										  access_text='{$_POST['access_text'][$k]}',
										  access_file='{$_POST['access_file'][$k]}',
										  access_level='{$_POST['access_level'][$k]}'
								where access_id='{$_POST['access_id'][$k]}'");
	}
	alert("정상적으로 수정되었습니다","admin_menu_list.php?$qstr");
	exit;
}

if($mode=="list_delete"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		sql_query("delete from nfor_access where access_id='{$_POST['access_id'][$k]}'");
	}
	alert("정상적으로 삭제되었습니다","admin_menu_list.php?$qstr");
	exit;
}

if($mode=="delete"){
	sql_query("delete from nfor_access where access_id='$access_id'");
	alert("정상적으로 삭제되었습니다","admin_menu_list.php?$qstr");
	exit;
}

$sql_common = " from nfor_access ";
$sql_search = " where 1 ";

if($access_code_select){
	$sql_search .= " and access_code='$access_code_select' and access_path='1' ";
} else{
	$sql_search .= " and access_path='0' ";
}


if($gp_id_select) $sql_search .= " and gp_id='$gp_id_select' ";
if($stx) $sql_search .= " and $sfl like '%$stx%' ";
if (!$sst) {
	$sst = "access_rank";
	$sod = "desc";
}
$sql_order = " order by $sst $sod ";
$sql = " select count(*) as cnt
							$sql_common
							$sql_search
							$sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];
$rows = 200;
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
	<? if(!$access_code_select){ ?>
	<form name="fsearch1" method="get" action="admin_menu_list.php">
	<input type="hidden" name="access_code_select" value="<?=$access_code_select?>">
	<select name="gp_id_select" onchange="fsearch1.submit()">
	<option value="">선택
	<?
	$que = sql_query("select * from nfor_access_group order by gp_id");
	while($data = sql_fetch_array($que)){
	?>
	<option value="<?=$data[gp_id]?>" <? if($data[gp_id]==$gp_id_select) echo "selected"; ?>><?=$data[gp_group]?> > <?=$data[gp_text]?>
	<?}?>
	</select>
	</form>
	<? } ?>
	</td>
	<td align="right">
	<form name="fsearch2" method="get" action="admin_menu_list.php">
	<input type="hidden" name="gp_id" value="<?=$gp_id?>">
	<input type="hidden" name="access_code_select" value="<?=$access_code_select?>">
	<select name="sfl">
	<?
	$sfl_txt_array = array("메뉴명");
	$sfl_val_array = array("access_text");
	for($i=0; $i<count($sfl_txt_array); $i++){
	?>	
	<option value="<?=$sfl_val_array[$i]?>" <? if($sfl==$sfl_val_array[$i]) echo "selected"; ?>><?=$sfl_txt_array[$i]?>
	<? } ?>
	</select>
	<input type="text"  name="stx" value="<?=$stx?>">
	<input type="image" src="img/gum_btn.gif" align="absmiddle">
	</form>
	</td>
</tr>
</table>

<form name="flist" id="flist" method="post" action="admin_menu_list.php">
<input type="hidden" name="mode" id="mode">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="gp_id_select" value="<?=$gp_id_select?>">
<input type="hidden" name="access_code_select" value="<?=$access_code_select?>">
<table border="1" cellspacing="0" class="tbl_typeB">
<tr>
	<th scope="col"><input type="checkbox" name="chkall" value="1" onclick="check_all(this.form)"></th>
	<th scope="col" <?=$access_code_select?"style='display:none'":""?>>메뉴구분</th>
	<th scope="col">메뉴명</th>
	<th scope="col">파일명</th>
	<th scope="col">출력순위</th>
	<th scope="col">접근레벨(이상)</th>
	<th scope="col" <?=$access_code_select?"style='display:none'":""?>>소속메뉴</th>
	<th scope="col">삭제</th>
</tr>
<? 
for($i=0; $row=sql_fetch_array($result); $i++){
?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
	<td><input type="checkbox" name="chk[]" value="<?=$i?>"><input type="hidden" name="access_id[<?=$i?>]" value="<?=$row[access_id]?>"></td>
	<td <?=$access_code_select?"style='display:none'":""?>>
		<select name="gp_id[]">
		<option value="">선택
		<?
		$que = sql_query("select * from nfor_access_group order by gp_id");
		while($data = sql_fetch_array($que)){
		?>
		<option value="<?=$data[gp_id]?>" <? if($data[gp_id]==$row[gp_id]) echo "selected"; ?>><?=$data[gp_group]?> > <?=$data[gp_text]?>
		<?}?>
		</select>
	</td>
	<td><input type="text" name="access_text[<?=$i?>]" value="<?=$row[access_text]?>" class="input_txt" style="width:150px;"></td>
	<td><input type="text" name="access_file[<?=$i?>]" value="<?=$row[access_file]?>" class="input_txt" style="width:150px;"></td>
	<td><input type="text" name="access_rank[<?=$i?>]" value="<?=$row[access_rank]?>" class="input_txt" style="width:30px;"></td>
	<td>
	
	<select name="access_level[<?=$i?>]">
	<option value="10" <?=$row[access_level]=="10"?"selected":""?>>최고관리자
	<option value="7" <?=$row[access_level]=="7"?"selected":""?>>부관리자
	<option value="2" <?=$row[access_level]=="2"?"selected":""?>>MD회원
	<option value="1" <?=$row[access_level]=="1"?"selected":""?>>입점업체
	</select>
	
	</td>

	<td <?=$access_code_select?"style='display:none'":""?>><a href="admin_menu_list.php?access_code_select=<?=$row[access_code]?>" style="color:blue;" class="btn_sml"><span>소속메뉴</span></a></td>


	<td><a href="javascript:del('admin_menu_list.php?mode=delete&access_id=<?=$row[access_id]?>&<?=$qstr?>')"><img src="img/del_btn.gif"></a></td>
</tr>
<?
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<div class="btn_cen"><?=$pagelist?></div>
<div class="btn_cen">
<a href="javascript:nfor_list('수정','list_update')"><img src="img/sun_update.jpg" alt="선택수정"></a>
<a href="javascript:nfor_list('삭제','list_delete')"><img src="img/s_del_btn.gif"></a>
<a href="admin_menu_form.php?<?=$qstr?>"><img src="img/dong_btn.gif"></a>
</div>
</form>
<?
include "tail.php";
?>