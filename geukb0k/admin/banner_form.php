<?php	// 배너관리
include "path.php";

$qstr .= "&wr_code=$wr_code";

if($banner_id){
	$write = sql_fetch("select * from nfor_banner where banner_id='$banner_id'");
}

if($mode=="insert"){
	if(!$wr_name) alert("배너이름을 입력하셔야 등록가능합니다");
	if(!$wr_rank){
		$max_wr_rank = sql_fetch("select * from nfor_banner order by wr_rank limit 1");
		$wr_rank = $max_wr_rank[wr_rank]-1;
	} else{
		$wr_rank = $wr_rank*-1;
	}
	if($wr_banner_img = file_upload($nfor[path]."/data/banner/", $_FILES["wr_banner_img"])) $add_sql .= " , wr_banner_img='$wr_banner_img' ";

	if($wr_banner_img_over = file_upload($nfor[path]."/data/banner/", $_FILES["wr_banner_img_over"])) $add_sql .= " , wr_banner_img_over='$wr_banner_img_over' ";
	if($wr_banner_img_hover = file_upload($nfor[path]."/data/banner/", $_FILES["wr_banner_img_hover"])) $add_sql .= " , wr_banner_img_hover='$wr_banner_img_hover' ";

	sql_query("insert nfor_banner set wr_code='$wr_code', wr_banner_link='$wr_banner_link', wr_name='$wr_name', wr_rank='$wr_rank', wr_use='$wr_use', wr_sdate='$wr_sdate', wr_edate='$wr_edate', wr_target='$wr_target', wr_memo='$wr_memo', wr_html='$wr_html' $add_sql");
	alert("정상적으로 등록되었습니다","banner_list.php?$qstr");
	exit;
}

if($mode=="update"){
	$wr_rank = $wr_rank*-1;
	if($wr_banner_img = file_upload($nfor[path]."/data/banner/", $_FILES["wr_banner_img"])) $add_sql .= " , wr_banner_img='$wr_banner_img' ";
	if($wr_banner_img_del){
		sql_query("update nfor_banner set wr_banner_img='' where banner_id='$banner_id'");
		@unlink($nfor[path]."/data/banner/".$write[wr_banner_img]);
	}

	if($wr_banner_img_over = file_upload($nfor[path]."/data/banner/", $_FILES["wr_banner_img_over"])) $add_sql .= " , wr_banner_img_over='$wr_banner_img_over' ";
	if($wr_banner_img_over_del){
		sql_query("update nfor_banner set wr_banner_img_over='' where banner_id='$banner_id'");
		@unlink($nfor[path]."/data/banner/".$write[wr_banner_img_over]);
	}

	if($wr_banner_img_hover = file_upload($nfor[path]."/data/banner/", $_FILES["wr_banner_img_hover"])) $add_sql .= " , wr_banner_img_hover='$wr_banner_img_hover' ";
	if($wr_banner_img_hover_del){
		sql_query("update nfor_banner set wr_banner_img_hover='' where banner_id='$banner_id'");
		@unlink($nfor[path]."/data/banner/".$write[wr_banner_img_hover]);
	}

	sql_query("update nfor_banner set wr_code='$wr_code', wr_banner_link='$wr_banner_link', wr_name='$wr_name',wr_rank='$wr_rank',wr_use='$wr_use',wr_sdate='$wr_sdate',wr_edate='$wr_edate', wr_target='$wr_target', wr_memo='$wr_memo', wr_html='$wr_html' $add_sql where banner_id='$banner_id'");
	alert("정상적으로 수정되었습니다","banner_form.php?banner_id=$banner_id&$qstr");
	exit;
}

include "head.php";

echo cheditor1('wr_memo', '100%', '450px');
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
jQuery(function($){

	$('#wr_sdate,#wr_edate').datetimepicker({

		showOn: 'button',
		buttonImage: 'img/calendar.gif',
		buttonImageOnly: true,
		buttonText: "달력",
		numberOfMonths: 1,
		closeText: '닫기',
		currentText: '오늘',
		changeMonth: true,
		showSecond: true,
		dateFormat: 'yy-mm-dd',
		timeFormat: 'hh:mm:ss'

	});

});
//-->
</SCRIPT>


<SCRIPT LANGUAGE="JavaScript">
<!--
function fsubmit(f){

    <?
    echo cheditor3('wr_memo');
    ?>	
	f.action = "banner_form.php";
	return true;

}	
//-->
</SCRIPT>



<form name="fwrite" method="post" onsubmit="return fsubmit(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$write[banner_id]?"update":"insert"?>">
<input type="hidden" name="banner_id" value="<?=$write[banner_id]?>">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<table class="tbl_type" border="1" cellspacing="0">
<colgroup>
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th>배너그룹 <a href="javascript:banner_type_form()"><img src="img/area_p_ico.gif" alt="배너그룹추가" align="absmiddle"></a></th> 
	<td>
	<select name="wr_code" required itemname="배너그룹">
	<option value="">선택
	<?
	$que = sql_query("select * from nfor_banner_group order by wr_id");
	while($data = sql_fetch_array($que)){
	?>
	<option value="<?=$data[wr_code]?>" <? if($data[wr_code]==$write[wr_code]) echo "selected"; ?>><?=$data[wr_group]?> - <?=$data[wr_code]?>
	<? } ?>
	</select>
	</td>
