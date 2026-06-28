<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends MY_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('Login_model');
    }
	public function index() {
		$data['base_url'] = base_url();
		$this->smarty->loadView('login.tpl',$data,'No','No');
	}
	public function logout()
	{

		$user_data = array();
		$this->session->set_userdata($user_data);
		unset($_SESSION["userdata"]);
		session_destroy();
		redirect(base_url("login"));
	}
	public function signin()
	{
		$login_attempt_count = $this->config->item("login_attempt");
		// pr($_POST,1);
		// $data['userInfo'] = $this->Crud->read_data("userInfo");
		$this->form_validation->set_rules('email', ' Email', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('password', ' Password', 'trim|required|min_length[3]');

		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$result = $this->Login_model->get_user_details($email, $password);	
		
		$redirect_url = "";
		if (empty($result)) {
			$result = $this->Login_model->get_user_exist($email);
			$success = 0;
			if($result['login_attempt'] > $login_attempt_count){
				$messages = "User temporary block!";
				$update_data = array(
	                'status' => "Block",
	            );
			}else{
				$login_attempt = $result['login_attempt']+1;
				$update_data = array(
	                'login_attempt' => $login_attempt,
	            );
				$messages = "Invalid credentials!";
			}
			$result = $this->Login_model->updateUserData($update_data, $result['id']);			
		} else {
			$this->session->unset_userdata($user_data);
			$user_data = array(
				'user_id' => $result['id'],
				'user_email' => $result['user_email'],
				'user_login' => true,
				'user_name' => $result['user_name'],
				'type' => $result['type'],
				'role' => $result['user_role'],
				'groups' => $result['groups']
			);
			$this->session->set_userdata($user_data);

			$group_rights = $this->Login_model->getGroupRightData($result['groups'],"");
			$this->session->set_userdata('group_rights_arr', base64_encode(json_encode($group_rights)));
			if(checkGroupAccess("sitemap","list","No")){
					$redirect_url = "dashboard";
			}else{
					$redirect_url = "dashboard";
			}
			$success = 1;
			$messages = "User Login successfully";
			
		}
		$return_arr['redirect_url']= $redirect_url;
		$return_arr['success']=$success;
		$return_arr['messages']=$messages;
		echo json_encode($return_arr);
		exit;
	}
	public function reset_password(){
		$username = $this->input->post('username');
		$result = $this->Login_model->get_user_exist_check($username);	
		if(is_valid_array($result)){
	        $success = 1;
			$messages = "Password sent successfully";
			$user_id = $result['id'];
			$email_data = [
				"time_stramp" => time(),
				"user_id" => $user_id,
				"email_name" => "Reset Password ",
				"email_subject" => "Reset Password Of ".$this->config->item("company_name")
			];
			$this->email_sender($email_data,$result['user_email'],"forgot_password");
		}else{
			$success = 0;
			$messages = "User not exist";
		}
		$return_arr['success']=$success;
		$return_arr['messages']=$messages;
		echo json_encode($return_arr);
		exit;
		
	}
	public function reset_password_action(){
		$post_data = $this->input->post();
		$update_data = array(
	        'user_password' => $post_data['password']
	    );
	    $result = $this->Login_model->updateUserData($update_data, $post_data['user_id']);
	    $success = 0;
		$messages = "Password not reset";
	    if($result > 0){
	    	$success = 1;
			$messages = "Password reset successful!";
	    }
	    $return_arr['redirect_url'] = "login";
		$return_arr['success']=$success;
		$return_arr['messages']=$messages;
		echo json_encode($return_arr);
		exit;
	}
	public function forgot_password($timestamp="",$user_id){
		$current_time = time();
		$time_difference = $current_time - $timestamp;
		$expiry_time = $this->config->item("password_link_expiry")*60;
		$expired_link = "Yes";
		if ($time_difference <= $expiry_time) {
		    $expired_link = "No";
		}
		$data['base_url'] = base_url();
		$data['user_id'] = $user_id;
		$data['expired_link'] = $expired_link;
		$this->smarty->setTemplateDir(APPPATH.'modules/user/views/');
		$this->smarty->loadView('forgot_password.tpl',$data,'No','No');
	}
	public function site_map(){
		$data['base_url'] = base_url();
		$data['sitemap'] = true;
		$data['site_path'] = $this->config->item("site_path")."views/templates/quick_menu.tpl";
		$this->smarty->loadView('site_map.tpl',$data,'Yes','Yes');
	}
	public function dashboard(){
		$data['base_url'] = base_url();
		$colleges = [
			[
				"id" => 1,
				"logo" => "https://ghrce.raisoni.net/icrfs/images/logo.png",
				"name" => "GHRCE",
				"url" => "ghrce",
				"students" => 5,
				"status" => "Active"
			],
			[
				"id" => 2,
				"logo" => "https://tse1.mm.bing.net/th?id=OIP.o9Rran9e3jwzxGolNQTYBAHaHa&pid=Api&P=0&h=180",
				"name" => "Delhi University (DU)",
				"url" => "du",
				"students" => 50,
				"status" => "Active"
			],
			[
				"id" => 3,
				"logo" => "https://tse4.mm.bing.net/th?id=OIP.VFJg4hbD5WpHqXOLWs9ztwHaHa&pid=Api&P=0&h=180",
				"name" => "Symbiosis Institute of Technology (SIT)",
				"url" => "sit",
				"students" => 74,
				"status" => "Inactive"
			],
			[
				"id" => 4,
				"logo" => "https://tse3.mm.bing.net/th?id=OIP.y4YLD7EAzYYD5j2LlGLx4gHaHa&pid=Api&P=0&h=180",
				"name" => "Indian Institute of Technology (IIT) Bombay",
				"url" => "iit",
				"students" => 74,
				"status" => "Active"
			]
		];
		$data['colleges'] = $colleges;
		
		$this->smarty->loadView('dashboard.tpl',$data,'Yes','Yes');
	}
	
	
}

