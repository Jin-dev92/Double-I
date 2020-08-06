<?php	// 관리자메뉴설정
include "path.php";

$qstr .= "&access_code_select=$access_code_select";

if($mode=="insert"){

	if($access_code_select){
		$data = sql_fetch("select * from nfor_access where access_id='$access_code_select'");
		$add_sql = " , access_path='1', access_code='$data[access_code]', gp_id='$data[gp_id]'";
	} else{
		$add_sql = " , access_path='0', gp_id='$_POST[gp_id]'";
	}

	sql_query("insert nfor_access set access_text='$_POST[access_text]',
										access_file='$_POST[access_file]',
										access_rank='$_POST[access_rank]',
										access_level='$_POST[access_level]' $add_sql");
	$access_id = sql_insert_id();

	if(!$access_code_select){		
		sql_query("update nfor_access set access_code='$access_id' where access_id='$access_id'");
	}

	alert("정상적으로 등록 되었습니다","admin_menu_list.php?$qstr");
	exit;
}


include "head.php";

?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function fsubmit(f){
	<? if(!$access_code_select){ ?>
	if(!$("#gp_id").val()){
		alert("메뉴구분을 선택해주세요");
		return false;
	}
	<? } ?>
	if(!$("#access_text").val()){
		alert("메뉴명을 입력해주세요");
		return false;
	}
	if(!$("#access_file").val()){
		alert("파일명을 입력해주세요");
		return false;
	}
	if(!$("#access_rank").val()){
		alert("출력순위를 입력해주세요");
		return false;
	}
	f.action = "admin_menu_form.php";
	return true;	    
}	
//-->
</SCRIPT>
<form name="fwrite" method="post" onsubmit="return fsubmit(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="insert">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="access_code_select" value="<?=$access_code_select?>">

<table class="tbl_type" border="1" cellspacing="0">
<colgroup>
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>

<? if(!$access_code_select){ ?>
<tr>
	<th>메뉴구분</th>
	<td>

		<select name="gp_id" id="gp_id">
		<option value="">선택
		<?
		$que = sql_query("select * from nfor_access_group order by gp_id");
		while($data = sql_fetch_array($que)){
		?>
		<option value="<?=$data[gp_id]?>" <? if($data[gp_id]==$write[gp_id]) echo "selected"; ?>><?=$data[gp_group]?> > <?=$data[gp_text]?>
		<?}?>
		</select>
	
	</td>
</tr>
<? } ?>
<tr>
	<th>메뉴명</th>
	<td><input type="text" name="access_text" id="access_text" value="<?=$write[access_text]?>" class="input_txt" style="width:150px;"></td>
</tr>
<tr>
	<th>파일명</th>
	<td><input type="text" name="access_file" id="access_file" value="<?=$write[access_file]?>" class="input_txt" style="width:200px;"></td>
</tr>
<tr>
	<th>출력순위</th>
	<td><input type="text" name="access_rank" id="access_rank" value="<?=$write[access_rank]?>" class="input_txt" style="width:50px;"></td>
</tr>
<tr>
	<th>접근레벨</th>
	<td>
	<select name="access_level" id="access_level">
	<option value="10" <?=$write[access_level]=="10"?"selected":""?>>최고관리자
	<option value="7" <?=$write[access_level]=="7"?"selected":""?>>부관리자
	<option value="2" <?=$write[access_level]=="2"?"selected":""?>>MD회원
	<option value="1" <?=$write[access_level]=="1"?"selected":""?>>입점업체
	</select>
	</td>
</tr>
</table>
<div class="btn_cen"><input type="image" src="img/dong_btn.gif"> <a href="admin_menu_list.php?<?=$qstr?>"><img src="img/list.gif"></a></div>
</form>
<?
include "tail.php";
?>