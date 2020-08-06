
<script src="<?=$nfor[path]?>/js/nfor.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<style>
/*linear-gradient(-45deg, #f7cac9 0%,#f7cac9 34%,#92a8d1 78%,#92a8d1 100%);*/
#header { position: relative; background:#fff }

#header .top_menu{width:100%; height:33px; z-index:10; }
#header .top_menu .top_menu_wrap{position:relative; margin:0 auto; width:1161px; height:33px; font-size:11px; letter-spacing:-1px;}
#header .top_menu .top_menu_wrap .left { position:absolute; top:0px; left:0px; color:#d7d7d7; font-size:11px; line-height:11px;}
#header .top_menu .top_menu_wrap .left a { display:inline-block; color:#666; padding:9px; }

#header .top_menu .top_menu_wrap .right { position:absolute; top:0px; right:0px; color:#fff; font-size:11px; line-height:11px; letter-spacing:-1px; }
#header .top_menu .top_menu_wrap .right a { display:inline-block; *zoom:1; *display:inline; color:#666; padding:9px; position:relative; }
#header .top_menu .top_menu_wrap .right .star { display:inline-block; *zoom:1; *display:inline;  height:15px;width:15px; background:url("<?=$nfor[skin_path]?>img/picreup_layout.png") -0px -0px no-repeat; vertical-align:-3px;}
#header .top_menu .top_menu_wrap .right .mail { display:inline-block; *zoom:1; *display:inline;  height:15px;width:15px; background:url("<?=$nfor[skin_path]?>img/picreup_layout.png") -30px -0px no-repeat; vertical-align:-3px;}
#header .top_menu .top_menu_wrap .right .cartbg { display:inline-block; *zoom:1; *display:inline;  height:16px;width:16px; background:url("<?=$nfor[skin_path]?>img/picreup_layout.png") -0px -30px no-repeat; vertical-align:-0px; text-align:center; line-height:16px;color:#FFFFFF; }

#header .gnb_logo_section { width:100%; }
#header .gnb_logo_section .inner{ position:relative; width:1161px; height: 70px; margin:0 auto; overflow:hidden; }
#header .gnb_logo_section .inner .indexlogo{position:absolute; top:-6px; text-align:left;  width:186px; height:30px; display:block; background:url("<?=$nfor[skin_path]?>img/logo.png") -0px -0px no-repeat;  text-indent:-9999px; }
#header .gnb_logo_section .inner .search { border:solid 2px #f18484; height:34px; width:400px;position:absolute; top:15px; right:390px; }
#header .gnb_logo_section .inner .search_btn{ display: block;  width:32px; height:32px; background: #ff8590;margin: 0;padding: 0; cursor: pointer; border: 0;}
#header .gnb_logo_section .inner .search_text{ width:351px; height:32px;line-height:33px; border:0px; padding-left:16px;}

#header .top_right_banner_wrap { position:absolute; top:15px; right:0px; }

#gnb { position:relative; width:100%; height:70px;background-color:#2b68a7; z-index:3; -moz-box-shadow: 10px 10px 5px #888888; /* Firefox 3.6 and earlier box-shadow: 0px 2px 2px #999999;*/}
#gnb .gnb_menu {width: 1161px; height: 70px; margin:0 auto; border-left:dashed 1px rgba(255, 255, 255, 0.47); overflow:hidden;}
.gnb_menu li a span{position: absolute; float: left;}
.gnb_menu li a {height: 100%;}
.gnb_menu li { list-style: none; } .gnb_menu a {text-decoration: none;}
#gnb .gnb_menu ul { position:relative; margin:0 auto;  width:1161px; }
#gnb .gnb_menu li { float:left; color:#ffffff;  text-align:center; margin:0px; padding:0px;}
#gnb .gnb_menu li a { display:block;color:#FFFFFF; line-height:75px; font-size:14px; width:231px; border-right:dashed 1px rgba(255, 255, 255, 0.47);  }
#gnb .gnb_menu li a img { margin-top:15px; margin-right:10px; margin-left: -60px !important;}
#gnb .gnb_menu li a.on { color:#FFFFFF;  background-color:#4090e3 }
#gnb .gnb_menu li a:hover{ text-decoration:none; background-color:#4090e3; }
.right a{text-decoration: none;}
.search_text {position: relative; width: 365px !important; top: -13px;}
</style>

