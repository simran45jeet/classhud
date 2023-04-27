<?php
class Users_Model extends MY_Model {
    
    public function __construct() {
        parent::__construct();
        $this->table_name = "tbl_users";
        $this->table_title = "Users";
    }
    
    function get_records($post_data,$pagination=true,$page_no=1) {
        $this->load->model("groups_models","groups");
        $this->load->model("referral_code_model","referral_code");
        $response = array();
        $record_sql = $this->db->select("u.*,g.name as group_name,g.is_primery,rc.referral_code,rc.id as referral_code_id,rc.request_status as referral_code_request_status,rc.referral_code")
                            ->from($this->table_name." u")
                            ->join($this->groups->table_name." g","g.id = u.group_id")
                            ->join($this->referral_code->table_name." rc","rc.user_id = u.id","left")
                            ->where( array("u.is_deleted"=>NOT_DELETED,"g.is_deleted"=>NOT_DELETED,"u.group_id"=>CUSTOMER_GROUP_ID ) );
        if( isset($post_data['only_active']) && $post_data['only_active']===true ){
            $record_sql->where("u.status",ACTIVE);
        }
        if( isset($post_data["account_verified_type"]) && is_numeric($post_data["account_verified_type"]) ) {
            $record_sql->where("u.account_verified_type",$post_data["account_verified_type"]);
        }
        if( !empty($post_data["search"]) ) {
            $record_sql->group_start();
            $record_sql->like("u.full_name",$post_data["search"]);
            if( is_numeric($post_data["search"]) ) {
                $record_sql->or_where("u.phone_no",$post_data["search"]);
            }
            $record_sql->or_like("u.email",$post_data["search"]);
            $record_sql->group_end();
        }
        if( $pagination===true ) {
            $record_count_sql = clone $record_sql;
            $response['count'] = $record_count_sql->get()->num_rows();
            $default_count = (int)$post_data['per_page_count'] ? (int)$post_data['per_page_count'] : DEFAULT_RECORDS_PAGELIMIT;
            
            $data_page = api_paging($default_count,$page_no);
            $record_sql->limit($data_page['limit'],$data_page['start']);
            $response['per_page_count'] = $default_count;
        }
        
        $response['records'] = $record_sql->order_by("u.id","desc")->get()->result_array();
        return $response;
    }
    
    public function get_record($user_id,$phone_no=0,$email=''){
        $this->load->model("groups_model","groups");
        $this->load->model("phone_code_model","phonecode");
        $this->load->model("referral_code_model","referral_code");
        $response = array();
        
        $record_sql = $this->db->select("u.*,g.is_staff,pc.phonecode,rc.request_status as referral_code_request_status,rc.referral_code")
                            ->from($this->table_name." u")
                            ->join($this->groups->table_name." g","g.id=u.group_id and g.status=".ACTIVE." and g.is_deleted=".NOT_DELETED)
                            ->join($this->phonecode->table_name." pc","pc.id=u.phone_code and pc.status=".ACTIVE." and pc.is_deleted=".NOT_DELETED,"left")
                ->join($this->referral_code->table_name." rc","rc.user_id = u.id","left")
                            ->where(array(
                                "u.status"=>ACTIVE,
                                "u.is_deleted"=>NOT_DELETED
                            ));
        if( !empty($phone_no) ){
            $record_sql->where("u.phone_no",$phone_no);
        }else{
            $record_sql->where("u.id",$user_id);
        }
        $record = $record_sql->get()->row_array();
        return array("record"=>$record);
    }
    
    public function checkActivationCode($userID,$activation_code){
        $row = $this->getRow(array('id'=>$userID,'activation_code'=>$activation_code));
        return $row;
    }
    
