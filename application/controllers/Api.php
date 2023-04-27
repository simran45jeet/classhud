<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends MY_Controller { 
    private $data;
    public function __construct() {
        parent::__construct();
        $this->data = array();
    }
    
    public function signup_data(){
        $this->load->model("phone_code_model","phone_code");
        $this->data["phone_codes"] = $this->phone_code->get_records(array("only_active"=>true),false)["records"];
        foreach($this->data["phone_codes"] as $key => &$phone_code ){
            $phone_code["id"] = encrypt($phone_code["id"]);
        }
        
        $response = array("flag"=>FLAG_SUCCESS,"data"=>$this->data);
        outputJsonData($response);
    }

    public function signup(){
        $this->load->module("main/users_main");
        $response = $this->users_main->register($this->post_data);
        unset($response["user_id"]);
        outputJsonData($response);
    }

    public function verify_account(){
        $this->load->model("users_model","users");
        $this->form_validation->set_rules("phone_no",$this->lang->line("heading_phone_no"),"required|is_not_empty|is_numeric");
        $this->form_validation->set_rules("otp",$this->lang->line("heading_phone_no"),"required|is_not_empty|is_numeric");
        if( $this->form_validation->run() ) {
            $record = $this->users->get_record(NULL,$this->post_data["phone_no"])["record"];
            if(  !empty($record) ) {
                $this->load->module("main/users_main");
                $response = $this->users_main->verify_account(encrypt($record["id"]),$this->post_data,OTP_SEND_TYPE_OTP,CART_FROM_APP);
            }else{
                $response = array("flag"=>FLAG_SUCCESS,"message"=>$this->lang->line("no_records"));
            }
        }else{
            $response = array("flag"=>FLAG_SUCCESS,"message"=>$this->lang->line("message_try_again"));
        }
        outputJsonData($response);
    }

}