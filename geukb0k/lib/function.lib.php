<?php	// 정의함수

function download_url($dirname,$filename,$orgname=""){
	$str = "download.php?dirname=$dirname&filename=".urlencode($filename);
	if($orgname){
		$str .= "&orgname=".urlencode($orgname);
	}
	return $str;
}

function expiry_chk($order,$item){
		global $nfor;
		if($item[it_expiry_type]=="1"){
			$ymd = date("Y-m-d",strtotime("+{$item[it_expiry_day]} day", strtotime($order[od_paydatetime])));
			if($nfor[ymdhis] <= $ymd) {
				$str = "1";
			}
		} elseif($item[it_expiry_type]=="2"){
			if($nfor[ymdhis] <= $item[it_enddate]) {
				$str = "1";
			}
		} else{

		}
		return $str;
}

function expiry_date($order,$item){
		global $nfor;
		if($item[it_expiry_type]=="1"){
			$ymd = date("Y-m-d",strtotime("+{$item[it_expiry_day]} day", strtotime($order[od_paydatetime])));
			$str = substr($order[od_paydatetime],0,10)." ~ ".$ymd;
		} elseif($item[it_expiry_type]=="2"){
			$str = substr($item[it_startdate],0,10)." ~ ".substr($item[it_enddate],0,10);
		} else{

		}
		return $str;
}



function card_info($data){
	global $nfor;
	$pg_code = $data[pg_card_info1];
	$card = sql_fetch("select pg_name from nfor_pg_code where pg_type='$nfor[pg_type]' and pg_payment_type='card' and pg_code='$pg_code'");
	return $card[pg_name];
}


function area_info($item){
	for($i=1; $i<=10; $i++){
		if(substr($item["category_id".$i],0,3)=="008"){
			$data = sql_fetch("select * from nfor_item_category where category_id = '".$item["category_id".$i]."'");

			if($data[wr_1]){
				$st = "font-size:{$data[wr_1]}px";
			} else{
				$st = "";
			}

			$return .= "<span class='area'><b class='area_txt' style='$st'>$data[wr_2]</b></span>";


		}
	}
	return $return;
}


function zzim_cnt($mb_no){
	$zzim = sql_fetch("select count(*) as cnt from nfor_zzim where mb_no='$mb_no'");
	return $zzim[cnt];
}

function juna_mb_id($mb_id){
	$mb = sql_fetch("select * from nfor_member where mb_id='$mb_id'");

	/*
	if($mb[mb_nick]){
		echo $mb[mb_nick];
	} elseif($mb[mb_id]){
		echo mb_id_chg($mb[mb_id]);
	} else{

	}
	*/
	if($mb[mb_id]){
		echo mb_id_chg($mb[mb_id]);
	}


}


function level_name($point){

}

function insert_point($mb_id,$point,$memo,$bobo_table="",$bobo_id=""){

	$mb = sql_fetch("select mb_id from nfor_member where mb_id = '$mb_id'");

	if(!$mb[mb_id] or $point == 0 or $mb_id == "") { return 0; }

	sql_query("insert nfor_point set mb_id='$mb_id', point='$point', memo='$memo', wr_datetime=NOW(), bobo_table='$bobo_table', bobo_id='$bobo_id'");
	$sum = sql_fetch("select sum(point) as sum_point from nfor_point where mb_id='$mb_id'");
	sql_query("update nfor_member set mb_point='$sum[sum_point]' where mb_id='$mb_id'");

	return 1;
}


function mb_id_chg($mb_id){
	$strlen = strlen($mb_id);
	$str = substr($mb_id,0,3);
	for($i=0; $i<$strlen-3; $i++){
		$str .= "*";
	}
	return $str;
}































function print_mb_info($data,$ing=array()){
	global $item, $member, $nfor;

	$mb = sql_fetch("select is_supply,mb_id,mb_email from nfor_member where mb_no='$data[mb_no]'");
	if($item[supply_no]==$data[mb_no]){	// 공급업체
		$ico = "$nfor[path]/img/qna02.png";
	} elseif($item[md_no]==$data[mb_no]){	// MD
		$ico = "$nfor[path]/img/qna03.png";
	} elseif($mb[is_supply] >= "7"){	// 관리자
		$ico = "$nfor[path]/img/qna04.png";
	} else{	// 일반회원
		$ico = "$nfor[path]/img/qna01.png";
	}

	if($data[fake_id]){
		$str = $data[fake_id];
	} else{
		$str = $mb[$nfor[id_type]];
	}

	if($member[mb_no] and ($member[is_supply] >= "7" or $item[supply_no]==$member[mb_no] or $item[md_no]==$member[mb_no] or $data[mb_no]==$member[mb_no] or $ing[mb_no]==$member[mb_no])){ // 관리자이거나 입점업체 또는 MD라면 또는 본인글이라면
		$return = $str;
	} else{ // 일반회원일때
		if($nfor[id_secret]){ // 아이디 비공개이면
			if($nfor[id_type]=="mb_id"){
				$strlen = strlen($str);
				$str = substr($str,0,-3);
				for($i=0; $i<=$strlen-3; $i++){
					$str .= "*";
				}
			} else{
				$exp = explode("@",$str);
				$strlen = strlen($exp[0]);
				$str = substr($exp[0],0,-3);
				for($i=0; $i<=$strlen-3; $i++){
					$str .= "*";
				}
				$str = $str."@".substr($exp[1],0,2);
			}
			$return = $str;
		} else{ // 공개이면
			$return = $str;
		}
	}

	// 최고관리자일경우 아이디 미표시
	//if($mb[is_supply]=="10"){
	//	$return = "";
	//}

	return $return;
}

function item_star_memo($str){
	global $item, $is_admin, $member;
	if($item[it_star_secret]){
		if($member[mb_no]){
			$return = strip_tags($str[wr_memo]);
		} else{
				$return = cut_str(strip_tags($str[wr_memo]),50);
				$return .= "<br>***********************************************************************<br>******************************************************************";
		}
	} else{
		$return = strip_tags($str[wr_memo]);
	}
	return $return;
}


function item_qna_memo($str,$ing=array()){
	global $item, $is_admin, $member;

	if($item[it_qna_secret]){

		if($is_admin){
			$return = nl2br($str[wr_memo]);
		} elseif(($member[mb_no] and $ing[mb_no]==$member[mb_no])){
			$return = nl2br($str[wr_memo]);
		} elseif(($member[mb_no] and $str[mb_no]==$member[mb_no])){
			$return = nl2br($str[wr_memo]);
		} else{
			$return = "비밀글입니다.<i class='fa fa-lock' aria-hidden='true'></i>";
		}
	} else{
		$return = $str[wr_memo];
	}
	return $return;
}

function order_view_link($row){
	global $PHP_SELF, $qstr;
	return str_replace("list","form",basename($PHP_SELF))."?od_id=$row[od_id]&".$qstr;
}

function item_link($it_id){
	global $nfor;
	return "$nfor[path]/item.php?it_id=$it_id";
}



function nfor_echo($type,$val){
	global $is_admin;
	if($is_admin){
		$str = $val;
	} else{
		if($type=="od_hp" or $type=="mb_hp"){
			$exp = explode("-",$val);
			$str = $exp[0]."-****-".$exp[2];
		} elseif($type=="od_email" or $type=="mb_email"){
			$exp = explode("@",$val);
			$strlen = strlen($exp[0]);
			$str = substr($exp[0],0,-3);
			for($i=0; $i<=$strlen-3; $i++){
				$str .= "*";
			}
			$str = $str."@".substr($exp[1],0,2);
		} else{

		}
	}
	return $str;
}


function order_us($row){
	global $member;

	$str = $row[od_name];
	$str .= "<br>";
	if($member[is_supply]=="1"){
		$exp = explode("-",$row[od_hp]);
		$str .= $exp[0]."-****-".$exp[2];
	} else{
		$str .= $row[od_hp];
	}
	$str .= "<br>";
	$str .= $row[od_email];
	return $str;
}

function order_mb($row){
	global $member;
	$str = "<a href=\"javascript:member('$row[mb_no]')\">";
	if($row[mb_name]){
		$str .= "$row[mb_name]<br>";
	}
	if($row[mb_hp]){
		if($member[is_supply]=="1"){
			$exp = explode("-",$row[mb_hp]);
			$str .= $exp[0]."-****-".$exp[2];
		} else{
			$str .= $row[mb_hp];
		}
		$str .= "<br>";
	}
	if($row[mb_id]){
		$str .= "$row[mb_id]<br>";
	}
	if($row[mb_black]){
		$str .= "<span style='background-color:red; color:#fff; padding:2px;'>warning</span>";
	} else{
		$mb = sql_fetch("select mb_black from nfor_member where mb_no='$row[mb_no]'");
		if($mb[mb_black]){
			$str .= "<span style='background-color:red; color:#fff; padding:2px;'>warning</span>";
		}
	}
	$str .= "</a>";
	return $str;
}


function mb_info($mb_no){
	$row = sql_fetch("select * from nfor_member where mb_no='$mb_no'");
	$str = order_mb($row);
	if(!$str) $str .= "탈퇴회원";
	return $str;
}




function item_access($it_id){
	global $member;
	if($it_id){
		$item = sql_fetch("select * from nfor_item where it_id='$it_id'");
		if($member[is_supply]=="1" and $item[supply_no]<>$member[mb_no]) alert("권한이 없습니다");
		if($member[is_supply]=="2" and $item[md_no]<>$member[mb_no]) alert("권한이 없습니다");
	}
}

function google_url($url){
	global $api;
    $postData = array('longUrl' => $url);
    $jsonData = json_encode($postData);
    $curlObj = curl_init();
    curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url?key='.$api[google_shortener]);
    curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curlObj, CURLOPT_HEADER, 0);
    curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
    curl_setopt($curlObj, CURLOPT_POST, 1);
    curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);
    $response = curl_exec($curlObj);
    $json = json_decode($response);
    curl_close($curlObj);
	$return_url = $json->id;
	if(!$return_url){
		$return_url = $url;
	}
    return $return_url;
}

function curl_request($url, $params, $isPostMethod=false, $headers=""){
	$opts = array(
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_HEADER => false,
		CURLOPT_HTTPHEADER => $headers,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSLVERSION => 1 // TLS
	);
	if($isPostMethod){
		$opts[CURLOPT_URL] = $url;
		$opts[CURLOPT_POST] = true;
		if(!empty($params)){
			$opts[CURLOPT_POSTFIELDS] = http_build_query($params);
		}
	} else{
		$url .= '?';
		if(!empty($params)) {
			$url .= http_build_query($params);
		}
		$opts[CURLOPT_URL] = $url;
	}
	$curlSession = curl_init();
	curl_setopt_array($curlSession, $opts);

	$result = curl_exec($curlSession);

	if($result === false){
		$error = curl_error($curlSession);
		curl_close($curlSession);
		return $error;
	}
	curl_close($curlSession);
	return $result;
}

function keyword_insert($it_keyword){
	$exp_keyword = explode(",", trim($it_keyword));
	for($i=0; $i<count($exp_keyword); $i++){
		$wr_keyword = trim($exp_keyword[$i]);
		if($wr_keyword){
			$chk_keyword = sql_fetch("select * from nfor_item_keyword where wr_keyword='$wr_keyword'");
			if(!$chk_keyword[wr_keyword]){
				sql_query("insert nfor_item_keyword set wr_keyword='$wr_keyword'");
			}
		}
	}
}

function item_delete($it_id){

	global $member;

	item_access($it_id);

	it_img_del("list_m","it_img_l_m",$item);
	it_img_del("main","it_img_m1",$item);
	it_img_del("main","it_img_m2",$item);
	it_img_del("main","it_img_m3",$item);
	it_img_del("main","it_img_m4",$item);
	it_img_del("main","it_img_m5",$item);
	it_img_del("list","it_img_l",$item);
	it_img_del("premium","it_img_p",$item);
	sql_query("delete from nfor_item where it_id='$it_id'");
	sql_query("delete from nfor_item_option where it_id='$it_id'");
}

function it_img_del($folder,$filename,$item){
	global $nfor;
	@unlink($nfor[path]."/data/".$folder."/".$item[$filename]);
}

function it_img_delete($folder,$filename){
	global $nfor, $item, $_POST;
	if($_POST[$filename."_del"]){
		sql_query("update nfor_item set ".$filename."='' where it_id='$item[it_id]'");
		@unlink($nfor[path]."/data/".$folder."/".$item[$filename]);
	}
}

function it_img_upload($folder,$filename){
	global $nfor, $_FILES;
	if($filename_add = file_upload($nfor[path]."/data/".$folder."/", $_FILES[$filename])){
		return " , $filename='$filename_add' ";
	}
}


