<?php	// 페이지
include_once "path.php";

$page = sql_fetch("select * from nfor_page where wr_code='$wr_code'");

$nfor[title] = $page[wr_subject];

include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>