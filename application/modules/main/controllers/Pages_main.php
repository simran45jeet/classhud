<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pages_main extends MY_Controller 
{ 
    public function __construct() {
        parent::__construct();    
    }
    
    public function submit_enquiry($post_data,$enquiry_type,$call_from=CART_FROM_WEB) {
        $this->form_validation->set_rules("name",$this->lang->line("heading_full_name"),"required|is_not_empty");
        $this->form_validation->set_rules("phone_no",$this->lang->line("heading_mobile_no"),"required|is_not_empty|min_length[".PHONE_MIN_LENGTH."]|max_length[".PHONE_MAX_LENGTH."]");
        $this->form_validation->set_rules("description",$this->lang->line("heading_description"),"required|is_not_empty");
        
        if( $this->form_validation->run() ) {
            $insert_data = $this->_set_posted_enquiry_data($post_data,$enquiry_type,$call_from);
            $this->load->model("enquiry_model","enquiry");

            if( $this->enquiry->insert($insert_data) ){
                $response = array("flag"=>FLAG_SUCCESS,"message"=>$this->lang->line("message_contact_us_submit_success") );
            }else{
                $response = array("flag"=>FLAG_SUCCESS,"message"=>$this->lang->line("message_try_again"),"error_array"=>$this->lang->line("message_try_again") );
            }
        }else{
            $response = array("flag"=>FLAG_ERROR,"message"=>implode("\n",$this->form_validation->error_array()),"error_array"=>$this->form_validation->error_array() );
        }
        return $response ;
    }
    
    public function get_blog_pages($post_data=array(),$pagination=true,$page_no=1) {
        $this->load->model("blogs_model","blogs");
        
        $records = $this->blogs->get_records($post_data,$pagination,$page_no);
        if( !empty($records["records"]) ){
            foreach( $records["records"] as $key=>&$blog_data ) {
                $blog_data["image_url"] = base_url(BASE_PAGES_IMAGES_PATH.$blog_data["image"] );
                $blog_data["short_description"] = stripcslashes($blog_data["short_description"]);
                $blog_data["description"] = stripcslashes($blog_data["description"]);
            }
            $response = array("flag"=>FLAG_SUCCESS,"data"=>$records["records"],"count"=>$records["count"]);
        }else{
            $response = array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_no_records"));
        }
        return $response;
    }
    public function get_blog_page($encoded_id="",$slug="") {
        $this->load->model("blogs_model","blogs");
        $edited_id = decrypt($encoded_id);
        
        $record = $this->blogs->get_record($edited_id,$slug);
        $blog_data = $record["record"];
        
        if( !empty($blog_data) ){
            $blog_data["image_url"] = base_url(BASE_PAGES_IMAGES_PATH.$blog_data["image"] );
            $blog_data["short_description"] = stripcslashes($blog_data["short_description"]);
            $blog_data["description"] = stripcslashes($blog_data["description"]);
            $response = array("flag"=>FLAG_SUCCESS,"data"=>$blog_data);
        }else{
            $response = array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_no_records"));
        }
        return $response;
    }
    private function _set_posted_enquiry_data($post_data,$enquiry_type){
        $items = array("name","email","phone_no","description","subject");
        $data = elements($items, $post_data);
        $data["created_at"] = SQL_ADDED_DATE;
        $data["created_by"] = $this->user_data["id"];
        $data["ip_address"] = getVisitorIp();
        
        return $data;
    }
    
}