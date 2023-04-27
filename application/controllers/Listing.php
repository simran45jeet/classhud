<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Listing extends MY_Controller { 
    public $layout_view = "layout/web";
    
    public function __construct() {
        parent::__construct();
        $this->data = array("module_name"=>$this->module_name,"controller_name"=>$this->controller_name);
        $this->load->model("phone_code_model","phone_code");
    }
    
    public function index(){
        $this->load->module("main/listing_main");
        $post_data = $this->post_data;
        $post_data["only_active"]=true;
        $post_data["request_status"]=LISTING_REQUEST_STATUS_APPROVED;
        $post_data["sort_by"] = "distance";
        $post_data["sort"] = "asc";
        $post_data["per_page_count"] = HOMEPAGE_RECORDS_PAGELIMIT;
        
        $this->form_validation->set_rules("latitude",$this->lang->line("heading_latitude"),"required|is_not_empty|numeric");
        $this->form_validation->set_rules("longitude",$this->lang->line("heading_longitude"),"required|is_not_empty|numeric");
        if( $this->form_validation->run() ) {
            $response = $this->listing_main->get_records($post_data);
        }
        if( $response["flag"]==FLAG_SUCCESS ) {
            $this->data["records"] = $response["data"];
        }
        if( isAjax() ){
            $this->load->view("{$this->module_name}/{$this->controller_name}/index",$this->data);
        }else{
            //echo 'asdasdasd';            
            $this->layout->view("{$this->module_name}/{$this->controller_name}/index",$this->data);
        }
        
    }
    
    public function add(){
        $this->load->model("organization_types_model","organization_types");
        $this->load->model("country_model","country");
        $this->load->model("state_model","state");
        $this->load->model("social_media_model","social_media");
        $this->load->model("amenities_model","amenities");
        $post_data = array("only_active"=>true);
        $this->data["main_form_url"]=base_url("{$this->controller_name}/add");
        $this->data["organization_types"] = $this->organization_types->get_records($post_data,false)["records"];
        $this->data["phone_codes"] = $this->phone_code->get_records($post_data,false)["records"];
        $this->data["countries"] = $this->country->get_records($post_data,false)["records"];
        $this->data["cover_image_required"]=$this->data["logo_required"]=true;
        if( count($this->data["countries"])==1 ) {
            $this->data["states"] = $this->state->get_records($this->data["countries"][0]["id"],$post_data,false)["records"];
        }
        $this->data["social_medias"] = $this->social_media->get_records($post_data,false)["records"];
        $this->data["amenities"] = $this->amenities->get_records($post_data,false)["records"];
        $this->data["week_days"] = $this->lang->line("heading_week_days");
        $this->data["referral_code"] = true;
        if( !empty($this->post_data) ) {
            $this->load->module("main/listing_main");
            $post_data = $this->post_data;
            $post_data["draf_listing_cover_image"] = $post_data["draf_listing_logo"] = "";
            $response = $this->listing_main->add_new_listing($this->post_data);
            
            if( $response["flag"]==FLAG_SUCCESS ) {
                success($response["message"]);
                redirect(base_url("dashboard"));
            }else{
                error( nl2br($response["message"]) );
                $this->data["post_data"] = $this->post_data;
            }
        }
        $this->layout->view("{$this->module_name}/{$this->controller_name}/add",$this->data);
    }
    
    public function all_listing(){
        $this->load->module("main/listing_main");
        $this->data["main_form_url"] = base_url("{$this->controller_name}/all_listing");
        $post_data = $this->post_data;
        $this->data["post_data"] = $post_data;
        $post_data["only_active"]=true;
        $this->data["listing_types"] = $this->listing_main->get_listing_types($post_data,false)["data"];
        $this->layout->view("{$this->module_name}/{$this->controller_name}/all_listing",$this->data);
    }
    
    public function detail( $slug ) {
        $this->load->module("main/listing_main");
        $this->load->model("phone_code_model","phone_code");
        $this->load->model("review_categories_model","review_categories");
        $this->data["phone_codes"]=$this->phone_code->get_records(array(),false)["records"];
        $this->data["review_categories"] = $this->review_categories->get_records(array(),false)["records"];
       
        $this->data['record'] = $this->listing_main->listing_main->get_record("",$slug)["data"];
        $this->layout->meta( $this->data["record"]["meta_title"] );
        $this->layout->meta_keywords($this->data["record"]["meta_keywords"]);
        $this->layout->meta_description($this->data["record"]["meta_description"]);
        $this->layout->meta_image($this->data["record"]["cover_image_url"]);

        if( empty($this->data['record']) ) {
            redirect($this->base_url);
        }else{
            $this->layout->view("{$this->module_name}/{$this->controller_name}/detail",$this->data);
        }
    }
    public function listing_review($slug,$page_no=1){
        $this->load->module("main/listing_main");
        $user_reviews = $this->listing_main->user_reviews($slug);
        if( $user_reviews["flag"]==FLAG_SUCCESS ) {
            $record["user_reviews"] = array(
                "records"=>$user_reviews["data"],
                "count"=>$user_reviews["count"],
                "total_pages"=>$user_reviews["total_pages"],
            );
        }
        $this->data["record"] = $record;
        
        if( isAjax() ) {
            $this->load->view("{$this->module_name}/{$this->controller_name}/review_list",$this->data);
        }
    }
    public function claim_listing( $slug ) {
        $this->load->module("main/listing_main");
        $post_data = $this->post_data;
        $response = $this->listing_main->claim_listing($slug,$post_data);
        if( $response["flag"]==FLAG_SUCCESS ){
            $response["url"] = base_url("listing/verify_claim/". encrypt("{$response["listing_id"]}_{$response["user_id"]}") );
            if( isAjax() ){
                outputJsonData($response);
            }else{
                success(nl2br($response["message"]));
                redirect($response["url"]);
            }
        }else{
            if( isAjax() ){
                outputJsonData($response);
            }else{
                error(nl2br($response["message"]));
                redirect($this->base_url);
            }
        }
    }
    
    public function verify_claim( $encoded_code ) {
        $arr = explode("_",decrypt($encoded_code));
        $listing_id = decrypt($arr[0]);
        $user_id = decrypt($arr[1]);
        $this->data["edited_id"] = $encoded_code;
        $this->data["main_form_url"] = base_url("{$this->controller_name}/verify_claim/{$encoded_code}");
        if( !empty($this->post_data) ){
            $this->load->module("main/listing_main");
            $post_data = array("listing_id"=>$arr[0],"user_id"=>$arr[1],"otp"=>$this->post_data["otp"]);
            $response = $this->listing_main->verify_claim($post_data);
            if( $response["flag"]==FLAG_SUCCESS ) {
                success($response["message"]);
                redirect($this->base_url);
            }else{
                error($response["message"]);
            }
        }
        $this->layout->view("{$this->module_name}/{$this->controller_name}/verify_claim",$this->data);
    }
    function resend_verify_claim_code($encoded_code){
        $arr = explode("_",decrypt($encoded_code));
        $listing_id = decrypt($arr[0]);
        $user_id = decrypt($arr[1]);
        $this->load->module("main/listing_main");
        $response = $this->listing_main->send_claim_request_code($listing_id,$user_id);
        if( $response["flag"]==FLAG_SUCCESS ) {
            success($response["message"]);
        }else{
            error($response["message"]);
        }
        redirect(base_url("{$this->controller_name}/verify_claim/{$encoded_code}"));
    }
    public function get_all_listing($page_no=1){
        $this->load->module("main/listing_main");
        $post_data = $this->post_data;
        $this->data["post_data"] = $post_data;
        $this->data["page_no"] = $page_no;
        $post_data["only_active"]=true;
        $post_data["request_status"]=LISTING_REQUEST_STATUS_APPROVED;
        $post_data["sort_by"] = "distance";
        $post_data["sort"] = "asc";
        $post_data["per_page_count"] = !empty($this->post_data["per_page_count"]) ? $this->post_data["per_page_count"] : DEFAULT_WEB_RECORDS_PAGELIMIT;
        
        $this->form_validation->set_rules("latitude",$this->lang->line("heading_latitude"),"required|is_not_empty|numeric");
        $this->form_validation->set_rules("longitude",$this->lang->line("heading_longitude"),"required|is_not_empty|numeric");
        if( $this->form_validation->run() ) {
            $response = $this->listing_main->get_records($post_data,$page_no);
        }
        
        
        if( $response["flag"]==FLAG_SUCCESS ) {
            $this->data["records"] = $response["data"];
        }
        $this->data["count"] = $response["count"];
        $this->data["total_pages"] = ceil($response["count"]/$post_data["per_page_count"]);
        $this->data["data"] = $this->load->view("{$this->module_name}/{$this->controller_name}/all_listing_result",$this->data,true);
        outputJsonData($this->data);
    }
    
    public function add_institute_review($slug) {
        $this->load->module("main/listing_main");
        $response = $this->listing_main->add_institute_review($slug,$this->post_data);
        if( $response["flag"]==FLAG_SUCCESS ) {
            success($response["message"]);
        }else{
            error($response["message"]);
        }
        $listing_data = $this->listing_main->get_record("",$slug)["data"];
        
        redirect(base_url("best/".strtolower($listing_data["listing_type_name"])."/{$listing_data["slug"]}/".strtolower($listing_data["city_name"])) );
        
    }
    
    public function listing_ecard($slug){
        $this->load->module("main/listing_main");
        $listing_response = $this->listing_main->get_listing_ecard_data($slug);
        
        if( $listing_response["flag"]==FLAG_SUCCESS ){
            $this->data["record"]=$listing_response["data"];
            $this->data["show_map"]=true;
            $this->load->view("{$this->module_name}/{$this->controller_name}/listing_ecard",$this->data);
        }else{
            $this->layout->view("{$this->module_name}/error/error_404");
        }
        
    }
    
}