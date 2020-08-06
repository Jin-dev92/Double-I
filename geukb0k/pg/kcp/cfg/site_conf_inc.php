<?
    $g_conf_home_dir  = $nfor[pg_path];       
    $g_conf_log_path = $nfor[pg_path]."/log";

	if($nfor[test]){
		$g_conf_gw_url    = "testpaygw.kcp.co.kr";
	    $g_conf_js_url    = "http://pay.kcp.co.kr/plugin/payplus_test_un.js";
	    $g_wsdl           = "KCPPaymentService.wsdl";
		$g_conf_site_cd   = "T0000";
		$g_conf_site_key  = "3grptw1.zW0GSo4PQdaGvsF__";
	} else{
		$g_conf_gw_url    = "paygw.kcp.co.kr";
		 $g_conf_js_url    = "http://pay.kcp.co.kr/plugin/payplus_un.js";
	    $g_wsdl           = "real_KCPPaymentService.wsdl";
		$g_conf_site_cd   = $nfor[pg_id];
		$g_conf_site_key  = $nfor[pg_key];
	}

    /* ============================================================================== */
    /* = g_conf_site_name 설정                                                      = */
    /* =----------------------------------------------------------------------------= */
    /* = 사이트명 설정(한글 불가) : 반드시 영문자로 설정하여 주시기 바랍니다.       = */
    /* ============================================================================== */
    $g_conf_site_name = $config[cf_name_eng];

    /* ============================================================================== */
    /* = 지불 데이터 셋업 (변경 불가)                                               = */
    /* ============================================================================== */
    $g_conf_log_level = "3";
    $g_conf_gw_port   = "8090";        // 포트번호(변경불가)
    $module_type      = "01";          // 변경불가
?>