</tr>

<tr>
	<th>타겟설정</th> 
	<td>
	
	<SELECT NAME="wr_target" required itemname="타겟">
		<OPTION VALUE="_self" <? if($write[wr_target]=="_self") echo "selected"; ?>>_self
		<OPTION VALUE="_blank" <? if($write[wr_target]=="_blank") echo "selected"; ?>>_blank
	</SELECT>


	</td>
</tr>

<tr>
	<th>표시기간</th> 
	<td>
	<input type="text" class="input_txt" name="wr_sdate" id="wr_sdate" value="<?=$write[wr_sdate]?>" style="width:116px;" required itemname="시작일자">
	<input type="text" class="input_txt" name="wr_edate" id="wr_edate" value="<?=$write[wr_edate]?>" style="width:116px;" required itemname="종료일자">

	<input type="hidden" name="now_datetime" id="now_datetime" value="<?=date("Y-m-d 00:00:00")?>">
	<input type="hidden" name="end_datetime" id="end_datetime" value="2020-12-31 00:00:00">
	<input type="checkbox" name="it_shopping" id="it_shopping" value="1" onclick="if (this.checked == true){ this.form.wr_sdate.value=this.form.now_datetime.value; this.form.wr_edate.value=this.form.end_datetime.value; } else{ this.form.wr_sdate.value = this.form.wr_sdate.defaultValue; this.form.wr_edate.value = this.form.wr_edate.defaultValue; } "> 계속표시


	</td>
</tr>


<tr>
	<th>배너이름</th> 
	<td><input type="text" class="input_txt" name="wr_name" value="<?=$write[wr_name]?>" required itemname="배너이름"></td>
</tr>
<tr>
	<th>배너링크</th> 
	<td><input type="text" class="input_txt" name="wr_banner_link" value="<?=$write[wr_banner_link]?>" size="60" required itemname="배너링크"> <span class="tex01">※ 주의 : _blank 사용시 반드시 http://를 포함한 적어주세요 예) http://nfor.net/ </span></td>
</tr>
<tr>
	<th>출력순위</th> 
	<td><input type="text" class="input_txt" name="wr_rank" value="<?=$write[wr_rank]?$write[wr_rank]*-1:""?>" style="width:40px;" required numeric itemname="출력순위"> <span class="tex01">※ 숫자가 높을 수록 우선 출력됩니다.(10 또는 20단위로 순위를 정하시면 좋습니다)</span></td>
</tr>
<tr>
	<th>노출여부</th> 
	<td><input type="checkbox" name="wr_use" value="1" <? if($write[wr_use]) echo "checked"; ?>>노출</td>
</tr>
<tr>
	<th>배너이미지</th> 
	<td>
	<input type="file" name="wr_banner_img" class="input_txt" <? if(!$write[wr_banner_img]){ ?> itemname="배너이미지"<? } ?>>
	<? if($write[wr_banner_img]){ ?><input type="checkbox" name="wr_banner_img_del" value="1" class="input_txt"><img src="<?=$nfor[path]?>/data/banner/<?=$write[wr_banner_img]?>" height="19"><? } ?>
	</td>
</tr>


<tr>
	<th>배너텍스트</th> 
	<td>

	배너텍스트 일반 : <input type="file" name="wr_banner_img_hover" class="input_txt" <? if(!$write[wr_banner_img_hover]){ ?> itemname="배너이미지2"<? } ?>>
	<? if($write[wr_banner_img_hover]){ ?><input type="checkbox" name="wr_banner_img_hover_del" value="1" class="input_txt"><img src="<?=$nfor[path]?>/data/banner/<?=$write[wr_banner_img_hover]?>" height="19"><? } ?>
	<br>
	배너텍스트 오버 : <input type="file" name="wr_banner_img_over" class="input_txt" <? if(!$write[wr_banner_img_over]){ ?> itemname="배너이미지1"<? } ?>>
	<? if($write[wr_banner_img_over]){ ?><input type="checkbox" name="wr_banner_img_over_del" value="1" class="input_txt"><img src="<?=$nfor[path]?>/data/banner/<?=$write[wr_banner_img_over]?>" height="19"><? } ?>




	</td>
</tr> 


<tr>
	<th>표시구분</th> 
	<td>
	<input type="radio" name="wr_html" value="0" <? if(!$write[wr_html]) echo "checked"; ?>>배너이미지
	<input type="radio" name="wr_html" value="1" <? if($write[wr_html]) echo "checked"; ?>>HTML
	</td>
</tr>

<tr>
	<th>HTML</th>
	<td><?=cheditor2('wr_memo', $write[wr_memo]);?></td>
</tr>
</table>
<div class="btn_cen"><input type="image" src="img/dong_btn.gif"> <a href="banner_list.php?<?=$qstr?>"><img src="img/list.gif" alt="목록보기"></a></div>
</form>




<?
include "tail.php";
?>