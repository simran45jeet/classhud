<?php
class Staff_model extends MY_Model {
    
    public function __construct() {
        parent::__construct();
        $this->table_name = 'tbl_users';
        $this->table_title = 'Staff';
    }

    function get_records($post_data,$pagination=true,$page_no=1) {
        $this->load->model("groups_models","groups");
        $response = array();
        $record_sql = $this->db->select("u.*,g.name as group_name,g.is_primery")
                            ->from($this->table_name." u")
                            ->join($this->groups->table_name." g","g.id = u.group_id")
                            ->where( array("u.is_deleted"=>NOT_DELETED,"g.is_deleted"=>NOT_DELETED,"g.is_staff"=>IS_STAFF) );
        if( isset($post_data['only_active']) && $post_data['only_active']===true ){
            $record_sql->where("u.status",ACTIVE);
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

    
    function get_record($id){
        $record = $this->db->select("*")
                            ->from($this->table_name)
                            ->where(array("is_deleted"=>NOT_DELETED,"id"=>$id))
                            ->get()->row_array();
        return array("record"=>$record);
    }
}