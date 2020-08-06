<?php	// 상품문의관리
include "path.php";

if($wr_id){
	$write = sql_fetch("select * from nfor_item_qna where wr_id='$wr_id'");
	$item = sql_fetch("select * from nfor_item where it_id='$write[it_id]'");
}

if($mode=="update"){
	item_access($write[it_id]);
	sql_query("update nfor_item_qna set wr_memo='$wr_memo' where wr_id='$wr_id'");		
	alert("정상적으로 수정되었습니다","qna_form.php?wr_id=$wr_id&$qstr");
	exit;
}

if($mode=="star_copy"){

	$last_star = sql_fetch("select * from nfor_item_star where it_id='$item[it_id]' order by wr_id desc limit 1");
	if($last_star[mb_no]==$write[mb_no]) json_return("같은상품에 대해 연속적인 후기작성은 불가합니다");

	if(!$write[mb_no]) json_return("회원정보가 존재하지 않습니다");

	$chk_buy = sql_fetch("select * from nfor_cart a, nfor_order b where a.cart_id=b.cart_id and a.pay_step='1' and b.mb_no='$write[mb_no]' and a.it_id='$item[it_id]' and a.is_star='0' order by b.od_id desc");
	if(!$chk_buy[it_id]) json_return("구매내역이 있는분만 후기 작성이 가능합니다");

	$chk_star = sql_fetch("select * from nfor_item_star where od_id='$chk_buy[od_id]' and mb_no='$write[mb_no]' and it_id='$item[it_id]'");
	if($chk_star[od_id]) json_return("이미 후기를 작성하신 상품입니다");

	$wr_memo = strip_tags($wr_memo);
	$add_sql .= it_img_upload("star","wr_img");
	sql_query("insert nfor_item_star set it_id_gp='$item[it_id_gp]', it_id='$item[it_id]', wr_reply='$wr_reply', mb_no='$write[mb_no]', wr_memo='$write[wr_memo]', wr_datetime=NOW(), od_id='$chk_buy[od_id]', wr_star='$wr_star' $add_sql");

	$is_star = sql_insert_id();

	sql_query("update nfor_cart set is_star='$is_star' where cart_id='$chk_buy[cart_id]' and it_id='$chk_buy[it_id]'");

	$option_sum = sql_fetch("select sum(option_price*option_cnt) as option_sum from nfor_cart where cart_id='$chk_buy[cart_id]' and it_id='$chk_buy[it_id]' and pay_step='1'");	
	if($add_sql){
		if($config[cf_pstar_type]=="1"){
			$p_pstar_money = ($option_sum[option_sum]/100)*$config[cf_pstar_per];
		} else{
			$p_pstar_money = $config[cf_pstar_won];
		}
		insert_money($write[mb_no],$p_pstar_money,"포토 구매후기작성","6",$chk_buy[od_id]);	
	} else{
		if($config[cf_star_type]=="1"){
			$p_star_money = ($option_sum[option_sum]/100)* $config[cf_star_per];
		} else{
			$p_star_money = $config[cf_star_won];
		}
		insert_money($write[mb_no],$p_star_money,"구매후기작성","5",$chk_buy[od_id]);	
	}

	json_return("","ok");
	exit;
}




include "head.php";
echo cheditor1('wr_memo', '100%', '450px');
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function fsubmit(f){
    <?
    echo cheditor3('wr_memo');
    ?>	
	f.action = "qna_form.php";
}
//-->
</SCRIPT>

<form name="fwrite" method="post" onsubmit="return fsubmit(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="update">
<input type="hidden" name="wr_id" value="<?=$write[wr_id]?>">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<table class="tbl_type" border="0" cellspacing="0">
<colgroup>
<col width="180" align="center">
<col align="left"style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th>상품명</th>
	<td><a href="<?=$nfor[load]?>?it_id=<?=$item[it_id]?>" target="_blank"><?=$item[it_name]?></a></td>
</tr>
<tr>
	<th>등록일자</th>
	<td><?=$write[wr_datetime]?></td>
</tr>
<tr>
	<th>아이디</th>
	<td><?=mb_info($write[mb_no])?></td>
</tr>
<tr>
	<th>상품평</th>
	<td><?=cheditor2('wr_memo', $write[wr_memo]);?></td>
</tr>
</table>
<div class="btn_cen"><input type="image" src="img/dong_btn.gif"> <a href="qna_list.php?<?=$qstr?>"><img src="img/list.gif"></a></div>
</form>




<? if($is_admin and !$write[wr_reply]){ ?>
<form method="post" id="fitem_star_form">
	<input type="hidden" name="mode" value="star_copy">
	<input type="hidden" name="wr_id" value="<?=$write[wr_id]?>">

	<select name="wr_star">
	<? for($s=5; $s>0; $s--){ ?>
	<option value="<?=$s?>"><?=$s?>
	<? } ?>
	</select>

	<input type="button" value="후기로복사" class="btn_item_star_submit">
</form>



<script type="text/javascript">
<!--
$(document).on("click", ".btn_item_star_submit", function(){
	
	$.ajax({
		type: "post",
		data : $("#fitem_star_form").serialize(),
		url: "qna_form.php",
		success: function(response){
			var json = $.parseJSON(response); 
			if(json["result"]=="ok"){
				alert("후기가 복사되었습니다");
			} else{
				alert(json["msg"]);
			}
		}
	});

});
//-->
</script>
<? } ?>

<?
include "tail.php";
?>