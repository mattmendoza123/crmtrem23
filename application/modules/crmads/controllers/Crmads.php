<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Crm extends MY_Controller
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
		$data["pagename"] = "CRMads";

		$this->load_page2("crmads", $data, "crmads_footer.php", "crmads_header.php");
	}
	
}
