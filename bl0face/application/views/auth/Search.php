<?php
/**
 * Created by PhpStorm.
 * User: theline
 * Date: 2017-04-11
 * Time: 오전 11:38
 */
?>
<!-- main content start here -->
<div class="container" style="background-color:#fff;">
    <div class="row" style="padding:7%;">
        <?php $this->load->view('auth/Top_menu');?>
        <div class="tab-content">
            <div id="searchPanel" class="panel-wrap tab-pane fade in active">
                <div class="col-sm-12">
                    <h1 class="text-center" style="color:#005fc5;"><?=$this->lang->line("menu_auth_search");?></h1>
                    <p class="text-center" style="color:#005fc5;"><?=$this->lang->line("auth_search_word1");?></p>
                </div>
                <div class="col-sm-12" style="background-color:#f5f5f5;padding:10%;">
                    <p class="text-center"><?=$this->lang->line("auth_search_word2");?></p>
                    <div class="col-sm-12" style="margin:5% 0;">
                        <div class="col-sm-8">
                            <div class="row">
                                <form class="form form-horizontal" method="post" id="frm_search" name="frm_search" action="/auth/search_process">
                                    <div class="form-group">
                                        <label class="col-xs-5 col-sm-4 control-label"><span class="glyphicon glyphicon-menu-right" style="float:left;"></span><strong><?=$this->lang->line("auth_signup_word7");?></strong></label>
                                        <div class="col-xs-7 col-sm-8">
                                            <input class="form-control" type="text" id="name" name="name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-xs-5 col-sm-4 control-label"><span class="glyphicon glyphicon-menu-right" style="float:left;"></span><strong><?=$this->lang->line("board_write_email");?></strong></label>
                                        <div class="col-xs-7 col-sm-8">
                                            <input class="form-control" type="text" id="email" name="email">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="row">
                                <button type="button" id="btn_search" class="btn-login text-white" style="width:90%;float: right;height:83px;"><?=$this->lang->line("auth_search_word3");?></button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/Scripts');?>
<script type="text/javascript">
    $("#btn_search").click(function(){
        if($("#name").val() == ""){
            alert("<?=$this->lang->line("board_write_valid3");?>");
            $("#name").focus();
            return false;
        }
        if($("#email").val() == ""){
            alert("<?=$this->lang->line("auth_search_word4");?>");
            $("#email").focus();
            return false;
        }
        frm_search.submit();
    });
</script>
