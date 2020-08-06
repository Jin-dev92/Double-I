<?php include_once('./_common.php'); ?>
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript" ></script>
<?php
$date1= $_POST['_date1'];
$date2= $_POST['_date2'];
$time1= $_POST['_time1'];
$time2= $_POST['_time2'];
$websel=$_POST['websel'];
if ($websel=='pc') {
  $query1=sql_query("SELECT * FROM g5_clickgraph WHERE pc=1 and date between '$date1' and '$date2' and time between '$time1' and '$time2';");
}if($websel=='mobile') {
  $query1=sql_query("SELECT * FROM g5_clickgraph WHERE pc=0 and date between '$date1' and '$date2' and time between '$time1' and '$time2' and xpoint!='';");
}
?>
<style media="screen">
  body{margin:0; }
  #iframe{position: fixed; top:0; left:0; opacity:0.7;z-index: 0; }
  #myCanvas{z-index: -1; position: absolute; top:0; left:0;}
  #bb{width:100%; position: absolute; top: 0; left: 0; }

</style>
  <body id="tbody">
    <canvas id="myCanvas" width="1920px" height="6000px">This browser doesn't support canvas</canvas>

    <?php
      if ($websel =='pc') {
        ?>
        <iframe src="http://bioface.kr/?device=pc" width="100%" height="100%" id="iframe" scrolling="yes" ></iframe>
        <?
      }else {
        ?>
        <iframe src="http://bioface.kr/?device=mobile" width="100%" height="100%" id="iframe" scrolling="yes" ></iframe>
        <?
      }
     ?>




   <div class="btn">
     <button type="button" name="button" class="btns">점위치바꾸기</button>
   </div>
   <style media="screen">
     .btn{position: fixed; right: 10px; top:10px;z-index: 999999}
   </style>
  </body>
<script type="text/javascript">

$(function(){
  $(".btns").click(function(){
    if ($(".btns").text()=="점위치바꾸기") {
      $("#myCanvas").css("z-index",99);
      $(".btns").text("배경위치바꾸기");
    }else {
      $("#myCanvas").css("z-index",0);
      $(".btns").text("점위치바꾸기");
    }

  });

  $(window).scroll(function(){
    var i_height = $(this).scrollTop();
    console.log("점 위치:" + i_height);
  })
  var ctx = document.getElementById('myCanvas').getContext('2d');
  <?php
  while ($row1=sql_fetch_array($query1)) {
  # code...
  ?>
  ctx.beginPath();
  var screen_size="<?=$row1['screensize']?>";
  var w=screen_size.split("X")[0];
  var h=screen_size.split("X")[1];
  var window_size="<?=$row1['windowsize']?>";
  var window_w=window_size.split("X")[0];
  var window_h=window_size.split("X")[1];
  var x_ratio= <?=$row1['xpoint']?>/window_w;  //반응형
  var y_ratio=<?=$row1['ypoint']?>/h;
  var x=w*x_ratio;
  var y=h*y_ratio;
  $("#bb").css("height",window_h);
  <?php if ($websel=='pc') {?>
    ctx.arc(x, y, 2, 1,(Math.PI/180) *360,false);<?

  }if($websel =='mobile') {?>
    ctx.arc(x+830, y, 2, 1,(Math.PI/180) *360,false);<?
  } ?>
  ctx.fillStyle = "#ff0000";  //채울 색상
  ctx.fill();
  ctx.closePath();
  <?
}
   ?>






})

</script>

<!-- <script type="text/javascript">
$(document).ready(function () {

});
</script> -->
