<?php
define('_INDEX_', true);
include_once('./_common.php');
if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/sub01/sub03.php');
    return;
}
include_once(G5_THEME_PATH.'/include/sub_head.php');
?>
<style>
#sub_mainImg {position:relative;width:100%;height:3000px;overflow:hidden;}
#sub_mainImg .sb_img {position:relative;width:100%;height:100%;margin-top: 50px;min-width: 1200px;}
#sub_mainImg .sb_img img{max-width: 1200px;}
#example3{padding-top: 40px;}
.t_pop{position: fixed; left: 50%;margin-left: -444px; top:50%; margin-top:-420px; z-index: 9999999; display: none;}
.x_bt{position: absolute;right: 10px;top:10px; cursor: pointer;}
.bbg{position: fixed; z-index: -1;width: 100%; height: 100%; left: 0; top: 0; background: #000; opacity: 0.5; display: none;}
</style>

<?php
include_once(G5_THEME_PATH.'/include/sub_main_head1.php');
?>
<link rel="stylesheet" type="text/css" href="/theme/basic/css/sub_slider-pro.min.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="/theme/basic/css/sub_examples.css" media="screen"/>
<script type="text/javascript">
function tum_on(num){
  $(".tum"+num).css("opacity","0.5");
}
function tum_off(){
  $(".sp-thumbnail").css("opacity","1");
}
function tum_click(num){
  $(".tm_pop"+num).fadeIn(500);
  $(".bbg").fadeIn(500);
}
function pop_down(num){
  $(".tm_pop"+num).fadeOut(500);
  $(".bbg").fadeOut(500);
}


</script>
<script type="text/javascript" src="/theme/basic/js/jquery.sliderPro.min.js"></script>
<div id="sub_title">
		<ul class="sub_ul">
			<li class="sub_li01"><a href="http://www.bioface.kr"><img src="/theme/basic/include/img/sub_home_icon.png">HOME</a></li>
			<span>-</span>
			<li class="sub_li02">BIOFACE STORY</li>
		</ul>
</div>

<div id="sub_mainImg">
	<div class="sb_img">
		<img class="sp-thumbnail" src="/theme/basic/sub01/img/sub03_1.jpg" style="display: block; margin: 0 auto; width: 100%" / >
		<div style="display: block; margin: 0 auto; text-align: center;">
			<img class="sp-thumbnail tum1" src="/theme/basic/sub01/img/sub03_2.jpg"/
      style="margin-right:140px; margin-top:50px; margin-bottom:50px; cursor:pointer" onmouseover="tum_on(1);" onmouseout="tum_off();" onclick="tum_click(1);">
			<img class="sp-thumbnail tum2" src="/theme/basic/sub01/img/sub03_3.jpg"/ style="margin-top:50px; margin-bottom:50px; cursor:pointer"  onmouseover="tum_on(2);" onmouseout="tum_off();" onclick="tum_click(2);">
		</div>
		<img class="sp-thumbnail" src="/theme/basic/sub01/img/sub03_4.jpg"/ style=" display: block; margin: 0 auto;">
	</div>
</div>
<div class="t_pop tm_pop1">
  <div class="bbg">

  </div>
  <img src="/theme/basic/img/pop/X.png" border="0" class="x_bt">
  <img src="/theme/basic/sub01/img/tum1.jpg" alt="">
</div>

<div class="t_pop tm_pop2">
  <div class="bbg">

  </div>
  <img src="/theme/basic/img/pop/X.png" border="0" class="x_bt">
  <img src="/theme/basic/sub01/img/tum2.jpg" alt="">
</div>

<!-- ///////////////////슬라이////////////////////// -->

<script type="text/javascript">

	$( document ).ready(function( $ ) {
    $(".bbg").click(function(){
      $(".t_pop").fadeOut(500);
      $(".bbg").fadeOut(500);
    })
    $(window).scroll(function(){
      $(".t_pop").fadeOut(500);
      $(".bbg").fadeOut(500);
    })
    $(".x_bt").click(function(){
      var idx = $(".x_bt").index(this);
      pop_down(idx+1);
    })
		$( '#example3' ).sliderPro({
			width: 1200,
			height: 650,
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

<div id="example3" class="slider-pro">
		<div class="sp-slides">
			<div class="sp-slide">
				<img class="sp-image" src="../src/css/images/blank.gif"
					data-src="/theme/basic/sub01/img/slide/slide_01.jpg"/>
			</div>

	        <div class="sp-slide">
	        	<img class="sp-image" src="../src/css/images/blank.gif"
	        		data-src="/theme/basic/sub01/img/slide/slide_02.jpg"/>
			</div>

			<div class="sp-slide">
				<img class="sp-image" src="../src/css/images/blank.gif"
					data-src="/theme/basic/sub01/img/slide/slide_03.jpg" />
			</div>

			<div class="sp-slide">
				<img class="sp-image" src="../src/css/images/blank.gif"
					data-src="/theme/basic/sub01/img/slide/slide_04.jpg" />
			</div>

			<div class="sp-slide">
				<img class="sp-image" src="../src/css/images/blank.gif"
					data-src="/theme/basic/sub01/img/slide/slide_05.jpg" />
			</div>

			<div class="sp-slide">
				<img class="sp-image" src="../src/css/images/blank.gif"
					data-src="/theme/basic/sub01/img/slide/slide_06.jpg" />
			</div>

			<div class="sp-slide">
				<img class="sp-image" src="../src/css/images/blank.gif"
					data-src="/theme/basic/sub01/img/slide/slide_07.jpg"/>
			</div>

			<div class="sp-slide">
				<img class="sp-image" src="../src/css/images/blank.gif"
					data-src="/theme/basic/sub01/img/slide/slide_08.jpg"/>
			</div>

			<div class="sp-slide">
				<img class="sp-image" src="../src/css/images/blank.gif"
					data-src="/theme/basic/sub01/img/slide/slide_09.jpg"/>
			</div>

			<div class="sp-slide">
				<img class="sp-image" src="../src/css/images/blank.gif"
					data-src="/theme/basic/sub01/img/slide/slide_10.jpg"/>
			</div>

			<div class="sp-slide">
				<img class="sp-image" src="../src/css/images/blank.gif"
					data-src="/theme/basic/sub01/img/slide/slide_11.jpg"/>
			</div>

			<div class="sp-slide">
				<img class="sp-image" src="../src/css/images/blank.gif"
					data-src="/theme/basic/sub01/img/slide/slide_12.jpg"/>
			</div>

			<div class="sp-slide">
				<img class="sp-image" src="../src/css/images/blank.gif"
					data-src="/theme/basic/sub01/img/slide/slide_13.jpg"/>
			</div>

			<div class="sp-slide">
				<img class="sp-image" src="../src/css/images/blank.gif"
					data-src="/theme/basic/sub01/img/slide/slide_14.jpg"/>
			</div>

			<div class="sp-slide">
				<img class="sp-image" src="../src/css/images/blank.gif"
					data-src="/theme/basic/sub01/img/slide/slide_15.jpg"/>
			</div>

			<div class="sp-slide">
				<img class="sp-image" src="../src/css/images/blank.gif"
					data-src="/theme/basic/sub01/img/slide/slide_16.jpg"/>
			</div>

			<div class="sp-slide">
				<img class="sp-image" src="../src/css/images/blank.gif"
					data-src="/theme/basic/sub01/img/slide/slide_17.jpg"/>
			</div>

			<div class="sp-slide">
				<img class="sp-image" src="../src/css/images/blank.gif"
					data-src="/theme/basic/sub01/img/slide/slide_18.jpg"/>
			</div>

			<div class="sp-slide">
				<img class="sp-image" src="../src/css/images/blank.gif"
					data-src="/theme/basic/sub01/img/slide/slide_19.jpg"/>
			</div>

			<div class="sp-slide">
				<img class="sp-image" src="../src/css/images/blank.gif"
					data-src="/theme/basic/sub01/img/slide/slide_20.jpg"/>
			</div>

			<div class="sp-slide">
				<img class="sp-image" src="../src/css/images/blank.gif"
					data-src="/theme/basic/sub01/img/slide/slide_21.jpg"/>
			</div>

		</div>

		<div class="sp-thumbnails">
			<img class="sp-thumbnail" src="/theme/basic/sub01/img/slide/slide_01.jpg"/>
			<img class="sp-thumbnail" src="/theme/basic/sub01/img/slide/slide_02.jpg"/>
			<img class="sp-thumbnail" src="/theme/basic/sub01/img/slide/slide_03.jpg"/>
			<img class="sp-thumbnail" src="/theme/basic/sub01/img/slide/slide_04.jpg"/>
			<img class="sp-thumbnail" src="/theme/basic/sub01/img/slide/slide_05.jpg"/>
			<img class="sp-thumbnail" src="/theme/basic/sub01/img/slide/slide_06.jpg"/>
			<img class="sp-thumbnail" src="/theme/basic/sub01/img/slide/slide_07.jpg"/>
			<img class="sp-thumbnail" src="/theme/basic/sub01/img/slide/slide_08.jpg"/>
			<img class="sp-thumbnail" src="/theme/basic/sub01/img/slide/slide_09.jpg"/>
			<img class="sp-thumbnail" src="/theme/basic/sub01/img/slide/slide_10.jpg"/>
			<img class="sp-thumbnail" src="/theme/basic/sub01/img/slide/slide_11.jpg"/>
			<img class="sp-thumbnail" src="/theme/basic/sub01/img/slide/slide_12.jpg"/>
			<img class="sp-thumbnail" src="/theme/basic/sub01/img/slide/slide_13.jpg"/>
			<img class="sp-thumbnail" src="/theme/basic/sub01/img/slide/slide_14.jpg"/>
			<img class="sp-thumbnail" src="/theme/basic/sub01/img/slide/slide_15.jpg"/>
			<img class="sp-thumbnail" src="/theme/basic/sub01/img/slide/slide_16.jpg"/>
			<img class="sp-thumbnail" src="/theme/basic/sub01/img/slide/slide_17.jpg"/>
			<img class="sp-thumbnail" src="/theme/basic/sub01/img/slide/slide_18.jpg"/>
			<img class="sp-thumbnail" src="/theme/basic/sub01/img/slide/slide_19.jpg"/>
			<img class="sp-thumbnail" src="/theme/basic/sub01/img/slide/slide_20.jpg"/>
			<img class="sp-thumbnail" src="/theme/basic/sub01/img/slide/slide_21.jpg"/>
		</div>
    </div>
<?php
include_once(G5_THEME_PATH.'/tail.php');
?>
