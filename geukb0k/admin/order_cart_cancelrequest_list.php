<?php	// 주문취소신청목록(개별)
include "path.php";
ini_set('memory_limit', -1);

$qstr .= "&ct_is_mobile=$ct_is_mobile&ct_payment_type=$ct_payment_type&payment_ok=$payment_ok&ticket_state=$ticket_state&supply_no=$supply_no&it_id=$it_id&od_sdate=$od_sdate&od_edate=$od_edate&date_type=$date_type";

if($mode=="cancel"){

	$delivery_chk = sql_fetch("select * from nfor_cart where ct_id='$ct_id' and (delivery_step='2' or delivery_step='3')");
	if($delivery_chk[cart_id]){
		alert("배송된 상품이 존재하여 취소가 불가능합니다\\n반품 처리후 진행해주세요");
	}
	$cancel_price = return_price($ct_id);
	sql_query("update nfor_cart set pay_step='3', od_canceldatetime=NOW(), cancel_price='$cancel_price' where ct_id='$ct_id'");

	$ct = sql_fetch("select * from nfor_cart where ct_id='$ct_id'");
	$total_ct1 = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$ct[cart_id]'");
	$total_ct2 = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$ct[cart_id]' and pay_step='3'");
	if($total_ct1[cnt]==$total_ct2[cnt]){
		sql_query("update nfor_order set pay_step='3', od_canceldatetime=NOW() where cart_id='$ct[cart_id]'");
	}

	$order = sql_fetch("select * from nfor_order where cart_id='$ct[cart_id]'");

	$total_ct3 = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$ct[cart_id]' and it_id='$ct[it_id]'");
	$total_ct4 = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$ct[cart_id]' and it_id='$ct[it_id]' and pay_step='3'");
	if($total_ct3[cnt]==$total_ct4[cnt]){
		coupon_again($order[od_id],$ct[it_id]);
	}

	sql_query("update nfor_cart set my_cancel_price='".return_money_coupon($ct[ct_id])."' where ct_id='$ct[ct_id]'");
	insert_money($order[mb_no],return_money_coupon($ct[ct_id]),"적립금 상품구매 부분취소","8",$order[od_id],$ct[ct_id]);

	$cancel_price = $order[cancel_price]+return_price($ct_id);	// 취소된금액 + 지금취소되는금액
	sql_query("update nfor_order set cancel_price='$cancel_price' where cart_id='$ct[cart_id]'");

	alert("주문취소 처리되었습니다","$PHP_SELF?$qstr");
	exit;
}


if($mode=="asign"){
	sql_query("update nfor_cart set pay_step='1', cancel_why_msg='', cancel_why='', od_cancelrequest='' where ct_id='$ct_id'");	//  주문완료 수정
	sql_query("update nfor_cart set delivery_step='2' where ct_id='$ct_id' and (delivery_step='3' or delivery_step='4')");	//  반품신청(3) 또는 반품완료(4)일경우 배송완료(2) 처리

	$ct = sql_fetch("select * from nfor_cart where ct_id='$ct_id'");
	sql_query("update nfor_order set pay_step='1', od_canceldatetime='' where cart_id='$ct[cart_id]'");

	$is_cancel = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$ct[cart_id]' and (pay_step='2' or pay_step='3')");
	if($is_cancel[cnt]){
		sql_query("update nfor_order set is_cancel='1' where cart_id='$ct[cart_id]'");
	} else{
		sql_query("update nfor_order set is_cancel='0' where cart_id='$ct[cart_id]'");
	}

	alert("주문완료 처리되었습니다","$PHP_SELF?$qstr");
	exit;
}


