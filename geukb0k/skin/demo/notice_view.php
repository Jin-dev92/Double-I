<?php
include_once $nfor[skin_path]."cus_head.php";
?>



		<table border="0" cellspacing="0" cellpadding="0" class="common_view_tbl">
		<tr>
			<th style="height:45px; background-color:#fafafa; border-bottom:solid 1px #CCC;"><?=$notice[ca_name]?"[".$notice[ca_name]."] ":""?><?=$notice[wr_subject]?></th>
		</tr>
		<tr>
			<td style="height:35px;">날짜 : <?=substr($notice[wr_datetime],0,10)?> | 조회수 : <span style="color:#cc0000"><?=$notice[wr_hit]?></span></td>
		</tr>
		<tr>
			<td style="padding:20px; height:250px; vertical-align:top;line-height:24px;"><?=$notice[wr_memo]?></td>
		</tr>
		</table>
		<div class="bottom_btn">
		<a href="notice_list.php"><span class="inquiryBtn">목록보기</span></a>
		</div>



<?
include_once $nfor[skin_path]."cus_tail.php";
?>