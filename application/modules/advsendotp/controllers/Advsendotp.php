<?php
	error_reporting(0);
	ini_set('display_errors', 0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Advsendotp extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data["title"] = "Email Verification";
		$this->load_page3("advsendotp", $data, "otp_footer.php", "otp_header.php");
		
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
			redirect(base_url("advsendotp"));
		} else {

			if (empty($otp_number)) {
				$this->session->set_flashdata('log_err', 'Please input the required fields!');
				redirect(base_url("advsendotp"));
			} else if ($otp_number != $randomString) {
				$this->session->set_flashdata('log_err', 'OTP does not exist');
				redirect(base_url("advsendotp"));
			} else {
				if ($otp_number == $randomString) {
					redirect(base_url("crmads"));
				} else {
					$this->session->set_flashdata('log_err', 'OTP does not exist');
					redirect(base_url("advsendotp"));
					
				}
				
			}
		}
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
			$fg_data = $this->MY_Model->getRows("click_users", $params);
			
			if(empty($fg_data)){
				$this->session->set_flashdata('log_err', 'Invalid Email !');
				redirect(base_url("advsendotp"));
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
					$this->sendmail($user_email,'Tremendio Portal', 'Tremendio Portal OTP', $message);
					$this->session->set_flashdata('check', 'Please check your email.');
					
	
				} else {
	
					$data['error'] = "Invalid Email ID !";
				}
				redirect(base_url("advsendotp"));
			}
		}
		$this->load_sendemail_page("advsendotp", $data);

	}


}
?>
