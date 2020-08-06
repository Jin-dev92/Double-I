<?php
// $host = '222.236.44.22';
// $user = 'root';
// $pw = '1tjdgudwjdqh))&$';
// $dbName = 'eventdb';
// $mysqli = new mysqli($host, $user, $pw, $dbName);
//
// if($mysqli){
//     echo "MySQL yes";
// }else{
//     echo "MySQL no";
// }
include_once('./_common.php');
$x_point=$_POST['xpoint'];
$y_point=$_POST['ypoint'];
$date=$_POST['date'];
$screen_size=$_POST['screensize'];
$window_size=$_POST['wsize'];
$url1=$_POST['urla'];
$ipa=$_SERVER[REMOTE_ADDR];
$device=$_SERVER['HTTP_USER_AGENT'];
$query1=sql_query("INSERT INTO  g5_clickgraph(`xpoint`, `ypoint`,`date`,`time`,`screensize`,`windowsize`,`pc`,`url`,`address`,`device`) VALUES ('$x_point','$y_point',now(),now(),'$screen_size','$window_size','0','$url1','$ipa','$device')");
?>
