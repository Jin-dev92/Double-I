<?php	// 검색
include_once "path.php";

$nfor[title] = "검색결과";

if($mode=="keyup"){
	if($config[cf_kd_keyword]){
		$que = sql_query("select wr_keyword from nfor_item_keyword where wr_keyword like '%$keyword%'");
		while($data = sql_fetch_array($que)){
			$return[keyword][] = $data[wr_keyword];
		}
	}
	if($config[cf_kd_it_name]){
		$que = sql_query("select it_name from nfor_item where it_name like '%$keyword%'");
		while($data = sql_fetch_array($que)){
			$return[keyword][] = $data[it_name];
		}
	}
	if($config[cf_kd_it_description]){
		$que = sql_query("select it_description from nfor_item where it_description like '%$keyword%'");
		while($data = sql_fetch_array($que)){
			$return[keyword][] = $data[it_description];
		}
	}
	
		$que = sql_query("select it_description from nfor_member where supply_name like '%$keyword%'");
		while($data = sql_fetch_array($que)){
			$return[keyword][] = $data[supply_name];
		}

	$return[result] = "ok";
	$json = json_encode($return);
	echo $json;
	exit;
}


if($mode=="delete"){
	$cookie_keyword = get_cookie("search_keyword");
	$cookie_keyword_date = get_cookie("search_keyword_date");
	$exp = explode("|",$cookie_keyword);
	$exp_date = explode("|",$cookie_keyword_date);
	$cookie_keyword = "";
	$cookie_keyword_date = "";
	for($i=0; $i<count($exp); $i++){
		if($exp[$i] and $exp[$i] <> $keyword){
			$cookie_keyword .= $exp[$i]."|";
			$cookie_keyword_date .= $exp_date[$i]."|";
		}
	}
	set_cookie("search_keyword", $cookie_keyword, 86400);
	set_cookie("search_keyword_date", $cookie_keyword_date, 86400);
	$return[result] = "ok";
	$json = json_encode($return);
	echo $json;
	exit;
}



if($mode=="delete_all"){
	set_cookie("search_keyword", "", 86400);
	set_cookie("search_keyword_date", "", 86400);
	$return[result] = "ok";
	$json = json_encode($return);
	echo $json;
	exit;
}


if($keyword){
	$cookie_keyword = get_cookie("search_keyword");
	$cookie_keyword_date = get_cookie("search_keyword_date");

	$exp = explode("|",$cookie_keyword);
	$exp_date = explode("|",$cookie_keyword_date);
	$cookie_keyword = "";
	$cookie_keyword_date = "";
	for($i=0; $i<count($exp); $i++){

		if($exp[$i] and $exp[$i] <> $keyword){
			$cookie_keyword .= $exp[$i]."|";
			$cookie_keyword_date .= $exp_date[$i]."|";
		}

	}
	$cookie_keyword .= $keyword."|";
	$cookie_keyword_date .= date("Y-m-d H:i:s")."|";
	set_cookie("search_keyword", $cookie_keyword, 86400);
	set_cookie("search_keyword_date", $cookie_keyword_date, 86400);

	sql_query("insert nfor_search set wr_keyword='$keyword', wr_ip='$REMOTE_ADDR', wr_datetime=NOW(), mb_no='$member[mb_no]'");

	goto_url("search.php?it_keyword=".urlencode($keyword));
	exit;
}

$qstr = "category_id=$category_id";

$sql_common = " from nfor_item ";
$sql_search = " where it_paydate <='$nfor[ymdhis]' and it_payenddate >='$nfor[ymdhis]' ";
if($_GET[category_id]) $sql_search .= " and category_id like '$_GET[category_id]%' ";
if($_GET[area_id]) $sql_search .= " and area_id like '$_GET[area_id]%' ";
if($_GET[it_name]) $sql_search .= " and it_name like '%$_GET[it_name]%' ";
if($_GET[it_keyword]) $sql_search .= " and (it_name like '%$_GET[it_keyword]%' or it_description like '%$_GET[it_keyword]%' or it_description like '%$_GET[it_keyword]%' or it_keyword like '%$_GET[it_keyword]%') ";

if(!$sst){
	$sst = "it_rank";
	$sod = "asc";
}
$sql_order = " order by $sst $sod ";
$sql = " select count(*) as cnt
						$sql_common
						$sql_search
						$sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];
$rows = 200;
$total_page  = ceil($total_count / $rows);
if(!$page) $page = 1;
$from_record = ($page - 1) * $rows;
$sql = " select *
				$sql_common
				$sql_search
				$sql_order
				limit $from_record, $rows ";
$result = sql_query($sql);

include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>
