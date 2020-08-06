<script src="/assets/js/swiper.min.js" charset="utf-8"></script>
<script type="text/javascript" src="/assets/js/jquery-ui.min.js"></script>
<script>
$(document).ready(function(){
	$('.tabs').tabs();
	$('.tabs_info li').eq(0).show();

	var swiper = new Swiper('.swiper-container', {
		autoplay: {
			delay: 3000,
		},
			loop: true,
			speed: 500,
	});

	var slideArea = $('.main_link');
	var dragSize = 150;
	var mDown = false;
	var dragX = 0;
	var htTouchInfo = { //touchstart 시점의 좌표와 시간을 저장하기  
		nStartX : -1,
		nStartY : -1,
		nStartTime : 0
	};

	htTouchInfo.nStartX = -1;
    htTouchInfo.nStartY = -1;
    htTouchInfo.nStartTime = 0;

	//마우스 좌클릭 확인
	slideArea.bind('touchmove',function(event){
		mDown = true;
		var current_X = event.originalEvent.changedTouches[0].screenX;

		dragX = event.originalEvent.targetTouches[0].pageX;
		slideArea.addClass("grab");

		var wth = $(window).width()/2;

		var nX = Math.abs(current_X + dragX);
		var nDis = nX;

		var nDis2 = Math.abs(wth - current_X);

		

		// console.log(nDis2);

		if(mDown == true && nDis>=500){ 
			swiper.slideNext();
			swiper.autoplay.start();
			event.preventDefault();
		}
		if(mDown == true && nDis < 500){
			swiper.slidePrev();
			swiper.autoplay.start();
			event.preventDefault();
		}


	}).bind('touchend',function(){
		mDown = false;
		slideArea.removeClass("grab");
	});

	//마우스 드래그 확인
	slideArea.mousemove(function(event){
		//마우스가 좌클릭 상태로 마우스를 'dragSize' 이상 이동시
		
	});

	// swiper.on('slideChange',function(){
	// 	var swiper_idx = swiper.activeIndex;

	// 	if(swiper_idx == 6){
	// 		$('.event').show();
	// 		$('.event2').hide();
	// 	} else if (swiper_idx == 7 || swiper_idx == 0) {
	// 		$('.event2').show();
	// 		$('.event').hide();
	// 	} else {
	// 		$('.event').hide();
	// 		$('.event2').hide();
	// 	}
	// })
});

function shurink(){
	location.href = '/Lifting/M_shurink';
}
function rijuran(){
	location.href = '/Lifting/M_rijuran';
}

var swiper2 = new Swiper('.swiper-container2', {
	slidesPerView: 2,
	spaceBetween: 10,
	autoplay: {
		delay: 2000,
	},
	pagination: {
		el: '.swiper-pagination2',
		clickable: true
	},
});
var swiper3 = new Swiper('.swiper-container3', {
	navigation: {
		nextEl: '.swiper-button-next3',
		prevEl: '.swiper-button-prev3',
		clickable: true,
	},
	autoplay: {
		delay: 3000,
	},
	loop: true
});
var swiper4 = new Swiper('.swiper-container4', {
	navigation: {
		nextEl: '.swiper-button-next4',
		prevEl: '.swiper-button-prev4',
		clickable: true,
	},
	autoplay: {
		delay: 3000,
	},
	loop: true
});

$('.next_btn').on('click', function() {
	$('.swiper-button-next3').trigger('click');
});
$('.before_btn').on('click', function() {
	$('.swiper-button-prev3').trigger('click');
});
$('.next_btn2').on('click', function() {
	$('.swiper-button-next4').trigger('click');
});
$('.before_btn2').on('click', function() {
	$('.swiper-button-prev4').trigger('click');
});


// Photogallery tab
$('.tabs .tab').on('click',function(){
	var idx = $(this).index();

	// console.log(idx);

	$('.tabs_info li').hide();
	$('.tabs_info li').eq(idx).show();
})

