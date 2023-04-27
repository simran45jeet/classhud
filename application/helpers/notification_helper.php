<?php
use React\Socket\ConnectionInterface;
use \Firebase\JWT\JWT;

function send_device_notification($auth_token,$text,$title,$type,$t_id,$notification_type,$user_type,$app_type,$extra_data = array(), $save = 0, $restaurant_id = NULL, $socket_data = [], $notificationId="", $production="")
{
    $ci =& get_instance();
    try {
        $auth_token_data = JWT::decode($auth_token,$ci->config->item('encryption_key'), array('HS256'));
    } catch (Exception $e) {
        $e->getmessage();
    }
    $user_id = $ci->my_encryption->decode($auth_token_data->id);
    $unique = $user_id.'x'.unique_notification_id; 
    $devices  = ['android','ios','web'];
    $ci->load->model('notifications_model');
    $ci->load->model('authtokens_model');
    
    $token_data = $ci->authtokens_model->getRow(['auth_token' => $auth_token]);
    $not_ids = [];
    $token = "";
    foreach($devices as $device)
    { 
        $message = ['body'   => $text,'title'     => $title,'type' => $type.'_'.$notification_type, 'id' => $t_id]; 
        $message = (!empty($extra_data))?array_merge($message,$extra_data):$message;
       
        $notification = array
        (
            'body'   => $text,
            'title'     => $title,
            'content_available'     => true,
            'vibrate'   => 1,
            'click_action'   => 'dashboard',
            'sound'     => 1,
            'largeIcon' => 'large_icon',
            'smallIcon' => 'small_icon',
            'notification_data'  => $message
        );
        
        //click actions
        if($device == 'android' || $device == 'ios'){
            if($user_type == WAITER_GROUP_ID){
                $message['click_action'] = $notification['click_action'] = 'dashboardActivity';
            }
            if($user_type == DELIVERY_BOY_GROUP_ID){
                $message['click_action'] = $notification['click_action'] = 'homeActivity';
            }
            if($app_type == POS){
                $message['click_action'] = $notification['click_action'] = 'dashboardPOS';
            }
        }
        

        if($device == 'android' && !empty($token_data['android_device_token']))
        { 
            $notificationSend = true;
            if($app_type==POS){
                $notificationSend = false;
            }
            $id = node_notification($token_data['android_device_token'], $notification , $message, ['notificationParam' => $notificationSend, 'appType' => $app_type, 'device' => $device]);
            if($id)
            {
                $not_ids['and_notification_id'] = $id;
            }

        }elseif ($device == 'ios' && !empty($token_data['ios_device_token']))
        {

            $token = $token_data['ios_device_token'];
            $notification['gcm.notification.notification_data'] = $notification['notification_data'];
            $notification['type'] = $notification['notification_data']['type'];
            unset($notification['notification_data']);
            $id = node_notification($token_data['ios_device_token'], $notification ,$message,['notificationParam' => true, 'appType' => $app_type, 'device' => $device, 'production' => $production, 'is_mobile' => $token_data['is_mobile']]);
            if($id)
            {
                $not_ids['ios_notification_id'] = $id ;
            }
        }elseif ($device == 'web' && !empty($token_data['web_device_token']))
        {
            // only saved notifications should be sent to superadmin dashboard
            if((!empty($notificationId)) || $token_data['app_type']==POS){
                $eData = [
                    'click_action' => notificationUrl($notificationId,$token_data['app_type']),
                    'icon' => base_url().'assets/images/logo-red-black.png',
                    'image' => base_url().'assets/images/logo-red-black.png'
                ];
                $id = node_notification( $token_data['web_device_token'], $eData + $notification  , $eData + $message, ['notificationParam' => true, 'appType' => $app_type, 'device' => $device] );
                if($id)
                {
                    $not_ids['web_notification_id'] = $id;
                }
            }
        }
    }
    
}

