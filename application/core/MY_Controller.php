<?php

use \Firebase\JWT\JWT;

class MY_Controller extends MX_Controller {

    // Site global layout
    public $layout_view = 'layout/admin_inner';
    public $global_data;
    protected $post_data = []; //Input post data
    protected $get_data = [],$userToken='',$controller_name,$method_name; //Input post data
    public $response_data = [];
    public $scripts = [];
    public $message = '';
    public $flag = 0;
    public $cms_pages = [];
    public $user_data = ['full_name' => 'Guest' ,'id' => 0 ,'user_id' => 0,'group_id' => GUEST_GROUP_ID,'lang_id'=>'1'];
    public $notification = [];
    public $timeFormatSet = 0;
    public $timeFormat = MILITARY_TIME_FORMAT;
    public $module_name ,$action_name = '';


    public function __construct() {
        parent::__construct();
        
        $this->user_data['rand'] = session_id();
        // enableGzip(1);

        $this->controller_name = $this->router->fetch_class();
        $this->method_name = $this->router->fetch_method();
        $action = $this->controller_name . '.' . $this->method_name;
        $this->action_name = $action;
        $this->base_url = rtrim( base_url(),"/" );
        $this->post_data = cleanInput($this->input->post());
        $this->get_data = cleanInput($this->input->get());
        

        //Api  Route Access

        $web_escape_action = array("home.index","listing.index","listing.all_listing","listing.get_all_listing","listing.detail","listing.listing_ecard","pages.privacy_policy","pages.terms_conditions","pages.contact_us","pages.benefits","pages.about","blogs.index","blogs.view","ajax.get_states","ajax.get_cities","ajax.getip_latlng","ajax.latlng_detail","users.signup","users.signin","users.forgot_password","users.resend_verify_code","users.verify_account");

        
        // $escape_actions[SUPERADMIN] = ['users.login', 'users.reset_password', 'users.recover_password', 'users.forgot_password'];
        $escape_actions = array(SUPERADMIN=>array("users.login"),
                            MODULE_NAME_WEB=>$web_escape_action,
                           MODULE_NAME_API=>array('api.signin','api.signup','api.signup_data'),        
                        );


        $module = strtolower($this->uri->segment(1));
        $nonuser_actions= array(SUPERADMIN=>array('users.login'),
                            MODULE_NAME_WEB=>array('users.login'),
                            MODULE_NAME_API=>array('api.signin','api.signup','api.signup_data',
                        ),
        );
        $loginPage = array( SUPERADMIN=>superadmin_url(),MODULE_NAME_WEB=>$this->base_url);
        
        $homePage = array(SUPERADMIN=>superadmin_url('dashboard'),MODULE_NAME_WEB=>$this->base_url);
//        if ($module == 'cli') {
//        } else {
//            $frontEndModule = 'web';
//            $module = MODULE_NAME_WEB;
//        }
        
        $this->load->helper(array('html', 'url', 'form', 'text', 'functions_helper'));
        $this->load->library(array('pagination','layout', 'StaticArrays', 'StaticFunctions', 'ion_auth','my_form_validation'=>'form_validation'));
       
        $this->module_name = $module;

        if ($this->module_name == 'cli') {
            
        }elseif( is_superadmin_module() ) {
            if(!empty($this->session->user_data)) {
                $this->user_data = tokenAuthenticate($this->session->user_data,$this->user_data);
                $this->user_data['permissions']= isset($this->session->userPermissions) && is_array($this->session->userPermissions) ? $this->session->userPermissions :[];
            }
            checkAccess($this->user_data,$action,$escape_actions,$nonuser_actions,SUPERADMIN ,$loginPage,$homePage);
        }elseif( is_api_module() ){
            if(MAINTENANCE){           
               http_response_code(503);
               echo json_encode(['flag'=>0,'message'=>'Application under maintainence, we will be back very soon']);exit;
            }
            
            $headers = $this->input->request_headers();
            if(!empty($headers['X-Auth-Token'])){
                try{
                    $this->user_data = tokenAuthenticate($headers['X-Auth-Token'],$this->user_data);
                    if(empty($this->userData))
                    { 
                        die('Invalid Token');
                    }
                }
                catch(Exception $e)
                {
                        die('Invalid Token');
                }
            }
            checkAccess($this->user_data,$action,$escape_actions,$nonuser_actions,$module,$loginPage,$homePage);
        }else{

            $this->module_name=MODULE_NAME_WEB;
            if(!empty($this->session->web_user_data)) {
                $this->user_data = tokenAuthenticate($this->session->web_user_data,$this->user_data);
            }

            checkAccess($this->user_data,$action,$escape_actions,$nonuser_actions,MODULE_NAME_WEB ,$loginPage,$homePage);
        }
        
        $this->lang->load('main_lang', strtolower(StaticArrays::$language[$this->user_data['lang_id']]));
//        $lang_dir = strtolower(StaticArrays::$app_language[$this->userData['lang_id']]);
//        if (is_dir(FCPATH . 'system/language/' . $lang_dir) && $this->userData['lang_id'] != DEFAULT_LANGUAUGE_ID) {
//            $this->config->set_item('language', $lang_dir);
//        }
        $this->session_data = cleanInput($this->session->userdata);
    }

