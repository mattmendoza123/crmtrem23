<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leavetracker extends MY_Controller
{

	private $errmsg = "";

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
		// echo "<pre>";print_r($this->session->userdata());exit;
		$data["title"] = "Leave Tracker | Tremendio Portal";
		$data["pagename"] = "Leave Tracker";
	


		// if(!$this->session->userdata('user_type')){

		// $data['user'] = $this->db->
		// where('user_type', 'User')->
		// from('click_users')->
		// count_all_results();
		// $data['employee'] = $this->db->
		// where('user_type', 'Employee')->
		// from('click_users')->
		// count_all_results();
		// }

		$this->load_page2("leavetracker", $data, "i_footer.php", "i_header.php");
	}
	

}
