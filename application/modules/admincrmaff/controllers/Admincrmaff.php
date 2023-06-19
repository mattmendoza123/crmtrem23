<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admincrmaff extends MY_Controller
{

	private $errmsg = "";

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
	
		$data["title"] = "CRM | Tremendio Portal";
		$data["pagename"] = "Crmaff";

		$this->load_page2("admincrmaff", $data, "admincrmaff_footer.php", "admincrmaff_header.php");
	}

	public function adduser(){
		$post = $this->input->post();
		$files_path = 'assets/uploads/files/';
		$aff_business_card1  = $_FILES['aff_business_card']['name'];
		$tmp_name1 = $_FILES['aff_business_card']['tmp_name'];
		$name1 = $_FILES['aff_business_card']['name'];
		// move_uploaded_file($tmp_name1, $files_path . $name1);
		move_uploaded_file($tmp_name1, $files_path.time().'_'.$name1);
		$aff_business_card = time().'_'.$aff_business_card1;
		$user_data = array(
			'aff_first_name' => $post["aff_first_name"],
			'aff_last_name' => $post['aff_last_name'],
			'aff_email' => $post["aff_email"],
			'aff_skype' => $post["aff_skype"],
			'date_created' => date("Y-m-d"),
			'aff_user_status' => 0
		);
		$insert_user = $this->MY_Model->insert('crmaff_users', $user_data);
		if ($insert_user) {
			$user_data = array(
			'fk_user_id' => $insert_user,
			'aff_company' => $post["aff_company"],
			'aff_tags' => implode(", ",$post["aff_tags"]),
			'aff_country' => $post["aff_country"],
			'aff_website' => $post["aff_website"],
			'aff_model' => implode(", ",$post["aff_model"]),
			'aff_geo' => implode(", ",$post["aff_geo"]),
			'aff_traffic_source' => implode(", ",$post["aff_traffic_source"]),
			'aff_am' => $post["aff_am"],
			'aff_business_card' => $aff_business_card,
			'aff_ex_hou' => $post["aff_ex_hou"],
			'aff_comment' => $post["aff_comment"],
			);
			$this->MY_Model->insert('crmaff_user_details', $user_data);
			$this->session->set_userdata('swal', 'Added successfully.');
			redirect(base_url("admincrmaff"));
		}
	}



	public function get_crmafflist()
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
			1 => 'aff_company',
			2 => 'aff_first_name',
			3 => 'aff_last_name',
            4 => 'aff_email',
            5 => 'aff_skype',
            6 => 'aff_tags',
            7 => 'aff_country',
            8 => 'aff_website',
			9 => 'aff_model',
			10 => 'aff_geo',
			11 => 'aff_traffic_source',
			12 => 'aff_am',
			13 => 'aff_ex_hou',
			14 => 'aff_comment',
			15 => 'date_created',
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

        $crmaff= $this->db
        ->select('*')
		->from('crmaff_users') 
		->join('crmaff_user_details', 'crmaff_user_details.fk_user_id= crmaff_users.crmaff_id')
		->where('aff_user_status !=', '2')
		// ->where('user_type', 'User')
        ->get();
		

		$data = array();

		foreach ($crmaff->result() as $tm) {
			$action_btn = "";
			// $action_btn = "<button type='button' class='btn btn-xs edit-users' data-toggle='tooltip' data-toggle='modal' data-target='#UpdateUsers'><i class='fa fa-edit'></i></button>"
            $action_btn .= "<a class='btn btn-xs edit-crmaff' crmaff-id=".$tm->crmaff_details_id." data-toggle='tooltip' data-placement='bottom' title='Update'  data-toggle='modal' data-target='#UpdateUsers' href=''><i class='fa fa-edit'></i></a>&nbsp;";
			$action_btn .= "<a class='btn btn-xs view-crmaff' crmaff-id=".$tm->crmaff_details_id." data-toggle='tooltip' data-placement='bottom' title='View'  data-toggle='modal' data-target='#ViewUsers' href=''><i class='fa fa-eye'></i></a> &nbsp;";
			// $action_btn .= "<a class='btn btn-xs delete-crm' crm-id=".$tm->crm_details_id." data-toggle='tooltip' data-placement='bottom' title='Delete'  data-toggle='modal' data-target='#DeleteUsers' href=''><i class='fa fa-trash'></i></a>";
			// $action_btn .= "<a class='btn btn-xs delete-users' crm-id=".$tm->crm_details_id." data-toggle='tooltip' data-placement='bottom' title='Delete' href=".base_url('crm/delete_crm/'.$tm->crm_id)."><i class='fa fa-trash'></i></a>";
			$action_btn .= "<a class='btn btn-xs delete-crmaff' data-toggle='tooltip' data-placement='bottom' title='Delete'  href=".base_url('admincrmaff/delete_crmaff/'.$tm->crmaff_id)."><i class='fa fa-trash'></i></a>";
			// $action_btn .= "<a class='btn btn-xs delete-crmaff' href='".base_url('crmaff/delete_crmaff/'.$tm->crmaff_id)."'><i class='fa fa-trash'></i></a>";

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
				$tm->aff_company,
				$tm->aff_first_name,
				$tm->aff_last_name,
				$tm->aff_email,
				$tm->aff_skype,
				$tm->aff_tags,
				$tm->aff_country,
                $tm->aff_website,
				$tm->aff_model,
				$tm->aff_geo,
				$tm->aff_traffic_source,
				$tm->aff_ex_hou,
				$tm->aff_comment,
				$tm->date_created,
				$action_btn
			);
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $crmaff->num_rows(),
			"recordsFiltered" => $crmaff->num_rows(),
			"data" => $data
		);
		echo json_encode($output);
		exit();
	}

	public function get_crmaff($id = '')
	{
		$result = $this->db
		->select('*')
        ->from('crmaff_users')
        ->join('crmaff_user_details', 'crmaff_user_details.fk_user_id= crmaff_users.crmaff_id')
		->where('crmaff_details_id', $id)
		->get()
		->result_array();
		echo json_encode($result);
		exit();
	}
	public function updatecrmaff()
	{
		$post = $this->input->post();
		$files_path = 'assets/uploads/files/';
		$aff_business_card1 = $_FILES['u_aff_business_card']['name'];
		$tmp_name1 = $_FILES['u_aff_business_card']['tmp_name'];
		$name1 = $_FILES['u_aff_business_card']['name'];
		// move_uploaded_file($tmp_name1, $files_path . $name1);
		move_uploaded_file($tmp_name1, $files_path.time().'_'.$name1);
		$aff_business_card = time().'_'.$aff_business_card1;
			if($post){
				$set = array(
                    
					'aff_company' => $post["u_aff_company"],
					'aff_tags' => implode(", ",$post["u_aff_tags"]),
					'aff_country' => $post["u_aff_country"],
					'aff_website' => $post["u_aff_website"],
					'aff_model' => implode(", ",$post["u_aff_model"]),
					'aff_geo' => implode(", ",$post["u_aff_geo"]),
					'aff_traffic_source' => implode(", ",$post["u_aff_traffic_source"]),
					'aff_am' => $post["u_aff_am"],
					'aff_business_card' => $aff_business_card,
					'aff_ex_hou' => $post["u_aff_ex_hou"],
					'aff_comment' => $post["u_aff_comment"],
					
				);
				$where = array("fk_user_id" => $post["fk_user_id"]);
				$update = $this->MY_Model->update("crmaff_user_details", $set, $where);
				if($update) {
					$set = array(
						'aff_first_name' => $post["u_aff_first_name"],
						'aff_last_name' => $post['u_aff_last_name'],
						'aff_email' => $post["u_aff_email"],
						'aff_skype' => $post["u_aff_skype"],
						'date_created' => date("Y-m-d"),
					);
					$where = array("crmaff_id" => $post["crmaff_id"]);
					$update = $this->MY_Model->update("crmaff_users", $set, $where);
					$this->session->set_userdata('swal', 'Updated Successfully.');
				}
			}
		
		redirect(base_url("admincrmaff"));
	}

	function delete_crmaff($crmaff_id=''){
		$set = array("aff_user_status" => 2);
		$where = array("crmaff_id" => $id="$crmaff_id");
		$res = $this->MY_Model->update("crmaff_users", $set, $where);
		$this->session->set_userdata('swal','User Remove successfully.');
		redirect(base_url("admincrmaff"));

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
