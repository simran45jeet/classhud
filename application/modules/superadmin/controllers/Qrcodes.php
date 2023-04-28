<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Qrcodes extends MY_Controller {
    public $layout_view = "layout/".SUPERADMIN;
    
    /**
     * Construct
     */
    public function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model("qrcodes_model","qrcodes");
        $this->data['controller_name'] = $this->controller_name;
        $this->data['title'] = $this->lang->line("heading_qrcodes_title");
    }

    public function index($page_no=1){
        $post_data = $this->get_data;
        $records = $this->qrcodes->get_records($post_data,true,$page_no);
        $count = $records['count'];
        $base_url = superadmin_url("{$this->controller_name}/index");
        $default_count = (int)$this->post_data['per_page_count'] ? (int)$this->post_data['per_page_count'] : DEFAULT_RECORDS_PAGELIMIT;
       
        $config = pagination_array($count,$default_count,$base_url,$page_no,true);
        $this->pagination->initialize($config);
        $this->data["links"] = $this->pagination->create_links();
        $this->data["records"] = $records['records'];
        $this->data["count"] = $records['count'];
        $this->data["start_record"] = ($page_no-1)*$default_count;
        $this->data["post_data"] = $post_data;
        $this->layout->view("{$this->module_name}/{$this->controller_name}/index",$this->data);
    }
    
    public function add(){
        $this->load->module("main/qrcode_main");
        if( !empty($this->post_data) ) {

            $insert_data = $this->qrcode_main->generate_qrcode($this->post_data);
            
            if( $insert_data["flag"]==FLAG_SUCCESS ) {
                success($insert_data["message"]);
                redirect(superadmin_url("{$this->controller_name}/index"));
            }else{
                error($insert_data["message"]);
            }
        }else{
            redirect( superadmin_url("{$this->controller_name}/index"));
        }
        
//        $this->layout->view("{$this->module_name}/{$this->controller_name}/form",$this->data);
    }
    
    
        
}
