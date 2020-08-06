<?php	// 배너관리
include "path.php";

if($wr_id){
	$write = sql_fetch("select * from nfor_plan where wr_id='$wr_id'");
}

if($mode=="insert"){
	if($wr_img = file_upload($nfor[path]."/data/plan/", $_FILES["wr_img"])) $add_sql .= " , wr_img='$wr_img' ";

	if($wr_img_m = file_upload($nfor[path]."/data/plan/", $_FILES["wr_img_m"])) $add_sql .= " , wr_img_m='$wr_img_m' ";

	sql_query("insert nfor_plan set wr_rank='$wr_rank', wr_use='$wr_use',wr_sdate='$wr_sdate',wr_edate='$wr_edate',wr_subject='$wr_subject', wr_memo='$wr_memo',wr_item_list='$wr_item_list' $add_sql");
	alert("정상적으로 등록되었습니다","plan_list.php?$qstr");
	exit;
}

if($mode=="update"){

	if($wr_img = file_upload($nfor[path]."/data/plan/", $_FILES["wr_img"])) $add_sql .= " , wr_img='$wr_img' ";
	if($wr_img_del){
		sql_query("update nfor_plan set wr_img='' where wr_id='$wr_id'");
		@unlink($nfor[path]."/data/plan/".$write[wr_img]);
	}

	if($wr_img_m = file_upload($nfor[path]."/data/plan/", $_FILES["wr_img_m"])) $add_sql .= " , wr_img_m='$wr_img_m' ";
	if($wr_img_m_del){
		sql_query("update nfor_plan set wr_img_m='' where wr_id='$wr_id'");
		@unlink($nfor[path]."/data/plan/".$write[wr_img_m]);
	}

	sql_query("update nfor_plan set wr_rank='$wr_rank', wr_use='$wr_use', wr_sdate='$wr_sdate',wr_edate='$wr_edate',wr_subject='$wr_subject', wr_memo='$wr_memo',wr_item_list='$wr_item_list' $add_sql where wr_id='$wr_id'");
	alert("정상적으로 수정되었습니다","plan_form.php?wr_id=$wr_id&$qstr");
	exit;
}

include "head.php";
echo cheditor1('wr_memo', '100%', '150px');
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
	f.action = "plan_form.php";
	return true;
			    
}	
//-->
</SCRIPT>

<form name="fwrite" method="post" onsubmit="return fsubmit(this)" enctype="multipart/form-data">
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
	<th>노출기간</th> 
	<td>
	<input type="text" class="input_txt" name="wr_sdate" id="wr_sdate" value="<?=$write[wr_sdate]?>" style="width:116px;" required itemname="시작일자">
	<input type="text" class="input_txt" name="wr_edate" id="wr_edate" value="<?=$write[wr_edate]?>" style="width:116px;" required itemname="종료일자">
	</td>
</tr>
<tr>
	<th>기획전명</th> 
	<td><input type="text" class="input_txt" style="width:100%;" name="wr_subject" value="<?=$write[wr_subject]?>" required itemname="배너이름"></td>
</tr>
<tr>
	<th>출력순위</th> 
	<td><input type="text" class="input_txt" name="wr_rank" value="<?=$write[wr_rank]?>" style="width:40px;" required numeric itemname="출력순위"> <span class="tex01">※ 숫자가 높을 수록 우선 출력됩니다.(10 또는 20단위로 순위를 정하시면 좋습니다)</span></td>
</tr>
<tr>
	<th>노출여부</th> 
	<td><input type="checkbox" name="wr_use" value="1" <? if($write[wr_use]) echo "checked"; ?>></td>
</tr>
<tr>
	<th>이미지</th> 
	<td>
	<input type="file" name="wr_img" class="input_txt" <? if(!$write[wr_img]){ ?> required itemname="이미지"<? } ?>>
	<? if($write[wr_img]){ ?><input type="checkbox" name="wr_img_del" value="1" class="input_txt"><img src="<?="$nfor[path]/data/plan/$write[wr_img]"?>" height="19"><? } ?>
	</td>
</tr>

<tr>
	<th>모바일 이미지</th> 
	<td>
	<input type="file" name="wr_img_m" class="input_txt" <? if(!$write[wr_img_m]){ ?> required itemname="이미지"<? } ?>>
	<? if($write[wr_img_m]){ ?><input type="checkbox" name="wr_img_m_del" value="1" class="input_txt"><img src="<?="$nfor[path]/data/plan/$write[wr_img_m]"?>" height="19"><? } ?>
	</td>
</tr>

<tr>
	<th>상품지정</th>
	<td>
	<a href="javascript:it_select('fwrite','wr_item_list');" class="btn_sml"><span>관련상품검색</span></a>
	<span class="tex01">&nbsp;※ 상품코드만 입력하셔야 하며 구분자는 | 입니다</span><br>
	<textarea name="wr_item_list" id="wr_item_list" rows="4" style="width:100%"><?=$write[wr_item_list]?></textarea>
	</td>
</tr>
<tr>
	<th>메모</th> 
	<td><?=cheditor2('wr_memo', $write[wr_memo]);?></td>
</tr>
</table>
<div class="btn_cen"><input type="image" src="img/dong_btn.gif"> <a href="plan_list.php?<?=$qstr?>"><img src="img/list.gif" alt="목록보기"></a></div>
</form>



<?
include "tail.php";
?>