<?php	// 입금대기목록
include "path.php";
ini_set('memory_limit', -1);

$qstr .= "&is_mobile=$is_mobile&payment_type=$payment_type&od_sdate=$od_sdate&od_edate=$od_edate&date_type=$date_type";

// if($mode=="delete"){
// 	banking_cancel($od_id);
// 	alert("정상적으로 삭제되었습니다","$PHP_SELF?$qstr");	
// }

// if($mode=="list_delete"){
// 	for($i=0; $i<count($chk); $i++){
// 		$k = $_POST['chk'][$i];
// 		banking_cancel($_POST['od_id'][$k]);
// 	}	
// 	alert("주문취소 처리되었습니다","$PHP_SELF?$qstr");
// }

// if($mode=="asign"){
// 	banking_asign($od_id);
// 	alert("주문완료 처리되었습니다","$PHP_SELF?$qstr");
// }

if($mode=="list_asign"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		banking_asign($_POST['od_id'][$k]);
	}
	alert("주문완료 처리되었습니다","$PHP_SELF?$qstr");
}

$sql_common = " from nfor_order ";
$sql_search = " where pay_step='4' ";

if($is_mobile){
	if($is_mobile=="1"){
		$sql_search .= " and is_mobile='1'";
	} else{
		$sql_search .= " and is_mobile='0'";
	}
}

if($payment_type){
	$sql_search .= " and payment_type='$payment_type'";
}

