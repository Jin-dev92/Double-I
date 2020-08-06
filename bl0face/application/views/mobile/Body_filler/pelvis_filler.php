<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
	// PC
	header("Location: /Body_filler/pelvis_filler");
} else {
	//MOBILE
}
?>
<style>
	* {max-width: 640px; margin: 0 auto;}
	.m_header { display: block !important;}
	.sub_img { max-width: 640px;}
	.sub_img img{ margin-top: 50px; margin-bottom: -10px; width: 100%;}
</style>
<div class="sub_img">
	<img src="../assets/img/sub/Body_filler/pelvis_filler_m.jpg?190509">
</div>

<script>
$(document).ready(function(){
	$('.m_header_info li:eq(3)').trigger('click');
	$('.m_header_tab ul:eq(3) li:eq(0)').addClass('active');
});
</script>