$(window).on("load resize", function () {
	//console.log(footerH);
	if ($('body').attr('data-mobile') == 'false'  ){ //pc
		$('.popup-select__item').on('mouseenter',function(){
			$(this).addClass('is-hover');
		}).on('mouseleave',function(){
			$(this).removeClass('is-hover');	
		});
		
	}else{

	}
});

$('.js-katalk').on('click',function(e){
	 e.preventDefault();
	$('.js-consultation').trigger('click');
	$('.popup-tab__item').eq(1).find('.popup-tab__link').trigger('click');
});

$('.js-cost').on('click',function(e){
	 e.preventDefault();
	$('.js-consultation').trigger('click');
	$('.popup-tab__item').eq(2).find('.popup-tab__link').trigger('click');
});
$('.popup-c__close').on('click',function(e){
	e.preventDefault();
	
	//�앹뾽 �명뭼 珥덇린��
	 // $('#kakaoForm').validate().resetForm();
	 // $('#priceForm').validate().resetForm();
	 
	 $('#kakaoForm')[0].reset();
	 $('#kakaoForm .popup-select__tit').text('관심부위를 선택해주세요');
	 $('#kakaoForm .popup-select__item').removeClass('select');
	 $('#part_item').val('');
	 
	  $('#priceForm')[0].reset();
	  $('#priceForm .js-multi').text('관심부위를 선택해주세요');
	  $('#priceForm .popup-select__item').removeClass('select');
	 
	  $('#part_item2').val('');
	  $('#priceForm .popup-check__item').remove();
	 
	  $('#priceForm .type-another .popup-select__tit').text('상담시간');
	  $('#ampm').val('');
	$('.input1__clear').hide();
	$('.input1__clear').hide();


	if ($('body').attr('data-mobile') == 'true'){
		$('.popup-c').fadeOut(300);
		$('.header__right').removeClass('remove-phone');
		$('html, body').removeClass("is-active");
		$('header').removeClass("is-logo");
		$('.common').css({'top':'auto','position':'static'});
		bodyY2 = $(window).scrollTop(bodyY2);
	}else{
		$('.popup-c').fadeOut(300);
	}
});
/*�곷떞李� 媛�蹂��� �곸슜*/
$(window).on('load resize',function(){
	if($(window).width()>992) {
		if($('.ad_menu').hasClass('open')){
			$('.dim-popup').show();
		}
	}else{
		if($('.dropdown.ad_menu').hasClass('open')){
			$('.dim-popup').hide();
			$('.consultation-icon').addClass('is-active');
			$('header').addClass('is-active');
		}
	}
})

$('.input1__clear').on('click',function(){
	$(this).siblings('input[type="text"]').val('');
	$(this).siblings('input[type="tel"]').val('');
	return false;
})

$('.js-group-close').on('click',function(e){
	e.preventDefault();
	$('.ad_menu').removeClass('open');
	$('html, body').removeClass("is-active")
	$('.dim-popup').fadeOut(300);
});

//�곷떞�좎껌
$('.js-c-open').on('click',function(e){
	e.preventDefault();
	$('.popup-c').fadeIn(500)
});
$('.js-c-close').on('click',function(e){
	e.preventDefault();
	$('.popup-c').fadeOut(500)
});
$('.popup-tab__link').on('click',function(e){
	e.preventDefault();
	var tab_id = $(this).attr('data-tab');
	$('.popup-tab__item').removeClass('is-active');
	$('.popup-content').removeClass('is-active');
	$(this).parent().addClass('is-active');
	$(".popup-content"+"."+tab_id).addClass('is-active');
	//�앹뾽 �명뭼 珥덇린��
	 // $('#kakaoForm').validate().resetForm();
	 // $('#priceForm').validate().resetForm();
	 
	 $('#kakaoForm')[0].reset();
	 $('#kakaoForm .popup-select__tit').text('관심부위를 선택해주세요');
	 $('#kakaoForm .popup-select__item').removeClass('select');
	 $('#part_item').val('');
	 
	  $('#priceForm')[0].reset();
	  $('#priceForm .js-multi').text('관심부위를 선택해주세요');
	  $('#priceForm .popup-select__item').removeClass('select');
	 
	  $('#part_item2').val('');
	  $('#priceForm .popup-check__item').remove();
	 
	  $('#priceForm .type-another .popup-select__tit').text('상담시간');
	  $('#ampm').val('');
	$('.input1__clear').hide();

});
//input �リ린
var $ipt = $('.popup-input1'),
    $clearIpt = $('.input1__clear');

