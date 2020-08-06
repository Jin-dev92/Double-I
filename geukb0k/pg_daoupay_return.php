<?
include_once "path.php";

$_SESSION[cart_id] = "";

if($is_mobile){
	goto_url("order_list.php");
} else{
?>
<script type="text/javascript">
<!--
	opener.parent.location='<?="http://".$HTTP_HOST."/order_list.php"?>';
	window.close();

//-->
</script>
<? } ?>