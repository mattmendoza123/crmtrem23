<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Affactivedomain extends MY_Controller
{

    private $apiKey;

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
	
		$data["title"] = "Active Domain | Click ADV";
		$data["pagename"] = "Active Domain";

		$this->load_page2("affactivedomain", $data, "affactivedomain_footer.php", "affactivedomain_header.php");
	}



    public function activedomain_api()
    {
        header('Access-Control-Allow-Origin: *'); // Allow requests from any domain
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        
        // Database connection
        $mysqli = new mysqli("localhost", "root", "password", "greeocvu_wp580");
        
        // Check for a successful database connection
        if ($mysqli->connect_error) {
            $response = ['success' => false, 'message' => 'Connection failed: ' . $mysqli->connect_error];
        } else {
            $url = 'https://tremendio.scaletrk.com/api/v2/network/offers/1147/tracking-settings?api-key=aafcf12b64ca3230279a89aa8b6eacf03c7c59da'; // URL of the API you want to request
            $data = file_get_contents($url); // Make the request and get the response
        
            // Decode the JSON response
            $responseData = json_decode($data, true);
        
            // Check if the response contains tracking domains
            if (isset($responseData['info']['details']['tracking_domains']) && is_array($responseData['info']['details']['tracking_domains'])) {
                // Create an array to store processed URLs
                $processedUrls = [];
        
                // Iterate through tracking domains and insert them into the database
                foreach ($responseData['info']['details']['tracking_domains'] as $trackingDomain) {
                    $url = $trackingDomain['name'];
        
                    // Check if the URL has already been processed
                    if (!in_array($url, $processedUrls)) {
                        // Insert the URL into the database
                        $url .= '/';
    
                        $stmt = $mysqli->prepare("INSERT INTO active_domain (url, tags, comments) VALUES (?, 'N/A', 'N/A')");
                        $stmt->bind_param('s', $url);
        
                        // Execute the SQL statement
                        if ($stmt->execute()) {
                            $success = true;
        
                            // Add the URL to the list of processed URLs
                            $processedUrls[] = $url;
                        } else {
                            $success = false;
                            $errorMessage = $stmt->error;
                        }
                    }
                }
        
                // Close the database connection
                $mysqli->close();
                $response = ['success' => true];
            } else {
                $response = ['success' => false, 'message' => "No tracking domains found in the API response."];
            }
        }
        
        // Send the response (you may want to return it in some way)
        header('Content-Type: application/json');
        echo json_encode($response);
    }



// Virustotal

public function api()
{
    header('Access-Control-Allow-Origin: *'); // Allow requests from any domain
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");

    // Replace 'YOUR_API_KEY' with your actual API key
    $apiKey = 'd04a998808ef6d256cfb90991efbc5fd1987b7283bec8c38f5e5efcd2ceb2d2b';
    

    // Database connection
    $mysqli = new mysqli("localhost", "root", "password", "greeocvu_wp580");

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $sql = "SELECT * FROM active_domain";
    $result = $mysqli->query($sql);

    $data = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Add each row as an associative array to the $data array
            $data[] = $row;
        }
    }

    // Close the database connection
    $mysqli->close();

    $dataWithVirusTotal = array();

    foreach ($data as $row) {
        $url = $row['url'];

        // Fetch additional data from the VirusTotal API
        $virusTotalData = $this->fetchVirusTotalData($url, $apiKey); // Implement this function

        if ($virusTotalData) {
            // Merge the VirusTotal data with the existing data
            $mergedData = array_merge($row, $virusTotalData);
            $dataWithVirusTotal[] = $mergedData;
        }
    }

    // Send the response as JSON
    echo json_encode($dataWithVirusTotal);
}

private function fetchVirusTotalData($url, $apiKey)
{
    $hash = hash('sha256', $url);
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

    if ($result && isset($result['data']['attributes']['last_analysis_stats'])) {
        // Extract the desired scan result statistics
        return array(
            'harmless' => $result['data']['attributes']['last_analysis_stats']['harmless'],
            'malicious' => $result['data']['attributes']['last_analysis_stats']['malicious'],
            'suspicious' => $result['data']['attributes']['last_analysis_stats']['suspicious'],
            'undetected' => $result['data']['attributes']['last_analysis_stats']['undetected']
        );
    } else {
        // Handle non-JSON response (e.g., HTML error page)
        // You can log the response or take appropriate action
        error_log("Non-JSON response received for URL: $url");
        return null;
    }
}


public function update_modal()
{
    $post = $this->input->post();

    $set = array(
        'url' => $post["u_url"],
        'tags' => $post["u_tags"],
        'comments' => $post["u_comment"],
    );

    $where = array("active_id" => $post["u_active_id"]);
    $update = $this->MY_Model->update("active_domain", $set, $where);

    if ($update) {
        $response = array('success' => true, 'message' => 'Updated Successfully.');
        
    } else {
        $response = array('success' => false, 'message' => 'Update failed.');
    }

    echo json_encode($response);
}

// public function update_modal()
// {
//     // Database connection
//     $mysqli = new mysqli("localhost", "greeocvu_wp580", "Sp0-r!7XP@]6Fr", "greeocvu_wp580");

//     // Check if connection was successful
//     if ($mysqli->connect_error) {
//         die("Connection failed: " . $mysqli->connect_error);
//     }

//     $post = $this->input->post();

//     // Sanitize and validate input data
//     $u_tags = $this->input->post('u_tags');
//     $u_comment = $this->input->post('u_comment');
//     $active_id = $this->input->post('active_id');

