<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Staff extends MY_Controller 
{
    public $layout_view = "layout/".SUPERADMIN;
    
    /**
     * Construct
     */
    public function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model("staff_model","staff");
        $this->load->model("groups_model","groups");
        $this->data['controller_name'] = $this->controller_name;
        
        $this->load->library("ion_auth","ion_auth");
        $this->load->model("groups_model","groups");
        $this->load->model("phone_code_model","phone_code");

        $this->data["groups"]=$this->groups->get_records(array("is_staff"=>IS_STAFF,"only_active",true),false)['records'];
        $this->data["phone_codes"]=$this->phone_code->get_records(array("only_active",true),false)['records'];
        $this->data['title'] = $this->lang->line("heading_staff");
    }


    public function index($page_no=1){
        $records = $this->staff->get_records($this->post_data,true,$page_no);
        $count = $records['count'];
        $base_url = superadmin_url("{$this->controller_name}/index");
        $default_count = (int)$this->post_data['per_page_count'] ? (int)$this->post_data['per_page_count'] : DEFAULT_RECORDS_PAGELIMIT;
       
        $config = pagination_array($count,$default_count,$base_url,$page_no,true);
        $this->pagination->initialize($config);
        $this->data["links"] = $this->pagination->create_links();
        $this->data["records"] = $records['records'];
        $this->data["count"] = $records['count'];
        $this->data["start_record"] = ($page_no-1)*$default_count;
        
        $this->layout->view("{$this->module_name}/{$this->controller_name}/index",$this->data);
    }
    
    public function add(){
        $this->data["main_form_url"]=superadmin_url("{$this->controller_name}/add");
        $this->data['title'] = $this->lang->line("heading_add_staff");
        $this->data["password_required"]=true;
        if( !empty($this->post_data) ) {
            $this->form_validation->set_rules("full_name",$this->lang->line("heading_full_name"),"trim|required");
            $this->form_validation->set_rules("phone_code",$this->lang->line("heading_phone_code"),"trim|required");
            $this->form_validation->set_rules("phone_no",$this->lang->line("heading_phone_no"),"required|numeric|is_unique[tbl_users.phone_no]");
            $this->form_validation->set_rules("password",$this->lang->line("heading_password"),"required");
            $this->form_validation->set_rules("email",$this->lang->line("heading_email"),"required|is_unique[tbl_users.email]");

            if( $this->form_validation->run() ) {
                $inset_data = $this->_get_posted_staff_data();
                $insert_id = $this->staff->insert($inset_data);
                if( !empty($insert_id) ){
                    success($this->lang->line("message_insert_success"));
                    redirect(superadmin_url("{$this->controller_name}/index"));
                }
            }else{
                $this->data['post_data'] = $this->post_data;
                error( implode("<br/>",$this->form_validation->error_array()) );
            }
        }
        
        
        $this->layout->view("{$this->module_name}/{$this->controller_name}/form",$this->data);
    }
    
    public function edit($edited_id){
        $this->data["main_form_url"]=superadmin_url("{$this->controller_name}/edit/{$edited_id}");
        $this->data['title'] = $this->lang->line("heading_edit_staff");
        $staff_id = decrypt($edited_id);
        $record = $this->staff->get_record($staff_id)['record'];
        if(empty($record)) {
            error($this->lang->line('message_no_records'));
            redirect(superadmin_url("{$this->controller_name}"));
        }else{
            $record['phone_code'] = encrypt($record['phone_code']);
            $record['group_id'] = encrypt($record['group_id']);
            $this->data['post_data'] = $record;
            
            if( !empty($this->post_data) ) {
                $this->form_validation->set_rules("full_name",$this->lang->line("heading_full_name"),"trim|required");
                $this->form_validation->set_rules("phone_code",$this->lang->line("heading_phone_code"),"trim|required");
                $this->form_validation->set_rules("phone_no",$this->lang->line("heading_phone_no"),"required|numeric|is_unique[tbl_users.phone_no.id.{$staff_id}]");
                $this->form_validation->set_rules("email",$this->lang->line("heading_email"),"required|is_unique[tbl_users.email.id.{$staff_id}]");
                if( $this->form_validation->run() ) {
                    $inset_data = $this->_get_posted_staff_data($staff_id);
                    if( $this->staff->update($inset_data,$staff_id) ){
                        success($this->lang->line("message_update_success"));
                        redirect(superadmin_url("{$this->controller_name}/index"));
                    }
                }else{
                    $this->data['post_data'] = $this->post_data;
                }
            }

        }
        $this->layout->view("{$this->module_name}/{$this->controller_name}/form",$this->data);
    }
    private function _get_posted_staff_data($staff_id=null){
        $items = array("full_name","email","phone_code","phone_no","status","group_id");
        $this->post_data["group_id"] = decrypt($this->post_data["group_id"]);
        $this->post_data["phone_code"] = decrypt($this->post_data["phone_code"]);
        
        if( !empty($this->post_data['password']) ) {
            $this->post_data['password'] = $this->ion_auth->hash_password($this->post_data['password']);
            $items[]="password";
        }
        $data = elements($items, $this->post_data);
        if( empty($staff_id) ){
            $data["created_by"] = $this->user_data['id'];
            $data["created_at"] = SQL_ADDED_DATE;
            $data['ip_address'] = getVisitorIp();
            $data['is_email_verified'] = EMAIL_VERIFIED;
            $data['username'] = $this->post_data["email"];
        }else{
            $data['modified_at'] = date(DEFAULT_SQL_DATE_FORMAT);
            $data['modified_by'] = $this->user_data['id'];
        }
        return $data;
    }
}
