<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ipwhitelist extends MY_Controller
{

	private $errmsg = "";

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
	
		$data["title"] = "IP Whitelist | Click ADV";
		$data["pagename"] = "IP Whitelist";

		$this->load_page2("ipwhitelist", $data, "ipwhitelist_footer.php", "ipwhitelist_header.php");
	}
	

	public function addip(){
		$post = $this->input->post();

			$user_data = array(
			'name' => $post["name"],
			'user_ip' => $post["user_ip"],
			'comment' => $post["comment"],
			'ip_status' => 0,
			'date_created' => date("Y-m-d"),
			);
			$this->MY_Model->insert('crm_ip', $user_data);
			$this->session->set_userdata('swal', 'Added successfully.');
			redirect(base_url("ipwhitelist"));
	}



	public function get_iplist()
	{
		
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		// $search = $search['value'];

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
			1 => 'name',
			2 => 'user_ip',
			3 => 'comment',
			4 => 'ip_status',
			5 => 'date_created',
			6 => 'actions'

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

        $ipwhitelist= $this->db
        ->select('*')
		->from('crm_ip') 
		->where('ip_status !=', '2')
		// ->join('crm_user_details', 'crm_user_details.fk_user_id= crm_users.crm_id')
		// ->where('user_type', 'User')
        ->get();
		

		$data = array();

		foreach ($ipwhitelist->result() as $tm) {
			$action_btn = "";
			// $action_btn = "<button type='button' class='btn btn-xs edit-users' data-toggle='tooltip' data-toggle='modal' data-target='#UpdateUsers'><i class='fa fa-edit'></i></button>"
            $action_btn .= "<a class='btn btn-xs edit-ip' crm-ip=".$tm->crm_ip_id." data-toggle='tooltip' data-placement='bottom' title='Update'  data-toggle='modal' data-target='#UpdateIP' href=''><i class='fa fa-edit'></i></a>&nbsp;";
			// $action_btn .= "<a class='btn btn-xs view-ip' crm-id=".$tm->crm_ip_id." data-toggle='tooltip' data-placement='bottom' title='View'  data-toggle='modal' data-target='#ViewUsers' href=''><i class='fa fa-eye'></i></a> &nbsp;";
			// $action_btn .= "<a class='btn btn-xs delete-crm' crm-id=".$tm->crm_details_id." data-toggle='tooltip' data-placement='bottom' title='Delete'  data-toggle='modal' data-target='#DeleteUsers' href=''><i class='fa fa-trash'></i></a>";
			// $action_btn .= "<a class='btn btn-xs delete-ip' crm-ip=".$tm->crm_ip_id." data-toggle='tooltip' data-placement='bottom' title='Delete' href=".base_url('ipwhitelist/delete_ip/'.$tm->crm_ip_id.)."><i class='fa fa-trash'></i></a>";
			//// $action_btn .= "<a class='btn btn-xs delete-ip' href='".base_url('ipwhitelist/delete_ip/'.$tm->crm_ip_id)."'><i class='fa fa-trash'></i></a>";
			// if ($tm->user_status == 0) {
			// 	$tm->user_status = "<span class='badge badge-pill badge-success'>Activated</span>";
			// } else {
			// 	$tm->user_status = "<span class='badge badge-pill badge-danger'>Deactivated</span>";
			// }
			// if ($tm->user_status == 0) {
			// 	$tm->user_status = "<span class='badge badge-pill badge-success'>Activated</span>";
			// 	$action_btn .= "<a class='btn btn-xs delete-users' data-toggle='tooltip' data-placement='bottom' title='Deactivate User' href=" . base_url('userlist/deactivate_user/' .$tm->user_id) . "><i class='fa fa-lock'></i></a>";
			// }else{
			// 	$tm->user_status = "<span class='badge badge-pill badge-danger'>Deactivated</span>";
			// 	$action_btn .= "<a class='btn btn-xs delete-users' data-toggle='tooltip' data-placement='bottom' title='Activate User' href=" . base_url('userlist/activate_user/' .$tm->user_id) . "><i class='fa fa-unlock'></i></a>";
			// }

			if ($tm->ip_status == 1) {
				$tm->ip_status = "<span class='badge badge-pill badge-danger'>Deactivate</span>";
				$action_btn .= "<a class='btn btn-xs delete-users' data-toggle='tooltip' data-placement='bottom' title='Activate IP' href=" . base_url('ipwhitelist/activate_ip/' .$tm->crm_ip_id) . "><i class='fa fa-lock'></i></a>&nbsp;";
                $ip_status = "Inactive";
               }else if($tm->ip_status == 0){
				$tm->ip_status = "<span class='badge badge-pill badge-success'>Activate</span>";
				$action_btn .= "<a class='btn btn-xs delete-users' data-toggle='tooltip' data-placement='bottom' title='Deactivate IP' href=" . base_url('ipwhitelist/deactivate_ip/' .$tm->crm_ip_id) . "><i class='fa fa-unlock'></i></a>&nbsp;";
                $ip_status = "Active";
               }else{

			}
			$action_btn .= "<a class='btn btn-xs delete-ip' data-toggle='tooltip' data-placement='bottom' title='Remove IP' href=" . base_url('ipwhitelist/remove_ip/' .$tm->crm_ip_id) . "><i class='fa fa-trash'></i></a>";

			$data[] = array(
                // $tm->crm_details_id,
				$tm->name,
				$tm->user_ip,
				$tm->comment,
				$tm->ip_status,
				$tm->date_created,
				$action_btn
			);
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $ipwhitelist->num_rows(),
			"recordsFiltered" => $ipwhitelist->num_rows(),
			"data" => $data
		);
		echo json_encode($output);
		exit();
	}

	public function get_ip($id = '')
	{
		$result = $this->db
		->select('*')
        ->from('crm_ip')
		->where('crm_ip_id', $id)
		->get()
		->result_array();
		echo json_encode($result);
		exit();
	}

	public function updateip()
	{
		$post = $this->input->post();

			$set = array(
			'name' => $post["u_name"],
			'user_ip' => $post['u_user_ip'],
			'comment' => $post["u_comment"],
			'date_created' => date("Y-m-d"),
			);
			$where = array("crm_ip_id" => $post["crm_ip_id"]);
			$update = $this->MY_Model->update("crm_ip", $set, $where);
			$this->session->set_userdata('swal', 'Updated Successfully.');
		
		redirect(base_url("ipwhitelist"));
	}
	// function delete_ip($crm_ip_id=''){
	// 	// $set = array("user_status" => 1);
	// 	$where = array("crm_ip_id" => $id="$crm_ip_id");
	// 	$res = $this->MY_Model->delete("crm_ip", $where);
	// 	$this->session->set_userdata('swal','User deleted successfully.');
	// 	redirect(base_url("ipwhitelist"));
	// }
	// function delete_crm($crm_id=''){
	// 	$set = array("user_status" => 2);
	// 	$where = array("crm_id" => $id="$crm_id");
	// 	$res = $this->MY_Model->update("crm_users", $set, $where);
	// 	$this->session->set_userdata('swal','User deleted successfully.');
	// 	redirect(base_url("crm"));
	// }

	function deactivate_ip($crm_ip_id=''){
		$set = array("ip_status" => 1);
		$where = array("crm_ip_id" => $id="$crm_ip_id");
		$res = $this->MY_Model->update("crm_ip", $set, $where);
		$this->session->set_userdata('swal','IP deactivated successfully.');
		redirect(base_url("ipwhitelist"));
	}

     function activate_ip($crm_ip_id=''){
		$set = array("ip_status" => 0);
		$where = array("crm_ip_id" => $id="$crm_ip_id");
		$res = $this->MY_Model->update("crm_ip", $set, $where);
		$this->session->set_userdata('swal','IP activated successfully.');
		redirect(base_url("ipwhitelist"));
	}

	function remove_ip($crm_ip_id=''){
		$set = array("ip_status" => 2);
		$where = array("crm_ip_id" => $id="$crm_ip_id");
		$res = $this->MY_Model->update("crm_ip", $set, $where);
		$this->session->set_userdata('swal','IP Remove successfully.');
		redirect(base_url("ipwhitelist"));

	}



}
