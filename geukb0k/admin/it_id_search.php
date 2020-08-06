<?php
include_once "path.php";

if($mode=="insert"){

	$keyword = $_POST[keyword];

	if($keyword){

		echo "<table border='1' cellspacing='0' class='tbl_typeB'>
			  <tr>
				  <th scope='col'>상품명</th>
				  <th scope='col'>판매가격</th>
				  <th scope='col'>판매기간</th>
			  </tr>";
		$que = sql_query("select * from nfor_item where it_name like '%$keyword%'");
		while($data = sql_fetch_array($que)){

			$data[it_name] = addslashes($data[it_name]);
			
			$data[it_price2] = number_format($data[it_price2]);
			echo "<tr>
					<td><a href=\"javascript:it_id_insert('$data[it_id]','$data[it_name]')\">".stripslashes($data[it_name])."</a></td>
					<td><a href=\"javascript:it_id_insert('$data[it_id]','$data[it_name]')\">$data[it_price2]원</a></td>
					<td><a href=\"javascript:it_id_insert('$data[it_id]','$data[it_name]')\">$data[it_paydate]<br>$data[it_payenddate]</a></td>
				  </tr>";
		}

		echo "</table>";

	} 

	exit;
}

?>
<table cellpadding="0" cellspacing="1" border="0" width="100%" align="center">	
<tr>
	<td width="100">
	<input type="text" name="keyword" id="keyword" value="<?=$keyword?>" style="width:100px">
	</td>
	<td>
	<a href="javascript:it_id_search_div()"><img src="img/jo_btn.gif" alt="조회하기" valign="absmiddle"></a>
	</td>
</tr>
</table>
<br>
<div id="it_id_div" style="width:100%; height:300px; overflow-x:hidden; overflow-y:scroll;"></div>