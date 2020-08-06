<?php
/**
 * Created by PhpStorm.
 * User: theline
 * Date: 2017-04-11
 * Time: 오후 3:39
 */
?>
<!-- main content start here -->
<div class="container" style="background-color:#fff;">
    <div class="row" style="padding:7%;">
        <?php $this->load->view('auth/Top_menu');?>
        <div class="tab-content">
            <div id="secedePanel" class="panel-wrap tab-pane fade in active">
                <div class="col-sm-12">
                    <h1 class="text-center" style="color:#005fc5;"><?=$this->lang->line("auth_secede_word1");?></h1>
                    <p class="text-center" style="color:#005fc5;"><?=$this->lang->line("auth_secede_word2");?></p>
                </div>
                <div class="col-sm-12" style="background-color:#f5f5f5;padding:10%;">
                    <p class="text-center"><?=$this->lang->line("auth_secede_word3");?></p>
                    <div class="col-sm-12" style="margin:5% 0;">
                        <div class="col-sm-8">
                            <div class="row">
                                <form class="form form-horizontal" id="frm_secession" name="frm_secession" method="post" action="/auth/secession_process">
                                    <div class="form-group">
                                        <label class="col-xs-5 col-sm-4 control-label"><span class="glyphicon glyphicon-menu-right" style="float:left;"></span><strong><?=$this->lang->line("auth_login_word4");?></strong></label>
                                        <div class="col-xs-7 col-sm-8">
                                            <input class="form-control" type="text" id="login_id" name="login_id">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-xs-5 col-sm-4 control-label"><span class="glyphicon glyphicon-menu-right" style="float:left;"></span><strong><?=$this->lang->line("board_write_password");?></strong></label>
                                        <div class="col-xs-7 col-sm-8">
                                            <input class="form-control" type="password" id="login_password" name="login_password">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="row">
                                <button id="btn_secession" class="btn-login text-white" style="width:90%;float: right;height:83px;"><?=$this->lang->line("auth_secede_word4");?></button>
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
    $("#btn_secession").click(function(){
        if($("#login_id").val() == ""){
            alert("<?=$this->lang->line("auth_secede_word5");?>");
            $("#login_id").focus();
            return false;
        }
        if($("#login_password").val() == ""){
            alert("<?=$this->lang->line("auth_secede_word6");?>");
            $("#login_password").focus();
            return false;
        }
        frm_secession.submit();
    });
</script>
