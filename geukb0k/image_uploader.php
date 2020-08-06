<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/preset.php';
?>
<?php
$file_name = $_FILES['upload_file']['name'];
$tmp_file = $_FILES['upload_file']['tmp_name'];

$file_path = $path['root'].'files/'.$file_name;
$image_url = $url['root'].'files/' . $file_name;

$r = move_uploaded_file($tmp_file, $file_path);

$file_size = $_FILES["upload_file"]["size"];
?>
