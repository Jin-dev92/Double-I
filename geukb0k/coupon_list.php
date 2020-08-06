<?php
include_once "path.php";

$nfor[title] = "할인쿠폰";

if(!$member[mb_no]) goto_url("login.php?url=coupon_list.php");

include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>