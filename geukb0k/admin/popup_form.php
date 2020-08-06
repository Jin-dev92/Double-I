<?php	// 팝업관리
include "path.php";
$qstr .= "&wr_type=$wr_type";

if($popup_id){
	$write = sql_fetch("select * from nfor_popup where popup_id='$popup_id'");

	if($write[it_id]){
		$item = sql_fetch("select * from nfor_item where it_id='$write[it_id]'");
	}

}
if($mode=="insert"){
	sql_query("insert nfor_popup set wr_use='$wr_use',it_subject='$it_subject',it_id='$it_id',wr_display='$wr_display',wr_type='$wr_type',wr_sdatetime='$wr_sdatetime',wr_edatetime='$wr_edatetime',wr_x_point='$wr_x_point',wr_y_point='$wr_y_point',wr_width='$wr_width',wr_height='$wr_height',wr_time='$wr_time',wr_subject='$wr_subject',wr_memo='$wr_memo',wr_datetime=NOW()");
	alert("정상적으로 등록 되었습니다","popup_list.php?$qstr");
	exit;
}

if($mode=="update"){
	sql_query("update nfor_popup set wr_use='$wr_use',it_subject='$it_subject',it_id='$it_id',wr_display='$wr_display',wr_type='$wr_type',wr_sdatetime='$wr_sdatetime',wr_edatetime='$wr_edatetime',wr_x_point='$wr_x_point',wr_y_point='$wr_y_point',wr_width='$wr_width',wr_height='$wr_height',wr_time='$wr_time',wr_subject='$wr_subject',wr_memo='$wr_memo',wr_datetime=NOW() where popup_id='$popup_id'");
	alert("정상적으로 수정 되었습니다","popup_form.php?popup_id=$popup_id&$qstr");
	exit;
}

include "head.php";

echo cheditor1('wr_memo', '100%', '450px');
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
jQuery(function($){

	$('#wr_sdatetime,#wr_edatetime').datetimepicker({

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

function fsubmit(f){

	if($('#wr_display').val()=="item"){
		if(!$('#it_id').val()){
			alert("팝업표시가 상품일 경우 조회하기를 눌러 상품을 선택해주세요");
			return false;
		}
	} else{
		$('#it_id').val('');
		$('#it_subject').val('');
	}

    <?
    echo cheditor3('wr_memo');
    ?>	

	f.action = "popup_form.php";
	return true;
}	

function div_display(){

	if($('#wr_display').val()=="item"){
		$('#div_display').show();
	} else{
		$('#div_display').hide();
		$('#it_id').val('');
		$('#it_subject').val('');
	}

}

//-->
</SCRIPT>

<form name="fwrite" method="post" onsubmit="return fsubmit(this)" enctype="multipart/form-data">
<INPUT TYPE="hidden" NAME="mode" value="<?=$write[popup_id]?"update":"insert"?>">
<INPUT TYPE="hidden" NAME="popup_id" value="<?=$write[popup_id]?>">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<table class="tbl_type" border="1" cellspacing="0">
<colgroup>
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th>사용여부</th>
	<td><INPUT TYPE="checkbox" NAME="wr_use" value="1" <? if($write[wr_use] or !$write[popup_id]) echo "checked"; ?>>
	
	
	
	<table cellpadding="0" cellspacing="0" border="0" style="display:none;">
		<tr>
			<td align="left">

				<SELECT NAME="wr_display" id="wr_display" onchange="div_display()">
					<?
					$popup_array = array("전체","상품");
					$popup_array_code = array("all","item");
					for($i=0; $i<count($popup_array); $i++){
					?>
					<OPTION VALUE="<?=$popup_array_code[$i]?>" <? if($write[wr_display]==$popup_array_code[$i]) echo "selected"; ?>><?=$popup_array[$i]?>
					<? } ?>
				</SELECT>

			</td>
			<td align="left">

			<div id="div_display" <? if(!$write[wr_display] or $write[wr_display]=="all"){ echo "style='display:none;'"; } ?>>

				<table cellpadding="0" cellspacing="0" border="0" class="tbl_typeC">
				<tr>
					<td align="left">
					<input type="hidden" name="it_id" id="it_id" value="<?=$write[it_id]?>">
					<input type="text" class="input_txt" name="it_subject" id="it_subject" value="<?=$item[it_name]?>" style="width:200px;" onclick="it_id_search();" readonly>
					</td>
					<td align="left"><a href="javascript:it_id_search();" class="btn_sml"><span>조회하기</span></a></td>
				</tr>
				</table>

			</div>

			</td>
		</tr>
		</table>
	
	
	
	
	
	</td>
</tr>
<tr>
	<th>팝업형태</th>
	<td><INPUT TYPE="radio" NAME="wr_type" value="window" <? if($write[wr_type]=="window" or !$write[wr_type]) echo "checked"; ?>> 새창
	<INPUT TYPE="radio" NAME="wr_type" value="layer" <? if($write[wr_type]=="layer") echo "checked"; ?>> 레이어</td>
</tr>
<tr>
	<th>시작일시</th>
	<td><input type=text class="input_txt" name="wr_sdatetime" id="wr_sdatetime" style="width:116px;" value='<?=$write[wr_sdatetime]?>' required itemname="시작일시"></td>
</tr>
<tr>
	<th>종료일시</th>
	<td><input type=text class="input_txt" name="wr_edatetime" id="wr_edatetime" style="width:116px;" value='<?=$write[wr_edatetime]?>' required itemname="종료일시"></td>
</tr>
<tr>
	<th>팝업위치</th>
	<td>Y측좌표&nbsp;<input type=text class="input_txt" NAME="wr_y_point" value="<?=$write[wr_y_point]?>" style="width:50px;" required itemname="Y축좌표">px,
	X축좌표&nbsp;<input type=text class="input_txt" NAME="wr_x_point" value="<?=$write[wr_x_point]?>" style="width:50px;" required itemname="X축좌표">px <span class="tex01">레이어팝업 : 중앙기준, 새창팝업 : 좌측상단기준</span></td>
</tr>
<tr>
	<th>팝업크기</th>
	<td><input type=text class="input_txt" NAME="wr_width" value="<?=$write[wr_width]?>" style="width:50px;" required numeric itemname="가로길이">px <input type=text class="input_txt" NAME="wr_height" value="<?=$write[wr_height]?>" style="width:50px;" required numeric itemname="세로길이">px</td>
</tr>
<tr>
	<th>다시보기</th>
	<td><input type=text class="input_txt" NAME="wr_time" value="<?=$write[wr_time]?>" style="width:30px;" required numeric itemname="다시보기">일 동안 다시보지 않기</td>
</tr>
<tr>
	<th>팝업제목</th>
	<td><input type=text class="input_txt" NAME="wr_subject" id="wr_subject" value="<?=$write[wr_subject]?>" style="width:100%;" required itemname="팝업제목"></td>
</tr>
<tr>
	<th>팝업내용</th>
	<td><?=cheditor2('wr_memo', $write[wr_memo]);?></td>
</tr>	
</table>
<div class="btn_cen"><input type="image" src="img/dong_btn.gif"> <a href="popup_list.php?<?=$qstr?>"><img src="img/list.gif"></a></div>
</form>
<?
include "tail.php";
?>