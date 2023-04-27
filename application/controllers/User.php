<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends MY_Controller { 
    public $layout_view = "layout/dashboard_web";
    
    public function __construct() {
        parent::__construct();
        $this->data = array("module_name"=>$this->module_name,"controller_name"=>$this->controller_name);
        $this->load->module("main/listing_main");
        $this->load->module("main/users_main");
        
        $user_menu_response = $this->users_main->user_dashboard_menus(encrypt($this->user_data["id"]));
        if( $user_menu_response["flag"]==FLAG_SUCCESS ){
            $this->data["dashboard_menus"] = $user_menu_response["data"];
        }
        $this->load->model("users_model","users");
        $this->data["user_data"] = $this->users->get_record($this->user_data["id"])["record"];
        $this->data["user_data"]["id"] = encrypt($this->data["user_data"]["id"]);
    }
    
    public function my_listing($page_no=1){
        $this->load->module("main/listing_main");
        $post_data = $this->post_data;
        $post_data["user_id"] = encrypt($this->user_data["id"]);
        $repsponse = $this->listing_main->get_user_listing($post_data["user_id"]);
        $this->data["records"] = $repsponse["flag"]==FLAG_SUCCESS ? $repsponse["data"] : array();
        $this->layout->view("{$this->module_name}/{$this->controller_name}/my_listing",$this->data);
    }
    
    public function edit_listing_request( $encoded_id ) {
        
        $this->load->module("main/listing_main");
        $this->load->model("organization_types_model","organization_types");
        $this->load->model("country_model","country");
        $this->load->model("state_model","state");
        $this->load->model("social_media_model","social_media");
        $this->load->model("amenities_model","amenities");
        $this->load->model("phone_code_model","phone_code");
        $post_data = array("only_active"=>true);
        
        $this->data["cover_image_required"]=$this->data["logo_required"]=false;
        $response = $this->listing_main->get_record($encoded_id);
        if( $response["flag"]==FLAG_SUCCESS ) {
            if( !empty($this->post_data) ) {
                $this->post_data["listing_id"]=$response["data"]["id"];
                $response = $this->listing_main->add_new_listing($this->post_data,false,$encoded_id);
                if( $response["flag"]==FLAG_SUCCESS ) {
                    success($response["message"]);
                    redirect( base_url("dashboard") );
                }else{
                    error(response["message"]);
                }
            }
            
            $this->data["organization_types"] = $this->organization_types->get_records($post_data,false)["records"];
            $this->data["phone_codes"] = $this->phone_code->get_records($post_data,false)["records"];
            $this->data["countries"] = $this->country->get_records($post_data,false)["records"];
            $this->data["states"] = $this->state->get_records(decrypt($response["data"]["country"]),$post_data,false)["records"];
            
            if(!empty($response["data"]["state"])) {
                $this->load->model("city_model","city");
                $this->data["cities"] = $this->city->get_records(decrypt($response["data"]["country"]),decrypt($response["data"]["state"]),$post_data,false)["records"];
    
            }
            $this->data["social_medias"] = $this->social_media->get_records($post_data,false)["records"];
            $this->data["amenities"] = $this->amenities->get_records($post_data,false)["records"];
            $this->data["week_days"] = $this->lang->line("heading_week_days");


            if( !empty($response["data"]["listing_amenities"]) ) {
                foreach( $response["data"]["listing_amenities"] as $key=> $listing_amenity ) {
                    $response["data"]["amenities"][] = $listing_amenity;
                }
            }
            if( !empty($response["data"]["social_media"]) ){
                $listing_social_medias = $response["data"]["social_media"];
                unset($response["data"]["social_media"]);
                foreach( $listing_social_medias as $key=>$listing_social_media ) {
                    $response["data"]["add_social_media"][] = $listing_social_media["username"];
                    $response["data"]["social_media"][] = $listing_social_media["social_media"];
                    $response["data"]["social_media_id"][] = $listing_social_media["id"];
                }
            }

            if( !empty($response["data"]["timming"]) ){
                foreach($response["data"]["timming"] as $day_no => $timming_arr ) {
                    foreach($timming_arr  as $timming_id => $timming_data ) {
                        $response["data"]["timming_id"][$day_no][]=$timming_id;
                        $response["data"]["start_time"][$day_no][]=$timming_data["start_time"];
                        $response["data"]["end_time"][$day_no][]=$timming_data["end_time"];
                    }   
                }
            }
            if( !empty($response["data"]["listing_phone"]) ){
                foreach( $response["data"]["listing_phone"] as $listing_phone_id=>$listing_phone ) {
                    $response["data"]["listing_phone_id"][]=$listing_phone_id;
                    $response["data"]["phone_no"][]=$listing_phone["phone_no"];
                }
            }
            $this->data["main_form_url"] = base_url("{$this->controller_name}/edit_listing_request/{$encoded_id}");
            
            $this->data["post_data"] = $response["data"];
            $this->data["cover_image_required"]=$this->data["logo_required"]=false;
            $this->layout->view("{$this->module_name}/{$this->controller_name}/edit_listing_request",$this->data);
        }else{
            error($this->lang->line("message_no_records"));
            redirect(base_url("{$this->controller_name}/my_listing"));
        }
        
    }

    
    
    public function edit_listing( $encoded_id ) {
        
        $this->load->module("main/listing_main");
        $this->load->model("organization_types_model","organization_types");
        $this->load->model("country_model","country");
        $this->load->model("state_model","state");
        $this->load->model("social_media_model","social_media");
        $this->load->model("amenities_model","amenities");
        $this->load->model("phone_code_model","phone_code");
        $post_data = array("only_active"=>true);
        $this->data["cover_image_required"]=$this->data["logo_required"]=false;
        $response = $this->listing_main->get_record($encoded_id);
        if( $response["flag"]==FLAG_SUCCESS ) {
            if( !empty($this->post_data) ) {
                $this->post_data["listing_id"]=$response["data"]["id"];
                $response = $this->listing_main->edit_listing($this->post_data,$encoded_id);
                if( $response["flag"]==FLAG_SUCCESS ) {
                    success($response["message"]);
                    redirect( base_url("dashboard") );
                }else{
                    error($response["message"]);
                }
            }
            
            $this->data["organization_types"] = $this->organization_types->get_records($post_data,false)["records"];
            $this->data["phone_codes"] = $this->phone_code->get_records($post_data,false)["records"];
            $this->data["countries"] = $this->country->get_records($post_data,false)["records"];
            $this->data["states"] = $this->state->get_records(decrypt($response["data"]["country"]),$post_data,false)["records"];
            
            if(!empty($response["data"]["state"])) {
                $this->load->model("city_model","city");
                $this->data["cities"] = $this->city->get_records(decrypt($response["data"]["country"]),decrypt($response["data"]["state"]),$post_data,false)["records"];
    
            }
            $this->data["social_medias"] = $this->social_media->get_records($post_data,false)["records"];
            $this->data["amenities"] = $this->amenities->get_records($post_data,false)["records"];
            $this->data["week_days"] = $this->lang->line("heading_week_days");


            if( !empty($response["data"]["listing_amenities"]) ) {
                foreach( $response["data"]["listing_amenities"] as $key=> $listing_amenity ) {
                    $response["data"]["amenities"][] = $listing_amenity;
                }
            }
            if( !empty($response["data"]["social_media"]) ){
                $listing_social_medias = $response["data"]["social_media"];
                unset($response["data"]["social_media"]);
                foreach( $listing_social_medias as $key=>$listing_social_media ) {
                    $response["data"]["add_social_media"][] = $listing_social_media["username"];
                    $response["data"]["social_media"][] = $listing_social_media["social_media"];
                    $response["data"]["social_media_id"][] = $listing_social_media["id"];
                }
            }

            if( !empty($response["data"]["timming"]) ){
                foreach($response["data"]["timming"] as $day_no => $timming_arr ) {
                    foreach($timming_arr  as $timming_id => $timming_data ) {
                        $response["data"]["timming_id"][$day_no][]=$timming_id;
                        $response["data"]["start_time"][$day_no][]=$timming_data["start_time"];
                        $response["data"]["end_time"][$day_no][]=$timming_data["end_time"];
                    }   
                }
            }
            if( !empty($response["data"]["listing_phone"]) ){
                foreach( $response["data"]["listing_phone"] as $listing_phone_id=>$listing_phone ) {
                    $response["data"]["listing_phone_id"][]=$listing_phone_id;
                    $response["data"]["phone_no"][]=$listing_phone["phone_no"];
                }
            }
            $this->data["main_form_url"] = base_url("{$this->controller_name}/edit_listing/{$encoded_id}");
            
            $this->data["post_data"] = $response["data"];
            $this->data["cover_image_required"]=$this->data["logo_required"]=false;
            $this->layout->view("{$this->module_name}/{$this->controller_name}/edit_listing",$this->data);
        }else{
            error($this->lang->line("message_no_records"));
            redirect(base_url("{$this->controller_name}/my_listing"));
        }
        
    }
}