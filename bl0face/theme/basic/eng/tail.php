<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/eng/tail.php');
    return;
}
?>

<!-- 하단 시작 { -->
<style>
#ft { position:relative; z-index:1; width:100%; min-width:1200px; height:409px; background:#000000; }
#ft #ft_catch { width:1200px; height:110px; margin:0 auto; text-align:left; border-bottom:1px solid #afa69a; }
#ft #ft_catch img { padding-top:20px; }

#ft #ft_go { width:1200px; height:269px; margin:0 auto; text-align:left; }
#ft #ft_go #ft_gg { position:relative; font-size:14px; padding-top:10px; }
#ft #ft_go #ft_gg ul { float:left; }
#ft #ft_go #ft_gg ul#go1 { margin:0; padding:0; list-style:none; font-weight:600;  margin-right:50px; }
#ft #ft_go #ft_gg ul#go1 li#title { font-size:18px; color:#ffffff;  font-weight:bold; margin-top:10px;  }
#ft #ft_go #ft_gg ul#go1 li#title b {  }
#ft #ft_go #ft_gg ul#go1 li#first { padding-top:5px; font-size:42px; color:#0ac6ba; }
#ft #ft_go #ft_gg ul#go1 li#sec { padding-bottom:20px; font-size:22px; color:#ffffff; }
#ft #ft_go #ft_gg ul#go1 li { padding-bottom:10px; text-decoration:none; color:#ffffff; }

#ft #ft_go #ft_gg ul#go2 { margin:0; padding:0; list-style:none; font-weight:600;  margin-right:50px; }
#ft #ft_go #ft_gg ul#go2 li#title { font-size:18px; color:#ffffff;  font-weight:bold; margin-top:10px;  }
#ft #ft_go #ft_gg ul#go2 li#title b {  }
#ft #ft_go #ft_gg ul#go2 li#first { padding-top:20px; color:#ffffff; }
#ft #ft_go #ft_gg ul#go2 li#sec { padding-bottom:20px; color:#ffffff; }

#ft #ft_go #ft_gg ul#go3 { margin:0; padding:0; list-style:none; font-weight:600;  margin-right:50px; }
#ft #ft_go #ft_gg ul#go3 li#title { font-size:18px; color:#ffffff;  font-weight:bold; margin-top:10px;  }
#ft #ft_go #ft_gg ul#go3 li#title b {  }
#ft #ft_go #ft_gg ul#go3 li#first { padding-top:20px; color:#ffffff; }

#ft #ft_go #ft_gg ul#go4 { margin:0; padding:0; list-style:none; font-weight:600; }
#ft #ft_go #ft_gg ul#go4 li#title { font-size:18px; color:#ffffff;  font-weight:bold; margin-top:10px;  }
#ft #ft_go #ft_gg ul#go4 li#title b {  }
#ft #ft_go #ft_gg ul#go4 li#first { padding-top:20px; }
#ft #ft_go #ft_gg ul#go4 li#first ul#go4_u { list-style:none; margin:0; padding:0; }
#ft #ft_go #ft_gg ul#go4 li#first ul#go4_u li { float:left; }
#ft #ft_go #ft_gg ul#go4 li#first ul#go4_u li#go4_u_f { margin-right:15px; }
#ft #ft_go #ft_gg ul#go4 li#first ul#go4_u li#go4_u_s { margin-right:15px; }
#ft #ft_go #ft_gg ul#go4 li#last { padding-top:100px; } 
#ft #ft_go #ft_gg ul#go4 li#last a {text-decoration:none; color:#ffffff; float:right; }
</style>
<div id="ft">
    <div id="ft_catch"><img src="/theme/basic/eng/img/main/footer_logo.png" alt="비오페이스"></div>
    <div id="ft_company">
    </div>
	<div id="ft_go">
		<div id="ft_gg">
			<ul id="go1">
				<li id="title"><b>CUSTOMER</b></li>
				<li id="first">1833 - 8838</li>
				<li id="sec">FAX : 02 - 6004 - 5998</li>
				<li>Mon, Wed, Thur : AM 11:00 ~ PM 07 : 00</li>
				<li>Tue&nbsp;&nbsp;Fri : AM 11:00 ~ PM 09 : 00</li>
				<li>Sat : AM 11:00 ~ PM 05 : 00</li>
			</ul>
			<ul id="go2">
				<li id="title"><b>ADRESS</b></li>
				<li id="first">Avenue 22, Gangnamdaero 152, Gangnam-gu, Seoul</li>
				<li id="sec">No.8 exit, Sinsa Station</li>
			</ul>
			<ul id="go3">
				<li id="title"><b>LICENCE</b></li>
				<li id="first">Registeration number : 605 - 25 - 72864</li>
			</ul>
			<ul id="go4">
				<li id="title"><b>SOCIAL</b></li>
				<li id="first">
					<ul id="go4_u">
						<li id="go4_u_f"><a href="https://www.facebook.com/biofacefiller"><img src="/theme/basic/eng/img/main/facebook_btn.png"></a></li>
						<li id="go4_u_s"><a href="http://instagram.com/bioface_seoul"><img src="/theme/basic/eng/img/main/instargram_btn.png"></a></li>
						<li><a href="http://goto.kakao.com/@비오페이스서울신사본점"><img src="/theme/basic/eng/img/main/kakao_btn.png"></a></li>
					</ul>
				</li>
				<li id="last"><a href="#hd" id="ft_totop">상단으로</a></li>
			</ul>
		</div>
	</div>
</div>

<?php
if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<!-- } 하단 끝 -->

<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_THEME_PATH."/eng/tail.sub.php");
?>