function it_img_copy($folder,$filename){
	global $nfor, $item, $_FILES;
	$it_img_upload = it_img_upload($folder,$filename);
	if($it_img_upload){
		return $it_img_upload;
	} else{
		if($item[$filename]){
			copy($nfor[path]."/data/".$folder."/".$item[$filename],$nfor[path]."/data/".$folder."/".time().$item[$filename]);
			$item[$filename] = time().$item[$filename];
			return " , $filename='".$item[$filename]."' ";
		}
	}
}

function banking_cancel_expire(){ // 무통장입금 자동취소
	global $nfor;
	$que = sql_query("select * from nfor_order where pay_step='4' and bank_date < '$nfor[ymd]'");
	while($order = sql_fetch_array($que)){
		banking_cancel($order[od_id]);
	}
}

function banking_cancel($od_id){ // 무통장입금 취소
	$order = sql_fetch("select * from nfor_order where od_id='$od_id'");
	sql_query("update nfor_order set pay_step='5', od_cancelrequest=NOW(), od_canceldatetime=NOW() where od_id='$order[od_id]'");	// 주문상태를 입금대기취소(5) 으로 변경
	sql_query("update nfor_cart set pay_step='5', od_cancelrequest=NOW(), od_canceldatetime=NOW(), cancel_why='관리자임의취소', cancel_why_msg='무통장미입금주문' where cart_id='$order[cart_id]'");
	sql_query("update nfor_coupon_use set cp_state='2' where od_id='$order[od_id]'");
	if($order[money_price]) insert_money($order[mb_no],$order[money_price],"상품구매취소 - $order[od_id]","7");
}

function banking_asign($od_id){ // 무통장 입금 확인처리
	$order = sql_fetch("select * from nfor_order where od_id='$od_id'");
	sql_query("update nfor_order set pay_step='1',od_paydatetime=NOW() where od_id='$order[od_id]'");
	sql_query("update nfor_cart set ct_od_paydate=NOW(), pay_step='1' where cart_id='$order[cart_id]'");
	nfor_send("banking",$order[mb_email],$order[mb_hp],$order[mb_no],$order[od_id]);
	$que = sql_query("select * from nfor_cart where cart_id='$order[cart_id]' and it_delivery='0'");
	while($ct = sql_fetch_array($que)){
		nfor_send("ticket",$order[mb_email],$order[mb_hp],$order[mb_no],$order[od_id], $ct[ct_id]);
	}
}


function coupon_again($od_id, $cp_it_id=""){

	if($it_id){
		$add_sql = " and cp_it_id='$cp_it_id'";
	}

	sql_query("update nfor_coupon_use set cp_state='2' where od_id='$od_id' $add_sql");
	$que = sql_query("select * from nfor_coupon_use where od_id='$od_id' and cp_state='2' $add_sql");
	while($data = sql_fetch_array($que)){
		sql_query("update nfor_coupon set cp_use=cp_use-1 where cp_id='$data[cp_id]'");
	}

}

function coupon_use($od_id){
	sql_query("update nfor_coupon_use set cp_state='1' where od_id='$od_id'");
	$que = sql_query("select * from nfor_coupon_use where od_id='$od_id' and cp_state='1'");
	while($data = sql_fetch_array($que)){
		sql_query("update nfor_coupon set cp_use=cp_use+1 where cp_id='$data[cp_id]'");
	}
}

function category_sql($category_id){
	$sql_search = " and (";
	for($i=1; $i<=10; $i++){
		if($i>1) $sql_search .= " or ";
		$sql_search .= "category_id{$i} like '$category_id%'";
	}
	$sql_search .= ")";
	return $sql_search;
}




function category_sql_or($category_id1,$category_id2,$category_id3){
	$sql_search = " and (";
	for($i=1; $i<=10; $i++){
		if($i>1) $sql_search .= " or ";
		$sql_search .= "(category_id{$i} like '$category_id1%' or category_id{$i} like '$category_id2%' or category_id{$i} like '$category_id3%')";
	}
	$sql_search .= ")";
	return $sql_search;
}



function bank_code($str){	// 이니시스 무통장 은행코드

	if($str=="03"){
		$bank = "기업은행";
	} elseif($str=="04"){
		$bank = "국민은행";
	} elseif($str=="05"){
		$bank = "외환은행";
	} elseif($str=="07"){
		$bank = "수협중앙회";
	} elseif($str=="11"){
		$bank = "농협중앙회";
	} elseif($str=="20"){
		$bank = "우리은행";
	} elseif($str=="23"){
		$bank = "SC제일은행";
	} elseif($str=="31"){
		$bank = "대구은행";
	} elseif($str=="32"){
		$bank = "부산은행";
	} elseif($str=="34"){
		$bank = "광주은행";
	} elseif($str=="37"){
		$bank = "전북은행";
	} elseif($str=="39"){
		$bank = "경남은행";
	} elseif($str=="53"){
		$bank = "한국씨티은행";
	} elseif($str=="71"){
		$bank = "우체국";
	} elseif($str=="81"){
		$bank = "하나은행";
	} elseif($str=="88"){
		$bank = "통합신한은행 (신한,조흥은행)";
	} elseif($str=="D1"){
		$bank = "동양종합금융증권";
	} elseif($str=="D2"){
		$bank = "현대증권";
	} elseif($str=="D3"){
		$bank = "미래에셋증권";
	} elseif($str=="D4"){
		$bank = "한국투자증권";
	} elseif($str=="D5"){
		$bank = "우리투자증권";
	} elseif($str=="D6"){
		$bank = "하이투자증권";
	} elseif($str=="D7"){
		$bank = "HMC투자증권";
	} elseif($str=="D8"){
		$bank = "SK증권";
	} elseif($str=="D9"){
		$bank = "대신증권";
	} elseif($str=="DA"){
		$bank = "하나대투증권";
	} elseif($str=="DB"){
		$bank = "굿모닝신한증권";
	} elseif($str=="DC"){
		$bank = "동부증권";
	} elseif($str=="DD"){
		$bank = "유진투자증권";
	} elseif($str=="DE"){
		$bank = "메리츠증권";
	} elseif($str=="DF"){
		$bank = "신영증권";
	} else{

	}
	return $bank;
}



function money_type($money_type){

	if($money_type=="1"){ //
		$str = "회원가입";
	} elseif($money_type=="2"){ //
		$str = "상품구매";
	} elseif($money_type=="7"){  //
		$str = "적립금 상품구매 취소";
	} elseif($money_type=="8"){
		$str = "적립금 상품구매 부분취소";
	} elseif($money_type=="9"){ //
		$str = "추천인입력";
	} elseif($money_type=="10"){ //
		$str = "추천받음";
	} elseif($money_type=="11"){
		$str = "회원탈퇴";
	} else{
		$str = "임의입력";
	}


	return $str;
}


function expire_mb_money($mb_no){ // 1개월내 만료 예정 포인트
	global $nfor;
	$end_datetime = date("Y-m-d H:i:s",strtotime("+1 month"));
	$sum = sql_fetch("select sum(use_money) as s_money from nfor_money where mb_no='$mb_no' and end_datetime >= '$nfor[ymdhis]' and end_datetime < '$end_datetime'");
	return $sum[s_money];
}

function mb_money($mb_no){	// 적립금
	global $nfor;
	$sum = sql_fetch("select sum(use_money) as s_money from nfor_money where mb_no='$mb_no' and end_datetime >= '$nfor[ymdhis]'");
	return $sum[s_money];
}

function insert_money($mb_no,$money,$memo,$money_type="",$od_id="",$ct_id="",$end_datetime=""){
	global $nfor;
	$mb = sql_fetch("select mb_no from nfor_member where mb_no = '$mb_no'");
	if(!$mb[mb_no] or $money == 0 or $mb_no == ""){ return 0; }

	if($money<0){
		$end_datetime = $nfor[ymdhis];
	} else{
		if(!$end_datetime){
			$end_datetime = $nfor[money_ymdhis];
		}
	}
	if($money>0){
		$use_money = $money;
	}
	if(!$end_datetime){
		$end_datetime = "2050-12-25 23:59:59";
	}
	sql_query("insert nfor_money set mb_no='$mb_no', money='$money', use_money='$use_money', memo='$memo', money_type='$money_type', od_id='$od_id', ct_id='$ct_id', wr_datetime='$nfor[ymdhis]', end_datetime='$end_datetime'");
	if($money < 0){
		$money = $money*-1;
		$que = sql_query("select * from nfor_money where mb_no='$mb_no' and end_datetime >= '$nfor[ymdhis]' and use_money > 0 order by end_datetime asc");
		while($data = sql_fetch_array($que)){
			if($data[use_money] >= $money){  // 레코드적립금이 까야할 적립금 보다 크거나 같으면
				$use_money_update = $data[use_money] - $money; // 레코드적립금 빼기 차감할적립금
			} else{
				$use_money_update = "0"; // 전체차감
			}
			sql_query("update nfor_money set use_money='$use_money_update' where wr_id='$data[wr_id]'");
			if($data[use_money] >= $money){
				break;
			}
			$money = $money - $data[use_money];
		}
	}
	return 1;
}

function str_number($str){
	$str = preg_replace("/[^0-9]*/s", "", $str);
	return $str;
}

function delivery_link($wr_name,$delivery_number){
	$wr_url = sql_fetch("select wr_url from nfor_delivery where wr_name='$wr_name'");
	$str = $wr_url[wr_url].$delivery_number;
	return $str;
}

function category_id_name($category_id){
	$str = "";
	for($k=1; $k <= strlen($category_id)/3; $k++){
		if($k>1) $str .= " > ";
		$category_id_str = substr($category_id,0,(3*$k));
		$catename = sql_fetch("select wr_category from nfor_item_category where category_id='$category_id_str'");
		$str .= $catename[wr_category];
	}
	return $str;
}

// 쿠폰 번호 생성
function coupon_number(){

	$ar = array(A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,1,2,3,4,5,6,7,8,9);
	$ap_len = count($ar);

	$cp1 = rand(0,$ap_len);
	$cp2 = rand(0,$ap_len);
	$cp3 = rand(0,$ap_len);
	$cp4 = rand(0,$ap_len);
	$cp5 = rand(0,$ap_len);
	$cp6 = rand(0,$ap_len);
	$cp7 = rand(0,$ap_len);
	$cp8 = rand(0,$ap_len);
	$cp9 = rand(0,$ap_len);
	$cp10 = rand(0,$ap_len);
	$cp11 = rand(0,$ap_len);
	$cp12 = rand(0,$ap_len);
	$cp13 = rand(0,$ap_len);
	$cp14 = rand(0,$ap_len);
	$cp15 = rand(0,$ap_len);
	$cp16 = rand(0,$ap_len);

	$coupon_1 = $ar[$cp1].$ar[$cp2].$ar[$cp3].$ar[$cp4];
	$coupon_2 = $ar[$cp5].$ar[$cp6].$ar[$cp7].$ar[$cp8];
	$coupon_3 = $ar[$cp9].$ar[$cp10].$ar[$cp11].$ar[$cp12];
	$coupon_4 = $ar[$cp13].$ar[$cp14].$ar[$cp15].$ar[$cp16];

	$cp_number = $coupon_1 . "-" . $coupon_2 . "-" . $coupon_3 . "-" . $coupon_4;

	$cp_number = sql_fetch(" select cp_number from nfor_coupon where cp_number = '$cp_number' ");

	// 쿠폰번호가 이미 존재한다면 쿠폰 번호를 다시 구함
	if ($cp_number[cp_number])
		return coupon_number();

	return $cp_number;
}


function json_return($msg="",$result=""){
	global $return;
	$return[msg] = $msg;
	$return[result] = $result;
	$json = json_encode($return);
	echo $json;
	exit;
}

function yoil($date){
	$daily = array("일","월","화","수","목","금","토");
	$yoil = date("w",strtotime($date));
	return $daily[$yoil];
}

function option_stock($all,$sale){
	$stock = $all - $sale;
	if($stock<0){
		$stock = 0;
	}
	return $stock;
}

function cart_it_name($cart_id){
	$cart = sql_fetch("select count(*) as cnt, z.it_id from (select it_id from nfor_cart where cart_id='$cart_id' and option_check='1' group by it_id) as z");
	$item = sql_fetch("select it_name from nfor_item where it_id='$cart[it_id]'");
	$str = $item[it_name];
	if($cart[cnt]>1){
		$str .= "외 ".($cart[cnt]-1)."건";
	}
	return $str;
}



/* member_form.php */

function birth_check($mb_birth){
	$exp = explode("-",$mb_birth);
	if(!$exp[0] or !$exp[1] or !$exp[2]){
		$return[msg] = "생년월일을 선택해주세요";
		$return[result] = "blank";
	} else{
		$return[msg] = "";
		$return[result] = "ok";
	}
	$json = json_encode($return);
	return $json;
}

