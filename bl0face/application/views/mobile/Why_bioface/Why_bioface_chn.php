<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
	// PC
	header("Location: /Why_bioface/Why_bioface_chn");
} else {
	//MOBILE
}
?>
<style>
* {max-width: 640px; margin: 0 auto;}
.m_header { display: block !important;}
.sub_img{ position:relative; max-width: 640px; margin-top: 50px;}
.sub_img img{ display:block; width:100%; }
.sub_img .snsBox{ position:absolute; left:0; bottom:1.5%; width:100%; text-align:center; z-index:1}
.sub_img .snsBox a{ display:inline-block; width:10%; margin:0 3.5vw;}
</style>

<div class="sub_img">
	<img src="../assets/img/sub/Why_bioface/whybioface_chn_m_200213.jpg?<?=rand()?>">
    <div class="snsBox">
    	<a href="https://www.facebook.com/biofacesinsa/" target="_blank"><img src="../assets/img/sub_sns01.png"></a>
        <a href="https://www.youtube.com/channel/UCVutFT6uS2peN2FscXaHSwg/featured?view_as=subscriber" target="_blank"><img src="../assets/img/sub_sns02.png"></a>
        <a href="https://www.instagram.com/bioface_clinic/" target="_blank"><img src="../assets/img/sub_sns03.png"></a>
        <a href="https://blog.naver.com/suwoni" target="_blank"><img src="../assets/img/sub_sns04.png"></a>
        <a href="https://pf.kakao.com/_xaiCuxd/" target="_blank"><img src="../assets/img/sub_sns05.png"></a>
    </div>
</div>