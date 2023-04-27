<?php
class Order_payments_products_model extends MY_Model {
    
    public function __construct(){
        parent::__construct();
        $this->table_name = "tbl_order_payments_products";
        $this->table_title = "Order Product Payment";
    }
    
    public function get_items_for_splitview($order_id){
        $this->load->model("order_payments_model","order_payments");
        $this->load->model("order_products_model","order_products");
        $this->db->select('op.id,op.added_from as cart_from, op.product_name,op.product_price as product_price, COALESCE(opp.order_payment_id, (Select MAX(id) from '.$this->order_payments->table_name.' where order_id = '.$order_id.')) as order_payment_id');
        $this->db->from($this->table_name." opp");
        $this->db->where('op.order_id = '.$order_id.' AND op.is_deleted='.NOT_DELETED);
        $this->db->join($this->order_products->table_name." op", 'op.id = opp.order_item_id', 'right');
        
        $this->db->join($this->order_payments->table_name." opay", 'opay.order_id = op.order_id', 'right');
        $this->db->order_by('opp.order_payment_id', 'ASC');
        $this->db->group_by('op.id');
        $this->db->group_by('opp.id');
        $get = $this->db->get();        
        return array("records"=> $get->result_array() );

      }
}