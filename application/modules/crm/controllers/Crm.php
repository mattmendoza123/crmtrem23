<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Crm extends MY_Controller
{

	private $errmsg = "";

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
	
		$data["title"] = "CRM | Click ADV";
		$data["pagename"] = "CRM";

		$this->load_page2("crm", $data, "crm_footer.php", "crm_header.php");
	}
	

	public function adduser(){
		$post = $this->input->post();
		$files_path = 'assets/uploads/';
		$business_card1  = $_FILES['business_card']['name'];
		$tmp_name1 = $_FILES['business_card']['tmp_name'];
		$name1 = $_FILES['business_card']['name'];
		// move_uploaded_file($tmp_name1, $files_path . $name1);
		move_uploaded_file($tmp_name1, $files_path.time().'_'.$name1);
		$business_card = time().'_'.$business_card1;
		$user_data = array(
			'first_name' => $post["first_name"],
			'last_name' => $post['last_name'],
			'email' => $post["email"],
			'skype' => $post["skype"],
			'date_created' => date("Y-m-d"),
			'user_status' => 0
		);
		$insert_user = $this->MY_Model->insert('crm_users', $user_data);
		if ($insert_user) {
			$user_data = array(
			'fk_user_id' => $insert_user,
			'company' => $post["company"],
			'tags' => implode(", ",$post["tags"]),
			'country' => $post["country"],
			'website' => $post["website"],
			'model' => implode(", ",$post["model"]),
			'geo' => implode(", ",$post["geo"]),
			'traffic_source' => implode(", ",$post["traffic_source"]),
			'am' => $post["am"],
			'business_card' => $business_card,
			'comment' => $post["comment"],
			);
			$this->MY_Model->insert('crm_user_details', $user_data);
			$this->session->set_userdata('swal', 'Added successfully.');
			redirect(base_url("crm"));
		}
	}



	public function get_crmlist()
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
			1 => 'company',
			2 => 'first_name',
			3 => 'last_name',
            4 => 'email',
            5 => 'skype',
            6 => 'tags',
            7 => 'country',
            8 => 'website',
			9 => 'model',
			10 => 'geo',
			11 => 'traffic_source',
			12 => 'am',
			13 => 'comment',
			14 => 'date_created',
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

        $crm= $this->db
        ->select('*')
		->from('crm_users') 
		->join('crm_user_details', 'crm_user_details.fk_user_id= crm_users.crm_id')
		// ->where('user_type', 'User')
        ->get();
		

		$data = array();

		foreach ($crm->result() as $tm) {
			$action_btn = "";
			// $action_btn = "<button type='button' class='btn btn-xs edit-users' data-toggle='tooltip' data-toggle='modal' data-target='#UpdateUsers'><i class='fa fa-edit'></i></button>"
            $action_btn .= "<a class='btn btn-xs edit-crm' crm-id=".$tm->crm_details_id." data-toggle='tooltip' data-placement='bottom' title='Update'  data-toggle='modal' data-target='#UpdateUsers' href=''><i class='fa fa-edit'></i></a>&nbsp;";
			$action_btn .= "<a class='btn btn-xs view-crm' crm-id=".$tm->crm_details_id." data-toggle='tooltip' data-placement='bottom' title='View'  data-toggle='modal' data-target='#ViewUsers' href=''><i class='fa fa-eye'></i></a> &nbsp;";
			// $action_btn .= "<a class='btn btn-xs delete-crm' crm-id=".$tm->crm_details_id." data-toggle='tooltip' data-placement='bottom' title='Delete'  data-toggle='modal' data-target='#DeleteUsers' href=''><i class='fa fa-trash'></i></a>";
			// $action_btn .= "<a class='btn btn-xs delete-users' crm-id=".$tm->crm_details_id." data-toggle='tooltip' data-placement='bottom' title='Delete' href=".base_url('crm/delete_crm/'.$tm->crm_id)."><i class='fa fa-trash'></i></a>";
			$action_btn .= "<a class='btn btn-xs delete-crm' href='".base_url('crm/delete_crm/'.$tm->crm_id)."'><i class='fa fa-trash'></i></a>";
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

			$data[] = array(
                // $tm->crm_details_id,
				$tm->company,
				$tm->first_name,
				$tm->last_name,
				$tm->email,
				$tm->skype,
				$tm->tags,
				$tm->country,
                $tm->website,
				$tm->model,
				$tm->geo,
				$tm->traffic_source,
				$tm->am,
				$tm->comment,
				$tm->date_created,
				$action_btn
			);
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $crm->num_rows(),
			"recordsFiltered" => $crm->num_rows(),
			"data" => $data
		);
		echo json_encode($output);
		exit();
	}

	public function get_crm($id = '')
	{
		$result = $this->db
		->select('*')
        ->from('crm_users')
        ->join('crm_user_details', 'crm_user_details.fk_user_id= crm_users.crm_id')
		->where('crm_details_id', $id)
		->get()
		->result_array();
		echo json_encode($result);
		exit();
	}

	public function updatecrm()
	{
		$post = $this->input->post();
		$files_path = 'assets/uploads/';
		$business_card1 = $_FILES['u_business_card']['name'];
		$tmp_name1 = $_FILES['u_business_card']['tmp_name'];
		$name1 = $_FILES['u_business_card']['name'];
		// move_uploaded_file($tmp_name1, $files_path . $name1);
		move_uploaded_file($tmp_name1, $files_path.time().'_'.$name1);
		$business_card = time().'_'.$business_card1;
			if($post){
				$set = array(
                    
					'company' => $post["u_company"],
					'tags' => implode(", ",$post["u_tags"]),
					'country' => $post["u_country"],
					'website' => $post["u_website"],
					'model' => implode(", ",$post["u_model"]),
					'geo' => implode(", ",$post["u_geo"]),
					'traffic_source' => implode(", ",$post["u_traffic_source"]),
					'am' => $post["u_am"],
					'business_card' => $business_card,
					'comment' => $post["u_comment"],
					
				);
				$where = array("fk_user_id" => $post["fk_user_id"]);
				$update = $this->MY_Model->update("crm_user_details", $set, $where);
				if($update) {
					$set = array(
						'first_name' => $post["u_first_name"],
						'last_name' => $post['u_last_name'],
						'email' => $post["u_email"],
						'skype' => $post["u_skype"],
						'date_created' => date("Y-m-d"),
					);
					$where = array("crm_id" => $post["crm_id"]);
					$update = $this->MY_Model->update("crm_users", $set, $where);
					$this->session->set_userdata('swal', 'Updated Successfully.');
				}
			}
		
		redirect(base_url("crm/crm"));
	}
	function delete_crm($fk_user_id=''){
		// $set = array("user_status" => 1);
		$where = array("fk_user_id" => $id="$fk_user_id");
		$res = $this->MY_Model->delete("crm_user_details", $where);
		$this->session->set_userdata('swal','User deleted successfully.');
		redirect(base_url("crm/crm"));
	}

	// public function delete_crm($id=''){

	// 	$this->db->
    // //   set('user_status', '1')->
	// 	select('*')
    //     ->from('crm_users')
    //     ->join('crm_user_details', 'crm_user_details.fk_user_id= crm_users.crm_id')
	// 	->where('crm_details_id', $id)
	// 	->delete();

	// 	$this->session->set_userdata('swal','User deleted successfully.');
	// 	redirect('crm');
	// }

}
