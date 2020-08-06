<style media="screen">
    .wrap{background: url("assets/img/sub_bg.jpg")no-repeat center center fixed;  -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;}
      @media (max-width:640px) {

        .footer{position: relative;clear: both;background: #fff;}
      }
  </style>

  <div class="wrap">
    <div class="m_head">
      <img src="assets/img/sub_bg_m.jpg" alt="">
    </div>
    <div class="row menu_row">
      <div class="main_meun">
      <ul>
        <li><h1 class="cate">Filler</h1></li>
        <li><a href="#">바디필러<span></span></a></li>
        <li><a href="#">무슨필러<span></span></a></li>
        <li><a href="#">LIFTING<span></span></a></li>
        <li><a href="#">BIOFACE STORY<span></span></a></li>
        <li><a href="#">ETC<span></span></a></li>
        <li>
          </li>
      </ul>
    </div>
  </div>
  <div class="side_content">

    <h2 class="side_tit">티오필이란?</h2>
    <p>진피와 가장 가까운 성분,<br>
이에 필러를 더하고,<br>
볼륨증가 효과를 주는<br>
<a href="#"  class="hash">#시술입니다.</a><br><br>

실제 피부와 거의 흡사하며,<br>
자연스러운 감촉을<br>
느낄 수 있습니다.<br>
<br>
진피와 가장 가까운 성분,<br>
그로인해 염증반응, 부작용이<br>
최소화된 필러입니다.<br>
<br>
실제 진피와 매우 흡사한<br>
2~5년 정도의 긴 유지력을<br>
지니고 있습니다.<br>
<a href="#" class="hash">#Long Lasting</a><a href="#" class="hash">#Innovation</a></p>
<div class="side_bg">

</div>

  </div>
  <div class="hash_con">
    <div class="container">
      <div class="hash_head">
        <h2>#시술</h2>
      </div>
      <div class="hash_contant">
        <img src="assets/img/tof1.JPG" alt="">
      </div>
      <div class="close_hash">
        <a href="javascript:close_hash()">돌아가기</a>
      </div>
    </div>
  </div>
  <script type="text/javascript">
  function close_hash(){
  $(".hash_con").removeClass("up");
  }
  $(function(){
  $(".meun_box").click(function(){
    $(".menu_wrap").css("opacity","1");
   $(".menu_wrap").addClass("active_menu");
   $(".menu_close").find("div").removeClass("remove_x");

  })
  $(".menu_wrap .main_meun ul li a").hover(function(){
   $(this).css("color","#fff");
   $(this).find("span").css("width","100%");
  },function(){
   $(this).css("color","#333");
   $(this).find("span").css("width","0%");
  })
  $(".menu_close").click(function(){
   $(this).find("div").addClass("remove_x");
   setTimeout(function(){
     $(".menu_wrap").css("opacity","0");
   },400);
   setTimeout(function(){
     $(".menu_wrap").removeClass("active_menu");
   },1400);

  })
  $(".hash").click(function(){
   $(".hash_con").addClass("up");
  })

  })
  </script>
