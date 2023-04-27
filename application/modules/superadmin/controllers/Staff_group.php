<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Staff_group extends MY_Controller  {
    public $layout_view = "layout/".SUPERADMIN;
    
    /**
     * Construct
     */
    public function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model("groups_model","groups");
        $this->data['controller_name'] = $this->controller_name;
        
        $this->load->library("ion_auth","ion_auth");
        $this->load->model("groups_model","groups");
        $this->load->model("phone_code_model","phone_code");
        $this->load->model("grouppermissions_model","group_permissions");

        $this->data["groups"]=$this->groups->get_records(array("is_staff"=>IS_STAFF,"only_active",true),false)['records'];
        $this->data["phone_codes"]=$this->phone_code->get_records(array("only_active",true),false)['records'];
        $this->data["permission_list"][SUPERADMIN]=get_permission_list()[SUPERADMIN];
        $this->data["title"]=$this->lang->line("heading_staff_group");
    }


    public function index($page_no=1){
        $records = $this->groups->get_records(array("is_staff"=>IS_STAFF),true,$page_no);
        
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
        $this->data["title"]=$this->lang->line("heading_add_staff_group");
        $this->data["password_required"]=true;
        if( !empty($this->post_data) ) {
            $this->form_validation->set_rules("name",$this->lang->line("heading_name"),"trim|required");
            
            if( $this->form_validation->run() ) {
                $inset_data = $this->_get_posted_staff_group_data();
                $insert_id = $this->groups->insert($inset_data);
                if( !empty($insert_id) ){
                    $this->load->module("main/group_main");
                    $this->group_main->update_group_permission($this->post_data['permission'],$insert_id);
                    success($this->lang->line("message_insert_success"));
                    redirect(superadmin_url("{$this->controller_name}/index"));
                }
            }else{
                $this->data['post_data'] = $this->post_data;
            }
        }
        $this->layout->view("{$this->module_name}/{$this->controller_name}/form",$this->data);
    }
    
    public function edit($edited_id){
        $this->data["main_form_url"]=superadmin_url("{$this->controller_name}/edit/{$edited_id}");
        $this->data["title"]=$this->lang->line("heading_edit_staff_group");
        $group_id = decrypt($edited_id);
        $record = $this->groups->get_record($group_id)['record'];
        
        if(empty($record)) {
            error($this->lang->line('message_no_records'));
            redirect(superadmin_url("{$this->controller_name}"));
        }else{
            $this->data['post_data'] = $record;
            $group_permissions = $this->group_permissions->get_records($group_id)['records'];
            $this->group_permissions=array();
            foreach( $group_permissions as $key=> $group_permission ){
                @$this->data['group_permissions'][$group_permission['type']][] = $group_permission['name'];
            }
            if( !empty($this->post_data) ) {
                $this->form_validation->set_rules("name",$this->lang->line("heading_name"),"trim|required");
                if( $this->form_validation->run() ) {
                    $inset_data = $this->_get_posted_staff_group_data($group_id);
                    if( $this->groups->update($inset_data,$group_id) ){
                        $this->load->module("main/group_main");
                        $this->group_main->update_group_permission($this->post_data['permission'],$group_id);
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
    private function _get_posted_staff_group_data($staff_id=null){
        $items = array("name","status");
        
        $data = elements($items, $this->post_data);
        if( empty($staff_id) ){
            $data["created_by"] = $this->user_data['id'];
            $data["is_staff"] = IS_STAFF;
            $data["created_at"] = SQL_ADDED_DATE;
            $data['ip_address'] = getVisitorIp();
            $data['is_super_admin'] = 1;
        }else{
            $data['modified_at'] = date(DEFAULT_SQL_DATE_FORMAT);
            $data['modified_by'] = $this->user_data['id'];
        }
        return $data;
    }
}
