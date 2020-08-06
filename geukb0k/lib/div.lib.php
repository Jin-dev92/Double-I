<?
function item_div_print($order,$it_id=""){
	global $config, $nfor;
?>

	<? if(basename($_SERVER[PHP_SELF])=="order_list.php" or basename($_SERVER[PHP_SELF])=="cancel_list.php"){ ?>
	<div class="item_head"><?=date("Y.m.d",strtotime($order[od_datetime]))?></div>
	<? } ?>

	<?
	$sql = "select * from nfor_cart where cart_id='$order[cart_id]'";
	if($it_id) $sql .= " and it_id='$it_id'";
	if($type=="delivery"){
		$sql .= " and it_delivery='1'";
	} elseif($type=="ticket"){
		$sql .= " and it_delivery='0'";
	} else{

	}
	$sql .= " group by it_id order by pay_step asc";
	$que = sql_query($sql);	
	while($cart = sql_fetch_array($que)){
		$item = item($cart[it_id]);
	?>
	<div class="item_body">







		<? if(basename($_SERVER[PHP_SELF])=="order_list.php" or basename($_SERVER[PHP_SELF])=="cancel_list.php" or basename($_SERVER[PHP_SELF])=="order_view.php"){ ?>
		<div class="item_title">
			<?=pay_step($cart[pay_step])?>

			<? if(basename($_SERVER[PHP_SELF])=="order_list.php" or basename($_SERVER[PHP_SELF])=="cancel_list.php"){ ?>
			<a href="order_view.php?od_id=<?=$order[od_id]?>" class="order_detail">상세보기</a>
			<? } ?>
		</div>
		<? } ?>
		







		<?
		$que2 = sql_query("select * from nfor_cart where cart_id='$order[cart_id]' and it_id='$cart[it_id]'");	
		while($ct = sql_fetch_array($que2)){

			$option_str = "";
			for($k=1; $k<=4; $k++){
				if($k>1) $option_str .= " ";
				if($ct["option_select".$k]){
					$option_str .= $ct["option_select".$k];
				}
			}
		?>
		<ul class="item_content">
			<li>
				<a href="item.php?it_id=<?=$ct[it_id]?>"><img src="<?=$item[it_img2]?>" class="item_img"></a>
				<div class="item_info_wrap">
					<div class="item_name1"><?=$item[it_name]?></div>
					<div class="item_name2"><?=$option_str?></div>
					<div class="item_name3"><?=number_format($ct[option_price])?>원 / <? if($row[it_delivery]){ ?><?=number_format($ct[option_cnt])?>개<? } else{ ?>구매 : <?=number_format($ct[option_cnt])?>개 / 사용 : <?=number_format($ct[ticket_used])?>개<? } ?></div>


					<?
					if(basename($_SERVER[PHP_SELF])=="order_view.php"){
					?>
					<div>
					티켓번호 : <?=$ct[ticket_number]?$ct[ticket_number]:strtoupper(sql_old_password($ct[ct_id]))?>
					사용기간 : <?=expiry_date($order,$item)?>

					<?=expiry_chk($order,$item)?"":"유효기간만료 티켓소멸"?>
					</div>
					<? } ?>
			
				</div>
			</li>
		</ul>
		<? } ?>




	




		<? if(basename($_SERVER[PHP_SELF])=="order_list.php" or basename($_SERVER[PHP_SELF])=="cancel_list.php" or basename($_SERVER[PHP_SELF])=="order_view.php"){ ?>
		<? if($cart[pay_step]<>"3" and $cart[pay_step]<>"5"){ // 취소가 아닐때만 출력	?>
		<!-- item_tail -->
		<div class="item_tail">
		
			<div class="table spacing10">
			<div class="table-row">
			<? if($cart[it_delivery]){ // 배송상품 ?>
				
				<? if($cart[pay_step]=="4"){ // 입금대기 ?>
				<div class="table-cell"><a href="order_cancel.php?od_id=<?=$order[od_id]?>" class="table-btn">즉시취소</a></div>
				<? } elseif($cart[pay_step]=="1"){ // 결제완료 ?>

						<? if($cart[delivery_step]=="0"){ // 배송대기 ?>
						<div class="table-cell"><a href="order_cancel.php?od_id=<?=$order[od_id]?>&it_id=<?=$cart[it_id]?>" class="table-btn">취소신청</a></div>
						<? } elseif($cart[delivery_step]=="1"){ ?>
						<span style="color:#666; font-size:13px;">공급사에서 주문을 접수하여 배송을 준비중입니다.</span>
						<? } elseif($cart[delivery_step]=="2"){ ?>
						<div class="table-cell"><a href="order_cancel.php?od_id=<?=$order[od_id]?>" class="table-btn">반품신청</a></div>
						<div class="table-cell"><a href="<?=delivery_link($cart[delivery_company],$cart[delivery_number])?>" class="table-btn">배송조회</a></div>							
						<? } else{ ?>

						<? } ?>

				<? } elseif($cart[pay_step]=="2"){ // 취소신청 ?>

						<?
						if($cart[delivery_step]=="3"){
						?>
						<span style="color:#666; font-size:13px;">반품이 접수되어 고객센터에서 상품을 기다리는중입니다.</span>
						<? } elseif($cart[delivery_step]=="4"){ ?>
						<span style="color:#666; font-size:13px;">고객센터에서 반품된 상품을 인수하였습니다.</span>
						<? } else{ ?>
						<span style="color:#666; font-size:13px;">취소가 접수되어 고객센터에서 취소가 진행중입니다.</span>
						<? } ?>

				<? } elseif($cart[pay_step]=="3"){ // 취소완료 ?>

				<? } else{ ?>

				<? } ?>

			<? } else{ // 티켓상품 ?>



					<? if($cart[pay_step]=="4"){ // 입금대기 ?>
					<div class="table-cell"><a href="order_cancel.php?od_id=<?=$order[od_id]?>" class="table-btn">즉시취소</a></div>
					<? } elseif($cart[pay_step]=="1"){ // 결제완료 ?>

						<?
						if(date("Y-m-d") < date("Y-m-d", strtotime(substr($order[od_paydatetime],0,10)."+$config[cf_cancle_day] day"))){	// 결제일로부터 7일까지 환불가능(환경설정 설정기간까지)
						?>
						<div class="table-cell"><a href="order_cancel.php?od_id=<?=$order[od_id]?>&it_id=<?=$cart[it_id]?>" class="table-btn">취소신청</a></div>
						<? } ?>


					<? } else{ ?>

					<? } ?>

				


				<div class="table-cell"><a href="item_location.php?it_id=<?=$item[it_id]?>" class="table-btn">업체정보</a></div>
				<div class="table-cell"><a href="item_notice.php?it_id=<?=$item[it_id]?>" class="table-btn">주의사항</a></div>

				<? if($cart[pay_step]=="1"){ // 결제완료 ?>

					<? if(expiry_chk($order,$item)){ ?><div class="table-cell"><a href="javascript:ticket_send('<?=$order[od_id]?>','<?=$item[it_id]?>')" class="table-btn">티켓발급</a></div><? } ?>

				<? } ?>


			<? } ?>
			</div>
			</div>


		</div>
		<!-- //item_tail -->
		<? } ?>
		<? } ?>








		
	</div>
	<? } ?>
<?
}
?>