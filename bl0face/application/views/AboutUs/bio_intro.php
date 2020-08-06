<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
	// PC
} else {
	//MOBILE
	header("Location: /AboutUs/M_bio_intro");
}
?>
<style>

	.header_wrap  { display: block !important; position: fixed; top: 0;}
	.section{ width:100%; height:100vh; position:relative; color:#ffffff;}
	.section { background-position: center; background-size: cover; background-repeat: no-repeat; position: relative; min-width: 1200px;}
	.section .intro_wrap { position: relative; margin: 0; padding: 0; max-width: 600px;}
	.fs_nav {
		display: block !important;
		position: fixed;
		right: 60px;
		top: 50%;
		-ms-transform: translateY(-50%);
		-webkit-transform: translateY(-50%);
		transform: translateY(-50%);
		font-size: 1.4em;
		z-index: 10;
	}
	.fs_nav li {
		width: 25px;
		height: 5px;
		background-color: #AA0010;
		margin-bottom: 35px;
	}
	.nav_active{		
		transform: rotate(-50deg);
	}
</style>

<div class="section" style="background-image: url('/assets/img/sub/sub01/intro01.jpg?<?=rand()?>">
<!-- 	<div class="intro_wrap" style="top: 10%; left: 30%;">
		<h5 class="ko_light align_left f_black lh_30">
			volum<span class="en_bold main_f_color">-ing</span><br>
			slimm<span class="en_bold main_f_color">-ing</span><br>
			lift<span class="en_bold main_f_color">-ing</span><br><br>

			"비오페이스는 <span class="en_bold main_f_color">-ing</span>를 연구하는 병원입니다."<br><br><br><br>

			<span class="ko_bold fs_15 lh_50">수술하지 않는 아름다움의 미학,<br>비오페이스</span><br><br>
			
			<span class="fs_7 lh_20">
				비오페이스는 <span class="ko_bold main_f_color f_underline">"자연스럽고 아름다운 표정이 지어지는<br>삶의 질 향상"</span>의 진료 철학을 가지고 있습니다.<br>
				동적인 밸런스를 무시하는, 억지스런 시술은 권하지 않으며,<br>개개인의 디테일한 분석과 상담,<br>
				그리고 안전하며 꼼꼼한 시술을 자부합니다.<br>
				<span class="ko_bold main_f_color f_underline">인간애에 기반한 더 나은 시술의 연구</span>로 고객<br>
				모두 만족할 수 있도록 하고 싶습니다.
			</span>
		</h5>
	</div> -->
</div>
	
<div class="section" style="background-image: url('/assets/img/sub/sub01/intro02.jpg?<?=rand()?>');">
	<<!-- div class="intro_wrap" style=" top: 24%; left: 36%;">
		<h1 class="en_bold" style="color: #E45959;">Imporve the<br>quality of life<br></h1>
	</div>

	<div class="intro_wrap" style="top: 21%; left: 36%;">
		<h6 class="ko_light f_black">우리는 당신의 삶의 질을 향상시키는 기술을 가지고 있습니다.</h6>
	</div>
	
	<div class="intro_wrap align_left" style="top: 28%; left: 40%;">
		<hr style="display: block; margin: 0; width: 50%;    max-width: 180px;border: none; border-top: 5px solid #E45959; ">
	</div>

	<div class="intro_wrap" style="top: 30%; left: 40%;">
		<h6 class="f_black lh_30">
			<span class="ko_bold f_underline">비오페이스는<span class="main_f_color">-ing</span>(Volum<span class="en_bold main_f_color">ing</span>,slimm<span class="en_bold main_f_color">ing</span>, Lift<span class="en_bold main_f_color">ing</span>)의 연구</span>로<br>
			다양한 시술들을 보유하고 있는 병원입니다.<br>
			기존에 존재하는 다양한 시술들의 단점을 분석하여 보완하고<br>
			<span class="f_underline ko_bold">장점을 획기적으로 살린 시술들을 직접 꾸준히 연구,<br>개발</span>하고 있습니다. 또한 고객 개개인 정신과 외면에는<br>생기를 불어넣으며, <span class="f_underline ko_bold">조금 더 나은 삶의 질을 향상</span>시킬 수<br>
			있도록 돕는 시술들을 집도하고 있습니다.
		</h6>
	</div -->>
</div>
<div class="section" style="background-image: url('/assets/img/sub/sub01/intro03.jpg?<?=rand()?>');">
	<!-- <div class="intro_wrap" style="top: 16%; left: 40%;">
		<h1 class="en_bold" style="color: #0E1633;">Strive for<br>Research</h1>
	</div>

	<div class="intro_wrap" style="top: 13%; left: 40%;">
		<h6 class="ko_light f_black">우리는 그 기술을 위해 연구합니다.</h6>
	</div>

	<div class="intro_wrap align_left" style="top: 28%; left: 25%;">
		<hr style="display: block; margin: 0 auto; width: 50%;    max-width: 180px;border: none; border-top: 5px solid #0E1633; ">
	</div>
	<div class="intro_wrap align_left" style="top: 30%; left: 40%;">
		
    	<h6 class="ko_light f_black lh_30">
    		비오페이스는 인생의 <span class="ko_bold f_underline">전반적인 삶의 질<br>향상</span>을 위해 <span class="ko_bold f_underline">꾸준한 연구</span>를 실시합니다.<br><br>

    		- 가장 고순도의 히알루론산 필러의 배합 연구<br>
    		- 얼굴의 전반적인 밸런스를 위한 분석 테크닉의 연구<br>
    		- 탄력과 극대화된 슬리밍 효과를 볼 수 있는 시술의 연구

    	</h6>
	</div> -->
</div>
<div class="section" style="background-image: url('/assets/img/sub/sub01/intro04.jpg?<?=rand()?>');">
	<!-- <div class="intro_wrap" style="top: 15%; left: 50%; transform: translateX(-50%);">
		<h3 class="ko_bold align_center f_black fs_25">
			당신의 아름다움은 언제나<br>"<span class="en_bold main_f_color">-ing"</span>여야 하니까.

		</h3>
		
		<br><br>
		<h6 class="ko_bold align_center f_black" style="line-height: 25px;">
			
			<hr style="display: block; margin: 0 auto; width: 50%;
    max-width: 180px;border: none; border-top: 5px solid #149E80;">

    		<br>
    		티오필<br>
    		<span class="ko_light">
    			사람 피부에 가장 가까운 볼륨 시술
    		</span>
    		<br><br>
    		포니테일리프팅<br>
    		<span class="ko_light">
    			실패하지 않는 리프팅 시술
    		</span>
    		<br><br>
    		리프톡스<br>
    		<span class="ko_light">
    			리프팅 개념의 보톡스 시술의 완성
    		</span>
    		<br><br>
    		NMT 다이어트<br>
    		<span class="ko_light">
    			뇌가 건강해지는 다이어트
    		</span>
    		<br><br>
    		NMT 피스토주사<br>
    		<span class="ko_light">
    			프랑스 오리진 지방분해주사
    		</span>
		</h6>


	</div> -->
</div>


<ul class="fs_nav">
	<li class="nav_active"><a class="" href="#aboutSection01"><span class="hover-text"></span></a></li>
	<li><a class="" href="#aboutSection02"><span class="hover-text"></span></a></li>
	<li><a class="" href="#aboutSection03"><span class="hover-text"></span></a></li>
	<li><a class="" href="#aboutSection04"><span class="hover-text"></span></a></li>
</ul>


<script type="text/javascript">
window.onload = function () {
	$(".section").each(function () {
		// 개별적으로 Wheel 이벤트 적용
		$(this).on("mousewheel DOMMouseScroll", function (e) {
			if($(this).index() != 5){
				var idx = $(this).index();
				e.preventDefault();
				var delta = 0;
				if (!event) event = window.event;
				if (event.wheelDelta) {
					delta = event.wheelDelta / 120;
					if (window.opera) delta = -delta;
				} else if (event.detail) delta = -event.detail / 3;
				var moveTop = null;
				// 마우스휠을 위에서 아래로
				if (delta < 0) {
					if ($(this).next() != undefined) {
						moveTop = $(this).next().offset().top;

						$('.fs_nav li').removeClass('nav_active');
						$('.fs_nav li:eq('+(idx - 1)+')').addClass('nav_active');


					}
					// 마우스휠을 아래에서 위로
				} else {
					if ($(this).prev() != undefined) {
						moveTop = $(this).prev().offset().top;

						if(idx == 3 || idx==4){
							$('.fs_nav li').removeClass('nav_active');
							$('.fs_nav li:eq('+(idx - 3)+')').addClass('nav_active');
						}
					}
				}
				// 화면 이동 0.8초(800)
				$("html,body").stop().animate({
					scrollTop: moveTop + 'px'
				}, {
					duration: 800, complete: function () {
					}
				});
			} else {
				e.preventDefault();
				var delta = 0;
				if (!event) event = window.event;
				if (event.wheelDelta) {
					delta = event.wheelDelta / 120;
					if (window.opera) delta = -delta;
				} else if (event.detail) delta = -event.detail / 3;
				var moveTop = null;
				// 마우스휠을 위에서 아래로
				if (delta < 0) {
					moveTop = $('footer').offset().top;
					$('.fs_nav li').removeClass('nav_active');
					// 마우스휠을 아래에서 위로
				} else {
					moveTop = $(this).prev().offset().top;

					$('.fs_nav li').removeClass('nav_active');
					$('.fs_nav li:eq(2)').addClass('nav_active');
					
				}
				// 화면 이동 0.8초(800)
				$("html,body").stop().animate({
					scrollTop: moveTop + 'px'
				}, {
					duration: 800, complete: function () {
					}
				});
			}
		});
	});

	$('.page-footer').on("mousewheel DOMMouseScroll", function (e) {
		e.preventDefault();
		var delta = 0;
		if (!event) event = window.event;
		if (event.wheelDelta) {
			delta = event.wheelDelta / 120;
			if (window.opera) delta = -delta;
		} else if (event.detail) delta = -event.detail / 3;

		var moveTop = null;

		// 마우스휠을 위에서 아래로
		if (delta < 0) {
			return false;
		// 마우스휠을 아래에서 위로
		} else {
			moveTop = $('.section:eq(3)').offset().top;

			$('.fs_nav li').removeClass('nav_active');
			$('.fs_nav li:eq(3)').addClass('nav_active');
		}
		// 화면 이동 0.8초(800)
		$("html,body").stop().animate({
			scrollTop: moveTop + 'px'
		}, {
			duration: 800, complete: function () {
			}
		});
	});	
}

</script>
