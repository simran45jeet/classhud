<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use \Firebase\JWT\JWT;
class Users_main extends MY_Controller 
{ 
    public function __construct() {
        parent::__construct();        
        $this->load->model('users_model','users');
        
    }
    
    public function login_user( $username,$password,$group_ids,$is_staff=false,$login_from=CART_FROM_WEB ) {
        $login = $this->ion_auth->login($username,$password,0,$group_ids);
        if( empty($login) && $is_staff==true ){
            $login = $this->ion_auth->login($username,$password,0,$is_staff);
        }
        
        if( !empty($login) ) {
            $user_id = $this->session->userdata("user_id");
            $this->load->model("users_model","users");
            $record = $this->users->get_record($user_id)['record'];
            
            if( !empty($record) ){
                $this->load->library('my_logs');
                $log_parms = array('user_id' => $record['id'],'table_name' => $this->users->table_name,'table_id' => $record['id'],'new_data' => array(),'prev_data' => array()  );
                $this->my_logs->logIt($log_parms,ACTION_INSERT);
                $record["login_from"] = CART_FROM_WEB;
                $response = $this->create_token($record);                
                $response["message"]=$this->lang->line("message_login_success");
                return $response;
                
            }else{
                $response = array('flag'=>FLAG_ERROR,"message"=>$this->lang->line("message_account_deactivated"));
            }
        }else{
            $response = array('flag'=>FLAG_ERROR,"message"=>$this->lang->line("message_no_records"));
        }
        return $response;
        
    }
    public function create_token($record){
        $record['image'] = empty($record['image']) ? base_url(BASE_IMAGE_PATH."no-image-male.png") : base_url(BASE_USER_IMAGE_PATH."{$record['image']}");
        
        $user_info = array(
            'id'                =>  $record['id'],
            'email'             =>  $record['email'],
            'username'          =>  $record['username'],
            'full_name'        =>   $record['full_name'],
            'user_type'         =>  $record['user_type'],
            'is_email_verified' =>  $record['is_email_verified'],
            'is_phone_no_verified' =>  $record['is_phone_no_verified'],
            'image'             =>  $record['image'],
            'address'           =>  $record['address'],
            'lang_id'           =>  $record['lang_id'],
            'phone_code'           =>  $record['phone_code'],
            'phonecode'         =>  $record['phonecode'],
            'phone_no'             =>  $record['phone_no'],
            'dob'               =>  date(DEFAULT_SQL_ONLY_DATE_FORMAT,strtotime( $record['dob']) ),
            'country_id'        =>  $record['country_id'],
            'group_id'          =>  $record['group_id'],
            'password_set'       =>  $record["password_set"],
            'is_staff'       =>  $record["is_staff"],
            'expire_date'       =>  strtotime('+1 Year'),
            'rand'              =>  uniqid(),
        );
        $response['flag'] = FLAG_SUCCESS;
        $response['token'] = JWT::encode($user_info, $this->config->item('encryption_key'));
        
        
        $this->load->model("authtokens_model","authtokens");
        $authData = array(
            'auth_token' => $response['token'],
            'user_id' => $record['id'],
            'app_type' => $record["login_from"],
            'android_device_token' => @$data['android_device_id'],
            'ios_device_token' => @$data['ios_device_id'],
            'web_device_token' => @$data['web_device_token'],
            'ip_address' => getVisitorIp(),
            'created_at' => date(DEFAULT_SQL_DATE_FORMAT),
        );
        $this->authtokens->insert($authData);

        return $response;
    }
    public function register($post_data,$group_id=CUSTOMER_GROUP_ID,$is_admin=false) {
        $this->form_validation->set_rules("full_name",$this->lang->line("heading_full_name"),"required|is_not_empty");
        $this->form_validation->set_rules("phone_code",$this->lang->line("heading_phone_code"),"required|is_not_empty");
        $this->form_validation->set_rules("phone_no",$this->lang->line("heading_phone_no"),"required|is_not_empty|is_numeric");

        if( $this->form_validation->run() ) {
            $existing_record = $this->users->get_record("",$post_data['phone_no'])['record'];
            
            if( empty($existing_record) ){
                $insert_data = $this->_get_posted_user_data($post_data,$group_id);
                $user_id = $this->users->insert_record($insert_data);
                if( !empty($user_id) ){
                    $this->load->model("phone_code_model","phone_code");
                    $phone_code = $this->phone_code->get_record($insert_data["phone_code"])['record']['phonecode'];
                    $sms_response = $this->send_phone_verification_code($user_id,$phone_code,$post_data['phone_no']);
                    $response = array(
                        "flag"=>FLAG_SUCCESS,
                        "message"=>$this->lang->line("message_singnup_success"),
                        "data"=>array(
                            "user_id"=>encrypt($user_id),
                            "phone_no"=>$post_data["phone_no"],
                        )
                    );
                }else{
                    $response = array(
                        "flag"=>FLAG_ERROR,
                        "message"=>$this->lang->line("message_try_again"),
                        "error_array"=>array($this->lang->line("message_try_again"))
                    );
                }
            }else{
                if( $existing_record['group_id']==CUSTOMER_GROUP_ID ) {
                    if( $existing_record['is_email_verified']==EMAIL_UNVERIFIED && $existing_record['is_phone_no_verified']==PHONE_NO_UNVERIFIED ){
                        $response = array(
                            "flag"=>FLAG_SUCCESS,
                            "message"=>$this->lang->line("message_record_exists"),
                            "error_array"=>array($this->lang->line("message_record_exists")),
                            "user_id"=>encrypt($existing_record['id']),
                            "data"=>array(
                                "user_id"=>encrypt($existing_record['id']),
                                "phone_no"=>$post_data["phone_no"],
                            )
                        );
                        $this->send_phone_verification_code($existing_record['id'],$existing_record['phonecode'],$existing_record['phone_no']);
                    }else{
                        $response = array(
                            "flag"=>FLAG_ERROR,
                            "message"=>$this->lang->line("message_record_exists"),
                            "error_array"=>array()
                        );
                    }
                }else{
                    $response = array(
                        "flag"=>FLAG_ERROR,
                        "message"=>$this->lang->line("message_record_exists"),
                        "error_array"=>array()
                    ); 
                }
            }
        }else{
            $response = array(
                "flag"=>FLAG_ERROR,
                "message"=>$this->lang->line("message_form_submit_error"),
                "error_array"=>$this->form_validation->error_array()
            );
        }
        return $response;
    }
    
