<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Body_filler extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 function __construct()
	 {
		 parent::__construct();
	 }


	// 골반필러
	public function pelvis_filler()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header');
		$this->load->view('Body_filler/pelvis_filler');
		$this->load->view('popup');
		$this->load->view('layout/Scripts');
		$this->load->view('layout/Footer');
	}

	public function M_pelvis_filler()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header_m');
		$this->load->view('mobile/Body_filler/pelvis_filler');
		$this->load->view('popup');
		$this->load->view('layout/Scripts_m');
		$this->load->view('layout/Footer');
	}

	// 힙업필러
	public function hipup_filler()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header');
		$this->load->view('Body_filler/hipup_filler');
		$this->load->view('popup');
		$this->load->view('layout/Scripts');
		$this->load->view('layout/Footer');
	}

	public function M_hipup_filler()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header_m');
		$this->load->view('mobile/Body_filler/hipup_filler');
		$this->load->view('popup');
		$this->load->view('layout/Scripts_m');
		$this->load->view('layout/Footer');
	}

	

	// 휜다리필러
	public function leg_filler()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header');
		$this->load->view('Body_filler/leg_filler');
		$this->load->view('popup');
		$this->load->view('layout/Scripts');
		$this->load->view('layout/Footer');
	}

	public function M_leg_filler()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header_m');
		$this->load->view('mobile/Body_filler/leg_filler');
		$this->load->view('popup');
		$this->load->view('layout/Scripts_m');
		$this->load->view('layout/Footer');
	}


}
