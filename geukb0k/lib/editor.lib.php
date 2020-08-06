<?php	// 에디터 함수

function cheditor1($id, $width='100%', $height='250'){
	return "
	<script type='text/javascript'>
	var ed_{$id} = new cheditor('ed_{$id}');
	ed_{$id}.config.editorHeight = '{$height}';
	ed_{$id}.config.editorWidth = '{$width}';
	ed_{$id}.inputForm = 'tx_{$id}';
	</script>";
}



function cheditor2($id, $content=''){
    return "
    <textarea name='{$id}' id='tx_{$id}' style='display:none;'>{$content}</textarea>
    <script type='text/javascript'>
    ed_{$id}.run();
    </script>";
}
 
function cheditor3($id){
    return "document.getElementById('tx_{$id}').value = ed_{$id}.outputBodyHTML();";
}
?>