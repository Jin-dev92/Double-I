<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
	// PC
} else {
	//MOBILE
	header("Location: /Lifting/M_duet_thermage");
}
?>
<style>
	.header_wrap  { display: block !important; position: fixed; top: 0;}
	.sub_img img{ width: 100%; position: relative; margin-top: 50px; margin-bottom: -10px;}
</style>
<div class="sub_img">
	<img src="../assets/img/sub/Lifting/duet_thermage.jpg?<?=rand()?>">
</div>