<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>


<?php
$name = $_POST['name'];
$content = $_POST['content'];
$phone = $_POST['phone1']."-".$_POST['phone2']."-".$_POST['phone3'];
$can_date = $_POST['can_date'];
$cate=$_POST['cate'];
$approach=$_POST['approach'];
$date = date("Y-m-d H:i:s");

    $conn = mysqli_connect("localhost", "bioface1", "doubleii11!@" , "bioface1") or die( "SQL server에 연결할 수 없습니다.");
         mysqli_set_charset($conn, 'utf8');

         $sql = "INSERT INTO db_event(name,phone,content,can_date,w_date,approach) VALUES('".$name."','".$phone."','".$content."','".$can_date."','".$date."','".$approach."')";
         $result = mysqli_query($conn,$sql);
         if($result){ㄴ
           ?>
           <script type="text/javascript">
             alert("이벤트 참여 감사합니다.");
             location.href="http://bioface.kr";
           </script>
           <?
         }else {
           echo "실패";
         }
    ?>
  </body>
</html>
