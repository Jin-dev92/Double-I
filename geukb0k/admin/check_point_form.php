<?php	// 체크포인트설정
include "path.php";

if($wr_id){
	$write = sql_fetch("select * from nfor_check_point where wr_id='$wr_id'");
}

if($mode=="insert"){
	if(!$wr_icon) alert("아이콘 이름을 입력하셔야 등록가능합니다");
	if($wr_icon_img = file_upload($nfor[path]."/data/icon/", $_FILES["wr_icon_img"])) $add_sql .= " , wr_icon_img='$wr_icon_img' ";
	sql_query("insert nfor_check_point set wr_icon='$wr_icon' $add_sql");
	alert("정상적으로 등록되었습니다","check_point_list.php?$qstr");
	exit;
}

if($mode=="update"){

	if($wr_icon_img = file_upload($nfor[path]."/data/icon/", $_FILES["wr_icon_img"])) $add_sql .= " , wr_icon_img='$wr_icon_img' ";
	if($wr_icon_img_del){
		sql_query("update nfor_check_point set wr_icon_img='' where wr_id='$wr_id'");
		@unlink($nfor[path]."/data/icon/".$write[wr_icon_img]);
	}
	sql_query("update nfor_check_point set wr_icon='$wr_icon' $add_sql where wr_id='$wr_id'");
	alert("정상적으로 수정되었습니다","check_point_form.php?wr_id=$wr_id&$qstr");
	exit;
}

include "head.php";
?>
<form name="fwrite" method="post" action="check_point_form.php" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$write[wr_id]?"update":"insert"?>">
<input type="hidden" name="wr_id" value="<?=$write[wr_id]?>">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<table class="tbl_type" border="1" cellspacing="0">
<colgroup>
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th scope="row" >이미지</th> 
	<td><input type="file" name="wr_icon_img" class="input_txt">
	<? if($write[wr_icon_img]){ ?><input type="checkbox"  name="wr_icon_img_del" value="1"><img src="<?="$nfor[path]/data/icon/$write[wr_icon_img]"?>" height="19"><? } ?>
	</td>
</tr>
<tr>
	<th scope="row">이름</th> 
	<td><input type="text" class="input_txt" name="wr_icon" value="<?=$write[wr_icon]?>" required itemname="체크포인트 이름"></td>
</tr>
</table>
<div class="btn_cen"><input type="image" src="img/dong_btn.gif"> <a href="check_point_list.php?<?=$qstr?>"><img src="img/list.gif"></a></div>
</form>
<?
include "tail.php";
?>