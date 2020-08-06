<?php
include_once $nfor[skin_path]."head.php";
?>

<div id="map"></div>

<SCRIPT LANGUAGE="JavaScript">
<!--
function initMap() {

  var title = "<?=$location[wr_name]?>";

  var latlng = { lat: <?=$location[wr_lat]?$location[wr_lat]:$nfor[default_lat]?>, lng: <?=$location[wr_lng]?$location[wr_lng]:$nfor[default_lng]?> };
  var map = new google.maps.Map(document.getElementById('map'), {
	zoom: 15,
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

<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?=$api[google_map]?>&callback=initMap"></script>

<style>
html, body { height:100%; }
#wrap { height:100%;}
#container { height:100%;}
#map { height:100%; }
</style>

<?
include_once $nfor[skin_path]."tail.php";
?>