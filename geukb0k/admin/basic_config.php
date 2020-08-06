<?php // 기본설정
include "path.php";

if($mode=="update"){
	
	$add_sql = "";
	
	// 파비콘 업로드
	if($cf_favicon = file_upload($nfor[path]."/data/favicon/", $_FILES["cf_favicon"])) $add_sql .= " , cf_favicon='$cf_favicon' ";
	if($cf_favicon_del){
		@unlink($nfor[path]."/data/favicon/".$config[cf_favicon]);
		sql_query("update nfor_config set cf_favicon=''");
	}
	// 로고 업로드
	if($cf_logo = file_upload($nfor[path]."/data/logo/", $_FILES["cf_logo"])) $add_sql .= " , cf_logo='$cf_logo' ";
	if($cf_logo_del){
		@unlink($nfor[path]."/data/logo/".$config[cf_logo]);
		sql_query("update nfor_config set cf_logo=''");
	}

	// 배경 업로드
	if($cf_app_img = file_upload($nfor[path]."/data/app/", $_FILES["cf_app_img"])) $add_sql .= " , cf_app_img='$cf_app_img' ";
	if($cf_app_img_del){
		@unlink($nfor[path]."/data/app/".$config[cf_app_img]);
		sql_query("update nfor_config set cf_app_img=''");
	}

	sql_query("update nfor_config set cf_visit='$cf_visit',cf_bstar_type='$cf_bstar_type', cf_bstar_per='$cf_bstar_per', cf_bstar_won='$cf_bstar_won', cf_star_type='$cf_star_type', cf_star_per='$cf_star_per', cf_star_won='$cf_star_won', cf_pstar_type='$cf_pstar_type', cf_pstar_per='$cf_pstar_per', cf_pstar_won='$cf_pstar_won', cf_kd_keyword='$cf_kd_keyword', cf_kd_it_name='$cf_kd_it_name', cf_kd_it_description='$cf_kd_it_description', cf_guest_customer='$cf_guest_customer', cf_money_min='$cf_money_min',cf_keyword_type='$cf_keyword_type',cf_vbanking_limit='$cf_vbanking_limit', cf_banking_limit='$cf_banking_limit', cf_keyword_hour='$cf_keyword_hour',cf_page_rows='$cf_page_rows',cf_cp_privacy_email='$cf_cp_privacy_email', cf_cp_privacy='$cf_cp_privacy', cf_name_eng='$cf_name_eng',cf_app_use='$cf_app_use',cf_top_mode='$cf_top_mode',cf_friend_money1='$cf_friend_money1',cf_friend_money2='$cf_friend_money2',cf_join_money='$cf_join_money',cf_best='$cf_best', cf_guest='$cf_guest', cf_kcp_cd='$cf_kcp_cd', cf_kcp_key='$cf_kcp_key', cf_cp_number1='$cf_cp_number1', cf_cp_number2='$cf_cp_number2', cf_cp_name='$cf_cp_name',  cf_cp_ceo='$cf_cp_ceo',  cf_cp_address='$cf_cp_address',  cf_cp_type1='$cf_cp_type1',  cf_cp_type2='$cf_cp_type2', cf_meta='$cf_meta',cf_name='$cf_name', cf_money='$cf_money', cf_change='$cf_change', cf_url='$cf_url', cf_email='$cf_email', cf_tel='$cf_tel',  cf_title='$cf_title', cf_cancle_day='$cf_cancle_day', cf_google_analytics='$cf_google_analytics',cf_pg_card='$cf_pg_card', cf_pg_iche='$cf_pg_iche', cf_ios_url='$cf_ios_url', cf_android_url='$cf_android_url' $add_sql ");
	
	alert("정상적으로 수정되었습니다","basic_config.php");
	exit;
}

include "head.php";
?>
<form name="fwrite" method="post" action="basic_config.php" enctype="multipart/form-data">
<input type="hidden" name="mode" value="update">


<div class="s_title"><img src="img/dot.gif" align="absmiddle"><span class="tex02">환경설정</span></div>

<table class="tbl_type" border="1" cellspacing="0">
<colgroup>
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th scope="row">상점명</th>
	<td><input type="text" class="input_txt" name="cf_name" value="<?=$config[cf_name]?>" style="width:200px;" required itemname="상점명"> <span class="tex01">&nbsp;문자메시지연동등 환경변수로 사용됩니다. 예) 엔포</span></td>
