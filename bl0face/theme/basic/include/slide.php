<?php
define('_INDEX_', true);
include_once('./_common.php');
?>

<link rel="stylesheet" href="/theme/basic/include/bootstrap/css/bootstrap.min.css">
<link href="/theme/basic/include/slick-1.8.0/slick/slick.css" rel="stylesheet">
<link href="/theme/basic/include/slick-1.8.0/slick/slick-theme.css" rel="stylesheet">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/theme/basic/include/bootstrap/js/bootstrap.min.js"></script>
<script src="/theme/basic/include/slick-1.8.0/slick/slick2.js"></script>

<style>
.slick_out {
	display: block;
	min-width: 1200px;
	width: 100%;
	height: 100vh;
}
.slider-nav img {
	margin: 0 2px;
}
.draggable {
	padding: 0 !important;
}
.main_info img{
	width: 100%;
}
.sub_imgs {
	height: 220px;
    width: 78%;
    margin: 0 auto;
    margin-top: -19%;
}
@media (max-width: 1400px) {
    .slick_out {
		height: 85vh;
	}

}
@media (max-width: 1300px) {
	.sub_imgs {
	    margin-top: -16%;
    	height: 100px;
	}

}
</style>
<div class="slick_out" style="position: relative; overflow: hidden;">

	<div class="slider-for main_imgs" style="position: relative;">
		<img src="/theme/basic/include/img/image8_large.jpg">
		<img src="/theme/basic/include/img/layer_new_bg.png">
		<img src="/theme/basic/include/img/image1_large.jpg">
		<img src="/theme/basic/include/img/image2_large.jpg">
		<img src="/theme/basic/include/img/image3_large.jpg">
		<img src="/theme/basic/include/img/image4_large.jpg">
		<img src="/theme/basic/include/img/image5_large.jpg">
		<img src="/theme/basic/include/img/image6_large.jpg">
		<img src="/theme/basic/include/img/image9_large.jpg">
	</div>

	<div class="slider-for main_info" style="position: absolute; top: 17%; left: 32%; width: 32%;">
		<a href="/theme/basic/sub01/sub03.php"><img src="/theme/basic/include/img/layer_08.png"></a>

		<a href="/bbs/board.php?bo_table=notice_kor&wr_id=4"><img src="/theme/basic/img/slide/layer_new.png"></a>
		<a href="/theme/basic/sub02/sub01.php"><img src="/theme/basic/img/slide/layer_01.png"></a>
		<a href="/theme/basic/sub02/sub02.php"><img src="/theme/basic/img/slide/layer_02.png"></a>
		<a href="/theme/basic/sub02/sub03.php"><img src="/theme/basic/img/slide/layer_03.png"></a>
		<a href="/theme/basic/sub02/sub04.php"><img src="/theme/basic/img/slide/layer_04.png"></a>
		<a href="/theme/basic/sub03/sub01.php"><img src="/theme/basic/img/slide/layer_05.png"></a>
		<a href="/theme/basic/sub02/sub09.php"><img src="/theme/basic/img/slide/layer_06.png"></a>
		<a href="/bbs/board.php?bo_table=event_kor"><img src="/theme/basic/img/slide/layer_09.png"></a>
	</div>

	<div class="sub_imgs">
		<div class="slider-nav" style="width: 100%; max-width: 1451px;">
			<img src="/theme/basic/include/img/thum_8.png">
			<img src="/theme/basic/include/img/thum_9.png">
			<img src="/theme/basic/include/img/thum_1.png">
			<img src="/theme/basic/include/img/thum_2.png">
			<img src="/theme/basic/include/img/thum_3.png">
			<img src="/theme/basic/include/img/thum_4.png">
			<img src="/theme/basic/include/img/thum_5.png">
			<img src="/theme/basic/include/img/thum_6.png">
			<img src="/theme/basic/include/img/thum_10-1.png" class="change">
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('.slider-for').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		fade: true,
		autoplay: false,
		asNavFor: '.slider-nav'
	});

	$('.slider-nav').slick({
		slidesToShow: 9,
		slidesToScroll: false,
		Scroll: false,
		asNavFor: '.slider-for',
		dots: false,
		centerMode: true,
		focusOnSelect: true,
	});
});
</script>

<script>
var change_index = 0;

setInterval(function(){
	
	if(change_index == 0){
		$('.change').attr('src','/theme/basic/img/slide/thum_10-2.png');
		change_index = 1;
	} else {
		$('.change').attr('src','/theme/basic/img/slide/thum_10-1.png');
		change_index = 0;
	}
}, 500);
</script>