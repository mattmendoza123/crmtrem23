<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Api extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url'); 
	}
	public function index(){
		//
	}		
	public function reports()
	{		
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
		echo json_encode($data);
	}

}
