<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blog_caregories extends MY_Controller 
{
    public $layout_view = "layout/".SUPERADMIN;
    private $type = PAGE_CATEGORIES_TYPES_BLOG;
    /**
     * Construct
     */
    public function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model("blog_categories_model","blog_categories");
        $this->data['controller_name'] = $this->controller_name;
        $this->data['title'] = $this->lang->line("heading_blogs_title");
    }

    public function index($page_no=1){
        $post_data = $this->get_data;
        $post_data["all_records"]=true;
        $records = $this->blog_categories->get_records($post_data,true,$page_no);    
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
        $this->data['title'] = sprintf($this->lang->line("heading_add_title"),$this->lang->line("heading_blog_category_title"));
        $this->data['image_required'] = true;
        $this->data["blog_categories"] = $this->blog_categories->get_records(array(),false)["records"];
        
        if( !empty($this->post_data) ) {
            $this->form_validation->set_rules("name",$this->lang->line("heading_name"),"required|is_not_empty");
            $this->form_validation->set_rules("description",$this->lang->line("heading_description"),"required|is_not_empty");
            
            if( $this->form_validation->run() ) {
                $insert_data = $this->_get_posted_data($this->post_data);
                
                $blog_id = $this->blog_categories->insert($insert_data);
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
        $record = $this->blog_categories->get_record($edited_id)["record"];

        $this->data["main_form_url"]=superadmin_url("{$this->controller_name}/edit/{$encoded_id}");
        $this->data['title'] = sprintf($this->lang->line("heading_edit_title"),$this->lang->line("heading_blog_category_title"));
        if( !empty($this->post_data) ) {
            $this->form_validation->set_rules("name",$this->lang->line("heading_name"),"required|is_not_empty");
            $this->form_validation->set_rules("description",$this->lang->line("heading_description"),"required|is_not_empty");
            
            if( $this->form_validation->run() ) {
                $insert_data = $this->_get_posted_data($this->post_data,$edited_id);
                
                $blog_id = $this->blog_categories->update($insert_data,$edited_id);
                if( !empty($blog_id) ) {
                    success($this->lang->line("message_update_success"));
                    redirect(superadmin_url("{$this->controller_name}/index"));
                }else{
                    error($this->lang->line("message_try_again"));
                }
            }else{
                $this->data["post_data"] = $this->post_data;
            }
        }else{
            $record["category"] = encrypt($record["category"]);
            $this->data["post_data"] = $record;
        }
        
        $this->layout->view("{$this->module_name}/{$this->controller_name}/form",$this->data);
    }
    
    public function delete($encoded_id){
        $edited_id = decrypt($encoded_id);
        $this->blog_categories->update(array("is_deleted"=>DELETED),$edited_id);
        success($this->lang->line("message_delete_success"));
        redirect(superadmin_url("{$this->controller_name}/index"));
        
    }
    private function _get_posted_data( $post_data,$edited_id=null ) {
        $items = array("name","description","status","sort_order");
        
        $data = elements($items, $post_data);
        $data["description"]=$this->input->post("description");
        if( empty($edited_id) ) {
            $data["created_by"] = $this->user_data["id"];
            $data["created_at"] = SQL_ADDED_DATE;
            $data["ip_address"] = getVisitorIp();
            $data["type"] = $this->type;
        }else{
            $data["modified_by"] = $this->user_data["id"];
            $data["modified_at"] = SQL_ADDED_DATE;
        }
        return $data;
        
        
    }
}