</tr>
<tr>
	<th scope="row">상점명(영문)</th>
	<td><input type="text" class="input_txt" name="cf_name_eng" value="<?=$config[cf_name_eng]?>" style="width:200px;" required itemname="상점명(영문)"> <span class="tex01">&nbsp;결제연동 전송등 환경변수로 사용됩니다. 예) nfor</span></td>
</tr>

<tr>
	<th scope="row">대표도메인</th>
	<td><input type="text" class="input_txt" name="cf_url" value="<?=$config[cf_url]?>" size="40" required itemname="상점url"><span class="tex01">&nbsp;사이트 대표도메인을 설정합니다. 예) http://nfor.net</span></td>
</tr>
<tr>
	<th scope="row">대표이메일</th>
	<td><input type="text" class="input_txt" name="cf_email" value="<?=$config[cf_email]?>" size="30" required itemname="대표이메일"> <span class="tex01">&nbsp;이메일발송에 따른 대표 이메일을 설정합니다. 예) nfor@nate.com</span></td>
</tr>
<tr>
	<th scope="row">대표전화</th>
	<td align="bottom"><input type="text" class="input_txt" name="cf_tel" value="<?=$config[cf_tel]?>" required itemname="대표전화"> <span class="tex01">&nbsp;티켓발송에 따른 대표 전화번호를 설정합니다. 예) 010-8782-9630</span></td>
</tr>
<tr>
	<th scope="row">웹브라우져 타이틀</th>
	<td><input type="text" class="input_txt" name="cf_title" value="<?=$config[cf_title]?>" size="50" required itemname="웹브라우져 타이틀"><span class="tex01">&nbsp;웹브라우져의 타이틀을 변경합니다. 예) 엔포</span></td>
</tr>
<tr>
	<th scope="row">즐겨찾기 아이콘</th>
	<td>
	<input type="file" name="cf_favicon" class="input_txt">
	<? if($config[cf_favicon]){ ?><input type="checkbox" name="cf_favicon_del" value="1"><img src="<?=$nfor[path]?>/data/favicon/<?=$config[cf_favicon]?>" height="19"><? } ?>
	</td>
</tr>
<tr>
	<th scope="row">메타태그</th>
	<td><textarea name="cf_meta" rows="4"  class="input_tatare" itemname="메타태그"><?=$config[cf_meta]?></textarea></td>
</tr>
<tr>
	<th scope="row">주문취소버튼활성</th>
	<td>결제일로 부터 <input type="text" class="input_txt" name="cf_cancle_day" value="<?=$config[cf_cancle_day]?>" size="3" required itemname="환불기간">일 까지 주문취소버튼을 활성화<span class="tex01">&nbsp; 공정거래위원회, 결제일로 부터 7일까지 환불 가능</span></td>
</tr>
<tr>
	<th scope="row">한줄당표시할목록수</th>
	<td><input type="text" class="input_txt" name="cf_page_rows" value="<?=$config[cf_page_rows]?$config[cf_page_rows]:"15"?>" size="3" required itemname="환불기간"></td>
</tr>
<tr style="display:none;">
	<th scope="row">비회원구매</th>
	<td><input type="checkbox" name="cf_guest" value="1" <?=$config[cf_guest]?"checked":""?>> 체크시 비회원구매가 가능하도록 설정</td>
</tr>
<tr>
	<th scope="row">비회원문의</th>
	<td><input type="checkbox" name="cf_guest_customer" value="1" <?=$config[cf_guest_customer]?"checked":""?>> 체크시 1:1문의에 비회원 작성 허용</td>
</tr>
</table>












<div class="s_title"><img src="img/dot.gif" align="absmiddle"><span class="tex02">인기검색어 설정</span></div>

<table class="tbl_type" border="1" cellspacing="0">
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th scope="row">운영형태</th>
	<td>	
	<input type="radio" name="cf_keyword_type" id="cf_keyword_type0" value="0" <?=$config[cf_keyword_type]=="0"?"checked":""?>> <label for="cf_keyword_type0">실제 검색데이터 기준으로 출력</label>
	<input type="radio" name="cf_keyword_type" id="cf_keyword_type1" value="1" <?=$config[cf_keyword_type]=="1"?"checked":""?>> <label for="cf_keyword_type1">관리자입력 기준으로 출력</label>
	<input type="radio" name="cf_keyword_type" id="cf_keyword_type2" value="2" <?=$config[cf_keyword_type]=="2"?"checked":""?>> <label for="cf_keyword_type2">실제 검색데이터 + 관리자입력 혼용출력</label>
	</td>
