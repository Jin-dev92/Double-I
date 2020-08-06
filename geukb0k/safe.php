<?php	// 청소년보호정책
include_once "path.php";

$safe = sql_fetch("select * from nfor_page where wr_code='safe'");

include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>