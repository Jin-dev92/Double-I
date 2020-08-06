<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function get_rand(){
    return rand(0, 999999);
}
function headerdataload($asd){
  switch ($asd) {
    case 'filler':
    $header_data['title'] = array('FACE');
    $header_data['submenu']=array('페이스 필러'=>'/filler/Facefiler',
                                  '미스코'=>'/filler/Misco',
                                  '하이눈'=>'/filler/Hinoon');
      break;

      case 'body':
      $header_data['title'] = array('BODY');
      $header_data['submenu']=array('바디필러'=>'/body',
                                    'Fat Control'=>'/body/Fatcontrol');
      // $header_data['suburl']=array('#','#');
        break;

        case 'lifting':
          $header_data['title'] = array('LIFTING');
          $header_data['submenu']=array('복합 리프팅'=>'/lifting',
                                        '포니테일 리프팅' =>'/lifting/Ponytail',
                                        '뉴테라 리프팅' =>'/lifting/Newthera');
          // $header_data['suburl']=array('#','#','#');
          break;

          case 'skin':
          $header_data['title'] = array('SKIN');
          $header_data['submenu']=array('화이트닝'=>'/skin',
                                        '여드름'=>'/skin/Pimple',
                                        '보습'=>'/skin/Aqua');
          break;

          case 'special':
          $header_data['title'] = array('SPECIAL');
          $header_data['submenu']=array('T.O.Fill'=>'/special/tof',
                                        '파워업 윤곽주사'=>'/special/Powerup');
          // $header_data['suburl']=array('#','#');
          break;

          case 'au':
          $header_data['title'] = array('About Us');
          $header_data['submenu']=array(
            '비오페이스 소개'=>'/au',
            '온라인상담'=>'/board/lists/online_kor/1',
            '이벤트'=>'/board/lists/event_kor/1',
            '후기 리뷰'=>'/board/lists/filler_review_kor/1');
          // $header_data['suburl']=array('#','#');
          break;
          default:
          $header_data['title'] = array('');
          $header_data['submenu']=array('FACE'=>'/filler',
                                        'BODY' =>'/body',
                                        'LIFTING' =>'/lifting',
                                        'SKIN' =>'/skin',
                                        'SPECIAL' => '/special',
                                        'ABOUT US'=>'/board/lists/online_kor/1');
          // $header_data['suburl']=array('#','#','#');
          break;
  }
  return $header_data;
}

//상단
function setData_top($category, $subcategory, $use_menu2 = true){
    $CI = & get_instance();

    $data_top['title'] = ($use_menu2 == true)?$CI->lang->line("menu_".$category."_".$subcategory):$CI->lang->line("menu_".$category);
    $data_top['menu1'] = $CI->lang->line("menu_".$category);
    $data_top['menu2'] = ($use_menu2 == true)?$CI->lang->line("menu_".$category."_".$subcategory):"";
    $data_top['menu1_link'] = "/".$category;
    $data_top['menu2_link'] = ($use_menu2 == true)?"/".$category."/".$subcategory:"";

    return $data_top;
}

//이메일 보내기
function Send_email($to, $subject, $msg) {
	$CI = & get_instance();

	$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'tls://email-smtp.us-east-1.amazonaws.com',
			'smtp_port' => 465,
			'smtp_user' => 'AKIAJWRYXIL3RFVPUYOQ',
			'smtp_pass' => 'AjvCCp5/Hj70TE1FzhzaUBYhHWpwddJL/nvoXwGjYVtB',
			'mailtype'  => 'html',
			'charset'   => 'utf-8'
	);
	$CI->load->library('email');
	$CI->email->initialize($config);
	$CI->email->set_newline("\r\n");

	$CI->email->from('administrator@theline.awsapps.com','Theline PS');
	$CI->email->to($to);
	$CI->email->subject($subject);
	$CI->email->message($msg);
	$CI->email->send();
	return $CI->email->print_debugger();
}

