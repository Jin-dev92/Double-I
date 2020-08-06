<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AboutUs extends CI_Controller {

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

	// 비오페이스 소개
	public function bio_intro()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header');
		$this->load->view('AboutUs/bio_intro');
		$this->load->view('popup');
		$this->load->view('layout/Scripts');
		$this->load->view('layout/Footer');
	}

	public function M_bio_intro()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header_m');
		$this->load->view('mobile/AboutUs/bio_intro');
		$this->load->view('popup');
		$this->load->view('layout/Scripts_m');
		$this->load->view('layout/Footer');
	}

	// 의료진 소개
	public function doctor_intro()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header');
		$this->load->view('AboutUs/doctor_intro');
		$this->load->view('popup');
		$this->load->view('layout/Scripts');
		$this->load->view('layout/Footer');
	}

	public function M_doctor_intro()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header_m');
		$this->load->view('mobile/AboutUs/doctor_intro');
		$this->load->view('popup');
		$this->load->view('layout/Scripts_m');
		$this->load->view('layout/Footer');
	}
	// 진료안내
	public function treatment_guide()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header');
		$this->load->view('AboutUs/treatment_guide');
		$this->load->view('popup');
		$this->load->view('layout/Scripts');
		$this->load->view('layout/Footer');
	}
	public function M_treatment_guide()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header_m');
		$this->load->view('mobile/AboutUs/treatment_guide');
		$this->load->view('popup');
		$this->load->view('layout/Scripts_m');
		$this->load->view('layout/Footer');
	}

	// 찾아오시는 길
	public function find_map()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header');
		$this->load->view('AboutUs/find_map');
		$this->load->view('popup');
		$this->load->view('layout/Scripts');
		// $this->load->view('layout/Footer');
	}
	public function M_find_map()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header_m');
		$this->load->view('mobile/AboutUs/find_map');
		$this->load->view('popup');
		$this->load->view('layout/Scripts_m');
		// $this->load->view('layout/Footer');
	}

}
