<?php	// 제휴문의
include_once "path.php";

$nfor[title] = "입점문의";

if($mode=="insert"){

	if($wr_upload = file_upload($nfor[path]."/data/cooperation/", $_FILES["wr_upload"])){
		$wr_filename = $_FILES[wr_upload][name];
		$add_sql .= " , wr_upload='$wr_upload', wr_filename='$wr_filename' ";
	}

	$wr_tel = $wr_tel1."-".$wr_tel2."-".$wr_tel3;
	sql_query("insert nfor_cooperation set 
										mb_no='$member[mb_no]',
										ca_name='$ca_name',
										wr_subject='$wr_subject',
										wr_memo='$wr_memo',
										wr_email='$wr_email',
										wr_tel='$wr_tel',
										wr_company='$wr_company',
										wr_homepage='$wr_homepage',
										wr_name='$wr_name',
										wr_datetime=NOW(),
										wr_is_reply='1'
										$add_sql");

	alert("정상적으로 등록되었습니다","cooperation_form.php");
	exit;

}

include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>