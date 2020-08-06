<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
	// PC
} else {
	//MOBILE
	header("Location: /AboutUs/M_doctor_intro");
}
?>
<style>
	.header_wrap  { display: block !important; position: fixed; top: 0;}
	.sub_img { width: 100%; position: relative; margin-bottom: -10px;}
	.sub_title { width: 300px; background-color: #AA0010; border-radius: 5px; color: #FFF; font-size: 1.5em; padding: 5px; text-align: center;}
	.doctor_wrap { position: relative; left: 50%; top: 15%; width: 510px; font-family: 'NanumSquareR';}
</style>
<!-- <div class="sub_img" style="background-image: url(../assets/img/sub/AboutUs/doctor_intro01.jpg); background-size: cover; background-position-y: 50px; ">
	<div class="doctor_wrap ko_light">
		<div class="sub_title">풍부한 임상경험과 디자인 연구</div>

		<h2>박 주 영 <span class="fs_7">대표원장</span></h2>

		<h6 class="lh_30">
			"초창기 큐오필 시술 임상 프로토콜 연구에 참여하게 된 것이<br>
			계기가 되어 Local inject material(HA, Thrad, B.toxin,<br>
			bioactivator 등)을 이용한 전체 얼굴윤곽과 바디 교정에 대해 깊게<br>
			고민하고 연구하기 시작하였습니다.<br>
			큐오필의 단점을 보완하기 위해 개발된 티오필, 회의적이었던<br>
			실프팅의 생각을 바꾸게 해준 포니테일 리프팅이 나왔고<br>
			어느덧 누적된 데이터와 경험이 한 분야를 정진해 나가는 밑거름이<br>
			되었습니다.<br>
			아름다운 결과를 만드는 시술 방법을 연구함에 있어서, <span class="main_f_color f_underline"><b>근거를<br>
			가지고</b></span> 안전하며 <span class="main_f_color f_underline"><b>실패하지 않는 자연스러운 결과를 내는 것이 저의<br>소명입니다."</b></span>
		</h6>

		<hr style="display: block; margin: 30px 0; width: 50%; max-width: 180px;border: none; border-top: 5px solid #AA0010;">

		<h6 class="lh_25">
			2016 메디컬아시아 필러 & 보톡스 대상<br>
			2017 대한민국 보건산업대상 필러부문 최우수상<br>
			2017 아시아의료미용교류협회 필러 & 보톡스 아시아최고명인 대상수상
		</h6>
	</div>
</div>

<div class="sub_img" style="background-image: url(../assets/img/sub/AboutUs/doctor_intro02.jpg); background-size: cover;">
	<div class="doctor_wrap ko_light f_white" style="top: 10%;">
		<div class="sub_title" style="width: 370px;">뇌과학과 지방 분해 생리의학의 전문가</div>

		<h2>이 동 한 <span class="fs_7">원장</span></h2>

		<h6 class="lh_30">
			우리는 모두 이미 체중 조절의 메커니즘을 알고 있습니다. 하지만<br>
			인지 이전의 충동과 중독, 요요방지를 위해서는 뇌과학적 변화가<br>
			필요합니다. 뇌과학적 변화를 neuromodulation이라 합니다.<br>
			이를 비만치료에 적용하기 시작한 것이 제가 처음이라고 합니다.<br>
			또한, 1952년 지방분해주사를 처음 개발하신, Dr.Michel Pistor의<br>
			수제자였던 Dr.Le coz와의 연으로 피스토 주사를 개발하게 되었습니다.<br><br>

			저도 과거 20kg를 감량하였다가 다시 요요를 경험한 적이 있습니다.<br>
			일시적인 식욕억제제 보다도, 뇌과학적으로 철저하게 접근하여<br>
			전두엽 활성화와 같은 안전한 다이어트가 필요합니다.<br>
			체중뿐 아니라 체형 변화를 위해서 필수적인, 지방분해주사는 <span class="f_bold" style="color: #FF8994;"><b>성분의<br>
			안전성과 부위별 테크닉</b></span>으로 확실한 효과가 중요하다고 생각합니다.<br>
			<span class="f_bold" style="color: #FF8994;"><b>NMT(Neuromodulation Training) 전문가로서, 인생 전반의<br>
			균형잡힌 건강한 삶의 동반자가 되어 드리고 싶습니다.</b></span>
		</h6>

		<hr style="display: block; margin: 30px 0; width: 50%; max-width: 180px;border: none; border-top: 5px solid #AA0010;">
			
		<h6 class="lh_25">
			2017 AMAEA Medical Leader Forum Award 수상<br>
			2017 아시아의료미용교류협회 비만부문 아시아명인 대상수상
		</h6>
	</div>
</div> -->

<div class="sub_img">
	<img src="../assets/img/sub/AboutUs/doctor_intro_200508.jpg?<?=rand()?>">
</div>