</tr>
<tr>
	<th scope="row">이전순위 기준시간</th>
	<td>
	<input type="text" style="width:50px;" class="input_txt" name="cf_keyword_hour" value="<?=$config[cf_keyword_hour]?>" itemname="기준시간">시간
	</td>
</tr>
<tr>
	<th scope="row">자동완성 조회DB</th>
	<td>
	<input type="checkbox" name="cf_kd_keyword" id="cf_kd_keyword" value="1" <?=$config[cf_kd_keyword]?"checked":""?>> <label for="cf_kd_keyword">키워드</label>
	<input type="checkbox" name="cf_kd_it_name" id="cf_kd_it_name" value="1" <?=$config[cf_kd_it_name]?"checked":""?>> <label for="cf_kd_it_name">상품명</label>
	<input type="checkbox" name="cf_kd_it_description" id="cf_kd_it_description" value="1" <?=$config[cf_kd_it_description]?"checked":""?>> <label for="cf_kd_it_description">상품설명</label>
	</td>
</tr>
</table>












<div class="s_title"><img src="img/dot.gif" align="absmiddle"><span class="tex02">입금기한 설정</span></div>

<table class="tbl_type" border="1" cellspacing="0">
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th scope="row">가상계좌 기한</th>
	<td>	
	주문시 가상계좌 기한을 주문일로부터 <input type="text" style="width:30px;" class="input_txt" name="cf_vbanking_limit" value="<?=$config[cf_vbanking_limit]?>" itemname="가상계좌 기한">일까지로 설정
	</td>
</tr>
<tr>
	<th scope="row">무통장입금 기한</th>
	<td>
	주문시 무통장입금 기한을 주문일로부터 <input type="text" style="width:30px;" class="input_txt" name="cf_banking_limit" value="<?=$config[cf_banking_limit]?>" itemname="무통장입금 기한">일까지 선택 가능 하도록 설정
	</td>
</tr>
</table>











<div class="s_title"><img src="img/dot.gif" align="absmiddle"><span class="tex02">적립금 설정</span></div>

<table class="tbl_type" border="1" cellspacing="0">
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th scope="row">적립금 사용제한</th>
	<td>
	적립금이 <input type="text" class="input_txt" name="cf_money" value="<?=$config[cf_money]?>" size="11" required numeric itemname="적립금 결제기준금액"><span class="tex02"> <b>원</b></span>
	이상 모였을 경우에만 사용가능 하도록 설정
	</td>
</tr>


<tr>
	<th scope="row">적립금 주문제한</th>
	<td>주문금액이 <input type="text" class="input_txt" name="cf_money_min" value="<?=$config[cf_money_min]?>" size="11" required numeric itemname="적립금 사용제한"><span class="tex02"> <b>원</b></span> 이상인 경우에만 사용가능 하도록 설정</td>
</tr>


<tr>
	<th scope="row">회원가입시 적립금</th>
	<td><input type="text" class="input_txt" name="cf_join_money" value="<?=$config[cf_join_money]?>" size="11" required numeric itemname="회원가입시 적립금"><span class="tex02"> <b>원</b></span>
	<span class="tex01">&nbsp;회원가입시 적립금을 부여합니다. 예) 1000</span>
	</td>
</tr>
<tr>
	<th scope="row">추천인입력시 적립금</th>
	<td>
	<input type="text" class="input_txt" name="cf_friend_money1" value="<?=$config[cf_friend_money1]?>" size="11" numeric itemname="추천인입력시 적립금"><span class="tex02"> <b>원</b></span>
	<span class="tex01">&nbsp;추천인 아이디를 입력한 사람에게 적립될 적립금을 입력합니다. 예) 1000 </span>
	</td>
</tr>
<tr>
	<th scope="row">추천받는분의 적립금</th>
	<td>
	<input type="text" class="input_txt" name="cf_friend_money2" value="<?=$config[cf_friend_money2]?>" size="11" numeric itemname="추천받는분의 적립금"><span class="tex02"> <b>원</b></span>
	<span class="tex01">&nbsp;추천받는 분에게 적립될 적립금을 입력합니다. 예) 1000 </span>
	</td>
