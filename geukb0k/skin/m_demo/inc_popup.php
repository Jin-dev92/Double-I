<?
if(!$_COOKIE[cookie_popup] and $config[cf_app_use] and $config[cf_app_img]){

	$is_popup = 0;

	if(preg_match("/(iPod|iPhone)/", $_SERVER["HTTP_USER_AGENT"]) and trim($config[cf_ios_url])) {
		$is_popup = 1;
		$popup_link = $config[cf_ios_url];
	}

	if(preg_match("/(Android)/", $_SERVER["HTTP_USER_AGENT"]) and trim($config[cf_android_url])) {
		$is_popup = 1;
		$popup_link = $config[cf_android_url];
	}

	if($is_popup){
?>

	<style>
	#popup { top:0px; width:100%; height:100%; position:fixed; z-index:99990; background-color: rgba(0, 0, 0, 0.8); }
	#app_down_wrap { left:50%; top:30%; width:300px; margin-left:-150px; display:block; position:absolute; }
	#app_down_wrap img { width:100%; cursor:pointer; }
	#popup_close { cursor:pointer; color:#fff; font-size:16px; font-weight:bold; text-align:center; text-decoration:underline; margin-top:15px; display:block; width:300px; }
	</style>

	<div id="popup">

		<div id="app_down_wrap">
			<a href="<?=$popup_link?>"><img src="<?="$nfor[path]/data/app/$config[cf_app_img]"?>" alt="어플다운로드"/></a>
			<a id="popup_close">모바일웹으로 접속해서 바로보기</a>
		</div>

	</div>

	<script type="text/javascript">
	<!--
	$(document).on("click", "#popup_close", function(){
		set_cookie("cookie_popup","appdown", "24");
		$('#popup').hide();
	});
	//-->
	</script>

<? 

	}
}
?>