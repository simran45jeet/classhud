<?php
class Qrcodes_model extends MY_Model {
    
    public function __construct(){
        parent::__construct();
        $this->table_name = "tbl_qrcodes";
        $this->table_title = "Qrcode";
    }
    
    public function get_records($post_data=array(),$pagination = true,$page_no=1 ) {
        //Get Restaurant List
        $qrcode_types = $this->lang->line("heading_qrcodes_type_names");
        $this->load->model("listing_model","listing");
        $record_sql = $this->db->select("q.*,(case when q.type=".QRCODE_TYPE_LISTING." and l.id is not null then l.name end ) as name,(case when q.type=".QRCODE_TYPE_LISTING." then '{$qrcode_types[QRCODE_TYPE_LISTING]}' end ) as type_name,(case when q.type=".QRCODE_TYPE_LISTING." and l.id is not null then l.id end ) as record_id",false)
                ->from($this->table_name." q")
                ->join($this->listing->table_name." l","l.qrcode = q.id","left")
                ->where( array("q.is_deleted"=>NOT_DELETED) );
        
        if( isset($post_data["only_active"]) && $post_data["only_active"]==true ){
            $record_sql->where("q.status",ACTIVE);
        }
        if( isset($post_data["unused_code"]) && !empty($post_data["unused_code"]) ){
            $record_sql->having("record_id",null);
        }

        if( $pagination===true ) {
            $record_count_sql = clone $record_sql;
            $response['count'] = $record_count_sql->get()->num_rows();
            $default_count = (int)$post_data['per_page_count'] ? (int)$post_data['per_page_count'] : DEFAULT_RECORDS_PAGELIMIT;
            
            $data_page = api_paging($default_count,$page_no);
            $record_sql->limit($data_page['limit'],$data_page['start']);
            $response['per_page_count'] = $default_count;
        }
        
        $response['records'] = $record_sql->order_by("q.id","desc")->get()->result_array();
        return $response;
    }
    
    public function get_record($qr_code) {
        //Get Restaurant List
        $this->load->model("listing_model","listing");
        $qrcode_types = $this->lang->line("heading_qrcodes_type_names");
        $record_sql = $this->db->select("q.*,(case when q.type=".QRCODE_TYPE_LISTING." and l.id is not null then l.name end ) as name,(case when q.type=".QRCODE_TYPE_LISTING." then '{$qrcode_types[QRCODE_TYPE_LISTING]}' end ) as type_name,(case when q.type=".QRCODE_TYPE_LISTING." and l.id is not null then l.id end ) as record_id",false)
                ->from($this->table_name." q")
                ->join($this->listing->table_name." l","l.qrcode = q.id","left")
                ->where(array("q.is_deleted"=>NOT_DELETED,"q.qrcode"=>$qr_code));
        $response['record'] = $record_sql->get()->row_array();
        return $response;
    }
}