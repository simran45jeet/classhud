<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Group_permissions extends MY_Controller {
    public $layout_view = "layout/".SUPERADMIN;
    
     /**
     * Construct
     */
    public function __construct() {
        parent::__construct();

        // Load database
        $this->load->model("grouppermissions_model","group_permissions");
        $this->load->model("groups_model","groups");
        $this->load->library("ion_auth","ion_auth");
        $this->data=array();
        $this->data['controller_name']=$this->controller_name;
        $this->data['title']=$this->lang->line("heading_group_permission");
    }

    /**
     * Summary
     */
    public function index($page_no=1) {
        $records = $this->groups->get_records($this->post_data,$pagination=true,$page_no);
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
    
    /*
     * assign roles 
     */
    public function edit($edited_id) {
        $this->data['title']=$this->lang->line("heading_group_permission");
        $this->data["main_form_url"] = superadmin_url("{$this->controller_name}/change_permission/{$edited_id}");
        $group_id = decrypt($edited_id);
        $this->data["group"] = $this->groups->get_record($group_id)['record'];
        
        $this->data["permissions"] = get_permission_list();
        $group_permissions = $this->group_permissions->get_records($group_id)['records'];
        
        $arry_permission = array();
        
        if($group_permissions){
            foreach ($group_permissions as  $value) {
                $this->data['group_permissions'][$value['type']][] = $value['name'];
            }
        }
        $this->layout->view("{$this->module_name}/{$this->controller_name}/edit", $this->data);
    }
    
    public function change_permission($edited_id) {
        $group_id = decrypt($edited_id);
        
        if( isset($this->post_data['keep']) && !empty($this->post_data['name']) && !empty($this->post_data['type']) ) {
            $qData['group_id'] =  $group_id;
            $qData['name'] = $this->post_data['name'];
            $qData['type'] = $this->post_data['type'];
            if($this->post_data['keep'] == 'true'){
                if(!$this->group_permissions->isExist($qData)){
                    $this->group_permissions->insert($qData); 
                }
            }else{
                $this->group_permissions->delete($qData); 
            }
        }
        $response = array( "flag"=>FLAG_SUCCESS,"mesage"=>$this->lang->line("message_update_success"));
        outputJsonData($response);
    }

    /*
     * permission types
     */
    private function _all_permission_type($id)
    {
        $tmp    = $this->roles_permission_model->get_roles_permissions($id);
        $data   = (isset($tmp['permissions'][0]) ? $tmp['permissions'][0]: '');
        
        $permission['permission_types'] = array(
            $this->lang->line('login_to_superadmin') => (isset($data['is_login_in_superadmin']) && $data['is_login_in_superadmin'] == 1 ? 1 : ''), 
            $this->lang->line('commission')            =>  ((isset($data['is_commission']) && $data['is_commission'] == 1) ? 1 : ''), 
            $this->lang->line('members')               => (isset($data['is_members']) && $data['is_members'] == 1 ? 1 : ''), 
            $this->lang->line('restaurants')           => (isset($data['is_restaurants']) && $data['is_restaurants'] == 1 ? 1 : ''), 
            $this->lang->line('food_menu')             => (isset($data['is_food_items']) && $data['is_food_items'] == 1 ? 1 : ''), 
            $this->lang->line('purchases')             => (isset($data['is_purchase']) && $data['is_purchase'] == 1 ? 1 : ''), 
            $this->lang->line('seating_plan')          => (isset($data['is_seating_plan']) && $data['is_seating_plan'] == 1 ? 1 : ''), 
            $this->lang->line('restaurant_booking')              => (isset($data['is_booking']) && $data['is_booking'] == 1 ? 1 : ''), 
            $this->lang->line('restaurant_news')                  => (isset($data['is_news']) && $data['is_news'] == 1 ? 1 : ''), 
            $this->lang->line('email_templates')       => (isset($data['is_commission']) && $data['is_commission'] == 1 ? 1 : ''), 
            $this->lang->line('cms')          => (isset($data['is_cms']) && $data['is_cms'] == 1 ? 1 : ''), 
            $this->lang->line('email_templates')                => (isset($data['is_email_templates']) && $data['is_email_templates'] == 1 ? 1 : ''), 
            $this->lang->line('enquiries')                   => (isset($data['is_enquiries']) && $data['is_enquiries'] == 1 ? 1 : ''), 
            $this->lang->line('notification_templates')             => (isset($data['is_notification_templates']) && $data['is_notification_templates'] == 1 ? 1 : ''), 
            $this->lang->line('order_details')              => (isset($data['is_orders']) && $data['is_orders'] == 1 ? 1 : ''), 
            $this->lang->line('restaurant_reviews')        => (isset($data['is_reviews']) && $data['is_reviews'] == 1 ? 1 : ''), 
            $this->lang->line('restaurant_favorites')               => (isset($data['is_favorites']) && $data['is_favorites'] == 1 ? 1 : ''), 
            $this->lang->line('taxes')              => (isset($data['is_taxes']) && $data['is_taxes'] == 1 ? 1 : ''), 
            $this->lang->line('reports')            => (isset($data['is_reports']) && $data['is_reports'] == 1 ? 1 : ''), 
            $this->lang->line('permission') => (isset($data['role_permissions']) && $data['role_permissions'] == 1 ? 1 : ''), 
            $this->lang->line('settings') => (isset($data['is_settings']) && $data['is_settings'] == 1 ? 1 : ''), 
        );
        $permission['name'] = $tmp['group_name'];
        return $permission;
    }

}
