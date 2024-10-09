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
		$data['date_filters'] = ["Today","Yesterday","Last 7 Days","Last 30 Days","Last 60 Days","Last 90 Days","This Month","Last Month","This Year","Last Year"];
		
		$this->load_page2("stats", $data, "i_footer.php", "i_header.php"); 
	}	
	public function top_offers($date_filter = "This Year"){		
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
	public function top_affiliates($date_filter = "This Year"){		
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
	
		$date_filter = str_replace(" ","",$date_filter);	
		if($date_filter == "Today"){
			$start_date = date("Y-m-d");
			$end_date = date("Y-m-d");	
		} elseif($date_filter =="ThisMonth"){
			$start_date = date("Y-m-01");
			$end_date = date("Y-m-d");	
		} elseif($date_filter =="LastMonth"){
			$start_date = date("Y-m-d",strtotime("first day of previous month"));
			$end_date = date("Y-m-d",strtotime("last day of previous month"));	
		} elseif($date_filter =="ThisYear"){
			$start_date = date("Y-01-01");
			$end_date = date("Y-m-d");	
		} elseif($date_filter =="LastYear"){
			$start_date = date("Y-01-01",strtotime("-1 year"));
			$end_date = date("Y-12-31",strtotime("-1 year"));
		}else{
			$minus_day = 0;			
			switch($date_filter){
				case "Yesterday" : $minus_day = -1; break;
				case "Last7Days" : $minus_day = -7; break;
				case "Last30Days" : $minus_day = -30; break;
				case "Last60Days" : $minus_day = -60; break;
				case "Last90Days" : $minus_day = -90; break;
			}
			$start_date = date("Y-m-d",strtotime("$minus_day days"));
			$end_date = date("Y-m-d",strtotime("-1 days"));
		}		
		header('Access-Control-Allow-Origin: *'); // Allow requests from any domain
		header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Authorization");
		
		$url = 'https://tremendio.scaletrk.com/api/v2/network/dashboard/statistics/'.$type.'?api-key=aafcf12b64ca3230279a89aa8b6eacf03c7c59da&lang=en&sortField=value&sortDirection=desc&perPage=50&page=1&rangeFrom='.$start_date.'&rangeTo='.$end_date; // URL of the API you want to request
		
		$data = json_decode(file_get_contents($url), true); 
		$data['dates'] = $start_date ." to ".$end_date;	
		return $data;
	}

}
