<?php
class Services_model extends MY_Model {
    function __construct(){
        parent::__construct();
        $this->table_name = 'services';
    }
    
    function getRecords($postData=array(),$pagination=true,$start=0,$limit=0){
        $recordsSql = $this->db->select('*')
                            ->from($this->table_name)
                            ->where('is_deleted',NOT_DELETED);
        if( isset($postData['status']) && is_numeric($postData['status']) ) {
            $recordsSql->where('status',$postData['status']);
        }
        if( $pagination===true ) {
            $recordsCountSql = clone $recordsSql;
            $response['count'] = $recordsCountSql->get()->num_rows();
        }
        $recordsSql->order_by('id','desc');
        $response['records'] = $recordsSql->get()->result_array();
        return $response;
    }
}