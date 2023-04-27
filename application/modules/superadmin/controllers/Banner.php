<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Banner extends MY_Controller 
{
    public $layout_view = "layout/".SUPERADMIN;
    
    /**
     * Construct
     */
    public function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model("banners_model","banners");
        $this->load->model("banners_category_model","banners_category");
        $this->data['controller_name'] = $this->controller_name;
        $this->data['title'] = $this->lang->line("heading_banner_list_title");
    }

    public function index($page_no=1){
        $post_data = $this->get_data;
    
        $records = $this->banners->get_records($post_data,true,$page_no);    
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
        $this->data["banner_categories"] = $this->banners_category->get_records(array(),false)["records"];
        
        if( !empty($this->post_data) ) {
            $this->form_validation->set_rules("name",$this->lang->line("heading_name"),"required|is_not_empty");
            
            
            if( $this->form_validation->run() ) {
                $error = false;
                $file_name = get_upload_image_name($this->post_data["name"],"image","banners","image")['file_name'];
                $image = "";
                if( !empty($file_name) ) {
                    $file_name_response = fileUpload(BASE_BANNER_IMAGES_PATH, "", "image","",false,$file_name);
                    
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

                $banner_id = $this->banners->insert($insert_data);
                if( !empty($banner_id) ) {
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
        $record = $this->banners->get_record($edited_id)["record"];
        $this->data["main_form_url"]=superadmin_url("{$this->controller_name}/edit/{$encoded_id}");
        $this->data['title'] = sprintf($this->lang->line("heading_edit_title"),$this->lang->line("heading_banner_list_title"));
        $this->data["banner_categories"] = $this->banners_category->get_records(array(),false)["records"];
        $this->data['image_required'] = false;
        if( !empty($this->post_data) ) {
            $this->form_validation->set_rules("name",$this->lang->line("heading_name"),"required|is_not_empty");
            //$this->form_validation->set_rules("banner_category",$this->lang->line("heading_banner_category_title"),"required|is_not_empty");
//            $this->form_validation->set_rules("description",$this->lang->line("heading_description"),"required|is_not_empty");
            
            if( $this->form_validation->run() ) {
                $error = false;
                
                $insert_data = $this->_get_posted_data($this->post_data,$edited_id);
                if( !empty($_FILES["image"]["name"]) ) {
                    $file_name = get_upload_image_name($this->post_data["name"],"image","banners","image","id",$edited_id)['file_name'];
                    $image = "";
                    if( !empty($file_name) ) {
                        $file_name_response = fileUpload(BASE_BANNER_IMAGES_PATH, "", "image","",false,$file_name);

                        if( $file_name_response["success"]==true ) {
                            $image = $file_name_response["filename"];
                            $insert_data["image"] = $image;
                        }else{
                            $error = true;
                        }
                    }
                }
            }
            if( $error===false ) {

                $blog_id = $this->banners->update($insert_data,$edited_id);
                
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
            $record["banner_category"] = encrypt($record["banner_category"]);
            $this->data["post_data"] = $record;
        }
        
       
        $this->layout->view("{$this->module_name}/{$this->controller_name}/form",$this->data);
    }
    
    public function delete($encoded_id){
        $edited_id = decrypt($encoded_id);
        $this->blogs->update(array("is_deleted"=>DELETED),$edited_id);
        success($this->lang->line("message_delete_success"));
        redirect(superadmin_url("{$this->controller_name}/index"));
        
    }
    private function _get_posted_data( $post_data,$edited_id=null ) {
        $items = array("name","banner_category","description");
        $data = elements($items, $post_data);
        $data["description"] = trim(stripcslashes($data["description"]));
        $data["status"] = (int)$post_data["status"];
        $data["banner_category"] = (int)decrypt($post_data["banner_category"]);
        if( empty($edited_id) ) {
            $data["created_by"] = $this->user_data["id"];
            $data["created_at"] = SQL_ADDED_DATE;
            $data["ip_address"] = getVisitorIp();
        }else{
            $data["modified_by"] = $this->user_data["id"];
            $data["modified_at"] = SQL_ADDED_DATE;
        }
        return $data;
        
        
    }
}
