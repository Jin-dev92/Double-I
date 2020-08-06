<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
	// PC
} else {
	//MOBILE
	header("Location: /Obesity_clinic/M_NMTbrain");
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
				<li class="tab col s3" onclick="go_brain();"><a class="active brain" href="/Obesity_clinic/NMTbrain">NMT 뇌피트니스</a></li>
				<li class="tab col s3" onclick="go_pisto();"><a class="pisto" href="/Obesity_clinic/NMTpisto">NMT 피스토주사</a></li>
				<li class="tab col s3" onclick="go_pic();"><a class="pisto" href="/Obesity_clinic/beforeAfter_pic">전후사진</a></li>
			</ul>
		</div>
	</div>

	<div id="brain" class="col s12 sub03_img" style="height: auto;">
		<img src="../../assets/img/sub/Obesity_clinic/sub_03_brain_01.jpg?<?=rand()?>">
		<img src="../../assets/img/sub/Obesity_clinic/sub_03_brain_02.jpg?<?=rand()?>">
		<img src="../../assets/img/sub/Obesity_clinic/sub_03_brain_03.gif?<?=rand()?>">

		<img src="../../assets/img/sub/Obesity_clinic/sub_03_brain_04.jpg?<?=rand()?>">
		<img src="../../assets/img/sub/Obesity_clinic/sub_03_brain_05.jpg?<?=rand()?>">
		<img src="../../assets/img/sub/Obesity_clinic/sub_03_brain_06.jpg?<?=rand()?>"">
		<img src="../../assets/img/sub/Obesity_clinic/sub_03_brain_07.gif?<?=rand()?>">

		<img src="../../assets/img/sub/Obesity_clinic/sub_03_brain_08.jpg?<?=rand()?>">
		<img src="../../assets/img/sub/Obesity_clinic/sub_03_brain_09.jpg?<?=rand()?>">
		<img src="../../assets/img/sub/Obesity_clinic/sub_03_brain_10.gif?<?=rand()?>">

		<img src="../../assets/img/sub/Obesity_clinic/sub_03_brain_11.gif?<?=rand()?>">
		<img src="../../assets/img/sub/Obesity_clinic/sub_03_brain_12.jpg?<?=rand()?>" style="margin-top: -10px;">
		<div class="container two_btn_wrap">
			<img class="two_btn" style="max-width: 214px;" src="../../assets/img/sub/Obesity_clinic/sub_03_brain_13.gif?<?=rand()?>" onclick="go_pic()">
			<img class="two_btn" style="max-width: 474px;" src="../../assets/img/sub/Obesity_clinic/sub_03_brain_14.gif?<?=rand()?>" onclick="go_pisto()">
		</div>
		<img src="../../assets/img/sub/Obesity_clinic/sub_03_bottom.jpg?<?=rand()?>">
	</div>
</div>