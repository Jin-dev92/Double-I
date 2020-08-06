<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skin extends CI_Controller {

	 function __construct()
	 {
		 parent::__construct();

	 }

	public function index()
	{
		$this->load->view('layout/Setting');
		$this->load->view('layout/Header');
		$this->load->view('skin/White');
		$this->load->view('layout/Scripts');
		$this->load->view('layout/Footer');

	}
	public function aqua()
	{
		$this->load->view('Layout/Setting');
		$seg = $this->uri->segment(1);
		$header_data=headerdataload($seg);
		$this->load->view('layout/Header',$header_data);
		$this->load->view('layout/Background');
		$this->load->view('skin/Aqua');
		$this->load->view('layout/Footer');
		$this->load->view('layout/Scripts');

	}
	public function Pimple()
	{
		$seg = $this->uri->segment(1);
		$header_data=headerdataload($seg);
		$this->load->view('layout/Header',$header_data);
		$this->load->view('layout/Background');
		$this->load->view('skin/Pimple');
		$this->load->view('layout/Scripts');
		$this->load->view('layout/Footer');
	}
	public function White()
	{
		$seg = $this->uri->segment(1);
		$header_data=headerdataload($seg);
		$this->load->view('layout/Header',$header_data);
		$this->load->view('layout/Background');
		$this->load->view('skin/White');
		$this->load->view('layout/Scripts');
		$this->load->view('layout/Footer');
	}
}
