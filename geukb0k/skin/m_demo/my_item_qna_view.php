<?php
include_once $nfor[skin_path]."head.php";
?>
		

<style>
.wrap_qna_view { margin:0px; padding:10px 10px; width:100%; box-sizing:border-box; -webkit-box-sizing:border-box;  }


.qna_view_title { background-color:#fff; border-top:solid 1px #ddd; border-left:solid 1px #ddd; border-right:solid 1px #ddd; }
.qna_view_title li{ position:relative; background-color:#fff; border-bottom:solid 1px #ddd; padding:10px;  }
.qna_view_title li .wr_date { font-size:11px; color:#999; }
.qna_view_title li .wr_it_name { max-width:100%; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; letter-spacing:-1px; font-size:13px; color:#333; }





.qna_view_qna { background-color:#fff; border-top:solid 1px #ddd; border-left:solid 1px #ddd; border-right:solid 1px #ddd; margin:10px 0px; }
.qna_view_qna li{ position:relative; background-color:#fff; border-bottom:solid 1px #ddd; padding:10px; font-size:15px; }
.qna_view_qna li .qna_q { padding-top:4px; padding-left:28px;  color:#333; }
.qna_view_qna li.qna_a { background-color:#f7f7f7; font-size:15px; }



.qna_view_qna li .qna_a_m { margin-top:3px; margin-left:28px; font-size:15px; color:#333; }



.qna_view_qna li .ico_q  { width:22px; height:22px; line-height:22px; display:inline-block; position:absolute; left:10px; top:12px; background:#ec3940; border-radius:11px; text-align:center; color:#fff; font-family:Helvetica,'Apple SD Gothic Neo'; font-size:15px; letter-spacing:-1px; }

.qna_view_qna li .ico_a  { width:22px; height:22px; line-height:22px; display:inline-block; position:absolute; left:10px; top:12px; background:#bdc2c8; border-radius:11px; text-align:center; color:#fff; font-family:Helvetica,'Apple SD Gothic Neo'; font-size:15px; letter-spacing:-1px; }


</style>


<div class="wrap_qna_view">


	<ul class="qna_view_title">
		<li>

		<p class="wr_date"><?=date("Y.m.d",strtotime($qna[wr_datetime]))?></p>
		<p class="wr_it_name"><? if($qna[it_name]){ ?><a href="item.php?it_id=<?=$qna[it_id]?>"><?=$qna[it_name]?></a><? } else{ ?>선택한 상품이 없습니다.<? } ?></p>

		</li>
	</ul>

		
	<ul class="qna_view_qna">
		<li>
			<b class="ico_q">Q</b> <p class="qna_q"><?=nl2br($qna[wr_memo])?></p>
		</li>
		<?
		$que2 = sql_query("select * from nfor_item_qna where wr_reply='$qna[wr_id]' order by wr_id desc");
		if(sql_num_rows($que2)){
			while($data2 = sql_fetch_array($que2)){
		?>
		<li class="qna_a">
			<b class="ico_a">A</b> 
			<p class="qna_a_m">
			<?=nl2br($data2[wr_memo])?>
			<?=$data2[wr_datetime]?>
			</p>
		</li>
		<? 
			}
		} else{
		?>
		<li class="qna_a">
			<b class="ico_a">A</b> 
			<p class="qna_a_m">답변을 준비중입니다.</p>
		</li>
		<?
		}
		?>
	</ul>


	<a href="my_item_qna_list.php" class="btn_list">목록보기</a>


</div>

	

<?
include_once $nfor[skin_path]."tail.php";
?>