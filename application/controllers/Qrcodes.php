<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Qrcodes extends MY_Controller { 
    public $layout_view = "layout/web";
    public function __construct() {
        parent::__construct();
    }

    public function index($qrcode) {
        $this->load->module("main/qrcode_main");
        $response = $this->qrcode_main->get_qrcode_detail($qrcode);
        if( $response["flag"]==FLAG_SUCCESS ) {

            $listing_url =  base_url( "best/".preg_replace("![\s]+!u","-",strtolower($response["data"]["listing_type_name"]))."/{$response["data"]["slug"]}/".preg_replace("![\s]+!u","-",strtolower($response["data"]["city_name"])) );
            redirect( $listing_url);
        }else{
            $this->layout->view("web/error/error_404");
        }
    }
    
}