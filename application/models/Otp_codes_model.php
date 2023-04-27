<?php
class Otp_codes_model extends MY_Model {
    
    public function __construct() {
        parent::__construct();
        $this->table_name = 'tbl_otp_codes';
        $this->table_title = 'Otp';
    }
    
    public function get_record($user_id,$otp_send_type,$otp_type){
        $record = $this->db->select("*")
                    ->from($this->table_name)
                    ->where( array("user_id"=>$user_id,"otp_send_type"=>$otp_send_type,"otp_type"=>$otp_type,"status"=>ACTIVE,"use_status"=>OTP_USE_STATUS_UNUSED))
                    ->group_start()
                        ->where("end_date>=",SQL_ADDED_DATE)
                        ->or_where("end_date","0000-00-00 00:00:00")
                        ->or_where("end_date",null)
                    ->group_end()
                    ->get()->row_array();
        
        return array("record"=>$record);
        
    }
    
    function use_otp($otp_id){
        return $this->update( array("use_status"=>OTP_USE_STATUS_USED,"modified_at"=>SQL_ADDED_DATE),$otp_id);
    }
    
    public function insert_record($user_id,$otp,$otp_send_type,$otp_type){
        return $this->insert( array(
                'user_id'=>$user_id,
                'otp_send_type'=>$otp_send_type,
                'code'=>$otp,
                'otp_type'=>$otp_type,
                'end_date'=>date(DEFAULT_SQL_DATE_FORMAT,strtotime("+1 day")),
                'created_at'=>SQL_ADDED_DATE,
                'created_by'=>$user_id,
                'ip_address' => getVisitorIp(),
            ) );
    }
    
    public  function update_time($record_id){
        return $this->update(array("modified_at"=>SQL_ADDED_DATE),$record_id);
        
    }
    
    public function use_phone_verify_otp($user_id,$by_user_id){
        return $this->update(array("use_status"=>OTP_USE_STATUS_USED,"modified_by"=>$by_user_id,"modified_at"=>SQL_ADDED_DATE),array("user_id"=>$user_id,"use_status"=>OTP_USE_STATUS_UNUSED,"status"=>ACTIVE,"is_deleted"=>NOT_DELETED,"otp_type"=>OTP_TYPE_REGISTER_OTP,"otp_send_type"=>OTP_SEND_TYPE_OTP));
    }
}