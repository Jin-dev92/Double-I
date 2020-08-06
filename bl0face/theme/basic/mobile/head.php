<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
?>
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" charset="utf-8" />
	<?php if(strpos($_SERVER['HTTP_USER_AGENT'],"iPhone")) { ?>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=yes, target-densitydpi=device-dpi" />

	 <?php } else if(strpos($_SERVER['HTTP_USER_AGENT'],"iPad")) { ?>
	  <meta name="viewport" content="user-scalable=yes, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />

	 <?php } else if(strpos($_SERVER['HTTP_USER_AGENT'],"Android")) { ?>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=yes, target-densitydpi=device-dpi" />
	 <?php } ?>
<meta name="viewport" content="width=640">
<link rel="stylesheet" type="text/css" href="/theme/basic/mobile/css/slider-pro.min.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="/theme/basic/mobile/css/examples.css" media="screen"/>
<script type="text/javascript" src="/theme/basic/mobile/js/jquery.sliderPro.min.js"></script>
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.js"></script> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="/theme/basic/mobile/js/iscroll.js"></script>
	<script>
		new iScroll('scroller1', { hScrollbar: false, vScrollbar: false, hScroll: false });
	</script>
<script>
$(document).ready(function(){
	$('.top_btn').click(function(){
		if($('#leftMenu_val').val() == '0'){
			$('#leftMenu').slideDown('easeOutExpo');
			$('#leftMenu_val').val('1')
		}
	});
	$('#leftMenu').click(function() {
			$('#leftMenu').slideUp('easeOutExpo');
			$('#leftMenu_val').val('0')
	});
	var article = $('ul.gnb_ul>.depth1');
	article.addClass('hide1');
	article.find('.sub_01').show();

});
</script>
<script type="text/javascript">
	$( document ).ready(function( $ ) {
		$( '#example1' ).sliderPro({
			width: 640,
			height: 850,
			buttons: false,
			waitForLayers: true,
			thumbnailWidth: 147,
			thumbnailHeight: 137,
			thumbnailPointer: true,
			autoplay: false,
			autoScaleLayers: false,
		});
	});

</script>
	<div class="slide_top">
		<div class="top_logo">
			<a href='<?php echo G5_URL ?>'><img src="/theme/basic/mobile/img/mobile_top_logo.png"></a>
		</div>
		<div class="nara">
			<ul class="nara_ul">
				<li class="nara_li" ><a href="<?php echo G5_URL ?>"><img src="/theme/basic/mobile/img/mobile_kor_btn.png"></a></li>
				<li class="nara_li" ><a href="<?php echo G5_URL ?>/theme/basic/etc/sub01.php"><img src="/theme/basic/mobile/img/mobile_chn_btn.png"></a></li>
				<li class="nara_li" ><a href="javascript:void(0);"><img src="/theme/basic/mobile/img/mobile_eng_btn.png"></a></li>
			</ul>
		</div>
	</div>
