<?php
define('_INDEX_', true);
include_once('./_common.php');

include_once(G5_THEME_MOBILE_PATH.'/include/sub_head.php');
?>
<?php
include_once(G5_THEME_MOBILE_PATH.'/include/sub_main_head1.php');
?>
<!-- Compiled and minified CSS -->
<!-- <link rel="stylesheet" href="/theme/basic/css/materialize.min.css"> -->
<link href='https://cdn.rawgit.com/openhiun/hangul/14c0f6faa2941116bb53001d6a7dcd5e82300c3f/nanumbarungothic.css' rel='stylesheet' type='text/css'>
<style>
	.sub02_tabs .tab a {
	    padding: 0 12px;
	}
	.sub02_tabs .tab a {
	    display: block;
	    font-size: 20px;
	    -webkit-transition: color .28s ease, background-color .28s ease;
	    transition: color .28s ease, background-color .28s ease;
	}
	a:link, a:visited {
	    color: #000;
	    text-decoration: none;
	}

	.sub02_img img {
		position:relative; width:100%;
	}

	.sub02_tabs, .sub02_tabs li {
		outline: 1px solid #999;
		list-style: none;
		padding: 0;
		line-height: 60px;
	}
	.sub02_tabs li a{
		color: #000 !important;
		font-family: 'Nanum Barun Gothic', sans-serif;
	}
	.sub02_tabs .tab a.active {
		background-color: #1BB3B6 !important;
		color: #fff !important;
		text-decoration: none;
	}
	.sub02_tabs .s6{
		width: 50%;
		float: left;
		text-align: center;
	}
	.one_btn, .two_btn {
		display: block;
		margin: 0 auto;
		width: 100% !important;
		max-width: 550px !important;
		position: relative !important;
		top: -130px;
		cursor: pointer;
		
	}
	.two_btn {
		margin-bottom: 10px;
		top: -150px;
	}
</style>

<div id="sub_title">
		<ul class="sub_ul">
			<li class="sub_li01"><a href="http://www.bioface.kr"><img src="/theme/basic/include/img/sub_home_icon.png">HOME</a></li>
			<span>-</span>
			<li class="sub_li02">PISTO</li>
		</ul>
</div>
<div class="sub_main">
	<!-- ? -->
	<div class="row" style="width: 100%; max-width: 640px;">
		<div class="col s12" style="padding: 0;">
			<ul class="sub02_tabs">
				<li class="tab col s6"><a class="fat" href="/theme/basic/sub06/sub02.php">비만클리닉</a></li>
				<li class="tab col s6"><a class="brain" href="/theme/basic/sub06/sub03.php">뇌피트니스</a></li>
				<li class="tab col s6"><a class="active pisto" href="/theme/basic/sub06/sub04.php">피스토주사</a></li>
				<li class="tab col s6"><a class="test4" href="/theme/basic/sub06/sub05.php">전후사진</a></li>
			</ul>
		</div>
	</div>

	<div id="pisto" class="col s12 sub02_img" style="height: auto;">
		<img src="/theme/basic/mobile/sub06/img/sub_02_pisto_01_m.jpg">
		<img src="/theme/basic/mobile/sub06/img/sub_02_pisto_02_m.jpg">
		<img src="/theme/basic/mobile/sub06/img/sub_02_pisto_03_m.jpg">
		<img src="/theme/basic/mobile/sub06/img/sub_02_pisto_04_m.gif">
		<img src="/theme/basic/mobile/sub06/img/sub_02_pisto_05_m.jpg">
		<img src="/theme/basic/mobile/sub06/img/sub_02_pisto_06_m.jpg"">
		<img src="/theme/basic/mobile/sub06/img/sub_02_pisto_07_m.gif">
		<img src="/theme/basic/mobile/sub06/img/sub_02_pisto_08_m.jpg">
		<img src="/theme/basic/mobile/sub06/img/sub_02_pisto_09_m.gif">
		<img src="/theme/basic/mobile/sub06/img/sub_02_pisto_10_m.jpg">
		<img class="two_btn" src="/theme/basic/mobile/sub06/img/sub_02_pisto_11_m.gif" onclick="go_pic()">
		<img class="two_btn" src="/theme/basic/mobile/sub06/img/sub_02_pisto_12_m.gif" onclick="go_brain()">
		<img src="/theme/basic/mobile/sub06/img/sub_02_bottom_m.jpg">
	</div>
</div>

<script>

function not_ready(){
	alert('준비중입니다.');
	return false;
}
function go_brain(){
	location.href = "/theme/basic/sub06/sub03.php";
}
function go_pic(){
	location.href = "/theme/basic/sub06/sub05.php";
}
</script>
<?php
include_once(G5_THEME_PATH.'/tail.php');
?>