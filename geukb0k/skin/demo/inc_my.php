<style>
.cus_leftmenu{ float:left; width:178px; margin:20px 0px 0px 20px;}
.cus_leftmenu .left_box{background-color:#d32f2f; width:100%; height:87px; color:#FFFFFF;}
.cus_leftmenu .left_box span{color:#FFFFFF; padding:25px 15px; text-align:left; display:block;}
.cus_leftmenu li {height:35px; line-height:35px; border-bottom:solid 1px #DCDCDC;}
.cus_leftmenu li:hover {background-color:#FAFAFA;}
.cus_leftmenu li a{ display:block; width:100%; padding-left:10px;}
.cus_leftmenu li a:hover{ color:#d32f2f;}
</style>
<div class="cus_leftmenu">
<div class="left_box"><span>마이페이지<br>My Page</span></div>
<ul>
	<li <?=basename($PHP_SELF)=="item_star_form.php"|| basename($PHP_SELF)=="order_cancel.php"|| basename($PHP_SELF)=="order_list.php"|| basename($_SERVER[PHP_SELF])=="item_location.php"|| basename($_SERVER[PHP_SELF])=="item_notice.php"|| basename($_SERVER[PHP_SELF])=="order_view.php"?"class='on'":"class=''"?>><a  href="order_list.php">주문목록</a></li>
	<li <?=basename($PHP_SELF)=="money_list.php"?"class='on'":"class=''"?>><a href="money_list.php">적립금</a></li>
	<li <?=basename($PHP_SELF)=="member_form.php"?"class='on'":"class=''"?>><a  href="member_confirm.php">정보수정</a></li>
	<li <?=basename($PHP_SELF)=="zzim_list.php"?"class='on'":"class=''"?>><a  href="zzim_list.php">찜한상품</a></li>
	<li <?=basename($PHP_SELF)=="customer_list.php"|| basename($_SERVER[PHP_SELF])=="customer_view.php"?"class='on'":"class=''"?>><a  href="customer_list.php">1:1문의</a></li>
	<li <?=basename($PHP_SELF)=="bank_account.php"?"class='on'":"class=''"?>><a  href="bank_account.php">환불계좌설정</a></li>


</ul> 
<a href="customer_form.php"><img src="<?=$nfor[skin_path]?>img/leftbanner03.png" style="margin-top:10px;margin-bottom:20px;"></a>
</div>