<?
include_once "path.php";
?>
<style>
.wrap_event_list { margin:0px; padding:10px 10px; width:100%; box-sizing:border-box; -webkit-box-sizing:border-box;  }


.wrap_event_list .event_list_wrap { width:50%; float:left; }
.event_list { width:100%; }
.event_list li img{ width:100%; }

.event_list li a { display:block; border:solid 1px #e5e5e5; margin-bottom:10px; }


.event_list_wrap1 { padding-right:5px; box-sizing:border-box; -webkit-box-sizing:border-box; }
.event_list_wrap2 { padding-left:5px; box-sizing:border-box; -webkit-box-sizing:border-box; }



.inc_event { margin:0px 0px 10px 0px; padding:0px; list-style:none; border-top:solid 1px #ddd; border-left:solid 1px #ddd; overflow:hidden;  }
.inc_event li { margin:0px 0px 0px -2px; padding:0px; background-color:#eee; text-align:center; float:left; width:50%; border-right:solid 1px #ddd; border-left:solid 1px #ddd; position:relative;  }
.inc_event li a { cursor:pointer; border-bottom:solid 1px #ddd; display:block; height:36px; line-height:36px; padding:0px 15px; font-size:14px; letter-spacing:-1px; text-decoration:none; color:#333; z-index:2; max-width:100%; overflow:hidden; }  
.inc_event li.on { position:relative; background-color:#fff;  }
.inc_event li.on a { color:#ec3940; font-weight:bold;   }


.event_wrap2 { display:none; }
</style>

<SCRIPT LANGUAGE="JavaScript">
<!--


$(document).on("click", ".inc_event li", function(){
		
	$(".inc_event li").removeClass("on");
	$(this).addClass("on");
	$(".event_wrap").hide();					

	if($(this).index()=="1"){
		$(".event_wrap2").show();
		if($(".event_wrap2").html()==""){
			$.get('<?=$nfor[skin_path]?>event_result_list.php', function(data){
				$(".event_wrap2").html(data);
			});
		}
	} else{
		$(".event_wrap1").show();
	}

});



//-->
</SCRIPT>



<div class="wrap_event_list">

	<ul class="inc_event">
		<li class="on"><a>진행중인이벤트</a></li>
		<li><a>당첨자발표</a></li>
	</ul>

	
	<div class="event_wrap event_wrap1">

		<div class="event_list_wrap event_list_wrap1">
		
			<ul class="event_list">
				<?
				$result = sql_query("select * from nfor_event where wr_view='0' order by wr_rank desc limit 0,5");
				for ($i=0; $row=sql_fetch_array($result); $i++) {
				?>
				<li><a href="event_view.php?wr_id=<?=$row[wr_id]?>"><img src="<?="$nfor[path]/data/event/$row[wr_img_m]"?>"></a></li>
				<? } ?>
			</ul>

		</div>

		<div class="event_list_wrap event_list_wrap2">

			<ul class="event_list">
				<?
				$result = sql_query("select * from nfor_event where wr_view='0' order by wr_rank desc limit 5,5");
				for ($i=0; $row=sql_fetch_array($result); $i++) {
				?>
				<li><a href="event_view.php?wr_id=<?=$row[wr_id]?>"><img src="<?="$nfor[path]/data/event/$row[wr_img_m]"?>"></a></li>
				<? } ?>
			</ul>

		</div>

		<div style="clear:both;"></div>

	</div>

	<div class="event_wrap event_wrap2"></div>




</div>