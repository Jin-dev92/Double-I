$(function(){

	$('.pie_progress02').asPieProgress({
		namespace: 'pie_progress'
	})

	setTimeout(function(){
		$('.pie_progress').asPieProgress({
			namespace: 'pie_progress'
		});
	},2500)

	$('.cir_graph').css({'transform':'rotate(180deg)'})

	$('#visual').on('click','.mainMore a',function(){
		if($('.flickity-page-dots li:eq(0)').hasClass('is-selected')){
			var url1 = "/bbs/board.php?bo_table=work&wr_id=16";
			$(location).attr('href',url1);
		}
		else if($('.flickity-page-dots li:eq(1)').hasClass('is-selected')){
			var url2 = "/bbs/board.php?bo_table=work&wr_id=17";
			$(location).attr('href',url2);
		}
		else if($('.flickity-page-dots li:eq(2)').hasClass('is-selected')){
			var url3 = "/bbs/board.php?bo_table=work&wr_id=25";
			$(location).attr('href',url3);
		}
		else if($('.flickity-page-dots li:eq(3)').hasClass('is-selected')){
			var url4 = "/bbs/board.php?bo_table=work&wr_id=24";
			$(location).attr('href',url4);
		}
	})

	function mc01(){
		setTimeout(function(){
			$('.pie_progress').asPieProgress('go','25%');
			$('.pie_progress02').asPieProgress('go','100%');
		}, 100);
	}
	function mc02(){
		setTimeout(function(){
			$('.pie_progress').asPieProgress('go','50%');
			$('.pie_progress02').asPieProgress('go','100%');
		}, 100);
	}
	function mc03(){
		setTimeout(function(){
			$('.pie_progress').asPieProgress('go','75%');
			$('.pie_progress02').asPieProgress('go','100%');
		}, 100);
	}
	function mc04(){
		setTimeout(function(){
			$('.pie_progress').asPieProgress('go','100%');
			$('.pie_progress02').asPieProgress('go','100%');
		}, 100);
	}



	$('body').on('touchend click','#visual',function(){
		setTimeout(function(){
			if($('.flickity-page-dots li:eq(0)').hasClass('is-selected')){
				mc01()
				$('.flickity-page-dots li:eq(3)').css('background-color','#CF3624')
				$('.flickity-page-dots li:eq(1)').css('background-color','#d7d7d7')
				$('.flickity-page-dots li:eq(2)').css('background-color','#d7d7d7')


			}
			else if($('.flickity-page-dots li:eq(1)').hasClass('is-selected')){
				mc02()
				$('.flickity-page-dots li:eq(2)').css('background-color','#d7d7d7')
				$('.flickity-page-dots li:eq(3)').css('background-color','#CF3624')
				$('.flickity-page-dots li:eq(1)').css('background-color','transparent')

			}
			else if($('.flickity-page-dots li:eq(2)').hasClass('is-selected')){
				mc03()
				$('.flickity-page-dots li:eq(1)').css('background-color','#CF3624')
				$('.flickity-page-dots li:eq(2)').css('background-color','transparent')
				$('.flickity-page-dots li:eq(3)').css('background-color','#CF3624')

			}
			else if($('.flickity-page-dots li:eq(3)').hasClass('is-selected')){
				mc04()
				$('.flickity-page-dots li:eq(3)').css('background-color','transparent')
				$('.flickity-page-dots li:eq(1)').css('background-color','#CF3624')
				$('.flickity-page-dots li:eq(2)').css('background-color','#CF3624')


			}
		},300)
	})

	setInterval(function(){
		if($('.flickity-page-dots li:eq(0)').hasClass('is-selected')){
			mc01()
			$('.flickity-page-dots li:eq(3)').css('background-color','#CF3624')
			$('.flickity-page-dots li:eq(1)').css('background-color','#d7d7d7')
			$('.flickity-page-dots li:eq(2)').css('background-color','#d7d7d7')


		}
		else if($('.flickity-page-dots li:eq(1)').hasClass('is-selected')){
			mc02()
			$('.flickity-page-dots li:eq(2)').css('background-color','#d7d7d7')
			$('.flickity-page-dots li:eq(3)').css('background-color','#CF3624')
			$('.flickity-page-dots li:eq(1)').css('background-color','transparent')

		}
		else if($('.flickity-page-dots li:eq(2)').hasClass('is-selected')){
			mc03()
			$('.flickity-page-dots li:eq(1)').css('background-color','#CF3624')
			$('.flickity-page-dots li:eq(2)').css('background-color','transparent')
			$('.flickity-page-dots li:eq(3)').css('background-color','#CF3624')

		}
		else if($('.flickity-page-dots li:eq(3)').hasClass('is-selected')){
			mc04()
			$('.flickity-page-dots li:eq(3)').css('background-color','transparent')
			$('.flickity-page-dots li:eq(1)').css('background-color','#CF3624')
			$('.flickity-page-dots li:eq(2)').css('background-color','#CF3624')


		}
	},300)

	setTimeout(function(){
	$('.dot').animate({'opacity':'0'})
	},0)
	setTimeout(function(){
	$('.dot').animate({'opacity':'1'}, 1000)
	},1800)
});