<div id="example1" class="slider-pro">
	<div class="sp-slides">

		<!-- 비오페이스 소개 -->
		<div class="sp-slide">
			<!-- <img class="sp-image" src="/theme/basic/mobile/img/image7_large.jpg"/> -->
			<img class="sp-image" src="/theme/basic/mobile/img/layer_new_bg_m.jpg"/>
			<p class="sp-layer sp-white sp-padding"
				data-position="centerCenter" data-vertical="-50"
				data-show-transition="right" data-hide-transition="left" data-show-delay="700" >
				<a class="layer"  href="/bbs/board.php?bo_table=notice_kor&wr_id=4"><img src="/theme/basic/mobile/img/layer_new_m.png"></a>
			</p>

		</div>
		<!-- 골판 필러 -->
		<div class="sp-slide">
			<img class="sp-image" src="/theme/basic/mobile/img/image8_large.jpg"/>

			<p class="sp-layer sp-white sp-padding"
				data-position="centerCenter" data-vertical="-50"
				data-show-transition="right" data-hide-transition="left" data-show-delay="700" >
				<a class="layer"  href="/theme/basic/sub03/sub01.php"><img src="/theme/basic/mobile/img/layer_08.png"></a>
			</p>
		</div>
	<!-- 휜다리 필러-->
		<div class="sp-slide">
			<img class="sp-image" src="/theme/basic/mobile/img/image9_large.jpg"/>

			<p class="sp-layer sp-white sp-padding"
				data-position="centerCenter" data-vertical="-50"
				data-show-transition="right" data-hide-transition="left" data-show-delay="700" >
				<a class="layer" href="/bbs/board.php?bo_table=filler_review_kor"><img src="/theme/basic/mobile/img/layer_09.png"></a>
			</p>

		</div>

		<!-- 이벤트 -->
		<div class="sp-slide">
			<img class="sp-image" src="/theme/basic/mobile/img/image10_large.jpg"/>

			<p class="sp-layer sp-white sp-padding"
				data-position="centerCenter" data-vertical="-50"
				data-show-transition="right" data-hide-transition="left" data-show-delay="700" >
				<a class="layer" href="bbs/board.php?bo_table=event_kor"><img src="/theme/basic/mobile/img/layer_10.png"></a>
			</p>

		</div>
	</div>
	<div class="sp-thumbnails">

		<div class="sp-thumbnail" >
			<div class="sp-thumbnail-title"><img src="/theme/basic/mobile/img/thum_7.png"></div>
		</div>

		<div class="sp-thumbnail">
			<div class="sp-thumbnail-title"><img src="/theme/basic/mobile/img/thum_8.png"></div>
		</div>

		<div class="sp-thumbnail">
			<div class="sp-thumbnail-title"><img src="/theme/basic/mobile/img/thum_9.png"></div>
		</div>

		<div class="sp-thumbnail change">
			<div class="sp-thumbnail-title"><img src="/theme/basic/mobile/img/thum_10-1.png"></div>
		</div>

	</div>
</div>


<div style="position:absolute; width:100%; z-index:10; text-align:center; margin-top:-60px;">
	<div><img src="http://bioface.kr/theme/basic/mobile/img/down.gif"></div>
</div>

<script>
var change_index = 0;

setInterval(function(){
	
	if(change_index == 0){
		$('.change img').attr('src','/theme/basic/mobile/img/thum_10-2.png');
		change_index = 1;
	} else {
		$('.change img').attr('src','/theme/basic/mobile/img/thum_10-1.png');
		change_index = 0;
	}
}, 500);
</script>

