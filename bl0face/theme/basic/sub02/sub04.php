<?php
define('_INDEX_', true);
include_once('./_common.php');
if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/sub02/sub04.php');
    return;
}
include_once(G5_THEME_PATH.'/include/sub_head.php');
?>
<?php
include_once(G5_THEME_PATH.'/include/sub_main_head2.php');
?>
<?php
if (!$member['mb_id'] && $member['mb_level'] < 2) // 회원 일때
{
	echo "<script> alert('로그인이 필요합니다.'); location.href='http://bioface.kr/bbs/login.php';</script>";

}
 ?>
<style>
/*�������̽�*/
.sub_main {position:relative;width:100%;height:4726px;overflow:hidden; padding-top:50px; }
.sub_main .sub_main_img1 {position:relative; width:100%; height:100%; background:url('/theme/basic/sub02/img/sub_main_img4.jpg') no-repeat 50% 0;}
.sub_main .sub_main_gif1 { position: absolute; width:100%; height: 300px; margin-top:-1830px; margin-left:-13px; text-align: center; }
</style>
<div id="sub_title">
		<ul class="sub_ul">
			<li class="sub_li01"><a href="http://www.bioface.kr"><img src="/theme/basic/include/img/sub_home_icon.png">HOME</a></li>
			<span>-</span>
			<li class="sub_li02">FILLER</li>
		</ul>
</div>
<div class="sub_main">
	<div class="sub_main_img1"></div>
	<!-- �ֻ��� gif{ -->
	<div class="sub_main_gif1">
		<img src="/theme/basic/sub02/img/sub_ssussu.gif" >
	</div>
	<!-- //�ֻ��� gif{ -->
</div>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>
