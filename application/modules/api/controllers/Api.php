<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends MY_Controller
{

	private $errmsg = "";

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
		
		$start_date = "2023-01-01";
		$end_date = date("Y-m-d");	

		//$url = 'https://tremendio.scaletrk.com/api/v2/network/reports/conversions?api-key=aafcf12b64ca3230279a89aa8b6eacf03c7c59da&lang=en&sortField=added_timestamp&sortDirection=desc&perPage=10&page=1&rangeFrom="'.$start_date.'"&rangeTo="'.$end_date.'"&columns=sub_id1,sub_id2,sub_id3,revenue,added_timestamp,changed_timestamp,currency,transaction_id,advertiser,affiliate&filters=advertisers:500,affiliates:1602'; // URL of the API you want to request
		//$data = json_decode(file_get_contents($url), true); 
		
		$continue = true;
		$page = 1;
		$data_transactions_array = [];
		$transaction_data = [];
		$data_headers = [];
		while($continue){

			$url = 'https://tremendio.scaletrk.com/api/v2/network/reports/conversions?api-key=aafcf12b64ca3230279a89aa8b6eacf03c7c59da&lang=en&sortField=added_timestamp&sortDirection=desc&perPage=500&page='.$page.'&rangeFrom="'.$start_date.'"&rangeTo="'.$end_date.'"&columns=sub_id1,sub_id2,sub_id3,revenue,added_timestamp,changed_timestamp,currency,transaction_id,advertiser,affiliate&filters=advertisers:500,affiliates:1602'; // URL of the API you want to request
			$data = json_decode(file_get_contents($url), true); 
			$i = 0;
			foreach($data['info']['transactions'] as $transaction){	
						
				unset($transaction["affiliate"]["value"] , $transaction["advertiser"]["value"]);	
				$transaction_data[$page."_".$i] = $transaction;		
				print_r($transaction);
			}
			if(count($data['info']['transactions']) <=0){
				$continue = false;
				$data_headers = $data;
			}		

			$page++;
			sleep(10);
			
		}


		/*$transaction_data = [];
		foreach($data['info']['transactions'] as $transaction){			

			unset($transaction["affiliate"]["value"] , $transaction["advertiser"]["value"]);

			$transaction_data[] = $transaction;		
		}*/		

		$data_headers["info"]["transactions"] = $transaction_data;
		echo json_encode($data);
	}

}
