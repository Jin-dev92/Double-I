<?php
include_once "path.php";
// ---------------------------------------------------------------------------
// 이미지가 저장될 디렉토리의 전체 경로를 설정합니다.
// 끝에 슬래쉬(/)는 붙이지 않습니다.
// 주의: 이 경로의 접근 권한은 쓰기, 읽기가 가능하도록 설정해 주십시오.

// // 현재 디렉토리
// echo getcwd() . "\n";

// chdir('cvs');

// // 현재 디렉토리
// echo getcwd() . "\n";


@mkdir("/home/hosting_users/bioface1/www/data/editor", 0707);
@chmod("/home/hosting_users/bioface1/www/data/editor", 0707);


$ym = date("Ym");

define("SAVE_DIR", "/home/hosting_users/bioface1/www/data/editor/$ym");

@mkdir(SAVE_DIR, 0707);
@chmod(SAVE_DIR, 0707);

# 위에서 설정한 'SAVE_DIR'의 URL을 설정합니다.
# 끝에 슬래쉬(/)는 붙이지 않습니다.

define("SAVE_URL", "http://bioface.kr/data/editor/$ym");


?>
