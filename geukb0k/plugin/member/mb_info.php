<?php	// 회원정보
include_once "path.php";
?>













		<B>회원정보</B>
		<table cellspacing="0" cellpadding="0" border="0" width="100%" class="order_list_tbl2" align="center">
		<colgroup>
		<col width="120" align="center">
		<col align="left" style="padding: 5px 0 0 10px;">
		<col width="120" align="center">
		<col align="left" style="padding: 5px 0 0 10px;">
		</colgroup>
		<tr>
			<? if($mb[mb_id]){ ?>
			<th>아이디</th>
			<td><?=$mb[mb_id]?></td>
			<? } ?>
			<th>이메일</th>
			<td <? if(!$mb[mb_id]) echo "colspan='3'"; ?>><?=$mb[mb_email]?></td>
		</tr>
		<tr>
			<th>이름</th>
			<td><?=$mb[mb_name]?></td>
			<th>핸드폰</th>
			<td><?=$mb[mb_hp]?></td>
		</tr>
		<tr>
			<th>주소</th>
			<td><?=$mb[mb_zipcode]." ".$mb[mb_addr1]." ".$mb[mb_addr2]?></td>
			<th>적립금</th>
			<td><a href="mb_money.php?mb_no=<?=$mb[mb_no]?>"><?=number_format(mb_money($mb[mb_no]))?>원</a></td>
		</tr>

		<tr>
			<th>성별</th>
			<td><?=$mb[mb_sex]=="M"?"남성":"여성"?></td>

			<th>생년월일</th>
			<td><?=$mb[mb_birth]?></td>
		</tr>

		<tr>
			<th>가입일</th>
			<td><?=$mb[mb_datetime]?></td>

			<th>최근접속일</th>
			<td><?=$mb[mb_today_login]?></td>
		</tr>
		</table>

		<div class="tab2">
		<ul>
		<li <?=basename($_SERVER[PHP_SELF])=="mb_order.php"?"class='on'":""?>>
		<a href="mb_order.php?mb_no=<?=$mb[mb_no]?>">구매내역</a>
		</li>
		<li <?=basename($_SERVER[PHP_SELF])=="mb_money.php"?"class='on'":""?>>
		<a href="mb_money.php?mb_no=<?=$mb[mb_no]?>">적립금내역</a>
		</li>
		<li <?=basename($_SERVER[PHP_SELF])=="mb_count.php"?"class='on'":""?>>
		<a href="mb_count.php?mb_no=<?=$mb[mb_no]?>">유입분석</a>
		</li>
		<li <?=basename($_SERVER[PHP_SELF])=="mb_mail.php"?"class='on'":""?>>
		<a href="mb_mail.php?mb_no=<?=$mb[mb_no]?>">메일전송</a>
		</li>
		<li <?=basename($_SERVER[PHP_SELF])=="mb_sms.php"?"class='on'":""?>>
		<a href="mb_sms.php?mb_no=<?=$mb[mb_no]?>">문자전송</a>
		</li>
		</ul>
		</div>

<br>