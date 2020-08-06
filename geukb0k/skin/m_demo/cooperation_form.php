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



<form name="fwrite" method="post" onsubmit="return cooperation_check(this);" enctype="multipart/form-data">
<input type="hidden" name="mode" value="insert">
<div class="row">
		<select name="ca_name" class="ca_name">
		<option value="">문의분류
		<?
		for($i=0; $i<count($nfor[cooperation]); $i++){
		?>	
		<option value="<?=$nfor[cooperation][$i]?>"><?=$nfor[cooperation][$i]?>
		<? } ?>
		</select>	
</div>
<div class="row">
	<input type="text" name="wr_company" class="wr_company" placeholder="회사명">
</div>
<div class="row">
	<input type="text" name="wr_homepage" class="wr_homepage" placeholder="홈페이지">
</div>
<div class="row_title">
	답변받으실분
</div>
<div class="row">
	<input type="text" name="wr_name" class="wr_name" value="<?=$member[mb_name]?>" placeholder="담당자명">
</div>

<div class="row">
	<input type="email" name="wr_email" class="wr_email" value="<?=$member[mb_email]?>" placeholder="이메일">
</div>
<div class="row">

	<div class="col">

		<div class="col_1of3"><select name="wr_tel1" class="wr_tel1">
		<? 
		$member[mb_hp] = explode("-",$member[mb_hp]);
		$array_hp1 = array("010","011","016","017","018","019");
		for($i=0; $i<count($array_hp1); $i++){ 
		?>
		<option value="<?=$array_hp1[$i]?>" <?=$array_hp1[$i]==$member[mb_hp][0]?"selected":""?>><?=$array_hp1[$i]?>
		<? } ?>
		</select></div>

		<div class="col_1of3"><div class="col_inner"><input type="tel" name="wr_tel2" class="wr_tel2" value="<?=$member[mb_hp][1]?>" maxlength="4"></div></div>
		<div class="col_1of3"><div class="col_inner"><input type="tel" name="wr_tel3" class="wr_tel3" value="<?=$member[mb_hp][2]?>" maxlength="4"></div></div>
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
	<input type="file" name="wr_upload">
</div>
<div class="row">
	<input type="checkbox" name="agree_chk" id="agree_chk" class="agree_chk" checked="checked"> <label for="agree_chk">개인정보 수집, 이용에 동의합니다</label>
</div>
<div class="row">
	<input type="submit" value="문의하기" class="btn_submit">
</div>
</form>


</div>

<?
include_once $nfor[skin_path]."tail.php";
?>