<?php
use \Firebase\JWT\JWT;
class Users extends MY_Controller 
{
    public $layout_view = "layout/".SUPERADMIN;
    
    /**
     * Construct
     */
    public function __construct() {
        parent::__construct();
        // Load form validation library
        // Load session library

        // Load database
        $this->load->model("users_model","users");
        $this->load->model("groups_model","groups");
        $this->load->model("profile_model","profile");
        $this->data = array();
        $this->data["account_verified_status"] = $this->lang->line("heading_verified_status");
        $this->data["controller_name"] = $this->controller_name;
        
    }


    /**
     * Login
     */
    public function login() {
        $post_data = $this->post_data;
        
        $data = array();
        $this->form_validation->set_rules('email', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        
        if( !empty($post_data) ){
            if ($this->form_validation->run() == TRUE ) {
                $response = ['flag' => 0];
                $data = array(
                    'username' => $postData['username'],
                    'password' => $postData['password'],
                    'remember_me' => $postData['remember_me']
                );
                $this->load->module('main/users_main');

                $response = $this->users_main->login_user($post_data['email'],$post_data['password'],array(SUPERADMIN_GROUP_ID,PRIMADMIN_GROUP_ID,EMPLOYEE_GROUP_ID),true);

                
                if($response['flag']==FLAG_SUCCESS) {
                    $this->session->set_userdata('user_data', $response['token']);
                    redirect(superadmin_url());
                    die;
                }else {
                    
                    error($this->lang->line('message_invalid_login'));
                    //redirect(superadmin_url());
                }
            }   
        }     
        $this->load->view(SUPERADMIN."/users/login",$data);  
    }

    /**
     * Logout
     */
    public function logout() {
        $this->data['title'] = "Logout";
        $webUserData = '';
        $user_data = $this->session->userdata("user_data");
        if( !empty($user_data) ){
            $this->load->model('authtokens_model');
            $this->authtokens_model->delete(["auth_token" =>$user_data]);
            $this->session->unset_userdata("userData");
            $this->session->unset_userdata("all_permission");
        }
        if( isset($_SESSION["webUserData"]) &&  !empty($_SESSION["webUserData"]) ) {
            $webUserData = $_SESSION["webUserData"];
        }
        //log the user out
        $logout = $this->ion_auth->logout();
        
        $this->session->unset_userdata(array('language'));
        if( !empty($webUserData) ) {
            $_SESSION['webUserData'] = $webUserData;
        }
        //redirect them to the login page
        $this->session->set_flashdata("message", $this->ion_auth->messages());
        redirect(superadmin_url("{$this->controller_name}/login"), "refresh");
    }
    
    /**
     * Change Password
     */
    public function change_password() {
        // set title 			
        $this->data["main_form_url"] = superadmin_url("{$this->controller_name}/change_password");
        $this->data["title"] = $this->lang->line("heading_change_password");
        $this->layout->title($page_Title);
        
        if( !empty($this->post_data) ) {
            //Form Validations

            $this->form_validation->set_rules("current_password", $this->lang->line("heading_current_password"), "required");
            $this->form_validation->set_rules("new_password", $this->lang->line("heading_new_password"), "required|min_length[".PASSWORD_MIN_LENGTH."]");
            $this->form_validation->set_rules("confirm_password", $this->lang->line("heading_confirm_new_password"), "required|min_length[".PASSWORD_MIN_LENGTH."]|matches[new_password]");

            if( $this->form_validation->run() ) {

                if (!$this->ion_auth->login($this->user_data['email'], $this->post_data['current_password'])) { 
                    
                    error($this->lang->line("message_old_password_error"));
                    redirect(superadmin_url("users/change_password"),"refresh");        
                }else{
                    $id = $this->user_data['id'];
                    $current_username = $this->user_data['email'];
                    if( $this->postData['current_password'] == $this->postData['new_password'] && false ){
                        error($this->lang->line("message_old_password_error"));
                        redirect( (SUPERADMIN."/users/change_password"),'refresh' );
                    }else if ($this->ion_auth_model->change_password($current_username, $this->post_data['current_password'], $this->post_data['new_password']))
                    {

                        success($this->lang->line("message_password_change_success"));
                        redirect(superadmin_url("{$this->controller_name}/change_password"),'refresh');
                    }
                    else
                    {
                        error($this->lang->line('try_again'));
                        redirect(superadmin_url("users/change_password"),'refresh');
                    }
                }
            }
        }
        $this->layout->view(SUPERADMIN."/{$this->controller_name}/change_password", $this->data);
    }
    
    public function resetPassword($uri)
    {
        $uri_data = $this->my_encryption->decode($uri);
        $params = explode('_', $uri_data);
        $user_id = $params[0];
        $activation_code = $params[1];

        $user_data = $this->users_model->getRow(['id' => $user_id, 'activation_code' => $activation_code]);
        if($user_data){
            if(!empty($this->postData)){
                $data = $this->postData;

                //Form Validations
                $this->form_validation->set_rules("new_password", "New Password",'required|min_length[8]');
                // $this->form_validation->set_rules("confirm_password", "Confirm Password", "required|matches[new_password]|min_length[6]");
                $this->form_validation->set_rules("pin", "Pin", "required|min_length[4]|max_length[4]");
                
                if($this->form_validation->run()===FALSE)
                {
                    form_error("new_password");
                    form_error("confirm_password");
                    form_error("pin");
                }
                else
                {
                    $new_password = $data['new_password'];
                    $pin = $data['pin'];
                    $hashed_password = $this->ion_auth_model->hash_password($new_password);
                    $this->users_model->update(['password' => $hashed_password,'pin' => $pin,'activation_code' => ''],$user_id);
                    $this->session->set_flashdata('message', $this->lang->line('password_changed'));
                    unset($this->postData['new_password'], $this->postData['confirm_password'], $this->postData['pin']);
                    $this->postData['username'] = $_POST['username'] = $user_data['email'];
                    $this->postData['password'] = $_POST['password'] = $new_password;
                    $this->postData['remember_me'] = $_POST['remember_me'] = 1;
                    $this->login();
                    // redirect('superadmin', 'refersh');
                }
            }
        } else {
            redirect(superadmin_url(), 'refersh');
        }
        $this->load->view('superadmin/users/reset_password');
    }
    
    
    /**
     *
     * Forgot Password
     *
     */
    public function forgot_password() {
        $postData = $this->postData;
        if(!empty($postData)){
            
            if($res['flag']==0){
                $this->session->set_flashdata("error_message", $res['message']);
            }else if($res['flag']==1){
                $this->session->set_flashdata("message", $this->lang->line('forgot_password_successful'));
            }
        }
        $this->load->view("{$this->module_name}/{$this->controller_name}/forgot_password");
    
    }


    /**
     *
     * Recover Password
     *
     */
    public function recoverPassword($code) {
        $data = $this->my_encryption->decode($code);
        list($user_id, $randStr) = explode('|||', $data);
        $user_data = $this->users_model->getRow(['id' => $user_id, 'forgotten_password_code' => $randStr]);
        if (!empty($user_data)) {/*Incase code expire*/
            $user_data['access_to_change_pin'] = false;   
            if($user_data['group_id'] == SUBADMIN_GROUP_ID || $user_data['group_id'] == ADMIN_GROUP_ID){
                $user_data['access_to_change_pin'] = true;   
            }
        }
        
        if($user_data){
            if(!empty($this->postData)){
                $data = $this->postData;
                //Form Validations
                $this->form_validation->set_rules("new_password", "New Password",'required|min_length[8]');
                $this->form_validation->set_rules("confirm_password", "Confirm Password", "required|matches[new_password]|min_length[6]");  
                if($user_data['group_id'] == SUBADMIN_GROUP_ID || $user_data['group_id'] == ADMIN_GROUP_ID){
                    $this->form_validation->set_rules("change_pin", "Pin", "required|min_length[4]|max_length[4]");
                }
                if($this->form_validation->run()===FALSE)
                {
                    form_error("new_password");
                    form_error("confirm_password");
                }
                else
                {
                    $new_password = $data['new_password'];
                    $hashed_password = $this->ion_auth_model->hash_password($new_password);
                    $update_data = [
                            'password' => $hashed_password,
                            'forgotten_password_code' => '',
                            'active' => 1
                        ];
                    if($user_data['group_id'] == SUBADMIN_GROUP_ID || $user_data['group_id'] == ADMIN_GROUP_ID){
                        $update_data['pin'] = $data['change_pin'];
                    }
                    $this->users_model->update($update_data,$user_id);
                    $this->session->set_flashdata('msg', $this->lang->line('password_changed'));
                    redirect(superadmin_url());
                }
            }
            $this->load->view('superadmin/users/recover_password',$user_data);
        } else {
            $this->layout->view('link_expired');
        }
    }    

    /**
     * check if user exist
     */
    public function check_user_exist() {
        $id_not = $uri_data = $this->my_encryption->decode($this->input->post('id_not'));

        if($id_not){
            $check_user = $this->users_model->getCount(['username'=>$this->input->post('username'),'id !=' => $id_not]);
        }else{
            $check_user = $this->users_model->getCount(['username'=>$this->input->post('username')]);
        }
        if($check_user>0){
            echo json_encode(array('user_exist'=>true));
        }else{
            echo json_encode(array('user_exist'=>false));
        }
        die;
    }
    /**
     * Summary
     */
    
    /**
     * Summary
    */
    public function index($page_no=1) {
        $this->data["main_form_url"]=superadmin_url("{$this->controller_name}/index");
        $this->data["title"] = $this->lang->line("heading_customers");
        $this->data["post_data"] = $this->get_data;
        $records = $this->users->get_records($this->get_data,true,$page_no);
       
        $count = $records['count'];
        $base_url = superadmin_url("{$this->controller_name}/index");
        $default_count = (int)$this->get_data['per_page_count'] ? (int)$this->get_data['per_page_count'] : DEFAULT_RECORDS_PAGELIMIT;
       
        $config = pagination_array($count,$default_count,$base_url,$page_no,true);
        $this->pagination->initialize($config);
        $this->data["links"] = $this->pagination->create_links();
        $this->data["records"] = $records['records'];
        $this->data["count"] = $records['count'];
        $this->data["start_record"] = ($page_no-1)*$default_count;
        $this->layout->view("{$this->module_name}/{$this->controller_name}/index",$this->data);
    }

   
    public function edit_profile(){
        $this->data["main_form_urll"] = superadmin_url("{$this->controller_name}/edit_profile");
        $this->data["title"] = $this->lang->line("heading_edit_profile");
        $this->data['post_data'] = $this->user_data;
        $this->data['post_data']['phone_code'] = encrypt($this->user_data['phone_code']);
        $this->load->model("phone_code_model","phone_code");

        $this->data["phone_codes"]=$this->phone_code->get_records(array("only_active",true),false)['records'];
        if( !empty($this->post_data) ) {
            $this->form_validation->set_rules("full_name", $this->lang->line("heading_full_name"), "trim|required");
            $this->form_validation->set_rules("phone_code", $this->lang->line("heading_phone_code"), "trim|required");
            $this->form_validation->set_rules("phone_no", $this->lang->line("heading_phone_no"), "required|numeric|is_unique[tbl_users.phone_no.id.{$this->user_data['id']}]");
            $this->form_validation->set_rules("email", $this->lang->line("heading_email"), "required|is_unique[tbl_users.email.id.{$this->user_data['id']}]");
            if ($this->form_validation->run()) {
                $old_token = $this->session->userdata("user_data");

                $update_data = $this->_get_posted_profile_data();

                $this->profile->update($update_data, $this->user_data['id']);
                $record = $this->users->get_record($this->user_data['id'])['record'];
                $this->load->module("main/users_main");
                $record["login_from"]=CART_FROM_WEB;
                $response = $this->users_main->create_token($record);
                $this->load->model("authtokens_model", "authtokens");
                $this->authtokens->update(['auth_token' => $response['token']], ['auth_token' => $old_token]);
                $this->session->set_userdata('user_data', $response['token']);


                success($this->lang->line("message_update_success"));
                redirect(superadmin_url("users/edit_profile"));
            }
        }
        $this->layout->view("{$this->module_name}/{$this->controller_name}/edit_profile",$this->data);
    }
    
    public function add(){
        $this->load->model("country_model","country");
        $this->load->model("state_model","state");
        $this->load->model("city_model","city");        

        $this->data["main_form_urll"] = superadmin_url("{$this->controller_name}/add");
        $this->data["title"] = $this->lang->line("heading_add_user_title");
        
        $this->data["countries"] = $this->country->get_records()["records"];
        
        $this->load->model("phone_code_model","phone_code");
        $this->data["phone_codes"]=$this->phone_code->get_records(array("only_active",true),false)['records'];
        if( !empty($this->post_data) ) {
            $this->load->module("main/users_main");
            $response = $this->users_main->register($this->post_data,CUSTOMER_GROUP_ID,true);
            
            if( $response["flag"]==FLAG_SUCCESS ) {
                success($response["message"]);
                redirect(superadmin_url($this->controller_name));
            }else{
                $this->data["post_data"] = $this->post_data;
                error($response["message"]);
            }
        }
        
        if( !empty($this->data['post_data']["country_id"]) ) {
            $this->data["states"] = $this->state->get_records(decrypt($this->data['post_data']["country_id"]),array(),false)["records"];
        }elseif( count($this->data["countries"])==1 ) {
            $this->data["states"] = $this->state->get_records($this->data["countries"][0]["id"],array(),false)["records"];
        }
        
        if( !empty($this->data['post_data']["state_id"]) && !empty($this->data['post_data']["country_id"]) ) {
            $this->data["cities"] = $this->city->get_records(decrypt($this->data['post_data']["country_id"]),decrypt($this->data['post_data']["state_id"]),array(),false )["records"];
        }
        $this->layout->view("{$this->module_name}/{$this->controller_name}/add",$this->data);
    }
    
    public function edit($edited_id){
        $this->load->model("country_model","country");
        $this->load->model("state_model","state");
        $this->load->model("city_model","city");        

        $user_id = decrypt($edited_id);
        $this->data["main_form_urll"] = superadmin_url("{$this->controller_name}/edit");
        $this->data["title"] = $this->lang->line("heading_edit_user_title");
        $record = $this->users->get_record($user_id)["record"];
        
        $this->data['post_data'] = $record;
        $this->data['post_data']["country_id"] = encrypt($this->data['post_data']["country_id"]);
        $this->data['post_data']["state_id"] = encrypt($this->data['post_data']["state_id"]);
        $this->data['post_data']["city_id"] = encrypt($this->data['post_data']["city_id"]);
        $this->data["countries"] = $this->country->get_records()["records"];
        
        $this->data['post_data']['phone_code'] = encrypt($this->user_data['phone_code']);
        $this->load->model("phone_code_model","phone_code");

        $this->data["phone_codes"]=$this->phone_code->get_records(array("only_active",true),false)['records'];
        if( !empty($this->post_data) ) {
            $this->form_validation->set_rules("full_name", $this->lang->line("heading_full_name"), "trim|required");
            if( !empty($post_data["password"]) ) {
                $this->form_validation->set_rules("password", $this->lang->line("heading_password"), "min_length[".PASSWORD_MIN_LENGTH."]");
                $this->form_validation->set_rules("password", $this->lang->line("heading_password"), "min_length[".PASSWORD_MIN_LENGTH."]|matches[password]");
                
            }
            if ($this->form_validation->run()) {
                
                $update_data = $this->_get_posted_user_data($this->post_data,$user_id);
                
                $this->users->update($update_data,$user_id);
                success($this->lang->line("message_update_success"));
                redirect(superadmin_url($this->controller_name));
            }
        }
        
        if( !empty($this->data['post_data']["country_id"]) ) {
            $this->data["states"] = $this->state->get_records(decrypt($this->data['post_data']["country_id"]),array(),false)["records"];
        }elseif( count($this->data["countries"])==1 ) {
            $this->data["states"] = $this->state->get_records($this->data["countries"][0]["id"],array(),false)["records"];
        }
        
        if( !empty($this->data['post_data']["state_id"]) && !empty($this->data['post_data']["country_id"]) ) {
            $this->data["cities"] = $this->city->get_records(decrypt($this->data['post_data']["country_id"]),decrypt($this->data['post_data']["state_id"]),array(),false )["records"];
        }
        $this->layout->view("{$this->module_name}/{$this->controller_name}/edit",$this->data);
    }
    
    public function get_id($id) {
        $record = $this->user_model->restaurant_detail($id); 
        $data['restaurant_id'] = $record;

        $this->layout->view('superadmin/users/restaurants_group_user', $data);
    }    
    
    function unauthorized_access()
    {
        $this->layout->view('superadmin/users/unauthorized_access');
    }
    
    /*
     * Delete Users
     */
    function delete_user($id)
    {
        $id = $this->my_encryption->decode($id);
        $this->users_model->update(['is_deleted'=>1],$id);
        //$this->users_model->delete($id);
        $this->session->set_flashdata("message", $this->lang->line('delete_success'));
        if (isset($_SERVER['HTTP_REFERER'])) {
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            redirect(superadmin_url('users/'));
        }
    }
    function updateWebFirebaseToken(){
        $this->load->module('main/authtoken_main');
        $response = $this->authtoken_main->updateWebFirebaseToken();
        echo  json_encode($response);
        die;
    }
    
    private function _update_token(){        
        $this->load->model('authtokens_model');
        $userData = $this->userData;
        $userData['id'] = $this->userData['id'];
        $userData['group_id'] = $this->my_encryption->encode($this->userData['group_id']);
        $token = $this->session->userData;
        $new_token = JWT::encode($userData, $this->config->item('encryption_key'));
        if($this->authtokens_model->update(['tbl_auth_tokens'=> $new_token],['auth_token'=>$token])){
            $this->session->set_userdata('user_data', $new_token);
            $response = [
                'flag' => 1,
                'message' => $response['message'] = $this->lang->line('success')
            ];
        }else{
            $response = [
                'flag' => 0,
                'message' => $response['message'] = $this->lang->line('try_again')
            ];
        }
        return $response;
       
    }

    public function user_tracking_analytics()
    {
        $data = array();        
        // set title
        
        $default_count = DEFAULT_SUPERADMIN_PAGELIMIT;
        $this->layout->title("User Tracking Analytics Summary");
        $base_url = superadmin_url() . "users/user_tracking_analytics";
        $page = $this->url_translate->uri_segment(4);

        $segment = 4;
        if($this->input->post('perpagecount') > 0){
            $default_count = $this->input->post('perpagecount');
        }
        $data_page = api_paging($default_count,$page);
        $data["page"] = $data_page['start'];
        $all_results = $this->user_tracking_analytics_model->getAllAnalytcis(0,$data_page['limit'],$data_page['start'],$pagination=true,$this->postData);
        
        $data['records'] = $all_results['results'];
        $count = $all_results['count'];
        $config = pagination_array($count,$default_count,$base_url,$segment);
        $this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();

        if($this->input->post()){
            die($this->load->view('superadmin/users/user_tracking_analytics_ajax', $data,true));
        }

        $this->layout->view('superadmin/users/user_tracking_analytics', $data); 
    }
    
    function logout_devices(){
        $this->load->module('main/users_main');
        $response = $this->users_main->logout_devices();
        if($response){
            $this->session->set_flashdata("message", "other devices logged out successfully.");
            redirect(superadmin_url("users/change_password"),"refresh");
        }
    }
    
    public function sessions($user_id="")
    {   
        $postData = $this->postData;
        $this->layout->title("User Active Session");
        $this->load->model('authtokens_model');
        $data['user_sessions_records'] = $this->authtokens_model->get_users_sessions();
        $segment = 4;
        $default_count = DEFAULT_SUPERADMIN_PAGELIMIT;
        if($postData['perpagecount'] > 0){
            $default_count = $postData['perpagecount'];
        }
        $page = $this->url_translate->uri_segment($segment);
        $data_page = api_paging($default_count,$page);
        $data["page"] = $data_page['start'];
        
        $all_results = $this->authtokens_model->get_users_sessions($user_id,$this->userData['is_staff'],$this->userData['id'],$data_page['limit'],$data_page['start'],$pagination=true,$this->postData);

        $data['user_sessions_records'] = $all_results['results'];
        $count = $all_results['count'];
        $base_url = superadmin_url() . "users/sessions";
        $config = pagination_array($count,$default_count,$base_url,$segment);
        $this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();
        $data["is_staff"] = $this->userData['is_staff'];
        if($postData){
           die($this->load->view('superadmin/users/user_session_ajax', $data,true));
        }
        $this->layout->view('superadmin/users/user_session', $data);
    }
    
    public function deleteSession($id, $userID){
        $this->load->model('authtokens_model');
        $id = $this->my_encryption->decode($id);
        $userID = $this->my_encryption->decode($userID);
        $del_permission = hasPermission($this->userData['group_id'],'users.deleteSession','superadmin');
        if(!$this->userData['is_staff'] && $del_permission > 0){
            if($this->userData['id'] == $userID){
                $this->authtokens_model->delete_user_session($id);    
                $this->session->set_flashdata("message", $this->lang->line('delete_success'));
            }else{
                $this->session->set_flashdata("error_message", $this->lang->line('user_seesion_permission'));
            }   
        }elseif($del_permission){
            $this->authtokens_model->delete_user_session($id);
            $this->session->set_flashdata("message", $this->lang->line('delete_success'));
        }
        redirect(superadmin_url('users/sessions'));
    }
    
   

    public function view_profile($user_id) {   
        $user_id = $this->my_encryption->decode($user_id);
        $this->layout->title("Member Profile");
        $this->load->model('order_model');
        $this->load->model('authtokens_model');
        $this->load->model('wallet_model');
        $result['user_data'] = $this->users_model->getRecord($user_id);
        $result['auth_data'] = $this->authtokens_model->getUserLastLogin($user_id);
        $result['order_type'] = $this->order_model->getCountsByOrderType($user_id);
        $result['orders_data'] = $this->order_model->getUserOrderData($user_id);
        $result['analytics_data'] = $this->user_tracking_analytics_model->getUserLocations($user_id);
        $result['wallet_data'] = $this->wallet_model->getDefaultCountryBalance($user_id);
        $result['user_id'] = $user_id;
        $this->layout->view('superadmin/users/view_profile', $result); 	
    }
    
    private function _get_posted_profile_data(){
        $this->post_data['phone_code'] = decrypt($this->post_data['phone_code']);
        $items = array("full_name","email","phone_code","phone_no");   
        $data = elements($items,$this->post_data);
        
        if( !empty($_FILES['image']['name']) ){
            $file_name = get_upload_image_name("{$data["full_name"]}","image","users","image","id",$this->user_data['id'])['file_name'];
            if( !empty($file_name) ) {
                $file_name = fileUpload(BASE_USER_IMAGE_PATH, "", "image","",false,$file_name)['filename'];
                $data['image']=$file_name;
            }
        }elseif( !empty($this->post_data['avatar_remove'])){
            $data['image']='';
        }
        $data['username'] = $data['email'];
        $data['modified_at'] = date(DEFAULT_SQL_DATE_FORMAT);
        $data['modified_by'] = $this->user_data['id'];
        return $data;
    }
    
    private function _get_posted_user_data($post_data,$user_id=''){
        $this->load->model("country_model","country");
        $this->load->model("state_model","state");
        $this->load->model("city_model","city"); 
        $items = array("full_name","gender");
        $data = elements($items,$post_data);
        $data["country_id"] = decrypt($post_data["country"]);
        $data["state_id"] = decrypt($post_data["state"]);
        $data["city_id"] = decrypt($post_data["city"]);
        $data["country"] = $this->country->get_record($data["country_id"])["record"]["name"];
        $data["state"] = $this->state->get_record($data["state_id"])["record"]["name"];
        $data["city"] = $this->city->get_record($data["city_id"])["record"]["name"];
        
        if( !empty($_FILES['image']['name']) ){
            if( !empty($user_id) ){
                $file_name = get_upload_image_name("{$data["full_name"]}","image","users","image","id",$user_id)['file_name'];
            }else{
                $file_name = get_upload_image_name("{$data["full_name"]}","image","users","image")['file_name'];
                
            }
            if( !empty($file_name) ) {
                $file_name = fileUpload(BASE_USER_IMAGE_PATH, "", "image","",false,$file_name)['filename'];
                $data['image']=$file_name;
            }
        }elseif( !empty($post_data['avatar_remove'])){
            $data['image']='';
        }
        if( !empty($post_data["password"]) ) {
            $this->load->library("ion_auth");
            $data['password'] = $this->ion_auth->hash_password($post_data["password"]);
            $data['password_set'] = PASSWORD_SET;
            
        }
        if( !empty($user_id) ){
            $data['modified_at'] = date(DEFAULT_SQL_DATE_FORMAT);
            $data['modified_by'] = $this->user_data['id'];
        }
        return $data;
    }
    
    public function verify_phone($edited_id){
        
        $this->load->module("main/users_main");
        $response = $this->users_main->verify_phone($edited_id,CART_FROM_WEB);
        if( $response["flag"]==FLAG_SUCCESS ) {
            success($response["message"]);
        }else{
            error($response["message"]);
        }
        redirect( superadmin_url($this->controller_name) );
        
    }
    
    public function generate_referral_code($encoded_id){
        $this->load->module("main/users_main");
        $response = $this->users_main->generate_referral_code($encoded_id);
        if( $response["flag"]==FLAG_SUCCESS ) {
            success($response["message"]);
        }else{
            error($response["message"]);
        }
        redirect(superadmin_url("{$this->controller_name}"));
    }
}
