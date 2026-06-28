<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Form extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Form_model');
        require_once(APPPATH.'libraries/tcpdf/tcpdf.php');
    }
    
    

    public function form_creation()
    {
        $data = [];
        $data['field_data'] = $this->Form_model->getFieldData();
        $this->smarty->loadView('form.tpl', $data,'Yes','Yes');
    }

    public function formListing()
    {
        $column[] = [
            "data" => "image",
            "title" => "Image",
            "width" => "8%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "name",
            "title" => "Name",
            "width" => "10%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "url",
            "title" => "Url",
            "width" => "10%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "total_record",
            "title" => "Total Data Collection",
            "width" => "10%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "status",
            "title" => "Status",
            "width" => "5%",
            "className" => "status dt-center",
        ];
        $column[] = [
            "data" => "action",
            "title" => "Action",
            "width" => "6%",
            "className" => "dt-left",
        ];
        
        $data["data"] = $column;
        $data["is_searching_enable"] = true;
        $data["is_paging_enable"] = true;
        $data["is_serverSide"] = true;
        $data["is_ordering"] = true;
        $data["is_heading_color"] = "#a18f72";
        $data["no_data_message"] =
            '<div class="p-3 no-data-found-block"><img class="p-2" src="' .
            base_url() .
            'public/assets/images/images/no_data_found_new.png" height="150" width="150"><br> No Employee data found..!</div>';
        $data["is_top_searching_enable"] = true;
        $data["sorting_column"] = json_encode([[11, 'desc']]);
        $data["page_length_arr"] = [[10,100,500,1000], [10,100,500,1000]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();
        $this->smarty->loadView('form_listing.tpl', $data,'Yes','Yes');
    }

    public function formListingData(){
        $post_data = $this->input->post();
        
        $column_index = array_column($post_data["columns"], "data");
        $order_by = "";
        foreach ($post_data["order"] as $key => $val) {
            if ($key == 0) {
                $order_by .= $column_index[$val["column"]] . " " . $val["dir"];
            } else {
                $order_by .=
                    "," . $column_index[$val["column"]] . " " . $val["dir"];
            }
        }
        $condition_arr["order_by"] = $order_by;
        $condition_arr["start"] = $post_data["start"];
        $condition_arr["length"] = $post_data["length"];
        $base_url = $this->config->item("base_url");
        $data = $this->Form_model->getSchoolData($condition_arr,$post_data["search"]);
        foreach ($data as $key => $val) {
            $data[$key]['image'] = "<img src='".base_url($val['image'])."' alt='' width='75' height='75' title='College Logo'>";
            $data[$key]['url'] = base_url("/form/".$val['url']);
            $data[$key]['action'] = '
                <span title="View">
                    <a href="'.base_url().'data_collection_list/'.$val['school_id'].'">
                        <i class="ti ti-eye"></i>
                    </a>
                </span>
        
                <span class="copy-text">
                      <i class="ti ti-copy copy-url" title="Copy" data-url="'.base_url("/form/".$val['url']).'"></i>
                </span>
                <span class="delete-school" title="Delete" data-id="'.$val['school_id'].'">
                    <i class="ti ti-trash"></i>
                </span>
                <span class="status-school" title="Change Status" data-status="'.$val['status'].'" data-id="'.$val['school_id'].'">
                    <i class="ti ti-clock"></i>
                </span>
            ';
        }
        
        
        $data["data"] = $data;
        // pr($data,1);
        $total_record = $this->Form_model->getSchoolDataCount([], $post_data["search"]);
        $data["recordsTotal"] = $total_record['total_record'];
        $data["recordsFiltered"] = $total_record['total_record'];
        echo json_encode($data);
        exit();
    }
    public function delete_school(){
        $post_data = $this->input->post();
        $total_record = $this->Form_model->deleteSchoolData($post_data['school_id']);
        $ret_arr['messages'] = "Record deleted successfully.";
        $ret_arr['success'] = 1;
        echo json_encode($ret_arr);
        exit();
    }
    public function change_status(){
        $post_data = $this->input->post();
        $update_data = ["status"=>$post_data['status']];
        $this->Form_model->updateSchoolData($update_data,$post_data['school_id']);
        $ret_arr['messages'] = "Status updated successfully.";
        $ret_arr['success'] = 1;
        echo json_encode($ret_arr);
        exit();
    }
    
    public function dataCollectionList()
    {
        
        $school_id = $this->uri->segment(2);
        $form_data = $this->Form_model->getFormJsonData($school_id);
        $from_field = json_decode($form_data['from_field'],TRUE);
        $from_field = array_column($from_field, "field_data");
        $column = [];
        $file_column_exist = false;
        
        foreach ($from_field as $key => $value) {
            $value = json_decode($value,TRUE);
            $position = "dt-left";
            $width = "10%";
            if($value['form_type'] == "file"){
                $position = "dt-center";
                $width = "5%";
                $file_column_exist = true;
            }
            $column[] = [
                "data" => $value['form_name'],
                "title" => $value['form_title'],
                "width" => $width,
                "className" => "status ".$position,
                "formType" => $value['form_type']
            ];
        }
        
        if($file_column_exist){
            $column[] = [
                "data" => "action",
                "title" => "Action",
                "width" => "3%",
                "className" => "status dt-center"
            ];
        }
        usort($column, function($a, $b) {
            // Put "file" formType first
            if ($a['formType'] === 'file' && $b['formType'] !== 'file') {
                return -1;
            }
            if ($a['formType'] !== 'file' && $b['formType'] === 'file') {
                return 1;
            }
            return 0; // Otherwise, leave the order unchanged
        });
        array_unshift($column,[
                "data" => "sr_no",
                "title" => "Sr. No.",
                "width" => "3%",
                "className" => "status dt-center"
            ]);
        $data["data"] = $column;
        $data["is_searching_enable"] = true;
        $data["is_paging_enable"] = true;
        $data["is_serverSide"] = true;
        $data["is_ordering"] = false;
        $data["is_heading_color"] = "#a18f72";
        $data["no_data_message"] =
            '<div class="p-3 no-data-found-block"><img class="p-2" src="' .
            base_url() .
            'public/assets/images/images/no_data_found_new.png" height="150" width="150"><br> No Employee data found..!</div>';
        $data["is_top_searching_enable"] = true;
        $data["sorting_column"] = json_encode([[11, 'desc']]);
        $data["page_length_arr"] = [[10,100,500,1000], [10,100,500,1000]];
        $data["school_id"] = $school_id;
        $data["base_url"] = base_url();
        $this->smarty->loadView('data_collection_list.tpl', $data,'Yes','Yes');
    }

    public function form_data_listing(){
        $post_data = $this->input->post();
        $column_details = $post_data['data']['column_details'];
        $school_id = $post_data['data']['school_id'];
        $column_index = array_column($post_data["columns"], "data");
        $order_by = "";
        foreach ($post_data["order"] as $key => $val) {
            if ($key == 0) {
                $order_by .= $column_index[$val["column"]] . " " . $val["dir"];
            } else {
                $order_by .=
                    "," . $column_index[$val["column"]] . " " . $val["dir"];
            }
        }
        $condition_arr["order_by"] = $order_by;
        $condition_arr["start"] = $post_data["start"];
        $condition_arr["length"] = $post_data["length"];
        $base_url = $this->config->item("base_url");

        $form_data = $this->Form_model->getFormDetails($condition_arr,$post_data["search"],$school_id);
        $data = [];
        foreach ($form_data as $key => $value) {
            $form_data = json_decode($value['form_data'],TRUE);
            $row_value = [];
            foreach ($column_details as $ke => $val) {
                if($val['data'] == "sr_no"){
                    $row_value[$val['data']] = display_no_character($value[$val['data']]);
                }else if($val['formType'] == "file"){
                    $form_data[$val['data']] = $form_data[$val['data']] != "" ? $form_data[$val['data']] : base_url("public/assets/images/no-pictures.png");
                    $row_value[$val['data']] = "<img src='".base_url($form_data[$val['data']])."' alt='' width='75' height='75' title='College Logo'>" ;
                }else{
                    $row_value[$val['data']] = display_no_character($form_data[$val['data']]);
                }

                if($val['data'] == "action"){
                    $row_value[$val['data']] = '<a class="me-2" href="'.base_url('download_images/').$value['form_data_collection_id'].'"><i class="ti ti-photo-down" title="Download Images"></i>';
                    $row_value[$val['data']] .= '<a class="me-2" href="'.base_url('download_all_ids/').$value['school_master_id']."/".$value['form_data_collection_id'].'"><i class="ti ti-id-badge-2" title="Download Images"></i>';
                    $row_value[$val['data']] .= '<a class="me-2 preview-id" href="javascript:void(0)" data-href="'.base_url('preview_id_card/').$value['school_master_id']."/".$value['form_data_collection_id'].'"><i class="ti ti-eye" title="Download Images"></i>';
                }
                
            }
            $data[] = $row_value;
            # code...
        }

        $data["data"] = $data;
        $total_record = $this->Form_model->getFormDetails([], $post_data["search"],$school_id);
        $data["recordsTotal"] = count($total_record);
        $data["recordsFiltered"] = count($total_record);
        echo json_encode($data);
        exit();
    }

    public function download_images(){
        $from_data_collection_id = $this->uri->segment(2);
        $from_data_collection_data = $this->Form_model->getFormCollectionData($from_data_collection_id);
        $form_details = json_decode($from_data_collection_data['form_data'],TRUE);
        $form_data = $this->Form_model->getFormJsonData($from_data_collection_data['school_master_id']);
        $from_field = json_decode($form_data['from_field'],TRUE);
        $from_field = array_column($from_field, "field_data");
        $column = [];
        $file_column_exist = false;
        $images = [];
        foreach ($from_field as $key => $value) {
            $value = json_decode($value,TRUE);
            if($value['form_type'] == "file"){
                if($form_details[$value['form_name']] != ""){
                    $images[] = $form_details[$value['form_name']];
                }
            }
        }
        $this->load->helper('url');
        $this->load->helper('file');

        // Create a temporary directory to store the images
        $temp_dir = FCPATH . 'public/temp_images/';

        // Check if the directory exists, if not, create it
        if (!is_dir($temp_dir)) {
            mkdir($temp_dir, 0755, TRUE);
        }

        // Define the ZIP file name
        $zipFile = $temp_dir . "images.zip";
        error_log("ZIP path: " . $zipFile);

        // Create a new ZIP archive
        $zip = new ZipArchive();
        if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            die("Could not create ZIP file");
        }

        // Download and add files to ZIP
        foreach ($images as $index => $fileUrl) {
            $fileContents = @file_get_contents($fileUrl);
            if ($fileContents !== false) {
                $fileName = basename($fileUrl);
                $zip->addFromString($fileName, $fileContents);
            } else {
                error_log("Failed to download: $fileUrl");
            }
        }

        // Close the ZIP archive
        $zip->close();

        // Ensure the ZIP file was created
        if (file_exists($zipFile)) {
            // Set headers to force download
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . basename($zipFile) . '"');
            header('Content-Length: ' . filesize($zipFile));

            ob_clean();
            flush();
            readfile($zipFile);

            // Delete the ZIP file after download
            unlink($zipFile);
        } else {
            die("ZIP file not found: $zipFile");
        }


    }
    public function download_all_images(){
        $school_id = $this->uri->segment(2);
        $from_data_collection_data = $this->Form_model->getSchoolFormCollectionData($school_id);
        $form_data = $this->Form_model->getFormJsonData($school_id);
        $from_field = json_decode($form_data['from_field'],TRUE);
        $from_field = array_column($from_field, "field_data");
        $images_arr = [];
        foreach ($from_data_collection_data as $ke => $val) {
            $form_details = json_decode($val['form_data'],TRUE);
            $images = [];
            foreach ($from_field as $key => $value) {
                $value = json_decode($value,TRUE);
                if($value['form_type'] == "file"){
                    if($form_details[$value['form_name']] != ""){
                        $images[] = $form_details[$value['form_name']];
                    }
                }
            }
            $images_arr[$val['sr_no']] = $images;
        }


        
        $this->load->helper('url');
        $this->load->helper('file');

        // Create a temporary directory to store the images
        $temp_dir = FCPATH . 'public/temp_images/';

        // Check if the directory exists, if not, create it
        if (!is_dir($temp_dir)) {
            mkdir($temp_dir, 0755, TRUE);
        }

        // Define the ZIP file name
        $zipFile = $temp_dir . "all_images.zip";

        // Create a new ZIP archive
        $zip = new ZipArchive();
        if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            die("Could not create ZIP file");
        }

        foreach ($images_arr as $key => $value) {
            $folderName = $key . "/";
            $zip->addEmptyDir($folderName);
            
            // Download and add files to ZIP
            foreach ($value as $index => $fileUrl) {
                $fileContents = @file_get_contents($fileUrl); // Suppress errors
                if ($fileContents !== false) {
                    $fileName = basename($fileUrl);
                    $zip->addFromString($folderName . $fileName, $fileContents);
                } else {
                    error_log("Failed to download: $fileUrl");
                }
            }
        }

        // Close the ZIP archive
        $zip->close();

        // Ensure the ZIP file exists
        if (file_exists($zipFile)) {
            // Set headers to force download
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="all_images.zip"');
            header('Content-Length: ' . filesize($zipFile));
            
            ob_clean();
            flush();
            readfile($zipFile);

            // Delete the ZIP file after download
            unlink($zipFile);
        } else {
            die("ZIP file not found or creation failed.");
        }


    }
    
    public function url()
    {
        
        $fields = [
            'name',
            'father_name',
            'mother_name',
            'gender',
            'date_of_birth'
        ];
        
        $data['form_fields'] = $fields;
        // pr("ok");
        $this->smarty->loadView('url_info_form.tpl', $data,'No','No');
    }
    

    public function generateFromData()
    {

        $post_data = $this->input->post();
        
        $school_master_data = $this->Form_model->checkDublicateUrl($post_data['url']);
        
        if(count($school_master_data) == 0){
            $course_value = $post_data['course'];
            $section_value = $post_data['section'];

            $form_fileds = json_decode($post_data['form_fileds'],TRUE);
            $fields = $this->Form_model->getFieldData();
            $fields_id_wise = [];
            foreach ($fields as $key => $value) {
                $fields_id_wise[$value['form_field_master_id']] = $value;
            }
            $form_field_data = [];
            foreach ($form_fileds as $key => $value) {
                if($fields_id_wise[$value['field_id']]['form_name'] == "course" || $fields_id_wise[$value['field_id']]['form_name'] == "class"){
                    $fields_id_wise[$value['field_id']]['form_value'] = $course_value;
                }else if($fields_id_wise[$value['field_id']]['form_name'] == "section"){
                    $fields_id_wise[$value['field_id']]['form_value'] = $section_value;
                }

                $row = [
                    "required" => $value['requied'],
                    "field_data" => json_encode($fields_id_wise[$value['field_id']],TRUE)
                ];
                array_push($form_field_data, $row);
            }


            /* collage logo */
            $profileImageData = $_FILES["image"]["name"] != "" ? $_FILES["image"] : [];
            $config["upload_path"] = "public/uploads/school_image/";
            $config["allowed_types"] = "jpg|png|jpeg|png";
            $this->load->library("upload", $config);
            $upload_error_msg = "";
            $school_image = "";
            if (!empty($profileImageData)) {
                if (!$this->upload->do_upload("image")) {
                    $upload_error_msg = $error = [
                        "error" => $this->upload->display_errors(),
                    ];
                    $upload_error = 1;
                } else {
                    $upload_data = $this->upload->data();
                    $school_image = "public/uploads/school_image/".$upload_data['file_name'];
                }
            }

            /* template image */
            $profileImageData = $_FILES["template"]["name"] != "" ? $_FILES["template"] : [];
            $config["upload_path"] = "public/uploads/form_template_img/";
            createFolder($config["upload_path"]);
            $config["allowed_types"] = "jpg|png|jpeg|png";
            $this->load->library("upload", $config);
            $upload_error_msg = "";
            $template_image = [];
            if (!empty($profileImageData)) {
                if (!$this->upload->do_upload("image")) {
                    $template_error_msg = $error = [
                        "error" => $this->upload->display_errors(),
                    ];
                    $template_error = 1;
                } else {
                    $template_data = $this->upload->data();
                    $template_image = "public/uploads/form_template_img/".$template_data['file_name'];
                }
            }

            $ret_arr = [];
            $msg ='Something went wrong';
            $success = 0;
            $data = array(
                    'name' => $this->input->post('name'),
                    'image' => $school_image,
                    'url' => $this->input->post('url'),
                    'form_type' => $this->input->post('form_heder_type'),
                    "contact_person" => $post_data['contact_person'],
                    "mobile_number" => $post_data['mobile_number'],
                    "designation" => $post_data['designation'],
                    "display_template" => $template_image,
                    "course" => $post_data['course'],
                    "section" => $post_data['section'],
                    "house" => $post_data['house'],
                    'from_field' => json_encode($form_field_data,TRUE),
                    'added_date' => date("Y-m-d H:i:s"),
                    'added_by' => $this->session->userdata('user_id')
            );
            // pr($data,1);
            $inser_query = $this->Form_model->insertSchoolData($data);
            if ($inser_query) {
                if ($inser_query) {
                    $success = 1;
                    $msg = 'School date added successfully.';
                }
            }
        }else{
            $success = 0;
            $msg = 'URL must be unique.';
        }
        $ret_arr['redirect_url'] = base_url("form_listing");
        $ret_arr['messages'] = $msg;
        $ret_arr['success'] = $success;
        echo json_encode($ret_arr);
    }
    
    /* daynamic form creation */
    public function form(){
        $page_url = $this->uri->segment(2);

        $form_data = $this->Form_model->getFormJson($page_url);
        $data = [];
        if(is_valid_array($form_data)){
            $form_fields = json_decode($form_data['from_field'],TRUE);
            foreach ($form_fields as $key => $value) {
                $fields = json_decode($value['field_data'],TRUE);
                if($fields['form_type'] == "radio" || $fields['form_type'] == "drop_down"){
                    $fields['form_value'] = explode(",", $fields['form_value']);
                }
                $form_fields[$key]['field_data'] = $fields;
            }
            $data = [];
            $data['form_fields'] = $form_fields;
            $data['form_data'] = $form_data;
            $this->smarty->loadView('url_info_form.tpl', $data,'No','No');
        }else{
            $data = [];
            $this->smarty->loadView('page_not_found.tpl', $data,'No','No');
        }
        
    }
    public function submit_form(){
        
        $post_data = $this->input->post();
        $form_data = $this->Form_model->getFormJson($post_data['from_url']);
        $form_fields = json_decode($form_data['from_field'],TRUE);
        $image_arr = [];

        $form_data_collection_count = $this->Form_model->getSchoolFormCollectionDataCount($post_data['matser_id']);
        $form_data_collection_count_val = $form_data_collection_count['count'] > 0 ? $form_data_collection_count['count']+1 : 1;
        // pr($form_data_collection_count,1);
        $folderPath = "public/uploads/data_collection_img/" . $post_data['from_url'];
        if (!is_dir($folderPath) && $folderPath != "") {
            mkdir($folderPath, 0777, true);
        }
        foreach ($_FILES as $key => $value) {
            // Get the uploaded image
            $profileImageData = $_FILES[$key]["name"] != "" ? $_FILES[$key] : [];
            $fileName = $_FILES[$key]['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $_FILES[$key]["name"] = $post_data['from_url']."_".$form_data_collection_count_val.".".$fileExtension;
            $folderPath .= "/".$key;
            // Ensure the folder exists, if not, create it
            if (!is_dir($folderPath) && $folderPath != "") {
                mkdir($folderPath, 0777, true);
            }
            // Set upload configuration
            $config["upload_path"] = $folderPath;
            $config["allowed_types"] = "jpg|png|jpeg";  // Allow jpg, png, and jpeg files
            $this->load->library("upload", $config);

            $upload_error_msg = "";
            if (!empty($profileImageData)) {
                
                if (!$this->upload->do_upload($key)) {
                    // If upload fails, store the error message
                    $upload_error_msg = $error = [
                        "error" => $this->upload->display_errors(),
                    ];
                    $upload_error = 1;
                    $image_arr[$key] = "";
                } else {
                    // Upload successful, get the uploaded file data
                    $upload_data = $this->upload->data();
                    $uploadedFilePath = $folderPath . "/" . $upload_data['file_name'];

                    // Convert image to JPG if it's PNG or JPEG
                    $fileType = strtolower(pathinfo($uploadedFilePath, PATHINFO_EXTENSION));
                    if ($fileType == 'png' || $fileType == 'jpeg') {
                        $newFilePath = $folderPath . "/" . pathinfo($upload_data['file_name'], PATHINFO_FILENAME) . '.jpg';

                        // Load the image depending on its type
                        if ($fileType == 'png') {
                            $image = imagecreatefrompng($uploadedFilePath);
                        } elseif ($fileType == 'jpeg') {
                            $image = imagecreatefromjpeg($uploadedFilePath);
                        }

                        // Save the image as JPG
                        imagejpeg($image, $newFilePath, 90); // Save with 90% quality
                        imagedestroy($image); // Free memory

                        // Delete the original uploaded PNG/JPEG file
                        unlink($uploadedFilePath);

                        // Update the image path to the new JPG
                        $image_arr[$key] = $newFilePath;
                    } else {
                        // If already JPG, just use the uploaded file
                        $image_arr[$key] = $uploadedFilePath;
                    }
                }
            }
        }


        $form_data_json = [];
        foreach ($form_fields as $key => $value) {
            $field_data = json_decode($value['field_data'],TRUE);
            if($field_data['form_type'] != "file"){
                $form_data_json[$field_data['form_name']] = $post_data[$field_data['form_name']] != "" ? $post_data[$field_data['form_name']] : "";
            }else{
                $form_data_json[$field_data['form_name']] = $image_arr[$field_data['form_name']] != "" ? $image_arr[$field_data['form_name']] : "";
            }
        }

        $insert_data = [
            "school_master_id" => $post_data['matser_id'],
            "sr_no" => $form_data_collection_count_val,
            "form_data" => json_encode($form_data_json,TRUE),
            "added_date" => date("Y-m-d H:i:s")
        ];
        // pr($post_data,1);
        $inser_query = $this->Form_model->insertFormData($insert_data);
        $msg = "Something went wrong";
        $success = 0;
        if ($inser_query) {
            if ($inser_query) {
                $success = 1;
                $msg = 'Form submited successfully.';
            }
        }
        $ret_arr['messages'] = $msg;
        $ret_arr['success'] = $success;
        echo json_encode($ret_arr);
        exit();
    }

    public function generate_id_card_pdf()
    {
        
        $school_id = $this->uri->segment(2);
        $data = $this->Form_model->getSchoolFormCollectionData($school_id);
        // pr($data,1);

        // pr($grn_data,1);
        $path = dirname(dirname(__DIR__)) . "/public/uploads/compan.pdf";
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetMargins(4, 7, 4, 4);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(true);
        // set font
        $pdf->SetFont('helvetica', '', 10);
        // add a page
        $pdf->AddPage();
        $data['data'] = $data;
        $html = $this->load->view('generate_id_card_pdf.tpl', $data, true);


        // $pdf->setCellPaddings( $left = '', $top = '2px', $right = '', $bottom = '2px');
        $pdf->writeHTML($html, true, 0, true, 0);
        // $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        $pdf->Output("Id_Cards.pdf", 'D');
    }

    public function formFieldListing()
    {
        $column[] = [
            "data" => "form_title",
            "title" => "Form Title",
            "width" => "10%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "form_type",
            "title" => "Form Type",
            "width" => "7%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "field_type",
            "title" => "Input Type",
            "width" => "7%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "form_value",
            "title" => "Input Value",
            "width" => "8%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "prefix",
            "title" => "Prefix",
            "width" => "5%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "length",
            "title" => "Length",
            "width" => "5%",
            "className" => "status dt-center",
        ];
         $column[] = [
            "data" => "added_by",
            "title" => "Added By",
            "width" => "8%",
            "className" => "status dt-center",
        ];
         $column[] = [
            "data" => "added_date",
            "title" => "Added Date",
            "width" => "8%",
            "className" => "status dt-center",
        ];
         $column[] = [
            "data" => "updated_by",
            "title" => "Updated By",
            "width" => "8%",
            "className" => "status dt-center",
        ];
         $column[] = [
            "data" => "updated_date",
            "title" => "Updated Date",
            "width" => "8%",
            "className" => "status dt-center",
        ];
        $column[] = [
            "data" => "action",
            "title" => "Action",
            "width" => "8%",
            "className" => "dt-left",
        ];
        
        $data["data"] = $column;
        $data["is_searching_enable"] = true;
        $data["is_paging_enable"] = true;
        $data["is_serverSide"] = true;
        $data["is_ordering"] = true;
        $data["is_heading_color"] = "#a18f72";
        $data["no_data_message"] =
            '<div class="p-3 no-data-found-block"><img class="p-2" src="' .
            base_url() .
            'public/assets/images/images/no_data_found_new.png" height="150" width="150"><br> No Employee data found..!</div>';
        $data["is_top_searching_enable"] = true;
        $data["sorting_column"] = json_encode([[11, 'desc']]);
        $data["page_length_arr"] = [[10,100,500,1000], [10,100,500,1000]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();
        $this->smarty->loadView('form_field_listing.tpl', $data,'Yes','Yes');
    }

    public function formFieldListingData(){
        $post_data = $this->input->post();
        
        $column_index = array_column($post_data["columns"], "data");
        $order_by = "";
        foreach ($post_data["order"] as $key => $val) {
            if ($key == 0) {
                $order_by .= $column_index[$val["column"]] . " " . $val["dir"];
            } else {
                $order_by .=
                    "," . $column_index[$val["column"]] . " " . $val["dir"];
            }
        }
        $condition_arr["order_by"] = $order_by;
        $condition_arr["start"] = $post_data["start"];
        $condition_arr["length"] = $post_data["length"];
        $base_url = $this->config->item("base_url");
        $data = $this->Form_model->getFieldDetails($condition_arr,$post_data["search"]);
        foreach ($data as $key => $val) {
            $data[$key]['prefix'] = display_no_character($val['prefix']);
            $data[$key]['field_type'] = display_no_character($val['field_type']);
            $data[$key]['form_value'] = display_no_character($val['form_value']);
            $data[$key]['length'] = $val['length'] > 0 ? $val['length'] : display_no_character();
            $data[$key]['updated_by'] = display_no_character($val['updated_by']);
            $data[$key]['updated_date'] = $val['updated_date'] != "" ? defaultDateFormat(date("Y-m-d", strtotime($val['updated_date']))) : display_no_character();
            $data[$key]['added_date'] = val['added_date'] != "" ? defaultDateFormat(date("Y-m-d", strtotime($val['added_date']))) : display_no_character();
            $row_data = base64_encode(json_encode($val));
            $data[$key]['action'] = '
                <span class="edit-field-row" title="Edit" data-row="'.$row_data.'">
                    <i class="ti ti-edit"></i>
                </span>
            ';
        }
        
        
        $data["data"] = $data;
        // pr($data,1);
        $total_record = $this->Form_model->getFieldDetailsCount([], $post_data["search"]);
        $data["recordsTotal"] = $total_record['total_record'];
        $data["recordsFiltered"] = $total_record['total_record'];
        echo json_encode($data);
        exit();
    }

    public function addUpdateFormField(){
        $post_data = $this->input->post();
        $id = $post_data['id'];
        $msg = "Something went wrong";
        $success = 0;
        if($id > 0){
            $update_date = [
                "form_title" => $post_data['form_title'],
                "form_name" => $post_data['form_name'],
                "form_type" => $post_data['form_type'],
                "field_type" => $post_data['field_type'],
                "form_value" => $post_data['form_value'],
                "prefix" => $post_data['prefix'],
                "length" => $post_data['length'],
                'updated_date' => date("Y-m-d H:i:s"),
                'updated_by' => $this->session->userdata('user_id')
            ];
            $inser_query = $this->Form_model->updateFormField($update_date,$id);
            if ($inser_query) {
                    $success = 1;
                    $msg = 'Form field updated successfully.';
            }
        }else{
            $insert_date = [
                "form_title" => $post_data['form_title'],
                "form_name" => $post_data['form_name'],
                "form_type" => $post_data['form_type'],
                "field_type" => $post_data['field_type'],
                "form_value" => $post_data['form_value'],
                "prefix" => $post_data['prefix'],
                "length" => $post_data['length'],
                'added_date' => date("Y-m-d H:i:s"),
                'added_by' => $this->session->userdata('user_id')
            ];
            $inser_query = $this->Form_model->insertFormField($insert_date);
            if ($inser_query) {
                    $success = 1;
                    $msg = 'Form field added successfully.';
            }
        }

        $ret_arr['messages'] = $msg;
        $ret_arr['success'] = $success;
        echo json_encode($ret_arr);
        exit();
    }

    public function download_all_ids(){
        $school_id = $this->uri->segment(2);
        $form_data_collection_id = $this->uri->segment(3) > 0 ? $this->uri->segment(3) : 0;
        $from_data_collection_data = $this->Form_model->getSchoolFormCollectionData($school_id,$form_data_collection_id);
        $form_data = $this->Form_model->getFormJsonData($school_id);
        $from_field = json_decode($form_data['from_field'],TRUE);
        $from_field = array_column($from_field, "field_data");
        $id_card_data = [];
        $data_collection = [];
        $arry_key = -1;

        foreach ($from_data_collection_data as $ke => $val) {
            $form_details = json_decode($val['form_data'],TRUE);
            $image_value = [];
            $other_data = [];
            foreach ($from_field as $key => $value) {
                $value = json_decode($value,TRUE);
                if($value['form_type'] == "file"){
                    if($form_details[$value['form_name']] != ""){
                        $image_value = base_url($form_details[$value['form_name']]);
                    }
                }else{
                        $other_data[] = [
                            "key" => $value['form_title'],
                            "value" => display_no_character($form_details[$value['form_name']])
                        ]; 
                    }
            }

            if($ke % 2 == 0){
                $arry_key += 1;
            }
            // if(array)
            $id_card_data[$arry_key][] = [
                "image" => $image_value,
                "other_data" => $other_data
            ];
        }
        $data['id_card_data'] = $id_card_data;
        $file_name = "id_cards.pdf";
        if($form_data_collection_id > 0){
            $file_name = "id_card.pdf";
        }
        $html = $this->smarty->fetch('pdf_generate.tpl', $data, TRUE);
        $this->generatePdf($html,"D",$file_name);
    }
    public function preview_id_card(){
        $school_id = $this->uri->segment(2);
        $form_data_collection_id = $this->uri->segment(3) > 0 ? $this->uri->segment(3) : 0;
        $from_data_collection_data = $this->Form_model->getSchoolFormCollectionData($school_id,$form_data_collection_id);
        $form_data = $this->Form_model->getFormJsonData($school_id);
        $from_field = json_decode($form_data['from_field'],TRUE);
        $from_field = array_column($from_field, "field_data");
        $id_card_data = [];
        $data_collection = [];
        $arry_key = -1;

        foreach ($from_data_collection_data as $ke => $val) {
            $form_details = json_decode($val['form_data'],TRUE);
            $image_value = [];
            $other_data = [];
            foreach ($from_field as $key => $value) {
                $value = json_decode($value,TRUE);
                if($value['form_type'] == "file"){
                    if($form_details[$value['form_name']] != ""){
                        $image_value = base_url($form_details[$value['form_name']]);
                    }
                }else{
                        $other_data[] = [
                            "key" => $value['form_title'],
                            "value" => display_no_character($form_details[$value['form_name']])
                        ]; 
                    }
            }

            if($ke % 2 == 0){
                $arry_key += 1;
            }
            // if(array)
            $id_card_data[$arry_key][] = [
                "image" => $image_value,
                "other_data" => $other_data
            ];
        }
        $data['id_card_data'] = $id_card_data;
        $html = $this->smarty->fetch('pdf_generate.tpl', $data, TRUE);
        $file_name = "id_card.pdf";
        $this->generatePdf($html,"I",$file_name);
    }
    public function generatePdf($html_content = "",$type="D",$file_name="id_card.pdf"){
        ob_start();
        require_once APPPATH . 'libraries/Pdf1.php';
        $pdf = new Pdf1('P', 'mm', 'A4', true, 'UTF-8', false,'',0,0,0, "");

        $pdf->SetMargins(0, $meddle_content, 0, 0);

        // set document information

        $pdf->SetCreator(PDF_CREATOR);

        // set default header data
        // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $pdf->AddPage(); // Left, Top, Right margins
        $pdf->SetAutoPageBreak(TRUE, 0); 
        $pdf->setPrintFooter(false);
        $pdf->SetFooterMargin(0);       

        $pdf->writeHTMLCell(0, 0, '', '', $html_content, 0, 0, 0, true, '', true);
        // $pdf->Output("id_card_fixed.pdf", 'D');

            $pdf->Output($file_name, $type);
             ob_end_flush();
       
        
       
    } 



}