function password_now_check($mb_password){
	global $member;
	if(sql_password($mb_password) != $member[mb_password]){
		$return[msg] = "로그인 패스워드와 입력하신 패스워드가 일치하지 않습니다";
		$return[result] = "now_different";
	} else{
		$return[msg] = "";
		$return[result] = "ok";
	}
	$json = json_encode($return);
	return $json;
}


function password_check($mb_password){
	if($mb_password==""){
		$return[msg] = "패스워드를 입력해주세요";
		$return[result] = "blank";
	} else{
		$return[msg] = "";
		$return[result] = "ok";
	}
	$json = json_encode($return);
	return $json;
}


function password_confirm_check($mb_password,$mb_password_confirm){
	if($mb_password != $mb_password_confirm){
		$return[msg] = "입력하신 패스워드가 일치하지 않습니다";
		$return[result] = "different";
	} else{
		$return[msg] = "";
		$return[result] = "ok";
	}
	$json = json_encode($return);
	return $json;
}


function name_check($mb_name){
	if($mb_name==''){
		$return[msg] = "이름을 입력해주세요";
		$return[result] = "blank";
	} else{
		$return[msg] = "";
		$return[result] = "ok";
	}
	$json = json_encode($return);
	return $json;
}

function sex_check($mb_sex){
	if($mb_sex==''){
		$return[msg] = "성별을 선택하세요";
		$return[result] = "blank";
	} else{
		$return[msg] = "";
		$return[result] = "ok";
	}
	$json = json_encode($return);
	return $json;
}

function id_check($mb_id, $mb_no=""){
	$mb_id = trim($mb_id);
	if($mb_id==''){
		$return[msg] = "아이디를 입력하십시오.";
		$return[result] = "blank";
	} else if (preg_match("/[^0-9a-z_]+/i", $mb_id)){
		$return[msg] = "아이디가 형식에 맞지 않습니다.";
		$return[result] = "match";
	} else if (strlen($mb_id) < 3){
		$return[msg] = "아이디는 최소 3자리 이상 입력하십시오.";
		$return[result] = "length";
	} else{
		$row = sql_fetch("select count(*) as cnt from nfor_member where  mb_no<>'$mb_no' and mb_id = '$mb_id'");
		if($row[cnt]){
			$return[msg] = "이미 존재하는 아이디입니다.";
			$return[result] = "is";
		} else {
			$return[msg] = "사용하셔도 좋은 아이디입니다.";
			$return[result] = "ok";
		}
	}
	$json = json_encode($return);
	return $json;
}

function hp_check($mb_hp, $mb_no=""){
	global $nfor;

	$mb_hp = trim($mb_hp);
	if(preg_match("/[^0-9]+/i", $mb_hp)){
		$return[msg] = "숫자만입력해주세요";
		$return[result] = "number";
	} elseif(strlen($mb_hp) < 10){
		$return[msg] = "휴대폰번호를 올바르게 입력해주세요";
		$return[result] = "length";
	} else{
		$mb_hp = add_hyphen($mb_hp);
		$data = sql_fetch("select mb_id, mb_email, mb_hp from nfor_member where mb_no <> '$mb_no' and mb_hp = '$mb_hp'");
		if($data[mb_hp]){
			$return[msg] = $data[$nfor[id_type]]." 으로 가입된 휴대폰 번호입니다. 이번호를 사용하시려면 휴대폰 인증을 해주세요.";
			$return[result] = "asign";
		} else{
			$return[msg] = ""; // 사용가능한 휴대폰번호입니다
			$return[result] = "ok";
		}
	}
	$json = json_encode($return);
	return $json;
}

function email_check($mb_email, $mb_no=""){
	$mb_email = trim($mb_email);
	if ($mb_email==''){
		$return[msg] = "E-mail 주소를 입력하십시오.";
		$return[result] = "blank";
	} elseif(!preg_match("/([0-9a-zA-Z_-]+)@([0-9a-zA-Z_-]+)\.([0-9a-zA-Z_-]+)/", $mb_email)) {
		$return[msg] = "E-mail 주소가 형식에 맞지 않습니다.";
		$return[result] = "match";
	} else{
		$row = sql_fetch("select count(*) as cnt from nfor_member where mb_no <> '$mb_no' and mb_email = '$mb_email'");
		if($row[cnt]){
			$return[msg] = "이미 존재하는 E-mail 주소입니다.";
			$return[result] = "is";
		} else {
			$return[msg] = "사용하셔도 좋은 E-mail 주소입니다.";
			$return[result] = "ok";
		}
	}
	$json = json_encode($return);
	return $json;
}

function asign_confirm($mb_hp,$asign_number){
	$wr_asign = $asign_number;
	$chk_hp = sql_fetch("select wr_asign from nfor_hp_asign where wr_hp='$mb_hp' and wr_asign='$wr_asign' order by wr_id desc limit 1");
	if($chk_hp[wr_asign]){
		$return[msg] = "";
		$return[result] = "ok";
	} else{
		$return[msg] = "인증번호가 일치하지 않습니다";
		$return[result] = "different";
	}
	$json = json_encode($return);
	return $json;
}

function asign_send($mb_hp, $mb_email=""){
	global $nfor;
	$mb_hp = trim($mb_hp);
	$nfor[asign_number] = rand("11111","99999");
	sql_query("insert nfor_hp_asign set wr_hp='$mb_hp', wr_asign='$nfor[asign_number]', wr_datetime=NOW()");
	nfor_send("hp_asign", $mb_email, $mb_hp);
	$return[msg] = "인증번호를 전송하였습니다";
	$return[result] = "ok";
	$json = json_encode($return);
	return $json;
}

/* //member_form.php */


















function mobile_check(){
    global $HTTP_USER_AGENT;
    $MobileArray  = array("iphone","lgtelecom","skt","mobile","samsung","nokia","blackberry","android","android","sony","phone");

    $checkCount = 0;
        for($i=0; $i<sizeof($MobileArray); $i++){
            if(preg_match("/$MobileArray[$i]/", strtolower($HTTP_USER_AGENT))){ $checkCount++; break; }
        }
   return ($checkCount >= 1) ? "mobile" : "pc";
}



// 휴대폰 번호 사이에 '-' 하이픈 넣기
function add_hyphen($hp){
	$hp = preg_replace("/[^0-9]/", "", $hp);
	return preg_replace("/([0-9]{3})([0-9]{3,4})([0-9]{4})$/", "\\1-\\2-\\3", $hp);
}




























// 티켓발송
function ticket_send($od_id){

	$order = sql_fetch("select * from nfor_order where od_id='$od_id'");
	$que = sql_query("select * from nfor_cart where cart_id='$order[cart_id]' and it_delivery='0'");
	while($ct = sql_fetch_array($que)){
		nfor_send("ticket",$order[mb_email],$order[mb_hp],$order[mb_no],$order[od_id], $ct[ct_id]);
	}

}


function delivery_price_insert($cart_id,$dy_zip){


	$que = sql_query("select a.it_id, b.it_delivery_type from nfor_cart a, nfor_item b where a.it_id=b.it_id and a.cart_id='$cart_id' and a.option_check='1' group by a.it_id");
	while($data = sql_fetch_array($que)){

		// 상품금액
		$ea_item_price = sql_fetch("select sum(option_price*option_cnt) as ea_item_price from nfor_cart where cart_id='$cart_id' and it_id='$data[it_id]' and option_check='1'");

		// 상품배송금액
		$dyinfo = ea_delivery_price($cart_id, $data[it_id],$ea_item_price[ea_item_price],$dy_zip);

		$total_price = $dyinfo[price]+$ea_item_price[ea_item_price];


		$chk_dy = sql_fetch("select * from nfor_dy_price where cart_id='$cart_id' and it_id='$data[it_id]'");
		if($chk_dy[dy_id]){
			sql_query("update nfor_dy_price set total_price='$total_price', dy_price='$dyinfo[price]', dy_state='$dyinfo[state]', dy_type='$data[it_delivery_type]',it_price='$ea_item_price[ea_item_price]' where cart_id='$cart_id' and it_id='$data[it_id]'");
		} else{
			sql_query("insert nfor_dy_price set total_price='$total_price', cart_id='$cart_id', it_id='$data[it_id]', dy_price='$dyinfo[price]', dy_state='$dyinfo[state]', dy_type='$data[it_delivery_type]',it_price='$ea_item_price[ea_item_price]'");
		}
	}


}

function delivery_total_price($cart_id,$dy_zip=""){

	$delivery_total_price = 0;
	$que = sql_query("select a.it_id, b.it_delivery_type from nfor_cart a, nfor_item b where a.it_id=b.it_id and a.cart_id='$cart_id' and a.option_check='1' group by a.it_id");
	while($data = sql_fetch_array($que)){

		// 상품금액
		$ea_item_price = sql_fetch("select sum(option_price*option_cnt) as ea_item_price from nfor_cart where cart_id='$cart_id' and it_id='$data[it_id]' and option_check='1'");

		// 상품배송금액
		$dyinfo = ea_delivery_price($cart_id, $data[it_id],$ea_item_price[ea_item_price],$dy_zip);
		$delivery_total_price += $dyinfo[price];

	}
	return $delivery_total_price;

}

//별점 주기
function star_view($vals){

	for ($i=0; $i < 5; $i++) {
		if ($i<$vals) {
			$stars .= "<i class='fa fa-star' aria-hidden='true'></i>";
		}else {
			$stars .= "<i class='fa fa-star-o' aria-hidden='true'></i>";
		}
	}
	return $stars;
}

function item($it_id){
	global $nfor;
	$item = sql_fetch("select * from nfor_item where it_id='$it_id'");

	// 판매량
	// $item[it_sales_volume] = it_change_volume($item[it_id])+it_sales_volume($item[it_id]);

	// 남은수량정의
	$item[it_stock_now] = $item[it_stock]-$item[it_sales_volume];

	// 개인구매제한남은수량이 남은수량(재고-판매량) 보다 크면, 개인구매제한남은수량은 남은수량
	if($item[it_buy_qty] > $item[it_stock_now]){
		$item[it_buy_qty] = $item[it_stock_now];
	}

	// 재고보다 구매한 수량이 크면 개별구매수량 초기화
	if($item[it_sales_volume] >= $item[it_stock]){
		$item[it_buy_qty] = 0;
	}

	// 판매량 그래프
	$item[grap_per] = @ceil((($item[it_sales_volume]*100)/$item[it_discount_want]));

	$item[href] = "item.php?it_id=".$item[it_id];

	$item[it_img1] = "$nfor[path]/data/list_m/$item[it_img_l_m]";
	$item[it_img2] = "$nfor[path]/data/list/$item[it_img_l]";

	return $item;
}


function option($option_id){
	$option = sql_fetch("select * from nfor_item_option where option_id='$option_id'");
	return $option;

}




function cart_cnt($cart_id){
	$cnt = mysqli_num_rows(sql_query("select * from nfor_cart a, nfor_item b where a.it_id=b.it_id and a.cart_id='$cart_id' group by a.it_id"));
	return $cnt;
}




function star_print($num){

	for($i=1; $i<=$num; $i++){
		echo "<img src='img/staron.png'>";
	}

	$namuji = 5-$num;

	for($i=0; $i<$namuji; $i++){
		echo "<img src='img/staroff.png'>";
	}


}

