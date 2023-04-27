<?php
class Carts_model extends MY_Model {
    
    public function __construct(){
        parent::__construct();
        $this->table_name = "tbl_cart";
        $this->table_title = "Cart";
    }
    
    
    public function ger_cart_item($post_data){
        $record = $this->getRow($post_data);
        return array("record"=>$record);
    }
    
    public function get_cart_items($session_id,$user_id,$listing_id,$order_from,$order_id = 0){

      
        $where .= " AND c.order_id = " . $order_id;
        if ($order_from == CART_FROM_WEB) {
            $cartUserCond = " session_id = '" . $session_id . "' "; /* condition applied due to mollie payment gateway when webhook url hits like IPN then session_id is different  because not hit in browser if guest user then session id stored in meta data */
            if ($user_id > 0) {
                $cartUserCond = " c.created_by = " . $user_id;
            }
            $where .= " AND (CASE WHEN c.created_by = 0 THEN (c.session_id = '" . $session_id . "') ELSE ($cartUserCond) END) AND c.product_order_status = 0 AND c.cart_from = " . $order_from;
        } else {
            if ($order_from != CART_FROM_ADMIN) {
                $where .= ' AND c.reated_by = ' . $user_id . ' AND c.product_order_status = 0 ';
            }
            $where .= ' AND (CASE WHEN c.product_order_status = 0 THEN (c.cart_from = ' . $order_from . ' ) ELSE ( c.product_order_status = 1) END)';
        }
    

        $sel = '';
        
        $this->load->model("products_model","products");
        $this->load->model("listing_model","listing");
        $this->load->model("users_model","users");
        $this->load->model("order_products_model","order_products");
       
        $record_sql = $this->db->select("c.*,u.full_name as added_by, p.name, p.image, c.order_id as order_id, c.product_price as price $sel , c.product_name")
                ->from($this->table_name." c")
                ->where(array("c.listing_id"=>$listing_id,"c.is_deleted"=>NOT_DELETED))
                ->join($this->products->table_name." p", 'p.id = c.product_id', 'left')
                ->join($this->listing->table_name." l", 'l.id = c.listing_id')
                ->join($this->users->table_name." u", 'u.id = c.created_by', 'left')
                ->group_by('c.id')->order_by("c.product_order_status ASC, id DESC");
        
        $records = $record_sql->get()->result_array();
        
        return array("records"=>$records);
    }
}