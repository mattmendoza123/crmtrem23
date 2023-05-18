<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Exclusiveoffers extends MY_Controller
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
		$data["title"] = "Exclusive Offers | Click ADV";
		$data["pagename"] = "Exclusive Offers";

		$this->load_page2("exclusiveoffers", $data, "exclusiveoffers_footer.php", "exclusiveoffers_header.php");
	}
	

	public function exclusiveoffers_api()
	{
	header('Access-Control-Allow-Origin: *'); // Allow requests from any domain
	header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
	header("Access-Control-Allow-Headers: Content-Type, Authorization");
	$url = 'https://tremendio.scaletrk.com/api/v2/network/offers?api-key=aafcf12b64ca3230279a89aa8b6eacf03c7c59da&status=active&search=&perPage=20&page=1&categories=62'; // URL of the API you want to request
	$data = file_get_contents($url); // Make the request and get the response
	echo $data; // Return the response to your frontend code
	}

}
