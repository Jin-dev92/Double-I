<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/include/sub_head.php');
    return;
}

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_THEME_PATH.'/include/quickbar.php');
?>

<script>
function allmenu(){
	if($("#hd_all").css("display") == "none"){
		$("#hd_all").show();
	} else {
		$("#hd_all").hide();
	}
}

$(document).ready(function(){
		$('#hd_all').click(function() {
			$('#hd_all').hide();
		});
});
</script>

<!-- 상단 시작 { -->
<div id="hd" >
    <div id="hd_wrapper">
        <div id="logo">
            <a href="<?php echo G5_URL ?>"><img src="/theme/basic/img/main/header_logo.png" alt="비오페이스"></a>
        </div>
        <div id="nara">
			<img src="/theme/basic/img/main/nara.png" usemap="#nara_go">
			<map name="nara_go">
				<area shape="rect" coords="0,0,28,28" href="<?php echo G5_URL ?>"/>
				<area shape="rect" coords="38,0,66,28" href="<?php echo G5_URL ?>/theme/basic/etc/sub01.php"/><!-- "<?php echo G5_URL ?>/theme/basic/chn" -->
				<area shape="rect" coords="76,0,104,28" href="javascript:void(0);"/><!-- "<?php echo G5_URL ?>/theme/basic/eng" -->
			</map>
        </div>
        <style media="screen">
          .top_login{position: absolute; top: 5px; right: 3px; z-index: 999999; }
          .top_login li{float: left; margin-left: 5px; color: #fff; font-size: 13px; text-decoration: none; font-weight: bold;}
          .top_login li a{color: #fff; font-size: 13px; text-decoration: none; font-weight: bold;}
        </style>
        <ul class="top_login">
  				<?php
  				if (!$member['mb_id']) // 회원이 아닐 일때
  				{
  				 ?>
  				<li><a href="<?php echo G5_URL ?>/bbs/login.php">로그인</a></li>
  				<li>|</li>
  				<li><a href="<?php echo G5_URL ?>/bbs/register.php"> 회원가입</a></li>
  				<?
  			}else {
  			 ?>
  			 <li><a href="<?php echo G5_URL ?>/bbs/logout.php">로그아웃</a></li>
  			 <?
  			}
  				?>
  			</ul>

        <ul id="tnb">
            <?php if ($is_admin) {  ?>
            <li><a href="<?php echo G5_ADMIN_URL ?>"><b>ADMIN</b></a></li>
            <?php }  ?>
            <li><a href="#" onclick="allmenu(); return false;"><b>BIOFACE STORY</b></a></li>
            <li><a href="#" onclick="allmenu(); return false;"><b>FILLER</b></a></li>
            <li><a href="#" onclick="allmenu(); return false;"><b>LIFTING</b></a></li>
            <li><a href="#" onclick="allmenu(); return false;"><b>PISTO</b></a></li>
            <li><a href="#" onclick="allmenu(); return false;"><b>SKIN</b></a></li>
            <li><a href="#" onclick="allmenu(); return false;"><b>ETC</b></a></li>
        </ul>
    </div>
</div>
<div id="hd_all">
	<div id="hd_allmenu">
        <div id="allmenu">
            <img src="/theme/basic/img/main/allmenu.png" alt="전체메뉴">
        </div>
        <div id="allmenu_cate">
			<ul id="cate1">
				<li id="title"><b>BIOFACE STORY</b></li>
				<li id="first"><a href="/theme/basic/sub01/sub01.php">필러는 하셨습니까?</a></li>
        <li><a href="/theme/basic/sub01/sub03.php">비오페이스 소개</a></li>
				<li><a href="/theme/basic/sub01/sub02.php">필러 역사</a></li>
				<li><a href="/bbs/board.php?bo_table=filler_lab_kor">필러 연구소</a></li>
				<li><a href="/bbs/board.php?bo_table=filler_review_kor">원장 필러리뷰</a></li>
        <li><a href="/bbs/board.php?bo_table=after">자필 후기</a></li>
				<li><a href="/bbs/board.php?bo_table=notice_kor">공지사항</a></li>
				<li><a href="/bbs/board.php?bo_table=online_kor">온라인상담</a></li>
				<li><a href="/bbs/board.php?bo_table=event_kor">이벤트</a></li>
				<li><a href="/bbs/board.php?bo_table=qna_kor">궁금해요!(Q&A)</a></li>
				<li><a href="/bbs/board.php?bo_table=star_kor">비오스타</a></li>
			</ul>
			<ul id="cate2">
				<li id="title"><b>FILLER</b></li>
				<li id="first"><a href="/theme/basic/sub02/sub10.php">바디 필러</a></li>
				<li><a href="/theme/basic/sub02/sub11.php">페이스 필러</a></li>
				<li><a href="/theme/basic/sub02/sub08.php">깐깐한 주사실</a></li>
        <li><a href="/theme/basic/sub02/sub06.php">티오필</a></li>
			</ul>
			<ul id="cate3">
				<li id="title"><b>LIFTING</b></li>
				<li id="first"><a href="/theme/basic/sub03/sub02.php">포니테일 리프팅</a></li>
				<li><a href="/theme/basic/sub03/sub04.php">리프톡스</a></li>
				<li><a href="/theme/basic/sub03/sub03.php">뉴테라 리프팅</a></li>
				<li><a href="/theme/basic/sub03/sub01.php">부위별 리프팅</a></li>					
			</ul>
			<ul id="cate6">
				<li id="title"><b>PISTO</b></li>
				<li id="first"><a href="/theme/basic/sub06/sub02.php">비만클리닉</a></li>
				<li><a href="/theme/basic/sub06/sub03.php">뇌피트니스</a></li>
				<li><a href="/theme/basic/sub06/sub04.php">피스토주사</a></li>
				<li><a href="/theme/basic/sub06/sub05.php">전후사진</a></li>
			</ul>
			<ul id="cate4">
				<li id="title"><b>SKIN</b></li>
				<li id="first"><a href="/theme/basic/sub04/sub01.php">에센스 주사</a></li>
				<li><a href="/theme/basic/sub04/sub02.php">피부흉터 재건</a></li>
				<li><a href="/theme/basic/sub04/sub03.php">촉촉필</a></li>
				<li><a href="/theme/basic/sub04/sub04.php">마녀주사</a></li>
				<li><a href="/theme/basic/sub04/sub05.php">메이크업필</a></li>
				<li><a href="/theme/basic/sub04/sub06.php">안티에이징 레이저(C+B)</a></li>
				<li><a href="/theme/basic/sub04/sub07.php">물광토닝</a></li>
				<li><a href="/theme/basic/sub04/sub08.php">잡티제거</a></li>
				<li><a href="/theme/basic/sub04/sub09.php">여드름</a></li>
				<li><a href="/theme/basic/sub04/sub10.php">아쿠아필</a></li>
			</ul>
			<ul id="cate5">
				<li id="title"><b>ETC</b></li>
				<!-- <li><a href="/theme/basic/sub05/sub09.php">반영구</a></li> -->
				<!-- <li><a href="/theme/basic/sub05/sub02.php">제로킹 다이어트</a></li> -->
				<!-- <li><a href="/theme/basic/sub05/sub03.php">리포소닉</a></li> -->
				<!-- <li><a href="/theme/basic/sub05/sub04.php">더블 스키니</a></li> -->
				<!-- <li><a href="/theme/basic/sub05/sub05.php">릴렉스 F 테너</a></li> -->
				<!-- <li><a href="/theme/basic/sub05/sub06.php">쿨쉐이핑</a></li> -->
				<li id="first"><a href="/theme/basic/sub05/sub07.php">미스코</a></li>
				<li><a href="/theme/basic/sub05/sub08.php">하이눈</a></li>
			</ul>
        </div>
	</div>
</div>
<!-- } 상단 끝 -->
