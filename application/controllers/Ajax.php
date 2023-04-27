<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ajax extends MY_Controller { 
    function __construct() {
        parent::__construct();
    }
    public function get_states(){
        $country_id = decrypt($this->post_data['country_id']);
        $this->load->model("state_model","state");
        $post_data = array("only_active"=>true);
        $states = $this->state->get_records($country_id,$post_data,false)['records'];
        $response = array("flag"=>FLAG_SUCCESS);
        
        foreach( $states as $key => $state ) {
            $response["data"][]=array("id"=>encrypt($state['id']),"name"=>$state['name']);
        }
        echo json_encode($response);
    }
    
    public function get_cities(){
        
        $countryId = decrypt($this->post_data['country_id']);
        $stateId = decrypt($this->post_data['state_id']);
        $this->load->model('city_model','city');
        $post_data = array("only_active"=>true);
        
        $cities = $this->city->get_records($countryId,$stateId,$post_data,false)['records'];
        
       $response = array("flag"=>FLAG_SUCCESS);
        
        foreach( $cities as $key => $city ) {
            $selected = !empty($this->post_data['city_id']) && decrypt($this->post_data['city_id']) == $city['id'] ? true:false;
            $response["data"][]=array("id"=>encrypt($city['id']),"name"=>$city['name'],"selected"=>$selected);
        }
        echo json_encode($response);
    }
    
    function getip_latlng(){
        $ip = getVisitorIp();
        $xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=".$ip);
        echo json_encode( ['lng'=>$xml->geoplugin_longitude,'lat'=>$xml->geoplugin_latitude]);
    }
    
    function latlng_detail() {
        $data = $this->post_data;
            
        if(isset($data) && !empty($data) && !empty($data['latitude']) && !empty($data['longitude'])) {
            $coordinates = latLngDetailFromGoogle($data["latitude"],$data["longitude"]);
            $response['flag'] = FLAG_SUCCESS;
            $response['location'] = $coordinates;
        }else{
            $response['flag'] = FLAG_ERROR;
            $response['message'] = $this->lang->line("message_invalid_request");
        }
        echo json_encode($response);

    }
}