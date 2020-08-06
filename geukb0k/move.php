<?php	// 페이지이동
include_once "path.php";

$item = sql_fetch("select * from nfor_item where it_id='$it_id'");

include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>