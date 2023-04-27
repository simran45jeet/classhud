<?php
class Country_model extends MY_Model {
    
    function __construct(){
        parent::__construct();
        $this->table_name = 'tbl_country';
        $this->table_title = 'Country';
    }
    
    function get_records($post_data=array(),$pagination=true,$page_no=1){
        
        $recordsSql = $this->db->select("c.*")
                            ->from($this->table_name." c")
                            
                            ->where('c.is_deleted',NOT_DELETED);
        

//        if( isset($post_data['only_active']) && $post_data['only_active']===true ) {
            $recordsSql->where('c.status',ACTIVE);
//        }
        
        if( $pagination===true ) {
            $recordsCountSql = clone $recordsSql;
            $response['count'] = $recordsCountSql->get()->num_rows();
            
            $default_count = (int)$post_data['per_page_count'] ? (int)$post_data['per_page_count'] : DEFAULT_RECORDS_PAGELIMIT;
            $data_page = api_paging($default_count,$page_no);
            $recordsSql->limit($data_page['limit'],$data_page['start']);
        }
        
        if( isset($post_data['order'][0]['column']) ) {
            $field = $post_data['columns'][$post_data['order'][0]['column']]['data'];
            if($field=='name') {
                $orderByFiled = 'c.name';
            }else{
                $orderByFiled = 'c.id';
            }
            $orderByType = $post_data['order'][0]['dir'] == "asc" ? "asc":"desc";
        }else{
            $orderByFiled = "c.id";
            $orderByType = "desc";
        }
        $recordsSql->order_by($orderByFiled,$orderByType);
        $response['records'] = $recordsSql->get()->result_array();
        return $response;
    }
    
    function get_record($id){
        $record = $this->db->select("c.*")
                            ->from($this->table_name." c")
                            
                            ->where(array("c.id"=>$id,"c.is_deleted"=>NOT_DELETED))
                            ->get()->row_array();
        return array('record'=>$record);
    }
}