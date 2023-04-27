<?php
Class Api_Request {
    static $ci,$replaceCounter,$module_dir;
    const API_URL = API_BASE_URL;
    private $api_url,$postData,$fileData,$apiResponse,$apiResponseData;
    const REGISTER_CAR_API = SELF::API_URL."register/userdetail";
    const SAVE_CAR_API = SELF::API_URL."savelisting";
    const CAR_MAKES_API = SELF::API_URL."carbrand";
    const CAR_MODAL_API = SELF::API_URL."carmodal";
    const USER_LOGIN_API = SELF::API_URL."login";
    const USER_LISTING_API = SELF::API_URL."carlistings/";

    private $api_request_date_type = 0;
    private $token = '';
    public function __construct(){ 
        $ci =& get_instance();
        
        if( $ci->controller->moduleName == MODULE_NAME_WEB && isUserLoggedIn() )  {
           $this->token = $_SESSION['webUserData'];
        }
    }
    
    function registerCar($data,$files=array()){        
        $this->setRegisterCarUrl();
        $this->setApiRequestData($data,$files);
        return $this->callApi();        
    }
    
    function setRegisterCarUrl(){
        //$this->api_request_date_type = 1;
        $url = !isUserLoggedIn() ? self::REGISTER_CAR_API : self::SAVE_CAR_API;
        $this->setApiUrl($url);
    }
    
    function getModal($id=0) {
        $this->setCarModalUrl( array(),array('makeid'=>$id) );
        return $this->callApi();
    }
    
    function getCarMakes($postData=array()){
        $this->setCarMakeUrl($postData);
        $this->callApi();
        return $this->apiResponseData;
    }
    
    function setCarMakeUrl($data){
        $this->setApiUrl(self::CAR_MAKES_API);
    }
    
    function login($postData){
        $this->setApiUrl(self::USER_LOGIN_API);
        $this->setApiRequestData($postData);
        return  $this->callApi();
    }
    
    function setCarModalUrl($data,$requestUrl=array()){
        $this->setApiUrl(self::CAR_MODAL_API,$requestUrl);
    }
    function setApiUrl($url,$requestUrl=array()){
        $this->api_url = $url;
        if(  !empty($requestUrl) && is_array($requestUrl) ) {
            $this->api_url.='?'.http_build_query($requestUrl);
        }
    }
    
    function setApiRequestData($data,$files=array()){
        $this->postData = $data;
        $this->fileData = $files;
    }
    
    function getUserLising($userId=NULL){
        $this->setApiUrl(self::USER_LISTING_API);
        return $this->callApi();
        
    }
    function callApi(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$this->api_url);
        if( !empty($this->postData) ) {
            $postData = $this->postData;
        }

        if( !empty($this->fileData) ) {
            $files = $this->fileData;
            foreach($files as $name=> $fileName) {
                $mimetype = mime_content_type($fileName['tmp_name']);
                $cFile = new CURLFile($fileName['tmp_name'],$fileName['type'],$fileName['name']);
                $postData[$name] = $cFile;
                
            }
            
        }
        $headers =  array();
        if( $this->api_request_date_type==1 ) {
            if( !empty($postData) ) {
                $postData = json_encode($postData);
            }
        }else if( !empty($postData) ){
            $postData = $this->build_post_fields($postData);
        }
        
        if( !empty($this->token) ) {
            $headers[]="token: ".$this->token;
        }
        $headers = array("Content-Type" => "multipart/form-data");
        
        if( !empty($headers) ) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        if( !empty($postData) ) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$postData );
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close ($ch);
        $this->setOutPut($server_output);
        return $this->apiResponseData;
    }
    function setOutPut($output) {
        $resp = $this->apiResponse = json_decode($output,true);
        $ci =& get_instance(); 
        try{
            if( isset($this->apiResponse['status']) && $this->apiResponse['status']=='true' ) {
                $this->apiResponseData['data'] = (array)$this->apiResponse['data'];
                $this->apiResponseData['flag'] = FLAG_SUCCESS;
                unset($resp['status'],$resp['data']);
                $this->apiResponseData = array_merge($this->apiResponseData,$resp);

            }else{
                $this->apiResponseData['data'] = array();
                $this->apiResponseData['flag'] = FLAG_ERROR;
                $this->apiResponseData['message'] = !empty($this->apiResponse['message']) ? $this->apiResponse['message'] : $ci->lang->line('try_again') ;
            }
        }catch(ErrorException $e) {
            $this->apiResponseData['data'] = array();
            $this->apiResponseData['flag'] = FLAG_ERROR;
        }
    }
    
    function build_post_fields( $data,$existingKeys='',&$returnArray=[]){
        if(($data instanceof CURLFile) or !(is_array($data) or is_object($data))){
            $returnArray[$existingKeys]=$data;
            return $returnArray;
        }
        else{
            foreach ($data as $key => $item) {
                $this->build_post_fields($item,$existingKeys?$existingKeys."[$key]":$key,$returnArray);
            }
            return $returnArray;
        }
    }
}
