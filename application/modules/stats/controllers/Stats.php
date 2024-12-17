<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stats extends MY_Controller
{

	private $errmsg = "";

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url'); 
	}
	public function index(){
		$this->topOffersfilter("This Year");
	}	
	public function topOffersfilter($date_filter)
	{		
		$data["title"] = "Scaleo Campaigns | Click ADV";
		$data['date_filter'] = $date_filter;
		$data["pagename"] = "Scaleo";
		$data['date_filters'] = [
			array("name"=> "today", "val"=>"Today"), 
			array("name" =>"yesterday", "val"=> "Yesterday"),
			array("name"=> "last7Days", "val"=> "Last 7 Days"),
			array("name"=> "last14Days", "val"=> "Last 14 Days"),		
			array("name"=> "last30Days", "val"=> "Last 30 Days"),
			array("name"=> "last90Days", "val"=> "Last 90 Days"),
			array("name"=> "lastMonth", "val"=> "Last Month"),
			array("name"=> "thisMonth", "val"=> "This Month"),
			array("name"=> "thisYear", "val"=> "This Year"),
			array("name"=> "lastYear", "val"=> "Last Year"),
			array("name"=> "alltime", "val"=> "All Time"),			
			//array("name"=> "custom", "val"=> "Custom Filter")
		];

			
		$this->load_page2("stats", $data, "i_footer.php", "i_header.php"); 
	}	
	public function top_offers($date_filter = "today"){		
		$date_filter = $_REQUEST['date_selected'];
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");		
		$newreporst_api = $this->newreports_api("top-offers",$date_filter);
		
		foreach ($newreporst_api['info']['rows'] as $offer) {	
			$cls = (floatval($offer['change']) > 0) ? "green" : "red";		

			$data_arr[] = array(				
				"#".$offer['entity']['id']. " ".$offer['entity']['title'],
				"$".number_format($offer['value'],2,'.',''),		
				"<span class='$cls'>".$offer['change']."%"."</span>"
			);
		}
	
		$output = array(
			"draw" => $draw,
			"recordsTotal" => count($data_arr),
			"recordsFiltered" => count($data_arr),
			"data" => $data_arr
		);
		echo json_encode($output);
		
	}
	public function top_affiliates($date_filter = "today"){		
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");

		$newreporst_api = $this->newreports_api("top-affiliates",$date_filter);
		
		foreach ($newreporst_api['info']['rows'] as $offer) {					
			$cls = (floatval($offer['change']) > 0) ? "green" : "red";		
			$data_arr[] = array(				
				"#".$offer['entity']['id']. " ".$offer['entity']['title'],
				"$".number_format($offer['value'],2,'.',''),		
				"<span class='$cls'>".$offer['change']."%"."</span>"
			);
		}
	
		$output = array(
			"draw" => $draw,
			"recordsTotal" => count($data_arr),
			"recordsFiltered" => count($data_arr),
			"data" => $data_arr
		);
		echo json_encode($output);
		
	}
	public function newreports_api($type="top-offers", $date_filter)
	{				
		date_default_timezone_set("Europe/Paris");
		//today, yesterday, last7Days, last14Days, last30Days, last90Days, thisMonth, lastMonth, thisYear, lastYear, allTime and custom
		$date_filter = str_replace(" ","",$date_filter);	
		if($date_filter == "today"){
			$start_date = date("Y-m-d");
			$end_date = date("Y-m-d");	
		} elseif($date_filter =="thisMonth"){
			$start_date = date("Y-m-01");
			$end_date = date("Y-m-d");	
		} elseif($date_filter =="lastMonth"){
			$start_date = date("Y-m-d",strtotime("first day of previous month"));
			$end_date = date("Y-m-d",strtotime("last day of previous month"));	
		} elseif($date_filter =="thisYear"){
			$start_date = date("Y-01-01");
			$end_date = date("Y-m-d");	
		} elseif($date_filter =="lastYear"){
			$start_date = date("Y-01-01",strtotime("-1 year"));
			$end_date = date("Y-12-31",strtotime("-1 year"));
		}else{
			$minus_day = 0;			
			switch($date_filter){
				case "yesterday" : $minus_day = -1; break;
				case "last7Days" : $minus_day = -7; break;
				case "last14Days" : $minus_day = -14; break;
				case "last30Days" : $minus_day = -30; break;
				case "last60Days" : $minus_day = -60; break;
				case "last90Days" : $minus_day = -90; break;
			}
			$start_date = date("Y-m-d",strtotime("$minus_day days"));
			$end_date = date("Y-m-d",strtotime("-1 days"));
		}		
		header('Access-Control-Allow-Origin: *'); // Allow requests from any domain
		header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Authorization");

		if($date_filter =="alltime"){
			$url = 'https://tremendio.scaletrk.com/api/v2/network/dashboard/statistics/'.$type.'?api-key=aafcf12b64ca3230279a89aa8b6eacf03c7c59da&lang=en&sortField=value&sortDirection=desc&perPage=50&page=1'; // URL of the API you want to request		
		} else if($date_filter == "today"){
			$url = 'https://tremendio.scaletrk.com/api/v2/network/dashboard/statistics/'.$type.'?api-key=aafcf12b64ca3230279a89aa8b6eacf03c7c59da&lang=en&sortField=value&sortDirection=desc&perPage=50&page=1&rangeFrom='.$start_date.'&rangeTo='.$end_date.'&preset=today'; // URL of the API you want to request		
		}else {
			$url = 'https://tremendio.scaletrk.com/api/v2/network/dashboard/statistics/'.$type.'?api-key=aafcf12b64ca3230279a89aa8b6eacf03c7c59da&lang=en&sortField=value&sortDirection=desc&perPage=50&page=1&rangeFrom='.$start_date.'&rangeTo='.$end_date; // URL of the API you want to request		
		}			
		$data = json_decode(file_get_contents($url), true); 	
		
		return $data;
	}

}
