<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Why_bioface extends CI_Controller {

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

	public function Why_bioface()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header');
		$this->load->view('Why_bioface/Why_bioface');
		$this->load->view('popup');
		$this->load->view('layout/Scripts');
	}

	public function M_Why_bioface()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header_m');
		$this->load->view('mobile/Why_bioface/Why_bioface');
		$this->load->view('popup');
		$this->load->view('layout/Scripts_m');
	}
	
	public function Why_bioface_eng()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header');
		$this->load->view('Why_bioface/Why_bioface_eng');
		$this->load->view('popup');
		$this->load->view('layout/Scripts');
	}

	public function M_Why_bioface_eng()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header_m');
		$this->load->view('mobile/Why_bioface/Why_bioface_eng');
		$this->load->view('popup');
		$this->load->view('layout/Scripts_m');
	}
	
	public function Why_bioface_chn()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header');
		$this->load->view('Why_bioface/Why_bioface_chn');
		$this->load->view('popup');
		$this->load->view('layout/Scripts');
	}

	public function M_Why_bioface_chn()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/header_m');
		$this->load->view('mobile/Why_bioface/Why_bioface_chn');
		$this->load->view('popup');
		$this->load->view('layout/Scripts_m');
	}
}