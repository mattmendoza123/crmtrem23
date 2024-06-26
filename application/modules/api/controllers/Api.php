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
		/*if($date_filter == "Today"){
			$start_date = date("Y-m-d");
			$end_date = date("Y-m-d");	
		} elseif($date_filter =="This_Month"){
			$start_date = date("Y-m-01");
			$end_date = date("Y-m-d");	
		} elseif($date_filter =="Last_Month"){
			$start_date = date("Y-m-d",strtotime("first day of previous month"));
			$end_date = date("Y-m-d",strtotime("last day of previous month"));	
		} elseif($date_filter =="This_Year"){
			$start_date = date("Y-01-01");
			$end_date = date("Y-m-d");	
		} elseif($date_filter =="Last_Year"){
			$start_date = date("Y-01-01",strtotime("-1 year"));
			$end_date = date("Y-12-31",strtotime("-1 year"));
		}else{
			$minus_day = 0;			
			switch($date_filter){
				case "Yesterday" : $minus_day = -1; break;
				case "Last_7_Days" : $minus_day = -7; break;
				case "Last_30_Days" : $minus_day = -30; break;
				case "Last_60_Days" : $minus_day = -60; break;
				case "Last_90_Days" : $minus_day = -90; break;
			}
			$start_date = date("Y-m-d",strtotime("$minus_day days"));
			$end_date = date("Y-m-d",strtotime("-1 days"));
		} */
		header('Access-Control-Allow-Origin: *'); // Allow requests from any domain
		header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Authorization");
		$url = 'https://tremendio.scaletrk.com/api/v2/network/reports/conversions?api-key=aafcf12b64ca3230279a89aa8b6eacf03c7c59da&lang=en&sortField=added_timestamp&sortDirection=desc&perPage=10&page=1&rangeFrom=2024-01-01&rangeTo=2024-12-31&columns=sub_id1,sub_id2,sub_id3,revenue,added_timestamp,changed_timestamp,currency,transaction_id,advertiser,affiliate&filters=advertisers:500,affiliates:1602'; // URL of the API you want to request
		$data = json_decode(file_get_contents($url), true); 
		
		$transaction_data = [];
		foreach($data['transactions'] as $transaction){
			print_r($transaction);
			//$transaction_data[] = 
		}
		
	}

}
