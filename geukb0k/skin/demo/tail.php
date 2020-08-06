	</div>
	
	<!-- footer -->
	<div id="footer">
		<!-- a00 -->
		
		<!--a01-->
		<div class="a01">
			<!--wrap-->
			<div class="wrap">
				<a href="company.php">회사소개</a>|<a href="agreement.php">이용약관</a>|<a href="privacy.php">개인정보취급방침</a>|<a href="cooperation_form.php">입점문의</a>|<a href="faq.php">자주묻는질문</a>
			</div>
			<!--//wrap-->
		</div>
		 <!--a02-->

    	<div class="a02">
        	<!--wrap-->
        	<div class="wrap">
            	
        		<!--f_tx-->
                <div class="f_tx">

				<?
				if($supply[mb_extra3]){
				?>
				<div class="fm">
				상호 :  <?=$supply[supply_name]?> | 대표자 : <?=$supply[mb_extra2]?> | 사업자등록번호 : <?=$supply[mb_extra3]?><br>
				주소 : <?=$supply[mb_extra5]?> |  고객센터 : <?=$supply[mb_tel]?> 
				</div>
				<div class="copyright">Copyright © <?=date("Y")?> <?=$supply[supply_name]?> Inc. All rights reserved</div>
				<? } else{ ?>
				<div class="fm">
				상호 :  <?=$config[cf_cp_name]?> | 대표자 : <?=$config[cf_cp_ceo]?> | 사업자등록번호 : <?=$config[cf_cp_number1]?> | 통신판매업신고 : <?=$config[cf_cp_number2]?><br>
				주소 : <?=$config[cf_cp_address]?> |
				개인정보보호책임자 : <?=$config[cf_cp_privacy]?>(<?=$config[cf_cp_privacy_email]?>) | 고객센터 : <?=$config[cf_tel]?>
				</div>
				<div class="copyright">Copyright © <?=date("Y")?> <?=$config[cf_cp_name]?> Inc. All rights reserved </div>
				<? } ?>



				


                
                </div>
        		<!--//f_tx-->
            </div>
        	<!--//wrap-->
        </div>
    	<!--//a02-->
	</div>

	<!-- //footer -->



</div>
<!-- //wrap -->

<?
if(!(basename($_SERVER['PHP_SELF'])=="faq.php" || basename($_SERVER['PHP_SELF'])=="customer_form.php" || basename($_SERVER['PHP_SELF'])=="agreement.php" || basename($_SERVER['PHP_SELF'])=="privacy.php" || basename($_SERVER['PHP_SELF'])=="notice_list.php" || basename($_SERVER['PHP_SELF'])=="cooperation_form.php" || basename($_SERVER['PHP_SELF'])=="cart.php" || basename($_SERVER['PHP_SELF'])=="order_list.php" || basename($_SERVER['PHP_SELF'])=="order_list.php" || basename($_SERVER['PHP_SELF'])=="order_list.php" || basename($_SERVER['PHP_SELF'])=="money_list.php" || basename($_SERVER['PHP_SELF'])=="member_confirm.php" || basename($_SERVER['PHP_SELF'])=="member_form.php" || basename($_SERVER['PHP_SELF'])=="zzim_list.php" || basename($_SERVER['PHP_SELF'])=="customer_list.php" || basename($_SERVER['PHP_SELF'])=="bank_account.php" || basename($_SERVER['PHP_SELF'])=="customer_view.php" || basename($_SERVER['PHP_SELF'])=="item.php"|| basename($_SERVER['PHP_SELF'])=="cart_order.php" || basename($_SERVER['PHP_SELF'])=="order_view.php" ||
basename($_SERVER['PHP_SELF'])=="item_location.php" || basename($_SERVER['PHP_SELF'])=="item_notice.php")) {
?>
<style>
/* 좌우배너 */
#left_banner {position:absolute; right:50%; top:0px; margin:773px 595px 0px 0px; }
#right_banner {position:absolute; right:50%; top:0px; margin:773px -700px 0px 0px; }
/* 좌우배너 */
</style>

<ul id="left_banner">
<?
$que = sql_query("select * from nfor_banner where wr_use='1' and wr_code='pc_left' and wr_sdate<='$nfor[ymdhis]' and wr_edate>='$nfor[ymdhis]' order by wr_rank");
while($banner=sql_fetch_array($que)){							
?>
	<li><a href="<?=$banner[wr_banner_link]?>" target="<?=$banner[wr_target]?>"><img src="<?="$nfor[path]/data/banner/$banner[wr_banner_img]"?>" alt="<?=$banner[wr_name]?>" style="margin-bottom:5px; border:solid 1px #cccccc;"></a></li>
<? } ?> 
</ul>

<div id="right_banner">
<table cellpadding="0" cellspacing="0" border="0" id="tb2">
<?
$que = sql_query("select * from nfor_banner where wr_use='1' and wr_code='pc_right' and wr_sdate<='$nfor[ymdhis]' and wr_edate>='$nfor[ymdhis]' order by wr_rank");
while($banner=sql_fetch_array($que)){							
?>
<tr>
	<td><a href="<?=$banner[wr_banner_link]?>" target="<?=$banner[wr_target]?>"><img src="<?="$nfor[path]/data/banner/$banner[wr_banner_img]"?>" alt="<?=$banner[wr_name]?>" style="margin-bottom:5px; border:solid 1px #cccccc;"></a></td>
</tr>
<? } ?>
</table>
<?
include $nfor[skin_path]."today.php";	
?> 
</div>
<? 
} else {
?>

<style>
/* 좌우배너 */
#left_banner {position:absolute; right:50%; top:0px; margin:233px 595px 0px 0px; }
#right_banner {position:absolute; right:50%; top:0px; margin:233px -700px 0px 0px; }
/* 좌우배너 */
</style>

<ul id="left_banner">
<?
$que = sql_query("select * from nfor_banner where wr_use='1' and wr_code='pc_left' and wr_sdate<='$nfor[ymdhis]' and wr_edate>='$nfor[ymdhis]' order by wr_rank");
while($banner=sql_fetch_array($que)){							
?>
	<li><a href="<?=$banner[wr_banner_link]?>" target="<?=$banner[wr_target]?>"><img src="<?="$nfor[path]/data/banner/$banner[wr_banner_img]"?>" alt="<?=$banner[wr_name]?>" style="margin-bottom:5px; border:solid 1px #cccccc;"></a></li>
<? } ?> 
</ul>

<div id="right_banner">
<table cellpadding="0" cellspacing="0" border="0" id="tb2">
<?
$que = sql_query("select * from nfor_banner where wr_use='1' and wr_code='pc_right' and wr_sdate<='$nfor[ymdhis]' and wr_edate>='$nfor[ymdhis]' order by wr_rank");
while($banner=sql_fetch_array($que)){							
?>
<tr>
	<td><a href="<?=$banner[wr_banner_link]?>" target="<?=$banner[wr_target]?>"><img src="<?="$nfor[path]/data/banner/$banner[wr_banner_img]"?>" alt="<?=$banner[wr_name]?>" style="margin-bottom:5px; border:solid 1px #cccccc;"></a></td>
</tr>
<? } ?>
</table>
<?
include $nfor[skin_path]."today.php";	
?> 
</div>
<?
	}
?>



</body>
</html>