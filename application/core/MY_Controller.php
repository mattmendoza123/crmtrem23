<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller {

	public function __construct(){
		$route = $this->router->fetch_class();
		$this->load->model('MY_Model', 'model');
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		if($route == 'login'){
			if($this->session->has_userdata('user_id')){
				redirect(base_url(""));
			}
		} else {
			if(!$this->session->has_userdata('user_id') && $route != 'register' && $route != 'whatsmyip' && $route != 'adminlogin'){
				redirect(base_url('login'));
			}
		}
	}

	public function load_page($page, $data = array(), $footer){
		$this->load->view('includes/head',$data);
		$this->load->view('includes/sidebar',$data);
		$this->load->view($page,$data);
		$this->load->view('includes/footer',$data);
	}

	public function load_user_page($page, $data = array(), $footer){
		$this->load->view('includes/head',$data);
		$this->load->view('includes/admin/header',$data);
		$this->load->view('includes/user/sidebar',$data);
		$this->load->view($page,$data);
		$this->load->view($footer,$data);
	}

	public function load_login_page($page, $data = array()){
		$this->load->view('includes/login_head',$data);
		$this->load->view($page,$data);
		$this->load->view('includes/login_footer',$data);
    }
	
	public function load_adminlogin_page($page, $data = array()){
		$this->load->view('includes/login_head',$data);
		$this->load->view($page,$data);
		$this->load->view('includes/login_footer',$data);
    }

	public function load_register_page($page, $data = array()){
		$this->load->view('includes/login_head',$data);
		$this->load->view($page,$data);
		$this->load->view('includes/login_footer',$data);
    }

	public function load_page2($page, $data = array(), $add_to_footer="",$add_to_header=""){
		if (!empty($add_to_footer)) {
			$data["add_to_footer"]=$add_to_footer;
		}
		if (!empty($add_to_header)) {
			$data["add_to_header"]=$add_to_header;
		}
		$this->load->view('includes/head',$data);
		$this->load->view('includes/sidebar',$data);
		$this->load->view($page);
		$this->load->view('includes/footer');
	}
	public function load_page3($page, $data = array(), $add_to_footer="",$add_to_header=""){
		if (!empty($add_to_footer)) {
			$data["add_to_footer"]=$add_to_footer;
		}
		if (!empty($add_to_header)) {
			$data["add_to_header"]=$add_to_header;
		}
		$this->load->view('includes/login_head',$data);
		// $this->load->view('includes/sidebar',$data);
		$this->load->view($page);
		$this->load->view('includes/login_footer',$data);
	}

	public function load_other_page($page, $data = array()){
		$this->load->view('includes/login_head',$data);
		$this->load->view($page,$data);
		$this->load->view('includes/login_footer',$data);
    }

	public function setSwal($icon='warning',$msg=''){
		$load = array('icon' => $icon, 'content' => $msg);
		$this->session->set_flashdata('swals', $load);
	}

	//send email
	public function sendmail($to_email='office@tremendio.com',$from_name='Tremendio Portal',$subject='Email Notification',$message='Sample Message Here',$use_html_template = true){
		$this->load->library('email');

		$config['protocol']    = 'smtp';
		$config['smtp_host']    = 'smtp.gmail.com';
		$config['smtp_port']    = '587';
		$config['smtp_user']    = 'devteam@tremendio.com';
		$config['_smtp_auth'] = TRUE;
		$config['smtp_pass']    = 'tbavmuumrplplbvp';
		$config['smtp_crypto'] = 'tls';
		$config['mailtype'] = 'html'; // or html
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['newline'] = "\r\n";

		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		

		$this->email->from('office@tremendio.com', $from_name);
		$this->email->to($to_email);
		$this->email->subject($subject);

		if ($use_html_template) {
			$messageData['title'] = $subject;
			$messageData['content'] = $message;
			$message = $this->load->view('mail_template',$messageData,true);
			$this->email->message($message);
		}else{
			$this->email->message($message);
		}

		// $this->email->send();

		if ($this->email->send()) {
			return true;

		} else {
			echo $this->email->print_debugger();

			return false;
		}
	}

}
