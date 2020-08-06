<?php
include_once $nfor[skin_path]."head.php";
?>

<style>
.mypage { margin:0px; padding:10px; width:100%; box-sizing:border-box; -webkit-box-sizing:border-box;  }



.mypage .mypage_menu { padding:0px; margin:0px; list-style:none; border-top:solid 1px #e4e4e4;  border-left:solid 1px #e4e4e4; overflow:hidden;  }
.mypage .mypage_menu li { margin:0px 0px 0px -2px; padding:0px; background-color:#fff;  float:left; width:50%; border-bottom:solid 1px #e4e4e4;  border-right:solid 1px #e4e4e4; border-left:solid 1px #e4e4e4; position:relative;  }
.mypage .mypage_menu li a { display:block;  height:50px; padding:10px 15px; font-size:14px; text-decoration:none; color:#333; z-index:2; }  
.mypage .mypage_menu li span { position:absolute; bottom:10px; right:15px; color:#ec3940; font-size:12px; z-index:1; }
.mypage .mypage_menu li b { font-weight:bold; font-size:16px; z-index:1; } 



.category1{ position: absolute; bottom:5px;left:15px;width:35px;height:35px;display: block;background:url('<?=$nfor[skin_path]?>img/layout.png') no-repeat; background-size:320px auto; background-position: 0px -250px; }
.category2{ position: absolute; bottom:5px;left:15px;width:35px;height:35px;display: block;background:url('<?=$nfor[skin_path]?>img/layout.png') no-repeat; background-size:320px auto; background-position: -50px -250px; }
.category3{ position: absolute; bottom:5px;left:15px;width:35px;height:35px;display: block;background:url('<?=$nfor[skin_path]?>img/layout.png') no-repeat; background-size:320px auto; background-position:-100px -250px; }
.category4{ position: absolute; bottom:5px;left:15px;width:35px;height:35px;display: block;background:url('<?=$nfor[skin_path]?>img/layout.png') no-repeat; background-size:320px auto; background-position: -150px -250px; }




.mypage .mypage_list { margin:10px 0px 0px 0px; padding:0px; background-color:#fff; border-top:solid 1px #e4e4e4;  border-left:solid 1px #e4e4e4;  border-right:solid 1px #e4e4e4; list-style:none; }
.mypage .mypage_list li { margin:0px; border-bottom:solid 1px #e4e4e4; position:relative; }
.mypage .mypage_list li a { display:block; padding:13px 15px; font-size:14px; text-decoration:none; color:#333;}
.mypage .mypage_list li b { position:absolute; top:50%; right:15px; width:7px; height:11px; margin-top:-6px; background:url( /skin/m_demo/img/layout.png ) no-repeat; background-position:-0px -400px;background-size: 320px auto; overflow:hidden; display:inline-block; text-indent:-999em; }
</style>

<div class="mypage">
<?

$dy = sql_fetch("select count(*) as cnt from nfor_order  where od_view='0' and pay_step>'0' and mb_no='$member[mb_no]'  and is_delivery>'0'");
$ti = sql_fetch("select count(*) as cnt from nfor_order  where od_view='0' and pay_step>'0' and mb_no='$member[mb_no]'  and is_ticket>'0'");
$cp = sql_fetch("select count(*) as cnt from nfor_coupon where cp_sdate<='$nfor[ymdhis]' and cp_edate>='$nfor[ymdhis]' and (cp_all='1' or cp_mb_no='$member[mb_no]')");

?>
	<ul class="mypage_menu">
		<li><em class="category1"></em><a href="order_list.php?type=delivery">배송상품</a> <span><b><?=$dy[cnt]?></b>건</span></li>
		<li><em class="category2"></em><a href="order_list.php?type=ticket">티켓상품</a> <span><b><?=$ti[cnt]?></b>건</span></li>
		<li><em class="category3"></em><a href="coupon_list.php">할인쿠폰</a> <span><b><?=$cp[cnt]?></b>장</span></li>
		<li><em class="category4"></em><a href="money_list.php">적립금</a> <span><b><?=number_format(mb_money($member[mb_no]))?></b>원</span></li>
	</ul>
	<div style="clear:both;"></div>

	<ul class="mypage_list">
		<li><a href="order_list.php">구매목록</a> <b></b></li>
		<li><a href="cancel_list.php">취소/반품 현황</a> <b></b></li>
		<li><a href="bank_account.php">무통장 환불계좌 설정</a> <b></b></li>
	</ul>

	<ul class="mypage_list">
		<li><a href="zzim_list.php">찜한상품</a> <b></b></li>
		<li><a href="recent_list.php">최근본상품</a> <b></b></li>
	</ul>

	<ul class="mypage_list">
		<li><a href="call.php">고객센터 <?=$config[cf_tel]?></a> </li>
		<li><a href="my_item_qna_list.php">상품문의내역</a> <b></b></li>
		<li><a href="customer_form.php">1:1문의</a> <b></b></li>
		<li><a href="faq.php">자주묻는질문</a> <b></b></li>
		<li><a href="notice_list.php">공지사항</a> <b></b></li>
	</ul>

	<? if($member[mb_no]){ ?>
	<ul class="mypage_list">
		<li><a href="member_confirm.php">정보수정</a> <b></b></li>
		<li><a href="logout.php">로그아웃</a> <b></b></li>
	</ul>
	<? } else{ ?>
	<ul class="mypage_list">
		<li><a href="member_join.php">회원가입</a> <b></b></li>
		<li><a href="login.php">로그인</a> <b></b></li>
	</ul>
	<? } ?>

</div>

<?
include_once $nfor[skin_path]."tail.php";
?>