function ea_delivery_price($cart_id, $it_id,$item_price=0,$zipcode=""){ // 상품코드, 상품합산가격

	global $nfor;

	$data = sql_fetch("select it_delivery, it_delivery_price, supply_no, it_delivery_type, it_delivery_total from nfor_item where it_id='$it_id'");

	if($nfor[dy_group]=="1" and $data[supply_no]){ // 묶음배송이고 공급업체설정이 되어 있으면

		// 무료배송있는지 체크
		$chk1 = sql_fetch("select a.it_id from nfor_cart a, nfor_item b where a.it_id=b.it_id and a.cart_id='$cart_id' and b.supply_no='$data[supply_no]' and b.it_delivery_type='1' and a.option_check='1'");

		// 조건부배송중에 무료배송 있는지 체크
		$chk3[it_id] = "";
		$que = sql_query("select a.it_id, b.it_delivery_total from nfor_cart a, nfor_item b where a.it_id=b.it_id and a.cart_id='$cart_id' and b.supply_no='$data[supply_no]' and b.it_delivery_type='3' and a.option_check='1' group by a.it_id");
		while($ct = sql_fetch_array($que)){

			$ea_item_price = sql_fetch("select sum(option_price*option_cnt) as ea_item_price from nfor_cart where cart_id='$cart_id' and it_id='$ct[it_id]' and option_check='1'");

			if($ct[it_delivery_total] <= $ea_item_price[ea_item_price]){
				$chk3[it_id] = $ct[it_id];	// 무료배송인 상품이 있다면 변수에 저장
			}

		}



		// ★★ 추가됨
		// 조건부배송중에 무료배송이 없을경우 장바구니에 담긴 상품들중 해당업체의 최소 조건부 배송 금액과 합산금액보다 큰게 있는지 체크
		if(!$chk3[it_id]){
			$chk3_1_chk = sql_fetch("select a.it_id, b.it_delivery_total from nfor_cart a, nfor_item b where a.it_id=b.it_id and a.cart_id='$cart_id' and b.supply_no='$data[supply_no]' and b.it_delivery_type='3' and a.option_check='1' group by a.it_id order by b.it_delivery_total asc");

			$total_item_price = sql_fetch("select sum(a.option_price*a.option_cnt) as total_item_price from nfor_cart a, nfor_item b where a.it_id=b.it_id and a.cart_id='$cart_id' and b.supply_no='$data[supply_no]' and a.option_check='1'");
			if($total_item_price[total_item_price] >= $chk3_1_chk[it_delivery_total]){
				$chk3[it_id] = $chk3_1_chk[it_id];
			}

		}
		// ★★ 추가됨





		// 조건부배송중에 무료배송이 없을경우 유료배송 있는지 체크
		if(!$chk3[it_id]){
			$chk3_1_chk = sql_fetch("select a.it_id from nfor_cart a, nfor_item b where a.it_id=b.it_id and a.cart_id='$cart_id' and b.supply_no='$data[supply_no]' and b.it_delivery_type='3' and a.option_check='1' group by a.it_id order by b.it_delivery_price asc");
			if($chk3_1_chk[it_id]){
				$chk3_1[it_id] = $chk3_1_chk[it_id];
			}
		}



		// 유료배송이 있는지 체크
		$chk4 = sql_fetch("select a.it_id from nfor_cart a, nfor_item b where a.it_id=b.it_id and a.cart_id='$cart_id' and b.supply_no='$data[supply_no]' and b.it_delivery_type='4' and a.option_check='1'");

		// 착불배송이 있는지 체크
		$chk2 = sql_fetch("select a.it_id from nfor_cart a, nfor_item b where a.it_id=b.it_id and a.cart_id='$cart_id' and b.supply_no='$data[supply_no]' and b.it_delivery_type='2' and a.option_check='1'");

		if($chk1[it_id]){	// 무료배송인 상품이 있다면 그상품 빼고 나머지는 다 묶음배송

			if($chk1[it_id]==$it_id){
				$dyinfo[price] = 0;
				$dyinfo[state] = "무료배송";
			} else{
				$dyinfo[price] = 0;
				$dyinfo[state] = "묶음배송";
			}

		} elseif($chk3[it_id]){ // 조건부배송에 따른 무료배송상품이 있다면 그상품 빼고 나머지는 다 묶음배송

			if($chk3[it_id]==$it_id){
				$dyinfo[price] = 0;
				$dyinfo[state] = "무료배송";
			} else{
				$dyinfo[price] = 0;
				$dyinfo[state] = "묶음배송";
			}

		} elseif($chk3_1[it_id]){ // 조건부배송에 따른 무료배송상품이 없고 조건부 배송상품만 존재한다면 그상품 빼고 나머지는 다 묶음배송

			if($chk3_1[it_id]==$it_id){
				$dyinfo[price] = $data[it_delivery_price];
				$dyinfo[state] = number_format($dyinfo[price])."원";
			} else{
				$dyinfo[price] = 0;
				$dyinfo[state] = "묶음배송";
			}

		} elseif($chk4[it_id]){ // 유료배송상품이 있다면 그상품 빼고 나머지는 다 묶음배송

			if($chk4[it_id]==$it_id){
				$dyinfo[price] = $data[it_delivery_price];
				$dyinfo[state] = number_format($dyinfo[price])."원";
			} else{
				$dyinfo[price] = 0;
				$dyinfo[state] = "묶음배송";
			}

		} elseif($chk2[it_id]){ // 착불배송상품이 있다면 그상품 빼고 나머지는 다 묶음배송

			if($chk2[it_id]==$it_id){
				$dyinfo[price] = 0;
				$dyinfo[state] = "착불배송";
			} else{
				$dyinfo[price] = 0;
				$dyinfo[state] = "묶음배송";
			}

		} else{


		}

	} else{	// 개별배송이면

		$dyinfo[price] = 0;
		$item_check = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$cart_id' and it_id='$it_id' and option_check='1'");
		if(!$item_check[cnt]){
			$dyinfo[price] = "0";
			$dyinfo[state] = "-";
		} elseif($data[it_delivery_type]=="1"){
			$dyinfo[price] = 0;
			$dyinfo[state] = "무료배송";
		} elseif($data[it_delivery_type]=="2"){
			$dyinfo[price] = 0;
			$dyinfo[state] = "착불배송";
		} elseif($data[it_delivery_type]=="3"){
			if($data[it_delivery_total] > $item_price){
				$dyinfo[price] = $data[it_delivery_price];
				$dyinfo[state] = number_format($dyinfo[price])."원";
			} else{
				$dyinfo[price] = 0;
				$dyinfo[state] = "무료배송";
			}

		} elseif($data[it_delivery_type]=="4"){
			$dyinfo[price] = $data[it_delivery_price];
			$dyinfo[state] = number_format($dyinfo[price])."원";
		} else{
			$dyinfo[state] = "-";
		}


	}





	/* 도서산간 체크*/
	if($zipcode){
		$zipcode = preg_replace("/[^0-9]*/s", "", $zipcode);
		$chk_zipcode = sql_fetch("select * from nfor_dy_zipcode where zip_zipcode='$zipcode'");
		if($chk_zipcode[zip_price]){	// 도서산간

			if($dyinfo[state]=="무료배송"){
				$dyinfo[price] = $chk_zipcode[zip_price];
				$dyinfo[state] = "도서산간배송";
			} elseif($data[state]=="착불배송"){

			} elseif($dyinfo[state]=="묶음배송"){

			} else{	// 유료배송
				$dyinfo[price] = $dyinfo[price]+$chk_zipcode[zip_price];
				$dyinfo[state] = "도서산간배송";
			}

		}
	}
	/* 도서산간 체크*/


	if(!$data[it_delivery]){	// 티켓상품이면
		$dyinfo[price] = "0";
		$dyinfo[state] = "없음";
	}



	return $dyinfo;
}



function category_print($category_id, $top_cate=""){
	$top_str = strlen($top_cate)/3;
	$abs = $top_str+1;
	$substr = substr($category_id,0,(3*$abs));
	$cate = sql_fetch("select * from nfor_item_category where category_id='$substr'");
	$str = $cate[wr_category];
	return $str;
}

function member($type, $value){
	$mb = sql_fetch("select * from nfor_member where $type='$value'");

	$birth = explode("-",$mb[mb_birth]);
	$mb[mb_birth_1] = $birth[0];
	$mb[mb_birth_2] = $birth[1];
	$mb[mb_birth_3] = $birth[2];


	return $mb;
}

function return_money($ct_id){	// 이번에 취소할적립금

	$ct = sql_fetch("select * from nfor_cart where ct_id='$ct_id'");
	$order = sql_fetch("select * from nfor_order where cart_id='$ct[cart_id]'");

	if($order[money_price] > $order[cancel_price]){	// 적립금으로 결제한금액이 취소된 금액보다 크면
		$max_money_price = $order[money_price] - $order[cancel_price];	// 남아있는 적립금
	} else{
		$max_money_price = 0;	// 남아있는 적립금
	}

	if($max_money_price > return_price($ct[ct_id])){	// 남아있는 적립금이 상품금액보다 크면
		$return_money_price = return_price($ct[ct_id]);
	} else{
		$return_money_price = $max_money_price;
	}

	/*
	echo "적립금 사용액 : ".$order[money_price];
	echo "<br>";
	echo "취소된적립금 : ".$order[cancel_price];
	echo "<br>";
	echo "남아있는 적립금 : ".$max_money_price;
	echo "<br>";
	echo "취소할상품금액 : ".return_price($ct[ct_id]);
	echo "<br>";
	echo "취소할적립금 : ".$return_money_price;
	*/
	return $return_money_price;

}




function return_money_coupon($ct_id){	// 이번에 취소할적립금

	$ct = sql_fetch("select * from nfor_cart where ct_id='$ct_id'");
	$order = sql_fetch("select * from nfor_order where cart_id='$ct[cart_id]'");
	$s_money = sql_fetch("select sum(money) as s_money from nfor_money where od_id='$order[od_id]' and money_type='8'"); // 부분취소된 적립금

	if($order[money_price] > $s_money[s_money]){
		$max_money_price = $order[money_price] - $s_money[s_money];	// 남아있는 적립금
	} else{
		$max_money_price = 0;	// 남아있는 적립금
	}

	if($max_money_price > return_price_coupon($ct[ct_id])){	// 남아있는 적립금이 상품금액보다 크면
		$return_money_price = return_price_coupon($ct[ct_id]);
	} else{
		$return_money_price = $max_money_price;
	}

	/*
	echo "적립금 사용액 : ".$order[money_price];
	echo "<br>";
	echo "취소된적립금 : ".$order[cancel_price];
	echo "<br>";
	echo "남아있는 적립금 : ".$max_money_price;
	echo "<br>";
	echo "취소할상품금액 : ".return_price($ct[ct_id]);
	echo "<br>";
	echo "취소할적립금 : ".$return_money_price;
	*/
	return $return_money_price;

}



function return_price_coupon($ct_id){	// 이번에 취소될 금액(쿠폰)

	$cancel_delivery_price = "0";
	$ct = sql_fetch("select * from nfor_cart where ct_id='$ct_id'");
	if($ct[it_delivery]){	// 배송상품이면서
		// 같은 주문서의 상품에서 본인꺼 빼고 완료 또는 신청에 1건이라도 있으면 배송비는 나중에 깜 (0원)
		$chk_delivery = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$ct[cart_id]' and it_id='$ct[it_id]' and ct_id<>'$ct[ct_id]' and (pay_step = '1' or pay_step = '2')");
		if(!$chk_delivery[cnt]){ // 본건이 마지막 취소이면
			$dy = sql_fetch("select * from nfor_dy_price where cart_id='$ct[cart_id]' and it_id='$ct[it_id]'");
			if($dy[dy_price]){
				$cancel_delivery_price = $dy[dy_price];
			}
		}

	}
	$return_price = ($ct[option_price]*$ct[option_cnt])+$cancel_delivery_price;


	// 쿠폰
	$order = sql_fetch("select * from nfor_order where cart_id='$ct[cart_id]'");
	$coupon_price = sql_fetch("select * from nfor_coupon_use where od_id='$order[od_id]' and cp_it_id='$ct[it_id]' and cp_state='1'");
	$return_price = $return_price - $coupon_price[cp_price];


	return $return_price;
}


function return_price($ct_id){	// 이번에 취소될 금액

	$cancel_delivery_price = "0";
	$ct = sql_fetch("select * from nfor_cart where ct_id='$ct_id'");
	if($ct[it_delivery]){	// 배송상품이면서
		// 같은 주문서의 상품에서 본인꺼 빼고 완료 또는 신청에 1건이라도 있으면 배송비는 나중에 깜 (0원)
		$chk_delivery = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$ct[cart_id]' and it_id='$ct[it_id]' and ct_id<>'$ct[ct_id]' and (pay_step = '1' or pay_step = '2')");
		if(!$chk_delivery[cnt]){ // 본건이 마지막 취소이면
			$dy = sql_fetch("select * from nfor_dy_price where cart_id='$ct[cart_id]' and it_id='$ct[it_id]'");
			if($dy[dy_price]){
				$cancel_delivery_price = $dy[dy_price];
			}
		}

	}
	$return_price = ($ct[option_price]*$ct[option_cnt])+$cancel_delivery_price;

	return $return_price;
}

function img_price($price,$path,$ext,$opt=0){	// 가격, 이미지경로, 확장자
	$print_img = "";
	if($opt){
		$price_txt = $price;
	} else{
		$price_txt = number_format($price);
	}
	for($i=0; $i<strlen($price_txt);  $i++){
		$substr = substr($price_txt,$i,1);
		if($substr==",") $substr = "dot";
		$print_img .= "<img src='{$path}{$substr}{$ext}'";

		if($ext==".png"){
			$print_img .= " class='png'";
		}
		$print_img .= ">";

	}
	echo $print_img;
}


function get_filesize($size)
{
    //$size = @filesize(addslashes($file));
    if ($size >= 1048576) {
        $size = number_format($size/1048576, 1) . "M";
    } else if ($size >= 1024) {
        $size = number_format($size/1024, 1) . "K";
    } else {
        $size = number_format($size, 0) . "byte";
    }
    return $size;
}

