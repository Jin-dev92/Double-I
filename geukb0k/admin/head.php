<?php	// 헤더
include_once "$nfor[path]/lib/thumb.lib.php";
include_once "$nfor[path]/lib/editor.lib.php";

preg_match("/오늘:(.*),어제:(.*),최대:(.*),전체:(.*)/", $config[cf_count], $count);
settype($count[0], "integer");
settype($count[1], "integer");
settype($count[2], "integer");
settype($count[3], "integer");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=$config[cf_title]?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$nfor[charset]?>" />
<link rel="stylesheet" href="style.css" type="text/css">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" type="text/css" media="all" />
<script src="<?=$nfor[path]?>/js/jquery-1.9.1.js"></script>
<script src="<?=$nfor[path]?>/js/jquery-ui.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=$nfor[path]?>/js/nfor.js"></script>
<script type="text/javascript" src="<?=$nfor[path]?>/js/jquery.timepicker.js"></script>
<script type="text/javascript" src="<?=$nfor[path]?>/js/jquery.countdown.min.js"></script>

<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>

<style type="text/css">
<!--
.ui-datepicker { font:12px dotum; }
.ui-datepicker select.ui-datepicker-month, 
.ui-datepicker select.ui-datepicker-year { width: 70px;}
.ui-datepicker-trigger { margin:0 0 -5px 2px; }
-->
</style>
<script src="<?=$nfor[path]?>/editor/cheditor.js"></script>
<SCRIPT LANGUAGE="JavaScript">
<!--
var nfor_path      = "<?=$nfor[path]?>";

$(document).ready(function($) {

	$.datepicker.regional['ko'] = {
		closeText: '닫기',
		prevText: '이전달',
		nextText: '다음달',
		currentText: '오늘',
		monthNames: ['1월(JAN)','2월(FEB)','3월(MAR)','4월(APR)','5월(MAY)','6월(JUN)',
		'7월(JUL)','8월(AUG)','9월(SEP)','10월(OCT)','11월(NOV)','12월(DEC)'],
		monthNamesShort: ['1월','2월','3월','4월','5월','6월',
		'7월','8월','9월','10월','11월','12월'],
		dayNames: ['일','월','화','수','목','금','토'],
		dayNamesShort: ['일','월','화','수','목','금','토'],
		dayNamesMin: ['일','월','화','수','목','금','토'],
		weekHeader: 'Wk',
		dateFormat: 'yy-mm-dd',
		firstDay: 0,
		isRTL: false,
		showMonthAfterYear: true,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['ko']);


});

