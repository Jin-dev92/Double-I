
<style media="screen">
  .for_pc{display: block!important;}
  .for_m{display: none!important;}
  .quick_side{position: fixed;right: 10px; bottom: 50px; z-index: 9999;background: #fff; display: none;}
  .quick_on{display: block;transition-duration: 0.8s;}
  .kakao_wrap{width:380px;background:#FFE800; font-size: 12px; text-align: center;height: 300px; display: flex;
  flex-wrap: wrap;flex-direction: column;justify-content: center;align-items: center; line-height: 20px;}
  .quick_icons_wrap{height: 180px;width: 100%; display: flex; flex-wrap: wrap;justify-content: center; align-items: center; flex-direction: column;}
  .quick_icons ul{border: 1px solid #ccc;height: 40px;border-radius: 30px;}
  .quick_icons ul li{cursor: pointer;border-radius: 30px;float: left; height: 40px; width:100px;color: #ccc;text-align: center;line-height: 40px;font-size: 12px;}
  .quick_icons .active_icon{color: #000; font-weight: bold; }
  .quick_icons .active_icon:nth-child(1) {background: #00C63B;}
  .quick_icons .active_icon:nth-child(2) {background: #FFE800;}
  .quick_icons .active_icon:nth-child(3) {background: #999;color: #000}

  .quick_info_head{font-weight: bolder; text-align: center;padding: 20px 0;}
  .quick_info_head h1{font-size: 1.5em;}

  .quick_info_wrap li{ display: none;}
  .quick_info_wrap .active_quick_info{display: block;}

  .input_wrap{margin:10px 0;position: relative;}
  .input_wrap input{    background: none;
    border: 1px solid #000;
    border-radius: 4px;
    padding: 6px 12px;display: block;margin: 0 auto;}
    .input_wrap select{
      background: none;
       border: 1px solid #000;
       border-radius: 4px;
       padding: 7px 16px;display: block;margin: 0 auto;
       font-size: 12px;
       max-width: 190px;
       background: #FFE800;
       color: #333;
    }


    .add_alim{font-size: 12px;  color: #fff;}
    .quick_foot{padding: 20px 10px; font-size: 12px; text-align: center;line-height: 20px; padding: 30px 0;}
    .quick_foot
    .quick_foot a{color: #ffcc00;cursor: pointer;}
    .quick_submit_btn{max-width: 100px; text-align: center;padding: 10px 30px; border: 1px #666 solid;
      border-radius: 40px;  background:none; color: #666!important;display: block; margin: 0 auto;margin-top: 10px;}
    .quick_submit_btn:hover{color: #fff!important; background: #333;}

    .tok_wrap{width:380px;background:#eee; font-size: 12px; text-align: center;height: 300px; display: flex;
    flex-wrap: wrap;flex-direction: column;justify-content: center;align-items: center; line-height: 20px;}
    .tok_wrap h2{font-size: 1.3em;font-weight: bolder;}
    .tok_txt{color: #00C63B}
    .quick_info_wrap li h3{font-size: 1.5em;font-weight: bolder; text-align: center; padding: 10px 0;}
    .side_icon{display: flex;flex-wrap: wrap;justify-content: center;align-items: center;flex-direction: column;
      position: fixed;right: 15px; bottom: 5%; color: #fff;border-radius: 50%; cursor: pointer; width: 100px; height: 100px; z-index: 9;}
      /*.side_icon p{padding: 10px 0; font-size: 12px;}
    .side_icon img{ max-width: 90%; display: block; margin: 0 auto; padding-top:10px; }*/
    .quick_close{position: absolute;right: 10px; top: 0; width: 35px;}
    .quick_close img{width: 100%}
    @media (max-width:786px) {
      .for_pc{display: none!important;}
      .for_m{display: block!important;}
      .quick_side{width: 100%;top:0;left: 0; height: 100%;right: auto; background: #333; color: #fff;}
      .quick_icons_wrap{height: 130px;}
      .kakao_wrap{width: 100%; background: none}
      .add_alim{text-align: center;}
      .tok_wrap{width: 100%;background: none}
      .quick_foot{padding: 10px 0;}
      .quick_foot p{ padding: 0 20px;}
      .quick_submit_btn{background: #ddd; margin-top: 10px;}
      .input_wrap input{ width: 170px; border: #fff solid 1px; color: #fff}
      .input_wrap select{ width: 200px; border: #fff solid 1px;color: #fff; background: #333}
      .side_icon{display: none;}
      .quick_close{right: 0;}
  	}
</style>
<script type="text/javascript">
function quick_on(num){
  if ($(".quick_side").hasClass("quick_on")) {
    $(".quick_side").removeClass("quick_on");
  }else {
    $(".quick_side").addClass("quick_on");
    var txt = $(".quick_icons ul li").eq(num).text();
    $(".head_txt").text(txt);
    $(".quick_icons ul li").removeClass("active_icon");
    $(".quick_icons ul li").eq(num).addClass("active_icon");
    $(".quick_info_wrap li").removeClass("active_quick_info");
    $(".quick_info_wrap li").eq(num).addClass("active_quick_info");
  }
}
  $(function(){
     $(".quick_icons ul li").click(function(){
       $(".quick_icons ul li").removeClass("active_icon");
       var idx = $(".quick_icons li").index(this);
       var txt = $(this).text();
       $(this).addClass("active_icon");

       $(".quick_info_wrap ul li").removeClass("active_quick_info");
       $(".quick_info_wrap ul li").eq(idx).addClass("active_quick_info");
       $(".head_txt").text(txt);
     })
  })
</script>
<div class="side_icon" onclick="quick_on(1);">
  <img src="http://www.modsclinic.co.kr/assets/front/images/main/quick_icon_right.png" alt="모즈 클리닉" >
</div>
<div class="quick_side">
  <div class="quick_close">
    <img src="http://www.modsclinic.co.kr/assets/front/images/main/close_quick.png" alt="" onclick="quick_on()">
  </div>
  <div class="quick_icons_wrap">
    <div class="quick_info_head">
      <h1 class="head_txt">카톡 상담</h1>
    </div>
  <div class="quick_icons">
    <ul>
      <li class="active_icon">카톡 상담</li>
      <li>온라인 상담</li>
    </ul>
  </div>
  </div>
  <div class="quick_info_wrap">
    <ul>
      <li>
        <div class="quick_foot">
          <h3 class="for_pc">전화상담 <a href="tel:02-545-1618" onclick="trackOutboundLink('tel:02-545-1618'); return false;" onMouseDown="javascript:_PL('modsclinic.co.kr/tell.php');">02.545.1618</a></h3>
          <h3 class="for_m">전화상담 <a href="tel:02-545-1618" onclick="trackOutboundLink('tel:02-545-1618');" onMouseDown="javascript:AM_PL('/tell.php');">02.545.1618</a></h3>

        </div>
      </li>
      <li class="active_quick_info">
        <div class="kakao_wrap ">
            <img src="http://www.modsclinic.co.kr/assets/front/images/main/kakako_icon.png" alt="모즈 클리닉">
            <br>
            <p>카카오톡 1:1 상담신청</p>
            <h2 style=" font-size: 1.3em;font-weight: bolder;">플러스친구 상담으로 <br> 다양한 혜택과 빠른 상담을 받아보세요.</h2>
            <p class="kako_txt">상담가능시간 평일 10:00 ~ 18:00</p>
            <!-- <p class="add_alim">신청 하시면 최대한 빠르게 답변드리겠습니다.</p> -->
            <!-- <p><input type="checkbox" name="agree" class="agree" >개인정보취급방침에 동의합니다. <a href="http://www.modsclinic.co.kr/board/privacy">[자세히 보기]</a> </p> -->
            <a href="https://pf.kakao.com/_BexepV" onclick="trackOutboundLink('https://pf.kakao.com/_BexepV');" onMouseDown="javascript:_PL('modsclinic.co.kr/kakao.php');" class="quick_submit_btn kakao_request for_pc">카카오톡<br>상담신청</a>
            <a href="https://pf.kakao.com/_BexepV" onclick="trackOutboundLink('https://pf.kakao.com/_BexepV');" onMouseDown="javascript:AM_PL('/kakao.php');" class="quick_submit_btn kakao_request for_m">카카오톡<br>상담신청</a>
          </form>
        </div>
        <div class="quick_foot">
          <h3 class="for_pc">전화상담 <a href="tel:02-545-1618" onclick="trackOutboundLink('tel:02-545-1618');" onMouseDown="javascript:_PL('modsclinic.co.kr/tell.php');">02.545.1618</a></h3>
          <h3 class="for_m">전화상담 <a href="tel:02-545-1618" onclick="trackOutboundLink('tel:02-545-1618');" onMouseDown="javascript:AM_PL('/tell.php');">02.545.1618</a></h3>
        </div>
      </li>

      <li>
        <div class="tok_wrap">
          <br>
          <img src="http://www.modsclinic.co.kr/assets/front/images/main/quick_in_online.png" alt="모즈 클리닉">
          <br>
          <p>온라인 상담게시판 문의</p>
          <h2>부담없는 상담을 원하시면 <br>온라인게시판을 이용해주세요. </h2>
          <br>
          <a class="quick_submit_btn for_pc" href="/board/review_write?type=online_advice&board_type=online_advice&board_title=온라인상담" onclick="trackOutboundLink('/board/review_write?type=online_advice&board_type=online_advice&board_title=온라인상담');" onMouseDown="javascript:_PL('modsclinic.co.kr/online_consult.php');">온라인 상담신청</a>
          <a class="quick_submit_btn for_m" href="/ma/community/community_write?type=&board_title=온라인상담" onclick="trackOutboundLink('/ma/community/community_write?type=online_advice&board_title=온라인상담');" onMouseDown="javascript:AM_PL('/online_consult.php');" >온라인 상담신청</a>
        </div>
        <div class="quick_foot">
          <h3 class="for_pc">전화상담 <a href="tel:02-545-1618" onclick="trackOutboundLink('tel:02-545-1618');" onMouseDown="javascript:_PL('modsclinic.co.kr/tell.php');">02.545.1618</a></h3>
          <h3 class="for_m">전화상담 <a href="tel:02-545-1618" onclick="trackOutboundLink('tel:02-545-1618');" onMouseDown="javascript:AM_PL('/tell.php');">02.545.1618</a></h3>
        </div>
      </li>
    </ul>
  </div>
</div>
<script type="text/javascript">
// $(".kakao_request").click(function(){
//   var kakao_arr = [{"to" : "01023494748",
//   "text" : "백성현 님, 모즈클리닉 위치 안내 드립니다. 서울시 강남구 청담동 92-22 시소모타워 (드림빌딩) 1F압구정 로데오 4번 출구로 나와 직진 – 버거킹 골목으로 직진 – 울프강 스테이크를 지나 언덕으로 직진 – 우측 모즈클리닉 진료 문의 ☎02-545-1618",
//   "from" : "01023494748",
//   "template_code" : "ModsClinic_003"
// }];
//   $(".messages").val(kakao_arr);
//   var name = $(".kakako_name").val();
//   var phone = $(".kakako_phone").val();
//   var part = $(".kakao_select").val();
//   if (name=="") {
//     alert("성함을 입력해주세요.");
//     $(".kakako_name").focus();
//     return false;
//   }
//   if (phone=="") {
//     alert("전화번호를 입력해주세요.");
//     $(".kakako_name").focus();
//     return false;
//   }
//   if (part=="") {
//     alert("상담항목을 선택해주세요.");
//     $(".kakao_select").focus();
//     return false;
//   }
//   if ($(".agree").is(":checked")) {
//
//   }else {
//     alert("개인정보취급방침에 동의해주세요.");
//     $(".agree").focus();
//     return false;
//   }
//   $.ajax({
//     url: "http://gw.surem.com/alimtalk/v2/json",
//     type:"POST",
//     contentType:"application/json",
//     dataType:"jsonp",
//     cache:false,
//     async: false,
//     data:{
//       "usercode" : "modsclinic",
//       "deptcode" : "7P-218-J3",
//       "yellowid_key" : "79542939d122e266678840c402b35059877b4099",
//       "messages" : [
//         {
//           "to" : phone,
//           "text" : name+"님, 모즈클리닉 위치 안내 드립니다. 서울시 강남구 청담동 92-22 시소모타워 (드림빌딩) 1F압구정 로데오 4번 출구로 나와 직진 – 버거킹 골목으로 직진 – 울프강 스테이크를 지나 언덕으로 직진 – 우측 모즈클리닉 진료 문의 ☎02-545-1618",
//           "from" : "01023494748",
//           "template_code" : "ModsClinic_003",
//           "reserved_time" : "209912310000",
//           "re_send" : "N",
//         }
//       ]
//       },success:function(data){
//         console.log("굿");
//       }
//   })
//   $(".kakao_form").submit();
// })

</script>
