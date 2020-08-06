<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obesity_clinic extends CI_Controller {

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


	// NMT 다이어트
	public function NMTdiet()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header');
		$this->load->view('Obesity_clinic/NMTdiet');
		$this->load->view('popup');
		$this->load->view('layout/Scripts');
		$this->load->view('layout/Footer');
	}

	public function M_NMTdiet()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header_m');
		$this->load->view('mobile/Obesity_clinic/NMTdiet');
		$this->load->view('popup');
		$this->load->view('layout/Scripts_m');
		$this->load->view('layout/Footer');
	}

	// NMT 뇌 피트니스
	public function NMTbrain()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header');
		$this->load->view('Obesity_clinic/NMTbrain');
		$this->load->view('popup');
		$this->load->view('layout/Scripts');
		$this->load->view('layout/Footer');
	}

	public function M_NMTbrain()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header_m');
		$this->load->view('mobile/Obesity_clinic/NMTbrain');
		$this->load->view('popup');
		$this->load->view('layout/Scripts_m');
		$this->load->view('layout/Footer');
	}

	

	// NMT 피스토주사
	public function NMTpisto()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header');
		$this->load->view('Obesity_clinic/NMTpisto');
		$this->load->view('popup');
		$this->load->view('layout/Scripts');
		$this->load->view('layout/Footer');
	}

	public function M_NMTpisto()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header_m');
		$this->load->view('mobile/Obesity_clinic/NMTpisto');
		$this->load->view('popup');
		$this->load->view('layout/Scripts_m');
		$this->load->view('layout/Footer');
	}

	// 전후사진
	public function beforeAfter_pic()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header');
		$this->load->view('Obesity_clinic/beforeAfter_pic');
		$this->load->view('popup');
		$this->load->view('layout/Scripts');
		$this->load->view('layout/Footer');
	}

	public function M_beforeAfter_pic()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header_m');
		$this->load->view('mobile/Obesity_clinic/beforeAfter_pic');
		$this->load->view('popup');
		$this->load->view('layout/Scripts_m');
		$this->load->view('layout/Footer');
	}


}
