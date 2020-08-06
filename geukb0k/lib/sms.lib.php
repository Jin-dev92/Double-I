<?php

function sms_status($status){
	if($status=="1"){
		$return = "일반발송 요청";
	} elseif($status=="2"){
		$return = "예약발송 요청";	
	} elseif($status=="3"){
		$return = "발송성공";
	} else{
		$return = "발송실패";
	}
	return $return;
}

function sms_count(){
	global $config;

	$sms_url = "https://sslsms.cafe24.com/sms_remain.php"; // SMS 잔여건수 요청 URL
	$sms['user_id'] = base64_encode($config[cf_sms_id]); // SMS 아이디
	$sms['secure'] = base64_encode($config[cf_sms_pass]) ;//인증키

	$sms['mode'] = base64_encode("1"); // base64 사용시 반드시 모드값을 1로 주셔야 합니다.

	$host_info = explode("/", $sms_url);
	$host = $host_info[2];
	$path = $host_info[3]."/".$host_info[4];
	srand((double)microtime()*1000000);
	$boundary = "---------------------".substr(md5(rand(0,32000)),0,10);

	// 헤더 생성
	$header = "POST /".$path ." HTTP/1.0\r\n";
	$header .= "Host: ".$host."\r\n";
	$header .= "Content-type: multipart/form-data, boundary=".$boundary."\r\n";

	// 본문 생성
	foreach($sms AS $index => $value){
		$data .="--$boundary\r\n";
		$data .= "Content-Disposition: form-data; name=\"".$index."\"\r\n";
		$data .= "\r\n".$value."\r\n";
		$data .="--$boundary\r\n";
	}
	$header .= "Content-length: " . strlen($data) . "\r\n\r\n";

	$fp = fsockopen($host, 80);

	if($fp){
		fputs($fp, $header.$data);
		$rsp = '';
		while(!feof($fp)) {
			$rsp .= fgets($fp,8192);
		}
		fclose($fp);
		$msg = explode("\r\n\r\n",trim($rsp));
		$Count = $msg[1]; //잔여건수
		echo $Count;
	} else{
		echo "Connection Failed";
	}

}

function sms_number(){
	global $config;
	$oCurl = curl_init();
	$url =  "https://sslsms.cafe24.com/smsSenderPhone.php";
	$aPostData['userId'] = $config[cf_sms_id];
	$aPostData['passwd'] = $config[cf_sms_pass];
	curl_setopt($oCurl, CURLOPT_URL, $url);
	curl_setopt($oCurl, CURLOPT_POST, 1);
	curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($oCurl, CURLOPT_POSTFIELDS, $aPostData);
	curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, 0); 
	$ret = curl_exec($oCurl);

	$ret = json_decode($ret);

	$str = "";
	for($i=0; $i<count($ret->list); $i++){
		if($i) $str .= ", ";
		$str .= $ret->list[$i];
	}

	return $str;
	curl_close($oCurl);
}


function sms_send($hps, $callback, $msg, $subject=""){

	global $config;


	$hps = add_hyphen($hps); // 받는 번호
	$call = explode("-",add_hyphen($callback)); // 보내는번호

	$strlen = strlen($msg);
	if($strlen<=80){
		$smsType = "S";
	} else{
		$smsType = "L";		
		if(!$subject) $subject = $config[cf_name];
	}

	$sms_url = "https://sslsms.cafe24.com/sms_sender.php"; // 전송요청 URL
	$sms['user_id'] = base64_encode($config[cf_sms_id]); //SMS 아이디.
	$sms['secure'] = base64_encode($config[cf_sms_pass]) ;//인증키
	$sms['msg'] = base64_encode(stripslashes($msg));
	if( $_POST['smsType'] == "L"){
		  $sms['subject'] =  base64_encode($subject);
	}
	$sms['rphone'] = base64_encode($hps);
	$sms['sphone1'] = base64_encode($call[0]);
	$sms['sphone2'] = base64_encode($call[1]);
	$sms['sphone3'] = base64_encode($call[2]);
	$sms['rdate'] = base64_encode("");
	$sms['rtime'] = base64_encode("");
	$sms['mode'] = base64_encode("1"); // base64 사용시 반드시 모드값을 1로 주셔야 합니다.
	$sms['returnurl'] = base64_encode("");
	$sms['testflag'] = base64_encode("");
	$sms['destination'] = strtr(base64_encode(""), '+/=', '-,');
	$sms['repeatFlag'] = base64_encode("");
	$sms['repeatNum'] = base64_encode("1");
	$sms['repeatTime'] = base64_encode("15");
	$sms['smsType'] = base64_encode($smsType); // LMS일경우 L
	$nointeractive = 1; //사용할 경우 : 1, 성공시 대화상자(alert)를 생략

	$host_info = explode("/", $sms_url);
	$host = $host_info[2];
	$path = $host_info[3]."/".$host_info[4];

	srand((double)microtime()*1000000);
	$boundary = "---------------------".substr(md5(rand(0,32000)),0,10);

	// 헤더 생성
	$header = "POST /".$path ." HTTP/1.0\r\n";
	$header .= "Host: ".$host."\r\n";
	$header .= "Content-type: multipart/form-data, boundary=".$boundary."\r\n";

	// 본문 생성
	foreach($sms AS $index => $value){
		$data .="--$boundary\r\n";
		$data .= "Content-Disposition: form-data; name=\"".$index."\"\r\n";
		$data .= "\r\n".$value."\r\n";
		$data .="--$boundary\r\n";
	}
	$header .= "Content-length: " . strlen($data) . "\r\n\r\n";

	$fp = fsockopen($host, 80);
	if($fp){
		fputs($fp, $header.$data);
		$rsp = '';
		while(!feof($fp)) {
			$rsp .= fgets($fp,8192);
		}
		fclose($fp);
		$msg = explode("\r\n\r\n",trim($rsp));
		$rMsg = explode(",", $msg[1]);
		$Result= $rMsg[0];
		$Count= $rMsg[1];
		if($Result=="success"){
			$alert = "성공";
			$alert .= " 잔여건수는 ".$Count."건 입니다.";
			$success++;
		} else if($Result=="reserved"){
			$alert = "성공적으로 예약되었습니다.";
			$alert .= " 잔여건수는 ".$Count."건 입니다.";
		} else if($Result=="3205"){
			$alert = "잘못된 번호형식입니다.";
		} else if($Result=="0044"){
			$alert = "스팸문자는발송되지 않습니다.";
		} else{
			$alert = "[Error]".$Result;
		}
	} else{
		$alert = "Connection Failed";
	}

	return $success;

}


?>