if($mode=="list_asign"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		sql_query("update nfor_cart set pay_step='1', cancel_why_msg='', cancel_why='', od_cancelrequest='' where ct_id='{$_POST['ct_id'][$k]}'");	//  주문완료 수정
		sql_query("update nfor_cart set delivery_step='2' where ct_id='{$_POST['ct_id'][$k]}' and (delivery_step='3' or delivery_step='4')");	//  반품신청(3) 또는 반품완료(4)일경우 배송완료(2) 처리

		$ct = sql_fetch("select * from nfor_cart where ct_id='{$_POST['ct_id'][$k]}'");
		sql_query("update nfor_order set pay_step='1', od_canceldatetime='' where cart_id='$ct[cart_id]'");

		$is_cancel = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$ct[cart_id]' and (pay_step='2' or pay_step='3')");
		if($is_cancel[cnt]){
			sql_query("update nfor_order set is_cancel='1' where cart_id='$ct[cart_id]'");
		} else{
			sql_query("update nfor_order set is_cancel='0' where cart_id='$ct[cart_id]'");
		}

	}
	alert("주문완료 처리되었습니다","$PHP_SELF?$qstr");
	exit;
}


$sql_common = " from nfor_cart ";
$sql_search = " where pay_step='2' ";

if($ct_payment_type) $sql_search .= " and ct_payment_type='$ct_payment_type' ";
if($ct_is_mobile) $sql_search .= " and ct_is_mobile='$ct_is_mobile' ";
if($member[is_supply]=="1"){
	$sql_search .= " and supply_no='$member[mb_no]' ";
} else{
	if($supply_no) $sql_search .= " and supply_no='$supply_no' ";
}
if($od_sdate and $od_edate and $date_type){
	$sql_search .= " and date_format($date_type,'%Y-%m-%d')>='$od_sdate' and date_format($date_type,'%Y-%m-%d')<='$od_edate' ";
}
if($payment_ok) $sql_search .= " and payment_ok='$payment_ok' ";
if($ticket_state){
	if($ticket_state=="1"){
		$sql_search .= " and option_cnt <= ticket_used";
	} elseif($ticket_state=="2"){
		$sql_search .= " and option_cnt > ticket_used";
	} else{
		
	}
}

if($stx){
	if($sfl=="mb_id"){
		$mb = sql_fetch("select mb_no from nfor_member where {$nfor[id_type]}='$stx'");
		$sql_search .= " and mb_no = '$mb[mb_no]' ";
	} elseif($sfl=="od_id"){
		$order = sql_fetch("select cart_id from nfor_order where od_id='$stx'");
		$sql_search .= " and cart_id = '$order[cart_id]' ";
	} elseif($sfl=="name"){
		$sql_search .= " and (ct_mb_name = '$stx' or ct_od_name = '$stx' or ct_dy_name = '$stx') ";
	} elseif($sfl=="hp"){
		$sql_search .= " and (ct_mb_hp = '$stx' or ct_od_hp = '$stx' or ct_dy_hp = '$stx') ";
	} elseif($sfl=="email"){
		$sql_search .= " and (ct_mb_email = '$stx' or ct_od_email = '$stx') ";
	} else{
		$sql_search .= " and $sfl like '%$stx%' ";
	}
}

if(!$sst){
	$sst = "ct_id";
	$sod = "desc";
}
$sql_order = " order by $sst $sod ";
$sql = " select count(*) as cnt
						 $sql_common
						 $sql_search
						 $sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];
$rows = $config[cf_page_rows];
$total_page  = ceil($total_count / $rows);
if(!$page) $page = 1;
$from_record = ($page - 1) * $rows;
$sql = " select *
			  $sql_common
			  $sql_search
			  $sql_order";

