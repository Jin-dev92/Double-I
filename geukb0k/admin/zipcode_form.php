<?php	// 공지사항
include "path.php";

if($mode=="insert"){
	sql_query("insert nfor_dy_zipcode set zip_type='$zip_type',zip_address='$zip_address', zip_price='$zip_price',zip_zipcode='$zip_zipcode'");
	alert("정상적으로 등록 되었습니다","zipcode_list.php?$qstr");
	exit;
}

if($mode=="update"){
	sql_query("update nfor_dy_zipcode set zip_type='$zip_type',zip_address='$zip_address',zip_price='$zip_price' where zip_zipcode='$zip_zipcode'");
	alert("정상적으로 수정 되었습니다","zipcode_form.php?zip_zipcode=$zip_zipcode&$qstr");
	exit;
}

if($zip_zipcode) $write = sql_fetch("select * from nfor_dy_zipcode where zip_zipcode='$zip_zipcode'");

include "head.php";

?>
<SCRIPT LANGUAGE="JavaScript">
<!--


function fsubmit(f){
	if(!$("#zip_zipcode").val()){
		alert("우편번호를 입력해주세요");
		return false;
	}
	if(!$("#zip_address").val()){
		alert("주소을 입력해주세요");
		return false;
	}
	if(!$("#zip_price").val()){
		alert("추가배송비를 입력해주세요");
		return false;
	}
	f.action = "zipcode_form.php";
	return true;	    
}	
//-->
</SCRIPT>
<form name="fwrite" method="post" onsubmit="return fsubmit(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$write[zip_zipcode]?"update":"insert"?>">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<table class="tbl_type" border="1" cellspacing="0">
<colgroup>
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th>우편번호</th>
	<td>
	
	<input type=text class="input_txt" name="zip_zipcode" id="zip_zipcode" value="<?=$write[zip_zipcode]?>" <?=$write[zip_zipcode]?"readonly":""?> style="width:100%;" required itemname="우편번호">
	</td>
</tr>
<tr>
	<th>분류</th>
	<td>
	
	<select name="zip_type" id="zip_type" required itemname="분류">
		<option value="도서산간" <?=$write[zip_type]=="도서산간"?"selected":""?>>도서산간
		<option value="제주권" <?=$write[zip_type]=="제주권"?"selected":""?>>제주권
	</select>
	
	</td>
</tr>
<tr>
	<th>주소</th>
	<td><input type=text class="input_txt" name="zip_address" id="zip_address" value="<?=$write[zip_address]?>" style="width:100%;" required itemname="주소"></td>
</tr>
<tr>
	<th>추가배송비</th>
	<td><INPUT TYPE="text" NAME="zip_price" id="zip_price" style="width:50px;" class="input_txt" value="<?=$write[zip_price]?>">원</td>
</tr>
</table>
<div class="btn_cen"><input type="image" src="img/dong_btn.gif"> <a href="zipcode_list.php?<?=$qstr?>"><img src="img/list.gif"></a></div>
</form>
<?
include "tail.php";
?>