// 내용을 변환
function conv_content($content, $html)
{
    global $config, $board;

    if ($html)
    {
        $source = array();
        $target = array();

        $source[] = "//";
        $target[] = "";

        if ($html == 2) { // 자동 줄바꿈
            $source[] = "/\n/";
            $target[] = "<br/>";
        }

        // 테이블 태그의 갯수를 세어 테이블이 깨지지 않도록 한다.
        $table_begin_count = substr_count(strtolower($content), "<table");
        $table_end_count = substr_count(strtolower($content), "</table");
        for ($i=$table_end_count; $i<$table_begin_count; $i++)
        {
            $content .= "</table>";
        }

        $content = preg_replace($source, $target, $content);
        $content = bad_tag_convert($content);

        $content = preg_replace("/(on)([a-z]+)([^a-z]*)(\=)/i", "&#111;&#110;$2$3$4", $content);
        $content = preg_replace("/(dy)(nsrc)/i", "&#100;&#121;$2", $content);
        $content = preg_replace("/(lo)(wsrc)/i", "&#108;&#111;$2", $content);
        $content = preg_replace("/(sc)(ript)/i", "&#115;&#99;$2", $content);
        $content = preg_replace("/(ex)(pression)/i", "&#101&#120;$2", $content);

    }
    else // text 이면
    {
        // & 처리 : &amp; &nbsp; 등의 코드를 정상 출력함
        $content = html_symbol($content);

        // 공백 처리
		//$content = preg_replace("/  /", "&nbsp; ", $content);
		$content = str_replace("  ", "&nbsp; ", $content);
		$content = str_replace("\n ", "\n&nbsp;", $content);

        $content = get_text($content, 1);

        $content = url_auto_link($content);
    }

    return $content;
}

// 악성태그 변환
function bad_tag_convert($code){
    global $view;
    global $member, $is_admin;

    if ($is_admin && $member[mb_id] != $view[mb_id]) {
        $code = preg_replace_callback("#(\<(embed|object)[^\>]*)\>(\<\/(embed|object)\>)?#i",
                    create_function('$matches', 'return "<div class=\"embedx\">보안문제로 인하여 관리자 아이디로는 embed 또는 object 태그를 볼 수 없습니다. 확인하시려면 관리권한이 없는 다른 아이디로 접속하세요.</div>";'),
                    $code);
    }

    return preg_replace("/\<([\/]?)(script|iframe)([^\>]*)\>/i", "&lt;$1$2$3&gt;", $code);
}
// get_list 의 alias
function get_view($write_row, $board, $skin_path, $subject_len=125)
{
    return get_list($write_row, $board, $skin_path, $subject_len);
}


// 한글(2bytes)에서 마지막 글자가 1byte로 끝나는 경우
// 출력시 깨지는 현상이 발생하므로 마지막 완전하지 않은 글자(1byte)를 하나 없앰
function cut_hangul_last($hangul)
{
    global $nfor;

    // 한글이 반쪽나면 ?로 표시되는 현상을 막음
    $cnt = 0;
    for($i=0;$i<strlen($hangul);$i++) {
        // 한글만 센다
        if (ord($hangul[$i]) >= 0xA0) {
            $cnt++;
        }
    }

    // 홀수라면 한글이 반쪽난 상태이므로
    if (strtoupper($nfor[charset]) != 'utf-8') {
        if ($cnt%2) {
            $hangul = substr($hangul, 0, $cnt-1);
        }
    }

    return $hangul;
}


// 제목을 변환
function conv_subject($subject, $len, $suffix=""){
    return cut_str(get_text($subject), $len, $suffix);
}

function subject_sort_link($col, $query_string='', $flag='asc'){
    global $sst, $sod, $sfl, $stx, $page;

    $q1 = "sst=$col";
    if ($flag == 'asc')
    {
        $q2 = 'sod=asc';
        if ($sst == $col)
        {
            if ($sod == 'asc')
            {
                $q2 = 'sod=desc';
            }
        }
    }
    else
    {
        $q2 = 'sod=desc';
        if ($sst == $col)
        {
            if ($sod == 'desc')
            {
                $q2 = 'sod=asc';
            }
        }
    }

    return "<a href='$_SERVER[PHP_SELF]?$query_string&$q1&$q2&sfl=$sfl&stx=$stx&page=$page'>";
}


// 게시물 정보($write_row)를 출력하기 위하여 $list로 가공된 정보를 복사 및 가공
function get_list($write_row, $board, $skin_path, $subject_len=40){
    global $qstr, $page;

    // 배열전체를 복사
    $list = $write_row;
    unset($write_row);

    $list['is_notice'] = preg_match("/[^0-9]{0,1}{$list['wr_id']}[\r]{0,1}/",$board['bo_notice']);

    if ($subject_len)
        $list['subject'] = conv_subject($list['wr_subject'], $subject_len, "…");
    else
        $list['subject'] = conv_subject($list['wr_subject'], $board['bo_subject_len'], "…");

    $list['comment_cnt'] = "";
    if ($list['wr_comment'])
        $list['comment_cnt'] = "($list[wr_comment])";

    // 당일인 경우 시간으로 표시함
    $list['datetime'] = substr($list['wr_datetime'],0,10);
    $list['datetime2'] = $list['wr_datetime'];
    if ($list['datetime'] == date("Y-m-d"))
        $list['datetime2'] = substr($list['datetime2'],11,5);
    else
        $list['datetime2'] = substr($list['datetime2'],5,5);
    // 4.1
    $list['last'] = substr($list['wr_last'],0,10);
    $list['last2'] = $list['wr_last'];
    if ($list['last'] == date("Y-m-d"))
        $list['last2'] = substr($list['last2'],11,5);
    else
        $list['last2'] = substr($list['last2'],5,5);


    $tmp_name = get_text(cut_str($list['wr_name'], "40")); // 설정된 자리수 만큼만 이름 출력

	$list['name'] = "<span class='".($list['mb_id']?'member':'guest')."'>$tmp_name</span>";

    $reply = $list['wr_reply'];

    $list['reply'] = "";
    if (strlen($reply) > 0)
    {
        for ($k=0; $k<strlen($reply); $k++)
            $list['reply'] .= ' &nbsp;&nbsp; ';
    }

    $list['icon_reply'] = "";
    if ($list['reply'])
        $list['icon_reply'] = "<img src='$skin_path/img/icon_reply.gif' align='absmiddle'>";

    $list['icon_link'] = "";
    if ($list['wr_link1'] || $list['wr_link2'])
        $list['icon_link'] = "<img src='$skin_path/img/icon_link.gif' align='absmiddle'>";

    // 분류명 링크
    $list['ca_name_href'] = "board.php?bo_table=$board[bo_table]&sca=".urlencode($list['ca_name']);

    $list['href'] = "board.php?bo_table=$board[bo_table]&wr_id=$list[wr_id]" . $qstr;

    $list['comment_href'] = $list['href'];

    $list['icon_new'] = "";
    if ($list['wr_datetime'] >= date("Y-m-d H:i:s", time() - ($board['bo_new'] * 3600)))
        $list['icon_new'] = "<img src='$skin_path/img/icon_new.gif' align='absmiddle'>";

    $list['icon_hot'] = "";
    if ($list['wr_hit'] >= $board['bo_hot'])
        $list['icon_hot'] = "<img src='$skin_path/img/icon_hot.gif' align='absmiddle'>";

    $list['icon_secret'] = "";
    if (strstr($list['wr_option'], "secret"))
        $list['icon_secret'] = "<img src='$skin_path/img/icon_secret.gif' align='absmiddle'>";

    // 링크
    for ($i=1; $i<=2; $i++)
    {
        $list['link'][$i] = set_http(get_text($list["wr_link{$i}"]));
        $list['link_href'][$i] = "link.php?bo_table=$board[bo_table]&wr_id=$list[wr_id]&no=$i" . $qstr;
        $list['link_hit'][$i] = (int)$list["wr_link{$i}_hit"];
    }

    // 가변 파일
    $list['file'] = get_file($board['bo_table'], $list['wr_id']);

    if ($list['file']['count'])
        $list['icon_file'] = "<img src='$skin_path/img/icon_file.gif' align='absmiddle'>";

    return $list;
}


// url에 http:// 를 붙인다
function set_http($url){
    if (!trim($url)) return;

    if (!preg_match("/^(http|https|ftp|telnet|news|mms)\:\/\//i", $url))
        $url = "http://" . $url;

    return $url;
}



// 게시글에 첨부된 파일을 얻는다. (배열로 반환)
function get_file($bo_table, $wr_id){
    global $nfor, $qstr;

    $file["count"] = 0;
    $sql = " select * from nfor_board_file where bo_table = '$bo_table' and wr_id = '$wr_id' order by bf_no ";
    $result = sql_query($sql);
    while ($row = sql_fetch_array($result))
    {
        $no = $row[bf_no];
        $file[$no][href] = "./download.php?bo_table=$bo_table&wr_id=$wr_id&no=$no" . $qstr;
        $file[$no][download] = $row[bf_download];
        $file[$no][path] = "$nfor[path]/data/file/$bo_table";
        $file[$no][size] = get_filesize($row[bf_filesize]);
        $file[$no][datetime] = $row[bf_datetime];
        $file[$no][source] = addslashes($row[bf_source]);
        $file[$no][bf_content] = $row[bf_content];
        $file[$no][content] = get_text($row[bf_content]);
        $file[$no][view] = view_file_link($row[bf_file], $row[bf_width], $row[bf_height], $file[$no][content]);
        $file[$no][file] = $row[bf_file];
        $file[$no][image_width] = $row[bf_width] ? $row[bf_width] : 640;
        $file[$no][image_height] = $row[bf_height] ? $row[bf_height] : 480;
        $file[$no][image_type] = $row[bf_type];
        $file["count"]++;
    }

    return $file;
}




// 파일을 보이게 하는 링크 (이미지, 플래쉬, 동영상)
function view_file_link($file, $width, $height, $content="")
{
    global $config, $board;
    global $nfor;
    static $ids;

    if (!$file) return;

    $ids++;

    // 파일의 폭이 게시판설정의 이미지폭 보다 크다면 게시판설정 폭으로 맞추고 비율에 따라 높이를 계산
    if ($width > $board[bo_image_width] && $board[bo_image_width])
    {
        $rate = $board[bo_image_width] / $width;
        $width = $board[bo_image_width];
        $height = (int)($height * $rate);
    }

    // 폭이 있는 경우 폭과 높이의 속성을 주고, 없으면 자동 계산되도록 코드를 만들지 않는다.
    if ($width)
        $attr = " width='$width' height='$height' ";
    else
        $attr = "";

    if (preg_match("/\.($config[cf_image_extension])$/i", $file))
        // 이미지에 속성을 주지 않는 이유는 이미지 클릭시 원본 이미지를 보여주기 위한것임
        // 게시판설정 이미지보다 크다면 스킨의 자바스크립트에서 이미지를 줄여준다
        return "<img src='$nfor[path]/data/file/$board[bo_table]/".urlencode($file)."' name='target_resize_image[]' onclick='image_window(this);' style='cursor:pointer;' title='$content'>";

}



function search_font($stx, $str){

	// 문자앞에 \ 를 붙입니다.
    $src = array("/", "|");
    $dst = array("\/", "\|");

    if (!trim($stx)) return $str;

    // 검색어 전체를 공란으로 나눈다
    $s = explode(" ", $stx);

    // "/(검색1|검색2)/i" 와 같은 패턴을 만듬
    $pattern = "";
    $bar = "";
    for ($m=0; $m<count($s); $m++) {
        if (trim($s[$m]) == "") continue;
        // 태그는 포함하지 않아야 하는데 잘 안되는군. ㅡㅡa
        //$pattern .= $bar . '([^<])(' . quotemeta($s[$m]) . ')';
        //$pattern .= $bar . quotemeta($s[$m]);
        //$pattern .= $bar . str_replace("/", "\/", quotemeta($s[$m]));
        $tmp_str = quotemeta($s[$m]);
        $tmp_str = str_replace($src, $dst, $tmp_str);
        $pattern .= $bar . $tmp_str . "(?![^<]*>)";
        $bar = "|";
    }

    // 지정된 검색 폰트의 색상, 배경색상으로 대체
    $replace = "<span style='background-color:yellow; color:red;'>\\1</span>";

    return preg_replace("/($pattern)/i", $replace, $str);
}



