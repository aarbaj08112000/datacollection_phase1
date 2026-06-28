<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
	public function getClientData(){
        $this->db->select('u.*');
        $this->db->from('client as u');
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }
    public function getUserData(){
        $this->db->select('u.*');
        $this->db->from('userinfo as u');
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }
    public function insertUser($insert_date = array()){
        $this->db->insert("userinfo", $insert_date);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    public function updateUserData($update_date = array(),$user_id = 0){
        $this->db->where('id', $user_id);
        $this->db->update('userinfo', $update_date);
        $affected_rows = $this->db->affected_rows() == 0 ? 1 : $this->db->affected_rows();
        return $affected_rows;
    }

	public function getGroupData($group_id = 0){
        $this->db->select('g.*');
        $this->db->from('group_master as g');
        if($group_id > 0){
             $this->db->where("g.group_master_id",$group_id);
        }
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }
    public function checkGroupCodeExist($group_code = 0){
        $this->db->select('g.*');
        $this->db->from('group_master as g');
        $this->db->where("g.group_code",$group_code);
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }
    public function checkGroupNameExist($group_name= 0){
        $this->db->select('g.*');
        $this->db->from('group_master as g');
        $this->db->where("g.group_name",$group_name);
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }
    public function insertGroup($insert_date = array()){
        $this->db->insert("group_master", $insert_date);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    public function insertGroupRights($insert_date = array()){
        $this->db->insert_batch('group_rights', $insert_date);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    public function updateGroupMasterData($update_date = array(),$group_master_id = 0){
        $this->db->where('group_master_id', $group_master_id);
        $this->db->update('group_master', $update_date);
        $affected_rows = $this->db->affected_rows() == 0 ? 1 : $this->db->affected_rows();
        return $affected_rows;
    }
    public function getAllMenuData(){
        $this->db->select('m.*,mc.menu_category_name ');
        $this->db->from('menu_master as m');
        $this->db->join("menu_category as mc","mc.menu_category_id = m.menu_category_id");
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }
    public function getGroupRightsData($group_id = 0){
        $this->db->select('g.*,m.diaplay_name');
        $this->db->from('group_rights as g');
        $this->db->join("menu_master as m","m.menu_master_id = g.menu_master_id");
        $this->db->where("g.group_master_id",$group_id);
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }
    public function deleteGroupRights($group_id = 0){
        $this->db->where('group_master_id', $group_id);
        $this->db->delete('group_rights');
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
}
