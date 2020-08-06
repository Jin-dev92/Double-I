<?
include_once "path.php";

if($mode=="category"){

	if(isset($_GET['category_id'])){
		$category_id = $_GET['category_id'];
		$wr_depth = $_GET['depth'];

		$que = sql_query("select * from nfor_item_category where wr_use='1' and wr_depth='$wr_depth' and category_id like '$category_id%' order by wr_rank asc");
		while($opt = sql_fetch_array($que)){
			$data[] = array(
			'category_id' => $opt['category_id'],
			'wr_category' => $opt['wr_category'],
			);
		}

		$reply = array('data' => $data, 'error' => false);
	} else{
		$reply = array('error' => true);
	}

	$json = json_encode($reply);    
	echo $json;
	exit;
}

if($mode=="name_check"){
	echo name_check($mb_name);
	exit;
}

if($mode=="birth_check"){
	echo birth_check($mb_birth);
	exit;
}

if($mode=="sex_check"){
	echo sex_check($mb_sex);
	exit;
}

if($mode=="hp_check"){
	echo hp_check($mb_hp,$mb_no);
	exit;
}

if($mode=="asign_confirm"){
	echo asign_confirm($mb_hp,$asign_number);
	exit;
}

if($mode=="asign_send"){
	echo asign_send($mb_hp, $mb_email);
	exit;
}

if($mode=="id_check"){
	echo id_check($mb_id,$mb_no);
	exit;
}

if($mode=="email_check"){
	echo email_check($mb_email,$mb_no);
	exit;
}

if($mode=="password_check"){
	echo password_check($mb_password);
	exit;
}

if($mode=="password_confirm_check"){
	echo password_confirm_check($mb_password,$mb_password_confirm);
	exit;
}
?>