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
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
		$data["title"] = "New Offers | Tremendio Portal";
		$data["pagename"] = "New Offers";

		$this->load_page2("newoffers", $data, "newoffers_footer.php", "newoffers_header.php");
	}
	

	public function newoffers_api()
	{
	header('Access-Control-Allow-Origin: *'); // Allow requests from any domain
	header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
	header("Access-Control-Allow-Headers: Content-Type, Authorization");

	$start_date = $this->input->post("from_date");
	$end_date = $this->input->post("to_date");
	if($start_date!="" && $end_date!=""){
		$url = 'https://tremendio.scaletrk.com/api/v2/network/offers?api-key=aafcf12b64ca3230279a89aa8b6eacf03c7c59da&status=active&search=&perPage=20&rangeFrom='.$start_date.'&rangeTo='.$end_date.'&page=1'; // URL of the API you want to request
	} else {
		$url = 'https://tremendio.scaletrk.com/api/v2/network/offers?api-key=aafcf12b64ca3230279a89aa8b6eacf03c7c59da&status=active&search=&perPage=20&page=1'; // URL of the API you want to request
	}
	$data =file_get_contents($url); // Make the request and get the response
	//echo $data; // Return the response to your frontend code
    
	if(!isset($_REQUEST['debug'])){
		echo $data;
	} else {
		print_r(json_decode($data));
	}
	/*foreach ($crmaff->result() as $tm) {
		
		$data[] = array(
			// $tm->crm_details_id,
			$tm->aff_company,
			$tm->aff_first_name,
			$tm->aff_last_name,
			$tm->aff_email,
			$tm->aff_skype,
			$tm->aff_tags,
			$tm->aff_country,
			$tm->aff_website,
			$tm->aff_model,
			$tm->aff_geo,
			$tm->aff_traffic_source,
			$tm->aff_ex_hou,
			$tm->aff_comment,
			$tm->date_created,
			$action_btn
		);
	}

	$output = array(
		"draw" => $draw,
		"recordsTotal" => $crmaff->num_rows(),
		"recordsFiltered" => $crmaff->num_rows(),
		"data" => $data
	);
	echo json_encode($output);
	exit();
	*/
	}

}
