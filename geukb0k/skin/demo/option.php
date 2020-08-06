<?
include_once "path.php";
$item = sql_fetch("select * from nfor_item where it_id='$it_id'");

if($option_id){
	$add_sql = "";
	$opt = sql_fetch("select * from nfor_item_option where option_id='$option_id'");	
	for($i=1; $i<$depth; $i++){
		$add_sql .= " and option_name{$i} ='".$opt["option_name".$i]."'";
	}
}

$sql = "select * from nfor_item_option where it_id='$it_id' and option_type='0' and option_view='0' and option_select='0' ";
$sql .= $add_sql;
$sql .= " group by option_name{$depth} order by option_rank asc";

$que = sql_query($sql);
while($data = sql_fetch_array($que)){
?>
<li<? if($item[it_opt_depth]==$depth){ ?> id="opt_<?=$data[option_id]?>" <?=option_stock($data[stock],$data[stock_now])?"":"class=\"option_soldout\" "?>data-stock="<?=option_stock($data[stock],$data[stock_now])?>"<? } ?> data-depth="<?=$depth?>" data-option_id="<?=$data[option_id]?>" data-option_name="<?=$data["option_name".$depth]?>" data-price="<?=$data[price]?>" data-basic="1">
	<div><?=option_stock($data[stock],$data[stock_now])?"":"(재고없음) "?><?=$data["option_name".$depth]?></div>
	<? if($item[it_opt_depth]==$depth){ ?><b><?=number_format($data[price])?><span>원</span></b><? } ?>
</li>
<?
}
?>