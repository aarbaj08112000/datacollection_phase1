<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

   
    /* check access for groups */
    public function check_group_access($page_url = "",$type = ''){
        $access = false;
        $session = $this->session->userdata();
        $groups = explode(",",$session['groups']);
        if(is_valid_array($groups)){
            $group_rights_data = $this->getGroupAccessList($groups,$page_url);
            if(is_valid_array($group_rights_data)){
                $group_rights = array_values($group_rights_data);
                $group_rights = $group_rights[0];
                if($group_rights[$type] == "Yes"){
                    $access = true;
                }
            }
            
        }
        return $access;
    }
    public function getGroupAccessList($groups=[],$menu_url = ""){
        $group_rights = $this->getGroupRightsDataList($groups,$menu_url);
        $group_rights_arr = [];
        foreach ($group_rights as $key => $value) {
            if(!isset($group_rights_arr[$value['menu_master_id']]) ){
                $group_rights_arr[$value['menu_master_id']]['diaplay_name'] = $value['diaplay_name'];
                $group_rights_arr[$value['menu_master_id']]['url'] = $value['url'];
            }
            if(!isset($group_rights_arr[$value['menu_master_id']]['list']) || (isset($group_rights_arr[$value['menu_master_id']]['list']) && $group_rights_arr[$value['menu_master_id']]['list'] == "No")){
                $group_rights_arr[$value['menu_master_id']]['list'] = $value['list'];
            }
            if(!isset($group_rights_arr[$value['menu_master_id']]['add']) || (isset($group_rights_arr[$value['menu_master_id']]['add']) && $group_rights_arr[$value['menu_master_id']]['add'] == "No")){
                $group_rights_arr[$value['menu_master_id']]['add'] = $value['add'];
            }
            if(!isset($group_rights_arr[$value['menu_master_id']]['update']) || (isset($group_rights_arr[$value['menu_master_id']]['update']) && $group_rights_arr[$value['menu_master_id']]['update'] == "No")){
                $group_rights_arr[$value['menu_master_id']]['update'] = $value['update'];
            }
            if(!isset($group_rights_arr[$value['menu_master_id']]['delete'])  || (isset($group_rights_arr[$value['menu_master_id']]['delete']) && $group_rights_arr[$value['menu_master_id']]['delete'] == "No")){
                $group_rights_arr[$value['menu_master_id']]['delete'] = $value['delete'];
            }
            if(!isset($group_rights_arr[$value['menu_master_id']]['export'])  || (isset($group_rights_arr[$value['menu_master_id']]['export']) && $group_rights_arr[$value['menu_master_id']]['export'] == "No")){
                $group_rights_arr[$value['menu_master_id']]['export'] = $value['export'];
            }
        }
        return $group_rights_arr;
    }
    public function getGroupRightsDataList($group_id = [],$menu_url = ''){
        $group_rights_arr = $this->session->userdata('group_rights_arr');
        $group_rights_arr =  $group_rights_arr != "" ? json_decode(base64_decode($group_rights_arr),TRUE) : '';
        $ret_data = [];
        if(is_valid_array($group_rights_arr)){ 
            foreach ($group_rights_arr as $key => $value) {
                if($value['url'] == $menu_url){
                   $ret_data[] = $value;
                }
            }
        }
        return $ret_data;
    }

    public function getConfig()
    {
       
        $this->db->select('c.*');
        $this->db->from('config_setting c');
        $query = $this->db->get();
        $data = is_object($query) ? $query->result_array() : [];
        return $data;
    }
}
