<!-- quick -->
<style type="text/css">
.quick {
	Z-INDEX:11; POSITION: fixed;  WIDTH: 115px;  TOP: -10px; RIGHT: 0px; height:100%;
}
.quick #quick_wrap {
	POSITION: absolute; TOP: 100px
}
.quick #quick_wrap:after {
	FLOAT: none; CLEAR: both; CONTENT: ""
}
.quick_list {
	WIDTH: 20px; FLOAT: left;
}
.quick_list .rb_open {
	Z-INDEX: 10
}
.quick_list .rb_close {
	Z-INDEX: 10
}
.quick_contents {
	POSITION: relative; WIDTH: 95px; height:100%; FLOAT: left; OVERFLOW: hidden; BACKGROUND-COLOR: #191919;

}
</style>

<div class="quick">
	<div id="quick_wrap">
		<div class="quick_list" >
			<a class="rb_close"><img src="/theme/basic/include/img/quick_01_close.jpg"  style="cursor:pointer;"></a>
			<a class="rb_open" style="display:none;"><img src="/theme/basic/include/img/quick_01_open.jpg"  style="cursor:pointer;"></a>
		</div>
		<div class="quick_contents">		
				<img src="/theme/basic/include/img/quick_title.jpg"><br>
				<a href="/bbs/board.php?bo_table=event_kor" onfocus="this.blur();"><img src="/theme/basic/include/img/quick_menu01.jpg"></a><br>
				<a href="http://goto.kakao.com/@비오페이스서울신사본점" onfocus="this.blur();"><img src="/theme/basic/include/img/quick_menu02.jpg"></a><br>
				<a href="/bbs/board.php?bo_table=online_kor" onfocus="this.blur();"><img src="/theme/basic/include/img/quick_menu03.jpg"></a><br>	
				<div class="up_scroll" style="position: relative; width: 100px; height: 50px; text-align: center; color: #fff; line-height: 50px; cursor: pointer;">
					<b>TOP</b>
				</div>
		</div>
	</div>
</div>
	
	<script type="text/javascript">
	$('.up_scroll').on('click',function(){
	  $('body,html').animate({scrollTop:0},200);
	});
	</script>

	<script type="text/javascript">

	$(window).load(function(){

			var isOpen=true;
			var cont=$('.quick_contents > div');

			$(window).ready(function(){
					$(".rb_close").show();
					$(".rb_open").hide();
					$('.quick').animate({right:0},200);
					cont.show();
					isOpen=true;
					return false;
			});

			$('.quick').find('.rb_open').click(function(){ /* quick배너 오픈함수 */
				$(".rb_close").show();
				$(".rb_open").hide();
				$('.quick').animate({right:0},200);
				cont.show();
				isOpen=true;
				return false;
			});

			$('.quick').find('.rb_close').click(function(){ /* quick배너 클로즈함수 */
				$(".rb_close").hide();
				$(".rb_open").show();
				$('.quick').animate({right:'-95px'},200);
				cont.hide();
				isOpen=false;
				return false;
			});


	   });
	   /* fn.quickmenu end */
</script>
<!-- quick -->