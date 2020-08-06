<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
	// PC
	header("Location: /Obesity_clinic/beforeAfter_pic");
} else {
	//MOBILE
}
?>
<style>
	* {max-width: 640px; margin: 0 auto;}
	.m_header { display: block !important;}
	.sub_img { max-width: 640px; display: block; margin: 0 auto;}
	.sub_img img{ width: 100%; position: relative; margin-bottom: -10px;}
	.sub_img .tab.col { padding: 0;}
	.sub03_tabs .tab a {
	    padding: 0 12px;
	}
	.sub03_tabs .tab a {
	    display: block;
	    font-size: 15px;
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

	.sub03_tabs, .sub03_tabs li {
		outline: 1px solid #999;
		list-style: none;
		padding: 0;
		line-height: 60px;
	}
	.row .col.s4 {
		padding: 0;
		text-align: center;
	}
	.sub03_tabs li a{
		color: #AA0010 !important;
	}
	.sub03_tabs .tab a.active {
		background-color: #AA0010 !important;
		color: #fff !important;
		text-decoration: none;
	}
	.sub03_tabs .s6{
		width: 50%;
		float: left;
		text-align: center;
	}
	.one_btn, .two_btn {
		display: block;
		margin: 0 auto;
		width: 80% !important;
		max-width: 550px !important;
		position: relative !important;
		top: -45px;
		cursor: pointer;
		
	}
	.two_btn {
		width: 100%;
		margin: 0 auto 10px auto;
	}
	.video_wrap {
		position: absolute;
		width: 50%;
		height: 40%;
		top: 39%;
		left: 38%;
		background-color: #245F5B;
	}
	.bottom_pic {display: block !important; margin: 0 auto !important; width: 80% !important; position: absolute !important; bottom: 16% !important; left: 10% !important;}
	@media only screen and (max-width: 400px){
		.bottom_pic { bottom: 25% !important;}
	}
</style>
<div class="sub_img">
	<div class="row" style="width: 100%; max-width: 640px; margin-top: 49px; margin-bottom: 0;">
		<div class="col s12" style="padding: 0;">
			<ul class="sub03_tabs">
				<li class="tab col s6"><a class="fat lh_20" href="/Obesity_clinic/M_NMTdiet" style="padding: 10px 0;">NMT 비만클리닉</a></li>
				<li class="tab col s6"><a class="brain lh_20" href="/Obesity_clinic/M_NMTbrain" style="padding: 10px 0;">NMT 뇌피트니스</a></li>
				<li class="tab col s6"><a class="pisto lh_20" href="/Obesity_clinic/M_NMTpisto" style="padding: 10px 0;">NMT 피스토주사</a></li>
				<li class="tab col s6"><a class="active pic lh_20" href="/Obesity_clinic/M_beforeAfter_pic" style="padding: 10px 0;">전후사진</a></li>
			</ul>
		</div>
	</div>


	<div class="col s12 sub02_img" style="height: auto;">
		<div style="position: relative;">
			<img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_01_m.jpg?<?=rand()?>" style="position: relative;">
			<div class="video_wrap">
				<iframe src="http://www.youtube.com/embed/YATvgx-0k24" class="video" frameborder="0" style="max-width:100%; width:100%; height: 100%;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
			</div>
		</div>

		<div style="width: 100%; height: 220px;">
			<div style="height: 675px; position: relative; margin: 0 auto;  width: 80%; top: -50px; background-size: 100% auto;">
					
					<div class="carousel carousel-slider" style="height: 400px; width: 100%; margin: 0 auto; position: relative; top: 20px;">
						<a class="carousel-item" href="#one!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_02-1.jpg?<?=rand()?>"></a>
						<a class="carousel-item" href="#two!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_02-2.jpg?<?=rand()?>"></a>
						<a class="carousel-item" href="#three!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_02-3.jpg?<?=rand()?>"></a>
						<a class="carousel-item" href="#four!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_02-4.jpg?<?=rand()?>"></a>
						<a class="carousel-item" href="#five!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_02-5.jpg?<?=rand()?>"></a>
					</div>
					
					<img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_02-6.png" style="position: absolute; top: 10%; left: 35%; z-index: 0; width: 100px;">

					<img class="movePrevCarousel" src="../../assets/img/sub/Obesity_clinic/left_btn.png" style="position: absolute; top: 13%; left: -10px; width: 40px;">

					<img class="moveNextCarousel" src="../../assets/img/sub/Obesity_clinic/right_btn.png" style="position: absolute; top: 13%; right: -10px; width: 40px;">
			</div>
		</div>

		<div style="display: block; width: 100%; position: relative;">
			<div style="width: 100%; background-color: #D8EBF2; background-image: url('../../assets/img/sub/Obesity_clinic/sub_06_bfaft_03_m.jpg?<?=rand()?>'); background-size: 100% auto; height: 400px; background-repeat: no-repeat;">

				<div style="height: 590px; position: relative; margin: 0 auto; background-repeat: no-repeat; width: 80%; top: 15%;">

					<div class="carousel carousel-slider" style="height: 750px; width: 100%; margin: 0 auto; position: relative; top: 95px;">
						<a class="carousel-item" href="#one!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_03-1.jpg?<?=rand()?>"></a>
						<a class="carousel-item" href="#two!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_03-2.jpg?<?=rand()?>"></a>
						<a class="carousel-item" href="#three!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_03-3.jpg?<?=rand()?>"></a>
					</div>
					
					<img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_02-6.png" style="position: absolute; top: 25%; left: 35%; z-index: 0; width: 100px;">

					<img class="movePrevCarousel" src="../../assets/img/sub/Obesity_clinic/left_btn.png" style="position: absolute; top: 30%; left: -10px; width: 40px;">

					<img class="moveNextCarousel" src="../../assets/img/sub/Obesity_clinic/right_btn.png" style="position: absolute; top: 30%; right: -10px; width: 40px;">
				</div>
			</div>
		</div>
		
		<img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_04.jpg?<?=rand()?>" style="position: relative;">

		<div style="position: relative; height: 350px;">
			<div class="carousel carousel-slider" style="width: 80%; margin: 0 auto;">
				<a class="carousel-item" href="#one!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_04-1.jpg?<?=rand()?>"></a>
				<a class="carousel-item" href="#two!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_04-2.jpg?<?=rand()?>"></a>
				<a class="carousel-item" href="#three!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_04-3.jpg?<?=rand()?>"></a>
			</div>
			<img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_04-4.png" class="bottom_pic">

			<img class="movePrevCarousel" src="../../assets/img/sub/Obesity_clinic/left_btn.png" style="position: absolute; top: 25%; left: 1%; width: 30px;">

			<img class="moveNextCarousel" src="../../assets/img/sub/Obesity_clinic/right_btn.png" style="position: absolute; top: 25%; right: 1%; width: 30px;">
			
		</div>

		
<!--  -->
		<div style="position: relative; height: 350px;">
			<div class="carousel carousel-slider" style="width: 80%; height: 600px; margin: 0 auto;">
				<a class="carousel-item" href="#one!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_05-1.jpg?<?=rand()?>"></a>
				<a class="carousel-item" href="#two!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_05-2.jpg?<?=rand()?>"></a>
				<a class="carousel-item" href="#three!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_05-3.jpg?<?=rand()?>"></a>
			</div>
			<img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_05-4.png" class="bottom_pic">

			<img class="movePrevCarousel" src="../../assets/img/sub/Obesity_clinic/left_btn.png" style="position: absolute; top: 25%; left: 1%; width: 30px;">

			<img class="moveNextCarousel" src="../../assets/img/sub/Obesity_clinic/right_btn.png" style="position: absolute; top: 25%; right: 1%; width: 30px;">
		</div>
		

		<div style="position: relative; height: 350px;">
			<div class="carousel carousel-slider" style="width: 80%; height: 600px; margin: 0 auto;">
				<a class="carousel-item" href="#one!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_06-1.jpg?<?=rand()?>"></a>
				<a class="carousel-item" href="#two!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_06-2.jpg?<?=rand()?>"></a>
				<a class="carousel-item" href="#three!"><img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_06-3.jpg?<?=rand()?>"></a>
			</div>
			<img src="../../assets/img/sub/Obesity_clinic/sub_06_bfaft_06-4.png" class="bottom_pic">

			<img class="movePrevCarousel" src="../../assets/img/sub/Obesity_clinic/left_btn.png" style="position: absolute; top: 25%; left: 1%; width: 30px;">

			<img class="moveNextCarousel" src="../../assets/img/sub/Obesity_clinic/right_btn.png" style="position: absolute; top: 25%; right: 1%; width: 30px;">	
		</div>
		
	
		
	</div>
</div>

<script>
$(document).ready(function(){
	$('.m_header_info li:eq(2)').trigger('click');
	$('.m_header_tab ul:eq(2) li:eq(1)').addClass('active');

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
			$(this).attr('src','../../assets/img/sub/Obesity_clinic/left_btn_on.png');
			btn_check = 1;
		} else {
			$(this).attr('src','../../assets/img/sub/Obesity_clinic/left_btn.png');
			btn_check = 0;
		}

	});

	$('.moveNextCarousel').hover(function(){
		if(btn_check == 0){
			$(this).attr('src','../../assets/img/sub/Obesity_clinic/right_btn_on.png');
			btn_check = 1;
		} else {
			$(this).attr('src','../../assets/img/sub/Obesity_clinic/right_btn.png');
			btn_check = 0;
		}

	});
});
</script>