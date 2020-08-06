<?php
include_once $nfor[skin_path]."mypage_head.php";
?>
		

<style>
.wrap_customer_view { margin:0px;  width:100%; box-sizing:border-box; -webkit-box-sizing:border-box;  }


.customer_view_title { background-color:#fff; border-top:solid 2px #666;  }
.customer_view_title li{ position:relative; background-color:#fff;  padding:15px 20px 15px 20px;  }
.customer_view_title li .wr_date { font-size:11px; color:#888; line-height:18px; }
.customer_view_title li .wr_it_name { max-width:100%; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;  font-size:14px; color:#555; line-height:26px; }





.customer_view_qna { background-color:#fff; border-top:solid 1px #ddd; }
.customer_view_qna li{ position:relative; background-color:#fff; border-bottom:solid 1px #ddd; padding:20px; font-size:15px; }
.customer_view_qna li .qna_q { padding-top:4px; padding-left:28px; max-width:100%; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; color:#333; }
.customer_view_qna li.qna_a { background-color:#f7f7f7; font-size:15px; }

.customer_view_qna li .qna_q_m { margin-top:10px; font-size:12px; color:#555; line-height:18px; }

.customer_view_qna li .qna_a_m { margin-top:10px; margin-left:0px; font-size:12px; color:#555;line-height:18px; }



.customer_view_qna li .ico_q  { width:22px; height:22px; line-height:22px; display:inline-block; position:absolute; left:20px; top:20px; background:#ec3940; border-radius:11px; text-align:center; color:#fff; font-family:Helvetica,'Apple SD Gothic Neo'; font-size:12px; letter-spacing:-1px; }

.customer_view_qna li .ico_a  { width:22px; height:22px; line-height:22px; display:inline-block; position:absolute; left:20px; top:20px; background:#bdc2c8; border-radius:11px; text-align:center; color:#fff; font-family:Helvetica,'Apple SD Gothic Neo'; font-size:15px; letter-spacing:-1px; }


</style>


<div class="wrap_customer_view">


	<ul class="customer_view_title">
		<li>
		<p class="wr_date">등록일 : <?=date("Y.m.d",strtotime($customer[wr_datetime]))?></p>
		<p class="wr_it_name"><? if($customer[it_name]){ ?><a href="item.php?it_id=<?=$customer[it_id]?>"><?=$customer[it_name]?></a><? } else{ ?><? } ?></p>
		</li>
	</ul>

	<ul class="customer_view_qna">
		<li>
			<b class="ico_q">Q</b> <p class="qna_q"><?=$customer[wr_subject]?></p>
			<p class="qna_q_m"><?=nl2br($customer[wr_memo])?></p>
		</li>

		<li class="qna_a">
			<b class="ico_a">A</b><p class="qna_q">관리자</p>
			<div class="qna_a_m">
			<? if($customer[wr_is_reply]=="2"){ ?>
				<?=nl2br($customer[wr_reply_memo])?>
				<?=$customer[wr_reply_datetime]?>
			<? } else{ ?>
				답변을 준비중입니다.
			<? } ?>
			</div>
		</li>
	</ul>

	<a href="customer_list.php" class="btn_list" style="display: block; width: 161px; height: 46px; background: #383838;  color: #fff; font-weight: normal;border: 0; line-height:46px; margin: 50px auto; font-size: 18px; text-align:center;" >목록보기</a>


</div>

	

<?
include_once $nfor[skin_path]."mypage_tail.php";
?>