<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Crmads extends MY_Controller
{

	private $errmsg = "";

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
	
		$data["title"] = "CRM | Tremendio Portal";
		$data["pagename"] = "Crmads";

		$this->load_page2("crmads", $data, "crmads_footer.php", "crmads_header.php");
	}
	
}
