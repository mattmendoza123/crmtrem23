<?php
	error_reporting(0);
	ini_set('display_errors', 0);
defined('BASEPATH') OR exit('No direct script access allowed');


// $GLOBALS['otpcode'] = '1234';
$seed = floor(time()/600);
srand($seed);

$length = 8;
$characters = '1234567890';
$randomString = '';
for ($i = 0; $i < $length; $i++) {
// $randomString .= $characters[rand(0, strlen($characters) - 1)];
// }
$GLOBALS['randomString'] .= $characters[rand(0, strlen($characters) - 1)];
}



class Sendotp extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data["title"] = "Email Verification";
		// $this->load_page3("sendotp", $data);
		$this->load_page3("sendotp", $data, "otp_footer.php", "otp_header.php");
		
	}

	public function otp_verify()
	{
		$this->input->post();
		$seed = floor(time()/600);
		srand($seed);
		$length = 8;
		$characters = '1234567890';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}

		$otp_number = $this->input->post("otp_number");



		if (empty($otp_number)) {
			$this->session->set_flashdata('log_err', 'Please input the required fields!');
			redirect(base_url("sendotp"));
		} else {

			if (empty($otp_number)) {
				$this->session->set_flashdata('log_err', 'Please input the required fields!');
				redirect(base_url("sendotp"));
			} else if ($otp_number != $randomString) {
				$this->session->set_flashdata('log_err', 'OTP does not exist');
				redirect(base_url("sendotp"));
			} else {
				if ($otp_number == $randomString) {
					redirect(base_url("dashboard"));
				} else {
					$this->session->set_flashdata('log_err', 'OTP does not exist');
					redirect(base_url("sendotp"));
					
				}
				
			}
			
		}

		// redirect(base_url("sendotp"));
		// echo "<pre>";
		// print_r($randomString );
		// exit;
	}


	public function otp()
	{

		if ($this->input->post('otp')) {
			$seed = floor(time()/600);
			srand($seed);
			$length = 8;
			$characters = '1234567890';
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
			}
	
			$email = $this->input->post('email');

			$params["select"] = "*";
			$params["where"] = array("email" => $email);
			$fg_data = $this->MY_Model->getRows("crm_email", $params);
			
			// echo $randomString;
			// print_r($fg_data);
			// exit();

			// echo "<pre>";
			// print_r($GLOBALS['randomString']);
			// exit;
			if(empty($fg_data)){
				$this->session->set_flashdata('log_err', 'Invalid Email !');
				redirect(base_url("sendotp"));
			}else{
				$user_email = $fg_data[0]['email'];
				if ((!strcmp($email, $user_email))) {
					// $pass = $fg_data[0]['password_plain'];
	
					// $to = $user_email;
					// $subject = "OTP";
					// $txt = "Your OTP code is 1234 .";
					// $headers = "From: adminclickadv@tremendio.com" . "\r\n" .
					// "CC: adminclickadv@gmail.com";
					// mail($to, $subject, $txt, $headers);
					$message = "<p>Hi $email,</p>";
					$message .= "<p>Please use this One Time Password (OTP) to access  CRM Tremendio Admin Portal.</p>";
					$message .= "<h3>$randomString</h3>";
					$message .= "<p>The code expire after 10 minutes. Do not share this OTP to anyone.</p>";
					$message .= "<p>Thank you!</p>";
					$this->sendmail($user_email, 'Tremendio Portal', 'Tremendio Portal OTP', $message);
					$this->session->set_flashdata('check', 'Please check your email.');
					
	
				} else {
	
					$data['error'] = "Invalid Email ID !";
				}
				redirect(base_url("sendotp"));
			}
		}
		$this->load_sendemail_page("sendotp", $data);

	}


	// public function otp()
	// {
	// 	$email = $this->input->post('email');

	// 	$otpcode = "123";
	// 	$uemail = $this->db->
    //      select('email')->
    //     //  where('email_id', '1')->
    //      from('crm_email')->
    //      get()->result();
   
    //      $message = "<h1>Hi TEST</h1>";
    //      $message .= "<h3>I'm Matt</h3>";
    //      $message .= "<h3>$otpcode</h3>";
    //      $this->sendmail($uemail[0]->email, null, 'Tremendio Portal OTP', $message);
    //     //  $this->send_notification('1', 'Notification: DDD Forms', 'Proceed to Step 4 DDD Form now. ', 5);
	// 	$this->session->set_flashdata('check', 'Please check your email.');
    //   $url = 'sendotp';
    //   echo'
    //   <script>
    //   window.location.href = "'.base_url().$url.'";
    //   </script>
    //   ';
	// }




}
