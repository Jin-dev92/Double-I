<?php
include_once $nfor[skin_path]."head.php";

if(!$sort) $sort = "1";
if(!$view) $view = "1";
?>
<input type="hidden" id="sort" value="<?=$sort?>">
<input type="hidden" id="view" value="<?=$view?>">
<input type="hidden" id="swiper_page" value="0">


<!-- 전체롤링 -->
<div class="swiper-container swiper-container-common">
	<div class="swiper-wrapper">
		<div class="swiper-slide swiper-list-0"><? 
		include_once $nfor[skin_path]."inc_item_list_banner.php"; 
		include_once $nfor[skin_path]."inc_item_list_wrap.php"; 
		?></div>
		<?
		$array[0] = $category_id;
		$i = 1;
		$que2 = sql_query("select * from nfor_item_category where wr_use='1' and wr_depth='2' and category_id like '".substr($category_id,0,6)."%'");
		while($data2 = sql_fetch_array($que2)){
			$array[$i] = $data2[category_id];
		?>
		<div class="swiper-slide swiper-list-<?=$i?>"></div>
		<?
			$i++;
		}
		?>
	</div>
</div>
<!-- //전체롤링 -->





<SCRIPT LANGUAGE="JavaScript">
<!--
$(function(){

	var pagename = [<? 
	for($i=0; $i<count($array); $i++){
		if($i) echo ",";
		echo "'".$array[$i]."'";
	} 
	?>];  


	$(document).on("change", ".sort_select", function(){
		$("#sort").val($(this).val());
		item_list_sort();
	});

	$(document).on("click", ".list_chg_btn", function(){		
		var view = parseInt($("#view").val());
		view = view + 1;
		if(view>3){
			view = 2;			
		}
		$("#view").val(view);
		$('.list_chg_btn').attr('src','<?=$nfor[skin_path]?>img/listico0'+view+'.png');
		

		$('.swiper-list-0 .item_list_wrap > ul').removeAttr('class').addClass('item_list'+view);
		
		if(view=="1"){
			$(".img1").show();
			$(".img2").hide();
		} else{
			$(".img1").hide();
			$(".img2").show()
		}


	});


	function item_list_sort(){
		print = $('#swiper_page').val();

		$.get('<?=$nfor[skin_path]?>inc_item_list.php?category_id='+pagename[print]+'&sort='+$('#sort').val()+'&view='+$('#view').val(), function(data){
			$('.swiper-list-'+print+' .item_list_wrap ul').html(data);
		});
	}



});
//-->
</SCRIPT>


<?php
include_once $nfor[skin_path]."tail.php";
?>