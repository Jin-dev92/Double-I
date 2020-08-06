<?php	// 상품분류설정
include "path.php";
$qstr .= "&depth_id=$depth_id";

if($wr_id){
	$write = sql_fetch("select * from nfor_item_category where wr_id='$wr_id'");
}

if($depth_id){
	$depth = sql_fetch("select * from nfor_item_category where wr_id='$depth_id'");
	$wr_depth = $depth[wr_depth]+1;
}

if($mode=="insert"){
	if(!$wr_category) alert("지역명을 입력하셔야 등록가능합니다");
	if($wr_img = file_upload($nfor[path]."/data/category/", $_FILES["wr_img"])) $add_sql .= " , wr_img='$wr_img' ";
	if($wr_img_ov = file_upload($nfor[path]."/data/category/", $_FILES["wr_img_ov"])) $add_sql .= " , wr_img_ov='$wr_img_ov' ";
	if($wr_img_hov = file_upload($nfor[path]."/data/category/", $_FILES["wr_img_hov"])) $add_sql .= " , wr_img_hov='$wr_img_hov' ";

	sql_query("insert nfor_item_category set wr_category='$wr_category', wr_rank='$wr_rank', wr_use='$wr_use', depth_id='$depth_id', wr_depth='$wr_depth' $add_sql");
    $wr_id = sql_insert_id();
	$wr_id = substr("000".$wr_id,-3);

	if($depth_id){
		$data = sql_fetch("select * from nfor_item_category where wr_id='$depth_id'");
		$category_id = $data[category_id];
	} else{
		$category_id = "";
	}


	$category_id .= $wr_id;

	sql_query("update nfor_item_category set category_id='$category_id' where wr_id='$wr_id'");
	
	alert("정상적으로 등록되었습니다","item_category_list.php?$qstr");
	exit;
}

if($mode=="update"){
	if($wr_map_icon = file_upload($nfor[path]."/data/map_icon/", $_FILES["wr_map_icon"])) $add_sql .= " , wr_map_icon='$wr_map_icon' ";
	if($wr_img = file_upload($nfor[path]."/data/category/", $_FILES["wr_img"])) $add_sql .= " , wr_img='$wr_img' ";
	if($wr_img_del){
		sql_query("update nfor_item_category set wr_img='' where wr_id='$wr_id'");
		@unlink($nfor[path]."/data/category/".$write[wr_img]);
	}
	if($wr_img_ov = file_upload($nfor[path]."/data/category/", $_FILES["wr_img_ov"])) $add_sql .= " , wr_img_ov='$wr_img_ov' ";
	if($wr_img_ov_del){
		sql_query("update nfor_item_category set wr_img_ov='' where wr_id='$wr_id'");
		@unlink($nfor[path]."/data/category/".$write[wr_img_ov]);
	}
	if($wr_img_hov = file_upload($nfor[path]."/data/category/", $_FILES["wr_img_hov"])) $add_sql .= " , wr_img_hov='$wr_img_hov' ";
	if($wr_img_hov_del){
		sql_query("update nfor_item_category set wr_img_hov='' where wr_id='$wr_id'");
		@unlink($nfor[path]."/data/category/".$write[wr_img_hov]);
	}


	sql_query("update nfor_item_category set wr_category='$wr_category' ,wr_rank='$wr_rank', wr_use='$wr_use',depth_id='$depth_id', wr_depth='$wr_depth' $add_sql where wr_id='$wr_id'");
	alert("정상적으로 수정되었습니다","item_category_form.php?wr_id=$wr_id&$qstr");
	exit;
}

include "head.php";
?>
<form name="fwrite" method="post" action="item_category_form.php" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$write[wr_id]?"update":"insert"?>">
<input type="hidden" name="wr_id" value="<?=$write[wr_id]?>">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="depth_id" value="<?=$depth_id?>">
<input type="hidden" name="depth_id" value="<?=$write[depth_id]?$write[depth_id]:$depth_id?>">

<table class="tbl_type" border="1" cellspacing="0">
<colgroup>
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th scope="row">분류이름</th> 
	<td><input type="text" class="input_txt" name="wr_category" value="<?=$write[wr_category]?>" required itemname="분류이름"></td>
</tr>
<tr>
	<th scope="row">출력순위</th> 
	<td><input type="text"  class="input_txt" name="wr_rank" value="<?=$write[wr_rank]?>" style="width:40px;" required numeric itemname="출력순위"><b> 순위 </b><br><span class="tex01">※숫자가 높을 수록 우선 출력됩니다. <br>※10 또는 20단위로 순위를 정하시면 좋습니다.</span></td>
</tr>
<tr>
	<th scope="row">카테고리이미지</th> 
	<td>

	미선택 <input type="file" name="wr_img" class="input_txt">
	<? if($write[wr_img]){ ?><input type="checkbox" name="wr_img_del" value="1"><img src="<?=$nfor[path]?>/data/category/<?=$write[wr_img]?>" height="19"><? } ?><br>

	선택 <input type="file" name="wr_img_ov" class="input_txt">
	<? if($write[wr_img_ov]){ ?><input type="checkbox" name="wr_img_ov_del" value="1"><img src="<?=$nfor[path]?>/data/category/<?=$write[wr_img_ov]?>" height="19"><? } ?>

	</td>
</tr>
<tr>
	<th scope="row">아이콘이미지</th> 
	<td>
	<input type="file" name="wr_img_hov" class="input_txt">
	<? if($write[wr_img_hov]){ ?><input type="checkbox" name="wr_img_hov_del" value="1"><img src="<?=$nfor[path]?>/data/category/<?=$write[wr_img_hov]?>" height="19"><? } ?>
	</td>
</tr>


<tr>
	<th scope="row">노출여부</th> 
	<td><input type="checkbox"  name="wr_use" value="1" <? if($write[wr_use]) echo "checked"; ?>></td>
</tr>



</table>
<div class="btn_cen"><input type="image" src="img/dong_btn.gif"> <a href="item_category_list.php?<?=$qstr?>"><img src="img/list.gif" alt="목록보기"></a></div>
</form>
<?
include "tail.php";
?>