<!-- 구독하기 -->
<style>
.subscribe_popup {position:fixed;_position:absolute;top:0;left:0;width:100%;height:100%; z-index:1000; display:none; }
.subscribe_popup .bg {position:absolute;top:0;left:0;width:100%;height:100%;background:#000;opacity:.5;filter:alpha(opacity=50)}
.subscribe_popup .fg {position:absolute;top:50%;left:50%;width:517px;height:392px;margin:-200px 0 0 -258px;}
</style>
<div id="subscribe_popup" class="subscribe_popup">
	<div class="bg"></div>
	<div class="fg"><? include_once $nfor[skin_path]."subscribe.php"; ?></div>
</div>
<!-- 구독하기 -->


<div id="wrap">
	<!-- header -->
	<div id="header">
		<!-- top_menu -->
		<div class="top_menu">
			<div class="top_menu_wrap">
				<div class="right">
					<a href="javascript:favorite()"><b class="star"></b> 즐겨찾기</a>
					<span class="menu_bar">|</span>
					<a href="javascript:subscribe_popup('open')" class="lk-1"><b class="mail"></b> 메일구독</a>
					<span class="menu_bar">|</span>
										<a href="../../logout.php">로그아웃</a>
					<span class="menu_bar">|</span>
										<a href="../../member_form.php">정보수정</a>
					<span class="menu_bar">|</span>
										<a href="../../faq.php" style="color:#666;">고객센터</a>
					<span class="menu_bar">|</span>
					<a href="../../order_list.php" style="color:#666;">마이페이지</a>
					<span class="menu_bar">|</span>
					<a href="../../cart.php">장바구니</a>
				</div>
			</div>
		</div>

		<div class="gnb_logo_section">
			<div class="inner">

						<a href="/"><h1 class="indexlogo"></h1></a>
			
			<div class="search">
				<form method="get" id="fitem_search" action="search.php">
				<input type="text" name="keyword" value="" class="search_text"><a href="javascript:item_search()"><img src="./img/search_btn.png" alt="검색"></a>
				</form>
			</div>
			<div class="top_right_banner_wrap">
	<div class="bx-wrapper" style="max-width: 100%;"><div class="bx-viewport" aria-live="polite" style="width: 100%; overflow: hidden; position: relative;"><ul id="top_right_banner" style="width: 215%; position: relative;">
		</ul></div><div class="bx-controls"></div></div>
	<span id="slider-prevt"><a class="bx-prev" href=""><img src="./img/slider_prev_btn.png"></a></span>
	<span id="slider-nextt"><a class="bx-next" href=""><img src="./img/slider_next_btn.png"></a></span>
</div>

<style>
.top_right_banner_wrap { position:relative; width:190px; height:79px; overflow:hidden; }
.top_right_banner_wrap #slider-prevt { position:absolute; top:0px; right:19px;   }
.top_right_banner_wrap #slider-nextt { position:absolute; top:0px; right:5px;  }
</style>

<script type="text/javascript">
<!--
(function($){
	$(function(){
		var top_right_banner = $('#top_right_banner').bxSlider({
		auto: true,
		autoHover: true,
		autoControls: false,
		pause: 3000,
		controls: true,
		pager: false,
		nextSelector: '#slider-nextt',
		  prevSelector: '#slider-prevt',
		  nextText: "<img src='./img/slider_next_btn.png'>",
		  prevText: "<img src='./img/slider_prev_btn.png'>"
		});
	});
}(jQuery))
</script>	</div>
		</div>

		<div id="gnb">
			<!-- gnb_menu -->
			<div class="gnb_menu">
					<li>
						<a class="menu01" href="../../today_item_list.php">
							<img src="./img/today.png">
							<span>전체상품</span>
						</a>
					</li>
					<li><a class="menu02" href="../../item_list.php?category_id=001"><img src="/data/category/3690663588_IHQGWAhU_2.png"><span>성형센터</span></a></li>
					<li><a class="menu02" href="../../item_list.php?category_id=002"><img src="/data/category/3690663588_UmRPiGty_3.png"><span>쁘띠성형</span></a></li>
					<li><a class="menu02" href="../../item_list.php?category_id=003"><img src="/data/category/3690663588_7DIqPns9_4.png"><span>피부센터</span></a></li>
					<div id="area_menu">
						<li><a class="menu02" href="../../item_list.php?category_id=004"><img src="/data/category/3690663588_CyHvn4uz_5.png"><span>지역</span></a></li>
						<div id="area_menu_list" style="display: none;">
							<a href="./item_list.php?category_id=004">모든지역 </a>
							<a href="./item_list.php?category_id=004465">서울시 </a>
							<a href="./item_list.php?category_id=004466">인천&nbsp;|&nbsp;경기 </a>
							<!--<a href="item_list.php?category_id=004467">대전&nbsp;|&nbsp;충청</a>
							<a href="item_list.php?category_id=004468">광주&nbsp;|&nbsp;전라</a>
							<a href="item_list.php?category_id=004469">부산&nbsp;|&nbsp;경상</a>
							<a href="item_list.php?category_id=004470">그외</a>-->
						</div>
					</div>
					

			</div>
			<!-- //gnb_menu -->
		</div>
	</div>
</div>