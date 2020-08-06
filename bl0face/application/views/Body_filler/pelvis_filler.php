<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
	// PC
} else {
	//MOBILE
	header("Location: /Body_filler/M_pelvis_filler");
}
?>
<style>
	.header_wrap  { display: block !important; position: fixed; top: 0;}
	.sub_img img{ width: 100%; position: relative; margin-top: 50px; margin-bottom: -10px;}
</style>
<div class="sub_img">
	<img src="../assets/img/sub/Body_filler/pelvis_filler.jpg?190509">
</div>