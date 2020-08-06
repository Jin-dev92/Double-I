<?php
define('_INDEX_', true);
include_once('./_common.php');
if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/sub06/sub02.php');
    return;
}
include_once(G5_THEME_PATH.'/include/sub_head.php');
?>
<?php
// include_once(G5_THEME_PATH.'/include/sub_main_head5.php');
?>

<style>
/*비오페이스*/
.sub_main {position:relative;width:100%;height:3666px;overflow:hidden; padding-top:50px; }
.sub_main .sub_main_img1 {position:relative; width:100%; height:100%; background:url('/theme/basic/sub06/img/sub_main_img1.jpg') no-repeat 50% 0;} 
</style>
<div id="sub_title">
		<ul class="sub_ul">
			<li class="sub_li01"><a href="http://www.bioface.kr"><img src="/theme/basic/include/img/sub_home_icon.png">HOME</a></li>
			<span>-</span>
			<li class="sub_li02">ETC</li>
		</ul>
</div>


<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="/theme/basic/css/materialize.min.css">

<link href='https://cdn.rawgit.com/openhiun/hangul/14c0f6faa2941116bb53001d6a7dcd5e82300c3f/nanumbarungothic.css' rel='stylesheet' type='text/css'>
<style>
.sub02_img img {
	position:relative; width:100%;
}
#fat .sub_02_01 {position:relative; width:100%; height: 100%; background:url('/theme/basic/sub06/img/sub_02_01.jpg') no-repeat 50% 0;}
.sub_main .sub_02_02 {position:relative; width:100%; height:100%; background:url('/theme/basic/sub06/img/sub_02_02.jpg') no-repeat 50% 0;}
.sub_main .sub_02_03 {position:relative; width:100%; height:100%; background:url('/theme/basic/sub06/img/sub_02_03.jpg') no-repeat 50% 0;} 

	.tabs, .tabs li {
		outline: 1px solid #999;
	}
	.tabs li a{
		color: #000 !important;
		font-family: 'Nanum Barun Gothic', sans-serif;
	}
	.tabs .tab a:hover, .tabs .tab a.active {
		background-color: #1BB3B6 !important;
		color: #fff !important;
		text-decoration: none;
	}
	.tabs .indicator{
		display: none;
	}

.one_btn {
	display: block;
	margin: 0 auto;
	width: 25% !important;
	max-width: 372px !important;
	position: relative !important;
	top: -100px;
	cursor: pointer;
}
.two_btn {
	width: 46% !important;
	margin: 0 20px;
	cursor: pointer;
}
.two_btn_wrap {
	display: block;
	margin: 0 auto;
	position: relative;
	top: -100px;
	width: 100%;
	text-align: center;
}
</style>
<div class="sub_main" style="height: auto; min-width: 1200px;">
	<!-- 탭 -->
	<div class="row" style="margin-top: 60px; max-width: 1200px;">
		<div class="col s12">
			<ul class="tabs">
				<li class="tab col s3"><a class="active fat" href="/theme/basic/sub06/sub02.php">비만클리닉</a></li>
				<li class="tab col s3"><a class="brain" href="/theme/basic/sub06/sub03.php">뇌피트니스</a></li>
				<li class="tab col s3"><a class="pisto" href="/theme/basic/sub06/sub04.php">피스토주사</a></li>
				<li class="tab col s3"><a class="test4" href="/theme/basic/sub06/sub05.php">전후사진</a></li>
			</ul>
		</div>
	</div>

	<div id="fat" class="col s12 sub02_img" style="height:auto;">
		<img src="/theme/basic/sub06/img/sub_02_fat_01.jpg">
		<img src="/theme/basic/sub06/img/sub_02_fat_02.jpg">
		<img src="/theme/basic/sub06/img/sub_02_fat_03.jpg">
		<img src="/theme/basic/sub06/img/sub_02_fat_04.gif">
		<img src="/theme/basic/sub06/img/sub_02_fat_05.jpg">
		<img class="one_btn" src="/theme/basic/sub06/img/sub_02_fat_06.jpg" onclick="go_brain()">
		<img src="/theme/basic/sub06/img/sub_02_fat_07.jpg">
		<img src="/theme/basic/sub06/img/sub_02_fat_08.gif">
		<img src="/theme/basic/sub06/img/sub_02_fat_09.jpg">
		<img class="one_btn" src="/theme/basic/sub06/img/sub_02_fat_10.jpg"onclick="go_pisto()">
		<img src="/theme/basic/sub06/img/sub_02_fat_11.jpg">
		<img src="/theme/basic/sub06/img/sub_02_fat_12.gif">
		<img src="/theme/basic/sub06/img/sub_02_fat_13.jpg">
		<img src="/theme/basic/sub06/img/sub_02_fat_14.jpg">
		<img src="/theme/basic/sub06/img/sub_02_fat_15.gif">
		<img src="/theme/basic/sub06/img/sub_02_bottom.jpg">
		<!-- <div class="sub_02_01"></div> -->
	</div>


<script>

function not_ready(){
	alert('준비중입니다.');
	return false;
}
function go_brain(){
	location.href = "/theme/basic/sub06/sub03.php";
}
function go_pisto(){
	location.href = "/theme/basic/sub06/sub04.php";
}
</script>
<?php
include_once(G5_THEME_PATH.'/tail.php');
?>