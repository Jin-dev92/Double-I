<?php
//ini_set('display_errors',1);

error_reporting(E_ALL ^ E_NOTICE);

header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"');

if(!isset($set_time_limit)) $set_time_limit = 0;
@set_time_limit($set_time_limit);

if(isset($HTTP_POST_VARS) && !isset($_POST)){
	$_POST   = &$HTTP_POST_VARS;
	$_GET    = &$HTTP_GET_VARS;
	$_SERVER = &$HTTP_SERVER_VARS;
	$_COOKIE = &$HTTP_COOKIE_VARS;
	$_ENV    = &$HTTP_ENV_VARS;
	$_FILES  = &$HTTP_POST_FILES;

    if(!isset($_SESSION)){
		$_SESSION = &$HTTP_SESSION_VARS;
	}
}

if(!get_magic_quotes_gpc()){
	if(is_array($_GET)){
		while(list($k, $v) = each($_GET)){
			if(is_array($_GET[$k])){
				while(list($k2, $v2) = each($_GET[$k])){
					$_GET[$k][$k2] = addslashes($v2);
				}
				@reset($_GET[$k]);
			} else{
				$_GET[$k] = addslashes($v);
			}
		}
		@reset($_GET);
	}

	if(is_array($_POST)){
		while(list($k, $v) = each($_POST)){
			if(is_array($_POST[$k])){
				while(list($k2, $v2) = each($_POST[$k])){
					$_POST[$k][$k2] = addslashes($v2);
				}
				@reset($_POST[$k]);
			} else{
				$_POST[$k] = addslashes($v);
			}
		}
		@reset($_POST);
	}

	if(is_array($_COOKIE)){
		while(list($k, $v) = each($_COOKIE)){
			if(is_array($_COOKIE[$k])){
				while(list($k2, $v2) = each($_COOKIE[$k])){
					$_COOKIE[$k][$k2] = addslashes($v2);
				}
				@reset($_COOKIE[$k]);
			} else{
				$_COOKIE[$k] = addslashes($v);
			}
		}
		@reset($_COOKIE);
	}
}

if($_GET['path'] || $_POST['path'] || $_COOKIE['path']) {
    unset($_GET['path']);
    unset($_POST['path']);
    unset($_COOKIE['path']);
    unset($path);
}

$ext_arr = array('PHP_SELF', '_ENV', '_GET', '_POST', '_FILES', '_SERVER', '_COOKIE', '_SESSION', '_REQUEST', 'HTTP_ENV_VARS', 'HTTP_GET_VARS', 'HTTP_POST_VARS', 'HTTP_POST_FILES', 'HTTP_SERVER_VARS', 'HTTP_COOKIE_VARS', 'HTTP_SESSION_VARS', 'GLOBALS');
$ext_cnt = count($ext_arr);
for($i=0; $i<$ext_cnt; $i++){
    if(isset($_GET[$ext_arr[$i]])) unset($_GET[$ext_arr[$i]]);
}

@extract($_GET);
@extract($_POST);
@extract($_SERVER);

$nfor = array();
$config = array();
$member = array();

if(!$path || preg_match("/:\/\//", $path)) die("path error");

$nfor[path] = $path;

unset($path);

include "$nfor[path]/config.php";
include "$nfor[path]/lib/function.lib.php";

if(!$nfor['url']){
    $nfor['url'] = "http://".$_SERVER['HTTP_HOST'];
    $dir = dirname($HTTP_SERVER_VARS["PHP_SELF"]);
    if(!file_exists("nfor.php"))
        $dir = dirname($dir);
    $cnt = substr_count($nfor[path], "..");
    for ($i=2; $i<=$cnt; $i++)
        $dir = dirname($dir);
    $nfor[url] .= $dir;
}
$nfor[url] = strtr($nfor[url], "\\", "/");
$nfor[url] = preg_replace("/\/$/", "", $nfor[url]);









$connect_db = mysqli_connect($nfor[sql_host], $nfor[sql_user], $nfor[sql_password], $nfor[sql_db]);
if(mysqli_connect_errno()){
    printf("DB 연결 실패: %s\n", mysqli_connect_error());
    exit();
}










ini_set("session.use_trans_sid", 0);
ini_set("url_rewriter.tags","");

//session_set_save_handler("nfor_session_open", "nfor_session_close", "nfor_session_read", "nfor_session_write", "nfor_session_destroy", "nfor_session_clean"); 

if(isset($SESSION_CACHE_LIMITER)){
	@session_cache_limiter($SESSION_CACHE_LIMITER);
} else{
	@session_cache_limiter("no-cache, must-revalidate");
}

$config = sql_fetch("select * from nfor_config");

ini_set("session.cache_expire", 180);
ini_set("session.gc_maxlifetime", 10800);
ini_set("session.gc_probability", 1);
ini_set("session.gc_divisor", 100);

session_set_cookie_params(0, "/");
ini_set("session.cookie_domain", $nfor[cookie_domain]);

@session_start();

if($_REQUEST[PHPSESSID] && $_REQUEST[PHPSESSID] != session_id()) goto_url("$nfor[path]/logout.php");

