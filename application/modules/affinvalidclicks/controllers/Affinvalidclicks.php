<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Affinvalidclicks extends MY_Controller
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
		$data["title"] = "Invalid Clicks | Click ADV";
		$data["pagename"] = "Invalid Clicks";
		
		$this->load_page2("affinvalidclicks", $data, "affinvalidclicks_footer.php", "affinvalidclicks_header.php");

	}
	
	public function invalidclick_api()
	{
	header('Access-Control-Allow-Origin: *'); // Allow requests from any domain
	header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
	header("Access-Control-Allow-Headers: Content-Type, Authorization");
	$url = 'https://tremendio.scaletrk.com/api/v2/network/reports/logs/clicks?api-key=aafcf12b64ca3230279a89aa8b6eacf03c7c59da&page=1&perPage=1000&lang=en&sortField=added_timestamp&sortDirection=desc&columns=added_timestamp,reason,destination,affiliate,click_referer_url,offer,link,creative,sub_id1,sub_id2,sub_id3,sub_id4,sub_id5,language,aff_param1,aff_param2,aff_param3,aff_param4,aff_param5,geo,connection_type,mobile_operator,aff_click_id,device_type,deep_link_url,device_brand,device_model,source,device_os,device_os_version,browser,browser_version&filters=affiliates,offers,reason,aff_click_ids,geo,countries,devices_types,devices_brands,devices_models,devices_os,browsers,languages,connections_types,mobile_operators,ips,idfa,gaid&rangeFrom=2023-01-01&rangeTo=2023-12-31'; // URL of the API you want to request
	$data = file_get_contents($url); // Make the request and get the response
	echo $data; // Return the response to your frontend code
	}

}
