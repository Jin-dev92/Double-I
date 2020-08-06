<?php
include_once $nfor[skin_path]."cus_head.php";
?>


	<form name="fwrite" method="post" onsubmit="return customer_check(this);">
	<input type="hidden" name="mode" value="insert">
	<table border="0" cellpadding="0" cellspacing="0" class="common_form_tbl customer_form">
	<?
	$que = sql_query("select * from nfor_cart where pay_step>0 and mb_no='$member[mb_no]' group by it_id order by ct_id desc");
	if(sql_num_rows($que)){
	?>
	<tr>
		<th>주문 상품</th>
		<td>		
			<select name="it_id" class="it_id">
			<option value="">주문 상품 선택
			<?
			while($data = sql_fetch_array($que)){
				$item = sql_fetch("select * from nfor_item where it_id='$data[it_id]'");
				if($item[it_id]){
			?>
			<option value="<?=$item[it_id]?>"><?=$item[it_name]?>
			<? 
				}
			} 
			?>
			</select>
		</td>
	</tr>
	<? } ?>
	<tr>
		<th>문의유형</th>
		<td>		
		<select name="ca_name" class="ca_name" onchange="customer_faq(this.value)">
		<option value="">문의유형
		<?
		for($i=0; $i<count($nfor[faq]); $i++){
		?>	
		<option value="<?=$nfor[faq][$i]?>"><?=$nfor[faq][$i]?>
		<? } ?>
		</select>
		</td>
	</tr>
	<tr class="wrap_customer_faq">
		<th>연관있는 자주묻는질문</th>
		<td>
		<div class="customer_faq_list"></div>	
		</td>
	</tr>
	<tr>
		<th>이름</th>
		<td><input type="text" name="wr_name" class="inp wr_name" value="<?=$member[mb_name]?>"></td>
	</tr>
	<tr>
		<th>이메일</th>
		<td><input type="text" name="wr_email" class="inp wr_email" value="<?=$member[mb_email]?>"></td>
	</tr>
	<tr>
		<th>연락처</th>
		<td>
		<select name="wr_hp1" class="sel wr_hp1">
		<? 
		$mb_hp = explode("-",$member[mb_hp]);
		$member[wr_hp1] = $mb_hp[0];
		$member[wr_hp2] = $mb_hp[1];
		$member[wr_hp3] = $mb_hp[2];
		$array_hp1 = array("010","011","016","017","018","019");
		for($i=0; $i<count($array_hp1); $i++){ 
		?>
		<option value="<?=$array_hp1[$i]?>" <?=$array_hp1[$i]==$member[wr_hp1]?"selected":""?>><?=$array_hp1[$i]?>
		<? } ?>
		</select> -
		<input type="text" name="wr_hp2" class="inp wr_hp2" value="<?=$member[wr_hp2]?>" size="4" maxlength="4"> -
		<input type="text" name="wr_hp3" class="inp wr_hp3" value="<?=$member[wr_hp3]?>" size="4" maxlength="4">
		</td>
	</tr>
	<tr>
		<th>제목</th>
		<td><input type="text" name="wr_subject" class="inp wr_subject"></td>
	</tr>
	<tr>
		<th>내용</th>
		<td><textarea name="wr_memo" class="inp wr_memo" style="height:250px;"></textarea></td>
	</tr>
	</table>
	<div class="bottom_btn">
	<button class="inquiryBtn" type="submit">문의하기</button>
	</div>
	</form>


<?
include_once $nfor[skin_path]."cus_tail.php";
?>