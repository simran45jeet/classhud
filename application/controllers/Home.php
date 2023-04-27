<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends MY_Controller { 
    public $layout_view = "layout/web";
    
    public  function __construct() {
        parent::__construct();
       $this->data = array("module_name"=>$this->module_name,"controller_name"=>$this->controller_name);
    }
    
    public function index(){
        $this->load->module("main/listing_main");
        $post_data = array("only_active"=>true);
        $this->data["listing_types"] = $this->listing_main->get_listing_types($post_data,false)["data"];
        $this->layout->view("{$this->module_name}/home/index",$this->data);
    }
   
}