if($od_sdate and $od_edate and $date_type){
	$sql_search .= " and date_format($date_type,'%Y-%m-%d')>='$od_sdate' and date_format($date_type,'%Y-%m-%d')<='$od_edate' ";
}
if($stx){
	if($sfl=="mb_id"){
		$mb = sql_fetch("select mb_no from nfor_member where {$nfor[id_type]}='$stx'");
		$sql_search .= " and mb_no = '$mb[mb_no]' ";
	} else{
		$sql_search .= " and $sfl like '%$stx%' ";
	}
}
if(!$sst){
	$sst = "od_datetime";
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
				->setCellValue("A1", "주문번호")
				->setCellValue("B1", "주문자 아이디")
				->setCellValue("C1", "주문자 이름")
				->setCellValue("D1", "주문자 연락처")
				->setCellValue("E1", "주문자 이메일")
				->setCellValue("F1", "상품정보")
				->setCellValue("G1", "상품금액")
				->setCellValue("H1", "배송금액")
				->setCellValue("I1", "합산금액")
				->setCellValue("J1", "적립금사용금액")
				->setCellValue("K1", "결제수단")				
				->setCellValue("L1", "주문일자")
				->setCellValue("M1", "입금자명")
				->setCellValue("N1", "입금은행")
				->setCellValue("O1", "입금예정일자");

	for($i=2; $row=sql_fetch_array($result); $i++){    

		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue("A$i", $row[od_id])
					->setCellValue("B$i", mb_id($row[mb_no]))
					->setCellValue("C$i", $row[mb_name])
					->setCellValue("D$i", $row[mb_hp])
					->setCellValue("E$i", $row[mb_email])
					->setCellValue("F$i", it_name($row[od_id]))
					->setCellValue("G$i", $row[it_price])
					->setCellValue("H$i", $row[delivery_price])
					->setCellValue("I$i", $row[total_price])
					->setCellValue("J$i", $row[money_price])
					->setCellValue("K$i", payment_type($row[payment_type]))					
					->setCellValue("L$i", substr($row[od_datetime],0,10))
					->setCellValue("M$i", $row[bank_name])
					->setCellValue("N$i", $row[bank_number])
					->setCellValue("O$i", $row[bank_date]);
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
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
	<td align="left" height="50">주문서수 : <?=number_format($total_count)?>개</td>
	<td align="right">
	<form name="fsearch" method="get">

	<select name="payment_type">
		<option value="">결제수단
		<option value="card" <?=$payment_type=="card"?"selected":""?>>신용카드
		<option value="iche" <?=$payment_type=="iche"?"selected":""?>>계좌이체
		<option value="hp" <?=$payment_type=="hp"?"selected":""?>>휴대폰결제
		<option value="vbanking" <?=$payment_type=="vbanking"?"selected":""?>>가상계좌
		<option value="banking" <?=$payment_type=="banking"?"selected":""?>>무통장입금
		<option value="money" <?=$payment_type=="money"?"selected":""?>>적립금
		<option value="coupon" <?=$payment_type=="coupon"?"selected":""?>>쿠폰
	</select>

	<select name="is_mobile">
		<option value="">결제구분
		<option value="1" <?=$is_mobile=="1"?"selected":""?>>모바일
		<option value="2" <?=$is_mobile=="2"?"selected":""?>>PC
	</select>

	<select name="date_type">
		<option value="">일자구분
		<option value="od_datetime" <?=$date_type=="od_datetime"?"selected":""?>>주문일자
		<option value="bank_date" <?=$date_type=="bank_date"?"selected":""?>>입금예정일자
	</select> 
	<input type="text" name="od_sdate" id="od_sdate" value="<?=$od_sdate?>"> ~ <input type="text" name="od_edate" id="od_edate" value="<?=$od_edate?>">
	<select name="sfl">
	<?
	$sfl_txt_array = array("입금자명","주문번호","아이디","주문자이름","주문자연락처","주문자이메일","배송지이름","배송지연락처","사용자이름","사용자연락처","사용자이메일","자동이체코드");
	$sfl_val_array = array("bank_name","od_id","mb_id","mb_name","mb_hp","mb_email","dy_name","dy_hp","od_name","od_hp","od_email","pg_tid");
	for($i=0; $i<count($sfl_txt_array); $i++){
	?>
	<option value="<?=$sfl_val_array[$i]?>" <? if($sfl==$sfl_val_array[$i]) echo "selected"; ?>><?=$sfl_txt_array[$i]?>
	<? } ?>
	</select>
	<input type="text" name="stx" value="<?=$stx?>">
	<input type="image" src="img/gum_btn.gif" align="absmiddle">
	<a href="<?=$PHP_SELF?>?mode=excel&<?=$qstr?>"><img src="img/ex_down.gif" alt="엑셀다운" align="absmiddle"></a>
	</form>
	</td>
</tr>
</table>

<form name="flist" id="flist" method="post" action="<?=$PHP_SELF?>">
<INPUT TYPE="hidden" NAME="mode" id="mode">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="date_type" value="<?=$date_type?>">
<input type="hidden" name="od_sdate" value="<?=$od_sdate?>">
<input type="hidden" name="od_edate" value="<?=$od_edate?>">
<table class="tbl_typeB" cellpadding="0" cellspacing="0">
<tr>
	<th width="40"><input type="checkbox" name="check_group" value="1" onclick="CheckAll(this.form)"></th>
	<th>주문번호</th>
	<th>주문자정보</th>
	<th>상품정보</th>
	<th>상품금액</th>
	<th>배송금액</th>
	<th>합산금액</th>
	<th>적립금</th>
	<th>할인쿠폰</th>
	<th>결제수단</th>
	<th>주문일자</td>
	<th>입금자명</th>
	<th>입금은행</th>
	<th>입금예정일자</th>
	<th>상태변경</th>
</tr>
<?								
for($i=0; $row=sql_fetch_array($result); $i++){

	$it_name = it_name($row[od_id]);
	$msg = addslashes($it_name)."(".$row[od_id].")";

	$cancel_btn = "javascript:order_cancel_btn('{$PHP_SELF}?mode=delete&od_id={$row[od_id]}&{$qstr}','$msg','db')";
	$asign_btn = "javascript:order_asign_btn('{$PHP_SELF}?mode=asign&od_id={$row[od_id]}&{$qstr}','$msg')";

	$order_wait_form = "order_wait_form.php?od_id={$row[od_id]}&{$qstr}";
?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
	<td><input type="checkbox" name="od_chk" value="<?=$i?>"><input type="hidden" name="od_id[<?=$i?>]" value="<?=$row[od_id]?>"></td>
	<td><a href="<?=str_replace("list","form",basename($PHP_SELF))."?od_id=$row[od_id]&".$qstr?>"><?=$row[od_id]?></a></td>
	<td><?=order_mb($row)?></td>
	<td><?=$it_name?></td>
	<td><?=number_format($row[it_price])?>원</td>
	<td><?=number_format($row[delivery_price])?>원</td>
	<td><?=number_format($row[total_price])?>원</td>
	<td><?=number_format($row[money_price])?>원</td>
	<td><?=number_format($row[coupon_price])?>원</td>
	<td><?=payment_type($row[payment_type])?><br><?=$row[is_mobile]?"(모바일웹)":""?></td>	
	<td><?=substr($row[od_datetime],0,10)?></td>
	<td><?=$row[bank_name]?></td>
	<td><?=$row[bank_number]?></td>
	<td><?=$row[bank_date]?></td>
	<td id="mb_info">
	<a href="#" onclick="order_cancel_btn(this)"><img src="img/ju_btn01.jpg" alt="주문취소처리" align="absmiddle"></a><br>
	<a href="#" onclick="order_deposit_btn(this)"><img src="img/ju_btn03.jpg" alt="주문완료처리" align="absmiddle"></a>
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
<div class="btn_cen">
<a href="#" onclick="order_m_deposit()"><img src="img/sun2_del.gif" alt="주문완료처리"></a>
<a href="#" onclick="order_m_cancel()"><img src="img/sun11_del.gif" alt="주문삭제"></a>
</div>


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

function CheckAll(){             
	var gChk = document.getElementsByName("check_group");    //체크박스의 name값
	var nChk = document.getElementsByName("od_chk");                   
	
	if(gChk[0].checked){ 
		for(i=0; i<nChk.length;i++){                                    
			nChk[i].checked = true;     //체크되어 있을경우 설정변경
		}
	}else{
		for(i=0; i<nChk.length;i++){                                            
			nChk[i].checked = false;                                              
		}  
	}
}

// 주문취소
function order_cancel_btn(obj) {
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
			, url : "./order_cancel_update.php"
			, cache : false
			, data : {
				od_id : od_id,
			}
		});

		// 문자전송
		cancel_sms();

		// 페이지 새로고침
		location.reload();

	} else {
		// return false;
	}

}