if($mode=="excel"){

	require_once "$nfor[path]/PHPExcel.php";
	$objPHPExcel = new PHPExcel();

	$result = sql_query($sql);
	$cnt = @sql_num_rows($result);
	if(!$cnt) alert("출력할 내역이 없습니다.");

	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue("A1", "고유번호")
				->setCellValue("B1", "주문번호")
				->setCellValue("C1", "아이디")
				->setCellValue("D1", "이름")
				->setCellValue("E1", "전화번호")
				->setCellValue("F1", "이메일")
				->setCellValue("G1", "상품명")
				->setCellValue("H1", "옵션명")
				->setCellValue("I1", "수량")
				->setCellValue("J1", "배송이름")
				->setCellValue("K1", "배송전화")
				->setCellValue("L1", "배송주소")
				->setCellValue("M1", "배송상태")
				->setCellValue("N1", "주문일자")
				->setCellValue("O1", "택배업체")
				->setCellValue("P1", "송장번호")
				->setCellValue("Q1", "티켓번호")
				->setCellValue("R1", "판매가격")
				->setCellValue("S1", "공급가격")
				->setCellValue("T1", "결제수단")
				->setCellValue("U1", "결제구분")
				->setCellValue("V1", "카드종류");

	for($i=2; $data=sql_fetch_array($result); $i++){    
		$order = sql_fetch("select * from nfor_order where cart_id='$data[cart_id]'");
		$row = array_merge($data, $order);

		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue("A$i", "$row[ct_id]")
					->setCellValue("B$i", "$row[od_id]")
					->setCellValue("C$i", mb_id($row[mb_no]))
					->setCellValue("D$i", "$row[mb_name]")
					->setCellValue("E$i", "$row[mb_hp]")
					->setCellValue("F$i", "$row[mb_email]")
					->setCellValue("G$i", item_name($row[it_id]))
					->setCellValue("H$i", option_select($row))
					->setCellValue("I$i", "$row[option_cnt]")
					->setCellValue("J$i", "$row[dy_name]")
					->setCellValue("K$i", "$row[dy_hp]")
					->setCellValue("L$i", "$row[dy_zip] $row[dy_addr1] $row[dy_addr2]")
					->setCellValue("M$i", delivery_step($row[delivery_step]))
					->setCellValue("N$i", "$row[od_datetime]")
					->setCellValue("O$i", "$row[delivery_company]")
					->setCellValue("P$i", "$row[delivery_number]")
					->setCellValue("Q$i", $row[ticket_number]?$row[ticket_number]:strtoupper(sql_old_password($row[ct_id])))
					->setCellValue("R$i", "$row[option_price]")
					->setCellValue("S$i", "$row[supply_price]")
					->setCellValue("T$i", payment_type($row[payment_type]))
					->setCellValue("U$i", $row[is_mobile]?"(모바일웹)":"")
					->setCellValue("V$i", card_info($row));
	}
 


	// 시트이름
	$objPHPExcel->getActiveSheet()->setTitle($menu_code[access_text]);

	$objPHPExcel->setActiveSheetIndex(0);

	// 파일명
	$filename = urlencode($menu_code[access_text]);

	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');

	exit;
}

$sql .= " limit $from_record, $rows ";
$result = sql_query($sql);

