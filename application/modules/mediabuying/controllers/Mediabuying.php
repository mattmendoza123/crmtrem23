<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mediabuying extends MY_Controller
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
		$data["title"] = "Media Buying | Click ADV";
		$data["pagename"] = "Media Buying";

		$this->load_page2("mediabuying", $data, "mediabuying_footer.php", "mediabuying_header.php");
	}
	

	public function mediabuying_api()
	{
	
	$draw = intval($this->input->post("draw"));
	$start = intval($this->input->post("start"));
	$length = intval($this->input->post("length"));
	$order = $this->input->post("order");
	$search = $this->input->post("search");

	header('Access-Control-Allow-Origin: *'); // Allow requests from any domain
	header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
	header("Access-Control-Allow-Headers: Content-Type, Authorization");
	
	//$data = file_get_contents($url); // Make the request and get the response
	

	$start_date = $this->input->post("from_date");
	$end_date = $this->input->post("to_date");
	if($start_date!="" && $end_date!=""){		
		$url = 'https://tremendio.scaletrk.com/api/v2/network/reports/conversions?api-key=aafcf12b64ca3230279a89aa8b6eacf03c7c59da&lang=en&sortField=added_timestamp&sortDirection=asc&perPage=300&page=1&rangeFrom='.$start_date.'&rangeTo='.$end_date.'&columns=transaction_id,added_timestamp,payout,sub_id1,offer,affiliate,link&filters[affiliates]=1247'; // URL of the API you want to request
	} else {
		$url = 'https://tremendio.scaletrk.com/api/v2/network/reports/conversions?api-key=aafcf12b64ca3230279a89aa8b6eacf03c7c59da&lang=en&sortField=added_timestamp&sortDirection=asc&perPage=300&page=1&rangeFrom=2024-03-01&rangeTo=2024-12-31&columns=transaction_id,added_timestamp,payout,sub_id1,offer,affiliate,link&filters[affiliates]=1247'; // URL of the API you want to request
	}
	$data = json_decode(file_get_contents($url)); // Make the request and get the response
	//echo $data; // Return the response to your frontend code	
	$offerNameMap = [
		"PRIVATE #1247 FlirtyNLocal - US - DOI" => "Flirty n Local",
		"1247 - Flirtymilfs - US - CPL - SOI" => "Flirty Milfs",
		"1247 - BBWtodate - US - CPL - SOI"=>"BBW to date",
		"1247 - One-nightstand - US - CPL - DOI "=>"One Night stand",
		"1247 ONLY Ashley Madison - US - CPL - SOI - WEB/WAP"=>"Ashley Madison"
		// Add more mappings as needed
	];

	foreach ($data->info->transactions as $transaction) {		
			$offerName = isset($offerNameMap[$transaction->offer->value]) ? $offerNameMap[$transaction->offer->value] : $transaction->offer->value;
			if($transaction->sub_id1!=""){
				$data_arr[] = array(
					// $tm->crm_details_id,
					$transaction->sub_id1,
					$offerName,
					date("m/d/Y h:i:s A", strtotime($transaction->added_timestamp)),				
					$transaction->payout,	
					$transaction->currency,				
				);
			}
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
