<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Adminoverdueinvoice extends MY_Controller
{
	private $errmsg = "";
    private $client_id;
    private $client_secret;
    private $redirect_uri;
    private $authorization_endpoint;
    private $token_endpoint;
    private $scopes;
    private $state;
    private $xero_tenant_id;
    private $token_encryption_key;
    private $xero_token_cache;
    private $encrypt_method;
    private $secret_key;
    private $secret_iv;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
        // Initialize your OAuth 2.0 credentials here
        $this->client_id = 'BC643010220E48B18C53F1E354429CD3';
        $this->client_secret = '2Ae237axhrfi_wnltUEMsmqzfEXhpC9wwaicwGb9uqQ3ypdj';
        $this->redirect_uri = 'https://crm.tremendio.network/adminoverdueinvoice';
        $this->authorization_endpoint = 'https://login.xero.com/identity/connect/authorize';
        $this->token_endpoint = 'https://identity.xero.com/connect/token';
        $this->xero_tenant_id = '1fc215e9-9c6c-46f6-a64e-4a2956d61ef7';
        $this->scopes = 'offline_access openid profile email accounting.transactions';
        $this->state = '123';
		
		// token related variables:
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
        $this->xero_token_cache = $application_folder."/cache/xero_token";
		$this->encrypt_method = "AES-256-CBC";
		$this->secret_key = 'b81c3536aeba40bc2e5cb8334141163a';
		$this->secret_iv = '16586c4284cc2666d72ec378e546db06';
	}

	public function index()
	{
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
		
		$xero_token_data = $this->getXeroTokenData();
		$xero_access_token = (!is_null($xero_token_data['xero_access_token']))?$xero_token_data['xero_access_token']:null;
		$xero_access_token_expiry = (!is_null($xero_token_data['xero_access_token_expiry']))?$xero_token_data['xero_access_token_expiry']:null;
		$xero_refresh_token = (!is_null($xero_token_data['xero_refresh_token']))?$xero_token_data['xero_refresh_token']:null;
		$xero_refresh_token_expiry = (!is_null($xero_token_data['xero_refresh_token_expiry']))?$xero_token_data['xero_refresh_token_expiry']:null;
		log_message("ERROR","index xero_access_token: ".$xero_access_token);
		log_message("ERROR","index xero_access_token_expiry: ".$xero_access_token_expiry);
		log_message("ERROR","index xero_refresh_token: ".$xero_refresh_token);
		log_message("ERROR","index xero_refresh_token_expiry: ".$xero_refresh_token_expiry);
        
		// if code is passed
		$authorization_code = isset($_GET['code'])?$_GET['code']:null;
		log_message("ERROR","Index: code passed: ".$authorization_code);	
		log_message("ERROR","xero_token_cache: ".$this->xero_token_cache);	
		
		if ( is_null($xero_access_token)){
			log_message("ERROR","No saved xero_access_token in session");
			// no xero_access_token yet
			if ( !is_null($authorization_code)){
				log_message("ERROR","code has been passed. calling processXeroCodeAuthorization");
				$this->processXeroCodeAuthorization($authorization_code);
			} else {
				log_message("ERROR","No code has been passed. calling redirectToXeroAuthorization");
				$this->redirectToXeroAuthorization();
			}
		} else {
			// xero_access_token is already stored in session most likely from a previous login 
			log_message("ERROR","xero_access_token is saved in session");
			if ( $xero_refresh_token_expiry > time()){
				// xero_refresh_token hasnt expired yet
				log_message("ERROR","code appended and access token expired. calling processXeroCodeAuthorization");
				log_message("ERROR","xero refresh token hasnt expired yet");
				if ( $xero_access_token_expiry <= time()){
					// xero_access_token has expired, refresh the token
					log_message("ERROR","xero access_token has expired. calling refreshAccessToken");
					$this->refreshAccessToken($xero_refresh_token);
				}
			} else {
				// xero_refresh_token has expired, try to process the code
				log_message("ERROR","xero refresh_token has expired. calling redirectToXeroAuthorization");
				$this->redirectToXeroAuthorization();
			}
		}
		log_message("ERROR","proceeding to getOverDueInvoices");
		$this->getOverDueInvoices();
	}
	
    private function processXeroCodeAuthorization($p_code)
    {
        // Xero OAuth 2.0 Credentials
        $client_id = $this->client_id;
        $client_secret = $this->client_secret;
        $redirect_uri = $this->redirect_uri;
        $token_endpoint = $this->token_endpoint;
		
		log_message("ERROR","processXeroCodeAuthorization: parsed code: ".$p_code);

        // Step 1: Exchange the authorization code for an access token
        $token_request = array(
            'grant_type' => 'authorization_code',
            'code' => $p_code,
            'redirect_uri' => $redirect_uri,
        );

        $curl = curl_init($token_endpoint);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($token_request));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic ' . base64_encode($client_id . ':' . $client_secret),
			'Content-Type: application/x-www-form-urlencoded',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $token_response = curl_exec($curl);
		log_message("ERROR","processXeroCodeAuthorization: [".$this->token_endpoint."] token_response: ".$token_response);
        curl_close($curl);

        // Step 2: Handle the access token and make API requests with it
        $token_data = json_decode($token_response, true);
		log_message("ERROR","processXeroCodeAuthorization: token_data: ");
		log_message("ERROR",print_r($token_data,TRUE));

        if (isset($token_data['access_token'])) {
			// grab the access_token and request_token from the token endpoint return
            $access_token = $token_data['access_token'];
			// calculate the access_token_expiry by adding the current epoch time in seconds and the 
			// expires_in value which is the number of seconds that the token is active
			$access_token_expiry = (integer) $token_data['expires_in'] + time();
			$refresh_token = $token_data['refresh_token'];
			$refresh_token_expiry = time() + (60*24*60*60); // token expires in 60 days. add number of seconds in 60 days

			$this->storeXeroTokenCache($access_token,$access_token_expiry,$refresh_token,$refresh_token_expiry);
		}
		return;
    }
	
    private function refreshAccessToken($p_refresh_token)
    {
        // Xero OAuth 2.0 Credentials
        $client_id = $this->client_id;
        $client_secret = $this->client_secret;
        $token_endpoint = $this->token_endpoint;

        // Step 1: Refresh the access_token with a new one given the refresh_token
        $token_request = array(
            'grant_type' => 'refresh_token',
            'refresh_token' => $p_refresh_token,
        );

        $curl = curl_init($token_endpoint);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($token_request));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic ' . base64_encode($client_id . ':' . $client_secret),
			'Content-Type: application/x-www-form-urlencoded',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $token_response = curl_exec($curl);
		log_message("ERROR","refreshAccessToken: [".$this->token_endpoint."] token_response: ".$token_response);
        curl_close($curl);

        // Step 2: Handle the access token and make API requests with it
        $token_data = json_decode($token_response, true);
		log_message("ERROR","refreshAccessToken: token_data: ");
		log_message("ERROR",print_r($token_data,TRUE));

        if (isset($token_data['access_token'])) {
			// grab the access_token and request_token from the token endpoint return
            $access_token = $token_data['access_token'];
			// calculate the access_token_expiry by adding the current epoch time in seconds and the 
			// expires_in value which is the number of seconds that the token is active
			$access_token_expiry = (integer) $token_data['expires_in'] + time();
			$refresh_token = $token_data['refresh_token'];
			$refresh_token_expiry = time() + (60*24*60*60); // token expires in 60 days. add number of seconds in 60 days

			$this->storeXeroTokenCache($access_token,$access_token_expiry,$refresh_token,$refresh_token_expiry);
		} else {
			$this->redirectToXeroAuthorization();
		}
		return;
    }
	
	private function getOverDueInvoices(){
		
		$xero_token_data = $this->getXeroTokenData();
		if ( is_null($xero_token_data['xero_access_token'] )){
			$this->redirectToXeroAuthorization();
		}
		$xero_access_token = $xero_token_data['xero_access_token'];
        $xero_tenant_id = $this->xero_tenant_id; // Get the Xero tenant ID
		
		$api_url = 'https://api.xero.com/api.xro/2.0/Invoices';
		$api_url .= '?';
		$api_url .= 'where=Status%3d%3d%22AUTHORISED%22'; 
		// STATUS=AUTHORISED means the invoices have been authorised but havent transitioned to PAID
		log_message("ERROR","calling api uri: ".$api_url);

		$headers = array(
			'Authorization: Bearer ' . $xero_access_token,
			'Content-Type: application/json',
			'Accept: application/json',
			'xero-tenant-id: ' . $xero_tenant_id,
		);

		$ch = curl_init($api_url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch);
		log_message("ERROR","getOverDueInvoices: response: ");
		log_message("ERROR",print_r($response,TRUE));

		curl_close($ch);

		// instantiate the overdue_invoices array. we will add overdue invoices later
		$overdue_invoices = array();
		$response = json_decode($response, true);
		// if the xero api response is successful
		if ( $response['Status'] == "OK" ){
			$authorised_invoices = $response['Invoices'];
			// Process and use the $response data as needed
			foreach ( $authorised_invoices as $authorised_invoice ){
				// DueDate string has the format "\/Date(1678060800000+0000)\/" where the first 10 digits is the epoch time.
				// we have to extract these first 10 digits so we use regex
				$due_date_string = $authorised_invoice['DueDate'];
				$due_date_u_regex = '/\((\d{10})\d{3}/';
				if(preg_match_all($due_date_u_regex, $due_date_string, $matches)){
					// log_message("ERROR",print_r($matches,TRUE));
					
					// the parsed epoch time should be assigned to $matches[1][0] by preg_match_all
					// we convert this value to integer because we will compare it to the current epoch time which is integer
					$due_date_u = (integer) $matches[1][0];
					
					// if the extracted duedate timestamp is less than the current timestamp, the consider it overdue
					if ( $due_date_u < time()){
						// we have to prepare and object with just the necessary data to return
						$data = new stdClass();
						$data->InvoiceNumber = $authorised_invoice['InvoiceNumber'];
						$data->AmountDue = $authorised_invoice['AmountDue'];
						$data->Total = $authorised_invoice['Total'];
						// $data->ContactID = $authorised_invoice['Contact']['ContactID'];
						$data->Reference = $authorised_invoice['Reference'];
						$data->Name = $authorised_invoice['Contact']['Name'];
						// $data->DueDate = $authorised_invoice['DueDate'];
						// $data->DueDateString = $authorised_invoice['DueDateString'];
						$dt = new DateTime("@$due_date_u");
						$data->DueDatePretty = $dt->format('Y-m-d');
						// push this object to the overdue_invoices array
						$overdue_invoices[] = $data;
						// unset the data to conserve memory
						unset($data);
					}
				}
			}
		}
		$data["title"] = "Overdue Invoices | Tremendio Portal";
		$data["pagename"] = "Overdue Invoices";
		// we will return the overdue_invoices object as a json string to the overdueinvoice view because we will assign it to a javascript variable
		// to make it consumable by datatables jquery
		// overdueinvoice_footer has the jquery code to convert that json into a javascript object to push into the datatable
		$data['overdue_invoice_list_json'] = json_encode($overdue_invoices);
		$this->load_page2("adminoverdueinvoice", $data, "adminoverdueinvoice_footer.php", "adminoverdueinvoice_header.php");
	}

    private function redirectToXeroAuthorization()
    {
        // Step 4: Redirect the user to Xero's authorization page with scopes and state
        // Use class-level properties, not local variables
        $client_id = $this->client_id;
        $redirect_uri = $this->redirect_uri;
        $authorization_endpoint = $this->authorization_endpoint;
        $scopes = $this->scopes;
        $state = $this->state;
		
        $authorize_url = $this->authorization_endpoint . '?response_type=code&client_id=' . $client_id . '&redirect_uri=' . $redirect_uri . '&response_type=code&scope=' . $scopes . '&state=' . $state;
		
        header('Location: ' . $authorize_url);
        exit;
    }
	
	private function getXeroTokenData(){
		// initialize token data as null to return
		$cache_data = array(
			'xero_access_token' => NULL,
			'xero_access_token_expiry' => NULL,
			'xero_refresh_token' => NULL,
			'xero_refresh_token_expiry' => NULL
		);
		if ( file_exists($this->xero_token_cache) ){
			// cache file exists
			$input = file_get_contents($this->xero_token_cache);
			if ( $input ) {
				// reading and decrypting cache file
				$key = hash('sha256', $this->secret_key);
				// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
				$iv = substr(hash('sha256', $this->secret_iv), 0, 16);
				$output = openssl_decrypt(base64_decode($input), $this->encrypt_method, $key, 0, $iv);
				// decrypted cache file is column-delimited data
				$key_list = explode(":",$output);
				$cache_data['xero_access_token'] = $key_list[0];
				$cache_data['xero_access_token_expiry'] = $key_list[1];
				$cache_data['xero_refresh_token'] = $key_list[2];
				$cache_data['xero_refresh_token_expiry'] = $key_list[3];
			}
		}
		return $cache_data;
	}
	
	private function storeXeroTokenCache($p_access_token, $p_access_token_expiry, $p_refresh_token, $p_refresh_token_expiry){
		
		// prepare a string of column-delimited data given the parameters:
		$master_string = $p_access_token.":".$p_access_token_expiry.":".$p_refresh_token.":".$p_refresh_token_expiry;
		
		// encrypt the string:
		$key = hash('sha256', $this->secret_key);
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $this->secret_iv), 0, 16);
		$output = openssl_encrypt($master_string, $this->encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);
		
		// check if directory exists, if not, create it
        $dirname = dirname($this->xero_token_cache);
        if (file_exists($this->xero_token_cache)){
            unlink(realpath($this->xero_token_cache));
        }
        if (!is_dir($dirname))
        {
            mkdir($dirname, 0755, true);
        }
		
		// write encrypted string to file:
        $temp_file_stream = fopen($this->xero_token_cache, 'w');
        fwrite($temp_file_stream, $output);
        fclose($temp_file_stream);
		return;
	}
}


