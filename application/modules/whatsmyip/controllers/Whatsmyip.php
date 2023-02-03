<?php
error_reporting(0);
ini_set('display_errors', 0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Whatsmyip extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
    public function index(){
		$data["title"] = "Whats My IP";
		$this->load_register_page("whatsmyip", $data);
		$this->load->view('includes/footer');
	}
}
