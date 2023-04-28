<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Qrcode_main extends MY_Controller { 
    public function __construct() {
        parent::__construct();
        $this->load->model("qrcodes_model","qrcodes");
    }
    
    public function generate_qrcode( $post_data=array() ){
        $this->load->library('ciqrcode');
        $qr_no = ( !empty($post_data["qr_no"]) && $post_data["qr_no"]>0 ) ? $post_data["qr_no"] : 1;
        $insert_data = $qr_codes = array();
        
        for( $i=1;$i<=$qr_no;$i++ ) {
            $qrcode = $this->get_unique_qrcode($qr_codes)["qrcode"];
            $qr_codes[]=$qrcode;
            $image = $qrcode.".png";
            $params = array(
                "data" => base_url("qrcode/{$qrcode}"),
                "level" => "H",
                "size" => 10,
                "savename" => FCPATH .BASE_QRCODE_IMAGE_PATH. "{$image}"
            );
            $this->ciqrcode->generate($params);
            $insert_data[]=array(
                "qrcode"=>$qrcode,
                "image"=>$image,
                "type"=>QRCODE_TYPE_LISTING,
                "created_at"=>SQL_ADDED_DATE,
                "created_by"=>$this->user_data["id"],
            );
        }
        if( !empty($insert_data) ){
            if( !empty($insert_data) ) {
                $this->qrcodes->insertRows($insert_data);
            }
            $response = array("flag"=>FLAG_SUCCESS,"message"=>$this->lang->line("message_qrcode_generate_success"));
        }else{
            $response = array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_try_again"));
        }
        return $response;
    }
    
    public function get_qrcode_detail($qrcode){
        $qrcode_detail = $this->qrcodes->get_record($qrcode)["record"];
        if( !empty($qrcode_detail["record_id"]) ) {
            
            if($qrcode_detail["type"]==QRCODE_TYPE_LISTING){
                $this->load->module("main/listing_main");

                $listing_data = $this->listing_main->get_record(encrypt($qrcode_detail["record_id"]))["data"];
                $listing_data["qrcode_type"] = QRCODE_TYPE_LISTING;
                $response = array("flag"=>FLAG_SUCCESS,"data"=>$listing_data);
                        
            }
        }else{
            $response = array("flag"=>FLAG_ERROR,"message"=>$this->lang->line("message_no_records"));
        }
        return $response;
    }
    private function get_unique_qrcode($qr_codes){
        $qrcode = rand(1111111111,9999999999);
        if( !in_array($qrcode,$qr_codes) ) {
            $existing_qr = $this->qrcodes->get_record($qrcode)["record"];
            if( empty($existing_qr["id"]) ) {
                return array("qrcode"=>$qrcode);
            }else{
                return $this->get_unique_qrcode($qr_codes);
            }
        }else{
            return $this->get_unique_qrcode($qr_codes);
        }
    }
    
    

}