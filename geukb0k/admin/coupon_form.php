<?php	// 쿠폰등록
include "path.php";

$write = sql_fetch("select * from nfor_coupon where cp_id='$cp_id'");

if($mode=="insert"){

	$cp_number = coupon_number();
	sql_query("insert nfor_coupon set cp_number='$cp_number', cp_name='$cp_name', cp_type='$cp_type', cp_it_id='$cp_it_id', cp_category_id='$cp_category_id', cp_mb_no='$cp_mb_no', cp_all='$cp_all', cp_sdate='$cp_sdate', cp_edate='$cp_edate', cp_pay_type='$cp_pay_type', cp_coupon_price='$cp_coupon_price', cp_coupon_per='$cp_coupon_per', cp_datetime=NOW()");

	alert("정상적으로 등록 되었습니다","coupon_list.php?$qstr");
	exit;
}


if($mode=="update"){

	sql_query("update nfor_coupon set cp_name='$cp_name', cp_type='$cp_type', cp_it_id='$cp_it_id', cp_category_id='$cp_category_id', cp_mb_no='$cp_mb_no', cp_all='$cp_all', cp_sdate='$cp_sdate', cp_edate='$cp_edate', cp_pay_type='$cp_pay_type', cp_coupon_price='$cp_coupon_price', cp_coupon_per='$cp_coupon_per' where cp_id='$cp_id'");

	alert("정상적으로 수정 되었습니다","coupon_list.php?$qstr");
	exit;
}


include "head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
jQuery(function($){

	$('#cp_sdate,#cp_edate').datetimepicker({

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
	f.action = "coupon_form.php";
	return true;		    
}	
//-->
</SCRIPT>
<form name="fwrite" method="post" onsubmit="return fsubmit(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$write[cp_id]?"update":"insert"?>">
<input type="hidden" name="cp_id" value="<?=$write[cp_id]?>">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<table class="tbl_type" border="1" cellspacing="0">
<colgroup>
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th>쿠폰이름</th>
	<td><input type="text" class="input_txt" name="cp_name" id="cp_name" value="<?=$write[cp_name]?>" required itemname="쿠폰이름"></td>
</tr>

<tr>
	<th>쿠폰종류</th>
	<td>
		<input type="radio" name="cp_type" class="cp_type" id="cp_type1" value="1" <?=!$write[cp_type] || $write[cp_type]=="1"?"checked":""?>> <label for="cp_type1">개별상품할인</label>
		<input type="radio" name="cp_type" class="cp_type" id="cp_type2" value="2" <?=$write[cp_type]=="2"?"checked":""?>> <label for="cp_type2">카테고리할인</label>



<SCRIPT LANGUAGE="JavaScript">
<!--
$(document).on("click",".cp_type",function(){

	var cp_type = $('.cp_type:checked').val();
	if(cp_type=="1"){
		$(".cp_item").show();
		$(".cp_category").hide();
		$("#cp_category_id").val("");
	} else if(cp_type=="2"){
		$(".cp_item").hide();
		$(".cp_category").show();
		$("#cp_it_id").val("");
	} else{
		$(".cp_item").hide();
		$(".cp_category").hide();
		$("#cp_it_id").val("");
		$("#cp_category_id").val("");
	}
	

});

//-->
</SCRIPT>

	</td>
</tr>
<tr class="cp_item" style="<?=!$write[cp_type] || $write[cp_type]=="1"?"":"display:none;"?>">
	<th>적용상품</th>
	<td>
	<input type="text" class="input_txt" name="cp_it_id" id="cp_it_id" value="<?=$write[cp_it_id]?>" itemname="적용상품">
	<input type="button" value="조회하기" onclick="search_it_id('cp_it_id')">
	</td>
</tr>
<tr class="cp_category" style="<?=$write[cp_type]=="2"?"":"display:none;"?>">
	<th>적용카테고리</th>
	<td>
	<input type="text" class="input_txt" name="cp_category_id" id="cp_category_id" value="<?=$write[cp_category_id]?>" itemname="적용카테고리">
	<input type="button" value="조회하기" onclick="search_category_id('cp_category_id')">
	</td>
</tr>
<tr>
	<th>발급대상</th>
	<td>

	<select name="cp_all" onchange="cp_all_fnc(this.value)">
		<option value="1" <?=$write[cp_all]=="1"?"selected":""?>>전체회원
		<option value="2" <?=$write[cp_all]=="2"?"selected":""?>>개인회원
	</select>

	<div id="cp_mb_no_wrap" <? if($write[cp_all]<>"2"){ ?>style="display:none;"<? } ?>>
	<input type="text" class="input_txt" name="cp_mb_no" id="cp_mb_no" value="<?=$write[cp_mb_no]?>" itemname="아이디">
	<input type="button" value="조회하기" onclick="search_mb_id('cp_mb_no')">
	</div>

	</td>
</tr>
<tr>
	<th>사용기간</th> 
	<td>
	<input type="text" class="input_txt" name="cp_sdate" id="cp_sdate" value="<?=$write[cp_sdate]?>" style="width:126px;" required itemname="시작일자">
	~
	<input type="text" class="input_txt" name="cp_edate" id="cp_edate" value="<?=$write[cp_edate]?>" style="width:126px;" required itemname="종료일자">
	</td>
</tr>
<tr>
	<th>할인형태</th>
	<td>
	
		<input type="text" class="input_txt" name="cp_coupon_price" id="cp_coupon_price" value="<?=$write[cp_coupon_price]?>" style="width:80px; <?=$write[cp_pay_type]=="2"?"display:none;":""?>" itemname="할인금액">
		<input type="text" class="input_txt" name="cp_coupon_per" id="cp_coupon_per" value="<?=$write[cp_coupon_per]?>" style="width:40px; <?=$write[cp_pay_type]<>"2"?"display:none;":""?>" itemname="할인률">

		<select name="cp_pay_type" onchange="cp_pay_type_fnc(this.value)">
		<option value="1" <?=$write[cp_pay_type]=="1"?"selected":""?>>원
		<option value="2" <?=$write[cp_pay_type]=="2"?"selected":""?>>%
		</select>

	</td>
</tr>
</table>
<div class="btn_cen"><input type="image" src="img/dong_btn.gif"> <a href="coupon_list.php?<?=$qstr?>"><img src="img/list.gif"></a></div>
</form>


<SCRIPT LANGUAGE="JavaScript">
<!--

function cp_all_fnc(ty){

	if(ty=="1"){
		$("#cp_mb_no_wrap").hide();
		$("#cp_mb_no").val("");
	} else{
		$("#cp_mb_no_wrap").show();
	}

}

function cp_pay_type_fnc(ty){

	if(ty=="1"){
		$("#cp_coupon_price").show();
		$("#cp_coupon_per").val("").hide();
	} else{
		$("#cp_coupon_per").show();
		$("#cp_coupon_price").val("").hide();
	}
	

}

//-->
</SCRIPT>

<?
include "tail.php";
?>