<?
include "$nfor[pg_path]/cfg/site_conf_inc.php";

$pay_method = "100000000000";
$good_name = cart_it_name($ss_cart_id);

$buyr_name = $member[mb_name];
$buyr_mail = $member[mb_email];
$buyr_tel1 = $member[mb_hp];
$buyr_tel2 = $member[mb_hp];

?>
<script type="text/javascript" src='<?=$g_conf_js_url?>'></script>

    <script type="text/javascript">
        /* 플러그인 설치(확인) */
        StartSmartUpdate();

        /* Payplus Plug-in 실행 */
        function  jsf__pay( form )
        {
            var RetVal = false;

            /* Payplus Plugin 실행 */
            if ( MakePayMessage( form ) == true )
            {
			    //alert("결제 승인 요청 전,\n\n반드시 결제창에서 고객님이 결제 인증 완료 후\n\n리턴 받은 ordr_chk 와 업체 측 주문정보를\n\n다시 한번 검증 후 결제 승인 요청하시기 바랍니다."); //업체 연동 시 필수 확인 사항.
                openwin = window.open( "<?=$nfor[path]?>/pg/kcp/proc_win.html", "proc_win", "width=449, height=209, top=300, left=300" );
                RetVal = true ;
            }
            
            else
            {
                /*  res_cd와 res_msg변수에 해당 오류코드와 오류메시지가 설정됩니다.
                    ex) 고객이 Payplus Plugin에서 취소 버튼 클릭시 res_cd=3001, res_msg=사용자 취소
                    값이 설정됩니다.
                */
                res_cd  = document.order_info.res_cd.value ;
                res_msg = document.order_info.res_msg.value ;

            }

            return RetVal ;
        }

        // Payplus Plug-in 설치 안내 
        function init_pay_button()
        {
            if ((navigator.userAgent.indexOf('MSIE') > 0) || (navigator.userAgent.indexOf('Trident/7.0') > 0))
            {
                try
                {
                    if( document.Payplus.object == null )
                    {
                        document.getElementById("display_setup_message").style.display = "block" ;
                    }
                    else{
                        document.getElementById("display_pay_button").style.display = "block" ;
                    }
                }
                catch (e)
                {
                    document.getElementById("display_setup_message").style.display = "block" ;
                }
            }
            else
            {
                try
                {
                    if( Payplus == null )
                    {
                        document.getElementById("display_setup_message").style.display = "block" ;
                    }
                    else{
                        document.getElementById("display_pay_button").style.display = "block" ;
                    }
                }
                catch (e)
                {
                    document.getElementById("display_setup_message").style.display = "block" ;
                }
            }
        }

        /* onLoad 이벤트 시 Payplus Plug-in이 실행되도록 구성하시려면 다음의 구문을 onLoad 이벤트에 넣어주시기 바랍니다. */
        function onload_pay()
        {
             if( jsf__pay(document.order_info) )
                document.order_info.submit();
        }

		window.onload = function(){
			setTimeout("init_pay_button();",300);
		}

    </script>




<SCRIPT LANGUAGE="JavaScript">
<!--
function cart_payment(){
	if(jsf__pay(document.order_info)){
		$(".payment_form").submit();
	}
}

// 결제타입선택
$(document).on("click",".payment_type",function(){

	var payment_type = $(".payment_type:checked").val();
	var paymethod = "";

	if(payment_type=="card"){
		paymethod = "100000000000";
	} else if(payment_type=="iche"){
		paymethod = "010000000000";
	} else if(payment_type=="vbanking"){
		paymethod = "001000000000";
	} else if(payment_type=="hp"){
		paymethod = "000010000000";
	} else{
		paymethod = "";
	}
	document.order_info.pay_method.value=paymethod;

});

<? if(!$member[mb_no]){ ?>
$(document).on("blur","#od_name",function(){
	$("#sndOrdername").val($(this).val());
});

$(document).on("blur","#od_hp",function(){
	$("#sndMobile").val($(this).val());
});

$(document).on("blur","#od_email",function(){
	$("#sndEmail").val($(this).val());
});
<? } ?>

//-->
</SCRIPT>


