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
	header('Access-Control-Allow-Origin: *'); // Allow requests from any domain
	header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
	header("Access-Control-Allow-Headers: Content-Type, Authorization");
	$url = 'https://tremendio.scaletrk.com/api/v2/network/reports/conversions?api-key=aafcf12b64ca3230279a89aa8b6eacf03c7c59da&lang=en&sortField=added_timestamp&sortDirection=desc&perPage=300&page=1&rangeFrom=2024-03-01&rangeTo=2024-12-31&columns=transaction_id,added_timestamp,payout,sub_id1,offer,affiliate,link&filters[affiliates]=1247'; // URL of the API you want to request
	$data = file_get_contents($url); // Make the request and get the response
	echo $data; // Return the response to your frontend code
	}

	
	  

}
