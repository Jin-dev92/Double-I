<?php
include_once $nfor[skin_path]."mypage_head.php";
?>
		

<style>
.wrap_star_view { margin:0px; padding:10px 10px; width:100%; box-sizing:border-box; -webkit-box-sizing:border-box;  }


.star_view_title { background-color:#fff; border-top:solid 1px #ddd; border-left:solid 1px #ddd; border-right:solid 1px #ddd; }
.star_view_title li{ position:relative; background-color:#fff; border-bottom:solid 1px #ddd; padding:10px;  }
.star_view_title li .wr_date { font-size:12px; color:#999; line-height:25px; }
.star_view_title li .wr_it_name { max-width:100%; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;  font-size:13px; color:#333; line-height:25px;}





.star_view_star { background-color:#fff; border-top:solid 1px #ddd; border-left:solid 1px #ddd; border-right:solid 1px #ddd; margin:10px 0px; }
.star_view_star li{ position:relative; background-color:#fff; border-bottom:solid 1px #ddd; padding:10px; font-size:15px; }
.star_view_star li .star_q { padding-top:4px; padding-left:40px;  color:#333; }
.star_view_star li.star_a { background-color:#f7f7f7; font-size:15px; }



.star_view_star li .star_a_m { margin-top:3px; margin-left:40px; font-size:15px; color:#333; }



.star_view_star li .ico_q  {  width:35px; height:22px; top:0px; left:0px; position:absolute; background:url('<?=$nfor[skin_path]?>img/qa.png') no-repeat ;  background-position:-0px -0px; left:10px; top:18px;  }

.star_view_star li .ico_a  { width:35px; height:22px; top:0px; left:10px; position:absolute; background:url('<?=$nfor[skin_path]?>img/qa.png') no-repeat ;  background-position:-37px -0px; left:10px; top:15px;  }


</style>


<div class="wrap_star_view">


	<ul class="star_view_title">
		<li>

		<p class="wr_date"><?=date("Y.m.d",strtotime($star[wr_datetime]))?></p>
		<p class="wr_it_name"><? if($star[it_name]){ ?><a href="item.php?it_id=<?=$star[it_id]?>"><?=$star[it_name]?></a><? } else{ ?>선택한 상품이 없습니다.<? } ?></p>

		</li>
	</ul>

		
	<ul class="star_view_star">
		<li>
			<p class="star_q"><?=nl2br($star[wr_memo])?></p>
		</li>
	</ul>


	<a href="my_item_star_list.php"  class="btn_list" style="display: block; width: 161px; height: 46px; background: #383838;  color: #fff; font-weight: normal;border: 0; line-height:46px; margin:20px auto; font-size: 18px; text-align:center;">목록보기</a>


</div>

	

<?
include_once $nfor[skin_path]."mypage_tail.php";
?>