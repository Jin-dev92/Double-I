<?php
include_once "path.php";

$nfor[title] = "공지사항";

$notice = sql_fetch("select * from nfor_notice where wr_id='$wr_id'");

if(!$_SESSION["wr_hit_notice_{$wr_id}"]){
	sql_query(" update nfor_notice set wr_hit = wr_hit + 1 where wr_id = '$wr_id' ");
	$_SESSION["wr_hit_notice_{$wr_id}"] = TRUE;
}

include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>