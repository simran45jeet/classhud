<?php
class Orders_model extends MY_Model {
    
    public function __construct(){
        parent::__construct();
        $this->table_name = "tbl_orders";
        $this->table_title = "Order";
    }
    
    public function get_records($post_data=array(),$pagination = false,$page_no=1 ) {
        
        //Get Restaurant List
        $record_sql = $this->db->distinct()->select("o.*",false)
                ->from($this->table_name." o")
                ->where( array("o.is_deleted"=>NOT_DELETED) );
        
        if( isset($post_data["all_records"]) && $post_data["all_records"]==true ){
        }else{ $record_sql->where("o.status",ACTIVE); }
        
        
        
        if( !empty($post_data["search"]) ) {
            
            
            $record_sql->group_start();
            $record_sql->like("o.listing_name",$post_data["search"]);
            $record_sql->or_like("o.listing_name",$post_data["search"]);
            $record_sql->or_like("o.user_name",$post_data["search"]);
            
            if( is_numeric($post_data["search"]) ) {
                $record_sql->or_where("o.listing_phone_no",$post_data["search"]);
                $record_sql->or_where("o.listing_email",$post_data["search"]);
            }
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
        $response['records'] = $record_sql->order_by("o.id","desc")->get()->result_array();
        
        return $response;
    }
    
    public function update_order_total($order_id, $discount_method = 0, $discount_amount = 0) {

        $this->load->model("order_products_model","order_products");

        $sql = "UPDATE {$this->table_name} SET  sub_total = (SELECT SUM(op.product_price) FROM {$this->order_products->table_name} as op  WHERE op.order_id={$order_id} and is_deleted=".NOT_DELETED." ) WHERE id = $order_id";

        $this->db->query($sql);

        $discount = $total = $discount_value = 0;
        $discountCond = '';
        if (!empty($order_id)) {
            $this->db->select('sub_total  as total')
                    ->from($this->table_name)
                    ->where('id = ' . $order_id)
                    ->limit(1);
            $totalarr = $this->db->get()->row_array();
            $total = $totalarr["total"];
            $total_for_disc = $totalarr["total_for_disc"];



        }
        $sql = "UPDATE {$this->table_name} SET  total_amount =  {$total}  WHERE id = " . $order_id;
        $this->db->query($sql);
        return $total;
    }

    public function get_order_details($order_id,$from = '') {
        $this->load->model("listing_model","listing");
        $this->load->model("users_model","users");
        
        $q = $this->db->select('o.*')
                ->from($this->table_name." o")
                ->join($this->listing->table_name." l", 'l.id = o.listing_id')
                ->join($this->users->table_name." u", 'u.id =  o.user_id', 'left')
                ->where('o.id', $order_id);
        return array( "record" => $q->get()->row_array() );
    }
}