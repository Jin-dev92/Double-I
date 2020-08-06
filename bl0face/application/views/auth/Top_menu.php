<?php
/**
 * Created by PhpStorm.
 * User: theline
 * Date: 2017-06-23
 * Time: 오후 5:09
 */
?>
<nav id="subCateNavWrap" class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul id="subCateNav" class="nav nav-tabs nav-justified">
                <?php
                if(empty($this->session->userdata('id'))) {
                    ?>
                    <li <?=($this->uri->segment(2) == "signup")?"class='active'":""?>><a href="/auth/signup"><?=$this->lang->line("menu_auth_signup");?> <?=($this->uri->segment(2) == "signup")?"<span class='sr-only'>(current)</span>":""?></a></li>
                    <li <?=($this->uri->segment(2) == "login")?"class='active'":""?>><a href="/auth/login"><?=$this->lang->line("menu_auth_login");?> <?=($this->uri->segment(2) == "login")?"<span class='sr-only'>(current)</span>":""?></a></li>
                    <li <?=($this->uri->segment(2) == "search")?"class='active'":""?>><a href="/auth/search"><?=$this->lang->line("menu_auth_search");?> <?=($this->uri->segment(2) == "search")?"<span class='sr-only'>(current)</span>":""?></a></li>
                    <?php
                }else {
                    ?>
                    <li <?=($this->uri->segment(2) == "modify")?"class='active'":""?>><a href="/auth/modify"><?=$this->lang->line("menu_auth_modify");?> <?=($this->uri->segment(2) == "modify")?"<span class='sr-only'>(current)</span>":""?></a></li>
                    <li <?=($this->uri->segment(2) == "secession")?"class='active'":""?>><a href="/auth/secession"><?=$this->lang->line("menu_auth_secession");?> <?=($this->uri->segment(2) == "secession")?"<span class='sr-only'>(current)</span>":""?></a></li>
                    <?php
                }
                ?>
                <li <?=($this->uri->segment(2) == "agree")?"class='active'":""?>><a href="/auth/agree"><?=$this->lang->line("menu_auth_agree");?> <?=($this->uri->segment(2) == "agree")?"<span class='sr-only'>(current)</span>":""?></a></li>
                <li <?=($this->uri->segment(2) == "policy_email")?"class='active'":""?>><a href="/auth/policy_email"><?=$this->lang->line("menu_auth_policy_email");?> <?=($this->uri->segment(2) == "policy_email")?"<span class='sr-only'>(current)</span>":""?></a></li>
                <li <?=($this->uri->segment(2) == "policy")?"class='active'":""?>><a href="/auth/policy"><?=$this->lang->line("menu_auth_policy");?> <?=($this->uri->segment(2) == "policy")?"<span class='sr-only'>(current)</span>":""?></a></li>
            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
