<?php
define('_INDEX_', true);
include_once('./_common.php');

include_once(G5_THEME_MOBILE_PATH.'/include/sub_head.php');
?>
<?php
include_once(G5_THEME_MOBILE_PATH.'/include/sub_main_head1.php');
?>
<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="/theme/basic/css/materialize.min.css">
<link href='https://cdn.rawgit.com/openhiun/hangul/14c0f6faa2941116bb53001d6a7dcd5e82300c3f/nanumbarungothic.css' rel='stylesheet' type='text/css'>
<style>
	#document {
		margin-top: -40px !important;
	}
	.smFixed {
		margin-top: -40px !important;
	}

	.sub02_tabs .tab a {
	    padding: 0 12px;
	}
	.sub02_tabs .tab a {
	    display: block;
	    font-size: 20px;
	    -webkit-transition: color .28s ease, background-color .28s ease;
	    transition: color .28s ease, background-color .28s ease;
	}
	a:link, a:visited {
	    color: #000;
	    text-decoration: none;
	}

	.sub02_img img {
		position:relative; width:100%;
	}

	.sub02_tabs, .sub02_tabs li {
		outline: 1px solid #999;
		list-style: none;
		padding: 0;
		line-height: 60px;
	}
	.sub02_tabs li a{
		color: #000 !important;
		font-family: 'Nanum Barun Gothic', sans-serif;
	}
	.sub02_tabs .tab a.active {
		background-color: #1BB3B6 !important;
		color: #fff !important;
		text-decoration: none;
	}
	.sub02_tabs .s6{
		padding: 0;
		width: 50%;
		float: left;
		text-align: center;
	}
	.video_wrap {
		position: absolute;
		width: 300px;
		height: 175px;
		top: 39%;
		left: 39%;
		background-color: #245F5B;
	}
</style>

<div id="sub_title">
		<ul class="sub_ul">
			<li class="sub_li01"><a href="http://www.bioface.kr"><img src="/theme/basic/include/img/sub_home_icon.png">HOME</a></li>
			<span>-</span>
			<li class="sub_li02">PISTO</li>
		</ul>
