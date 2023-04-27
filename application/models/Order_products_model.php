<?php
class Order_products_model extends MY_Model {
    
    public function __construct(){
        parent::__construct();
        $this->table_name = "tbl_orders_products";
        $this->table_title = "Order Product";
    }
    
    public function get_all_order_products($order_id,$show_deleted_items) {
        $this->load->model("orders_model","orders");
        $data = $this->db->select('o.invoice_id,o.invoice_number, op.*, op.added_from as cart_from')
                ->from($this->table_name." op")
                ->join($this->orders->table_name." o", 'o.id=op.order_id')
                ->where(['op.order_id' => $order_id,"op.is_deleted"=>NOT_DELETED]);
        
        $data = $data->get();
        $result = $data->result_array();
        return array("records"=>$result);
    }

}