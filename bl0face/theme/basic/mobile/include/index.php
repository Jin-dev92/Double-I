<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_MOBILE_PATH.'/head.php');
?>
<!--	################ 20170206팝업 ################ -->
<style media="screen">
  #aa{display: none;position: absolute;top: 0;z-index: 99999}
</style>
<div id="aa">
<canvas id="myCanvas" width="1920px" height="6000px">This browser doesn't support canvas</canvas>
</div>
<script>
	function closeWin0120(){
		document.all['popup0120'].style.visibility = "hidden";
	}
	function closeWin0121(){
		document.all['popup0121'].style.visibility = "hidden";
	}
	function setCookie( name, value, expiredays ) {
	 var todayDate = new Date();
	  todayDate.setDate( todayDate.getDate() + expiredays );
	  document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
	 }
	 function closeTodayWin20() {
		 if ( document.form20170120.chkbox ){
		  setCookie( "popup0120", "done" , 1 );
		 }
	 document.all['popup0120'].style.visibility = "hidden";
	}
	function closeTodayWin21() {
		if ( document.form20170121.chkbox ){
		 setCookie( "popup0121", "done" , 1 );
		}
	document.all['popup0121'].style.visibility = "hidden";
 }
</script>
<!-- <div id="popup0120" style="position:absolute; margin:0 auto; width:100%; z-index: 13; top:100px; ">
	<div id="eventpop1121" style="display:block; margin:0 auto; width:500px;">
		<div id="theLayer1121" style="position:absolute; width:500px; margin:0 auto; ">
			<div>
        <a href="javascript:closeWin0120();">
        <div style="position:absolute; right:10px; top:10px; width:45px; height:45px; "><img src="/theme/basic/img/pop/X.png" style="width:100%;" alt=""></div></a>
				<img src="/theme/basic/mobile/img/pop/biopop1101_m.jpg?<?=rand()?>" border="0" usemap="#map0120" >
				<map id="map0120" name="map0120">
					<area shape="rect" alt="이벤트 페이지 바로가기" title="이벤트 페이지 바로가기" coords="57,325,217,375" href="http://www.bioface.kr/bbs/board.php?bo_table=event_kor&wr_id=17" target="" />
					<area shape="rect" alt="온라인상담 바로가기" title="온라인상담 바로가기" coords="286,326,447,376" href="http://www.bioface.kr/bbs/board.php?bo_table=online_kor" target="" />
					<area shape="rect" alt="이벤트 페이지 바로가기" title="이벤트 페이지 바로가기" coords="54,782,217,832" href="http://www.bioface.kr/bbs/board.php?bo_table=event_kor&wr_id=18" target="" />
					<area shape="rect" alt="온라인상담 바로가기" title="온라인상담 바로가기" coords="284,780,448,830" href="http://www.bioface.kr/bbs/board.php?bo_table=online_kor" target="" />
				</map>
			</div>
			<div style="position:absolute; z-index: 13; top:10px; left:15px;">
				<form name="form20170120">
					<input type="hidden" name='chkbox' value="checkbox"><a href="javascript:closeTodayWin20();" onfocus="this.blur();"><img src="/theme/basic/img/pop/todayend_w.png" border="0"></a>
				</form>
			</div>
		</div>
	</div>
</div> -->

<!-- <div id="popup0121" style="position:absolute; margin:0 auto; width:100%; z-index: 333; top:100px; ">
	<div id="eventpop1121" style="display:block; margin:0 auto; width:500px;">
		<div id="theLayer1121" style="position:absolute; width:500px; margin:0 auto; ">
			<div>
				<a href="javascript:closeWin0121();">
				<div style="position:absolute; right:10px; top:10px; width:45px; height:45px; "><img src="/theme/basic/img/pop/X.png" style="width:100%;" alt=""></div></a>
				<img src="/theme/basic/img/pop/170921biopopup.jpg" border="0" usemap="#map0122" style="width:500px;">
				<map name="map0122">
				</map>
			</div>
			<div style="position:absolute; z-index: 12;  margin-top:-20px; right:5px; float:left;">
				<form name="form20170121">
					<input type="hidden" name='chkbox' value="checkbox"><a href="javascript:closeTodayWin21();" onfocus="this.blur();"><img src="/theme/basic/img/pop/todayend.png" border="0"></a>
				</form>
			</div>
		</div>
	</div>
