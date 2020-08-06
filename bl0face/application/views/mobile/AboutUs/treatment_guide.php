<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
  // PC
  header("Location: /AboutUs/treatment_guide");
} else {
  //MOBILE
}
?>
<link rel="stylesheet" type="text/css" href="../assets/css/slider-pro.min.css" media="screen"/>
<style>
  .m_header { display: block !important;}
  footer { max-width: 640px;}
  .sub_img{ width: 100%; position: relative; margin-top: 50px; max-width: 640px;}
  .sub_img h5 { margin: 30px 0; }
  #example3 { margin-bottom: 50px; height: 70vh;}
  .sp-thumbnail { margin-top: 5px !important;}
  .sp-thumbnail-container { height: 80px !important;}
  .notice{ position:relative; padding:0 0 50px; text-align:center}
  .notice img{ max-width:95%;}
  #notice_corona_location{ position:absolute; left:0; top:-60px; width:100%;}
  @media (max-width: 768px){
    #example3 { height: 50vh;}
  }
</style>

<div class="sub_img">
  <img src="../assets/img/sub/AboutUs/treatment_guide01_m.jpg?<?=rand()?>">

  <h5 class="ko_bold main_f_color align_center">비오페이스 원내 둘러보기</h5>
</div>


<div id="example3" class="slider-pro">
  <div class="sp-slides">
    <div class="sp-slide">
      <img class="sp-image" src="../src/css/images/blank.gif"
        data-src="../assets/img/sub/AboutUs/slide_01.jpg?<?=rand()?>"/>
    </div>

        <div class="sp-slide">
          <img class="sp-image" src="../src/css/images/blank.gif"
            data-src="../assets/img/sub/AboutUs/slide_02.jpg?<?=rand()?>"/>
    </div>

    <div class="sp-slide">
      <img class="sp-image" src="../src/css/images/blank.gif"
        data-src="../assets/img/sub/AboutUs/slide_03.jpg?<?=rand()?>" />
    </div>

    <div class="sp-slide">
      <img class="sp-image" src="../src/css/images/blank.gif"
        data-src="../assets/img/sub/AboutUs/slide_04.jpg?<?=rand()?>" />
    </div>

    <div class="sp-slide">
      <img class="sp-image" src="../src/css/images/blank.gif"
        data-src="../assets/img/sub/AboutUs/slide_05.jpg?<?=rand()?>" />
    </div>

    <div class="sp-slide">
      <img class="sp-image" src="../src/css/images/blank.gif"
        data-src="../assets/img/sub/AboutUs/slide_06.jpg?<?=rand()?>" />
    </div>

    <div class="sp-slide">
      <img class="sp-image" src="../src/css/images/blank.gif"
        data-src="../assets/img/sub/AboutUs/slide_07.jpg?<?=rand()?>"/>
    </div>

    <div class="sp-slide">
      <img class="sp-image" src="../src/css/images/blank.gif"
        data-src="../assets/img/sub/AboutUs/slide_08.jpg?<?=rand()?>"/>
    </div>

    <div class="sp-slide">
      <img class="sp-image" src="../src/css/images/blank.gif"
        data-src="../assets/img/sub/AboutUs/slide_09.jpg?<?=rand()?>"/>
    </div>

    <div class="sp-slide">
      <img class="sp-image" src="../src/css/images/blank.gif"
        data-src="../assets/img/sub/AboutUs/slide_10.jpg?<?=rand()?>"/>
    </div>

    <div class="sp-slide">
      <img class="sp-image" src="../src/css/images/blank.gif"
        data-src="../assets/img/sub/AboutUs/slide_11.jpg?<?=rand()?>"/>
    </div>

    <div class="sp-slide">
      <img class="sp-image" src="../src/css/images/blank.gif"
        data-src="../assets/img/sub/AboutUs/slide_12.jpg?<?=rand()?>"/>
    </div>

    <div class="sp-slide">
      <img class="sp-image" src="../src/css/images/blank.gif"
        data-src="../assets/img/sub/AboutUs/slide_14.jpg?<?=rand()?>"/>
    </div>

    <div class="sp-slide">
      <img class="sp-image" src="../src/css/images/blank.gif"
        data-src="../assets/img/sub/AboutUs/slide_15.jpg?<?=rand()?>"/>
    </div>

    <div class="sp-slide">
      <img class="sp-image" src="../src/css/images/blank.gif"
        data-src="../assets/img/sub/AboutUs/slide_16.jpg?<?=rand()?>"/>
    </div>

    <div class="sp-slide">
      <img class="sp-image" src="../src/css/images/blank.gif"
        data-src="../assets/img/sub/AboutUs/slide_17.jpg?<?=rand()?>"/>
    </div>

    <div class="sp-slide">
      <img class="sp-image" src="../src/css/images/blank.gif"
        data-src="../assets/img/sub/AboutUs/slide_18.jpg?<?=rand()?>"/>
    </div>

    <div class="sp-slide">
      <img class="sp-image" src="../src/css/images/blank.gif"
        data-src="../assets/img/sub/AboutUs/slide_19.jpg?<?=rand()?>"/>
    </div>

    <div class="sp-slide">
      <img class="sp-image" src="../src/css/images/blank.gif"
        data-src="../assets/img/sub/AboutUs/slide_20.jpg?<?=rand()?>"/>
    </div>

    <div class="sp-slide">
      <img class="sp-image" src="../src/css/images/blank.gif"
        data-src="../assets/img/sub/AboutUs/slide_21.jpg?<?=rand()?>"/>
    </div>

  </div>

  <div class="sp-thumbnails">
    <img class="sp-thumbnail" src="../assets/img/sub/AboutUs/slide_01.jpg?<?=rand()?>"/>
    <img class="sp-thumbnail" src="../assets/img/sub/AboutUs/slide_02.jpg?<?=rand()?>"/>
    <img class="sp-thumbnail" src="../assets/img/sub/AboutUs/slide_03.jpg?<?=rand()?>"/>
    <img class="sp-thumbnail" src="../assets/img/sub/AboutUs/slide_04.jpg?<?=rand()?>"/>
    <img class="sp-thumbnail" src="../assets/img/sub/AboutUs/slide_05.jpg?<?=rand()?>"/>
    <img class="sp-thumbnail" src="../assets/img/sub/AboutUs/slide_06.jpg?<?=rand()?>"/>
    <img class="sp-thumbnail" src="../assets/img/sub/AboutUs/slide_07.jpg?<?=rand()?>"/>
    <img class="sp-thumbnail" src="../assets/img/sub/AboutUs/slide_08.jpg?<?=rand()?>"/>
    <img class="sp-thumbnail" src="../assets/img/sub/AboutUs/slide_09.jpg?<?=rand()?>"/>
    <img class="sp-thumbnail" src="../assets/img/sub/AboutUs/slide_10.jpg?<?=rand()?>"/>
    <img class="sp-thumbnail" src="../assets/img/sub/AboutUs/slide_11.jpg?<?=rand()?>"/>
    <img class="sp-thumbnail" src="../assets/img/sub/AboutUs/slide_12.jpg?<?=rand()?>"/>
    <img class="sp-thumbnail" src="../assets/img/sub/AboutUs/slide_14.jpg?<?=rand()?>"/>
    <img class="sp-thumbnail" src="../assets/img/sub/AboutUs/slide_15.jpg?<?=rand()?>"/>
    <img class="sp-thumbnail" src="../assets/img/sub/AboutUs/slide_16.jpg?<?=rand()?>"/>
    <img class="sp-thumbnail" src="../assets/img/sub/AboutUs/slide_17.jpg?<?=rand()?>"/>
    <img class="sp-thumbnail" src="../assets/img/sub/AboutUs/slide_18.jpg?<?=rand()?>"/>
    <img class="sp-thumbnail" src="../assets/img/sub/AboutUs/slide_19.jpg?<?=rand()?>"/>
    <img class="sp-thumbnail" src="../assets/img/sub/AboutUs/slide_20.jpg?<?=rand()?>"/>
    <img class="sp-thumbnail" src="../assets/img/sub/AboutUs/slide_21.jpg?<?=rand()?>"/>
  </div>
</div>

<div class="notice"><div id="notice_corona_location"></div><img src="../assets/img/sub/AboutUs/corona.jpg?<?=rand()?>"></div>

<script type="text/javascript" src="../assets/js/jquery.sliderPro.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
  $('.m_header_info li:eq(0)').trigger('click');

  $('.m_header_tab ul:eq(0) li:eq(2)').addClass('active');
});

  $( document ).ready(function( $ ) {
    $( '#example3' ).sliderPro({
      width: 600,
      height: 400,
      fade: true,
      arrows: true,
      buttons: false,
      fullScreen: true,
      shuffle: false,
      thumbnailArrows: true,
      autoplay: true,
      fadeDuration: 1500,
      slideAnimationDuration : 100,
    });
  });
</script>