// 로그인 check
function confirm_login(){
	var log_check = confirm("로그인 하시겠습니까?");

	if (log_check == true) {
		return true;
	} else {
		event.preventDefault();
	}
}
function confirm_logout(){
	var log_check = confirm("로그아웃 하시겠습니까?");

	if (log_check == true) {
		return true;
	} else {
		event.preventDefault();
	}
}
// 모바일 메뉴 On Off
$('.m_header li:eq(0)').on('click',function(){
	var current_status = $(this).text();
	var sess = '<?=$this->session->userdata('id')?>';

	if(current_status == 'menu'){
		$(this).find('i').text('close');
		$('.change_icon').attr('src','/assets/img/login.png');
		if(sess == ''){
			$('.change_icon').parents('a').attr({
				'href':'/auth/login',
				'onclick':'confirm_login()'
			});
		} else {
			$('.change_icon').parents('a').attr({
				'href':'/auth/modify'
			});
		}

		$('.m_header_info').show();
	} else {

		$(this).find('i').text('menu');
		$('.change_icon').attr('src','/assets/img/phone_m.png');
		$('.change_icon').parents('a').attr('href','tel:1833-8838');
		$('.m_header_info').hide();
	}
})
// 모바일 메뉴 탭 변경
$('.m_header_tab_title ul li').on('click',function(){
	var m_header_tab_idx = $(this).index();

	$('.m_header_tab ul').hide();
	$('.m_header_tab ul:eq('+m_header_tab_idx+')').show();
});

// 소개부분
$('.intro i').on('click',function(){
	var intro_icon = $(this).text();

	// intro02_m_on.jpg
	var intro_idx = $(this).parent('.col.m12.s12').index() + 1;

	var onsrc = "url('/assets/img/intro0" + intro_idx +"_m_on.jpg')";
	var offsrc = "url('/assets/img/intro0" + intro_idx +"_m.jpg')";
	

	if(intro_icon == 'expand_more'){
		$('.intro_wrap i').text('expand_more');
		$('.intro_wrap i').css({
			'color':'#fff',
			'top': '35%',
			'right': '5%'

		});

		$('.intro_wrap .intro .col.m12.s12').find('h6:eq(0)').show();
		$('.intro_wrap .intro .col.m12.s12').find('h6:eq(1)').hide();
		$('.intro_wrap .intro .col.m12.s12').css('height','35vh');

		$('.intro_wrap .intro .col.m12.s12:eq(0)').css('background-image', 'url(/assets/img/intro01_m.jpg)');
		$('.intro_wrap .intro .col.m12.s12:eq(1)').css('background-image', 'url(/assets/img/intro02_m.jpg)');
		$('.intro_wrap .intro .col.m12.s12:eq(2)').css('background-image', 'url(/assets/img/intro03_m.jpg)');

		$(this).text('expand_less');
		$(this).css({
			'color':'#AA0010',
			'top': '0',
			'right': '0'

		});
		$(this).parent('.col.m12.s12').css('background-image',onsrc);

		$(this).siblings('h6:eq(0)').hide();
		$(this).siblings('h6:eq(1)').show();

		$(this).parent('.col.s12').animate({
			'height': '70vh',
		}, 500, "easeOutCubic");	
	}

	if(intro_icon == 'expand_less'){
		$(this).text('expand_more');
		$(this).css({
			'color':'#fff',
			'top': '35%',
			'right': '5%'

		});
		$(this).parent('.col.m12.s12').css('background-image',offsrc);

		$(this).siblings('h6:eq(1)').hide();
		$(this).siblings('h6:eq(0)').show();

		$(this).parent('.col.s12').animate({
			height: '30vh',
		}, 500, "easeOutCubic");	
	}
	
});
function go_brain(){
	location.href = '/Obesity_clinic/M_NMTbrain';
}
function go_diet(){
	location.href = '/Obesity_clinic/M_NMTdiet';
}
function go_pisto(){
	location.href = '/Obesity_clinic/M_NMTpisto';
}
function go_pic(){
	location.href = '/Obesity_clinic/M_beforeAfter_pic';	
}
</script>
