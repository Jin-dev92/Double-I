<?php	// 네이버 지식쇼핑
include "path.php";

sql_query("update nfor_member set admin_memo='$admin_memo', admin_memo_datetime='$nfor[ymdhis]' where mb_no='$member[mb_no]'");

die($nfor[ymdhis]);

?>