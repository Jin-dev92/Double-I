<?php
include_once $nfor[skin_path]."head.php";
?>

<style>
.wrap_customer_form { margin:0px; padding:10px 10px; width:100%; box-sizing:border-box; -webkit-box-sizing:border-box;  }
.wrap_customer_faq { display:none; }
.row_title {  margin-bottom:5px; margin-top:25px;font-size:15px;font-weight:bold;color:#555;}
.row { margin-bottom:5px; }
.col_1of3 { float:left; width:33.333%; }
.col_inner { margin-left:4px; }
</style>



<div class="wrap_customer_form">


	<?
	include_once $nfor[skin_path]."inc_customer.php";
	?>

<form name="fwrite" method="post" onsubmit="return customer_check(this);">
<input type="hidden" name="mode" value="insert">
<?
$que = sql_query("select * from nfor_cart where pay_step>0 and mb_no='$member[mb_no]' group by it_id order by ct_id desc");
if(sql_num_rows($que)){
?>
<div class="row">

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

</div>
<? } ?>
<div class="row">

	<select name="ca_name" class="ca_name" onchange="customer_faq(this.value)">
	<option value="">문의유형
	<?
	for($i=0; $i<count($nfor[faq]); $i++){
	?>	
	<option value="<?=$nfor[faq][$i]?>"><?=$nfor[faq][$i]?>
	<? } ?>
	</select>

</div>
<div class="row wrap_customer_faq">

		<div class="row_title">연관있는 자주묻는질문</div>
		<div class="customer_faq_list"></div>	

</div>
<div class="row_title">
	답변받으실분
</div>
<div class="row">
	<input type="text" name="wr_name" class="wr_name" value="<?=$member[mb_name]?>" placeholder="이름">
</div>
<div class="row">
	<input type="email" name="wr_email" class="wr_email" value="<?=$member[mb_email]?>" placeholder="이메일">
</div>
<div class="row">

	<div class="col">

		<div class="col_1of3"><select name="wr_hp1" class="wr_hp1">
		<? 
		$member[mb_hp] = explode("-",$member[mb_hp]);
		$array_hp1 = array("010","011","016","017","018","019");
		for($i=0; $i<count($array_hp1); $i++){ 
		?>
		<option value="<?=$array_hp1[$i]?>" <?=$array_hp1[$i]==$member[mb_hp][0]?"selected":""?>><?=$array_hp1[$i]?>
		<? } ?>
		</select></div>

		<div class="col_1of3"><div class="col_inner"><input type="tel" name="wr_hp2" class="wr_hp2" value="<?=$member[mb_hp][1]?>" maxlength="4"></div></div>
		<div class="col_1of3"><div class="col_inner"><input type="tel" name="wr_hp3" class="wr_hp3" value="<?=$member[mb_hp][2]?>" maxlength="4"></div></div>
		<div style="clear:both;"></div>
		
	</div>

</div>
<div class="row_title">
	문의하기
</div>
<div class="row">
	<input type="text" name="wr_subject" class="wr_subject" placeholder="제목을 입력해주세요">
</div>
<div class="row">
	<textarea name="wr_memo" class="wr_memo" placeholder="문의 내용을 입력해주세요"></textarea>
</div>
<div class="row">
	<input type="submit" value="문의하기" class="btn_submit">
</div>
</form>


</div>

<?
include_once $nfor[skin_path]."tail.php";
?>