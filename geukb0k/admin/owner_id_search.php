<?
include "path.php";

if($mode=="insert"){

	$keyword = $_POST[keyword];

	if($keyword){

		echo "<table border='1' cellspacing='0' class='tbl_typeB'>
			  <tr>
				  <th scope='col'>업체명</th>
				  <th scope='col'>담당자명</th>
				  <th scope='col'>연락처</th>
			  </tr>";
		$que = sql_query("select * from nfor_member where is_supply='1' and mb_level>1 and (mb_id like '%$keyword%' or supply_name like '%$keyword%' or mb_name like '%$keyword%' or mb_id = '$mb_id')");
		while($data = sql_fetch_array($que)){
			$data[supply_name] = $data[supply_name];
			$data[mb_name] = $data[mb_name];
			$data[mb_tel] = $data[mb_tel];

			$data[mb_addr] = $data[mb_addr1]." ".$data[mb_addr2];


			echo "<tr>
					<td><a href=\"javascript:supply_id_insert('$data[mb_id]','$data[mb_addr]')\">$data[supply_name]</a></td>
					<td><a href=\"javascript:supply_id_insert('$data[mb_id]','$data[mb_addr]')\">$data[mb_name]</a></td>
					<td><a href=\"javascript:supply_id_insert('$data[mb_id]','$data[mb_addr]')\">$data[mb_tel]</a></td>
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
	<a href="javascript:supply_id_search_div()"><img src="img/jo_btn.gif" alt="조회하기" valign="absmiddle"></a>
	</td>
</tr>
</table>
<br>
<div id="supply_id_div" style="width:100%; height:300px; overflow-x:hidden; overflow-y:scroll;"></div>
