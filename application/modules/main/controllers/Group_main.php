<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Group_main extends MY_Controller { 
    public function __construct() {
        parent::__construct();        
        $this->load->model("groups_model","groups");
        $this->load->model("grouppermissions_model","group_permissions");        
        $this->data = array();
    }
    
    public function update_group_permission( $post_permissions,$group_id ) {
        $group_permissions = $this->group_permissions->get_records($group_id)['records']; 
       
        $this->data['group_permissions']=array();
        
        foreach( $group_permissions as $key => $group_permission ){            
            if( ( !empty($post_permissions[$group_permission['type']]) && is_array($post_permissions[$group_permission['type']]) && !in_array($group_permission['name'],$post_permissions[$group_permission['type']]) ) || empty($post_permissions[$group_permission['type']])  ){
                $get_permision_row = $this->group_permissions->getRow(array("group_id"=>$group_id,"type"=>$group_permission['type'],"name"=>$group_permission['name']));
                $this->group_permissions->delete($get_permision_row['id']);//delete old permission which are not posted 

            }else{
                //echo '<pre>';print_R($group_permission);die;
                if( empty($this->data['group_permissions'][$group_permission['type']]) ) {
                    $this->data['group_permissions'][$group_permission['type']] = array();
                }
                $this->data['group_permissions'][$group_permission['type']][] = $group_permission['name'];
            }   
        }
        $insert_data = array();
        foreach( $post_permissions as $module=>$module_permissions ) {
            foreach( $module_permissions as $key=>$module_permission ){
                if( !empty($this->data['group_permissions'][$module]) && is_array($this->data['group_permissions'][$module]) && in_array($module_permission,$this->data['group_permissions'][$module]) ){
                    //do nothing
                }else{
                    $insert_data[]=array(
                      "group_id" => $group_id,
                      "name" => $module_permission,
                      "type" => $module,
                      "status" => ACTIVE,
                      "created_at" => SQL_ADDED_DATE,
                      "created_by" => $this->user_data['id'],
                      "ip_address" => getVisitorIp(),
                    );
                }
            
            }
        }
        if( !empty($insert_data) ){
            $this->group_permissions->insertRows($insert_data);
        }
        return array("flag"=>FLAG_SUCCESS);
    }
}