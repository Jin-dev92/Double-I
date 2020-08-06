<?php
include "path.php";

$location = sql_fetch("select * from nfor_item_location where wr_id='$wr_id'");

$nfor[title] = $location[wr_name]?$location[wr_name]:"지도확대";

include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>