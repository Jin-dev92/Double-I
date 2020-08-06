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
<div class="left_box"><span>고객센터<br>CustomerCenter</span></div>
<ul >
	<li <?=basename($PHP_SELF)=="faq.php"?"class='on'":""?>><a href="faq.php">자주묻는질문</a></li>
	<li <?=basename($PHP_SELF)=="customer_form.php"?"class='on'":""?>><a href="customer_form.php">1:1문의</a></li>
	<li <?=basename($PHP_SELF)=="agreement.php"?"class='on'":""?>><a href="agreement.php">이용약관</a></li>
	<li <?=basename($PHP_SELF)=="privacy.php"?"class='on'":""?>><a href="privacy.php">개인정보취급방침</a></li>
	<li <?=basename($PHP_SELF)=="notice_list.php" || basename($PHP_SELF)=="notice_view.php"?"class='on'":""?>><a href="notice_list.php"">공지사항</a></li>
	<li <?=basename($PHP_SELF)=="cooperation_form.php"?"class='on'":""?>><a href="cooperation_form.php">입점문의</a></li>
</ul>
<a href="customer_form.php"><img src="<?=$nfor[skin_path]?>img/leftbanner03.png" style="margin-top:10px;"></a>
</div>