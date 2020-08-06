<?php	// 헤드
include_once "$nfor[path]/html_head.php";
?>

<style>
html { overflow:hidden; overflow-y:scroll; }
body { padding:0px; margin:0px; }


.tab2{position:relative;height:29px;margin-top:20px;background:url(img/tab_menu.gif) repeat-x 0 100%;font-family:'Verdana',dotum;font-size:12px}
.tab2 ul,.tab2 ul li{margin:0;padding:0}
.tab2 ul li{list-style:none}
.tab2 ul li,.tab2 ul li a{background:url(img/bg_tab2_off.gif) no-repeat}
.tab2 ul li{float:left;margin-right:-1px;line-height:26px}
.tab2 ul li a{display:inline-block;padding:2px 16px 1px;_padding:3px 16px 0;background-position: 100% 0;font-weight:bold;color:#666;text-decoration:none !important}
.tab2 ul li a:hover{color:#000}
.tab2 ul li.on,.tab2 ul li.on a{background-image:url(img/bg_tab2_on.gif)}
.tab2 ul li.on a{color:#c8202d;}
.btn_sml{display:inline-block;padding-right:4px;background:url(http://static.naver.com/groupware/2010/bg_btn_default.gif) no-repeat 100% -27px;font-family:'돋움',dotum;font-size:11px;color:#444;line-height:21px;letter-spacing:-1px;word-spacing:-1px;text-decoration:none !important;white-space:nowrap}





.order_list_tbl { border-top:solid 1px #000000; border-right:solid 1px #e4e4e4; margin-bottom:20px; }
.order_list_tbl th{ background-color:#f5f7f9; height:45px; color:#353638; border-bottom:solid 1px #e4e4e4; border-left:solid 1px #e4e4e4; font-size:12px; }
.order_list_tbl td{ background-color:#ffffff; height:74px; color:#333333; border-bottom:solid 1px #e4e4e4; border-left:solid 1px #e4e4e4; text-align:center;  font-size:12px; }
.tbl_ct td:first-child { border-left:solid 1px #fff;   }
.tbl_ct td { border-top:solid 1px #e4e4e4; border-bottom:solid 1px #fff;   }



.order_list_tbl2 { border-top:solid 1px #000000; border-right:solid 1px #e4e4e4; margin-bottom:20px; }
.order_list_tbl2 th{ background-color:#f5f7f9; height:35px; color:#353638; border-bottom:solid 1px #e4e4e4; border-left:solid 1px #e4e4e4; font-size:12px; }
.order_list_tbl2 td{ background-color:#ffffff; color:#333333; border-bottom:solid 1px #e4e4e4; border-left:solid 1px #e4e4e4; text-align:center;  font-size:12px; }



.order_list_tbl9 { border-top:solid 1px #000000; border-right:solid 1px #e4e4e4; margin-bottom:20px; }
.order_list_tbl9 th{ background-color:#f5f7f9; height:35px; color:#353638; border-bottom:solid 1px #e4e4e4; border-left:solid 1px #e4e4e4; font-size:12px; }
.order_list_tbl9 td{ background-color:#ffffff; color:#333333; border-bottom:solid 1px #e4e4e4; border-left:solid 1px #e4e4e4; text-align:center;  font-size:12px; }




.tbl_typeC { border:0px; }
.tbl_typeC th{ border:0px; text-align:left; }
.tbl_typeC td{ border:0px; text-align:left; }

</style>




<table style="width:100%;" height="800" cellpadding="0" cellspacing="0" border="0">
<tr>
	<td style="border:solid 5px #c8202d; padding:20px;" valign="top">
	<?
	include_once "mb_info.php";
	?>