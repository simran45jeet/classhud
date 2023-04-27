<?php
function isUrlValid($url) {
  if(preg_match( '/^http(s)?:\/\/(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/gi' ,$url)){
    return true;
  } else{
    return false;
  }
}
function returnCallData($data)
{

    if( empty($data->message) &&  empty($data->errorMessage))
    {
        $data->message = "Success";
    }
    if(empty($data->responseData))
    {
        $data->responseData =  null;
    }
    return ['user_data' => $data->responseData,'message' => $data->message, 'flag' =>$data->flag];
}

function outputJsonData($data)
{
    if(is_array($data))
    {
        if(empty($data['data']))
        {
            $data['data'] = NULL;
        }
        echo json_encode($data);
   }
}

function slug($string)
{
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
}


function cleanInput($data)
{
    $ci =& get_instance();
    $data = array_trimmer($data,$ci);
    $data = $ci->security->xss_clean($data);
    return $data;
}

function array_trimmer($data,$ci)
{
    $new_array = [];
    if((!isset($_ENV['SANDBOX']) || $_ENV['SANDBOX'] != 1)){
        $db = $ci->db->conn_id;
    //     $val = mysqli_real_escape_string($db, $val);
    }
    if( !empty($data) ) {
    foreach($data as $key => $value) {
            if(is_array($value))
            {
                $new_array[$key] = array_trimmer($value,$ci);
            }else
            {   
                if((!isset($_ENV['SANDBOX']) || $_ENV['SANDBOX'] != 1)){
                    $new_array[$key] = trim(mysqli_real_escape_string($db, $value));
                }else{
                    $new_array[$key] = trim(addslashes($value));
                }
            }
        }
    }
    
    return $new_array;
}

function getDataWithFullPath($data,$image_var, $user = 0)
{
    $new_array = [];
    foreach($data as $key => $value)
    {
        if(is_array($value))
        {
            $new_array[$key] = getDataWithFullPath($value,$image_var);
        }else
        {   
            if(in_array($key,$image_var))
            {
                $folder = 'assets/uploads/';
                if($user == 1){
                     $folder = USERS_IMG_PATH; 
                }  
                $new_array[$key] = (!empty($value))?base_url().$folder.$value:$value;
                
            }else
            {
                $new_array[$key] = $value;
            }
        }
    }
    return $new_array;
}


function getVisitorIp() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function __print($array,$continue = 0)
{
    echo "<pre>";  print_r($array); echo "</pre>";
    if($continue === 0)
    {
        die();
    }
}


function isActive($link,$class = "active"){
    $ci = &get_instance();
    $action = $ci->router->fetch_class().'.'.$ci->router->fetch_method();
    if($link==$action)
    {
        return $class;
    }
}
function isActiveMod($link,$class = "active"){
    $ci = &get_instance();
    $third_seg = (!empty($ci->uri->segment(3)))?$ci->uri->segment(3):'index';
    $action = $ci->uri->segment(2).'.'.$third_seg;
    if($link==$action)
    {
        return $class;
    }
}
//Only use 1 or 0
function enableGzip($gzip = 1)
{
    
    ini_set("zlib.output_compression", $gzip);
}

function validateDate($date, $format = DEFAULT_SQL_ONLY_DATE_FORMAT)
{
    $d = DateTime::createFromFormat($format, $date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    return $d && $d->format($format) === $date;
}

function is_staff_member($user_data)
{
    //This function is not meant to check if the user is superadmin or not..
    if($user_data['is_staff'] == 1 && $user_data['group_id'] != SUPERADMIN_GROUP_ID && $user_data['group_id'] != TECH_SUPPORT_LEAD_GROUP_ID)
    {
        return true;
    }
    return false;
}

function dateForDb($date, $format=DEFAULT_DATE_FORMAT){
    $date = DateTime::createFromFormat($format, $date);
    if($date){
        return  $date->format(DEFAULT_SQL_ONLY_DATE_FORMAT);
    }else{
        return "0000-00-00 00:00:00";
    }
}
function dateForUser($dateFromDb=''){
    return  ((!empty($dateFromDb)) && ($dateFromDb != "0000-00-00 00:00:00"))?date(DEFAULT_DATE_FORMAT, strtotime($dateFromDb)):$dateFromDb;
}

function timezoneListFormat($timezone){
    date_default_timezone_set($timezone);
    return '(GMT'.date('P', time()).') '.str_replace("_", " ",end(explode('/', $timezone)));
}


function transactionNumber($userId,$for_wallet=false){
    $start_string = $userId.'x';
    
    if($for_wallet===true){
        $start_string = '';
    }
    $transaction_id =  $start_string.strtoupper(generateRandomString(TRANSACTION_STR_LENGTH)).'x'.strtoupper(uniqid());

    return $transaction_id;
}


function getUserAuthToken(){
    $ci =& get_instance(); 
    $token = NULL;
	if(!$ci->url_translate->isModuleApi()){
        if(isset($ci->session->userData)){
            $token = $ci->session->userData;
        }
    }else{
        $request_headers = $ci->input->request_headers();
        $token = $request_headers['X-Auth-Token'];
    }
    return $token;
}