<?php

class Options extends MY_Controller {

    public $layout_view = "layout/".SUPERADMIN;

    public function __construct() {
        parent :: __construct();
        $this->data = array();
        $this->load->model("options_model","options");
        $this->load->model("option_values_model","option_values");
        $this->load->model("organization_types_model","organization_types");
        $this->load->model("option_organizations_model","option_organization");
       
        $this->data['organization_types']=$this->organization_types->get_records( array("only_active"=>true),false )['records'];
        $this->data['display_types']=$this->lang->line('heading_option_types');
        $this->data['controller_name'] = $this->controller_name;
        $this->data['title'] = $this->lang->line("heading_option");
    }

    public function index($page_no=1) {
        $records = $this->options->get_records($this->post_data,true,$page_no);
        $count = $records['count'];
        $base_url = superadmin_url("options/index");
        $default_count = (int)$this->post_data['per_page_count'] ? (int)$this->post_data['per_page_count'] : DEFAULT_RECORDS_PAGELIMIT;
        $config = pagination_array($count,$default_count,$base_url,$page_no,true);
        $this->pagination->initialize($config);
        $this->data["links"] = $this->pagination->create_links();
        $this->data["records"] = $records['records'];
        $this->data["count"] = $records['count'];
        $this->data["start_record"] = ($page_no-1)*$default_count;

        $this->layout->view(SUPERADMIN."/{$this->controller_name}/index",$this->data);
    }
    
    
    public function add(){
        $this->data["main_form_url"] = superadmin_url("options/add");
        $this->data['title']=$this->lang->line("heading_add_option");
        if( !empty($this->post_data) ) {
            $this->form_validation->set_rules("name",$this->lang->line("heading_name"),"trim|required");
            $this->form_validation->set_rules("display_type",$this->lang->line("heading_display_type"),"trim|required");            
            $this->form_validation->set_rules("option_for",$this->lang->line("heading_option_for_type"),"trim|required");
            $this->form_validation->set_rules("organization_type_id[]",$this->lang->line("heading_orgnization_type"),"required");
            if( $this->form_validation->run() ) {
                $insert_data = $this->_get_posted_option_data();
                $option_id = $this->options->insert($insert_data);
                if( !empty($this->post_data['organization_type_id']) ) {
                    $insert_data = array();
                    foreach( $this->post_data['organization_type_id'] as $key=>$organization_type_id ){
                        $organization_type_id=decrypt($organization_type_id);
                        $insert_data[]=array(
                            'organization_type_id'=>$organization_type_id,
                            'option_id'=>$option_id,
                            'status'=>ACTIVE,
                            'created_at'=>date(DEFAULT_SQL_DATE_FORMAT),
                            'created_by'=>$this->user_data['id'],
                            'ip_address'=>getVisitorIp(),
                        );
                    }
                    $this->option_organization->insertRows($insert_data);
                    
                }
                success($this->lang->line('message_insert_success'));
                redirect(superadmin_url("{$this->controller_name}"));
                
            }
            
        }
      
        $this->layout->view(SUPERADMIN."/{$this->controller_name}/form",$this->data);
    }
    
    public function edit($edited_id){
        $this->data["main_form_url"] = superadmin_url("{$this->controller_name}/edit/{$edited_id}");
        $edited_id=decrypt($edited_id);
        
        $record=$this->options->get_record($edited_id)["record"];
        
        if( empty($record) ){
            error($this->lang->line('message_no_records'));
            redirect(superadmin_url("{$this->controller_name}"));
        }else{
            $option_id = $edited_id;
            $option_orgnizations = $this->option_organization->get_records($edited_id)["records"];
            $orgnization_type_ids = $option_values_ids = array();
            
            foreach( $option_orgnizations as $key=>$option_orgnization ) {
                $record["organization_type_id"][] = $option_orgnization["organization_type_id"];
            }
            
            if( !empty($this->post_data) ) {
                $this->form_validation->set_rules("name",$this->lang->line("heading_name"),"trim|required");
                $this->form_validation->set_rules("display_type",$this->lang->line("heading_display_type"),"trim|required");
                $this->form_validation->set_rules("option_for",$this->lang->line("heading_option_for_type"),"trim|required");
                $this->form_validation->set_rules("organization_type_id[]",$this->lang->line("heading_orgnization_type"),"required");
                if( $this->form_validation->run() ) {
                    $this->data['post_data'] = $this->post_data;
                    $insert_data = $this->_get_posted_option_data($edited_id);
                    $this->options->update($insert_data,$edited_id);

                    if( !empty($this->post_data['organization_type_id']) ) {
                        $insert_data = array();
                        $new_ids = array();
                        foreach( $this->post_data['organization_type_id'] as $key=>$organization_type_id ){
                            $this->post_data['organization_type_id'][$key] = $organization_type_id=decrypt($organization_type_id);
                            $new_ids[]=$organization_type_id;
                            
                            if( !in_array($organization_type_id,$record["organization_type_id"]) ) {
                                $insert_data[]=array(
                                    'organization_type_id'=>$organization_type_id,
                                    'option_id'=>$option_id,
                                    'status'=>ACTIVE,
                                    'created_at'=>date(DEFAULT_SQL_DATE_FORMAT),
                                    'created_by'=>$this->user_data['id'],
                                    'ip_address'=>getVisitorIp(),
                                );
                            }
                        }
                        foreach($record["organization_type_id"] as $key=>$organization_type_id){
                            if( !in_array($organization_type_id,$new_ids) ){
                                $this->option_organization->delete($organization_type_id);
                            }    
                        }
                        if( !empty($insert_data) ){
                            $this->option_organization->insertRows($insert_data);
                        }

                    }else{
                        $this->option_organization->delete(array("option_id"=>$option_id));
                    }
                    success($this->lang->line('message_update_success'));
                    redirect(superadmin_url("{$this->controller_name}"));
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
    private function _get_posted_option_data($edited_id="") {
       
        $items = array("name","display_type","sort_order","status");
        $data = elements($items,$this->post_data);
        if( empty($edited_id) ) {
            $data['created_at'] = date(DEFAULT_SQL_DATE_FORMAT);
            $data['created_by'] = $this->user_data['id'];
            $data['ip_address'] = getVisitorIp();
        }else{
            $data['modified_at'] = date(DEFAULT_SQL_DATE_FORMAT);
            $data['modified_by'] = $this->user_data['id'];
        }
            
        return $data;
    }
    
    private function _get_posted_option_value_data($option_id){
        $data = array();
        foreach( $this->post_data['option_value'] as $key=> $option_value){
            if( empty($this->post_data['option_value_id'][$key]) ) {
                $data[]=array(
                    'option_id'=>$option_id,
                    'name'=>$option_value,
                    'status'=>ACTIVE,
                    'created_at'=>date(DEFAULT_SQL_DATE_FORMAT),
                    'created_by'=>$this->user_data['id'],
                    'ip_address'=>getVisitorIp(),
                );
            }
        }
        return $data;
    }
}

