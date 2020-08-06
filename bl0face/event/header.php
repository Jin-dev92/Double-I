<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bioevent</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean1.css">
    <link rel="stylesheet" href="assets/css/styles.css?<?=rand()?>">
    <link rel="stylesheet" href="assets/fonts/font.css">
    <script src="assets/js/jquery.min.js"></script>
</head>
<script type="text/javascript">
function agree_on(){
  $(".popup").show();
  $(".bac").show();
}
</script>
<?
  $approach = $_GET['approach'];
  if (!$_GET['approach']) {
    $approach= "null";
  }
  $nowurl = $_SERVER["REQUEST_URI"];
  $script = explode("page=",$nowurl);
  $thisurl = explode("/",$script[0]);
  $url = explode(".php",$thisurl[2]);
  $cate = $script[1];
  $cate2 = $url[0];
  $get_json = file_get_contents('assets/js/item.json');
  $get_item = file_get_contents('assets/js/in_item.json');
?>
<body>
    <div>
        <nav class="navbar navbar-default navigation-clean">
            <div class="container">
                <div class="navbar-header"><a class="navbar-brand" href="index.php?approach=<?=$approach?>&page="><span>특별한 시술을 찾는 당신만의 특별한 공간</span>BIOFACE SPECIAL FLEX</a>
                    <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                </div>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav navbar-right">
                      <li role="presentation" class="all_cate"><a href="index.php?approach=<?=$approach?>&page=">시술 전체보기</a></li>
                      <li role="presentation" class="tofgold_cate"><a href="index.php?approach=<?=$approach?>&page=tofgold">명품필러</a></li>
                      <li role="presentation" class="tof_cate"><a href="index.php?approach=<?=$approach?>&page=tof">티오필 </a></li>
                      <li role="presentation" class='anti_cate'><a href="index.php?approach=<?=$approach?>&page=anti">스페셜 안티에이징 </a></li>
                      <li role="presentation" class="filler_cate"><a href="index.php?approach=<?=$approach?>&page=filler">필러 </a></li>
                      <li role="presentation" class='liffting_cate'><a href="index.php?approach=<?=$approach?>&page=liffting">리프팅 </a></li>
                      <li role="presentation" class="skin_cate"><a href="index.php?approach=<?=$approach?>&page=skin">피부관리 </a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
