<?php	// 찜하기
include_once $nfor[skin_path]."mypage_head.php";
?>


<div class="zzim_list">

	<table cellpadding="0" cellspacing="0" border="0" class="zzim_tbl">
		<colgroup>
			<col  width="80"></col>
			<col width="120"></col>
			<col ></col>
			<col width="120"></col>
			<col width="120"></col>
			<col width="120"></col>
		</colgroup>
	<tr>
		<th>번호</th>
		<th>상품이미지</th>
		<th>상품정보</th>
		<th>상품가격</th>
		<th>찜한날짜</th>
		<th>관리</th>
	</tr>
	<?
	for($i=0; $row=sql_fetch_array($result); $i++){
		$item = sql_fetch("select * from nfor_item where it_id='$row[it_id]'");

		$row[num] = $total_count - ($page - 1) * $rows - $i;
		$row[url] = "item.php?it_id=$row[it_id]";
	?>
	<tr>
		<td><?=$row[num]?></td>
		<td>
			<a href="<?=$row[url]?>"><img src="<?="$nfor[path]/data/list/$item[it_img_l]"?>" width="100" height="100"></a>
		</td>
		<td class="deal_info">
			<a href="<?=$row[url]?>"><?=$item[it_name]?></a><br>
			<?=$item[it_description]?>
		</td>
		<td>
			<!--<s><?=number_format($item[it_price1])?>원</s><br> -->
			<em><?=number_format($item[it_price2])?>원</em>
		</td>
		<td><?=substr($row[wr_datetime],0,10)?></td>
		<td class="care">			
			<a href="<?=$row[url]?>" class="zzim_buybtn">구매하기</a>
			<a href="javascript:del('zzim_list.php?mode=delete&wr_id=<?=$row[wr_id]?>')" class="zzim_delbtn">삭제</a>
		</td>
	</tr>
	<? 
	} 
	$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?page=");			
	?>
	</table>

	<div style="margin:0 auto; text-align:center; padding:10px;"><?=$pagelist?></div>

</div>


<?php
include_once $nfor[skin_path]."mypage_tail.php";
?>