//     // Prepare and execute the SQL SELECT query to fetch data before update
//     $sql_select = "SELECT tags, comments FROM active_domain WHERE active_id = ?";
//     $stmt_select = $mysqli->prepare($sql_select);
//     $stmt_select->bind_param("i", $active_id);
//     $stmt_select->execute();
//     $stmt_select->bind_result($existing_tags, $existing_comments);

//     if ($stmt_select->fetch()) {
//         // Check if the data has changed
//         if ($existing_tags !== $u_tags || $existing_comments !== $u_comment) {
//             // Data has changed, proceed with the update
//             $stmt_select->close();

//             // Prepare and execute the SQL update query
//             $sql_update = "UPDATE active_domain SET tags = ?, comments = ? WHERE active_id = ?";
//             $stmt_update = $mysqli->prepare($sql_update);
//             $stmt_update->bind_param("ssi", $u_tags, $u_comment, $active_id);

//             if ($stmt_update->execute()) {
//                 // Handle the success response if needed
//                 $response = array('success' => 'Updated Successfully');
//                 echo json_encode($response);
//             } else {
//                 // Handle the error gracefully
//                 $error_message = "Error updating record: " . $stmt_update->error;
//                 $response = array('error' => $error_message);
//                 echo json_encode($response);
//             }
//         } else {
//             // Data has not changed, no need to update
//             $stmt_select->close();
//             $response = array('info' => 'No changes made.');
//             echo json_encode($response);
//         }
//     } else {
//         // No record found with the given active_id
//         $stmt_select->close();
//         $response = array('error' => 'Record not found.');
//         echo json_encode($response);
//     }

//     // Close the database connection
//     $mysqli->close();
// }

// public function api()
// {
//     header('Access-Control-Allow-Origin: *'); // Allow requests from any domain
//     header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
//     header("Access-Control-Allow-Headers: Content-Type, Authorization");

//     // Replace 'YOUR_API_KEY' with your actual API key
//     $apiKey = 'd04a998808ef6d256cfb90991efbc5fd1987b7283bec8c38f5e5efcd2ceb2d2b';

//     // Database connection
//     $mysqli = new mysqli("localhost", "greeocvu_wp580", "Sp0-r!7XP@]6Fr", "greeocvu_wp580");

//     // Check connection
//     if ($mysqli->connect_error) {
//         die("Connection failed: " . $mysqli->connect_error);
//     }

//     $sql = "SELECT url, tags, comments FROM active_domain";
//     $result = $mysqli->query($sql);

//     $data = array();

//     if ($result->num_rows > 0) {
//         while ($row = $result->fetch_assoc()) {
//             // Add each row as an associative array to the $data array
//             $data[] = $row;
//         }
//     }

//     // Close the database connection
//     $mysqli->close();

//     $data = array();

//     foreach ($urls as $url) {
//         $result = $this->scanUrl($url);
        
//         if ($result) {
//             // Encode each result as JSON and add it to the data array
//             $data[] = json_encode($result);
//         }
//     }

//     // Send the response as JSON
//     $this->output->set_content_type('application/json')->set_output('[' . implode(',', $data) . ']');
// }

// // public function api()
// // {
// //     header('Access-Control-Allow-Origin: *'); // Allow requests from any domain
// //     header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
// //     header("Access-Control-Allow-Headers: Content-Type, Authorization");

// //     // Replace 'YOUR_API_KEY' with your actual API key
// //     $apiKey = '2d79fa4d329c17de8973a1e862539c344830a0a96ccc53599848164c11630c86';
// //     $urls = [
// //         'https://drive.trck-securelink.com/',
// //         'https://tremendio.scaletrk.com/' // Add the new URL here
// //     ];

// //     $data = array();

// //     foreach ($urls as $url) {
// //         $result = $this->scanUrl($url);
        
// //         if ($result) {
// //             // Encode each result as JSON and add it to the data array
// //             $data[] = json_encode($result);
// //         }
// //     }

// //     // Send the response as JSON
// //     $this->output->set_content_type('application/json')->set_output('[' . implode(',', $data) . ']');
// // }

// private function scanUrl($url)
// {
//     $hash = hash('sha256', $url);
//     $urlEndpoint = "https://www.virustotal.com/api/v3/urls/{$hash}";

//     $options = array(
//         'http' => array(
//             'header' => "Content-type: application/x-www-form-urlencoded\r\n" .
//                 "x-apikey: {$this->apiKey}\r\n",
//             'method' => 'GET'
//         )
//     );

//     $context  = stream_context_create($options);
//     $response = file_get_contents($urlEndpoint, false, $context);

//     // Check if the response is valid JSON
//     $result = json_decode($response, true);

//     if ($result && isset($result['data']['attributes']['last_analysis_stats'])) {
//         // Extract the desired scan result statistics
//         return array(
//             'url' => $url,
//             'harmless' => $result['data']['attributes']['last_analysis_stats']['harmless'],
//             'malicious' => $result['data']['attributes']['last_analysis_stats']['malicious'],
//             'suspicious' => $result['data']['attributes']['last_analysis_stats']['suspicious'],
//             'undetected' => $result['data']['attributes']['last_analysis_stats']['undetected']
//         );
//     } else {
//         // Handle non-JSON response (e.g., HTML error page)
//         // You can log the response or take appropriate action
//         error_log("Non-JSON response received for URL: $url");
//         return null;
//     }
// }
}









	

