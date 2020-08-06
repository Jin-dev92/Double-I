<?php
header('X-Frame-Options: GOFORIT');
define('_INDEX_', true);
include_once('./_common.php');
if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/sub06/sub05.php');
    return;
}
include_once(G5_THEME_PATH.'/include/sub_head.php');
?>
<?php
// include_once(G5_THEME_PATH.'/include/sub_main_head5.php');
?>
<style>
	/*비오페이스*/
	.sub_main {position:relative;width:100%; overflow:hidden; padding-top:50px; }
	.sub02_img img {
		position:relative; width:100%;
	}
	.tabs, .tabs li {
		outline: 1px solid #999;
	}
	.tabs li a{
		color: #000 !important;
		font-family: 'Nanum Barun Gothic', sans-serif;
	}
	.tabs .tab a:hover, .tabs .tab a.active {
		background-color: #1BB3B6 !important;
		color: #fff !important;
		text-decoration: none;
	}
	.tabs .indicator{
		display: none;
	}
	.video_wrap {
		position: absolute;
		width: 530px;
		height: 300px;
		top: 39%;
		left: 43%;
		background-color: #245F5B;
	}
	.movePrevCarousel, .moveNextCarousel {
		cursor: pointer;
	}
</style>

<div id="sub_title">
		<ul class="sub_ul">
			<li class="sub_li01"><a href="http://www.bioface.kr"><img src="/theme/basic/include/img/sub_home_icon.png">HOME</a></li>
			<span>-</span>
			<li class="sub_li02">ETC</li>
		</ul>
</div>

<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="/theme/basic/css/materialize.min.css">
<link rel="stylesheet" href="/theme/basic/css/swiper.min.css">

