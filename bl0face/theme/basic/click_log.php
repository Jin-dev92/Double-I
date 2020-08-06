
    <meta charset="utf-8">

    <style media="screen">
      .clickFrm{width: 100%; height: 100%; margin:0 auto;}
    </style>

    <form name="frm" action="point_graph.php" method="post" class="clickFrm">
          날짜: <input type="date" class="_date1" name="_date1" value=""> ~ <input type="date" class="_date2" value="" name="_date2"><br><br>
          시간: <input type="time" name="_time1" value="" class="_time1"> ~ <input type="time" name="_time2" value="" class="_time2"><br><br>
          <!-- <input type="text"  name="url" value="" placeholder="URL을 입력하세요."> -->
          <select class="sel" name="websel">
            <option value="pc">PC</option>
            <option value="mobile">모바일</option>
          </select>
          <input type="submit" name="" value="GO!" class="submit_btn">
    </form>
