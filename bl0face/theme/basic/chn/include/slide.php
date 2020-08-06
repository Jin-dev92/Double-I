<?php
define('_INDEX_', true);
include_once('./_common.php');
?>

<link rel="stylesheet" type="text/css" href="/theme/basic/css/slider-pro.min.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="/theme/basic/css/examples.css" media="screen"/>

<script type="text/javascript" src="/theme/basic/js/jquery.sliderPro.min.js"></script>

<script type="text/javascript">
window.onresize = function() {
    document.location.reload();
};
	$( document ).ready(function( $ ) {

		var moni_width = window.innerWidth ;
		var moni_height = window.innerHeight+9 ;

		var agent = navigator.userAgent.toLowerCase();

		if(agent.indexOf("chrome") != -1){
			var slider_width = moni_width;
			var slider_height = moni_height;
		} else if (agent.indexOf("safari") != -1) {
			var slider_width = moni_width;
			var slider_height = moni_height;
		} else if (agent.indexOf("firefox") != -1) {
			var slider_width = moni_width;
			var slider_height = moni_height;
		} else if ( (navigator.appName == 'Netscape' && navigator.userAgent.search('Trident') != -1) || (agent.indexOf("msie") != -1) ) {
			var slider_width = moni_width;
			var slider_height = moni_height;
		}

		$( '#example1' ).sliderPro({
			width: slider_width,
			height: slider_height,
			arrows: true,
			buttons: false,
			waitForLayers: true,
			thumbnailWidth: 147,
			thumbnailHeight: 150,
			thumbnailPointer: true,
			autoplay: false,
			autoScaleLayers: false,
			breakpoints: {
				500: {
					thumbnailWidth: 120,
					thumbnailHeight: 50
				}
			}
		});
	});

</script>

<div id="example1" class="slider-pro">
	<div class="sp-slides">
		<div class="sp-slide">
			<img class="sp-image" src="/theme/basic/img/slide/image1_large.jpg"/>
			
			<p class="sp-layer sp-white sp-padding" 
				data-position="centerCenter" data-vertical="-50" 
				data-show-transition="right" data-hide-transition="left" data-show-delay="700" >
				<a class="layer"><img src="/theme/basic/img/slide/layer_01.png"></a>
			</p>

		</div>

		<div class="sp-slide">
			<img class="sp-image" src="/theme/basic/img/slide/image2_large.jpg"/>

			<p class="sp-layer sp-white sp-padding" 
				data-position="centerCenter" data-vertical="-50" 
				data-show-transition="right" data-hide-transition="left" data-show-delay="700" >
				<a class="layer"><img src="/theme/basic/img/slide/layer_02.png"></a>
			</p>


		</div>

		<div class="sp-slide">
			<img class="sp-image" src="/theme/basic/img/slide/image3_large.jpg"/>

			<p class="sp-layer sp-white sp-padding" 
				data-position="centerCenter" data-vertical="-50" 
				data-show-transition="right" data-hide-transition="left" data-show-delay="700" >
				<a class="layer"><img src="/theme/basic/img/slide/layer_03.png"></a>
			</p>

		</div>

		<div class="sp-slide">
			<img class="sp-image" src="/theme/basic/img/slide/image4_large.jpg"/>

		<p class="sp-layer sp-white sp-padding" 
				data-position="centerCenter" data-vertical="-50" 
				data-show-transition="right" data-hide-transition="left" data-show-delay="700" >
				<a class="layer"><img src="/theme/basic/img/slide/layer_04.png"></a>
			</p>

		</div>

		<div class="sp-slide">
			<img class="sp-image" src="/theme/basic/img/slide/image5_large.jpg"/>

			<p class="sp-layer sp-white sp-padding" 
				data-position="centerCenter" data-vertical="-50" 
				data-show-transition="right" data-hide-transition="left" data-show-delay="700" >
				<a class="layer"><img src="/theme/basic/img/slide/layer_05.png"></a>
			</p>

		</div>

		<div class="sp-slide">
			<img class="sp-image" src="/theme/basic/img/slide/image6_large.jpg"/>

			<p class="sp-layer sp-white sp-padding" 
				data-position="centerCenter" data-vertical="-50" 
				data-show-transition="right" data-hide-transition="left" data-show-delay="700" >
				<a class="layer"><img src="/theme/basic/img/slide/layer_06.png"></a>
			</p>

		</div>

		<div class="sp-slide">
			<img class="sp-image" src="/theme/basic/img/slide/image7_large.jpg"/>

			<p class="sp-layer sp-white sp-padding" 
				data-position="centerCenter" data-vertical="-50" 
				data-show-transition="right" data-hide-transition="left" data-show-delay="700" >
				<a class="layer"><img src="/theme/basic/img/slide/layer_07.png"></a>
			</p>

		</div>

		<div class="sp-slide">
			<img class="sp-image" src="/theme/basic/img/slide/image8_large.jpg"/>

			<p class="sp-layer sp-white sp-padding" 
				data-position="centerCenter" data-vertical="-50" 
				data-show-transition="right" data-hide-transition="left" data-show-delay="700" >
				<a class="layer"><img src="/theme/basic/img/slide/layer_08.png"></a>
			</p>

		</div>

		
	</div>

	<div class="sp-thumbnails">
		<div class="sp-thumbnail">
			<div class="sp-thumbnail-title"><img src="/theme/basic/img/slide/thum_1.png"></div>
		</div>

		<div class="sp-thumbnail">
			<div class="sp-thumbnail-title"><img src="/theme/basic/img/slide/thum_2.png"></div>
		</div>

		<div class="sp-thumbnail">
			<div class="sp-thumbnail-title"><img src="/theme/basic/img/slide/thum_3.png"></div>
		</div>

		<div class="sp-thumbnail">
			<div class="sp-thumbnail-title"><img src="/theme/basic/img/slide/thum_4.png"></div>
		</div>

		<div class="sp-thumbnail">
			<div class="sp-thumbnail-title"><img src="/theme/basic/img/slide/thum_5.png"></div>
		</div>

		<div class="sp-thumbnail">
			<div class="sp-thumbnail-title"><img src="/theme/basic/img/slide/thum_6.png"></div>	
		</div>

		<div class="sp-thumbnail">
			<div class="sp-thumbnail-title"><img src="/theme/basic/img/slide/thum_7.png"></div>
		</div>

		<div class="sp-thumbnail">
			<div class="sp-thumbnail-title"><img src="/theme/basic/img/slide/thum_8.png"></div>
		</div>
	</div>
</div>