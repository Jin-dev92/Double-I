<?php
/**
 * Created by PhpStorm.
 * User: 홍승기
 * Date: 2016-08-23
 * Time: 오후 1:38
 */
class Member_m extends CI_Model {

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();

        $this->table="g5_member";
    }

    //로그인 체크
    public function login() {
        $pass = $_POST['mb_password'];
        $where = "mb_id =" . "'" . $_POST['mb_id'] . "' and mb_password =password('".$pass."') ";
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($where);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //SNS 로그인 체크
    public function login_SNS(){
        if($this->checkValidId() == 0){
            $this->db
                ->set('hospitalFK', 1)
                ->set('grade', 9)
                ->set('type', 9)
                ->set('id', $_POST['id'])
                ->set('email', $_POST['email'])
                ->set('name', $_POST['name']);

            $this->db->insert($this->table);
            //echo $this->db->last_query();
            $value = 0;
        }else{
            $value = 1;
        }
        return $value;
    }

    //회원정보 리턴
    function getMember($id){
        $where = "mb_id =" . "'" . $id . "'";
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($where);
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->row_array();
    }



    function getMember_no($no){
        $where = "no =" . "'" . $no . "'";
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($where);
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->row_array();
    }

    function setMember(){
      if ( !$_POST['mb_mailling']) {
      $mailling =0;
    }else {
      $mailling =1;
    }
    if ( !$_POST['mb_sms']) {
    $sms =0;
  }else {
    $sms =1;
  }
        $this->db
            ->set('mb_id', $_POST['mb_id'])
            ->set('mb_password', "PASSWORD('".$_POST['mb_password']."')", false)
            ->set('mb_name', $_POST['mb_name'])
            ->set('mb_hp', $_POST['mb_hp'])
            ->set('mb_level', 2)
            ->set('mb_email', $_POST['mb_email'])
            ->set('mb_datetime', DATE("Y-m-d h:i:s",time()))
            ->set('mb_mailling', $mailling)
            ->set('mb_sms', $sms);

        $this->db->insert($this->table);
    }

    function updateMember(){
        // if(isset($_POST['issms'])){ $_POST['issms'] = ($_POST['issms'] == "on")? "0": "1"; }else{ $_POST['issms'] = 1;}
        // if(isset($_POST['ismail'])){ $_POST['ismail'] = ($_POST['ismail'] == "on")? "0": "1"; }else{ $_POST['ismail'] = 1;}

        // if(isset($_POST['clinicFK1'])){ $_POST['clinicFK1'] = ($_POST['clinicFK1'] == "on")? "1": "0"; }else{ $_POST['clinicFK1'] = 0;}
        // if(isset($_POST['clinicFK2'])){ $_POST['clinicFK2'] = ($_POST['clinicFK2'] == "on")? "1": "0"; }else{ $_POST['clinicFK2'] = 0;}
        // if(isset($_POST['clinicFK3'])){ $_POST['clinicFK3'] = ($_POST['clinicFK3'] == "on")? "1": "0"; }else{ $_POST['clinicFK3'] = 0;}
        // if(isset($_POST['clinicFK4'])){ $_POST['clinicFK4'] = ($_POST['clinicFK4'] == "on")? "1": "0"; }else{ $_POST['clinicFK4'] = 0;}
        // if(isset($_POST['clinicFK5'])){ $_POST['clinicFK5'] = ($_POST['clinicFK5'] == "on")? "1": "0"; }else{ $_POST['clinicFK5'] = 0;}
        // if(isset($_POST['clinicFK6'])){ $_POST['clinicFK6'] = ($_POST['clinicFK6'] == "on")? "1": "0"; }else{ $_POST['clinicFK6'] = 0;}
        // if(isset($_POST['clinicFK7'])){ $_POST['clinicFK7'] = ($_POST['clinicFK7'] == "on")? "1": "0"; }else{ $_POST['clinicFK7'] = 0;}
        // if(isset($_POST['clinicFK8'])){ $_POST['clinicFK8'] = ($_POST['clinicFK8'] == "on")? "1": "0"; }else{ $_POST['clinicFK8'] = 0;}
        // if(isset($_POST['clinicFK9'])){ $_POST['clinicFK9'] = ($_POST['clinicFK9'] == "on")? "1": "0"; }else{ $_POST['clinicFK9'] = 0;}
        // if(isset($_POST['clinicFK10'])){ $_POST['clinicFK10'] = ($_POST['clinicFK10'] == "on")? "1": "0"; }else{ $_POST['clinicFK10'] = 0;}
        $checked = $this->input->post('mb_mailling');
        $checked2 = $this->input->post('mb_sms');
        $checked_val_sms = 0;
        $checked_val_mail = 0;

        if(isset($checked)) {
            $checked_val_mail = 1;
        }
        if(isset($checked2)) {
            $checked_val_sms = 1;
        }

        $this->db
            ->set('mb_name', $_POST['mb_name'])
            ->set('mb_email', $_POST['mb_email'])
            ->set('mb_hp', $_POST['mb_hp'])
            ->set('mb_mailling', $checked_val_mail)
            ->set('mb_sms', $checked_val_sms);

        if(isset($_POST['mb_password']) && $_POST['mb_password'] <> ""){
            $this->db->set('mb_password', "PASSWORD('".$_POST['mb_password']."')", false);
        }

        $this->db->where('mb_id', $this->session->userdata['id']);
        $this->db->update($this->table);
    }

    function updateMemberforSNS(){
        if(isset($_POST['issms'])){ $_POST['issms'] = ($_POST['issms'] == "on")? "0": "1"; }else{ $_POST['issms'] = 1;}

        if(isset($_POST['clinicFK1'])){ $_POST['clinicFK1'] = ($_POST['clinicFK1'] == "on")? "1": "0"; }else{ $_POST['clinicFK1'] = 0;}
        if(isset($_POST['clinicFK2'])){ $_POST['clinicFK2'] = ($_POST['clinicFK2'] == "on")? "1": "0"; }else{ $_POST['clinicFK2'] = 0;}
        if(isset($_POST['clinicFK3'])){ $_POST['clinicFK3'] = ($_POST['clinicFK3'] == "on")? "1": "0"; }else{ $_POST['clinicFK3'] = 0;}
        if(isset($_POST['clinicFK4'])){ $_POST['clinicFK4'] = ($_POST['clinicFK4'] == "on")? "1": "0"; }else{ $_POST['clinicFK4'] = 0;}
        if(isset($_POST['clinicFK5'])){ $_POST['clinicFK5'] = ($_POST['clinicFK5'] == "on")? "1": "0"; }else{ $_POST['clinicFK5'] = 0;}
        if(isset($_POST['clinicFK6'])){ $_POST['clinicFK6'] = ($_POST['clinicFK6'] == "on")? "1": "0"; }else{ $_POST['clinicFK6'] = 0;}
        if(isset($_POST['clinicFK7'])){ $_POST['clinicFK7'] = ($_POST['clinicFK7'] == "on")? "1": "0"; }else{ $_POST['clinicFK7'] = 0;}
        if(isset($_POST['clinicFK8'])){ $_POST['clinicFK8'] = ($_POST['clinicFK8'] == "on")? "1": "0"; }else{ $_POST['clinicFK8'] = 0;}
        if(isset($_POST['clinicFK9'])){ $_POST['clinicFK9'] = ($_POST['clinicFK9'] == "on")? "1": "0"; }else{ $_POST['clinicFK9'] = 0;}
        if(isset($_POST['clinicFK10'])){ $_POST['clinicFK10'] = ($_POST['clinicFK10'] == "on")? "1": "0"; }else{ $_POST['clinicFK10'] = 0;}

        $this->db
            ->set('ismail', 1)
            ->set('name', $_POST['name'])
            ->set('cell', $_POST['cell'])
            ->set('issms', $_POST['issms'])
            ->set('clinicFK1', $_POST['clinicFK1'])
            ->set('clinicFK2', $_POST['clinicFK2'])
            ->set('clinicFK3', $_POST['clinicFK3'])
            ->set('clinicFK4', $_POST['clinicFK4'])
            ->set('clinicFK5', $_POST['clinicFK5'])
            ->set('clinicFK6', $_POST['clinicFK6'])
            ->set('clinicFK7', $_POST['clinicFK7'])
            ->set('clinicFK8', $_POST['clinicFK8'])
            ->set('clinicFK9', $_POST['clinicFK9'])
            ->set('clinicFK10', $_POST['clinicFK10'])
            ->set('route', $_POST['route']);

        $this->db->where('id', $this->session->userdata['id']);
        $this->db->update($this->table);
    }

    function update_Secession(){
        $this->db->set('secession','1');
        $this->db->where('mb_id', $_POST['mb_id']);
        $this->db->update($this->table);
    }

    function checkValidId(){
        $this->db->where($this->table.".id", $_POST['wr_id']);
        $query = $this->db->get($this->table);

        return $query->num_rows();
    }

    function checkValidEmail(){
        $this->db->where($this->table.".email", $_POST['email']);
        $query = $this->db->get($this->table);

        return $query->num_rows();
    }

    function checkSearch(){
        $this->db->where($this->table.".name", $_POST['name']);
        $this->db->where($this->table.".email", $_POST['email']);
        $query = $this->db->get($this->table);

        return $query->num_rows();
    }

    function resetPassword($password){
        $this->db->set('password', "PASSWORD('".$password."')", false);

        $this->db->where($this->table.".name", $_POST['name']);
        $this->db->where($this->table.".email", $_POST['email']);
        $this->db->update($this->table);
    }

    function unsubscribe(){
        $this->db->set('ismail', 1);

        $this->db->where($this->table.".email", $this->uri->segment(3));
        $this->db->update($this->table);
    }

    // 비밀번호 찾기
    function find_pwd()
    {
        $board_name_re = "g5_member";
        $id = $_POST['mb_id'];
        $email = $_POST['mb_email'];
        $pwd = '0000000';
        // 비밀번호 확인
        if($this->db->query("SELECT * FROM $board_name_re WHERE mb_id= '$id' and mb_email = '$email'")->row_array()){
            $this->db
            ->set('mb_password', "PASSWORD('".$pwd."')", false);

            $this->db->where('mb_id', $id);
            $this->db->update($this->table);
            return true;
        } else {
            return false;
        }
    }
}
