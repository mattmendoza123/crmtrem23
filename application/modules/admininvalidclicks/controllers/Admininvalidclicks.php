<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Admininvalidclicks extends MY_Controller
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
		$data["title"] = "Invalid Clicks | Tremendio Portal";
		$data["pagename"] = "Invalid Clicks";
		
		$this->load_page2("admininvalidclicks", $data, "admininvalidclicks_footer.php", "admininvalidclicks_header.php");

	}
	
	public function invalidclick_api()
	{
	$draw = intval($this->input->post("draw"));
	$start = intval($this->input->post("start"));
	$length = intval($this->input->post("length"));
	$order = $this->input->post("order");
	$search = $this->input->post("search");

	header('Access-Control-Allow-Origin: *'); // Allow requests from any domain
	header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
	header("Access-Control-Allow-Headers: Content-Type, Authorization");
	
	$start_date = $this->input->post("from_date")!= "" ?  $this->input->post("from_date") : "2023-01-01";
	$end_date = $this->input->post("to_date")!= "" ?  $this->input->post("to_date") : date("Y-m-d");

	$url = 'https://tremendio.scaletrk.com/api/v2/network/reports/logs/clicks?api-key=aafcf12b64ca3230279a89aa8b6eacf03c7c59da&page=1&perPage=500&lang=en&sortField=added_timestamp&sortDirection=desc&columns=added_timestamp,reason,destination,affiliate,click_referer_url,offer,link,creative,sub_id1,sub_id2,sub_id3,sub_id4,sub_id5,language,aff_param1,aff_param2,aff_param3,aff_param4,aff_param5,geo,connection_type,mobile_operator,aff_click_id,device_type,deep_link_url,device_brand,device_model,source,device_os,device_os_version,browser,browser_version&filters=affiliates,offers,reason,aff_click_ids,geo,countries,devices_types,devices_brands,devices_models,devices_os,browsers,languages,connections_types,mobile_operators,ips,idfa,gaid&rangeFrom='.$start_date.'&rangeTo='.$end_date.'';
	

	$data = json_decode(file_get_contents($url)); // Make the request and get the response
	//echo $data; // Return the response to your frontend code
	

	
//$data->transactrions
	/*
	(transaction => {
		var affiliateName = transaction.affiliate ? transaction.affiliate.value : "N/A";
		var offerName = transaction.offer ? transaction.offer.value : "N/A";
		var clickTimestamp = transaction.added_timestamp ? new Date(transaction.added_timestamp) : "N/A";
		var reason = transaction.reason ? transaction.reason : "N/A";

		// Convert the timestamp to GMT+1 (CET)
		clickTimestamp = clickTimestamp.toLocaleString('en-US', { timeZone: 'Europe/Belgrade' });

		if (!affiliateOffers[affiliateName]) {
			affiliateOffers[affiliateName] = [];
		}

		var existingOfferIndex = affiliateOffers[affiliateName].findIndex(offerInfo => offerInfo.offer === offerName);
		if (existingOfferIndex !== -1) {
			affiliateOffers[affiliateName][existingOfferIndex].clicks++;
		} else {
			affiliateOffers[affiliateName].push({
				offer: offerName,
				clicks: 1,
				clickTimestamp: clickTimestamp,
				reason: reason
			});
		}
	}); */
	
	$data_arr = [];
	$affiliateOffers = [];
	foreach ($data->info->transactions as $transaction) {
		$affiliateName = ($transaction->affiliate->value!="") ? $transaction->affiliate->value : "N/A";
		$offerName = ($transaction->offer->value!="") ? $transaction->offer->value : "N/A";

		if (!isset($affiliateOffers[$affiliateName])) {
			$affiliateOffers[$affiliateName]= [];
		}
		//echo $offerName;
		
		$existingOfferIndex = array_search($offerName,$affiliateOffers);


		if ($existingOfferIndex) {
			$affiliateOffers[$affiliateName][$existingOfferIndex]->clicks++;
		} else {

			$offerInfo = [
				'offer'=> $offerName,
				'clicks'=> 1,
				'clickTimestamp'=> $transaction->added_timestamp,
				'reason'=>  $transaction->reason
			];		
			array_push($affiliateOffers[$affiliateName],$offerInfo);
		}	
	
	}

	foreach($affiliateOffers as $i => $affOfers){
		print_r($affOfers[$i]);
		/*$data_arr[] = array(		
			$affOfers[$i]->offer,
			date("m/d/Y h:i:s A", strtotime($affOfers[$i]->clickTimestamp)),
			$affOfers[$i]->clicks,					
			''
		);	*/
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
