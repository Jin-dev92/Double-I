<?php	// 개인정보취급방침
include_once "path.php";

$nfor[title] = "개인정보취급방침";

$privacy = sql_fetch("select * from nfor_page where wr_code='privacy'");

include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>