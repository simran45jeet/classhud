<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Controller {

    public $layout_view = "layout/web";

    public function __construct() {
        parent::__construct();
        $this->data = array("module_name"=>$this->module_name,"controller_name"=>$this->controller_name);
    }

    public function privacy_policy() {
        $this->layout->view("{$this->module_name}/{$this->controller_name}/privacy_policy", $this->data);
    }

    public function terms_conditions() {
        $this->layout->view("{$this->module_name}/{$this->controller_name}/terms_conditions", $this->data);
    }

    public function contact_us() {
        $this->data["main_form_url"] = base_url("{$this->controller_name}/contact_us");
        $this->load->module("main/pages_main");
        $response = $this->pages_main->submit_enquiry($this->post_data,ENQUIRY_TYPE_CONTACT_US);
        if( $response["flag"]==FLAG_SUCCESS ) {
            success($response["message"]);
            redirect(base_url("contact-us"));
        }else{
            error($response["message"]);
        }
        $this->layout->view("{$this->module_name}/{$this->controller_name}/contact", $this->data);
    }

    public function benefits() {
        $this->layout->view("{$this->module_name}/{$this->controller_name}/benefits", $this->data);
    }

    public function about() {
        $this->layout->view("{$this->module_name}/{$this->controller_name}/about", $this->data);
    }
    
    public function error_404(){
        
        $this->layout->view("{$this->module_name}/error/error_404", $this->data);
    }

}
