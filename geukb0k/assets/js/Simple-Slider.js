$(function(){

    // Initializing the swiper plugin for the slider.
    // Read more here: http://idangero.us/swiper/api/

    var mySwiper = new Swiper ('.swiper-container', {
        loop: true,
        pagination: '.swiper-pagination',
        paginationClickable: true,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        autoplay:4000,
        speed:600,
        onSlideChangeEnd: function (mySwiper) {

       var idx = mySwiper.activeIndex;
       var slidesLen = $(".swiper-container .swiper-slide").length;
       if (idx==slidesLen-1) {
         idx=1;
       }
       $(".banner_name").text($(".in_banner_name").eq(idx-1).text());
       $(".banner_con").text($(".in_banner_con").eq(idx-1).text());
       $(".banner_val").text($(".in_banner_val").eq(idx-1).text()+"원" );
   }
    });
    var mySwiper2 = new Swiper ('.swiper-container2', {
        loop: true,
        pagination: '.swiper-pagination2',
        paginationClickable: true,
        nextButton: '.swiper-button-next2',
        prevButton: '.swiper-button-prev2',
        slidesPerView: 2,
        slidesPerGroup:2,
        autoplay:4000,
        speed:600,
    });
    $(".detail_view_btn").click(function(){
			mySwiper2.stopAutoplay();
		})
    $(".machine_detail_txt h2 a").click(function(){
      mySwiper2.startAutoplay();
    })
});
