<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category extends MY_Controller { 
    public $layout_view = "layout/web";
    
    public function __construct() {
        parent::__construct();
        $this->data = array("module_name"=>$this->module_name,"controller_name"=>$this->controller_name);
        $this->load->model("phone_code_model","phone_code");
    }
    
    public function category_listing($slug){
        $this->load->module("main/listing_main");
        $this->data["main_form_url"] = base_url("category/category_listing/{$slug}");
        $post_data = $this->post_data;
        $post_data["listing_type_slug"] = $slug;
        $this->data["hide_listing_type_filter"] = true;
        
        $this->data["post_data"] = $post_data;
        $this->data["listing_types"] = $this->listing_main->get_listing_types($post_data,false)["data"];
        $this->layout->view("{$this->module_name}/listing/all_listing",$this->data);
    }
    
    
}