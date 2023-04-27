<?php
class Products_model extends MY_Model {
    
    function __construct(){
        parent::__construct();
        $this->table_name = "tbl_products";
        $this->table_title = "Product";
    }
    
    public function get_records($post_data=array(),$pagination = false,$page_no=1 ) {

        $record_sql = $this->db->distinct()->select("p.*",false)
                ->from($this->table_name." p")
                ->where( array("p.is_deleted"=>NOT_DELETED) );
        
        if( isset($post_data["all_records"]) && $post_data["all_records"]==true ){
        }else{ $record_sql->where("p.status",ACTIVE); }
        
        
        
        if( !empty($post_data["search"]) ) {
            $record_sql->group_start();
            $record_sql->like("p.name",$post_data["search"]);
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
        
        $response['records'] = $record_sql->order_by("p.id","desc")->get()->result_array();
        
        return $response;
    }
    
    public function get_product_price($product_id){
        
        $record_sql = $this->db->select("p.name as product_name ,p.product_price")
                            ->from($this->table_name." p")
                            ->where("p.id" , $product_id);
        $record = $record_sql->get()->row_array();
        return array("record"=>$record );
    }
}