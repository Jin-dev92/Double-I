<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=<?=$nfor[charset]?>">
<title><?=$config[cf_title]?></title>
<style type="text/css"> 
* {margin:0;padding:0;}
body {color:#888; font:12px 돋움,Dotum,AppleGothic,sans-serif; text-align:center;}
ul, li , ol {list-style-type:none;}
img{border:none;}
a {color:#000; text-decoration:underline;}
#wrap {width:600px; height:600px; position:absolute; top:50%; left:50%; margin:-270px 0 0 -294px; text-align:left;}
#header {position:relative; height:130px;}
#header h1 {position:relative; left:-4px; top:-20px;}
#container {width:600px; border-top:3px solid #3d3d3d; border-bottom:3px solid #3d3d3d; }
#container h2 {margin:30px 0 0 30px;}
#container .caution {width:588px; margin:16px 36px 0; padding-bottom:15px; border:1px solid #e4e4e4; background-color:#fdfdfd;}
#container .caution h3 {margin:19px 0 0 18px;}
#container .caution ul {margin:10px 0 0 17px;}
#container .caution ul li {padding:0 0 13px 8px; color:#7a7a7a; letter-spacing:-1px; line-height:18px;}
#container .caution strong {font-weight:normal; color:#3b3b3b;}
#container .caution p {margin:-3px 0 0 25px;color:#7a7a7a; letter-spacing:-1px; }
#container .loadingbar {height:32px; padding:22px 0 27px 218px;}
#footer{text-align:center; padding-top:17px;}

.indexlogo2 { margin:110px auto 20px; width:272px; height:96px; display:block; background:url("/skin/demo/img/logo.png") -0px -0px no-repeat; text-indent:-9999px; }

</style>
<SCRIPT LANGUAGE="JavaScript">
<!--
window.onload = function (){
  setTimeout("document.nfor.submit();", 2000);
}	
//-->
</SCRIPT>

</head>
<body>
 
<div id="wrap" style="background-color:#FFF">
    <div id="header">
        <h1><a href="/"><div class="indexlogo2"></div></a></h1>
    </div>
    <div id="container">

        <div class="caution">
          <ul>
       	    <li style="font-weight:bold;">"극복"은 각 병의원 비급여항목 상품에 직접 관여하지 않으며<br>결제시스템(신용카드, 계좌이체, 무통장입금)과 관련된 취소 및<br> 환불의 의무와 책임은 각 병의원에 있습니다. <br>해당 병의원의 비급여항목 결제 전 상세정보와 유의사항을 반드시 확인 하시기 바랍니다.</li>
            </ul>
        </div>        
        <div class="loadingbar">
<div class="ly_loading">

<table>
<tr>
	<td align="center"><img alt="로딩중" src="http://static.naver.com/common/loading/load_b01_01.gif" width="150" height="13"><br><br></td>
</tr>
</table>
</div>
</div>
    </div>
    <div id="footer">
  copyright @ storehome all rights reserved. </div>
</div>

<form method="post" name="nfor" action="<?=$nfor[url]."/item.php?it_id=".$item[it_id]?>" style="margin:0px; padding:0px;"><input type="hidden" name="nfor_id" value="<?=$_REQUEST[PHPSESSID]?>"></form>

</body>
 
</html>