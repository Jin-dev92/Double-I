<?php
include "path.php";
$datetime = date("Y-m-d H:i:s");


// pay_step, od_cancelrequest, od_canceldatetime
sql_query("update nfor_order set pay_step = '5', od_cancelrequest = '$datetime', od_canceldatetime = '$datetime' where od_id='$od_id'");

$sql_cart_id = sql_fetch("select * from nfor_order where od_id = '$od_id'");
$cart_id = $sql_cart_id[cart_id];

sql_query("update nfor_cart set pay_step = '5', od_cancelrequest = '$datetime', od_canceldatetime = '$datetime' where cart_id='$cart_id'");

?>