include "head.php";
?>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td align="left" height="50">주문서수 : <?=number_format($total_count)?>개</td>
	<td align="right">
	<form name="fsearch" method="get">
	<select name="date_type">
		<option value="">일자구분
		<option value="ct_od_date" <?=$date_type=="ct_od_date"?"selected":""?>>주문일자
		<option value="ct_od_paydate" <?=$date_type=="ct_od_paydate"?"selected":""?>>결제일자
		<option value="od_cancelrequest" <?=$date_type=="od_cancelrequest"?"selected":""?>>취소신청일자
		<option value="payment_date" <?=$date_type=="payment_date"?"selected":""?>>정산일자
	</select> 
	<input type="text" name="od_sdate" id="od_sdate" value="<?=$od_sdate?>"> ~ <input type="text" name="od_edate" id="od_edate" value="<?=$od_edate?>">

	<select name="ticket_state">
	<option value="">사용구분
	<option value="1" <? if($ticket_state=="1") echo "selected"; ?>>사용
	<option value="2" <? if($ticket_state=="2") echo "selected"; ?>>미사용
	</select>

	<select name="payment_ok">
	<option value="">정산구분
	<option value="1" <? if($payment_ok==1) echo "selected"; ?>>정산대기
	<option value="2" <? if($payment_ok==2) echo "selected"; ?>>정산완료
	</select>	

	<select name="ct_payment_type">
		<option value="">결제수단
		<option value="card" <?=$ct_payment_type=="card"?"selected":""?>>신용카드
		<option value="iche" <?=$ct_payment_type=="iche"?"selected":""?>>계좌이체
		<option value="hp" <?=$ct_payment_type=="hp"?"selected":""?>>휴대폰결제
		<option value="vbanking" <?=$ct_payment_type=="vbanking"?"selected":""?>>가상계좌
		<option value="banking" <?=$ct_payment_type=="banking"?"selected":""?>>무통장입금
		<option value="money" <?=$ct_payment_type=="money"?"selected":""?>>적립금
		<option value="coupon" <?=$ct_payment_type=="coupon"?"selected":""?>>쿠폰
	</select>

	<select name="ct_is_mobile">
		<option value="">결제구분
		<option value="1" <?=$ct_is_mobile=="1"?"selected":""?>>모바일
		<option value="2" <?=$ct_is_mobile=="2"?"selected":""?>>PC
	</select>


	<? if($member[is_supply]=="10"){ ?>
	<select name="supply_no">
		<option value="">전체
		<?
		$que = sql_query("select * from nfor_member where is_supply='1' order by ( case when  supply_name between '가' and  '金' then 1  else 2  end ), supply_name asc");
		while($data = sql_fetch_array($que)){
		?>
		<option value="<?=$data[mb_no]?>" <?=$data[mb_no]==$supply_no?"selected":""?>><?=$data[supply_name]?>
		<? } ?>
	</select>
	<? } else{ ?>
	<select name="it_id">
		<option value="">전체
		<?
		$que = sql_query("select * from nfor_item where supply_no='$member[mb_no]' order by it_datetime desc");
		while($data = sql_fetch_array($que)){
		?>
		<option value="<?=$data[it_id]?>" <?=$data[it_id]==$it_id?"selected":""?>><?=$data[it_name]?>
		<? } ?>
	</select>
	<? } ?>	
	<select name="sfl">
	<?
	$sfl_txt_array = array("이름","연락처","이메일","아이디","주문번호","상품코드","수동티켓번호","자동티켓번호");
	$sfl_val_array = array("name","hp","email","mb_id","od_id","it_id","ticket_number","old_password(ct_id)");
	for($i=0; $i<count($sfl_txt_array); $i++){
	?>
	<option value="<?=$sfl_val_array[$i]?>" <? if($sfl==$sfl_val_array[$i]) echo "selected"; ?>><?=$sfl_txt_array[$i]?>
	<? } ?>
	</select>
	<input type="text" name="stx" value="<?=$stx?>"><input type="image" src="img/gum_btn.gif" align="absmiddle"> 
	<a href="<?=$PHP_SELF?>?mode=excel&<?=$qstr?>"><img src="img/ex_down.gif" alt="엑셀다운" align="absmiddle"></a>
	</form>
	</td>
</tr>
</table>

<form name="flist" id="flist" method="post" action="<?=$PHP_SELF?>">
<input type="hidden" name="mode" id="mode">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="date_type" value="<?=$date_type?>">
<input type="hidden" name="od_sdate" value="<?=$od_sdate?>">
<input type="hidden" name="od_edate" value="<?=$od_edate?>">
<input type="hidden" name="supply_no" value="<?=$supply_no?>">
<input type="hidden" name="it_id" value="<?=$it_id?>">
<input type="hidden" name="ticket_state" value="<?=$ticket_state?>">
<input type="hidden" name="payment_ok" value="<?=$payment_ok?>">
<input type="hidden" name="ct_payment_type" value="<?=$ct_payment_type?>">
<input type="hidden" name="ct_is_mobile" value="<?=$ct_is_mobile?>">
<table class="tbl_typeB" cellpadding="0" cellspacing="0">
<tr>
	<th width="40"><input type="checkbox" name="chkall" value="1" onclick="check_all(this.form)"></th>
	<th>주문번호</th>
	<th>주문자정보</th>
	<th>상품명</th>
	<th>옵션명</th>
	<th>수량</th>
	<th>가격</th>
	<th>합산</th>
	<th>배송정보</th>
	<th>배송상태</th>
	<th>티켓사용</th>
	<th>결제수단</th>
	<th>주문일자</th>
	
	<th>취소사유</th>
	<th>상태변경</th>
	<th>DB상태취소</th>
