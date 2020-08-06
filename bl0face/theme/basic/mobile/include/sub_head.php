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
<link rel="stylesheet" href="/theme/basic/mobile/css/swiper.min.css">
<script src="/theme/basic/mobile/js/swiper.jquery.min.js"></script>
<script type="text/javascript" src="/theme/basic/mobile/js/jquery.mousewheel.min.js"></script>
<script src="/theme/basic/mobile/js/iscroll.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script>
		new iScroll('scroller1', { hScrollbar: false, vScrollbar: false, hScroll: false });
	</script>
	<style>
		#leftMenu {overflow-y: scroll;}
	</style>
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


<script>
$( document ).ready( function() {
	var jbOffset = $( '#document' ).offset();
	$( window ).scroll( function() {
		if ( $( document ).scrollTop() > jbOffset.top ) {
			$( '#document' ).addClass( 'smFixed' );
			$('#leftMenu').addClass('lmFixed');
		} else {
			$( '#document' ).removeClass( 'smFixed' );
			$('#leftMenu').removeClass('lmFixed');
		}
	});
} );
</script>
<style media="screen">
.login_m{float:right;margin-top: 25px;margin-right: 30px; }
	.login_m a {color: #fff; text-decoration: none; font-weight: bold; font-family: }
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
			</div>
		</div>
	</div>
</div>
