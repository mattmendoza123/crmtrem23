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
			array("name"=> "thisMonth", "val"=> "Last Month"),
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
			$data_arr[] = array(				
				$offer['entity']['title'],
				$offer['value'],		
				$offer['change']	
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
			$data_arr[] = array(				
				$offer['entity']['title'],
				$offer['value'],		
				$offer['change']	
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
		
		header('Access-Control-Allow-Origin: *'); // Allow requests from any domain
		header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Authorization");
		if($date_filter !="custom"){
			$url = 'https://tremendio.scaletrk.com/api/v2/network/dashboard/statistics/'.$type.'?api-key=aafcf12b64ca3230279a89aa8b6eacf03c7c59da&lang=en&sortField=value&sortDirection=desc&perPage=50&page=1&preset='.$date_filter; // URL of the API you want to request		
		} else {
			$url = 'https://tremendio.scaletrk.com/api/v2/network/dashboard/statistics/'.$type.'?api-key=aafcf12b64ca3230279a89aa8b6eacf03c7c59da&lang=en&sortField=value&sortDirection=desc&perPage=50&page=1&rangeFrom='.$start_date.'&rangeTo='.$end_date; // URL of the API you want to request		
		}	
		$data = json_decode(file_get_contents($url), true); 	
		return $data;
	}

}
