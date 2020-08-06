<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
	// PC
} else {
	//MOBILE
	header("Location: /Eventmodel/M_Eventmodel");
}
?>
<style>
.sub_img{ position:relative;}
.sub_img img{ display:block; width:100%; max-width:1200px; margin:0 auto;}
.sub_img .btnBox{ position:absolute; left:0; bottom:4.5%; width:100%; text-align:center; z-index:1}
.sub_img .btnBox a{ display:inline-block; width:50%; height:11vw;}
</style>

<div class="sub_img">
	<img src="../assets/img/sub/Eventmodel/Eventmodel.jpg?<?=rand()?>">
    <div class="btnBox">
    	<a href="https://forms.gle/tqwFzyJWtJJsbP2p7" target="_blank"></a>
    </div>
</div>