<?php
include_once $nfor[skin_path]."head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
$(document).on("click", "#money_msg_btn", function(){
	if($("#money_msg_wrap").css('display')=="none"){
		$("#money_msg_wrap").show();
	} else{
		$("#money_msg_wrap").hide();	
	}
});
//-->
</SCRIPT>

<style>
.coupon_wrap { width:100%;  }
.coupon_wrap img { width:100%;  }
.coupon_down{ width: 100%; margin: 0 auto; text-align: center;}
.coupon_down_m { width: 240px;height: 120px; margin: 50px auto 20px; background-repeat: no-repeat;background-size: 240px 120px; background-image: url('<?=$nfor[skin_path]?>img/coupondd.png');}
.coupon_down_m b{ display: block; color: #292929; font-size: 40px; font-family: Tahoma; padding-top: 20px;}
</style>



<div class="coupon_wrap">
<img src="<?=$nfor[skin_path]?>img/02de.png" >
	<div class="coupon_down">
		<div class="coupon_down_m">
			<b>5,000원</b> 
			<span>15,000원구매시</span>
		</div>
		<button style=" width:240px; height:45px;background: #ff0000; border:0px; border-radius: 5px; color:#FFF; margin-bottom:30px;" >다운받기 </button>
	</div>
<img src="<?=$nfor[skin_path]?>img/01end.png" >
</div>

<?
include_once $nfor[skin_path]."tail.php";
?>