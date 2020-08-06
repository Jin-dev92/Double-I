<?php	// 1:1문의
include_once $nfor[skin_path]."mypage_head.php";
?>

		<div class="zzim_list">

			<table cellpadding="0" cellspacing="0" border="0" class="zzim_tbl">
			<tr>
				<th>번호</th>
				<th>문의제목</th>
				<th>등록일</th>
				<th>답변여부</th>
			</tr>
			<?
			for($i=0; $row=sql_fetch_array($result); $i++){
				$row[num] = $total_count - ($page - 1) * $rows - $i;

				if($row[it_id]){ 
					$item = sql_fetch("select it_name from nfor_item where it_id='$row[it_id]'");
					$row[it_name] = $item[it_name];
				}
			?>
			<tr>
				<td><?=$row[num]?></td>
				<td style="text-align:left;"><a href="customer_view.php?wr_id=<?=$row[wr_id]?>"><?=$row[wr_subject]?><p><?=$row[it_name]?$row[it_name]:""?></p></a></td>
				<td><?=date("Y.m.d",strtotime($row[wr_datetime]))?></td>
				<td><?=$row[wr_is_reply]=="2"?"답변완료":"답변대기"?></td>
			</tr>
			<? 
			} 
			$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");			
			?>
			</table>

			<div style="margin:0 auto; text-align:center; padding:10px;"><?=$pagelist?></div>

			<a href="customer_form.php" class="btn_list" style="display: block; width: 161px; height: 46px; background: #383838;  color: #fff; font-weight: normal;border: 0; line-height:46px; margin:20px auto; font-size: 18px; text-align:center;" >문의하기</a>

		</div>

<?php
include_once $nfor[skin_path]."mypage_tail.php";
?>