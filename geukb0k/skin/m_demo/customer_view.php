<?php
include_once $nfor[skin_path]."head.php";
?>
		

<style>
.wrap_customer_view { margin:0px; padding:10px 10px; width:100%; box-sizing:border-box; -webkit-box-sizing:border-box;  }


.customer_view_title { background-color:#fff; border-top:solid 1px #ddd; border-left:solid 1px #ddd; border-right:solid 1px #ddd; }
.customer_view_title li{ position:relative; background-color:#fff; border-bottom:solid 1px #ddd;  padding:15px 10px 10px 15px;  }
.customer_view_title li .wr_date { font-size:11px; color:#888; line-height:18px; }
.customer_view_title li .wr_it_name { max-width:100%; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;  font-size:12px; color:#555; }





.customer_view_qna { background-color:#fff; border-top:solid 1px #ddd; border-left:solid 1px #ddd; border-right:solid 1px #ddd; margin:10px 0px; }
.customer_view_qna li{ position:relative; background-color:#fff; border-bottom:solid 1px #ddd; padding:10px; font-size:15px; }
.customer_view_qna li .qna_q { padding-top:4px; padding-left:28px; max-width:100%; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; color:#333; }
.customer_view_qna li.qna_a { background-color:#f7f7f7; font-size:15px; }

.customer_view_qna li .qna_q_m { margin-top:7px; font-size:12px; color:#555; }

.customer_view_qna li .qna_a_m { margin-top:10px; margin-left:0px; font-size:12px; color:#555; }



.customer_view_qna li .ico_q  { width:22px; height:22px; line-height:22px; display:inline-block; position:absolute; left:10px; top:12px; background:#ec3940; border-radius:11px; text-align:center; color:#fff; font-family:Helvetica,'Apple SD Gothic Neo'; font-size:12px; letter-spacing:-1px; }

.customer_view_qna li .ico_a  { width:22px; height:22px; line-height:22px; display:inline-block; position:absolute; left:10px; top:12px; background:#bdc2c8; border-radius:11px; text-align:center; color:#fff; font-family:Helvetica,'Apple SD Gothic Neo'; font-size:15px; letter-spacing:-1px; }


</style>


<div class="wrap_customer_view">


	<ul class="customer_view_title">
		<li>

		<p class="wr_date">등록일 : <?=date("Y.m.d",strtotime($customer[wr_datetime]))?></p>
		<p class="wr_it_name"><? if($customer[it_name]){ ?><a href="item.php?it_id=<?=$customer[it_id]?>"><?=$customer[it_name]?></a><? } else{ ?>선택한 상품이 없습니다.<? } ?></p>

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


	<a href="customer_list.php" class="btn_list">목록보기</a>


</div>

	

<?
include_once $nfor[skin_path]."tail.php";
?>