</div> -->
<!--################ 팝업 ################ -->
<script>
  function closeWin0122(){
		document.all['popup0122'].style.visibility = "hidden";
	}
	function setCookie( name, value, expiredays ) {
	 var todayDate = new Date();
	  todayDate.setDate( todayDate.getDate() + expiredays );
	  document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
	 }

  function closeTodayWin21() {
    if ( document.form20170122.chkbox ){
     setCookie( "popup0122", "done" , 1 );
    }
  document.all['popup0122'].style.visibility = "hidden";
 }
</script>

<!-- <div id="popup0122" style="position:absolute; margin:0 auto; width:100%; z-index: 15; top:100px; ">
	<div id="eventpop1121" style="display:block; margin:0 auto; width:500px;">
    <div id="theLayer1121" style="position:absolute; width:500px; margin:0 auto; ">
      <div>
        <a href="javascript:closeWin0122();">
        <div style="position:absolute; right:10px; top:10px; width:45px; height:45px; "><img src="/theme/basic/img/pop/X_w.png" style="width:100%;" alt=""></div></a>
        <img src="/theme/basic/img/pop/biopop1226.jpg?<?=rand()?>" border="0">
      </div>
      <div style="position:absolute; z-index: 12; float:left; right:5px; bottom:5px;">
        <form name="form20170122">
          <input type="hidden" name='chkbox' value="checkbox"><a href="javascript:closeTodayWin21();" onfocus="this.blur();"><img src="/theme/basic/img/pop/todayend_w.png" border="0"></a>
        </form>
      </div>
    </div>
	</div>
</div> -->
<script language="Javascript">
	cookiedata = document.cookie;

  if ( cookiedata.indexOf("popup0122=done") < 0 ){
  document.all['popup0122'].style.visibility = "visible";
  }
  else {
  document.all['popup0122'].style.visibility = "hidden";
  }
</script>

<!--################ 팝업 ################ -->

<script language="Javascript">
	cookiedata = document.cookie;
	if ( cookiedata.indexOf("popup0120=done") < 0 ){
	document.all['popup0120'].style.visibility = "visible";
	}
	else {
	document.all['popup0120'].style.visibility = "hidden";
	}
	if ( cookiedata.indexOf("popup0121=done") < 0 ){
	document.all['popup0121'].style.visibility = "visible";
	}
	else {
	document.all['popup0121'].style.visibility = "hidden";
	}
</script>
<!--################ 팝업 ################ -->


<link rel="stylesheet"  href="/theme/basic/mobile/css/lightslider.css"/>
<script src="/theme/basic/mobile/js/lightslider.js"></script>

	<div class="mobile_main">

		<div class="main_01">
			<img src="/theme/basic/mobile/img/mobile_main_01.jpg" >

			<img src="/theme/basic/mobile/img/mobile_main_02_1.jpg" usemap="#main_1">
				<map name="main_1">
					<area shape="rect" coords="340,302,585,393" href="/theme/basic/sub02/sub01.php" />
				</map>
			<img src="/theme/basic/mobile/img/mobile_main_02_2.jpg"usemap="#main_2">
				<map name="main_2">
					<area shape="rect" coords="47,286,296,378" href="/theme/basic/sub02/sub09.php" />
				</map>

		</div>

		<div class="main_02">
			<img src="/theme/basic/mobile/img/mobile_main_03.jpg" >

		</div>

		<div class="su_gif">
			<img src="/theme/basic/mobile/img/ssussu.gif" >
		</div>

		<div class="main_03">
			<img src="/theme/basic/mobile/img/mobile_main_04.jpg" usemap="#main_3">
				<map name="main_3">
					<area shape="rect" coords="191,595,461,709" href="/bbs/board.php?bo_table=filler_lab_kor" />
				</map>

		</div>

		<div  class="main_04">
			<img src="/theme/basic/mobile/img/mobile_main_05.jpg"  usemap="#main_4">
				<map name="main_4">
					<area shape="rect" coords="186,426,453,531" href="/bbs/board.php?bo_table=filler_review_kor" />
				</map>
		</div>

		<div class="main_05">
			<ul id="content-slider1" class="content-slider">
				<li><img src="/theme/basic/mobile/img/mobile_sl01.jpg"></li>
				<li><img src="/theme/basic/mobile/img/mobile_sl02.jpg"></li>
				<li><img src="/theme/basic/mobile/img/mobile_sl03.jpg"></li>
				<li><img src="/theme/basic/mobile/img/mobile_sl04.jpg"></li>
			</ul>
		</div>
		<div class="main_06">
			<img src="/theme/basic/mobile/img/mobile_main_08.jpg" usemap="#main_05">
				<!--필러 히스토리 -->
				<map name="main_05">
					<area shape="rect" coords="64,137,413,208" href="https://www.youtube.com/channel/UCuitF5ApGjfZ5q3HPjPSUNw" target="_blank"/>
				</map>
				<div class="main_video">
				<iframe width="500" height="280" src="https://www.youtube.com/embed/njEvj4HcSGA" frameborder="0" allowfullscreen></iframe>
				</div>
		</div>
		<div class="main_07">
			<div id="map_view" style="width:100%; min-width:600px; height:350px;"></div>
		</div>
	</div>
