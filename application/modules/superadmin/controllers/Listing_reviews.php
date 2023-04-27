<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Listing_reviews extends MY_Controller 
{
    public $layout_view = "layout/".SUPERADMIN;
    
    /**
     * Construct
     */
    public function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model("listing_model","listing");
        $this->load->model("listing_reviews_model","listing_reviews");
        $this->data['controller_name'] = $this->controller_name;
        $this->data['title'] = $this->lang->line("heading_listing_review_title");
        $post_data = array("only_active"=>true);
        
    }

    
    
    public function index($page_no=1){
        $this->data["main_form_url"] = superadmin_url("{$this->controller_name}/index");
        
        $this->data["post_data"] = $post_data = $this->get_data;
        $post_data["all_records"] = true;
        $records = $this->listing_reviews->get_records($post_data,true,$page_no);
        
        $config = pagination_array($count,$default_count,$base_url,$page_no,true);
        $this->pagination->initialize($config);
        $this->data["links"] = $this->pagination->create_links();
        $this->data["records"] = $records['records'];
        $this->data["count"] = $records['count'];
        $this->data["start_record"] = ($page_no-1)*$default_count;
        $this->layout->view("{$this->module_name}/{$this->controller_name}/index",$this->data);
    }
    
    public function edit($edited_id){
        $this->data['title'] = $this->lang->line("heading_listing_review_title");
        $this->data["main_form_url"] = superadmin_url("{$this->controller_name}/edit/{$edited_id}");
        $review_id = decrypt($edited_id);
        $this->load->model("listing_claim_request_model","listing_claim_request");
        $record = $this->listing_reviews->get_record($review_id)["record"];
        
        if( !empty($record) ) {
            if( !empty($this->post_data) ){
                $this->load->module("main/listing_main");
                $response = $this->listing_main->edit_institute_review($edited_id,$this->post_data);
                if($response["flag"]==FLAG_SUCCESS){
                    success($response["message"]);
                    redirect(superadmin_url($this->controller_name));
                }else{
                    error($response["message"]);
                }
                $this->data["post_data"] = $this->post_data;
            }else{
                $this->load->model("review_categories_rating_model","review_categories_rating");
                $cateories_review = $this->review_categories_rating->get_records($review_id,array(),false)["records"]; 
                foreach($cateories_review as $key=>$cateory_review) {
                    $record["category_rating_id"][] = encrypt($cateory_review["id"]);
                    $record["review_category"][] = encrypt($cateory_review["category_id"]);
                    $record["category_review"][] = $cateory_review["rating"];
                    $record["review_category_name"][] = $cateory_review["category_name"];
                }
                $this->data["post_data"] = $record;
            }
            if( !empty($this->post_data) ) {
                $this->form_validation->set_rules("request_status",$this->lang->line("heading_status"),"required|is_not_empty");
                if( $this->form_validation->run() ) {
                    $this->listing_claim_request->reject_other_request($record["listing_id"],$claim_request_id);
                    $this->listing_claim_request->change_status($claim_request_id,$this->post_data["request_status"]);
                    if(  $this->post_data["request_status"] == LISTING_CLAIM_REQUEST_APPROVED ) {
                        $this->listing->claim_listing_approve($record["listing_id"],$record["user_id"]);
                    }
                    success($this->lang->line("message_update_success"));
                    redirect( superadmin_url("{$this->controller_name}"));
                }else{
                    error( implode("<br/>",$this->form_validation->error_array()) );
                }
            }
            $this->layout->view("{$this->module_name}/{$this->controller_name}/edit",$this->data);
        }else{
            redirect( superadmin_url("{$this->controller_name}"));
        }

    }
    
    public function delete($edited_id){
        $review_id = decrypt($edited_id);
        $this->listing_reviews->delete_record( $review_id );
        success($this->lang->line("message_delete_success"));
        redirect(superadmin_url($this->controller_name));
    }
}
