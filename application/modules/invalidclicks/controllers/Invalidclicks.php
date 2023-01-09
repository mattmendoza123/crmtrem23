<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invalidclicks extends MY_Controller
{

	private $errmsg = "";

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
	
		$data["title"] = "Invalid Clicks | Click ADV";
		$data["pagename"] = "Invalid Clicks";

		$this->load_page2("invalidclicks", $data, "invalidclicks_footer.php", "invalidclicks_header.php");
	}
	

}
