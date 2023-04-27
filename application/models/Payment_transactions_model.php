<?php
class Payment_transactions_model extends MY_Model {
    
    function __construct(){
        parent::__construct();
        $this->table_name = "tbl_payment_transactions";
        $this->table_title = "Payment Transaction";
    }
}