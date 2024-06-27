<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Api extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url'); 
	}
	public function index(){
		//
	}		
	public function report_request(){
		date_default_timezone_set("Europe/Paris");
		header('Access-Control-Allow-Origin: *'); // Allow requests from any domain
		header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Authorization");
		
		$start_date = $this->input->get("rangeFrom") !="" ? $this->input->get("rangeFrom") : "2023-01-01";		
		$end_date = date("Y-m-d");			
		$page = $this->input->get('page', TRUE);
		$perPage = $this->input->get('perPage', TRUE);
		
		$transaction_data = [];
		$data_headers = [];
		$url = 'https://tremendio.scaletrk.com/api/v2/network/reports/conversions?api-key=aafcf12b64ca3230279a89aa8b6eacf03c7c59da&lang=en&sortField=added_timestamp&sortDirection=desc&perPage='.$perPage.'&page='.$page.'&rangeFrom='.$start_date.'&rangeTo='.$end_date.'&columns=sub_id1,sub_id2,sub_id3,revenue,added_timestamp,changed_timestamp,currency,transaction_id,advertiser,affiliate&filters=advertisers:500,affiliates:1602'; // URL of the API you want to request	
		$data = json_decode(file_get_contents($url), true); 			
		foreach($data['info']['transactions'] as $transaction){						
			unset($transaction["affiliate"]["value"] , $transaction["advertiser"]["value"]);	
			$transaction_data[] = $transaction;		
		}			
		
		$data["info"]["transactions"] = $transaction_data;
		return json_encode($data);
	}	
	public function reports()
	{		
		$start_date = $this->input->get("rangeFrom") !="" ? $this->input->get("rangeFrom") : "2023-01-01";		
		$end_date = date("Y-m-d");			
		$page = $this->input->get('page', TRUE);
		$perPage = $this->input->get('perPage', TRUE);		

		
		
		$url = base_url()."api/report_request?page=".$page."&perPage=".$perPage."&rangeFrom=".$start_date;

		$ch = curl_init($url);

		// Set cURL options for SSL/HTTPS
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification (not recommended for production)
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Disable host verification (not recommended for production)
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the transfer as a string

		$response = curl_exec($ch);

		// Check for errors
		if (curl_errno($ch)) {
			$error_msg = curl_error($ch);
			// Handle error
		}
		echo $response;
		curl_close($ch);
		


	}


}
