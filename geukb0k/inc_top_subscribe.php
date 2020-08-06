<?php
include_once "path.php";

if($mode=="insert"){
	if(!preg_match("/([0-9a-zA-Z_-]+)@([0-9a-zA-Z_-]+)\.([0-9a-zA-Z_-]+)/", $wr_email)) die("email_match"); 
	$is_email = sql_fetch("select count(*) as cnt from nfor_subscribe where wr_email='$wr_email'");
	if(!$is_email[cnt]){
		sql_query("insert nfor_subscribe set wr_datetime=NOW(), wr_email='$wr_email'");
		die("insert");
		exit;
	} else{
		die("is_email");
	}
	exit;
}
?>