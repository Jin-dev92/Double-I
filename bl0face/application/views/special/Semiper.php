
  <div class="side_content">
    <h2 class="side_tit">반영구</h2>
<p>
  당신은 무엇을,<br>
  누구를 그리고 어떤 방식을<br>
  바라시나요?<br>
  조심스레 물어봅니다.<br><br>

  안전과 신뢰라는,<br>
  그런 이름을 가진 경험.<br>
  그 경험으로<br>
  당신에게 보여드립니다.<br><br>

  당신의 바람,<br>
  바람의 형태,<br>
  그것에 만족하실 정도로.<br><br>

  수미기법,<br>
  기존과는 다른 테크닉으로<br>
  질문에 대한 대답을<br>
  믿음을 드리겠습니다.<br>
</p>
<!-- <a href="#" class="hash">#</a> -->
<div class="side_bg">

</div>

  </div>
  <div class="hash_con">
    <div class="container">
      <div class="hash_head">
        <span class="hash_title">#시술</span>
        <span><img src="/assets/img/x.png" class="close_btn hidden-xs" onclick="close_hash()"></span>
      </div>
      <div class="hash_contant">
        <img src="/assets/img/tof1.JPG" alt="">
        <span class="close_hash visible-xs"><a href="javascript:close_hash()">돌아가기</a></span>
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