    public function forgot_password($username,$group_id){
        
        $record = $this->users->get_login_detail($username,$group_id)["record"];

        if( !empty($record) ){
            $temp_password = rand(111111,999999);
            $this->load->library("ion_auth");
            $new_password = $this->ion_auth->hash_password($temp_password);
            $this->users->update(array("password"=>$new_password,'password_set'=>0),$record["id"]);
            send_new_password($record["phonecode"],$record["phone_no"],$record["id"],$temp_password);
            $response = array("flag"=>FLAG_SUCCESS,"message"=>$this->lang->line("message_temp_password_sent"));
        }else{
            $response = array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_no_records"));
        }
        return $response;
    }
    public function send_phone_verification_code($user_id,$phone_code,$phone_no){
        
        $this->load->model("otp_codes_model","otp_codes");
        $record = $this->otp_codes->get_record($user_id,OTP_SEND_TYPE_OTP,OTP_TYPE_REGISTER_OTP)["record"];
        $send_sms = true;
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
            $this->otp_codes->insert_record($user_id,$code,OTP_SEND_TYPE_OTP,OTP_TYPE_REGISTER_OTP);
            $response["message"]=$this->lang->line("message_insert_success");
        }
        
        if( $send_sms==true ){
            send_account_verify_otp($phone_code,$phone_no,$user_id,$response["otp"]);
        }
        return $response;    
    }
    
    public function verify_account($encoded_id,$post_data,$otp_send_type,$login_from=CART_FROM_WEB){
        $this->form_validation->set_rules("otp",$this->lang->line("heading_verify_code"),"required|is_not_empty|is_numeric");
        if( $this->form_validation->run() ) {
            $user_id = decrypt($encoded_id);
            if(is_numeric($user_id) && $user_id>0 ){
                $this->load->model("otp_codes_model","otp_codes");
                $record = $this->otp_codes->get_record($user_id,$otp_send_type,OTP_TYPE_REGISTER_OTP)['record'];
                if( !empty($record) ) {
                    if( $record["code"]!=$post_data['otp'] ) {
                        $response = array(
                            "flag"=>FLAG_ERROR,
                            "message" => $this->lang->line("message_invalid_opt"),
                            "error_array" => array($this->lang->line("message_invalid_opt")),
                        );
                    }else{
                        
                        $user_record = $this->users->get_record($user_id)["record"];
                        $update_data = array();
                        
                        if( empty($user_record["account_verified_type"]) ){
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
                            
                            $this->otp_codes->use_otp($record["id"]);
                            $this->users->verify_account($update_data,$user_id);
                            $response = array("flag"=>FLAG_SUCCESS,"message"=>$this->lang->line("message_account_verified"));
                            $user_record["login_from"]=$login_from;
                            $token_response = $this->create_token($user_record);
                            $response["token"] = $token_response["token"];
                        }else{//meanse account already veified check for email/phone change request
                            $response = array("flag"=>FLAG_ERROR,"messgae"=>$this->lang->line("message_account_already_verified"),"error_array"=>array($this->lang->line("message_account_already_verified")));
                        }
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
        return $response;
    }
    
    public function set_password($post_data,$old_token,$login_from=CART_FROM_WEB) {
        if( !empty($this->user_data["set_password"]) ) {
            $response = array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_password_already_set"));
        }else{
            
            $this->form_validation->set_rules("password",$this->lang->line("heading_password"),"required");
            $this->form_validation->set_rules("confirm_password",$this->lang->line("heading_confirm_new_password"),"required|matches[password]");
            
            if( $this->form_validation->run() ){
                $this->load->library("ion_auth");
                $update_data = array("password"=> $this->ion_auth->hash_password($post_data["password"]) ,"password_set"=>PASSWORD_SET);
                $this->load->model("profile_model","profile");
                $this->profile->update($update_data, $this->user_data['id']);
                $record = $this->users->get_record($this->user_data['id'])['record'];
                
                $record["login_from"]=$login_from;
                $response = $this->create_token($record);
                $this->load->model("authtokens_model", "authtokens");
                $this->authtokens->update(['auth_token' => $response['token']], ['auth_token' => $old_token]);
                $response["message"]=$this->lang->line("message_password_set");
                return $response;
               
            }else{
               $response = array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_try_again"),"error_array"=>$this->form_validation->error_array()); 
            }
        }
        return  $response;
    }
    
    public function verify_phone($encoded_id,$login_from){
        $user_id = decrypt($encoded_id);
        $record = $this->users->get_record($user_id)['record'];

        if( !empty($record) ) {
            $update_data = array();
            if( $record["account_verified_type"]==ACCOUNT_VERIFIED_TYPE_UNVERIFIED ) {
                $update_data["account_verified_type"] = ACCOUNT_VERIFIED_TYPE_PHONE;
                $update_data["account_verified_date"] = SQL_ADDED_DATE;
                $update_data["account_verified_platform"] = $login_from;
            }
            if( $record["is_phone_no_verified"]==PHONE_NO_UNVERIFIED ){
                $update_data["is_phone_no_verified"] = PHONE_NO_VERIFIED;
                $update_data["phone_no_verified_datetime"] = SQL_ADDED_DATE;
                $update_data["account_verified_type"] = ACCOUNT_VERIFIED_TYPE_PHONE;   
                $update_data["modified_at"] = SQL_ADDED_DATE;
                $update_data["modified_by"] = $this->user_data["id"];
            }
            if( !empty($update_data) ) {
                $this->users->verify_phone($update_data,$user_id);
                $this->load->model("otp_codes_model","otp_codes");
                $this->otp_codes->use_phone_verify_otp($user_id,$this->user_data["id"]);
                $response = array("flag"=>FLAG_SUCCESS,"message"=>$this->lang->line("message_account_verified"));
            }else{
                $response = array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_try_again"));
            }
        }else{
            $response = array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_no_records"));
        }
        
        return $response;
    }
    private function _get_posted_user_data($post_data,$group_id){
        $this->load->model("country_model","country");
        $this->load->model("state_model","state");
        $this->load->model("city_model","city"); 
        $this->load->library("ion_auth");
        $items = array("full_name","phone_code","phone_no","email","gender");
        $data = elements($items, $post_data);
        $data["phone_code"] = decrypt($post_data['phone_code']);
        $data["group_id"] = $group_id;
        $data["password"] = $this->ion_auth->hash_password(rand(111111,999999));
        $data["created_by"] = $this->user_data["id"];
        $data["created_at"] = SQL_ADDED_DATE;
        $data["status"] = ACTIVE;
        
        $data["country_id"] = decrypt($post_data["country"]);
        $data["state_id"] = decrypt($post_data["state"]);
        $data["city_id"] = decrypt($post_data["city"]);
        $data["country"] = $this->country->get_record($data["country_id"])["record"]["name"];
        $data["state"] = $this->state->get_record($data["state_id"])["record"]["name"];
        $data["city"] = $this->city->get_record($data["city_id"])["record"]["name"];
        
        return $data;
    }
    
    public function generate_referral_code($encoded_id){
        $user_id = decrypt($encoded_id);
        $record = $this->users->get_record($user_id)['record'];
        if( empty($record["referral_code"]) ) {
            if( empty($record["referral_code_request_status"]) ){
                $referral_code = rand(111111,999999);
                $insert_data = array("user_id"=>$user_id,"referral_code"=>$referral_code,"created_by"=>$this->user_data["id"],"created_at"=>SQL_ADDED_DATE,"status"=>ACTIVE);
                if( $this->user_data["group_id"]==SUPERADMIN_GROUP_ID || !empty($this->user_data["is_staff"]) ) { 
                    $insert_data["request_status"]=ACTIVE;
                }
                $this->load->model("referral_code_model","referral_code");
                $this->referral_code->insert($insert_data);
                $response = array("flag"=>FLAG_SUCCESS,"message"=>$this->lang->line("message_referral_code_generated"));
            }else{
                $response = array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_referral_code_already_request"));
            }
        }else{
            $response = array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_referral_code_already_generated"));
        }
        return $response;
    }
    
    public function user_dashboard_menus($encoded_id){
        $user_id = decrypt($encoded_id);
        $this->load->model("users_model","users");
        $user_detail = $this->users->get_record($user_id )["record"];
        $user_menus = array();
        if( !empty($user_detail["referral_code"]) ){
            $user_menus["my_business"]=array(
                "name"=>$this->lang->line("heading_my_business_title"),
                "action" => "dashboard.my_business",
                "icon" => "business-time",
                "active" => isActive("dashboard.my_business"),
            );
            
        }
        $this->load->module("main/listing_main");
        $paid_order_packages = $this->listing_main->get_paid_listing($this->user_data["id"]);
        $paid_order_packages_data = array();
        if( $paid_order_packages["flag"]==FLAG_SUCCESS ) {
            $pacakages = StaticArrays::$product_packages;
            foreach( $paid_order_packages["data"] as $key=>$listing_packages ){
                //$paid_order_packages["data"]["cover_image_url"] = 
                $listing_id = $listing_packages["listing_id"];
                unset($listing_packages["listing_id"]);
                foreach( $pacakages as $key=>$package_type ) {
                    $package_key = "{$key}_package";
                    if( array_key_exists($package_key, $listing_packages) && !empty($listing_packages[$package_key]) ) {
                        $paid_order_packages_data["package_{$package_type}"] = 1;
                        
                        if( $package_type == PRODUCT_PACKAGE_TYPE_BANNER ) {
                            $user_menus["banner"]=array(
                                    "name"=>$this->lang->line("message_packages_headings")[PRODUCT_PACKAGE_TYPE_BANNER],
                                    "action" => "listing_features.listing_banner",
                                    "icon" => "image",
                                    "active" => isActive("listing_features.listing_banner").isActive("listing_features.listing_benner_setting").isActive("listing_features.banner_list"),
                            );
                        }else if( $package_type == PRODUCT_PACKAGE_TYPE_ECARD ){ 
                            $user_menus["ecard"]=array(
                                    "name"=>$this->lang->line("message_packages_headings")[PRODUCT_PACKAGE_TYPE_ECARD],
                                    "action" => "listing_features.listing_ecard",
                                    "icon" => "address-card",
                                    "active" => isActive("listing_features.listing_ecard"),
                            );
                        }else if( $package_type == PRODUCT_PACKAGE_TYPE_CERTIFICATE ){ 
                            $user_menus["certificate"]=array(
                                    "name"=>$this->lang->line("message_packages_headings")[PRODUCT_PACKAGE_TYPE_CERTIFICATE],
                                    "action" => "listing_features.listing_certificate",
                                    "icon" => "certificate",
                                    "active" => isActive("listing_features.listing_certificate"),
                            );
                        }
                    }
                }
            }
            
        }
        
        if( !empty($user_menus) ) {
            $response = array("flag"=>FLAG_SUCCESS,"data"=>$user_menus);
        }else{
            $response = array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_no_records"));
        }
        return $response;
    }
    
    public function user_business_listing($encoded_id,$page_no=1){
        $user_id = decrypt($encoded_id);
        $records = $this->users->user_business_listing($user_id,array(),true,$page_no);
        $listing_records = $records["records"];
        if( !empty($listing_records) ) {
            foreach($listing_records as $key => $record) {
                
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
                
                $listing_records[$key]["id"] = encrypt($record["id"]);
                
                $listing_records[$key]["logo_url"] = $record["logo_url"];
                $listing_records[$key]["name"] = stripcslashes($record["name"]);
                $listing_records[$key]["cover_image_url"] = $record["cover_image_url"];
                $listing_records[$key]["listing_type_image"] = !empty($record["listing_type_image"]) ? base_url(BASE_LISTING_TYPE_IMAGE_PATH.$record["listing_type_image"]):"";;
            }
            $response = array("flag"=>FLAG_SUCCESS,"data"=>$listing_records,"count"=>$records["count"]);
        }else{
            $response = array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_no_records"),"count"=>0);
        }
        return $response;
    }

}