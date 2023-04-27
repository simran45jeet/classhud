<?php
function dateFormatForDevice($format, $device) {
    if($device == CART_FROM_APP){
        $characters = str_split(preg_replace("/[^a-zA-Z]+/", "", $format));
        $characters = array_unique($characters);
        foreach ($characters as $character) {
            $format = str_replace($character,$character.$character,$format);
        }
    }
    return $format;
}
function google_address_details($address) {
    $result = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&key='.SERVER_GOOGLE_API_KEY);
    $data = json_decode($result);
    $lat = '';
    $lng = '';
    if(!empty($data->results)){
        $lat = $data->results[0]->geometry->location->lat;
        $lng = $data->results[0]->geometry->location->lng;
    }
    return ['lat' => $lat,'lng' => $lng];
} 

function latLngDetailFromGoogle($lat,$lng) {
    $result = file_get_contents(GOOGLEAPI_MAP_URL.'&latlng='.$lat.','.$lng);
    return json_decode($result);
}

function getDatesFromRange($start, $end, $format = 'Y-m-d') { 
      
    // Declare an empty array 
    $array = array(); 
      
    // Variable that store the date interval 
    // of period 1 day 
    $interval = new DateInterval('P1D'); 
  
    $realEnd = new DateTime($end); 
    $realEnd->add($interval); 
  
    $period = new DatePeriod(new DateTime($start), $interval, $realEnd); 
  
    // Use loop to store date into array 
    foreach($period as $date) {                  
        $array[] = $date->format($format);  
    } 
  
    // Return the array elements 
    return $array; 
} 
function debug($data)
{
    $bt = debug_backtrace();
    $caller = array_shift($bt);
    
    echo "<pre>";
    echo "<b>" . $caller["file"] . " : " . $caller["line"] . "</b><br/>";
    print_r($data);
    echo "</pre>";
}

function get_time_diff($diff_type, $start, $end=null, $full=false){
    $now = date('Y-m-d H:i:s');
    // $now = new DateTime;
    if(empty($end)){
        $end = $now;
    }

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    $diff = date_diff(date_create($start),date_create($end));
    
    if($full){
        return $diff->format('%'.$diff_type) .' '. $string[$diff_type];
    } else {
        return $diff->format('%'.$diff_type);
    }
}

