<style>
.bg { display: block; width: 100%; min-width: 1200px;}
.container { min-width: 1200px;}
.board_title { padding-left: 0}
.list { max-width: 1200px; width: 80%; display: block; margin: 0 auto;}
.list > ul li{ padding: 30px 0 !important;}

.album_ul li:hover { background-color: #eee;}

.album_img { max-height: 282px; cursor: pointer; padding: 0;}
.close_event { max-height: 282px !important;}
.open_event { max-height: 10000px !important;}
.album_img img:nth-child(2) { display: none;}
.open_event img:nth-child(2) { display: block !important;}
footer {
  display: table;
  width: 100%;
}
</style>
<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
    // PC
} else {
    ?>
    <!-- //MOBILE -->
    <style>
      * {max-width: 640px; margin: 0 auto;}
      .list_wrap { display: block; width: 100%; max-width: 640px; margin: 0 auto;}
      .m_header { display: block !important;}
      .agree { width: 100%; padding: 20px; }
      .bg { display: none !important;}
      .container { max-width: 640px; min-width: 300px !important; padding: 0;}
      .list { padding: 60px 0px 0 0px; width: 100% !important;}
      .album_img { max-height: 100px}
      .album_img img { max-width: 1200px !important;}
      .list > ul li{ padding: 10px 5px 10px 5px !important;}
      .album_name { padding-top: 60px;}
      .board_title {margin: 20px auto;}
      .album_title {padding-right: 0;}
    </style>
<?}?>

<img class="bg" src="/assets/img/sub/sub_main_head_img.jpg">

<div class="list_wrap">
  <div class="list">
    <h1 class="board_title align_center"><?=$list['board_title']?></h1>


        <?
        if ($this->session->userdata('level')==10) {

          ?>
          <div class="list_btns">
          <a href="/board/write/<?=$this->uri->segment(3)?>">
            <div class="board_list_btn">
              글쓰기
            </div>
            </a>
            </div>
          <?
        }?>


    <ul class="album_ul">

      <?
      $x_idx =1;
      $page_max = $list['page'] * $list['page_limit'];
      $page_min = $page_max- $list['page_limit'];
        foreach ($list as $entry) {
            $wr_id = $entry['wr_id'];
          if(!$entry['wr_id']){
            break;
          }
            if ($x_idx > $page_max) {
              break;
            }
            if ($x_idx <= $page_max && $x_idx >= $page_min+1) {
            $wr_date =  explode(" ",$entry['wr_datetime']);
          ?>
          <li>
            <!-- <a href="/board/view/<?=$this->uri->segment(3)?>/<?=$entry['wr_id']?>"> -->
            <div class="album_img" style="width: 100%;">
              <?

              // 썸네일 가져오기
              $thumb = $this->Board_m->getImage($this->uri->segment(3),$entry['wr_id']);

              // print_r($thumb);
              // echo $thumb[0]['bf_file'];

              $cnt_img = count($list['album_img']);
              for ($i=0; $i < $cnt_img; $i++) {
                if ($list['album_img'][$i]['wr_id']==$entry['wr_id']) {
                  ?>
                    <img src="/data/file/<?=$list['album_img'][$i]['bo_table']?>/<?=$list['album_img'][$i]['bf_file']?>" alt="" style="width: 100%; max-width: 1200px;">
                    

                  <?
                }
              }
              ?>
            </div>
          <!-- </a> -->
        </li>
          <?
          }
          $x_idx++;
        }
      ?>
    </ul>
    <div class="paging_line">
      <ul>
        <li class="f_e_li"><a href="/board/lists/<?=$this->uri->segment(3)?>/1">처음</a></li>
        <?
        $page = $this->uri->segment(4);
        if ($page<1) {
          $page=1;
        }
          $total_page = ceil($list['total']/$list['page_scale']);
          $start_page = ((ceil($page/$list['page_scale'])-1)*$list['page_scale'])+1;
          $end_page = $start_page + $list['page_scale']-1;
          if ($end_page >=$total_page) {
              $end_page = $total_page;
          }
          if ($start_page>$list['page_scale'])
          {
            echo "<li><a href='/board/lists/".$this->uri->segment(3)."/".($start_page-1)."'>이전</a></li>";
          }
          $paging_str="";
          if ($total_page>=1) {
            for ($i=$start_page; $i <=$end_page ; $i++) {
              if ($page==$i) {
                $paging_str .="<li class='paging_active'>[$i]</li>";
              }else {
                $paging_str .="<li><a href='/board/lists/".$this->uri->segment(3)."/".$i."'>".$i."</a></li>";
              }
            }
          }
          echo $paging_str;
        ?>
        <li class="f_e_li"><a href="/board/lists/<?=$this->uri->segment(3)?>/<?=$start_page+$list['page_scale']?>">다음</a></li>
      </ul>

    </div>
  </div>
</div>
<script>
$('.album_img').on('click', function(){
  $('.album_img').addClass('close_event');
  $('.album_img').removeClass('open_event');

  $(this).removeClass('close_event');
  $(this).addClass('open_event');

//  $(this).parent('li').clone(true).prependTo('.album_ul');
//  $(this).parent('li').remove();

//  $('body,html').animate({scrollTop:100},200);

	var tmp = $(this).offset().top;
    $("html, body").animate({ scrollTop: tmp}, "slow");
    return false;
});

</script>

