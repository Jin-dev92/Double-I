<?php
include_once $nfor[skin_path]."head.php";
?>
		

<style>
.wrap_notice_view { margin:0px; padding:0px 10px; width:100%; box-sizing:border-box; -webkit-box-sizing:border-box;  }

.notice_view_qna { background-color:#fff; border-top:solid 1px #ddd; border-left:solid 1px #ddd; border-right:solid 1px #ddd; margin:10px 0px; }
.notice_view_qna li{ position:relative; background-color:#fff; border-bottom:solid 1px #ddd; padding:15px 10px; font-size:15px; }
.notice_view_qna li .wr_date {  font-size:11px; color:#888;line-height:15px;  }
.notice_view_qna li .wr_subject { max-width:100%; overflow:hidden; letter-spacing:-1px; font-size:15px; color:#333;font-size:14px;line-height:18px; }



.notice_view_qna li.qna_a { background-color:#fafafa; font-size:12px; }
.notice_view_qna li .qna_a_m { font-size:12px; color:#666; }

</style>


<div class="wrap_notice_view">

		
	<ul class="notice_view_qna">
		<li class="qna_q">

		<p class="wr_date"><?=date("Y.m.d",strtotime($notice[wr_datetime]))?></p>
		<p class="wr_subject">[ <?=$notice[ca_name]?> ]  &nbsp;<?=$notice[wr_subject]?></p>

		</li>

		<li class="qna_a">
			<div class="qna_a_m">
			<?=$notice[wr_memo]?>
			</div>
		</li>
	</ul>

	<a href="notice_list.php" class="btn_list">목록보기</a>


</div>

	

<?php
include_once $nfor[skin_path]."tail.php";
?>