<?
include "$nfor[pg_path]/cfg/site_conf_inc.php";



/* kcp와 통신후 kcp 서버에서 전송되는 결제 요청 정보 */
$req_tx          = $_POST[ "req_tx"         ]; // 요청 종류         
$res_cd          = $_POST[ "res_cd"         ]; // 응답 코드         
$tran_cd         = $_POST[ "tran_cd"        ]; // 트랜잭션 코드     
$ordr_idxx       = $_POST[ "ordr_idxx"      ]; // 쇼핑몰 주문번호   
$good_name       = $_POST[ "good_name"      ]; // 상품명            
$good_mny        = $_POST[ "good_mny"       ]; // 결제 총금액       
$buyr_name       = $_POST[ "buyr_name"      ]; // 주문자명          
$buyr_tel1       = $_POST[ "buyr_tel1"      ]; // 주문자 전화번호   
$buyr_tel2       = $_POST[ "buyr_tel2"      ]; // 주문자 핸드폰 번호
$buyr_mail       = $_POST[ "buyr_mail"      ]; // 주문자 E-mail 주소
$use_pay_method  = $_POST[ "use_pay_method" ]; // 결제 방법         
$ipgm_date       = $_POST[ "ipgm_date"      ]; // 가상계좌 마감시간 
$enc_info        = $_POST[ "enc_info"       ]; // 암호화 정보       
$enc_data        = $_POST[ "enc_data"       ]; // 암호화 데이터     
$van_code        = $_POST[ "van_code"       ];
$cash_yn         = $_POST[ "cash_yn"        ];
$cash_tr_code    = $_POST[ "cash_tr_code"   ];
/* 기타 파라메터 추가 부분 - Start - */
$param_opt_1    = $_POST[ "param_opt_1"     ]; // 기타 파라메터 추가 부분
$param_opt_2    = $_POST[ "param_opt_2"     ]; // 기타 파라메터 추가 부분
$param_opt_3    = $_POST[ "param_opt_3"     ]; // 기타 파라메터 추가 부분
/* 기타 파라메터 추가 부분 - End -   */

$tablet_size     = "1.0"; // 화면 사이즈 고정
$url = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
?>
<script type="text/javascript" src="<?=$nfor[path]?>/pg/kcp/js/approval_key.js"></script>

<script type="text/javascript">

   /* kcp web 결제창 호츨 (변경불가) */
  function call_pay_form()
  {
    var v_frm = document.order_info;

    document.getElementById("member_info").style.display = "none";
    document.getElementById("layer_all").style.display  = "block";

    v_frm.target = "frm_all";
    v_frm.action = PayUrl;

    // 인코딩 방식에 따른 변경 -- Start  
	if(v_frm.encoding_trans == undefined){
		v_frm.action = PayUrl;    
	} else{
		if(v_frm.encoding_trans.value == "UTF-8"){
			v_frm.action = PayUrl.substring(0,PayUrl.lastIndexOf("/")) + "/jsp/encodingFilter/encodingFilter.jsp";  
			v_frm.PayUrl.value = PayUrl;   
		} else{         
			v_frm.action = PayUrl; 
		}  
	}   
	// 인코딩 방식에 따른 변경 -- End  
 
    if (v_frm.Ret_URL.value == "")
    {
	  /* Ret_URL값은 현 페이지의 URL 입니다. */
	  alert("연동시 Ret_URL을 반드시 설정하셔야 됩니다.");
      return false;
    }
    else
    {
      v_frm.submit();
    }
  }

   /* kcp 통신을 통해 받은 암호화 정보 체크 후 결제 요청 (변경불가) */
  function chk_pay()
  {
    self.name = "tar_opener";
    var pay_form = document.pay_form;

    if (pay_form.res_cd.value == "3001" )
    {
      alert("사용자가 취소하였습니다.");
      pay_form.res_cd.value = "";
    }
    else if (pay_form.res_cd.value == "3000" )
    {
      alert("30만원 이상 결제를 할 수 없습니다.");
      pay_form.res_cd.value = "";
    }

    document.getElementById("member_info").style.display = "block";
    document.getElementById("layer_all").style.display  = "none";

    if (pay_form.enc_info.value)
      pay_form.submit();
  }
