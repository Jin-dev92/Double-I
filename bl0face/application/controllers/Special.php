<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class special extends CI_Controller {

	 function __construct()
	 {
		 parent::__construct();

	 }

	public function index()
	{
		$seg = $this->uri->segment(1);
		$header_data=headerdataload($seg);
		$this->load->view('layout/Header',$header_data);
		$this->load->view('layout/Background');
		$this->load->view('filler/Tof');
		$this->load->view('layout/Scripts');
		$this->load->view('layout/Footer');
	}
	public function powerup()
	{
		$seg = $this->uri->segment(1);
		$header_data=headerdataload($seg);
		$this->load->view('layout/Header',$header_data);
		$this->load->view('layout/Background');
		$this->load->view('special/Powerup');
		$this->load->view('layout/Scripts');
		$this->load->view('layout/Footer');
	}
	public function tof()
	{
		$seg = $this->uri->segment(1);
		$header_data=headerdataload($seg);
		$this->load->view('layout/Header',$header_data);
		$this->load->view('layout/Background');
		$this->load->view('filler/Tof');
		$this->load->view('layout/Scripts');
		$this->load->view('layout/Footer');
	}

}
