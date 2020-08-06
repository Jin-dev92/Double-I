<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
	// PC
	header("Location: /AboutUs/doctor_intro");
} else {
	//MOBILE
}
?>
<style>
	* {max-width: 640px; margin: 0 auto;}
	.m_header { display: block !important;}
	.sub_img { max-width: 640px;}
	.sub_img img{ margin-top: 50px; margin-bottom: -10px;}
</style>
<div class="sub_img">
	<img src="../assets/img/sub/AboutUs/doctor_intro_m_200508.jpg?<?=rand()?>">
</div>

<script>
$(document).ready(function(){
	$('.m_header_info li:eq(0)').trigger('click');
	$('.m_header_tab ul:eq(0) li:eq(1)').addClass('active');
});
</script>