// 검색 구문을 얻는다.
//function get_sql_search($search_ca_name, $search_field, $search_text, $search_operator=false)
function get_sql_search($search_ca_name, $search_field, $search_text, $search_operator='and')
{

	global $g4, $wr_9, $wr_10;

    $str = "";
    if ($search_ca_name)
        $str = " ca_name = '$search_ca_name' ";


	if($wr_9){
		if($str){
			$str = "(" . $str . " and wr_9 = '$wr_9') ";
		} else {
			$str = " wr_9 = '$wr_9' ";
		}
    }

	if($wr_10){
		if($str){
			$str = "(" . $str . " and wr_10 = '$wr_10') ";
		} else{
			$str = " wr_10 = '$wr_10' ";
		}
    }



    //$search_text = trim($search_text);
    $search_text = trim(stripslashes($search_text));

    if (!$search_text)
        return $str;

    if ($str)
        $str .= " and ";

    // 쿼리의 속도를 높이기 위하여 ( ) 는 최소화 한다.
    $op1 = "";

    // 검색어를 구분자로 나눈다. 여기서는 공백
    $s = array();
    $s = explode(" ", strip_tags($search_text));

    // 검색필드를 구분자로 나눈다. 여기서는 +
    //$field = array();
    //$field = explode("||", trim($search_field));
    $tmp = array();
    $tmp = explode(",", trim($search_field));
    $field = explode("||", $tmp[0]);
    $not_comment = $tmp[1];

    $str .= "(";
    for ($i=0; $i<count($s); $i++) {
        // 검색어
        $search_str = trim($s[$i]);
        if ($search_str == "") continue;

        $str .= $op1;
        $str .= "(";

        $op2 = "";
        for ($k=0; $k<count($field); $k++) { // 필드의 수만큼 다중 필드 검색 가능 (필드1+필드2...)
            $str .= $op2;
            switch ($field[$k]) {
                case "mb_id" :
                case "wr_name" :
                    $str .= " $field[$k] = '$s[$i]' ";
                    break;
                case "wr_hit" :
                case "wr_good" :
                case "wr_nogood" :
                    $str .= " $field[$k] >= '$s[$i]' ";
                    break;
                // 번호는 해당 검색어에 -1 을 곱함
                case "wr_num" :
                    $str .= "$field[$k] = ".((-1)*$s[$i]);
                    break;
                // LIKE 보다 INSTR 속도가 빠름
                default :
                    if (preg_match("/[a-zA-Z]/", $search_str))
                        $str .= "INSTR(LOWER($field[$k]), LOWER('$search_str'))";
                    else
                        $str .= "INSTR($field[$k], '$search_str')";
                    break;
            }
            $op2 = " or ";
        }
        $str .= ")";

        //$op1 = ($search_operator) ? ' and ' : ' or ';
        $op1 = " $search_operator ";
    }
    $str .= " ) ";
    if ($not_comment)
        $str .= " and wr_is_comment = '0' ";

    return $str;
}



function get_category_option($bo_table=''){
    global $board;

    $arr = explode("|", $board[bo_category_list]); // 구분자가 , 로 되어 있음
    $str = "";
    for ($i=0; $i<count($arr); $i++)
        if (trim($arr[$i]))
            $str .= "<option value='$arr[$i]'>$arr[$i]</option>\n";

    return $str;
}

// 회원권한을 SELECT 형식으로 얻음
function get_member_level_select($name, $start_id=0, $end_id=2, $selected='', $event=''){
    $str = "<select name='$name' $event>";
    for ($i=$start_id; $i<=$end_id; $i++)
    {
        $str .= "<option value='$i'";
        if ($i == $selected)
            $str .= " selected";

		if($i=="1"){
			$str .= ">비회원($i)</option>";
		} elseif($i=="2"){
			$str .= ">일반회원($i)</option>";
		} else{
			$str .= ">여분회원($i)</option>";
		}


    }
    $str .= "</select>";
    return $str;
}

function get_skin_dir($skin, $len=''){
    global $nfor;

    $result_array = array();

    $dirname = "$nfor[path]/skin/$skin/";
    $handle = opendir($dirname);
    while ($file = readdir($handle))
    {
        if($file == "."||$file == "..") continue;

        if (is_dir($dirname.$file)) $result_array[] = $file;
    }
    closedir($handle);
    sort($result_array);

    return $result_array;
}

function get_wr_num($table){
    // 가장 작은 번호를 얻어
    $sql = " select min(wr_num) as min_wr_num from $table ";
    $row = sql_fetch($sql);
    // 가장 작은 번호에 1을 빼서 넘겨줌
    return (int)($row[min_wr_num] - 1);
}


// TEXT 형식으로 변환
function get_text($str, $html=0)
{

    // TEXT 출력일 경우 &amp; &nbsp; 등의 코드를 정상으로 출력해 주기 위함
    if ($html == 0) {
        $str = html_symbol($str);
    }

    $source[] = "/</";
    $target[] = "&lt;";
    $source[] = "/>/";
    $target[] = "&gt;";
    //$source[] = "/\"/";
    //$target[] = "&#034;";
    $source[] = "/\'/";
    $target[] = "&#039;";
    //$source[] = "/}/"; $target[] = "&#125;";
    if ($html) {
        $source[] = "/\n/";
        $target[] = "<br/>";
    }

    return preg_replace($source, $target, $str);
}

function html_symbol($str)
{
    return preg_replace("/\&([a-z0-9]{1,20}|\#[0-9]{0,3});/i", "&#038;\\1;", $str);
}




function xml2array($contents, $get_attributes=1, $priority = 'tag') {
    if(!$contents) return array();

    if(!function_exists('xml_parser_create')) {
        //print "'xml_parser_create()' function not found!";
        return array();
    }

    //Get the XML parser of PHP - PHP must have this module for the parser to work
     $parser = xml_parser_create('');
    xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "utf-8"); # http://minutillo.com/steve/weblog/2004/6/17/php-xml-and-character-encodings-a-tale-of-sadness-rage-and-data-loss
     xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
    xml_parse_into_struct($parser, trim($contents), $xml_values);
    xml_parser_free($parser);

    if(!$xml_values) return;//Hmm...

    //Initializations
    $xml_array = array();
    $parents = array();
    $opened_tags = array();
    $arr = array();

    $current = &$xml_array; //Refference

    //Go through the tags.
    $repeated_tag_index = array();//Multiple tags with same name will be turned into an array
     foreach($xml_values as $data) {
        unset($attributes,$value);//Remove existing values, or there will be trouble

        //This command will extract these variables into the foreach scope
        // tag(string), type(string), level(int), attributes(array).
        extract($data);//We could use the array by itself, but this cooler.

        $result = array();
        $attributes_data = array();

        if(isset($value)) {
            if($priority == 'tag') $result = $value;
            else $result['value'] = $value; //Put the value in a assoc array if we are in the 'Attribute' mode
         }

        //Set the attributes too.
        if(isset($attributes) and $get_attributes) {
            foreach($attributes as $attr => $val) {
                if($priority == 'tag') $attributes_data[$attr] = $val;
                else $result['attr'][$attr] = $val; //Set all the attributes in a array called 'attr'
             }
        }

        //See tag status and do the needed.
        if($type == "open") {//The starting of the tag '<tag>'
            $parent[$level-1] = &$current;
            if(!is_array($current) or (!in_array($tag, array_keys($current)))) { //Insert New tag
                 $current[$tag] = $result;
                if($attributes_data) $current[$tag. '_attr'] = $attributes_data;
                 $repeated_tag_index[$tag.'_'.$level] = 1;

                $current = &$current[$tag];

            } else { //There was another element with the same tag name

                if(isset($current[$tag][0])) {//If there is a 0th element it is already an array
                     $current[$tag][$repeated_tag_index[$tag.'_'.$level]] = $result;
                     $repeated_tag_index[$tag.'_'.$level]++;
                } else {//This section will make the value an array if multiple tags with the same name appear together
                     $current[$tag] = array($current[$tag],$result);//This will combine the existing item and the new item together to make an array
                     $repeated_tag_index[$tag.'_'.$level] = 2;

                    if(isset($current[$tag.'_attr'])) { //The attribute of the last(0th) tag must be moved as well
                         $current[$tag]['0_attr'] = $current[$tag.'_attr'];
                        unset($current[$tag.'_attr']);
                    }

                }
                $last_item_index = $repeated_tag_index[$tag.'_'.$level]-1;
                $current = &$current[$tag][$last_item_index];
            }

        } elseif($type == "complete") { //Tags that ends in 1 line '<tag />'
            //See if the key is already taken.
            if(!isset($current[$tag])) { //New Key
                $current[$tag] = $result;
                $repeated_tag_index[$tag.'_'.$level] = 1;
                if($priority == 'tag' and $attributes_data) $current[$tag. '_attr'] = $attributes_data;

            } else { //If taken, put all things inside a list(array)
                if(isset($current[$tag][0]) and is_array($current[$tag])) {//If it is already an array...

                    // ...push the new element into that array.
                    $current[$tag][$repeated_tag_index[$tag.'_'.$level]] = $result;

                    if($priority == 'tag' and $get_attributes and $attributes_data) {
                         $current[$tag][$repeated_tag_index[$tag.'_'.$level] . '_attr'] = $attributes_data;
                     }
                    $repeated_tag_index[$tag.'_'.$level]++;

                } else { //If it is not an array...
                    $current[$tag] = array($current[$tag],$result); //...Make it an array using using the existing value and the new value
                     $repeated_tag_index[$tag.'_'.$level] = 1;
                    if($priority == 'tag' and $get_attributes) {
                        if(isset($current[$tag.'_attr'])) { //The attribute of the last(0th) tag must be moved as well

                            $current[$tag]['0_attr'] = $current[$tag.'_attr'];
                            unset($current[$tag.'_attr']);
                        }

                        if($attributes_data) {
                            $current[$tag][$repeated_tag_index[$tag.'_'.$level] . '_attr'] = $attributes_data;
                         }
                    }
                    $repeated_tag_index[$tag.'_'.$level]++; //0 and 1 index is already taken
                 }
            }

        } elseif($type == 'close') { //End of tag '</tag>'
            $current = &$parent[$level-1];
        }
    }

    return($xml_array);
}



function url_fsockopen($url){
	$url_parsed = parse_url($url);

	$host = $url_parsed["host"];
	$port = $url_parsed["port"];
	if ($port==0)
		$port = 80;

	$path = $url_parsed["path"];
	if ($url_parsed["query"] != "")
		$path .= "?".$url_parsed["query"];

	$out = "GET $path HTTP/1.0\r\nHost: $host\r\n\r\n";

	$fp = fsockopen($host, $port, $errno, $errstr, 30);
	if (!$fp) {
		echo "$errstr ($errno)<br>\n";
	} else {
		fputs($fp, $out);
		$body = false;
		while (!feof($fp)) {
			$contents = fgets($fp, 128);
			if ($body)
				$social .= $contents;
			if ($contents == "\r\n")
				$body = true;
		}
		fclose($fp);
		return $social;
	}
}


function delivery_type($item){

	$str = "";
	if($item[it_delivery]){

		if($item[it_delivery_type]=="1"){
			$str = "무료배송";
		} elseif($item[it_delivery_type]=="2"){
			$str = "착불배송";
		} elseif($item[it_delivery_type]=="3"){
			$str = number_format($item[it_delivery_total])."원 이상 무료배송"; // 조건부무료배송
		} elseif($item[it_delivery_type]=="4"){
			$str = "배송비 ".number_format($item[it_delivery_price])."원"; // 자동결제
		} else{
			$str = "배송상품";
		}

	} else{

		$str = "티켓상품";

	}

	return $str;
}


function get_paging_it_select($write_pages, $cur_page, $total_page, $url, $add=""){
	$str = "<div class='paging'>";
	if ($cur_page > 1) {
		$str .= "<a href='javascript:it_select_page(1)' class='num_box pre'>&lt;&lt;</a>";
	}

	$start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
	$end_page = $start_page + $write_pages - 1;

	if ($end_page >= $total_page) $end_page = $total_page;

	if ($start_page > 1) $str .= " &nbsp;<a href='javascript:it_select_page(".($start_page-1).")' class='num_box pre'>&lt;</a>";

	if ($total_page > 1) {
		for ($k=$start_page;$k<=$end_page;$k++) {
			if ($cur_page != $k)
				$str .= " &nbsp;<a href='javascript:it_select_page($k)' class='num_box'>$k</a>";
			else
				$str .= " &nbsp;<strong>$k</strong> ";
		}
	}

	if ($total_page > $end_page) $str .= " &nbsp;<a href='javascript:it_select_page(".($end_page+1).")' class='num_box next'>&gt;</a>";

	if ($cur_page < $total_page) {
		$str .= " &nbsp;<a href='javascript:it_select_page($total_page)' class='num_box next'>&gt;&gt;</a>";
	}
	$str .= "</div>";

	return $str;
}



