<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');
// 파일, 링크, 트랙백 버튼
$ad_btn = "";
if($is_file) {
	$ad_btn .= "<a id='ad-btn_file' href=\"javascript:ad_layer('file');\" class='btn_file' title='첨부파일'><span>파일첨부</span>";
	if($w=="u") $ad_btn .= "<em>{$file['count']}</em>";
	$ad_btn .= "</a>";
}

if($is_link) {
	$ad_btn .= "<a id='ad-btn_link' href=\"javascript:ad_layer('link');\" class='btn_link' title='링크'><span>링크</span>";
	if($w=="u") $ad_btn .= "<em>{$link['count']}</em>";
	$ad_btn .= "</a>";
}
// 파일, 링크, 트랙백 리스트
if($w=="u") {

	$k = 0;
	$ad_list = "";
	for($i=0; $i<$file_count; $i++) { 
		if($file[$i]['source'] && $file[$i]['size'])
		{
			$ad_list .= "<li id='ad-file_list_{$i}'";
			if($k==0) $ad_list .= " class='first' ";
			$ad_list .= ">";
				$ad_list .= "<span class='txt_name'>{$file[$i][source]}</span>";
				$ad_list .= "<span class='txt_size'>".((int)$file[$i][size] ? '('.$file[$i][size].')' : '')."</span>";
				$ad_list .= "<span class='txt_date'>".($file[$i][source] ? $file[$i][datetime] : '')."</span>";
				$ad_list .= $file[$i][source] ? "<a href='javascript:delete_ad_file($i);' class='btn_del'>삭제</a>" : '&nbsp;';
				if($file[$i][bf_content]) $ad_list .= "<p class='txt_file_content'>{$file[$i][bf_content]}</p>";
			$ad_list .= "</li>";
			$ad_list .= "<input type='hidden' id='bf_file_del_$i' name='bf_file_del[$i]' value='0' />";
			$k++;
		}
	}

	if($is_link && $link) {
		$link['count']=0;
		foreach($link as $value) {
			if(!$value) continue;
			$ad_list .= "<li";
			if($k==0) $ad_list .= " class='first' ";
			$ad_list .= ">";
			$ad_list .= "<span class='txt_link'>".cut_str($value, 70)."</span>";
			$ad_list .= "</li>";

			$k++;
			$link['count']++;
		}
	}
}
?>
<script>
$(function(){
   $("#wr_2").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", minDate: "+d;", maxDate: "+365d;" });
});
</script>
<style>
::-webkit-input-placeholder {
 font-size: 12px; 
 color: #d0cdfa;
 text-align: center;
 font-weight: 700;
 opacity:0.8
}
:-moz-placeholder { /* older Firefox*/
 font-size: 12px; 
 color: #d0cdfa;
 text-align: center;
 font-weight: 700;
 opacity:0.8
}
::-moz-placeholder { /* Firefox 19+ */ 
 font-size: 12px; 
 color: #d0cdfa;
 text-align: center;
 font-weight: 700;
 opacity:0.8
} 
:-ms-input-placeholder { 
 font-size: 12px; 
 color: #d0cdfa;
 text-align: center;
 font-weight: 700;
 opacity:0.8
}
.bo_write_mbinfo .title { width:50px; line-height:35px; padding:2px;}
.bo_write_mbinfo .title1 { line-height:35px; padding:2px;}
.title_h4 {color:rgba(255, 56, 103, 1); font-size:11px;}
.bo_write_mbinfo input {width:400px;}
.wr_2 {width:150px !important; height:35px;}
select::-ms-expand { 
  display: none;
}

