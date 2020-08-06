/*슬라이딩 애니메이션*/
$(function () {
		
		var filterList = {
		
			init: function () {
				// MixItUp plugin
				// http://mixitup.io
				$('#work').mixitup({
					targetSelector: 'li',
					filterSelector: '.filter',
					effects: ['fade'],
					easing: 'snap',
					// call the hover effect
					onMixEnd: filterList.hoverEffect()
				});				
			},	
						
			
				// Simple parallax effect
		hoverEffect: function () {
			
				
				}		
			
			};
					
		// Run the show!
		filterList.init();
		
		
	});	


$(document).ready(function() {
 $('.listBtn').click(function() {	
	    anioption = { time:0.8, easing:'easeOutCubic' };		
        $('.overlay').animate({"right": "0%"}, anioption); 
	 $('.blocker').animate({"opacity": "0.5"}, anioption).show(); 
	 $('#boxWrapp').addClass("split"); 
	 
	    });

$('.overlay-close, .blocker').click(function(){
	  anioption = { time:0.6, easing:'linear' }; 
      $('.overlay').animate({"right": "-100%"}, anioption); 
	$('.blocker').animate({"opacity": "0"}, anioption).hide();
  $('.project_area').animate({"right": "-100%"}, anioption); 
   	 $('#boxWrapp').removeClass("split"); 
	 $('.project_area').hide();
    });


 $('.request').click(function() {	
  $('.project_area').removeClass("fix").show();
	    anioption = { time:0.8, easing:'easeOutCubic' };			
        $('.overlay').animate({"right": "0%"}, anioption); 
	 $('.blocker').animate({"opacity": "0.5"}, anioption).show(); 
	 $('#boxWrapp').addClass("split"); 
		        $('.project_area').animate({"right": "0"}, anioption); 
	    });

$('.close').click(function(){	 
	  anioption = { time:0.6, easing:'linear' }; 
      $('.project_area').animate({"right": "-100%"}, anioption);
	   $('.project_area').addClass("fix").hide(0.8); 
 
    });
	
	

/*포트폴리오 슬라이딩*/

$(function(){
  $("#main_work > li").hover(
  function(){	
    anioption = { time:0.5, easing:'easeOutCubic' };  
   $(this).find('.hover').animate({"top": "0px"}, anioption);
  }, function(){
   $(this).find('.hover').animate({"top": "250px"},anioption);
  });

/*
  $("#work > li").hover( function(){	
  anioption = { time:0.5, easing:'easeOutCubic' };  
   $(this).find('.subText').animate({"bottom": "0px"}, anioption);
  }, function(){
   $(this).find('.subText').animate({"bottom": "-94px"}, anioption);
  });
*/




});

 });

window.onload = function()
{ // div height 설정
 setDivHeight('work');
}
function setDivHeight(objSet, objTar)
{ 
  var objSet   = document.getElementById(objSet); 
  var objTarHeight= document.getElementById(objTar).offsetHeight;
  objSet.style.height  = objTarHeight + "px";
} 
/*페럴렉스 스크롤*/

$(document).ready(function() {
var s = skrollr.init();

			var $head = $( '#header' );
			$( '.content' ).each( function(i) {
				var $el = $( this ),
					animClassDown = $el.data( 'animateDown' ),
					animClassUp = $el.data( 'animateUp' );
				$el.waypoint( function( direction ) {

					if( direction === 'down' && animClassDown ) {
					$head.attr('class', ' ' + animClassDown);
					}
					else if( direction === 'up' && animClassUp ){
						$head.attr('class', '' + animClassUp);
					}
				}, { offset: '0%' } );
			} );



});


/*비주얼 영역 브라우저에 따른 리사이징*/

   $(document).ready(function(){ 
   $('.slider, .sectionMain').css('height', $(window).height() - 0 );
   //$('.listBox').css({marginTop:"-"+$(".listBox").height()/2+"px"});
   $(window).resize(function() {
        $('.slider, .sectionMain').css('height', $(window).height() - 0 );
	//	 $('.listBox').css({marginTop:"-"+$(".listBox").height()/2+"px"});		
  
   });
					

   

  /*슬라이딩*/ 

  	var quick = $('.downBtn a, .request, .TopScroll a, .bottom_arrow a'),
		easi = 'easeInOutExpo',
		speed = 1000;
	quick.on('click', function(){
		var $this = $(this),
			href = $this.attr('href'),
			body = $('html, body'),
			scrollPosition = $(href).position().top;
	if(href == null){return false;}
		body.stop().animate({
			scrollTop : scrollPosition
		}, {
			duration:speed, easing: easi
		});
		return false;
	});  
}); 



/*오브젝트 자동 돌아가는 애니메이션*/



$(document).ready(function(){
				$('#skroll-body p').everyTime(1000, function(){
				$(this).animate({'top':25},1000).animate({'top':0},1000);
			});
		

if(navigator.platform == 'iPad' || navigator.platform == 'iPhone' || navigator.platform == 'iPod') 

{ 
//$("#header").css("position", "absolute"); 
 $("#boxWrapp .subVisual, .sectionMain").css("background-attachment", "scroll");
  $(".slides .cont").css("background-attachment", "scroll"); 
};
		});	


    $("#cmTopScroll").click(function (){ $("html, body").animate({scrollTop:0}, 200); });
    $(window).scroll(function (){ 
	var top = $(document).scrollTop(); 
	if(top > 300){
     $("#cmTopScroll").stop().animate({"bottom":40}, 250);
        }else{
            $("#cmTopScroll").stop().animate({"bottom":-200}, 250);
        }
    });
