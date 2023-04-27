<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

function hasPermission($roleId, $action, $type) {
    $type = ($type == SUPERADMIN) ? SUPERADMIN : $type;

    $ci = &get_instance();
    $module = strtolower(StaticFunctions::getSegment(1));
//    $module = $ci->url_translate->isModuleSuperadmin() ? 'superadmin' : $module;
    $module = $module;
    $return = false;
    if (!empty($roleId)) {
        $flag = 1;
        if ($module == SUPERADMIN) {
            if (!empty($ci->session->user_permissions) && is_array($ci->session->user_permissions)) {
                $flag = 0;
                if (in_array($action, $ci->session->user_permissions)) {
                    $return = true;
                }
            }
        }
        
        if ($flag) {
            
            $permission = $ci->grouppermissions->getRow(['group_id' => $roleId, 'name' => $action, 'type' => $type], ['id']);

            if (!empty($permission['id'])) {
                $return = true;
            }
        }
    }
    return $return;
    // return true;//for testing only
}

function isGuest($data) {
    $return = false;
    if (!empty($data) && $data['group_id'] == GUEST_GROUP_ID) {
        $return = true;
    }
    return $return;
}

function tokenAuthenticate($token, $guestUser) {
    $ci = &get_instance();
    $ci->load->model('authtokens_model');
    try {
        $userData = (array) JWT::decode($token, $ci->config->item('encryption_key'), array('HS256'));


        if (!empty($userData)) {
            $userData['id'] = $userData['id'];

            if (!empty($userData['expire_date'])) {

                if ($userData['expire_date'] > time()) {
                    //Validate if token does exist in the database
                    $authData = $ci->authtokens_model->getRow(['auth_token' => $token], ['web_device_token', 'android_device_token', 'ios_device_token']);

                    if (!empty($authData)) {
                        return array_merge($userData, $authData);
                    }
                } else {
                    //Delete token from database if token is expired
                    $ci->authtokens_model->delete(['auth_token' => $token]);
                }
            }
            return $guestUser;
        }
    } catch (Exception $e) {
        return $guestUser;
    }
}

function checkAccess($userData, $action, $escape_actions, $nonuser_actions, $module, $loginPage, $homePage) {
    $ci = &get_instance();

    if ( !in_array($action, $escape_actions[$module]) && !is_api_module() ) {

        if (empty($userData['id'])) {
            //Authentication Failed
            if ( is_api_module() ) {
                http_response_code(401);

                $response = ['flag' => 0, 'message' => 'Session Expired! Please Login.', 'data' => null];
                echo json_encode($response);
                die();
            } else {
                if ($ci->uri->segment(3) != 'logout' || $ci->uri->segment(2) != 'logout') {
                    //Authentication Failed
                    $ci->session->referrer = base_url() . implode('/', $ci->uri->segment_array());
                }
                redirect($loginPage[$module]);
            }
        }
    }

    if ( in_array($action, $nonuser_actions[$module]) ) {
        if (!empty($userData['id'])) {
            //Checking if a logged in user is trying to access page which he/she is not allowed to access
            if (isModuleApi($module)) {
                http_response_code(505);
                $response = ['flag' => FLAG_ERROR, 'message' => 'Permission Denied!', 'data' => null];
                echo json_encode($response);
                die();
            } else {
                redirect($homePage[$module]);
            }
        }
    }

    if ( !empty($userData['group_id']) && (!hasPermission($userData['group_id'], $action, $module)) ) {
        
        $ci = &get_instance();
        $module_name = $module;
        
        $permissions = get_all_permissions();
        $not_found = 1;

        foreach ($permissions[$module_name] as $id => $module_detail) {
            if( !empty($module_detail['operations']) ){
                foreach($module_detail['operations'] as $key=>$operation_detail ) {
                    if ( $action == $operation_detail['slug'] ) {
                        $not_found = 0;
                        break;
                    }
                }
            }
            if( $not_found==0 ) {
                break;
            }
        }
        
        if ($not_found === 0) {
            if ($module === 'api' || $module === 'pos_api' || $module === 'waiter_api') {
                die(json_encode(['flag' => 0, 'message' => $ci->lang->line('message_access_denied')]));
            } else if ($module === SUPERADMIN) {
                if (in_array($action, $escape_actions[$module])) {
                    $ci->session->userPermissions = [];
                    redirect(superadmin_url('users/logout'));
                } else {
                    $ci->load->module(SUPERADMIN . '/error_page');
                    $ci->error_page->access_forbidden();
                }
            } else {
                redirect($homePage[$module]);
                // $ci->load->view("{$module}/error/error_501");
                // die;
            }
        }
    }
}

function isModuleApi($module) {
    if ($module == 'api' || $module == 'waiter_api' || $module == 'pos_api' || $module == 'delivery_boy_api') {
        return true;
    } else {
        return false;
    }
}


function get_all_permissions($flag=false){
    $ci =& get_instance();
    if( empty($ci->session->userdata('all_permission')) || $flag==true ) {
        $ci->load->model("Modules_model","modules");
        $ci->load->model("Operations_model","operations");

        $all_modules = $ci->modules->getAllWhere(array("status"=>ACTIVE,"is_deleted"=>NOT_DELETED),'','','','sort_order','asc');
        $all_permissions = array();
        if( !empty($all_modules) ) {
            foreach( $all_modules as $key => $module_detail ) {
                if( !isset($all_permissions[$module_detail['module_name']]) ) {
                    $all_permissions[$module_detail['module_name']] = array();
                }

                if( !isset($all_permissions[$module_detail['module_name']][$module_detail['id']]) ) {
                    $all_permissions[$module_detail['module_name']][$module_detail['id']]=array(
                        'name'=>$module_detail['name'],
                        'display_name'=>$module_detail['display_name'],
                        'icon_class'=>$module_detail['icon_class'],
                        'show_in_menu'=>$module_detail['show_in_menu'],
                        'operations'=>array(),
                    );
                }

                $module_all_operations = $ci->operations->getAllWhere(array("status"=>ACTIVE,"is_deleted"=>NOT_DELETED,"module_id"=>$module_detail['id']),'','','','sort_order','asc');
                if( count($module_all_operations)>0 ){
                    foreach( $module_all_operations as $operation_key => $operation_detail ) {
                        $all_permissions[$module_detail['module_name']][$module_detail['id']]['operations'][] = array(
                            'name' => $operation_detail['name'],
                            'display_name' => $operation_detail['display_name'],
                            'show_in_menu' => $operation_detail['show_in_menu'],
                            'icon_class' => $operation_detail['icon_class'],
                            'slug' => "{$operation_detail['slug']}",
                        );
                    }
                }

            }
        }
        
        $ci->session->set_userdata('all_permission',$all_permissions);
    
    }else{
        $all_permissions = $ci->session->userdata('all_permission');
    }
    return $all_permissions;
}

function get_permission_list($flag=false){
    $permission = array();
    $permission_list = get_all_permissions($flag);
    foreach( $permission_list as $module=>$module_detail ) {
        $permission[$module]=array();
        foreach( $module_detail as $permission_group ){
            foreach($permission_group["operations"] as $key => $operation_detail ) {
                
                $permission[$module][$permission_group["display_name"]][$operation_detail["display_name"]] = $operation_detail["slug"];
            }
        }
    }

    return $permission;
}