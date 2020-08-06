<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
	// PC
	header("Location: /Obesity_clinic/NMTpisto");
} else {
	//MOBILE
}
?>
<style>
	* {max-width: 640px; margin: 0 auto;}
	.m_header { display: block !important;}
	.sub_img { max-width: 640px; display: block; margin: 0 auto;}
	.sub_img img{ width: 100%; position: relative; margin-bottom: -10px;}
	.sub_img .tab.col { padding: 0;}
	
	.sub03_tabs .tab a {
	    padding: 0 12px;
	}
	.sub03_tabs .tab a {
	    display: block;
	    font-size: 15px;
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

	.sub03_tabs, .sub03_tabs li {
		outline: 1px solid #999;
		list-style: none;
		padding: 0;
		line-height: 60px;
	}
	.row .col.s4 {
		padding: 0;
		text-align: center;
	}
	.sub03_tabs li a{
		color: #AA0010 !important;
	}
	.sub03_tabs .tab a.active {
		background-color: #AA0010 !important;
		color: #fff !important;
		text-decoration: none;
	}
	.sub03_tabs .s6{
		width: 50%;
		float: left;
		text-align: center;
	}
	.one_btn, .two_btn {
		display: block;
		margin: 0 auto;
		width: 80% !important;
		max-width: 550px !important;
		position: relative !important;
		top: -45px;
		cursor: pointer;
		
	}
	.two_btn {
		width: 100%;
		margin: 0 auto 10px auto;
	}
</style>
<div class="sub_img">
	<div class="row" style="width: 100%; max-width: 640px; margin-top: 49px; margin-bottom: 0;">
		<div class="col s12" style="padding: 0;">
			<ul class="sub03_tabs">
				<li class="tab col s6"><a class="fat lh_20" href="/Obesity_clinic/M_NMTdiet" style="padding: 10px 0;">NMT 비만클리닉</a></li>
				<li class="tab col s6"><a class="brain lh_20" href="/Obesity_clinic/M_NMTbrain" style="padding: 10px 0;">NMT 뇌피트니스</a></li>
				<li class="tab col s6"><a class="active pisto lh_20" href="/Obesity_clinic/M_NMTpisto" style="padding: 10px 0;">NMT 피스토주사</a></li>
				<li class="tab col s6"><a class="pic lh_20" href="/Obesity_clinic/M_beforeAfter_pic" style="padding: 10px 0;">전후사진</a></li>
			</ul>
		</div>
	</div>


	<div id="fat" class="col s12 sub02_img" style="height:auto;">
		<img src="../../assets/img/sub/Obesity_clinic/mobile/sub_03_pisto_01_m.jpg">
		<img src="../../assets/img/sub/Obesity_clinic/mobile/sub_03_pisto_02_m.jpg">
		<img src="../../assets/img/sub/Obesity_clinic/mobile/sub_03_pisto_03_m.jpg">
		<img src="../../assets/img/sub/Obesity_clinic/mobile/sub_03_pisto_04_m.jpg">
		<img src="../../assets/img/sub/Obesity_clinic/mobile/sub_03_pisto_05_m.jpg">
		<img src="../../assets/img/sub/Obesity_clinic/mobile/sub_03_pisto_06_m.jpg"">
		<img src="../../assets/img/sub/Obesity_clinic/mobile/sub_03_pisto_07_m.gif">
		<img src="../../assets/img/sub/Obesity_clinic/mobile/sub_03_pisto_08_m.jpg">
		<img src="../../assets/img/sub/Obesity_clinic/mobile/sub_03_pisto_09_m.gif">
		<div style="position: relative;">
			<img src="../../assets/img/sub/Obesity_clinic/mobile/sub_03_pisto_10_m.jpg" style="margin-top: -10px; position: relative;">
			<div style="position: absolute; bottom: -20px; width: 100%;">
				<img class="two_btn" src="../../assets/img/sub/Obesity_clinic/mobile/sub_03_pisto_11_m.gif" onclick="go_pic()" style="margin-bottom: 10px;">
				<img class="two_btn" src="../../assets/img/sub/Obesity_clinic/mobile/sub_03_pisto_12_m.gif" onclick="go_brain()">
			</div>
		</div>

		<img src="../../assets/img/sub/Obesity_clinic/mobile/sub_03_bottom_m.jpg?<?=rand()?>">
	</div>
</div>

<script>
$(document).ready(function(){
	$('.m_header_info li:eq(2)').trigger('click');
	$('.m_header_tab ul:eq(2) li:eq(2)').addClass('active');
});
</script>