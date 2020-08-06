<?
include_once "path.php";

if($wr_id){
	$location = sql_fetch("select * from nfor_item_location where wr_id='$wr_id'");
} else{
	$location = sql_fetch("select * from nfor_item_location where it_id='$it_id' order by wr_id asc");
}

?><div class="location_wrap">

	<table>
	<colgroup>
		<col width="80">
		<col>
	</colgroup>
	<tbody>
	<tr>
		<th>업체명</th>
		<td><?=$location[wr_name]?></td>
	</tr>
	<tr>
		<th>주소</th>
		<td><?=$location[wr_address]?></td>
	</tr>
	<tr>
		<th>전화번호</th>
		<td><?=$location[wr_tel]?></td>
	</tr>
	</tbody>
	</table>

</div>


<div id="map"></div>	


<div class="table son">
<div class="table-row">
	<div class="table-cell table-left"><a href="item_location_big.php?it_id=<?=$location[it_id]?>&wr_id=<?=$location[wr_id]?>" class="table-btn">지도확대</a></div>
	<div class="table-cell table-right"><a href="tel:<?=str_number($location[wr_tel])?>" class="table-btn">전화걸기</a></div>
</div>
</div>

<style>
.son { margin:10px 0px; }
.son .table-left{ padding-right:5px;}
.son .table-right{ padding-left:5px;}
.son .table-cell a { background-color:#fff; }
</style>

<SCRIPT LANGUAGE="JavaScript">
<!--

function initMap(){

  var title = "<?=$location[wr_name]?>";

  var latlng = { lat: <?=$location[wr_lat]?$location[wr_lat]:$nfor[default_lat]?>, lng: <?=$location[wr_lng]?$location[wr_lng]:$nfor[default_lng]?> };
  var map = new google.maps.Map(document.getElementById('map'), {
	zoom: 14,
	center: latlng
  });

  var infowindow = new google.maps.InfoWindow({
	content: title
  });

  var marker = new google.maps.Marker({
	position: latlng,
	map: map,
	title: title
  });
  marker.addListener('click', function() {
	infowindow.open(map, marker);
  });
}
//-->
</SCRIPT>
