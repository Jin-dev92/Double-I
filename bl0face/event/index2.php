<?php
include_once('./header.php');
?>
<style media="screen">
  body{background: #252525}
</style>
    <div class="container main_content">
      <div class="row">
        <div class="col-sm-12 item_wrap">

          <script type="text/javascript">
          $(function(){
            var approach = "<?= $_GET['approach']?>";
            var json = <?=$get_json?>;
            var page = "<?=$cate?>";
            var filler = 'filler';
            var tof = 'tof';
            var tofgold = 'tofgold';
            var anti = 'anti';
            var liffting = 'liffting';
            var skin = 'skin';
            var outdata = json[page];
            var item_arr=[filler,tof,tofgold,anti,liffting,skin];
            var item_arr2=json;
            if (page!="") {
              for (var i = 0; i < json[page].length; i++) {
                var num = i+1;
              var inner ='<div class="col-sm-3 col-xs-6 item">';
              inner +='<div class="item_img_box">';
              inner +='<img src="assets/img/'+page+num+'.jpg" alt=""></div>';
              inner +='<div class="item_info_box">';
              inner +='<span class="description">'+json[page][i]['description']+'</span>';
              inner +='<span class="title">'+json[page][i]["title"]+'</span><a href="'+page+'.php?approach='+approach+'&num='+num+'" class="more_btn">자세히 보기</a> </div> </div>'
              $(".item_wrap").append(inner);
              }
            }else {

              for (var i = 0; i < item_arr.length; i++) {
                var key = item_arr[i];
                for (var j = 0; j < json[key].length; j++) {
                var num = j+1;
                var inner ='<div class="col-sm-3 col-xs-6 item">';
                inner +='<div class="item_img_box">';
                inner +='<img src="assets/img/'+key+num+'.jpg" alt=""></div>';
                inner +='<div class="item_info_box">';
                inner +='<span class="description">'+json[key][j]['description']+'</span>';
                inner +='<span class="title">'+json[key][j]["title"]+'</span><a href="'+key+'.php?approach='+approach+'&num='+num+'" class="more_btn">자세히 보기</a> </div> </div>'
                $(".item_wrap").append(inner);
                }
              }
            }
          })          </script>
          </div>
        </div>
    </div>
    <?php
    include_once('./footer.php');
    ?>
