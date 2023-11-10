<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Webassets extends MY_Controller
{

	private $errmsg = "";
    private $webassets_list;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		
		// we get the application folder so that we dont have to set this everytime we migrate the codebase
		$dir_list = explode("/",__DIR__);
		$application_folder = "";
		foreach ( $dir_list as $key => $folder_name ){
			if ( $folder_name != "" ){
				$application_folder .= "/".$folder_name;
			}
			if ( strtoupper($folder_name) == "APPLICATION" ){
				break;
			}
		}
        $this->webassets_list = $application_folder."/cache/webassets.json";
	}

	public function index()
	{
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
		$data["title"] = "Web Assets | Click ADV";
		$data["pagename"] = "Web Assets";
		
		$this->load_page2("webassets", $data, "webassets_footer.php", "webassets_header.php");

	}
	
	public function webassets_api()
{
	header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
	header("Access-Control-Allow-Headers: Content-Type, Authorization");
	
	$retrieved_domains = array();
	$error = NULL;
	$page_size = 100;
	$has_more = true; // we will use the has_more flag if we need to run the query for the first time, or if we know there are more results for the next page
	$page = 1;
	$total_records = 0;
	
	while ( $has_more ) {
		$url = "https://api.namecheap.com/xml.response?ApiUser=jpmacz29&ApiKey=dc559ce7bbf74489a3dcfa082e66be4d&UserName=jpmacz29&Command=namecheap.domains.getList&ClientIp=167.99.205.45&PageSize={$page_size}&Page={$page}";
		// Fetch the data from the URL
		$data = file_get_contents($url);
		
		// Check if data was fetched successfully
		if ($data === false) {
			$error = 'Failed to fetch data from the Namecheap API'; 
			break;
		} else {
			// Parse the XML data
			$xml = simplexml_load_string($data);
		
			// check if the response returned any error like IP address related or such
			if ( property_exists($xml, 'Errors')){
				if ( property_exists($xml->Errors, 'Error')){
					$error = ($xml->Errors->Error != "") ? $xml->Errors->Error : NULL;
					break;
				}
			}
			
			// get the totalItems (total records) field
			$total_records = $xml->CommandResponse->Paging->TotalItems;
			// start parsing data
			foreach ($xml->CommandResponse->DomainGetListResult->Domain as $domain) {
				$domainData = [
					'ID' => (string)$domain['ID'],
					'Name' => (string)$domain['Name'],
					'Expires' => (string)$domain['Expires'],
				];
				$retrieved_domains[] = $domainData;
			}	
		}
		
		// check to see how many records we got compared to how many actual total records for the query
		// if we already got equal or more than the total_records, then turn off the flag so we dont have to query the next page
		if ( count($retrieved_domains) >= $total_records ){
			$has_more = false;
		}
		// go to the next page for the next cycle
		$page++;
	}
	
	if ( !is_null($error) ){
		// Handle the error, e.g., return an error response
		// http_response_code(500); // Internal Server Error
		// dont return 500 so the frontend can consume the error message
		header('Content-Type: application/json');
		echo json_encode(['error' => $error]);
	} else {

		// read contents of cache first
		$existing_webassets_list = array();
		$input = file_get_contents($this->webassets_list);
		if ( $input ) {
			$existing_webassets_list = json_decode($input);
		}

		// print_r($existing_webassets_list); //returned as array of objects

		$final_domain_list = array();
		foreach ( $retrieved_domains as $current_retrieved_domain ){
			// print_r($current_domain); //returned as array of arrays
			$temp_domain_data = (object) $current_retrieved_domain;
			$temp_domain_data->tag = 'N/A';
			$temp_domain_data->comment = 'N/A';
			foreach ( $existing_webassets_list as $existing_webasset ){
				if ( $existing_webasset->ID == $current_retrieved_domain['ID']){
					// if we found the retrieved domain to already be in the stored json
					if ( property_exists($existing_webasset, 'tag')){
						$temp_domain_data->tag = $existing_webasset->tag;
					}
					if ( property_exists($existing_webasset, 'comment')){
						$temp_domain_data->comment = $existing_webasset->comment;
					}
				}
			}
			$final_domain_list[] = $temp_domain_data;
		}

		// print_r($final_domain_list);

		// write to local cache
		// echo "webassets_list: {$this->webassets_list}\n";
		
		// check if directory exists, if not, create it
        $dirname = dirname($this->webassets_list);
        if (file_exists($this->webassets_list)){
            unlink(realpath($this->webassets_list));
        }
        if (!is_dir($dirname))
        {
            mkdir($dirname, 0755, true);
        }
        $temp_file_stream = fopen($this->webassets_list, 'w');
        fwrite($temp_file_stream, json_encode($final_domain_list));
        fclose($temp_file_stream);

		$response = [
			'domains' => $final_domain_list,
		];

		header('Content-Type: application/json');
		echo json_encode($response);
	}
}

