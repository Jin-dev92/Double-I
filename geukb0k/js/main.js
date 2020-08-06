$(document).ready(function(){
  // 가격 카운트
  var nums=0;
 setInterval(function(){
   nums += 1;
   if(nums>90){
     return false;
   }
   var num_view = Intl.NumberFormat().format(nums);
   $(".pur").text(num_view+"%");
 },10);
   var nums2=0;
  setInterval(function(){
    nums2 += 1100;
    if(nums2>9900){
      return false;
    }
    var num_view2 = Intl.NumberFormat().format(nums2);
    $(".prs").text(num_view2+"원");
  },50);

  // 띠배너
$('.ad3_img').bxSlider({
slideWidth: 330,
minSlides: 2,
maxSlides: 20,
moveSlides: 1,
auto: true,
autoControls: false,
pager:false,
speed:600,
slideMargin:10,
});


// 리뷰 별점
$(".review_item_wrap .item_img").hover(function(){
var idx = $(".review_item_wrap .item_img").index(this);
$(".item_hover_wrap").eq(idx).css("display","block");
},function(){
var idx = $(".review_item_wrap .item_img").index(this);
$(".item_hover_wrap").eq(idx).css("display","none");
})

// 기기
var slider =$('.machine_items').bxSlider({
  minSlides: 2,
  maxSlides: 2,
  slideWidth: 960,
  auto: true,
});

// 비쥬얼메뉴
$(".left_inbtn").mouseover(function(){
  $(".left_btn").animate({"width":"100%"},800);
  $(".bf_txt").hide();
  $(".menu2").css("display","flex");
  $(".left_inbtn img").attr("src","img/main_slide_arrow2.jpg");
});
$(".left_inbtn").click(function(){
  $(".left_inbtn img").attr("src","img/main_slide_arrow.jpg");
  $(".left_btn").animate({"width":"650px"},800);
  $(".bf_txt").show();
  $(".menu2").hide();
})


// 기기 디테일
$(".detail_view_btn").click(function(){
    $('.machine_detail').show();
    $(".machine_prs").text("원");
    var lnr = ($(".detail_view_btn").index(this)%2);
    if(lnr==0){
      $('.machine_detail_right').slideDown(1000);
      $('.machine_detail_right .machine_detail_txt').fadeIn(1500);
      var num_cnt=0;
      var nums = Number(5200000);//php로 값 받기
      var numup = nums/20;
      setTimeout(function(){
        setInterval(function(){
           num_cnt+=numup;
           if (num_cnt>nums) {
             return false;
           }else {
             var num_view = Intl.NumberFormat().format(num_cnt);
             $(".machine_prs").text(num_view+"원");
           }
        },50);
      },1300);
    }else {
      var num_cnt=0;
      var nums = Number(6700000);//php로 값 받기
      var numup = nums/20;
      setTimeout(function(){
        setInterval(function(){
           num_cnt+=numup;
           if (num_cnt>nums) {
             return false;
           }else {
             var num_view = Intl.NumberFormat().format(num_cnt);
             $(".machine_prs").text(num_view+"원");
           }
        },50);
      },1300);
      $('.machine_detail_left').slideDown(1000);
      $('.machine_detail_left .machine_detail_txt').fadeIn(1500);
    }
})
$(".machine_detail_txt h2 a").click(function (){
  $('.machine_detail').hide();
  $('.machine_detail_left').hide();
  $('.machine_detail_right').hide();
  $('.machine_detail_txt').hide();
  $(".machine_prs").text("원");
})
})
