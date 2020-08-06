<!doctype html>
<html><head>
<meta charset="utf-8">
<? if($item[it_id] and basename($PHP_SELF)=="item.php"){ ?>
<meta property="og:url" content="<?=$nfor[url]."/item.php?it_id=".$item[it_id]?>" />
<meta property="og:title" content="<?=$item[it_name]?>" />
<meta property="og:description" content="<?=$item[it_description]?>" />
<meta property="og:image" content="<?="$nfor[url]/data/main/$item[it_img_m1]"?>" />
<meta property="og:image:type" content="image/jpeg" />
<? } ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0" />
<title><?=$config[cf_name]?></title>
<link href="<?=$nfor[skin_path]?>css/style.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="<?=$nfor[path]?>/js/jquery.bxslider.min.js"></script>
<link href="<?=$nfor[path]?>/css/jquery.bxslider.css" rel="stylesheet" />
<script src="<?=$nfor[path]?>/js/jquery.countdown.min.js"></script>

<script src="<?=$nfor[path]?>/js/placeholders.jquery.min.js"></script>




<script src="<?=$nfor[path]?>/js/nfor.js"></script>
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script type="text/javascript">
<!--
var is_member = "<?=$is_member?>";
var nfor_path = "<?=$nfor[path]?>";
var nfor_url = "<?=$nfor[url]?>";
var nfor_name = "<?=$config[cf_name]?>";
//-->
</script>
<?
if($config[cf_naverpay_use]){
?>
<script type="text/javascript" src="http://<?=$config[cf_naverpay_test]?"test-":""?>pay.naver.com/customer/js/naverPayButton.js" charset="UTF-8"></script>
<script type="text/javascript" src="http://wcs.naver.net/wcslog.js"></script>
<script type="text/javascript">
if(!wcs_add) var wcs_add = {};
wcs_add["wa"] = "<?=$config[cf_naverpay_wcs_add]?>";
wcs.inflow("<?=$HTTP_HOST?>");
</script>
<? } ?>
</head>
<body>


<style>
.findid {width: 362px; margin: 0 auto; padding: 28px 20px;}
.findid h2{ width:349px; padding-bottom:5px; margin-bottom:25px; border-bottom: 1px solid #d6d6d6; font-size:1.3em; font-weight:bold; display:block; }
.findid h3{ margin-bottom:10px; font-size: 1.1em; font-weight:bold; }
.back{width:325px; height:75px;padding: 16px 0 0 24px; background: #f5f5f5;}
.btn{ line-height:45px ;text-align:center; display:block; color:#FFF; width: 150px; height:45px; font-size:1.1em; color:#fff; font-weight:bold; cursor:pointer; border-radius:3px;  -webkit-border-radius: 3px; background:#a676f4; border:0px; margin: 20px auto;}
.back2{ width:331px; height:32px;padding:16px 0 0 18px; margin-bottom: 15px; background: #f5f5f5;}
.back2 p{ font-size: 14px; color: #333; float: left;}
.btn2{ width:110px; height:25px; margin-top:-4px; margin-right:10px; border:solid 1px #CCC; line-height:25px; float:right; display:block; -webkit-border-radius: 0;-moz-border-radius: 0; border-radius:2; text-align:center; background:#DCDCD; }

</style>



<form name="find_id_form" method="post">



<div class="findid">
	<h2>아이디찾기</h2>

	<h3>휴대폰 번호로 찾기</h3>

	<div class="back">
	<span style="width: 78px; margin-top: 6px; float: left; font-weight: bold;">이름</span>
	<input type="text" name="mb_name" id="mb_name_1" class="mb_name" placeholder="이름" style=" width:170px; margin-bottom:15px; display: block;">
	<span style="width: 78px; margin-top: 6px; float: left; font-weight: bold;">핸드폰번호</span>
	<input type="text"  name="mb_hp" id="mb_hp" placeholder="휴대폰번호 (-없이 입력)">
	</div>

	<a href="#" class="btn" id="hp_check_btn">핸드폰번호로 찾기</a>



	<h3>이메일로 찾기</h3>

	<div class="back">
	<span style="width: 78px; margin-top: 6px; float: left; font-weight: bold;">이름</span>	
	<input type="text" name="mb_name" id="mb_name_2" class="mb_name" placeholder="이름" style=" width:170px; margin-bottom:15px; display: block;">
	<span style="width: 78px; margin-top: 6px; float: left; font-weight: bold;">이메일</span>
	<input type="email" name="mb_email" id="mb_email" placeholder="이메일" style=" width:170px; margin-bottom:15px; display: block;">
	</div>

	<a href="#" class="btn" id="email_check_btn">이메일로 찾기</a>


	<div class="back2">
	<p>☎ 고객센터 : <?=$config[cf_tel]?></p> 
	<a href="find_password.php" class="btn2" style="cursor: pointer;">비밀번호 찾기</a>
	</div>


</div>


</form>

<script type="text/javascript">
<!--
$(document).on("click","#hp_check_btn",function(){
	find_id("hp_check");
});

$(document).on("click","#email_check_btn",function(){
	find_id("email_check");
});
//-->
</script>


</body>
</html>