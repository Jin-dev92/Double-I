<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}
include_once(G5_THEME_PATH.'/head.php');
?>

<?php
	include_once(G5_THEME_PATH.'/include/slide.php');
?>
<script>
$(document).ready(function(){
		$('#main_all').click(function() {
			$('#main_all').hide();
		});
    // $(window).scroll(function(){
    //   var scroll_tops = $(this).scrollTop();
    //   console.log("홈피에지 위치:"+scroll_tops);
    // })
});
</script>
<script>
  function closeWin0122(){
		document.all['popup0122'].style.visibility = "hidden";
	}
	function setCookie( name, value, expiredays ) {
	 var todayDate = new Date();
	  todayDate.setDate( todayDate.getDate() + expiredays );
	  document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
	 }

  function closeTodayWin21() {
    if ( document.form20170122.chkbox ){
     setCookie( "popup0122", "done" , 1 );
    }
  document.all['popup0122'].style.visibility = "hidden";
 }
</script>

<!-- <div id="popup0122" style="position:absolute; margin:0 auto; width:100%; z-index: 15; top:100px; ">
	<div id="eventpop1121" style="display:block; margin:0 auto; width:300px;">
    <div id="theLayer1121" style="position:absolute; width:300px; margin:0 auto; ">
      <div>
        <a href="javascript:closeWin0122();">
        <div style="position:absolute; right:-5px; top:5px; width:45px; height:45px; "><img src="/theme/basic/img/pop/X_w.png" style="width:80%;" alt=""></div></a>
        <img src="/theme/basic/img/pop/pop0511.png?<?=rand()?>" border="0">
      </div>
      <div style="position:absolute; z-index: 12; float:left; right:5px; bottom:2px;">
        <form name="form20170122">
          <input type="hidden" name='chkbox' value="checkbox"><a href="javascript:closeTodayWin21();" onfocus="this.blur();"><img src="/theme/basic/img/pop/todayend_w.png" border="0"></a>
        </form>
      </div>
    </div>
	</div>
</div> -->


<script language="Javascript">
	cookiedata = document.cookie;
	if ( cookiedata.indexOf("popup0122=done") < 0 ){
	document.all['popup0122'].style.visibility = "visible";
	}
	else {
	document.all['popup0122'].style.visibility = "hidden";
	}

</script>