    // Add Record
    public function add_record($table, $data) {
        $data['created_on'] = date(DEFAULT_SQL_DATE_FORMAT);
        $user_id = $this->ion_auth->get_user_id();
        $data['created_by'] = (!empty($user_id)) ? $user_id : 0;
        $data['modified_on'] = date(DEFAULT_SQL_DATE_FORMAT);
        $data['modified_by'] = (!empty($user_id)) ? $user_id : 0;
        $this->db->insert($table, $data);
        return;
    }

    // Edit Record
    public function edit_record($table, $data, $id, $field_name_id) {
        $data['modified_on'] = date(DEFAULT_SQL_DATE_FORMAT);
        $data['modified_by'] = $this->ion_auth->get_user_id();
        $this->db->where($field_name_id, $id);
        $this->db->update($table, $data);
    }

    public function isExist($table_name, $where) {
        if (!is_array($where)) {
            $where = ['id' => $where];
        }
        $this->db->select('count(id) as count');

        $data = $this->db->get_where($table_name, $where, 1);
        $result = $data->result_array();
        if ($result[0]['count'] == 1) {
            return true;
        } else {
            return false;
        }
    }

    // Delete Record
    public function delete_record($table, $id, $field_name_id) {
        $this->db->delete($table, array($field_name_id => $id));
    }

    // Generate Password
    public function generateRandomString($length, $strength, $pw = 0) {
        $password = $upper_case = '';
        $lower_case = $vowels = 'aeuy';
        $lower_case .= $consonants = 'bdghjmnpqrstvz';
        $numbers = '23456789';
        $special_chars = '@#$%';

        if ($strength & 1) {
            $consonants .= $upper_case = 'BDGHJLMNPQRSTVWXZ';
        }
        if ($strength & 2) {
            $upper_case .= $vowels .= "AEUY";
        }
        if ($strength & 4) {
            $consonants .= $numbers;
        }
        if ($strength & 8) {
            $consonants .= $special_chars;
        }

        if (!empty($pw)) {

            $password = substr(str_shuffle($consonants), 0, $length);
            if (!preg_match(PHP_PASSWORD_REGEX, $password)) {
                return $this->generateRandomString($length, $strength, $pw);
            }
        } else {
            $alt = time() % 2;
            for ($i = 0; $i < $length; $i++) {
                if ($alt == 1) {
                    $password .= $consonants[(rand() % strlen($consonants))];
                    $alt = 0;
                } else {
                    $password .= $vowels[(rand() % strlen($vowels))];
                    $alt = 1;
                }
            }
        }
        return $password;
    }

