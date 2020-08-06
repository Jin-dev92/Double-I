<?php
/**
 * Created by PhpStorm.
 * User: 홍승기
 * Date: 2016-08-24
 * Time: 오후 5:14
 */
class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->model('Member_m');
    }

    function index()
    {
        redirect('/auth/login');
    }

    function Searchresult($method){
      $memberdata=$this->Member_m->checkinfo($method);
      $this->load->helper('email');
      $this->load->library('email');
      $subject='비오페이스입니다.';
      if ($method=='id') {
        $content='고객님의 아이디는 '.$memberdata['mb_id'].'입니다.';
      }
      if ($method=='password') {
        $content='고객님의 비밀번호는 0000000으로 초기화 되었습니다.';
      }
      //e-mail config
      $this->email->initialize(array('validate'=>'true'));
      //
      $this->email->from('m36542m@daum.net', '비오페이스');
      $this->email->to($memberdata['mb_email']);
      $this->email->subject($subject);
      $this->email->message($content);
      if (valid_email($_POST['mb_email'])) {
        $this->Member_m->pwdconstruct($memberdata['mb_id']);
        $this->email->send();
      }else {
          alert('입력하신 정보와 일치하는 회원정보를 찾을 수 없습니다. 입력 정보 또는 회원가입 여부를 확인해주세요.');
          return false;
      }

      // if ($this->email->send()) {
      //   // alert('성공');
      // }else {
      //   return false;
      // }




      $seg = $this->uri->segment(1);
      $header_data=headerdataload($seg);
      $this->load->view('layout/Setting');
      $this->load->view('layout/header',$header_data);
      $this->load->view('auth/Searchresult');
      $this->load->view('layout/Footer');
    }
    //정보 찾기 입력 페이지
    // function searchinfo(){
    //   $seg = $this->uri->segment(1);
    //   $header_data=headerdataload($seg);
    //   $this->load->view('layout/Setting');
    //   $this->load->view('layout/header',$header_data);
    //   $this->load->view('auth/Searchinfo');
    //   $this->load->view('layout/Footer');
    // }
    //회원가입
    function signup(){
        $seg = $this->uri->segment(1);
        $header_data=headerdataload($seg);
        $this->load->view('board/Board_css');
        $this->load->view('layout/Setting');
        if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
            // PC
            $this->load->view('layout/header',$header_data);
            $this->load->view('layout/Scripts');
        } else {
            //MOBILE
            $this->load->view('layout/header_m',$header_data);
            $this->load->view('layout/Scripts_m');
        }
        $this->load->view('auth/Signup');
        $this->load->view('layout/Footer');
    }

    //SNS 사용자 추가정보 입력
    function add_info(){

        $this->load->view('layout/Setting');
        $this->load->view('layout/header', $this->data_header);
        $this->load->view('layout/Top',$data_top);
        $this->load->view('auth/Add_info');
        $this->load->view('layout/Footer');
    }

    //SNS 사용자 추가정보 입력 프로세스
    function add_info_process(){
        $this->Member_m->updateMemberforSNS();

        alert($this->lang->line("controller_word1"), '/auth/login');
    }

    function signup_process(){
        $this->Member_m->setMember();
		naverlogscript("2");
        alert("회원가입을 축하드립니다.", '/auth/login');
    }

    //회원약관
    function agree(){

        $seg = $this->uri->segment(1);
        $header_data=headerdataload($seg);
        $this->load->view('board/Board_css');
        $this->load->view('layout/Setting');
        if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
            // PC
            $this->load->view('layout/header',$header_data);
            $this->load->view('layout/Scripts');
        } else {
            //MOBILE
            $this->load->view('layout/header_m',$header_data);
            $this->load->view('layout/Scripts_m');
        }
        $this->load->view('auth/Agree');
        $this->load->view('layout/Footer');
    }

    // 비밀번호찾기
    function Searchinfo(){

        $seg = $this->uri->segment(1);
        $header_data=headerdataload($seg);
        $this->load->view('board/Board_css');
        $this->load->view('layout/Setting');
        if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
            // PC
            $this->load->view('layout/header',$header_data);
            $this->load->view('layout/Scripts');
        } else {
            //MOBILE
            $this->load->view('layout/header_m',$header_data);
            $this->load->view('layout/Scripts_m');
        }
        $this->load->view('auth/Searchinfo');
        $this->load->view('layout/Footer');
    }

    function find_pw()
    {
        $result = $this->Member_m->find_pwd();
        if ($result) {
            alert("비밀번호가 0000000으로 초기화되었습니다.","/auth/login");
        }else {
            alert("입력하신 아이디와 이메일이 일치하지않습니다.","/auth/Searchinfo");
        }
    }

    //로그인
    function login(){
        if ($this->session->userdata('name')) {
          alert("이미 로그인이 되어있습니다. 로그아웃을 하시고 이용해주시기 바랍니다.","/");
        }
        $seg = $this->uri->segment(1);
        $header_data=headerdataload($seg);
        $this->load->view('board/Board_css');
        $this->load->view('layout/Setting');
        if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
            // PC
            $this->load->view('layout/header',$header_data);
            $this->load->view('layout/Scripts');
        } else {
            //MOBILE
            $this->load->view('layout/header_m',$header_data);
            $this->load->view('layout/Scripts_m');
        }

        $this->load->view('auth/Login');
        $this->load->view('layout/Footer');
    }

    //ID/PW 찾기
    function search(){
        $seg = $this->uri->segment(1);
        $header_data=headerdataload($seg);
        $this->load->view('board/Board_css');
        $this->load->view('layout/Setting');
        $this->load->view('layout/header',$header_data);
        $this->load->view('auth/Search');
        $this->load->view('layout/Scripts');
        $this->load->view('layout/Footer');
    }

    function search_process(){
        //이름, 이메일로 체크
        if($this->Member_m->checkSearch() == 0){
            alert($this->lang->line("controller_word4"), '/auth/search');
        }else{
            //비밀번호 초기화
            $password = substr(uniqid('', true), -5);
            $this->Member_m->resetPassword($password);

            //이메일 전송
            $html = email_html_search($_POST['name'], $_POST['email'], $password);
            Send_email($_POST['email'], $this->lang->line("controller_word5"), $html);

            alert($this->lang->line("controller_word6"), '/auth/login');
        }
    }

    //회원정보수정
    function modify(){
        if ($this->session->userdata('level')<1) {
            alert("로그인이 필요합니다.","/auth/login");
        }
        $data = $this->Member_m->getMember($this->session->userdata['id']);
        $this->load->view('board/Board_css');
        $this->load->view('layout/Setting');
        if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
            // PC
            $this->load->view('layout/header');
            $this->load->view('layout/Scripts');
        } else {
            //MOBILE
            $this->load->view('layout/header_m');
            $this->load->view('layout/Scripts_m');
        }
        $this->load->view('auth/Modify', array("data"=>$data));
        $this->load->view('layout/Footer');
    }

    function modify_process(){
        //회원정보 수정 업데이트
        $this->Member_m->updateMember();

        // alert($this->lang->line("controller_word7"), '/index');
        alert('정보가 수정되었습니다.', '/auth/Modify');
    }

    //개인정보보호방침
    function policy(){


        $this->load->view('layout/Setting');
        $this->load->view('layout/header', $this->data_header);
        $this->load->view('layout/Top',$data_top);
        $this->load->view('auth/Policy');
        $this->load->view('layout/Footer');
    }

    //개인정보보호방침
    function policy_email(){


        $this->load->view('layout/Setting');
        $this->load->view('layout/header', $this->data_header);
        $this->load->view('layout/Top',$data_top);
        $this->load->view('auth/Policy_email');
        $this->load->view('layout/Footer');
    }

    //회원탈퇴
    function secession(){
        $this->load->view('layout/Setting');
        $this->load->view('layout/header', $this->data_header);
        $this->load->view('layout/Top',$data_top);
        $this->load->view('auth/Secession');
        $this->load->view('layout/Footer');
    }

    function secession_process(){
        //아이디, 비번 체크
        if($this->Member_m->login() == 0){
            alert($this->lang->line("controller_word8"), '/auth/secession');
        }
        //탈퇴처리
        $this->Member_m->update_Secession();
        $this->session->sess_destroy();
        alert($this->lang->line("controller_word9"), '/index');
    }

    function change_lang(){
        $this->session->set_userdata('site_lang', $this->uri->segment(3));
        switch ($this->uri->segment(3)){
            case "korea":
                $this->session->set_userdata('locale_lang', 'ko');
                break;
            case "china":
                $this->session->set_userdata('locale_lang', 'zh');
                break;
        }

        redirect("/index");
    }

    function login_process(){
        $data['id'] = trim($_POST['mb_id']);
        $data['password'] = trim($_POST['mb_password']);
        if($this->Member_m->login() == true){
            $userdata = $this->Member_m->getMember(trim($_POST['mb_id']));
            $session_data = array(
                'no'=> $userdata['mb_no'],
                'id' => $userdata['mb_id'],
                'name' => $userdata['mb_name'],
                'email' => $userdata['mb_name'],
                'level' => $userdata['mb_level'],
                'tel' => $userdata['mb_tel'],
                'email' => $userdata['mb_email'],
                'login_chk' => '1'
            );

            //로그인 성공
            $this->session->set_userdata($session_data);
            $user_name_sess = $this->session->userdata('name');

            // 로그인 데이타
            $IP = $_SERVER['REMOTE_ADDR'];
            $this->db
            ->set('mb_login_ip',$IP)
            ->set('mb_today_login',DATE("Y-m-d h:i:s",time()));

            $this->db->where('mb_id', $data['id']);
            $this->table="g5_member";
            $this->db->update($this->table);

            //쿠키값 저장
            if(!empty($_POST['chksaveid'])) {
                if ($_POST['chksaveid'] == "on") {

                    $cookie = array(
                        'name' => 'save_id',
                        'value' => $userdata['mb_id'],
                        'expire' => '86500',
                        'domain' => 'http://felicewoman1.cafe24.com',
                        'path' => '/',
                        'prefix' => '',
                    );
                    set_cookie($cookie);
                    $cookie = array(
                        'name' => 'save_chk',
                        'value' => '1',
                        'expire' => '86500',
                        'domain' => 'http://felicewoman1.cafe24.com',
                        'path' => '/',
                        'prefix' => '',
                    );

                    set_cookie($cookie);
                }
            }
            alert("환영합니다. $user_name_sess 님","/");
        }else{
            //로그인 실패
            alert('로그인 정보가 정확하지 않습니다.', '/auth/login');
        }
    }

    function login_sns_process(){
        $value = $this->Member_m->login_SNS();

        $userdata = $this->Member_m->getMember($_POST['id']);

        $session_data = array(
            'no' => $userdata['no'],
            'id' => $userdata['id'],
            'name' => $userdata['name'],
            'email' => $userdata['email'],
            'grade' => $userdata['grade'],
            'tel' => '',
            'cell' => '',
            'login_type' => $this->uri->segment(3)
        );

        //로그인 성공
        $this->session->set_userdata($session_data);

        $arrData = array(
            'value' => $value
        );

        header('Content-Type: application/json');
        echo json_encode($arrData);
    }

    function login_naver_callback(){
        $this->load->view('/auth/Naver_callback');
    }

    function login_google_callback(){
        $this->load->view('/auth/Google_callback');
    }

    function login_kakao_callback(){
        $this->load->view('/auth/Naver_callback');
    }

    function logout_process(){
        $this->session->sess_destroy();
        alert("감사합니다.", '/');
    }

    //수신거부
    function unsubscribe(){
        $this->load->library('user_agent');

        $this->Member_m->unsubscribe();
        alert_close($this->lang->line("controller_word13"));
    }
}
