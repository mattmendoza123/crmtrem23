<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admincrmads extends MY_Controller
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
		$data["pagename"] = "Crmads";

		$this->load_page2("admincrmads", $data, "admincrmads_footer.php", "admincrmads_header.php");
	}

	public function adduser(){
		$post = $this->input->post();
		$files_path = 'assets/uploads/files/';
		$ads_business_card1  = $_FILES['ads_business_card']['name'];
		$tmp_name1 = $_FILES['ads_business_card']['tmp_name'];
		$name1 = $_FILES['ads_business_card']['name'];
		// move_uploaded_file($tmp_name1, $files_path . $name1);
		move_uploaded_file($tmp_name1, $files_path.time().'_'.$name1);
		$ads_business_card = time().'_'.$ads_business_card1;
		$user_data = array(
			'ads_first_name' => $post["ads_first_name"],
			'ads_last_name' => $post['ads_last_name'],
			'ads_email' => $post["ads_email"],
			'ads_skype' => $post["ads_skype"],
			'date_created' => date("Y-m-d"),
			'ads_user_status' => 0
		);
		$insert_user = $this->MY_Model->insert('crmads_users', $user_data);
		if ($insert_user) {
			$user_data = array(
			'fk_user_id' => $insert_user,
			'ads_company' => $post["ads_company"],
			'ads_tags' => implode(", ",$post["ads_tags"]),
			'ads_country' => $post["ads_country"],
			'ads_website' => $post["ads_website"],
			'ads_model' => implode(", ",$post["ads_model"]),
			'ads_geo' => implode(", ",$post["ads_geo"]),
			'ads_traffic_source' => implode(", ",$post["ads_traffic_source"]),
			'ads_am' => $post["ads_am"],
			'ads_business_card' => $ads_business_card,
			'ads_comment' => $post["ads_comment"],
			);
			$this->MY_Model->insert('crmads_user_details', $user_data);
			$this->session->set_userdata('swal', 'Added successfully.');
			redirect(base_url("admincrmads"));
		}
	}



	public function get_crmadslist()
	{
		
		print_r($_REQUEST);
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
			1 => 'ads_company',
			2 => 'ads_first_name',
			3 => 'ads_last_name',
            4 => 'ads_email',
            5 => 'ads_skype',
            6 => 'ads_tags',
            7 => 'ads_country',
            8 => 'ads_website',
			9 => 'ads_model',
			10 => 'ads_geo',
			11 => 'ads_traffic_source',
			12 => 'ads_am',
			13 => 'ads_comment',
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

        $crmads= $this->db
        ->select('*')
		->from('crmads_users') 
		->join('crmads_user_details', 'crmads_user_details.fk_user_id= crmads_users.crmads_id')
		->where('ads_user_status !=', '2')
		// ->where('user_type', 'User')
        ->get();
		

		$data = array();

		foreach ($crmads->result() as $tm) {
			$action_btn = "";
			// $action_btn = "<button type='button' class='btn btn-xs edit-users' data-toggle='tooltip' data-toggle='modal' data-target='#UpdateUsers'><i class='fa fa-edit'></i></button>"
            $action_btn .= "<a class='btn btn-xs edit-crmads' crmads-id=".$tm->crmads_details_id." data-toggle='tooltip' data-placement='bottom' title='Update'  data-toggle='modal' data-target='#UpdateUsers' href=''><i class='fa fa-edit'></i></a>&nbsp;";
			$action_btn .= "<a class='btn btn-xs view-crmads' crmads-id=".$tm->crmads_details_id." data-toggle='tooltip' data-placement='bottom' title='View'  data-toggle='modal' data-target='#ViewUsers' href=''><i class='fa fa-eye'></i></a>&nbsp;";
			// $action_btn .= "<a class='btn btn-xs delete-crm' crm-id=".$tm->crm_details_id." data-toggle='tooltip' data-placement='bottom' title='Delete'  data-toggle='modal' data-target='#DeleteUsers' href=''><i class='fa fa-trash'></i></a>";
			// $action_btn .= "<a class='btn btn-xs delete-users' crm-id=".$tm->crm_details_id." data-toggle='tooltip' data-placement='bottom' title='Delete' href=".base_url('crm/delete_crm/'.$tm->crm_id)."><i class='fa fa-trash'></i></a>";
			$action_btn .= "<a class='btn btn-xs delete-crmads' data-toggle='tooltip' data-placement='bottom' title='Delete'  href=".base_url('admincrmads/delete_crmads/'.$tm->crmads_id)."><i class='fa fa-trash'></i></a>";
			// $action_btn .= "<a class='btn btn-xs delete-crmads' href='".base_url('crmads/delete_crmads/'.$tm->crmads_id)."'><i class='fa fa-trash'></i></a>";
			
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
				$tm->ads_company,
				$tm->ads_first_name,
				$tm->ads_last_name,
				$tm->ads_email,
				$tm->ads_skype,
				$tm->ads_tags,
				$tm->ads_country,
                $tm->ads_website,
				$tm->ads_model,
				$tm->ads_geo,
				$tm->ads_traffic_source,
				$tm->ads_am,
				$tm->ads_comment,
				$tm->date_created,
				$action_btn
			);
			
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $crmads->num_rows(),
			"recordsFiltered" => $crmads->num_rows(),
			"data" => $data, 
			"ads_tags"=> $this->makeOptions("ads_tags",$crmads->result() )
		);
		echo json_encode($output);
		exit();
	}
	public function makeOptions($field,$optionData){
		$option_arr = [];
		$option_list = [];
		foreach ($optionData as $key => $value) {		
			$option_list = explode(",",$value->$field);
			if(count($option_list) > 0){
				foreach($option_list as $ol){
					if(!in_array($ol,$option_arr)){	
						$option_arr[] = trim($ol);
					}
				}
			}
			if(!in_array($value->$field,$option_arr)){	
				$option_arr[] = trim($value->$field);
			}
		}
		return $option_arr;
	}
	public function get_crmads($id = '')
	{
		$result = $this->db
		->select('*')
        ->from('crmads_users')
        ->join('crmads_user_details', 'crmads_user_details.fk_user_id= crmads_users.crmads_id')
		->where('crmads_details_id', $id)
		->get()
		->result_array();
		echo json_encode($result);
		exit();
	}
	public function updatecrmads()
	{
		$post = $this->input->post();
		$files_path = 'assets/uploads/files/';
		$ads_business_card1 = $_FILES['u_ads_business_card']['name'];
		$tmp_name1 = $_FILES['u_ads_business_card']['tmp_name'];
		$name1 = $_FILES['u_ads_business_card']['name'];
		// move_uploaded_file($tmp_name1, $files_path . $name1);
		move_uploaded_file($tmp_name1, $files_path.time().'_'.$name1);
		$ads_business_card = time().'_'.$ads_business_card1;
			if($post){
				$set = array(
                    
					'ads_company' => $post["u_ads_company"],
					'ads_tags' => implode(", ",$post["u_ads_tags"]),
					'ads_country' => $post["u_ads_country"],
					'ads_website' => $post["u_ads_website"],
					'ads_model' => implode(", ",$post["u_ads_model"]),
					'ads_geo' => implode(", ",$post["u_ads_geo"]),
					'ads_traffic_source' => implode(", ",$post["u_ads_traffic_source"]),
					'ads_am' => $post["u_ads_am"],
					'ads_business_card' => $ads_business_card,
					'ads_comment' => $post["u_ads_comment"],
					
				);
				$where = array("fk_user_id" => $post["fk_user_id"]);
				$update = $this->MY_Model->update("crmads_user_details", $set, $where);
				if($update) {
					$set = array(
						'ads_first_name' => $post["u_ads_first_name"],
						'ads_last_name' => $post['u_ads_last_name'],
						'ads_email' => $post["u_ads_email"],
						'ads_skype' => $post["u_ads_skype"],
						'date_created' => date("Y-m-d"),
					);
					$where = array("crmads_id" => $post["crmads_id"]);
					$update = $this->MY_Model->update("crmads_users", $set, $where);
					$this->session->set_userdata('swal', 'Updated Successfully.');
				}
			}
		
		redirect(base_url("admincrmads"));
	}

	function delete_crmads($crmads_id=''){
		$set = array("ads_user_status" => 2);
		$where = array("crmads_id" => $id="$crmads_id");
		$res = $this->MY_Model->update("crmads_users", $set, $where);
		$this->session->set_userdata('swal','User Remove successfully.');
		redirect(base_url("admincrmads"));

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
