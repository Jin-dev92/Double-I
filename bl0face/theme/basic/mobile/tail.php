<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
    </div>
</div>
<style>
#footer_fixed_btn {
	position: fixed;
    width: 640px;
    bottom: 130px;
}
#fixed_btn_1 {
	width:60px;
	height:60px;
	margin-left:20px;
	float:left;
}
#fixed_btn_2 {
	width:60px;
	height:60px;
	margin-right:20px;
	float:right;
}
</style>
<div id="ft">
	<div id="footer_f">
		<div id="footer_fixed_btn">
			<div id="fixed_btn_1">
				<a class="f_1"href="#" onclick="history.go(-1); return false"><img  src='/theme/basic/mobile/img/main_back.png' /></a>
			</div>
			<div id="fixed_btn_2">
				<a class="f_1"href="#" onclick="history.go(1); return false"><img  src='/theme/basic/mobile/img/main_prev.png' /></a>
			</div>

			<div id="fixed_btn_2" style="position: relative; width: 60px; height: 60px; top: -80px; right: -80px; background: rgba(0,0,0,0.7); color: #fff; border-radius: 5px;">
				<a class="up_scroll" href="#"><img  src='/theme/basic/mobile/img/main_top.png' /></a>
			</div>
		</div>
		<div id="footer_fixed">
			<a class="f_1"href="/bbs/board.php?bo_table=event_kor" ><img  src='/theme/basic/mobile/img/footer_fixed1.jpg' /></a>
			<a class="f_2"href="http://goto.kakao.com/@비오페이스서울신사본점"><img  src='/theme/basic/mobile/img/footer_fixed2.jpg' /></a>
			<a class="f_3"href="/bbs/board.php?bo_table=online_kor"><img  src='/theme/basic/mobile/img/footer_fixed3.jpg' /></a>
			<a class="f_4"href="tel:1833-8838"><img  src='/theme/basic/mobile/img/footer_fixed4.jpg' /></a>
		</div>
	</div>
	<div id="ft_logo">
		<div id="ft_logo_img">
			<img src="/theme/basic/mobile/img/ft_logo.png">
		</div>
	</div>
    <div id="ft_intro">
		<div id="ft_intro_txt">
			<span id="big_text">ADRESS</span>
			<p>서울특별시 강남구 강남대로 152길 22</p>
			<p>(신사동) 신사역 8번 출구</p>
			<span id="big_text">LICENCE</span>
			<p>사업자 등록번호 : 605-25-72864</p>
			<p>대표자 : 박주영</p>
			<p>상호명 : 비오페이스의원</p>
			<span id="big_text">CUSTOMER</span>
			<p>월 수 금 : AM 11 : 00 ~ PM 09 : 00</p>
			<p>화&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;목 : AM 11 : 00 ~ PM 07 : 00</p>
			<p>토 요 일 : AM 11 : 00 ~ PM 05 : 00</p>
		</div>
        <div id="ft_intro_sns">
			<span id="big_text">SOCIAL</span>
			<p>
				<a href="https://www.facebook.com/biofacefiller" target="_blank"><img src="/theme/basic/mobile/img/facebook_img.png" style="margin-right:15px;"></a>
				<a href="http://instagram.com/bioface_seoul" target="_blank"><img src="/theme/basic/mobile/img/instargram_img.png" style="margin-right:15px;"></a>
				<a href="http://goto.kakao.com/@비오페이스서울신사본점" target="_blank"><img src="/theme/basic/mobile/img/kakaotalk_img.png"></a>
			</p>
        </div>
        <div id="ft_intro_tel">
			<span id="big_text">CONTACT US</span>
			<p id="tel_number">1833-8838</p>
			<p id="fax_number">FAX : 02-6004-5998</p>
        </div>
    </div>
</div>

<?php
if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>
<script type="text/javascript">
	$('.up_scroll').on('click',function(){
		$('body,html').animate({scrollTop:0},200);
	});
</script>
<?php
include_once(G5_THEME_PATH."/tail.sub.php");
?>