    function verify_account($update_data,$user_id){
        return $this->update($update_data,$user_id);
        
    }
    public function get_login_detail($username,$group_id){
        
        $this->load->model("phone_code_model","phonecode");
        $record_sql = $this->db->select("u.*,pc.phonecode")
                ->from($this->table_name." u")
                ->join($this->phonecode->table_name." pc","pc.id=u.phone_code and pc.status=".ACTIVE." and pc.is_deleted=".NOT_DELETED,"left")
                ->where("u.group_id",$group_id)
                ->where("u.status",ACTIVE)
                ->where("u.account_verified_type>",0)
                ->where("u.is_deleted",NOT_DELETED)
                ->group_start()
                ->where("u.username",$username)
                ->or_where("u.email",$username);
        if( is_numeric($username) && $username>0 ) {
            $record_sql->or_where("u.phone_no",$username);
        }
        $record_sql->group_end();
        $record = $record_sql->get()->row_array();
        return array( "record"=>$record );
    }
    public function getAdminUserForLogin($email) {
        $query = $this->db->select("
            `users`.`id`,
            `users`.`lang_id`,
            `users`.`image`,
            CONCAT(
                users.first_name,
                ' ',
                COALESCE(users.last_name, '')
            ) AS name,
            `users`.`status`,
            `users`.`login_requests`,
            `users`.`username`,
            `users`.`group_id`,
            `password`,
            `groups`.`is_staff`
        ")
        ->from($this->table_name)
        ->join('groups', 'groups.id = users.group_id')
        ->where('users.email = "'. $email. '" AND users.is_deleted = '.NOT_DELETED.' AND groups.is_staff = 1 ')
        ->group_by('users.id');
        $return = $query->get();
        return array('record'=>$return->row_array() );
    }
    
    public function getRecord($user_id=0,$email='',$phone_no=0){
        
        $recordSql = $this->db->select($this->table_name.'.*, groups.name as group_name, groups.is_staff')
                ->from($this->table_name)
                ->join('groups', 'groups.id = '.$this->table_name.'.group_id')
                ->where( array('is_deleted'=>NOT_DELETED) );
        if( !empty($email) ){
            $recordSql->where('email',$email);
        }elseif( !empty($phoneNo) ){
            $recordSql->where('phone_no',$phone_no);
        }else{   
            $recordSql->where('id',$user_id);
        }
        $record = $recordSql->get()->row_array();
        return array('record'=>$record);
    }
    
    public function checkRecord($email='',$phoneNo=0,$userId=0){
        $recordSql = $this->db->select($this->table_name.'.*, groups.name as group_name, groups.is_staff')
                ->from($this->table_name)
                ->join('groups', 'groups.id = '.$this->table_name.'.group_id');
        if( !empty($userId) ) {
            $recordSql->where('users.id!=',$userId);
        }
        if( !empty($email) && !empty($phoneNo) ) {
            $recordSql->group_start();
            $recordSql->where('email',$email);
            $recordSql->or_where('phone_no',$phoneNo);
            $recordSql->group_end();
        }elseif( !empty($email) ){
            $recordSql->where('email',$email);
        }else{
            $recordSql->where('phone_no',$phoneNo);
        }
        $record = $recordSql->get()->row_array();
        return !empty($record);
    }
    
    public function insert_record($insert_data){
        return $this->insert($insert_data);
    }
    
    public function verify_phone($update_data,$user_id){
        return $this->update($update_data,$user_id );
    }
    
    public function user_business_listing($user_id,$post_data=array(),$pagination = false,$page_no=1 ) {
        $today = date("Y-m-d",strtotime(UTC_DATE_TIME));
        $day_no = date("N",strtotime($today));
        $now_time = UTC_TIME;
        
        $this->load->model("listing_timming_model","listing_timming");
        $this->load->model("timezone_model","timezone");
        $this->load->model("listing_types_model","listing_types");
        $this->load->model("phone_code_model","phone_code");
        $this->load->model("city_model","city");
        $this->load->model("listing_model","listing");
        $this->load->model("referral_listing_model","referral_listing");
        //Get Restaurant List
        $record_sql = $this->db->distinct()->select("l.*,t.name as listing_type_name,t.image as listing_type_image,pc.phonecode as primary_phone_code_name,c.name as city_name",false)
                ->from($this->listing->table_name." l")
                ->join($this->listing_types->table_name." t","t.id = l.listing_type","left")
                ->join($this->phone_code->table_name." pc","pc.id = l.primary_phone_code","left")
                ->join($this->city->table_name." c","c.id = l.city","left")
                ->join($this->referral_listing->table_name." rl","rl.listing_id=l.id and l.status=".ACTIVE." and l.is_deleted=".NOT_DELETED)
                ->where( array("l.is_deleted"=>NOT_DELETED,/*"l.request_status"=>LISTING_REQUEST_STATUS_APPROVED,*/"rl.referrar_user_id"=>$user_id) );
        
        
        $record_sql->where("l.status",ACTIVE);
        
        if( isset($post_data["listing_type"]) && is_numeric($post_data["listing_type"]) && $post_data["listing_type"]>0 ){
            $record_sql->where("l.listing_type",$post_data["listing_type"]);
        }else if( isset($post_data["listing_type_slug"]) && !empty($post_data["listing_type_slug"]) ){
            $record_sql->where("t.slug",$post_data["listing_type_slug"]);
        }
        
        
        
        if( !empty($post_data["search"]) ) {
            $this->load->model("listing_tags_model","listing_tags");
            $this->load->model("tags_model","tags");
            $record_sql->join($this->listing_tags->table_name." l_t","l_t.table_id = l.id and l_t.type = ".TAGS_TYPES_LISTING." and l_t.is_deleted=".NOT_DELETED." and l_t.status=".ACTIVE,"left");
            $record_sql->join($this->tags->table_name." tag","tag.id = l_t.tag_id and tag.is_deleted = ".NOT_DELETED." and tag.status=".ACTIVE,"left");
            $record_sql->group_start();
            $record_sql->like("l.primary_email",$post_data["search"]);
            $record_sql->like("tag.name",$post_data["search"]);
            if( is_numeric($post_data["search"]) ) {
                $record_sql->or_where("l.primary_phone_no",$post_data["search"]);
            }
            $record_sql->or_like("l.name",$post_data["search"]);
            $record_sql->group_end();
        }
          
        if( $pagination===true ) {
            $record_count_sql = clone $record_sql;
            $response['count'] = $record_count_sql->get()->num_rows();
            $default_count = (int)$post_data['per_page_count'] ? (int)$post_data['per_page_count'] : DEFAULT_RECORDS_PAGELIMIT;
            
            $data_page = api_paging($default_count,$page_no);
            $record_sql->limit($data_page['limit'],$data_page['start']);
            $response['per_page_count'] = $default_count;
        }
       
        
//        
//        $record_sql->order_by("l.id","desc");
        
        $response['records'] = $record_sql->order_by("l.id","desc")->get()->result_array();
        
        return $response;
    }
    
}