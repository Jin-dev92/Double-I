<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
	// PC
} else {
	//MOBILE
	header("Location: /Obesity_clinic/M_NMTpisto");
}
?>
<style>
	.header_wrap  { display: block !important; position: fixed; top: 0;}
	.sub_img img{ width: 100%; position: relative; margin-bottom: -10px;}

	.sub03_img img {
		position:relative; width:100%;
	}
	.tabs, .tabs li {
		outline: 1px solid #999;
	}
	.tabs li a{
		color: #000 !important;
		font-family: 'Nanum Barun Gothic', sans-serif;
	}
	.tabs .tab a:hover, .tabs .tab a.active {
		background-color: #AA0010 !important;
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
<div class="sub_img">
		<!-- 탭 -->
	<div class="row" style="margin-top: 70px; max-width: 1200px;">
		<div class="col s12">
			<ul class="tabs">
				<li class="tab col s3" onclick="go_diet();"><a class="fat" href="/Obesity_clinic/NMTdiet">NMT 비만클리닉</a></li>
				<li class="tab col s3" onclick="go_brain();"><a class="brain" href="/Obesity_clinic/NMTbrain">NMT 뇌피트니스</a></li>
				<li class="tab col s3" onclick="go_pisto();"><a class="active pisto" href="/Obesity_clinic/NMTpisto">NMT 피스토주사</a></li>
				<li class="tab col s3" onclick="go_pic();"><a class="pisto" href="/Obesity_clinic/beforeAfter_pic">전후사진</a></li>
			</ul>
		</div>
	</div>

	<div id="brain" class="col s12 sub03_img" style="height: auto;">
		<img src="../../assets/img/sub/Obesity_clinic/sub_03_pisto_01.jpg">
		<img src="../../assets/img/sub/Obesity_clinic/sub_03_pisto_02.jpg">
		<img src="../../assets/img/sub/Obesity_clinic/sub_03_pisto_03.jpg">
		<img src="../../assets/img/sub/Obesity_clinic/sub_03_pisto_04.jpg">
		<img src="../../assets/img/sub/Obesity_clinic/sub_03_pisto_05.jpg">
		<img src="../../assets/img/sub/Obesity_clinic/sub_03_pisto_06.jpg"">
		<img src="../../assets/img/sub/Obesity_clinic/sub_03_pisto_07.gif">
		<img src="../../assets/img/sub/Obesity_clinic/sub_03_pisto_08.jpg">
		<img src="../../assets/img/sub/Obesity_clinic/sub_03_pisto_09.gif">
		<img src="../../assets/img/sub/Obesity_clinic/sub_03_pisto_10.jpg" style="margin-top: -10px;">
		<div class="container two_btn_wrap">
			<img class="two_btn" style="max-width: 214px;"  src="../../assets/img/sub/Obesity_clinic/sub_03_pisto_11.gif" onclick="go_pic()">
			<img class="two_btn" style="max-width: 474px;" src="../../assets/img/sub/Obesity_clinic/sub_03_pisto_12.gif" onclick="go_brain()">
		</div>
		<img src="../../assets/img/sub/Obesity_clinic/sub_03_bottom.jpg">
	</div>
</div>