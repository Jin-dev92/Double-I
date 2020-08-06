<?php
include_once $nfor[skin_path]."head.php";
?>
<style>
.wrap_notice_list { margin:0px; padding:10px 10px; width:100%; box-sizing:border-box; -webkit-box-sizing:border-box;  }

.notice_list { background-color:#fff; border-top:solid 1px #ddd; border-left:solid 1px #ddd; border-right:solid 1px #ddd; }
.notice_list li{ position:relative; background-color:#fff; border-bottom:solid 1px #ddd;  }
.notice_list li a{ display:block; padding:15px 10px; }
.notice_list li .wr_date { font-size:11px; color:#888;line-height:15px; }
.notice_list li .wr_subject { color:#333; max-width:90%; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; letter-spacing:-1px;  font-size:14px;line-height:18px; }



.notice_list li b { position:absolute; top:50%; right:15px; width:7px; height:11px; margin-top:-6px; background:url( <?=$nfor[skin_path]?>img/layout.png ) no-repeat; background-position:-0px -400px;background-size: 320px auto; overflow:hidden; display:inline-block; text-indent:-999em; }

</style>


<div class="wrap_notice_list">

	


	<ul class="notice_list">
		<?
		for ($i=0; $row=sql_fetch_array($result); $i++) {
		?>
		<li>
		<a href="notice_view.php?wr_id=<?=$row[wr_id]?>">
			<p class="wr_date"><?=date("Y.m.d",strtotime($row[wr_datetime]))?></p>
			<p class="wr_subject"><?=$row[ca_name]?"[".$row[ca_name]."] ":""?> <?=$row[wr_subject]?></p>
			<b></b>
		</a>
		</li>
		<?
		}
		$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?page=");
		?>
	</ul>

	<div style="margin:0 auto; text-align:center; padding:10px;"><?=$pagelist?></div>


	




</div>
<?php
include_once $nfor[skin_path]."tail.php";
?>