<?php  if ( ! defined('BASEPATH')) exit("No direct script access allowed");

class Queue extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }
    public function create_pdf_invoice($queue_id){
        $this->load->model('queues_model');
        $results = $this->queues_model->getRow($queue_id);
        $data = unserialize($results['data']);
        if(!empty($data['order_id'])){
            $_POST['order_id'] = $data['order_id'];
            $this->load->module('main/order_main');        
            $response = $this->order_main->get_all_order_food_items(0,1,CART_FROM_APP);
            if(!is_dir(FCPATH."assets/orders/pdfs")) {
                mkdir(FCPATH."assets/orders/pdfs", 0755, true);
                chmod(FCPATH."assets/orders/pdfs", 0755);
            }
            if($data['recreate'] == 1){
                unlink(FCPATH."assets/orders/pdfs/".$response['data'][0]['invoice_id'].".pdf");   
            }
            if((!file_exists(FCPATH."assets/orders/pdfs/".$response['data'][0]['invoice_id'].".pdf"))){
                $this->load->library('Html2pdf');

                //Set folder to save PDF to
                $this->html2pdf->folder('./assets/orders/pdfs/');

                //Set the filename to save/download as
                $this->html2pdf->filename($response['data'][0]['invoice_id'].'.pdf');

                //Set the paper defaults
                $this->html2pdf->paper('a4', 'portrait');

                //Load html view
                $this->html2pdf->html($this->load->view('orders/order_invoice_pdf' , $response, true));

                $path = $this->html2pdf->create('save');
                $this->queues_model->delete($queue_id);
            }
        }
    }
    public function attribute_translation($queue_id){
        $this->load->model('fooditem_attributes_translation_model');
        $this->load->model('fooditem_attributes_value_translation_model');
        $this->load->model('queues_model');
        $results = $this->queues_model->getRow($queue_id);
        $data = unserialize($results['data']);
        $noti_results=false;
        if (!empty($data['attributes'])) {
            foreach($data['attributes'] as $f_id => $att_name){
                $isExist = $this->fooditem_attributes_translation_model->isExist(['att_id'=>$f_id,'lang_code'=>$data['lang_code']]);
                if(!$isExist){
                    $data_insert['att_id'] = $f_id;
                    $data_insert['lang_code'] = $data['lang_code'];
                    $data_insert['restaurant_id'] = $data['restaurant_id'];
                    $data_insert['name'] = (!empty($att_name) && $att_name!='-' &&  $att_name!='- -')?$att_name:'';
                    $data_insert['created_on'] = date(DEFAULT_SQL_DATE_FORMAT);
                    $data_insert['modified_on'] = date(DEFAULT_SQL_DATE_FORMAT);
                    $data_insert['created_by'] = $results['created_by'];
                    $data_insert['modified_by'] = $results['created_by'];
                    $this->fooditem_attributes_translation_model->insert($data_insert);
                }
                $noti_results=true;
            }
        }
        if(!empty($data['attributes_value'])) {
            foreach($data['attributes_value'] as $f_id => $att_val){
                $isExist = $this->fooditem_attributes_value_translation_model->isExist(['att_value_id'=>$f_id,'lang_code'=>$data['lang_code']]);
                if(!$isExist){
                    $data_insert['att_value_id'] = $f_id;
                    $data_insert['lang_code'] = $data['lang_code'];
                    $data_insert['name'] = (!empty($att_val) && $att_val!='-' &&  $att_val!='- -')?$att_val:'';
                    $data_insert['created_on'] = date(DEFAULT_SQL_DATE_FORMAT);
                    $data_insert['modified_on'] = date(DEFAULT_SQL_DATE_FORMAT);
                    $data_insert['created_by'] = $results['created_by'];
                    $data_insert['modified_by'] = $results['created_by'];
                    $this->fooditem_attributes_value_translation_model->insert($data_insert);
                }
                $noti_results=true;
            }
        }
        if($noti_results==true){
            $this->queues_model->delete($queue_id);
        }
    }
    public function food_item_translation($queue_id){
        $this->load->model('fooditem_translation_model');
        $this->load->model('category_translation_model');
        $this->load->model('menu_translation_model');
        $this->load->model('queues_model');
        $results = $this->queues_model->getRow($queue_id);
        $data = unserialize($results['data']);
        $noti_results=false;
        if(!empty($data['menus'])){
            foreach($data['menus'] as $m_id => $menu_name){
                $isExist = $this->menu_translation_model->isExist(['m_id'=>$m_id,'lang_code'=>$data['lang_code']]);
                if(!$isExist){
                    $data_insert['m_id'] = $m_id;
                    $data_insert['lang_code'] = $data['lang_code'];
                    $data_insert['restaurant_id'] = $data['restaurant_id'];
                    $data_insert['name'] = (!empty($menu_name) && $menu_name!='-' &&  $menu_name!='- -')?$menu_name:'';
                    $data_insert['created_on'] = date(DEFAULT_SQL_DATE_FORMAT);
                    $data_insert['modified_on'] = date(DEFAULT_SQL_DATE_FORMAT);
                    $data_insert['created_by'] = $results['created_by'];
                    $data_insert['modified_by'] = $results['created_by'];
                    $this->menu_translation_model->insert($data_insert);

                }
                $noti_results=true;
            }
        }
        if(!empty($data['categories'])){
            foreach($data['categories'] as $c_id => $cate_name){
                $isExist = $this->category_translation_model->isExist(['c_id'=>$c_id,'lang_code'=>$data['lang_code']]);
                if(!$isExist){
                    $data_insert['c_id'] = $c_id;
                    $data_insert['lang_code'] = $data['lang_code'];
                    $data_insert['restaurant_id'] = $data['restaurant_id'];
                    $data_insert['name'] = (!empty($cate_name) && $cate_name!='-' &&  $cate_name!='- -')?$cate_name:'';
                    $data_insert['created_on'] = date(DEFAULT_SQL_DATE_FORMAT);
                    $data_insert['modified_on'] = date(DEFAULT_SQL_DATE_FORMAT);
                    $data_insert['created_by'] = $results['created_by'];
                    $data_insert['modified_by'] = $results['created_by'];
                    $this->category_translation_model->insert($data_insert);

                }
                $noti_results=true;
            }
        }
        if(!empty($data['food_items'])){
            foreach($data['food_items'] as $f_id => $food_item){
                $isExist = $this->fooditem_translation_model->isExist(['f_id'=>$f_id,'lang_code'=>$data['lang_code']]);
                if(!$isExist){
                    $data_insert['f_id'] = $f_id;
                    $data_insert['lang_code'] = $data['lang_code'];
                    $data_insert['restaurant_id'] = $data['restaurant_id'];
                    $data_insert['name'] = (!empty($food_item['text']) && $food_item['text']!='-' &&  $food_item['text']!='- -')?$food_item['text']:'';
                    $data_insert['description'] = (!empty($food_item['description']) && $food_item['description']!='-' &&  $food_item['description']!='- -')?$food_item['description']:'';
                    $data_insert['created_on'] = date(DEFAULT_SQL_DATE_FORMAT);
                    $data_insert['modified_on'] = date(DEFAULT_SQL_DATE_FORMAT);
                    $data_insert['created_by'] = $results['created_by'];
                    $data_insert['modified_by'] = $results['created_by'];
                    $this->fooditem_translation_model->insert($data_insert);
                }
                $noti_results=true;
            }
        }
        if($noti_results==true){
            $this->queues_model->delete($queue_id);
        }
    }
    public function notification_send($queue_id){
        $this->load->model('queues_model');
        $this->load->model('restaurants_model');
        $results = $this->queues_model->getRow($queue_id);
        $noti_results=false;
        if(!empty($results)){
            $data = unserialize($results['data']);
            $data['restaurant_id'] = (!empty($data['restaurant_id']) && (trim($data['restaurant_id'])!=""))?$data['restaurant_id']:0;
            if(!empty($data['restaurant_id']) || !empty($data['timezone']) ){
                if( !empty($data['restaurant_id']) ) {
                    $timezone = $this->restaurants_model->getRow($data['restaurant_id'],['timezone']);
                }else{
                    $timezone['timezone'] = $data['timezone'];
                }
                if($timezone){
                    date_default_timezone_set($timezone['timezone']);
                }
            }
            if($results['action']=="send_notification"){
                $app_type = ''; $notificationId = null;
                if($data['send_to']=="type"){
                    $isGlobal = (!empty($data['is_global']))?1:0;
                    $this->load->model('users_model');
                    $users = $this->users_model->getUsersByType($data['app_type'],$data['restaurant_id'], $data['token'], $isGlobal);
                    $app_type = $data['app_type'];
                    if($data['is_save']){
                        $notificationId = $this->save_notification($data['title'],$data['message'],$data['type'],rand(),$data['t_id'],$data['notification_type'],$data['data'],0,$data['restaurant_id']);
                    }
                }else if($data['send_to']=="group"){
                    $this->load->model('users_model');
                    $users = $this->users_model->getUsersByRoles($data['group_id'],$data['restaurant_id'], $data['token']);
                    /*if(in_array(ADMIN_GROUP_ID, $data['group_id']) || in_array(SUBADMIN_GROUP_ID, $data['group_id'])){
                        $app_type = POS;
                    }else if(in_array(CUSTOMER_GROUP_ID, $data['group_id'])){
                        $app_type = APP;
                    }else if(in_array(WAITER_GROUP_ID, $data['group_id']) || in_array(DELIVERY_BOY_GROUP_ID, $data['group_id'])){
                        $app_type = WAITER;
                    }*/
                    if($data['is_save']){
                        $notificationId = $this->save_notification($data['title'],$data['message'],$data['type'],rand(),$data['t_id'],$data['notification_type'],$data['data'],0,$data['restaurant_id']);
                    }
                }else if($data['send_to']=='table'){
                    $this->load->model('table_scan_users_model');
                    $users = $this->table_scan_users_model->getScannedUsersByRoles($data['table_id'], $data['restaurant_id'], $data['token']);
                    $app_type = APP;
                }else if($data['send_to']=='user'){
                    $this->load->model('authtokens_model');
                    $users = $this->authtokens_model->getAllTokens($data['user_id'],@$data['token']);
                    if(!empty($users)){
                        if( $users[0]['group_id'] == ADMIN_GROUP_ID || $users[0]['group_id'] == SUBADMIN_GROUP_ID || $users[0]['app_type'] == POS){
                            $app_type = POS;
                        }else if($users[0]['group_id'] == CUSTOMER_GROUP_ID){
                            $app_type = APP;
                        }else if($users[0]['group_id'] == WAITER_GROUP_ID || $users[0]['group_id']==DELIVERY_BOY_GROUP_ID){
                            $app_type = WAITER;
                        }
                    }

                    if($data['is_save']){
                        $notificationId = $this->save_notification($data['title'],$data['message'],$data['type'],rand(),$data['t_id'],$data['notification_type'],$data['data'],$data['user_id']);
                    }
                }if($data['send_to']=="staff_group"){  //any type of group restaurant or organization link does not matter
                    $this->load->model('users_model');
                    $users = $this->users_model->getStaffByGroupWeb($data['group_id'],@$data['token']);
                }
                $users_notified = [];//Oly in case of send_to = table
                if($users)
                {   
                    foreach($users as $user)
                    {
                        if(!empty($data['request_status_string']) && $data['request_status_string']==DELIVERY_BOY_ORDER_STATUS_ACCEPTED){
                            if($data['data']['request_status'] == DELIVERY_BOY_ORDER_STATUS_ACCEPTED){
                                $data['title'] = 'Delivery request accepted';
                                $data['message'] = 'Delivery boy has accepted the delivery order';
                            }else{
                                $data['title'] = 'Delivery request rejected';
                                $data['message'] = 'Delivery boy has rejected the delivery order';
                            }
                        }
                        if(isset($data['get_cart']) && $data['get_cart']==1 ){
                            $_POST['order_id'] = $data['order_id'];
                            $_POST['restaurant_id'] = $data['restaurant_id'];
                            $this->load->module('main/cart_main');
                            $data['socket_data'] = $this->cart_main->get_cart($_POST,CART_FROM_APP,$user['id']);
                        }
                        
                        if($data['send_to']=='table' || $data['send_to']=='staff_group')
                        {
                            if(!in_array($user['id'],$users_notified))
                            {
                                $notificationId = $this->save_notification($data['title'],$data['message'],$data['type'],rand(),$data['t_id'],$data['notification_type'],$data['data'],$user['id']);
                                $users_notified[] =  $user['id'];
                            }
                        }
                        if($data['send_to'] == "group"){
                            if(($user['group_id'] == WAITER_GROUP_ID || $user['group_id'] == ADMIN_GROUP_ID || $user['group_id'] == SUBADMIN_GROUP_ID) && ($user['app_type'] == POS || $user['app_type'] == WEB)){
                                $app_type = $user['app_type'];
                            }else if($user['group_id'] == CUSTOMER_GROUP_ID){
                                $app_type = APP;
                            }else if($user['group_id'] == WAITER_GROUP_ID || $user['group_id'] == DELIVERY_BOY_GROUP_ID){
                                $app_type = WAITER;
                            }
                        }

                        send_device_notification($user['auth_token'],$data['message'],$data['title'],$data['type'],$data['t_id'],$data['notification_type'],$user['group_id'],$app_type,$data['data'],$data['is_save'],$data['restaurant_id'],$data['socket_data'], $notificationId, $data['production']);
                        $noti_results = true;
                        
                    }
                }
                if($noti_results==true){
                    $this->queues_model->delete($queue_id);
                }
            }
        }
    }

    function save_notification($title,$text,$type,$unique,$t_id,$notification_type,$extra_data = [],$user_id = 0,$restaurant_id = 0){
        
        $data = [
            'title' => $title,
            'text' =>  $text,
            'user_id' => $user_id,
            'restaurant_id' => $restaurant_id,
            'type' =>  $type,
            'unique_id' => $unique,
            't_id' =>  $t_id,
            'notification_type' => $notification_type,
            'click_action' => 'dashboard',
            'created_at' => date(DEFAULT_SQL_DATE_FORMAT),
            'is_read' => 0,
            'and_notification_id' => '',
            'ios_notification_id' => '',
            'web_notification_id' => '',
        ];

        if(in_array($notification_type, StaticArrays::$accept_notification_data)){
            $data['extra_data'] = serialize($extra_data);
        }
        
        $this->load->model('notifications_model');
        return $this->notifications_model->insert($data);
    }


    public function invite_all_users_queue($user_id) {
        $this->load->model('queues_model');
        
        $response = array();
        if(!empty($user_id)) {
            $this->load->model('user_synced_contacts_model');
            $results = $this->user_synced_contacts_model->getAllEmailsForUser($user_id);
            
            if($results){
                $email_template = 'invite_all_users';
                $subject = $this->lang->line('invite_all_subject');

                foreach($results as $row) {
                    $email_data = array();
                    $email_data['name'] = $row['first_name'].' '.$row['last_name'];
                    
                    if(!empty($row['email']) && validateEmail($row['email'])==TRUE ){
                        send_email($row['email'], $subject, $email_template, $email_data);
                    }
                }

                $response['flag'] = FLAG_SUCCESS;
                $response['message']= $this->lang->line("invite_sent");
            } else {
                $response['flag'] = FLAG_SUCCESS;
                $response['message'] = $this->lang->line("no_records");
            }
        } else {
            $response['flag'] = FLAG_ERROR;
            $response['message'] = $this->lang->line("no_records");
        }
        //file_put_contents('test.txt', json_encode($response).PHP_EOL,FILE_APPEND);
        return $response;
    }


}