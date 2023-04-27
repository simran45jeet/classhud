<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends MY_Controller { 
    public $layout_view = "layout/web";
    
    public function __construct() {
        parent::__construct();
        $this->data = array("module_name"=>$this->module_name,"controller_name"=>$this->controller_name);
        $this->load->model("phone_code_model","phone_code");
        
    }
    
    public function signin(){
        $this->data["main_form_url"] = base_url("users/signin");
        if( !empty($this->post_data) ) {
            $this->form_validation->set_rules("username",$this->lang->line("heading_username"),"required|is_not_empty");
            $this->form_validation->set_rules("password",$this->lang->line("heading_password"),"required|is_not_empty");
            if( $this->form_validation->run() ){
               $this->load->module("main/users_main") ;
               
                $response =  $this->users_main->login_user($this->post_data["username"],$this->post_data["password"],array(CUSTOMER_GROUP_ID)); 
                if( isAjax() ) {
                    $response["url"] = base_url("dashboard");
                    if( $response["flag"]==FLAG_SUCCESS ){
                       $this->session->set_userdata("web_user_data", $response['token']);
                    }
                    echo json_encode($response);
                    die;
                }else if( $response["flag"]==FLAG_SUCCESS ){
                    $this->session->set_userdata("web_user_data", $response['token']);
                    redirect($this->base_url);
                }else{
                   error($response["message"]);
                   redirect($this->base_url);
                }
            }
        }else{
            redirect($this->base_url);
        }
        $this->layout->view("{$this->module_name}/{$this->controller_name}/login",$this->data);
    }
    
    public function signup() {
        $this->data["main_form_url"] = base_url("users/signup");
        $post_data = array("only_active"=>true);
        $this->data['phone_codes'] = $this->phone_code->get_records($post_data,false)['records'];
        if( !empty($this->post_data) ) {
            $this->load->module("main/users_main");
            $response = $this->users_main->register($this->post_data);
            if( $response["flag"]==FLAG_SUCCESS ) {
                redirect( base_url("users/verify_account/{$response["data"]["user_id"]}") );
            }else{
                error($response["message"]);
            }
        }
        $this->layout->view("{$this->module_name}/{$this->controller_name}/register",$this->data);
    }
    
    public function set_password() {
        $this->load->module("main/users_main");
        $response = $this->users_main->set_password($this->post_data,$this->session->userdata("web_user_data"));
        if($response["flag"]==FLAG_SUCCESS){
            $this->session->set_userdata("web_user_data", $response['token']);
        }
        echo json_encode($response);
        
    }
    
    public function signout() {
        
        $this->data['title'] = "Logout";
        $webUserData = '';
        $user_data = $this->session->userdata("web_user_data");
        
        if( !empty($user_data) ){
            $this->load->model('authtokens_model');
            $this->authtokens_model->delete(["auth_token" =>$user_data]);
            $this->session->unset_userdata("userData");
        }
       
        //log the user out
        $logout = $this->ion_auth->logout();
        
        $this->session->unset_userdata(array('language'));
        
        //redirect them to the login page
        $this->session->set_flashdata("message", $this->lang->line("message_logout_success"));
        redirect($this->base_url);
    
    }
    
    public function forgot_password() {
        $this->data["main_form_url"] = base_url("users/forgot_password");
        $this->data['phone_codes'] = $this->phone_code->get_records($post_data,false)['records'];
        if( !empty($this->post_data) ) {
            $this->load->module("main/users_main");
            $response = $this->users_main->forgot_password($this->post_data["username"],CUSTOMER_GROUP_ID);
            if( isAjax() ) {
                echo json_encode($response);
                die;
            }elseif( $response["flag"]==FLAG_SUCCESS ) {
                success($response["message"]);
                redirect(base_url("users/login"));
                die;
                
            }
        }
        $this->layout->view("{$this->module_name}/{$this->controller_name}/forgot_password",$this->data);
    }
    
    public function resend_verify_code($encoded_id=""){
        $this->load->model("users_model","users");
        $user_id = decrypt($encoded_id);
        $record = $this->users->get_record($user_id)['record'];
        if( !empty($record) ) {
            $this->load->module("main/users_main");
            $response = $this->users_main->send_phone_verification_code($user_id,$record["phonecode"],$record["phone_no"]);
            if( $response["flag"]==FLAG_SUCCESS ) {
                success($response["message"]);
            }else{
                error($response["message"]);
            }
            redirect(base_url("{$this->controller_name}/verify_account/{$encoded_id}"));
            
            
        }else{
            redirect($this->base_url);
        }
    }
    public function verify_account($encoded_id){
        $this->data["main_form_url"] = base_url("users/verify_account/{$encoded_id}");
        $user_id = decrypt($encoded_id);
        $this->data["edited_id"] = $encoded_id;
        if( !empty($this->post_data) ){
            $this->load->module("main/users_main");
            $response = $this->users_main->verify_account($encoded_id,$this->post_data,OTP_SEND_TYPE_OTP);
            if( $response["flag"]==FLAG_SUCCESS ) {
                success($response["message"]);
                $this->session->set_userdata("web_user_data", $response['token']);
                redirect(base_url("dashboard"));
            }else{
                error($response["message"]);
            }
        }
        $this->layout->view("{$this->module_name}/{$this->controller_name}/verify_account",$this->data);
    }
}