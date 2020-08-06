<?php	// 부분취소
include "path.php";

$_POST[req_tx] = "mod";
$_POST[tno] = $tid;	// KCP 거래번호

if($od_id){

	$order = sql_fetch("select * from nfor_order where od_id='$od_id'");
	$delivery_chk = sql_fetch("select * from nfor_cart where cart_id='$order[cart_id]' and (delivery_step='2' or delivery_step='3')");
	if($delivery_chk[cart_id]){
		alert("배송된 상품이 존재하여 취소가 불가능합니다\\n반품 처리후 진행해주세요");
	}

	$cancel_chk = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$order[cart_id]' and pay_step='3'");
	if($cancel_chk[cnt]){
		alert("이미 부분취소된 상품이 존재하여 취소가 불가능합니다\\n개별주문관리를 통해서 취소를 진행해주세요");
	}

	if($order[payment_type]=="iche" and $order[iche_price] >= 50000){
		$_POST[mod_type] = "STE2";	// STSC 취소
	} else{
		$_POST[mod_type] = "STSC";	// STSC 취소
	}

	$_POST[mod_desc] = "관리자취소";

} else{



	$ct = sql_fetch("select * from nfor_cart where ct_id='$ct_id'");

	if($ct[delivery_step]=="2" or $ct[delivery_step]=="3"){
		alert("배송된 상품이 존재하여 취소가 불가능합니다\\n반품 처리후 진행해주세요");
	}

	$order = sql_fetch("select * from nfor_order where cart_id='$ct[cart_id]'");

	if($order[payment_type]=="card"){
		$_POST[mod_type] = "RN07";	// RN07 신용카드 부분취소 요청, STPA 계좌이체 부분취소 요청
	} else{
		$_POST[mod_type] = "STPA";	// RN07 신용카드 부분취소 요청, STPA 계좌이체 부분취소 요청
	}


	$_POST[mod_mny] = return_price($ct[ct_id])-return_money($ct[ct_id]); // 취소 요청 금액

	$pg_cancel_price_s = sql_fetch("select sum(pg_cancel_price) as pg_cancel_price_s from nfor_cart where cart_id='$order[cart_id]'");
	$_POST[rem_mny] = $order[pg_price] - $pg_cancel_price_s[pg_cancel_price_s];	// 남은 PG 취소금액(취소가능금액)

	$_POST[mod_desc] = $ct[cancel_why]; // 변경사유

	if(!$_POST[mod_mny]){
		goto_url("order_cart_cancelrequest_list.php?mode=cancel&ct_id=$ct[ct_id]");
	}

}

    /* ============================================================================== */
    /* = 라이브러리 및 사이트 정보 include                                          = */
    /* = -------------------------------------------------------------------------- = */
    require $nfor[pg_path]."/pp_cli_hub_lib_cancel.php";
    include $nfor[pg_path]."/cfg/site_conf_inc.php";
    /* ============================================================================== */
    $g_conf_pa_url   = $g_conf_gw_url;
    $g_conf_pa_port  = $g_conf_gw_port;
    /* ============================================================================== */



    /* ============================================================================== */
    /* =   01. 취소 요청 정보 설정                                                  = */
    /* = -------------------------------------------------------------------------- = */
    $req_tx           = $_POST[ "req_tx"     ];                    // 요청 종류
    $cust_ip          = getenv( "REMOTE_ADDR" );                   // 요청 IP
    $mod_type         = $_POST[ "mod_type"   ];                    // 변경 요청 종류
    /* = -------------------------------------------------------------------------- = */
    $res_cd           = "";                                        // 결과코드
    $res_msg          = "";                                        // 결과메시지
    $tno              = "";                                        // 거래번호
    /* = -------------------------------------------------------------------------- = */
    $tx_cd            = "";                                        // 트랜잭션 코드
    /* = -------------------------------------------------------------------------- = */
    $amount           = "";                                        // 원 거래금액
    $mod_mny          = "";                                        // 취소요청금액
    $rem_mny          = "";                                        // 취소가능잔액
    /* ============================================================================== */


    /* ============================================================================== */
    /* =   02. 인스턴스 생성 및 초기화                                              = */
    /* = -------------------------------------------------------------------------- = */
    $c_PayPlus  = new C_PAYPLUS_CLI;
    $c_PayPlus->mf_clear();
    /* ============================================================================== */


    /* ============================================================================== */
    /* =   03. 처리 요청 정보 설정, 실행                                            = */
    /* = -------------------------------------------------------------------------- = */

    /* = -------------------------------------------------------------------------- = */
    /* =   03-1. 취소 요청                                                          = */
    /* = -------------------------------------------------------------------------- = */
        if ( $req_tx == "mod" )
        {
            $tx_cd = "00200000";

            $c_PayPlus->mf_set_modx_data( "tno",      $_POST[ "tno" ]      ); // KCP 원거래 거래번호
            $c_PayPlus->mf_set_modx_data( "mod_type", $mod_type            ); // 원거래 변경 요청 종류
            $c_PayPlus->mf_set_modx_data( "mod_ip",   $cust_ip             ); // 변경 요청자 IP
            $c_PayPlus->mf_set_modx_data( "mod_desc", $_POST[ "mod_desc" ] ); // 변경 사유

            if ( $mod_type == "RN07" or $mod_type == "STPA" ) // 부분취소의 경우
            {
				if($mod_type == "RN07"){
					$c_PayPlus->mf_set_modx_data( "mod_mny", $_POST[ "mod_mny" ] ); // 취소요청금액
                } else{
					$c_PayPlus->mf_set_modx_data( "amount",  $_POST[ "mod_mny" ] ); // 취소요청금액
				}
				$c_PayPlus->mf_set_modx_data( "rem_mny", $_POST[ "rem_mny" ] ); // 취소가능잔액
            }
        }

    /* ============================================================================== */
    /* =   03-2. 실행                                                               = */
    /* ------------------------------------------------------------------------------ */
        if ( strlen($tx_cd) > 0 )
        {
            $c_PayPlus->mf_do_tx( "",                $g_conf_home_dir, $g_conf_site_cd,
                                  $g_conf_site_key,  $tx_cd,           "",
                                  $g_conf_pa_url,    $g_conf_pa_port,  "payplus_cli_slib",
                                  "",                $cust_ip,         "3",
                                  "",                0 );
        }
        else
        {
            $c_PayPlus->m_res_cd  = "9562";
            $c_PayPlus->m_res_msg = "연동 오류";
        }
        $res_cd  = $c_PayPlus->m_res_cd;                      // 결과 코드
        $res_msg = $c_PayPlus->m_res_msg;                     // 결과 메시지
    /* ============================================================================== */


    /* ============================================================================== */
    /* =   04. 취소 결과 처리                                                       = */
    /* = -------------------------------------------------------------------------- = */
        if ( $req_tx == "mod" )
        {
            if ( $res_cd == "0000" )
            {
                $tno = $c_PayPlus->mf_get_res_data( "tno" );  // KCP 거래 고유 번호

    /* = -------------------------------------------------------------------------- = */
    /* =   04-1. 부분취소 결과 처리                                                 = */
    /* = -------------------------------------------------------------------------- = */
                if ( $mod_type == "RN07" or $mod_type == "STPA" ) // 부분취소의 경우
                {
                    $amount  = $c_PayPlus->mf_get_res_data( "amount"       ); // 원 거래금액
                    $mod_mny = $c_PayPlus->mf_get_res_data( "panc_mod_mny" ); // 취소요청된 금액
                    $rem_mny = $c_PayPlus->mf_get_res_data( "panc_rem_mny" ); // 취소요청후 잔액
					$cancel_price = return_price($ct_id);
					$pg_cancel_price = $mod_mny;

					sql_query("update nfor_cart set pay_step='3', od_canceldatetime=NOW(), pg_cancel_price='$pg_cancel_price', cancel_price='$cancel_price' where ct_id='$ct_id'");
					$ct = sql_fetch("select * from nfor_cart where ct_id='$ct_id'");
					$total_ct1 = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$ct[cart_id]'");
					$total_ct2 = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$ct[cart_id]' and pay_step='3'");
					if($total_ct1[cnt]==$total_ct2[cnt]){
						sql_query("update nfor_order set pay_step='3', od_canceldatetime=NOW() where cart_id='$ct[cart_id]'");
					}

					$order = sql_fetch("select * from nfor_order where cart_id='$ct[cart_id]'");
					sql_query("update nfor_cart set my_cancel_price='".return_money($ct[ct_id])."' where ct_id='$ct[ct_id]'");
					insert_money($order[mb_no],return_money($ct[ct_id]),"적립금 상품구매 부분취소","8",$order[od_id],$ct[ct_id]); // 부분취소일때 반드시 cancel_price 수정전에 입력되야함

					$cancel_price = $order[cancel_price]+return_price($ct_id);	// 취소된금액 + 지금취소되는금액
					sql_query("update nfor_order set cancel_price='$cancel_price' where cart_id='$ct[cart_id]'");

					alert("주문취소 처리되었습니다","order_cart_cancelrequest_list.php?$qstr");
					
                }


				if($mod_type == "STSC" or $mod_type == "STE2"){
					sql_query("update nfor_order set pay_step='3', od_canceldatetime=NOW(), cancel_price=total_price where od_id='$order[od_id]'");
					sql_query("update nfor_cart set pay_step='3', od_canceldatetime=NOW() where cart_id='$order[cart_id]' and pay_step='2'");
					if($order[money_price]){
						insert_money($order[mb_no],$order[money_price],"적립금 상품구매 취소","7",$order[od_id]);
					}
					nfor_send("cancel",$order[mb_email],$order[mb_hp],$order[mb_no],$order[od_id]);
					alert("주문취소 처리되었습니다","order_cancelrequest_list.php?$qstr");
				}



				

				

            } // End of [res_cd = "0000"]

    /* = -------------------------------------------------------------------------- = */
    /* =   04-2. 취소 실패 결과 처리                                                = */
    /* = -------------------------------------------------------------------------- = */
            else
            {
            }
        } // End of Process


    /* ============================================================================== */
    /* =   05. 폼 구성 및 결과페이지 호출                                           = */
    /* ============================================================================== */



