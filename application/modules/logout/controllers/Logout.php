<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends MY_Controller {

	public function index(){
		session_destroy();
		redirect(base_url('login'));
	}
}
