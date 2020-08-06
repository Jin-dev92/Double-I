<?php
define('_INDEX_', true);
include_once('./_common.php');

include_once(G5_THEME_MOBILE_PATH.'/include/sub_head.php');
?>
<?php
include_once(G5_THEME_MOBILE_PATH.'/include/sub_main_head1.php');
?>
<link rel="stylesheet" type="text/css" href="/theme/basic/css/sub_slider-pro.min.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="/theme/basic/css/sub_examples.css" media="screen"/>
<script type="text/javascript" src="/theme/basic/js/jquery.sliderPro.min.js"></script>
<style media="screen">
	.sub_main_img img{margin: 0 auto; display: block;}
	.tm{cursor: pointer; box-shadow: 0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 10px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.3);}
	.pops{position: fixed; width: 100%;height: 100%;z-index: 9999; display: none;top:0; left:0;}
	.pops img{width: 90%;display: block; margin: 0 auto;margin-top:150px; }
	.pops .pop_down{width: 80px; height: 80px;margin-top: 0;}
	.pop_down{position: absolute;right:30px; top:160px;}
	.tmpop_img{ box-shadow: 0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 10px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.3);}
	.bbg{position: fixed; z-index: -1;width: 100%; height: 100%; left: 0; top: 0; background: #000; opacity: 0.5; display: none;}
</style>
<div id="sub_title">
		<ul class="sub_ul">
			<li class="sub_li01"><a href="http://www.bioface.kr"><img src="/theme/basic/include/img/sub_home_icon.png">HOME</a></li>
			<span>-</span>
			<li class="sub_li02">BIOFACE STORY</li>
		</ul>
</div>

<div class="pops tm_pop1">

	<img src="/theme/basic/img/pop/X.png" alt="" class="pop_down" >
	<img src="/theme/basic/mobile/sub01/img/m_tm1.jpg" class="tmpop_img">
	<div class="bbg">

	</div>
</div>
<div class="pops tm_pop2">

	<img src="/theme/basic/img/pop/X.png" alt="" class="pop_down" >
	<img src="/theme/basic/mobile/sub01/img/m_tm2.jpg" class="tmpop_img">
	<div class="bbg">

	</div>
</div>
<div class="sub_main">
	<div class="sub_main_img">
		<img src="/theme/basic/mobile/sub01/img/sub03_1.jpg">
		<img src="/theme/basic/mobile/sub01/img/sub03_2.jpg" class="tm" >
		<img src="/theme/basic/mobile/sub01/img/sub03_3.jpg">
		<img src="/theme/basic/mobile/sub01/img/sub03_4.jpg" class="tm">
		<img src="/theme/basic/mobile/sub01/img/sub03_5.jpg">
	</div>
</div>
<script type="text/javascript">
$(function(){
	$(".tm").click(function(){
		var idx = $(".tm").index(this);
		idx = idx+1;
		$(".tm_pop"+idx).fadeIn(500);
		$(".bbg").fadeIn(500);
	})
	$(".pop_down").click(function(){
		$(".pops").fadeOut(500);
		$(".bbg").fadeOut(500);
	})
	$(".bbg").click(function(){
		$(".pops").fadeOut(500);
		$(".bbg").fadeOut(500);
	})
	$(window).scroll(function(){
		$(".pops").fadeOut(500);
		$(".bbg").fadeOut(500);
	})
})

</script>
<script type="text/javascript">
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
