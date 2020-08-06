<style>
	.delete_btn { background-color: #AA0010; width: 150px;
    border-radius: 5px; color: #fff; padding: 10px 0px; margin-top: 20px; border: none; text-align: center; cursor: pointer; margin: 5px;}
</style>
<div>

	<div class="selfie_contents_img_wrap">
		<img src="/data/file/selfie_kor/<?=$selfie_data['img'][0]['bf_file']?>" alt="" style="width: 100%;">


	</div>
	<p class="name_age_wrap">
		<span class="selfie_name"><?=$selfie_data[0]['wr_1']?></span><span class="selfie_age">&nbsp;/&nbsp;<?=$selfie_data[0]['wr_2']?>세</span>
		
		
		<br>
		<span class="s_part">
		수술부위 : 
		<?
			$strTok =explode(',' , $selfie_data[0]['wr_subject']);
			for($i=0; $i<count($strTok); $i++){
				echo '#'.$strTok[$i].' ';
			}
		?>
		</span>
	</p>

	<hr style="width: 90%; margin: 0 auto;">
	<div class="selfie_contents_wrap">
		<p>
			<?=$selfie_data[0]['wr_content']?>
		</p>
	</div>
</div>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script>
	$('.del_check').click(function() {
		if(!confirm("정말로 삭제하시겠습니까?")) {
			event.preventDefault();
	    }
	});
	$('.modi_check').click(function() {
		if(!confirm("정말로 수정하시겠습니까?")) {
			event.preventDefault();
	    }
	});
</script>