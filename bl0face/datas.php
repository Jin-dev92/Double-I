<?php
header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = biofacedb.xls" );
header( "Content-Description: PHP4 Generated Data" );
  $conn = mysqli_connect("localhost", "bioface1", "doubleii11!@" , "bioface1") or
      die( "SQL server에 연결할 수 없습니다.");
       mysqli_set_charset($conn, 'utf8');
  $sql = "select * from db_event";
  $result = $conn->query($sql);
  echo "<meta content=\"application/vnd.ms-excel; charset=UTF-8\" name=\"Content-type\"> ";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>DB체크</title>
    <style media="screen">
    h1 {text-align: center;}
      .wrap{width: 100%;position: relative;}
      .wrap table{width: 800px; border-collapse: collapse; margin: 0 auto;}
      th{background: #ddd; border: 1px solid #ccc;}
      td{border: 1px solid #ccc;}
    </style>
  </head>

  <body>
      <div class="wrap">
        <h1>비오페이스 설문 결과</h1>
        <table>
          <tr>
            <th>이름</th>
            <th>전화번호</th>
            <th>상담항목</th>
            <th>상담가능시간</th>
            <th>등록날짜</th>
            <th>유입경로</th>
          </tr>

            <?for ($i=0; $row = $result->fetch_array(); $i++) {
              ?>
              <tr>
              <td><?=$row[name]?></td>
              <td><?=$row[phone]?></td>
              <td><?=$row[cate]?></td>
              <td><?=$row[can_date]?></td>
              <td><?=$row[w_date]?></td>
              <td><?=$row[approach]?></td>
              </tr>
              <?
            }?>

        </table>

      </div>
  </body>
</html>
