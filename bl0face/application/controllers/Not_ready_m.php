<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Not_ready_m extends CI_Controller {

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

	public function index()
	{
		// $seg = $this->uri->segment(1);
 	//  	$header_data=headerdataload($seg);
		$this->load->view('layout/Setting');
		$this->load->view('layout/header_m');
		$this->load->view('mobile/not_ready');
		$this->load->view('layout/Scripts_m');
		$this->load->view('layout/Footer');
	}

}