if($mod_type == "STSC" or $mod_type == "STE2"){

	alert("다음 사유로 취소가 불가합니다".iconv("euc-kr","utf-8",$res_msg).$res_cd,"order_cancelrequest_list.php");

} else{

	if($res_cd == "8742"){
		alert("에스크로는 부분취소가 불가합니다","order_cart_cancelrequest_list.php");
	} else{
		alert("다음 사유로 취소가 불가합니다".iconv("euc-kr","utf-8",$res_msg).$res_cd,"order_cart_cancelrequest_list.php");
	}

}

?>
    <html>
    <head>
    <script>
        function goResult()
        {
            document.pay_info.submit();
        }
    </script>
    </head>
    <body onload="goResult()">
    <form name="pay_info" method="post" action="../pg/kcp/sample/result.php">
        <input type="hidden" name="req_tx"            value="<?=$req_tx?>">            <!-- 요청 구분 -->
        <input type="hidden" name="mod_type"          value="<?=$mod_type?>">          <!-- 변경 요청 구분 -->

        <input type="hidden" name="res_cd"            value="<?=$res_cd?>">            <!-- 결과 코드 -->
        <input type="hidden" name="res_msg"           value="<?=$res_msg?>">           <!-- 결과 메세지 -->
        <input type="hidden" name="tno"               value="<?=$tno?>">               <!-- KCP 거래번호 -->

        <input type="hidden" name="amount"            value="<?=$amount?>">            <!-- 원 거래금액 -->
        <input type="hidden" name="mod_mny"           value="<?=$mod_mny?>">           <!-- 취소요청된 금액 -->
        <input type="hidden" name="rem_mny"           value="<?=$rem_mny?>">           <!-- 취소요청후 잔액 -->
    </form>
    </body>
    </html>