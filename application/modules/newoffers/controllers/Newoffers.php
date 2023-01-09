<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Newoffers extends MY_Controller
{

	private $errmsg = "";

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
	
		$data["title"] = "New Offers| Click ADV";
		$data["pagename"] = "New Offers";

		$this->load_page2("newoffers", $data, "newoffers_footer.php", "newoffers_header.php");
	}
	

}