</script>


<script type="text/javascript">
<!--
function cart_payment(){
	kcp_AJAX();
}

// 결제타입선택
$(document).on("click",".payment_type",function(){

	var payment_type = $(".payment_type:checked").val();

	if(payment_type=="card"){
		document.order_info.ActionResult.value = "card";
		document.order_info.pay_method.value = "CARD";
	} else if(payment_type=="iche"){
		document.order_info.ActionResult.value = "acnt";
		document.order_info.pay_method.value = "BANK";
	} else if(payment_type=="vbanking"){
		document.order_info.ActionResult.value == "vcnt";
		document.order_info.pay_method.value = "VCNT";
	} else if(payment_type=="hp"){
		document.order_info.ActionResult.value = "mobx";
		document.order_info.pay_method.value = "MOBX";
	} else{

	}

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


$(document).ready(function(e) {
	chk_pay();
}); 
//-->
</script>

<?

$good_name = cart_it_name($ss_cart_id);

$buyr_name = $member[mb_name];
$buyr_mail = $member[mb_email];
$buyr_tel1 = $member[mb_hp];
$buyr_tel2 = $member[mb_hp];

?>




<form name="order_info" method="post">
<input type="hidden" name="encoding_trans" value="UTF-8" />
<input type="hidden" name="PayUrl">
<input type="hidden" name="ordr_idxx" id="od_id">
<input type="hidden" name="good_mny" id="pay_price">
<input type="hidden" name="good_name" value="<?=$good_name?>">
<input type="hidden" name="buyr_name" value="<?=$buyr_name?>">
<input type="hidden" name="buyr_mail" value="<?=$buyr_mail?>">
<input type="hidden" name="buyr_tel1" value="<?=$buyr_tel1?>">
<input type="hidden" name="buyr_tel2" value="<?=$buyr_tel2?>">
<select name="ActionResult" style="display:none;">
<option value="card">신용카드</option>
<option value="acnt">계좌이체</option>
<option value="vcnt">가상계좌</option>
<option value="mobx">휴대폰</option>
</select>
<!-- 공통정보 -->
<input type="hidden" name="req_tx"          value="pay">                           <!-- 요청 구분 -->
<input type="hidden" name="shop_name"       value="<?= $g_conf_site_name ?>">      <!-- 사이트 이름 --> 
<input type="hidden" name="site_cd"         value="<?= $g_conf_site_cd   ?>">      <!-- 사이트 코드 -->
<input type="hidden" name="currency"        value="410"/>                          <!-- 통화 코드 -->
<input type="hidden" name="eng_flag"        value="N"/>                            <!-- 한 / 영 -->
<!-- 결제등록 키 -->
<input type="hidden" name="approval_key"    id="approval">
<!-- 인증시 필요한 파라미터(변경불가)-->
<input type="hidden" name="escw_used"       value="N">
<input type="hidden" name="pay_method"      value="CARD">
<input type="hidden" name="van_code"        value="<?=$van_code?>">
<!-- 신용카드 설정 -->
<input type="hidden" name="quotaopt"        value="12"/>                           <!-- 최대 할부개월수 -->
<!-- 가상계좌 설정 -->
<input type="hidden" name="ipgm_date"       value=""/>
<!-- 가맹점에서 관리하는 고객 아이디 설정을 해야 합니다.(필수 설정) -->
<input type="hidden" name="shop_user_id"    value=""/>
<!-- 복지포인트 결제시 가맹점에 할당되어진 코드 값을 입력해야합니다.(필수 설정) -->
<input type="hidden" name="pt_memcorp_cd"   value=""/>
<!-- 현금영수증 설정 -->
<input type="hidden" name="disp_tax_yn"     value="Y"/>
<!-- 리턴 URL (kcp와 통신후 결제를 요청할 수 있는 암호화 데이터를 전송 받을 가맹점의 주문페이지 URL) -->
<input type="hidden" name="Ret_URL"         value="<?=$url?>">
<!-- 화면 크기조정 -->
<input type="hidden" name="tablet_size"     value="<?=$tablet_size?>">
<!-- 추가 파라미터 ( 가맹점에서 별도의 값전달시 param_opt 를 사용하여 값 전달 ) -->
<input type="hidden" name="param_opt_1"     value="">
<input type="hidden" name="param_opt_2"     value="">
<input type="hidden" name="param_opt_3"     value="">
<?
    /* ============================================================================== */
    /* =   옵션 정보                                                                = */
    /* = -------------------------------------------------------------------------- = */
    /* =   ※ 옵션 - 결제에 필요한 추가 옵션 정보를 입력 및 설정합니다.             = */
    /* = -------------------------------------------------------------------------- = */
    /* 카드사 리스트 설정
    예) 비씨카드와 신한카드 사용 설정시
    <input type="hidden" name='used_card'    value="CCBC:CCLG">

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
    /* = -------------------------------------------------------------------------- = */
    /* =   옵션 정보 END                                                            = */
    /* ============================================================================== */
?>
</form>

















<!-- 스마트폰에서 KCP 결제창을 레이어 형태로 구현-->
<div id="layer_all" style="position:absolute; left:0px; top:0px; width:100%;height:100%; z-index:1; display:none;">
    <table height="100%" width="100%" border="-" cellspacing="0" cellpadding="0" style="text-align:center">
        <tr height="100%" width="100%">
            <td>
                <iframe name="frm_all" frameborder="0" marginheight="0" marginwidth="0" border="0" width="100%" height="100%" scrolling="auto"></iframe>
            </td>
        </tr>
    </table>
</div>
<form name="pay_form" method="post" action="pg_kcp_mobile_update.php">
    <input type="hidden" name="req_tx"         value="<?=$req_tx?>">               <!-- 요청 구분          -->
    <input type="hidden" name="res_cd"         value="<?=$res_cd?>">               <!-- 결과 코드          -->
    <input type="hidden" name="tran_cd"        value="<?=$tran_cd?>">              <!-- 트랜잭션 코드      -->
    <input type="hidden" name="ordr_idxx"      value="<?=$ordr_idxx?>">            <!-- 주문번호           -->
    <input type="hidden" name="good_mny"       value="<?=$good_mny?>">             <!-- 휴대폰 결제금액    -->
    <input type="hidden" name="good_name"      value="<?=$good_name?>">            <!-- 상품명             -->
    <input type="hidden" name="buyr_name"      value="<?=$buyr_name?>">            <!-- 주문자명           -->
    <input type="hidden" name="buyr_tel1"      value="<?=$buyr_tel1?>">            <!-- 주문자 전화번호    -->
    <input type="hidden" name="buyr_tel2"      value="<?=$buyr_tel2?>">            <!-- 주문자 휴대폰번호  -->
    <input type="hidden" name="buyr_mail"      value="<?=$buyr_mail?>">            <!-- 주문자 E-mail      -->
    <input type="hidden" name="cash_yn"        value="<?=$cash_yn?>">              <!-- 현금영수증 등록여부-->
    <input type="hidden" name="enc_info"       value="<?=$enc_info?>">
    <input type="hidden" name="enc_data"       value="<?=$enc_data?>">
    <input type="hidden" name="use_pay_method" value="<?=$use_pay_method?>">
    <input type="hidden" name="cash_tr_code"   value="<?=$cash_tr_code?>">

    <!-- 추가 파라미터 -->
    <input type="hidden" name="param_opt_1"	   value="<?=$param_opt_1?>">
    <input type="hidden" name="param_opt_2"	   value="<?=$param_opt_2?>">
    <input type="hidden" name="param_opt_3"	   value="<?=$param_opt_3?>">
</form>