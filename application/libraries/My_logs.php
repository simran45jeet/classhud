<?php

class My_logs {
    /*
      Creator: Varun Dhamija
      Purpose: To keep track record of user actions
     */

    private $CI;
    private $log_data = [
        'text' => '',
        'table_name' => '',
        'table_id' => 0,
        'module' => '',
        'action' => '',
        'prev_data' => '',
        'new_data' => '',
        'post_data' => '',
        'get_data' => '',
        'created_by' => 0,
    ];
    public $insert = False;
    public $update = False;
    public $delete = False;
    private $params = [];

    public function __construct() {
        $this->CI = & get_instance();
    }

    public function logIt($params, $type) {
        $ci =& get_instance();

        if($ci->controller->module_name=='cli'){ return ; }
        if( !empty($params['user_id']) ) {
        }else{
            $params['user_id'] = $ci->controller->user_data['id'];
        }

        if( $params['table_name']=='tbl_auth_tokens' ) {
            return false;
        }
        $this->setLogData($params, $type);
        $this->CI->db->insert('tbl_logs', $this->log_data);
    }

    public function setLogData($params, $type) {        
        $this->log_data['created_by'] = $params['user_id'];
        $this->log_data['table_name'] = $params['table_name'];
        $this->log_data['table_id'] = (!empty($params['table_id'])) ? $params['table_id'] : 0;
        $this->log_data['post_data'] = serialize($this->CI->input->post());
        $this->log_data['get_data'] = serialize($this->CI->input->get());
        $this->log_data['new_data'] = serialize($params['new_data']);
        $this->log_data['prev_data'] = serialize($params['prev_data']);
        $this->log_data['module'] = $this->CI->controller->module_name;
        $this->log_data['action'] = $this->CI->router->fetch_class() . '.' . $this->CI->router->fetch_method();
        $this->log_data['ip_address'] = getVisitorIp();
        $this->log_data['created_at'] = date('Y-m-d H:i:s');
        $this->insert = $this->update = $this->delete = False;
        if ($type == ACTION_INSERT) {
            $this->log_data['db_action'] = $type;
            $this->insert = True;
        } else if ($type == ACTION_UPDATE) {
            $this->log_data['db_action'] = $type;
            $this->update = True;
        } else if ($type == ACTION_DELETE) {
            $this->log_data['db_action'] = $type;
            $this->delete = True;
        }
        $this->log_data['text'] = $this->setMessage($params);
    }

    private function setMessage($params) {
        $tablesArray = array(
            'restaurants' => 'restaurant',
            'food_categories' => 'food_category',
            'restaurant_delivery_areas' => 'restaurant_delivery_area',
            'food_items' => 'food_item',
        );

        $this->CI->load->model('users_model');
        $name = $this->CI->users_model->getRow($this->log_data['created_by'], ['full_name']);
        
        $name = !empty($name['full_name'])  ? $name['full_name'] : 'Guest User';
        

        if (!empty($tablesArray[$this->log_data['table_name']])) {
            $table_name = $tablesArray[$this->log_data['table_name']];
        } else {
            $table_name = $this->log_data['table_name'];
        }
        $table_name = str_replace('tbl_', '',$table_name);
        if( !empty($params['table_title']) ){
            $table_name = $params['table_title'];
        }
        if ($this->insert === True && $this->log_data['action']=='users.login' && $table_name=='users') {
            return $name . ' logged in ';
        }else if ($this->insert === True) {
            return $name . ' created  ' . str_replace('_', ' ', $table_name);
        } elseif ($this->update === True) {
            $actionStr = 'updated';
            $statusStr = '';
            if (isset($params['new_data']['is_deleted']) && $params['new_data']['is_deleted'] == DELETED) {
                $actionStr = 'deleted';
            }
            
            return ucfirst($name) . ' ' . $actionStr . ' ' . str_replace('_', ' ', $table_name) . ' ' . $statusStr;
        } else if ($this->delete === True) {
            return $name . ' deleted  a ' . str_replace('_', ' ', $table_name);
        }
    }

}
