<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blogs extends MY_Controller { 
    public $layout_view = "layout/web";
    private $page_type = "blog";
    public function __construct() {
        parent::__construct();
        
        $this->data = array();
    }
    
    public function index($page_no=1){
        $this->load->module("main/pages_main");
        $response = $this->pages_main->get_blog_pages($this->post_data,true,$page_no);
        $count = 0;
        if($response["flag"]==FLAG_SUCCESS){
            $this->data["records"] = $response["data"];
            $count = $response["count"];
        }
        
        $base_url = base_url("{$this->controller_name}");
        $default_count = (int)$this->post_data['per_page_count'] ? (int)$this->post_data['per_page_count'] : DEFAULT_RECORDS_PAGELIMIT;
       
        $config = pagination_array($count,$default_count,$base_url,$page_no,true);
        $this->pagination->initialize($config);
        $this->data["links"] = $this->pagination->create_links();
        $this->layout->view("{$this->module_name}/{$this->controller_name}/index",$this->data);
    }

    public function view($slug){
        $this->load->module("main/pages_main");
        $response = $this->pages_main->get_blog_page("",$slug);
        if($response["flag"]==FLAG_SUCCESS && $response["data"]["status"]==ACTIVE) {
            $this->data['record'] = $response["data"];
            $this->layout->meta(stripcslashes($this->data["record"]["meta_title"]));
            $this->layout->meta_keywords(stripcslashes($this->data["record"]["meta_keywords"]));
            $this->layout->meta_description(stripcslashes($this->data["record"]["meta_description"]));
            $this->layout->meta_image($this->data["record"]["cover_image_url"]);
            $this->layout->view("{$this->module_name}/{$this->controller_name}/view",$this->data);
        }else{
            error($this->lang->line("message_no_records"));
            redirect($this->base_url);
        }
    }
}