</tr>
<tr>
	<th scope="row">구매후기 적립금</th>
	<td>

		<input type="radio" name="cf_star_type" value="1" onclick="$('#cf_star_per_div').show(); $('#cf_star_won_div').hide();" <? if($config[cf_star_type]=="1" or !$config[cf_star_type]) echo "checked"; ?>>주문합산 퍼센트 %
		<input type="radio" name="cf_star_type" value="2" onclick="$('#cf_star_per_div').hide(); $('#cf_star_won_div').show();" <? if($config[cf_star_type]=="2") echo "checked"; ?>>임의지정금액

		<span class="tex01">&nbsp;구매후기를 작성하시는 분에게 적립될 적립금을 입력합니다. 예) 10 </span>

		<div id="cf_star_per_div" <? if($config[cf_star_type]=="2") echo " style='display:none;'"; ?>>
		<input type="text" class="input_txt" name="cf_star_per" id="cf_star_per" value="<?=$config[cf_star_per]?>" style="width:30px;" numeric itemname="적립금(퍼센트)">%
		</div>
		
		<div id="cf_star_won_div" <? if($config[cf_star_type]=="1" or !$config[cf_star_type]) echo " style='display:none;'"; ?>>
		<input type="text" class="input_txt" name="cf_star_won" id="cf_star_won" value="<?=$config[cf_star_won]?>" style="width:90px;" numeric itemname="적립금(원)">원
		</div>

	</td>
</tr>
<tr style="display:none;">
	<th scope="row">포토 구매후기 적립금</th>
	<td> 

		<input type="radio" name="cf_pstar_type" value="1" onclick="$('#cf_pstar_per_div').show(); $('#cf_pstar_won_div').hide();" <? if($config[cf_pstar_type]=="1" or !$config[cf_pstar_type]) echo "checked"; ?>>주문합산 퍼센트 %
		<input type="radio" name="cf_pstar_type" value="2" onclick="$('#cf_pstar_per_div').hide(); $('#cf_pstar_won_div').show();" <? if($config[cf_pstar_type]=="2") echo "checked"; ?>>임의지정금액

		<span class="tex01">&nbsp;포토 구매후기를 작성하시는 분에게 적립될 적립금을 입력합니다. 예) 10 </span>

		<div id="cf_pstar_per_div" <? if($config[cf_pstar_type]=="2") echo " style='display:none;'"; ?>>
		<input type="text" class="input_txt" name="cf_pstar_per" id="cf_pstar_per" value="<?=$config[cf_pstar_per]?>" style="width:30px;" numeric itemname="적립금(퍼센트)">%
		</div>
		
		<div id="cf_pstar_won_div" <? if($config[cf_pstar_type]=="1" or !$config[cf_pstar_type]) echo " style='display:none;'"; ?>>
		<input type="text" class="input_txt" name="cf_pstar_won" id="cf_pstar_won" value="<?=$config[cf_pstar_won]?>" style="width:90px;" numeric itemname="적립금(원)">원
		</div>

	</td>
</tr>


<tr>
	<th scope="row">베스트후기 적립금</th>
	<td>

		<input type="radio" name="cf_bstar_type" value="1" onclick="$('#cf_bstar_per_div').show(); $('#cf_bstar_won_div').hide();" <? if($config[cf_bstar_type]=="1" or !$config[cf_bstar_type]) echo "checked"; ?>>주문합산 퍼센트 %
		<input type="radio" name="cf_bstar_type" value="2" onclick="$('#cf_bstar_per_div').hide(); $('#cf_bstar_won_div').show();" <? if($config[cf_bstar_type]=="2") echo "checked"; ?>>임의지정금액

		<span class="tex01">&nbsp;베스트 구매후기를 작성하시는 분에게 적립될 적립금을 입력합니다. 예) 10 </span>

		<div id="cf_bstar_per_div" <? if($config[cf_bstar_type]=="2") echo " style='display:none;'"; ?>>
		<input type="text" class="input_txt" name="cf_bstar_per" id="cf_bstar_per" value="<?=$config[cf_bstar_per]?>" style="width:30px;" numeric itemname="적립금(퍼센트)">%
		</div>
		
		<div id="cf_bstar_won_div" <? if($config[cf_bstar_type]=="1" or !$config[cf_bstar_type]) echo " style='display:none;'"; ?>>
		<input type="text" class="input_txt" name="cf_bstar_won" id="cf_bstar_won" value="<?=$config[cf_bstar_won]?>" style="width:90px;" numeric itemname="적립금(원)">원
		</div>

	</td>
