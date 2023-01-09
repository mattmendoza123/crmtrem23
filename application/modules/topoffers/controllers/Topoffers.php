<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Topoffers extends MY_Controller
{

	private $errmsg = "";

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
	
		$data["title"] = "Top Offers| Click ADV";
		$data["pagename"] = "Top Offers";

		$this->load_page2("topoffers", $data, "topoffers_footer.php", "topoffers_header.php");
	}
	

}
