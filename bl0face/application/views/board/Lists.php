<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
    // PC
} else {
    // $list['page_scale'] = 5;
    ?>
    <!-- //MOBILE -->
    <style>
      * {max-width: 640px; margin: 0 auto;}
      .m_header { display: block !important;}
      .agree { width: 100%; padding: 20px; }
      .bg { display: none !important;}
      .container { max-width: 640px; min-width: 300px !important; padding: 0; width: 100%;}
      .list { padding-top: 60px; padding: 60px 5px 0 5px;}
    </style>
<?}?>
<style>
.bg { display: block; width: 100%; min-width: 1200px;}
.container { min-width: 1200px;}
.board_title { padding-left: 0}
</style>

<img class="bg" src="/assets/img/sub/sub_main_head_img.jpg">

<div class="container">
<div class="list">
  <h1 class="board_title align_center"><?=$list['board_title']?></h1>
  <div class="list_btns">
    <a href="/board/write/<?=$this->uri->segment(3)?>">
    <div class="board_list_btn">
      <div><i class="large material-icons" style="font-size: 1.5rem; margin-right: 12px;">create</i></div>
      <div>글쓰기</div>      
    </div>
    </a>
  </div>
  <ul>
    <li class="li_head"><div class="list_no">No.</div><div class="list_title">제목</div><div class="list_name">작성자</div><div class="list_date">작성일</div></li>
<?
    $list['page_limit'] =5;
    
    $x_idx =1;
    $page_max = $list['page'] * $list['page_limit'];
    $page_min = $page_max- $list['page_limit'];
    
      $no = 1;
      
      foreach ($list as $key => $value) {
        if(gettype($key) == 'integer') {
            if ($x_idx > $page_max) {
              break;
            }
    
            if ($x_idx <= $page_max && $x_idx >= $page_min+1) {
              $wr_date =  explode(" ",$list[$key]['wr_datetime']);
    ?>
              <li>
                <a href="/board/view/<?=$this->uri->segment(3)?>/<?=$list[$key]['wr_id']?>">
                  <div class="list_no"> <?=$no?></div>
                  <div class="list_title"><?=$list[$key]['wr_subject']?></div>
                  <div class="list_name"><?if($list[$key]['mb_id'] == '' || !$list[$key]['mb_id']) { echo $list[$key]['wr_name']; }else{ echo $list[$key]['mb_id']; }?></div>
                  <div class="list_date"><?=$wr_date[0];?></div>
                </a>
              </li>
    
    
    <?
              $co_data = $this->Board_m->comment_re($this->uri->segment(3));
    
              foreach ($co_data as $co){
                if($list[$key]['wr_num']==$co['wr_num']){
                  $co['mb_id'] = '비오페이스';
                  $no++;
    ?>
    
                  <li>
                    <a href="/board/view/<?=$this->uri->segment(3)?>/<?=$co['wr_id']?>">
                      <div class="list_no"> <?=$no?></div>
                      <div class="list_title"><?=$co['wr_subject']?></div>
                      <div class="list_name"><?if($co['mb_id'] == '' || !$co['mb_id']) { echo $co['wr_name']; }else{ echo $co['mb_id']; }?></div>
                      <div class="list_date"><?=$wr_date[0]?></div>
                    </a>
                  </li>
    <?
                }
              }
    ?>
    
    <?
            }
            $x_idx++;
            $no++;
        }
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
$(document).ready(function(){
  // $('.m_header_info li:eq(5)').trigger('click');
  $('.m_header_tab ul:eq(5) li:eq(4)').addClass('active');
});
</script>