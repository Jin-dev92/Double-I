<style>
  footer .main_icon { height: 25px; margin-right: 15px;}
  footer .map_new{ width:100%; padding:60px 30px 60px 0; box-sizing:border-box;}
  footer .map_new img{ display:block; width:100%}
  footer .ko_light{ margin-top:30px}
  footer .ko_light li{ font-size:14px; font-weight:400; color:#fff; margin-bottom:30px}
  footer .btnBox{ padding-left:100px}
  footer .btnBox a{ display:block; width:150px; height:40px; line-height:35px; font-size:14px; font-weight:400; color:#fff; border:3px solid #fff; border-radius:25px; box-sizing:border-box; margin-bottom:20px; text-align:center;}
  footer .btnBox a img{ height:20px; vertical-align:middle; margin-right:10px;}
  @media (max-width:600px){
  footer .map_new{padding:30px 0 0;}
  footer .btnBox{ padding-left:0}
  footer .btnBox a{ margin:0 auto 20px}
  }
</style>
<footer class="page-footer main_color" style="position: relative; background-color: #AA0010; margin: 0 auto;padding: 0;">
<!--<div id="map2" class="for_pc" style="width:51.4%;height:100%; position: absolute; top: 0;"></div>
<div class="for_m" style="padding: 0; width: 100%; height: 300px;">
 <div id="map" style="width: 100%; height: 100%;"></div>
</div>-->

  <div class="container">
    <div class="row">
      <div class="col m7 s12">
      	<div class="map_new">
            <img src="/assets/img/map_new.jpg">
        </div>
      </div>
      <div class="col m5 s12 for_pc" style="padding: 40px 0 0;">
        <h3 class="en_bold">Contact us</h3>
        <ul class="ko_light">
          <li>
            <img src="/assets/img/map_icon.png?1" class="main_icon">
            서울 특별시 강남구 강남대로 152길 22(신사동)<br>신사역 8번출구
          </li>
          <li>
            <img src="/assets/img/time_icon.png?1" class="main_icon" style="margin-top: 7px;">
            평&nbsp;&nbsp;&nbsp;&nbsp;일 : AM 10:30 ~ PM 09:00<br>토요일 : AM 10:30  ~ PM 05:00
          </li>
          <li>
            <img src="/assets/img/phone_icon.png" class="main_icon">
            <span class="">Tel) 1833.8838 <br>FAX) 02.6082.8839</span>
          </li>
          <li>
            <img src="/assets/img/licence_icon.png" class="main_icon">
            <span class="">사업자 등록번호 : 605 - 25 - 72864<br>대표자 : 박주영 | 상호명 : 비오페이스의원</span>
          </li>
          <div class="btnBox">
              <a href="http://goto.kakao.com/@비오페이스서울신사본점"><img src="/assets/img/talk_icon.png">카톡상담&nbsp;&nbsp;></a>
              <a href="/board/lists/online_kor/1"><img src="/assets/img/consult.png">온라인상담&nbsp;&nbsp;></a>
          </div>
        </ul>
      </div>
      <div class="col m5 s12 for_m" style="padding: 20px;">
        <h3 class="en_bold align_center">Contact us</h3>
        <ul class="ko_light">
          <li>
            <img src="/assets/img/map_icon.png?1" class="main_icon">
            서울 특별시 강남구 강남대로 152길 22(신사동) 신사역 8번출구
          </li>
          <li>
            <img src="/assets/img/time_icon.png?1" class="main_icon" style="margin-top: 7px;">
            평&nbsp;&nbsp;&nbsp;&nbsp;일 : AM 10:30 ~ PM 09:00<br>토요일 : AM 10:30  ~ PM 05:00
          </li>
          <li>
            <img src="/assets/img/phone_icon.png" class="main_icon">
            <span>Tel) 1833.8838 <br>FAX) 02.6082.8839</span>
          </li>
          <li>
            <img src="/assets/img/licence_icon.png" class="main_icon">
            <span class="">사업자 번호 : 605 - 25 - 72864<br>대표자 : 박주영 | 비오페이스의원</span>
          </li>
          <div class="btnBox">
              <a href="http://pf.kakao.com/_xaiCuxd/chat"><img src="/assets/img/talk_icon.png">카톡상담&nbsp;&nbsp;></a>
              <a href="/board/lists/online_kor/1"><img src="/assets/img/consult.png">온라인상담&nbsp;&nbsp;></a>
          </div>
        </ul>
      </div>
    </div>
  </div>
</footer>




<!-- 네이버프리미엄로그 공통 적용 스크립트 , 모든 페이지에 노출되도록 설치. 단 전환페이지 설정값보다 항상 하단에 위치해야함 -->
<script type="text/javascript" src="//wcs.naver.net/wcslog.js"> </script>
<script type="text/javascript">
if (!wcs_add) var wcs_add={};
wcs_add["wa"] = "s_33fc03e30d77";
if (!_nasa) var _nasa={};
wcs.inflow();
wcs_do(_nasa);
</script>


<!--<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=h3pQJQhw4SaCCkta6Lt8&submodules=geocoder"></script>
<script>
var map = new naver.maps.Map('map');
var myaddress = '서울 특별시 강남구 강남대로 152길 22(신사동)';// 도로명 주소나 지번 주소만 가능 (건물명 불가!!!!)
naver.maps.Service.geocode({address: myaddress}, function(status, response) {
    if (status !== naver.maps.Service.Status.OK) {
        // return alert(myaddress + '의 검색 결과가 없거나 기타 네트워크 에러');
    }
    var result = response.result;
    // 검색 결과 갯수: result.total
    // 첫번째 결과 결과 주소: result.items[0].address
    // 첫번째 검색 결과 좌표: result.items[0].point.y, result.items[0].point.x
    var myaddr = new naver.maps.Point(result.items[0].point.x, result.items[0].point.y);
    map.setCenter(myaddr); // 검색된 좌표로 지도 이동

    map.setOptions({ //지도 인터랙션 켜기
      draggable: true,
      pinchZoom: true,
      scrollWheel: false,
    });

    // 마커 표시
    var marker = new naver.maps.Marker({
      position: myaddr,
      map: map,
      icon: {
        url: '/assets/img/map_logo.png',
        size: new naver.maps.Size(79, 46),
        origin: new naver.maps.Point(0, 0),
        anchor: new naver.maps.Point(40, 43)
      }
    });
    // 마커 클릭 이벤트 처리
    naver.maps.Event.addListener(marker, "click", function(e) {
      if (infowindow.getMap()) {
          infowindow.close();
      } else {
          infowindow.open(map, marker);
      }
    });
});

var map2 = new naver.maps.Map('map2');
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
    map2.setCenter(myaddr); // 검색된 좌표로 지도 이동

    map2.setOptions({ //지도 인터랙션 켜기
      draggable: true,
      pinchZoom: true,
      scrollWheel: false,
    });

    // 마커 표시
    var marker2 = new naver.maps.Marker({
      position: myaddr,
      map: map2,
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
          infowindow.open(map2, marker2);
      }
    });
});
</script>-->

