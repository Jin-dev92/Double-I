<?php	// 옵션
include_once "path.php";

$item = sql_fetch("select * from nfor_item where it_id='$it_id'");





if($option_id){
	$add_sql = "";
	$opt = sql_fetch("select * from nfor_item_option where option_id='$option_id'");	
	for($i=1; $i<$depth; $i++){
		$add_sql .= " and option_name{$i} ='".$opt["option_name".$i]."'";
	}
}


$sql = "select * from nfor_item_option where it_id='$it_id' and option_type='0' and option_select='0' "; // 본품=0(option_select)

$sql .= $add_sql;

$sql .= " group by option_name{$depth} order by option_rank asc";


$que = sql_query($sql);
while($data = sql_fetch_array($que)){

	$data[option_name] = $data["option_name".$depth];


	if($item[it_opt_depth]==$depth){ // 마지막옵션선택이면

		$data[b_price] = number_format($data[price])."원";

		$data[it_sales_volume] = $data[stock]-it_sales_volume($it_id,$data[option_id]);
		$data[em_it_sales_volume] = number_format($data[it_sales_volume])."개 남음";

		echo "<li><a class=\"option-price\" href=\"javascript:opt_select('$depth','$data[option_id]','$data[option_name]','$data[it_sales_volume]','$data[price]')\"><span>$data[option_name]</span> <em>| $data[em_it_sales_volume]</em> <b>$data[b_price]</b></a></li>";
	} else{
		echo "<li><a class=\"option-price\" href=\"javascript:opt_select('$depth','$data[option_id]','$data[option_name]')\"><span>$data[option_name]</span></a></li>";
	}


}

?>