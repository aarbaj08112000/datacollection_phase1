<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    public function getFieldData(){
        $this->db->select('f.*');
        $this->db->from('form_field_master as f');
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }
    public function insertSchoolData($insert_date = array()){
        $this->db->insert("school_matser", $insert_date);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    public function deleteSchoolData($school_id){
        $this->db->where('school_id', $school_id);
        $this->db->delete('school_matser');
    }
    public function updateSchoolData($update_data, $id) {
        $this->db->where('school_id', $id);
        $this->db->update('school_matser', $update_data);
    }



    /* school listing */
    public function getSchoolData($condition_arr = [],$search_params = ""){
        
        $this->db->select('sm.*,COUNT(fdc.school_master_id) as total_record');
        $this->db->from('school_matser sm');
        $this->db->join('form_data_collection as fdc','fdc.school_master_id = sm.school_id','left');
        // if (!empty($search_params['value'])) {
        //     $keyword = $search_params['value'];
        //     $this->db->group_start(); // Start a group of OR conditions
    
        //     $fields = [
        //         'cpt.po_number', // Replace 'some_field' with actual fields in 'customer_po_tracking' you want to search
        //         'c.customer_name',
        //         // Add more fields if needed
        //     ];
    
        //     foreach ($fields as $field) {
        //         $this->db->or_like($field, $keyword);
        //     }
    
        //     $this->db->group_end(); // End the group of OR conditions
        // }

        if (count($condition_arr) > 0) {
            $this->db->limit($condition_arr["length"], $condition_arr["start"]);
            if ($condition_arr["order_by"] != "") {
                $this->db->order_by($condition_arr["order_by"]);
            }
        }
        $this->db->group_by('sm.school_id');
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        // pr($this->db->last_query(),1);
        return $ret_data;
    }

    public function getSchoolDataCount($condition_arr = [],$search_params = ""){
        
        $this->db->select('COUNT(sm.school_id) as total_record');
        $this->db->from('school_matser sm');

        // if (!empty($search_params['value'])) {
        //     $keyword = $search_params['value'];
        //     $this->db->group_start(); // Start a group of OR conditions
    
        //     $fields = [
        //         'cpt.po_number', // Replace 'some_field' with actual fields in 'customer_po_tracking' you want to search
        //         'c.customer_name',
        //         // Add more fields if needed
        //     ];
    
        //     foreach ($fields as $field) {
        //         $this->db->or_like($field, $keyword);
        //     }
    
        //     $this->db->group_end(); // End the group of OR conditions
        // }
        $this->db->group_by('sm.school_id');
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->row_array() : [];
        // pr($this->db->last_query(),1);
        return $ret_data;
    }


    /* form field listing */
    public function getFieldDetails($condition_arr = [],$search_params = ""){
        
        $this->db->select('f.*,ua.user_name as added_by,uu.user_name as updated_by');
        $this->db->from('form_field_master f');
        $this->db->join('userinfo as ua','ua.id = f.added_by','left');
        $this->db->join('userinfo as uu','uu.id = f.updated_by','left');
        if (!empty($search_params['value'])) {
            $keyword = $search_params['value'];
            $this->db->group_start(); // Start a group of OR conditions
    
            $fields = [
                'f.form_title', 'f.form_name','f.form_type','f.field_type','f.form_value','f.prefix','f.length',
                'ua.user_name','uu.user_name'
                // Add more fields if needed
            ];
    
            foreach ($fields as $field) {
                $this->db->or_like($field, $keyword);
            }
    
            $this->db->group_end(); // End the group of OR conditions
        }

        if (count($condition_arr) > 0) {
            $this->db->limit($condition_arr["length"], $condition_arr["start"]);
            if ($condition_arr["order_by"] != "") {
                $this->db->order_by($condition_arr["order_by"]);
            }else{
                $this->db->order_by("f.form_field_master_id","DESC");
            }
        }
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        // pr($this->db->last_query(),1);
        return $ret_data;
    }

    public function getFieldDetailsCount($condition_arr = [],$search_params = ""){
        
         $this->db->select('COUNT(f.form_field_master_id) as total_record');
        $this->db->from('form_field_master f');
        $this->db->join('userinfo as ua','ua.id = f.added_by','left');
        $this->db->join('userinfo as uu','uu.id = f.updated_by','left');
        // if (!empty($search_params['value'])) {
        //     $keyword = $search_params['value'];
        //     $this->db->group_start(); // Start a group of OR conditions
    
        //     $fields = [
        //         'cpt.po_number', // Replace 'some_field' with actual fields in 'customer_po_tracking' you want to search
        //         'c.customer_name',
        //         // Add more fields if needed
        //     ];
    
        //     foreach ($fields as $field) {
        //         $this->db->or_like($field, $keyword);
        //     }
    
        //     $this->db->group_end(); // End the group of OR conditions
        // }

        if (count($condition_arr) > 0) {
            $this->db->limit($condition_arr["length"], $condition_arr["start"]);
            if ($condition_arr["order_by"] != "") {
                $this->db->order_by($condition_arr["order_by"]);
            }
        }
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->row_array() : [];
        // pr($this->db->last_query(),1);
        return $ret_data;
    }

    /* dyanamic form creation */
    public function checkDublicateUrl($page_url = ""){
        $this->db->select('sm.*');
        $this->db->from('school_matser as sm');
        $this->db->where("url",$page_url);
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->row_array() : [];
        return $ret_data;
    }
    public function getFormJson($page_url = ""){
        $this->db->select('sm.*');
        $this->db->from('school_matser as sm');
        $this->db->where("url",$page_url);
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->row_array() : [];
        return $ret_data;
    }
    public function insertFormData($insert_date = array()){
        $this->db->insert("form_data_collection", $insert_date);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    public function getFormJsonData($school_id = ""){
        $this->db->select('sm.*');
        $this->db->from('school_matser as sm');
        $this->db->where("school_id",$school_id);
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->row_array() : [];
        return $ret_data;
    }
    public function getFormCollectionData($from_data_collection_id = 0){
        $this->db->select('fdc.*');
        $this->db->from('form_data_collection as fdc');
        $this->db->where("fdc.form_data_collection_id",$from_data_collection_id);
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->row_array() : [];
        return $ret_data;
    }
    public function getSchoolFormCollectionData($school_id = 0,$from_data_id = 0){
        
        $this->db->select('fdc.*');
        $this->db->from('form_data_collection as fdc');
        $this->db->where("fdc.school_master_id",$school_id);
        if($from_data_id > 0){
            $this->db->where("fdc.form_data_collection_id",$from_data_id); 
        }
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }
    public function checkFormFieldUnique($form_name = "",$id = 0){
        $this->db->select('fdc.*');
        $this->db->from('form_field_master as fdc');
        $this->db->where("fdc.form_name",$form_name);
        if($id > 0){
            $this->db->where("fdc.form_field_master_id !=",$id);
        }
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }
    public function insertFormField($insert_date = array()){
        $this->db->insert("form_field_master", $insert_date);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    public function updateFormField($update_data, $id) {
        $this->db->where('form_field_master_id', $id);
        $this->db->update('form_field_master', $update_data);
        return true;
    }

    public function getFormDetails($condition_arr = [],$search_params = "",$school_id = ""){
        $this->db->select('fd.*');
        $this->db->from('form_data_collection as fd');
        $this->db->where("fd.school_master_id",$school_id);
        if (count($condition_arr) > 0) {
            $this->db->limit($condition_arr["length"], $condition_arr["start"]);
            if (!empty($search_params['value'])) {
                $keyword = $search_params['value'];
                $this->db->group_start(); 
        
                $fields = [
                    'fd.form_data'
                ];
        
                foreach ($fields as $field) {
                    $this->db->or_like($field, $keyword);
                }
        
                $this->db->group_end(); // End the group of OR conditions
            }
        }
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        // pr($this->db->last_query(),1);
        return $ret_data;
    }
    public function getSchoolFormCollectionDataCount($school_id = 0){
        
        $this->db->select('COUNT(fdc.form_data_collection_id) as count');
        $this->db->from('form_data_collection as fdc');
        $this->db->where("fdc.school_master_id",$school_id);
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->row_array() : [];
        return $ret_data;
    }
    public function get_school_data(){
        
        $this->db->select('sm.*,COUNT(fdc.school_master_id) as total_record');
        $this->db->from('school_matser sm');
        $this->db->join('form_data_collection as fdc','fdc.school_master_id = sm.school_id','left');
        $this->db->group_by('fdc.school_master_id');
        $result_obj = $this->db->get();
        $ret_data = is_object($result_obj) ? $result_obj->result_array() : [];
        return $ret_data;
    }


    
    
}
