<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Board extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Board_m');
		define('BOARD_NAME', $this->uri->segment(3));

	}
	public function index()
	{
		alert("존재하지 않는 페이지입니다.","/");
	}

	public function sms_send()
	{
		$this->load->view('board/sms_send');
	}

	public function lists($bo_name,$page)
	{
		if (!$bo_name) {
			alert("존재하지 않는 페이지입니다.","/board/lists/online_kor/1");
		}
		if ($page<1) {
			$page=1;
		}
			$bo_name_re = "g5_write_".$bo_name;


		$data = $this->Board_m->getList("$bo_name_re");
		if($bo_name=='selfie_kor'){
			$where = 'AND 1=1';

			if($page==2){
				$where = " and `wr_3` like '%fullface%' ";
			} else if($page==3){
				$where = " and `wr_3` like '%lifting%' ";
			} else if($page==4){
				$where = " and `wr_3` like '%body%' ";
			}


			$data = $this->Board_m->getList_selfie("$bo_name_re",$where);
		}
		
		$data['total'] =count($data);
		$data['page'] = $page;
		$data['page_scale']=10;
		$data['page_limit'] =8;
		if ($bo_name!="online_kor") {
			$img_data = $this->Board_m->getImages($bo_name);
			$data['album_img']= $img_data;
		}
		$header_data=headerdataload("au");
		$data["board_title"] = $this->board_title($bo_name);
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

		if ($bo_name=="online_kor") {
			$this->load->view('board/Lists' , array("list"=>$data));
		} else if ($bo_name=="star_kor") {
			$this->load->view('board/Album_star' , array("list"=>$data)); 
			
		} else if($bo_name=="selfie_kor"){
			$this->load->view('board/Album_selfie' , array("list"=>$data)); 
		} else if ($bo_name=="BeforeAfter_kor") {
			$this->load->view('board/Album_bf' , array("list"=>$data)); 
		} else if($bo_name=="new_event3" || $bo_name=="new_event4"){
			$this->load->view('board/new_event_DB' , array("list"=>$data)); 
		} else if ($bo_name=="event_kor") {
			$this->load->view('board/Album_event' , array("list"=>$data)); 
		} else {
			$this->load->view('board/Album' , array("list"=>$data)); 
		}
		$this->load->view('popup');
		$this->load->model('Board_m');
		$this->load->view('layout/Footer');
	}

	public function lists_db($bo_name,$page)
	{
		if (!$bo_name) {
			alert("존재하지 않는 페이지입니다.","/Main");
		}
		if ($page<1) {
			$page=1;
		}
			$bo_name_re = "g5_".$bo_name;

		$data = $this->Board_m->getList_DB("$bo_name_re");
		$data['total'] =count($data);
		$data['page'] = $page;
		$data['page_scale']=10;
		$data['page_limit'] =8;

		$header_data=headerdataload("au");
		$data["board_title"] = $this->board_title($bo_name);
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

		$this->load->view('board/Lists_DB' , array("list"=>$data));
		$this->load->view('popup');
		$this->load->model('Board_m');
		$this->load->view('layout/Footer');
	}

	public function view($bo_name,$bo_no)
	{
		$data = $this->Board_m->view_m($bo_name,$bo_no);
		if (!$data) {
			Header('location:/board/lists/'.$bo_name.'/1');
		}
		if ($bo_name == "online_kor") {
			// if ($this->session->userdata('level')<1) {
			// 	alert("로그인이 필요합니다.","/auth/login");
			// }

			$board_name_re = "g5_write_".$bo_name;
			// 부모 wr_id값을 받아옴
			$check = $this->db->query("SELECT * FROM $board_name_re WHERE `wr_id`= $bo_no")->row_array();
			$parent = $check['wr_parent'];

			// 부모 아이디 값과 현재 아이디 값이 같은지 확인
			$check2 = $this->db->query("SELECT * FROM $board_name_re WHERE `wr_id`= $parent")->row_array();

			if ($this->session->userdata('level')<10) {
				if ($_SERVER['REMOTE_ADDR']!=$check['wr_ip'] &&  $this->session->userdata('id') != $data['mb_id'] && $check2['mb_id'] != $this->session->userdata('id')) {
					// alert("본인만 확인 가능합니다.","/board/lists/$bo_name/1");
					alert("본인만 확인가능합니다.","/board/Secret?bo_name=$bo_name&bo_no=$bo_no");
				}
			}

		} else if($bo_name == "filler_review_kor" || $bo_name == "selfie_kor" || $bo_name == "BeforeAfter_kor"){
			if ($this->session->userdata('level')<1) {
				alert("로그인이 필요합니다.","/auth/login");
			}			
		}
		$co_data = $this->Board_m->coment();
		$img_data = $this->Board_m->getImage($bo_name,$bo_no);
		$data['img'] = $img_data;
		$header_data=headerdataload("au");
		$header_data["board_title"] = $this->board_title($bo_name);
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

        if ($bo_name == "event_kor") {
			$this->load->view('board/View_event' , array("views"=>$data));
		} else {
			$this->load->view('board/View' , array("views"=>$data));	
		}

		if ($bo_name=="online_kor" && $this->session->userdata('level')==10) {
			$this->load->view('board/Coment_admin' , array("coment"=>$co_data));
		} else if($bo_name=="online_kor" && $this->session->userdata('level')!=10){
			$re_check = $this->db->query("SELECT * FROM $board_name_re WHERE `wr_id`= $bo_no")->row_array();
			if($re_check['wr_reply'] != 'A'){
				$this->load->view('board/Coment' , array("coment"=>$co_data));
			}
			$this->load->view('board/Menu');
		} else {
			$this->load->view('board/Menu');
		}
		
		$this->load->view('popup');
		$this->load->view('layout/Footer');
	}
	public function view_pass($bo_name,$bo_no)
	{
		$data = $this->Board_m->view_m($bo_name,$bo_no);
		if (!$data) {
			Header('location:/board/lists/'.$bo_name.'/1');
		}
		$co_data = $this->Board_m->coment();
		$img_data = $this->Board_m->getImage($bo_name,$bo_no);
		$data['img'] = $img_data;
		$header_data=headerdataload("au");
		$header_data["board_title"] = $this->board_title($bo_name);
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
		$this->load->view('board/View' , array("views"=>$data));

		if ($bo_name=="online_kor" && $this->session->userdata('level')==10) {
			$this->load->view('board/Coment_admin' , array("coment"=>$co_data));
		} else if($bo_name=="online_kor" && $this->session->userdata('level')!=10){
			$board_name_re = "g5_write_".$bo_name;
			$re_check = $this->db->query("SELECT * FROM $board_name_re WHERE `wr_id`= $bo_no")->row_array();
			if($re_check['wr_reply'] != 'A'){
				$this->load->view('board/Coment' , array("coment"=>$co_data));
			}
			$this->load->view('board/Menu');
		} else {
			$this->load->view('board/Menu');
		}
		
		$this->load->view('popup');
		$this->load->view('layout/Footer');
	}
	public function write($bo_name)
	{
		if (!$bo_name) {
			alert("존재하지 않는 페이지입니다.","/");
		}
		// 만약 온라인 상담이 아니라면 관리자만 사용할 수 있게
		if ($this->session->userdata('level')<1) {
			alert("로그인이 필요합니다.","/auth/login");
		}
		$data['bo_name'] = $bo_name;
		$header_data=headerdataload("au");
		$header_data["board_title"] = $this->board_title($bo_name);

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
        $this->load->view('popup');

        if($bo_name == 'event_kor'){
        	$this->load->view('board/Write_event', $data);	
        } else if($bo_name == 'selfie_kor'){
        	$this->load->view('board/Write_selfie', $data);	
        } else {
			$this->load->view('board/Write', $data);
		}
		$this->load->view('layout/Footer');
	}
	public function modify($bo_name,$bo_no)
	{

		$data = $this->Board_m->modify($bo_name,$bo_no);
		$data['bo_name'] = $bo_name;
		$img_data = $this->Board_m->getImage($bo_name,$bo_no);
		$data['img'] = $img_data;
		$header_data=headerdataload("au");
		$header_data["board_title"] = $this->board_title($bo_name);
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
        $this->load->view('popup');
        if($bo_name == 'event_kor'){
			$this->load->view('board/Modify_event' , array("modify"=>$data));
		} else if($bo_name == 'selfie_kor'){
			$this->load->view('board/Modify_selfie' , array("modify"=>$data));
		} else {
			$this->load->view('board/Modify' , array("modify"=>$data));	
		}
		$this->load->view('layout/Footer');
	}

	// 비밀글
	public function Secret()
	{
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
		$this->load->view('board/Secret');
		$this->load->view('popup');
		$this->load->view('layout/Footer');
	}

	function delContent($bo_name,$bo_no)
	{
		$result = $this->Board_m->del_process();
		if ($result) {
			alert("삭제되었습니다.","/board/lists/$bo_name/1");
		}else {
			alert("다시 한번 시도해주세요..","/board/view/$bo_name/$bo_no");
		}
	}
	function setComent($bo_name,$bo_no)
	{
		$bo_name_re ="g5_write_".$bo_name;
		$set = $this->Board_m->setComent("$bo_name_re","$bo_no");
		if ($set) {
			alert("답글이 등록 되었습니다.","/board/view/$bo_name/$bo_no");
		}
	}

	function delComent($bo_name,$bo_no)
	{
		$bo_name_re ="g5_write_".$bo_name;
		$id_chk = $this->db->query("SELECT * FROM $bo_name_re WHERE wr_id=$bo_no")->row();

		$del = $this->Board_m->delComent($bo_name,$bo_no);
		if ($del) {
			alert("답글이 삭제 되었습니다.","/board/view/$bo_name/$bo_no");
		}
	}
	function write_process($bo_name){

		$result = $this->Board_m->setContent();
		if ($result) {
			alert("글이 등록 되었습니다.","/board/lists/$bo_name/1");
		}else {
			alert("글 등록에 실패하였습니다.","/board/lists/$bo_name/1");
		}
	}
	function write_process_event($bo_name){

		$result = $this->Board_m->setContent_event();
		if ($result) {
			alert("글이 등록 되었습니다.","/board/lists/$bo_name/1");
		}else {
			alert("글 등록에 실패하였습니다.","/board/lists/$bo_name/1");
		}
	}

	function write_process_selfie($bo_name){

		$result = $this->Board_m->setContent_selfie();
		if ($result) {
			alert("글이 등록 되었습니다.","/board/lists/selfie_kor/1");
		}else {
			alert("글 등록에 실패하였습니다.","/board/lists/selfie_kor/1");
		}
	}

	function modify_process($bo_name,$bo_no)
	{

		$result = $this->Board_m->modify_process();
		if ($result) {
			alert("글이 등록 되었습니다.","/board/lists/$bo_name/1");
		}else {
			alert("글 등록에 실패하였습니다.","/board/lists/$bo_name/1");
		}
	}
	function modify_process_event($bo_name,$bo_no)
	{

		$result = $this->Board_m->modify_process_event();
		if ($result) {
			alert("글이 수정 되었습니다.","/board/lists/$bo_name/1");
		}else {
			alert("글 수정에 실패하였습니다.","/board/lists/$bo_name/1");
		}
	}

	function modify_process_selfie($bo_name,$bo_no)
	{

		$result = $this->Board_m->modify_process_selfie();
		if ($result) {
			alert("글이 수정 되었습니다.","/board/lists/selfie_kor/1");
		}else {
			// alert("글 수정에 실패하였습니다.","/board/lists/selfie_kor/1");

		}
	}


	function setKakao_db()
	{
		$bo_name_re ="g5_kakao";
		$set = $this->Board_m->setKakao($bo_name_re);
		if ($set) {
			alert("상담 신청되었습니다.","/Main");
		}
	}

	function setCost_db()
	{
		$bo_name_re ="g5_write_online_kor";
		$set = $this->Board_m->setCost($bo_name_re);
		if ($set) {
			alert("온라인 상담게시판에 등록되었습니다..","/Main");
		}
	}
	function secret_check($bo_name,$bo_no)
	{
		$result = $this->Board_m->pass_check($bo_name,$bo_no);
		if ($result) {
			Header('location:/board/view_pass/'.$bo_name.'/'.$bo_no);
		}else {
			alert("비밀번호가 틀렸습니다.","/board/lists/$bo_name/1");
		}
	}

	function selfie_contents_process($selfie_num){
		$selfie_data = $this->Board_m->get_selfie($selfie_num);
	 	$selfie_data['img'] = $this->Board_m->getImage('selfie_kor',$selfie_num);
		$this->load->view('board/selfie_contents_process',array("selfie_data"=>$selfie_data));
    }

	function board_title($bo_name)
	{
		switch ($bo_name) {
			case 'online_kor':
				$board_title = "온라인 상담";
				break;
			case 'event_kor':
					$board_title = "이벤트";
				break;
			case 'filler_review_kor':
					$board_title = "의료진 리뷰";
				break;
			case 'after':
					$board_title = "자필후기";
				break;
			case 'star_kor':
				$board_title = "With star";
				break;
			case 'selfie_kor':
				$board_title = "셀카존";
				break;
			case 'BeforeAfter_kor':
				$board_title = "전후사진";
				break;
			case 'kakao':
				$board_title = "카톡상담";
				break;
			case 'cost':
				$board_title = "비용상담";
				break;
			case 'new_event3':
				$board_title = "DB";
				break;
			case 'new_event4':
				$board_title = "DB";
				break;
			default:

				break;
		}
		return $board_title;
	}


}