<!--################ 팝업 ################ -->
<!-- 상단 시작 { -->
<div class="super_main">
	<div id="main" >
		<div id="main_wrapper">
			<div id="logo">
				<a href="<?php echo G5_URL ?>"><img src="/theme/basic/img/main/header_logo.png" alt="비오페이스"></a>
			</div>
			<div id="nara">
				<img src="/theme/basic/img/main/nara.png" usemap="#nara_go">
				<map name="nara_go">
					<area shape="rect" coords="0,0,28,28" href="<?php echo G5_URL ?>"/>
					<area shape="rect" coords="38,0,66,28" href="<?php echo G5_URL ?>/theme/basic/chn"/>
					<area shape="rect" coords="76,0,104,28" href="<?php echo G5_URL ?>/theme/basic/eng"/>
				</map>
			</div>
			<!--<div class="admin_btn">
				<?php if ($is_admin) {  ?>
					<a href="<?php echo G5_ADMIN_URL ?>"><img src="/theme/basic/img/main/admin_btn.png"></a>
				<?php }  ?>
			</div>
			<div class="icon_btn">
				<ul class="btn_ul">
					<li><a href="/theme/basic/sub02/sub01.php"><img src="/theme/basic/img/main/head_btn_1.png"></a></li>
					<li><a href="/theme/basic/sub02/sub02.php"><img src="/theme/basic/img/main/head_btn_2.png"></a></li>
					<li><a href="/theme/basic/sub03/sub01.php"><img src="/theme/basic/img/main/head_btn_3.png"></a></li>
					<li><a href="/theme/basic/sub04/sub01.php"><img src="/theme/basic/img/main/head_btn_4.png"></a></li>
				</ul>
			</div> -->
			<ul id="tnb">
				<?php if ($is_admin) {  ?>
				<li><a href="<?php echo G5_ADMIN_URL ?>"><b>ADMIN<b></a></li>
				<?php }  ?>
				<li><a href="#" onclick="mainmenu(); return false;"><b>BIOFACE STORY</b></a></li>
				<li><a href="#" onclick="mainmenu(); return false;"><b>FILLER</b></a></li>
				<li><a href="#" onclick="mainmenu(); return false;"><b>LIFTING</b></a></li>
				<li><a href="#" onclick="mainmenu(); return false;"><b>PISTO</b></a></li>
				<li><a href="#" onclick="mainmenu(); return false;"><b>SKIN</b></a></li>
				<li><a href="#" onclick="mainmenu(); return false;"><b>ETC</b></a></li>
			</ul>
		</div>
	</div>
	<div id="main_all">
		<div id="main_allmenu">
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
					<!-- <li><a href="/theme/basic/sub05/sub02.php">제로킹 다이어트</a></li>
					<li><a href="/theme/basic/sub05/sub03.php">리포소닉</a></li>
					<li><a href="/theme/basic/sub05/sub04.php">더블 스키니</a></li>
					<li><a href="/theme/basic/sub05/sub05.php">릴렉스 F 테너</a></li>
					<li><a href="/theme/basic/sub05/sub06.php">쿨쉐이핑</a></li> -->
					<li id="first"><a href="/theme/basic/sub05/sub07.php">미스코</a></li>
					<li><a href="/theme/basic/sub05/sub08.php">하이눈</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- //상단 시작 { -->
<div class="main1">
	<div class="main1_2">
		<div class="main1_2_1">
			<img src="/theme/basic/img/main/ssussu.gif" style="border-radius: 25px;">
				<div class="de_btn_01">
					<a href="/bbs/board.php?bo_table=filler_lab_kor"><img src="/theme/basic/img/main/filler_btn.png" ></a>
				</div>
				<div class="de_btn_02">
					<a href="/bbs/board.php?bo_table=filler_review_kor"><img src="/theme/basic/img/main/detail_btn.png" ></a>
				</div>
		</div>
	</div>
</div>
<div class="main2">
	<!--<div class="main2_1">
	<div class="main2_1_1">
			<div class="main2_1_1_1">
				<ul id="content-slider" class="content-slider">
					<li><img src="/theme/basic/img/main/main2_1_1.png"></li>
					<li><img src="/theme/basic/img/main/main2_1_2.png"></li>
					<li><img src="/theme/basic/img/main/main2_1_3.png"></li>
					<li><img src="/theme/basic/img/main/main2_1_4.png"></li>
				</ul>
			</div>
		</div>
	</div>-->
	<div class="vbtn_03">
		<div class="de_btn_03">
			<a href="/theme/basic/sub01/sub02.php"><img src="/theme/basic/img/main/detail_btn.png" ></a>
		</div>
	</div>
	<div class="main2_3">
		<ul class="main2_3_ul">
			<li class="main2_3_li_first"><a href="/bbs/board.php?bo_table=filler_lab_kor"><img src="/theme/basic/img/main/main2_3_1.jpg"></a></li>
			<li class="main2_3_li_sec"><a href="/bbs/board.php?bo_table=filler_lab_kor"><img src="/theme/basic/img/main/main2_3_2.jpg"></a></li>
			<li><a href="/bbs/board.php?bo_table=filler_lab_kor"><img src="/theme/basic/img/main/main2_3_3.jpg"></a></li>
			<li class="main2_3_li_last"><a href="/bbs/board.php?bo_table=filler_lab_kor"><img src="/theme/basic/img/main/main2_3_4.jpg"></a></li>
		</ul>
	</div>
		<div class="main2_4">
			<iframe width="560" height="315" src="https://www.youtube.com/embed/njEvj4HcSGA" frameborder="0" allowfullscreen></iframe>
			<div class="vbtn_04">
				<div class="de_btn_04">
						<a href="https://www.youtube.com/channel/UCuitF5ApGjfZ5q3HPjPSUNw"><img src="/theme/basic/img/main/bioface_btn.png" ></a>
				</div>
			</div>
		</div>
</div>
<div class="main3">
	<div class="vbtn_05">
		<div class="main3_1">
			<img src="/theme/basic/img/main/main3_2_1.png" usemap="#main3_2_1">
			<map name="main3_2_1">
				<area shape="rect" coords="9,266,154,305" href="/theme/basic/sub02/sub08.php"/>
			</map>
		</div>
	</div>
</div>
<div class="main4">
	<!-- <div id="map_view" style="width:100%; min-width:1200px; height:445px;"></div> -->
	<img src="/theme/basic/img/main/main3_2_2.jpg" style="width:100%; max-width: 1920px; display: block; margin: 0 auto; ">
</div>


<script>
function mainmenu(){
	if($("#main_all").css("display") == "none"){
		$("#main_all").show();
	} else {
		$("#main_all").hide();
	}
}

</script>

</script>
<!-- 지도 -->

<!-- <script type="text/javascript" src="http://bioface.kr/theme/basic/js/clickgraph.js?<?=time();?>" id="clickgraph"></script> -->


<?php
include_once(G5_THEME_PATH.'/tail.php');
?>
