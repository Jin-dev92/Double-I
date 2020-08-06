<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가


// SMS 알림
include_once(G5_LIB_PATH.'/icode.sms.lib.php');

$sql = " select cf_phone from sms5_config limit 1 ";
$sms_row = sql_fetch($sql);
$admin_tel = $sms_row['cf_phone'];
$admin_tel = str_replace("-", "", "$admin_tel");


 /*
    // 답변글은 질문 등록자에게 전송
    if($w == 'r') {
		$sms_hp = "$wr_1";
		$sms_hp = str_replace("-", "", "$sms_hp");

        $sms_content = "문의하신 온라인상담에 답변글을 남겼습니다. 감사합니다.";
        $send_number = "01033304271"; // 관리자번호
        $recv_number = "$sms_hp";

        if($recv_number) {
            $SMS = new SMS; // SMS 연결
            $SMS->SMS_con($config['cf_icode_server_ip'], $config['cf_icode_id'], $config['cf_icode_pw'], $config['cf_icode_server_port']);
            $SMS->Add($recv_number, $send_number, $config['cf_icode_id'], iconv("utf-8", "euc-kr", stripslashes($sms_content)), "");
            $SMS->Send();
        }
    }
*/
    //문의글 등록시 관리자에게 전송
    if($bo_table!="after"){
      if($w == '') {
  		$sms_hp = "$wr_1";
  		$sms_hp = str_replace("-", "", "$sms_hp");
          $sms_content = "$wr_name 님이 온라인상담글을 남기셨습니다.";
            $send_number = "$sms_hp";
          $recv_number = "$admin_tel";  // 관리자번호

          if($recv_number) {
              $SMS = new SMS; // SMS 연결
              $SMS->SMS_con($config['cf_icode_server_ip'], $config['cf_icode_id'], $config['cf_icode_pw'], $config['cf_icode_server_port']);
              $SMS->Add($recv_number, $send_number, $config['cf_icode_id'], iconv("utf-8", "euc-kr", stripslashes($sms_content)), "");
              $SMS->Send();

        // alert("$recv_number"."+".$send_number."+".$config['cf_icode_id']."+".$config['cf_icode_pw']."+".$config['cf_icode_server_port']);
        // 01049688838 sir_double doubleii1! 7295
  			alert("문의가 성공적으로 접수되었습니다.\\n\\n빠른시간내에 답변드리겠습니다. 감사합니다.", "./board.php?bo_table=$bo_table&wr_id=$wr_id");
          }
     }
   }else {
     if($w == '') {
     $sms_hp = "$wr_1";
     $sms_hp = str_replace("-", "", "$sms_hp");
         $sms_content = "$wr_name 님이 온라인상담글을 남기셨습니다.";
         $send_number = "$sms_hp";
         $recv_number = "$admin_tel";  // 관리자번호

         if($recv_number) {
             $SMS = new SMS; // SMS 연결
             $SMS->SMS_con($config['cf_icode_server_ip'], $config['cf_icode_id'], $config['cf_icode_pw'], $config['cf_icode_server_port']);
             $SMS->Add($recv_number, $send_number, $config['cf_icode_id'], iconv("utf-8", "euc-kr", stripslashes($sms_content)), "");
             $SMS->Send();

       alert("후기를 남겨주셔서 감사합니다!", "./board.php?bo_table=$bo_table&wr_id=$wr_id");
         }
    }
   }





?>
