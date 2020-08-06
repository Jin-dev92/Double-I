<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
	// PC
} else {
	//MOBILE
	header("Location: /Not_ready_m");
}
?>
<style>
	.not_ready h1, .not_ready h2, .not_ready h3 { text-align: center; color: #fff}
	.not_ready { background-image: url(/assets/img/intro_content01.jpg); background-position: center center; background-repeat: no-repeat; width: 100%; opacity: 1; height: 100vh; display: flex; flex-wrap: wrap; align-content: center; flex-direction: column; justify-content: center;}
</style>
<div class="not_ready">
	<h1>페이지 준비중입니다.</h1><br><br>

	<a href="http://goto.kakao.com/@비오페이스서울신사본점" target="_blank"><img src="/assets/img/kakao_talk.png" style="width: 100%; max-width: 60px; display: block; margin: 0 auto;"></a>
	
	<h2>문의하기</h2>
	<h3>필러 연구소 <span class="en_bold">BIOFACE</span></h36>
</div>