function add_notification_queue($serialize_data) {
    $ci =& get_instance();
    $ci->load->model('queues_model');

    $production=1;
    if($_SERVER['SERVER_ADDR'] == '::1' || $_SERVER['SERVER_ADDR'] == '127.0.0.5' || $_SERVER['HTTP_HOST'] == 'dev.whythewait.top' || (!empty($_GET['apple_notification_debug_on']) && $_GET['apple_notification_debug_on'] == 1)){
        $production=0;
    }

    $data = unserialize($serialize_data);
    $data['production']  = $production;
    $serialize_data = serialize($data);

    $insert_id = $ci->queues_model->insert([
        'action'=>'send_notification',
        'data'=>$serialize_data,
        'created_by' =>  0,
        'created_on' => date(DEFAULT_SQL_DATE_FORMAT),
        'modified_by' =>  0,
        'modified_on' => date(DEFAULT_SQL_DATE_FORMAT),
    ]);
    // $ci->load->module('cli/queue');
    // $ci->queue->notification_send($insert_id);
    exec("nohup php ".FCPATH."index.php cli/queue notification_send $insert_id > /dev/null 2>&1 &");
}
function add_menu_translation_queue($serialize_data,$user_id) {
    $ci =& get_instance();
    $ci->load->model('queues_model');
    $insert_id = $ci->queues_model->insert([
        'action'=>'food_item_translation',
        'data'=>$serialize_data,
        'created_on' => date(DEFAULT_SQL_DATE_FORMAT),
        'modified_on' => date(DEFAULT_SQL_DATE_FORMAT),
        'created_by' => $user_id,
        'modified_by' => $user_id
    ]);
    exec("nohup php ".FCPATH."index.php cli/queue food_item_translation $insert_id > /dev/null 2>&1 &");
}
function attribute_translation_queue($serialize_data,$user_id) {
    $ci =& get_instance();
    $ci->load->model('queues_model');
    $insert_id = $ci->queues_model->insert([
        'action'=>'attribute_translation',
        'data'=>$serialize_data,
        'created_on' => date(DEFAULT_SQL_DATE_FORMAT),
        'modified_on' => date(DEFAULT_SQL_DATE_FORMAT),
        'created_by' => $user_id,
        'modified_by' => $user_id
    ]);
    exec("nohup php ".FCPATH."index.php cli/queue attribute_translation $insert_id > /dev/null 2>&1 &");
}
function create_pdf_invoice($order_id,$recreate = 0) {
    $ci =& get_instance();
    $ci->load->model('queues_model');
    $insert_id = $ci->queues_model->insert([
        'action'=>'create_pdf_invoice',
        'data'=>serialize(['order_id' => $order_id,'recreate' => $recreate]),
        'created_on' => date(DEFAULT_SQL_DATE_FORMAT),
        'modified_on' => date(DEFAULT_SQL_DATE_FORMAT),
        'created_by' => 0,
        'modified_by' => 0
    ]);
    exec("nohup php ".FCPATH."index.php cli/queue create_pdf_invoice $insert_id > /dev/null 2>&1 &");
}


function base64($data) {
  return rtrim(strtr(base64_encode(json_encode($data)), '+/', '-_'), '=');
}


function node_notification($token, $notification ,$message, $options=[])
{
    $postData = array(
        'token' => $token,
        'message' => $message,
        'password' => "6}Yx6)dV#k+{wq*3",
        'notification' => $notification,
        'options' => $options
    );
    $ch = curl_init();
    curl_setopt_array($ch, array(
    CURLOPT_URL => SOCKET_NOTIFICATION_URL,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query($postData),
    CURLOPT_FOLLOWLOCATION => true
    ));
    $output = curl_exec($ch);
}

function notificationUrl($savedId,$app_type = null){
    if(!empty($savedId)){
      $ci =& get_instance();
      $savedId = $ci->my_encryption->encode($savedId);
    }
    $pathStr = 'notification/view/'.$savedId;
    $url = base_url($pathStr);
    if($app_type == POS){
      if(empty($savedId)){
        $url = base_url();
      }
      $subsomain = explode('.', base_url())[0];
      if($subsomain=="test"){
          return overrideSubDomain("testpos",$url);
      }else if($subsomain=="prelive"){
          return overrideSubDomain("prepos",$url);
      }else{
          return str_replace('www','pos',$url);
      }
    }
    return superadmin_url($pathStr); 

}
function overrideSubDomain($subDomain, $url)
{
    $info = parse_url($url);

    $array = explode('.', $info['host']);

    $withoutDomain = (array_key_exists(count($array) - 2,
            $array) ? $array[count($array) - 2] : '') . '.' . $array[count($array) - 1];

    $newSubDomain = $info['scheme'] . '://' . $subDomain . '.' . $withoutDomain;

    return $newSubDomain;
}

