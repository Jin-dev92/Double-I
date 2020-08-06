<?php	// FAQ관리
include "path.php";

if($wr_id){
	$write = sql_fetch("select * from nfor_api where wr_id='$wr_id'");
}

if(substr($wr_domain,0,7)=="http://"){
	$wr_domain = substr($wr_domain,7);
}

if(substr($wr_domain,0,4)=="www."){
	$wr_domain = substr($wr_domain,4);
}

if($mode=="insert"){
	sql_query("insert nfor_api set wr_domain='$wr_domain',facebook_appid='$facebook_appid',facebook_appsecret='$facebook_appsecret', kakao_rest='$kakao_rest', kakao_javascript='$kakao_javascript', google_map='$google_map', google_shortener='$google_shortener'");
	alert("정상적으로 등록 되었습니다","api_list.php?$qstr");
	exit;
}

if($mode=="update"){
	sql_query("update nfor_api set wr_domain='$wr_domain',facebook_appid='$facebook_appid',facebook_appsecret='$facebook_appsecret', kakao_rest='$kakao_rest', kakao_javascript='$kakao_javascript', google_map='$google_map', google_shortener='$google_shortener' where wr_id='$wr_id'");
	alert("정상적으로 수정 되었습니다","api_form.php?wr_id=$wr_id&$qstr");
	exit;
}

include "head.php";

?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function fsubmit(f){

	if(!$("#wr_domain").val()){
		alert("도메인을 입력해주세요");
		return false;
	}


	f.action = "api_form.php";
	return true;

}	
//-->
</SCRIPT>
<style>
.input_txt { width:300px; }
</style>
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
	<th>도메인</th>
	<td>
	<input type="text" class="input_txt" name="wr_domain" id="wr_domain" value="<?=$write[wr_domain]?>" itemname="도메인">
	<span class="tex01">http:// 과 www. 을 제외한 도메인 나머지를 입력해주세요 예) nfor.kr</span>

	</td>
</tr>



<tr>
	<th>페이스북</th>
	<td>

		앱 ID : <input type="text" class="input_txt" name="facebook_appid" id="facebook_appid" value="<?=$write[facebook_appid]?>"  itemname="앱 ID">

		앱 시크릿 코드 : <input type="text" class="input_txt" name="facebook_appsecret" id="facebook_appsecret" value="<?=$write[facebook_appsecret]?>"  itemname="앱 시크릿 코드">

		<a href="https://developers.facebook.com/apps" target="_blank" class="btn_sml"><span>페이스북API 발급받기</span></a>

	</td>
</tr>

<tr>
	<th>카카오톡</th>
	<td>

		REST API 키 : <input type="text" class="input_txt" name="kakao_rest" id="kakao_rest" value="<?=$write[kakao_rest]?>"  itemname="REST API 키">

		자바스크립트 키 : <input type="text" class="input_txt" name="kakao_javascript" id="kakao_javascript" value="<?=$write[kakao_javascript]?>"  itemname="자바스크립트 키">

		<a href="https://developers.kakao.com/apps" target="_blank" class="btn_sml"><span>카카오API 발급받기</span></a>

	</td>
</tr>


<tr>
	<th>구글지도</th>
	<td>

	<input type="text" class="input_txt" name="google_map" id="google_map" value="<?=$write[google_map]?>"  itemname="구글지도">
	<a href="https://developers.google.com/maps/documentation/javascript/" target="_blank" class="btn_sml"><span>구글지도API 발급받기</span></a>

	</td>
</tr>

<tr>
	<th>구글짧은주소</th>
	<td>

	<input type="text" class="input_txt" name="google_shortener" id="google_shortener" value="<?=$write[google_shortener]?>"  itemname="구글짧은주소">
	<a href="http://code.google.com/apis/console/" target="_blank" class="btn_sml"><span>구글짧은주소API 발급받기</span></a>

	</td>
</tr>



</table>
<div class="btn_cen"><input type="image" src="img/dong_btn.gif"> <a href="api_list.php?<?=$qstr?>"><img src="img/list.gif"></a></div>
</form>

<?
include "tail.php";
?>