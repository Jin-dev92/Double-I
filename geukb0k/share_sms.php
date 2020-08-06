<?php	// 문자공유
include "path.php";

$item = sql_fetch("select * from nfor_item where it_id='$it_id'");

$nfor[title] = "SMS문자공유";

include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>