<?php
/**
 * Created by PhpStorm.
 * User: theline
 * Date: 2016-11-18
 * Time: 오후 1:54
 */
#########################################
#	SMS 발송 클래스
#########################################

class Sms_class {

    var $Data = array();
    var $Result = array();

    // 접속을 위해 사용하는 변수를 정리한다.
    public function SMS_Con($host, $id, $pw) {
        $this->socket_host	= $host;
        $this->socket_port	= 3453;
        $this->smsi_id = AddSpace($id, 15);
        $this->smsi_pw = md5($pw);
    }

    function Add($sType, $strToCall, $strCallBack, $strMsg, $strMsgSub, $strDate="", $mmslist="") {

        $sType = trim($sType);
        $strToCall = trim($strToCall);
        $strCallBack = preg_replace("/[^0-9]/i","",trim($strCallBack));
        $strDate = preg_replace("/[^0-9]/i","",trim($strDate));
        $strMsg = str_replace("\r\n", "\n", rtrim($strMsg));
        $strMsgSub = trim($strMsgSub);

        if ($sType == 'S') $msgLen = 90;
        else if ($sType == 'L' || $sType == 'M') $msgLen = 2000;
        else { echo "ERROR : \$sType값이 올바르지 않습니다."; return false; }

        $strToCall = explode(";", $strToCall);
        $CallCount = count($strToCall);

        $error_hp = CheckPhone($strToCall, $CallCount);
        if ($error_hp) { echo $error_hp; return false; }
        $error_callback = CheckCallBack($strCallBack);
        if ($error_callback) { echo $error_callback; return false; }
        $error_reqdate = CheckReqDate($strDate);
        if ($error_reqdate) { echo $error_reqdate; return false; }
        if (!$strMsg) { echo "ERROR : 문자내용이 없습니다."; return false; }

        if ($strDate) $strDate = substr($strDate, 0, 4)."-".substr($strDate, 4, 2)."-".substr($strDate, 6, 2)." ".substr($strDate, 8, 2).":".substr($strDate, 10, 2);
        $strCallBack = AddSpace($strCallBack,11);
        $strDate = AddSpace($strDate,16);

        $strMms_Txt = "";
        if ($mmslist) {
            $mmslist_arr = explode(",", $mmslist);
            $strMms_Txt = ($mmslist_arr[0]) ? $mmslist_arr[0] : AddSpace("", 8);
            $strMms_Txt .= ($mmslist_arr[1]) ? $mmslist_arr[1] : AddSpace("", 14);
            $strMms_Txt .= ($mmslist_arr[2]) ? $mmslist_arr[2] : AddSpace("", 14);
        }

        $j = 0;
        for ($i=0; $i<$CallCount; $i++) {
            if ($strToCall[$i]) {
                $strToCall[$i] = AddSpace(preg_replace("/[^0-9]/i","",$strToCall[$i]),11);
                $strMsg = AddSpace(CutChar($strMsg, $msgLen), $msgLen);
                $strMsgSub = AddSpace(CutChar($strMsgSub, 20), 20);
                $this->Data[$j] = $sType.$strToCall[$i].$strCallBack.$strDate.$strMsg.$strMsgSub.$strMms_Txt;
                $j++;
            }
        }
        return true;
    }

    function Send() {
        $fsocket = @fsockopen($this->socket_host,$this->socket_port, $errno, $errstr, 10);
        if (!$fsocket) {
            set_time_limit(30);
            $fsocket = @fsockopen("121.254.253.173", 3453, $errno, $errstr, 30);
            if (!$fsocket) { echo $errstr." (".$errno.")"; return false; }
        }

        fputs($fsocket, "A".$this->smsi_id.$this->smsi_pw);
        $gets = "";
        while(!$gets) $gets = trim(fgets($fsocket,21));

        if ($gets != 'Auth') { echo "ERROR : 서버 로그인 실패하였습니다."; return false; }

        set_time_limit(300);

        $gets = "";
        foreach($this->Data as $puts) {
            $toPhone = trim(substr($puts,1,11));
            fputs($fsocket, $puts);
            while(!$gets) $gets = trim(fgets($fsocket,21));
            $this->Result[] = $toPhone." : ".$gets;
            $gets = "";
        }

        fclose($fsocket);
        $this->Data = "";
        return true;
    }

