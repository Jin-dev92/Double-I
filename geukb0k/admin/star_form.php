<?php	// 상품평관리
include "path.php";

if($wr_id){
	$write = sql_fetch("select * from nfor_item_star where wr_id='$wr_id'");
	$item = sql_fetch("select * from nfor_item where it_id='$write[it_id]'");
}

if($mode=="best"){
	if($write[is_best]) json_return("이미 베스트후기 적립금이 지급된 게시글입니다");
	
	$order = sql_fetch("select * from nfor_order where od_id='$write[od_id]'");
	$option_sum = sql_fetch("select sum(option_price*option_cnt) as option_sum from nfor_cart where cart_id='$order[cart_id]' and it_id='$write[it_id]' and pay_step='1'");

	if($config[cf_bstar_type]=="1"){
		$p_bstar_money = ($option_sum[option_sum]/100)* $config[cf_bstar_per];
	} else{
		$p_bstar_money = $config[cf_bstar_won];
	}
	insert_money($write[mb_no],$p_bstar_money,"베스트 구매후기작성","4",$write[od_id]);	

	sql_query("update nfor_item_star set is_best='1' where wr_id='$wr_id'");

	json_return("","ok");
	exit;
}

if($mode=="update"){
	item_access($write[it_id]);

	$add_sql = "";
	if($wr_datetime){
		$add_sql .= ", wr_datetime='$wr_datetime'";
	} else{
		$add_sql .= ", wr_datetime=NOW()";
	}

	$add_sql .= it_img_upload("star","wr_img");
	if($wr_img_del){
		sql_query("update nfor_item_star set wr_img='' where wr_id='$write[wr_id]'");
		@unlink($nfor[path]."/data/star/".$write[wr_img]);
	}

	sql_query("update nfor_item_star set wr_star='$wr_star', wr_memo='$wr_memo',wr_best='$wr_best',it_id='$it_id' $add_sql where wr_id='$wr_id'");		
	alert("정상적으로 수정되었습니다","star_form.php?wr_id=$wr_id&$qstr");
	exit;
}

include "head.php";
echo cheditor1('wr_memo', '100%', '450px');
?>
<SCRIPT LANGUAGE="JavaScript">
<!--


$(function(){
    $('#wr_datetime').datetimepicker({
        showOn: 'button',
		buttonImage: 'img/calendar.gif',
		buttonImageOnly: true,
        buttonText: "달력",
        changeMonth: true,
		changeYear: true,
        showButtonPanel: true,
		dateFormat: 'yy-mm-dd',
		timeFormat: 'hh:mm:ss'
    }); 

});	




function fsubmit(f){
    <?
    echo cheditor3('wr_memo');
    ?>	
	f.action = "star_form.php";
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
	<th>상품코드</th>
	<td>	
	<input type="text" name="it_id" value="<?=$write[it_id]?>">
	</td>
</tr>
<tr>
	<th>상품명</th>
	<td>	
	<a href="<?=$nfor[load]?>?it_id=<?=$item[it_id]?>" target="_blank"><?=$item[it_name]?></a>
	</td>
</tr>
<tr>
	<th>등록일시</th>
	<td><input type="text" name="wr_datetime" id="wr_datetime" value="<?=$write[wr_datetime]?$write[wr_datetime]:date("Y-m-d H:i:s");?>"></td>
</tr>
<tr>
	<th>아이디</th>
	<td><?=mb_info($write[mb_no])?></td>
</tr>

<tr>
	<th>베스트</th>
	<td>
	<input type="text" name="wr_best" value="<?=$write[wr_best]?>" size="4">
	</td>
</tr>

<tr>
	<th>별점</th>
	<td>
		<select name="wr_star">
		<? for($s=5; $s>0; $s--){ ?>
		<option value="<?=$s?>" <? if($s==$write[wr_star]) echo "selected"; ?>><?=$s?>
		<? } ?>
		</select>
	</td>
</tr>
<tr>
	<th>상품평</th>
	<td><?=cheditor2('wr_memo', $write[wr_memo]);?></td>
</tr>
</table>
<div class="btn_cen"><input type="image" src="img/dong_btn.gif"> <a href="star_list.php?<?=$qstr?>"><img src="img/list.gif"></a></div>
</form>




<? if($is_admin){ ?>
<form method="post" id="fitem_star_form">
	<input type="hidden" name="mode" value="best">
	<input type="hidden" name="wr_id" value="<?=$write[wr_id]?>">
	<input type="button" value="베스트후기 적립금지급" class="btn_item_star_submit">
</form>



<script type="text/javascript">
<!--
$(document).on("click", ".btn_item_star_submit", function(){
	
	$.ajax({
		type: "post",
		data : $("#fitem_star_form").serialize(),
		url: "star_form.php",
		success: function(response){
			var json = $.parseJSON(response); 
			if(json["result"]=="ok"){
				alert("베스트후기 적립금이 지급되었습니다");
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