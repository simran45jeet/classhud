<?php
class Referral_code_model extends MY_Model {
    
    public function __construct(){
        parent::__construct();
        $this->table_name = "tbl_referral_code";
        $this->table_title = "Referral Code";
    }
    
    public function get_referral_code_user($referral_code){
        $this->load->model("users_model","users");
        $record_sql = $this->db->select("u.id")
                                ->from( $this->table_name." rc")
                                ->join( $this->users->table_name." u","u.id = rc.user_id")
                                ->where( array("rc.request_status"=>ACTIVE,"rc.is_deleted"=>NOT_DELETED,"u.is_deleted"=>NOT_DELETED,"u.status"=>ACTIVE,"rc.referral_code"=>$referral_code) );
        return array( "record"=>$record_sql->get()->row_array() );
    }
}