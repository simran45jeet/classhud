<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Listing_request extends MY_Controller 
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
        $this->data['title'] = $this->lang->line("heading_staff");
        $this->load->model("organization_types_model","organization_types");
        $this->load->model("country_model","country");
        $this->load->model("social_media_model","social_media");
        $this->load->model("phone_code_model","phone_code");
        $this->load->model("state_model","state");
        $this->load->model("city_model","city");
        $this->load->model("amenities_model","amenities");
        $this->load->model("listing_tags_model","listing_tags");
        $post_data = array("only_active"=>true);
        
        $this->data["organization_types"] = $this->organization_types->get_records($post_data,false)["records"];
        $this->data["phone_codes"] = $this->phone_code->get_records($post_data,false)["records"];
        $this->data["countries"] = $this->country->get_records($post_data,false)["records"];
        $this->data["social_medias"] = $this->social_media->get_records($post_data,false)["records"];
        $this->data["week_days"] = $this->lang->line("heading_week_days");
        
        $this->data["countries"] = $this->country->get_records($post_data,false)["records"];
        
    }

   
    public function index($page_no=1){
        $this->data["title"] = $this->lang->line("heading_listing_request");
        $this->data["main_form_url"] = superadmin_url("{$this->controller_name}/index");
        $records = $this->listing->get_request_list($this->post_data,$page_no)["records"];
        $this->data["records"] = $records;
        $this->layout->view("{$this->module_name}/{$this->controller_name}/index",$this->data);   
    }
   
    
    
    public function edit($edited_id){
        $this->data["title"] = $this->lang->line("heading_edit_listing");
        $this->data["main_form_url"] = superadmin_url("{$this->controller_name}/edit/{$edited_id}");
        $this->load->module("main/listing_main");
        $listing_id = decrypt($edited_id);
        $this->data["amenities"] = $this->amenities->get_records(array("only_action"=>true),false)["records"];

        $record = $this->listing_main->get_record($edited_id);        
        if( $record["flag"]!=FLAG_SUCCESS ) {
            error($this->lang->line("message_no_records"));
            redirect(superadmin_url("{$this->controller_name}/request"));
        }else{
            
            if( !empty($record["data"]["listing_amenities"]) ) {
                foreach( $record["data"]["listing_amenities"] as $key=> $listing_amenity ) {
                    $record["data"]["amenities"][] = $listing_amenity;
                }
            }
            if( !empty($record["data"]["social_media"]) ){
                $listing_social_medias = $record["data"]["social_media"];
                unset($record["data"]["social_media"]);
                foreach( $listing_social_medias as $key=>$listing_social_media ) {
                    $record["data"]["add_social_media"][] = $listing_social_media["username"];
                    $record["data"]["social_media"][] = $listing_social_media["social_media"];
                    $record["data"]["social_media_id"][] = $listing_social_media["id"];
                }
            }else{
                $record["data"]["add_social_media"][] = "";
                $record["data"]["social_media"][] = "";
                $record["data"]["social_media_id"][] = "";
            }

            if( !empty($record["data"]["timming"]) ){
                foreach($record["data"]["timming"] as $day_no => $timming_arr ) {
                    foreach($timming_arr  as $timming_id => $timming_data ) {
                        $record["data"]["timming_id"][$day_no][]=$timming_id;
                        $record["data"]["start_time"][$day_no][]=$timming_data["start_time"];
                        $record["data"]["end_time"][$day_no][]=$timming_data["end_time"];
                    }   
                }
            }
            if( !empty($record["data"]["listing_phone"]) ){
                foreach( $record["data"]["listing_phone"] as $listing_phone_id=>$listing_phone ) {
                    $record["data"]["listing_phone_id"][]=$listing_phone_id;
                    $record["data"]["phone_code"][]=$listing_phone["phone_code"];
                    $record["data"]["phone_no"][]=$listing_phone["phone_no"];
                }
            }
            $data = $record["data"];
            
            if( !empty($data["listing_amenities"]) ) {
                foreach( $data["listing_amenities"] as $key=>$listing_amenity ) {
                    $this->data["listing_amenities"][]=decrypt($listing_amenity);
                }
            }
            
            if( !empty($this->post_data) ) {
                $this->load->module("main/listing_main");
                $post_data = $this->post_data;
                $tags_array = json_decode($this->input->post("tags"),true);
                if( !empty($tags_array) ) {
                    $post_data["tags"] = implode(",", array_column($tags_array, "value") );
                }else{
                    $post_data["tags"] = "";
                }
                $post_data["listing_id"] = $listing_id;
                if( !empty($post_data["listing_social_media"]) ) {
                    foreach($post_data["listing_social_media"] as $key=>$listing_social_media){
                        $post_data["add_social_media"][]=$listing_social_media["add_social_media"];
                        $post_data["social_media"][]=$listing_social_media["social_media"];
                        $post_data["social_media_id"][]=$listing_social_media["social_media_id"];
                    }
                }
                
                $response = $this->listing_main->add_new_listing($post_data,true,$edited_id);
                if( $response["flag"]==FLAG_SUCCESS ) {
                    success($response["message"]);
                    redirect(superadmin_url("{$this->controller_name}/index"));
                }else{
                    error($response["message"]);
                }
            }
            
            if( !empty($data["country"]) ) {
                $this->data["states"] = $this->state->get_records(decrypt($data["country"]),array(),false)["records"];
            }
            if( !empty($data["state"]) ) {
                $this->data["cities"] = $this->city->get_records(decrypt($data["country"]),decrypt($data["state"]),array(),false)["records"];
            }
            if( empty($data['social_media']) ) {
                $data['social_media'] = array();
            }
            
            $this->data["post_data"] = $data;
            $this->layout->view("{$this->module_name}/{$this->controller_name}/edit",$this->data);   
        }
    }
    
    public function delete($edited_id){ 
        $listing_id = decrypt($edited_id);
        $this->listing->update(array("is_deleted"=>DELETED),$listing_id);
        success($this->lang->line("message_delete_success"));
        redirect(superadmin_url($this->controller_name));
    }
}
