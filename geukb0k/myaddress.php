<?php	// 우편번호 찾기
include "path.php";

if($mode=="delete"){
	sql_query("delete from nfor_myaddress where my_id='$my_id' and mb_no='$member[mb_no]'");
	alert("정상적으로 삭제되었습니다","myaddress.php");
	exit;
}

if($mode=="insert"){

	if($my_basic){
		sql_query("update nfor_myaddress set my_basic='0' where my_basic='1' and mb_no='$member[mb_no]'");
	}

	sql_query("insert nfor_myaddress set my_nick='$my_nick', my_name='$my_name', my_zip1='$my_zip1', my_zip2='$my_zip2', my_addr1='$my_addr1', my_addr2='$my_addr2', my_hp1='$my_hp1', my_hp2='$my_hp2', my_hp3='$my_hp3', my_basic='$my_basic', mb_no='$member[mb_no]'");
	alert("정상적으로 등록되었습니다","myaddress.php");
	exit;
}

if($mode=="update"){

	if($my_basic){
		sql_query("update nfor_myaddress set my_basic='0' where my_basic='1' and mb_no='$member[mb_no]'");
	}

	sql_query("update nfor_myaddress set my_nick='$my_nick', my_name='$my_name', my_zip1='$my_zip1', my_zip2='$my_zip2', my_addr1='$my_addr1', my_addr2='$my_addr2', my_hp1='$my_hp1', my_hp2='$my_hp2', my_hp3='$my_hp3', my_basic='$my_basic' where my_id='$my_id' and mb_no='$member[mb_no]'");
	alert("정상적으로 수정되었습니다","myaddress.php");
	exit;
}

include "html_head.php";

if($my_id){
	$write = sql_fetch("select * from nfor_myaddress where my_id='$my_id'");
}
?>
<script type="text/javascript">
<!--
function myaddress_insert(val1,val2,val3,val4,val5,val6,val7,val8){
	$('#dy_name',window.opener.document).val(val1);
	$('#dy_hp1',window.opener.document).val(val2);
	$('#dy_hp2',window.opener.document).val(val3);
	$('#dy_hp3',window.opener.document).val(val4);
	$('#dy_zip1',window.opener.document).val(val5);
	$('#dy_zip2',window.opener.document).val(val6);
	$('#dy_addr1',window.opener.document).val(val7);
	$('#dy_addr2',window.opener.document).val(val8);
    window.close();
}

