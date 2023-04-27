<?php

class Option_values extends MY_Controller {

    public $layout_view = "layout/".SUPERADMIN;

    public function __construct() {
        parent :: __construct();
        $this->data = array();
        $this->load->model("options_model","options");
        $this->load->model("option_values_model","option_values");
        $this->data['controller_name'] = $this->controller_name;
        $this->data['title']=$this->lang->line("heading_option_value");
    }

    public function index($encoded_id,$page_no=1) {
        $option_id = decrypt($encoded_id);
        $this->data["option_id"]=$encoded_id;
        $records = $this->option_values->get_records($option_id,$this->post_data,true,$page_no);
        
        $count = $records['count'];
        $base_url = superadmin_url("{$this->controller_name}/index");
        $default_count = (int)$this->post_data['per_page_count'] ? (int)$this->post_data['per_page_count'] : DEFAULT_RECORDS_PAGELIMIT;
       
        $config = pagination_array($count,$default_count,$base_url,$page_no,true);
        $this->pagination->initialize($config);
        $this->data["links"] = $this->pagination->create_links();
        $this->data["records"] = $records['records'];
        $this->data["count"] = $records['count'];
        $this->data["start_record"] = ($page_no-1)*$default_count;
        $this->layout->view(SUPERADMIN."/{$this->controller_name}/index",$this->data);
    }
    
    
    public function add($encoded_id){
        $option_id = decrypt($encoded_id);
        $this->data['option_id'] = $encoded_id;
        $this->data["main_form_url"] = superadmin_url("{$this->controller_name}/add/{$encoded_id}");
        $this->data['title']=$this->lang->line("heading_add_option_value");
        if( !empty($this->post_data) ) {
            $this->form_validation->set_rules("name",$this->lang->line("heading_name"),"trim|required");
            if( $this->form_validation->run() ) {
                $insert_data = $this->_get_posted_data($option_id);
                $option_id = $this->option_values->insert($insert_data);
                success($this->lang->line('message_insert_success'));
                redirect(superadmin_url("{$this->controller_name}/index/{$encoded_id}"));
            }
        }
      
        $this->layout->view(SUPERADMIN."/{$this->controller_name}/form",$this->data);
    }
    
    public function edit($encoded_id,$edited_id){
        $option_value_id = decrypt($encoded_id);
        $option_value_id=decrypt($edited_id);
        $this->data["main_form_url"] = superadmin_url("{$this->controller_name}/edit/{$encoded_id}/{$edited_id}");
        $this->data['title']=$this->lang->line("heading_edit_option_value");
        $record=$this->option_values->get_record($option_value_id)["record"];

        if( empty($record) ){
            error($this->lang->line('message_no_records'));
            redirect(superadmin_url("{$this->controller_name}/index/{$encoded_id}"));
        }else{
            if( !empty($this->post_data) ) {
                $this->form_validation->set_rules("name",$this->lang->line("heading_name"),"trim|required");
               
                if( $this->form_validation->run() ) {
                    $this->data['post_data'] = $this->post_data;
                    $update_data = $this->_get_posted_data('',$option_value_id);
                    $this->option_values->update($update_data,$option_value_id);
                    success($this->lang->line('message_update_success'));
                    redirect(superadmin_url("{$this->controller_name}/index/{$encoded_id}"));
                }
                
            }else{
                $this->data['post_data'] = $record;
            }
      
            $this->layout->view(SUPERADMIN."/{$this->controller_name}/form",$this->data);
        }
    }
    
    
    public  function delete($edited_id){
        $option_id = decrypt($edited_id);
        $this->option_organization->update( array("is_deleted"=>DELETED),array("option_id"=>$option_id) );
        $this->option_values->update( array("is_deleted"=>DELETED),array("option_id"=>$option_id) );
        $this->options->update( array("is_deleted"=>DELETED),$option_id );
        success($this->lang->line('message_delete_success'));
        redirect(superadmin_url("{$this->controller_name}"));
        
    }
    private function _get_posted_data($option_id="",$edited_id="") {
       
        $items = array("name","sort_order","status");
        $data = elements($items,$this->post_data);
        if( empty($edited_id) ) {
            $data['option_id'] = $option_id;
            $data['created_at'] = date(DEFAULT_SQL_DATE_FORMAT);
            $data['created_by'] = $this->user_data['id'];
            $data['ip_address'] = getVisitorIp();
        }else{
            $data['modified_at'] = date(DEFAULT_SQL_DATE_FORMAT);
            $data['modified_by'] = $this->user_data['id'];
        }
            
        return $data;
    }
}

