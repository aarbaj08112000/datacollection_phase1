<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_user_details($email ="",$password="")
	{
		$this->db->select('*');
		$this->db->from('userinfo u');
		$this->db->where('u.user_email', $email);
		$this->db->where('u.user_password', $password);
		$this->db->where('u.status', 'Active');
		$query = $this->db->get();
		$data = is_object($query) ? $query->row_array() : [];
        return $data;
	}
	public function get_user_exist($email ="")
	{
		$this->db->select('*');
		$this->db->from('userinfo u');
		$this->db->where('u.user_email', $email);
		$query = $this->db->get();
		$data = is_object($query) ? $query->row_array() : [];
        return $data;
	}
	public function updateUserData($update_date = array(),$user_id = 0){
        $this->db->where('id', $user_id);
        $this->db->update('userinfo', $update_date);
        $affected_rows = $this->db->affected_rows() == 0 ? 1 : $this->db->affected_rows();
        return $affected_rows;
    }
	public function get_company_details($company_id)
	{
		$this->db->select('*');
		$this->db->from('userinfo u');
		$this->db->where('u.user_email', $email);
		$this->db->where('u.user_password', $password);
		$query = $this->db->get();
		$data = is_object($query) ? $query->row_array() : [];
        return $data;
	}
	public function getGroupRightData($group_id = [],$menu_url = ''){
        $group_id = explode(",",$group_id);
        $this->db->select('g.*,m.diaplay_name,m.url');
        $this->db->from('group_rights as g');
        $this->db->join("menu_master as m","m.menu_master_id = g.menu_master_id");
        $this->db->where_in("g.group_master_id",$group_id);
        if($menu_url != ""){
            $this->db->where("m.url",$menu_url);
        }
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }
    public function get_user_exist_check($usename="")
	{
		$this->db->select('*');
		$this->db->from('userinfo u');
		$this->db->where('u.user_email', $usename);
		$this->db->where('u.status', 'Active');
		$query = $this->db->get();
		$data = is_object($query) ? $query->row_array() : [];
        return $data;
	}
    
}
