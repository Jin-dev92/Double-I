<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
	// PC
	header("Location: /Eventmodel/Eventmodel");
} else {
	//MOBILE
}
?>
<style>
* {max-width: 640px; margin: 0 auto;}
.m_header { display: block !important;}
.sub_img{ position:relative; padding-top:50px}
.sub_img img{ display:block; width:100%; max-width:1920px; margin:0 auto;}
.sub_img .btnBox{ position:absolute; left:0; bottom:4.1%; width:100%; text-align:center; z-index:1}
.sub_img .btnBox a{ display:inline-block; width:50%; height:11vw;}
</style>

<div class="sub_img">
	<img src="../assets/img/sub/Eventmodel/Eventmodel.jpg?<?=rand()?>">
    <div class="btnBox">
    	<a href="https://forms.gle/tqwFzyJWtJJsbP2p7" target="_blank"></a>
    </div>
</div>