function my_address_form(){
	$('#fmyaddress').submit();
}
//-->
</script>
<form id="fmyaddress" method="post" action="myaddress.php">
<input type="hidden" name="mode" value="<?=$write[my_id]?"update":"insert"?>">
<input type="hidden" name="my_id" value="<?=$write[my_id]?>">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td style="height:40px;" bgcolor="#66666">&nbsp;&nbsp;<span style="font-weight:bold; font-size:12px;color:#ffffff;font-family:'trebuchet MS',dotum">| 내주소관리</span></td>
</tr>
<tr>
	<td>
	<table width="98%" border="0" cellspacing="0" cellpadding="0" style="margin:20px;">
	<tr> 
		<td>	
		<b>자주쓰는 배송주소를 등록 관리합니다.</b><br>
		회원정보와 별도로 배송주소를 등록하여 자유롭게 설정할수 있습니다.
		</td>
	</tr>
	<tr> 
		<td>
		<table cellpadding="0" cellspacing="0" border="0" class="tbl_typeE" style="margin-top:20px;" width="95%">
		<tr>
			<th>배송지 명칭</th>
			<td><input type="text" name="my_nick" id="my_nick" value="<?=$write[my_nick]?>" style="border: 1px solid #CECECE; color: #333333; height: 12px; padding: 3px 0px 4px 6px; vertical-align: middle;"> <input type="checkbox" name="my_basic" value="1"> 기본배송지로 설정</td>
		</tr>
		<tr>
			<th>수령인</th>
			<td><input type="text" name="my_name" id="my_name" value="<?=$write[my_name]?>" style="border: 1px solid #CECECE; color: #333333; height: 12px; padding: 3px 0px 4px 6px; vertical-align: middle;"></td>
		</tr>
		<tr>
			<th>배송받을주소</th>
			<td><input type="text" name="my_zip1" id="my_zip1" maxlength="4" class="zipcode" value="<?=$write[my_zip1]?>" style="border: 1px solid #CECECE; color: #333333; height: 12px; padding: 3px 0px 4px 6px; vertical-align: middle;"> -
						<input type="text" name="my_zip2" id="my_zip2" maxlength="4" class="zipcode" value="<?=$write[my_zip2]?>" style="border: 1px solid #CECECE; color: #333333; height: 12px; padding: 3px 0px 4px 6px; vertical-align: middle;"> <a href="javascript:zipcode('fmyaddress','my_zip1','my_zip2','my_addr1','my_addr2')"><img src="img/zipcode_btn.gif" align="absmiddle"></a><br>
						<input type="text" name="my_addr1" id="my_addr1" class="address" value="<?=$write[my_addr1]?>" style="border: 1px solid #CECECE; color: #333333; height: 12px; padding: 3px 0px 4px 6px; vertical-align: middle;"><br>
						<input type="text" name="my_addr2" id="my_addr2" class="address" value="<?=$write[my_addr2]?>" style="border: 1px solid #CECECE; color: #333333; height: 12px; padding: 3px 0px 4px 6px; vertical-align: middle;"></td>
		</tr>
		<tr>
			<th>연락처</th>
			<td><input type="text" name="my_hp1" id="my_hp1" maxlength="4" class="phone" value="<?=$write[my_hp1]?>" class="input" style="border: 1px solid #CECECE; color: #333333; height: 12px; padding: 3px 0px 4px 6px; vertical-align: middle;"> - <input type="text" name="my_hp2" id="my_hp2" maxlength="4" class="phone" value="<?=$write[my_hp2]?>" class="input" style="border: 1px solid #CECECE; color: #333333; height: 12px; padding: 3px 0px 4px 6px; vertical-align: middle;"> - <input type="text" name="my_hp3" id="my_hp3" maxlength="4" class="phone" value="<?=$write[my_hp3]?>" class="input" style="border: 1px solid #CECECE; color: #333333; height: 12px; padding: 3px 0px 4px 6px; vertical-align: middle;"></td>
		</tr>
		</table>
		
		</td>
	</tr>
	<tr>
		<td align="center" style="height:50px;"><a href="javascript:my_address_form();" class="btn_big"><span >저장</span></a>&nbsp;<a href="<?=$write[my_id]?"myaddress.php":"javascript:window.close();"?>" class="btn_big"><span >취소</span></a></td>
	</tr>
	</table>




		<table cellpadding="0" cellspacing="0" border="0" class="tbl_typeP" style="margin-top:20px;" width="95%" align="center">
		<tr>
			<th>배송지 명칭</th>
			<th>수령인</th>
			<th>전화번호</th>
			<th>배송받을주소</th>
			<th>수정</th>
			<th>삭제</th>
		</tr>
		<?
		$que = sql_query("select * from nfor_myaddress where mb_no='$member[mb_no]' order by my_basic desc, my_id desc ");
		while($data = sql_fetch_array($que)){
		?>
		<tr>
			<td><?=$data[my_nick]?><? if($data[my_basic]){ ?><br><b style="font-family:돋움; font-size:11px;">[기본배송지]</b><? } ?></td>
			<td><a href="javascript:myaddress_insert('<?=$data[my_name]?>','<?=$data[my_hp1]?>','<?=$data[my_hp2]?>','<?=$data[my_hp3]?>','<?=$data[my_zip1]?>', '<?=$data[my_zip2]?>', '<?=$data[my_addr1]?>', '<?=$data[my_addr2]?>');"><?=$data[my_name]?></a></td>
			<td><a href="javascript:myaddress_insert('<?=$data[my_name]?>','<?=$data[my_hp1]?>','<?=$data[my_hp2]?>','<?=$data[my_hp3]?>','<?=$data[my_zip1]?>', '<?=$data[my_zip2]?>', '<?=$data[my_addr1]?>', '<?=$data[my_addr2]?>');"><?=$data[my_hp1]?>-<?=$data[my_hp2]?>-<?=$data[my_hp3]?></a></td>
			<td><a href="javascript:myaddress_insert('<?=$data[my_name]?>','<?=$data[my_hp1]?>','<?=$data[my_hp2]?>','<?=$data[my_hp3]?>','<?=$data[my_zip1]?>', '<?=$data[my_zip2]?>', '<?=$data[my_addr1]?>', '<?=$data[my_addr2]?>');"><?=$data[my_zip1]?>-<?=$data[my_zip2]?> <?=$data[my_addr1]?> <?=$data[my_addr2]?></a></td>
			<td><a href="myaddress.php?my_id=<?=$data[my_id]?>">[수정]</a></td>
			<td><a href="myaddress.php?mode=delete&my_id=<?=$data[my_id]?>" >[삭제]</a></td>
		</tr>
		<? } ?>
		</table>


	</td>
</tr>
</table>
</form>
<?
include "html_tail.php";
?>