jQuery(function($){
	$(function() {
		var dates = $( "#od_sdate, #od_edate" ).datepicker({
			showOn: 'button',
			buttonImage: 'img/calendar.gif',
			buttonImageOnly: true,
			buttonText: "달력",
			changeMonth: true,
			numberOfMonths: 1,
			onSelect: function( selectedDate ) {
				var option = this.id == "od_edate" ? "maxDate" : "minDate",
					instance = $( this ).data( "datepicker" );
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
	});
});
//-->
</script>
</head>
<body>
<div id="xdialog" style="display: none; padding:10px;"/></div>
<div id="xdialog2" style="display: none; padding:10px;"/></div>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td width="207" height="69"><a href="index.php"><img src="img/main_logo.jpg" alt="처음으로"></a></td>
	<td>


	<table border="0" cellpadding="0" cellspacing="0" border="0">
	<tr>
	<?
	for($i=1; $i<count($nfor[admin_tab]); $i++){
		$tab_link = sql_fetch("select * from nfor_access a, nfor_access_group b where a.gp_id=b.gp_id and b.gp_group='{$nfor[admin_tab][$i]}' and a.access_level<='$member[is_supply]' and a.access_path='0' order by b.gp_rank desc, access_rank desc");
		if($tab_link[access_file]){
	?>
		<td width="131" style="padding:36px 1px 0px 0px;"><a href="<?=$tab_link[access_file]?>"><img src="img/admin_menu<?=sprintf("%02d",$i)?><?=$menu_code[gp_group]==$nfor[admin_tab][$i]?"_ov":""?>.jpg" alt="<?=$nfor[admin_tab][$i]?>"></a></td>
	<?
		}

	}
	?>
	</tr>
	</table>


	</td>
</tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td align="center" width="207" valign="top">


	<table border="0" cellpadding="0" cellspacing="0" width="182" background="img/middlebg.jpg">
	<tr>
		<td background="img/top_bg.jpg" height="56">

		<table border="0" cellpadding="0" cellspacing="0" align="center">
		<tr>
			<td style="text-align:left;">
				<p style="color:#feff00; font-size:8pt; font-family:돋움; padding:0px; margin:5px 0px 0px 0px;">오늘날짜</p>
				<p style="color:#ffffff; font-size:8pt; font-family:돋움; padding:0px; margin:7px 0px 0px 0px;"><?=date("y.m.d")?></p>
			</td>
			<td>

						<?
						$second = strtotime(date("Y-m-d 23:59:59"))-time();
						sscanf(date('His',$second-32400),'%2d%2d%2d',$h,$i,$s);
						?>
						<script type="text/javascript">
						$(function () {
							var austDay = new Date(<?=strtotime(date("Y-m-d 23:59:59"))*1000?>);
							$('#countdown').countdown({until: austDay,  layout: '<span>{hnn}</span>:<span>{mnn}</span>:<span>{snn}</span>' });
						});
						</script>
						<div id='countdown' style="font-weight: bold; font-family: trebuchet ms; font-size: 24px; color: #ffffff;">
						<span><?=sprintf("%02d",$h)?></span>:<span><?=sprintf("%02d",$i)?></span>:<span><?=sprintf("%02d",$s)?></span>
						</div>

			</td>
		</tr>
		</table>

		</td>
	</tr>
	<tr>
		<td background="img/middlebg.jpg" style="font-size:8pt; font-family:돋움; color:#ffffff; padding:5px 0px 0px 10px; line-height:15px; text-align:left;">
		버전 : <span style="color:#FEEA00;font-weight:bold;"><?=$nfor[version]?></span><br>
		<? if($is_admin){ ?>금일 방문자수 : <?=number_format($count[1])?>명<? } ?>
		<a href="<?=$nfor[path]?>/logout.php?url=<?=dirname($_SERVER[PHP_SELF])?>/login.php"><img src="img/change_btn.jpg" alt="로그아웃" align="absmiddle"></a>
		</td>
	</tr>
	<tr>
		<td background="img/bottom.jpg" height="8">
		</td>
	</tr>
	</table>




	<table background="img/bottom.jpg" border="0" cellpadding="0" cellspacing="0" width="182" style="margin-top:7px;">
	<tr>
		<td><a href="<?=$nfor[url]?>" target="_blank"><img src="img/shopgo_btn.jpg" alt="내상점 바로가기"></a></td>
	</tr>
	</table>




	<?
	$sql = "select * from nfor_access a, nfor_access_group b where a.gp_id=b.gp_id and b.gp_group='$menu_code[gp_group]' and a.access_level<='$member[is_supply]' group by b.gp_id order by b.gp_rank desc";
	$que = sql_query($sql);
	while($data = sql_fetch_array($que)){
	?>	
	<table border="0" cellpadding="0" cellspacing="0" width="182" style="margin-top:7px;" background="img/leftmenu_bg_middle.jpg">
	<tr>
		<td background="img/leftmenu_bg_top.jpg" height="46" style="text-align:left; font-family:'굴림'; font-size:12px; color:#FFFFFF; padding-left:15px;">
		<?=$data[gp_text]?>
		</td>
	</tr>
	<tr>
		<td background="img/leftmenu_bg_middle.jpg" style="text-align:left; padding-left:15px;">

		<table border="0" cellpadding="0" cellspacing="0">
		<?
		$que2 = sql_query("select * from nfor_access where gp_id='$data[gp_id]' and access_path='0' and access_level<='$member[is_supply]' order by access_rank desc");
		while($data2 = sql_fetch_array($que2)){
		?>	
		<tr>
			<td height="18"><a href="<?=$data2[access_file]?>" style="<? if($access_code==$data2[access_code]) echo "font-weight:bold;"; ?>"><?=$data2[access_text]?></a> <?=$menu_cnt[$data2[access_code]]?"[".$menu_cnt[$data2[access_code]]."]":""?> 
			</td>
		</tr>
		<? } ?>
		</table>

		</td>
	</tr>
	<tr>
		<td background="img/leftmenu_bg_bottom.jpg" height="7"></td>
	</tr>
	</table>
	<? } ?>

	<table border="0" cellpadding="0" cellspacing="0" width="182" style="margin-top:7px;" background="img/leftmenu_bg_middle.jpg">
	<tr>
		<td background="img/leftmenu_bg_top.jpg" height="46" style="text-align:left; font-family:'굴림'; font-size:12px; color:#FFFFFF; padding-left:15px;">
		관리메모
		</td>
	</tr>
	<tr>
		<td background="img/leftmenu_bg_middle.jpg" align="center" valign="top">
		
		<form id="admin_memo_form" method="post" action="admin_memo_update.php">
		<table border="0" cellpadding="0" cellspacing="0" width="86%">
		<tr>
			<td><textarea name="admin_memo" rows="10" style="width:100%;"><?=$member[admin_memo]?></textarea></td>
		</tr>
		<tr>
			<td><input type="button" onclick="admin_memo_update()" value="메모저장" style="width:100%; margin:5px 0px 5px 0px;"></td>
		</tr>
		<tr>
			<td style="font-family:돋움; font-size:11px;"><b style="letter-spacing:-1px;">최종저장</b> <span id="admin_memo_datetime"><?=$member[admin_memo_datetime]?></a></td>
		</tr>
		</table>			
		</form>

		</td>
	</tr>
	<tr>
		<td background="img/leftmenu_bg_bottom.jpg" height="7"></td>
	</tr>
	</table>


	</td>
	<td  valign="top">

		<table border="0" cellpadding="0" cellspacing="0" width="100%"  bgcolor="#FFFFFF" style="border:7px solid #0081E6;">
		<tr>
			<td style="padding:10px;"valign="top">&nbsp;
			<?
			if($menu_code){
			?>	
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td><img src="img/main_dot.gif" align="absmiddle"><span  style="font-size: 16px; color:#000; font-family: verdana,돋움체; text-decoration:none; font-weight:bold; text-align:left;letter-spacing:-1px;"><?=$menu_code[access_text]?></span></td>
						<td align="right"><span class="loc01"><?=$menu_code[gp_group]?> > <?=$menu_code[gp_text]?> > </span> <span class="loc02"><?=$menu_code[access_text]?></span></td>
					</tr>
					</table>
			<? } ?>
			</td>
		</tr>
		<tr>
			<td style="padding:20px;" valign="top">