<?php	// 로그인 체크
include "path.php";

$mb_id = $_POST[mb_id];
$mb_password = $_POST[mb_password];

if (!trim($mb_id) || !trim($mb_password)) alert("회원 아이디나 패스워드가 공백이면 안됩니다");

$mb = member($nfor[id_type],$mb_id);

if(!$mb[mb_no] || (sql_password($mb_password) != $mb[mb_password])){
	//alert("가입된 회원이 아니거나 패스워드가 틀립니다\\n\\n패스워드는 대소문자를 구분합니다");
}

if($mb[mb_access]){
	alert("접근이 금지된 아이디입니다");
}

if($mb[mb_leavedatetime] && $mb[mb_leavedatetime] <= $nfor[ymdhis]){
    alert("탈퇴한 아이디로 접근하실수 없습니다");
}

$_SESSION[ss_mb_no] = $mb[mb_no];

if($auto_login){
    $key = md5($_SERVER[SERVER_ADDR].$_SERVER[REMOTE_ADDR].$_SERVER[HTTP_USER_AGENT].$mb[mb_password]);
    set_cookie('ck_mb_no', $mb[mb_no], 86400 * 31);
    set_cookie('ck_auto', $key, 86400 * 31);
} else {
    set_cookie('ck_mb_no', '', 0);
    set_cookie('ck_auto', '', 0);
}

if($save_id) { 
    set_cookie('chk_save_id', $mb_id, time()+2592000); 
}else{ 
    set_cookie('chk_save_id', '', 0); 
} 

if($url){
    $link = urldecode($url);

    if (preg_match("/\?/", $link)){
        $split= "&"; 
    } else{
        $split= "?"; 
	}

    foreach($_POST as $key=>$value){
        if($key != "mb_id" && $key != "mb_password" && $key != "x" && $key != "y" && $key != "url" && $key != "mode"){
            $link .= "$split$key=$value";
            $split = "&";
        }
    }
} else{
    $link = $nfor[path];
}

goto_url($link);
?>