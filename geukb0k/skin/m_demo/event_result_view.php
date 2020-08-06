<?php
include_once $nfor[skin_path]."head.php";

$event[wr_memo] = str_replace("style","alt",$event[wr_memo]);
?>
		

<style>
.wrap_event_view { margin:0px; padding:0px; width:100%; box-sizing:border-box; -webkit-box-sizing:border-box;  }
.wrap_event_view img { width:100%; }
</style>


<div class="wrap_event_view">

		

	<?=$event[wr_memo]?>



</div>

	

<?
include_once $nfor[skin_path]."tail.php";
?>