$qstr = "";
if(isset($sfl)){
    $qstr .= '&sfl='.urlencode($sfl);
}
if(isset($stx)){
    $qstr .= '&stx='.urlencode($stx);
}
if(isset($sst)){
    $qstr .= '&sst='.urlencode($sst);
}

if(isset($sod)){
    $sod = preg_match("/^(asc|desc)$/i", $sod) ? $sod : "";
    $qstr .= '&sod='.urlencode($sod);
}

if(isset($sop)){
    $sop = preg_match("/^(or|and)$/i", $sop) ? $sop : "";
    $qstr .= '&sop=' . urlencode($sop);
}
if(isset($page)){
    $page = (int)$page;
    $qstr .= '&page='.urlencode($page);
}

if(isset($url)){
	$urlencode = urlencode($url);
} else{
    $urlencode = urlencode($_SERVER[REQUEST_URI]);
}


if($_SESSION[ss_mb_no]){

    $member = member("mb_no",$_SESSION[ss_mb_no]);
    if(substr($member[mb_today_login], 0, 10) != $nfor[ymd]){
        sql_query("update nfor_member set mb_today_login=NOW(), mb_login_ip='$_SERVER[REMOTE_ADDR]' where mb_no='$member[mb_no]'");
    }

	if($member[mb_no]=="1") $is_admin = "super";

	$is_member = 1;
	$is_guest = FALSE;

} else{
	$is_member = 0;
	$is_guest = TRUE;
	$member[mb_level] = 1;

}

if(get_cookie('check_count_ip') != $_SERVER[REMOTE_ADDR]){
    set_cookie('check_count_ip', $_SERVER[REMOTE_ADDR], 86400); 
	$result = sql_query(" insert nfor_count set wr_ip='$_SERVER[REMOTE_ADDR]', wr_datetime=NOW(), wr_referer='$_SERVER[HTTP_REFERER]', wr_agent='$_SERVER[HTTP_USER_AGENT]' ", FALSE);
    if($result){

		$rs = sql_query("insert nfor_count_sum set wr_date=NOW(), wr_count='1'", FALSE);
        if(!$rs) sql_query("update nfor_count_sum set wr_count = wr_count + 1 where wr_date = '$nfor[ymd]'");

        $row = sql_fetch("select wr_count as cnt from nfor_count_sum where wr_date = '$nfor[ymd]'");
        $wr_today = $row[cnt];

        $row = sql_fetch("select wr_count as cnt from nfor_count_sum where wr_date = DATE_SUB('$nfor[ymd]', INTERVAL 1 DAY)");
        $wr_yesterday = $row[cnt];

        $row = sql_fetch("select max(wr_count) as cnt from nfor_count_sum");
        $wr_max = $row[cnt];

        $row = sql_fetch("select sum(wr_count) as total from nfor_count_sum");
        $wr_sum = $row[total];

        $cf_count = "오늘:$wr_today,어제:$wr_yesterday,최대:$wr_max,전체:$wr_sum";

        sql_query("update nfor_config set cf_count = '$cf_count'");

    }
}



if(!$_SESSION[cart_id]){
	$micro_exp = explode(" ", microtime());
    $_SESSION[cart_id] = $micro_exp[1].rand("1","9").substr($micro_exp[0],2).rand("1","9").str_number($_SERVER[REMOTE_ADDR]).rand("1","9");
}



require_once "$nfor[path]/lib/sms.lib.php";
require_once "$nfor[path]/lib/mail.lib.php";
include_once "$nfor[path]/lib/thumb.lib.php";
include_once "$nfor[path]/lib/editor.lib.php";


if($_GET[skin] or $_SESSION[skin]){

	if($_GET[skin]){
		$_SESSION[skin] = $_GET[skin];
	}

	$nfor[skin_path] = "$nfor[path]/skin/".$_SESSION[skin]."/";
}

if(mobile_check() == "mobile" or $_SESSION[skin]=="m_demo"){ 
    $nfor[skin_path] = $nfor[m_skin_path];
	$is_mobile = "1";
	$config[cf_write_pages] = "4";
}


if(substr($HTTP_HOST,0,4)=="www."){
	$host_url = substr($HTTP_HOST,4);
} else{
	$host_url = $HTTP_HOST;
}
$api = sql_fetch("select * from nfor_api where wr_domain='$host_url'");













if($bo_table){

	$bo_table = preg_match("/^[a-zA-Z0-9_]+$/", $bo_table) ? $bo_table : "";
	$write_table = "nfor_write_$bo_table";
    $board = sql_fetch(" select * from nfor_board where bo_table = '$bo_table' ");
	//if(!$board[bo_table]) alert("존재하지 않는 게시판입니다");
	if($wr_id){
		$wr_id = (int)$wr_id;
		$write = sql_fetch(" select * from $write_table where wr_id = '$wr_id' ");
	}
	// 스킨경로
	$board_skin_path = "";
	if(isset($board[bo_skin])) $board_skin_path = "{$nfor[path]}/skin/board/{$board[bo_skin]}"; // 게시판 스킨 경로

}


if($is_mobile){ 
	$board[bo_include_head] = $board[bo_include_head_m];
	$board[bo_include_tail] = $board[bo_include_tail_m];
}


define("IMJUNA",TRUE);





?>