//Sms 보내기
function send_SMS($strToCall, $strMsg){
	$CI = & get_instance();

	$CI->load->library('Sms_class');

	$socket_host	= "121.254.253.172";			// 수정하시 마세요

	$smsi_id = "theline";			// SMS아이 회원가입하신 아이디(4~15자)
	$smsi_pw = "ejfkdls2014";			// 패스워드(8~15자)
	$CI->sms_class->SMS_Con($socket_host, $smsi_id, $smsi_pw);

	$sType = "S";

	$strCallBack = '000-1899-0252';  //회신번호
	$strDate = '';       //예약전송
	$strMsgSub = ''; //mms 시 제목

	$mms_info['mmslist'] = "";

	// 발송하기위해 패킷을 정의합니다.
	$result = $CI->sms_class->Add($sType, $strToCall, $strCallBack, iconv("UTF-8","EUC-KR",$strMsg), $strMsgSub, $strDate, $mms_info['mmslist']);

	if ($result) {

		$result = $CI->sms_class->Send();		// 발송

		if ($result) {

			$success = $fail = 0;

			foreach($CI->sms_class->Result as $result) {

				list($phone,$err_msg) = explode(" : ",$result);
				$err_msg = trim($err_msg);

				if ($err_msg == "SUCC") {

					$success++;

				} else {

					switch ($err_msg) {
						case 'ERR_NoXmsCompany':
							//echo "LMS 발송 권한이 없습니다. 고객센타로 문의해 주시기 바랍니다. (".$err_msg.")<br>";
							break;
						case 'ERR_DelCompany':
							//echo "삭제된 고객사 입니다. 고객센타로 문의해 주시기 바랍니다.(".$err_msg.")<br>";
							break;
						case 'ERR_NoSms_Blocking':
							//echo "수신거부 차단되었습니다.(".$err_msg.")<br>";
							break;
						case 'ERR_NoReq':
							//echo "예약설정이 올바르지 않습니다.(".$err_msg.")<br>";
							break;
						case 'ERR_NotSmsUse':
							//echo "SMS 발송 권한이 없습니다. 고객센타로 문의해 주시기 바랍니다.(".$err_msg.")<br>";
							break;
						case 'ERR_NotMmsUse':
							//echo "LMS 발송 권한이 없습니다. 고객센타로 문의해 주시기 바랍니다.(".$err_msg.")<br>";
							break;
						case 'ERR_NoPoint':
							//echo "충전 포인트가 부족합니다.(".$err_msg.")<br>";
							break;
						case 'Not_Auth':
							//echo "사용자 인증실패하였습니다.(".$err_msg.")<br>";
							break;
						default:
							//echo "알 수 없는 오류로 전송이 실패하였습니다.(".$err_msg.")<br>";
							break;
					}
					$fail++;
				}
			}

			//echo number_format($success)." 건을 전송, ".number_format($fail)." 건 실패.<br>";
			$CI->sms_class->Init();		// 결과값 초기화

		}
		//else echo "<br>에러: SMS 서버와 통신이 불안정합니다.<br>";
	}
	return true;
}

function getReservState($state){
    $CI = & get_instance();

	$strValue = "";
	switch($state){
		case "1": $strValue = "<span style='color:green'>".$CI->lang->line("reservation_view_word5")."</span>";
			break;
		case "2": $strValue = "<span style='color:green'>".$CI->lang->line("change")."</span>";
			break;
		case "3": $strValue = "<span style='color:dodgerblue;'>".$CI->lang->line("confirm")."</span>";
			break;
		case "4": $strValue = "<span style='color:red;'>".$CI->lang->line("cancel")."</span>";
			break;
		case "5": $strValue = "";
			break;
	}
	return $strValue;
}

function getReservState2($state){
    $CI = & get_instance();

	$strValue = "";
	switch($state){
		case "1": $strValue = $CI->lang->line("reservation_view_word5");
			break;
		case "2": $strValue = $CI->lang->line("change");
			break;
		case "3": $strValue = $CI->lang->line("confirm");
			break;
		case "4": $strValue = $CI->lang->line("cancel");
			break;
		case "5": $strValue = "";
			break;
	}
	return $strValue;
}

//url ? 뒤만 찾아서 리턴
function getUrlQueryString($url){
	$q = "";
	if(strpos($url, "?") > -1){
		$q = substr($url, strpos($url, "?"));
	}
	return $q;
}

function loadBaseInfomation(){
	$CI = & get_instance();

	$CI->load->model('Index_m');

	$arrData['consults'] = $CI->Index_m->getLists(5, 1, "consult", "lists");

	$arrData['answerboard'] = $CI->Index_m->getLists(5, "1", "answerboard", "lists");

	return $arrData;
}

function getClinic($clinicFK){
    $CI = & get_instance();

	$value = "";
	switch($clinicFK){
		case "1": $value = $CI->lang->line("menu_eye");
			break;
		case "2": $value = $CI->lang->line("menu_nose");
			break;
		case "3": $value = $CI->lang->line("menu_face");
			break;
		case "4": $value = $CI->lang->line("menu_lift");
			break;
		case "5": $value = $CI->lang->line("menu_breast");
			break;
		case "7": $value = $CI->lang->line("menu_body");
			break;
		case "8": $value = $CI->lang->line("board_lists_sel_clinic7");
			break;
		default :  $value = $CI->lang->line("all");
			break;
	}
	return $value;
}

?>
