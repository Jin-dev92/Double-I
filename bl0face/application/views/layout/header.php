<div class="header header_wrap bg_black" id="myHeader">
	<ul class="f_white">
		<a href="/Main"><img src="/assets/img/header_logo.png" style="position: absolute; left: 7%; top: 20%; width: 100px;"></a>
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
					<img src="/assets/img/header01.jpg" style="">
				</div>
			</div>
			<div class="col m6">
				<li><a href="/Why_bioface/Why_bioface">비오페이스 소개</a></li>
				<li><a href="/AboutUs/doctor_intro">의료진소개</a></li>
				<li><a href="/AboutUs/treatment_guide">진료안내</a></li>
				<li><a href="/AboutUs/find_map">찾아오시는 길</a></li>
				<li><a href="/board/lists/star_kor/1">with star</a></li>
			</div>
		</div>
		<div class="row lifting">
			<div class="col m6">
				<div class="header_img">
					<img src="/assets/img/header02.jpg" style="">
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
				<li><a href="/Obesity_clinic/M_NMTdiet"><big><b>NMT</b></big>다이어트</a></li>
				<li><a href="/Obesity_clinic/M_NMTbrain"><big><b>NMT</b></big>뇌피트니스</a></li>
				<li><a href="/Obesity_clinic/M_NMTpisto"><big><b>NMT</b></big>피스토주사</a></li>
				<li><a href="/Obesity_clinic/M_beforeAfter_pic">전후사진</a></li>
			</div>
		</div>
		<div class="row body">
			<div class="col m6">
				<div class="header_img">
					<img src="/assets/img/header04.jpg" style="">
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
					<img src="/assets/img/header05.jpg" style="">
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
					<img src="/assets/img/header06.jpg" style="">
				</div>
			</div>
            <div class="col m6" style="padding: 30px 0;">
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