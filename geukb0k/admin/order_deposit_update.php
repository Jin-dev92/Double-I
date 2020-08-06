<?php
include "path.php";
$datetime = date("Y-m-d H:i:s");


// pay_step, od_cancelrequest, od_canceldatetime
sql_query("update nfor_order set pay_step = '1', od_paydatetime = '$datetime' where od_id='$od_id'");



$sql_cart_id = sql_fetch("select * from nfor_order where od_id = '$od_id'");
$cart_id = $sql_cart_id[cart_id];

// nfor_cart UPDATE
sql_query("update nfor_cart set pay_step = '1' where cart_id='$cart_id'");

$sql_it_id = sql_fetch("select * from nfor_cart where cart_id = '$cart_id'");
$it_id = $sql_it_id[it_id];

// 현재 판매량
$current_volume = sql_fetch("select it_sales_volume from nfor_item where it_id = '$it_id'");
$update_volume = $current_volume[it_sales_volume] + 1;

// 판매량 업데이트
sql_query("update nfor_item set it_sales_volume = '$update_volume' where it_id = '$it_id'");
?>