function get_od_id(){

    sql_query(" LOCK TABLES nfor_order READ, nfor_order WRITE ", FALSE);
    $row = sql_fetch(" select max(od_id) as max_od_id from nfor_order where SUBSTRING(od_id, 1, 6) = '".date("ymd")."' ");
    $od_id = $row[max_od_id];
    if($od_id){
		$od_id = (int)substr($od_id, -6);
        $od_id++;
	} else{
		$od_id = 1;
    }
    $od_id = date("ymd").substr("000000".$od_id,-6);

	sql_query(" UNLOCK TABLES ", FALSE);
    return $od_id;
}



function nfor_price($it_price_type,$type){
	$data = sql_fetch("select * from nfor_price where wr_id='$it_price_type'");
	if($type){
		if($data[wr_icon_img]){
			$str = "<img src='$nfor[path]/data/price/$data[wr_icon_img]' alt='$data[wr_icon]'>";
		} else{
			$str = $data[wr_icon];
		}
	} else{
		$str = $data[wr_icon];
	}
	return $str;
}


function reply_name($mb_no){
	$data = sql_fetch("select mb_name from nfor_member where mb_no='$mb_no'");
	echo $data[mb_name];
}


function nfor_send($wr_code,$email="",$hp="",$mb_no="",$od_id="",$ct_id=""){
	global $config, $nfor, $member;
	$send = sql_fetch("select * from nfor_send where wr_code='$wr_code'");


	$wr_subject = $send[wr_subject];
	$wr_memo = $send[wr_memo];
	$wr_msg = $send[wr_msg];

	$wr_memo=str_replace("{메일내용}", $nfor[wr_memo], $wr_memo);
	$wr_msg=str_replace("{메일내용}", $nfor[wr_memo], $wr_msg);

	// 주문번호가 인자로 넘어왔을때
	if($od_id){
		$od = sql_fetch("select * from nfor_order where od_id='$od_id'");

		$wr_subject=str_replace("{주문번호}", $od[od_id], $wr_subject);
		$wr_memo=str_replace("{주문번호}", $od[od_id], $wr_memo);
		$wr_msg=str_replace("{주문번호}", $od[od_id], $wr_msg);

		// 무통장
		$wr_subject=str_replace("{입금계좌}", $od[bank_number], $wr_subject);
		$wr_memo=str_replace("{입금계좌}", $od[bank_number], $wr_memo);
		$wr_msg=str_replace("{입금계좌}", $od[bank_number], $wr_msg);


		$wr_subject=str_replace("{입금자명}", $od[bank_name], $wr_subject);
		$wr_memo=str_replace("{입금자명}", $od[bank_name], $wr_memo);
		$wr_msg=str_replace("{입금자명}", $od[bank_name], $wr_msg);


		$wr_subject=str_replace("{입금금액}", number_format($od[banking_price])."원", $wr_subject);
		$wr_memo=str_replace("{입금금액}", number_format($od[banking_price])."원", $wr_memo);
		$wr_msg=str_replace("{입금금액}", number_format($od[banking_price])."원", $wr_msg);


		$wr_subject=str_replace("{입금예정일}", $od[bank_date], $wr_subject);
		$wr_memo=str_replace("{입금예정일}", $od[bank_date], $wr_memo);
		$wr_msg=str_replace("{입금예정일}", $od[bank_date], $wr_msg);

	}

	// 카트번호가 인자로 넘어왔을때
	if($ct_id){
		$ct = sql_fetch("select * from nfor_cart where ct_id='$ct_id'");

		$wr_subject=str_replace("{구매수량}", $ct[option_cnt]."장", $wr_subject);
		$wr_memo=str_replace("{구매수량}", $ct[option_cnt]."장", $wr_memo);
		$wr_msg=str_replace("{구매수량}", $ct[option_cnt]."장", $wr_msg);

		$wr_subject=str_replace("{사용수량}", $ct[ticket_used]."장", $wr_subject);
		$wr_memo=str_replace("{사용수량}", $ct[ticket_used]."장", $wr_memo);
		$wr_msg=str_replace("{사용수량}", $ct[ticket_used]."장", $wr_msg);



		$wr_subject=str_replace("{송장번호}", $ct[delivery_number], $wr_subject);
		$wr_memo=str_replace("{송장번호}", $ct[delivery_number], $wr_memo);
		$wr_msg=str_replace("{송장번호}", $ct[delivery_number], $wr_msg);

		$wr_subject=str_replace("{택배업체}", $ct[delivery_company], $wr_subject);
		$wr_memo=str_replace("{택배업체}", $ct[delivery_company], $wr_memo);
		$wr_msg=str_replace("{택배업체}", $ct[delivery_company], $wr_msg);

		if($ct[ticket_number]){
			$wr_subject=str_replace("{티켓번호}", $ct[ticket_number], $wr_subject);
			$wr_memo=str_replace("{티켓번호}", $ct[ticket_number], $wr_memo);
			$wr_msg=str_replace("{티켓번호}", $ct[ticket_number], $wr_msg);
		} else{
			$wr_subject=str_replace("{티켓번호}", strtoupper(sql_old_password($ct[ct_id])), $wr_subject);
			$wr_memo=str_replace("{티켓번호}", strtoupper(sql_old_password($ct[ct_id])), $wr_memo);
			$wr_msg=str_replace("{티켓번호}", strtoupper(sql_old_password($ct[ct_id])), $wr_msg);
		}

		$item = sql_fetch("select supply_no, it_enddate from nfor_item where it_id='$ct[it_id]'");
		$wr_subject=str_replace("{유효기간}", "~".((int)substr($item[it_enddate],5,2))."/".((int)substr($item[it_enddate],8,2))."까지", $wr_subject);
		$wr_memo=str_replace("{유효기간}", "~".((int)substr($item[it_enddate],5,2))."/".((int)substr($item[it_enddate],8,2))."까지", $wr_memo);
		$wr_msg=str_replace("{유효기간}", "~".((int)substr($item[it_enddate],5,2))."/".((int)substr($item[it_enddate],8,2))."까지", $wr_msg);


		$supply = sql_fetch("select supply_name from nfor_member where mb_no='$item[supply_no]'");
		$wr_subject=str_replace("{입점업체}", $supply[supply_name], $wr_subject);
		$wr_memo=str_replace("{입점업체}", $supply[supply_name], $wr_memo);
		$wr_msg=str_replace("{입점업체}", $supply[supply_name], $wr_msg);




	}

	// 회원정보가 인자로 넘어왔을때
	if($mb_no){
		$mb = sql_fetch("select * from nfor_member where mb_no='$mb_no'");
		$wr_subject=str_replace("{아이디}", $mb[$nfor[id_type]], $wr_subject);
		$wr_memo=str_replace("{아이디}", $mb[$nfor[id_type]], $wr_memo);
		$wr_msg=str_replace("{아이디}", $mb[$nfor[id_type]], $wr_msg);

		$wr_subject=str_replace("{이름}", $mb[mb_name], $wr_subject);
		$wr_memo=str_replace("{이름}", $mb[mb_name], $wr_memo);
		$wr_msg=str_replace("{이름}", $mb[mb_name], $wr_msg);
	}


	// 임시비밀번호
	$wr_subject = str_replace("{임시비밀번호}", $nfor[tmp_password], $wr_subject);
	$wr_memo = str_replace("{임시비밀번호}", $nfor[tmp_password], $wr_memo);
	$wr_msg = str_replace("{임시비밀번호}", $nfor[tmp_password], $wr_msg);


	// 회원전번
	$wr_subject=str_replace("{회원전번}", $order[mb_hp], $wr_subject);
	$wr_memo=str_replace("{회원전번}", $order[mb_hp], $wr_memo);
	$wr_msg=str_replace("{회원전번}", $order[mb_hp], $wr_msg);


	// 회원가입 인증번호
	$wr_subject=str_replace("{인증번호}", $nfor[asign_number], $wr_subject);
	$wr_memo=str_replace("{인증번호}", $nfor[asign_number], $wr_memo);
	$wr_msg=str_replace("{인증번호}", $nfor[asign_number], $wr_msg);


	// 상품명
	if($ct_id){
		$wr_subject=str_replace("{상품명}", it_name($od[od_id],$ct[ct_id]), $wr_subject);
		$wr_memo=str_replace("{상품명}", it_name($od[od_id],$ct[ct_id]), $wr_memo);
		$wr_msg=str_replace("{상품명}", it_name($od[od_id],$ct[ct_id]), $wr_msg);
	} else{
		$wr_subject=str_replace("{상품명}", it_name($od[od_id]), $wr_subject);
		$wr_memo=str_replace("{상품명}", it_name($od[od_id]), $wr_memo);
		$wr_msg=str_replace("{상품명}", it_name($od[od_id]), $wr_msg);
	}


	$wr_subject=str_replace("{상점명}", $config[cf_name], $wr_subject);
	$wr_memo=str_replace("{상점명}", $config[cf_name], $wr_memo);
	$wr_msg=str_replace("{상점명}", $config[cf_name], $wr_msg);


	$wr_subject=str_replace("{상호명}", $config[cf_cp_name], $wr_subject);
	$wr_memo=str_replace("{상호명}", $config[cf_cp_name], $wr_memo);
	$wr_msg=str_replace("{상호명}", $config[cf_cp_name], $wr_msg);


	$wr_subject=str_replace("{사업자등록번호}", $config[cf_cp_number1], $wr_subject);
	$wr_memo=str_replace("{사업자등록번호}", $config[cf_cp_number1], $wr_memo);
	$wr_msg=str_replace("{사업자등록번호}", $config[cf_cp_number1], $wr_msg);


	$wr_subject=str_replace("{통신판매업신고}", $config[cf_cp_number2], $wr_subject);
	$wr_memo=str_replace("{통신판매업신고}", $config[cf_cp_number2], $wr_memo);
	$wr_msg=str_replace("{통신판매업신고}", $config[cf_cp_number2], $wr_msg);


	$wr_subject=str_replace("{사업장소재지}", $config[cf_cp_address], $wr_subject);
	$wr_memo=str_replace("{사업장소재지}", $config[cf_cp_address], $wr_memo);
	$wr_msg=str_replace("{사업장소재지}", $config[cf_cp_address], $wr_msg);


	$wr_subject=str_replace("{대표자명}", $config[cf_cp_ceo], $wr_subject);
	$wr_memo=str_replace("{대표자명}", $config[cf_cp_ceo], $wr_memo);
	$wr_msg=str_replace("{대표자명}", $config[cf_cp_ceo], $wr_msg);


	$wr_subject=str_replace("{대표전화}", $config[cf_tel], $wr_subject);
	$wr_memo=str_replace("{대표전화}", $config[cf_tel], $wr_memo);
	$wr_msg=str_replace("{대표전화}", $config[cf_tel], $wr_msg);


	$wr_subject=str_replace("{개인정보보호책임자}", $config[cf_cp_privacy], $wr_subject);
	$wr_memo=str_replace("{개인정보보호책임자}", $config[cf_cp_privacy], $wr_memo);
	$wr_msg=str_replace("{개인정보보호책임자}", $config[cf_cp_privacy], $wr_msg);


	$wr_subject=str_replace("{상점URL}", $nfor[url], $wr_subject);
	$wr_memo=str_replace("{상점URL}", $nfor[url], $wr_memo);
	$wr_msg=str_replace("{상점URL}", $nfor[url], $wr_msg);



	if($send[wr_mail_use]){
		mailer($config[cf_name], $config[cf_email], $email, $wr_subject, $wr_memo, 1);
	}

	if($send[wr_sms_use]){
		sms_send($hp, $config[cf_tel], $wr_msg);
	}


}

function mb_id($mb_no){
	global $nfor;
	$data = sql_fetch("select mb_email,mb_id from nfor_member where mb_no='$mb_no'");
	if($nfor[id_type]=="mb_email"){
		$str = $data[mb_email];
	} else{
		$str = $data[mb_id];
	}
	return $str;
}



function it_change_volume($it_id){
	global $nfor;
	$it_sales_volume = sql_fetch("select sum(it_sales_volume) as change_volume from nfor_false_item where it_id='$it_id' and wr_datetime <= '$nfor[ymdhis]'");
	return $it_sales_volume[change_volume];
}


function it_sales_volume($it_id,$option_id=''){
	$sql = "select sum(option_cnt) as it_sales_volume from nfor_cart a, nfor_order b where a.cart_id=b.cart_id and a.it_id='$it_id' and (b.pay_step='1' or b.pay_step='4')";
	if($option_id) $sql .= " and a.option_id='$option_id'";
	$count = sql_fetch($sql);	// 결제완료, 입금대기
	$count[it_sales_volume] = $count[it_sales_volume] + 0;
	return $count[it_sales_volume];
}


