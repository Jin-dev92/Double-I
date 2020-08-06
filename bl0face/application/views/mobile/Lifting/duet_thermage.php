<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
	// PC
	header("Location: /Lifting/duet_thermage");
} else {
	//MOBILE
}
?>
<style>
	* {max-width: 640px; margin: 0 auto;}
	.m_header { display: block !important;}
	.sub_img { max-width: 640px; margin-bottom: -10px;}
	.sub_img img{ margin-top: 50px;}
</style>
<div class="sub_img">
	<img src="../assets/img/sub/Lifting/duet_thermage_m.jpg?<?=rand()?>">
</div>

<script>
$(document).ready(function(){
	$('.m_header_info li:eq(1)').trigger('click');
	$('.m_header_tab ul:eq(1) li:eq(6)').addClass('active');
});
</script>