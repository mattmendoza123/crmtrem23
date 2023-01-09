<?php
	error_reporting(0);
	ini_set('display_errors', 0);
defined('BASEPATH') or exit('No direct script access allowed');

class Userlist extends MY_Controller
{

	public function index()
	{
		$data["title"] = "Manage Users | Prompt Healthcare, Inc.";
		$data["pagename"] = "Manage Users";
		$this->load_page2("userlist", $data, "user_footer.php", "user_header.php");
	}
	public function adduser(){
		$post = $this->input->post();
		$params["select"] = "*";
        $params["where"] = array("username" => $post["username"]);
        $user_data = $this->MY_Model->getRows("phealth_users", $params, 'row');

        $params2["select"] = "*";
        $params2["where"] = array("email" => $post["email"]);
        $user_data2 = $this->MY_Model->getRows("phealth_users", $params2, 'row');
        
        if ($post["username"] == $user_data->username) {
            $this->session->set_flashdata('log_err', 'Username already exist!');
            redirect(base_url("userlist"));
        } else if ($post["email"] == $user_data2->email) {
            $this->session->set_flashdata('log_err', 'Email already exist!');
            redirect(base_url("userlist"));
        } else {
			$user_data = array(
				'username' => $post["username"],
				'password' => password_hash($post['password'], PASSWORD_DEFAULT),
				'password_plain' => $post['password'],
				'email' => $post["email"],
				'date_added' => date("Y-m-d"),
				'user_type' => "User",
				'user_status' => 0
			);
			$insert_user = $this->MY_Model->insert('phealth_users', $user_data);
			if ($insert_user) {
				$user_data = array(
					'fk_user_id' => $insert_user,
					'first_name' => $post["first_name"],
					'last_name' => $post["last_name"],
					'phone_number' => $post["phone_number"],
					'city' => $post["city"],
					'state' => $post["state"],
					'country' => $post["country"],
					'zip_code' => $post["zip_code"],
				);
				$this->MY_Model->insert('phealth_user_details', $user_data);
				$this->session->set_userdata('swal', 'Added successfully.');
				redirect(base_url("userlist"));
			}
		}
	}

	
    public function get_userlist()
	{
		
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		$search = $search['value'];

		$col = 0;
		$dir = "";
		if (!empty($order)) {
			foreach ($order as $o) {
				$col = $o['column'];
				$dir = $o['dir'];
			}
		}

		if ($dir != "asc" && $dir != "desc") {
			$dir = "desc";
		}

		$valid_columns = array(
			1 => 'first_name',
			2 => 'last_name',
            3 => 'username',
            4 => 'email',
            5 => 'phone_number',
            6 => 'city',
            7 => 'state',
            8 => 'country',
            9 => 'zip_code',
		);

		if (!isset($valid_columns[$col])) {
			$order = null;
		} else {
			$order = $valid_columns[$col];
		}
		if ($order != null) {
			$this->db->order_by($order, $dir);
		}

		$x = 0;
		if (!empty($search)) {
			$this->db->group_start();
			foreach ($valid_columns as $sterm) {
				if ($x == 0) {
					$this->db->like($sterm, $search);
				} else {
					$this->db->or_like($sterm, $search);
				}
				$x++;
			}
			$this->db->group_end();
		}

        $userlist= $this->db
        ->select('*')
		->from('phealth_users') 
		->join('phealth_user_details', 'phealth_user_details.fk_user_id= phealth_users.user_id')
		->where('user_type', 'User')
        ->get();
		

		$data = array();

		foreach ($userlist->result() as $tm) {
			$action_btn = "";
            $action_btn .= "<a class='btn btn-xs edit-users' user-id=".$tm->user_details_id." data-toggle='tooltip' data-placement='bottom' title='Update'  data-toggle='modal' data-target='#UpdateUsers' href=''><i class='fa fa-edit'></i></a>";
			// $action_btn .= "<a class='btn btn-xs delete-users' user-id=".$tm->user_details_id." data-toggle='tooltip' data-placement='bottom' title='Delete' href=".base_url('userlist/delete_users/'.$tm->user_id)."><i class='fa fa-trash'></i></a>";
			// if ($tm->user_status == 0) {
			// 	$tm->user_status = "<span class='badge badge-pill badge-success'>Activated</span>";
			// } else {
			// 	$tm->user_status = "<span class='badge badge-pill badge-danger'>Deactivated</span>";
			// }
			if ($tm->user_status == 0) {
				$tm->user_status = "<span class='badge badge-pill badge-success'>Activated</span>";
				$action_btn .= "<a class='btn btn-xs delete-users' data-toggle='tooltip' data-placement='bottom' title='Deactivate User' href=" . base_url('userlist/deactivate_user/' .$tm->user_id) . "><i class='fa fa-lock'></i></a>";
			}else{
				$tm->user_status = "<span class='badge badge-pill badge-danger'>Deactivated</span>";
				$action_btn .= "<a class='btn btn-xs delete-users' data-toggle='tooltip' data-placement='bottom' title='Activate User' href=" . base_url('userlist/activate_user/' .$tm->user_id) . "><i class='fa fa-unlock'></i></a>";
			}

			$data[] = array(
                $tm->user_details_id,
				$tm->first_name,
				$tm->last_name,
                $tm->username,
				$tm->email,
				$tm->city,
                $tm->state,
                $tm->country,
                $tm->zip_code,
				$tm->user_status,
				$action_btn
			);
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $userlist->num_rows(),
			"recordsFiltered" => $userlist->num_rows(),
			"data" => $data
		);
		echo json_encode($output);
		exit();
	}

    public function get_users($id = '')
	{
		$result = $this->db
		->select('*')
        ->from('phealth_users')
        ->join('phealth_user_details', 'phealth_user_details.fk_user_id= phealth_users.user_id')
		->where('user_details_id', $id)
		->get()
		->result_array();
		echo json_encode($result);
		exit();
	}

    public function updateusers()
	{
		$post = $this->input->post();
			if($post){
				$set = array(
                    
					"first_name" => $post["first_name"],
					"last_name" => $post["last_name"],
					"phone_number" => $post["phone_number"],
					"city" => $post["city"],
					"state" => $post["state"],
					"country" => $post["country"],
					"zip_code" => $post["zip_code"],
					
				);
				$where = array("fk_user_id" => $post["fk_user_id"]);
				$update = $this->MY_Model->update("phealth_user_details", $set, $where);
				if($update) {
					$set = array(
						'username' => $post["username"],
						'password_plain' => $post["password_plain"],
						'email' => $post["email"],
						'password' => password_hash($post['password'], PASSWORD_DEFAULT),
					);
					$where = array("user_id" => $post["user_id"]);
					$update = $this->MY_Model->update("phealth_users", $set, $where);
					$this->session->set_userdata('swal', 'Updated Successfully.');
				}
			}
		
		redirect(base_url("userlist/userlist"));
	}

	function deactivate_user($user_id=''){
		$set = array("user_status" => 1);
		$where = array("user_id" => $id="$user_id");
		$res = $this->MY_Model->update("phealth_users", $set, $where);
		$this->session->set_userdata('swal','User deactivated successfully.');
		redirect(base_url("userlist/userlist"));
	}

	function activate_user($user_id='')
	{
		$set = array("user_status" => 0);
		$where = array("user_id" => $id="$user_id");
		$res = $this->MY_Model->update("phealth_users", $set, $where);
		$this->session->set_userdata('swal','User activated successfully.');
		redirect(base_url("userlist/userlist"));
	}
	 
}