</tr>
<?								
for($i=0; $data=sql_fetch_array($result); $i++){
	$order = sql_fetch("select * from nfor_order where cart_id='$data[cart_id]'");
	$row = array_merge($data, $order);

	$it_name = item_name($row[it_id]);
	$msg = addslashes($it_name)."(".$row[od_id].")";

	if($row[payment_type]<>"banking" and $row[pg_tid]){
		$cancel_btn = "javascript:order_cancel_btn('kcp_cancel.php?ct_id={$row[ct_id]}&tid={$row[pg_tid]}&{$qstr}','$msg','pg')";
		$cancel_kind = 1;
	} else{
		$cancel_btn = "javascript:order_cancel_btn('{$PHP_SELF}?mode=cancel&ct_id={$row[ct_id]}&{$qstr}','$msg','db')";
		$cancel_kind = 2;
	}
	$db_cancel_btn = "javascript:order_cancel_btn('{$PHP_SELF}?mode=cancel&ct_id={$row[ct_id]}&{$qstr}','$msg','db')";

	$asign_btn = "javascript:order_asign_btn('{$PHP_SELF}?mode=asign&ct_id={$row[ct_id]}&{$qstr}','$msg')";

?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
	<td><input type="checkbox" name="chk[]" value="<?=$i?>"><input type="hidden" name="ct_id[<?=$i?>]" value="<?=$row[ct_id]?>"></td>
	<td><a href="<?=str_replace("list","form",basename($PHP_SELF))."?od_id=$row[od_id]&".$qstr?>"><?=$row[od_id]?></a></td>
	<td><?=order_mb($row)?></td>
	<td><a href="<?=$nfor[load]?>?it_id=<?=$row[it_id]?>" target="_blank"><?=$it_name?></a></td>
	<td><?=option_select($row)?></td>
	<td><?=$row[option_cnt]?>개</td>
	<td><?=number_format($row[option_price])?>원</td>
	<td><?=number_format($row[option_price]*$row[option_cnt])?>원</td>
	<td><? if($row[it_delivery]){ ?><?=$row[dy_name]?><br><?=$row[dy_hp]?><br><?=$row[dy_zip]?> <?=$row[dy_addr1]?> <?=$row[dy_addr2]?><? } else{ echo "-";  } ?></td> 
	<td><? if($row[it_delivery]){ ?><?=delivery_step($row[delivery_step])?><? } else{ echo "-";  } ?></td>
	<td><? if($row[it_delivery]){ ?>-<? } else{ ?><?=$row[ticket_used]?>개<? } ?></td>
	
	<td><?=payment_type($row[payment_type])?><br><?=$row[is_mobile]?"(모바일웹)":""?><?=card_info($row)?></td>
	<td><?=substr($row[od_datetime],0,10)?></td>
	<td><?=$row[cancel_why]?><br><?=$row[cancel_why_msg]?></td>
	<td>
		<a href="#" onclick="order_cart_cancelkindrequest_update(this)"><img src="img/ju_btn01.jpg" alt="주문취소처리" align="absmiddle"></a><br>
		<a href="#" onclick="order_depositrequest_btn(this)"><img src="img/ju_btn03.jpg" alt="주문완료처리" align="absmiddle"></a>
		<input type="hidden" id="od_id" value="<?=$row[od_id]?>">
		<input type="hidden" id="it_name" value="<?=$it_name?>">
		<input type="hidden" id="mb_name" value="<?=$row[mb_name]?>">
		<input type="hidden" id="mb_hp" value="<?=$row[mb_hp]?>">
	</td>
	<td>
		<a href="#" onclick="order_cart_cancelrequest(this)"><img src="img/ju_btn01.jpg" alt="주문취소처리" align="absmiddle"></a>
		<input type="hidden" id="od_id" value="<?=$row[od_id]?>">
		<input type="hidden" id="it_name" value="<?=$it_name?>">
		<input type="hidden" id="mb_name" value="<?=$row[mb_name]?>">
		<input type="hidden" id="mb_hp" value="<?=$row[mb_hp]?>">
	</td>
</tr>
<?
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<div class="btn_cen"><?=$pagelist?></div>
</form>

<!-- 문자 -->
<script type = "text/javascript">
    function setPhoneNumber(val){
        var numList = val.split("-");
        document.smsForm.sphone1.value=numList[0];
        document.smsForm.sphone2.value=numList[1];
        if(numList[2] != undefined){
            document.smsForm.sphone3.value=numList[2];
        }
    }
    function loadJSON(){
        var data_file = "./calljson.php";
        var http_request = new XMLHttpRequest();
        try{
            // Opera 8.0+, Firefox, Chrome, Safari
            http_request = new XMLHttpRequest();
        }catch (e){
            // Internet Explorer Browsers
            try{
                http_request = new ActiveXObject("Msxml2.XMLHTTP");

            }catch (e) {

                try{
                    http_request = new ActiveXObject("Microsoft.XMLHTTP");
                }catch (e){
                    // Eror
                    alert("지원하지 않는브라우저!");
                    return false;
                }

            }
        }
        http_request.onreadystatechange = function(){
            if (http_request.readyState == 4  ){
                // Javascript function JSON.parse to parse JSON data
                var jsonObj = JSON.parse(http_request.responseText);
                if(jsonObj['result'] == "Success"){
                    var aList = jsonObj['list'];
                    var selectHtml = "<select id='snd_nm' name=\"sendPhone\" onchange=\"setPhoneNumber(this.value)\">";
                    selectHtml += "<option value='' selected>발신번호를 선택해주세요</option>";
                    for(var i=0; i < aList.length; i++){
                        selectHtml += "<option value=\"" + aList[i] + "\">";
                        selectHtml += aList[i];
                        selectHtml += "</option>";
                    }
                    selectHtml += "</select>";
                    document.getElementById("sendPhoneList").innerHTML = selectHtml;
                }
            }
        }

        http_request.open("GET", data_file, true);
        http_request.send();
    }

</script>

<form method="post" id="smsForm" name="smsForm" action="./sms_send.php" target="_self" style="display: none;">

<br />받는 번호 <input type="text" name="rphone" value="" id="rphone">

<br />
보내는 번호  <input type="hidden" name="sphone1" value="010">
<input type="hidden" name="sphone2" value="2800">
<input type="hidden" name="sphone3" value="7184">
<span id="sendPhoneList"></span>
<br /> test flag <input type="text" name="testflag" maxlength="1" value="Y"> 예) 테스트시: Y
<br />nointeractive <input type="text" name="nointeractive" maxlength="1"> 예) 사용할 경우 : 1, 성공시 대화상자(alert)를 생략.

        <br>