// public function update_modal()
// {
//     $post = $this->input->post();

// 	// print_r($post);
// 	$web_id = array_key_exists('u_web_id', $post) ? $post["u_web_id"] : NULL;
// 	$tag = array_key_exists('u_tags', $post) ? $post["u_tags"] : NULL;
// 	$comment = array_key_exists('u_comment', $post) ? $post["u_comment"] : NULL;

// 	// we update the json based on the new update
// 	if ( !is_null($web_id) && (!is_null($tag) || !is_null($comment))){

// 		// read contents of cache first
// 		$existing_webassets_list = array();
// 		$input = file_get_contents($this->webassets_list);
// 		if ( $input ) {
// 			$existing_webassets_list = json_decode($input);
// 		}
// 		// print_r($existing_webassets_list); //returned as array of objects
// 		$final_domain_list = array();
// 		foreach ( $existing_webassets_list as $existing_webasset ){
// 			$temp_domain_data = $existing_webasset;
// 			if ( $existing_webasset->ID == $web_id ){
// 				if (!is_null($tag)){
// 					$temp_domain_data->tag = $tag;
// 					echo "updating web_id {$web_id} tag {$tag}\n";
// 				}
// 				if (!is_null($comment)){
// 					$temp_domain_data->comment = $comment;
// 					echo "updating web_id {$web_id} comment {$comment}\n";
// 				}
// 			}
// 			$final_domain_list[] = $temp_domain_data;
// 		}
		
// 		// check if directory exists, if not, create it
//         $dirname = dirname($this->webassets_list);
//         if (file_exists($this->webassets_list)){
//             unlink(realpath($this->webassets_list));
//         }
//         if (!is_dir($dirname))
//         {
//             mkdir($dirname, 0755, true);
//         }
//         $temp_file_stream = fopen($this->webassets_list, 'w');
//         fwrite($temp_file_stream, json_encode($final_domain_list));
//         fclose($temp_file_stream);

// 	}

// 	$response = array();
//     echo json_encode($response);
// }

public function update_modal()
{
    $post = $this->input->post();

    $web_id = array_key_exists('u_web_id', $post) ? $post["u_web_id"] : NULL;
    $tag = array_key_exists('u_tags', $post) ? $post["u_tags"] : NULL;
    $comment = array_key_exists('u_comment', $post) ? $post["u_comment"] : NULL;

    $response = array();

    if (!is_null($web_id) && (!is_null($tag) || !is_null($comment))) {
        $existing_webassets_list = array();
        $input = file_get_contents($this->webassets_list);

        if ($input) {
            $existing_webassets_list = json_decode($input);
        }

        $final_domain_list = array();

        foreach ($existing_webassets_list as $existing_webasset) {
            $temp_domain_data = $existing_webasset;

            if ($existing_webasset->ID == $web_id) {
				if (!is_null($tag)) {
					$temp_domain_data->tag = $tag;
					$response['message'] = "Updated Successfully";
				}
				if (!is_null($comment)) {
					$temp_domain_data->comment = $comment;
					$response['message'] = "Updated Successfully";
				}
			}

            $final_domain_list[] = $temp_domain_data;
        }

        $dirname = dirname($this->webassets_list);

        if (file_exists($this->webassets_list)) {
            unlink(realpath($this->webassets_list));
        }

        if (!is_dir($dirname)) {
            mkdir($dirname, 0755, true);
        }

        $temp_file_stream = fopen($this->webassets_list, 'w');
        fwrite($temp_file_stream, json_encode($final_domain_list));
        fclose($temp_file_stream);

        $response['success'] = true;
    } else {
        $response['success'] = false;
		$response['message'] = "Update Error";
    }

    echo json_encode($response);
}




}
