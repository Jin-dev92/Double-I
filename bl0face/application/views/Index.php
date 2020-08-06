<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
	// PC
} else {
	//MOBILE
	header("Location: /mobile_m");
}

?>

<style>
	.header_content .row .m6 li a:hover { color: #AA0010; text-decoration: underline;}
	.header_content .row { height: 30vh;}
	.header_content .row .m6 { height: 100%;}
	.intro div:nth-child(1):hover{
		background-image: url('/assets/img/intro_content02_on.jpg?<?=rand()?>') !important;
	}
	.intro div:nth-child(2):hover{
		background-image: url('/assets/img/intro_content01_on.jpg?<?=rand()?>') !important;
	}
	.intro div:nth-child(3):hover{
		background-image: url('/assets/img/intro_content03_on.jpg?<?=rand()?>') !important;
	}
	.tab_wrap .tabs .tab { height: 50px;}
	
	#popup_area{position: absolute; top: 30px; right: 100px; z-index: 1000; width: 440px;}
	#popup_area .popup_layer{ position:relative}
	#popup_area .imgBox img{ display:block}
	#popup_area2{position: absolute; top: 30px; right: 550px; z-index: 1000; width: 440px;}
	#popup_area2 .popup_layer{ position:relative}
	#popup_area2 .imgBox img{ display:block}
</style>

<div id="popup_area">
	<script>
    function closeWin01(){
        document.all['popup01'].style.visibility = "hidden";
    }
    function setCookie01( name, value, expiredays ) {
        var todayDate = new Date();
        todayDate.setDate( todayDate.getDate() + expiredays );
        document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
    }
    function closeTodayWin01() {
        if ( document.formPopup01.chkbox ){
            setCookie01( "popup01", "done" , 1 );
        }
        document.all['popup01'].style.visibility = "hidden";
    }
    cookiedata = document.cookie;
    if ( cookiedata.indexOf("popup01=done") < 0 ){
        document.all['popup01'].style.visibility = "visible";
    } else {
        document.all['popup01'].style.visibility = "hidden";
    }
    </script>
    
    <div id="popup01" class="popup_layer" style="margin-top:5px">
        <div id="eventpop01">
            <div id="theLayer01">
                <div>
                    <a href="javascript:closeWin01();">
                        <div style="position:absolute; right:10px; top:10px; width:35px; height:35px; "><img src="/assets/img/pop/X_w.png" style="width:100%;" alt=""></div>
                    </a>
                    <a href="/Why_bioface/Why_bioface" class="imgBox">
                        <img src="/assets/img/pop/popup_why_190813.jpg?<?=rand()?>" border="0" style="width: 100%;">
                    </a>
                </div>
                <!--<div style="position:absolute; z-index: 14; float:left; right:4%; bottom:12px;">
                    <form name="formPopup01">
                        <input type="hidden" name='chkbox' value="checkbox"><a href="javascript:closeTodayWin01();" onfocus="this.blur();"><img src="/assets/img/pop/todayend_w.png" border="0"></a>
                    </form>
                </div>-->
            </div>
        </div>
    </div>
    
        
    <script>
    function closeWin02(){
        document.all['popup02'].style.visibility = "hidden";
    }
    function setCookie02( name, value, expiredays ) {
        var todayDate = new Date();
        todayDate.setDate( todayDate.getDate() + expiredays );
        document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
    }
    function closeTodayWin02() {
        if ( document.formPopup02.chkbox ){
            setCookie02( "popup02", "done" , 1 );
        }
        document.all['popup02'].style.visibility = "hidden";
    }
    cookiedata = document.cookie;
    if ( cookiedata.indexOf("popup02=done") < 0 ){
        document.all['popup02'].style.visibility = "visible";
    } else {
        document.all['popup02'].style.visibility = "hidden";
    }
    </script>
    
      <div id="popup02" class="popup_layer" style="margin-top:5px">
        <div id="eventpop02">
        
          <div id="theLayer02">
            <div>
              <a href="javascript:closeWin02();">
              <div style="position:absolute; right:10px; top:10px; width:35px; height:35px; "><img src="/assets/img/pop/X_w.png" style="width:100%;" alt=""></div></a>
              <a href="/board/lists/event_kor/1" class="imgBox">
                <img src="/assets/img/pop/popup_200731.jpg?<?=rand()?>" border="0" style="width: 100%;">
              </a>
            </div>
            <!--<div style="position:absolute; z-index: 14; float:left; right:4%; bottom:12px;">
              <form name="formPopup02">
                <input type="hidden" name='chkbox' value="checkbox"><a href="javascript:closeTodayWin02();" onfocus="this.blur();"><img src="/assets/img/pop/todayend.png" border="0"></a>
              </form>
            </div>-->
          </div>
    
        </div>
      </div>
    
    
    
        <script>
        function closeWin03(){
          document.all['popup03'].style.visibility = "hidden";
        }
        function setCookie03( name, value, expiredays ) {
         var todayDate = new Date();
          todayDate.setDate( todayDate.getDate() + expiredays );
          document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
         }
    
        function closeTodayWin03() {
          if ( document.formPopup03.chkbox ){
           setCookie03( "popup03", "done" , 1 );
          }
        document.all['popup03'].style.visibility = "hidden";
       }
       cookiedata = document.cookie;
        if ( cookiedata.indexOf("popup03=done") < 0 ){
        document.all['popup03'].style.visibility = "visible";
        }
        else {
        document.all['popup03'].style.visibility = "hidden";
        }
      </script>
    
    <div id="popup03" class="popup_layer" style="margin-top:5px">
        <div id="eventpop03">
            <div id="theLayer03">
                <div>
                    <a href="javascript:closeWin03();">
                    	<div style="position:absolute; right:10px; top:10px; width:35px; height:35px; "><img src="/assets/img/pop/X_w.png" style="width:100%;" alt=""></div>
                    </a>
                    <a href="/board/lists/promotion/1" class="imgBox">
                        <img src="/assets/img/pop/popup_promotion_200723.jpg?<?=rand()?>" border="0" style="width: 100%;">
                    </a>
                </div>
            
            </div>
        </div>
    </div>
    
    <script>
    function closeWin04(){
        document.all['popup04'].style.visibility = "hidden";
    }
    function setCookie04( name, value, expiredays ) {
        var todayDate = new Date();
        todayDate.setDate( todayDate.getDate() + expiredays );
        document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
    }
    function closeTodayWin04() {
        if ( document.formPopup04.chkbox ){
            setCookie04( "popup04", "done" , 1 );
        }
        document.all['popup04'].style.visibility = "hidden";
    }
    cookiedata = document.cookie;
    if ( cookiedata.indexOf("popup04=done") < 0 ){
        document.all['popup04'].style.visibility = "visible";
    } else {
        document.all['popup04'].style.visibility = "hidden";
    }
    </script>
    
    <div id="popup04" class="popup_layer" style="margin-top:5px">
        <div id="eventpop04">
            <div id="theLayer04">
                <div>
                    <a href="javascript:closeWin04();">
                        <div style="position:absolute; right:10px; top:10px; width:35px; height:35px;"><img src="/assets/img/pop/X.png" style="width:100%;" alt=""></div>
                    </a>
                    <a href="/board/lists/exhibitions/1" class="imgBox">
                        <img src="/assets/img/pop/popup_men_200723.jpg?<?=rand()?>" border="0" style="width: 100%;">
                    </a>
                </div>
                <!--<div style="position:absolute; z-index: 14; float:left; right:4%; bottom:12px;">
                    <form name="formPopup04">
                        <input type="hidden" name='chkbox' value="checkbox"><a href="javascript:closeTodayWin04();" onfocus="this.blur();"><img src="/assets/img/pop/todayend_w.png" border="0"></a>
                    </form>
                </div>-->
            </div>
        </div>
    </div>
</div>

<div id="popup_area2">
	<script>
    function closeWin05(){
        document.all['popup05'].style.visibility = "hidden";
    }
    function setCookie05( name, value, expiredays ) {
        var todayDate = new Date();
        todayDate.setDate( todayDate.getDate() + expiredays );
        document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
    }
    function closeTodayWin05() {
        if ( document.formPopup05.chkbox ){
            setCookie05( "popup05", "done" , 1 );
        }
        document.all['popup05'].style.visibility = "hidden";
    }
    cookiedata = document.cookie;
    if ( cookiedata.indexOf("popup05=done") < 0 ){
        document.all['popup05'].style.visibility = "visible";
    } else {
        document.all['popup05'].style.visibility = "hidden";
    }
    </script>
    
	<div id="popup05" class="popup_layer" style="margin-top:5px">
        <div id="eventpop05">
            <div id="theLayer05">
                <div>
                    <a href="javascript:closeWin05();">
                        <div style="position:absolute; right:10px; top:10px; width:35px; height:35px;"><img src="/assets/img/pop/X.png" style="width:100%;" alt=""></div>
                    </a>
                    <a href="/AboutUs/treatment_guide#notice_corona_location" class="imgBox">
                        <img src="/assets/img/pop/popup_corona_200226.jpg?<?=rand()?>" border="0" style="width: 100%;">
                    </a>
                </div>
                <!--<div style="position:absolute; z-index: 14; float:left; right:4%; bottom:12px;">
                    <form name="formPopup04">
                        <input type="hidden" name='chkbox' value="checkbox"><a href="javascript:closeTodayWin04();" onfocus="this.blur();"><img src="/assets/img/pop/todayend_w.png" border="0"></a>
                    </form>
                </div>-->
            </div>
        </div>
    </div>
    
    <script>
    function closeWin06(){
        document.all['popup06'].style.visibility = "hidden";
    }
    function setCookie06( name, value, expiredays ) {
        var todayDate = new Date();
        todayDate.setDate( todayDate.getDate() + expiredays );
        document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
    }
    function closeTodayWin06() {
        if ( document.formPopup06.chkbox ){
            setCookie06( "popup06", "done" , 1 );
        }
        document.all['popup06'].style.visibility = "hidden";
    }
    cookiedata = document.cookie;
    if ( cookiedata.indexOf("popup06=done") < 0 ){
        document.all['popup06'].style.visibility = "visible";
    } else {
        document.all['popup06'].style.visibility = "hidden";
    }
    </script>
    
	<div id="popup06" class="popup_layer" style="margin-top:5px">
        <div id="eventpop06">
            <div id="theLayer06">
                <div>
                    <a href="javascript:closeWin06();">
                        <div style="position:absolute; right:10px; top:10px; width:35px; height:35px;"><img src="/assets/img/pop/X.png" style="width:100%;" alt=""></div>
                    </a>
                    <a href="/Eventmodel/Eventmodel" class="imgBox">
                        <img src="/assets/img/pop/popup_model_200311.jpg?<?=rand()?>" border="0" style="width: 100%;">
                    </a>
                </div>
                <!--<div style="position:absolute; z-index: 14; float:left; right:4%; bottom:12px;">
                    <form name="formPopup04">
                        <input type="hidden" name='chkbox' value="checkbox"><a href="javascript:closeTodayWin04();" onfocus="this.blur();"><img src="/assets/img/pop/todayend_w.png" border="0"></a>
                    </form>
                </div>-->
            </div>
        </div>
    </div>
</div>


<div class="main_wrap">
	<div class="main_swiper_wrap">
<!-- 		<div class="event">
			<h3 class="lh_50 f_white align_left">
				<span class="en_bold">BIOFACE<br>Special<br>Promotion<br><span class="lh_100">Ⅰ - Ⅰ</span></span><br>
				<input type="button" name="bio_special_pro_detail" id="bio_special_pro_btn" value="자세히보기" onclick="shurink();">
			</h3>
		</div>

		<div class="event2">
			<h3 class="lh_50 f_white align_left">
				<span class="en_bold">BIOFACE<br>Special<br>Promotion<br><span class="lh_100">Ⅰ - Ⅱ</span></span><br>
				<input type="button" name="bio_special_pro_detail" id="bio_special_pro_btn" value="자세히보기" onclick="rijuran();">
				
			</h3>
		</div> -->

		<div style="position: absolute; width: 94%;
		height: 77vh; z-index: 998; left: 3%; top: 7%;" class="main_link"></div>
		<div class="main_innerContainer" style="min-width: 1120px;">
			<div class="border borderh" id="borderTopBar"></div>
			<div class="border borderv" id="borderLeftBar01"></div>
			<div class="border borderv" id="borderLeftBar02"></div>
			<div class="border borderv" id="borderRightBar"></div>
			<div class="border borderh" id="borderBottomBar01"></div>
			<div class="border borderh" id="borderBottomBar02"></div>
			<div class="scroll">
				<em class="ko_bold">SCROLL</em>
				<div class="inner">
					<i></i>
				</div>
			</div>

			<ul class="sns">
				<li><a href="https://www.facebook.com/biofacesinsa/" target="_blank"><img src="/assets/img/facebook.png" alt="페이스북"></a></li>
				<li><a href="https://www.instagram.com/bioface_clinic/" target="_blank"><img src="/assets/img/insta.png" alt="인스타"></a></li>
				<li><a href="https://blog.naver.com/suwoni" target="_blank" class="blog"><img src="/assets/img/blog.png" alt="블로그"></a></li>
                <li><a href="https://pf.kakao.com/_xaiCuxd/" target="_blank"><img src="/assets/img/kakao.png" alt="카카오톡"></a></li>
				<!--<li><a href="https://www.youtube.com/channel/UCuitF5ApGjfZ5q3HPjPSUNw" target="_blank"><img src="/assets/img/utube.png" alt="유투브"></a></li>-->
			</ul>
			<ul class="top_icon">
				<?if(isset($_SESSION['id'])){?>
					<li style="float: left; margin-right: 10px;"><a href="/auth/modify" target="_self"><img src="/assets/img/login.png" alt="로그아웃"></a></li>
				<?} else {?>
					<li style="float: left; margin-right: 10px;"><a href="/auth/login" target="_self" onclick="confirm_login()"><img src="/assets/img/login.png" alt="로그인"></a></li>
				<?}?>
				<li><a href="#" target="_blank"><img src="/assets/img/consult.png" alt="상담" class="js-c-open"></a></li>
			</ul>

		</div>

		<!-- Swiper -->
		<div class="swiper-container" style="width: 100%; height: 100%;">
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<img src="/assets/img/main01.jpg?<?=rand()?>">
					<div class="mainSwiper_info" style="left:5%; bottom: 10%;">
						<h3 class="lh_60 f_white">
							당신의 <span class="main_f_color">삶에 활력</span>이 넘칠 때까지-<Br>
							<span class="en_bold main_f_color fs_15 f_bold lh_100">-ing</span><br>
							우리는 당신을 위해 <span class="en_bold">-ing</span>합니다.<br>
							우리는 당신을 위해 연구합니다.
						</h3>
					</div>
				</div>
				<div class="swiper-slide">
					<img src="/assets/img/main02.jpg?<?=rand()?>">
					<div class="mainSwiper_info" style="right: 10%; top: 20%;">
						<h5 class="lh_40 f_white align_right">
							<span class="fs_12">필러 연구의 - <span class="en_bold">ing</span></span><br>
							<span class="en_bold main_f_color fs_20 lh_60">Top Of Filler<br>T.O.Fill</span><br>
							오래도록 지지 않는<br>
							아름다움이 될 수 있도록 -<br><br>
							히알루론산과 동종진피의 결합으로<br>
							3년 이상 오래가는 히알루론산 필러<br>
							<span class="main_f_color">티오필</span>
						</h5>
					</div>
				</div>
				<div class="swiper-slide">
					<img src="/assets/img/main03.jpg?<?=rand()?>">
					<div class="mainSwiper_info" style="left: 10%; top: 20%;">
						<h5 class="lh_40 f_white align_left">
							<span class="fs_12">리프팅 연구의 - <span class="en_bold">ing</span></span><br>
							<span class="en_bold main_f_color fs_20 lh_60">Ponytail<br>Lifting</span><br>
							볼륨재배치가 가능한 리프팅 -<br><br>
							<span class="main_f_color f_underline">이중턱 살을</span> 실로 끌어올려 이마 볼륨으로<br>
							만드는 "마법"같은 리프팅,<br>
							<span class="main_f_color">포니테일리프팅</span>
						</h5>
					</div>
				</div>
				<div class="swiper-slide">
					<img src="/assets/img/main04.jpg?<?=rand()?>">
					<div class="mainSwiper_info" style="right: 10%; top:30%;">
						<h5 class="lh_40 f_white align_right">
							<span class="fs_12">보톡스 연구의 - <span class="en_bold">ing</span></span><br>
							<span class="en_bold main_f_color fs_20 lh_60">Liftox</span><br>
							넘을 수 없는 보톡스 기술의 정점,<br>
							리프팅 되는 보톡스 -<br><br>
							근육 수축 억제 작용은 물론,<br>
							진피, 표피층에 탄력증대 효과까지<br>
							더한<span class="main_f_color">리프톡스</span>
						</h5>
					</div>
				</div>
				<div class="swiper-slide">
					<img src="/assets/img/main05.jpg?<?=rand()?>">
					<div class="mainSwiper_info" style="left: 10%; top: 20%;">
						<h5 class="lh_40 f_white align_left">
							<span class="fs_12">다이어트 연구의 - <span class="en_bold">ing</span></span><br>
							<span class="en_bold main_f_color fs_20 lh_60">NMT<br>Diet</span><br>
							지금까지 없었던 다이어트의 새로운 패러다임 -<br><br>
							체중감량 확실한 뇌 피트니스와<br>
							예쁜 라인 개선을 위한 피스토주사의 결합,<br>
							<span class="main_f_color">NMT다이어트</span>
						</h5>
					</div>
				</div>
				<!-- 슈링크 -->
				<!-- <div class="swiper-slide">
					<img src="/assets/img/main06.jpg?<?=rand()?>">
					<div class="mainSwiper_info" style="right: 10%; bottom: 5%;">
						<h3 class="lh_50 f_white align_right">
							<span class="en_bold">SHURINK<br>LIFTING<br></span>
							<span class="fs_5">슈링크리프팅</span><br>
							<hr style="width: 100%; border: 1px solid #fff; margin: 40px 0;">
							<span class="main_f_color">100샷<br>59,000원</span>
						</h3>
					</div>
					
				</div> -->
				<!-- 리쥬란 -->
				<!-- <div class="swiper-slide">
					<img src="/assets/img/main07.jpg?<?=rand()?>">
					<div class="mainSwiper_info" style="right: 10%; bottom: 5%;">
						<h3 class="lh_50 f_white align_right">
							<span class="en_bold">REJURAN<br>HEALER<br></span>
							<span class="fs_5">리쥬란힐러</span><br>
							<hr style="width: 100%; border: 1px solid #fff; margin: 40px 0;">
							<span class="main_f_color">1cc<br>110,000원</span>
						</h3>
					</div>
				</div> -->

			</div>
		</div>
	</div>
	<div class="main_swiper_bottom main_color" id="main_swiper_bottom">
		
		<ul class="f_white">
			<li><img src="/assets/img/header_logo.png" style="margin-top: 10px;"></li>
			<li><a href="/board/lists/online_kor/1" class="counseling_btn" style="padding: 10px 15px;">상담신청</a></li>
			<li>
				<img src="/assets/img/time_icon.png" class="main_icon">
				평&nbsp;&nbsp;&nbsp;&nbsp;일 AM 10:30 ~ PM 09:00&nbsp;&nbsp;&nbsp;&nbsp;<br>토요일 : AM 10:30 ~ PM 05:00</li>
			<li>
				<img src="/assets/img/map_icon.png" class="main_icon">
				서울 특별시 강남구 강남대로 152길 22(신사동)<br>신사역 8번 출구
			</li>
			<li class="counseling_btn"><i class="material-icons fs_10">phone</i>1833-8838</li>
		</ul>
	</div>
</div>

<div class="header header_wrap bg_black" id="myHeader">
	<ul class="f_white">
		<a href=""><img src="/assets/img/header_logo.png" style="position: absolute; left: 7%; top: 20%;width: 100px;"></a>
        <a href="/Why_bioface/Why_bioface" style="font-size:1.2rem; padding:0 30px">Why BIOFACE</a>
		<li>About Us</li>
		<li>리프팅</li>
		<li>비만클리닉</li>
		<li>바디필러</li>
		<!-- <li>쁘띠/피부</li> -->
		<li>커뮤니티</li>
	</ul>
	
	<div class="header_content">
		<div class="row aboutUs">
			<div class="col m6">
				<div class="header_img">
					<img src="/assets/img/header01.jpg?<?=rand()?>" style="">
				</div>
			</div>
			<div class="col m6">
				<li><a href="/Why_bioface/Why_bioface">비오페이스 소개</a></li>
				<li><a href="/AboutUs/doctor_intro">의료진소개</a></li>
				<li><a href="/AboutUs/treatment_guide">진료안내</a></li>
				<li><a href="/AboutUs/treatment_guide">찾아오시는 길</a></li>
				<li><a href="/board/lists/star_kor/1">with star</a></li>
			</div>
		</div>
		<div class="row lifting">
			<div class="col m6">
				<div class="header_img">
					<img src="/assets/img/header02.jpg?<?=rand()?>" style="">
				</div>
			</div>
			<div class="col m6" style="padding: 30px 0;">
				<div class="col m5" style="width: 50%;">
					<!-- <li><a href="/not_ready">BIO What's Lifting</a></li> -->
					<li><a href="/Lifting/tof">티오필</a></li>
					<li><a href="/Lifting/ponytail">포니테일리프팅</a></li>
					<li><a href="/Lifting/liftox">리프톡스</a></li>
					<li><a href="/Lifting/shurink">슈링크</a></li>
					<li><a href="/Lifting/rijuran">리쥬란힐러</a></li>
				</div>
				<div class="col m5" style="width: 50%;">
					<li><a href="/Lifting/new_thera">뉴테라</a></li>
					<li><a href="/Lifting/duet_thermage">듀엣써마지</a></li>
				</div>
			</div>
		</div>
		<div class="row obesity">
			<div class="col m6">
				<div class="header_img">
					<img src="/assets/img/header03.gif" style="">
				</div>
			</div>
			<div class="col m6">
				<li><a href="/Obesity_clinic/M_NMTdiet"><big><b>NMT</b></big> 다이어트</a></li>
				<li><a href="/Obesity_clinic/M_NMTbrain"><big><b>NMT</b></big> 뇌피트니스</a></li>
				<li><a href="/Obesity_clinic/M_NMTpisto"><big><b>NMT</b></big> 피스토주사</a></li>
				<li><a href="/Obesity_clinic/M_beforeAfter_pic">전후사진</a></li>
			</div>
		</div>
		<div class="row body">
			<div class="col m6">
				<div class="header_img">
					<img src="/assets/img/header04.jpg?<?=rand()?>" style="">
				</div>
			</div>
			<div class="col m6">
				<li><a href="/Body_filler/pelvis_filler">골반필러</a></li>
				<li><a href="/Body_filler/hipup_filler">힙업필러</a></li>
				<li><a href="/Body_filler/leg_filler">휜다리교정필러</a></li>
			</div>
		</div>
		<!-- <div class="row petitSkin">
			<div class="col m6">
				<div class="header_img">
					<img src="/assets/img/header05.jpg?<?=rand()?>" style="">
				</div>
			</div>
			<div class="col m6" style="padding: 30px 0;">
				<div class="col m5" style="width: 50%;">
					<li><a href="/not_ready">부위 별 필러</a></li>
					<li><a href="/not_ready">보톡스</a></li>
					<li><a href="/not_ready">오아시스토닝</a></li>
					<li><a href="/not_ready">탄력케어</a></li>
					<li><a href="/not_ready">여드름케어</a></li>
					<li><a href="/not_ready">모공케어</a></li>
				</div>
				<div class="col m5" style="width: 50%;">
					<li><a href="/not_ready">OXYCRYO</a></li>
					<li><a href="/not_ready">미백·수분케어</a></li>
				</div>
			</div>
		</div> -->
		<div class="row body">
			<div class="col m6">
				<div class="header_img">
					<img src="/assets/img/header06.jpg?<?=rand()?>" style="">
				</div>
			</div>
			<div class="col m6" style="padding:30px 0">
				<!-- <li><a href="/not_ready">셀카존</a></li>
				<li><a href="/not_ready">전후사진</a></li> -->
                <div class="col m5" style="width: 50%;">
					<li><a href="/board/lists/selfie_kor/1">리얼셀피리뷰</a></li>
                    <li><a href="/board/lists/filler_review_kor/1">의료진리뷰</a></li>
                    <li><a href="/board/lists/event_kor/1">이벤트</a></li>
                    <li><a href="/board/lists/promotion/1">프로모션</a></li>
                    <li><a href="/board/lists/exhibitions/1">기획전</a></li>
				</div>
				<div class="col m5" style="width: 50%;">
					<li><a href="/board/lists/online_kor/1">온라인상담</a></li>
				<li><a href="/board/lists/after/1">자필후기</a></li>
				<li><a href="/Eventmodel/Eventmodel">모델모집</a></li>
                <? if ($this->session->userdata('level')==10) {?>
                    <li><a href="/board/lists/quick_kor/1">빠른상담</a></li>
                <? } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="intro_wrap" style="margin-bottom: -10px;">
	<!-- <div class="row" style="position: relative;">
		<div class="intro">
			<div class="col m4 s12" style="background-image: url('/assets/img/intro_content02.jpg?<?=rand()?>'); background-position: center; background-repeat: no-repeat;">
				<h5 class="f_white align_center lh_45" style="padding: 220px 0;">
					<span class="fs_20"><span class="en_bold">Dr</span>.박주영</span><br><br>
					풍부한 임상경험과<br>디자인 이미지 연구
				</h5>
				<h5 class="ko_light align_right lh_50" style="position: relative; top: 10%; display: none;">
					풍부한 임상경험과 디자인,<br>
					시술 프로토콜 연구<br><br><br>
					아름다운 결과를 만드는 <span class="fs_12 ko_bold">시술<br>
					방법들을 연구함</span>에 있어<br>
					근거를 가지고 안전하며, 실패하지 않는<br>
					<span class="fs_12 ko_bold">자연스러운 결과를</span> 내는 것이<br>
					저의 소명입니다.
				</h5>
			</div>
			<div class="col m4 s12" style="background-image: url('/assets/img/intro_content01.jpg?<?=rand()?>'); background-position: center; background-repeat: no-repeat;">
				<h5 class="f_white align_center lh_60" style="padding: 200px 0;">
					<span class="en_bold fs_25">-Ing</span><br>
					당신의 삶의 질을 향상시키는<br>Anti-Ag<span class="f_bold fs_15">ing</span> 기술<br>
					비오페이스
				</h5>
				<h4 class="ko_light align_center" style="position: relative; top: 12%; line-height: 1.1em; display: none;">
					한 가지 시술로 한 가지<br>
					효과만 볼 수 있다는 편견,<br>
					<span class="fs_12 lh_100">그래서  <span class="en_bold main_f_color">-ing</span> 합니다.</span><br><br><br>
					비오페이스는 <span class="en_bold">-ing</span>시술을 연구합니다.<br><br>
					<span class="en_bold">Lifting<br>Slimming<br>Voluming</span>
				</h4>
			</div>
			<div class="col m4 s12" style="background-image: url('/assets/img/intro_content03.jpg?<?=rand()?>'); background-position: center; background-repeat: no-repeat;">
				<h5 class="f_white align_center lh_45" style="padding: 220px 0;">
					<span class="fs_20"><span class="en_bold">Dr</span>.이동한</span><br><br>
					비만 프로그램과<br>지방분해주사 연구
				</h5>
				<h5 class="ko_light align_left lh_50" style="position: relative; top: 10%; display: none;">
					비만 프로그램과<br>
					지방분해주사 연구<br><br><br>
					관심과 위로, 멘탈리티의<br>
					관리 동반자로서<br>
					인생 전반의 <span class="fs_12 ko_bold">균형 잡힌 건강한 삶</span>이<br>
					완성되도록<br>
					도와주고 싶습니다.
				</h5>
			</div>
		</div>
	</div> -->

	<img src="/assets/img/main_sec2_200304.jpg" style="width: 100%;">
</div>



<div class="f_white main_color" style="width: 100%; padding: 90px 0;">
	<h3 class="align_center lh_60 ko_light" style="margin: 0;">
		<span class="ko_bold">확인해보세요</span><br>
		비오페이스에서 걸어온 꾸준한 연구의 길.
	</h3>
</div>

<div class="research_wrap" style="width: 100%;">
	<div class="row" style=" position: relative;">
		<div class="swiper-container3" style="overflow: hidden;">
			<div class="swiper-wrapper" style="padding: 80px 100px;">
				<div class="swiper-slide">
					<div class="col m6 s12">
						<img src="/assets/img/research01.png" style="width: 70%;">
					</div>
					<div class="col m6 s12">
						<h3 class="lh_40">
							<span class="en_bold main_f_color fs_12">INNOVATION - ing</span><br>
							<span class="ko_bold fs_7">필러, 리프팅, 보톡스 시술의 연구</span><br><br>

							<span class="ko_light fs_5 lh_30">
								비오페이스에서는 필러 주입의 방법, 볼륨 리프팅이 <span class="ko_bold main_f_color">동시에</span><br>
								가능한 리프팅 시술 연구, 획일적인 보톡스 시술의 단점 보완 등<br>
								다양한 연구 사항으로 100%에 가까운 만족도를<br>
								위해 노력합니다.
							</span>

						</h3>
					</div>
				</div>
				<div class="swiper-slide">
					<div class="col m6 s12">
						<img src="/assets/img/research02.png" style="width: 70%;">
					</div>
					<div class="col m6 s12">
						<h3 class="lh_40">
							<span class="en_bold main_f_color fs_12">INNOVATION - ing</span><br>
							<span class="ko_bold fs_7">철저한 안전시스템</span><br><br>

							<span class="ko_light fs_5 lh_30">
								비오페이스에서는 염증과 감염을 막는 "클린벤치"의 사용과<br>
								가장 깨끗한 히알루론산, 캐뉼라 등의 시스템으로 환자에게<br>
								더욱 안전한 시술을 진행하고 있습니다.
							</span>

						</h3>
					</div>
				</div>
				<div class="swiper-slide">
					<div class="col m6 s12">
						<img src="/assets/img/research03.png" style="width: 70%; margin-top: 0">
					</div>
					<div class="col m6 s12">
						<h3 class="lh_40">
							<span class="en_bold main_f_color fs_12">INNOVATION - ing</span><br>
							<span class="ko_bold fs_7">다양한 임상과 연구 의료진</span><br><br>

							<span class="ko_light fs_5 lh_30">
								비오페이스에서는 필러, 리프팅, 보톡스, 비만관리 등의<br>
								다양한 임상과 연구를 진행하는 의료진들과 구성되어<br>
								기존 시술들의 단점은 보완하고 <span class="ko_bold main_f_color">장점을 최대한</span> 살린<br>
								시술을 집도합니다.
							</span>

						</h3>
					</div>
				</div>
			</div>
			
			
			
			<div class="swiper-button-next3"></div>
			<div class="swiper-button-prev3"></div>
		</div>
		<img src="/assets/img/before_btn.png" style="position: absolute; bottom: 20%; right: 15%;" class="before_btn">
		<img src="/assets/img/next_btn.png" style="position: absolute; bottom: 20%; right:10%;" class="next_btn">
</div>

<div class="beforeAfter_wrap">
	<div class="beforeAfter_title main_f_color bg_white align_center">
		<h3 class="en_bold lh_15">Photo Gallery</h3>
	</div>
	
	<div class="row tab_wrap">
		<div style="display: block; width: 80%; margin: 0 auto; max-width: 700px;">
			<ul class="tabs" style="background-color: #f1f1f1">
				<li class="tab"><a href="#tab_content05" class="active" style="line-height: 20px; padding-top: 5px;">NMT<br>다이어트</a></li>
				<li class="tab"><a href="#tab_content01">필러</a></li>
				<li class="tab"><a href="#tab_content02">리프팅</a></li>
				<li class="tab"><a href="#tab_content03">보톡스</a></li>
				<li class="tab"><a href="#tab_content04">바디필러</a></li>
			</ul>
		</div>
		<div style="display: block; width: 80%; margin: 0 auto; max-width: 700px;">
			<ul class="tabs_info align_center">
				<li class="f_black">피스토주사</li>
				<li>티오필<br>풀페이스필러</li>
				<li>포니테일리프팅</li>
				<li>턱 리프톡스</li>
				<li>골반필러</li>
			</ul>
		</div>

		<div class="tab_content_wrap">
			<div id="tab_content01" class="col s12">
				<img src="/assets/img/beforeafter01.jpg?<?=rand()?>">
			</div>
			<div id="tab_content02" class="col s12">
				<img src="/assets/img/beforeafter02.jpg?<?=rand()?>">
			</div>
			<div id="tab_content03" class="col s12">
				<img src="/assets/img/beforeafter03.jpg?<?=rand()?>">
			</div>
			<div id="tab_content04" class="col s12">
				<img src="/assets/img/beforeafter04.jpg?<?=rand()?>">
			</div>
			<div id="tab_content05" class="col s12">
				<img src="/assets/img/beforeafter05.jpg?<?=rand()?>">
			</div>
		</div>
	</div>
	<div class="ko_light" style="display: block; width: 50%; margin-bottom: 20px; color: #CDC9C8; margin: 0 auto;">※ 본 이미지는 촬영 조건에 따라 실물과 다르게 보일 수 있으며, 환자 본인의 동의를 얻어 촬영 후 게재하였습니다.</div><br>
	<div class="beforeAfter_btn bg_black f_white"><a href="/not_ready" style="color: #fff;">더보기 ></a></div>
</div>

<div class="video" style="padding: 100px 0; text-align: center; max-width: 900px; margin: 0 auto; width: 80%;">
	<div class="row">
		<div class="col m6 s12 main_color" style="width: 80%; max-width: 450px; height: 350px; padding: 0">
			<iframe src="http://www.youtube.com/embed/WRdRyBR9GRc" class="video" frameborder="0" style="max-width:100%; width:100%; height: 100%;" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
		</div>
		<div class="col m6 s12" style="padding: 80px 0;">
			<h5>
				<span class="ko_bold main_f_color">비오페이스에서의 </span>놀라운 순간들을<br>
				지금 바로 영상으로<br>
				만나보세요~<br><br>
				<div class="f_white main_color" style="padding: 10px 20px; border-radius: 20px; font-size: 0.8em; outline: none; width: 200px; margin: 0 auto;">
					<a href="https://www.youtube.com/watch?v=WRdRyBR9GRc" style="color: #fff;">영상 바로가기 ></a>
				</div>
			</h5>
		</div>
	</div>
</div>

<script src="/assets/js/swiper.min.js" charset="utf-8"></script>
<script type="text/javascript" src="/assets/js/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.4/TweenMax.min.js"></script>
