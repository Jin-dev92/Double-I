<?php
/**
 * Created by PhpStorm.
 * User: theline
 * Date: 2017-04-24
 * Time: 오후 1:30
 */
?>
<!-- main content start here -->
<div class="container" style="background-color:#fff;">
    <div class="row" style="padding:7%;">
        <div class="tab-content">
            <div id="termsPanel" class="panel-wrap tab-pane fade in active">
                <div class="col-sm-12">
                    <h1 class="text-center" style="color:#005fc5;"><?=$this->lang->line("auth_add_info_word1");?></h1>
                    <p class="text-center" style="color:#005fc5;"><?=$this->lang->line("auth_add_info_word2");?></p>
                </div>
                <div class="col-sm-12" style="background-color:#f5f5f5;padding-left:10%;padding-right:10%;padding">

                    <div class="page-header">
                        <h4><?=$this->lang->line("auth_add_info_word3");?> </h4>
                    </div>

                    <form class="form form-horizontal" method="post" id="frm_addinfo" name="frm_addinfo" style="padding:0;">
                        <div class="form-group" style="padding:0;">
                            <label class="control-label col-xs-4 col-sm-2" style="text-align:left;padding: 10px 0;"><strong><span class="glyphicon glyphicon-menu-right"></span> <?=$this->lang->line("auth_signup_word7");?></strong></label>

                            <div class="col-xs-8 col-sm-10">
                                <input class="form-control" type="text" id="name" name="name" value="<?=$this->session->userdata['name']?>">
                            </div>

                        </div>
                        <hr>

                        <div class="form-group" style="padding:0;">
                            <label class="control-label col-xs-4 col-sm-2" style="text-align:left;padding: 10px 0;"><strong><span class="glyphicon glyphicon-menu-right"></span> <?=$this->lang->line("auth_signup_word8");?></strong></label>

                            <div class="col-xs-8 col-sm-10">
                                <input class="form-control" type="text" id="cell" name="cell">
                                <div class="checkbox">
                                    <label><input type="checkbox" id="issms" name="issms"> <?=$this->lang->line("agree");?></label>
                                </div>
                            </div>

                        </div>
                        <hr>

                        <div class="form-group" style="padding:0;">
                            <label class="control-label col-xs-12 col-sm-12" style="text-align:left;padding: 10px 0;"><strong><span class="glyphicon glyphicon-menu-right"></span> <?=$this->lang->line("menu_word5");?></strong></label>

                            <div class="col-sm-12">
                                <div class="checkbox" style="padding-left:15px;">
                                    <label><input type="checkbox" name="clinicFK1"> <?=$this->lang->line("auth_signup_word10");?></label>
                                    <label><input type="checkbox" name="clinicFK2"> <?=$this->lang->line("auth_signup_word11");?></label>
                                    <label><input type="checkbox" name="clinicFK3"> <?=$this->lang->line("auth_signup_word12");?></label>
                                    <label><input type="checkbox" name="clinicFK4"> <?=$this->lang->line("auth_signup_word13");?></label>
                                    <label><input type="checkbox" name="clinicFK5"> <?=$this->lang->line("auth_signup_word14");?></label>
                                    <label><input type="checkbox" name="clinicFK6"> <?=$this->lang->line("auth_signup_word15");?></label>
                                    <label><input type="checkbox" name="clinicFK7"> <?=$this->lang->line("auth_signup_word16");?></label>
                                    <label><input type="checkbox" name="clinicFK8"> <?=$this->lang->line("auth_signup_word17");?></label>
                                    <label><input type="checkbox" name="clinicFK9"> <?=$this->lang->line("auth_signup_word18");?></label>
                                    <label><input type="checkbox" name="clinicFK10"> <?=$this->lang->line("auth_signup_word19");?></label>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="form-group">
                            <label class="control-label col-xs-4 col-sm-2" style="text-align:left;padding: 10px 0;"><strong><span class="glyphicon glyphicon-menu-right"></span> <?=$this->lang->line("auth_signup_word20");?></strong></label>

                            <div class="col-xs-8 col-sm-10">
                                <select class="form-control" id="route" name="route">
                                    <option value=""><?=$this->lang->line("auth_signup_word21");?></option>
                                    <option value="1"><?=$this->lang->line("auth_signup_word22");?></option>
                                    <option value="2"><?=$this->lang->line("auth_signup_word23");?></option>
                                    <option value="3"><?=$this->lang->line("auth_signup_word24");?></option>
                                    <option value="4"><?=$this->lang->line("auth_signup_word25");?></option>
                                    <option value="5"><?=$this->lang->line("auth_signup_word26");?></option>
                                    <option value="6"><?=$this->lang->line("auth_signup_word27");?></option>
                                    <option value="7"><?=$this->lang->line("auth_signup_word28");?></option>
                                    <option value="8"><?=$this->lang->line("auth_signup_word29");?></option>
                                    <option value="9"><?=$this->lang->line("auth_signup_word30");?></option>
                                    <option value="10"><?=$this->lang->line("auth_signup_word31");?></option>
                                </select>
                            </div>
                        </div>
                        <hr>
                    </form>

                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="row">
                            <button class="btn" id="btn_save" style="width:100%;background-color:#005fc5;color:#fff;margin:0 auto;display:inline-block;"><?=$this->lang->line("confirm");?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/Scripts');?>
<script type="text/javascript">
    $("#btn_save").click(function(){
        if($("#name").val() == ""){
            alert("<?=$this->lang->line("board_write_valid3");?>");
            $("#name").focus();
            return false;
        }
        if($("#cell").val() == ""){
            alert("<?=$this->lang->line("auth_add_info_word4");?>");
            $("#cell").focus();
            return false;
        }
        if($("#route").val() == ""){
            alert("<?=$this->lang->line("auth_add_info_word5");?>");
            $("#route").focus();
            return false;
        }
        frm_addinfo.action = "/auth/add_info_process";
        frm_addinfo.submit();
    });
</script>
