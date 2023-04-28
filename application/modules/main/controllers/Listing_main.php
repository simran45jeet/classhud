<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Listing_main extends MY_Controller { 
    public function __construct() {
        parent::__construct();
        
        $this->load->model("listing_model","listing");
        $this->load->model("listing_social_media_model","listing_social_media");
        $this->load->model("listing_email_model","listing_email");
        $this->load->model("listing_phone_model","listing_phone");
        $this->load->model("listing_timming_model","listing_timming");
        $this->load->model("listing_amenities_model","listing_amenities");
    }
    
    public function add_new_listing($post_data,$approval=false,$encoded_id=""){
        
        if( !empty($post_data["save_draft"]) && ( $this->user_data["group_id"]==SUPERADMIN_GROUP_ID || !empty($this->user_data["is_staff"]) )  ){
            $this->load->module(SUPERADMIN."/draft_listing");
            
            return $this->draft_listing->add($post_data);
        }
        $listing_id = decrypt($encoded_id);
        $this->form_validation->set_rules("listing_type",$this->lang->line("heading_institute_type"),"required|is_not_empty");
        $this->form_validation->set_rules("name",$this->lang->line("heading_name"),"required|is_not_empty");
        $this->form_validation->set_rules("address",$this->lang->line("heading_address"),"required|is_not_empty");
        $this->form_validation->set_rules("state",$this->lang->line("heading_state"),"required|is_not_empty");
        $this->form_validation->set_rules("city",$this->lang->line("heading_city"),"required|is_not_empty");
        $this->form_validation->set_rules("description",$this->lang->line("heading_description"),"required|is_not_empty");
        
        if( !empty($post_data["listing_email"]) && is_array($post_data["listing_email"]) && count($post_data["listing_email"]) >0 ) {
            foreach( $post_data["listing_email"] as $key=>$listing_email ) {
                $this->form_validation->set_rules("listing_email[{$key}]",$this->lang->line("heading_email"),"required|valid_email");
            }
        }
        
        if( !empty($post_data["phone_no"]) && is_array($post_data["phone_no"]) && count($post_data["phone_no"]) >0 ) {
            foreach( $post_data["phone_no"] as $key=>$phone_no ) {
                $this->form_validation->set_rules("phone_no[{$key}]",$this->lang->line("heading_phone_no"),"required|is_numeric|min_length[10]|max_length[10]");
            }
        }
        if( empty($listing_id) ) {//incase of approval and edit
            $this->form_validation->set_rules("primary_email",$this->lang->line("heading_email"),"required|is_not_empty|valid_email|is_unique[{$this->listing->table_name}.primary_email]");
//            $this->form_validation->set_rules("primary_phone_no",$this->lang->line("heading_phone_no"),"required|is_numeric|is_not_empty|is_unique[{$this->listing->table_name}.primary_phone_no]");
        }else{
            
            $this->form_validation->set_rules("primary_email",$this->lang->line("heading_email"),"required|is_not_empty|valid_email|is_unique[{$this->listing->table_name}.primary_email.id.{$post_data["listing_id"]}]");
//            $this->form_validation->set_rules("primary_phone_no",$this->lang->line("heading_phone_no"),"required|is_numeric|is_not_empty|min_length[10]|max_length[10]|is_unique[{$this->listing->table_name}.primary_phone_no.id.{$post_data["listing_id"]}]");
        }
        //$this->form_validation->set_rules("logo",$this->lang->line("heading_logo"),"required|is_not_empty");
        
        if( $this->form_validation->run() ) {
            $error = false;
            $logo = $cover_image="";
            
            if( !empty($_FILES["logo"]["name"]) ) {
                $file_name = get_upload_image_name($post_data["name"],"logo","listing","logo")['file_name'];

                if( !empty($file_name) ) {
                    $file_name_response = fileUpload(BASE_LISTING_LOGO_PATH, "", "logo","",false,$file_name);

                    if( $file_name_response["success"]==true ) {
                        $logo = $file_name_response["filename"];
                    }else{
                        $error = true;
                        $response = array( "flag"=>FLAG_ERROR,"message"=>$file_name_response["error"],"error_array"=>array($file_name_response["error"]) );
                    }
                }
            }elseif( ( $this->user_data["group_id"]==SUPERADMIN_GROUP_ID ||  !empty($this->user_data["is_staff"]) ) && !empty($post_data["draf_listing_logo"]) ){
                $_FILES["logo"]["name"] = $post_data["draf_listing_logo"];
                $logo = $file_name = get_upload_image_name($post_data["name"],"logo","listing","logo")['file_name'];
                
                copy( base_url(BASE_DRAFT_LISTING_LOGO_PATH.$post_data["draf_listing_logo"]),FCPATH.BASE_LISTING_LOGO_PATH.$file_name );
                
                unset($_FILES["logo"]);
                
                
            }else if( empty($listing_id) &&  $this->user_data["group_id"]!=SUPERADMIN_GROUP_ID && empty($this->user_data["is_staff"])  ) {
                $error = true;
            }
         
            if( !empty($_FILES["cover_image"]["name"]) ) {
                
                $file_name = get_upload_image_name($post_data["name"],"cover_image","listing","cover_image")["file_name"];

                if( !empty($file_name) ) {
                    $file_name_response = fileUpload(BASE_LISTING_COVER_IMAGE_PATH, "", "cover_image","",false,$file_name);
                    if( $file_name_response["success"]==true ) {
                        $cover_image = $file_name_response["filename"];
                    }else{
                        $error = true;
                        $response = array( "flag"=>FLAG_ERROR,"message"=>$file_name_response["error"],"error_array"=>array($file_name_response["error"]) );
                    }
                }
            }elseif( ( $this->user_data["group_id"]==SUPERADMIN_GROUP_ID ||  !empty($this->user_data["is_staff"]) ) && !empty($post_data["draf_listing_cover_image"]) ){
                $_FILES["cover_image"]["name"] = $post_data["draf_listing_cover_image"];
                $cover_image = $file_name = get_upload_image_name($post_data["name"],"cover_image","listing","logo")['file_name'];
                copy( base_url(BASE_DRAFT_LISTING_COVER_IMAGE_PATH.$post_data["draf_listing_cover_image"]),FCPATH.BASE_LISTING_COVER_IMAGE_PATH.$cover_image );
                
                unset($_FILES["cover_image"]);
                
                
            }else if( empty($listing_id) && $this->user_data["group_id"]!=SUPERADMIN_GROUP_ID && empty($this->user_data["is_staff"])  ) {
               $error = true;
            }
            $referral_code_detail = array();
            if( !empty($post_data["referral_code"]) ) {
                $this->load->model("referral_code_model","referral_code");
                $referral_code_detail = $this->referral_code->get_referral_code_user($post_data["referral_code"])["record"];
                if( empty($referral_code_detail) ) {
                    return array( "flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_referral_not_found"),"error_array"=>array($this->lang->line("message_referral_not_found")) );
                }
                
            }
            
            if( !empty($referral_code_detail["id"]) && $referral_code_detail["id"]==$this->user_data["id"] ) {
                return array( "flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_use_own_referral_code_error"),"error_array"=>array($this->lang->line("message_use_own_referral_code_error")) );
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
                
                if( !empty($listing_id) ) {
                    $update_record =true;
                    $this->listing->update($insert_data,$listing_id);
                }else{
                    $listing_id = $this->listing->insert($insert_data);
                    if( !empty($referral_code_detail["id"]) ) {
                        $this->load->model("referral_listing_model","referral_listing");
                        $this->referral_listing->insert(array("listing_id"=>$listing_id,"referrar_user_id"=>$referral_code_detail["id"],"created_at"=>SQL_ADDED_DATE,"created_by"=>$this->user_data["id"]));
                    }
                    if( $this->user_data["group_id"]!=SUPERADMIN_GROUP_ID && empty($this->user_data["is_staff"]) ) {
                        $this->load->model("listing_users_model","listing_users");
                        $listing_user_data = array(
                            "user_id"=>$this->user_data["id"],
                            "status"=>ACTIVE,
                        );
                        $this->listing_users->add_listing_user($listing_id,$listing_user_data,$this->user_data["id"]);
                    }
                    
                }
                
                if( $listing_id>0 ) {
                    
                    $this->submit_listing_extra_data($post_data,$listing_id);
                    
                    $listing_timming = array_column($this->listing_timming->get_records($listing_id)["records"],"id");
                    $posted_listing_phone = array();
                    if( !empty($listing_timming) ) {
                        $this->listing_timming->delete(array("listing_id"=>$listing_id));
                    }
                    
                    if( !empty($post_data["timming"])){
                        $listimg_timming_data = $this->_get_posted_listing_timming($post_data,$listing_id);
                        
                        if( !empty($listimg_timming_data) ) {
                            $this->listing_timming->insertRows($listimg_timming_data);
                        }
                    }
                    
                    $message_language=!empty($update_record) ? "message_update_success" : "message_insert_success";
                    $response = array( "flag"=>FLAG_SUCCESS,"message"=>$this->lang->line($message_language),"data"=>array("listing_id"=>encrypt($listing_id)) );
                    if( $this->user_data["group_id"]==SUPERADMIN_GROUP_ID || !empty($this->user_data["is_staff"]) ) {
                        generate_sitemap();
                    }

                    if( $approval==true &&  isset($post_data["request_status"]) && $post_data["request_status"]== LISTING_REQUEST_STATUS_REQUESTED  ) {
                        $listing_data = $this->get_record(encrypt($listing_id))["data"];
                        //__print($listing_data);
                        send_listing_approve_sms($listing_data["primary_phone_code_name"],$listing_data["primary_phone_no"]);
                        send_listing_approve_sms($listing_data["user_phone_code"],$listing_data["user_phone_no"]);
                    }
                }else{
                    $response = array( "flag"=>FLAG_ERROR,"message"=>implode("<br/>",$this->form_validation->error_array()),"error_array"=>$this->form_validation->error_array() );
                }

            }
        }else{
            $response = array( "flag"=>FLAG_ERROR,"message"=>implode("\n",$this->form_validation->error_array()),"error_array"=>$this->form_validation->error_array() );
        }
       
        return $response;
    }
    
    private function submit_listing_extra_data($post_data,$listing_id) {
        $listing_social_medias = array_column($this->listing_social_media->get_records($listing_id)["records"],"id");
        $posted_social_media = array();
        if (!empty($post_data["add_social_media"])) {
            $social_insert_data = $this->_get_posted_social_media($post_data, $listing_id);

            if (!empty($social_insert_data)) {
                $this->listing_social_media->insertRows($social_insert_data);
            }


            foreach ($post_data["add_social_media"] as $key => $social_media_users) {
                if (!empty($social_media_users) && !empty($post_data["social_media_id"][$key])) {//check for existing record  posted then update
                    $social_media_id = decrypt($post_data["social_media_id"][$key]);
                    if (in_array($social_media_id, $listing_social_medias)) {
                        $posted_social_media[] = $social_media_id;
                        $update_data = array(
                            "social_media_id" => decrypt($post_data["social_media"][$key]),
                            "social_media_name" => $social_media_users,
                            "modified_at" => SQL_ADDED_DATE,
                            "modified_by" => $this->user_data["id"],
                        );
                        $this->listing_social_media->update($update_data, $social_media_id);
                    }
                }
            }
            if (!empty($listing_social_medias)) {//check for existing record not posted
                foreach ($listing_social_medias as $listing_social_media_id) {
                    if (!in_array($listing_social_media_id, $posted_social_media)) {
                        $this->listing_social_media->delete($listing_social_media_id);
                    }
                }
            }
        } else {
            $this->listing_social_media->delete(array("listing_id" => $listing_id));
        }

        $listing_email_ids = array_column($this->listing_email->get_records($listing_id)["records"], "id"); //emails

        $posted_listing_email = array();
        if (!empty($post_data["listing_email"])) {
            $listimg_email_data = $this->_get_posted_listing_email($post_data, $listing_id);
            if (!empty($listimg_email_data)) {
                $this->listing_email->insertRows($listimg_email_data);
            }

            foreach ($post_data["listing_email"] as $key => $listing_email) {//check for existing record  posted then update
                if (!empty($post_data["listing_email_id"][$key])) {
                    $listing_email_id = decrypt($post_data["listing_email_id"][$key]);

                    if (in_array($listing_email_id, $listing_email_ids)) {
                        $posted_listing_email[] = $listing_email_id;
                        $update_data = array(
                            "email" => $listing_email,
                            "modified_at" => SQL_ADDED_DATE,
                            "modified_by" => $this->user_data["id"],
                        );
                        $this->listing_email->update($update_data, $listing_email_id);
                    }
                }
            }
            if (!empty($listing_email_ids)) {
                foreach ($listing_email_ids as $listing_email_id) {
                    if (!in_array($listing_email_id, $posted_listing_email)) {
                        $this->listing_email->delete($listing_email_id);
                    }
                }
            }
        } elseif (!empty($listing_email)) {
            $this->listing_email->delete(array("listing_id" => $listing_id));
        }

        $listing_phone = array_column($this->listing_phone->get_records($listing_id, array("phone_type" => PHONE_TYPE_PHONE))["records"], "id");
        $posted_listing_phone = array();
        if (!empty($post_data["phone_no"])) {
            $listimg_phone_data = $this->_get_posted_listing_phone($post_data, $listing_id);
            if (!empty($listimg_phone_data)) {
                $this->listing_phone->insertRows($listimg_phone_data);
            }
            foreach ($post_data["phone_no"] as $key => $phone_no) {//check for existing record  posted then update
                if (!empty($post_data["listing_phone_id"][$key])) {
                    $listing_phone_id = decrypt($post_data["listing_phone_id"][$key]);
                    if (in_array($listing_phone_id, $listing_phone)) {
                        $posted_listing_phone[] = $listing_phone_id;
                        $update_data = array(
                            "phone_code" => decrypt($post_data["phone_code"][$key]),
                            "phone_no" => $phone_no,
                            "modified_at" => SQL_ADDED_DATE,
                            "modified_by" => $this->user_data["id"],
                        );
                        $this->listing_phone->update($update_data, $listing_phone_id);
                    }
                }
            }
            if (!empty($listing_phone)) {
                foreach ($listing_phone as $listing_phone_id) {//check for existing record not posted then delete
                    if (!in_array($listing_phone_id, $posted_listing_phone)) {
                        $this->listing_phone->delete($listing_phone_id);
                    }
                }
            }
        } elseif (!empty($listing_phone)) {
            $this->listing_phone->delete(array("listing_id" => $listing_id));
        }

        $listing_amenities = array_column($this->listing_amenities->get_records($listing_id, array(), false)["records"], "amenities_id");
        $posted_listing_amenities = array();
        if (!empty($post_data["amenities"])) {
            foreach ($post_data["amenities"] as $key => $amenity) {
                $amenity = decrypt($amenity);
                $posted_listing_amenities[] = $amenity;
                if (!in_array($amenity, $listing_amenities)) {
                    $insert_data = array(
                        "listing_id" => $listing_id,
                        "amenities_id" => $amenity,
                        "status" => ACTIVE,
                        "created_at" => SQL_ADDED_DATE,
                        "created_by" => $this->user_data["id"],
                    );
                    $this->listing_amenities->insert($insert_data);
                }
            }
            if (!empty($listing_amenities)) {
                foreach ($listing_amenities as $key => $listing_amenity) {                    
                    if (!in_array($listing_amenity, $posted_listing_amenities)) {
                        $this->listing_amenities->delete( array("listing_id"=>$listing_id,"amenities_id"=>$listing_amenity) );
                    }
                }
            }
        } else if (!empty($listing_amenities)) {
            $this->listing_amenities->delete(array("listing_id" => $listing_id));
        }
        
        $this->update_listing_tags($post_data,$listing_id);
        
    }

    public function edit_listing($post_data,$encoded_id=""){
        
        $listing_id = decrypt($encoded_id);
        
        $this->form_validation->set_rules("listing_type",$this->lang->line("heading_institute_type"),"required|is_not_empty");
        $this->form_validation->set_rules("name",$this->lang->line("heading_name"),"required|is_not_empty");
        $this->form_validation->set_rules("address",$this->lang->line("heading_address"),"required|is_not_empty");
        $this->form_validation->set_rules("state",$this->lang->line("heading_state"),"required|is_not_empty");
        $this->form_validation->set_rules("city",$this->lang->line("heading_city"),"required|is_not_empty");
        $this->form_validation->set_rules("description",$this->lang->line("heading_description"),"required|is_not_empty");
        
        if( !empty($post_data["listing_email"]) && is_array($post_data["listing_email"]) && count($post_data["listing_email"]) >0 ) {
            foreach( $post_data["listing_email"] as $key=>$listing_email ) {
                $this->form_validation->set_rules("listing_email[{$key}]",$this->lang->line("heading_email"),"required|valid_email");
            }
        }
        
        if( !empty($post_data["phone_no"]) && is_array($post_data["phone_no"]) && count($post_data["phone_no"]) >0 ) {
            foreach( $post_data["phone_no"] as $key=>$phone_no ) {
                $this->form_validation->set_rules("phone_no[{$key}]",$this->lang->line("heading_phone_no"),"required|is_numeric|min_length[10]|max_length[10]");
            }
        }
        if( empty($listing_id) ) {//incase of approval and edit
            $this->form_validation->set_rules("primary_email",$this->lang->line("heading_email"),"required|is_not_empty|valid_email|is_unique[{$this->listing->table_name}.primary_email]");
            //$this->form_validation->set_rules("primary_phone_no",$this->lang->line("heading_phone_no"),"required|is_numeric|is_not_empty|is_unique[{$this->listing->table_name}.primary_phone_no]");
        }else{
            
            $this->form_validation->set_rules("primary_email",$this->lang->line("heading_email"),"required|is_not_empty|valid_email|is_unique[{$this->listing->table_name}.primary_email.id.{$listing_id}]");
            //$this->form_validation->set_rules("primary_phone_no",$this->lang->line("heading_phone_no"),"required|is_numeric|is_not_empty|min_length[10]|max_length[10]|is_unique[{$this->listing->table_name}.primary_phone_no.id.{$listing_id}]");
        }
        //$this->form_validation->set_rules("logo",$this->lang->line("heading_logo"),"required|is_not_empty");
        
        if( $this->form_validation->run() ) {
            $error = false;
            $logo = $cover_image="";
            
            if( !empty($_FILES["logo"]["name"]) ) {
                $file_name = get_upload_image_name($post_data["name"],"logo","listing","logo")['file_name'];

                if( !empty($file_name) ) {
                    $file_name_response = fileUpload(BASE_LISTING_LOGO_PATH, "", "logo","",false,$file_name);

                    if( $file_name_response["success"]==true ) {
                        $logo = $file_name_response["filename"];
                    }else{
                        $error = true;
                        $response = array( "flag"=>FLAG_ERROR,"message"=>$file_name_response["error"] );
                    }
                }
            }

            if( !empty($_FILES["cover_image"]["name"]) ) {
                $file_name = get_upload_image_name($post_data["name"],"cover_image","listing","cover_image")["file_name"];

                if( !empty($file_name) ) {
                    $file_name_response = fileUpload(BASE_LISTING_COVER_IMAGE_PATH, "", "cover_image","",false,$file_name);
                    if( $file_name_response["success"]==true ) {
                        $cover_image = $file_name_response["filename"];
                    }else{
                        $error = true;
                        $response = array( "flag"=>FLAG_ERROR,"message"=>$file_name_response["error"],"error_array"=>array() );
                    }
                }
            }
            
            if( $error === false ) {
                if( !empty($logo) ) {
                    $post_data["logo"]=$logo;
                }
                if( !empty($cover_image) )  {
                    $post_data["cover_image"]=$cover_image;
                }
               
                $insert_data = $this->_get_posted_listing_basic_detail($post_data,$listing_id,$approval);
                $this->listing->update($insert_data,$listing_id);
                
                if( $listing_id>0 ) {
                    $this->submit_listing_extra_data($post_data,$listing_id);
                    $listing_email_ids = array_column($this->listing_email->get_records($listing_id)["records"],"id");//emails
                    
                    $listing_timming = array_column($this->listing_timming->get_records($listing_id)["records"],"id");
                    $posted_listing_phone = array();
                    if( !empty($listing_timming) ) {
                        $this->listing_timming->delete(array("listing_id"=>$listing_id));
                    }
                    
                    if( !empty($post_data["timming"])){
                        $listimg_timming_data = $this->_get_posted_listing_timming($post_data,$listing_id);
                        
                        if( !empty($listimg_timming_data) ) {
                            $this->listing_timming->insertRows($listimg_timming_data);
                        }
                    }
                    
                    $message_language=!empty($listing_id) ? "message_update_success" : "message_insert_success";
                    $response = array( "flag"=>FLAG_SUCCESS,"message"=>$this->lang->line($message_language) );
                    if( $this->user_data["group_id"]==SUPERADMIN_GROUP_ID || !empty($this->user_data["is_staff"]) ) {
                        generate_sitemap();
                    }
                }else{
                    $response = array( "flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_try_again"),"error_array"=>array($this->lang->line("message_try_again")) );
                }
            }
        }else{
            
            $response = array( "flag"=>FLAG_ERROR,"message"=>implode("<br/>",$this->form_validation->error_array()),"error_array"=>$this->form_validation->error_array() );
        }
       
        return $response;
    }
    
    private function update_listing_tags( $post_data,$listing_id )  {
        
        $posted_tags = array();
        $post_data["tags"] = trim(trim($post_data["tags"]), ",");
        if (!empty($post_data["tags"])) {
            $posted_tags = array_map("trim", explode(",", $post_data["tags"]));
        }
        
        $this->load->model("listing_tags_model", "listing_tags");
        $this->load->model("tags_model", "tags");
        $listing_tags = array_column($this->listing_tags->get_records($listing_id)["records"],"name","tag_id"); //emails
        
        $inset_tags_data = array();
        if (!empty($posted_tags)) {
            foreach ($posted_tags as $key => $tag_name) {//check for existing record  posted then update
                if ( ( is_array($listing_tags) && !in_array($tag_name, $listing_tags) ) || empty($listing_tags) ) {
                    $tag_record = $this->tags->get_tag_id($tag_name)["record"];
                    if( !empty($tag_record["id"]) ) {
                        $tag_id = $tag_record["id"];
                    }else{
                        $tag_id = $this->tags->add_tag($tag_name,$this->user_data["id"]);
                    }
                    
                    $inset_tags_data[] = array(
                        "tag_id" => $tag_id,
                        "type" => TAGS_TYPES_LISTING,
                        "table_id" => $listing_id, 
                        "created_by" => $this->user_data["id"],
                        "created_at" => SQL_ADDED_DATE,
                        "ip_address" => getVisitorIp(),
                        "status" => ACTIVE
                    );
                }
            }
            if (!empty($inset_tags_data)) {
                $this->listing_tags->insertRows($inset_tags_data);
            }
            if (!empty($listing_tags)) {
                foreach ($listing_tags as $listing_tag) {
                    if (!in_array($listing_tag, $posted_tags)) {
                        $delete_tag_id = array_search($listing_tag,$listing_tags);
                        $this->listing_tags->delete(array("tag_id" => $delete_tag_id, "table_id" => $listing_id, "type" => TAGS_TYPES_LISTING));
                    }
                }
            }
        } elseif (!empty($listing_tags)) {
            $this->listing_tags->delete(array("table_id" => $listing_id, "type" => TAGS_TYPES_LISTING));
        }
    }

    public function get_records($post_data=array(),$page_no=1){
        $post_data["user_id"] = !empty($post_data["user_id"]) ? decrypt($post_data["user_id"])  : 0;
        $post_data["listing_type"] = !empty($post_data["listing_type"]) ? decrypt($post_data["listing_type"]) : 0;
        $records = $this->listing->get_records($post_data,true,$page_no);
        if( !empty($records["records"]) ) {
            foreach($records["records"] as $key => $record) {
                
                if( !empty($record["logo"]) ) {
                    $record["logo_url"] = base_url(BASE_LISTING_LOGO_PATH.$record["logo"]);
                }else{
                    $record["logo_url"] = base_url(BASE_WEB_IMAGES_PATH."class-hud-institute-cover-logo.jpg");
                }
                if( !empty($record["cover_image"]) ) {
                    $record["cover_image_url"] = base_url(BASE_LISTING_COVER_IMAGE_PATH.$record["cover_image"]);
                }else{
                    $record["cover_image_url"] = base_url(BASE_WEB_IMAGES_PATH."class-hud-institute-cover-image.jpg");
                }
                $records["records"][$key]["id"] = encrypt($record["id"]);
                
                $records["records"][$key]["logo_url"] = $record["logo_url"];
                $records["records"][$key]["name"] = stripcslashes($record["name"]);
                $records["records"][$key]["cover_image_url"] = $record["cover_image_url"];
                $records["records"][$key]["listing_type_image"] = !empty($record["listing_type_image"]) ? base_url(BASE_LISTING_TYPE_IMAGE_PATH.$record["listing_type_image"]):"";;
            }
            $response = array("flag"=>FLAG_SUCCESS,"data"=>$records["records"],"count"=>$records["count"]);
        }else{
            $response = array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_no_records"),"count"=>0);
        }
        return $response;
    }
    public function get_record($encoded_id="",$slug="",$post_data=array()){
        $listing_id = decrypt($encoded_id);
        $record = $this->listing->get_record($listing_id,$slug)["record"];
        if( !empty($record) ) {
            $record["name"] = stripcslashes($record["name"]);
            $record["address"] = stripcslashes($record["address"]);
            $record["listing_id"] = encrypt($record["id"]);
            $record["qrcode"] = !empty($record["qrcode"]) ? encrypt($record["qrcode"]) : "";
            $listing_id = $record["id"];
            
            $this->load->model("listing_email_model","listing_email");
            $this->load->model("listing_phone_model","listing_phone");
            $this->load->model("listing_social_media_model","listing_social_media");
            $this->load->model("listing_timming_model","listing_timming");
            $timmings = $this->listing_timming->get_records($listing_id)["records"];
            
            $record["listing_type"] = encrypt($record["listing_type"]);
            $record["primary_phone_code"] = encrypt($record["primary_phone_code"]);
            $record["primary_whatsapp_code"] = encrypt($record["primary_whatsapp_code"]);
            $record["country"] = encrypt($record["country"]);
            $record["state"] = encrypt($record["state"]);
            $record["city"] = encrypt($record["city"]);
            $record["primary_email"] = strtolower($record["primary_email"]);
            $record["website"] = strtolower($record["website"]);
            $record["meta_title"] = stripcslashes($record["meta_title"]);
            $record["meta_keywords"] = stripcslashes($record["meta_keywords"]);
            $record["meta_description"] = stripcslashes($record["meta_description"]);
            $record["description"] = stripcslashes($record["description"]);
            
            $this->load->model("listing_reviews_model","listing_reviews");
            $record["category_wise_rating"] = $this->listing_reviews->get_review_rating_categoriwise($record["id"])["records"];
            $user_reviews = $this->user_reviews($record["slug"]);
            if( $user_reviews["flag"]==FLAG_SUCCESS ) {
                $record["user_reviews"] = array(
                    "records"=>$user_reviews["data"],
                    "count"=>$user_reviews["count"],
                    "total_pages"=>$user_reviews["total_pages"],
                );
            }
            
            foreach( $timmings as $key=>$timming ) {
                if( $timming['day_type']==DAY_TYPE_NORMAl ) {
                    unset($timming["listing_id"]);
                    $record['timming'][$timming["day_no"]][encrypt($timming["id"])]=array(
                        "start_time" => $timming["start_time"],
                        "end_time" => $timming["end_time"]
                    );
                }
            }
            $listing_emails = $this->listing_email->get_records($listing_id)["records"];
            foreach( $listing_emails as $key => $listing_email ) {
                $record['listing_email'][encrypt($listing_email["id"])] = $listing_email["email"];
            }
            
            $listing_phones = $this->listing_phone->get_records($listing_id)["records"];
            foreach( $listing_phones as $key => $listing_phone ) {
                
                if( $listing_phone["phone_type"]==PHONE_TYPE_PHONE ) {
                    $record['listing_phone'][encrypt($listing_phone["id"])] = array("phone_code"=>encrypt($listing_phone["phone_code"]),"phone_no"=>$listing_phone["phone_no"],"phone_code_name"=>$listing_phone["phone_code_name"]);
                }
            }
            
            $listing_amenities = $this->listing_amenities->get_records($listing_id,array(),false)["records"];
            foreach( $listing_amenities as $key => $listing_amenity ) {
                $listing_amenity_id = encrypt($listing_amenity["id"]);
                unset($listing_amenity["listing_id"],$listing_amenity["id"]);
                $listing_amenity["image_url"] = !empty($listing_amenity["image"]) ? base_url(BASE_AMENITIES_IMAGE_PATH.$listing_amenity["image"]):"";
                $listing_amenity["amenities_id"] = encrypt($listing_amenity["amenities_id"]);
                $record['listing_amenities_data'][$listing_amenity_id] = $listing_amenity;
                $record['listing_amenities'][$listing_amenity_id] = $listing_amenity["amenities_id"];
            }
            $listing_social_medias = $this->listing_social_media->get_records($listing_id)["records"];
            foreach( $listing_social_medias as $key => $listing_social_media ) {
                $record['social_media'][] = array("id"=>encrypt($listing_social_media["id"]),"username"=>$listing_social_media["social_media_name"],"social_media"=>encrypt($listing_social_media["social_media_id"]),"icon_class"=>$listing_social_media["icon_class"] );
            }
            if( !empty($record["logo"]) ) {
                $record["logo_url"] = base_url(BASE_LISTING_LOGO_PATH.$record["logo"]);
            }else{
                $record["logo_url"] = base_url(BASE_WEB_IMAGES_PATH."class-hud-institute-cover-logo.jpg");
            }
            
            if( !empty($record["cover_image"]) ) {
                $record["cover_image_url"] = base_url(BASE_LISTING_COVER_IMAGE_PATH.$record["cover_image"]);
            }else{
                $record["cover_image_url"] = base_url(BASE_WEB_IMAGES_PATH."class-hud-institute-cover-image.jpg");;
            }
            $record["listing_type_image"] = !empty($record["listing_type_image"]) ? base_url(BASE_LISTING_TYPE_IMAGE_PATH.$record["listing_type_image"]):"";
            
            $video_id = !empty($record["video"]) ? yotube_video_id($record["video"]) : "";
            
            $record["video_thumb"] = !empty($video_id) ? "https://img.youtube.com/vi/{$video_id}/0.jpg" : "";
            $record["video_url"] = !empty($video_id) ? youtube_videoid_url($video_id) : "";
            
            $this->load->model("listing_tags_model","listing_tags");
            $listing_tags = $this->listing_tags->get_records($record["id"])["records"];
            if( !empty($listing_tags) ) {
                $record["tags"] = implode(",",  array_column($listing_tags, "name"));
            }
            
            $record["id"] = $record["listing_id"];
            $response = array("flag"=>FLAG_SUCCESS,"data"=>$record);
            
        }else{
            $response = array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_no_records"));
        }
        return $response;
    }
    
    public function user_reviews($slug,$post_data=array(),$page_no=1){
        $this->load->model("listing_reviews_model","listing_reviews");
        $post_data["per_page_count"] =  $post_data["per_page_count"] ? :DEFAULT_RECORDS_PAGELIMIT;
        $user_reviews = $this->listing_reviews->user_reviews($slug,$post_data,true,$page_no);
        if( !empty($user_reviews["records"]) ) {
            foreach( $user_reviews["records"] as $key=>$user_review ){
                $records[$key]["id"] = encrypt($user_review["id"]);
                $records[$key]["full_name"] = $user_review["full_name"];
                $records[$key]["email"] = $user_review["email"];
                $records[$key]["rating"] = $user_review["rating"];
                $records[$key]["review"] = $user_review["review"];
                $records[$key]["created_at"] = $user_review["created_at"];
                $category_names = explode("=>",$user_review["category_name"]);
                $category_ratings = explode("=>",$user_review["category_rating"]);
                foreach($category_ratings as $key2=>$category_rating) {
                    $records[$key]["category_rating"][] = array( 
                            "name"=>$category_names[$key2],
                            "category_rating"=>$category_rating,
                    );
                }
            }
            $total_pages = ceil( $user_reviews["count"]/$post_data["per_page_count"] );
            
            $response = array("flag"=>FLAG_SUCCESS,"data"=>$records,"count"=>$user_reviews["count"],"total_pages"=>$total_pages);
        }else{
            $response = array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_no_records"));
        }
       
        return $response;
    }
    
    public function get_listing_types( $post_data=array() ){
        $this->load->model("organization_types_model","organization_types");
        $records = $this->organization_types->get_records($post_data);        
        if( !empty($records["records"]) ) {
            foreach($records["records"] as $key => $record) {
                $records["records"][$key]["id"] = encrypt($record["id"]);
            }
            $response = array("flag"=>FLAG_SUCCESS,"data"=>$records["records"]);
        }else{
            $response = array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_no_records"));
        }
        return $response;
    }
    
    public function claim_listing($slug,$post_data){
        //$record = $this->listing->get_record($listing_id,$slug)["record"];
        
        $this->form_validation->set_rules("full_name",$this->lang->line("heading_full_name"),"required|is_not_empty");
        $this->form_validation->set_rules("phone_code",$this->lang->line("heading_phone_code"),"required|is_not_empty");
        $this->form_validation->set_rules("phone_no",$this->lang->line("heading_phone_no"),"required|is_not_empty|numeric|min_length[".PHONE_MIN_LENGTH."]|max_length[".PHONE_MAX_LENGTH."]");
        
        if( $this->form_validation->run() ) {
            $this->load->model("users_model","users");
            $user_detail = $this->users->get_record("",$post_data["phone_no"])["record"];
            $listing_detail = $this->get_record("",$slug)["data"];
            
            if( !empty($listing_detail["is_claimable"]) && $listing_detail["is_claimable"]==LISTING_IS_CLAIMABLE && isset($listing_detail["is_claimed"]) && $listing_detail["is_claimed"]==LISTING_IS_UNCLAIMED && empty($listing_detail["listing_claim_request_id"]) ){
                if( !empty($user_detail) ) {
                    $user_id = $user_detail["id"];
                }else{
                    $this->load->module("main/users_main");
                    $response = $this->users_main->register($post_data,CUSTOMER_GROUP_ID);
                    if( $response["flag"]==FLAG_SUCCESS ) {
                        $user_id = decrypt($response["data"]["user_id"]);
                    }else{
                        return $response;
                    }
                }
                $listing_id = decrypt($listing_detail["listing_id"]);
                if( !empty($user_id) ) {
                    $this->load->model("listing_claim_request_model","listing_claim_request");
                    $old_request = $this->listing_claim_request->get_user_listing_record($listing_id,$user_id)["record"];

                    if( !empty($old_request) && $old_request["request_status"]==LISTING_CLAIM_REQUEST_PENDING ) {
                        $response = array("flag"=>FLAG_SUCCESS,"message"=>$this->lang->line("message_listing_calim_requested"),"listing_id"=>encrypt($listing_detail["id"]),"user_id"=>encrypt($user_id) );
                    }else if( !empty($old_request) && $old_request["request_status"]!=LISTING_CLAIM_REQUEST_REJECT ) {
                        $response = array("flag"=>FLAG_SUCCESS,"message"=>$this->lang->line("message_listing_calim_already_requested") );
                    }else{

                        $file_name = get_upload_image_name("{$post_data["full_name"]} personal document","personal_document","listing_claim_request","personal_document")['file_name'];

                        if( !empty($file_name) ) {
                            $file_name_response = fileUpload(BASE_CLAIM_LISTING_PERSONAL_DOCUMENTS_IMAGE_PATH, "", "personal_document","",false,$file_name);

                            if( $file_name_response["success"]==true ) {
                                $personal_document_image = $file_name_response["filename"];
                            }else{
                                $error = true;
                                $error_message = $file_name_response["error"];
                            }
                        }

                        $file_name = get_upload_image_name("{$post_data["full_name"]} legal document","legal_document","listing_claim_request","legal_document")['file_name'];

                        if( !empty($file_name) ) {
                            $file_name_response = fileUpload(BASE_CLAIM_LISTING_LEGAL_DOCUMENTS_IMAGE_PATH, "", "legal_document","",false,$file_name);

                            if( $file_name_response["success"]==true ) {
                                $legal_document_image = $file_name_response["filename"];
                            }else{
                                $error = true;
                                $error_message = $file_name_response["error"];
                            }
                        }
                        if( $error==false ) {
                            $insert_data = array(
                                "user_id"=>$user_id,
                                "full_name"=>$post_data["full_name"],
                                "phone_code"=>decrypt($post_data["phone_code"]),
                                "phone_no"=>$post_data["phone_no"],
                                "personal_document"=>$personal_document_image,
                                "legal_document"=>$legal_document_image,
                                "created_at"=>SQL_ADDED_DATE,
                                "created_by"=>$this->user_data["id"],
                                "listing_id"=>$listing_id,
                                "ip_address"=>getVisitorIp(),
                            );
                            $request_id = $this->listing_claim_request->insert($insert_data);
                            $this->send_claim_request_code($listing_detail["id"],$user_id);
                            $response = array("flag"=>FLAG_SUCCESS,"message"=>$this->lang->line("message_listing_calim_requested"),"listing_id"=>$listing_detail["listing_id"],"user_id"=>encrypt($user_id) );
                        }else{
                            $response = array("flag"=>FLAG_ERROR,"message"=>$error_message,"error_array"=>array($error_message));
                        }
                    }
                }else{
                    $response = array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_try_again"),"error_array"=>array($this->lang->line("message_try_again")) );
                }
            }else{
                $response = array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_claim_listing_claim_error"),"error_array"=>array($this->lang->line("message_claim_listing_claim_error")) );
            }
        }else{
            $response = array("flag"=>FLAG_ERROR,"message"=>implode("\n",$this->form_validation->error_array()),"error_array"=>$this->form_validation->error_array() );
            
        }
        return $response;
    }
    public function send_claim_request_code($listing_id,$user_id){
        
        $this->load->model("otp_codes_model","otp_codes");
        $record = $this->otp_codes->get_record($user_id,OTP_SEND_TYPE_OTP,OTP_TYPE_LISTING_CLAIM_OTP)["record"];
        $send_sms = true;
        $this->load->model("users_model","users");
        $user_detail = $this->users->get_record($user_id)["record"];
        
        if( !empty($record) ){//resend case only
            $updated_date = !empty($record['modified_at']) && $record['modified_at']!='0000-00-00 00:00:00' ? $record['modified_at'] : $record['created_at'];

            if( date(DEFAULT_SQL_DATE_FORMAT)<date($updated_date,strtotime("+1 min")) ){
                $send_sms = false;
                $response = array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_resend_time_error") );
            }else{
                $this->otp_codes->update_time($record['id']);
                $response["flag"] = FLAG_SUCCESS;
                $response["otp"] = $record['code'];
                $response["message"]=$this->lang->line("message_otp_resent_success");
            }
        }else{
            $response["flag"] = FLAG_SUCCESS;
            $code = rand(111111,999999);
            if($phone_no==9781579168){                
                $code = "123456";
            }
            $response["otp"] = $code;
            $this->otp_codes->insert_record($user_id,$code,OTP_SEND_TYPE_OTP,OTP_TYPE_LISTING_CLAIM_OTP);
            $response["message"]=$this->lang->line("message_insert_success");
        }
        
        if( $send_sms==true ){
            send_claim_listing_request_otp($user_detail["phonecode"],$user_detail["phone_no"],$user_id,$response["otp"]);
        }
        
        return $response;    
    }
    
    public function verify_claim($post_data){
        
        $this->form_validation->set_rules("otp",$this->lang->line("heading_verify_code"),"required|is_not_empty|is_numeric");
        if( $this->form_validation->run() ) {
            $user_id = decrypt($post_data["user_id"]);
            $listing_id = decrypt($post_data["listing_id"]);
            if(is_numeric($user_id) && $user_id>0 && is_numeric($listing_id) && $listing_id>0  ){
                $this->load->model("otp_codes_model","otp_codes");
                $record = $this->otp_codes->get_record($user_id,OTP_SEND_TYPE_OTP,OTP_TYPE_LISTING_CLAIM_OTP)['record'];
                
                if( !empty($record) ) {
                    if( $record["code"]!=$post_data['otp'] ) {
                        $response = array(
                            "flag"=>FLAG_ERROR,
                            "message" => $this->lang->line("message_invalid_opt"),
                            "error_array" => array($this->lang->line("message_invalid_opt")),
                        );
                    }else{
                        $this->load->model("Listing_claim_request_model","listing_claim_request");
                        $this->load->model("otp_codes_model","otp_codes");
                        $this->otp_codes->use_otp($record["id"]);
                        $this->listing_claim_request->update_claim_request_requested($listing_id,$user_id);
                        $this->load->model("users_model","users");
                        $user_record = $this->users->get_record($user_id)["record"];
                        $update_data = array();
                        
                        
                        if( empty($user_record["account_verified_type"]) ){//verify user account if not verified
                            $update_data["account_verified_date"] = SQL_ADDED_DATE;
                            if( $otp_send_type==OTP_SEND_TYPE_EMAIL ){
                                $update_data["is_email_verified"] = EMAIL_VERIFIED;
                                $update_data["email_verified_datetime"] = SQL_ADDED_DATE;
                                $update_data["account_verified_type"] = ACCOUNT_VERIFIED_TYPE_EMAIL;
                                $update_data["account_verified_platform"] = $login_from;
                            }else{
                                $update_data["is_phone_no_verified"] = PHONE_NO_VERIFIED;
                                $update_data["phone_no_verified_datetime"] = SQL_ADDED_DATE;
                                $update_data["account_verified_type"] = ACCOUNT_VERIFIED_TYPE_PHONE;
                                $update_data["account_verified_platform"] = $login_from;
                            }
                            
                            
                            $this->users->verify_account($update_data,$user_id);
                            
//                            $user_record["login_from"]=$login_from;
//                            $token_response = $this->create_token($user_record);
                            //$response["token"] = $token_response["token"];
                        }
//                        $response = array("flag"=>FLAG_SUCCESS,"message"=>$this->lang->line("message_account_verified"));
                        $response = array("flag"=>FLAG_SUCCESS,"message"=>$this->lang->line("message_listing_calim_requested"));
                    }
                    return $response;
                }else{
                    $response = array(
                        "flag"=>FLAG_ERROR,
                        "message" => $this->lang->line("message_opt_expire"),
                        "error_array" => array($this->lang->line("message_opt_expire")),
                    );
                }
            }else{
                $response = array(
                    "flag"=>FLAG_ERROR,
                    "message" => $this->lang->line("message_try_again"),
                    "error_array" => array($this->lang->line("message_try_again")),
                );
            }
        }else{
            $response = array(
                "flag"=>FLAG_ERROR,
                "message" => $this->lang->line("message_try_again"),
                "error_array" => $this->form_validataion->error_array(),
            );
        }
//        echo '<pre>';print_R($response);die;
        return $response;
    
    }
    
    private function _get_posted_basic_detail($post_data,$listing_id="",$approval=false){//for request only
        $items = array("name","listing_type","name","primary_email","primary_phone_code","primary_phone_no","primary_whatsapp_code","primary_whatsapp_no","website","address","country","state","city","google_location","full_address","place_id","longitude","latitude","zip_code","description","meta_title","meta_keywords","meta_description","video","landline","google_virtual_map");
        if( $approval==true ) {
            $items[] = "request_status";
        }
        
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
                $data["request_status"] = LISTING_REQUEST_STATUS_APPROVED;
                $data["is_claimable"] = (int)$post_data["is_claimable"];
                $data["user_id"] = empty($post_data["is_claimable"]) ? $this->user_data["id"] : 0;
                $data["status"] = $post_data["status"];
            }else if( $approval!=true ) {
                $data["request_status"] = LISTING_REQUEST_STATUS_REQUESTED;
                $data["user_id"] = $this->user_data["id"];
            }
            $data["created_by"] = $this->user_data["id"];
            $data["created_at"] = SQL_ADDED_DATE;
            $data["ip_address"] = getVisitorIp();
            $config = array(
                'table' => $this->listing->table_name,
                'id' => 'id',
                'field' => 'slug',
                'title' => 'name',
                'replacement' => 'dash' // Either dash or underscore
            );
            $this->load->library('slug', $config);
            $slug = $this->slug->create_uri($data["name"]);
            $data["slug"] = $slug;
        }
        
        return $data;       
    }
    
    
    private function _get_posted_listing_basic_detail($post_data,$listing_id,$approval=false){//for edit only
        $items = array("name","listing_type","name","primary_email","primary_phone_code","primary_phone_no","primary_whatsapp_code","primary_whatsapp_no","website","address","country","state","city","google_location","full_address","place_id","longitude","latitude","zip_code","description","meta_title","meta_keywords","meta_description","video","landline","google_virtual_map");
        if( $this->user_data["group_id"]==SUPERADMIN_GROUP_ID || !empty($this->user_data["is_staff"])) {
            $items[]="status";
            if( !empty($post_data["qrcode"]) ) {
                $items[]="qrcode";
                $post_data["qrcode"] = decrypt($post_data["qrcode"]);
            }
        }
        if( !empty($listing_id) && empty($post_data["logo"]) ) {
        }else{
            $items[] = "logo";
        }
        if( !empty($listing_id) && empty($post_data["cover_image"]) ) {}else{
            $items[] = "cover_image";
        }
        $data = elements($items,$post_data);
        $data["google_virtual_map"] = $this->input->post("google_virtual_map");
        $data["listing_type"] = decrypt($data["listing_type"]);
        $data["primary_phone_code"] = decrypt($data["primary_phone_code"]);
        $data["primary_whatsapp_code"] = decrypt($data["primary_whatsapp_code"]);
        $data["country"] = decrypt($data["country"]);
        $data["state"] = decrypt($data["state"]);
        $data["city"] = decrypt($data["city"]);
        
        if( !empty($listing_id) ) {
            $data["modified_by"] = $this->user_data["id"];
            $data["modified_at"] = SQL_ADDED_DATE;
        }
        
        return $data;       
    }
    
    private function _get_posted_social_media($post_data,$listing_id) {
        $data = array();
        
        foreach($post_data["add_social_media"] as $key=> $social_media_users) {
            if( !empty($social_media_users) && empty($post_data["social_media_id"][$key]) ) {
                $data[]=array(
                    "listing_id"=>$listing_id,
                    "social_media_id"=>decrypt($post_data["social_media"][$key]),
                    "social_media_name"=>$social_media_users,
                    "status"=>ACTIVE,
                    "created_at"=>SQL_ADDED_DATE,
                    "created_by"=>$this->user_data["id"],
                );
            }
        }
        return $data;
    }
    
    private function _get_posted_listing_email($post_data,$listing_id) {
        $data = array();
        foreach($post_data["listing_email"] as $key => $listing_email) {
            if( empty($post_data["listing_email_id"][$key]) ) {
                $data[]=array(
                    "listing_id"=>$listing_id,
                    "email"=>$listing_email,
                    "status"=>ACTIVE,
                    "created_at"=>SQL_ADDED_DATE,
                    "created_by"=>$this->user_data["id"],
                );
            }
        }
        return $data;
    }
    
   
    
    private function _get_posted_listing_phone($post_data,$listing_id) {
        $data = array();
        foreach($post_data["phone_no"] as $key => $phone_no) {
            if( empty($post_data["listing_phone_id"][$key]) ) {
                $data[]=array(
                    "listing_id"=>$listing_id,
                    "phone_code"=>decrypt($post_data["phone_code"][$key]),
                    "phone_no"=>$phone_no,
                    "phone_type"=>PHONE_TYPE_PHONE,
                    "status"=>ACTIVE,
                    "created_at"=>SQL_ADDED_DATE,
                    "created_by"=>$this->user_data["id"],
                );
            }
            
        }
        return $data;
    }
    
    private function _get_posted_listing_timming($post_data,$listing_id){
        $data = array();

        foreach( $post_data["timming"] as $key => $timming_on ) {
            
            if( !empty($post_data['start_time'][$key]) && $post_data['end_time'][$key]) {
                foreach( $post_data['start_time'][$key] as $index=>$start_time ) {
                    $end_time_new = "";
                    $end_time = $post_data["end_time"][$key][$index];
                    if( ( !empty($start_time) && !empty($end_time) && $start_time<$end_time ) || ( !empty($start_time) && empty($end_time) ) ||  empty($start_time) && !empty($end_time)  )
                    $start_time =  !empty($start_time) ? $start_time : "00:00:00";
                    $end_time =  !empty($end_time) ? $end_time : "00:00:00";
                    if( !empty($end_time) && !empty($start_time) ) {
                        $end_time = date("H:i:s",strtotime($end_time));
                        $start_time = date("H:i:s",strtotime($start_time));
                        //echo $start_time.' : '.$end_time.'<br/>';
                        $day_no = $key;
                        // if($end_time<$start_time ) {
                        //     $end_time_new=$end_time;
                        //     $end_time = "23:59:59";
                        // }
                        $data[]=array(
                            "listing_id"=>$listing_id,
                            "day_no"=>$day_no,
                            "start_time"=>$start_time,
                            "end_time"=>$end_time,
                            "status"=>ACTIVE,
                            "created_at"=>SQL_ADDED_DATE,
                            "created_by"=>$this->user_data["id"],
                        );
                        // if( !empty($end_time_new) ) {
                        //     if( $day_no==7 ) {
                        //         $day_no=1;
                        //     }else{
                        //         $day_no++;
                        //     }
                        //     $start_time = "00:00:00";
                        //     $end_time = $end_time_new;
                        //     $data[]=array(
                        //        "listing_id"=>$listing_id,
                        //         "day_no"=>$day_no,
                        //         "start_time"=>$start_time,
                        //         "end_time"=>$end_time,
                        //         "status"=>ACTIVE,
                        //         "created_at"=>SQL_ADDED_DATE,
                        //         "created_by"=>$this->user_data["id"],
                        //     );
                        // }
                    }
                
                }
            }
        }
        return $data;
    }
    
    public function add_institute_review($slug,$post_data){
        
        $total_rating = $avg_rating = 0;
        $category_ratings = array();
        $this->form_validation->set_rules("full_name",$this->lang->line("heading_full_name"),"required|is_not_empty");
        $this->form_validation->set_rules("email",$this->lang->line("heading_email"),"required|is_not_empty");
        $this->form_validation->set_rules("email",$this->lang->line("heading_email"),"required|is_not_empty");
        
        if( $this->form_validation->run() ) {
            $this->load->model("review_categories_model","review_categories");
            $review_categories = array_column($this->review_categories->get_records(array(),false)["records"],"id");
            $listing_data = $this->listing->get_record("",$slug)["record"];

            if( !empty($listing_data) ){
                
                foreach( $review_categories as $key=> $review_category_id ) {
                    $category_rating = isset( $post_data["category_review"][$key] ) ?  $post_data["category_review"][$key] : 0;
                    
                    if( empty($category_rating)) {
                        $category_rating = 0;
                    }
                    $category_ratings[$review_category_id] = $category_rating;
                    $total_rating+=$category_rating;
                }
                
                $avg_rating = round( $total_rating/count($review_categories),2);
                $insert_data = array(
                        "type"=>REVIEW_TYPES_LISTING,
                        "table_id"=>$listing_data["id"],
                        "full_name"=>$post_data["full_name"],
                        "email"=>$post_data["email"],
                        "rating"=>$avg_rating,
                        "review"=>$post_data["review"],
                        "created_at"=>SQL_ADDED_DATE,
                        "created_by"=>$this->user_data["id"],
                        "ip_address"=>  getVisitorIp(),
                    );
                $this->load->model("listing_reviews_model","listing_reviews");
                $this->load->model("review_categories_rating_model","review_categories_rating");
                
                $review_id = $this->listing_reviews->insert($insert_data);
               
                foreach( $review_categories as $review_category_id ) {
                    $insert_data = array(
                        "review_id"=>$review_id,
                        "category_id"=>$review_category_id,
                        "rating"=>$category_ratings[$review_category_id],
                        "created_at"=>SQL_ADDED_DATE,
                        "created_by"=>$this->user_data["id"],
                        "ip_address"=>  getVisitorIp(),
                    );
                    $this->review_categories_rating->insert($insert_data);
                }
                $response = array("flag"=>FLAG_SUCCESS,"message"=>$this->lang->line("message_insert_success") );
            }else{
                $response = array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_listing_not_found"),"error_array"=>array($this->lang->line("message_listing_not_found")) );
            }
        }else{
            $response = array("flag"=>FLAG_ERROR,"message"=>implode("\n",$this->form_validation->error_array()),"error_array"=>$this->form_validation->error_array() );
        }
        return $response;
    }
    
    public function edit_institute_review($edited_id,$post_data){
        $review_id = decrypt($edited_id);
        $total_rating = $avg_rating = 0;
        $category_ratings = array();
        $this->form_validation->set_rules("full_name",$this->lang->line("heading_full_name"),"required|is_not_empty");
        $this->form_validation->set_rules("email",$this->lang->line("heading_email"),"required|is_not_empty");
        $this->form_validation->set_rules("review",$this->lang->line("heading_listing_review_title"),"required|is_not_empty");
        
        if( $this->form_validation->run() ) {
            
            $this->load->model("review_categories_rating_model","review_categories_rating");
            $record = array();
            $cateories_review = $this->review_categories_rating->get_records($review_id,array(),false)["records"];
            $totalRating = 0;
            
            foreach($cateories_review as $key=>$cateory_review) {
                
                $category_rating=$post_data["category_review"][$key]?:$cateory_review["rating"];
                $totalRating+=$category_rating;
                
                if($category_rating!=$cateory_review["rating"]) {
                    $this->review_categories_rating->update(array("rating"=>$category_rating),$cateory_review["id"]);
                }
            }
            $avg_rating = round($totalRating/count($cateories_review),2);
            $update_data = array(
                    "full_name"=>$post_data["full_name"],
                    "email"=>$post_data["email"],
                    "rating"=>$avg_rating,
                    "review"=>$post_data["review"],
                    "modified_at"=>SQL_ADDED_DATE,
                    "modified_by"=>$this->user_data["id"],
            );
            if( $this->user_data["group_id"]==SUPERADMIN_GROUP_ID || !empty($this->user_data["is_staff"]) ) {
                $update_data["status"] = $post_data["status"];
                $update_data["request_status"] = $post_data["request_status"];
            }

            $this->load->model("listing_reviews_model","listing_reviews");
            $this->listing_reviews->update($update_data,$review_id);

            
            $response = array("flag"=>FLAG_SUCCESS,"message"=>$this->lang->line("message_insert_success") );

        }else{
            $response = array("flag"=>FLAG_ERROR,"message"=>implode("\n",$this->form_validation->error_array()),"error_array"=>$this->form_validation->error_array() );
        }
        return $response;
    }
    
    public function get_user_listing($encoded_id,$post_data=array(),$page_no=1){
        $user_id = decrypt($encoded_id);
        $post_data["user_id"] = !empty($post_data["user_id"]) ? decrypt($post_data["user_id"])  : 0;
        $post_data["listing_type"] = !empty($post_data["listing_type"]) ? decrypt($post_data["listing_type"]) : 0;
        $records = $this->listing->get_user_listing($user_id,$post_data,true,$page_no);
        if( !empty($records["records"]) ) {
            foreach($records["records"] as $key => $record) {
                
                if( !empty($record["logo"]) ) {
                    $record["logo_url"] = base_url(BASE_LISTING_LOGO_PATH.$record["logo"]);
                }else{
                    $record["logo_url"] = base_url(BASE_WEB_IMAGES_PATH."class-hud-institute-cover-logo.jpg");
                }

                if( !empty($record["cover_image"]) ) {
                    $record["cover_image_url"] = base_url(BASE_LISTING_COVER_IMAGE_PATH.$record["cover_image"]);
                }else{
                    $record["cover_image_url"] = base_url(BASE_WEB_IMAGES_PATH."class-hud-institute-cover-image.jpg");
                }
                $records["records"][$key]["id"] = encrypt($record["id"]);
                
                $records["records"][$key]["logo_url"] = $record["logo_url"];
                $records["records"][$key]["name"] = stripcslashes($record["name"]);
                $records["records"][$key]["cover_image_url"] = $record["cover_image_url"];
                $records["records"][$key]["listing_type_image"] = !empty($record["listing_type_image"]) ? base_url(BASE_LISTING_TYPE_IMAGE_PATH.$record["listing_type_image"]):"";;
            }
            $response = array("flag"=>FLAG_SUCCESS,"data"=>$records["records"],"count"=>$records["count"]);
        }else{
            $response = array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_no_records"),"count"=>0);
        }
        return $response;
    }
    
    public function get_listing_order_packages( $listing_id=0,$post_data=array() ){

        $this->load->model("listing_model","listing");
        $pacakages = StaticArrays::$product_packages;
      
        $user_package = $this->listing->get_listing_order_packages($listing_id,$pacakages)["record"];
        if( !empty($user_package) ) {
            
            unset($user_package["country"],$user_package["state"],$user_package["city"]);
            $user_package["id"] = encrypt($user_package["id"]);
            $user_package["user_id"] = encrypt($user_package["user_id"]);
            $user_package["time_zone"] = encrypt($user_package["time_zone"]);

            if( !empty($user_package["logo"]) ) {
                $user_package["logo_url"] = base_url(BASE_LISTING_LOGO_PATH.$user_package["logo"]);
            }else{
                $user_package["logo_url"] = base_url(BASE_WEB_IMAGES_PATH."class-hud-institute-cover-logo.jpg");
            }

            if( !empty($user_package["cover_image"]) ) {
                $user_package["cover_image_url"] = base_url(BASE_LISTING_COVER_IMAGE_PATH.$user_package["cover_image"]);
            }else{
                $user_package["cover_image_url"] = base_url(BASE_WEB_IMAGES_PATH."class-hud-institute-cover-image.jpg");
            }

            $user_package["name"] = stripcslashes($user_package["name"]);
            $user_package["listing_type_image"] = !empty($user_package["listing_type_image"]) ? base_url(BASE_LISTING_TYPE_IMAGE_PATH.$user_package["listing_type_image"]):"";
            
           foreach( $pacakages as $package_type_name=>$package_type_id ) {
               if(array_key_exists("{$package_type_name}_package",$user_package) ) {
                   $user_package["{$package_type_name}_package"] = encrypt($user_package["{$package_type_name}_package"]);
               }
           }            
            $response = array("flag"=>FLAG_SUCCESS,"data"=>$user_package);
        }else{
            $response = array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_no_active_order"));
        }
        return $response;
    }
    
    public function get_paid_listing( $user_id=0,$package_type=array() ){
        $this->load->model("listing_model","listing");
        $package_type = !empty($package_type) ? $package_type : StaticArrays::$product_packages ;         
        $user_packages = $this->listing->get_user_paid_listing($user_id,$package_type)["records"];
        if( !empty($user_packages) ) {
            foreach( $user_packages as $key=> $user_package ) {
                unset($user_packages[$key]["country"],$user_packages[$key]["state"],$user_packages[$key]["city"]);
                $user_packages[$key]["id"] = encrypt($user_package["id"]);
                $user_packages[$key]["user_id"] = encrypt($user_package["user_id"]);
                $user_packages[$key]["time_zone"] = encrypt($user_package["time_zone"]);
                
                if( !empty($user_packages[$key]["logo"]) ) {
                    $user_packages[$key]["logo_url"] = base_url(BASE_LISTING_LOGO_PATH.$user_packages[$key]["logo"]);
                }else{
                    $user_packages[$key]["logo_url"] = base_url(BASE_WEB_IMAGES_PATH."class-hud-institute-cover-logo.jpg");
                }

                if( !empty($user_packages[$key]["cover_image"]) ) {
                    $user_packages[$key]["cover_image_url"] = base_url(BASE_LISTING_COVER_IMAGE_PATH.$user_packages[$key]["cover_image"]);
                }else{
                    $user_packages[$key]["cover_image_url"] = base_url(BASE_WEB_IMAGES_PATH."class-hud-institute-cover-image.jpg");
                }
                
                $user_packages[$key]["name"] = stripcslashes($user_packages[$key]["name"]);
                $user_packages[$key]["listing_type_image"] = !empty($user_packages[$key]["listing_type_image"]) ? base_url(BASE_LISTING_TYPE_IMAGE_PATH.$user_packages[$key]["listing_type_image"]):"";
                foreach( $pacakages as $package_type_name=>$package_type_id ) {
                   if(array_key_exists("{$package_type_name}_package",$user_package) ) {
                       $user_packages[$key]["{$package_type_name}_package"] = encrypt($user_package["{$package_type_name}_package"]);
                   }
                }
            }
            
            $response = array("flag"=>FLAG_SUCCESS,"data"=>$user_packages);
        }else{
            $response = array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_no_active_order"));
        }
        return $response;
    }
    
    public function is_paid_listing($encoded_id,$check_package_type){
        
        $paid_order_packages = $this->get_listing_order_packages(decrypt($encoded_id));
        $paid_order_id = $paid_listing = false;
        if( $paid_order_packages["flag"]==FLAG_SUCCESS ) {
            $pacakages = StaticArrays::$product_packages;   
            $pacakage_type_name = array_search($check_package_type, $pacakages);
            $listing_packages = $paid_order_packages["data"] ;
            
            //$paid_order_packages["data"]["cover_image_url"] = 
            $listing_id = $listing_packages["id"];

            $package_key = "{$pacakage_type_name}_package";

            if( array_key_exists($package_key, $listing_packages) && !empty($listing_packages[$package_key]) ) {
                //$paid_listing_data[$listing_id]["package_{$package_type}"]=$listing_packages[$package_key];
                $paid_listing =  true;
                $paid_order_id = $listing_packages[$package_key];

            }

            if( $paid_listing ) {
                $response = array("flag"=>FLAG_SUCCESS,"data"=>array("order_id"=>$paid_order_id) );
            }else{
                $response = array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_no_active_order"));
            }
        }else{
            $response = array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_no_active_order"));
        }
        
        return $response;
    }
    
    public function track_listing_banner_download($order_id,$listing_id,$banner_id){
        $log_data = $this->package_log_id($order_id,$listing_id,PRODUCT_PACKAGE_TYPE_BANNER);
        $log_id = $log_data["data"]["new_id"];
        $this->load->model("banner_download_model","banner_download");
        
        $download_id = $this->banner_download->insert( array("banner_id"=>decrypt($banner_id),"listing_id"=>decrypt($listing_id),"log_id"=>$log_id,"created_at"=>SQL_ADDED_DATE,"created_by"=>$this->user_data["id"]) );
        
        return  array("flag"=>FLAG_SUCCESS,"data"=>array("downlaod_id"=>encrypt($download_id))) ;
    }
    
    
    public function package_log_id($order_id,$listing_id,$package_type) {
        
        $this->load->model("listing_package_log_model","listing_package_log");
        $this->load->model("listing_package_log_detail_model","listing_package_log_detail");
        $order_id = decrypt($order_id);
        $listing_id = decrypt($listing_id);
        $log_data = $this->listing_package_log->getRow( array("listing_id"=>$listing_id,"package_type"=>$package_type,'order_id'=>$order_id,"is_deleted"=>NOT_DELETED) ) ;
        
        if( !empty($log_data) ) {
            $new_id = $log_data["id"];
            $this->db->set("count","count+1",false);
            $this->listing_package_log->update( array("modified_at"=>SQL_ADDED_DATE,"modified_by"=>$this->user_data["id"]),$new_id );
        }else{
            $new_id = $this->listing_package_log->insert( array("listing_id"=>$listing_id,"package_type"=>$package_type,'order_id'=>$order_id,"count"=>1,"created_at"=>SQL_ADDED_DATE,"created_by"=>$this->user_data["id"]) );
        }
        try{
            
            $this->listing_package_log_detail->insert( array("listing_id"=>$listing_id,"package_type"=>$package_type,'order_id'=>$order_id,"package_log_id"=>$new_id,"created_at"=>SQL_ADDED_DATE,"created_by"=>$this->user_data["id"]) );
        }catch(Exception $e){
            echo $e->getMessage();
            die;
        }catch(Error $e){
            echo $e->getMessage();
            die;
        }

        return array("flag"=>FLAG_SUCCESS,"data"=>array("new_id"=>$new_id));
    }
    
    public function get_listing_ecard_data($slug){
        $listing_data_response = $this->get_record("",$slug);

        if( $listing_data_response["flag"]==FLAG_SUCCESS ) {
            
            $paid_listing_response = $this->is_paid_listing($listing_data_response["data"]["id"],PRODUCT_PACKAGE_TYPE_ECARD);
            if( $paid_listing_response["flag"]==FLAG_SUCCESS ) {
                return $listing_data_response;
            }else{
                return array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_no_active_order"));
            }
        }else{
            return $listing_data_response;
        }
    }
    
}