<input type="submit" value="전송" id="sms_btn">
<input type="hidden" name="action" value="go">
발송타입 <span><input type="radio" name="smsType" value="S" checked>단문(SMS)</span>
<!-- <span><input type="radio" name="smsType" value="L">장문(LMS)</span> --> <br />
<!-- 제목 : <input type="text" name="subject" value="제목"> 장문(LMS)인 경우(한글30자이내)<br /> -->
전송메세지

<textarea id="msg" name="msg" cols="30" rows="10" style="width:455px;"></textarea>
</form>

<script>
$(document).ready(function() {
	document.smsForm.sphone1.value='010';
	document.smsForm.sphone2.value='2126';
	document.smsForm.sphone3.value='2774';
});
</script>
<script>
// 주문취소 처리
function order_cart_cancelkindrequest_update(obj) {
	var od_id = $(obj).siblings('#od_id').val();
	var it_name = $(obj).siblings('#it_name').val();
	var mb_name = $(obj).siblings('#mb_name').val();
	var mb_hp = $(obj).siblings('#mb_hp').val();
	var cancel_kind = '<?=$cancel_kind?>';


	$('#rphone').val(mb_hp);
	$('#msg').val(mb_name + " 고객님\n주문번호 : " + od_id + "\n상품이름 : " + it_name + "\n주문취소처리가 완료되었습니다.");

	var cancel_ck = confirm('주문취소처리대상\n' + it_name + '(' + od_id + ')\n\n' + '확인버튼을 누르실경우 전자결제(PG)는 취소되지 않으며 주문서 상태만 취소됩니다. 그래도 진행하시겠습니까?');
	
	if (cancel_ck == true){
		if(cancel_kind == '1'){
			alert('1');
		} else {
			// DB UPDATE
			$.ajax({
				type : "post"
				, url : "./order_cart_cancelrequest_update.php?mode=cancel"
				, cache : false
				, async : false
				, data : {
					od_id : od_id,
					cancel_kind : cancel_kind,
				}
				, success : function(data){
					if(data == '1'){
						alert('배송된 상품이 존재하여 취소가 불가능합니다. 반품 처리후 진행해주세요.');
					} else if(data == '2'){
						alert('이미 부분취소된 상품이 존재하여 취소가 불가능합니다. 개별주문관리를 통해서 취소를 진행해주세요.');
					} else if(data == '3'){
						alert('주문취소 처리되었습니다.');

						// 문자전송
						cancel_sms();
					} else {
						alert("주문취소에 실패하였습니다");
					}
				}
			});


		} 

		// 페이지 새로고침
		location.reload();
	} else {
		// return false;
	}

}

