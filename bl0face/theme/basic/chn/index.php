<?php
include_once('./_common.php');

define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/chn/index.php');
    return;
}

include_once(G5_THEME_PATH.'/chn/head.php');
?>
<?php
include_once(G5_THEME_PATH.'/chn/include/slide.php');
?>
<style>

</style>

<script>
function mainmenu(){
	if($("#main_all").css("display") == "none"){
		$("#main_all").show();
	} else {
		$("#main_all").hide();
	}
}
$( document ).ready( function() {
	var jbOffset = $( '.super_main' ).offset();
	$( window ).scroll( function() {
		if ( $( document ).scrollTop() > jbOffset.top ) {
			$( '.super_main' ).addClass( 'smFixed' );
		} else {
			$( '.super_main' ).removeClass( 'smFixed' );
		}
	});
} );

$(document).ready(function(){
		$('#main_all').click(function() { 
			$('#main_all').hide(); 
		});
});

</script>


<!-- 상단 시작 { -->
<div class="super_main">
	<div id="main" >
		<div id="main_wrapper">
			<div id="logo">
				<a href="http://biofacetest.dothome.co.kr/theme/basic/chn"><img src="/theme/basic/chn/img/main/header_logo.png" alt="비오페이스"></a>
			</div>
			<div id="nara">
				<img src="/theme/basic/img/main/nara.png" usemap="#nara_go">
				<map name="nara_go">
					<area shape="rect" coords="0,0,28,28" href="<?php echo G5_URL ?>"/>
					<area shape="rect" coords="38,0,66,28" href="<?php echo G5_URL ?>/theme/basic/chn"/>
					<area shape="rect" coords="76,0,104,28" href="<?php echo G5_URL ?>/theme/basic/eng"/>
				</map>
			</div>

			<ul id="tnb">
				<?php if ($is_admin) {  ?>
				<li><a href="<?php echo G5_ADMIN_URL ?>"><b>ADMIN</b></a></li>
				<?php }  ?>
				<li><a href="#" onclick="mainmenu(); return false;"><b>BIOFACE STORY</b></a></li>
				<li><a href="#" onclick="mainmenu(); return false;"><b>FILLER</b></a></li>
				<li><a href="#" onclick="mainmenu(); return false;"><b>LIFTING</b></a></li>
				<li><a href="#" onclick="mainmenu(); return false;"><b>SKIN</b></a></li>
				<li><a href="#" onclick="mainmenu(); return false;"><b>ETC</b></a></li>
			</ul>
		</div>
	</div>
	<div id="main_all">
		<div id="main_allmenu">
			<div id="allmenu">
				<img src="/theme/basic/chn/img/main/allmenu.png" alt="전체메뉴">
			</div>
			<div id="allmenu_cate">
				<ul id="cate1">
			<ul id="cate1">
				<li id="title"><b>BIOFACE STORY</b></li>
				<li id="first"><a href="/theme/basic/chn/sub01/sub01.php">你曾经做过玻尿酸吗?</a></li>
				<li><a href="/theme/basic/chn/sub01/sub02.php">填充剂的历史</a></li>
				<li><a href="/theme/basic/chn/sub01/sub03.php">BIOFACE 介绍</a></li>
				<li><a href="/bbs/board.php?bo_table=filler_review_chn">院长玻尿酸诊断</a></li>
				<li><a href="/bbs/board.php?bo_table=notice_chn">BIOFACE NOTICE</a></li>
				<li><a href="/bbs/board.php?bo_table=online_chn">BIOFACE ONLINE CONSULT</a></li>
				<li><a href="/bbs/board.php?bo_table=event_chn">BIOFACE EVENT</a></li>
				<li><a href="/bbs/board.php?bo_table=qna_chn">问答</a></li>
				<li><a href="/bbs/board.php?bo_table=star_chn">BIOFACE 明星</a></li>
			</ul>
			<ul id="cate2">
				<li id="title"><b>FILLER</b></li>
				<li id="first"><a href="/theme/basic/chn/sub02/sub01.php">骨盆玻尿酸</a></li>
				<li><a href="/theme/basic/chn/sub02/sub02.php">双腿玻尿酸</a></li>
				<li><a href="/theme/basic/chn/sub02/sub03.php">臀部玻尿酸</a></li>
				<li><a href="/theme/basic/chn/sub02/sub04.php">隆胸玻尿酸</a></li>
				<li><a href="/theme/basic/chn/sub02/sub05.php">纯净QOFILL</a></li>
				<li><a href="/theme/basic/chn/sub02/sub06.php">QOFILL</a></li>
				<li><a href="/theme/basic/chn/sub02/sub07.php">QOGEL</a></li>
				<li><a href="/theme/basic/chn/sub02/sub08.php">GLAMFILL</a></li>
				<li><a href="/theme/basic/chn/sub02/sub09.php">灵通的注射室</a></li>
			</ul>
			<ul id="cate3">
				<li id="title"><b>LIFTING</b></li>
				<li id="first"><a href="/theme/basic/chn/sub03/sub01.php">分部位 提升术</a></li>
				<li><a href="/theme/basic/chn/sub03/sub02.php">NEW-THERA 提升术</a></li>
				<li><a href="/theme/basic/chn/sub03/sub03.php">埋线提升术(可熔丝)</a></li>
				<li><a href="/theme/basic/chn/sub03/sub04.php">蜘蛛网提升术</a></li>
			</ul>
			<ul id="cate4">
				<li id="title"><b>SKIN</b></li>
				<li id="first"><a href="/theme/basic/chn/sub04/sub01.php">精华素注射</a></li>
				<li><a href="/theme/basic/chn/sub04/sub02.php">皮肤疤痕重建</a></li>
				<li><a href="/theme/basic/chn/sub04/sub03.php">淋淋针</a></li>
				<li><a href="/theme/basic/chn/sub04/sub04.php">魔女注射</a></li>
				<li><a href="/theme/basic/chn/sub04/sub05.php">Make-up peel</a></li>
				<li><a href="/theme/basic/chn/sub04/sub06.php">抗老化激光</a></li>
				<li><a href="/theme/basic/chn/sub04/sub07.php">水光调色</a></li>
				<li><a href="/theme/basic/chn/sub04/sub08.php">除去瑕疵</a></li>
				<li><a href="/theme/basic/chn/sub04/sub09.php">痤疮</a></li>
				<li><a href="/theme/basic/chn/sub04/sub10.php">AGAS IO PEEL</a></li>
				<li><a href="/theme/basic/chn/sub04/sub11.php">AQUA PEEL</a></li>
			</ul>
			<ul id="cate5">
				<li id="title"><b>ETC</b></li>
				<li id="first"><a href="/theme/basic/chn/sub05/sub01.php">增强轮廓注射</a></li>
				<li><a href="/theme/basic/chn/sub05/sub02.php">Zero-king diet</a></li>
				<li><a href="/theme/basic/chn/sub05/sub03.php">3-way diet</a></li>
				<li><a href="/theme/basic/chn/sub05/sub04.php">liposonix</a></li>
				<li><a href="/theme/basic/chn/sub05/sub05.php">Double-skinny</a></li>
				<li><a href="/theme/basic/chn/sub05/sub06.php">Relax F Tenor</a></li>
				<li><a href="/theme/basic/chn/sub05/sub07.php">Cool-shaping</a></li>
				<li><a href="/theme/basic/chn/sub05/sub08.php">隆鼻埋线</a></li>
				<li><a href="/theme/basic/chn/sub05/sub09.php">眼部埋线</a></li>
			</ul>
			</div>
		</div>
	</div>
</div>

<!-- 중간 슬라이더 -->
<link rel="stylesheet"  href="/theme/basic/css/lightslider.css"/>
<style>
ul { list-style: none outside none; padding-left: 0; margin: 0; }
.content-slider li{ text-align: center; }
.main2_1_1_1{ width: 1200px; }
</style>
<script src="/theme/basic/js/lightslider.js"></script> 
<script>
	 $(document).ready(function() {
		$("#content-slider").lightSlider({
			loop:true,
			auto:true,
			speed: 1000,
			pause: 4000,
			keyPress:false,
			enableTouch: false,
			enableDrag: false
		});
	});
</script>
<!-- //중간 슬라이더 -->
<!-- 지도 -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8lJYRsS4HXPN3jx7HRL7qarHZkK9UIDs&callback=initMap"></script>
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
							disableDefaultUI: true,
							mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		var map = new google.maps.Map(document.getElementById('map_view'), mapOptions);

		var myIcon = new google.maps.MarkerImage("/theme/basic/chn/img/main/google_map_marker.png", null, null, null, new google.maps.Size(50,74));

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
<!-- 지도 -->

<div class="main1">
	<div class="main1_2">
		<div class="main1_2_1">
			<img src="/theme/basic/chn/img/main/ssussu.gif" >
		</div>
	</div>
</div>
<div class="main2">
	<div class="main2_1">
		<div class="main2_1_1">
			<div class="main2_1_1_1">
				<ul id="content-slider" class="content-slider">
					<li><img src="/theme/basic/chn/img/main/main2_1_1.png"></li>
					<li><img src="/theme/basic/chn/img/main/main2_1_2.png"></li>
					<li><img src="/theme/basic/chn/img/main/main2_1_3.png"></li>
					<li><img src="/theme/basic/chn/img/main/main2_1_4.png"></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="main2_2">
		<div class="main2_2_1">
			<img src="/theme/basic/chn/img/main/main2_2_1.png" usemap="#main2_2_1">
				<map name="main2_2_1">
					<area shape="rect" coords="10,419,156,461" href="/theme/basic/chn/sub01/sub02.php"/><!-- 필러history -->
				</map>
		</div>
	</div>
	<div class="main2_3">
		<ul class="main2_3_ul">
			<li class="main2_3_li_first"><img src="/theme/basic/chn/img/main/main2_3_1.jpg"></li>
			<li class="main2_3_li_sec"><img src="/theme/basic/chn/img/main/main2_3_2.jpg"></li>
			<li><img src="/theme/basic/chn/img/main/main2_3_3.jpg"></li>
			<li class="main2_3_li_last"><img src="/theme/basic/chn/img/main/main2_3_4.jpg"></li>
		</ul>
	</div>
</div>
<div class="main3">
	<div class="main3_1">
		<div class="main3_1_1">
			<img src="/theme/basic/chn/img/main/main3_1_1.png" usemap="#main3_1_1">
				<map name="main3_1_1">
					<area shape="rect" coords="9,200,269,240"  href="https://www.youtube.com/channel/UCuitF5ApGjfZ5q3HPjPSUNw" target="_blank"/><!-- 비오페이스 필러 시술 영상 보기 -->
				</map>
		</div>
		<div class="main3_1_2">
			<iframe width="560" height="315" src="https://www.youtube.com/embed/njEvj4HcSGA" frameborder="0" allowfullscreen></iframe>
		</div>
	</div>
	<div class="main3_2">
		<div class="main3_2_1">
			<img src="/theme/basic/chn/img/main/main3_2_1.png" usemap="#main3_2_1">
				<map name="main3_2_1">
					<area shape="rect" coords="9,266,154,305" href="/theme/basic/chn/sub02/sub09.php"/>
				</map>
		</div>
	</div>
</div>
<div class="main4">
	<div id="map_view" style="width:100%; min-width:1200px; height:445px;"></div>
</div>

<?php
include_once(G5_THEME_PATH.'/chn/tail.php');
?>