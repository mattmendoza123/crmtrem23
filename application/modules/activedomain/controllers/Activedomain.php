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
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");

        $mysqli = new mysqli("localhost", "root", "password", "greeocvu_wp580");

        if ($mysqli->connect_error) {
            $response = ['success' => false, 'message' => 'Connection failed: ' . $mysqli->connect_error];
        } else {
            $url = 'https://tremendio.scaletrk.com/api/v2/network/offers/1147/tracking-settings?api-key=aafcf12b64ca3230279a89aa8b6eacf03c7c59da';
            $data = file_get_contents($url);
            $responseData = json_decode($data, true);

            if (isset($responseData['info']['details']['tracking_domains']) && is_array($responseData['info']['details']['tracking_domains'])) {
                $processedUrls = [];

                foreach ($responseData['info']['details']['tracking_domains'] as $trackingDomain) {
                    $url = $trackingDomain['name'];

                    if (!in_array($url, $processedUrls)) {
                        $url .= '/';
                        $stmt = $mysqli->prepare("INSERT INTO active_domain (url, tags, comments) VALUES (?, 'N/A', 'N/A')");
                        $stmt->bind_param('s', $url);

                        if ($stmt->execute()) {
                            $success = true;
                            $processedUrls[] = $url;
                        } else {
                            $success = false;
                            $errorMessage = $stmt->error;
                        }
                    }
                }

                $mysqli->close();
                $response = ['success' => true];
            } else {
                $response = ['success' => false, 'message' => "No tracking domains found in the API response."];
            }
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function update_modal()
    {
        $post = $this->input->post();

        $set = array(
            'url' => $post["u_url"],
            'tags' => implode(';', $post["u_tags"]),
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