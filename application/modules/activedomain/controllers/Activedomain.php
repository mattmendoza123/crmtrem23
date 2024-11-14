<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Activedomain extends MY_Controller
{
    private $apiKey;
    private $errmsg = "";

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();

    }

    public function index()
    {
        $data["title"] = "Active Domain | Tremendio Portal";
        $data["pagename"] = "Active Domain";

        $this->load_page2("activedomain", $data, "activedomain_footer.php", "activedomain_header.php");
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

public function update_modal()
{
    $post = $this->input->post();

    $set = array(
        'url' => $post["u_url"],
        'tags' => implode(';', $post["u_tags"]), // Convert the array to a comma-separated string
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

}