</div>
<div class="sub_main">
	<!-- ? -->
	<div class="row" style="width: 100%; max-width: 640px; margin: 0;">
		<div class="col s12 beforeafter_header" style="padding: 0;">
			<ul class="sub02_tabs">
				<li class="tab col s6"><a class="fat" href="/theme/basic/sub06/sub02.php">비만클리닉</a></li>
				<li class="tab col s6"><a class="brain" href="/theme/basic/sub06/sub03.php">뇌피트니스</a></li>
				<li class="tab col s6"><a class="pisto" href="/theme/basic/sub06/sub04.php">피스토주사</a></li>
				<li class="tab col s6"><a class="active test4" href="#" onclick="not_ready()">전후사진</a></li>
			</ul>
		</div>
	</div>
	<div class="col s12 sub02_img" style="height: auto;">
		<div style="position: relative;">
			<img src="/theme/basic/mobile/sub06/img/sub_06_bfaft_01_m.jpg" style="position: relative;">
			<div class="video_wrap">
				<iframe src="http://www.youtube.com/embed/YATvgx-0k24" class="video" frameborder="0" style="max-width:100%; width:100%; height: 100%;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
			</div>
		</div>

		<div style="width: 100%; height: 330px;">
			<div style="height: 675px; position: relative; margin: 0 auto; background-image: url('/theme/basic/sub06/img/sub_06_bfaft_02.png'); background-repeat: no-repeat; width: 80%; top: -90px; background-size: 100% auto;">
					
					<div class="carousel carousel-slider" style="height: 735px; width: 100%; margin: 0 auto; position: relative; top: 40px;">
						<a class="carousel-item" href="#one!"><img src="/theme/basic/sub06/img/sub_06_bfaft_02-1.jpg"></a>
						<a class="carousel-item" href="#two!"><img src="/theme/basic/sub06/img/sub_06_bfaft_02-2.jpg"></a>
						<a class="carousel-item" href="#three!"><img src="/theme/basic/sub06/img/sub_06_bfaft_02-3.jpg"></a>
						<a class="carousel-item" href="#four!"><img src="/theme/basic/sub06/img/sub_06_bfaft_02-4.jpg"></a>
						<a class="carousel-item" href="#five!"><img src="/theme/basic/sub06/img/sub_06_bfaft_02-5.jpg"></a>
					</div>
					
					<img src="/theme/basic/sub06/img/sub_06_bfaft_02-6.png" style="position: absolute; top: 25%; left: 35%; z-index: 0; width: 150px;">

					<img class="movePrevCarousel" src="/theme/basic/sub06/img/left_btn.png" style="position: absolute; top: 30%; left: -50px; width: 40px;">

					<img class="moveNextCarousel" src="/theme/basic/sub06/img/right_btn.png" style="position: absolute; top: 30%; right: -50px; width: 40px;">
			</div>
		</div>

		<div style="display: block; width: 100%; position: relative;">
			<div style="width: 100%; background-color: pink; background-image: url('/theme/basic/mobile/sub06/img/sub_06_bfaft_03_m.jpg'); background-size: 100% auto;">

				<div style="height: 725px; position: relative; margin: 0 auto; background-image: url('/theme/basic/sub06/img/sub_06_bfaft_02.png'); background-repeat: no-repeat; width: 80%; top: 250px;">

					<div class="carousel carousel-slider" style="height: 750px; width: 100%; margin: 0 auto; position: relative; top: 95px;">
						<a class="carousel-item" href="#one!"><img src="/theme/basic/sub06/img/sub_06_bfaft_03-1.jpg"></a>
						<a class="carousel-item" href="#two!"><img src="/theme/basic/sub06/img/sub_06_bfaft_03-2.jpg"></a>
						<a class="carousel-item" href="#three!"><img src="/theme/basic/sub06/img/sub_06_bfaft_03-3.jpg"></a>
					</div>
					
					<img src="/theme/basic/sub06/img/sub_06_bfaft_02-6.png" style="position: absolute; top: 30%; left: 35%; z-index: 0; width: 150px;">

					<img class="movePrevCarousel" src="/theme/basic/sub06/img/left_btn.png" style="position: absolute; top: 35%; left: -50px; width: 40px;">

					<img class="moveNextCarousel" src="/theme/basic/sub06/img/right_btn.png" style="position: absolute; top: 35%; right: -50px; width: 40px;">
				</div>
			</div>
		</div>
		
		<img src="/theme/basic/sub06/img/sub_06_bfaft_04.jpg" style="position: relative;">

		<div style="position: relative; height: 350px;">
			<div class="carousel carousel-slider" style="width: 80%; margin: 0 auto;">
				<a class="carousel-item" href="#one!"><img src="/theme/basic/sub06/img/sub_06_bfaft_04-1.jpg"></a>
				<a class="carousel-item" href="#two!"><img src="/theme/basic/sub06/img/sub_06_bfaft_04-2.jpg"></a>
				<a class="carousel-item" href="#three!"><img src="/theme/basic/sub06/img/sub_06_bfaft_04-3.jpg"></a>
			</div>

			<img class="movePrevCarousel" src="/theme/basic/sub06/img/left_btn.png" style="position: absolute; top: 50%; left: 1%; width: 50px;">

			<img class="moveNextCarousel" src="/theme/basic/sub06/img/right_btn.png" style="position: absolute; top: 50%; right: 1%; width: 50px;">			
		</div>

		<img src="/theme/basic/sub06/img/sub_06_bfaft_04-4.png" style="display: block; margin: 0 auto; width: 80%; margin-bottom: 50px;">

		<div style="position: relative; height: 350px;">
			<div class="carousel carousel-slider" style="width: 80%; height: 600px; margin: 0 auto;">
				<a class="carousel-item" href="#one!"><img src="/theme/basic/sub06/img/sub_06_bfaft_05-1.jpg"></a>
				<a class="carousel-item" href="#two!"><img src="/theme/basic/sub06/img/sub_06_bfaft_05-2.jpg"></a>
				<a class="carousel-item" href="#three!"><img src="/theme/basic/sub06/img/sub_06_bfaft_05-3.jpg"></a>
			</div>

			<img class="movePrevCarousel" src="/theme/basic/sub06/img/left_btn.png" style="position: absolute; top: 50%; left: 1%; width: 50px;">

			<img class="moveNextCarousel" src="/theme/basic/sub06/img/right_btn.png" style="position: absolute; top: 50%; right: 1%; width: 50px;">			
		</div>
		<img src="/theme/basic/sub06/img/sub_06_bfaft_05-4.png" style="display: block; margin: 0 auto; width: 80%; margin-bottom: 50px;">

		<div style="position: relative; height: 350px;">
			<div class="carousel carousel-slider" style="width: 80%; height: 600px; margin: 0 auto;">
				<a class="carousel-item" href="#one!"><img src="/theme/basic/sub06/img/sub_06_bfaft_06-1.jpg"></a>
				<a class="carousel-item" href="#two!"><img src="/theme/basic/sub06/img/sub_06_bfaft_06-2.jpg"></a>
				<a class="carousel-item" href="#three!"><img src="/theme/basic/sub06/img/sub_06_bfaft_06-3.jpg"></a>
			</div>

			<img class="movePrevCarousel" src="/theme/basic/sub06/img/left_btn.png" style="position: absolute; top: 50%; left: 1%; width: 50px;">

			<img class="moveNextCarousel" src="/theme/basic/sub06/img/right_btn.png" style="position: absolute; top: 50%; right: 1%; width: 50px;">			
		</div>
		<img src="/theme/basic/sub06/img/sub_06_bfaft_06-4.png" style="display: block; margin: 0 auto; width: 80%; margin-bottom: 50px;">
	
		
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
			$(this).attr('src','/theme/basic/sub06/img/left_btn_on.png');
			btn_check = 1;
		} else {
			$(this).attr('src','/theme/basic/sub06/img/left_btn.png');
			btn_check = 0;
		}

	});

	$('.moveNextCarousel').hover(function(){
		if(btn_check == 0){
			$(this).attr('src','/theme/basic/sub06/img/right_btn_on.png');
			btn_check = 1;
		} else {
			$(this).attr('src','/theme/basic/sub06/img/right_btn.png');
			btn_check = 0;
		}

	});

});
$(window).scroll(function(event){
	$('.sub_main').css('margin-top','120px');
	$('.beforeafter_header').css('margin-top','50px');
});


</script>
<?php
include_once(G5_THEME_PATH.'/tail.php');
?>