function notificationEndPoint($type, $notification_type, $id, $notificationId){
    $notificatLinks = StaticArrays::$notificationLinks;
    $encodedId = null;
    $ci =& get_instance();
    if(!empty($id)){
        $encodedId = $ci->my_encryption->encode($id);
    }
    switch ($type) {
        case "order":
            $url = 'orders/';
            if(in_array($notification_type, $notificatLinks[$type]['view']) && !empty($encodedId)){
                $url .= 'view/'.$encodedId;
            }
        break;
        case "restaurants":
            $url = '';
            if($notification_type ==  'restaurant_registered'){
                $url .= 'restaurants/index/';
            }else if($notification_type ==  'store_registered'){
                $url .= 'store/index/';
            }
        break;
        case "restaurant_requests":
            $url = '';
            if($notification_type ==  'reg_verified_restaurant'){
                $url .= 'restaurants/requests/';
            }else if($notification_type ==  'reg_unverified_restaurant'){
                $url .= 'restaurants/unverified/';
            }else if($notification_type ==  'reg_verified_store'){
                $url .= 'store/requests/';
            }else if($notification_type ==  'reg_unverified_store'){
                $url .= 'store/unverified/';
            }
        break;
        case "tickets":
            $url = '';
            if(!empty($encodedId)){
                $url .= 'support/view/'.$encodedId;
            }else{
                $url .= 'support/index';
            }
        case "organization_requests":
            $url = 'organizations/requests';
        break;
        default:
          $url = '';
    }
    return !empty($url)?superadmin_url($url):false;
}

function notificationHtml($type=null, $notificatonType=null, $id=null, $data=[], $forJsRand=null){
    $format = 'd M Y h:i A';
    $dateTime = isset($data['created_at'])?date($format,strtotime($data['created_at'])):date($format);
    $readUnread = ''; $savedNotificationId = null;
    if(!empty($data)){
        if($data['is_read'] == 0){
            $readUnread = 'notificationUnread';
        }
        if(!empty($data['id'])){
            $savedNotificationId = $data['id'];
        }
     }
    $url = empty($forJsRand)?notificationUrl($savedNotificationId):"{url}";
    $title = empty($forJsRand)?$data['title']:"{title}";
    $text = empty($forJsRand)?$data['text']:"{text}";
    $readUnread = $data['is_read'] == 0?'notificationUnread':'';
    $str = '<a href="'.$url.'" >'
        .'<div class="media">'
        .'<div class="media-left align-self-center"><i class="ft-plus-square icon-bg-circle bg-cyan"></i></div>'
        .'<div class="media-body">'
            .'<h6 class="media-heading">'.$title.'</h6>'
            .'<div class="not-text-desc text-muted">'.$text.'</div>'
            .'<small>'
          
            .'<time class="media-meta text-muted">'.$dateTime.'</time></small>'
        .'</div>'
        .'<div class="media-right align-self-center"><i class="'.$readUnread.'"></i></div>'
        .'</div>'
    .'</a>';
    return $str; 
}


function notificationHtml2($type=null, $notificatonType=null, $id=null, $data=[], $forJsRand=null){
    $format = 'd M Y h:i A';
    $dateTime = isset($data['created_at'])?date($format,strtotime($data['created_at'])):date($format);
    $readUnread = ''; $savedNotificationId = null;
    if(!empty($data)){
        if($data['is_read'] == 0){
            $readUnread = 'notificationUnread';
        }
        if(!empty($data['id'])){
            $savedNotificationId = $data['id'];
        }
     }
    $url = empty($forJsRand)?notificationUrl($savedNotificationId):"{url}";
    $title = empty($forJsRand)?$data['title']:"{title}";
    $text = empty($forJsRand)?$data['text']:"{text}";
    $readUnread = 'notificationUnread';
    $bg = ($data['is_read'] == 0) ? '':'style="background-color:#fff"';
    $str = 
        '<div class="media" '.$bg.'>'
        .'<div class="media-left align-self-center"><i class="ft-plus-square icon-bg-circle bg-cyan"></i></div>'
        .'<div class="media-body">'
            .'<h6 class="media-heading">'.$title.'</h6>'
            .'<div class="not-text-desc text-muted">'.$text.'</div>'           
        .'</div>'
        .'<div class="media-right align-self-center"><a href="'.$url.'" ><i class="'.$readUnread.'"></i><i class="'.$readUnread.'"></i><i class="'.$readUnread.'"></i><i class="'.$readUnread.'"></i></a><br><small>
          
        <time class="media-meta text-muted">'.$dateTime.'</time></small></div>'
        .'</div>';
    return $str; 
}