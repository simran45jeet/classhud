<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Enquiry extends MY_Controller 
{
    public $layout_view = "layout/".SUPERADMIN;
    
    public function __construct() {
        parent::__construct();
        $this->data = array();
        $this->data['controller_name'] = $this->controller_name;
        
    }

    public function contact_us( $page_no=1  ){
        $this->data['title'] = $this->lang->line("heading_contact_us_enquiry_title");
        $this->load->model("enquiry_model","enquiry");
        $this->data["main_form_url"] = superadmin_url("{$this->controller_name}/contact_us");
        $this->data["records"] = $this->enquiry->contact_us_enquiry($this->get_data,true,$page_no)["records"];
        $this->data["post_data"] = $this->get_data;
        $this->layout->view("{$this->module_name}/{$this->controller_name}/contact_us",$this->data);
    }

    public function edit_contact_enquiry( $encoded_id  ){
        
        $this->load->model("phone_code_model","phone_code");
        $this->data["phone_codes"] = $this->phone_code->get_records($post_data,false)["records"];
        $this->data['title'] = $this->lang->line("heading_contact_us_enquiry_title");
        $this->load->model("enquiry_model","enquiry");
        $this->data["main_form_url"] = superadmin_url("{$this->controller_name}/edit_contact_enquiry/{$encoded_id}");
        
        $record = $this->enquiry->get_contact_us_enquiry(decrypt($encoded_id))["record"];
        $this->data["post_data"] = $record;
        $this->data["post_data"]["phone_code"] = encrypt($record["phone_code"]);
        if( !empty($this->post_data) ) {
            $this->enquiry->update( array("enquiry_status"=>$this->post_data["enquiry_status"]),decrypt($encoded_id) );  
            success($this->lang->line("message_update_success"));
            redirect( superadmin_url("{$this->controller_name}/contact_us") );
        }
        $this->layout->view("{$this->module_name}/{$this->controller_name}/edit_contact_enquiry",$this->data);
    }
    
    public function delete_contact_enquiry( $encoded_id  ){
        $this->load->model("enquiry_model","enquiry");
        $this->enquiry->update( array("is_deleted"=>DELETED),decrypt($encoded_id) );  
        success($this->lang->line("message_delete_success"));
        redirect( superadmin_url("{$this->controller_name}/contact_us") );
        
    }
}
