<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
	// PC
	header("Location: http://bioface.kr/");
} else {
	//MOBILE
}
?>
<style>
	div { display: block; max-width: 640px; margin: 0 auto;}

	.main_innerContainer .top_icon {width: 40px;}
	.intro_wrap .row .m12 { height: 30vh;}
	.swiper-container4 {max-width: 180px;  overflow: hidden; height: 340px;}
	#main_swiper_bottom ul li {height: 0vh;}
	.beforeAfter_btn { height: 50px; border: none;}
	.tab_content_wrap {padding: 0;}
	.tab_wrap .tabs {max-width: 180px;}
	.tab_wrap .tabs .tab.col.s12 { height: auto; background-color: #f1f1f1}
	.tabs_info li { width: 100%; background-color: #f1f1f1; display: none;}
	.tab_wrap .tabs .tab.col.s12 { margin-bottom: 10px;}
	.tab_wrap .tabs .tab.col.s12 ul { margin: 0;}
	.tabs .tab a { color: #AA0010 !important;}
	.certifi_info2 h6 {left: 45px; text-align: center;}
	.certifi_wrap { height: 180vh;}
	.swiper-container .swiper-wrapper .swiper-slide img { height: 100%; min-width: 120%; height: auto;}
	.swiper-container4 .swiper-slide {width: 180px; height: 340px;}
	.swiper-container4 .swiper-wrapper .swiper-slide img {min-height: 100px; width: 100%; height: auto;}
	.swiper-container2 .swiper-wrapper .swiper-slide img { width: 100%;}
	.certifi_info2 {padding: 200px 0;}
	.event, .event2 { position: absolute; left: 15%; top: 5%; z-index: 999; display: none;}
	footer { max-width: 640px;}
	.popup-select__tit { margin-top: 0 !important;}
	
	#popup_area{position: absolute; top: 20px; left: 50%; z-index: 99999; transform: translate(-50%); width: 90%; max-width: 350px;}
	#popup_area .popup_layer{ position:relative}
	#popup_area .imgBox img{ display:block}
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
    
    <div id="popup01" class="popup_layer">
        <div id="eventpop01">
            <div id="theLayer01">
                <div>
                    <a href="javascript:closeWin01();">
                        <div style="position:absolute; right:5px; top:5px; width:30px; height:30px;"><img src="/assets/img/pop/X_w.png" style="width:100%;" alt=""></div>
                    </a>
                    <a href="/Why_bioface/Why_bioface" class="imgBox">
                        <img src="/assets/img/pop/popup_why_190813_m.jpg?<?=rand()?>" border="0" style="width: 100%;">
                    </a>
                </div>
                <!--<div style="position:absolute; z-index: 14; float:left; right:2%; bottom:2px;">
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
              <div style="position:absolute; right:5px; top:5px; width:30px; height:30px;"><img src="/assets/img/pop/X_w.png" style="width:100%;" alt=""></div></a>
              <a href="/board/lists/event_kor/1" class="imgBox">
                <img src="/assets/img/pop/popup_200731.jpg?<?=rand()?>" border="0" style="width: 100%;">
              </a>
            </div>
            <!--<div style="position:absolute; z-index: 14; float:left; right:2%; bottom:2px;">
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
                    	<div style="position:absolute; right:5px; top:5px; width:30px; height:30px;"><img src="/assets/img/pop/X_w.png" style="width:100%;" alt=""></div>
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
                        <div style="position:absolute; right:5px; top:5px; width:30px; height:30px;"><img src="/assets/img/pop/X.png" style="width:100%;" alt=""></div>
                    </a>
                    <a href="/board/lists/exhibitions/1" class="imgBox">
                    	<img src="/assets/img/pop/popup_men_200723.jpg?<?=rand()?>" border="0" style="width: 100%;">
                    </a>
                </div>
                <!--<div style="position:absolute; z-index: 14; float:left; right:2%; bottom:2px;">
                    <form name="formPopup04">
                        <input type="hidden" name='chkbox' value="checkbox"><a href="javascript:closeTodayWin04();" onfocus="this.blur();"><img src="/assets/img/pop/todayend_w.png" border="0"></a>
                    </form>
                </div>-->
            </div>
        </div>
    </div>
    
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
                        <div style="position:absolute; right:5px; top:5px; width:30px; height:30px;"><img src="/assets/img/pop/X.png" style="width:100%;" alt=""></div>
                    </a>
                    <a href="/AboutUs/treatment_guide#notice_corona_location" class="imgBox">
                    	<img src="/assets/img/pop/popup_corona_200226.jpg?<?=rand()?>" border="0" style="width: 100%;">
                    </a>
                </div>
                <!--<div style="position:absolute; z-index: 14; float:left; right:2%; bottom:2px;">
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
            setCookie05( "popup06", "done" , 1 );
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
                        <div style="position:absolute; right:5px; top:5px; width:30px; height:30px;"><img src="/assets/img/pop/X.png" style="width:100%;" alt=""></div>
                    </a>
                    <a href="/Eventmodel/M_Eventmodel" class="imgBox">
                    	<img src="/assets/img/pop/popup_model_200311.jpg?<?=rand()?>" border="0" style="width: 100%;">
                    </a>
                </div>
                <!--<div style="position:absolute; z-index: 14; float:left; right:2%; bottom:2px;">
                    <form name="formPopup04">
                        <input type="hidden" name='chkbox' value="checkbox"><a href="javascript:closeTodayWin04();" onfocus="this.blur();"><img src="/assets/img/pop/todayend_w.png" border="0"></a>
                    </form>
                </div>-->
            </div>
        </div>
    </div>
</div>

<div class="main_wrap" style="position: relative;">
	<div class="main_swiper_wrap">
		<!-- <div class="event">
			<h4 class="lh_40 f_white align_left ko_light">
				<span class="en_bold">BIOFACE<br>Special<br>Promotion<br><span class="lh_45">Ⅰ - Ⅰ</span></span><br>
				<input type="button" name="bio_special_pro_detail" id="bio_special_pro_btn" value="자세히보기" onclick="shurink();">
				
			</h4>
		</div>
		<div class="event2">
			<h4 class="lh_40 f_white align_left">
				<span class="en_bold">BIOFACE<br>Special<br>Promotion<br><span class="lh_45">Ⅰ - Ⅱ</span></span><br>
				<input type="button" name="bio_special_pro_detail" id="bio_special_pro_btn" value="자세히보기" onclick="rijuran();">
				
			</h4>
		</div> -->

		<div style="position: absolute; width: 74%;
		height: 80vh; z-index: 998; left: 14%; top: 9%;" class="main_link"></div>
		<div class="main_innerContainer" style="max-width: 600px;">
			<div class="border borderh" id="borderTopBar"></div>
			<div class="border borderv" id="borderLeftBar01"></div>
			<div class="border borderv" id="borderLeftBar02"></div>
			<div class="border borderv" id="borderRightBar"></div>
			<div class="border borderh" id="borderBottomBar01"></div>
			<div class="border borderh" id="borderBottomBar02"></div>
			<div class="scroll">
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
				<li><a href="#" target="_blank"><img src="/assets/img/consult.png" alt="상담" class="js-c-open"></a></li>
			</ul>

		</div>
		

		<!-- Swiper -->
		<div class="swiper-container" style="width: 100%; height: 100%;">
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<img src="/assets/img/main01_m.jpg?<?=rand()?>">
					<div class="mainSwiper_info" style="left:10%; bottom: 10%;">
						<h5 class="lh_35 f_white ko_light s_info">
							당신의 <span class="main_f_color">삶에 활력</span>이 넘칠 때까지-<Br>
							<span class="en_bold main_f_color f_bold lh_80 fs_23">-ing</span><br>
							우리는 당신을 위해 <span class="en_bold">-ing</span>합니다.<br>
							우리는 당신을 위해 연구합니다.
						</h5>
					</div>
				</div>
				<div class="swiper-slide">
					<img src="/assets/img/main02_m.jpg?<?=rand()?>">
					<div class="mainSwiper_info" style="right: 10%; bottom: 6%;">
						<h6 class="lh_30 f_white align_right ko_light">
							<span class="fs_12">필러 연구의 - <span class="en_bold">ing</span></span><br>
							<span class="en_bold main_f_color fs_23 lh_40">Top Of Filler<br>T.O.Fill</span><br>
							오래도록 지지 않는<br>
							아름다움이 될 수 있도록 -<br><br>
							히알루론산과 동종진피의 결합으로<br>
							3년 이상 오래가는 히알루론산 필러<br>
							<span class="main_f_color">티오필</span>
						</h6>
					</div>
				</div>
				<div class="swiper-slide">
					<img src="/assets/img/main03_m.jpg?<?=rand()?>">
					<div class="mainSwiper_info" style="left: 10%; bottom: 6%;">
						<h6 class="lh_30 f_white align_left ko_light">
							<span class="fs_12">리프팅 연구의 - <span class="en_bold">ing</span></span><br>
							<span class="en_bold main_f_color fs_23 lh_45">Ponytail<br>Lifting</span><br>
							볼륨재배치가 가능한 리프팅 -<br><br>
							<span class="main_f_color f_underline">이중턱 살을</span> 실로 끌어올려 이마 볼륨으로<br>
							만드는 "마법"같은 리프팅,<br>
							<span class="main_f_color">포니테일리프팅</span>
						</h6>
					</div>
				</div>
				<div class="swiper-slide">
					<img src="/assets/img/main04_m.jpg?<?=rand()?>">
					<div class="mainSwiper_info" style="right: 10%; bottom: 10%">
						<h6 class="lh_30 f_white align_right ko_light">
							<span class="fs_12">보톡스 연구의 - <span class="en_bold">ing</span></span><br>
							<span class="en_bold main_f_color fs_23 lh_45">Liftox</span><br>
							넘을 수 없는 보톡스 기술의 정점,<br>
							리프팅 되는 보톡스 -<br><br>
							근육 수축 억제 작용은 물론,<br>
							진피, 표피층에 탄력증대 효과까지<br>
							더한<span class="main_f_color ko_bold">리프톡스</span>
						</h6>
					</div>
				</div>
				<div class="swiper-slide">
					<img src="/assets/img/main05_m.jpg?<?=rand()?>">
					<div class="mainSwiper_info" style="left: 10%; bottom: 6%;">
						<h6 class="lh_30 f_white align_left ko_light">
							<span class="fs_12">다이어트 연구의 - <span class="en_bold">ing</span></span><br>
							<span class="en_bold main_f_color fs_23 lh_45">NMT<br>Diet</span><br>
							지금까지 없었던 다이어트의 새로운 패러다임 -<br><br>
							체중감량 확실한 뇌 피트니스와<br>
							예쁜 라인 개선을 위한 피스토주사의 결합,<br>
							<span class="main_f_color">NMT다이어트</span>
						</h6>
					</div>
				</div>
				<!-- 슈링크 -->
				<!-- <div class="swiper-slide">
					<img src="/assets/img/main06_m.jpg?<?=rand()?>">
					<div class="mainSwiper_info" style="right: 10%; bottom: 5%;">
						<h4 class="lh_30 f_white align_right ko_light">
							<span class="en_bold">SHURINK<br>LIFTING<br></span>
							<span class="fs_5">슈링크리프팅</span><br>
							<hr style="width: 100%; border: 1px solid #fff; margin: 20px 0;">
							<span class="fs_7">100샷<br>59,000원</span>
						</h4>
					</div>
				</div> -->
				<!-- 리쥬란 -->
				<!-- <div class="swiper-slide">
					<img src="/assets/img/main07_m.jpg?<?=rand()?>">
					<div class="mainSwiper_info" style="right: 10%; bottom: 5%;">
						<h4 class="lh_30 f_white align_right">
							<span class="en_bold">REJURAN<br>HEALER<br></span>
							<span class="fs_5">리쥬란힐러</span><br>
							<hr style="width: 100%; border: 1px solid #fff; margin: 20px 0;">
							<span class="fs_7">1cc<br>110,000원</span>
						</h4>
					</div>
				</div> -->

			</div>
		</div>
	</div>
	<div class="main_swiper_bottom main_color" id="main_swiper_bottom">
		<ul class="f_white">
			<li><img src="/assets/img/header_logo.png" style="margin-top: -15px; width: 90px;"></li>
			<li style="margin: -25px 20px 0 0;"><a href="tel:1833-8838" class="counseling_btn"><i class="material-icons fs_10">phone</i>1833-8838</a></li>
		</ul>
	</div>
</div>

<div class="intro_wrap" style="margin-bottom: -10px;">
	<!-- <div class="row" style="position: relative;">
		<div class="intro">
			<div class="col m12 s12" style="background-image: url('/assets/img/intro01_m.jpg?<?=rand()?>'); background-position: center; background-repeat: no-repeat; display: table; text-align: center; position: relative;">
				<h6 class="f_white align_center lh_30">
					<span class="en_bold fs_25">-Ing</span><br>
					당신의 삶의 질을 향상시키는<br>Anti-Ag<span class="f_bold fs_15">ing</span> 기술<br>
					비오페이스
				</h6>
				<h6 class="ko_light align_center lh_30" style="display: none;">
					한 가지 시술로 한 가지<br>
					효과만 볼 수 있다는 편견,<br>
					<span class="fs_12 lh_60">그래서 <span class="en_bold main_f_color">-ing</span> 합니다.</span><br>
					비오페이스는 <span class="en_bold">-ing</span>시술을 연구합니다.<br><br>
					<span class="en_bold">Lifting<br>Slimming<br>Voluming</span>
				</h6>
				<i class="large material-icons" style="">expand_more</i>
			</div>
			<div class="col m12 s12" style="background-image: url('/assets/img/intro02_m.jpg?<?=rand()?>'); background-position: center; background-repeat: no-repeat; display: table; text-align: center; position: relative;">
				<h6 class="f_white align_center lh_30">
					<span class="fs_20 lh_50"><span class="en_bold">Dr</span>.박주영</span><br>
					풍부한 임상경험과<br>디자인 이미지 연구
				</h6>
				<h6 class="ko_light align_right lh_30" style="display: none;">
					풍부한 임상경험과 디자인,<br>
					시술 프로토콜 연구<br><br>
					아름다운 결과를 만드는 <span class="fs_12 ko_bold">시술<br>
					방법들을 연구함</span>에 있어<br>
					근거를 가지고 안전하며, 실패하지 않는<br>
					<span class="fs_12 ko_bold">자연스러운 결과를</span> 내는 것이<br>
					저의 소명입니다.
				</h6>
				<i class="large material-icons" style="">expand_more</i>
			</div>
			<div class="col m12 s12" style="background-image: url('/assets/img/intro03_m.jpg?<?=rand()?>'); background-position: center; background-repeat: no-repeat; display: table; text-align: center; position: relative;">
				<h6 class="f_white align_center lh_30">
					<span class="fs_20 lh_50"><span class="en_bold">Dr</span>.이동한</span><br>
					비만 프로그램과<br>지방분해주사 연구
				</h6>
				<h6 class="ko_light align_left lh_30" style="display: none;">
					비만 프로그램과<br>
					지방분해주사 연구<br><br>
					관심과 위로, 멘탈리티의<br>
					관리 동반자로서<br>
					인생 전반의 <span class="fs_12 ko_bold">균형 잡힌 건강한 삶</span>이<br>
					완성되도록<br>
					도와주고 싶습니다.
				</h6>
				<i class="large material-icons" style="">expand_more</i>
			</div>
		</div>
		
	</div> -->
	<img src="/assets/img/main_sec2_m_200304.jpg" style="width: 100%;">
</div>

<div class="f_white main_color" style="width: 100%; padding: 50px 0;">
	<h5 class="align_center lh_35 ko_light" style="margin: 0;">
		<span class="ko_bold">확인해보세요</span><br>
		비오페이스에서 걸어온<br>꾸준한 연구의 길.
	</h5>
</div>

<div class="research_wrap" style="width: 100%;">
	<div class="row" style=" position: relative;">
		<div class="swiper-container3" style="overflow: hidden;">
			<div class="swiper-wrapper" style="padding: 50px 0">
				<div class="swiper-slide">
					<div class="col m12 s12">
						<h4 class="lh_30 align_center">
							<span class="en_bold main_f_color fs_9">INNOVATION - ing</span><br>
							<span class="ko_bold fs_6">필러, 리프팅, 보톡스 시술의 연구</span><br><br>

							<span class="ko_light fs_5 lh_20">
								비오페이스에서는 필러 주입의 방법,<br>볼륨 리프팅이 <span class="ko_bold main_f_color">동시에</span> 가능한<br>리프팅 시술 연구,<br>획일적인 보톡스 시술의 단점 보완 등<br>
								다양한 연구 사항으로 100%에 가까운<br>만족도를 위해 노력합니다.
							</span>

						</h4>
					</div>
					<div class="col m12 s12">
						<img src="/assets/img/research01.png" style="width: 70%; padding: 20px 0;">
					</div>
				</div>
				<div class="swiper-slide">
					<div class="col m12 s12">
						<h4 class="lh_30 align_center">
							<span class="en_bold main_f_color fs_9">INNOVATION - ing</span><br>
							<span class="ko_bold fs_6">철저한 안전시스템</span><br><br>

							<span class="ko_light fs_5 lh_20">
								비오페이스에서는 염증과 감염을 막는<br>
								"클린벤치"의 사용과 가장 깨끗한<br>히알루론산, 캐뉼라 등의 시스템으로<br>환자에게 더욱 안전한 시술을<br>진행하고 있습니다.
							</span>

						</h4>
					</div>
					<div class="col m12 s12">
						<img src="/assets/img/research02.png" style="width: 70%; padding: 30px 0;">
					</div>
				</div>
				<div class="swiper-slide">
					<div class="col m12 s12">
						<h4 class="lh_30 align_center">
							<span class="en_bold main_f_color fs_9">INNOVATION - ing</span><br>
							<span class="ko_bold fs_6">다양한 임상과 연구 의료진</span><br><br>

							<span class="ko_light fs_5 lh_20">
								비오페이스에서는<br>필러, 리프팅, 보톡스, 비만관리 등의<br>
								다양한 임상과 연구를 진행하는<br>의료진들과 구성되어 기존 시술들의<br>단점은 보완하고 <span class="ko_bold main_f_color">장점을 최대한</span> 살린<br>
								시술을 집도합니다.
							</span>

						</h4>
					</div>
					<div class="col m12 s12">
						<img src="/assets/img/research03.png" style="width: 70%; margin-top: 0">
					</div>
				</div>
			</div>

			<div class="swiper-button-next3"></div>
			<div class="swiper-button-prev3"></div>
		</div>
		<img src="/assets/img/before_btn.png" style="position: absolute; bottom: 5%; right: 25%;" class="before_btn">
		<img src="/assets/img/next_btn.png" style="position: absolute; bottom: 5%; right:10%;" class="next_btn">
</div>

<div class="beforeAfter_wrap">
	<div class="beforeAfter_title main_f_color bg_white align_center">
		<h5 class="en_bold lh_15">Photo Gallery</h5>
	</div>
	
	<div class="row tab_wrap" style="height: 490px;">
		<div class="col s5">
			<ul class="tabs" style="height: auto; background-color: #f1f1f1">
				<li class="tab col s12">
					<a href="#tab_content05" class="active">NMT 다이어트</a>
					<ul class="tabs_info align_center" style="display: block;">
						<li class="f_black">피스토주사</li>
					</ul>
				</li>
				<li class="tab col s12">
					<a href="#tab_content01">필러</a>
					<ul class="tabs_info align_center">
						<li class="f_black" style="line-height: 20px; padding: 10px 0;">티오필<br>풀페이스필러</li>
					</ul>
				</li>
				<li class="tab col s12">
					<a href="#tab_content02">리프팅</a>
					<ul class="tabs_info align_center">
						<li class="f_black">포니테일리프팅</li>
					</ul>
				</li>
				<li class="tab col s12">
					<a href="#tab_content03">보톡스</a>
					<ul class="tabs_info align_center">
						<li class="f_black">턱 리프톡스</li>
					</ul>
				</li>
				<li class="tab col s12">
					<a href="#tab_content04">바디필러</a>
					<ul class="tabs_info align_center">
						<li class="f_black">골반필러</li>
					</ul>
				</li>
			</ul>
		</div>
		<div class="col s7">
			<div class="tab_content_wrap" style="min-width: 100px;">
				<div id="tab_content01">
					<img src="/assets/img/beforeafter01_m.jpg?<?=rand()?>">
				</div>
				<div id="tab_content02">
					<img src="/assets/img/beforeafter02_m.jpg?<?=rand()?>">
				</div>
				<div id="tab_content03">
					<img src="/assets/img/beforeafter03_m.jpg?<?=rand()?>">
				</div>
				<div id="tab_content04">
					<img src="/assets/img/beforeafter04_m.jpg?<?=rand()?>">
				</div>
				<div id="tab_content05">
					<img src="/assets/img/beforeafter05_m.jpg?<?=rand()?>">
				</div>
			</div>
		</div>

		
	</div>

	<div class="ko_light" style="display: block; width: 80%; margin-bottom: 20px; color: #CDC9C8;">※ 본 이미지는 촬영 조건에 따라 실물과 다르게 보일 수 있으며, 환자 본인의 동의를 얻어 촬영 후 게재하였습니다.</div>
	<input type="button" class="beforeAfter_btn bg_black f_white ko_bold" value="더보기 >" onclick="not_ready();">
</div>

<div class="video" style="padding: 50px 0; text-align: center; max-width: 900px; margin: 0 auto; width: 100%;">
	<div class="row">
		<div class="col m12 s12">
			<div class="main_color" style="width: 80%; max-width: 400px; height: 200px; margin: 20px auto; padding: 0">
				<iframe src="http://www.youtube.com/embed/WRdRyBR9GRc" class="video" frameborder="0" style="max-width:100%; width:100%; height: 100%;" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
			</div>
		</div>
		<div class="col m12 s12" style="padding-top: 50px 0;">
			<h6>
				<span class="ko_bold main_f_color">비오페이스에서의 </span>놀라운 순간들을<br>
				지금 바로 영상으로<br>
				만나보세요~<br><br>
				<div class="f_white main_color" style="padding: 10px 20px; border-radius: 20px; font-size: 0.8em; outline: none; width: 200px; margin: 0 auto;">
					<a href="https://www.youtube.com/watch?v=WRdRyBR9GRc" style="color: #fff;">영상 바로가기 ></a>
				</div>
			</h6>
		</div>
	</div>
</div>

<script>
// 스크로 내리면 메뉴 On Off
window.onscroll = function() {myFunction()};
function myFunction() {
	var num = $(window).scrollTop();

	if(num > 0){
		$('.m_header').fadeIn();
	} else {
		$('.m_header').fadeOut();
		$('.m_header li:eq(0) i').text('menu');
		$('.change_icon').attr('src','/assets/img/phone_m.png');
		$('.m_header_info').fadeOut();
	}
	
}
function not_ready(){
	location.href="/not_ready";
}
</script>