<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data["title"] = "Login Account";
		$this->load_login_page("index", $data);
	}

	public function login_account()
	{
		$this->input->post();
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		if (empty($username) || empty($password)) {
			$this->session->set_flashdata('log_err', 'Please input the required fields!');
			redirect(base_url("login"));
		} else {
			$params["select"] = "*";
			$params["where"] = array("username" => $username);
			$params["join"] = array("click_user_details" => "click_users.user_id = click_user_details.fk_user_id");
			$user_data = $this->MY_Model->getRows("click_users", $params);

			if (empty($user_data)) {
				$this->session->set_flashdata('log_err', 'User does not exist');
				redirect(base_url("login"));
			} else if (!password_verify($password, $user_data[0]['password'])) {
				$this->session->set_flashdata('log_err', 'Incorrect Password');
				redirect(base_url("login"));
			} else {
				if ($user_data[0]['user_status'] == 1) {
					$this->session->set_flashdata('log_err', 'Your Account is Deactivated. Please contact the administrator.');
					redirect(base_url("login"));
				}
				$this->session->set_userdata('user_details', $user_data);
				$this->session->set_userdata('user_id', $user_data);
				// $redirect = ($user_data[0]['user_type'] != 'User') ? base_url('jobseeker') : base_url('jobseeker');
				// $redirect = ($user_data[0]['user_type'] != 'Employee') ? base_url('dashboard') : base_url('dashboard');
				// redirect($redirect);
				if ($user_data[0]['user_type'] == 'Advertiser'){
					redirect(base_url("crmads"));
				}else if($user_data[0]['user_type'] == 'Affiliate'){
					redirect(base_url("crmaff"));
				} else {
					redirect(base_url("dashboard"));
					
				}
				
			}
			
		}
	}


}