<script>
$( document ).ready( function() {

	$( window ).scroll( function() {
		if ( $( document ).scrollTop() > 849 ) {
			$( '#document' ).addClass( 'smFixed' );
			$('#leftMenu').addClass('lmFixed');
			//$('.mobile_main').css('marginTop',110);
		} else {
			$( '#document' ).removeClass( 'smFixed' );
			$('#leftMenu').removeClass('lmFixed');
			//$('.mobile_main').css('marginTop',-110);
		}
		if($("#document").hasClass("smFixed") === true) {
			$('.mobile_main').css('marginTop',110);
		} else {
			$('.mobile_main').css('marginTop',0);
		}
	});

});
</script>
<style media="screen">
.login_m{float:right;margin-top: 25px;margin-right: 30px; }
	.login_m a {color: #fff; text-decoration: none; font-weight: bold;}
</style>
<div id='document'>
	<div id='head_wrap'>
		<div class='head_box'>
				<h1><a class="top_logo" href='<?php echo G5_URL ?>'><img  src='/theme/basic/mobile/img/mobile_middle_logo.png' alt='logo'/></a></h1>

			<div class="menu_list">

				<p class="top_btn">
					<img src='/theme/basic/mobile/img/mobile_middle_btn.png' alt='사이트맵보기' style="cursor:pointer;">
				</p>
			</div>
			<div class="login_m">
				<?php if (!$member['mb_id'] && $member['mb_level'] < 2){ ?>
				<a href="<?php echo G5_URL ?>/bbs/login.php"><i class="fa fa-user fa-3x" aria-hidden="true"></i><br>로그인</a>
				<?php }else {
					?>
					<a href="<?php echo G5_URL ?>/bbs/logout.php"><i class="fa fa-sign-out fa-3x" aria-hidden="true"></i><br>로그아웃</a>
					<?
				} ?>
			</div>
		</div>
	</div>
</div>
<div id="leftMenu">
	<input type='hidden' value='0' id='leftMenu_val'>
	<div class="menu_wrap"  id="scroller1">
		<p class="logo"><a href="<?php echo G5_URL ?>"><img src="/theme/basic/mobile/img/left_menu_logo.png"></a></p>
			<nav id="gnb1">
				<div class="lnb">
					<ul class="gnb_ul">
						<li class="depth1"><a href=""><span>BIOFACE STORY</span></a>
							<ul class="sub_01">
								<li class="sub_li"><a href="/theme/basic/sub01/sub01.php">필러는 하셨습니까?</a></li>
				        <li class="sub_li"><a href="/theme/basic/sub01/sub03.php">비오페이스 소개</a></li>
								<li class="sub_li"><a href="/theme/basic/sub01/sub02.php">필러 역사</a></li>
								<li class="sub_li"><a href="/bbs/board.php?bo_table=filler_lab_kor">필러 연구소</a></li>
								<li class="sub_li"><a href="/bbs/board.php?bo_table=filler_review_kor">원장 필러리뷰</a></li>
								<li class="sub_li"><a href="/bbs/board.php?bo_table=after">자필 후기</a></li>
								<li class="sub_li"><a href="/bbs/board.php?bo_table=notice_kor">공지사항</a></li>
								<li class="sub_li"><a href="/bbs/board.php?bo_table=online_kor">온라인상담</a></li>
								<li class="sub_li"><a href="/bbs/board.php?bo_table=event_kor">이벤트</a></li>
								<li class="sub_li"><a href="/bbs/board.php?bo_table=qna_kor">궁금해요!(Q&A)</a></li>
								<li class="sub_li"><a href="/bbs/board.php?bo_table=star_kor">비오스타</a></li>
							</ul>
						</li>
						<li class="depth1"><a href=""><span>FILLER</span></a>
							<ul class="sub_01">
								<li class="sub_li"><a href="/theme/basic/sub02/sub10.php">바디 필러</a></li>
								<li class="sub_li"><a href="/theme/basic/sub02/sub11.php">페이스 필러</a></li>
								<li class="sub_li"><a href="/theme/basic/sub02/sub08.php">깐깐한 주사실</a></li>
								<li class="sub_li"><a href="/theme/basic/sub02/sub06.php">티오필</a></li>
							</ul>
						</li>
						<li class="depth1"><a href=""><span>LIFTING</span></a>
							<ul class="sub_01">
								<li class="sub_li"><a href="/theme/basic/sub03/sub02.php">포니테일 리프팅</a></li>
								 <li class="sub_li"><a href="/theme/basic/mobile/sub03/sub04.php">리프톡스</a></li>
								 <li class="sub_li"><a href="/theme/basic/sub03/sub03.php">뉴테라 리프팅</a></li>
								<li class="sub_li"><a href="/theme/basic/sub03/sub01.php">부위별 리프팅</a></li>
							</ul>
						</li>
                        <li class="depth1"><a href=""><span>PISTO</span></a>
                            <ul class="sub_01">
                                <li class="sub_li"><a href="/theme/basic/sub06/sub02.php">비만클리닉</a></li>
								<li class="sub_li"><a href="/theme/basic/sub06/sub03.php">뇌피트니스</a></li>
								<li class="sub_li"><a href="/theme/basic/sub06/sub04.php">피스토주사</a></li>
								<li class="sub_li"><a href="/theme/basic/sub06/sub05.php">전후사진</a></li>
                            </ul>
                        </li>
						<li class="depth1"><a href=""><span>SKIN</span></a>
							<ul class="sub_01">
								<li class="sub_li"><a href="/theme/basic/sub04/sub01.php">에센스 주사</a></li>
								<li class="sub_li"><a href="/theme/basic/sub04/sub02.php">피부흉터 재건</a></li>
								<li class="sub_li"><a href="/theme/basic/sub04/sub03.php">촉촉필</a></li>
								<li class="sub_li"><a href="/theme/basic/sub04/sub04.php">마녀주사</a></li>
								<li class="sub_li"><a href="/theme/basic/sub04/sub05.php">메이크업필</a></li>
								<li class="sub_li"><a href="/theme/basic/sub04/sub06.php">안티에이징 레이저(C+B)</a></li>
								<li class="sub_li"><a href="/theme/basic/sub04/sub07.php">물광토닝</a></li>
								<li class="sub_li"><a href="/theme/basic/sub04/sub08.php">잡티제거</a></li>
								<li class="sub_li"><a href="/theme/basic/sub04/sub09.php">여드름</a></li>
								<li class="sub_li"><a href="/theme/basic/sub04/sub10.php">아쿠아필</a></li>
							</ul>
						</li>
						<li class="depth1"><a href=""><span>ETC</span></a>
							<ul class="sub_01">
								<!--<li class="sub_logo"><img src="/theme/basic/img/left_sub_body.jpg"></li>-->
								<!-- <li class="sub_li"><a href="/theme/basic/sub05/sub09.php" >반영구</a></li> -->
								<!-- <li class="sub_li"><a href="/theme/basic/sub05/sub02.php" >제로킹 다이어트</a></li>
								<li class="sub_li"><a href="/theme/basic/sub05/sub03.php" >리포소닉</a></li>
								<li class="sub_li"><a href="/theme/basic/sub05/sub04.php" >더블 스키니</a></li>
								<li class="sub_li"><a href="/theme/basic/sub05/sub05.php" >릴렉스 F 테너</a></li>
								<li class="sub_li"><a href="/theme/basic/sub05/sub06.php" >쿨쉐이핑</a></li> -->
								<li class="sub_li"><a href="/theme/basic/sub05/sub07.php" >미스코</a></li>
								<li class="sub_li"><a href="/theme/basic/sub05/sub08.php" >하이눈</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<div class="call">
					<style>

					</style>
				</div>
		</div>
	</div>
</div>

			<!--<div class="sibla">
				<div class="envet">
					<div class="nara">
						<ul class="nara_ul">
							<li class="nara_li" style="left:0; padding-right:35.5px;"><a href="<?php echo G5_URL ?>"><img src="/theme/basic/mobile/img/mobile_kor_btn.png"></a></li>
							<li class="nara_li" ><a href="javascript:void(0);"><img src="/theme/basic/mobile/img/mobile_chn_btn.png"></a></li>
							<li class="nara_li" style="right:0; padding-left:35.5px;"><a href="javascript:void(0);"><img src="/theme/basic/mobile/img/mobile_eng_btn.png"></a></li>
						</ul>
					</div>
					<div class="board_btn">
						<ul class="board_btn_ul">
							<li class="board_btn_li" style="left:0; padding-right:30px;"><a href="/bbs/board.php?bo_table=event_kor"><img src="/theme/basic/mobile/img/mobile_menu_btn1.png"></a></li>
							<li class="board_btn_li" ><a href="/bbs/board.php?bo_table=online_kor"><img src="/theme/basic/mobile/img/mobile_menu_btn2.png"></a></li>
						</ul>
					</div>
				</div>
				<div class="call">
						<ul>
							<li class="con">CONTACT US</li>
							<li class="num">1833.8838</li>
						</ul>
				</div>-->
