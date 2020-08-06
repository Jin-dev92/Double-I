<?php
include_once $nfor[skin_path]."mypage_head.php";
?>
<style>
.item_location_wrap { width:100%; margin:0px auto 35px;border:1px solid #d9d9d9; background:#fff;  }

.location_wrap { border:solid 1px #d8d5d5; padding:10px; margin:10px 0px; background-color:#fff; line-height:35px;  }
.location_wrap table { margin:0px; width:98%}
.location_wrap table th { font-size:14px; text-align:left; font-weight:normal; padding:3px 3px; border-bottom:solid 1px #DCDCDC; }
.location_wrap table td { font-size:14px; padding:3px 3px; text-align:left; font-weight:bold; border-bottom:solid 1px #DCDCDC;  }

#map { height:500px; width:100%; }
</style>








	<select id="wr_id" style=" height:24px;">
	<option value="" disabled>매장을 선택하세요
	<?
	$que = sql_query("select * from nfor_item_location where it_id='$it_id' order by wr_id asc");
	while($data = sql_fetch_array($que)){
	?>
	<option value="<?=$data[wr_id]?>"><?=$data[wr_name]?>
	<? } ?>
	</select>



	<div id="item_location_info"><? include_once $nfor[skin_path]."inc_item_location.php"; ?></div>



<SCRIPT LANGUAGE="JavaScript">
<!--
$(document).on("change", "#wr_id", function(){

	$.get("<?=$nfor[skin_path]?>inc_item_location.php",{
		wr_id : $("#wr_id").val()
	}, function(data){
		$("#item_location_info").html(data);
		initMap();
	});


});
//-->
</SCRIPT>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?=$api[google_map]?>&callback=initMap"></script>


<?
include_once $nfor[skin_path]."mypage_tail.php";
?>