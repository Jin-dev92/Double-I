<?php
/**
 * Created by 백성현.
 * User: bioface
 * Date: 2018-03-06
 * Time: 오후 7:17
 */
?>
<div class="container-fluid" style="background-color:#9ec4ec;padding-top:24px;padding-bottom:80px;">
    <h5 class="text-center" style="color:#6982af;"><strong>THELINE BEAUTY ANTIANG</strong></h5>
    <h1 class="text-center text-white"><strong><?=$title?></strong></h1>
</div>
<div class="container" style="margin-top:-54px;background-color:#cfe2f6;padding:0;">
    <a id="breadcrumMobile" href="#" class="collapsed" data-toggle="collapse" data-target="#breadcrum" aria-expanded="false" aria-controls="navbar" style="width:100%;padding:15px;">
        <?=$title?>
        <span class="glyphicon glyphicon-menu-down" style="float:right;"></span>
    </a>

    <!-- navigation breadcrumb start here -->
    <div id="breadcrum" class="breadcrumb-nav navbar-collapse collapse">
        <ul style="padding: 0;">
            <li>
                <a href="/" style="float:left;">Home</a>
                <span class="glyphicon glyphicon-menu-down text-white" style="float:right;"></span>
            </li>
            <li class="<?=(empty($menu2))?"active":""?>">
                <a href="<?=$menu1_link?>" style="float:left;"><?=$menu1?></a>
                <span class="glyphicon glyphicon-menu-down text-white" style="float:right;"></span>
            </li>
            <?php
            if(empty($menu2)) {
                ?>
                <li class="last">

                </li>
                <?php
            }else{?>
                <li class="active">
                    <a href="<?=$menu2_link?>" style="float:left;"><?=$menu2?></a>
                    <span class="glyphicon glyphicon-menu-down text-white" style="float:right;"></span>
                </li>
            <?php }?>
            <li class="last">

            </li>
        </ul>
    </div>
    <!-- navigation breadcrumb end here -->
</div>
