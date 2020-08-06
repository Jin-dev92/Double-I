<?php
include "path.php";
$mb_id = get_cookie("chk_save_id");
if(!$mb_id) $mb_id = "";

if($nfor[test]){
	$mb = sql_fetch("select * from nfor_member where mb_no='1'");
	if($nfor[id_type] == "mb_email"){
		$mb_id = $mb[mb_email];
	} else{
		$mb_id = $mb[mb_id];
	}
	$mb_password = $nfor[test_password];
} else{
	$mb_password = "";
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="Content-Script-Type" content="text/javascript"/>
<meta http-equiv="Content-Style-Type" content="text/css"/>
<title><?=$config[cf_name]?></title>

<style type="text/css"> 
/* Common */
body,p,h1,h2,h3,h4,h5,h6,ul,ol,li,dl,dt,dd,table,th,td,form,fieldset,legend,input,textarea,button,select{margin:0;padding:0;}
body,input,textarea,select,button,table{color:#2e2e2e;font-family:'나눔고딕',NanumGothic,'돋움',Dotum,AppleGothic,sans-serif;font-size:12px;line-height:16px}
img,fieldset{border:0}
ul,ol{list-style:none}
em,address{font-style:normal}
a{text-decoration:none}
a:hover,a:active,a:focus{text-decoration:underline}
 
/* Layout */
body{text-align:center;}
#wrap{width:960px;margin:0 auto;text-align:left;background-color:2e2e2e;}
#header{position:relative;}
.text{}
#footer{clear:both;margin:20px 0;color:#302f2e;font-size:11px;text-align:center;font-style:normal}
#footer em{font-family:verdana}
#footer a{color:#ffffff;font-weight:bold;text-decoration:none}
#wrap #container #content center table tr td table tr td #textfield {
	font-family: "돋움";
	font-size: 12px;
	color:#fff;
	background-color: #9ea5ad;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-color: #909090;
	border-right-color: #909090;
	border-bottom-color: #909090;
	border-left-color: #909090;
	height: 25px;
	padding-left: 5px;
}
/* Content */
#container{clear:both;width:960px;background:url(/admin/img/index_bg01.gif) no-repeat 0 0;}
</style>
</head>
<body bgcolor="#2e2e2e">

<div id="wrap">
<!-- container -->
  <div id="container">
		<!-- content -->
		<div id="content">
		  <center style="display:block;width:960px;padding:300px 0;color:#ccc">
		<form id="flogin" method="post" action="<?=$nfor[path]?>/login_check.php">
		<INPUT TYPE="hidden" NAME="url" value="<?=dirname($_SERVER[PHP_SELF])?>">

		<table width="514" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td>
				<p><img src="img/logo_index.png"  alt=""/></p><BR/>
				</td>
				</tr>
				<tr>
				<td align="center" valign="middle" style="border:solid #3d3e3f 5px; background-color:#6c6c6c;">
				<p>&nbsp;</p>
						<table border="0" cellspacing="4" cellpadding="0">
						<tr>
						<td><img src="img/id_title01.gif" alt=""/></td>
						<td>
						<input name="mb_id" type="text" value="<?=$mb_id?>" tabindex="1" id="mb_id" size="40" style="font-family: 돋움;font-size: 12px;color:#fff;background-color: #9ea5ad;border-top-width: 1px;border-right-width: 1px;border-bottom-width: 1px;border-left-width: 1px;border-top-color: #909090;border-right-color: #909090;border-bottom-color: #909090;border-left-color: #909090;height: 22px;padding-left: 5px">
						</td>
						<td rowspan="3"><input type="image" src="img/login_btn01.gif"  alt=""/></td>
						</tr>
						<tr>
						<td><img src="img/id_title02.gif"  alt=""/></td>
						<td>
						<input name="mb_password" type="password" value="<?=$mb_password?>" tabindex="2" id="mb_password" size="40" style="font-family: 돋움;font-size: 12px;color:#fff;background-color: #9ea5ad;border-top-width: 1px;border-right-width: 1px;border-bottom-width: 1px;border-left-width: 1px;border-top-color: #909090;border-right-color: #909090;border-bottom-color: #909090;border-left-color: #909090;height: 22px;padding-left: 5px">
						</td>
						</tr>
						</table>
				<p>&nbsp;</p>
				</td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				</tr>
		</table>


<input type='checkbox' id='save_id' name='save_id' value="1" <?=$chk_save_id?"checked":""?> onclick="if(this.checked){ if(confirm(('공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n아이디를 저장하시겠습니까?'))){ this.checked = true; } else{ this.checked = false; } }"> 아이디 저장

&nbsp;&nbsp;&nbsp;

<input type="checkbox" name="auto_login" value="1" onclick="if (this.checked) { if (confirm('자동로그인을 사용하시면 다음부터 회원아이디와 패스워드를 입력하실 필요가 없습니다.\n\n\공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?')) { this.checked = true; } else { this.checked = false; } }">
자동로그인


		</form>
</center>
		</div>
		<!-- //content -->
	</div>
	<!-- //container -->
	<!-- footer -->
	<address id="footer">
	 <a href="http://nfor.net" target="_blank">Copyright <em>&copy;</em>nfor social commerce All Rights Reserved.</a>	
	</address>
	<!-- //footer -->
</div>
</body>
</html>