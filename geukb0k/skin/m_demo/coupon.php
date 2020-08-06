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
.coupon_wrap {  }
.coupon_wrap img { width:100%;  }
</style>



<div class="coupon_wrap">
<a href="coupon_view.php"><img src="/skin/m_demo/img/01.png" ></a>
<a href="coupon_view2.php"><img src="/skin/m_demo/img/02.png" ></a>







</div>

<?
include_once $nfor[skin_path]."tail.php";
?>