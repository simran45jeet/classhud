<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Orders extends MY_Controller 
{
    public $layout_view = "layout/".SUPERADMIN;
    private $page_type = PAGE_TYPES_BLOG;
    
    /**
     * Construct
     */
    public function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model("orders_model","orders");
        
        $this->data['controller_name'] = $this->controller_name;
        $this->data['title'] = $this->lang->line("heading_orders_title");
    }

    public function index($page_no=1){
        $post_data = $this->get_data;
        
        $records = $this->orders->get_records($post_data,true,$page_no);
        
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
        
        $this->data["main_form_url"]=superadmin_url("{$this->controller_name}/add");
        $this->data['title'] = $this->lang->line("heading_blog_add_title");
        $this->data['image_required'] = true;
        $this->data["blog_categories"] = $this->blog_categories->get_records(array(),false)["records"];
        
        if( !empty($this->post_data) ) {
            $this->form_validation->set_rules("name",$this->lang->line("heading_name"),"required|is_not_empty");
            $this->form_validation->set_rules("author_name",$this->lang->line("heading_blog_author_title"),"required|is_not_empty");
            $this->form_validation->set_rules("description",$this->lang->line("heading_description"),"required|is_not_empty");
            
            if( $this->form_validation->run() ) {
                $error = false;
                $file_name = get_upload_image_name($this->post_data["name"],"image","blogs","image")['file_name'];
                $image = "";
                if( !empty($file_name) ) {
                    $file_name_response = fileUpload(BASE_PAGES_IMAGES_PATH, "", "image","",false,$file_name);
                    
                    if( $file_name_response["success"]==true ) {
                        $image = $file_name_response["filename"];
                    }else{
                        $error = true;
                    }
                }
            }
            if($error == false ) {
                $insert_data = $this->_get_posted_data($this->post_data);
                $insert_data["image"] = $image;
                $blog_id = $this->blogs->insert($insert_data);
                if( !empty($blog_id) ) {
                    success($this->lang->line("message_insert_success"));
                    redirect(superadmin_url("{$this->controller_name}/index"));
                }else{
                    error($this->lang->line("message_try_again"));
                }
            }else{
                $this->data["post_data"] = $this->post_data;
            }
        }
        
        $this->layout->view("{$this->module_name}/{$this->controller_name}/form",$this->data);
    }
    
    public function edit($encoded_id){
        $edited_id = decrypt($encoded_id);
        $this->load->module("main/order_main");
        $record = $this->order_main->get_all_order_products(0,0,false,array("order_id"=>$edited_id));
        
        __print($record) ;
        $this->layout->view("{$this->module_name}/{$this->controller_name}/edit",$this->data);
    }
    
}
