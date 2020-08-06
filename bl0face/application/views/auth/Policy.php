<?php
/**
 * Created by PhpStorm.
 * User: theline
 * Date: 2017-04-11
 * Time: 오후 3:24
 */
?>
<!-- main content start here -->
<div class="container" style="background-color:#fff;">
    <div class="row" style="padding:7%;">
        <?php $this->load->view('auth/Top_menu');?>
        <div class="tab-content">
            <div id="policyPanel" class="panel-wrap tab-pane fade in active">
                <div class="col-sm-12">
                    <h1 class="text-center" style="color:#005fc5;"><?=$this->lang->line("policy_word1");?></h1>
                </div>
                <div class="col-sm-12" style="background-color:#f5f5f5;padding:10%;">

                    <div class="row" style="padding:10%;"><?=$this->lang->line("policy_word2");?>
                    </div>
                </div>

                <hr>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/Scripts');?>

