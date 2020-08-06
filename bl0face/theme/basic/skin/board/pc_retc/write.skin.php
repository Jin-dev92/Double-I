<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<section id="bo_w">
    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) {
        $option = '';
        if ($is_notice) {
            $option .= "\n".'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label for="notice">공지</label>';
        }

        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html">';
            } else {
                $option .= "\n".'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="html">html</label>';
            }
        }

        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= "\n".'<input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'."\n".'<label for="secret">비밀글</label>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }

        if ($is_mail) {
            $option .= "\n".'<input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'."\n".'<label for="mail">답변메일받기</label>';
        }
    }

    echo $option_hidden;
    ?>

    <div class="mobile_wrap"  style="width:640px; margin:0 auto;">
      <?if ($bo_table == "new_event") {
      ?>
      <img src="/theme/basic/mobile/skin/board/basic/img/mobile_img.jpg" alt="" usemap="#mapping">
      <?
    }else if($bo_table == "new_event2"){
      ?>
      <img src="/theme/basic/mobile/skin/board/basic/img/mobile_img2.jpg" alt="" usemap="#mapping">
      <?
    }else if ($bo_table == "new_event3") {
      ?>
      <img src="/theme/basic/mobile/skin/board/basic/img/mobile_img3.jpg" alt="" usemap="#mapping">
      <?
    }else if ($bo_table == "new_event4") {
      ?>
      <img src="/theme/basic/skin/board/pc_retc/img/biodb.jpg" alt="" usemap="#mapping">
      <?
    }?>

    <map name="mapping" id="mapping">
      <?if ($bo_table == "new_event") {
      ?>
      <area  alt="" title="" href="tel:02-1833-8838" shape="rect" coords="1,6848,640,7047" style="outline:none;" target="_self"     />
      <area  alt="" title="" href="/bbs/board.php?bo_table=filler_review_kor" shape="rect" coords="9,7057,160,7209" style="outline:none;" target="_self"     />
      <area  alt="" title="" href="/theme/basic/sub02/sub06.php" shape="rect" coords="168,7057,319,7209" style="outline:none;" target="_self"     />
      <area  alt="" title="" href="http://plus.kakao.com/home/%40%EB%B9%84%EC%98%A4%ED%8E%98%EC%9D%B4%EC%8A%A4%EC%84%9C%EC%9A%B8%EC%8B%A0%EC%82%AC%EB%B3%B8%EC%A0%90" shape="rect" coords="326,7059,477,7211" style="outline:none;" target="_self"     />
      <area  alt="" title="" href="/bbs/board.php?bo_table=online_kor" shape="rect" coords="483,7059,634,7211" style="outline:none;" target="_self"     />
      <?
    }else if($bo_table == "new_event2") {
      ?>
      <area  alt="" title="" href="tel:02-1833-8838" shape="rect" coords="1,5825,640,6024" style="outline:none;" target="_self"     />
      <area  alt="" title="" href="/bbs/board.php?bo_table=filler_review_kor" shape="rect" coords="11,6033,126,6187" style="outline:none;" target="_self"     />
      <area  alt="" title="" href="/theme/basic/sub02/sub06.php" shape="rect" coords="133,6034,248,6188" style="outline:none;" target="_self"     />
      <area  alt="" title="" href="http://plus.kakao.com/home/%40%EB%B9%84%EC%98%A4%ED%8E%98%EC%9D%B4%EC%8A%A4%EC%84%9C%EC%9A%B8%EC%8B%A0%EC%82%AC%EB%B3%B8%EC%A0%90" shape="rect" coords="259,6034,374,6188" style="outline:none;" target="_self"     />
      <area  alt="" title="" href="/bbs/board.php?bo_table=online_kor" shape="rect" coords="385,6035,501,6185" style="outline:none;" target="_self"     />
      <area  alt="" title="" href="/bbs/board.php?bo_table=after"  shape="rect" coords="510,6036,626,6186" style="outline:none;" target="_self"     />
      <?
    }?>



