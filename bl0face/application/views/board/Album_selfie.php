<link type="text/css" rel="stylesheet" href="/assets/css/swiper.min.css"  media="screen,projection"/>
<style>
/*셀피내용*/
.admin_btn { display: none; width: 100%;}
.selfie_contents p {text-align: center;}
.selfie_contents hr { margin: 0;}
.selfie_contents img { max-width: 90%;}
.selfie_contents_wrap { padding: 50px 0;}
.selfie_contents_img_wrap { margin: 0 auto; width: 200px; height: 200px; overflow: hidden;}
.selfie_contents .selfie_name { font-size: 45px; }
.selfie_contents .selfie_age { font-size: 30px;}
.selfie_contents .s_part { font-size: 25px; background: #AA0010; color: #fff; padding: 5px;}
.name_age_wrap { padding: 30px 0;}

.swiper-slide { text-align: center; }
.for_m.swiper-container { height: 20px; margin-bottom: 20px;}
.swiper-slide-active_menu a { color: #AA0010;}

.bg { display: block; width: 100%; min-width: 1200px;}
.container { min-width: 1200px;}
.board_title { padding-left: 0}
.list { max-width: 1200px; width: 80%; display: block; margin: 50px auto 100px auto;}
.list > ul li{ padding: 30px 0 !important;}
.album_info_wrap { text-align: center;}
.selfie_title { padding: 20px 0; background-color: #f7f7f7}
.selfie_title span { color: #A9A9A9; font-size: 0.8em; line-height: 15px;}
.row .col { padding: 0 0.55rem;}
.selfie_on, .selfie_select { background-color: #AA0010; color: #fff !important; transition: all 0.3s ease-in-out;}
.selfie_on span, .selfie_select span { color: #fff;}
.slideshow { height: 200px; overflow: hidden; padding: 0; background: #fff;position: relative; padding: 0 !important;}
.slideshow img { position: static !important;}
.list > ul li { border-bottom: none; padding: 0;}
.album_ul { padding: 0 50px !important;}
.selfie_contents { margin: 0; float: left; width: 100%;}
.selfie_menu ul { display: flex; flex-wrap: wrap; justify-content: center;}
.selfie_menu ul li { border: 1px solid #eee; border-collapse: collapse; font-size: 20px; padding: 10px 40px; width: 200px; text-align: center;}
.selfie_menu_on, .selfie_menu ul li:hover { background-color: #AA0010; color: #fff; transition: all 0.3s ease-in-out;}

footer {
  display: table;
  width: 100%;
}
.album_img img { max-width: 300px; height: 100%; max-height: 225px;}
</style>
<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
    // PC
  $cut = 4;
  $uri= $_SERVER['REQUEST_URI'];

} else {
    $cut = 2;
    ?>
    <!-- //MOBILE -->

    <style>
      * {max-width: 640px; margin: 0 auto;}
      .list_wrap { display: block; width: 100%; max-width: 640px; margin: 0 auto;}
      .m_header { display: block !important;}
      .agree { width: 100%; padding: 20px; }
      .bg { display: none !important;}
      .container { max-width: 640px; min-width: 300px !important; padding: 0;}
      .list { padding: 30px 0px 0 0px; width: 100% !important;}
      /*.album_img2 img { max-width: 80px;}*/
      .list > ul li{ padding: 10px 5px 10px 5px !important;}
      .album_name { padding-top: 60px;}
      .board_title {margin: 20px auto;}
      .album_title {padding-right: 0;}
      .album_img img { height: 100px; max-width: 100%;}
      .row .col.s6 { height: 300px; }
      .album_img2 { max-height: none !important;}
      .album_ul { padding: 0px !important; display: flex; flex-wrap: wrap; justify-content: center; margin-bottom: 30px !important;}
      .selfie_menu ul li { border: none; font-size: 15px; width: unset; padding: 10px;}

      .selfie_contents_wrap { padding: 30px 0; width: 90%;}
      .selfie_contents_img_wrap { width: 150px; height: 150px; margin: 50px auto 0 auto;}
      .selfie_contents .selfie_name { font-size: 30px; }
      .selfie_contents .selfie_age { font-size: 22px;}
      .selfie_contents .s_part { font-size: 18px; background: #AA0010; color: #fff; padding: 5px;}
      .name_age_wrap { padding: 15px 0;}
    </style>
<?}?>

<div class="list_wrap">
  <div class="list">
    <h1 class="board_title align_center">리얼셀피리뷰</h1>
        <div class="selfie_menu for_pc">
          <ul>
            <a href="/board/lists/selfie_kor/1"><li>전체보기</li></a>
            <a href="/board/lists/selfie_kor/2"><li>풀페이스필러</li></a>
            <a href="/board/lists/selfie_kor/3"><li>리프팅</li></a>
            <a href="/board/lists/selfie_kor/4"><li>바디필러</li></a>
          </ul>
        </div>

        <!-- Swiper -->
        <div class="swiper-container for_m">
          <div class="swiper-wrapper">
            <div class="swiper-slide"><a href="/board/lists/selfie_kor/1">전체</a></div>
            <div class="swiper-slide"><a href="/board/lists/selfie_kor/2">풀페이스필러</a></div>
            <div class="swiper-slide"><a href="/board/lists/selfie_kor/3">리프팅</a></div>
            <div class="swiper-slide"><a href="/board/lists/selfie_kor/4">바디필러</a></div>
          </div>

          <!-- Add Arrows -->
          <!-- <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div> -->
        </div>

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


    

      <?

      $x_idx =1;
      $page_max = $list['page'] * $list['page_limit'];
      $page_min = $page_max- $list['page_limit'];

        foreach ($list as $entry) {
            $wr_id = $entry['wr_id'];
          if(!$entry['wr_id']){
            if($x_idx%$cut!=0){?>
              <div class="selfie_contents"></div>
              <div class="admin_btn">
                  <?if ($this->session->userdata('level')==10) {?>
                    <div class="col m12 s12" style="text-align: center; margin-bottom: 50px;">
                          <a href="/board/modify/selfie_kor/<?=$this->uri->segment(5)?>"><input type="button" name="button" class="waves-effect waves-light delete_btn modi_check" value="수정"></a>

                          <a href="/board/delContent/selfie_kor/<?=$this->uri->segment(5)?>"><input type="button" class="waves-effect waves-light delete_btn del_check" value="삭제"></a>
                      </div>
                  <?}?>
                </div>
              </ul>
            <?}
            break;
          }
          // if ($x_idx > $page_max) {
          //   break;
          // }


          // if ($x_idx <= $page_max && $x_idx >= $page_min+1) {
            $wr_date =  explode(" ",$entry['wr_datetime']);
          ?>

          <?if($x_idx%$cut==1 OR $x_idx==1){?>
          <ul class="album_ul row">
          <?}?>
            <li class="col m3 s6 selfie_<?=$entry['wr_id']?>">
              <a href="/board/lists/selfie_kor/<?=$this->uri->segment(4)?>/<?=$entry['wr_id']?>">
                <div class="album_img2 col m12 s12 ">
                  <div class="slideshow col m12 s12">
                  <?

                  // 썸네일 가져오기
                  $thumb = $this->Board_m->getImage('selfie_kor',$entry['wr_id']);
                  $cnt_img = count($thumb);


                  for ($i=0; $i < $cnt_img; $i++) {?>

                        <img src="/data/file/selfie_kor/<?=$thumb[$i]['bf_file']?>" alt="" style="width: 100%;">
                        <?
                  }
                  ?>
                  </div>
                </div>
                <div class="album_info_wrap col m12 s12">
                  <div class="selfie_title" style="font-size: 1.2em;"><?=$entry['wr_name']?>
                  <br>

                  <span>#
                    <?
                    $strTok =explode(',' , $entry['wr_subject']);
                    echo mb_substr($strTok[0],0,8,'utf-8');

                    if (mb_strlen($strTok[0])>8){echo "..";}
                    ?>
                      
                  </span>
                  </div>
                  
                </div>
              </a>              

            </li>

            <?if($x_idx%$cut==0){?>              
                <div class="selfie_contents"></div>
                <div class="admin_btn">
                  <?if ($this->session->userdata('level')==10) {?>
                    <div class="col m12 s12" style="text-align: center;">
                          <a href="/board/modify/selfie_kor/<?=$this->uri->segment(5)?>"><input type="button" name="button" class="waves-effect waves-light delete_btn modi_check" value="수정"></a>

                          <a href="/board/delContent/selfie_kor/<?=$this->uri->segment(5)?>"><input type="button" class="waves-effect waves-light delete_btn del_check" value="삭제"></a>
                        </div>
                  <?}?>
                </div>
                </ul>          
            <?}?>
          
            
          <?
          // }

          $x_idx++;
        }
      ?>


    <!-- <div class="paging_line">
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

    </div> -->
  </div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript" src="http://malsup.github.com/jquery.cycle.all.js"></script>
<script>
  $(document).ready(function() {
     var swiper = new Swiper('.swiper-container', {
      slidesPerView: 4,
      slidesPerGroup: 1,
      // loop: true,
      loopFillGroupWithBlank: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });

    $('.slideshow').cycle({
      fx: 'fade',
      speed: 200,
      timeout : 1000,
    });

    //메뉴 색칠
    var selfie_cate = <?=$this->uri->segment(4)?>;

    $('.selfie_menu ul a:eq('+(selfie_cate-1)+') li').addClass('selfie_menu_on');
    $('.swiper-container .swiper-wrapper .swiper-slide:eq('+(selfie_cate-1)+')').addClass('swiper-slide-active_menu');

    // 변수가 있으면 셀피 내용 가져오기
    var selfie_num = '<?=$this->uri->segment(5)?>';

    if(selfie_num != ''){
      var levels = '<?=$this->session->userdata('level')?>';
      if(levels<1){
        alert("로그인이 필요합니다.","/auth/login");
        location.href = '/auth/login';
      }

      $.ajax({
        type : "post"
        , url : "/board/selfie_contents_process/"+selfie_num
        , success : function(data, status, xhr){
          // console.log(data);
          // $('.selfie_contents').em
          $('.selfie_'+selfie_num).find('.selfie_title').addClass('selfie_select');
          $('.selfie_'+selfie_num).siblings('.admin_btn').css('display','block');
          $('.selfie_'+selfie_num).siblings('.selfie_contents').append(data);

        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(jqXHR.responseText);
        }
      });

    }


  });

  $('.album_ul li').mouseenter(function() {
    // $(this).css('background-color','#eee');
    $(this).find('.selfie_title').addClass('selfie_on');
  }).mouseleave(function() {
    $(this).find('.selfie_title').removeClass('selfie_on');
  });

  // $(document).ready(function(){
  //   $('.m_header_info li:eq(0)').trigger('click');
  //   $('.m_header_tab ul:eq(0) li:eq(4)').addClass('active');
  // });
</script>

