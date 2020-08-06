<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lifting extends CI_Controller {

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

	// 티오필
	public function tof()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header');
		$this->load->view('Lifting/tof');
		$this->load->view('popup');
		$this->load->view('layout/Scripts');
		$this->load->view('layout/Footer');
	}
	public function M_tof()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header_m');
		$this->load->view('mobile/Lifting/tof');
		$this->load->view('popup');
		$this->load->view('layout/Scripts_m');
		$this->load->view('layout/Footer');
	}

	// 포니테일
	public function ponytail()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header');
		$this->load->view('Lifting/ponytail');
		$this->load->view('popup');
		$this->load->view('layout/Scripts');
		$this->load->view('layout/Footer');
	}
	public function M_ponytail()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header_m');
		$this->load->view('mobile/Lifting/ponytail');
		$this->load->view('popup');
		$this->load->view('layout/Scripts_m');
		$this->load->view('layout/Footer');
	}

	// 리프톡스
	public function liftox()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header');
		$this->load->view('Lifting/liftox');
		$this->load->view('popup');
		$this->load->view('layout/Scripts');
		$this->load->view('layout/Footer');
	}
	public function M_liftox()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header_m');
		$this->load->view('mobile/Lifting/liftox');
		$this->load->view('popup');
		$this->load->view('layout/Scripts_m');
		$this->load->view('layout/Footer');
	}

	// 슈링크
	public function shurink()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header');
		$this->load->view('Lifting/shurink');
		$this->load->view('popup');
		$this->load->view('layout/Scripts');
		$this->load->view('layout/Footer');
	}
	public function M_shurink()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header_m');
		$this->load->view('mobile/Lifting/shurink');
		$this->load->view('popup');
		$this->load->view('layout/Scripts_m');
		$this->load->view('layout/Footer');
	}

	// 리쥬란
	public function rijuran()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header');
		$this->load->view('Lifting/rijuran');
		$this->load->view('popup');
		$this->load->view('layout/Scripts');
		$this->load->view('layout/Footer');
	}
	public function M_rijuran()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header_m');
		$this->load->view('mobile/Lifting/rijuran');
		$this->load->view('popup');
		$this->load->view('layout/Scripts_m');
		$this->load->view('layout/Footer');
	}

	// 뉴테라
	public function new_thera()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header');
		$this->load->view('Lifting/new_thera');
		$this->load->view('popup');
		$this->load->view('layout/Scripts');
		$this->load->view('layout/Footer');
	}
	public function M_new_thera()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header_m');
		$this->load->view('mobile/Lifting/new_thera');
		$this->load->view('popup');
		$this->load->view('layout/Scripts_m');
		$this->load->view('layout/Footer');
	}

	// 듀엣써마지
	public function duet_thermage()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header');
		$this->load->view('Lifting/duet_thermage');
		$this->load->view('popup');
		$this->load->view('layout/Scripts');
		$this->load->view('layout/Footer');
	}
	public function M_duet_thermage()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header_m');
		$this->load->view('mobile/Lifting/duet_thermage');
		$this->load->view('popup');
		$this->load->view('layout/Scripts_m');
		$this->load->view('layout/Footer');
	}

}