// 다중 주문취소
function order_m_cancel() {
	var nums = "";
	var phones = "";
	var mb_names = "";
	var it_names = "";

	if(!confirm("주문취소를 계속 진행하시겠습니까?")) {
		return;
	}

	$("input:checkbox[name=od_chk]").each(function(index) {
		if($(this).prop("checked")) {
			nums += nums == "" ? $(this).siblings().val() : ","+ $(this).siblings().val();

			phones += phones == "" ? $(this).parents().siblings('#mb_info').children('#mb_hp').val() : ","+ $(this).parents().siblings('#mb_info').children('#mb_hp').val();

			mb_names += mb_names == "" ? $(this).parents().siblings('#mb_info').children('#mb_name').val() : ","+ $(this).parents().siblings('#mb_info').children('#mb_name').val();

			it_names += it_names == "" ? $(this).parents().siblings('#mb_info').children('#it_name').val() : ","+ $(this).parents().siblings('#mb_info').children('#it_name').val();
		};
	});

	if(nums == "") {
		alert("취소할 주문을 선택해주세요.");
		return;
	} else{
		var cancel_od_id = nums.split(",");
		var cancel_phone_num = phones.split(",");
		var cancel_mb_name = mb_names.split(",");
		var cancel_it_name = it_names.split(",");

		for(var i=0; i<cancel_od_id.length; i++){
			var od_id = cancel_od_id[i];
			var mb_hp = cancel_phone_num[i];
			var mb_name = cancel_mb_name[i];
			var it_name = cancel_it_name[i];
			
			// 문자 info
			$('#rphone').val(mb_hp);
			$('#msg').val(mb_name + " 고객님\n주문번호 : " + od_id + "\n상품이름 : " + it_name + "\n주문취소처리가 완료되었습니다.");

			$.ajax({
				type : "post"
				, url : "./order_cancel_update.php"
				, cache : false
				, data : {
					od_id : od_id,
				}
			});

			// 문자전송
			cancel_sms();

		}

		// 페이지 새로고침
		location.reload();

	}

}

