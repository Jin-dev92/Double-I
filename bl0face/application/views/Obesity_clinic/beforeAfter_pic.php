<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
	// PC
} else {
	//MOBILE
	header("Location: /Obesity_clinic/M_beforeAfter_pic");
}
?>
<style>
	.header_wrap  { display: block !important; position: fixed; top: 0;}
	.sub_img img{ width: 100%; position: relative; margin-bottom: -10px;}

	.sub03_img img {
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
		background-color: #AA0010 !important;
		color: #fff !important;
		text-decoration: none;
	}
	.tabs .indicator{
		display: none;
	}

	.one_btn {
		display: block;
		margin: 0 auto;
		width: 25% !important;
		max-width: 372px !important;
		position: relative !important;
		top: -100px;
		cursor: pointer;
	}
	.two_btn {
		width: 46% !important;
		margin: 0 20px;
		cursor: pointer;
	}
	.two_btn_wrap {
		display: block;
		margin: 0 auto;
		position: relative;
		top: -100px;
		width: 100%;
		text-align: center;
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
<div class="sub_img">
		<!-- 탭 -->
	<div class="row" style="margin-top: 70px; max-width: 1200px;">
		<div class="col s12">
			<ul class="tabs">
				<li class="tab col s3" onclick="go_diet();"><a class="fat" href="/Obesity_clinic/NMTdiet">NMT 비만클리닉</a></li>
				<li class="tab col s3" onclick="go_brain();"><a class="brain" href="/Obesity_clinic/NMTbrain">NMT 뇌피트니스</a></li>
				<li class="tab col s3" onclick="go_pisto();"><a class="pisto" href="/Obesity_clinic/NMTpisto">NMT 피스토주사</a></li>
				<li class="tab col s3" onclick="go_pic();"><a class="active pisto" href="/Obesity_clinic/beforeAfter_pic">전후사진</a></li>
			</ul>
		</div>
	</div>

	<div class="col s12 sub02_img" style="height: auto;">
		<div style="position: relative;">
			<img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_01.jpg" style="position: relative;">
			<div class="video_wrap">
				<iframe src="http://www.youtube.com/embed/YATvgx-0k24?rel=0&autoplay=true" class="video" frameborder="0" style="max-width:100%; width:100%; height: 100%;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
			</div>
		</div>

		<div style="width: 100%; height: 690px;">
			<div style="height: 830px; position: relative; margin: 0 auto; background-image: url('../../assets/img/sub/Obesity_clinic/sub_06_bfaft_02.png'); background-repeat: no-repeat; width: 1200px; top: -140px;">
					
					<div class="carousel carousel-slider" style="height: 735px; width: 1000px; margin: 0 auto; position: relative; top: 95px;">
						<a class="carousel-item" href="#one!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_02-1.jpg"></a>
						<a class="carousel-item" href="#two!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_02-2.jpg"></a>
						<a class="carousel-item" href="#three!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_02-3.jpg"></a>
						<a class="carousel-item" href="#four!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_02-4.jpg"></a>
						<a class="carousel-item" href="#five!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_02-5.jpg"></a>
					</div>
					
					<img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_02-6.png" style="position: absolute; top: 45%; left: 41%; z-index: 9; width: 200px;">

					<img class="movePrevCarousel" src="../../assets/img/sub/Obesity_clinic/left_btn.png" style="position: absolute; top: 50%; left: 0; width: 50px;">

					<img class="moveNextCarousel" src="../../assets/img/sub/Obesity_clinic/right_btn.png" style="position: absolute; top: 50%; right: 0; width: 50px;">
			</div>
		</div>

		<div style="display: block; width: 100%; position: relative;">
			<div style="width: 100%; background-color: pink; background-image: url('../../assets/img/sub/Obesity_clinic/sub_06_bfaft_03.jpg'); background-size: 100% auto;">

				<div style="height: 1280px; position: relative; margin: 0 auto; background-image: url('../../assets/img/sub/Obesity_clinic/sub_06_bfaft_02.png'); background-repeat: no-repeat; width: 1200px; top: 470px;">

					<div class="carousel carousel-slider" style="height: 750px; width: 1000px; margin: 0 auto; position: relative; top: 95px;">
						<a class="carousel-item" href="#one!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_03-1.jpg"></a>
						<a class="carousel-item" href="#two!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_03-2.jpg"></a>
						<a class="carousel-item" href="#three!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_03-3.jpg"></a>
					</div>
					
					<img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_03-4.png" style="position: absolute; top: 25%; left: 41%; z-index: 9; width: 200px;">

					<img class="movePrevCarousel" src="../../assets/img/sub/Obesity_clinic/left_btn.png" style="position: absolute; top: 40%; left: 0; width: 50px;">

					<img class="moveNextCarousel" src="../../assets/img/sub/Obesity_clinic/right_btn.png" style="position: absolute; top: 40%; right: 0; width: 50px;">
				</div>
			</div>
		</div>
		
		<img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_04.jpg" style="position: relative;">

		<div style="position: relative; height: 500px; min-width: 1200px;">
			<div class="carousel carousel-slider" style="width: 1000px; height: 600px; margin: 0 auto;">
				<a class="carousel-item" href="#one!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_04-1.jpg"></a>
				<a class="carousel-item" href="#two!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_04-2.jpg"></a>
				<a class="carousel-item" href="#three!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_04-3.jpg"></a>
			</div>

			<img class="movePrevCarousel" src="../../assets/img/sub/Obesity_clinic/left_btn.png" style="position: absolute; top: 50%; left: 10%; width: 50px;">

			<img class="moveNextCarousel" src="../../assets/img/sub/Obesity_clinic/right_btn.png" style="position: absolute; top: 50%; right: 10%; width: 50px;">			
		</div>
		<img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_04-4.png" style="display: block; margin: 0 auto; width: 1000px; margin-bottom: 100px;">

		<div style="position: relative; height: 500px; min-width: 1200px;">
			<div class="carousel carousel-slider" style="width: 1000px; height: 600px; margin: 0 auto;">
				<a class="carousel-item" href="#one!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_05-1.jpg"></a>
				<a class="carousel-item" href="#two!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_05-2.jpg"></a>
				<a class="carousel-item" href="#three!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_05-3.jpg"></a>
			</div>

			<img class="movePrevCarousel" src="../../assets/img/sub/Obesity_clinic/left_btn.png" style="position: absolute; top: 50%; left: 10%; width: 50px;">

			<img class="moveNextCarousel" src="../../assets/img/sub/Obesity_clinic/right_btn.png" style="position: absolute; top: 50%; right: 10%; width: 50px;">			
		</div>
		<img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_05-4.png" style="display: block; margin: 0 auto; width: 1000px; margin-bottom: 100px;">

		<div style="position: relative; height: 500px; min-width: 1200px;">
			<div class="carousel carousel-slider" style="width: 1000px; height: 600px; margin: 0 auto;">
				<a class="carousel-item" href="#one!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_06-1.jpg"></a>
				<a class="carousel-item" href="#two!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_06-2.jpg"></a>
				<a class="carousel-item" href="#three!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_06-3.jpg"></a>
			</div>

			<img class="movePrevCarousel" src="../../assets/img/sub/Obesity_clinic/left_btn.png" style="position: absolute; top: 50%; left: 10%; width: 50px;">

			<img class="moveNextCarousel" src="../../assets/img/sub/Obesity_clinic/right_btn.png" style="position: absolute; top: 50%; right: 10%; width: 50px;">			
		</div>
		<img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_06-4.png" style="display: block; margin: 0 auto; width: 1000px; margin-bottom: 100px;">
	
		
	</div>
</div>

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
			$('.movePrevCarousel').attr('src','../../assets/img/sub/Obesity_clinic/left_btn_on.png');
			btn_check = 1;
		} else {
			$('.movePrevCarousel').attr('src','../../assets/img/sub/Obesity_clinic/left_btn.png');
			btn_check = 0;
		}

	});

	$('.moveNextCarousel').hover(function(){
		if(btn_check == 0){
			$('.moveNextCarousel').attr('src','../../assets/img/sub/Obesity_clinic/right_btn_on.png');
			btn_check = 1;
		} else {
			$('.moveNextCarousel').attr('src','../../assets/img/sub/Obesity_clinic/right_btn.png');
			btn_check = 0;
		}

	});

});

</script>