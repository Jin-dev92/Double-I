<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
//include_once(G5_PATH.'/_head.php');
if(($bo_table == "online_kor") || ($bo_table == "qna_kor") || ($bo_table == "star_kor") || ($bo_table == "notice_kor") || ($bo_table == "filler_review_kor") || ($bo_table == "event_kor") || ($bo_table == "filler_lab_kor")) {
	include_once(G5_THEME_MOBILE_PATH.'/include/sub_head.php');
} else if(($bo_table == "online_eng") || ($bo_table == "qna_eng") || ($bo_table == "star_eng") || ($bo_table == "notice_eng") || ($bo_table == "filler_review_eng") || ($bo_table == "event_eng") || ($bo_table == "filler_lab_eng")) {
	include_once(G5_THEME_MOBILE_PATH.'/eng/include/sub_head.php');
} else if(($bo_table == "online_chn") || ($bo_table == "qna_chn") || ($bo_table == "star_chn") || ($bo_table == "notice_chn") || ($bo_table == "filler_review_chn") || ($bo_table == "event_chn") || ($bo_table == "filler_lab_chn")) {
	include_once(G5_THEME_MOBILE_PATH.'/chn/include/sub_head.php');
}
?>