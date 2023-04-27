<?php
class Order_payments_model extends MY_Model {
    
    public function __construct(){
        parent::__construct();
        $this->table_name = "tbl_order_payments";
        $this->table_title = "Order Payments";
    }
    
    public function get_order_payment_transcactons($order_id, $left=NULL)  {
        $this->load->model("payment_transactions_model", "payment_transactions");
        $this->load->model("orders_model", "orders");
        $this->db->select('opay.id, opay.order_id, opay.amount, opay.discount_amount, SUM(pt.amount) as amount_paid, (Select SUM(amount) from ' . $this->payment_transactions->table_name . ' where payment_mode = ' . PAYMENT_MODE_CASH . ' and order_id = ' . $order_id . ' and `order_payment_id` = opay.id) as cash, (Select SUM(amount) from '.$this->payment_transactions->table_name.'  where payment_mode = ' . PAYMENT_MODE_PIN . ' and order_id = ' . $order_id . ' and `order_payment_id` = opay.id ) as card, (Select SUM(amount) from '.$this->payment_transactions->table_name.'  where payment_mode = ' . PAYMENT_MODE_CHEQUE . ' and order_id = ' . $order_id . ' and `order_payment_id` = opay.id ) as cheque, (Select SUM(amount) from '.$this->payment_transactions->table_name.'  where payment_mode = ' . PAYMENT_MODE_ONLINE . ' and order_id = ' . $order_id . ' and `order_payment_id` = opay.id ) as online,o.total_amount as grand_total');
        $this->db->from($this->table_name . " opay");
        $this->db->where('opay.order_id = ' . $order_id . '  and opay.credit_note_id IS NULL OR opay.credit_note_id = 0');
        if (empty($left)) {
            $this->db->join($this->payment_transactions->table_name . " pt", 'pt.order_payment_id = opay.id AND pt.status = ' . ACTIVE);
        } else {
            $this->db->join($this->payment_transactions->table_name . " pt", 'pt.order_payment_id = opay.id AND pt.status = 1', 'left');
        }
        $this->db->join($this->orders->table_name . " o", 'o.id = opay.order_id');
        $this->db->group_by('pt.order_payment_id');
        $this->db->group_by('opay.id');
        $this->db->order_by('opay.id ', "desc");
        $get = $this->db->get();
        $result = $get->result_array();
        // echo $this->db->last_query();
        return array( "records"=>$result);
    }

    public function remove_discounts_by_order($order_id){
        $this->db->set('discount_amount', 0);
        $this->db->where('order_id', $order_id);
        $this->db->update($this->table_name); 
     }
}