</map>
    <table>
    <tbody>
      <tr>
          <th scope="row"><label for="wr_subject">이름<strong class="sound_only">필수</strong></label></th>
          <td><input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input required"  style="width:200px; color:#000;"></td>
      </tr>
      <tr>
          <th scope="row"><label for="wr_hp">연락처<strong class="sound_only">필수</strong></label></th>
          <input type="hidden" name="wr_1" value="">
          <td><input type="text" name="wr_2" value="<?php echo $wr_2 ?>" id="wr_2" required class="frm_input required" style="width:100px; margin-right:10px; color:#000;">
            <input type="text" name="wr_3" value="<?php echo $wr_3 ?>" id="wr_3" required class="frm_input required" style="width:100px; margin-right:10px; color:#000;">
          <input type="text" name="wr_4" value="<?php echo $wr_4 ?>" id="wr_4" required class="frm_input required" style="width:100px; margin-right:10px; color:#000;"></td>
      </tr>
      <tr>
        <th><?if($bo_table == "new_event3"){?>상담가능시간<?}else {
          echo "상담항목";
        }?></th>
        <td>
          <select class="wr_7" name="wr_7" style="float:left; color:#000; height:30px;">
            <?if ($bo_table == "new_event") {
            ?>
            <option value="">항목을 선택해 주세요.</option>
            <option value="히알루론산 필러(뉴라미스, 글램필)">히알루론산 필러(뉴라미스, 글램필)</option>
            <option value="티오필">티오필</option>
            <option value="큐오필">큐오필</option>
            <option value="가슴필러">가슴필러</option>
            <option value="골반필러">골반필러</option>
            <option value="힙업필러">힙업필러</option>
            <option value="휜다리교정필러">휜다리교정필러</option>
            <option value="다이어트(바디관리)">다이어트(바디관리)</option>
            <option value="부위별리프팅">부위별리프팅</option>
            <option value="윤곽주사">윤곽주사</option>
            <option value="피부관리">피부관리</option>
            <option value="반영구">반영구</option>
            <option value="기타문의">기타문의</option>
            <?
          }else if($bo_table == "new_event2"){
            ?>
            <option value="">항목을 선택해 주세요.</option>
            <option value="골반필러">골반필러</option>
            <option value="힙업필러">힙업필러</option>
            <option value="가슴필러">가슴필러</option>
            <option value="휜다리교정">휜다리교정</option>
            <option value="기타바디">기타바디</option>

            <?
          }else if($bo_table == "new_event3"||$bo_table == "new_event4"){
            ?>
            <option value="">시간 선택</option>
            <option value="11:00 ~ 12:00">11:00 ~ 12:00</option>
            <option value="12:00 ~ 13:00">12:00 ~ 13:00</option>
            <option value="13:00 ~ 14:00">13:00 ~ 14:00</option>
            <option value="14:00 ~ 15:00">14:00 ~ 15:00</option>
            <option value="15:00 ~ 16:00">15:00 ~ 16:00</option>
            <option value="16:00 ~ 17:00">15:00 ~ 17:00</option>
            <option value="17:00 ~ 18:00">15:00 ~ 18:00</option>

            <?
          }?>

          </select>
        </td>
      </tr>

      <?if($bo_table == "new_event3"){?>
      <tr>
        <th>상담내용</th>
        <td class="wr_content"><textarea name="wr_content" value="." required class="frm_input required" style="width:320px;height:100px; background:#fff; float:left"></textarea></td>
      </tr>
      <?}else {
        ?>
        <tr style="display:none;">
            <th scope="row"><label for="wr_content"> 상담희망시간 <strong class="sound_only">필수</strong></label></th>
            <td class="wr_content"><input type="text" name="wr_content" value="." required class="frm_input required" style="width:100%;"></td>
        </tr>
        <?
      }?>
      <?  if($bo_table == "new_event4"){
          ?>
          <tr>
            <th scope="row"><label for="wr_wr2"> 상담내용 <strong class="sound_only">필수</strong></label></th>
            <td class="wr_2"><textarea name="name" rows="8" cols="80"  name="wr_2" required class="frm_input required" ></textarea></td>
          </tr>
          <?}?>
      <tr>
        <th> </th>
        <td style="text-align:left" class="pri"><input type="checkbox" name="wr_5" id="wr_5" value="1" required class="required" style="width:24px;height:24px;margin-top:3px;">개인정보취급동의 <a href="javascript:open_this()" style="color:#fff;">[보기]</a></td>
      </tr>
      <tr>
        <td colspan="2">
          <?if ($bo_table == "new_event3") {
          ?>
          <input type="image" id="btn_submit" class="btn_submit" accesskey="s" required src="/theme/basic/mobile/skin/board/basic/img/btn3.jpg" class="required" style="height:60px;"></td>
          <?}else {
            ?>
            <input type="image" id="btn_submit" class="btn_submit" accesskey="s" required src="/theme/basic/mobile/skin/board/basic/img/mobile_btn.jpg" class="required" style="height:60px;"></td>
            <?
          }?>

      </tr>

    </tbody>
    </table>
    <div class="slider_wrap">
    <div class="simple-slider">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide" style="background-image:url(/theme/basic/mobile/skin/board/basic/img/slider1.jpg);"></div>
            <div class="swiper-slide" style="background-image:url(/theme/basic/mobile/skin/board/basic/img/slider2.jpg);"></div>
            <div class="swiper-slide" style="background-image:url(/theme/basic/mobile/skin/board/basic/img/slider3.jpg);"></div>
            <div class="swiper-slide" style="background-image:url(/theme/basic/mobile/skin/board/basic/img/slider4.jpg);"></div>
            <div class="swiper-slide" style="background-image:url(/theme/basic/mobile/skin/board/basic/img/slider5.jpg);"></div>
            <div class="swiper-slide" style="background-image:url(/theme/basic/mobile/skin/board/basic/img/slider6.jpg);"></div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
  </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
  <script type="text/javascript">
  $(function(){

      // Initializing the swiper plugin for the slider.
      // Read more here: http://idangero.us/swiper/api/

      var mySwiper = new Swiper ('.swiper-container', {
          loop: true,
          pagination: '.swiper-pagination',
          paginationClickable: true,
          nextButton: '.swiper-button-next',
          prevButton: '.swiper-button-prev'
      });

  });
  </script>
  <?if ($bo_table == "new_event") {
  ?>
  <style media="screen">
    .slider_wrap{top: 5929px!important;}
  </style>
  <?
}else if($bo_table == "new_event2"){
  ?>
  <style media="screen">
    .slider_wrap{top: 4605px!important}
  </style>
  <?
}else if($bo_table == "new_event3"){
  ?>
  <style media="screen">
    .slider_wrap{display: none!important}
    table{
    position: absolute;
    top: 2550px;
    width: 620px;
    color: #000;
    font-size: 13px;
    left: 50%;
    margin-left: -295px;
    text-align: center;
}
label{color: #000; text-align: center;}
input,textarea{background: #fff!important}
.required, textarea.required{background: #fff!important;}
#wr_5{background: #fff!important;}
.profile_wrap{border: 1px solid #333;}
td a{color: #000!important;}
.pri{font-size: 16px;}
.frm_input{float: left;}
  </style>
  <?
}if($bo_table == "new_event4"){
  ?>
  <style media="screen">
  .frm_input{height: 30px;}
    .mobile_wrap{width: 100%!important;position: relative;}
    table{position: absolute;
    bottom: 10px;
    width: 1200px;
    left: 50%;
    margin-left: -600px;}
    tr{height: 50px;color: #fff;font-size: 16px}
    textarea{width: 600px; height: 110px!important;}
    th{text-align: right;}
    #btn_submit{padding: 0;    margin: 0 auto;
    display: block;
    width: 200px;
    height: 34px!important;}
  </style>
  <?}?>
    <style media="screen">
      .profile_wrap{width: 640px;position: fixed;top:100px;left: 50%; margin-left: -320px;background: #fff; display: none;}
      .profile_wrap ul{width: 100%; font-size: 14px; clear: both; margin: 0 auto;display: block; padding: 0;height: 60px;}
      .profile_wrap ul li{list-style: none;float: left;width: 33%; padding: 20px 0;text-align: center; }
      .profile_wrap h2{text-align: center; font-size: 32px;padding: 20px 0;}
      .ul_head{background: #ddd;}
      .ul_head li{padding:0 0;}
      .slider_wrap{position: absolute;left: 10px;width: 620px; height: 430px; overflow: hidden;}
      .swiper-slide{height: 430px!important}
      .swiper-slide img {height: 430px!important;}
      .swiper-pagination-bullet{width: 15px; height: 15px; background: #fff;opacity:0.8}
      .swiper-pagination-bullet-active{background: #d7244b;}
    </style>
    <script type="text/javascript">
      function close_this(){
        $(".profile_wrap").hide();
      }
      function open_this(){
        $(".profile_wrap").show();
      }
    </script>
    <div class="profile_wrap">
      <a href="javascript:close_this()"><img src="/theme/basic/img/pop/X.png" alt="" style="position:absolute; top:0; right:0; width:50px;"></a>
      <h2>개인정보처리방침안내</h2>
      <ul class="ul_head">
        <li>목적</li>
        <li>항목</li>
        <li>보유기간</li>
      </ul>
      <ul>
        <li>이용자 식별 및 본인여부 확인</li>
        <li>아이디, 이름, 비밀번호</li>
        <li>회원 탈퇴 시까지</li>
      </ul>
      <ul>
        <li>고객서비스 이용에 관한 통지,<br>CS대응을 위한 이용자 식별</li>
        <li>연락처 (이메일, 휴대전화번호)</li>
        <li>회원 탈퇴 시까지</li>
      </ul>

        </div>
    </div>
</form>
</div>
<script>
<?php if($write_min || $write_max) { ?>
// 글자수 제한
var char_min = parseInt(<?php echo $write_min; ?>); // 최소
var char_max = parseInt(<?php echo $write_max; ?>); // 최대
check_byte("wr_content", "char_count");

$(function() {
    $("#wr_content").on("keyup", function() {
        check_byte("wr_content", "char_count");
    });
});

<?php } ?>

function html_auto_br(obj)
{
    if (obj.checked) {
        result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
        if (result)
            obj.value = "html2";
        else
            obj.value = "html1";
    }
    else
        obj.value = "";
}

function fwrite_submit(f)
{

    var subject = "";
    var content = "";
    $.ajax({
        url: g5_bbs_url+"/ajax.filter.php",
        type: "POST",
        data: {
            "subject": f.wr_subject.value,
            "content": f.wr_content.value
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
            subject = data.subject;
            content = data.content;
        }
    });

    if (subject) {
        alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
        f.wr_subject.focus();
        return false;
    }


    if (f.wr_2.value==""||f.wr_3.value==""||f.wr_4.value=="") {
      alert("연락처를 적어주세요.");
      f.wr_2.focus();
      return false;
    }
    if (f.wr_7.value=="") {
      alert("항목을 선택해 주세요.");
      f.wr_7.focus();
      return false;
    }
    f.wr_1.value=f.wr_2.value+"-"+f.wr_3.value+"-"+f.wr_4.value;
    f.wr_name.value = f.wr_subject.value;
    document.getElementById("btn_submit").disabled = "disabled";

    return true;
}
</script>
</section>
<!-- } 게시물 작성/수정 끝 -->
