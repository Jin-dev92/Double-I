<?php
include_once "path.php";

$event = sql_fetch("select * from nfor_event where wr_id='$wr_id'");
$nfor[title] = $event[wr_subject];

if(!$_SESSION["wr_hit_event_{$wr_id}"]){
	sql_query(" update nfor_event set wr_hit = wr_hit + 1 where wr_id = '$wr_id' ");
	$_SESSION["wr_hit_event_{$wr_id}"] = TRUE;
}

include_once $nfor[skin_path]."event_result_view.php";
?>