$ipt.keyup(function(){
  $(this).next().toggle(Boolean($(this).val()));
});


$(".popup-select__tit").click(function() {
	$(this).parent().addClass('is-active')
	$(this).parent().find('.popup-select2__subject, .popup-select__list').addClass('is-active')
    return false;
});

$(".popup-select2__subject").click(function() {
	$(this).parent().removeClass('is-active')
	$(this).parent().find('.popup-select2__subject, .popup-select__list').removeClass('is-active')
    return false;
});

//鍮꾩슜�곷떞�� �곷떞��ぉ �좏깮
$("#priceForm .popup-select__item").click(function() {	
	$(this).parents('.popup-select__list').removeClass('is-active').parents(".popup-select").removeClass('is-active').find(".popup-select__tit").text($(this).text());
	$(this).parents('.popup-select').find('.popup-select2__subject').removeClass('is-active')
	var selectType = $(this).parents('.popup-select').attr('data-style')
	if(selectType == 'multi'){
		var optCount = $('#priceForm .popup-check li').length;
		if(optCount > 2) {
			alert('최대 3개까지 선택 가능합니다.');
			return false;

		}else {
			if(!$(this).find('h4').hasClass('popup-select2__tit') && !$(this).hasClass('select')) {
				$(this).addClass('select');
				var idx = $(this).attr('id').split('_');
				var nowTxt = $(this).text();
				$('#part_item2').val(nowTxt).keyup();
				$('.popup-check').append('<li class="popup-check__item" id="cost_'+idx[1]+'"><span class="popup-check__wrap">'+nowTxt+'<a href="" class="popup-check__close">,</a></span></li>');
				return false;
			}
		}
	}
});

//鍮꾩슜�곷떞�� �곷떞 �좏깮��ぉ ��젣
$('.popup-check').on('click','.popup-check__close',function(e){
	e.preventDefault();
	$(this).parents('.popup-check__item').remove();
	var idx = $(this).parents('.popup-check__item').attr('id').split('_');
	$('#cost_'+idx[1]).removeClass('select');

	var optCount = $('.popup-check__item').length;

	if(optCount == 0) {
		//$(this).parents('.popup-content__box').find('.popup-content__box').text('관심부위를 선택해주세요');
		$('.js-multi').text('관심부위를 선택해주세요');
		$('#part_item2').val('').keyup();
	}
	return false;
});


// 鍮꾩슜�곷떞 상담시간 �좏깮
$('#priceForm .type-another .popup-select__item').click(function(){
	$('#ampm').val($(this).text()).keyup();
});



//移댁뭅�ㅼ긽�댁쓽 �곷떞��ぉ �좏깮
$("#kakaoForm .popup-select__item").click(function() {	
	$(this).parents('.popup-select__list').removeClass('is-active').parents(".popup-select").removeClass('is-active').find(".popup-select__tit").text($(this).text());
	$(this).parents('.popup-select').find('.popup-select2__subject').removeClass('is-active')
	$(this).addClass('select');
	var idx = $(this).attr('id').split('_')[1];
	$('#part_item').val(idx).keyup();
});


$('.js-terms-open').on('click',function(e){
	e.preventDefault();
	$('.popup-c__terms').addClass('is-active');
})
$('.js-terms-close').on('click',function(e){
	e.preventDefault();
	$('.popup-c__terms').removeClass('is-active');
})

// // 移댄넚 �곷떞
// $("#kakaoForm").validate({
//   errorPlacement: function(error, element) {
//   	if (element.attr("name") == "chkAgree1") {
//       error.insertAfter("#chkAgree1-error");
//     }
//     else if (element.attr("name") == "part_item") {
//       error.insertAfter("#part_item_error");
//     } else {
//       error.insertAfter(element);
//     }
//   },
//   messages: {
//     k_name: "�대쫫�� �낅젰�댁＜�몄슂.",
//     k_tel: "�곕씫泥섎� �낅젰�댁＜�몄슂.",
//     part_item: "관심부위를 선택해주세요.",
//     k_content: "�곷떞�댁슜�� �낅젰�댁＜�몄슂.",
//     chkAgree1: "媛쒖씤�뺣낫痍④툒諛⑹묠�� �숈쓽�댁＜�몄슂."
//   },
//   submitHandler: function() {
// 	// form.submit();
// 	gtag('event', '移댄넚�곷떞', {'event_category': '�곷떞�좎껌','event_label':'�곷떞�좎껌'});
// 	var formdata = $('#kakaoForm').serialize();

