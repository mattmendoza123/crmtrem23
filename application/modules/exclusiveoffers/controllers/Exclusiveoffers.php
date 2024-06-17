<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Exclusiveoffers extends MY_Controller
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
		$data["title"] = "Exclusive Offers | Tremendio Portal";
		$data["pagename"] = "Exclusive Offers";

		$this->load_page2("exclusiveoffers", $data, "exclusiveoffers_footer.php", "exclusiveoffers_header.php");
	}
	

	public function exclusiveoffers_api()
	{
	
	$draw = intval($this->input->post("draw"));
	$start = intval($this->input->post("start"));
	$length = intval($this->input->post("length"));
	$order = $this->input->post("order");
	$search = $this->input->post("search");

	header('Access-Control-Allow-Origin: *'); // Allow requests from any domain
	header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
	header("Access-Control-Allow-Headers: Content-Type, Authorization");
	
	$start_date = $this->input->post("from_date");
	$end_date = $this->input->post("to_date");
	if($start_date!="" && $end_date!=""){
		$url = 'https://tremendio.scaletrk.com/api/v2/network/offers?api-key=aafcf12b64ca3230279a89aa8b6eacf03c7c59da&status=active&search=&perPage=20&categories=62&rangeFrom='.$start_date.'&rangeTo='.$end_date.'&page=1'; // URL of the API you want to request
	} else {
		$url = 'https://tremendio.scaletrk.com/api/v2/network/offers?api-key=aafcf12b64ca3230279a89aa8b6eacf03c7c59da&status=active&search=&perPage=20&page=1&categories=62';
	}
	$data = json_decode(file_get_contents($url));

    foreach ($data->info->offers as $offer) {
		$tags_arr = [];
		foreach($offer->categories as $tag){
			$tags_arr[] = $tag->title;
		}			
		$data_arr[] = array(
			// $tm->crm_details_id,
			$offer->id,
			$offer->title_info->name,
			$offer->title_info->advertiser->company_name,
			implode(",",$tags_arr),
			$offer->payout[0]->value,			
		);
	}

	$output = array(
		"draw" => $draw,
		"recordsTotal" => count($data_arr),
		"recordsFiltered" => count($data_arr),
		"data" => $data_arr
	);
	echo json_encode($output);
	exit();


	}

}
