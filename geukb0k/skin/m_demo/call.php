<?php
include_once $nfor[skin_path]."head.php";

$banner = sql_fetch("select * from nfor_banner where wr_use='1' and wr_code='mobile_call' and wr_sdate<='$nfor[ymdhis]' and wr_edate>='$nfor[ymdhis]' order by wr_rank desc");
?>
<style>
.banner{width:100%;text-align:center;}
.banner img{width:100%;}
.my-call{padding: 20px 10px 10px;text-align: center;}
.my-call_intro-text{text-align:center;font-size:15px;color:#555;height:36px;line-height:20px;font-family:Malgun Gothic;}
.my-call_btn{margin: 30px 0;box-sizing: border-box;}
.my-btn {
	color: #fff;
    width: 260px;
    background-color: #ec3940;
    border-color: #ec3940;
	border-bottom-width: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
	cursor: pointer;
    display: inline-block;
    overflow: visible;
    text-align: center;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
	font-size: 17px;
    line-height: 25px;
    padding: 9px 8px 8px;
    height: 45px;
}
</style>
<div>
	<?
	if($banner[wr_banner_img]){
	?>
	<div class="banner">	
		<a href="<?=$banner[wr_banner_link]?>" target="<?=$banner[wr_target]?>"><img src="<?="$nfor[path]/data/banner/$banner[wr_banner_img]"?>" alt=""></a>
	</div>
	<? } ?>
	<div class="my-call">
		<div class="my-call_intro-text">
               356일 놀라운 감동이 있는 <?=$config[cf_name]?> 고객센터<br>
                문의사항이 있으시면 언제든지 연락주세요.
		</div>
		<div class="my-call_btn">
		<a href="tel:<?=str_number($config[cf_tel])?>" class="my-btn">전화걸기</a>
		</div>
	</div>

</div>

<?
include_once $nfor[skin_path]."tail.php";
?>