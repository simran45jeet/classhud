<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Claim_listing extends MY_Controller 
{
    public $layout_view = "layout/".SUPERADMIN;
    
    /**
     * Construct
     */
    public function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model("listing_model","listing");
        $this->data['controller_name'] = $this->controller_name;
        $this->data['title'] = $this->lang->line("heading_listing");
        $this->load->model("organization_types_model","organization_types");
        $this->load->model("country_model","country");
        $this->load->model("social_media_model","social_media");
        $this->load->model("phone_code_model","phone_code");
        $this->load->model("state_model","state");
        $this->load->model("city_model","city");
        $this->load->model("amenities_model","amenities");
        $post_data = array("only_active"=>true);
        
        $this->data["organization_types"] = $this->organization_types->get_records($post_data,false)["records"];
        $this->data["phone_codes"] = $this->phone_code->get_records($post_data,false)["records"];
        $this->data["countries"] = $this->country->get_records($post_data,false)["records"];
        $this->data["social_medias"] = $this->social_media->get_records($post_data,false)["records"];
        $this->data["week_days"] = $this->lang->line("heading_week_days");
        
        $this->data["countries"] = $this->country->get_records($post_data,false)["records"];
        
    }

    
    
    public function index($page_no=1){
        $this->data["main_form_url"] = superadmin_url("{$this->controller_name}/claim_listing_request");
        $this->load->model("listing_claim_request_model","listing_claim_request");
        $post_data = $this->post_data;
        $post_data["request_status"] = !empty($post_data["request_status"]) ? $post_data["request_status"] : LISTING_CLAIM_REQUEST_REQUESTED;
        $records = $this->listing_claim_request->get_records($post_data,true,$page_no);
        $config = pagination_array($count,$default_count,$base_url,$page_no,true);
        $this->pagination->initialize($config);
        $this->data["links"] = $this->pagination->create_links();
        $this->data["records"] = $records['records'];
        $this->data["count"] = $records['count'];
        $this->data["start_record"] = ($page_no-1)*$default_count;
        $this->layout->view("{$this->module_name}/{$this->controller_name}/index",$this->data);
    }
    
    public function edit($encoded_id){
        $this->data['title'] = $this->lang->line("heading_claim_listing_edit_title");
        $this->data["main_form_url"] = superadmin_url("{$this->controller_name}/edit/{$encoded_id}");
        $claim_request_id = decrypt($encoded_id);
        $this->load->model("listing_claim_request_model","listing_claim_request");
        $record = $this->listing_claim_request->get_record($claim_request_id)["record"];
        $record["phone_code"] = encrypt($record["phone_code"]);
        if( !empty($record) ) {
            $this->data["post_data"] = $record;
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
}