function price_decimal($price,$uptodecimal){    
    return truncate_number($price,$uptodecimal);
}
function pagination_array($count,$per_page,$base_url,$segment,$flag=false){
    $config = array();
    $config["base_url"] = $base_url;
    $config["total_rows"] = $count;
    $config["per_page"] = $per_page;
    $config["uri_segment"] = $segment;
    $config['num_links'] = 4;
    if($flag===true) {
        $config['use_page_numbers'] = $flag;
        $config['cur_page'] = $segment;
    }
    $config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination">';
    $config['full_tag_close'] = '</ul></nav>';

    $config['first_link'] = '<<';
    $config['first_tag_open'] = '<li class="firstlink page-item">';
    $config['first_tag_close'] = '</li>';
     
    $config['last_link'] = '>>';
    $config['last_tag_open'] = '<li class="lastlink page-item">';
    $config['last_tag_close'] = '</li>';
     
    $config['next_link'] = '>';
    $config['next_tag_open'] = '<li class="nextlink page-item">';
    $config['next_tag_close'] = '</li>';

    $config['prev_link'] = '<';
    $config['prev_tag_open'] = '<li class="prevlink page-item">';
    $config['prev_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="curlink page-item active"><a class="page-link" href="#">';
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li class="numlink page-item">';
    $config['num_tag_close'] = '</li>';
    $config['attributes'] = array('class' => 'page-link');
    return $config;
}
/**
 * return array to where sql string
 * @param type $conditions
 * @return string
 */

function array_diff_by_key_value($array1,$array2){
    $return = [];
    if(!empty($array1)){
        foreach ($array1 as $key => $value) {
            if(array_key_exists($key,$array2) && $array2[$key]!=$value){
                $return[$key] = $value;
            }
        }
    }
    return $return;
}
function get_where($conditions)
{
    $where = array();
    
    $raw_where = '';
    
    foreach($conditions as $operator => $data)
    {
        foreach($data as $arr)
        {
            if (isset($arr["field"]) && isset($arr["value"]))
            {
                $arr["op"] = isset($arr["op"]) ? $arr["op"] : "=";
                
                $where[] = $arr["field"] . " " . $arr["op"] . " '" . $arr["value"] . "'";
            }
            else
            {
                $where[] = get_where($arr);
            }            
        }
        
        $raw_where .= "(" . implode(" $operator ",  $where) . ")";
    }
    
    return $raw_where;
}


function count_dimension($array)
{
    if (is_array(reset($array)))
    {
        $return = countdim(reset($array)) + 1;
    }

    else
    {
        $return = 1;
    }

    return $return;
}

function obj_to_array($obj) 
{
    $arr = array();
    if (gettype($obj) == "object") 
    {
        $arr = obj_to_array(get_object_vars($obj));
    } 
    else if (gettype($obj) == "array") 
    {
        foreach ($obj as $k => $v) 
        {
            $arr[$k] = obj_to_array($v);
        }
    }
    else 
    {
        $arr = $obj;
    }

    return $arr;
}
function random_string($length = 5)
{
    $str = '1234567890';
    return substr(str_shuffle($str),0,$length);
}

function api_paging($limit = NULL, $pagenum = NULL){
    $page_no = (isset($pagenum) && !empty($pagenum)) ? $pagenum : 1;
    $limit = (isset($limit) && !empty($limit)) ? $limit : DEFAULT_API_PAGELIMIT;
    $start  = ($limit * $page_no) - $limit;
    return array('limit' => $limit, 'start'=> $start);
}

function truncate_number( $number, $precision = 2) {
    $precision = (empty($precision))?2:$precision;
    return bcdiv($number, 1, $precision);
}

function numberToAlphabet($num)
{
    //returns the alphabet according to the number For ex: 0 = A
    $letter = range("a","z");
    return $letter[($num)];
}


function create_html_image($html_file, $width, $file_name)
{
    $dir = FCPATH.'/assets/temp';
    if(!is_dir($dir))
    {
        mkdir($dir);
    }
    // $file_name = time().'_'.rand().'.png';
    exec("xvfb-run -a --server-args='-screen 0, 1024x768x24' ".WHTMLTOMIAGE_PATH." --quality 20 --width $width $html_file {$dir}/{$file_name} ");
    return "assets/temp/".$file_name;
}



function validateEmail($email) {
    // SET INITIAL RETURN VARIABLES
    $emailIsValid = FALSE;
    // MAKE SURE AN EMPTY STRING WASN'T PASSED
    if (!empty($email)) {
        // GET EMAIL PARTS
        $domain = ltrim(stristr($email, '@'), '@') . '.';
        $user = stristr($email, '@', TRUE);

        // VALIDATE EMAIL ADDRESS
        if
        (
                !empty($user) &&
                !empty($domain) &&
                checkdnsrr($domain)
        ) {
            $emailIsValid = TRUE;
        }
    }
    // RETURN RESULT
    return $emailIsValid;
}

// for ccavenue
function validatePhone($phone)
{
    // SET INITIAL RETURN VARIABLES
    $phoneIsValid = FALSE;
    // MAKE SURE AN EMPTY STRING WASN'T PASSED
    if (!empty($phone)) {
        $mobileregex = "/^[0-9]{4,12}$/"; //"/^[6-9][0-9]{8,9}$/" ;  
        if
        (
                preg_match($mobileregex, $phone)
        ) {
            $phoneIsValid = TRUE;
        }
    }
    // RETURN RESULT
    return $phoneIsValid;
}

// for api
function validatePhoneNo($phone,$country_code)
{
    $flag = 1;
    $message = 'success';
    if (empty($phone)) {
        $flag = 0;
        $message = 'Phone No. required.';
    } else if (empty($country_code)) {
        $flag = 0;
        $message = 'Country Code required.';
    } else if (!preg_match("/^[0-9]{1,5}$/", $country_code)) {
        $flag = 0;
        $message = 'Invalid Country Code.';
    } else if (!preg_match("/^[0-9]{4,12}$/", $phone)) {
        $flag = 0;
        $message = 'Invalid Phone No.';
    }
    $response['flag'] = $flag;
    $response['message'] = $message;
    return $response;
}


/*
    function name : checkStrLen
    return : bool true/false
    description  : check the length of string and return bool value true/false
    parameter : string to be check, length
*/
function checkStrLen($string,$length){
    return ($length>=strlen($string));
} 
function text_to_image( $str='' ) {
    $im = imagecreatetruecolor(strlen($str)*10 , 20);
    $red = imagecolorallocate($im, 255, 0, 0);
    $black = imagecolorallocate($im, 0, 0, 0);
    $blackText = imagecolorallocate($im, 77,77,77);

    imagecolortransparent($im, $black);

    // Draw a red rectangle
    imagestring($im, 5, 8, 0, $str, $blackText);

    // Save the image
    header('Content-type: image/png');
    imagepng($im);
    imagedestroy($im);
}

function convert_date_sql($date){
    return date(DEFAULT_SQL_ONLY_DATE_FORMAT, strtotime($date));
}



function encode_variables( &$arr,$variables ) {
    $ci =& get_instance();
    if( is_array($variables) ) {
        foreach( $variables as $filedToEncode ) {
            if( is_object($arr) && isset( $arr->$filedToEncode ) ) {
                $arr->$filedToEncode = $ci->my_encryption->encode($arr->$filedToEncode);
            }else if( is_array($arr) && isset( $arr[$filedToEncode] ) ) {
                $arr[$filedToEncode] = $ci->my_encryption->encode($arr[$filedToEncode]);
            }
        }
    }else{
        if( is_object($arr) && isset( $arr->$variables ) ) {
            $arr->$variables = $ci->my_encryption->encode($arr->$variables);
        }else if( is_array($arr) && isset( $arr[$variables] ) ) {
            $arr[$variables] = $ci->my_encryption->encode($arr[$variables]);
        }
    }
    foreach( $arr as $index=>&$data ) {
        if( is_object($data) || is_array($data) ) {
            encode_variables($data,$variables);
        }
    }
    return $arr;
}

function isUserLoggedIn(){
    $ci =& get_instance();
    return !empty($ci->controller->userData['email']) ;
}


function send_verification_helper($user_id=0,$email='', $data,$template = null) {
    $ci =& get_instance();
    $verification_code = $data['activation_code'];

    if(!empty($verification_code))
    {
        $first_name = $data['first_name'];
        $email_data = array("user" => $data['email'], "name" => $data['firstname'], 'account_verified_code' => $verification_code );
        $to = $data['email'];
        $subject = "Please verify email account.";
        $email_template = (!empty($template))?$template:"account_verified_email";
        send_email($to, $subject, $email_template, $email_data);
    }else
    {
        return false;
    }
}

function setFlashErrorMessage($message,$key='error_message'){
    $ci =& get_instance();
    $ci->session->set_flashdata( $key,$message);
}

function error($message){
    setFlashErrorMessage($message);

}
function success($message){
    setFlashErrorMessage($message,'message');
}

function encrypt($string){
    $ci =& get_instance();
    return $ci->my_encryption->encode($string);
}
function decrypt($string){
    $ci =& get_instance();
    return $ci->my_encryption->decode($string);
}

function isAjax(){
    $ci =& get_instance();
    return $ci->input->is_ajax_request();
}

function get_upload_image_name( $name,$upload_image,$table_name,$filed_name,$primery_filed="",$primery_id="",$cnt=1) {
    $ci =& get_instance();
    
    $file_ext = strtolower( end(explode(".", $_FILES[$upload_image]["name"] )) );
    
    
    $ci->load->model("{$table_name}_model","model");
    $name = strtolower($name);
    $image_name = trim( preg_replace("/[^a-zA-Z]+/","-","{$name}"),'-');
    $image_name .=( $cnt>1?"-{$cnt}":"").".{$file_ext}";

    
    $where = array($filed_name=>$image_name);
    
    if( !empty($primery_id) ) {
        $where["{$primery_filed}!="]=$primery_id;
    }
    $exists = $ci->model->isExist($where);
   
    if($exists){
        return get_upload_image_name( $name,$upload_image,$table_name,$filed_name,$primery_filed,$primery_id,++$cnt );
    }else{
        return  array("flag"=>FLAG_SUCCESS,'file_name'=>$image_name) ;
    }
}

function send_account_verify_otp($phone_code,$phone_no,$user_id,$otp){
    $ci =& get_instance();
    $params = array("message"=> "{$otp} is your OTP to verify your phone number. Get ready to expand your Institute reach with Class Hud .CLSHUD","template_id"=>"1207167706923723312");
    send_sms("1207167706923723312",$params,$phone_code,$phone_no);
}

function send_claim_listing_request_otp($phone_code,$phone_no,$user_id,$otp){
   
    $ci =& get_instance();
    $params = array("message"=> "{$otp} is your OTP to verify your phone number. Get ready to expand your Institute reach with Class Hud .CLSHUD","template_id"=>"1207167706923723312");
    send_sms("1207167706923723312",$params,$phone_code,$phone_no);
}


function send_new_password($phone_code,$phone_no,$user_id,$temp_password){
    $ci =& get_instance();
    $params = array("message"=> "Your OTP to reset your password is {$temp_password}. Please enter this code on the reset password page to continue the process .CLSHUD","template_id"=>"1207167706896025919");
    send_sms("1207167706896025919",$params,$phone_code,$phone_no);
}

function send_sms($template_id,$params,$phone_code,$phone_no){
    $params = array_map("rawurlencode", $params);
    $api_url = "http://servermsg.com/api/SmsApi/SendSingleApi?UserID=ClassHud&Password=duyw2276DU&SenderID=CLSHUD&Phno={$phone_no}&Msg={$params["message"]}&TemplateID={$template_id}&EntityID=1201167695892460057";
    
    $ch = curl_init($api_url);
    $response = file_get_contents($api_url);
    $data = json_decode($response,true);
    return $data;
}

function send_listing_approve_sms($phone_code,$phone_no){
    $params = array("message"=> "Your institute details have been approved and are now live on Class Hud Get ready to expand your Institute reach. Thank you for choosing Class Hud. CLSHUD","template_id"=>"1207167706913464312");
    send_sms("1207167706913464312",$params,$phone_code,$phone_no);
}


function is_api_module(){
    $ci =& get_instance(); 
    return ($ci->uri->segment(1) == MODULE_NAME_API);
}

function is_superadmin_module(){
    $ci =& get_instance(); 
    return ($ci->uri->segment(1) == SUPERADMIN);
}

function in_my_array($value,$array=array()) {
    $exist = false;
    if( !empty($array) && is_array($array) )  {
        foreach( $array as $array_value ) {
            if( decrypt($array_value)==$value ) {
                $exist = true;
            }
        }
    }
    return $exist;
}

function in_my_array_key($search_key,$array=array()) {
    $array_new = array();

    if( !empty($array) && is_array($array) )  {
        foreach( $array as $key => $array_value ) {
            $array_new[decrypt($key)] = $array_value;
        }
    }

    return isset($array_new[$search_key]) ? $array_new[$search_key]  : false;
}

function generate_sitemap(){
    exec("nohup php ".FCPATH."index.php cli/crons generate_sitemap  > /dev/null 2>&1 &");
}

function yotube_video_id($url){
    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/   ]{11})%i', $url, $match);
    return $match[1];
}

function youtube_videoid_url($video_id){
    return "https://www.youtube.be/embed/{$video_id}";
}

function generateRandomString($length = 6) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}