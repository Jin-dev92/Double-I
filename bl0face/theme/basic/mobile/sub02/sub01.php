<?php
define('_INDEX_', true);
include_once('./_common.php');

include_once(G5_THEME_MOBILE_PATH.'/include/sub_head.php');
?>
<?php
if (!$member['mb_id'] && $member['mb_level'] < 2) // 회원 일때
{
	echo "<script> alert('로그인이 필요합니다.'); location.href='http://bioface.kr/bbs/login.php';</script>";

}
 ?>
<style>
.sub_main_gif {margin-top:-3130px !important;}
</style>
<div id="sub_title">
		<ul class="sub_ul">
			<li class="sub_li01"><a href="http://www.bioface.kr"><img src="/theme/basic/include/img/sub_home_icon.png">HOME</a></li>
			<span>-</span>
			<li class="sub_li02">FILLER</li>
		</ul>
</div>
<div class="sub_main">
	<div class="sub_main_img"><img src="/theme/basic/mobile/sub02/img/sub_img01.jpg"></div>
	<div class="sub_main_gif"><img src="/theme/basic/mobile/sub02/img/sub_ssussu.gif"></div>
</div>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>
