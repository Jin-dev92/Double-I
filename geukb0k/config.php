<?php	// 환경설정

if(function_exists("date_default_timezone_set")){
	date_default_timezone_set("Asia/Seoul");
}

$nfor[version] = "7.0.7.160701";
$nfor[charset] = "utf-8";
$nfor[ymd] = date("Y-m-d");
$nfor[his] = date("H:i:s");
$nfor[ymdhis] = date("Y-m-d H:i:s");

$nfor[money_ymdhis] = date("Y-m-d",strtotime("+12 month"));


$nfor[cookie_domain] = "";

$nfor[sql_host] = "localhost";
$nfor[sql_user] = "viewline1";
$nfor[sql_password] = "doubleii1!";
$nfor[sql_db] = "viewline1";


$nfor[editor_path] = "$nfor[path]/editor";

$nfor[item_load] = "item.php";


$nfor[https] = "0";


$nfor[load_filename] = "item.php";
$nfor[load] = "$nfor[path]/$nfor[load_filename]";

$nfor[test] = "0";	// 테스트모드 1 / 실모드 0
$nfor[test_password] = "1q2w3e4r"; // 테스트 계정 비밀번호(admin)


$nfor[pg_type] = "daoupay";



$nfor[root_path] = "/home/hosting_users/viewline1/www";
$nfor[pg_path] = $nfor[root_path]."/pg/".$nfor[pg_type];


if($nfor[test]){
	$nfor[pg_id] = "CTS14363";
	$nfor[pg_key] = "nfor1234";
} else{
	$nfor[pg_id] = "CWI17808";
	$nfor[pg_key] = "nfor1234";
}




/*

nfor_order

pay_step
0 - 결제대기
1 - 결제완료
2 - 취소신청
3 - 취소완료
4 - 입금대기
5 - 입금대기취소

delivery_step
0 - 배송대기 1
1 - 배송준비 
2 - 배송완료 1
3 - 반품신청
4 - 반품완료
5 - 주문취소
*/





$nfor[id_type] = "mb_id";	// mb_email, mb_id

$nfor[id_secret] = "1"; // 아이디비공개(상품문의/상품평)



if(substr($HTTP_HOST,0,4)=="www."){
	$nfor[host_domain] = substr($HTTP_HOST,4);
} else{
	$nfor[host_domain] = $HTTP_HOST;
}


$nfor[http_url] = "http://".$HTTP_HOST;



/*
적립금

money_type
0 - 임의입력
1 - 회원가입
2 - 상품구매

4 - 베스트 구매후기작성적립
5 - 구매후기작성적립
6 - 포토 구매후기작성적립

7 - 적립금 상품구매 취소
8 - 적립금 상품구매 부분취소
9 - 추천인입력
10 - 추천받음 

11 - 회원탈퇴 

88 - 이전적립


66 - 커뮤니티

*/



$nfor[admin_tab] = array("","환경설정","상품관리","주문관리","회원/발송관리","사이트관리","통계/데이터");




$nfor[cooperation] = array("티켓상품","배송상품");


$nfor[faq] = array("배송","교환/반품/환불","구매/결제","티켓사용","나의정보관리","포인트/할인쿠폰","모바일/기타");






$nfor[send] = array("전체회원","수신허용회원","구독회원","지역별회원","연령별회원","성별회원");




$nfor[sex] = array("M","F");

$nfor[age] = array("10대","20대","30대","40대","50대","60대");





/*이미지사이즈*/
$nfor[it_img_m1][x] = "";
$nfor[it_img_m1][y] = "";

$nfor[it_img_m2][x] = "";
$nfor[it_img_m2][y] = "";

$nfor[it_img_m3][x] = "";
$nfor[it_img_m3][y] = "";

$nfor[it_img_m4][x] = "";
$nfor[it_img_m4][y] = "";

$nfor[it_img_m5][x] = "";
$nfor[it_img_m5][y] = "";

$nfor[it_img_l][x] = "";
$nfor[it_img_l][y] = "";



$nfor[dy_group] = "1"; // 묶음배송이용하면 1 개별배송은 0


$nfor[skin_path] = $nfor[path]."/skin/demo/";
$nfor[m_skin_path] = $nfor[path]."/skin/m_demo/";


$nfor[admin_path] = $nfor[path]."/admin/";


$nfor[guest] = "0"; // 1비회원 0 회원






$nfor[default_lat] = "37.5325989619262";
$nfor[default_lng] = "126.63399696350098";







$nfor[delivery_step] = "0";
?>