select {  
  -webkit-appearance: none;  /* 네이티브 외형 감추기 */
  -moz-appearance: none;
  appearance: none; 
  width: 200px; /* 원하는 너비설정 */
  padding: .8em .5em; /* 여백으로 높이 설정 */
  background: url(https://farm1.staticflickr.com/379/19928272501_4ef877c265_t.jpg) no-repeat 95% 50%; /* 네이티브 화살표 대체 */  
  border: 1px solid #999; 
  border-radius: 0px; /* iOS 둥근모서리 제거 */
  -webkit-appearance: none; /* 네이티브 외형 감추기 */
  -moz-appearance: none;
  appearance: none;
}
.bo_w_ca_name {width: 200px !important;}
.bo_w_ca_name ul {width: 200px !important;}
</style>
<section id="bo_w" class="fz_wrap">
	<h2 id="container_title">
		<?php 
			if($bo_table == "online") {
		?>
				Online reservation
		<?php
		}		
		?>
	</h2>

    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
   
	<div class="bo_w_form">
		<div class="bo_w_title<?php if($is_category){ echo " use_category";}?>">
			<div class="bo_w_ca_name" style="width: 200px !important; ">
				<select name="wr_subject" id="wr_subject"> 
					<option value="selected">:::상담 항목:::</option>
						<option value="필러">필러</option>
						<option value="리프팅">리프팅</option>
						<option value="더블킴 스페셜">더블킴 스페셜</option>
						<option value="비만">비만 </option>
						<option value="콜라겐생성">콜라겐생성</option>
				</select>
				
			</div>
				<p class="title_h4">※상담하고 싶은 항목을 선택해주세요.</p>

			<span class="placeholder">
				<!--<input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="i_text_large required" size="50" maxlength="255">-->
			</span>
		</div>
		<?php if($option){?>
		<div class="bo_write_body">
			<div class="bo_write_option"><?php echo $option ?></div>
		</div>
		<?php }?>

		<div class="bo_write_mbinfo">
			<ul>
				<li class="title">이름</li>
				<li><span ><input type="text" name="wr_name" value="" id="wr_name" required class="i_text required" maxLength="20"><label for='wr_name'></label></span></li>
				
				<li class="title">이메일</li>
				<li><span ><input type="text" name="wr_email" value="" id="wr_email" class="i_text email" maxlength="100"><label for="wr_email"></label></span></li>

				<li class="title">연락처</li>
				<li><span ><input type="text" name="wr_1" value="" id="wr_1" class="i_text"><label for="wr_1"></label></span></li>
				
				<li class="title1">상담가능시간</li>
				<li><span>
				<input type="text" name="wr_2" value="<?php echo $write["wr_2"] ?>" class="wr_2" id="wr_2" required class="i_date_large required" size="10" maxlength="25" placeholder=" - 일자 - " readonly>
				
				<select name="wr_3" id="wr_3">
					<option value="selected">- 시 간 -</option>
					<?php 
						$time = "10:00";
						$lastTime = "19:00";
						$tmpTime = "";

						while(true){

							for($j = 0 ; $j < 2; $j++) {

									$tmpTime = $time; 
									$time = date("H:i", strtotime($time." + 30 Minute"));
							
									echo "<option value=' {$tmpTime} ~ {$time}'>{$tmpTime} ~ {$time}</option>";

									if($time == $lastTime) break;
									if($j == 0) echo " / ";
							}

							if($time == $lastTime) break;
							} 
						?>
				</select>
				<p class="title_h4">※단 주말은 PM04:30분까지 입니다.</p>
				<label for="wr_3"></label></span></li>


			</ul>
			<?php echo $captcha_html; ?>
		</div>
		<div class="bo_editor_wrap">
			<?php if($write_min || $write_max) { ?>
			<!-- 최소/최대 글자 수 사용 시 -->
			<p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
			<?php } ?>
			<?php 
				if(!$is_dhtml_editor){echo "<span class='placeholder'>";}
				echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 
				if(!$is_dhtml_editor){echo "<label for='wr_content'></label></span>";}
			?>
			<?php if($write_min || $write_max) { ?>
			<!-- 최소/최대 글자 수 사용 시 -->
			<div id="char_count_wrap"><span id="char_count"></span>글자</div>
			<?php } ?>
		</div>
		<? if($ad_btn) { ?>
		<? } ?>
	</div>
	<div id="lay">
		<p><?php include_once(G5_THEME_PATH.'/skin/board/fz_basic_pc_online/personal.php');?></p>
		<span id="close">닫기</span>
	</div>
	<div id="mask">
		개인정보취급방침<p id="layerBtn">[보기]</p><input type="checkbox" id="personal_info" value="agree">동의
	</div>
	<style>
	#layerBtn {cursor:pointer;}
	 #lay {position:absolute; top:50%; left:50%; height:400px; width:500px; margin-top:-200px; margin-left:-250px; background:#fff;  
	 text-align:left; z-index:160; }
	 #lay span {display:block; position:absolute; right:5px; bottom:5px; cursor:pointer;}
	 #blind_box {position:absolute; top:0; left:0; width:100%; height:100%; background:#000; z-index:50;} 
	</style>
	<script>
		$(document).ready(function(){
		   $("#lay").hide()
		   $("#layerBtn").click(function(){
			$('<div id="blind_box"></div>').css('opacity',0.3).appendTo('body');     
			$('#lay').fadeIn(300);    
			$('#lay').css('z-index', '100');        
		   });
		  
		   $("#close").click(function(){
			$("#blind_box").remove()
			$('#lay').hide()
		   });
		  });
	</script>
	<div class="write_foot">
		<input type="submit"id="btn_submit" class="list_btn btn_write" value="글쓰기" alt="글쓰기" />
	</div>

    </form>

	<script type="text/javascript">
    <?php if($write_min || $write_max) { ?>
    // 글자수 제한
    var char_min = parseInt(<?php echo $write_min; ?>); // 최소
    var char_max = parseInt(<?php echo $write_max; ?>); // 최대
    check_byte("wr_content", "char_count");

    $(function() {
        $("#wr_content").on("keyup", function() {
            check_byte("wr_content", "char_count");
        });
    });
    <?php } ?>
    function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "html2";
            else
                obj.value = "html1";
        }
        else
            obj.value = "";
    }

    function fwrite_submit(f)
    {
		<?php if($is_category){?>
		if(!$("#ca_name").val())
		{
			alert("카테고리는 필수 입력사항입니다. 카테고리를 선택해 주세요.");
			$("#ca_name").siblings("a").focus();
			return false;
		}
		<?php }?>
        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": f.wr_subject.value,
                "content": f.wr_content.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
                content = data.content;
            }
        });

        if (subject) {
            alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
            f.wr_subject.focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_wr_content) != "undefined")
                ed_wr_content.returnFalse();
            else
                f.wr_content.focus();
            return false;
        }

        if (document.getElementById("char_count")) {
            if (char_min > 0 || char_max > 0) {
                var cnt = parseInt(check_byte("wr_content", "char_count"));
                if (char_min > 0 && char_min > cnt) {
                    alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                    return false;
                }
                else if (char_max > 0 && char_max < cnt) {
                    alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                    return false;
                }
            }
        }

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }

	// ad 레이어 조작
	var ad_layer = function(kind) {

		var $button = $("#ad-btn_"+kind);
		var $form = $("#ad-form_"+kind);

		if($button.hasClass("on")) {
			clean_ad_layer();
			$("#ad-handle").hide();
		} else {
			clean_ad_layer();
			$button.addClass("on");
			$button.children("span").addClass("on");
			$form.show();
			$("#ad-handle").show();
		}
	}

	// ad 레이어 모두닫기
	var clean_ad_layer = function() {
		$("#ad-form-sector fieldset").hide();;
		$(".ad_btn_area a").removeClass("on");
		$(".ad_btn_area a span").removeClass("on");
	}


	// ad 파일 삭제
	var delete_ad_file = function(num) {

		var $wrap = $("#ad-file_input_"+num);
		$wrap.children("[name^=file_path_]").val("");
		$wrap.children("span").children("[name^=bf_content]").val("");

		$("#ad-file_list_"+num).remove();
		$("#bf_file_del_"+num).val('1');
	}

	// ad 레이어 닫기
	var close_ad_layer = function() {
		ad_layer($(".ad_btn_area a.on").attr("id").split("_")[1]);
	}

	$(function(){
		var $width = $("#bo_w").width();
		<?php if(!$board['bo_use_dhtml_editor']){?>
		$("#wr_content").css({width:$width-18+"px", padding:'8px'});
		<?php }?>
		$(".ad_form_area .filebox").width($width-111);
		$(".ad_form_area .i_text, .ad_form_area .i_text_large").width($width-50);
		<?php if(!$is_category){?>
		$("#wr_subject").width($width-14);
		<?php }?>

		$(".bo_w_ca_name").select_box({
			'height':31
			<?php if($is_category){?>
			, onload:function($select){
				$select.css('float', 'left');
				$("#wr_subject").width($width-$select.width()-26);
				$("#wr_subject").parent().css('float', 'right');
			}
			<?php }?>
		});
		$(".checkbox").check_box({fontSize:11});
	});

	function autoHypenPhone(str){
				str = str.replace(/[^0-9]/g, '');
				var tmp = '';
				if( str.length < 4){
					return str;
				}else if(str.length < 7){
					tmp += str.substr(0, 3);
					tmp += '-';
					tmp += str.substr(3);
					return tmp;
				}else if(str.length < 11){
					tmp += str.substr(0, 3);
					tmp += '-';
					tmp += str.substr(3, 3);
					tmp += '-';
					tmp += str.substr(6);
					return tmp;
				}else{              
					tmp += str.substr(0, 3);
					tmp += '-';
					tmp += str.substr(3, 4);
					tmp += '-';
					tmp += str.substr(7);
					return tmp;
				}
				return str;
			}

	var cellPhone = document.getElementById('wr_1');
	cellPhone.onkeyup = function(event){
			event = event || window.event;
			var _val = this.value.trim();
			this.value = autoHypenPhone(_val) ;
	}
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->