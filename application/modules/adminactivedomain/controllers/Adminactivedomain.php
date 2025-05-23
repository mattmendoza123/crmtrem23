<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('America/New_York'); 
class Adminactivedomain extends MY_Controller
{


	private $errmsg = "";

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
        $this->load->database();

            // Replace with your actual API key
            $this->apiKey = 'd04a998808ef6d256cfb90991efbc5fd1987b7283bec8c38f5e5efcd2ceb2d2b';
            // $this->apiKey = '2d79fa4d329c17de8973a1e862539c344830a0a96ccc53599848164c11630c86';
            // $this->apiKey = '372c362e7c97ac0f7f20ee6b278179b486f23f64f0c15d87ce7562f83d27a1c8';
            // $this->apiKey = 'f2fe677fe6439e8574fcc40519aa398fb3e09b1096e8c3313cfb59437dcd29ab';
            // $this->apiKey = '2072cda478eb51d04bed004d4d7352dc16e097ac33bfc0f8847f447f54b1fe40';
            // $this->apiKey = '5664f3e4ced248681f8f0ac0c4f062e8ad618ffdfb5581e382e12ca86c8bbe6e';
      
	}
	public function index()
	{
			$data["title"] = "Active Domain | Tremendio Portal";
		$data["pagename"] = "Active Domain";
		$this->load_page2("adminactivedomain", $data, "adminactivedomain_footer.php", "adminactivedomain_header.php");
	}

    public function activedomain_api()
    {
        error_reporting(0);
        header('Access-Control-Allow-Origin: *'); // Allow requests from any domain
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
       
        // Database connection
        //$mysqli = new mysqli("localhost", "root", "", "greeocvu_wp580");
        
        // Check for a successful database connection
           
        $url = 'https://tremendio.scaletrk.com/api/v2/network/offers/1147/tracking-settings?api-key=50b3610e8131bed482340559725750ac13682d0d'; // URL of the API you want to request
        $data = file_get_contents($url); // Make the request and get the response
        
        // Decode the JSON response
        $responseData = json_decode($data, true);      
      
        // Check if the response contains tracking domains
        if (isset($responseData['info']['details']['tracking_domains']) && is_array($responseData['info']['details']['tracking_domains'])) {
            // Create an array to store processed URLs
            $processedUrls = [];
           
            // Iterate through tracking domains and insert them into the database
            foreach ($responseData['info']['details']['tracking_domains'] as $x=> $trackingDomain) {                
                $url = $trackingDomain['name'];                          
                // Check if the URL has already been processed
                if (!in_array($url, $processedUrls)) {                 
                    // Insert the URL into the database
                    $url .= '/';      
                    $domain_info = array(
                        'url' => $url,
                        'tags' => 'N/A',
                        'comments' =>'N/A',       
                        'hash'=> hash('sha256',$url)             
                    );

                    $this->db->where('url',$url);
                    
                    $query = $this->db->get('active_domain');
                    $num_rows = $query->num_rows();
                    $result = $query->result();
                    $responseData['info']['details']['tracking_domains'][$x]['active_id'] =  $result[0]->active_id;
                    $responseData['info']['details']['tracking_domains'][$x]['vtotal'] = unserialize($result[0]->vtotal);
                    $responseData['info']['details']['tracking_domains'][$x]['tags'] =  $result[0]->tags;
                    $responseData['info']['details']['tracking_domains'][$x]['comments'] =  $result[0]->comments;
                    $responseData['info']['details']['tracking_domains'][$x]['urlHash'] =  $domain_info['hash'];
                    $responseData['info']['details']['tracking_domains'][$x]['url'] =  $domain_info['url'];
                    $responseData['info']['details']['tracking_domains'][$x]['date_fetch'] = date("m/d/Y H:i:s A",strtotime($result[0]->date_fetch));
                    if($num_rows == 0){
                        $insert_domain = $this->db->insert('active_domain', $domain_info);    
                        $processedUrls[] = $url;                                    
                    } 
                    
                    //die;
                }
            }
          
            $response = ['success' => true , 'data' => $responseData];
        } else {
            $response = ['success' => false, 'message' => "No tracking domains found in the API response."];
        }
      
        
        // Send the response (you may want to return it in some way)
        header('Content-Type: application/json');
        echo json_encode($response);
}

function fetchVirusTotalData($hash){
    error_reporting(0);
    $url = $this->input->post("url");
    if($hash != ""){
        $this->db->where('hash',$hash);                    
        $query = $this->db->get('active_domain');
        $num_rows = $query->num_rows();
        $result = $query->result();
        
        if(count($result) > 0){
            if(date("Y-m-d",strtotime($result[0]->date_fetch)) == date("Y-m-d")){                             
                $this->db->set('date_fetch', date("Y-m-d h:i:s"));     
                $this->db->where('hash', $hash);
                $this->db->update('active_domain'); 
                $vtotal_data = unserialize($result[0]->vtotal);         
                return json_encode($vtotal_data);
            }
        }     
    }
      
    $apiKey = '5664f3e4ced248681f8f0ac0c4f062e8ad618ffdfb5581e382e12ca86c8bbe6e';      
    $urlEndpoint = "https://www.virustotal.com/api/v3/urls/{$hash}";
   
    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n" .
            "x-apikey: {$apiKey}\r\n",
            'method' => 'GET'
        )
    );

    $context  = stream_context_create($options);
    $response = file_get_contents($urlEndpoint, false, $context);   
   
    // Check if the response is valid JSON
    $result = json_decode($response, true);        
    $analysis_stats = $result['data']['attributes']['last_analysis_stats'];
    $final_url = $result['data']['attributes']['last_final_url'];  
    $vtotal = array(
        'harmless' => $analysis_stats['harmless'],
        'malicious' => $analysis_stats['malicious'],
        'suspicious' => $analysis_stats['suspicious'],
        'undetected' => $analysis_stats['undetected'],          
    );
    $this->db->set('date_fetch', date("Y-m-d h:i:s"));     
    $this->db->set('vtotal', serialize($vtotal));                 
    $this->db->set('hash', $hash);  
    $this->db->where('url', $url);              
    $this->db->update('active_domain');

    return json_encode($vtotal);
    
    die;
}

public function update_modal()
{
    $post = $this->input->post();
    $this->db->set('tags', implode(';', $post["u_tags"]));     
    $this->db->set('comments', $post["u_comment"]);                  
    $this->db->where('active_id', $post["u_active_id"]);              
    $this->db->update('active_domain');
 
    $response = array('success' => true, 'message' => 'Updated Successfully.');
  
    echo json_encode($response);
}

}









	


