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
		// $user_ip = $this->input->post("user_ip");
		// $IP = $_SERVER['REMOTE_ADDR'];


		// if (empty($username) || empty($password)){
		// 	$this->session->set_flashdata('log_err', 'Please input the required fields!');
		// 	redirect(base_url("login"));
		// }else{
		// 	$params["select"] = "*";
		// 	$params["where"] = array("user_ip" => $user_ip);
		// 	$user_data1 = $this->MY_Model->getRows("crm_ip", $params);
		// }if (empty($user_data1)) {
		// 	$this->session->set_flashdata('log_err', 'Invalid IP. Please contact the administrator.');
		// 	redirect(base_url("login"));

		// }else{
		// 	if ($user_data1[0]['ip_status'] == 1) {
		// 		$this->session->set_flashdata('log_err', 'Your IP is Deactivated. Please contact the administrator.');
		// 		redirect(base_url("login"));
		// 	}else if ($user_data1[0]['ip_status'] == 2) {
		// 		$this->session->set_flashdata('log_err', 'User IP does not exist');
		// 		redirect(base_url("login"));
		// 	}
		// }


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
			} else if ($user_data[0]['user_type'] == 'Admin') {
				$this->session->set_flashdata('log_err', 'User does not exist');
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
					redirect(base_url("advsendotp"));
				}else if($user_data[0]['user_type'] == 'Affiliate'){
					redirect(base_url("affsendotp"));
				} else {
					redirect(base_url("login"));
					
				}
				
			}
			
		}
	}

	public function forgot_password(){
		if(isset($_POST['email'])){
			$pwdb = $this->db->
			select('*')->
			from('click_users')->
			where('email', $_POST['email'])->
			get()->
			result_array();
			if(!empty($pwdb)){
				$id = $pwdb[0]['user_id'];
				$temp = $pwdb['0']['username'][0] . $pwdb['0']['user_type'][0];
				$token = uniqid($temp);
				$this->db->
				set('token', $token)->
				where('user_id', $id)->
				update('click_users');
				$test = md5(rand(1,13));
				$message = "<h2>Please visit the link to change your password:</h2>";
				$message .= "<a href=\"".base_url()."login/change_password?ms=".$id."&te=".$token."\">Change Password</a>";
				$this->sendmail($_POST['email'], 'Tremendio Portal', 'Password Recovery', $message, true);
				$this->session->set_flashdata('check', 'Check your email now to retrieve your password.');
				// $this->session->set_userdata('swal', 'Check your email now to retrieve your password.');
			} else{
				$this->session->set_flashdata('log_err', 'Sorry but there is no account that exists with that email.');
				// $this->session->set_userdata('swal', 'Sorry but there is no account that exists with that email.');
			}
			redirect('login');
		}
	}

	public function change_password(){
		if(isset($_POST['ms'])){
               $ms = $_POST['ms'];
               $te = $_POST['te'];
			$data['u_id'] = $id = $ms;
			$token = $te;
			$verify = $this->db->
			select('*')->
			from('click_users')->
			where('token', $token)->
			get()->result_array();

			if(!empty($verify)){
				if(isset($_POST['password'])){
					$pw1 = $_POST['password'];
					$conpw = $_POST['confirm_password'];

					if($pw1 != $conpw){
						$this->session->set_flashdata('log_err', 'Sorry, but passwords do not match. Please try again.');
						// $this->session->set_userdata('swal', 'Sorry, but passwords do not match. Please try again.');
					}else{
						$pw2 = password_hash($pw1, PASSWORD_DEFAULT);
						$token = md5(rand(1,8));
						$this->db->
						set('password', $pw2)->
						set('password_plain', $pw1)->
						set('token', $token)->
						where('user_id', $id)->
						update('click_users');
						$this->session->set_flashdata('check', 'Password changed successfully.');
						// $this->session->set_userdata('swal', 'Password changed successfully.');
						redirect('login');
					}
				}
			} else{
				$this->session->set_flashdata('log_err', 'Access not allowed.');
				// $this->session->set_userdata('swal', 'Access not allowed.');
				redirect('login');
			}
		}
		$this->load->view('change_pw');
	}
}
?>

