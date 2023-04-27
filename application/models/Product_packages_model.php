<?php
class Product_packages_model extends MY_Model {
    
    public function __construct(){
        parent::__construct();
        $this->table_name = "tbl_product_packages";
        $this->table_title = "Product Package";
    }
}