<form name="order_info" class="payment_form" method="post" action="./pg_kcp_update.php" >
<input type="hidden" name="ordr_idxx" id="od_id">
<input type="hidden" name="good_mny" id="pay_price">



	<input type="hidden" name="pay_method" value="<?=$pay_method?>">
	<input type="hidden" name="good_name" value="<?=$good_name?>">

	<input type="hidden" name="buyr_name" value="<?=$buyr_name?>">
	<input type="hidden" name="buyr_mail" value="<?=$buyr_mail?>">
	<input type="hidden" name="buyr_tel1" value="<?=$buyr_tel1?>"/>
	<input type="hidden" name="buyr_tel2" value="<?=$buyr_tel2?>"/>





	<!-- Payplus Plug-in 설치 안내 -->
	<div id="display_setup_message" style="display:none">
	<p class="txt">
	결제를 계속 하시려면 상단의 노란색 표시줄을 클릭 하시거나 <a href="http://pay.kcp.co.kr/plugin_new/file/KCPUXWizard.exe"><span>[수동설치]</span></a>를 눌러
	Payplus Plug-in을 설치하시기 바랍니다.
	[수동설치]를 눌러 설치하신 경우 새로고침(F5)키를 눌러 진행하시기 바랍니다.
	</p>
	</div>



	<input type="hidden" name="req_tx"          value="pay" />
	<input type="hidden" name="site_cd"         value="<?=$g_conf_site_cd	?>" />
	<input type="hidden" name="site_name"       value="<?=$g_conf_site_name ?>" />
	<input type="hidden" name="quotaopt"        value="12"/>
	<input type="hidden" name="currency"        value="WON"/>
	<input type="hidden" name="module_type"     value="<?=$module_type ?>"/>

<!--
      ※ 필 수
          필수 항목 : Payplus Plugin에서 값을 설정하는 부분으로 반드시 포함되어야 합니다
          값을 설정하지 마십시오
-->
    <input type="hidden" name="res_cd"          value=""/>
    <input type="hidden" name="res_msg"         value=""/>
    <input type="hidden" name="tno"             value=""/>
    <input type="hidden" name="trace_no"        value=""/>
    <input type="hidden" name="enc_info"        value=""/>
    <input type="hidden" name="enc_data"        value=""/>
    <input type="hidden" name="ret_pay_method"  value=""/>
    <input type="hidden" name="tran_cd"         value=""/>
    <input type="hidden" name="bank_name"       value=""/>
    <input type="hidden" name="bank_issu"       value=""/>
    <input type="hidden" name="use_pay_method"  value=""/>
	
	<!-- 주문정보 검증 관련 정보 : Payplus Plugin 에서 설정하는 정보입니다 -->
	<input type="hidden" name="ordr_chk"        value=""/>

    <!--  현금영수증 관련 정보 : Payplus Plugin 에서 설정하는 정보입니다 -->
    <input type="hidden" name="cash_tsdtime"    value=""/>
    <input type="hidden" name="cash_yn"         value=""/>
    <input type="hidden" name="cash_authno"     value=""/>
    <input type="hidden" name="cash_tr_code"    value=""/>
    <input type="hidden" name="cash_id_info"    value=""/>

    <!-- 2012년 8월 18일 전자상거래법 개정 관련 설정 부분 -->
    <!-- 제공 기간 설정 0:일회성 1:기간설정(ex 1:2012010120120131)  -->
    <input type="hidden" name="good_expr" value="0">

    <!-- 가맹점에서 관리하는 고객 아이디 설정을 해야 합니다.(필수 설정) -->
    <input type="hidden" name="shop_user_id"    value=""/>
    <!-- 복지포인트 결제시 가맹점에 할당되어진 코드 값을 입력해야합니다.(필수 설정) -->
    <input type="hidden" name="pt_memcorp_cd"   value=""/>
<?
    /* = -------------------------------------------------------------------------- = */
    /* =   3. Payplus Plugin 필수 정보 END                                          = */
    /* ============================================================================== */
?>

