<?php
	$conn = mysqli_connect("222.236.44.22", "ykmg", " ykmg1234" , "eventdb") or
			die( "SQL server에 연결할 수 없습니다.");
			 mysqli_set_charset($conn, 'utf8');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>설문조사</title>
  </head>
  <body>
    <img src="respon.jpg" alt="">
  </body>
</html>
