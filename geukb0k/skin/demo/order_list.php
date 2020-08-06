<?php
include_once $nfor[skin_path]."mypage_head.php";
include_once $nfor[path]."/lib/div.lib.php";
?>
<style>
.order_list_top_wrap { padding:20px 0px; }
.order_list_tab  { border-top:solid 1px #999999; border-left:solid 1px #999999; overflow:hidden; }
.order_list_tab li { margin:0px 0px 0px -2px; background-color:#fff; float:left; width:33.3333%; border-bottom:solid 1px #999999; border-right:solid 1px #999999; border-left:solid 1px #999999; }
.order_list_tab li a{ display:block; height:45px; line-height:45px;  text-align:center; font-size:14px; letter-spacing:-1px; text-decoration:none; color:#999999; }
.order_list_tab li.on { background-color:#999999; }
.order_list_tab li.on a { color:#fff; font-weight:bold; }

.order_list_wrap { border-top:solid 1px #e1e1e1; padding:0px; background-color:#fff; }

.item_head { padding:3px 0px; color:#999; font-size:12px; line-height:45px; }
.item_body { border:solid 1px #d8d5d5; margin-bottom:10px; background:#fff;  }
.item_title { position:relative; font-size:14px; color:#616161; padding:7px; border-bottom:1px solid #f1f1f1; background:#eee; }
.order_detail{ cursor:pointer; position:absolute; right:5px; top:6px; width:62px; border:solid 1px #ccc; background-color:#fff; font-size:12px; color:#3b3b3b; letter-spacing:-1px; text-align:center; display:block; padding:2px 0px; }
.item_content { display:block; overflow:hidden; border-top:solid 1px #eee;  }
.item_content li { position:relative; }
.item_img { position:absolute; left:10px; top:10px; width:75px; height:75px; }
.item_info_wrap { padding:10px 10px 10px 95px; }
.item_name1{ height:14px; font-size:14px; line-height:14px; overflow:hidden; color:#000; font-weight:bold; }
.item_name2{ height:36px; font-size:14px; line-height:18px; margin:3px 0px 5px 0px; color:#3a3a3a; overflow:hidden; }
.item_name3{ font-size:14px; line-height:18px; margin:3px 0px 0px 0px; color:#3a3a3a;}

.item_tail { border-top:solid 1px #e1e1e1; }
.table-btn { cursor:pointer; text-align:center; font-size:15px; border:solid 1px #c3c3c3; color:#333; border-radius:2px; background-color:fff; display:block; padding:9px 7px; width:95%; }


.order_list_wrap .table-cell a { margin:0 auto; }


.box { border:solid 1px #DCDCDC; background-color:#FAFAFA; padding:10px 10px; height:35px;}
.box::after {content:""; clear:both;}
.box .box_right {padding-left:20px; }
.box .box_right a {display:inline-block; border:solid 1px #DCDCDC;padding:5px 10px;  background-color:#FFFFFF;  }
.box .box_right a:hover, .box .box_right a.on {display:inline-block; border:solid 1px #d32f2f; color:#FFF; background-color:#d32f2f; }

.box .box_right .inpt {border: solid 1px #DCDCDC; height:30px;margin-top:-3px; }
.box .box_right .boxbtn { display:inline-block; border:solid 1px #666; padding:5px 10px; color:#FFF;  background-color:#666;  }

</style>



		<div class="order_list_top_wrap">

			<ul class="order_list_tab">
				<li<?=!$type?" class='on'":""?>><a href="order_list.php">전체</a></li>
				<li<?=$type=="delivery"?" class='on'":""?>><a href="order_list.php?type=delivery">배송상품</a></li>
				<li<?=$type=="ticket"?" class='on'":""?>><a href="order_list.php?type=ticket">티켓상품</a></li>
			</ul>

		</div>

		<div class="order_list_wrap">
			<?
			for($i=0; $order=sql_fetch_array($result); $i++){
				echo item_div_print($order);
			}
			?>
		</div>





<?
include_once $nfor[skin_path]."mypage_tail.php";
?>