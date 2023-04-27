<?php
class Authtokens_Model extends MY_Model {
    
    function __construct()
    {
        parent::__construct();
        $this->table_name = 'tbl_auth_tokens';
    }

    public function getAllTokens($user_id,$token=null)
    {
        if(!is_array($user_id))
        {
            if(!empty($token)){
                $where = ['auth_tokens.auth_token <>' => $token, 'auth_tokens.user_id' => $user_id];
            } else {
                $where = ['auth_tokens.user_id' => $user_id];
            }
        }else{
            $ids = "";
            foreach ($user_id as $value) {
                $ids .= $value.",";
            }
            $id = rtrim($ids,",");
            if(!empty($token)){
                $where = 'auth_tokens.auth_token <>"'.$token.'" and auth_tokens.user_id in ('.$id.')';
            } else {
                $where = 'auth_tokens.user_id in ('.$id.')';
            }
        }
    	$this->db->select('auth_tokens.auth_token,auth_tokens.app_type,users.group_id')
    		->from($this->table_name)
            ->join('users','users.id=auth_tokens.user_id','left')
    		->where($where);
    	$result = $this->db->get();
    	return $result->result_array();
    }
    public function deleteOldAuthTokens($user_id){
        $this->db->where('user_id', $user_id);  
        $this->db->where('id Not IN (select id from (SELECT id FROM '.$this->table_name .' where user_id = '.$user_id.' order by id desc limit '.MAX_SESSION_LIMIT.') recentIds)');
        $this->db->delete($this->table_name);
    }

    public function get_users_sessions($user_id='',$is_staff='',$current_user_id='', $limit='',$start='',$pagination=false,$data=[]){
        $q = $this->db->from($this->table_name);
        $q->join('users', 'users.id= auth_tokens.user_id');
        if(!empty($data['search']))
        {
            $q->where('(users.first_name like "%'.trim($data['search']).'%" OR users.last_name like "%'.trim($data['search']).'%" OR users.email like "%'.trim($data['search']).'%" OR CONCAT(users.first_name," ",users.last_name) like "%'.trim($data['search']).'%")',null,false);    
        }
        if(empty($is_staff))
        {
            $this->db->where('auth_tokens.user_id', $current_user_id);
        }
        $this->db->where('auth_tokens.auth_token !=',$_SESSION["userData"]);
        if($pagination==true){
            $tempdb = clone $this->db;
            $tempdb->select("count(auth_tokens.id) as total");      
            $num_results = $tempdb->get()->row_array();
        }
        $q = $this->db->select("auth_tokens.*, CONCAT(COALESCE(users.first_name,''), ' ', COALESCE(users.last_name,'')) AS user_name");
        $q->order_by("auth_tokens.id desc");
        $q->limit($limit,$start);
        $result = $q->get()->result_array();
        //echo $q->last_query();
        if($pagination==true){
            return array('count'=>$num_results['total'],'results'=>$result);
        }else{
            return $result;
        }
    }

    public function delete_user_session($id) { 
        return $this->delete($id); 
    }

    public function getUserLastLogin($userId) { 
        $this->db->select('id,user_id,created_on')
        ->from($this->table_name)
        ->where('user_id = '.$userId);
        $this->db->order_by('id DESC');
        $this->db->limit(1);
        $get = $this->db->get();
        return $get->row_array(); 
    }
}