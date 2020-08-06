<?php
include_once('./header.php');
?>
<style media="screen">
  .info_head{padding-top: 50px; padding-bottom: 50px; border-bottom: 2px solid #000;}
  .item_info_img img{width: 100%;}
  .item_info_txt{line-height: 20px; font-weight: bold;}
  .item_info_txt .row{padding-bottom: 10px;}
  .info_title{border-bottom: 1px solid #000;margin-bottom: 20px;}
  .info_title h1{font-size: 3.6em;}
  .info_title p{font-weight: bold;}
  .info_unique{border-bottom: 1px solid #000;padding-bottom: 20px;}
  form{font-weight: bold;}
  input{padding: 2px 5px; max-width: 100%;}
  select{padding: 4px 10px;}
  .forms{padding-bottom: 40px;}
  .forms .row{padding:10px 0;}
  .forms h1{text-align: center;padding: 20px 0;}
  .agree{margin-right: 10px; display: inline-block;}
  .phone input{width: 100px;margin-left: 10px;}
  textarea{width: 300px; height: 100px;}
  .button_wrap{margin: 0 auto; float: none; clear: both; display: flex;}
  .col-xs-6 button{background: #2badbb; padding: 6px 16px; color: #fff; font-size: 16px; display: inline-block; margin: 0 auto;}
  .sub_img img{ margin: 0 auto; max-width: 100%; display: block;}
  .forPc{display: block!important;}
  .forM{display: none!important;}
  @media (max-width:768px) {
    .button_wrap{width: 100%!important;}
    .forPc{display: none!important;}
    .forM{display: block!important;}
  }
</style>
<?
$num = $_GET[num];
?>
<div class="container">
  <div class="row info_head">
    <div class="col-sm-5 item_info_img">
      <img src="assets/img/<?=$cate2."_head".$num?>.jpg" alt="">
    </div>
    <div class="col-sm-7 item_info_txt">
      <div class="row info_top">
        <div class="col-sm-12 info_title">
          <h1>title</h1>
          <p>description</p>
        </div>
      </div>
      <div class="row info_price">
        <div class="col-xs-3">
          <p>시술비용, 시술부위</p>
        </div>
        <div class="col-xs-9">
          <p>내용 <span>130만원</span></p>
        </div>
      </div>
      <div class="row info_long">
        <div class="col-xs-3">
          <p>유지기간</p>
        </div>
        <div class="col-xs-9">
          <p>1년 이상 <span></span></p>
        </div>
      </div>
      <div class="row info_unique">
        <div class="col-xs-3">
          <p>특이사항</p>
        </div>
        <div class="col-xs-9">
          <p>내용~~ <span>내용~~</span><span>내용~~</span><span>내용~~</span><span>내용~~</span></p>
        </div>
      </div>
    </div>
  </div>
  <div class="row forms">
    <form class="" action="prosess.php" method="post">
      <input type="hidden" name="cate" value="">
    <div class="col-sm-12">
      <h1>TITLE + 상담신청서</h1>
      <div class="row">
        <div class="col-sm-3">
          <p>이름</p>
        </div>
        <div class="col-sm-9">
          <input type="text" name="name" class="name" value="" placeholder="이름">
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <p>전화번호</p>
        </div>
        <div class="col-sm-9 phone">
          <select class="phone1" name="phone1">
            <option value="010">010</option>
            <option value="010">011</option>
            <option value="010">016</option>
            <option value="010">018</option>
            <option value="010">019</option>
          </select>
          <input type="text" name="phone2"class="phone2">
          <input type="text" name="phone3" class="phone3">
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <p>상담가능시간</p>
        </div>
        <div class="col-sm-9">
          <select class="can_date" name="can_date">
            <option value="">시간선택</option>
            <option value="11:00 ~ 12:00">11:00 ~ 12:00</option>
            <option value="12:00 ~ 13:00">12:00 ~ 13:00</option>
            <option value="13:00 ~ 14:00">13:00 ~ 14:00</option>
            <option value="14:00 ~ 15:00">14:00 ~ 15:00</option>
            <option value="15:00 ~ 16:00">15:00 ~ 16:00</option>
            <option value="16:00 ~ 17:00">15:00 ~ 17:00</option>
            <option value="17:00 ~ 18:00">15:00 ~ 18:00</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <p>상담내용</p>
        </div>
        <div class="col-sm-9">
          <textarea name="content" class="content"></textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12"><input type="checkbox" name="agree" class="agree" value="">
          <p style="display:inline-block">개인정보 수집 사용동의 <a href="javascript:agree_on()">자세히 보기</a></p>
        </div>
        <div class="col-sm-12">
          <button type="button" name="button" class="submit">상담하기</button>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <p style="text-align:center;">다르게 문의할 수는 없나?! 하는 언니들은 아래 눌러~</p>
        </div>
        <div class="col-xs-6 button_wrap">
          <button type="button" name="button" class="gohome"><a href="http://www.bioface.kr/bbs/board.php?bo_table=online_kor">온라인상담 > </a></button>
          <button type="button" name="button" class="kakao"><a href="http://goto.kakao.com/@비오페이스서울신사본점">카카오톡 상담 > </a></button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 sub_img">
      <iframe width="100%" class="youtube" height="500" src="https://www.youtube.com/embed/c88yQyqdfZY" frameborder="0" gesture="media"  allowfullscreen ></iframe>
      <img src="assets/img/<?=$cate2?>_img<?=$num?>.jpg" class="forPc" alt="">
      <img src="assets/img/<?=$cate2?>_img<?=$num?>_m.jpg" class="forM" alt="">
    </div>
  </div>
</div>

<?php
include_once('./footer.php');
?>
