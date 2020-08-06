<?php
include_once $nfor[skin_path]."head.php";
?>

<style>
.wrap_share_sms { margin:0px; padding:10px 10px; width:100%; box-sizing:border-box; -webkit-box-sizing:border-box;  }
.row { margin-bottom:5px; }
.info_msg { color:#888; font-size:13px; letter-spacing:-1px; }
.copy_msg { padding:30px 10px; border:solid 1px #d4d4d4; background-color:#fff; color:#222; font-size:14px; letter-spacing:-1px; }
</style>

<div class="wrap_share_sms">

<div class="row">
	<span class="info_msg">상품정보를 복사하셔서 문자메시지를 발송하세요.</span>
</div>
<div class="row">
	<div class="copy_msg">
	[<?=$config[cf_name]?>] <?=$item[it_name]?><br>
	<?=$item[it_description]?><br>
	<?=google_url("$nfor[url]/item.php?it_id=$item[it_id]")?>
	</div>
</div>

</div>
<?
include_once $nfor[skin_path]."tail.php";
?>