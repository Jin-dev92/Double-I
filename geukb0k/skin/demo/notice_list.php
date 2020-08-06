<?php
include_once $nfor[skin_path]."cus_head.php";
?>



		<table border="0" cellpadding="0" cellspacing="0" class="common_list_tbl">
		<tr>
			<th>번호</th>
			<th>제목</th>
			<th>등록일</th>
			<th>조회</th>
		</tr>
		<?								
		for($i=0; $row=sql_fetch_array($result); $i++){
			$row[num] = $total_count - ($page - 1) * $rows - $i;
		?>
		<tr>
			<td><?=$row[num]?></td>	
			<td style="text-align:left;"><?=$row[ca_name]?"[".$row[ca_name]."]":""?> <a href="notice_view.php?wr_id=<?=$row[wr_id]?>"><?=cut_str($row[wr_subject],100)?></a></td>
			<td><?=substr($row[wr_datetime],0,10)?></td>
			<td><?=$row[wr_hit]?></td>
		</tr>					
		<? 
		} 
		$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?page=");		
		?>
		</table>
		<div style="margin:0 auto; text-align:center; padding:10px;"><?=$pagelist?></div>



<?
include_once $nfor[skin_path]."cus_tail.php";
?>