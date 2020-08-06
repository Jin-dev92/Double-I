<?php	// 팝업
include_once "path.php";

if($popup_id){
	$popup = sql_fetch("select * from `nfor_popup` where `popup_id`='$popup_id'");

	include_once "html_head.php";
?>
<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
	<td><?=nl2br($popup[wr_memo])?></td>
</tr>
<tr>
	<td height="30" bgcolor="black" style="font-size:9pt;color:#dddddd" align="right">	
	<a href="javascript:setCookie('popup_<?=$popup[popup_id]?>','<?=date("Ymd",strtotime("+$popup[wr_time] day"))?>',<?=abs($popup[wr_time])?>); self.close();" style="text-decoration:none;color:#DDDDDD"><?=$popup[wr_time]?>일동안 띄우지 않기</a>
	<b style="color:#FFFFFF">|</b>&nbsp;&nbsp;<a href="javascript:self.close();" style="text-decoration:none; color:#FFFFFF">닫기</a>
	</td>
</tr>
</table>
<?
	include_once "html_tail.php";
		
} else{

	$layer_ids = "";
	$que = sql_query("select * from `nfor_popup` where wr_sdatetime < '$nfor[ymdhis]' and wr_edatetime > '$nfor[ymdhis]' and wr_use='1' and wr_type='layer'");
	while($data=sql_fetch_array($que)){
		
		if($_COOKIE["popup_{$data[popup_id]}"] <= date("Ymd")){
			if($layer_ids) $layer_ids .= ",";
			$layer_ids .= "#popup_".$data[popup_id];
?>
			<div id="popup_<?=$data[popup_id]?>" style="position:absolute;left:50%; margin:<?=$data[wr_y_point]?>px 0px 0px <?=$data[wr_x_point]?>px; z-index:200;"><table cellpadding=0 cellspacing=0>
			<tr>
				<td align=center bgcolor="#FFFFFF" width=<?=$data[wr_width]?> height=<?=$data[wr_height]?>>
				<?=nl2br($data[wr_memo])?>
				</td>
			</tr>
			<tr>
				<td align=right height="20" bgcolor="#000000" style="color:#FFFFFF;">
					<a onclick="setCookie('popup_<?=$data[popup_id]?>','<?=date("Ymd",strtotime("+$data[wr_time] day"))?>',<?=abs($data[wr_time])?>); $('#popup_<?=$data[popup_id]?>').fadeOut();" style="color:#FFFFFF; cursor:hand;"><?=$data[wr_time]?>일동안 띄우지 않기</a> |
					<a onclick="$('#popup_<?=$data[popup_id]?>').fadeOut();" style="color:#FFFFFF; cursor:hand;">닫기</a>
				</td>
			</tr>
			</table>
			</div>
<?

		}

	}
?>
<SCRIPT LANGUAGE="JavaScript">
<!--

$(document).ready(function(){

<?	
	$sql = "select * from `nfor_popup` where wr_sdatetime < '$nfor[ymdhis]' and wr_edatetime > '$nfor[ymdhis]' and wr_use='1' and wr_type='window'";
	$que = sql_query($sql);
	while($data=sql_fetch_array($que)){
		if($_COOKIE["popup_{$data[popup_id]}"] <= date("Ymd")){
			$data[wr_height] = $data[wr_height]+30;
			echo "window.open('popup.php?popup_id={$data[popup_id]}','popup_{$data[popup_id]}','toolbar=no, width={$data[wr_width]}, height={$data[wr_height]}, left={$data[wr_x_point]}, top={$data[wr_y_point]}');\n"; 
		}
	}
	
	if($layer_ids){ 
?>
	$("<?=$layer_ids?>").draggable({	// 드레그
		start: function() {$(this).css("opacity","0.5");},	// 흐리게
		stop: function() {$(this).css("opacity","1");}	// 진하게
	});
<? } ?>

});	
//-->
</SCRIPT>
<? } ?>
<!-- 팝업 -->
