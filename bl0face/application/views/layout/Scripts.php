<?php
/**
 * Created by 백성현.
 * User: bioface
 * Date: 2018-03-06
 * Time: 오후 7:17
 */
?>

<script>
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

// 메뉴 눌렀을 때 CSS
$('.header ul li').mouseover(function(){
	$('.header_content').show();
	var content_idx = $(this).index() - 2;

	$('.header ul li').removeClass('main_f_color');
	$(this).addClass('main_f_color');

	$('.header_content').find('.row').hide();
	$('.header_content').find('.row:eq('+content_idx+')').show(); 
}).mouseout(function(){
	$('.header_content').hide();
});;

// 메뉴 내용 변화
$('.header_content').mouseover(function(){
	$('.header_content').show();
}).mouseout(function(){
	$('.header_content').hide();
});


$(document).ready(function(){
	$('.tabs').tabs();
});

$(function(){
	
});


	

jQuery(document).ready(function(){
	var swiper = new Swiper('.swiper-container', {
		autoplay: {
			delay: 3000,
		},
			loop: true,
			speed: 500,
	});

	var slideArea = $('.main_link');
	var dragSize = 100;
	var mDown = false;

	//마우스 드래그 확인
	slideArea.mousemove(function(event){
		//마우스가 좌클릭 상태로 마우스를 'dragSize' 이상 이동시
		if(mDown == true && dragX + dragSize < event.pageX){ 
			swiper.slidePrev();
			swiper.autoplay.start();
		}
		if(mDown == true && dragX - dragSize > event.pageX){
			swiper.slideNext();
			swiper.autoplay.start();
		}

	});

	//마우스 좌클릭 확인
	slideArea.mousedown(function(event){
		mDown = true;
		dragX = event.pageX;
		slideArea.addClass("grab");
	});
		slideArea.mouseup(function(){
		mDown = false;
		slideArea.removeClass("grab");
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

$('.next_btn').on('click', function() {
	$('.swiper-button-next3').trigger('click');
});
$('.before_btn').on('click', function() {
	$('.swiper-button-prev3').trigger('click');
});

$('.tabs .tab').on('click',function(){
	var idx = $(this).index();

	$('.tabs_info li').removeClass('f_black');
	$('.tabs_info li').eq(idx).addClass('f_black');
})
$('.tabs .tab').mouseenter(function() {
	var tab_idx = $(this).index();
	$('.tabs_info li').eq(tab_idx).css('color','#000');
})
.mouseleave(function() {
	var tab_idx = $(this).index();
	$('.tabs_info li').eq(tab_idx).css('color','#F1F1F1');
});

window.onscroll = function() {myFunction()};
function myFunction() {
	var header = document.getElementById("main_swiper_bottom");
	var sticky = header.offsetTop;


	var stick_header = document.getElementById("myHeader");

	if (window.pageYOffset >= sticky) {
		stick_header.classList.add("sticky");
	} else {
		stick_header.classList.remove("sticky");
	}
	
}

$('.header, .certifi_wrap').mouseover(function(){
	$('.intro .col.m4:eq(0) h5:eq(0), .intro .col.m4:eq(1) h5:eq(0), .intro .col.m4:eq(2) h5:eq(0)').show();
	$('.intro .col.m4:eq(0) h4:eq(0), .intro .col.m4:eq(1) h4:eq(0), .intro .col.m4:eq(2) h5:eq(1)').hide();
})

</script>

<script>
// 메인 사진
var duration = 0.3;
var es_step = "Expo.ease";
var w1 = null,
  w2 = null,
  w3 = null,
  h1 = null,
  h2 = null,
  h3 = null;
function detailListSection(w1,w2,w3,h1,h2,h3) {
	$(".intro .col").on("mouseenter",function(){
		TweenMax.to($(".intro .col"),duration,{width:w3,height:h3,ease:es_step})
		TweenMax.to($(this),duration,{width:w2,height:h2,ease:es_step})
		$(".intro .col").removeClass("open");
		$(this).addClass("open");

		var intro_idx = $(this).index();

		if(intro_idx == 0){
			$('.intro .col.m4:eq(1) h5:eq(0), .intro .col.m4:eq(2) h5:eq(0)').show();
			$('.intro .col.m4:eq(1) h4:eq(0), .intro .col.m4:eq(2) h5:eq(1)').hide();

			$(this).find('h5:eq(0)').hide();
			$(this).find('h5:eq(1)').show();

		} else if(intro_idx == 1){
			$('.intro .col.m4:eq(0) h5:eq(0), .intro .col.m4:eq(2) h5:eq(0)').show();
			$('.intro .col.m4:eq(0) h5:eq(1), .intro .col.m4:eq(2) h5:eq(1)').hide();


			$(this).find('h5:eq(0)').hide();
			$(this).find('h4:eq(0)').show();
		} else {
			$('.intro .col.m4:eq(0) h5:eq(0), .intro .col.m4:eq(1) h5:eq(0)').show();
			$('.intro .col.m4:eq(0) h5:eq(1), .intro .col.m4:eq(1) h4:eq(0)').hide();

			$(this).find('h5:eq(0)').hide();
			$(this).find('h5:eq(1)').show();
		}
	})
	$(".intro .col").on("mouseleave",function(){
		TweenMax.to($(".intro .col"),duration,{width:w1,height:h1,ease:es_step})
		$(".intro .col").removeClass("open");
	});
}

if($(window).width()>992) {
	var wh2 = '90vh'
	$('#detailListSection').css({height: wh2});

	detailListSection('33.333%','50%','25%','90vh','90vh','90vh')

} else {

	var wh2 = '90vh'
	$('#detailListSection').css({height: wh2});

	detailListSection('90vh','90vh','90vh','33.333%','42.8%','25%')

}

function go_brain(){
	location.href = '/Obesity_clinic/NMTbrain';
}
function go_diet(){
	location.href = '/Obesity_clinic/NMTdiet';
}
function go_pisto(){
	location.href = '/Obesity_clinic/NMTpisto';
}
function go_pic(){
	location.href = '/Obesity_clinic/beforeAfter_pic';	
}
</script>

