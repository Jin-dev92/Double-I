<?php	// 이용약관
include_once "path.php";

$nfor[title] = "이용약관";

$agreement = sql_fetch("select * from nfor_page where wr_code='agreement'");

include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>