    // validate data	
    public function validate_data($table, $field_name, $id) {
        $query = $this->db->get_where($table, array($field_name => $id));
        $result = $query->row_array();
        if (!$result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //Check is superadmin login
    public function authenticateSuperadmin() {
        // $current_user_data = $this->user_model->get_user_permission($this->session->userdata('user_id'));
        // if (isset($current_user_data[0]) && !empty($current_user_data[0]['is_super_admin']) && $current_user_data[0]['is_super_admin']== 1 )
        // {
        // }
        // else if($current_user_data[0]['group_id'] != SUPERADMIN_GROUP_ID )
        // {
        //     redirect(SUPERADMIN);
        // }
    }

    //Check is superadmin login
    public function authenticateAdmin() {
        // $current_user_data = $this->user_model->get_user_permission($this->session->userdata('user_id'));
        // if ($current_user_data[0]['is_super_admin'] == 1 )
        // {
        // }
        // else if($current_user_data[0]['group_id'] != ADMIN_GROUP_ID )
        // {
        //     redirect('admin');
        // }
    }

    //Check is POS login
    public function authenticateAdminPOS() {
        $current_user_data = $this->user_model->get($this->session->userdata('user_id'));
        if ($current_user_data['group_id'] != ADMIN_GROUP_ID) {
            redirect('pos');
        }
    }

    /**
     * Gets Cart Counter
     */
    public function get_cart_counter($session_id, $rest_id = NULL) {
        //Gets Total items in cart
        $rest_id = $rest_id;
        $record = $this->db->select("*")
                ->from('carts')
                ->where('carts.session_id="' . $session_id . '" AND carts.restaurant_id = "' . $rest_id . '"');
        $record = $record->get()->result();
        $cart_counter = COUNT($record);
        return $cart_counter;
    }

    /*
     * get user profile image
     */

    public function get_user_image_path($image_name) {
        if (!empty($image_name)) {
            $image_path = base_url() . USERS_IMG_PATH . $image_name;
            // User from facebook then skip its static path
            if (strpos($image_name, "http://") !== false || strpos($image_name, "https://") !== false) {
                $image_path = $image_name;
            }
        } else {
            $image_path = base_url() . USERS_IMG_PATH . 'bot_user.png';
        }
        return $image_path;
    }

    /**
     * Generate Invoice Number
     * For orders
     */
    public function generate_invoice_number($restaurant_id, $delivery_type = DELIVERY_TYPES_DELIVERY) {
        //Gets Settings based on restaurant_id
        $restaurant_settings = $this->db->get_where("restaurant_settings", array("restaurant_id" => $restaurant_id));
        $restaurant_settings = $restaurant_settings->row_array();
        //Gets last order from orders table based on restaurant id and delivery types
        if ($delivery_type == DELIVERY_TYPES_DINEIN) {
            $cond = ' AND delivery_type = ' . DELIVERY_TYPES_DINEIN;
        } else {
            $cond = ' AND delivery_type IN(' . DELIVERY_TYPES_TAKEAWAY . ',' . DELIVERY_TYPES_DELIVERY . ')';
        }

        $orders = $this->db->select("orders.invoice_id")
                ->from('orders')
                ->where('orders.restaurant_id=' . $restaurant_id . $cond)
                ->order_by('orders.id DESC')
                ->limit(1);
        $orders = $orders->get()->result_array();
        //Checks Invoice number by orders or restaurant settings
        if (isset($orders[0]['invoice_id']) && !empty($orders[0]['invoice_id'])) {
            $invoice_id = $orders[0]['invoice_id'];
        } else {
            if ($delivery_type == DELIVERY_TYPES_DINEIN) {
                $invoice_id = $restaurant_settings['order_number_for_dinein'];
            } else { // DELIVERY_TYPES_TAKEAWAY, DELIVERY_TYPES_DELIVERY
                $invoice_id = $restaurant_settings['order_number_for_td'];
            }
        }

        //Gets string with number + 1
        function inc($matches) {
            return ++$matches[1];
        }

        $input_number = preg_replace_callback("|(\d+)|", "inc", $invoice_id);

        return($input_number);
    }

    /**
     * Create Restaurant user
     * From web, app, pos
     */
    public function create_restaurant_users($restaurant_id, $user_id) {
        // Make user to restaurant specific
        //Check its already exist
        $check_record = $this->db->select('COUNT(*)AS counter')
                ->from('restaurant_users')
                ->where('restaurant_users.restaurant_id = ' . $restaurant_id . ' AND restaurant_users.user_id = ' . $user_id);
        $rec_record = $check_record->get()->result_array();
        if ($rec_record[0]['counter'] == 0) {
            $data_array = array(
                'restaurant_id' => $restaurant_id,
                'user_id' => $user_id
            );
            $this->add_record('restaurant_users', $data_array);
        }
    }

    /**
     * Create notifications
     * From web, app, pos
     */
    public function notification_handler($user_id, $restaurant_id, $notification_template_id, $placeholders, $notification_from, $notification_type, $is_important = 0, $pincode = NULL, $order_id = NULL, $booking_id = NULL, $table_id = NULL, $is_confirm = NULL) {
        //Gets notification template
        $query = $this->db->get_where("notification_templates", array("notification_type" => $notification_template_id));
        $notification_template = $query->row_array();

        //Resolves message placeholders
        foreach ($placeholders as $key => $value) {
            $notification_template['body'] = str_replace("{{{$key}}}", "$value", $notification_template['body']);
        }

        //Logs notification message
        $notification_logs = array(
            'user_id' => $user_id,
            'notification_template_id' => $notification_template['id'],
            'restaurant_id' => $restaurant_id,
            'order_id' => $order_id,
            'booking_id' => $booking_id,
            'title' => $notification_template['title'],
            'content' => $notification_template['body'],
            'is_important' => $is_important,
            'pincode' => $pincode,
            'is_confirm' => $is_confirm,
            'notification_from' => $notification_from,
            'notification_type' => $notification_type,
            'table_id' => $table_id
        );
        $this->add_record('user_notification_logs', $notification_logs);
        $row_single = $this->db->select('device_token')->get_where("users", array('id' => $user_id))->result();
        if (!empty($row_single)) {
            $this->send_ios_notification($notification_template['body'], $row_single[0]->device_token, $notification_type);
        }
    }

    /*
     *  Send Notification
     */

    function verification_notificaiton($id = NULL, $table_name = NULL, $message = NULL, $type_notification = NULL, $notification_to = NULL, $show_restaurant_name = NULL, $field_name = NULL, $for_pos = NULL) {
        $row_single = $this->db->get_where($table_name, array('id' => $id))->result();
        if (isset($row_single) && !empty($row_single)) {
            $restaurant_id = $row_single[0]->restaurant_id;
        }
        if ($table_name == 'users') {
            $user_id = $id;
        } else {
            if (isset($field_name) && !empty($field_name)) {
                $user_id = $row_single[0]->$field_name;
            } else {
                $user_id = $row_single[0]->user_id;
            }
        }

        //Get restaurant Details
        $restaurant_details = $this->db->get_where('restaurants', array('id' => $restaurant_id))->result_array();
        $restaurant_name = $restaurant_details[0]['name'];

        if ($show_restaurant_name == 0) {
            $message = $message;
        } else {
            $message = $message . ' at ' . $restaurant_name;
        }

        if ($user_id > 0 && !empty($user_id)) {
            //Now Check Device Token For IOS Notifications
            $token = $this->check_device_token($user_id);
            $token_device = $token['deviceToken'];
            $is_logged_in = $token['is_logged_in'];
            if (isset($token_device) && !empty($token_device)) {
                if ($table_name == 'orders') {
                    $id_order_for_waiter = $id;
                } else {
                    $id_order_for_waiter = '';
                }

                //Create a Notification Log 
                $app_log = array(
                    'restaurant_id' => $restaurant_id,
                    'user_id' => $user_id,
                    'notification_body' => $message,
                    'order_id' => $id_order_for_waiter
                );

                $this->add_record('notification_logs_app', $app_log);

                $notification_type = $type_notification;
                //if Device Token Exist then proceed for push notifications
                if ($is_logged_in == 1) {
                    if ($notification_to == WAITER_GROUP_ID) {
                        $this->send_ios_notification_waiter($message, $token_device, $notification_type);
                    } else if (isset($for_pos) && !empty($for_pos) && $for_pos == 1) {
                        $this->send_ios_notification_pos($message, $token_device, $notification_type);
                    } else {
                        $this->send_ios_notification($message, $token_device, $notification_type);
                    }
                }
            }
        }
    }

    /*
     *  Push Notification for Apple IOS
     */

    public function send_ios_notification($message = NULL, $token_device = NULL, $notification_type = NULL) {
        $message = $message;

        $body['aps'] = array(
            'alert' => trim($message),
            'sound' => 'default',
            'data' => $notification_type
        );


        $deviceToken = $token_device;

        // Encode the payload as JSON
        $payload = json_encode($body);
        //$deviceToken = 'b84a67602250737445446ae797368467c737e1d7ce05c9654e1162888663fd4e';
        $msg = chr(0) . pack('n', 32) . pack('H*', trim($deviceToken)) . pack('n', strlen($payload)) . $payload;

        // For sandbox
        $url = 'ssl://gateway.sandbox.push.apple.com:2195';
        $passphrase = 'push@123';
        $ctx = stream_context_create();

        if ($_SERVER['HTTP_HOST'] == 'localhost') {
            stream_context_set_option($ctx, 'ssl', 'local_cert', 'C:\Users\dev\ios_notification.pem');
        } else {
            $apnsCert = FCPATH . '/ios_notification.pem';
            stream_context_set_option($ctx, 'ssl', 'local_cert', $apnsCert);
        }

        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        // Connection to APNS server
        $fp = stream_socket_client($url, $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
        if (!$fp) {
            //exit("Failed to connect: $err $errstr" . PHP_EOL);
        }

        $result = fwrite($fp, $msg, strlen($msg));

        if (!$result) {
            //  echo 'Message not delivered' . PHP_EOL;
        } else {
            // echo 'Message successfully delivered' . PHP_EOL;
            //return $result;
        }
        // Close the connection to the server
        fclose($fp);
    }

    /*
     *  Push Notification for Apple IOS
     */

    public function send_ios_notification_waiter($message = NULL, $token_device = NULL, $notification_type = NULL) {
        $message = $message;

        $body['aps'] = array(
            'alert' => trim($message),
            'sound' => 'default',
            'data' => $notification_type
        );


        $deviceToken = $token_device;

        // Encode the payload as JSON
        $payload = json_encode($body);
        //$deviceToken = 'b84a67602250737445446ae797368467c737e1d7ce05c9654e1162888663fd4e';
        $msg = chr(0) . pack('n', 32) . pack('H*', trim($deviceToken)) . pack('n', strlen($payload)) . $payload;

        // For sandbox
        $url = 'ssl://gateway.sandbox.push.apple.com:2195';
        $passphrase = 'push@123';
        $ctx = stream_context_create();

        if ($_SERVER['HTTP_HOST'] == 'localhost') {
            stream_context_set_option($ctx, 'ssl', 'local_cert', 'C:\Users\dev\waiterDev.pem');
        } else {
            $apnsCert = FCPATH . '/waiterDev.pem';
            stream_context_set_option($ctx, 'ssl', 'local_cert', $apnsCert);
        }

        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        // Connection to APNS server
        $fp = stream_socket_client($url, $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
        if (!$fp) {
            // exit("Failed to connect: $err $errstr" . PHP_EOL);
        }

        $result = fwrite($fp, $msg, strlen($msg));

        if (!$result) {
            //  echo 'Message not delivered' . PHP_EOL;
        } else {
            //  echo 'Message successfully delivered' . PHP_EOL;
            // return $result;
        }
        // Close the connection to the server
        fclose($fp);
    }

    /*
     *  Push Notification for Apple IOS
     */

    public function send_ios_notification_pos($message = NULL, $token_device = NULL, $notification_type = NULL) {
        $message = $message;

        $body['aps'] = array(
            'alert' => trim($message),
            'sound' => 'default',
            'data' => $notification_type
        );


        $deviceToken = $token_device;

        // Encode the payload as JSON
        $payload = json_encode($body);
        //$deviceToken = 'b84a67602250737445446ae797368467c737e1d7ce05c9654e1162888663fd4e';
        $msg = chr(0) . pack('n', 32) . pack('H*', trim($deviceToken)) . pack('n', strlen($payload)) . $payload;

        // For sandbox
        $url = 'ssl://gateway.sandbox.push.apple.com:2195';
        $passphrase = 'push@123';
        $ctx = stream_context_create();

        if ($_SERVER['HTTP_HOST'] == 'localhost') {
            stream_context_set_option($ctx, 'ssl', 'local_cert', 'C:\Users\Dev\POS_iOS_Notification.pem');
        } else {
            $apnsCert = FCPATH . '/POS_iOS_Notification.pem';
            stream_context_set_option($ctx, 'ssl', 'local_cert', $apnsCert);
        }

        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        // Connection to APNS server
        $fp = stream_socket_client($url, $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
        if (!$fp) {
            // exit("Failed to connect: $err $errstr" . PHP_EOL);
        }

        $result = fwrite($fp, $msg, strlen($msg));

        if (!$result) {
            //  echo 'Message not delivered' . PHP_EOL;
        } else {
            //  echo 'Message successfully delivered' . PHP_EOL;
            //return $result;
        }
        // Close the connection to the server
        fclose($fp);
    }

    /*
     * Check user Device token
     */

    public function check_device_token($user_id) {
        $data['deviceToken'] = '';
        $data['is_logged_in'] = '';

        //Get device token from user
        $temp = $this->db->select('users.device_token, users.is_logged_in')
                ->from('users')
                ->where('users.id="' . $user_id . '"');
        $token = $temp->get()->row();
        if (isset($token) && !empty($token)) {
            $data['deviceToken'] = $token->device_token;
            $data['is_logged_in'] = $token->is_logged_in;
        }
        return $data;
    }

    /*
     * Save Notification log for app
     */

    public function roles_permission() {
        $group_id = $this->global_data['current_user_data']['group_id'];

        $permission = array('id' => '', 'is_super_admin' => '', 'group_id' => '', 'is_commission' => '', 'is_dashboard' => '', 'is_members' => '', 'is_restaurants' => '', 'is_food_items' => '', 'is_purchase' => '', 'is_seating_plan' => '', 'is_booking' => '', 'is_news' => '', 'is_email_templates' => '', 'is_notification_templates' => '', 'is_orders' => '', 'is_cms' => '', 'is_enquiries' => '', 'is_reviews' => '', 'is_favorites' => '', 'is_taxes' => '', 'is_settings' => '', 'created_by' => '', 'created_on' => '', 'modified_by' => '', 'modified_on' => '', 'restaurant_id' => '', 'name' => '', 'description' => '', 'is_reports' => '', 'role_permissions' => '0');
        $cond = '';
        if (isset($this->global_data['current_user_data']['restaurant_id']) && $this->global_data['current_user_data']['restaurant_id'] > 1) {
            $restaurant_id = $this->global_data['current_user_data']['restaurant_id'];
            $cond = ' AND role_permissions.restaurant_id="' . $restaurant_id . '"';
        } else {
            $cond = ' AND role_permissions.is_super_admin = 1';
        }

        //Get all things
        $q = $this->db->select('role_permissions.*')
                ->from('role_permissions')
                ->where('role_permissions.group_id="' . $group_id . '"' . $cond)
                ->join('groups', 'groups.id = role_permissions.group_id');
        $tmp = $q->get()->result_array();
        if (isset($tmp) && !empty($tmp)) {
            $permission = $tmp[0];
        }

        if ($group_id == SUPERADMIN_GROUP_ID || $group_id == ADMIN_GROUP_ID) {
            $permission = array('id' => '1', 'is_super_admin' => '1', 'group_id' => '1', 'is_commission' => '1', 'is_dashboard' => '1', 'is_members' => '1', 'is_restaurants' => '1', 'is_food_items' => '1', 'is_purchase' => '1', 'is_seating_plan' => '1', 'is_booking' => '1', 'is_news' => '1', 'is_email_templates' => '1', 'is_notification_templates' => '1', 'is_orders' => '1', 'is_cms' => '1', 'is_enquiries' => '1', 'is_reviews' => '1', 'is_favorites' => '1', 'is_taxes' => '1', 'is_settings' => '1', 'created_by' => '1', 'created_on' => '1', 'modified_by' => '1', 'modified_on' => '1', 'restaurant_id' => '1', 'name' => '1', 'description' => '1', 'is_reports' => '1', 'role_permissions' => '1');
        }
        return $permission;
    }

    private function block_permission() {
        $check = array(
            'dashboard' => 'group_id',
            'login' => 'group_id',
            'users' => 'is_members',
            'commissions' => 'is_commission',
            'restaurants' => 'is_restaurants',
            'food_items' => 'is_food_items',
            'food_categories' => 'is_food_items',
            'attibutes' => 'is_food_items',
            'purchases' => 'is_purchase',
            'suppliers' => 'is_purchase',
            'restaurant_tables' => 'is_seating_plan',
            'restaurant_bookings' => 'is_booking',
            'user_email_logs' => 'is_email_templates',
            'user_notification_logs' => 'is_notification_templates',
            'restaurant_reviews' => 'is_reviews',
            'orders' => 'is_orders',
            'restaurant_favorites' => 'is_favorites',
            'restaurant_reports' => 'is_reports',
            'restaurant_settings' => 'is_settings',
            'roles_permission_admin' => 'role_permissions',
            'roles_permission' => 'role_permissions',
            'unauthorized_access' => 'group_id',
            'restaurant_categories' => 'is_restaurants',
            'restaurant_news' => 'is_news',
            'email_templates' => 'is_email_templates',
            'notification_templates' => 'is_notification_templates',
            'pages' => 'is_cms',
            'testimonials' => 'is_cms',
            'enquiries' => 'is_enquiries',
            'restaurant_taxes' => 'is_taxes',
        );
        return $check;
    }

    function client_address_verification() {
        require_once(APPPATH . 'libraries/RestClient.php');

        $client = new PostcodeNl_Api_RestClient('SP57EUeSy03n7mzzq74yDEL5h1POcNcalRjqptkHlxq', 'wZ6ilfEL3P9K1hXw8kw4uAtz4NIsOjTco8CGH34P8PRk4uyemH', 'https://api.postcode.nl/rest');
        $client->setDebugEnabled();

        $data = $this->input->post();
        if ($data) {
            $result = $client->lookupAddress($data['postcode'], $data['houseNumber'], $data['houseNumberAddition'], !empty($data['validateHouseNumberAddition']));
            $addressResult = $result;
            $addressResult['flag'] = 1;
            echo json_encode($addressResult);
            exit;
        } else {
            $addressResult['flag'] = 0;
            $addressResult['error'] = 'Error Posting';
            echo json_encode($addressResult);
            exit;
        }
    }

    public function mail_error($errno, $errstr, $errfile, $errline) {
        $message = "[Error $errno] $errstr - Error on line $errline in file $errfile";
        error_log($message); // writes the error to the log file
        //mail('ythewaitlogs@yopmail.com', 'I have an error', $message);
    }

}