    function Init() {
        $this->Data = "";
        $this->Result = "";
    }

}

//  문자 공백체우기
function AddSpace($text,$size) {
    for ($i=0; $i<$size; $i++) $text .= " ";
    $text = substr($text,0,$size);
    return $text;
}

// 문자길이 조정
function CutChar($word, $cut) {
    $word = substr($word,0,$cut);						// 필요한 길이만큼 취함.
    for ($k = $cut-1; $k>1; $k--) {
        if (ord(substr($word,$k,1))<128) break;		// 한글값은 160 이상.
    }
    $word = substr($word,0,$cut-($cut-$k+1)%2);
    return $word;
}

// 수신번호 확인
function CheckPhone($strToCall, $CallCount) {
    for ($i=0; $i<$CallCount; $i++) {
        $strToCall[$i] = preg_replace("/[^0-9]/i","",$strToCall[$i]);
        $HP = substr($strToCall[$i],0,3);
        if ( preg_match("/[^0-9]/i", $HP) || ($HP != '010' && $HP != '011' && $HP != '016' && $HP = '017' && $HP != '018' && $HP != '019') || strlen($strToCall[$i]) < 10 || strlen($strToCall[$i]) > 11) return "ERROR : 휴대폰 번호가 올바르지 않습니다.";
    }
}

// 회신번호 확인
function CheckCallBack($strCallBack) {
    if (strlen($strCallBack) < 8 || strlen($strCallBack) > 11 || preg_match("/[^0-9]/i", $strCallBack) || !$strCallBack) return "ERROR : 회신번호가 올바르지 않습니다.";
}

// 예약날짜 확인
function CheckReqDate($strDate) {
    if ($strDate) {
        if (!checkdate(substr($strDate,4,2),substr($strDate,6,2),substr($strDate,0,4))) return "ERROR : 예약날짜가 올바르지 않습니다.";
        if (substr($strDate,8,2) > 23 || substr($strDate,10,2) > 59) return "ERROR : 예약시간이 잘못되었습니다";
    }
}

function get_upload_curl($url, $postdata) {
    $curl = curl_init();
    curl_setopt( $curl, CURLOPT_URL, $url );
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
    $result = curl_exec( $curl );
    curl_close( $curl );
    return $result;
}

function get_mms_upload($id, $pw, $postdata) {
    $info_url = "https://www.smsi.kr/pgxms/mmsupload.do";
    $postdata['userid'] = $id;
    $postdata['userpw'] = md5($pw);
    $result = get_upload_curl($info_url, $postdata);
    parse_str($result);
    $mms_info = array(
        'mmslist' => $mmslist			// 결과코드
    );
    return $mms_info;
}

function GetImage_Size($width_img, $height_img, $imageFile) {
    $size = GetImageSize($imageFile);
    if ($width_img > $size[0] && $height_img > $size[1]) {
        $widthSize = $size[0];
        $heightSize = $size[1];
        $imgSize = array($widthSize, $heightSize);
    } else {
        $width_per =  $size[0] / $width_img;
        $height_per =  $size[1] / $height_img;
        $img_per = ($width_per > $height_per ) ? $width_per : $height_per;
        $widthSize = (int)($size[0] / $img_per );
        $heightSize = (int)($size[1] / $img_per );
        $imgSize = array($widthSize, $heightSize);
    }
    return $imgSize;
}

function CropImgCreate($imgFile) {
    $src = @ImageCreateFromJPEG($imgFile);
    $ImgSize = GetImage_Size(1024, 768, $imgFile);
    $thumb = imageCreate($ImgSize[0],$ImgSize[1]);
    $thumb = imageCreateTrueColor($ImgSize[0],$ImgSize[1]);
    ImageCopyResampled($thumb,$src,0,0,0,0,$ImgSize[0],$ImgSize[1],imageSX($src),imageSY($src));
    imageJPEG($thumb, $imgFile);
    return true;
}
