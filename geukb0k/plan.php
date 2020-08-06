<?php	// 회사소개
include_once "path.php";

$plan = sql_fetch("select * from nfor_plan where wr_id='$wr_id'");
$nfor[title] = $plan[wr_subject];

include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>