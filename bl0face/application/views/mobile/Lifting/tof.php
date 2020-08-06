<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
	// PC
	header("Location: /Lifting/tof");
} else {
	//MOBILE
}
?>
<style>
	* {max-width: 640px; margin: 0 auto;}
	.m_header { display: block !important;}
	.sub_img { max-width: 640px;}
	.sub_img img{ margin-top: 50px;}
</style>
<div class="sub_img">
	<img src="../assets/img/sub/sub02/sub02_2_m.jpg">
</div>

<script>
$(document).ready(function(){
	$('.m_header_info li:eq(1)').trigger('click');

	$('.m_header_tab ul:eq(1) li:eq(0)').addClass('active');
});
</script>