// DB 주문취소 처리
function order_cart_cancelrequest(obj) {
	var od_id = $(obj).siblings('#od_id').val();
	var it_name = $(obj).siblings('#it_name').val();
	var mb_name = $(obj).siblings('#mb_name').val();
	var mb_hp = $(obj).siblings('#mb_hp').val();

	$('#rphone').val(mb_hp);
	$('#msg').val(mb_name + " 고객님\n주문번호 : " + od_id + "\n상품이름 : " + it_name + "\n주문취소처리가 완료되었습니다.");

	var cancel_ck = confirm('주문취소처리대상\n' + it_name + '(' + od_id + ')\n\n' + '확인버튼을 누르실경우 전자결제(PG)는 취소되지 않으며 주문서 상태만 취소됩니다. 그래도 진행하시겠습니까?');
	
	if (cancel_ck == true){
			// DB UPDATE
			$.ajax({
				type : "post"
				, url : "./order_cart_cancelrequest_update.php?mode=cancel"
				, cache : false
				, async : false
				, data : {
					od_id : od_id,
				}
				, success : function(data){
					if(data == '1'){
						alert('배송된 상품이 존재하여 취소가 불가능합니다. 반품 처리후 진행해주세요.');
					} else if(data == '2'){
						alert('이미 부분취소된 상품이 존재하여 취소가 불가능합니다. 개별주문관리를 통해서 취소를 진행해주세요.');
					} else if(data == '3'){
						alert('주문취소 처리되었습니다.');

						// 문자전송
						cancel_sms();
					} else {
						alert("주문취소에 실패하였습니다");
					}
				}
			});

		// 페이지 새로고침
		location.reload();
	} else {
		// return false;
	}

}

// 주문완료 처리
function order_depositrequest_btn(obj) {
	var od_id = $(obj).siblings('#od_id').val();
	var it_name = $(obj).siblings('#it_name').val();
	var mb_name = $(obj).siblings('#mb_name').val();
	var mb_hp = $(obj).siblings('#mb_hp').val();

	$('#rphone').val(mb_hp);
	$('#msg').val(mb_name + " 고객님\n주문번호 : " + od_id + "\n상품이름 : " + it_name + "\n주문완료되었습니다.");

	var cancel_ck = confirm('주문취소처리대상\n' + it_name + '(' + od_id + ')\n\n' + '확인버튼을 누르실경우 전자결제(PG)는 취소되지 않으며 주문서 상태만 취소됩니다. 그래도 진행하시겠습니까?');
	
	if (cancel_ck == true){
		// DB UPDATE
		$.ajax({
			type : "post"
			, url : "./order_cart_cancelrequest_update.php?mode=asign"
			, cache : false
			, async : false
			, data : {
				od_id : od_id,
			}
			, success : function(data){
				if(data == '5'){
					alert('주문완료 처리되었습니다.');

					// 문자전송?
					// cancel_sms();
				} else {
					alert("주문완료에 실패하였습니다");
				}
			}
		});
		
	} else {
		// return false;
	}

	// 페이지 새로고침
	location.reload();

}

function cancel_sms(){
  $.ajax({
    type : "post"
    , url : "./sms_send.php"
    , cache : false
    , data : $("#smsForm").serialize()
  });
}
</script>
<?
include "tail.php";
?>