</div>
	<!-- 구글 지도 스크립트 -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyKavMrNQhkaunhn7zcv1gq--Nq-7zUcM&callback=initMap"></script>
	<script>
		function initMap() {

			/*
				http://openapi.map.naver.com/api/geocode.php?key=f32441ebcd3cc9de474f8081df1e54e3&encoding=euc-kr&coord=LatLng&query=서울특별시 강남구 강남대로 456
				위의 링크에서 뒤에 주소를 적으면 x,y 값을 구할수 있습니다.
			*/
			var Y_point			= 37.517381;		// Y 좌표
			var X_point			= 127.021275;		// X 좌표

			var zoomLevel		= 18;						// 지도의 확대 레벨 : 숫자가 클수록 확대정도가 큼

			var markerTitle		= "비오페이스의원";				// 현재 위치 마커에 마우스를 오버을때 나타나는 정보
			var markerMaxWidth	= 300;						// 마커를 클릭했을때 나타나는 말풍선의 최대 크기

			// 말풍선 내용
			var contentString	= '<div>' +
			'<h2>비오페이스의원</h2>'+
			'<p>비오페이스는7만 cc의 필러 시술 부분에서<br />' +
			'단 0건의 혈관 부작용을 자랑하는 필러전문병원 입니다.</p>' +
			//'<a href="http://www.daegu.go.kr" target="_blank">http://www.daegu.go.kr</a>'+ //링크도 넣을 수 있음
			'</div>';

			var myLatlng = new google.maps.LatLng(Y_point, X_point);
			var mapOptions = {
								zoom: zoomLevel,
								center: myLatlng,
								zoomControl: false,
								scrollwheel : false,
								disableDefaultUI: true,
								mapTypeId: google.maps.MapTypeId.ROADMAP
			}
			var map = new google.maps.Map(document.getElementById('map_view'), mapOptions);

			var myIcon = new google.maps.MarkerImage("/theme/basic/img/main/google_map_marker.png", null, null, null, new google.maps.Size(50,74));

			var marker = new google.maps.Marker({
													position: myLatlng,
													map: map,
													icon: myIcon,
													title: markerTitle
			});

			var infowindow = new google.maps.InfoWindow(
														{
															content: contentString,
															maxWidth: markerMaxWidth
														}
			);

			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map, marker);
			});
		}
		google.maps.event.addDomListener(window, 'load', initMap);
	</script>


<script>
	 $(document).ready(function() {
		$("#content-slider").lightSlider({
		  item:2,
        loop:false,
        slideMove:2,
        easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
        speed:600,
		loop:true
		});
		 $("#content-slider1").lightSlider({
		  item:2,
        loop:false,
        slideMove:2,
        easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
        speed:600,
		loop:true
		});
	});
</script>
<script type="text/javascript" src="/theme/basic/mobile/js/clickgraph.js?<?=time();?>" id="clickgraph"></script>
<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>
