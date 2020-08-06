<?php	// 사용처관리
include "path.php";
$qstr .= "&it_id=$it_id";

item_access($it_id);

$write = sql_fetch("select * from nfor_item_location where wr_id='$wr_id'");

if($mode=="insert"){
	sql_query("insert nfor_item_location set wr_name='$wr_name',wr_address='$wr_address',wr_tel='$wr_tel',wr_lng='$wr_lng',wr_lat='$wr_lat',it_id='$it_id'");
	alert("정상적으로 등록 되었습니다","item_location_list.php?$qstr");
	exit;
}

if($mode=="update"){
	
	sql_query("update nfor_item_location set wr_name='$wr_name',wr_address='$wr_address',wr_tel='$wr_tel',wr_lng='$wr_lng',wr_lat='$wr_lat',it_id='$it_id' where wr_id='$wr_id'");
	alert("정상적으로 수정 되었습니다","item_location_list.php?$qstr");
	exit;
}

include "head.php";
?>	

<style>
.input_txt { width:100%; }
</style>

<SCRIPT LANGUAGE="JavaScript">
<!--
function fsubmit(f){
	if(!$("#wr_name").val()){
		alert("업체명을 입력해주세요");
		return false;
	}
	if(!$("#wr_address").val()){
		alert("주소를 입력해주세요");
		return false;
	}
	if(!$("#wr_tel").val()){
		alert("전화번호를 입력해주세요");
		return false;
	}
	f.action = "item_location_form.php";
	return true;	    
}	
//-->
</SCRIPT>
<form name="fwrite" method="post" onsubmit="return fsubmit(this)">
<input type="hidden" name="mode" value="<?=$write[it_id]?"update":"insert"?>">
<input type="hidden" name="wr_id" value="<?=$write[wr_id]?>">
<input type="hidden" name="it_id" value="<?=$write[it_id]?$write[it_id]:$it_id?>">
<input type="hidden" name="wr_lat" id="wr_lat" value="<?=$write[wr_lat]?>">
<input type="hidden" name="wr_lng" id="wr_lng" value="<?=$write[wr_lng]?>">


<table class="tbl_type" cellpadding="0" cellspacing="0">
<tr>
	<th width="100">업체명</th>
	<td><input type="text" class="input_txt" name="wr_name" id="wr_name" value="<?=$write[wr_name]?>"></td>
</tr>
<tr>
	<th>주소</th>
	<td><input type="text" class="input_txt" name="wr_address" id="wr_address" value="<?=$write[wr_address]?>"></td>
</tr>
<tr>
	<th>전화번호</th>
	<td><input type="text" class="input_txt" name="wr_tel" id="wr_tel" value="<?=$write[wr_tel]?>"></td>
</tr>
<tr>
	<th>지도</th>
	<td>
	

	<style>
	#map { height:500px; width:100%; }
	</style>
		
	<div id="map"></div>


	<SCRIPT LANGUAGE="JavaScript">
	<!--
	var map;
	var markers = [];

	function initMap() {
	  var haightAshbury = { lat: <?=$write[wr_lat]?$write[wr_lat]:$nfor[default_lat]?>, lng: <?=$write[wr_lng]?$write[wr_lng]:$nfor[default_lng]?> };
	  map = new google.maps.Map(document.getElementById('map'), {
		zoom: 12,
		center: haightAshbury
	  });
	  map.addListener('click', function(event) {
		var nfor_latlng = event.latLng;
		$("#wr_lat").val(nfor_latlng.lat());
		$("#wr_lng").val(nfor_latlng.lng());
		deleteMarkers();		
		addMarker(nfor_latlng);
	  });
	  <? if($write[wr_lat] and $write[wr_lng]){ ?>
	  addMarker(haightAshbury);
	  <? } ?>
	}

	function addMarker(location) {
	  var marker = new google.maps.Marker({
		position: location,
		map: map
	  });
	  markers.push(marker);
	}

	function deleteMarkers() {
	  for (var i = 0; i < markers.length; i++) {
		markers[i].setMap(null);
	  }
	  markers = [];
	}
	//-->
	</SCRIPT>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?=$api[google_map]?>&callback=initMap"></script>


	</td>
</tr>
</table>
<div class="btn_cen"><input type="image" src="img/dong_btn.gif"> <a href="item_location_list.php?<?=$qstr?>"><img src="img/list.gif"></a></div>
</form>



<?
include "tail.php";
?>