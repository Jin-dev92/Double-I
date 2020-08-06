<?php
include_once $nfor[skin_path]."head.php";
?>
<style>
.wrap_customer_list { margin:0px; padding:10px 10px; width:100%; box-sizing:border-box; -webkit-box-sizing:border-box;  }

.customer_list { background-color:#fff; border-top:solid 1px #ddd; border-left:solid 1px #ddd; border-right:solid 1px #ddd; }
.customer_list li{ position:relative; background-color:#fff; border-bottom:solid 1px #ddd; padding:15px 10px 10px 15px;  }

.customer_list li .wr_date { font-size:11px; color:#888; line-height:18px;}
.customer_list li .wr_it_name { max-width:90%; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;  font-size:12px; color:#555; margin:0px 0px 5px 0px; }
.customer_list li .wr_subject { color:#ec3940; font-size:15px; max-width:90%; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; letter-spacing:-1px; }



.customer_list li b {  position:absolute; top:50%; right:15px; width:7px; height:11px; margin-top:-6px; background:url( <?=$nfor[skin_path]?>img/layout.png ) no-repeat; background-position:-0px -400px;background-size: 320px auto; overflow:hidden; display:inline-block; text-indent:-999em; }

</style>


<div class="wrap_customer_list">


	<?
	include_once $nfor[skin_path]."inc_customer.php";
	?>

	<ul class="customer_list">
		<?
		for ($i=0; $row=sql_fetch_array($result); $i++) {

			if($row[it_id]){ 
				$item = sql_fetch("select it_name from nfor_item where it_id='$row[it_id]'");
				$row[it_name] = $item[it_name];
			}
		?>
		<li>
		<a href="customer_view.php?wr_id=<?=$row[wr_id]?>">

		<p class="wr_date">등록일 : <?=date("Y.m.d",strtotime($row[wr_datetime]))?></p>
		<p class="wr_it_name"><?=$row[it_name]?$row[it_name]:"선택한 상품이 없습니다."?></p>
		<p class="wr_subject"><?=$row[wr_subject]?></p>
			
		<b></b>
		</a>
		</li>
		<?
		}
		$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
		?>
	</ul>

	<div style="margin:0 auto; text-align:center; padding:10px;"><?=$pagelist?></div>


	




</div>
<?
include_once $nfor[skin_path]."tail.php";
?>