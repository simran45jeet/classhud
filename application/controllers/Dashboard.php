<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MY_Controller { 
    public $layout_view = "layout/dashboard_web";
    
    public function __construct() {
        parent::__construct();
        $this->data = array("module_name"=>$this->module_name,"controller_name"=>$this->controller_name);
        $this->load->module("main/listing_main");
        $this->load->module("main/users_main");
        
        $user_menu_response = $this->users_main->user_dashboard_menus(encrypt($this->user_data["id"]));
        if( $user_menu_response["flag"]==FLAG_SUCCESS ){
            $this->data["dashboard_menus"] = $user_menu_response["data"];
        }
        $this->load->model("users_model","users");
        $this->data["user_data"] = $this->users->get_record($this->user_data["id"])["record"];
        $this->data["user_data"]["id"] = encrypt($this->data["user_data"]["id"]);
    }
    
    public function index(){
        $post_data = array();
        $this->load->module("main/listing_main");
       
        $user_id = encrypt($this->user_data["id"]);
        $this->data["total_listing"] =  $this->listing_main->get_user_listing($user_id,$post_data)["count"];
        $post_data["request_status"] = LISTING_REQUEST_STATUS_APPROVED;
        $this->data["approved_listing"] = $this->listing_main->get_user_listing($user_id,$post_data)["count"];
        $post_data["request_status"] = LISTING_REQUEST_STATUS_DISAPPROVED;
        $this->data["disapproved_listing"] = $this->listing_main->get_user_listing($user_id,$post_data)["count"];
        $post_data["request_status"] = LISTING_REQUEST_STATUS_REQUESTED;
        $this->data["pending_listing"] = $this->listing_main->get_user_listing($user_id,$post_data)["count"];
        
        $this->layout->view("{$this->module_name}/{$this->controller_name}/index",$this->data)["count"];
    }    
    
    public function my_business(){
        $post_data = array();
        $user_id = encrypt($this->user_data["id"]);
        $repsponse =  $this->users_main->user_business_listing($user_id);
        $this->data["records"] = $repsponse["flag"]==FLAG_SUCCESS ? $repsponse["data"] : array();
        $this->layout->view("{$this->module_name}/{$this->controller_name}/my_business_listing",$this->data)["count"];
        
    }    
}