function option_select($row){
	$str = "";
	for($i=1; $i<=4; $i++){
		if($i>1) $str .= " ";
		$str .= $row["option_select".$i];
	}
	return $str;
}



function it_option($option_id,$ct_id=''){
	$opt = sql_fetch("select * from nfor_item_option where option_id='$option_id'");
	$item = sql_fetch("select * from nfor_item where it_id='$opt[it_id]'");
	for($i=1; $i<=$item[it_opt_depth]; $i++){
		if($i>1){
			$print .= " <br> ";
		}
		$print .= $opt["option_name".$i];
	}


	if($ct_id){
		$price_data = sql_fetch("select option_price from nfor_cart where ct_id='$ct_id'");
		$print .=  "(".number_format($price_data[option_price])."원)";
	} else{
		$print .=  "(".number_format($opt[price])."원)";
	}

	return $print;
}


function item_name($it_id){
	$item = sql_fetch("select it_name from nfor_item where it_id='$it_id'");
	return $item[it_name];
}

function it_name($od_id,$ct_id=""){

	if($ct_id){
		$ct = sql_fetch("select it_id from nfor_cart where ct_id='$ct_id'");
		$item = sql_fetch("select it_name from nfor_item where it_id='$ct[it_id]'");
		$str = $item[it_name];
	} else{
		$order = sql_fetch("select cart_id from nfor_order where od_id='$od_id'");
		$cart = sql_fetch("select count(*) as cnt, z.it_id from (select * from nfor_cart where cart_id='$order[cart_id]') as z");	//  group by it_id
		$item = sql_fetch("select it_name from nfor_item where it_id='$cart[it_id]'");
		$str = $item[it_name];
		if($cart[cnt]>1){
			$str .= "외 ".($cart[cnt]-1)."건";
		}
	}
	return $str;
}



function pay_step($step){

	if($step=="1"){
		$str = "결제완료";
	} elseif($step=="2"){
		$str = "취소신청";
	} elseif($step=="3"){
		$str = "취소완료";
	} elseif($step=="4"){
		$str = "입금대기";
	} elseif($step=="5"){
		$str = "취소완료";
	} else{
		$str = "결제대기";
	}
	return $str;

}


function delivery_step($step){
	if($step=="1"){
		$str = "배송준비중";
	} elseif($step=="2"){
		$str = "배송완료";
	} elseif($step=="3"){
		$str = "반품대기";
	} elseif($step=="4"){
		$str = "반품완료";
	} elseif($step=="5"){
		$str = "주문취소";
	} else{
		$str = "배송대기";
	}
	return $str;
}


function payment_type($payment_type){

	if($payment_type=="card"){
		$return = "신용카드";
	} elseif($payment_type=="iche"){
		$return = "계좌이체";
	} elseif($payment_type=="hp"){
		$return = "휴대폰";
	} elseif($payment_type=="vbanking"){
		$return = "가상계좌";
	} elseif($payment_type=="banking"){
		$return = "무통장입금";
	} elseif($payment_type=="money"){
		$return = "적립금";
	} elseif($payment_type=="coupon"){
		$return = "쿠폰";
	} else{
		$return = "";
	}
	return $return;

}

function file_upload($targetdir, $filearray){

	$tmp_file = $filearray['tmp_name'];

    if(is_uploaded_file($tmp_file)){

		@mkdir($targetdir, 0707);
		@chmod($targetdir, 0707);

		$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));
		$filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filearray['name']);

		shuffle($chars_array);
		$shuffle = implode("", $chars_array);

		$change_filename = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr($shuffle,0,8).'_'.str_replace('%', '', urlencode(str_replace(' ', '_', $filename)));

		$dest_file = $targetdir.$change_filename;

		if(move_uploaded_file($filearray['tmp_name'], $dest_file)){
			@chmod($dest_file, 0606);
			return $change_filename;
		} else{
			return false;
		}

	}

}



function multi_upload($targetdir, $filename, $k){
	global $_FILES;
	$dest_file = time().$_FILES[$filename]['name'][$k];
	if(move_uploaded_file($_FILES[$filename]['tmp_name'][$k], $targetdir.$dest_file)){
		@chmod($dest_file, 0606);
		$add_sql = " , $filename='$dest_file'";
	} else{
		$add_sql = "";
	}
	return $add_sql;

}


// 메타태그를 이용한 URL 이동
function goto_url($url){
    echo "<script type='text/javascript'> location.replace('$url'); </script>";
    exit;
}





// 쿠키변수 생성
function set_cookie($cookie_name, $value, $expire){
    global $nfor;
    setcookie(md5($cookie_name), base64_encode($value), time() + $expire, '/', $nfor[cookie_domain]);
}


// 쿠키변수값 얻음
function get_cookie($cookie_name){
    $cookie = md5($cookie_name);
    if (array_key_exists($cookie, $_COOKIE))
        return base64_decode($_COOKIE[$cookie]);
    else
        return "";
}












// 경고메세지를 경고창으로
function alert($msg='', $url=''){
	global $nfor;

    if (!$msg) $msg = '올바른 방법으로 이용해 주십시오.';

	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=$nfor[charset]\">";
	echo "<script type='text/javascript'>alert('$msg');";
    if (!$url)
        echo "history.go(-1);";
    echo "</script>";
    if ($url)
        goto_url($url);
    exit;
}


// 경고메세지 출력후 창을 닫음
function alert_close($msg){
	global $nfor;

	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=$nfor[charset]\">";
    echo "<script type='text/javascript'> alert('$msg'); window.close(); </script>";
    exit;
}

// 경고메세지 출력후 창을 닫음
function alert_close_refresh($msg){
	global $nfor;

	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=$nfor[charset]\">";
    echo "<script type='text/javascript'> alert('$msg'); window.opener.document.location.href = window.opener.document.URL; window.close(); </script>";
    exit;
}

function cut_str($str, $len, $suffix="…"){
    global $nfor;

    $s = substr($str, 0, $len);
    $cnt = 0;
    for ($i=0; $i<strlen($s); $i++)
        if (ord($s[$i]) > 127)
            $cnt++;
    if ($nfor[charset] == 'utf-8')
        $s = substr($s, 0, $len - ($cnt % 3));
    else
        $s = substr($s, 0, $len - ($cnt % 2));
    if (strlen($s) >= strlen($str))
        $suffix = "";


    return $s . $suffix;
}


function sql_num_rows($result){
	return mysqli_num_rows($result);
}


function sql_insert_id(){
	global $connect_db;
	return mysqli_insert_id($connect_db);
}

function sql_query($sql, $error=TRUE){
	global $connect_db;

    if ($error)
        $result = @mysqli_query($connect_db, $sql) or die("<p>$sql<p>" . mysqli_errno($connect_db) . " : " .  mysqli_error($connect_db) . "<p>error file : $_SERVER[PHP_SELF]");
    else
        $result = @mysqli_query($connect_db, $sql);

    return $result;
}

function sql_fetch($sql, $error=TRUE){
    $result = sql_query($sql, $error);
    $row = mysqli_fetch_array($result);
    return $row;
}

function sql_fetch_array($result){
    $row = @mysqli_fetch_assoc($result);
    return $row;
}

function sql_password($value){
    $row = sql_fetch(" select password('$value') as pass ");
    return $row[pass];
}

function sql_old_password($value){
    $row = sql_fetch(" select old_password('$value') as pass ");
    return $row[pass];
}


function ajax_get_paging($type, $write_pages, $cur_page, $total_page, $url, $add="")
{
	global $nfor;
    $str = "<div class='paging'>";
    if ($cur_page > 1) {
        $str .= "<a href='javascript:item_{$type}_load(it_id,1)' class='num_box pre'>&lt;&lt;</a>";
    }

    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;

    if ($end_page >= $total_page) $end_page = $total_page;

    if ($start_page > 1) $str .= " &nbsp;<a href='javascript:item_{$type}_load(it_id,".($start_page-1).")' class='num_box pre'>&lt;</a>";

    if ($total_page > 1) {
        for ($k=$start_page;$k<=$end_page;$k++) {
            if ($cur_page != $k)
                $str .= " &nbsp;<a href='javascript:item_{$type}_load(it_id,$k)' class='num_box'>$k</a>";
            else
                $str .= " &nbsp;<strong>$k</strong> ";
        }
    }

    if ($total_page > $end_page) $str .= " &nbsp;<a href='javascript:item_{$type}_load(it_id,".($end_page+1).")' class='num_box next'>&gt;</a>";

    if ($cur_page < $total_page) {
        $str .= " &nbsp;<a href='javascript:item_{$type}_load(it_id,$total_page)' class='num_box next'>&gt;&gt;</a>";
    }
    $str .= "</div>";

    return $str;
}

// 현재페이지, 총페이지수, 한페이지에 보여줄 행, URL
function get_paging($write_pages, $cur_page, $total_page, $url, $add=""){
    $str = "<div class='paging'>";
    if ($cur_page > 1) {
        $str .= "<a href='" . $url . "1{$add}' class='num_box pre'style='color:#aaaaaa;'><b>&lt; </b> 처음</a>";
    }

    $start_page = ( ( ( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;

    if ($end_page >= $total_page) $end_page = $total_page;

    if ($start_page > 1) $str .= " <a href='" . $url . ($start_page-1) . "{$add}' class='num_box pre' style='color:#aaaaaa;'>이전&lt;</a>";

    if ($total_page > 1) {
        for ($k=$start_page;$k<=$end_page;$k++) {
            if ($cur_page != $k)
                $str .= " <a href='$url$k{$add}' class='num_box'>$k</a>";
            else
                $str .= " <strong>$k</strong> ";
        }
    }

    if ($total_page > $end_page) $str .= " &nbsp;<a href='" . $url . ($end_page+1) . "{$add}' class='num_box next'>&gt;</a>";

    if ($cur_page < $total_page) {
        $str .= " <a href='$url$total_page{$add}' class='num_box next' style='color:#aaaaaa;'>다음 <b>&gt;</b></a>";
    }
    $str .= "</div>";

    return $str;
}









function nfor_session_open($save_path, $session_name){
    global $connect_db, $nfor;
    if(!$connect_db){
		$connect_db = mysqli_connect($nfor[sql_host], $nfor[sql_user], $nfor[sql_password], $nfor[sql_db]);
		if(mysqli_connect_errno()){
			printf("DB 연결 실패: %s\n", mysqli_connect_error());
			exit();
		}
    }
    return true;
}

function nfor_session_close(){
    global $connect_db;
    return mysqli_close($connect_db);
}

function nfor_session_read($id){
    global $connect_db;
    $row = sql_fetch("select ss_data from nfor_session where id = '$id'");
    return $row[ss_data];
}

function nfor_session_write($id, $data){
    global $connect_db;
    $qry = sql_query("replace into nfor_session values ('$id', NOW(), '$data')");
    return $qry;
}

function nfor_session_destroy($id){
    global $connect_db;
    $qry = sql_query("delete from nfor_session where id = '$id'");
    return $qry;
}

function nfor_session_clean($max){
    global $connect_db;
    $old = time() - $max;
    $old = date("Y-m-d H:i:s", $old);
    $qry = sql_query("delete from nfor_session where ss_datetime < '$old'");
    return $qry;
}




// way.co.kr 의 wayboard 참고
function url_auto_link($str){

    $str = preg_replace("/&lt;/", "\t_lt_\t", $str);
    $str = preg_replace("/&gt;/", "\t_gt_\t", $str);
    $str = preg_replace("/&amp;/", "&", $str);
    $str = preg_replace("/&quot;/", "\"", $str);
    $str = preg_replace("/&nbsp;/", "\t_nbsp_\t", $str);
    $str = preg_replace("/([^(http:\/\/)]|\(|^)(www\.[^[:space:]]+)/i", "\\1<A HREF=\"http://\\2\" TARGET='_blank'>\\2</A>", $str);
    $str = preg_replace("/([^(HREF=\"?'?)|(SRC=\"?'?)]|\(|^)((http|https|ftp|telnet|news|mms):\/\/[a-zA-Z0-9\.-]+\.[\xA1-\xFEa-zA-Z0-9\.:&#=_\?\/~\+%@;\-\|\,\(\)]+)/i", "\\1<A HREF=\"\\2\" TARGET='_blank'>\\2</A>", $str);
    $str = preg_replace("/([0-9a-z]([-_\.]?[0-9a-z])*@[0-9a-z]([-_\.]?[0-9a-z])*\.[a-z]{2,4})/i", "<a href='mailto:\\1'>\\1</a>", $str);
    $str = preg_replace("/\t_nbsp_\t/", "&nbsp;" , $str);
    $str = preg_replace("/\t_lt_\t/", "&lt;", $str);
    $str = preg_replace("/\t_gt_\t/", "&gt;", $str);

    return $str;
}

?>
