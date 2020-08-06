<?php
define('_INDEX_', true);
include_once('./_common.php');

?>
<link rel="stylesheet" href="/theme/basic/css/style.css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script type="text/javascript" src="/theme/basic/js/jquery.aw-showcase.js"></script>

<script type="text/javascript">

$(document).ready(function()
{
	$("#showcase").awShowcase(
	{
		content_width:			1900,
		content_height:			900,
		fit_to_parent:			false,
		auto:					false,
		interval:				3000,
		continuous:				false,
		loading:				true,
		tooltip_width:			200,
		tooltip_icon_width:		32,
		tooltip_icon_height:	32,
		tooltip_offsetx:		18,
		tooltip_offsety:		0,
		arrows:					true,
		buttons:				false,
		btn_numbers:			false,
		keybord_keys:			true,
		mousetrace:				false, /* Trace x and y coordinates for the mouse */
		pauseonover:			true,
		stoponclick:			true,
		transition:				'vslide', /* hslide/vslide/fade */
		transition_delay:		300,
		transition_speed:		1000,
		show_caption:			'onhover', /* onload/onhover/show */
		thumbnails:				true,
		thumbnails_position:	'outside-last', /* outside-last/outside-first/inside-last/inside-first */
		thumbnails_direction:	'horizontal', /* vertical/horizontal */
		thumbnails_slidex:		0, /* 0 = auto / 1 = slide one thumbnail / 2 = slide two thumbnails / etc. */
		dynamic_height:			false, /* For dynamic height to work in webkit you need to set the width and height of images in the source. Usually works to only set the dimension of the first slide in the showcase. */
		speed_change:			false, /* Set to true to prevent users from swithing more then one slide at once. */
		viewline:				false /* If set to true content_width, thumbnails, transition and dynamic_height will be disabled. As for dynamic height you need to set the width and height of images in the source. */
	});
});
</script>

<div style="width: 1900px; margin: auto;">

	<div id="showcase" class="showcase">
		<!-- Each child div in #showcase with the class .showcase-slide represents a slide. -->
		<div class="showcase-slide">
			<!-- Put the slide content in a div with the class .showcase-content. -->
			<div class="showcase-content">
				<img src="/theme/basic/img/slide/01.jpg" alt="01" />
			</div>
			<!-- Put the thumbnail content in a div with the class .showcase-thumbnail -->
			<div class="showcase-thumbnail">
				<img src="/theme/basic/img/slide/01.jpg" alt="01" width="140px" />
				<!-- The div below with the class .showcase-thumbnail-caption contains the thumbnail caption. -->
				<div class="showcase-thumbnail-caption">Caption Text</div>
				<!-- The div below with the class .showcase-thumbnail-cover is used for the thumbnails active state. -->
				<div class="showcase-thumbnail-cover"></div>
			</div>
			<!-- Put the caption content in a div with the class .showcase-caption -->
			<div class="showcase-caption">
				<h2>Be creative. Get Noticed!</h2>
			</div>
		</div>
		<div class="showcase-slide">
			<div class="showcase-content">
				<img src="/theme/basic/img/slide/02.jpg" alt="02"  />
			</div>
			<div class="showcase-thumbnail">
				<img src="/theme/basic/img/slide/02.jpg" alt="01" width="140px" />
				<div class="showcase-thumbnail-caption">Caption Text</div>
				<div class="showcase-thumbnail-cover"></div>
			</div>
			<!-- Put the tooltips in a div with the class .showcase-tooltips. -->
			<div class="showcase-tooltips">
				<!-- Each anchor in .showcase-tooltips represents a tooltip. The coords attribute represents the position of the tooltip. -->
				<a href="http://www.awkward.se" coords="634,130">
					<!-- The content of the anchor-tag is displayed in the tooltip. -->
					This is a tooltip that displays the anchor html in a nice way.
				</a>
				<a href="http://www.awkward.se" coords="200,440">
					This is a tooltip that displays the anchor html in a nice way.
				</a>
				<a href="http://www.awkward.se" coords="600,440">
					This is a tooltip that displays the anchor html in a nice way.
				</a>
				<a href="http://www.awkward.se" coords="356, 172">
					<!-- You can add multiple elements to the anchor-tag which are display in the tooltip. -->
					<img src="/theme/basic/img/slide/glasses.png" />
					<span style="display: block; font-weight: bold; padding: 3px 0 3px 0; text-align: center;">
						White Glasses: 500$
					</span>
				</a>
			</div>
		</div>
		<div class="showcase-slide">
			<div class="showcase-content">
				<img src="/theme/basic/img/slide/03.jpg" alt="03" />
			</div>
			<div class="showcase-thumbnail">
				<img src="/theme/basic/img/slide/03.jpg" alt="01" width="140px" />
				<div class="showcase-thumbnail-caption">Caption Text</div>
				<div class="showcase-thumbnail-cover"></div>
			</div>
		</div>
		<div class="showcase-slide">
			<div class="showcase-content">
				<img src="/theme/basic/img/slide/04.jpg" alt="04" />
			</div>
			<div class="showcase-thumbnail">
				<div class="showcase-thumbnail-content">Just some text<br/> I'm not <b>bold</b></div>
				<div class="showcase-thumbnail-cover"></div>
			</div>
		</div>
		<div class="showcase-slide">
			<div class="showcase-content">
				<img src="/theme/basic/img/slide/05.jpg" alt="05" />
			</div>
			<div class="showcase-thumbnail">
				<div class="showcase-thumbnail-content">Just some more of this text</div>
				<div class="showcase-thumbnail-cover"></div>
			</div>
		</div>
		<div class="showcase-slide">
			<div class="showcase-content">
				<img src="/theme/basic/img/slide/06.jpg" alt="06" />
			</div>
			<div class="showcase-thumbnail">
				<img src="/theme/basic/img/slide/03.jpg" alt="06" width="140px" />
				<div class="showcase-thumbnail-caption">Caption Text</div>
				<div class="showcase-thumbnail-cover"></div>
			</div>
		</div>
		<div class="showcase-slide">
			<div class="showcase-content">
				<img src="/theme/basic/img/slide/07.jpg" alt="07" />
			</div>
			<div class="showcase-thumbnail">
				<img src="/theme/basic/img/slide/07.jpg" alt="07" width="140px" />
			</div>
		</div>
	</div>
</div>
</div>