<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
	// PC
	header("Location: /not_ready");
} else {
	//MOBILE
}
?>
<style>
	* {max-width: 640px; margin: 0 auto;}
	.m_header { display: block !important;}
	.sub_main { display: block; width: 100%; max-width: 640px; margin: 0 auto; margin-top: 50px; position: relative;}
	.sub_main h4, .sub_main h5 { text-align: center; color: #fff;}
	.back_img { background-image: url(/assets/img/main01_m.jpg); background-position: center center; background-repeat: no-repeat; width: 100%; opacity: 1; height: 100vh; display: flex; flex-wrap: wrap; align-content: center; flex-direction: column; justify-content: center;}
</style>
<div class="sub_main">
	<div class="back_img">
		<h4>페이지 준비중입니다.</h4>
		<br><br>

		<a href="http://goto.kakao.com/@비오페이스서울신사본점" target="_blank"><img src="/assets/img/kakao_talk.png" style="width: 100%; max-width: 60px; display: block; margin: 0 auto;"></a>
		
		<h4>문의하기</h4>
		<h5>필러 연구소 <span class="en_bold">BIOFACE</span></h5>
		<br><br><br><br>
	</div>
</div>

