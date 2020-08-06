<?php
include_once "path.php";
include_once "head.php";

if(!$wr_date) $wr_date = date("Y-m-d");

$qstr = "wr_date=$wr_date&smsType=$smsType";

$rows = $config[cf_page_rows]; // 한페이지 표시갯수
if(!$page) $page = 1;
$startNo = ($page - 1) * $rows;

$sms_url = "https://sslsms.cafe24.com/sms_list.php"; // 전송요청 URL
$sms['user_id'] = $config[cf_sms_id]; // SMS 아이디
$sms['secure'] = $config[cf_sms_pass];//인증키
$sms['date'] = date("Ymd",strtotime($wr_date)); // 조회 기준일(YYYYMMDD)
$sms['day'] = "1" ;//조회 범위
$sms['startNo'] = $startNo;//조회 시작번호
$sms['displayNo'] = "50" ;//출력 갯수
$sms['sendType'] = "" ;//발송형태
$sms['sendStatus'] = "" ;//발송상태
$sms['receivePhone'] = "" ;//검색할 수신번호
$sms['sendPhone'] = "" ;//검색할 발신번호
$sms['smsType'] = $smsType;// LMS, MMS 조회인경우 lms
                
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

if ($fp) {
    fputs($fp, $header.$data);
    $rsp = '';
    while(!feof($fp)) {
        $rsp .= fgets($fp,8192);
    }
    fclose($fp);
    $msg = explode("\r\n\r\n",trim($rsp));
    $array = xml2array($msg[1]);
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
$(function(){
    $('#wr_date').datepicker({
        showOn: 'button',
		buttonImage: 'img/calendar.gif',
		buttonImageOnly: true,
        buttonText: "달력",
        changeMonth: true,
		changeYear: true,
        showButtonPanel: true,
		dateFormat: 'yy-mm-dd'
    }); 

});	
//-->
</SCRIPT>


<form method="get" action="<?=$PHP_SELF?>">

<select name="smsType">
	<option value="sms" <?=$smsType=="sms"?"selected":""?>>sms
	<option value="lms" <?=$smsType=="lms"?"selected":""?>>lms
</select>

<input type="text" name="wr_date" id="wr_date" value="<?=$wr_date?>">
<input type="image" src="img/jo_btn.gif">
</form>


<table border="1" cellspacing="0" class="tbl_typeB">
<tr>
	<? if($smsType=="lms"){ ?><th>메시지제목</th><? } ?>
	<th>메시지내용</th>
	<th>보낸분</th>
	<th>받은분</th>
	<th>발송시간</th>
	<th>상태</th>
</tr>
<?
if($array[API][totalCnt]=="1"){
	$array[API][data][record][0] = $array[API][data][record];
}

for($i=0; $i<$rows; $i++){
	if($array[API][data][record][$i][receivePhone]){
?>
<tr>
	<? if($smsType=="lms"){ ?><td><?=$array[API][data][record][$i][subject]?></td><? } ?>
	<td><?=$array[API][data][record][$i][msg]?></td>
	<td><?=$array[API][data][record][$i][sendPhone]?></td>
	<td><?=$array[API][data][record][$i][receivePhone]?></td>
	<td><?=$array[API][data][record][$i][sendDateTime]?></td>
	<td><?=sms_status($array[API][data][record][$i][sendStatus])?></td>
</tr>
<?
	}
} 
$total_page  = ceil($array[API][totalCnt] / $rows);
$total_page = $total_page+$page-1;
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<div class="btn_cen"><?=$pagelist?></div>
<?
} else{
    echo "Connection Failed";
}




include_once "tail.php";

?>