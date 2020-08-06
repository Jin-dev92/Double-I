<?
$PRODUCTNAME = cart_it_name($ss_cart_id);
$USERNAME = $member[mb_name];
$USERID = $member[mb_id];
$EMAIL = $member[mb_email];
$TELNO1 = $member[mb_hp];
$TELNO2 = $member[mb_hp];

$RETURNURL = "http://".$HTTP_HOST."/order_list.php";
$HOMEURL = "http://".$HTTP_HOST."/pg_daoupay_return.php";

if($nfor[test]){
	$test = "test";
} else{
	$test = "";
}
?>

<script type="text/javascript">

function cart_payment(){

	var payment_type = $(".payment_type:checked").val();

	if(payment_type=="card"){
		fnSubmit();
	} else if(payment_type=="iche"){
		pay();
	} else if(payment_type=="vbanking"){
		pay2();
	} else{
		paymethod = "";
	}

}

var pf;
  
function fnSubmit() {
	var fileName;
	fileName = "http://ssl<?=$test?>.daoupay.com/creditCard/DaouCreditCardMngUTF.jsp";		
	
	pf = document.frmConfirm
	<? if(!$is_mobile){ ?>
	DAOUPAY = window.open("", "DAOUPAY", "width=469,height=507");
	DAOUPAY.focus();
 
	pf.target = "DAOUPAY";
	<? } ?>
	pf.action = fileName;
	pf.method = "post";
	pf.submit();
}

</script>

<form name="frmConfirm"> 
<input type="text" name="CPID" value="<?=$nfor[pg_id]?>">
<input type="text" name="ORDERNO" class="od_id">
<input type="text" name="AMOUNT" class="pay_price">
<input type="text" name="PRODUCTTYPE" value="1">
<input type="text" name="BILLTYPE" value="1">
<input type="text" name="EMAIL" value="<?=$EMAIL?>">
<input type="text" name="USERID" value="<?=$USERID?>">
<input type="text" name="USERNAME" value="<?=$USERNAME?>">
<input type="text" name="PRODUCTNAME" value="<?=$PRODUCTNAME?>">
<input type="text" name="PRODUCTCODE" value="">
<input type="text" name="TELNO1" size="50" value="<?=str_number($TELNO1)?>">
<input type="text" name="TELNO2" size="50" value="<?=str_number($TELNO2)?>">
<input type="text" name="RESERVEDINDEX1" value="RESERVEDATA1">
<input type="text" name="RESERVEDINDEX2" value="RESERVEDATA2">
<input type="text" name="RESERVEDSTRING" value="RESERVESTRING">
<input type=text name=RETURNURL value="<?=$RETURNURL?>">
<input type=text name=HOMEURL value="<?=$HOMEURL?>">
<input type=text name=DIRECTRESULTFLAG value="Y">
<input type=text name=TAXFREECD value="00">
<input type=text name=kcp_noint value="">
<input type=text name=kcp_noint_quota   value="">
<input type=text name=quotaopt         value="">
<input type=text name=fix_inst         value="">
<input type=text name=not_used_card    value="">
<input type=text name=save_ocb         value="">
<input type=text name=used_card_YN   value="">
<input type=text name=used_card         value="">
<input type=text name=eng_flag         value="">
<input type=text name=kcp_site_logo         value="">
<input type=text name=kcp_site_img         value="">
</form>































<script language="javascript">
<!--
function pay() {

	var fileName;
	
	pf = document.payForm;
	
	if(pf.paytype.value=="bank"){
		fileName = "https://ssl<?=$test?>.daoupay.com/bank/DaouBankMngUTF.jsp";
	} 
	else {
		fileName = "https://ssl<?=$test?>.daoupay.com/bank/DaouBankEscrowMngUTF.jsp";
	}
	<? if(!$is_mobile){ ?>
	DAOUPAY = window.open("", "DAOUPAY", "width=480,height=480");
	DAOUPAY.focus();

	pf.target = "DAOUPAY";
	<? } ?>
	//pf.target = "hidden";
	pf.action = fileName;
	pf.method = "post";
	pf.submit();

}		
//-->
</script>

<form name="payForm"> 
<select name="paytype">
	<option value="bank">계좌이체(일반)</option>
</select>
<input type=text name=PRODUCTNAME value="<?=$PRODUCTNAME?>">
<input type=text name=AMOUNT class="pay_price">
<input type=text name=EMAIL value="<?=$EMAIL?>">
<input type=text name=CPID value="<?=$nfor[pg_id]?>">
<input type=text name=ORDERNO class="od_id">
<input type=text name=PRODUCTTYPE value="1">
<input type=text name=BILLTYPE value="1">
<input type=text name=USERID value="<?=$USERID?>">
<input type=text name=USERNAME value="<?=$USERNAME?>"> 
<input type=text name=USERSSN value="">
<input type=text name=CHECKSSNYN value="">
<input type=text name=RESERVEDINDEX1>
<input type=text name=RESERVEDINDEX2>
<input type=text name=RESERVEDSTRING>
<input type=text name=RETURNURL value="<?=$RETURNURL?>">
<input type=text name=HOMEURL value="<?=$HOMEURL?>">
<input type=text name=DIRECTRESULTFLAG value="Y">
<!--------------------------------------------------------------------------------------------
 * PRODUCTCODE : 상품코드[필수항목]
 * 다우와 협의 후 정의된 상품 코드를 입력하시면 됩니다.
---------------------------------------------------------------------------------------------->
<input type=text name=PRODUCTCODE value="10001">
</form>





















<script language="javascript">
<!--
function pay2(){

	var fileName;

	fileName = "http://ssl<?=$test?>.daoupay.com/m/vaccount/DaouVaccountMngUTF.jsp";
	
	pf = document.payForm2;
	<? if(!$is_mobile){ ?>
	DAOUPAY = window.open("", "DAOUPAY", "width=468,height=538");
	DAOUPAY.focus();

	pf.target = "DAOUPAY";
	//pf.target = "hidden";
	<? } ?>
	pf.action = fileName;
	pf.method = "post";
	pf.submit();

}
//-->
</script>



<form name="payForm2"> 

<input type=text name=PRODUCTNAME value="<?=$PRODUCTNAME?>">
<input type=text name=AMOUNT class="pay_price">
<input type=text name=EMAIL value="<?=$EMAIL?>">
<input type=text name=CPID value="<?=$nfor[pg_id]?>">
<input type=text name=ORDERNO class="od_id">
<input type=text name=PRODUCTTYPE value="1">
<input type=text name=BILLTYPE value="1">
<input type=text name=USERID value="<?=$USERID?>">
<input type=text name=USERNAME value="<?=$USERNAME?>"> 
<input type=text name=RESERVEDINDEX1>
<input type=text name=RESERVEDINDEX2>
<input type=text name=RESERVEDSTRING>
<input type=text name=RETURNURL value="<?=$RETURNURL?>">
<input type=text name=HOMEURL value="<?=$HOMEURL?>">
<input type=radio name=CASHRECEIPTFLAG value="1" checked> 발행 <input type=radio name=CASHRECEIPTFLAG value="0"> 미발행

<!--------------------------------------------------------------------------------------------
 * PRODUCTCODE : 상품코드[필수항목]
 * 다우와 협의 후 정의된 상품 코드를 입력하시면 됩니다.
---------------------------------------------------------------------------------------------->
<input type=text name=PRODUCTCODE value="10001">


</form>