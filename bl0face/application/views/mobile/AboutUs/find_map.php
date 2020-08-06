<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
	// PC
  header("Location: /AboutUs/find_map");
} else {
	//MOBILE
}
?>
<style>
  * {max-width: 640px; margin: 0 auto;}
  .m_header { display: block !important;}
	.map_wrap { display: block; width: 100%; margin-top:60px}
	.map_wrap img{ width:100%; display:block}
	.map_info { display: flex; flex-wrap: wrap; justify-content: center; flex-direction: column; height: 100%; width: 100%; height: 30vh; text-align: center;}
	.bio_info { background-color: #AA0010; height: 50vh; display: flex; flex-wrap: wrap; justify-content: center; flex-direction: column;}
	.consol_Btn { width: 150px; padding: 10px 25px; color: #AA0010; background-color: #FFF; border: none; border-radius: 20px; display: block; margin: 10px auto; font-size: 1.3em; cursor: pointer;}
</style>

<div class="map_wrap">
	<!--<div id="map3" style="width:100%;height:100%;"></div>-->
	<img src="/assets/img/map_new.jpg">
</div>

<div class="bio_info f_white align_center ko_bold">
	<h6 class="lh_15">
		<span class="lh_25">
			서울특별시 강남구 강남대로<br>
			152길 22(신사동) 신사K타워 3층<br><br>
		</span>

		<span class="fs_7 en_bold" style="color: #FF0000;">
			22, Gangnam-daero 152-gil,<br>
			Gangnam-gu, Seoul, Republic of Korea
		</span>

		<br><br>
		TEL / 1833.8838

		<br><br>
		FAX / 02.6004.5998
	</h6>
	<input type="button" name="" value="상담신청" class="consol_Btn ko_bold js-c-open">
</div>


<div class="ko_bold map_info">
  <h6>
    <span class="main_f_color en_bold">3호선 신사역 8번출구</span>에서<br>앞에 보이는 골목길로 들어오셔서 쭉<br>바로 우측에 투썸플레이스 있는<br> 오른쪽 건물 3층으로 오시면 됩니다!
  </h6>
</div>

<!-- <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=h3pQJQhw4SaCCkta6Lt8&submodules=geocoder"></script>
<script>
$(document).ready(function(){
  $('.m_header_info li:eq(0)').trigger('click');

  $('.m_header_tab ul:eq(0) li:eq(3)').addClass('active');
});

var map3 = new naver.maps.Map('map3');
var myaddress = '서울 특별시 강남구 강남대로 152길 22(신사동)';// 도로명 주소나 지번 주소만 가능 (건물명 불가!!!!)
naver.maps.Service.geocode({address: myaddress}, function(status, response) {
    if (status !== naver.maps.Service.Status.OK) {
        return alert(myaddress + '의 검색 결과가 없거나 기타 네트워크 에러');
    }
    var result = response.result;
    // 검색 결과 갯수: result.total
    // 첫번째 결과 결과 주소: result.items[0].address
    // 첫번째 검색 결과 좌표: result.items[0].point.y, result.items[0].point.x
    var myaddr = new naver.maps.Point(result.items[0].point.x, result.items[0].point.y);

    // var center = new naver.maps.LatLng(37.516325, 127.018782);

    map3.setCenter(myaddr); // 검색된 좌표로 지도 이동

    map3.setOptions({ //지도 인터랙션 켜기
      zoom: 12,
      draggable: true,
      pinchZoom: true,
      scrollWheel: false,
    });

    // 마커 표시
    var marker2 = new naver.maps.Marker({
      position: myaddr,
      map: map3,
      icon: {
        url: '/assets/img/map_logo.png',
        size: new naver.maps.Size(79, 46),
        origin: new naver.maps.Point(0, 0),
        anchor: new naver.maps.Point(40, 43)
      }
    });
    // 마커 클릭 이벤트 처리
    naver.maps.Event.addListener(marker2, "click", function(e) {
      if (infowindow.getMap()) {
          infowindow.close();
      } else {
          infowindow.open(map3, marker2);
      }
    });
});
</script>-->