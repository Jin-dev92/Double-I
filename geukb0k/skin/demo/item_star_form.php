<?php	// 상품평작성
include_once $nfor[skin_path]."mypage_head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
$(document).ready(function(){
	$("#star_ratio input").bind("click",function(){
		var eqindex = $("#star_ratio input").index(this);
		for(i=0; i<$("#star_ratio input").length; i++){
			if(i <= eqindex){
				$("#star_ratio").children().eq(i).addClass("star_ov");
			} else{
				$("#star_ratio").children().eq(i).removeClass("star_ov");
			}
		}
		$("#wr_star").val(eqindex+1);
	});
});

$(document).on("click", ".btn_item_star_submit", function(){
	
	if(!$(".wr_memo").val()){
		alert("내용을 입력해주세요");
		$(".wr_memo").focus();
		return;
	}

	$.ajax({
		type: "post",
		data : $("#fitem_star_form").serialize(),
		url: "item_star_form.php",
		success: function(response){
			var json = $.parseJSON(response); 
			if(json["result"]=="ok"){
				location.href="item.php?it_id=<?=$write[it_id]?$write[it_id]:$it_id?>";
			} else{
				alert(json["msg"]);
			}
		}
	});

});
//-->
</SCRIPT>

<style>
.wrap_item_star_form { margin:0px; padding:10px 10px; width:100%; box-sizing:border-box; -webkit-box-sizing:border-box;  }

.row { margin-bottom:20px; }
.wrap_star_btn {  width:300px; margin:0px auto;}
.wrap_star_btn li { width:50%; float:left; box-sizing:border-box; -webkit-box-sizing:border-box; }
.wrap_star_btn li:nth-child(1){ padding:10px 5px 10px 0px;  }
.wrap_star_btn li:nth-child(2){ padding:10px 0px 10px 5px;  }

.star_msg { color:#888; font-size:13px; letter-spacing:-1px; }
.star_msg b { font-weight:normal; color:#ec3940; }
.sms_msg { color:#666; font-size:14px; letter-spacing:-1px; }

.btn_item_star_cancel { border:solid 1px #e5e5e5; background-color:#fff; height:34px; color:#444; font-size:15px; line-height:34px; display:block; text-align:center; width:150px; }
.btn_item_star_submit { border:solid 1px #ec3940; background-color:#ec3940; height:34px; color:#fff; font-size:15px; line-height:34px; display:block; text-align:center; padding:0px; margin:0px; width:150px; }

#wr_star { display:none; } 
#star_ratio .img_star { background:url('/skin/m_demo/img/star.png') no-repeat 0 -24px; background-size:134px auto; }
#star_ratio input { width:24px; height:24px; background-position:0 0; border:0px; padding:0px; margin:0px; }
#star_ratio .star_ov { background-position:0 0px; }

.hu_tbl { width:100%; border-top:solid 2px #666; line-height:45px;}
.hu_tbl th {background-color:#FAFAFA; border-bottom:solid 1px #DCDCDC;}
.hu_tbl td {border-bottom:solid 1px #DCDCDC; padding-left:10px;}
</style>



<div class="wrap_item_star_form">

<form name="fitem_star_form" id="fitem_star_form" method="post" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$write[wr_id]?"update":"insert"?>">
<input type="hidden" name="wr_id" value="<?=$write[wr_id]?>">
<input type="hidden" name="it_id" value="<?=$write[it_id]?$write[it_id]:$it_id?>">
<input type="hidden" name="wr_reply" value="<?=$wr_reply?>">
		


<table class="hu_tbl">
<tr>
	<th>별점평가</th>
	<td>

		<div id="star_ratio">
			<? for($i=1; $i<=5; $i++){ ?><input type="button" id="score_0<?=$i?>" class="img_star<? if($i<=$write[wr_star]){ ?> star_ov<? } ?>"/><? } ?>
		</div>

		<select name="wr_star" id="wr_star">
		<? for($s=5; $s>0; $s--){ ?>
		<option value="<?=$s?>" <? if($s==$write[wr_star]) echo "selected"; ?>><?=$s?>
		<? } ?>
		</select>
	
	</td>
</tr>
<tr>
	<th>상품평</th>
	<td><textarea name="wr_memo" class="wr_memo" placeholder="내용을 입력해주세요" style="width:95%;height:150px; margin:10px;"><?=$write[wr_memo]?></textarea></td>
</tr>
</table>

<div class="row">
	<ul class="wrap_star_btn">
		<li><a href="javascript:history.back()" class="btn_item_star_cancel">취소</a></li>
		<li><input type="button" value="<?=$nfor[btn_txt]?>" class="btn_item_star_submit"></li>
	</ul>
	<div style="clear:both;"></div>
</div>
</form>

</div>
<?php
include_once $nfor[skin_path]."mypage_tail.php";
?>