</tr>
</table>




<div class="s_title"><img src="img/dot.gif" align="absmiddle"><span class="tex02">카드사 수수료설정</span></div>

<table class="tbl_type" border="1" cellspacing="0">
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th scope="row">신용카드</th>
	<td align="bottom"><input type="text" size="3" class="input_txt" name="cf_pg_card" value="<?=$config[cf_pg_card]?>" itemname="kcp site code">% <span class="tex01">&nbsp;통계/데이터 > 매출분석에서 사용됩니다.</span></td>
</tr>
<tr>
	<th scope="row">계좌이체</th>
	<td align="bottom"><input type="text" size="3" class="input_txt" name="cf_pg_iche" value="<?=$config[cf_pg_iche]?>" itemname="kcp site key">%</td>
</tr>
</table>












<div class="s_title"><img src="img/dot.gif" align="absmiddle"><span class="tex02">상점정보</span></div>

<table class="tbl_type" border="1" cellspacing="0">
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th scope="row">사업자등록번호</th>
	<td><input type="text" class="input_txt" name="cf_cp_number1" value="<?=$config[cf_cp_number1]?>" size="20"> <span class="tex01">&nbsp;웹사이트, 모바일웹 카피라이트 및 기타 제공되는 정보에 공통으로 활용됩니다.</span></td>
</tr>
<tr>
	<th scope="row">통신판매번호</th>
	<td><input type="text" class="input_txt" name="cf_cp_number2" value="<?=$config[cf_cp_number2]?>" size="30"></td>
</tr>
<tr>
	<th scope="row">상호명(법인명)</th>
	<td><input type="text" class="input_txt" name="cf_cp_name" value="<?=$config[cf_cp_name]?>" size="30"></td>
</tr>
<tr>
	<th scope="row">대표자명</th>
	<td><input type="text" class="input_txt" name="cf_cp_ceo" value="<?=$config[cf_cp_ceo]?>" size="20"></td>
</tr>
<tr>
	<th scope="row">사업장소재지</th>
	<td><input type="text" class="input_txt" name="cf_cp_address" value="<?=$config[cf_cp_address]?>" size="70"></td>
</tr>
<tr>
	<th scope="row">업태</th>
	<td><input type="text" class="input_txt" name="cf_cp_type1" value="<?=$config[cf_cp_type1]?>" size="30"></td>
</tr>
<tr>
	<th scope="row">종목</th>
	<td><input type="text" class="input_txt" name="cf_cp_type2" value="<?=$config[cf_cp_type2]?>" size="30"></td>
</tr>
<tr>
	<th scope="row">개인정보보호책임자</th>
	<td><input type="text" class="input_txt" name="cf_cp_privacy" value="<?=$config[cf_cp_privacy]?>" size="20"></td>
</tr>
<tr>
	<th scope="row">개인정보보호책임자이메일</th>
	<td><input type="text" class="input_txt" name="cf_cp_privacy_email" value="<?=$config[cf_cp_privacy_email]?>" size="20"></td>
</tr>
</table>

<div class="s_title"><img src="img/dot.gif" align="absmiddle"><span class="tex02">해드</span></div>

<table class="tbl_type" border="1" cellspacing="0">
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th scope="row">스크립트</th>
	<td align="bottom">
	<a href="http://www.google.com/intl/ko_ALL/analytics/" target="_blank" class="btn_sml"><span>구글 Analytics 코드 발급받기</span></a>
	<span class="tex01"> HTML의 HEAD영역에 들어갈 스크립트 소스 이외에 절대 다른 소스가 삽입되어서는 안됩니다</span>
	<textarea name="cf_google_analytics" rows="5"  class="input_tatare" itemname="발급코드"><?=$config[cf_google_analytics]?></textarea>
	</td>
</tr>
</table>

<div class="btn_cen"><input type="image" src="img/con_btn.gif"></div>

</form>
<?php
include "tail.php";
?>