<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Order_main extends MY_Controller {
    
    public function __construct() {
        parent::__construct();  
        $this->load->model("carts_model","carts");
        $this->load->model("orders_model","orders");
        $this->load->model("order_products_model","order_products");
    }
    
    
    public function place_order($post_data,$order_from) {
        $user_id = (!empty($this->user_data['id']))?$this->user_data['id']:0;
        if($order_from == CART_FROM_ADMIN ){
            $post_data['user_id'] = decrypt($post_data['user_id']);
            $user_id =  $post_data['user_id'];
        }
        $post_data['listing_id'] = decrypt($post_data['listing_id']);
        $post_data["country_id"] = decrypt($post_data["country"]);
        $post_data["state_id"] = decrypt($post_data["state"]);
        $post_data["city_id"] = decrypt($post_data["city"]);
        $post_data["product_id"] = decrypt($post_data["product_id"]);       
        
        //Gets order idplace_order
        $order_id = 0;
        
        if(empty($post_data['order_id']))
        {
//            if($delivery_type == DELIVERY_TYPES_DINEIN || $order_from == CART_FROM_POS || $order_from == CART_FROM_WAITER)
//            {
//                $cart_order_id = $this->carts_model->cartOrderId($post_data['table_id'],$delivery_type, $user_id,$c_id);
//            }
            $cart_order_id = 0;
        }else
        {
            $cart_order_id = $post_data['order_id'];
        }
        
        
        if( !empty($cart_order_id) ) {
            $order_id = $cart_order_id;
        }

//        $session_id = (!empty($this->user_data['rand'])) ? $this->user_data['rand']: session_id(); 
        if( !empty($post_data['guest_address']) && !empty($post_data['guest_session_id']) ) {//used this condition as if because peviuos for guest user rand variable was not set 
            $session_id = $post_data['guest_session_id'];
        }else if( !empty($this->user_data['rand']) ) {
            $session_id = $this->user_data['rand'];
        }else{
            $session_id = session_id();
        }
        
        $new_items = $this->carts->get_cart_items($session_id,$user_id,$post_data['listing_id'],$order_from,$order_id)["records"];
        
        if (empty($cart_order_id)) { // new order record added and order items added 
            
            if(!empty($new_items) && isset($new_items))
            {
                
                $invoice_id = !empty($post_data['invoice_id'])?$post_data['invoice_id']:$this->uniqueInvoiceNumber();
                $this->load->model("listing_model","listing");
                $this->load->model("country_model","country");
                $this->load->model("state_model","state");
                $this->load->model("city_model","city");
                $listing_data = $this->listing->get_record($post_data['listing_id'])["record"];
                $this->load->model("users_model","users");

                $user_data = $this->users->get_record($user_id)["record"];
                $last_invoice_no = $this->orders->getRow(['1' => 1],['MAX(invoice_number) as last_order']);
                $order_count = $last_invoice_no['last_order'] + 1;
                
                $country_id = !empty($post_data["country_id"]) ? $post_data["country_id"] : $listing_data["country"];
                $state_id = !empty($post_data["state_id"]) ? $post_data["state_id"] : $listing_data["state"];
                $city_id = !empty($post_data["city_id"]) ? $post_data["city_id"] : $listing_data["city_id"];
                $city = !empty($post_data["city_id"]) ? $post_data["city_id"] : $listing_data["city"];
                $country_name = $this->country->get_record($country_id)["record"]["name"];
                $state_name = $this->state->get_record($state_id)["record"]["name"];
                $city_name =  $this->city->get_record($city_id)["record"]["name"];
                
                //bof pack_unpack order
                
               
                $order_data = array(
                    "user_id"           => $user_id,
                    "user_name"         => $user_data["full_name"],
                    "invoice_number"    => $order_count,
                    "country_id"        => $country_id,
                    "state_id"          => $state_id,
                    "city_id"           => $city_id,
                    "country"           => $country_name,
                    "state"             => $state_name,
                    "city"              => $city_name,
                    "invoice_id"        => $invoice_id,
                    "listing_id"        => $post_data["listing_id"],
                    "listing_name"      => $listing_data["name"],
                    "listing_email"     => $listing_data["primary_email"],
                    "listing_phone_no"  => $listing_data["primary_phone_no"],
                    "listing_phone_code"=> $listing_data["primary_phone_code"],
                    "listing_type"      => $listing_data["listing_type"],
                    "listing_type_name" => $listing_data["listing_type_name"],
                    "user_name"         => $user_data["full_name"],
                    "phone_no"          => $user_data["phone_no"],
                    "address"           => $post_data["address"] ? : $listing_data["address"],
                    "sub_total"          => 0,
                    "total_amount"      => 0,
                    "payment_status"    => PAYMENT_STATUS_PENDING,
                    "order_status"      => DEFAUILT_ORDER_STATUS,
                    "order_from"        => $order_from,
                    "created_at"        => SQL_ADDED_DATE,
                    "created_by"        => $user_id,
                    "modified_at"       => SQL_ADDED_DATE,
                    "modified_by"       => $user_id,
                    "ip_address"        => getVisitorIp(),
                );
                
                if($order_from == CART_FROM_ADMIN) {
                    $order_data['order_status'] = ORDER_STATUS_CONFIRMED;
                }
                
                if(!empty($post_data['guest_address']) && false){
                    $order_data['billing_firstname'] = $post_data['firstname'];
                    $order_data['billing_lastname'] = $post_data['lastname'];
                    $order_data['billing_email'] = $post_data['email'];
                    $order_data['billing_mobile'] = $post_data['phone'];
                    $order_data['billing_address'] = $post_data['address'];
                    $order_data['billing_postcode'] = $post_data['postcode'];
                    $order_data['billing_place'] = @$post_data['city_name'] . ', ' . (isset($post_data['state_name']) ? $post_data['state_name'] : '') ;
                    $order_data['billing_latitude'] = $post_data['latitude'];
                    $order_data['billing_longitude'] = $post_data['longitude'];

                    $order_data['shipping_firstname'] = $post_data['firstname'];
                    $order_data['shipping_lastname'] = $post_data['lastname'];
                    $order_data['shipping_address'] = @$post_data['address2'].", ".@$post_data['address'];
                    $order_data['shipping_postcode'] = @$post_data['postcode'];
                    $order_data['shipping_place'] = @$post_data['city_name'] . ', ' . (isset($post_data['state_name']) ? $post_data['state_name'] : '') ;
                    $order_data['shipping_latitude'] = $post_data['latitude'];
                    $order_data['shipping_longitude'] = $post_data['longitude'];
                }
                $order_id = $this->orders->insert($order_data);               
            }
        }
        
        //** This block of code is specifically written for the issue where multiple users on the same table placed thier order at the exact same moment */
        

        if( empty($order_id) ) {
            $response['flag'] = 0;
            $response['message'] = $this->lang->line("message_order_place_fail");
            $response['data'] = [];
            return $response;
        } else {
            foreach ($new_items as $new) {
                //Save Order Items
                
                if($new['product_order_status'] == CART_ITEM_STATUS_PENDING && $new['is_deleted'] == NOT_DELETED) {
                    $itemDataIds = $this->_save_order_items($new, $order_id);
                    $order_item_ids[] = array(
                        'id' => $itemDataIds['new_id'],
                        'preparation_location' => $itemDataIds['preparation_location']
                    );
                }
            }
            
            $response['flag'] = 1;
            $response['order_id'] = encrypt($order_id);
            $response['message'] = $this->lang->line("message_order_place_success");
        }
        
        $total = $this->orders->update_order_total($order_id, $discount_method, $discount_value);
        $this->update_order_payments_calculation($order_id);
        $cart_user_id = (isset($new_items[0]['user_id']) && !empty($new_items[0]['user_id']))? $new_items[0]['user_id'] : $user_id;
        $_POST["order_id"] = $order_id;
        $order_details = $this->orders->getRow($order_id);
        if( ( $order_details['total'] )==0 && ($order_from == CART_FROM_APP || $order_from == CART_FROM_WEB) ){
            $new_order_data['payment_status'] =  PAYMENT_STATUS_DONE;
        }
        $this->orders->update($new_order_data,$order_id);
        
        
//        if(!empty($post_data['order_detail']) && $order_from == CART_FROM_ADMIN ){
//            $returnData = $this->get_all_order_food_items(1, 1, CART_FROM_POS);
//        }else{
//            try{
//            $returnData = $this->cart_main->get_cart($post_data, $order_from);
//            __print($returnData);
//            }catch(Error $e){
//                echo $e->getMessage();
//                die;
//            }catch(Exception $e){
//                echo $e->getMessage();
//                die;
//            }
//        }
        
//        foreach($returnData as $k=>$d){
//            if($k != "flag"){
//                $response[$k] = $d;
//            }
//        }
       
        return $response;
    }
    
    public function get_all_order_products($show_deleted_items = 0, $show_billing_details = 0, $from=null,$data = [])  {
        $response = array();
        // $tax = array();
        if (empty($data)) {
            $data = $this->post_data;
        }
        if (isset($data) && !empty($data) && !empty($data['order_id'])) {
            // $tmp = $this->order_model->get_order_items($data['order_id']);
            
            $order_detail = $this->orders->get_order_details($data['order_id'], $from)["record"];
            
            $items = [];
            $total = 0;
            $taxamt = 0;
            $rate_us = 0;

            if (!empty($order_detail)) {
                $order_products = $this->order_products->get_all_order_products($data['order_id'], $show_deleted_items)["records"];
                
                $count = count($order_products);
                $taxes = [];
                foreach ($order_products as $key => $record) {
                    $record['product_name'] = stripcslashes($record['product_name']);
                    $items[$key] = $record;
                }
                $tmp = array_values($items); 
               
                $this->load->model("payment_transactions_model","payment_transactions");
                $other_details = $this->orders->get_order_details($data['order_id'])["record"];
                
                if ($this->payment_transactions->isExist(['order_id' => $data['order_id']])) {
                    
                    $payment_mode = $this->payment_transactions->getRow(['order_id' => $data['order_id']], ['payment_mode,transaction_id', 'payment_method_id']);
                    if (isset($payment_mode['payment_mode']) && !empty($payment_mode['payment_mode'])) {
                        $other_details["payment_method"] = $payment_mode['payment_method_id'];
                        if ($payment_mode['payment_mode'] == PAYMENT_MODE_CASH) {
                            $pm = $this->lang->line("heading_payment_method_cash");
                        } elseif ($payment_mode['payment_mode'] == PAYMENT_MODE_PIN) {
                            $pm = $this->lang->line("heading_payment_method_card");
                        } elseif ($payment_mode['payment_mode'] == PAYMENT_MODE_ONLINE) {
                            $pm = $this->lang->line("heading_payment_method_online");
                        } elseif ($payment_mode['payment_mode'] == PAYMENT_MODE_CHEQUE) {
                            $pm = 'Cheque';
                        } 
                    }
                    $other_details["payment_mode"] = $pm;
                    $other_details["transaction_id"] = $payment_mode['transaction_id'];
                }
                
                
                $other_details["payment_status_str"] = ( isset($other_details["payment_status"]) && !empty($other_details["payment_status"]) ) ? $this->lang->line('payment_status')[$other_details["payment_status"]] : $this->lang->line("heading_payment_status")[PAYMENT_STATUS_PENDING];
//                if ($order_detail['discount_method']) {
//                    $order_detail['discount_method'] = StaticArrays::$restaurant_discount_types[$order_detail['discount_method']];
//                    $order_detail['discount_method'] = strtolower($order_detail['discount_method']);
//                }
               
               
                $response['flag'] = FLAG_SUCCESS;
                $response['data'] = $tmp;
                
                $response['sub_total'] = $order_detail['subtotal'];

                $response['order_id'] = $data['order_id'];
                $response['user_id'] = $order_detail['user_id'];
                $response['order_status'] = $order_detail['order_status'];
               
                $response['total_amount'] = $order_detail['total_amount'];
                $response['grand_total'] = $order_detail['total_amount'];
                $response['other_details'] = $other_details;
                $response['order_from'] = $order_detail['order_from'];
                $response['tax_method'] = $order_detail['tax_method'];
                $response['created_on'] = $order_detail['created_on'];
                $response['credit_note_id'] = $order_detail['credit_note_id'];
                $response['credit_note_number'] = $order_detail['credit_note_number'];
                $response['instant_order'] = $order_detail['instant_order'];
                
                if ($show_billing_details == 1) {
                    // $this->load->module('main/customers_main');
                    // $user = $this->customers_main->get_profile($order_detail['user_id']);
                    $custDet = [
                        'listing_name' => $order_detail['listing_name'],
                        'listing_phone_no' => $order_detail['listing_phone_no'],
                        'address' => $order_detail['address'],
                        'postcode' => $order_detail['postcode'],
                        'country' => $order_detail['country'],
                        'state' => $order_detail['state'],
                        'city' => $order_detail['city'],
                        'date' => date(DEFAULT_SQL_ONLY_DATE_FORMAT, strtotime($order_detail['created_at'])),
                        'time' => date(DEFAULT_SQL_TIME_FORMAT, strtotime($order_detail['created_at']))
                    ];
                    $response['user_details'] = $custDet;
                }

               

                $order_payments = $this->view_order_payments($data['order_id'],$data)['data'];
                $payments = [];
                $payment_mod = '';
                foreach ($order_payments as $key => $payment) {
                    $payments[$key]['id'] = $payment['id'];
                    $payments[$key]['total'] = $payment['amount_paid'];
                    $payments[$key]['cash'] = $payment['cash'];
                    $payments[$key]['card'] = $payment['card'];
                    $payments[$key]['cheque'] = $payment['cheque'];
                    $payments[$key]['online'] = $payment['online'];
                    
                    if ($payment['cash'] > 0) {
                        $payment_mod .= $this->lang->line("heading_payment_method_cash").", ";
                    }
                    if ($payment['card'] > 0) {
                        $payment_mod .= $this->lang->line("heading_payment_method_card").", ";
                    }
                    if ($payment['cheque'] > 0) {
                        $payment_mod .= $this->lang->line("heading_payment_method_cheque").", ";
                    }
                    if ($payment['online'] > 0) {
                        $payment_mod .= $this->lang->line("heading_payment_method_online").", ";
                    }
                    $payment_mod = trim($payment_mod, ", ");
                }

                $response['payment_mod'] = $payment_mod;
                $response['payments'] = $payments;
                
            } else {
                $response['flag'] = 0;
                $response['message'] = $this->lang->line('message_wrong_order_id');
            }
        } else {
            $response['flag'] = 0;
            $response['message'] = $this->lang->line('messag_invalid_request');
        }
        return $response;
    }
    public function view_order_payments($order_id=NULL,$post_data=array(),$from = 0)  {
        $data = $post_data;
        if (!empty($order_id)) {
            $data['order_id'] = $order_id;
        }
        if (!empty($data['order_id']) && is_numeric($data['order_id'])) {
            $order = $this->orders->getRow(['id' => $data['order_id']]);

           

            if (!isset($order['id']) || empty($order['id'])) {
                $response['flag'] = 0;
                $response['message'] = $this->lang->line('message_wrong_order_id');
                return $response;
            }

            $this->load->model("order_payments_model","order_payments");
            $this->load->model("order_payments_products_model","order_payments_products");
            $this->load->model("order_products_model","order_products");
            $order_payments = $this->order_payments->get_order_payment_transcactons($data['order_id'], 1)["records"];
            
            $order_payments_sum = $this->order_payments->getRow(['order_id' => $data['order_id']], ['sum(amount) as amount']);
            $order_payments_count = $this->order_payments->getCount(['order_id' => $data['order_id']]);
            $order_payments_itemscount = $this->order_payments_products->getCount(['order_id' => $data['order_id']]);
            $order_payments_items = [];
            $order_payments_items = $this->order_payments_products->get_items_for_splitview($data['order_id'])["records"];
            // print_r($order_payments_items);
            if (!empty($order_payments)) {
                $response['flag'] = 1;
                $response['order_id'] = $order_payments[0]['order_id'];
            

                $op_items_same = [];
                $i = 0;
                $totalTax = 0;
                $taxes = [];
                if ($order_payments_count > 1 && $order_payments_itemscount == 0) {
                    $split_type = ORDER_SPLIT_TYPE_PERSONS;
                    foreach ($order_payments_items as $itemkey => $item) {
                        $item['product_price'] = $item['product_price'];
                        $op_items_same[$i] = $item;
                        $i++;
                    }
                }
                if ($order_payments_count > 1 && $order_payments_itemscount > 0) {
                    $split_type = ORDER_SPLIT_TYPE_ITEMS;
                }
               
                

                foreach ($order_payments as $k => $p) {
                
                    $op_items = [];
                    // print_r($order_payments_items);
                    if (empty($op_items_same)) {
                        $i = 0;
                        $totalTax = 0;
                        $taxes = [];
                        foreach ($order_payments_items as $itemkey => $item) {
                            if ($item['order_payment_id'] == $p['id']) {
                                $op_items[$i] = $item;
                                $i++;
                            }
                        }
                    } else {
                        $op_items = $op_items_same;
                    }


                    // when discounts are removed from order payments while updating
                    
                    
                    
                    $order_payments[$k]["grand_total"] = $p["grand_total"];
                    /* This will not work properly incase of of multiple payments (split) */
                    $order_payments[$k]['sub_total'] = ($order_payments[$k]['amount']);
                    
                    $order_payments[$k]['net_total'] = $order_payments[$k]['net_amount'] = ($p['amount'] - $order_payments[$k]['discount_amount']);
                    $order_payments[$k]['total'] = $order_payments[$k]['amount'] = $p['amount'] - $order_payments[$k]['discount_amount'] - $order['coupon_discount_amount'] ;
                    

                    $order_payments[$k]['amount_paid'] = $p['amount_paid'];
                    $order_payments[$k]['cash'] = $p['cash']?:0;
                    $order_payments[$k]['online'] = $p['online']?:0;
                    $order_payments[$k]['card'] = $p['card']?:0;
                    $order_payments[$k]['cheque'] = $p['cheque']?:0;
                    
                    $order_payments[$k]['items'] = $op_items;
                }
                $response['data'] = $order_payments;
                $response['tax_method'] = $order['tax_method'];
                $response['split_type'] = $split_type;
            } else {
                $response['flag'] = 1;
                $response['message'] = $this->lang->line('message_no_records');
            }
        } else {
            $response['flag'] = 0;
            $response['message'] = $this->lang->line('message_invalid_request');
        }
        return $response;
    }

    public function update_order_payments_calculation($order_id, $cart_discount=0){
        //Needs to handle coupon 
        $this->load->model("order_payments_model","order_payments");
        $this->load->model("order_payments_products_model","order_payments_product");

        $this->order_payments->remove_discounts_by_order($order_id);
        $payment_items_count = $this->order_payments_product->getCount(['order_id' => $order_id]);
        $payments = $this->order_payments_product->getAllWhere(['order_id' => $order_id], ['id']);
        if ($payment_items_count > 0) {
            //Split by Items & need to be deleted because there's a change in order
            $this->order_payments_product->delete(['order_id' => $order_id]);
            foreach ($payments as $key => $payment) {
                if ($key > 0) {
                    //Delete all payments excpet for one
                    $this->order_payments->delete($payment['id']);
                }
            }
            $split_count = 1;
        } else {
            //Split by Number
            $split_count = count($payments);
        }
        $order_data = $this->orders->getRow($order_id, ['total_amount']);
        $total = $order_data['total_amount'] ;
        $new_payment_data = ['modified_at' => SQL_ADDED_DATE, 'modified_by' => $this->user_data['id'], 'order_id' => $order_id];
        if (!empty($split_count)) {
            $amount = $total / $split_count;
            $discount_amount = $order_data['discount_amount'] / $split_count;
            $diff = $total - ($amount * $split_count);
            $disscount_diff = $order_data['discount_amount'] - ($discount_amount * $split_count);
            foreach ($payments as $key => $payment) {
                if ($key === 0) {
                    $new_payment_data['amount'] = $amount + $diff;
                    $new_payment_data['discount_amount'] = $discount_amount + $disscount_diff;
                } else {
                    $new_payment_data['discount_amount'] = $discount_amount;
                    $new_payment_data['amount'] = $amount;
                }
                $this->orders->update($new_payment_data, $payment['id']);
            }
        } else {
            $new_payment_data['created_by'] = $this->user_data['id'];
            $new_payment_data['created_at'] = date(DEFAULT_SQL_DATE_FORMAT);
            $new_payment_data['ip_address'] = getVisitorIp();
            $new_payment_data['amount'] = $total;
            $new_payment_data['discount_amount'] = $order_data['discount_amount'];
            $this->order_payments->insert($new_payment_data);
        }
    }
    public function _item_calculation($item, $order_id = 0,$is_credit_note=0)  {
        $product_price = (!empty($item['product_price'])) ? $item['product_price'] : 0;
        $total_price = $product_price;        

        // $total_price = $total_price - $tax_amount;
        $item["product_price"] = $product_price;
        $order_item_arr = array(
            'cart_id' => $item["id"],
            'product_name' => $item['product_name'],
            "order_id" => $order_id,
            "product_id" => $item['product_id'],
            "product_price" => $product_price,
        );
        return array('product_price' => $product_price,  'total_price' => $total_price, 'discount_amount' => $discount_amount, 'tax_amount' => $tax_amount,  'order_product_array' => $order_item_arr) ;
    }

    public function _save_order_items($new, $order_id) {
        $item = $this->_item_calculation($new, $order_id);
        $data = $item["order_product_array"];
        $data['created_at'] = date(DEFAULT_SQL_DATE_FORMAT);
        $data['created_by'] = $this->user_data['id'];
        $data['added_from'] = $new['cart_from'];
        $order_item_row = $this->order_products->getRow(array('cart_id' => $data['cart_id']), ['id']);
            
        if (!empty($data['cart_id']) && !empty($order_item_row['id'])) {
            $data['modified_at'] = SQL_ADDED_DATE;
            $data['modified_by'] = $this->user_data['id'];
            
            $this->order_products->update($data, array('cart_id' => $data['cart_id']));
            $newid = $order_item_row['id'];
            
        } else {
            $newid = $this->order_products->insert($data);
        }
        $cart_data = array('product_order_status' => CART_ITEM_STATUS_ORDERED, 'order_id' => $order_id, 'modified_by' => $this->user_data['id'], 'modified_at' => SQL_ADDED_DATE);
        //hides the cart items from the getCartItems fucntion

        $this->carts->update($cart_data, $new['id']);
        return array('total' => $data['price'], 'tax' => $data['tax_amount'], 'new_id' => $newid, 'preparation_location' => $item['preparation_location']);
    }

    private function uniqueInvoiceNumber($length = 6 ,$tried_num =1 ) { 
        $invoiceNum = strtoupper(generateRandomString($length));
        $order = $this->orders->isExist(['invoice_id' => $invoiceNum]);
        if($order === false)
        {   
            return $invoiceNum;
        }else
        {
            if($tried_num === 3)
            {
                $length++;
            }
            $tried_num++;
            //If random generated invoice number was found more than 3 times incriment the length of invoice number by one
            return $this->uniqueInvoiceNumber($length ,$tried_num);
        }
    }
}