<div class="sub_main" style="height: auto; min-width: 1200px;">
	<!-- 탭 -->
	<div class="row" style="margin-top: 60px; max-width: 1200px;">
		<div class="col s12">
			<ul class="tabs">
				<li class="tab col s3"><a class="fat" href="/theme/basic/sub06/sub02.php">비만클리닉</a></li>
				<li class="tab col s3"><a class="brain" href="/theme/basic/sub06/sub03.php">뇌피트니스</a></li>
				<li class="tab col s3"><a class="pisto" href="/theme/basic/sub06/sub04.php">피스토주사</a></li>
				<li class="tab col s3"><a class="active" href="/theme/basic/sub06/sub05.php" onclick="not_ready()">전후사진</a></li>
			</ul>
		</div>
	</div>

	<div class="col s12 sub02_img" style="height: auto;">
		<div style="position: relative;">
			<img src="/theme/basic/sub06/img/sub_06_bfaft_01.jpg" style="position: relative;">
			<div class="video_wrap">
				<iframe src="http://www.youtube.com/embed/YATvgx-0k24?rel=0&autoplay=true" class="video" frameborder="0" style="max-width:100%; width:100%; height: 100%;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
			</div>
		</div>

		<div style="width: 100%; height: 690px;">
			<div style="height: 830px; position: relative; margin: 0 auto; background-image: url('/theme/basic/sub06/img/sub_06_bfaft_02.png'); background-repeat: no-repeat; width: 1200px; top: -140px;">
					
					<div class="carousel carousel-slider" style="height: 735px; width: 1000px; margin: 0 auto; position: relative; top: 95px;">
						<a class="carousel-item" href="#one!"><img src="/theme/basic/sub06/img/sub_06_bfaft_02-1.jpg"></a>
						<a class="carousel-item" href="#two!"><img src="/theme/basic/sub06/img/sub_06_bfaft_02-2.jpg"></a>
						<a class="carousel-item" href="#three!"><img src="/theme/basic/sub06/img/sub_06_bfaft_02-3.jpg"></a>
						<a class="carousel-item" href="#four!"><img src="/theme/basic/sub06/img/sub_06_bfaft_02-4.jpg"></a>
						<a class="carousel-item" href="#five!"><img src="/theme/basic/sub06/img/sub_06_bfaft_02-5.jpg"></a>
					</div>
					
					<img src="/theme/basic/sub06/img/sub_06_bfaft_02-6.png" style="position: absolute; top: 45%; left: 40%; z-index: 9; width: 200px;">

					<img class="movePrevCarousel" src="/theme/basic/sub06/img/left_btn.png" style="position: absolute; top: 50%; left: 0; width: 50px;">

					<img class="moveNextCarousel" src="/theme/basic/sub06/img/right_btn.png" style="position: absolute; top: 50%; right: 0; width: 50px;">
			</div>
		</div>

		<div style="display: block; width: 100%; position: relative;">
			<div style="width: 100%; background-color: pink; background-image: url('/theme/basic/sub06/img/sub_06_bfaft_03.jpg'); background-size: 100% auto;">

				<div style="height: 1280px; position: relative; margin: 0 auto; background-image: url('/theme/basic/sub06/img/sub_06_bfaft_02.png'); background-repeat: no-repeat; width: 1200px; top: 470px;">

					<div class="carousel carousel-slider" style="height: 750px; width: 1000px; margin: 0 auto; position: relative; top: 95px;">
						<a class="carousel-item" href="#one!"><img src="/theme/basic/sub06/img/sub_06_bfaft_03-1.jpg"></a>
						<a class="carousel-item" href="#two!"><img src="/theme/basic/sub06/img/sub_06_bfaft_03-2.jpg"></a>
						<a class="carousel-item" href="#three!"><img src="/theme/basic/sub06/img/sub_06_bfaft_03-3.jpg"></a>
					</div>
					
					<img src="/theme/basic/sub06/img/sub_06_bfaft_03-4.png" style="position: absolute; top: 35%; left: 40%; z-index: 9; width: 200px;">

					<img class="movePrevCarousel" src="/theme/basic/sub06/img/left_btn.png" style="position: absolute; top: 40%; left: 0; width: 50px;">

					<img class="moveNextCarousel" src="/theme/basic/sub06/img/right_btn.png" style="position: absolute; top: 40%; right: 0; width: 50px;">
				</div>
			</div>
		</div>
		
		<img src="/theme/basic/sub06/img/sub_06_bfaft_04.jpg" style="position: relative;">

		<div style="position: relative; height: 500px; min-width: 1200px;">
			<div class="carousel carousel-slider" style="width: 1000px; height: 600px; margin: 0 auto;">
				<a class="carousel-item" href="#one!"><img src="/theme/basic/sub06/img/sub_06_bfaft_04-1.jpg"></a>
				<a class="carousel-item" href="#two!"><img src="/theme/basic/sub06/img/sub_06_bfaft_04-2.jpg"></a>
				<a class="carousel-item" href="#three!"><img src="/theme/basic/sub06/img/sub_06_bfaft_04-3.jpg"></a>
			</div>

			<img class="movePrevCarousel" src="/theme/basic/sub06/img/left_btn.png" style="position: absolute; top: 50%; left: 10%; width: 50px;">

			<img class="moveNextCarousel" src="/theme/basic/sub06/img/right_btn.png" style="position: absolute; top: 50%; right: 10%; width: 50px;">			
		</div>
		<img src="/theme/basic/sub06/img/sub_06_bfaft_04-4.png" style="display: block; margin: 0 auto; width: 1000px; margin-bottom: 100px;">

		<div style="position: relative; height: 500px; min-width: 1200px;">
			<div class="carousel carousel-slider" style="width: 1000px; height: 600px; margin: 0 auto;">
				<a class="carousel-item" href="#one!"><img src="/theme/basic/sub06/img/sub_06_bfaft_05-1.jpg"></a>
				<a class="carousel-item" href="#two!"><img src="/theme/basic/sub06/img/sub_06_bfaft_05-2.jpg"></a>
				<a class="carousel-item" href="#three!"><img src="/theme/basic/sub06/img/sub_06_bfaft_05-3.jpg"></a>
			</div>

			<img class="movePrevCarousel" src="/theme/basic/sub06/img/left_btn.png" style="position: absolute; top: 50%; left: 10%; width: 50px;">

			<img class="moveNextCarousel" src="/theme/basic/sub06/img/right_btn.png" style="position: absolute; top: 50%; right: 10%; width: 50px;">			
		</div>
		<img src="/theme/basic/sub06/img/sub_06_bfaft_05-4.png" style="display: block; margin: 0 auto; width: 1000px; margin-bottom: 100px;">

		<div style="position: relative; height: 500px; min-width: 1200px;">
			<div class="carousel carousel-slider" style="width: 1000px; height: 600px; margin: 0 auto;">
				<a class="carousel-item" href="#one!"><img src="/theme/basic/sub06/img/sub_06_bfaft_06-1.jpg"></a>
				<a class="carousel-item" href="#two!"><img src="/theme/basic/sub06/img/sub_06_bfaft_06-2.jpg"></a>
				<a class="carousel-item" href="#three!"><img src="/theme/basic/sub06/img/sub_06_bfaft_06-3.jpg"></a>
			</div>

			<img class="movePrevCarousel" src="/theme/basic/sub06/img/left_btn.png" style="position: absolute; top: 50%; left: 10%; width: 50px;">

			<img class="moveNextCarousel" src="/theme/basic/sub06/img/right_btn.png" style="position: absolute; top: 50%; right: 10%; width: 50px;">			
		</div>
		<img src="/theme/basic/sub06/img/sub_06_bfaft_06-4.png" style="display: block; margin: 0 auto; width: 1000px; margin-bottom: 100px;">
	
		
	</div>
</div>

<script src="/theme/basic/js/materialize.min.js"></script>
<script>
$(document).ready(function(){
	var btn_check = 0;;

	$('.carousel').carousel();

	// move next carousel
	$('.moveNextCarousel').click(function(e){
		e.preventDefault();
		e.stopPropagation();
		$(this).siblings('.carousel').carousel('next');
		// $('.carousel').carousel('next');
	});
	// move prev carousel
	$('.movePrevCarousel').click(function(e){
		e.preventDefault();
		e.stopPropagation();
		$(this).siblings('.carousel').carousel('prev');
		// $('.carousel').carousel('prev');
	});

	$('.movePrevCarousel').hover(function(){
		if(btn_check == 0){
			$('.movePrevCarousel').attr('src','/theme/basic/sub06/img/left_btn_on.png');
			btn_check = 1;
		} else {
			$('.movePrevCarousel').attr('src','/theme/basic/sub06/img/left_btn.png');
			btn_check = 0;
		}

	});

	$('.moveNextCarousel').hover(function(){
		if(btn_check == 0){
			$('.moveNextCarousel').attr('src','/theme/basic/sub06/img/right_btn_on.png');
			btn_check = 1;
		} else {
			$('.moveNextCarousel').attr('src','/theme/basic/sub06/img/right_btn.png');
			btn_check = 0;
		}

	});

});

</script>
<?php
include_once(G5_THEME_PATH.'/tail.php');
?>