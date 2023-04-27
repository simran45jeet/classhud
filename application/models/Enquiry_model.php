<?php
class Enquiry_model extends MY_Model {
    
    public function __construct(){
        parent::__construct();
        $this->table_name = "tbl_enquiry";
        $this->table_title = "Enquiry";
    }
    
    public function contact_us_enquiry($post_data=array(),$pagination = true,$page_no=1 ) {
        //Get Restaurant List
        $record_sql = $this->db->select('*')
                ->from($this->table_name)
                ->where( array("is_deleted"=>NOT_DELETED,"enquiry_type"=>ENQUIRY_TYPE_CONTACT_US) );
        if( $post_data["enquiry_status"]>-1 ) {
            $record_sql->where("enquiry_status",$post_data["enquiry_status"]);
        }
        if( !empty($post_data["search"]) ){
            $record_sql->group_start();
            $record_sql->like("name",$post_data["search"]);
            $record_sql->or_like("email",$post_data["search"]);
            $record_sql->or_like("subject",$post_data["search"]);
            $record_sql->or_like("description",$post_data["search"]);
            if( is_numeric($post_data["search"]) ){
                $record_sql->where("phone_no",$post_data["search"]);
            }
            $record_sql->group_end();
        }
        
        if( isset($post_data["all_records"]) && $post_data["all_records"]==true ){
        }else{ $record_sql->where("status",ACTIVE); }
        if( $pagination===true ) {
            $record_count_sql = clone $record_sql;
            $response['count'] = $record_count_sql->get()->num_rows();
            $default_count = (int)$post_data['per_page_count'] ? (int)$post_data['per_page_count'] : DEFAULT_RECORDS_PAGELIMIT;
            
            $data_page = api_paging($default_count,$page_no);
            $record_sql->limit($data_page['limit'],$data_page['start']);
            $response['per_page_count'] = $default_count;
        }
        
        $response['records'] = $record_sql->order_by("id","desc")->get()->result_array();
        return $response;
    }
    
    public function get_contact_us_enquiry($id) {
        //Get Restaurant List
        $record_sql = $this->db->select('*')
                ->from($this->table_name)
                ->where(array("is_deleted"=>NOT_DELETED,"id"=>$id));
        $response['record'] = $record_sql->get()->row_array();
        return $response;
    }
}