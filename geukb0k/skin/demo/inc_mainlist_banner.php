<style>
.mainlist_banner{margin:20px auto; width:1161px; height:200px;overflow:hidden; }
.mainlist_banner li { float:left; margin-right:40px; }
</style>


<div class="mainlist_banner">
	<ul>
		<?
		$i = 0;
		$que = sql_query("select * from nfor_banner where wr_use='1' and wr_code='pc_mainlist' and wr_sdate<='$nfor[ymdhis]' and wr_edate>='$nfor[ymdhis]' order by wr_rank desc limit 3");
		while($banner=sql_fetch_array($que)){							
		?>
		<li <? if($i==2){ ?>style="margin-right:0px"<? } ?>><a href="<?=$banner[wr_banner_link]?>" target="<?=$banner[wr_target]?>"><img src="<?="$nfor[path]/data/banner/$banner[wr_banner_img]"?>" alt=""></a></li>
		<? 
			$i++;
		} 
		?>
		</ul>
</div>
<div style="width:1161px; margin:0px auto;">
