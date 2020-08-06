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


<div style="background-color:#eee;padding-top:50px;padding-bottom:50px;">

	<a href="/"><div class="indexlogo2">픽리업</div></a>
	<div style="width:600px; margin:0 auto; background-color:#fff; border:solid 1px #DCDCDC;padding:30px;">