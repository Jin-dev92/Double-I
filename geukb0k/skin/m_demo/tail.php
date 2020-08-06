	</div>
	<!-- //container -->




	<!--footer


        	<div class="footer_link">
        		<a href="agreement.php">이용약관</a>|<a href="privacy.php">개인정보취급방침</a>|<a href="safe.php">청소년보호정책</a>|<a href="http://ftc.go.kr/info/bizinfo/communicationViewPopup.jsp?wrkr_no=<?=str_number($config[cf_cp_number1])?>" target="_blank">사업자정보확인</a>
            </div>

			<div class="company">
			상호 :  <?=$config[cf_cp_name]?> | 대표자 : <?=$config[cf_cp_ceo]?> <br>
			주소 : <?=$config[cf_cp_address]?><br>
			사업자등록번호 : <?=$config[cf_cp_number1]?><br>
			통신판매업신고 : <?=$config[cf_cp_number2]?><br>
			고객센터 : <?=$config[cf_tel]?> / <?=$config[cf_email]?><br>
			개인정보보호책임자 : <?=$config[cf_cp_privacy]?>(<?=$config[cf_cp_privacy_email]?>)
			</div>

			<div class="copyright">Copyright © <?=date("Y")?> <?=$config[cf_cp_name]?> Inc. All rights reserved</div>


	//footer-->




	<?
	if(!$hide){
	?>

	<style>
	#footer { position:fixed; left:0px; bottom:0px; width:100%; height:56px; z-index:9999; background:#fff; border-top:1px solid #ccc;  }
	#footer a { display:block; float:left; width:25%; text-align:center; color:#111; font-size:13px; text-decoration:none; text-align:center; padding:7px 0px; }
	#footer i{ display:block; background:url(<?=$nfor[skin_path]?>img/layout.png) no-repeat 0 0; background-size:320px auto; width:25px; height:25px; margin:0 auto; }

	#footer .btn_home { background-position:0px 0px; }
	#footer .btn_category { background-position:-50px 0px; }
	#footer .btn_cart { background-position:-0px -150px; } 
	#footer .btn_mypage { background-position:-150px 0px; }

	#footer .btn_home.on { background-position:0px -50px; }
	#footer .btn_category.on  { background-position:-50px -50px; }
	#footer .btn_cart.on  { background-position:-100px -50px; }
	#footer .btn_mypage.on  { background-position:-150px -50px; }
	</style>
	<footer id="footer">
		<a href="index.php"><i class="btn_home <?=basename($PHP_SELF)=="index.php"?"on":""?>"></i>홈으로</a>
		<a href="category.php"><i class="btn_category <?=basename($PHP_SELF)=="category.php"?"on":""?>"></i>카테고리</a>
		<a href="cart.php"><i class="btn_cart <?=basename($PHP_SELF)=="cart.php"?"on":""?>"></i>장바구니</a>
		<a href="mypage.php"><i class="btn_mypage <?=basename($PHP_SELF)=="mypage.php"?"on":""?>"></i>마이페이지</a>
	</footer>
	<? } ?>



	<style>
	.btn_top { position:fixed; display:none; cursor:pointer; bottom:70px; right:16px; width:52px; height:52px; background:url(<?=$nfor[skin_path]?>img/layout.png) no-repeat -248px -50px; background-size:320px auto; z-index:900; }
	</style>
	<div class="btn_top"></div>


</div>
<!-- //wrap -->



<script type="text/javascript">
$(function() {
	$("img.lazy").lazyload({
		placeholder : "<?=$nfor[skin_path]?>img/white.gif",
		threshold : 300,
		skip_invisible : true,
		effect : "fadeIn"
	}).removeClass("lazy");
});

$(document).ajaxStop(function(){
	$("img.lazy").lazyload({
		threshold : 300,
		skip_invisible : true,
		effect : "fadeIn"
	}).removeClass("lazy");
});
</script>






</body>
</html>