// 입금확인
function order_deposit_btn(obj) {
	var od_id = $(obj).siblings('#od_id').val();
	var it_name = $(obj).siblings('#it_name').val();
	var mb_name = $(obj).siblings('#mb_name').val();
	var mb_hp = $(obj).siblings('#mb_hp').val();

	$('#rphone').val(mb_hp);
	$('#msg').val(mb_name + " 고객님\n주문번호 : " + od_id + "\n상품이름 : " + it_name + "\n입급확인되었습니다.");

	var cancel_ck = confirm('주문완료처리대상\n' + it_name + '(' + od_id + ')\n\n' + '확인버튼을 누르실경우 주문서 상태가 주문완료로 변경됩니다. 그래도 진행하시겠습니까?');

	
	if (cancel_ck == true){
		// DB UPDATE
		$.ajax({
			type : "post"
			, url : "./order_deposit_update.php"
			, cache : false
			, data : {
				od_id : od_id,
			}
		});

		// 문자전송
		cancel_sms();

		// 페이지 새로고침
		location.reload();

	} else {
		// return false;
	}

}

// 다중 입금확인
function order_m_deposit() {
	var nums = "";
	var phones = "";
	var mb_names = "";
	var it_names = "";

	if(!confirm("입금확인을 계속 진행하시겠습니까?")) {
		return;
	}

	$("input:checkbox[name=od_chk]").each(function(index) {
		if($(this).prop("checked")) {
			nums += nums == "" ? $(this).siblings().val() : ","+ $(this).siblings().val();

			phones += phones == "" ? $(this).parents().siblings('#mb_info').children('#mb_hp').val() : ","+ $(this).parents().siblings('#mb_info').children('#mb_hp').val();

			mb_names += mb_names == "" ? $(this).parents().siblings('#mb_info').children('#mb_name').val() : ","+ $(this).parents().siblings('#mb_info').children('#mb_name').val();

			it_names += it_names == "" ? $(this).parents().siblings('#mb_info').children('#it_name').val() : ","+ $(this).parents().siblings('#mb_info').children('#it_name').val();
		};
	});

	if(nums == "") {
		alert("입금확인할 주문을 선택해주세요.");
		return;
	} else{
		var cancel_od_id = nums.split(",");
		var cancel_phone_num = phones.split(",");
		var cancel_mb_name = mb_names.split(",");
		var cancel_it_name = it_names.split(",");

		for(var i=0; i<cancel_od_id.length; i++){
			var od_id = cancel_od_id[i];
			var mb_hp = cancel_phone_num[i];
			var mb_name = cancel_mb_name[i];
			var it_name = cancel_it_name[i];
			
			// 문자 info
			$('#rphone').val(mb_hp);
			$('#msg').val(mb_name + " 고객님\n주문번호 : " + od_id + "\n상품이름 : " + it_name + "\n입급확인되었습니다.");

			$.ajax({
				type : "post"
				, url : "./order_deposit_update.php"
				, cache : false
				, data : {
					od_id : od_id,
				}
			});

			// 문자전송
			cancel_sms();

		}

		// 페이지 새로고침
		location.reload();

	}

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