<?
    /* ============================================================================== */
    /* =   4. 옵션 정보                                                             = */
    /* = -------------------------------------------------------------------------- = */
    /* =   ※ 옵션 - 결제에 필요한 추가 옵션 정보를 입력 및 설정합니다.             = */
    /* = -------------------------------------------------------------------------- = */

    /* 사용카드 설정 여부 파라미터 입니다.(통합결제창 노출 유무)
    <input type="hidden" name="used_card_YN"        value="Y"/> */
    /* 사용카드 설정 파라미터 입니다. (해당 카드만 결제창에 보이게 설정하는 파라미터입니다. used_card_YN 값이 Y일때 적용됩니다.
    /<input type="hidden" name="used_card"        value="CCBC:CCKM:CCSS"/> */

    /* 해외카드 구분하는 파라미터 입니다.(해외비자, 해외마스터, 해외JCB로 구분하여 표시)
    <input type="hidden" name="used_card_CCXX"        value="Y"/> */

    /* 신용카드 결제시 OK캐쉬백 적립 여부를 묻는 창을 설정하는 파라미터 입니다
         포인트 가맹점의 경우에만 창이 보여집니다
        <input type="hidden" name="save_ocb"        value="Y"/> */

    /* 고정 할부 개월 수 선택
        value값을 "7" 로 설정했을 경우 => 카드결제시 결제창에 할부 7개월만 선택가능
    <input type="hidden" name="fix_inst"        value="07"/> */

    /*  무이자 옵션
            ※ 설정할부    (가맹점 관리자 페이지에 설정 된 무이자 설정을 따른다)                             - "" 로 설정
            ※ 일반할부    (KCP 이벤트 이외에 설정 된 모든 무이자 설정을 무시한다)                           - "N" 로 설정
            ※ 무이자 할부 (가맹점 관리자 페이지에 설정 된 무이자 이벤트 중 원하는 무이자 설정을 세팅한다)   - "Y" 로 설정
    <input type="hidden" name="kcp_noint"       value=""/> */

    /*  무이자 설정
            ※ 주의 1 : 할부는 결제금액이 50,000 원 이상일 경우에만 가능
            ※ 주의 2 : 무이자 설정값은 무이자 옵션이 Y일 경우에만 결제 창에 적용
            예) 전 카드 2,3,6개월 무이자(국민,비씨,엘지,삼성,신한,현대,롯데,외환) : ALL-02:03:04
            BC 2,3,6개월, 국민 3,6개월, 삼성 6,9개월 무이자 : CCBC-02:03:06,CCKM-03:06,CCSS-03:06:04
    <input type="hidden" name="kcp_noint_quota" value="CCBC-02:03:06,CCKM-03:06,CCSS-03:06:09"/> */

    /*  가상계좌 은행 선택 파라미터
         ※ 해당 은행을 결제창에서 보이게 합니다.(은행코드는 매뉴얼을 참조)
    <input type="hidden" name="wish_vbank_list" value="05:03:04:07:11:23:26:32:34:81:71"/> */

    /*  가상계좌 입금 기한 설정하는 파라미터 - 발급일 + 3일
    <input type="hidden" name="vcnt_expire_term" value="3"/> */

    /*  가상계좌 입금 시간 설정하는 파라미터
         HHMMSS형식으로 입력하시기 바랍니다
         설정을 안하시는경우 기본적으로 23시59분59초가 세팅이 됩니다
         <input type="hidden" name="vcnt_expire_term_time" value="120000"/> */

    /* 포인트 결제시 복합 결제(신용카드+포인트) 여부를 결정할 수 있습니다.- N 일경우 복합결제 사용안함
        <input type="hidden" name="complex_pnt_yn" value="N"/>    */

    /* 현금영수증 등록 창을 출력 여부를 설정하는 파라미터 입니다
         ※ Y : 현금영수증 등록 창 출력
         ※ N : 현금영수증 등록 창 출력 안함 
    ※ 주의 : 현금영수증 사용 시 KCP 상점관리자 페이지에서 현금영수증 사용 동의를 하셔야 합니다
        <input type="hidden" name="disp_tax_yn"     value="Y"/> */

    /* 결제창에 가맹점 사이트의 로고를 플러그인 좌측 상단에 출력하는 파라미터 입니다
       업체의 로고가 있는 URL을 정확히 입력하셔야 하며, 최대 150 X 50  미만 크기 지원

    ※ 주의 : 로고 용량이 150 X 50 이상일 경우 site_name 값이 표시됩니다.
        <input type="hidden" name="site_logo"       value="" /> */

    /* 결제창 영문 표시 파라미터 입니다. 영문을 기본으로 사용하시려면 Y로 세팅하시기 바랍니다
        2010-06월 현재 신용카드와 가상계좌만 지원됩니다
        <input type='hidden' name='eng_flag'      value='Y'> */

    /* KCP는 과세상품과 비과세상품을 동시에 판매하는 업체들의 결제관리에 대한 편의성을 제공해드리고자, 
        복합과세 전용 사이트코드를 지원해 드리며 총 금액에 대해 복합과세 처리가 가능하도록 제공하고 있습니다
        복합과세 전용 사이트 코드로 계약하신 가맹점에만 해당이 됩니다
        상품별이 아니라 금액으로 구분하여 요청하셔야 합니다
        총결제 금액은 과세금액 + 부과세 + 비과세금액의 합과 같아야 합니다. 
        (good_mny = comm_tax_mny + comm_vat_mny + comm_free_mny)
    
        <input type="hidden" name="tax_flag"       value="TG03">  <!-- 변경불가	   -->
        <input type="hidden" name="comm_tax_mny"   value=""    >  <!-- 과세금액	   --> 
        <input type="hidden" name="comm_vat_mny"   value=""    >  <!-- 부가세	   -->
        <input type="hidden" name="comm_free_mny"  value=""    >  <!-- 비과세 금액 --> */

    /* skin_indx 값은 스킨을 변경할 수 있는 파라미터이며 총 7가지가 지원됩니다. 
        변경을 원하시면 1부터 7까지 값을 넣어주시기 바랍니다. 

        <input type='hidden' name='skin_indx'      value='1'> */

    /* 상품코드 설정 파라미터 입니다.(상품권을 따로 구분하여 처리할 수 있는 옵션기능입니다.)
        <input type='hidden' name='good_cd'      value=''> */

    /* = -------------------------------------------------------------------------- = */
    /* =   4. 옵션 정보 END                                                         = */
    /* ============================================================================== */
?>
</form>