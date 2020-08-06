<link href="/assets/css/popup.css" rel="stylesheet">
<style>
	.mCSB_2_scrollbar_vertical {
		overflow: scroll;
		height: 300px;
	}
	#mCSB_1_container, #mCSB_2_container, #mCSB_3_container {
		overflow: scroll;
		height: 200px;
	}
	.popup-c { z-index: 999;}
	.popup-tab__wrap { color: #fff;}
	.is-active a span{ color: #000 !important;}

</style>

<div class="popup-c" style="display: none;">
	<div class="popup-c__wrap">
		<a href="" class="popup-c__close">닫기</a>
		<div class="popup-tab">
			<ul class="popup-tab__list">
				<li class="popup-tab__item katalk is-active"><a href="#" class="popup-tab__link" data-tab="katalk"><span class="popup-tab__wrap">카톡상담</span></a></li>
				<li class="popup-tab__item cost"><a href="#" class="popup-tab__link" data-tab="cost"><span class="popup-tab__wrap">비용상담</span></a></li>
			</ul>
		</div>
		<div class="popup-c__scroll">
				 <!-- 카톡상담 -->
				<div class="popup-content katalk is-active">
					<form name="kakaoForm" id="kakaoForm" method="post" action="/Board/setKakao_db" onclick="check_kakao()">
					  <input type="hidden" name="counselKind" value="K">
						<h2 class="popup-content__tit2 for_pc">
							<strong>비오페이스</strong> 전문 상담원이 <span class="inline-block">친절히 상담 도와드립니다.</span>
						</h2>
						<h2 class="popup-content__tit2 for_m ko_light">
							<strong>비오페이스</strong> 전문 상담원이<br>친절히 상담 도와드립니다.
						</h2>
						<div class="popup-content__wrap">
							<div class="popup-content__box">
								<div class="input1__box">
									<input type="text" placeholder="이름" name="k_name" id="k_name" autocomplete="off" class="popup-input1" required="" aria-required="true">
									<button class="input1__clear" style="display: none;"></button>										
								</div>
								<div class="input1__box">
									<input type="tel" placeholder="연락처" class="popup-input1" id="k_tel" name="k_tel" autocomplete="off" required="" aria-required="true">
									<button class="input1__clear" style="display: none;"></button>
								</div>
								<div class="popup-select">
									<input type="hidden" name="ka_part">
									<a href="#" class="popup-select__tit ka_part">관심부위를 선택해주세요</a>
									<div class="popup-select__box">
										<p class="popup-select2__subject type-another">관심부위</p>
										<ul class="popup-select__list mCustomScrollbar _mCS_1 mCS-autoHide mCS_no_scrollbar" style="position: relative; overflow: visible;"><div id="mCSB_1" class="mCustomScrollBox mCS-minimal mCSB_vertical mCSB_outside" style="max-height: 0px;" tabindex="0"><div id="mCSB_1_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">

									  <li class="popup-select2">
									  <h4 class="popup-select2__tit">리프팅</h4>
										  <ul class="popup-select2__list">
											<li class="popup-select__item" id="partOptKakao_40">티오필</li>
											<li class="popup-select__item" id="partOptKakao_41">포니테일리프팅</li>
											<li class="popup-select__item" id="partOptKakao_42">리프톡스</li>
											<li class="popup-select__item" id="partOptKakao_43">슈링크</li>
											<li class="popup-select__item" id="partOptKakao_44">리쥬란힐러</li>
											<li class="popup-select__item" id="partOptKakao_45">뉴테라</li>
											<li class="popup-select__item" id="partOptKakao_45">듀엣써마지</li>
										</ul>
									  </li>
									  <li class="popup-select2">
									  <h4 class="popup-select2__tit">비만클리닉</h4>
										  <ul class="popup-select2__list">
											<li class="popup-select__item" id="partOptKakao_50">NMT 다이어트</li>
											<li class="popup-select__item" id="partOptKakao_51">NMT 뇌피트니스</li>
											<li class="popup-select__item" id="partOptKakao_52">NMT 피스토주사</li>
										</ul>
									  </li>
									  <li class="popup-select2">
									  <h4 class="popup-select2__tit">필러</h4>
										  <ul class="popup-select2__list">
											<li class="popup-select__item" id="partOptKakao_57">골반필러</li>
											<li class="popup-select__item" id="partOptKakao_58">힙업필러</li>
											<li class="popup-select__item" id="partOptKakao_59">휜다리교정필러</li>
										</ul>
									  </li>
								</div></div><div id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-minimal mCSB_scrollTools_vertical" style="display: none;"><div class="mCSB_draggerContainer"><div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 50px; top: 0px;"><div class="mCSB_dragger_bar" style="line-height: 50px;"></div></div><div class="mCSB_draggerRail"></div></div></div></ul></div>
								</div> 
								<label id="part_item_error" class="popup-content__noti" style="display: none;"></label>
								<input type="text" name="part_item" id="part_item" value="" class="invisible" required="" style="width: 0; height: 0;" aria-required="true"> <!-- 실제 관심부위 입력값 -->
								<!-- //select -->
							</div>
							<div class="popup-content__box">
								<textarea placeholder="메모" class="popup-textarea" name="k_content" id="k_content" required="" aria-required="true"></textarea>
							</div>
						</div>
						<div class="popup-content__wrap">
							<div class="popup-content__box type-right">
								<div class="popup-content__check">
									<input type="checkbox" name="chkAgree1" id="chkAgree1" class="checkbox02" required="" aria-required="true"><label for="chkAgree1">개인정보 수집 및 이용 동의(필수)</label>
									<a href="" class="popup-content__btn2 is-view js-terms-open">[자세히 보기]</a>
									<label id="chkAgree1-error" class="error" style="display: none;"></label>
								</div>
							</div>
						</div>
						 <button type="submit" class="popup-content__btn type-katalk">상담신청</button>
                    </form>						
				</div>
				<div class="popup-content cost">
					<form name="priceForm" id="priceForm" method="post" action="/Board/setCost_db" onclick="check_cost();">
						<input type="hidden" name="p_part">

					  <input type="hidden" name="counselKind" value="P">
                      <h2 class="popup-content__tit2 for_pc">
                      	<strong>비오페이스</strong> 전문 상담원이 친절히 <span class="inline-block">상담 도와드립니다.</span>
                      </h2>
                      <h2 class="popup-content__tit2 for_m ko_light">
                      	<strong>비오페이스</strong> 전문 상담원이<br>친절히 상담 도와드립니다.
                      </h2>
						<div class="popup-content__wrap">
								<div class="popup-content__box">
									<div class="input1__box">
										<input type="text" placeholder="이름" class="popup-input1" name="p_name" id="p_name" autocomplete="off" required="" aria-required="true">
										<button class="input1__clear" style="display: none;"></button>
										<!-- <span class="popup-content__noti">필수 정보입니다.</span> -->
									</div>
									<div class="input1__box">
										<input type="tel" placeholder="연락처" class="popup-input1" name="p_tel" id="p_tel" autocomplete="off" required="" aria-required="true">
										<button class="input1__clear" style="display: none;"></button>
										<!-- <span class="popup-content__noti">필수 정보입니다.</span> -->
									</div>
									<div class="popup-select" data-style="multi">
										<a href="#" class="popup-select__tit js-multi">관심부위를 선택해주세요</a>
										<div class="popup-select__box">
											<p class="popup-select2__subject">[최대 3개까지 선택가능]</p>
											<ul class="popup-select__list mCustomScrollbar _mCS_2 mCS-autoHide mCS_no_scrollbar" style="position: relative; overflow: visible;"><div id="mCSB_2" class="mCustomScrollBox mCS-minimal mCSB_vertical mCSB_outside" style="max-height: 0px;" tabindex="0"><div id="mCSB_2_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">

									  <li class="popup-select2">
									  <h4 class="popup-select2__tit">리프팅</h4>
										  <ul class="popup-select2__list">
											<li class="popup-select__item" id="cost_40">티오필</li>
											<li class="popup-select__item" id="cost_41">포니테일리프팅</li>
											<li class="popup-select__item" id="cost_42">리프톡스</li>
											<li class="popup-select__item" id="cost_43">슈링크</li>
											<li class="popup-select__item" id="cost_44">리쥬란힐러</li>
											<li class="popup-select__item" id="cost_45">뉴테라</li>
											<li class="popup-select__item" id="cost_45">듀엣써마지</li>
										</ul>
									  </li>
									  <li class="popup-select2">
									  <h4 class="popup-select2__tit">비만클리닉</h4>
										  <ul class="popup-select2__list">
											<li class="popup-select__item" id="cost_53">NMT 다이어트</li>
											<li class="popup-select__item" id="cost_46">NMT 뇌피트니스</li>
											<li class="popup-select__item" id="cost_54">NMT 피스토주사</li>
										</ul>
									  </li>
									  <li class="popup-select2">
									  <h4 class="popup-select2__tit">바디필러</h4>
										  <ul class="popup-select2__list">
											<li class="popup-select__item" id="cost_57">골반필러</li>
											<li class="popup-select__item" id="cost_58">힙업필러</li>
											<li class="popup-select__item" id="cost_59">휜다리교정필러</li>
										</ul>
									  </li>
									</div></div><div id="mCSB_2_scrollbar_vertical" class="mCSB_scrollTools mCSB_2_scrollbar mCS-minimal mCSB_scrollTools_vertical" style="display: none;"><div class="mCSB_draggerContainer"><div id="mCSB_2_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 50px; top: 0px;"><div class="mCSB_dragger_bar" style="line-height: 50px;"></div></div><div class="mCSB_draggerRail"></div></div></div></ul></div>
									</div>
									<!-- <span class="popup-content__noti">관심부위를 선택하세요.</span> -->
									<label id="part_item2-error" class="error" style="display: none;"></label>
									<input type="text" name="part_item2" id="part_item2" value="" class="invisible" required="" style="width: 0; height: 0;" aria-required="true"> <!-- 실제 관심부위 마지막 입력값 -->
									<ul class="popup-check">
									</ul>
									<!-- //select -->
								</div>
								<div class="popup-content__box con_time">
									<div class="popup-select type-another">
										<a href="#" class="popup-select__tit">상담시간</a>
										<div class="popup-select__box">
											<p class="popup-select2__subject type-another">상담시간</p>
											<ul class="popup-select__list mCustomScrollbar _mCS_3 mCS-autoHide mCS_no_scrollbar" style="position: relative; overflow: visible;"><div id="mCSB_3" class="mCustomScrollBox mCS-minimal mCSB_vertical mCSB_outside" style="max-height: 0px;" tabindex="0"><div id="mCSB_3_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">
												<li class="popup-select2">
													<h4 class="popup-select2__tit">오전</h4>
													<ul class="popup-select2__list">
														<li class="popup-select__item"><span class="popup-c__number">11:00 ~ 12:00</span></li>
													</ul>
												</li>
												<li class="popup-select2">
													<h4 class="popup-select2__tit">오후</h4>
													<ul class="popup-select2__list">
														<li class="popup-select__item"><span class="popup-c__number">12:00 ~ 13:00</span></li>
														<li class="popup-select__item"><span class="popup-c__number">13:00 ~ 14:00</span></li>
														<li class="popup-select__item"><span class="popup-c__number">14:00 ~ 15:00</span></li>
														<li class="popup-select__item"><span class="popup-c__number">15:00 ~ 16:00</span></li>
														<li class="popup-select__item"><span class="popup-c__number">16:00 ~ 17:00</span></li>
														<li class="popup-select__item"><span class="popup-c__number">17:00 ~ 18:00</span></li>
														<li class="popup-select__item"><span class="popup-c__number">18:00 ~ 19:00</span></li>
														<li class="popup-select__item"><span class="popup-c__number">19:00 ~ 20:00</span></li>
													</ul>
												</li>
											</div></div><div id="mCSB_3_scrollbar_vertical" class="mCSB_scrollTools mCSB_3_scrollbar mCS-minimal mCSB_scrollTools_vertical" style="display: none;"><div class="mCSB_draggerContainer"><div id="mCSB_3_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 50px; top: 0px;"><div class="mCSB_dragger_bar" style="line-height: 50px;"></div></div><div class="mCSB_draggerRail"></div></div></div></ul>
										</div>
									</div>
									<label id="ampm_error" class="error" style="display: none;"></label>
									<input type="text" name="ampm" id="ampm" value="" class="invisible" required="" style="width: 0; height: 0;" aria-required="true"> <!-- 실제 상담시간 입력값 -->
									<textarea placeholder="메모" required="" class="popup-textarea type-another" name="p_content" id="p_content" aria-required="true"></textarea>
									<!-- <span class="popup-content__noti">메모를 입력하세요</span> -->

									<!-- <div class="popup-content__check">
										<input type="checkbox" name="chk_sms_agree" value="Y" id="chk_sms_agree" required="" class="checkbox02 type-cost" aria-required="true"><label for="chk_sms_agree">SMS 수신 동의</label>
									</div> -->
									<div class="popup-content__check">
										<input type="checkbox" name="chk_agree2" id="chk_agree2" class="checkbox02 type-cost" required="" aria-required="true"><label for="chk_agree2">개인정보 수집 및 이용 동의(필수)</label>
										<a href="" class="popup-content__btn2 is-view js-terms-open">[자세히 보기]</a>
									</div>
									<label id="chk_agree2-error" class="error" style="display: none;"></label>
								</div>
						</div>
						<button type="submit" class="popup-content__btn type-cost">상담신청</button>
                    </form>						
				</div>
				<div class="popup-c__footer">
					<div class="popup-c__info">
						<dl class="popup-c__dl">
							<dt class="popup-c__dt"><span>전</span><span>화</span></dt>
							<dd class="popup-c__dd"><span class="popup-c__number">1833-8838</span></dd>
						</dl>
						<dl class="popup-c__dl">
							<dt class="popup-c__dt">진료시간</dt>
							<dd class="popup-c__dd">
								평일 <span class="popup-c__number">10:30~21:00</span>
								, <span class="inline-block">토요일 <span class="popup-c__number">10:30~17:00</span></span>
							</dd>
						</dl>
					</div>
				</div>
				<div class="popup-c__terms">
					<div class="terms-c">
						<a href="" class="terms-c__btn js-terms-close">닫기</a>
						<div class="terms-c__box">
							<h3 class="terms-c__tit">개인정보취급방침</h3>
							<div class="terms-c__area mCustomScrollbar _mCS_4 mCS-autoHide" style="position: relative; overflow: visible;"><div id="mCSB_4" class="mCustomScrollBox mCS-minimal mCSB_vertical mCSB_outside" style="max-height: none;" tabindex="0"><div id="mCSB_4_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">
									  <div class="termsTxt" style="overflow: scroll; height: 120px;">
		<div class="box">
			비오페이스(은)는 개인정보 보호법 제30조에 따라 정보주체(고객)의 개인정보를 보호하고 이와 관련한 고충을 신속하고 원활하게 처리할 수 있도록 하기 위하여 다음과 같이 개인정보 처리지침을 수립․공개합니다. 
			<br><br>
			1. 개인정보의 처리목적 비오페이스은(는) 다음의 목적을 위하여 개인정보를 처리하고 있으며, 다음의 목적 이외의 용도로는 이용하지 않습니다. 
			   - 고객 가입의사 확인, 고객에 대한 서비스 제공에 따른 본인 식별․인증, 회원자격 유지․관리, 물품 또는 서비스 공급에 따른 금액 결제, 물품 또는 서비스의 공급․배송 등
			<br><br>
			2. 개인정보의 처리 및 보유기간 ① 비오페이스은(는) 정보주체로부터 개인정보를 수집할 때 동의받은 개인정보 보유․이용기간 또는 법령에 따른 개인정보 보유․이용기간 내에서 개인정보를 처리․보유합니다. 
			   ② 구체적인 개인정보 처리 및 보유 기간은 다음과 같습니다. 
			    - 고객 가입 및 관리 : 서비스 이용계약 또는 회원가입 해지시까지, 다만 채권․채무관계 잔존시에는 해당 채권․채무관계 정산시까지 
			    - 전자상거래에서의 계약․청약철회, 대금결제, 재화 등 공급기록 : 5년 
			<br><br>
			3. 개인정보의 제3자 제공 비오페이스은(는) 정보주체의 별도 동의, 법률의 특별한 규정 등 개인정보 보호법 제17조에 해당하는 경우 외에는 개인정보를 제3자에게 제공하지 않습니다. 
			<br><br>
			4. 개인정보처리의 위탁 ① 비오페이스은(는) 원활한 개인정보 업무처리를 위하여 다음과 같이 개인정보 처리업무를 외부에 위탁하고 있습니다.
			   ② 비오페이스은(는) 위탁계약 체결시 개인정보 보호법 제25조에 따라 위탁업무 수행목적 외 개인정보 처리금지, 재위탁 제한, 수탁자에 대한 관리․감독, 책임에 관한 사항을 문서에 명시하고, 수탁자가 개인정보를 안전하게 처리하는지를 감독하고 있습니다. 
			5. 정보주체와 법정대리인의 권리․의무 및 행사방법 정보주체는 비오페이스에 대해 언제든지 다음 각 호의 개인정보 보호 관련 권리를 행사할 수 있습니다. 
			    1. 개인정보 열람요구
			    2. 개인정보에 오류 등이 있을 경우 정정 요구 
			    3. 삭제요구 
			    4. 처리정지 요구  
			<br><br>
			 6. 처리하는 개인정보 항목 비오페이스은(는) 다음의 개인정보 항목을 처리하고 있습니다. 
			   - 이름, 연락처, 이메일 등
			<br><br>
			 7. 개인정보의 파기 ① 비오페이스은(는) 개인정보 보유기간의 경과, 처리목적 달성 등 개인정보가 불필요하게 되었을 때에는 지체없이 해당 개인정보를 파기합니다. 
			   ② 비오페이스은(는) 다음의 방법으로 개인정보를 파기합니다. 
			      - 전자적 파일 : 파일 삭제 및 디스크 등 저장매체 포맷
			      - 수기<span style="font-family: 'Dotum;">(手記)</span> 문서 : 분쇄하거나 소각 
			<br><br>
			 8. 개인정보의 안전성 확보조치 비오페이스은(는) 개인정보의 안전성 확보를 위해 다음과 같은 조치를 취하고 있습니다. 
			    - 관리적 조치 : 내부관리계획 수립․시행, 직원․종업원 등에 대한 정기적 교육 
			    - 기술적 조치 : 개인정보처리시스템(또는 개인정보가 저장된 컴퓨터)의 비밀번호 설정 등 접근권한 관리, 백신소프트웨어 등 보안프로그램 설치, 개인정보가 저장된 파일의 암호화 
			    - 물리적 조치 : 개인정보가 저장․보관된 장소의 시건, 출입통제 등 
			<br><br>
			 9. 개인정보 자동 수집 장치의 설치∙운영 및 거부에 관한 사항      
			   ① 비오페이스은(는) 이용자에게 개별적인 맞춤서비스를 제공하기 위해 이용정보를 저장하고 수시로 불러오는 ‘쿠키(cookie)’를 사용합니다.
			   ② 쿠키는 웹사이트를 운영하는데 이용되는 서버(http)가 이용자의 컴퓨터 브라우저에게 보내는 소량의 정보이며 이용자들의 PC 컴퓨터내의 하드디스크에 저장되기도 합니다.
			      가. 쿠키의 사용목적: 이용자가 방문한 각 서비스와 웹 사이트들에
			     대한 방문 및 이용형태, 인기 검색어, 보안접속 여부, 등을 파악하여
			      이용자에게 최적화된 정보 제공을 위해 사용됩니다.
			      나. 쿠키의 설치∙운영 및 거부 : 웹브라우저 상단의 도구>인터넷 옵션>개인정보 메뉴의 옵션 설정을 통해 쿠키 저장을 거부 할 수 있습니다.
			      다. 쿠키 저장을 거부할 경우 맞춤형 서비스 이용에 어려움이 발생할 수 있습니다.
			<br><br>
			 10. 개인정보 보호책임자 비오페이스은(는) 개인정보 처리에 관한 업무를 총괄해서 책임지고, 개인정보 처리와 관련한 정보주체의 불만처리 및 피해구제를 처리하기 위하여 아래와 같이 개인정보 보호책임자를 지정하고 있습니다. 
			   ▶ 개인정보 보호책임자 (사업주 또는 대표자) 
			       성명 : 박주영          직책 : 대표
			       연락처 : 010-6811-2103, kukuiju@gmail.com, 02.6004.5998 
			<br><br>
			 11. 개인정보 처리방침 변경 이 개인정보 처리방침은 2018. 06. 05.부터 적용됩니다.
	    </div>
    </div>								
</div>
</div>
<div id="mCSB_4_scrollbar_vertical" class="mCSB_scrollTools mCSB_4_scrollbar mCS-minimal mCSB_scrollTools_vertical" style="display: block;"><div class="mCSB_draggerContainer"><div id="mCSB_4_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 50px; display: block; height: 2px; max-height: 116px; top: 0px;"><div class="mCSB_dragger_bar" style="line-height: 50px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div>
							</div>
							<div class="terms-c__box">
								<h3 class="terms-c__tit">개인정보 수집 및 이용 동의</h3>
								<div class="terms-c__area mCustomScrollbar _mCS_5 mCS-autoHide" style="position: relative; overflow: visible;"><div id="mCSB_5" class="mCustomScrollBox mCS-minimal mCSB_vertical mCSB_outside" style="max-height: none;" tabindex="0"><div id="mCSB_5_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">
									
	  <div class="termsTxt" style="overflow: scroll; height: 120px;">
		<p>수집하는 개인정보의 항목</p><br>
	   <p>[홈페이지 회원가입 시 수집항목]</p>
	   <p>-수집항목 : 이름, 연락처, 이메일</p>
	   <p>-서비스 이용 과정이나 서비스 제공 업무 처리 과정에서 다음과 같은 정보들이 자동으로 생성되어 수집될 수 있습니다. : 서비스 이용기록, 접속로그, 쿠키, 접속 IP 정보</p>
		<br><br><br>
	   <p>개인정보의 수집 및 이용 목적</p><br>
	   <p>본원은 수집한 개인정보를 다음의 목적을 위해 활용합니다.</p>
	   <p>이용자가 제공한 모든 정보는 하기 목적에 필요한 용도 이외로는 사용되지 않으며 이용 목적이 변경될 시에는 사전 동의를 구할 것입니다.</p><br>
	   <p>[진료정보]</p>
	   <p>-진단 및 치료를 위한 진료서비스와 청구, 수납 및 환급 등의 원무서비스 제공</p><br>
	   <p>[홈페이지 수집정보]</p>
	   <p>-필수정보 : 홈페이지를 통한 진료 예약, 예약조회 및 회원제 서비스 제공</p>
	   <p>-선택정보 : MMS, SNS, SMS, 이메일을 통한 본원소식 및 고지사항 전달, 질병정보 안내, 설문조사, 불만처리 등을 위한 원활한 의사소통 경로의 확보 등</p><br>

	   <p>개인정보의 보유 및 이용기간</p><br>
	   <p>본원은 개인정보의 수집목적 또는 제공받은 목적이 달성된 때에는 귀하의 개인정보를 지체 없이 파기합니다.</p><br>
	   <p>[진료정보]</p>
	   <p>-의료법에 명시된 진료기록 보관 기준에 준하여 보관</p><br>
	   <p>[홈페이지 회원정보]</p>
	   <p>-회원가입을 탈퇴하거나 회원에서 제명된 때</p><br>
	   <p>개인정보는 『개인정보의 수집 및 이용목적』을 위해 서비스 제공 기간 동안에 한하여 보유 및 이용되며, 진료서비스 제공을 위하여 수집된 정보는 의료법에 준하여 보관하고 있습니다. 다만, 수집 목적 및 제공받은 목적이 달성된 경우에도 다른 법령 등에 의하여 보관의 필요성이 있는 경우에는 개인정보를 보유할 수 있습니다.</p>
	  </div>								</div></div><div id="mCSB_5_scrollbar_vertical" class="mCSB_scrollTools mCSB_5_scrollbar mCS-minimal mCSB_scrollTools_vertical" style="display: block;"><div class="mCSB_draggerContainer"><div id="mCSB_5_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 50px; display: block; height: 16px; max-height: 116px; top: 0px;"><div class="mCSB_dragger_bar" style="line-height: 50px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div>
							</div>
						</div><!--//terms-c-->
					</div><!-- //popup-c__terms-->
				</div>
			</div>
		</div>
	</div>

<script src="/assets/js/popup.js"></script>
<script>
	function check_kakao(){
		var part = $('.ka_part').text();
		// console.log(part);
		$('input[name=ka_part]').val(part);
	}

	function check_cost(){
		var part = $('.popup-check').text();

		$('input[name=p_part]').val($.trim(part));
	}
</script>