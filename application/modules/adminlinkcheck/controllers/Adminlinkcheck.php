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
	// $apiKey = '2d79fa4d329c17de8973a1e862539c344830a0a96ccc53599848164c11630c86';
	// $apiKey = 'd04a998808ef6d256cfb90991efbc5fd1987b7283bec8c38f5e5efcd2ceb2d2b';
	$apiKey = '5664f3e4ced248681f8f0ac0c4f062e8ad618ffdfb5581e382e12ca86c8bbe6e';
	$urls = array(

		//Old
		// 'https://www.virustotal.com/api/v3/urls/86a9b5e5f5dd635310624a6add6646bb7d4813c0d925c5dd7084ed81b95af56c',
		// 'https://www.virustotal.com/api/v3/urls/3ff7aded799302aec0a9e5aa17bbc5845a1b127a2d46a8f71daaf6e2eb92d855',
		// 'https://www.virustotal.com/api/v3/urls/39b88d34e4a8625930115fe8e50a92ff2eb6fcd8a08c9ff2d9d9ab202a47f4e8',

		// 'https://www.virustotal.com/api/v3/urls/2f5bfafa68a2e81fd7f5ecc197896151427d90c09698a26f491d5f0d8a32db1c',
		// 'https://www.virustotal.com/api/v3/urls/b860136b6738af19fc490c7b655a87e2f78aa6e0bb35e5025bf897c69a7d3eb6',
		// 'https://www.virustotal.com/api/v3/urls/68322d9f9279a4b5b6aa95f6c24e8dcec586ed59df6fb370217142516bb109bb',

		// 'https://www.virustotal.com/api/v3/urls/e9740affc52cb9180b41fb8f5f0327267061c573b514bc9e069fe44b5c31001a',
		// 'https://www.virustotal.com/api/v3/urls/ae3c9be37190f9b7da5be2d6fd5675876f8366d2487f4021a330a0c6262e9501',
		// 'https://www.virustotal.com/api/v3/urls/0d1a5c9c8eb7fdda73f12160feabf62880a98261a73090bc80b9e403ef5e1cc8',

		// 'https://www.virustotal.com/api/v3/urls/309c17b8ec31ef409d7439f94f5d54df91a624b456a9fb2f5ae8161776ecd711',
		// 'https://www.virustotal.com/api/v3/urls/82294849b4def3330160ae0f5b9be8833e071fe380e88656ca8915ed0129472e',
		// 'https://www.virustotal.com/api/v3/urls/70b3ee0fe08ee2fa354dfa1d90ad83da16ef481f2ea45c294bb0b3b3a9ed0b77',


		// 'https://www.virustotal.com/api/v3/urls/84442b05cb3d87f1802a8576b0fe036d6842860731eb5eee466430fb0214a639',
		// 'https://www.virustotal.com/api/v3/urls/729fde97e478cc0778b250c4fa42835f97f16d52789ac220bbcdd8f95c3cb7e4',
		// 'https://www.virustotal.com/api/v3/urls/a0a37302e7d55d853b34fbe7aee5fce8c692a1a79bde00f067888b4bbe541d72',

		// 'https://www.virustotal.com/api/v3/urls/b1403eb1fea1d7372a44dbaae582eff1bf1f6cadedf1c093ee5aeb64ba28df88',
		// 'https://www.virustotal.com/api/v3/urls/6bd6b0a8be6fbfff24db51ec6beb80e96d85f07da9a0a0aa0717c53bbd270010',
		// 'https://www.virustotal.com/api/v3/urls/f35412cfdfb30e7e497bbae4fe618a5863b461caaaf8c2a12985cd3223a86178',

		// 'https://www.virustotal.com/api/v3/urls/c68710ee895db09491c725e223912a91182ac6aad4a4c0fb3a58b0a4db93392c',
		// 'https://www.virustotal.com/api/v3/urls/4964871542365ac47ec1108137f85b3dcf2507d5149a15a062b0a6b036dfa51c',

		// New Links
		'https://www.virustotal.com/api/v3/urls/9f02efe1cb700c42328c945cebf26524d4e27a5c5c342217439801968994eb7c',
		'https://www.virustotal.com/api/v3/urls/9423618c963cbc56867b435e83106b4cda417521855515539333bbeef218a98f',
		'https://www.virustotal.com/api/v3/urls/9029571ce26c7a828fb695c2d6212479fae97ea41ddb6dd9b4ff3d09376ad3b3',

		'https://www.virustotal.com/api/v3/urls/318d9edeb07274b1af1f1ecf3be00c6ea9914d5c8826d08e0e837b83c996f0da',
		'https://www.virustotal.com/api/v3/urls/1eabc9977a80f07387953a432cea01e95f5be57fe16cec8adef061de536017ce',
		'https://www.virustotal.com/api/v3/urls/ada879640063b001012cc7546ad7b2f5f60c355ad236919dca41b580cb9e693a',

		'https://www.virustotal.com/api/v3/urls/df2ec2611b71562a5545ac053b23b1f1a0f6afbd13d86eb4de54aa3766a67631',
		'https://www.virustotal.com/api/v3/urls/5e691c9b671716ddb42d4ab42289414458d95227608aeae4db3a5c622306b785',
		'https://www.virustotal.com/api/v3/urls/49dad4540997f366b3df563b93c773ff22f329058a77f0aa8b73ee8ecfdf37ca',

		'https://www.virustotal.com/api/v3/urls/ab086fc74c313e5a42f956cb117a1480b820a9ad96d1b98bbcb6a99d7dd5c2db',
		'https://www.virustotal.com/api/v3/urls/3c89d532ababa77816daa1be4ef14111692750dda8fe389c86723656467710df',
		'https://www.virustotal.com/api/v3/urls/e88bf24d7dfb35fbfc22749b5dcf3ab1c1202a7cafe160ed9ed058c6b150b48e',


		'https://www.virustotal.com/api/v3/urls/8b711733354bb20e56d6ee9841b7b49e08dd397f0a5071cb083477ef456b0071',
		'https://www.virustotal.com/api/v3/urls/32735e462ad70977b06a96f13c2ac270f98c072539e0550b18d09c47858f025d',
		'https://www.virustotal.com/api/v3/urls/ba5c76cb1e5304fe17e804eeeb6be82193a03e0649b36749151dd772ba16c75e',

		'https://www.virustotal.com/api/v3/urls/6958e04e0b360816d15e6cc976387ae36d4a15e34b9a5ea6d8212f5efc4844ea',
		'https://www.virustotal.com/api/v3/urls/359f695aa4361483027eaded2316c146ad41686aa66af02f1711af1b736c5aa7',
		'https://www.virustotal.com/api/v3/urls/c7ffd3bd54e072eed5da9528a0835051a4b837307b37637657048370d156b5d3',

		'https://www.virustotal.com/api/v3/urls/3fbad26659b690e98ce76b9e4e288a20cf12fbb9b92cf60c610ae7768d9d38a9',
		'https://www.virustotal.com/api/v3/urls/e45fe5e9e614d8966997d67aa764c123ecbcbe7d026d99478e7077eca813a98e',
		'https://www.virustotal.com/api/v3/urls/79cff6301a1dfb544830a5e74f009ef5b9e358857deaa2ac3a0ce9c9be52f20f',



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
