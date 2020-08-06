<style>
.bg { display: block; width: 100%; min-width: 1200px;}
.container { min-width: 1200px;}
.board_title { padding-left: 0}
.list { max-width: 1200px; width: 80%; display: block; margin: 0 auto;}
.list > ul li{ padding: 30px 0 !important;}
footer {
  display: table;
  width: 100%;
}
.ths { background-color: #AA0010 !important; color: #fff;}
.album_ul tr th { width: 10%}
.album_ul tr th:nth-child(2) { width: 60%;}
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
      .album_img img { max-width: 80px;}
      .list > ul li{ padding: 10px 5px 10px 5px !important;}
      .album_name { padding-top: 60px;}
      .board_title {margin: 20px auto;}
      .album_title {padding-right: 0;}
      .album_ul tr th:nth-child(3), .album_ul tr th:nth-child(5) { width: 15%;}
      .album_ul tr th:nth-child(2) { width: 40%;}
      .album_ul img { margin-bottom: 5px;}
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
    }
?>


    <table class="album_ul">
      <thead>
        <tr>
          <th class="ths align_center for_pc">No.</th>
          <th class="ths align_center for_pc">제목</th>
          <th class="ths align_center for_pc">작성자</th>
          <th class="ths align_center for_pc">작성일</th>
          <th class="ths align_center for_pc">조회수</th>
        </tr>
      </thead>

      <tbody>
<?
        $x_idx =1;
        $page_max = $list['page'] * $list['page_limit'];
        $page_min = $page_max- $list['page_limit'];

        $no = 1;
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



            <tr>
              <td class="align_center for_pc"><?=$no?></td>

              <td>
                <a href="/board/view/<?=$this->uri->segment(3)?>/<?=$entry['wr_id']?>">
<?
                // 썸네일 가져오기
                $thumb = $this->Board_m->getImage($this->uri->segment(3),$entry['wr_id']);

                $cnt_img = count($list['album_img']);
                for ($i=0; $i < $cnt_img; $i++) {
                  if ($list['album_img'][$i]['wr_id']==$entry['wr_id']) {
?>
                    <img src="/data/file/<?=$list['album_img'][$i]['bo_table']?>/<?=$list['album_img'][$i]['bf_file']?>" alt="" style="max-width: 150px; float: left; margin-right: 10px;">
<?                  
                    break;
                  }
                }
?>  

                  <span class="ko_bold for_pc"><?=mb_strimwidth($entry['wr_subject'],'0','50','...','UTF-8')?><br><br></span>
                  <span class="ko_bold for_m" style="margin-bottom: 10px;"><?=mb_strimwidth($entry['wr_subject'],'0','30','...','UTF-8')?><br></span>
                  <span class="for_pc"><?=mb_strimwidth($entry['wr_content'],'0','130','...','UTF-8')?></span>
                   <span class="for_m"><?=mb_strimwidth($entry['wr_content'],'0','80','...','UTF-8')?></span>
                </a>
              </td>
              <td class="align_center for_pc">
<?
                if($entry['mb_id'] == '' || !$entry['mb_id']) {
                  echo $entry['wr_name'];
                } else {
                  echo $entry['mb_id'];
                }
?>
              </td>
              <td class="align_center for_pc"><?=$wr_date[0]?></td>
              <td class="align_center for_pc"><?=$entry['wr_hit']?></td>
            </tr>
  <?
          }
          $x_idx++;
          $no++;
        }
?>
      </tbody>
    </table>

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
  $('.album_ul tbody tr').mouseenter(function() {
    $(this).css('background-color','#eee');
  }).mouseleave(function() {
    $(this).css('background-color','#fff');
  });

  $(document).ready(function(){
    $('.m_header_info li:eq(5)').trigger('click');

    $('.m_header_tab ul:eq(5) li').each(function(){
      if($('.board_title').text().replace(/ /g, '') == $(this).text()){
        $(this).addClass('active');
      }
      
    });

    
  });
</script>