//     $.post('/inc/incCounselProc.php', formdata, function(data){
// 		if(data == 'errorCase1' )
// 		{
// 		  alert('�꾩닔�낅젰 ��ぉ�� �꾨씫�섏뿀�듬땲��!!');
// 		}else if(data == 'errorCase2'){
// 		  alert('�곷떞�좎껌�� �ㅽ뙣�섏��듬땲��!!');
// 		}else{
// 		 // alert(data);
// 		  $('#kakaoForm')[0].reset();
// 		  $('#kakaoForm .popup-select__tit').text('관심부위를 선택해주세요');
// 		  $('#kakaoForm .popup-select__item').removeClass('select');
// 		  $('#part_item').val('');
// 		  alert('�곷떞�좎껌�� �꾨즺�섏뿀�듬땲��!!');
// 		}
//     });
//   }
// });

// // 鍮꾩슜 �곷떞
// $("#priceForm").validate({
//   groups: {
//     username: "chk_agree2 chk_sms_agree"
//   },
//   errorPlacement: function(error, element) {
//   	if (element.attr("name") == "chk_agree2" || element.attr("name") == "chk_sms_agree" ) {
//       error.insertAfter("#chk_agree2-error");
//     }
//     else if (element.attr("name") == "part_item2") {
//       error.insertAfter("#part_item2-error");
//     }
//     else if (element.attr("name") == "ampm") {
//       error.insertAfter("#ampm_error");
//     }
//     else {
//       error.insertAfter(element);
//     }
//   },
//   messages: {
//     p_name: "�대쫫�� �낅젰�댁＜�몄슂.",
//     p_tel: "�곕씫泥섎� �낅젰�댁＜�몄슂.",
//     part_item2: "관심부위를 선택해주세요.",
//     p_content: "硫붾え瑜� �낅젰�댁＜�몄슂.",
//     ampm: "상담시간�� �좏깮�댁＜�몄슂.",
//     chk_agree2: "媛쒖씤�뺣낫痍④툒諛⑹묠怨� SMS �섏떊�� �숈쓽�댁＜�몄슂.",
//     chk_sms_agree: "媛쒖씤�뺣낫痍④툒諛⑹묠怨� SMS �섏떊�� �숈쓽�댁＜�몄슂."
//   },
//   submitHandler: function() {
// 	gtag('event', '鍮꾩슜�곷떞', {'event_category': '�곷떞�좎껌','event_label':'�곷떞�좎껌'});

// 	var partId = "";
// 	for(i=0; i < $('#priceForm .popup-check li').length; i++){
// 		partId = partId + $('#priceForm .popup-check li').eq(i).attr('id').split('_')[1] + ',';

// 	}
// 	$('#part_item2').val(partId);


// 	var formdata = $('#priceForm').serialize();
//     $.post('/inc/incCounselProc.php', formdata, function(data){
// 		if(data == 'errorCase1' )
// 		{
// 		  alert('�꾩닔�낅젰 ��ぉ�� �꾨씫�섏뿀�듬땲��!!');
// 		}else if(data == 'errorCase2'){
// 		  alert('�곷떞�좎껌�� �ㅽ뙣�섏��듬땲��!!');
// 		}else{
// 		 // alert(data);
// 		  $('#priceForm')[0].reset();
// 		  $('#priceForm .js-multi').text('관심부위를 선택해주세요');
// 		  $('#priceForm .popup-select__item').removeClass('select');
		 
// 		  $('#part_item2').val('');
// 		  $('#priceForm .popup-check__item').remove();
		 
// 		  $('#priceForm .type-another .popup-select__tit').text('상담시간');
// 		  $('#ampm').val('');
// 		  alert('�곷떞�좎껌�� �꾨즺�섏뿀�듬땲��!!');
// 		}
//     });
//    // form.submit();
//   }
// });