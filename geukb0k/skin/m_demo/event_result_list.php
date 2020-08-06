<?
include_once "path.php";
?>



<style>
.wrap_event_result_list { margin:0px; padding:0px; width:100%; box-sizing:border-box; -webkit-box-sizing:border-box;  }

.event_result_list { background-color:#fff; border-top:solid 1px #ddd; border-left:solid 1px #ddd; border-right:solid 1px #ddd; }
.event_result_list li{ position:relative; background-color:#fff; border-bottom:solid 1px #ddd;  }
.event_result_list li a{ display:block; padding:15px 10px; }


.event_result_list li .wr_date { font-size:11px; color:#888;line-height:15px; }
.event_result_list li .wr_subject { color:#333; max-width:90%; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; letter-spacing:-1px;  font-size:14px;line-height:18px; }



.event_result_list li b { position:absolute; top:50%; right:15px; width:7px; height:11px; margin-top:-6px; background:url( <?=$nfor[skin_path]?>img/common.png ) no-repeat; background-position:-305px 0; background-size:450px 400px; overflow:hidden; display:inline-block; text-indent:-999em; }


</style>


<div class="wrap_event_result_list">

	


	<ul class="event_result_list">
		<?
		$result = sql_query("select * from nfor_event where wr_view='0' order by rand()");
		for ($i=0; $row=sql_fetch_array($result); $i++) {
		?>
		<li>
		<a href="event_result_view.php?wr_id=<?=$row[wr_id]?>">





		<p class="wr_date"><?=date("Y.m.d",strtotime($row[wr_datetime]))?></p>
		<p class="wr_subject">[ <?=$row[ca_name]?> ] <?=$row[wr_subject]?> 당첨자 발표</p>
			




		<b></b>
		</a>
		</li>
		<?
		}
		$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
		?>
	</ul>

	<?=$pagelist?>


	




</div>