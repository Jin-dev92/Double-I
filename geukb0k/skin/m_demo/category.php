<?php
include_once $nfor[skin_path]."head.php";
?>

<style>
.category { margin:0px; padding:10px 10px; width:100%; box-sizing:border-box; -webkit-box-sizing:border-box;  }

.category .category_title { position:relative; height:30px; box-sizing:border-box; -webkit-box-sizing:border-box; padding:0px 15px; margin:0px; font-weight:bold;  display:block; width:100%;  font-size:16px; line-height:19px; }

.category .category_title b { position:absolute; top:5px; left:0px; width:19px; height:19px; background:url("/skin/m_demo/img/category.png") no-repeat; display:inline-block; overflow:hidden; -webkit-background-size:270px 246px;  }

.category .category_title .b_1 { width:19px; height:19px; background-position: -241px -172px; -webkit-background-position: -241px -172px; }
.category .category_title .b_2 { width:19px; height:19px; background-position: -241px -193px; -webkit-background-position: -241px -193px; }
.category .category_title .b_3 { width:19px; height:19px; background-position: 0px -227px; -webkit-background-position: 0px -227px; }
.category .category_title .b_4 { width:19px; height:19px; background-position: -21px -227px; -webkit-background-position: -21px -227px; }
.category .category_title .b_5 { width:19px; height:19px; background-position: -42px -227px; -webkit-background-position: -42px -227px; }
.category .category_title .b_6 { width:19px; height:19px; background-position: -63px -227px; -webkit-background-position: -63px -227px; }
.category .category_title span { position:absolute; left:22px; top:5px; color:#333; font-weight:normal; font-size:15px; }


.category .category_menu { padding:0px; margin:0px 0px 10px 0px; list-style:none; overflow:hidden; border-top:solid 1px #ddd;   background-color:#fff; }
.category .category_menu li { margin:0px 0px 0px -1px; padding:0px; background-color:#fff;  float:left; width:50%; border-bottom:solid 1px #ddd; border-left:solid 1px #ddd; position:relative;  }

.category .category_menu li a { display:block; height:36px; line-height:36px; padding-left:10px; font-size:13px; text-decoration:none; color:#666; }  


</style>



<div class="category">


	<?
	$k = 1;
	$que = sql_query("select * from nfor_item_category where wr_use='1' and wr_depth='0' order by wr_rank asc");
	while($data = sql_fetch_array($que)){
	?>
	<b class="category_title"><b class="b_<?=$k?>"></b><span><?=$data[wr_category]?><span></b>
	<ul class="category_menu">
		<?
		$i = 0;
		$que2 = sql_query("select * from nfor_item_category where wr_use='1' and wr_depth='1' and category_id like '".substr($data[category_id],0,3)."%'");
		while($data2 = sql_fetch_array($que2)){
		?>
		<li><a href="item_list.php?category_id=<?=$data2[category_id]?>"><?=$data2[wr_category]?></a></li>
		<? 
			$i++;
		}
		if($i%2==1) echo "<li><a></a></li>";
		?>
	</ul>
	<div style="clear:both;"></div>
	<? 
		$k++;
	}
	?>



</div>

<?
include_once $nfor[skin_path]."tail.php";
?>