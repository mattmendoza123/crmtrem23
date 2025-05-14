<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scaleo extends MY_Controller
{

	private $errmsg = "";

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url'); 
	}

	public function mapOffers($offer){		
		return $offer;
		/*$clean_offer = str_replace(" ","_",$offer);	
		$offerNameMap = [
			"PRIVATE_#1247_FlirtyNLocal_-_US_-_DOI" => "Flirty n Local",
			"1247_-_Flirtymilfs_-_US_-_CPL_-_SOI" => "Flirty Milfs",
			"1247_-_BBWtodate_-_US_-_CPL_-_SOI" => "BBW to date",
			"1247_-_One-nightstand_-_US_-_CPL_-_DOI" => "One Night stand",
			"1247_ONLY_Ashley_Madison_-_US_-_CPL_-_SOI_-_WEB/WAP"=> "Ashley Madison"
		];
	
		if(array_key_exists($clean_offer,$offerNameMap)){
			return $offerNameMap[$clean_offer];
		}else {
			//return "";			
			return $offer;
		}	*/	
	}
	public function index(){
		$this->filter("Today");
	}	
	public function filter($date_filter)
	{		
		$data["title"] = "Scaleo Campaigns | Click ADV";
		$data['date_filter'] = $date_filter;
		$data["pagename"] = "Scaleo";
		$data['date_filters'] = ["Today","Yesterday","Last 7 Days","Last 30 Days","Last 60 Days","Last 90 Days","This Month","Last Month","This Year","Last Year"];
		

		$newreporst_api = $this->newreports_api($date_filter);
		$data['dates'] = $newreporst_api['dates'];
		$data['barchart_data_title_per_offer'] = "Scaleo Reports Per Offer";
		$data['barchart_data_title_total_offer'] = "Scaleo Reports Total Offer";
		$data['data_total'] = $newreporst_api['info']['rows']['totals'];

		
		
		$offer_arr = [];
		$offer = [];
		$total_revenue = 0;
		$total_conversions = 0;
		foreach($newreporst_api['info']['rows']['rows'] as $row=>$report){
			$offer_name = $this->mapOffers($report['offer']['value']);
			if($offer_name!=""){
					$offer = ['name'=> $offer_name, 
							'total_payout' => $report['total_payout'], 
							'approx_spend'=> 100,
							'cv_approved'=>$report['cv_approved'],
							'total_revenue'=> $report['total_revenue'],
							'bar_data'=>[['value'=> $report['total_payout'], 'x'=>'Payout','normal'=>['fill'=>'#515151','stroke'=>'#515151']],
										['value'=> 100, 'x'=>'Approx Spend','normal'=>['fill'=>'#7ac0f4']]],
							'epc'=>  $report['epc'],
							"dataPoints" => [['value' => $report['cv_approved'] , 'x' => "QTY/Approved Conversion", 'normal'=> ['fill'=>'#515151']], 
											['value' => $report['total_revenue'] , 'x' => "Total Revenue"],
											['value' => $report['epc'] , 'x' => "EPC"]]
							]; 			
					array_push($offer_arr,$offer);
					$total_revenue += $report['total_revenue'];
					$total_conversions += $report['cv_approved'];
			}
		}
		//TAB 1	
		$data['tab_per_offer_data'] = json_encode($offer_arr);
		$data['total_revenue'] = $total_revenue;	
		$data['total_conversions'] = $total_conversions;	
		$data['num_offers'] = count($offer);		
		
			
		$this->load_page2("scaleo", $data, "i_footer.php", "i_header.php");
	}	
	public function newreports_api($date_filter)
	{		
		date_default_timezone_set("Europe/Paris");
		if($date_filter == "Today"){
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
		}
		header('Access-Control-Allow-Origin: *'); // Allow requests from any domain
		header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Authorization");
		$url = 'https://tremendio.scaletrk.com/api/v2/network/reports/statistics?api-key=50b3610e8131bed482340559725750ac13682d0d&lang=en&sortField=offer&sortDirection=desc&perPage=1000&page=1&rangeFrom='.$start_date.'&rangeTo='.$end_date.'&breakdown=offer&columns=impressions,ctr,clicks,unique_clicks,duplicate_clicks,invalid_clicks,clicks_revenue,clicks_payout,clicks_profit,clicks_margin,cv_approved,cr,approved_revenue,approved_payout,approved_profit,approved_margin,approved_gross_sales,cv_total,tr,total_revenue,total_payout,total_profit,total_margin,cv_pending,pr,pending_revenue,pending_payout,pending_profit,pending_margin,pending_gross_sales,total_gross_sales,cv_rejected,rr,rejected_revenue,rejected_payout,rejected_profit,rejected_margin,rejected_gross_sales,epm,antifraud_logic_score,rpc,cpc,epc,rpa,cpa,epa,rpm,cpm&filters[affiliates]=1247'; // URL of the API you want to request
		$data = json_decode(file_get_contents($url), true); 
		$data['dates'] = $start_date ." to ".$end_date;
		return $data;
	}

}
