<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Adminlinkcheck extends MY_Controller
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
		$data["title"] = "Link Check | Click ADV";
		$data["pagename"] = "Link Check";
		$this->load_page2("adminlinkcheck", $data, "adminlinkcheck_footer.php", "adminlinkcheck_header.php");

	}
	
	public function api()
{
	header('Access-Control-Allow-Origin: *'); // Allow requests from any domain
	header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
	header("Access-Control-Allow-Headers: Content-Type, Authorization");
	$apiKey = '2d79fa4d329c17de8973a1e862539c344830a0a96ccc53599848164c11630c86';
	$urls = array(
		'https://www.virustotal.com/api/v3/urls/86a9b5e5f5dd635310624a6add6646bb7d4813c0d925c5dd7084ed81b95af56c',
		'https://www.virustotal.com/api/v3/urls/3ff7aded799302aec0a9e5aa17bbc5845a1b127a2d46a8f71daaf6e2eb92d855',
		'https://www.virustotal.com/api/v3/urls/39b88d34e4a8625930115fe8e50a92ff2eb6fcd8a08c9ff2d9d9ab202a47f4e8',

		'https://www.virustotal.com/api/v3/urls/2f5bfafa68a2e81fd7f5ecc197896151427d90c09698a26f491d5f0d8a32db1c',
		'https://www.virustotal.com/api/v3/urls/b860136b6738af19fc490c7b655a87e2f78aa6e0bb35e5025bf897c69a7d3eb6',
		'https://www.virustotal.com/api/v3/urls/68322d9f9279a4b5b6aa95f6c24e8dcec586ed59df6fb370217142516bb109bb',

		'https://www.virustotal.com/api/v3/urls/e9740affc52cb9180b41fb8f5f0327267061c573b514bc9e069fe44b5c31001a',
		'https://www.virustotal.com/api/v3/urls/ae3c9be37190f9b7da5be2d6fd5675876f8366d2487f4021a330a0c6262e9501',
		'https://www.virustotal.com/api/v3/urls/0d1a5c9c8eb7fdda73f12160feabf62880a98261a73090bc80b9e403ef5e1cc8',

		'https://www.virustotal.com/api/v3/urls/309c17b8ec31ef409d7439f94f5d54df91a624b456a9fb2f5ae8161776ecd711',
		'https://www.virustotal.com/api/v3/urls/82294849b4def3330160ae0f5b9be8833e071fe380e88656ca8915ed0129472e',
		'https://www.virustotal.com/api/v3/urls/70b3ee0fe08ee2fa354dfa1d90ad83da16ef481f2ea45c294bb0b3b3a9ed0b77',


		'https://www.virustotal.com/api/v3/urls/84442b05cb3d87f1802a8576b0fe036d6842860731eb5eee466430fb0214a639',
		'https://www.virustotal.com/api/v3/urls/729fde97e478cc0778b250c4fa42835f97f16d52789ac220bbcdd8f95c3cb7e4',
		'https://www.virustotal.com/api/v3/urls/a0a37302e7d55d853b34fbe7aee5fce8c692a1a79bde00f067888b4bbe541d72',

		'https://www.virustotal.com/api/v3/urls/b1403eb1fea1d7372a44dbaae582eff1bf1f6cadedf1c093ee5aeb64ba28df88',
		'https://www.virustotal.com/api/v3/urls/6bd6b0a8be6fbfff24db51ec6beb80e96d85f07da9a0a0aa0717c53bbd270010',
		'https://www.virustotal.com/api/v3/urls/f35412cfdfb30e7e497bbae4fe618a5863b461caaaf8c2a12985cd3223a86178',

		'https://www.virustotal.com/api/v3/urls/c68710ee895db09491c725e223912a91182ac6aad4a4c0fb3a58b0a4db93392c',
		'https://www.virustotal.com/api/v3/urls/4964871542365ac47ec1108137f85b3dcf2507d5149a15a062b0a6b036dfa51c',



	); // Array of URLs you want to request

	$data = array();
	foreach ($urls as $url) {
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n" .
							"x-apikey: $apiKey\r\n",
				'method'  => 'GET'
			)
		);
		$context  = stream_context_create($options);
		$response = file_get_contents($url, false, $context);
		
		$data[] = $response; // Add the response to the data array
	}

echo json_encode($data); // Return the array of responses as JSON to your frontend code


}
}
