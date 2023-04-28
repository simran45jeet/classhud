<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Listing extends MY_Controller 
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
        $post_data = $this->get_data;
        $post_data["request_status"] = LISTING_REQUEST_STATUS_APPROVED;
        $post_data["all_records"] = true;
        
        $records = $this->listing->get_records($post_data,true,$page_no);
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
        $this->data['title'] = $this->lang->line("heading_listing_add_title");
        $this->data['add_draft'] = hasPermission($this->user_data['group_id'],"draft_listing.add",SUPERADMIN);        
        $this->data["organization_types"] = $this->organization_types->get_records($post_data,false)["records"];
        $this->data["phone_codes"] = $this->phone_code->get_records($post_data,false)["records"];
        $this->data["countries"] = $this->country->get_records($post_data,false)["records"];
        $this->data['claim_option']=true;
        if( count($this->data["countries"])==1 ) {
            $this->data["states"] = $this->state->get_records($this->data["countries"][0]["id"],$post_data,false)["records"];
        }
        $this->load->model("qrcodes_model","qrcodes");
        $this->data["qrcodes"] = $this->qrcodes->get_records(array("unused_code"=>true),false)["records"];
        
        $this->data["cover_image_required"]=$this->data["logo_required"]=true;
        $this->data["social_medias"] = $this->social_media->get_records($post_data,false)["records"];
        $this->data["amenities"] = $this->amenities->get_records($post_data,false)["records"];
        $this->data["referral_code"] = true;
        foreach( $this->data["amenities"] as $key=>$amenity_data ){
            $amenity["image"] = !empty($amenity_data["image"]) ? base_url(BASE_AMENITIES_IMAGE_PATH.$amenity_data["image"]) : "";
            $amenity["value"] = $amenity_data["id"];
            $amenity["name"] = $amenity_data["name"];
            $this->data["amenity_list"][]=$amenity;
        }
        $this->data["add_social_media"] = !empty($this->post_data["add_social_media"]) ? $this->post_data["add_social_media"] : array() ;
        $this->data["social_media"] = !empty($this->post_data["social_media"]) ? $this->post_data["social_media"] : array() ;
        $this->data["social_media_id"] = !empty($this->post_data["social_media_id"]) ? $this->post_data["social_media_id"] : array() ;
        $this->data["post_data"] = $this->post_data;
        
        if( !empty($this->post_data) ) {
            $this->load->module("main/listing_main");
            $post_data = $this->post_data;
            $tags_array = json_decode($this->input->post("tags"),true);
            if( !empty($tags_array) ) {
                $post_data["tags"] = implode(",", array_column($tags_array, "value") );
            }else{
                $post_data["tags"] = "";
            }
            if( !empty($this->post_data["listing_social_media"]) ) {
                foreach($this->post_data["listing_social_media"] as $key=>$listing_social_media){
                    $post_data["add_social_media"][]=$listing_social_media["add_social_media"];
                    $post_data["social_media"][]=$listing_social_media["social_media"];
                    $post_data["social_media_id"][]=$listing_social_media["social_media_id"];
                }
            }
            $this->data["post_data"] = $post_data;
            if( !empty($post_data["amenities"]) ) {
                $posted_amenities = json_decode($this->input->post("amenities"),true);
                $this->data["post_data"]["amenities"] = $post_data["amenities"] = array();
                
                foreach($posted_amenities as $key => $posted_amenity ) {
                    $post_data["amenities"][]=encrypt($posted_amenity["value"]);
                    $this->data["post_data"]["amenities"][]=$posted_amenity["value"]; 
                }
            }else{
                $post_data["amenities"] = array();
            }
            
            
            //$this->data["post_data"] = $post_data;
            $this->data["cities"] = $this->city->get_records(decrypt($post_data["country"]),decrypt($post_data["state"]),array(),false)["records"];
            
            $response = $this->listing_main->add_new_listing($post_data);
            if( $response["flag"]==FLAG_SUCCESS ) {
                success($this->lang->line("message_insert_success"));
                redirect(superadmin_url("{$this->controller_name}/index"));
            }else{
                success(nl2br($response["message"]));
            }
        }else{
            $this->data["post_data"]["add_social_media"] = $this->data["post_data"]["social_media_id"] = $this->data["post_data"]["social_media"] = array("");
            
            if( count($this->data["countries"])==1 ) {
                $this->data["post_data"]["country"] = encrypt($this->data["countries"][0]["id"]);
            }
        }
        
        $this->data["scripts"] = array(
            array(
                "src"=>"https://maps.googleapis.com/maps/api/js?key=".GOOGLE_LOCATION_API_KEY."&sensor=false&callback=initialize&libraries=places",
                "attributes"=>" async ",  
            )
        );
        $this->layout->view("{$this->module_name}/{$this->controller_name}/form",$this->data);
    }
    
    public function edit($edited_id){
        $this->data["main_form_url"]=superadmin_url("{$this->controller_name}/edit/{$edited_id}");
        $this->data['title'] = $this->lang->line("heading_edit_staff");
        $listing_id = decrypt($edited_id);
        $this->load->module("main/listing_main");
        $record = $this->listing_main->get_record($edited_id)['data'];
        if( !empty($record["qrcode_value"])  ) {
            
            $this->data["qrcodes"][] = $this->qrcodes->get_record($record["qrcode_value"])["record"];
        }else{
            $this->load->model("qrcodes_model","qrcodes");
            $this->data["qrcodes"] = $this->qrcodes->get_records(array("unused_code"=>true),false)["records"];
        }
        if(empty($record)) {
            error($this->lang->line('message_no_records'));
            redirect(superadmin_url("{$this->controller_name}"));
        }else{
            $this->data['title'] = sprintf( $this->lang->line("heading_edit_title"),$this->lang->line("heading_listing") );
            $this->data["organization_types"] = $this->organization_types->get_records($post_data,false)["records"];
            $this->data["phone_codes"] = $this->phone_code->get_records($post_data,false)["records"];
            $this->data["countries"] = $this->country->get_records($post_data,false)["records"];

            if( count($this->data["countries"])==1 ) {
                $this->data["states"] = $this->state->get_records($this->data["countries"][0]["id"],$post_data,false)["records"];
            }
            $this->data["cover_image_required"]=$this->data["logo_required"]=true;
            $this->data["social_medias"] = $this->social_media->get_records($post_data,false)["records"];
            $this->data["amenities"] = $this->amenities->get_records($post_data,false)["records"];
            foreach( $this->data["amenities"] as $key=>$amenity_data ){
                $amenity["image"] = !empty($amenity_data["image"]) ? base_url(BASE_AMENITIES_IMAGE_PATH.$amenity_data["image"]) : "";
                $amenity["value"] = $amenity_data["id"];
                $amenity["name"] = $amenity_data["name"];
                $this->data["amenity_list"][]=$amenity;
            }
            $this->data["add_social_media"] = !empty($this->post_data["add_social_media"]) ? $this->post_data["add_social_media"] : array() ;
            $this->data["social_media"] = !empty($this->post_data["social_media"]) ? $this->post_data["social_media"] : array() ;
            $this->data["social_media_id"] = !empty($this->post_data["social_media_id"]) ? $this->post_data["social_media_id"] : array() ;
            
            
            if( !empty($this->post_data) ) {
                $this->load->module("main/listing_main");
                
                $post_data = $this->post_data;
                $tags_array = json_decode($this->input->post("tags"),true);
                if( !empty($tags_array) ) {
                    $post_data["tags"] = implode(",", array_column($tags_array, "value") );
                }else{
                    $post_data["tags"] = "";
                }
                
                if( !empty($post_data["listing_social_media"]) ) {
                    foreach($post_data["listing_social_media"] as $key=>$listing_social_media){
                        $post_data["add_social_media"][]=$listing_social_media["add_social_media"];
                        $post_data["social_media"][]=$listing_social_media["social_media"];
                        $post_data["social_media_id"][]=$listing_social_media["social_media_id"];
                    }
                }
                if( !empty($post_data["amenities"]) ) {
                    $posted_amenities = json_decode( $this->input->post("amenities") ,true);
                    $post_data["amenities"] = array();
                    foreach($posted_amenities as $key => $posted_amenity ) {
                        $post_data["amenities"][]=encrypt($posted_amenity["value"]);
                    }
                }else{
                    $post_data["amenities"] = array();
                }
                $this->data["cities"] = $this->city->get_records(decrypt($post_data["country"]),decrypt($post_data["state"]),array(),false)["records"];
                $response = $this->listing_main->edit_listing($post_data,$edited_id);
                if( $response["flag"]==FLAG_SUCCESS ) {
                    success($this->lang->line("message_insert_success"));
                    redirect(superadmin_url("{$this->controller_name}/index"));
                }else{    
                    $this->data["post_data"] = $post_data;
                    if( empty($_FILES["logo"]["name"]) ) {
                        $this->data["post_data"]["logo"] = $record["logo"];
                    }
                    if( empty($_FILES["cover_image"]["name"]) ) {
                        $this->data["post_data"]["cover_image"] = $record["cover_image"];
                    }
                }
            }else{
                $this->data["cities"] = $this->city->get_records(decrypt($record["country"]),decrypt($record["state"]),array(),false)["records"];
                
                if( !empty($record["social_media"]) ) {
                    $listing_social_medias = $record["social_media"];
                    unset($record["social_media"]);
                    
                    foreach($listing_social_medias as $key=>$listing_social_media){
                        $record["add_social_media"][]=$listing_social_media["username"];
                        $record["social_media"][]=$listing_social_media["social_media"];
                        $record["social_media_id"][]=$listing_social_media["id"];
                    }
                }else{
                    $record["add_social_media"] = $record["social_media"] = $record["social_media_id"] = array("") ;
                }
                if( !empty($record["listing_amenities"]) ) {
                    foreach( $record["listing_amenities"] as $key=>$listing_amenity ) {
                        $record["amenities"][]=decrypt($listing_amenity);
                    }
                }
                
                if( !empty($record["timming"]) ){
                    foreach($record["timming"] as $day_no => $timming_arr ) {
                        foreach($timming_arr  as $timming_id => $timming_data ) {
                            $record["timming_id"][$day_no][]=$timming_id;
                            $record["start_time"][$day_no][]=$timming_data["start_time"];
                            $record["end_time"][$day_no][]=$timming_data["end_time"];
                        }   
                    }
                }
                if( !empty($record["listing_phone"]) ){
                    foreach( $record["listing_phone"] as $listing_phone_id=>$listing_phone ) {
                        $record["listing_phone_id"][]=$listing_phone_id;
                        $record["phone_code"][]=$listing_phone["phone_code"];
                        $record["phone_no"][]=$listing_phone["phone_no"];
                    }
                }
                
                
                $this->data["post_data"] = $record;
            }
            
            
        }
        $this->data["scripts"] = array(
            array(
                "src"=>"https://maps.googleapis.com/maps/api/js?key=".GOOGLE_LOCATION_API_KEY."&sensor=false&callback=initialize&libraries=places",
                "attributes"=>" async ",  
            )
        );
        
        $this->layout->view("{$this->module_name}/{$this->controller_name}/form",$this->data);
    }
    
    public function delete($edited_id){
        $listing_id = decrypt($edited_id);
        $this->listing->delete_record($listing_id);
        success($this->lang->line("message_delete_success"));
        redirect(superadmin_url($this->controller_name));
        
    }
    
    public function listing_users( $encoded_id,$page_no=1 ) {
        $listing_id = decrypt($encoded_id);
        $this->load->model("listing_users_model","listing_users");
        $post_data = $this->get_data;
        $post_data["all_records"]=true;
        $records = $this->listing_users->get_records($listing_id,$post_data,true,$page_no);
        $count = $records['count'];
        $base_url = superadmin_url("{$this->controller_name}/listing_users/{$encoded_id}");
        $this->data["main_form_url"]=$base_url;
        $this->data["post_data"]=$this->post_data;
        $this->data["edited_id"]=$encoded_id;
        $this->data["title"]=$this->lang->line("heading_listing_users_title");
        $default_count = (int)$this->post_data['per_page_count'] ? (int)$this->post_data['per_page_count'] : DEFAULT_RECORDS_PAGELIMIT;
       
        $config = pagination_array($count,$default_count,$base_url,$page_no,true);
        $this->pagination->initialize($config);
        $this->data["links"] = $this->pagination->create_links();
        $this->data["records"] = $records['records'];
        $this->data["count"] = $records['count'];
        $this->data["start_record"] = ($page_no-1)*$default_count;
        $this->data["post_data"] = $post_data;
        
        $this->layout->view("{$this->module_name}/{$this->controller_name}/listing_users",$this->data);
    }
    
    public function add_listing_users($encoded_id) {
        $listing_id = decrypt($encoded_id);
        $this->data["listing_data"] = $this->listing->get_record($listing_id)["record"];
        $this->data["title"] = $this->lang->line("heading_add_user_title");
        $this->data["edited_id"]=$encoded_id;
        if( !empty($this->post_data) ) {
            $this->form_validation->set_rules("user_id",$this->lang->line("heading_listing_user_title"),"required");
            
            if( $this->form_validation->run() ) {
                $user_id = decrypt($this->post_data["user_id"]);
                $this->load->model("listing_users_model","listing_users");
                if( !empty($user_id) ) {
                    
                    $exiting_record = $this->listing_users->check_listing_user($listing_id,$user_id)["record"];
                    if( empty($exiting_record) ) {
                        $post_data = $this->post_data;
                        $post_data["user_id"] = $user_id;
                        if( $this->listing_users->add_listing_user($listing_id,$post_data,$this->user_data["id"]) ){
                            success($this->lang->line("message_insert_success"));
                            redirect( superadmin_url("{$this->controller_name}/listing_users/{$encoded_id}") );
                        }else{
                            error($this->lang->line("message_try_again"));
                        }
                    }else{
                        $this->data["form_error"] = array("user_id"=>sprintf($this->lang->line("message_field_required"),$this->lang->line("heading_listing_user_title")));
                    }
                }else{
                    $this->data["form_error"] = array("user_id"=>sprintf($this->lang->line("message_field_required"),$this->lang->line("heading_listing_user_title")));
                }
            }else{
                $this->data["form_error"] = $this->form_validataion->error_array();
            }
        }
        $this->data["main_form_url"]=superadmin_url("{$this->controller_name}/add_listing_users/{$encoded_id}");
        $this->layout->view("{$this->module_name}/{$this->controller_name}/add_listing_users",$this->data);
    }
    
    public function get_users_list($encoded_id) {
        $listing_id = decrypt($encoded_id);
        $this->load->model("listing_users_model","listing_users");
        $listing_users = $this->listing_users->get_users_list_for_listing($listing_id,$this->post_data)["records"];
        
        if( !empty($listing_users) ){
            foreach( $listing_users as $key=>$listing_user ) {
                $response[] = array( "id"=> encrypt($listing_user["id"]),"text"=>"{$listing_user["full_name"]} - {$listing_user["phone_no"]}" );   
            }
        }else{
            $response = array();
        }
        echo json_encode($response);
    }
    
    public function delete_listing_users( $encoded_id,$edited_id ) {
        $this->load->model("listing_users_model","listing_users");
        $this->listing_users->delete_listing_user( decrypt($edited_id) );
        success($this->lang->line("message_delete_success"));
        redirect( superadmin_url("{$this->controller_name}/listing_users/{$encoded_id}") );
    }
    
    public function change_listing_user_status( $encoded_id,$edited_id ) {
        $this->load->model("listing_users_model","listing_users");
        $status = ( !empty($this->post_data["status"]) && $this->post_data["status"] )==ACTIVE ? ACTIVE:INACTIVE;
        if( $this->listing_users->update( array("status"=>$status,"modified_at"=>SQL_ADDED_DATE,"modified_by"=>$this->user_data["id"]),decrypt($edited_id) ) ){
            $response = array("flag"=>FLAG_SUCCESS,"message"=>$this->lang->line("message_update_success"));
        }else{
            $response = array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_try_again"));
        }
        echo outputJsonData($response);
        
    }
    
    
    public function add_order( $encoded_id ) {
        $listing_id = decrypt($encoded_id);
        $this->load->model("products_model","products");
        $this->load->model("country_model","country");
        $this->load->model("state_model","state");
        $this->load->model("city_model","city");
        
        $this->load->model("products_model","products");
        $listing_record = $this->listing->get_record($listing_id)["record"];
        $this->data["title"]= sprintf($this->lang->line("heading_listing_add_order_title"),$listing_record["name"]);
        if( !empty($listing_record["id"]) ) {
            if( !empty($this->post_data) ) {
                $this->load->module("main/cart_main");
                $this->post_data["listing_id"] = $_POST["listing_id"] = $encoded_id;
                $response = $this->cart_main->add_to_cart($this->post_data,CART_FROM_ADMIN);
                if( $response["flag"]==FLAG_SUCCESS ) {
                    $this->load->module("main/order_main");
                    $response = $this->order_main->place_order($this->post_data,CART_FROM_ADMIN);
                    if( $response["flag"]==FLAG_SUCCESS ) {
                        redirect(superadmin_url("orders/edit/{$response["order_id"]}"));
                    }else{
                        error($response["message"]);
                    }
                    
                }else{
                    error($response["message"]);
                }
            }
            $this->data["listing_data"] = $listing_record;
            $this->data["countries"] = $this->country->get_records()["records"];
            $country_id = 0;
            
            if( !empty($this->data["listing_data"]["country"]) ){
                $country_id = $this->data["listing_data"]["country"];
            }else if( count($this->data["countries"])==1 ) {
                $country_id = $this->data["countries"][0]["id"];
            }
            
            if( !empty($country_id) ){
                $this->data["states"] = $this->state->get_records($country_id,array(),false)["records"];
            }
            if( !empty($this->data["listing_data"]["state"]) ) {
                $this->data["cities"] = $this->city->get_records($country_id,$this->data["listing_data"]["state"],array(),false)["records"];

            }
            $this->data["products"]= $this->products->get_records(array(),false)["records"];
            $this->load->model("listing_users_model","listing_users");
            $this->data["listing_users"] = $this->listing_users->get_records($listing_id)["records"];
            
            $this->layout->view("{$this->module_name}/{$this->controller_name}/add_order",$this->data);
        }else{
            error($this->lang->line("message_no_records"));
            redirect(superadmin_url($this->controller_name));
        }
        
    }
}
