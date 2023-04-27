<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Draft_listing extends MY_Controller 
{
    public $layout_view = "layout/".SUPERADMIN;
    
    /**
     * Construct
     */
    public function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model("listing_model","listing");
        $this->load->model("draft_listing_model","draft");
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
        if( $this->user_data["group_id"]!=SUPERADMIN_GROUP_ID ) {
            $post_data["user_id"] = $this->user_data["id"];
        }
        $records = $this->draft->get_records($post_data,true,$page_no);
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
    
    public function add( $post_data = array() ){
        if( empty($post_data) ) {
            $post_data = $this->post_data;
        }
       
        $error = false;
        $logo = $cover_image="";
            
        if( !empty($_FILES["logo"]["name"]) ) {
            $file_name = get_upload_image_name($post_data["name"],"logo","draft_listing","logo")['file_name'];

            if( !empty($file_name) ) {
                $file_name_response = fileUpload(BASE_DRAFT_LISTING_LOGO_PATH, "", "logo","",false,$file_name);

                if( $file_name_response["success"]==true ) {
                    $logo = $file_name_response["filename"];
                }else{
                    $error = true;
                    $response = array( "flag"=>FLAG_ERROR,"message"=>$file_name_response["error"],"error_array"=>array("logo"=>$file_name_response["error"]) );
                }
            }
        }

        if( !empty($_FILES["cover_image"]["name"]) ) {
            $file_name = get_upload_image_name($post_data["name"],"cover_image","draft_listing","cover_image")["file_name"];

            if( !empty($file_name) ) {
                $file_name_response = fileUpload(BASE_DRAFT_LISTING_COVER_IMAGE_PATH, "", "cover_image","",false,$file_name);
                if( $file_name_response["success"]==true ) {
                    $cover_image = $file_name_response["filename"];
                }else{
                    $error = true;
                    $response = array( "flag"=>FLAG_ERROR,"message"=>$file_name_response["error"],"error_array"=>array("cover_image"=>$file_name_response["error"]) );
                }
            }
        }else if( empty($listing_id) && $this->user_data["group_id"]!=SUPERADMIN_GROUP_ID && empty($this->user_data["is_staff"])  ) {
           $error = true;
        }
        $referral_code_detail = array();
        if( !empty($post_data["referral_code"]) ) {
            $this->load->model("referral_code_model","referral_code");
            $referral_code_detail = $this->referral_code->get_referral_code_user($post_data["referral_code"])["record"];
            if( empty($referral_code_detail) ) {
                return array( "flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_referral_not_found"),"error_array"=>array("referral_code"=>$this->lang->line("message_referral_not_found")) );
            }

        }

        if( !empty($referral_code_detail["id"]) && $referral_code_detail["id"]==$this->user_data["id"] ) {
            return array( "flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_use_own_referral_code_error"),"error_array"=>array("referral_code"=>$this->lang->line("message_use_own_referral_code_error")) );
        }

        if( $error === false ) {
            $update_record = false;
            if( !empty($logo) ) {
                $post_data["logo"]=$logo;
            }
            if( !empty($cover_image) )  {
                $post_data["cover_image"]=$cover_image;
            }

            $insert_data = $this->_get_posted_basic_detail($post_data,$listing_id,$approval);
            $listing_id = $this->draft->insert($insert_data);
            
            if( $listing_id>0 ) {
                success($this->lang->line("message_insert_success"));
                redirect(superadmin_url("draft_listing"));
            }else{
                error($this->lang->line("message_try_again"));
            }

        }
        return $response;    
    }
    
    public function edit($edited_id){
        $listing_id  = decrypt($edited_id);
        $this->data["main_form_url"]=superadmin_url("{$this->controller_name}/edit/{$edited_id}");
        $record = $this->draft->get_record($listing_id)['record'];
        if( !empty($record["listing_id"]) ){
            redirect(superadmin_url("listing/edit/".encrypt($record["listing_id"])));
        }
        if(empty($record)) {
            error($this->lang->line('message_no_records'));
            redirect(superadmin_url("{$this->controller_name}"));
        }else{
            $this->data['title'] = sprintf( $this->lang->line("heading_edit_title"),$this->lang->line("heading_draf_listing") );
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
                if( !empty($_FILES["logo"]["name"]) ) {
                    $file_name = get_upload_image_name($this->post_data["name"],"logo","draft_listing","logo")['file_name'];

                    if( !empty($file_name) ) {
                        $file_name_response = fileUpload(BASE_DRAFT_LISTING_LOGO_PATH, "", "logo","",false,$file_name);

                        if( $file_name_response["success"]==true ) {
                            $logo = $file_name_response["filename"];
                        }else{
                            $error = true;
                            $response = array( "flag"=>FLAG_ERROR,"message"=>$file_name_response["error"],"error_array"=>array("logo"=>$file_name_response["error"]) );
                        }
                    }
                }

                if( !empty($_FILES["cover_image"]["name"]) ) {
                    $file_name = get_upload_image_name($this->post_data["name"],"cover_image","draft_listing","cover_image")["file_name"];

                    if( !empty($file_name) ) {
                        $file_name_response = fileUpload(BASE_DRAFT_LISTING_COVER_IMAGE_PATH, "", "cover_image","",false,$file_name);
                        if( $file_name_response["success"]==true ) {
                            $cover_image = $file_name_response["filename"];
                        }else{
                            $error = true;
                            $response = array( "flag"=>FLAG_ERROR,"message"=>$file_name_response["error"],"error_array"=>array("cover_image"=>$file_name_response["error"]) );
                        }
                    }
                }
                $draft_listing_id = 0;
                if( empty($this->post_data["save_draft"]) ) {
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
                    
                    $this->load->module("main/listing_main");
                    
                    $record = $this->draft->get_record($listing_id)['record'];
                    $post_data["draf_listing_logo"] = $record["logo"];
                    $post_data["draf_listing_cover_image"] = $record["cover_image"];
                  
                    $response = $this->listing_main->add_new_listing($post_data);
                    if( $response["flag"]==FLAG_SUCCESS ) {
                        $draft_listing_id = decrypt($response["data"]["listing_id"]);
                    }else{
                        error( $response["message"] );
                        redirect( superadmin_url("{$this->controller_name}/edit/{$edited_id}"));

                    }
                   
                }
                
                $post_data = $this->post_data;
                if( !empty($logo) ) {
                    $post_data["logo"]=$logo;
                }
                if( !empty($cover_image) )  {
                    $post_data["cover_image"]=$cover_image;
                }
                $update_data = $this->_get_posted_basic_detail($post_data,$listing_id);
                $update_data["listing_id"] = $draft_listing_id;
                $response = $this->draft->update($update_data,$listing_id);
                if( $draft_listing_id > 0 ) {
                       success($this->lang->line("message_listing_created"));
                        redirect(superadmin_url("listing/index"));
                }else{
                    success($this->lang->line("message_update_success"));
                    redirect(superadmin_url("{$this->controller_name}/index"));
                }

            }else{
                $this->data["cities"] = $this->city->get_records($record["country"],$record["state"],array(),false)["records"];
                
                
                if( !empty($record["social_media"]) ) {
                    $listing_social_medias = $record["social_media"];
                    unset($record["social_media"]);
                    if( !empty($listing_social_medias) ){
                        foreach($listing_social_medias as $key=>$listing_social_media){
                            $record["add_social_media"][]=$listing_social_media["username"];
                            $record["social_media"][]=$listing_social_media["social_media"];
                            $record["social_media_id"][]=$listing_social_media["id"];
                        }
                    }
                }else{
                    $record["add_social_media"] = $record["social_media"] = $record["social_media_id"] = array("") ;
                }
                
               
//                if( !empty($record["listing_amenities"]) ) {
//                    foreach( $record["listing_amenities"] as $key=>$listing_amenity ) {
//                        $record["amenities"][]=decrypt($listing_amenity);
//                    }
//                }
                
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
                $record["listing_type"]=encrypt($record["listing_type"]);
                $record["primary_whatsapp_code"]=encrypt($record["primary_whatsapp_code"]);
                $record["primary_phone_code"]=encrypt($record["primary_phone_code"]);
                $record["country"]=encrypt($record["country"]);
                $record["state"]=encrypt($record["state"]);
                $record["city"]=encrypt($record["city"]);
                if( !empty($record['listing_phone_no']) ) {
                    $listing_phone_no = json_decode( $record['listing_phone_no'],true);
                    foreach($listing_phone_no as $key=>$listing_phone_data) {
                        $record["phone_no"][$key] = $listing_phone_data["phone_no"];
                        $record["phone_code"][$key] = $listing_phone_data["phone_code"];
                    }
                }
               
                if( !empty($record['listing_amenities']) ) {
                    $listing_amenities = json_decode( $record['listing_amenities'],true);
                    $record["amenities"] = $listing_amenities;
                }
                if( !empty($record['listing_email']) ) {
                    $record['listing_email'] = json_decode( $record['listing_email'],true);
                }
                if( !empty($record['listing_social_media']) ) {
                    $listing_social_media = json_decode($record['listing_social_media'],true);
                    foreach( $listing_social_media as $key=>$listing_social_media_data ) {
                        $record["social_media"][$key] = $listing_social_media_data["social_media"];
                        $record["add_social_media"][$key] = $listing_social_media_data["add_social_media"];
                        
                    }
                   
                }
                if( !empty($record['listing_timming']) ) {
                    $listing_timming = json_decode($record['listing_timming'],true);
//                    __print($listing_timming);
                    foreach( $listing_timming as $day_no=>$listing_timming_data ) {
                        $record["timming"][$day_no]=array();
                        foreach( $listing_timming_data as $key=>$timming_data ) {
                            $record["timming"][$day_no][$key]["start_time"] = $record["start_time"][$day_no][$key]=$timming_data["start_time"];
                            $record["timming"][$day_no][$key]["end_time"] = $record["end_time"][$day_no][$key]=$timming_data["end_time"];
                        }
                        
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
    
    
    private function _get_posted_basic_detail($post_data,$listing_id="",$approval=false){//for request only
        
        $items = array("name","listing_type","name","primary_email","primary_phone_code","primary_phone_no","primary_whatsapp_code","primary_whatsapp_no","website","address","country","state","city","google_location","full_address","place_id","longitude","latitude","zip_code","description","meta_title","meta_keywords","meta_description","video","landline","google_virtual_map","tags");
        
        if( !empty($listing_id) && empty($post_data["logo"]) ) {
        }else{
            $items[] = "logo";
        }
       
        if( !empty($listing_id) && empty($post_data["cover_image"]) ) {}else{
            $items[] = "cover_image";
        }
        $data = elements($items,$post_data);
        $data["google_virtual_map"] = $this->input->post("google_virtual_map");
        if( !empty($data["latitude"]) && !empty($data["longitude"]) ) {
            $address_detail = file_get_contents(GOOGLEAPI_MAP_URL."&latlng={$post_data["latitude"]},{$post_data["longitude"]}");
            $address_detail = json_decode($address_detail,true)["results"][0];
            //$data["google_location"] = $address_detail["formatted_address"];
//            $full_addresss = "";
//            foreach( $address_detail["address_components"] as $key => $address_component ) {
//                $full_addresss.=$address_component["long_name"].", ";
//            }
            $data["full_address"] = trim( trim($address_detail["formatted_address"]),"," );
        }
        
        $data["listing_type"] = decrypt($data["listing_type"]);
        $data["primary_phone_code"] = decrypt($data["primary_phone_code"]);
        $data["primary_whatsapp_code"] = decrypt($data["primary_whatsapp_code"]);
        $data["country"] = decrypt($data["country"]);
        $data["state"] = decrypt($data["state"]);
        $data["city"] = decrypt($data["city"]);
        if( !empty($listing_id) ) {
            $data["modified_at"] = SQL_ADDED_DATE;
            $data["modified_by"] = $this->user_data["id"];
        }else{
            if( $this->user_data["group_id"]==SUPERADMIN_GROUP_ID || !empty($this->user_data["is_staff"]) ) {
                $data["is_claimable"] = (int)$post_data["is_claimable"];
                $data["user_id"] = empty($post_data["is_claimable"]) ? $this->user_data["id"] : 0;
                $data["status"] = $post_data["status"];
            }
            $data["created_by"] = $this->user_data["id"];
            $data["created_at"] = SQL_ADDED_DATE;
            $data["ip_address"] = getVisitorIp();
        }
        $data["description"] = stripcslashes($data["description"]);
        $data["listing_social_media"]="";
        $data["listing_amenities"] = $data["listing_timming"] = $data["listing_phone_no"] = $data["listing_email"]=array();
        
        if( !empty($post_data["phone_no"]) ) {
            foreach( $post_data["phone_no"] as $key=>$phone_no ){
                $data["listing_phone_no"][]=array("phone_no"=>$phone_no,"phone_code"=>$post_data["phone_code"][$key]);
            }
        }
        if( !empty($post_data["listing_email"]) ) {
            foreach( $post_data["listing_email"] as $key=>$listing_email ){
                $data["listing_email"][]=$listing_email ;
            }
        }
        
        if( !empty($post_data["listing_social_media"]) ) {
            $data["listing_social_media"] = json_encode($post_data["listing_social_media"]);
        }
        
        if( !empty($post_data["timming"]) ) {
            foreach( $post_data["timming"] as $day_no => $timming_on ){
                
                foreach( $post_data['start_time'][$day_no] as $key=>$start_time ){
                    $data["listing_timming"][$day_no][]=array("start_time"=>$start_time ,"end_time"=>$post_data['end_time'][$day_no][$key]);
                    
                }
            }
        }
        
        $tags_array = json_decode($this->input->post("tags"),true);
        if( !empty($tags_array) ) {
            $data["tags"] = implode(",", array_column($tags_array, "value") );
        }else{
            $data["tags"] = "";
        }
        if( !empty($this->input->post("amenities")) ) {
            $data["listing_amenities"] = json_encode( array_column( json_decode($this->input->post("amenities")),"value" ) );
        }else{
            $data["listing_amenities"]="";
        }
        
        $data["listing_phone_no"] = !empty($data["listing_phone_no"]) ? json_encode($data["listing_phone_no"]) :"";
        $data["listing_email"] = !empty($data["listing_email"]) ? json_encode($data["listing_email"]) :"";
        $data["listing_timming"] = !empty($data["listing_timming"]) ? json_encode($data["listing_timming"]) :"";
        
        return $data;       
    }
}


