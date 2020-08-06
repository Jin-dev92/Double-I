<?php	// 회사소개
include_once "path.php";

$nfor[title] = "회사소개";

$company = sql_fetch("select * from nfor_page where wr_code='company'");

include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>