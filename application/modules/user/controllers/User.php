<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends MY_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }
	public function index() {
		$data['base_url'] = base_url();
		$this->smarty->loadView('login.tpl',$data,'No','No');
	}
	public function page_not_found(){
		
		$base_url = base_url("page_not_found");
		header("Location: $base_url");
		exit;
	}
	public function page_not_found_view(){
		
		$this->smarty->loadView('page_not_found.tpl',$data,'Yes','Yes');
	}
	/* add update user module */

	public function user_list()
	{
		$data['client'] = $this->User_model->getClientData();
        $data['groups'] = $this->User_model->getGroupData();
		$data['user_info'] = $this->User_model->getUserData();
		$data['no_data_message'] = NoDataFoundMessage("user");
		$this->smarty->loadView('user_details.tpl', $data,'Yes','Yes');
	}
	public function addUsersData()
	{
		$ret_arr = [];
		$msg ='';
		$success = 1;
        $client_arr  = $this->input->post("client");
        $groups  = $this->input->post("groups");
        
        if(is_valid_array($client_arr) && is_valid_array($groups)){
    		$data = array(
    			'user_name' => $this->input->post('user_name'),
    			'user_email' => $this->input->post('user_email'),
    			'user_password' => $this->input->post('user_password'),
    			'user_role' => $this->input->post('user_role'),
    			'added_date' => date("Y-m-d H:i:s"),
    			'added_by' => $this->session->userdata('user_id'),
                'unit_ids' => implode(",", $client_arr),
                "deleted"=>0,
                'groups' => implode(",", $groups),
    		);

    		$inser_query = $this->User_model->insertUser($data);
    		if ($inser_query) {
    			if ($inser_query) {
    				// echo "<script>alert('User  Added Successfully');document.location='erp_users'</script>";
    				$msg = 'User Added Successfully.';
    			} else {
    				// echo "<script>alert('Error IN User  Adding ,try again');document.location='erp_users'</script>";
    				$msg = 'Error IN User Adding ,try again.';
    				$success = 0;
    			}
    		} else {
    			
    			$msg = 'Error occer while inserting data.';
    			$success = 0;
    		}
        }else if(!is_valid_array($client_arr)){
            $msg = 'Please select unit.';
            $success = 0;
        }else if(!is_valid_array($groups)){
            $msg = 'Please select groups.';
            $success = 0;
        }
		$ret_arr['msg'] = $msg;
		$ret_arr['success'] = $success;
		echo json_encode($ret_arr);
	}
	public function updateUsersData()
    {
        $ret_arr = [];
        $msg ='';
        $success = 1;
        $client_arr  = $this->input->post("client");
        $status = $this->input->post('status');
        $groups  = $this->input->post("groups");
        if(is_valid_array($client_arr) && is_valid_array($groups)){
            $data = array(
                'user_name' => $this->input->post('user_name'),
                'unit_ids' => implode(",", $client_arr),
                'groups' => implode(",", $groups),
                'status' => $status
            );
            if($status != "Block"){
            	$data['login_attempt'] = 0;
            }
            $id = $this->input->post("user_id");
            $result = $this->User_model->updateUserData($data, $id);
            if ($result) {
                if ($result) {
                    // echo "<script>alert('User  Added Successfully');document.location='erp_users'</script>";
                    $msg = 'User Updated Successfully.';
                } else {
                    // echo "<script>alert('Error IN User  Adding ,try again');document.location='erp_users'</script>";
                    $msg = 'Error IN User Updating ,try again.';
                    $success = 0;
                }
            } else {
                $msg = 'Error occer while updateing data.';
                $success = 0;
            }
        }else if(!is_valid_array($client_arr)){
            $msg = 'Please select unit.';
            $success = 0;
        }else if(!is_valid_array($groups)){
            $msg = 'Please select groups.';
            $success = 0;
        }
        $ret_arr['messages'] = $msg;
        $ret_arr['success'] = $success;
        echo json_encode($ret_arr);
    }


	/* group master module */
	public function groupMaster(){
		$data['groups'] = $this->User_model->getGroupData();
		$this->smarty->loadView('group_master.tpl', $data,"Yes","Yes");
	}
	public function updateGroupMaster(){
		$post_data = $this->input->post();

		$update_arr = [
			"group_name" => $post_data['group_name'],
			"status" => $post_data['status']
		];

		$group_master_id = $post_data['group_master_id'];
		$affected_rows = $this->User_model->updateGroupMasterData($update_arr,$group_master_id);
		if($affected_rows > 0){
			$success = 1;
			$messages = "Group data updated successfully.";
			$menu_data = $this->User_model->getAllMenuData();
			$menu_arr = array_column($menu_data, "menu_master_id");
			$group_rights_data = $this->User_model->getGroupRightsData($group_master_id);
			$group_rights_arr = array_column($group_rights_data, "menu_master_id");
			$pending_menu = array_diff($menu_arr, $group_rights_arr);
			$group_rights_insert_arr = [];
			foreach ($pending_menu as $key => $value) {
				$group_rights_insert_arr[] = [
						"group_master_id" => $group_master_id,
						"menu_master_id" => $value,
						"list" => "No",
						"add" => "No",
						"update" => "No",
						"delete" => "No",
						"export" => "No"

					];
			}
			if(is_valid_array($group_rights_insert_arr)){
				$this->User_model->insertGroupRights($group_rights_insert_arr);
			}
			
		}
		$result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
		
	}
	public function addGroupMaster(){
		$post_data = $this->input->post();
		$group_name = $post_data['group_name'];
		$group_code = $post_data['group_code'];
		$status = $post_data['status'];

		$dublicate_group_code = $this->User_model->checkGroupCodeExist($group_code);
		$dublicate_group_name = $this->User_model->checkGroupNameExist($group_name);
		$success = 0;
        $messages = "Something went wrong.";
		if(count($dublicate_group_code) > 0){
			$messages = "Group code already exist.";
		}else if(count($dublicate_group_name) > 0){
			$messages = "Group name already exist.";
		}else{
			$insert_date = [
				"group_name" => $group_name,
				"group_code" => $group_code,
				"status" => $status
			];
			$insert_id = $this->User_model->insertGroup($insert_date);
			if($insert_id > 0){
				// $menu_data = $this->GlobalConfigModel->getAllMenuData();
				// $group_rights_arr = [];
				// foreach ($menu_data as $key => $value) {
				// 	$group_rights_arr[] = [
				// 		"group_master_id" => $insert_id,
				// 		"menu_master_id" => $value['menu_master_id'],
				// 		"list" => "No",
				// 		"add" => "No",
				// 		"update" => "No",
				// 		"delete" => "No",
				// 		"export" => "No"

				// 	];
				// }
				// if(count($group_rights_arr) > 0){
				// 	$this->GlobalConfigModel->insertGroupRights($group_rights_arr);
				// }
				$messages = "Group added successfully.";
				$success = 1;
			}
		}
		$result['messages'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}

	public function groupMenu(){
		$get_data = $this->input->get();
		$group_id = $get_data['id'];
		$data['group_id'] = $group_id;
		$group_details = $this->User_model->getGroupData($group_id);
		$data['group_details'] = $group_details[0];
		$data['groups_menu'] = $this->User_model->getGroupRightsData($group_id);
		$exist_menu_access_arr = [];
		foreach ($data['groups_menu'] as $key => $value) {
			$exist_menu_access_arr[$value['menu_master_id']] = $value;
		}
		$menu_data = $this->User_model->getAllMenuData();

		$data['groups_menu'] = [];
		foreach ($menu_data as $key => $value) {
			if(array_key_exists($value['menu_master_id'], $exist_menu_access_arr)){
				$groups_menu[$value['menu_category_name']][] = $exist_menu_access_arr[$value['menu_master_id']];
			}else{
				$groups_menu[$value['menu_category_name']][] = [
					"group_rights_id" => 0,
					"group_master_id" => $group_id,
					"menu_master_id" => $value['menu_master_id'],
					"list" => "No",
					"add" => "No",
					"update" => "No",
					"delete" => "No",
					"export" => "No",
					"import" => "No",
					"diaplay_name" => $value['diaplay_name']
				];
			}
		}
		
		$data['groups_menu'] = $groups_menu;
		
		$this->smarty->loadView('group_master_menu.tpl', $data,"Yes","Yes");
	}
	public function updateGroupMenuRight(){
		$post_data = $this->input->post();
		$menu_data = $post_data['menu'];
		$group_id = $post_data['group_id'];
		$access_data = ["list","add","update","export","delete",'import'];
		$group_menu_right = [];
		foreach ($menu_data as $key => $value) {
			$group_master_id = $value['group_master_id'];
			$menu_master_id = $value['menu_master_id'];
			$access_arr = array_keys($value['access']);
			$missing_access = (isset($value['access'])) ? array_diff($access_data, $access_arr) : $access_data;
			$update_arr = [];
			if(is_valid_array($value['access'])){
				$update_arr['group_master_id'] = $group_master_id;
				$update_arr['menu_master_id'] = $menu_master_id;
				foreach ($value['access'] as $key_val => $val) {
					$update_arr[$key_val] = $val;
				}
				foreach ($missing_access as $key_val => $val) {
					$update_arr[$val] = "No";
				}
				$group_menu_right[] = $update_arr;
			}
			
		}
		
		$success = 0;
        $messages = "Something went wrong.";
        // pr($group_menu_right,1);
		if(is_array($group_menu_right) && count($group_menu_right)){
			$this->User_model->deleteGroupRights($group_id);
			$affected_rows = $this->User_model->insertGroupRights($group_menu_right);
			if($affected_rows > 0){
				$group_ids = $this->session->userdata("groups");
				$group_ids = explode(",",$group_ids);
				if(in_array($group_id,$group_ids)){
					$group_rights = $this->User_model->getGroupRightData($group_ids,"");
					$this->session->set_userdata('group_rights_arr', base64_encode(json_encode($group_rights)));
				}
				$success = 1;
				$messages = "Group Right updated successfully.";
			}
		}else{
			$messages = "Please select group rights.";
		}
        $result['message'] = $messages;
        $result['success'] = $success;
        echo json_encode($result);
        exit();
	}
}

