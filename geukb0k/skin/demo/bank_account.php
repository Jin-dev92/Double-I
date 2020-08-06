<?php
include_once $nfor[skin_path]."mypage_head.php";
?>



<div style="padding:10px; background-color:#fff;">


<style>
.bank_account_ul li:first-child {  border-top:solid 2px #666; padding:10px 0px; }
.bank_account_ul li {  border-top:solid 1px #f1f1f1; padding:10px 0px; }
.bank_account_btn { margin:10px 0px 20px 0px; background-color:#fff; cursor:pointer; }

.bank_account_ul label { margin-right:50px; font-weight:bold; }
.bank_account_ul input, select { border:solid 1px #ccc; padding:4px; }
#mb_bank_account { width:200px; }
</style>



	<form name="fbank_account" id="fbank_account" method="post">
	<input type="hidden" name="mode" value="bank_account">
	<ul class="bank_account_ul">
		<li>
			<label>예금주</label>
			<input type="text" name="mb_name" value="<?=$member[mb_name]?>" readonly style="border:solid 1px #fff; padding-left:10px;">  
		</li>
		<li>
			<label>은행선택</label>
			<select name="mb_bank_name" id="mb_bank_name">
			<option value="">은행선택
			<?
			$que = sql_query("select * from nfor_pg_code where pg_type='$nfor[pg_type]' and pg_payment_type='vbanking'");
			while($data = sql_fetch_array($que)){
			?>
			<option value="<?=$data[pg_code]?>" <?=$member[mb_bank_name]==$data[pg_code]?"selected":""?>><?=$data[pg_name]?>(<?=$data[pg_code]?>)
			<? } ?>
			</select>
		</li>
		<li>
			<label>계좌번호</label>
			<input type="text" name="mb_bank_account" id="mb_bank_account" value="<?=$member[mb_bank_account]?>">
		</li>
		<li>
			<input type="checkbox" name="mb_bank_agree" id="mb_bank_agree" value="1" <?=$member[mb_bank_agree]?"checked":""?>> <label for="mb_bank_agree">환불계좌 수집 및 설정에 동의합니다.</label>

			

			<div style="font-size:13px; color:#cc0000; background-color:#f5f5f5; padding:20px; margin-top:20px;">
			<p> ※ 계좌이체 또는 무통장입금 결제 후 주문 취소가 발생할 경우 등록된 무통장 계좌로 환불해드립니다.</p>
			<p> ※ 환불계좌는 반드시 본인 명의의 계좌만 설정 가능합니다</p>
			</div>


		</li>
	</ul>
		<a class="table-btn" id="bank_account_btn" style="width:150px; margin:20px auto;">등록하기</a>
	</form>

</div>




<SCRIPT LANGUAGE="JavaScript">
<!--
$(document).on("click","#bank_account_btn",function(){


	if(!$("#mb_bank_name").val()){
		alert("은행을 선택해주세요");
		$("#mb_bank_name").focus();
		return;
	}
	if(!$("#mb_bank_account").val()){
		alert("계좌번호를 입력해주세요");
		$("#mb_bank_account").focus();
		return;
	}


	if(!$("#mb_bank_agree").is(":checked")){
		alert("환불계좌 수집 및 설정에 동의하셔야 진행가능합니다.");
		$("#mb_bank_agree").focus();
		return;
    }

	$.ajax({ 
		type : "post"
		, url : "bank_account.php"
		, cache : false  
		, data : $("#fbank_account").serialize() 
		, success : function(response){ 
			var json = $.parseJSON(response); 
			if(json["result"]=="ok"){
				alert("환불계좌가 정상적으로 설정되었습니다");
				location.reload();
			} else{
				alert(msg);
			}
		}
	}); 


});
//-->
</SCRIPT>

<?
include_once $nfor[skin_path]."mypage_tail.php";
?>