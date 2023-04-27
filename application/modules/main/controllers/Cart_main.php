<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cart_main extends MY_Controller { 
    public function __construct() {
        parent::__construct();  
        $this->load->model("carts_model","carts");
        $this->load->model("orders_model","orders");
    }
    
    public function add_to_cart($post_data,$added_from,$return_get_cart = true) {
        $response = array();

        if(!empty($order_data['cart_item_id'])){
            $cart_item = $this->carts->ger_cart_item(array('id'=>$order_data['cart_item_id'],'is_deleted'=>0))["record"]; 
            $post_data =  $post_data + $cart_item; 
            $validationNotNeeded = true;
        }else {
            $this->form_validation->set_rules("product_id", $this->lang->line("heading_product_title"), "required");
            $this->form_validation->set_rules("listing_id", $this->lang->line("heading_listing"), "required");
            if($this->user_data["group_id"]==SUPERADMIN_GROUP_ID || !empty($this->user_data["is_staff"]) ) {
                $this->form_validation->set_rules("user_id", $this->lang->line("heading_listing_user_title"), "required");
            }
        }
        
        if (isset($post_data) && !empty($post_data))  
        { 
            
            if ( $this->form_validation->run() ) {    
                
                $request_headers = $this->input->request_headers();
                $post_data["country_id"] = decrypt($post_data["country"]);
                $post_data["state_id"] = decrypt($post_data["state"]);
                $post_data["city_id"] = decrypt($post_data["city"]);
                $post_data["product_id"] = decrypt($post_data["product_id"]);
                $post_data["listing_id"] = decrypt($post_data["listing_id"]);

                
                if( $added_from==CART_FROM_APP || ( $added_from == CART_FROM_WEB && $this->user_data["group_id"]!=SUPERADMIN_GROUP_ID && empty($this->user_data["is_staff"]) ) ){
                    $user_id = (!empty($order_data["user_id"]))?$order_data["user_id"]:$this->user_data['id'];
                }else{
                    $post_data["user_id"] = decrypt($post_data["user_id"]);
                    $user_id = (!empty($post_data["user_id"]))?$post_data["user_id"]:0;
                }
                $session_id = (!empty($this->user_data['rand'])) ? $this->user_data['rand']: session_id();
                $product_id = $post_data["product_id"];
                
                $listing_id= $post_data["listing_id"];
                $this->load->model("products_model","products");
                
                
                $product_data = $this->products->get_product_price($product_id)["record"];
                if(empty($post_data['cart_item_id']) )
                {
                    $product_price = $product_data["product_price"];
                } else {
                    /*
                    if($added_from == CART_FROM_ADMIN){
                        $food_price = $order_data['food_item_price'];
                    }else{
                        $food_price = (!empty($food_data['price']))?$food_data['price']:0;
                        if($food_data['discount_on'] == RESTAURANT_DISCOUNT_ON_FOOD_ITEM && !empty($food_data['discount']))
                        {  
                            $food_price = $food_data['discount'];
                        }else{
                            if($food_data['discount_type']==RESTAURANT_DISCOUNT_TYPE_FIXED && $food_data['discount'] > $food_price ){
                                $value = originalAndDiscountPrice($food_price,$food_price,$food_data['discount_type']);
                            }else{
                                $value = originalAndDiscountPrice($food_price,$food_data['discount'],$food_data['discount_type']);
                            }
                            $food_price = $value['price'];                        
                        }
                    }
                    */
                    $product_price = $product_data["product_price"];
                }
                
                if( !empty($user_id) ) {
                    $cartWhere = array('user_id' => $user_id,'product_id' => $product_id,'cart_from' =>$added_from,'is_deleted' => NOT_DELETED,"listing_id"=>$listing_id);
                }else{
                    $cartWhere = array('session_id' => $this->user_data['rand'],'food_item_id' => $food_item_id,'cart_from' =>$added_from,'is_deleted' => 0,'delivery_type' =>$delivery_type,"listing_id"=>$listing_id);
                }
           
                $product_name = (isset($order_data['product_name'])) ? $order_data['product_name'] : $product_data['product_name'];
                /*
                if($added_from == CART_FROM_ADMIN || $this->user_data["group_id"]==SUPERADMIN_GROUP_ID || !empty($this->user_data["is_staff"]) ){
                    if(isset($post_data['food_item_price']) ){ // as the value can be zero
                        //Remove item discount if price is changed
                        $order_data['single_item_discount_value'] = 0;
                        $order_data['single_item_discount_type'] = 0;
                        $food_price = $order_data['food_item_price'];
                    }
                    if(!empty($order_data['food_item_name'])){
                        if(trim($order_data['food_item_name']) != trim($food_data['name'])){
                            $food_item_name = trim($order_data['food_item_name']);
                        }
                    }
                    $cartWhere = array_merge($cartWhere,[ 'food_item_price' => $food_price, 'food_item_name' => $food_item_name ]);
                }
                */
                
                
                
                if( empty($post_data['cart_item_id']) || empty($cart_item['id']) ) {
                    // $cartWhere = array_merge($cartWhere,[ 'attribute_id' => $attribute_id , 'attribute_value_id' => $attribute_value_id, 'instructions' => $instructions, 'pos_note' => $pos_note, 'item_status' => 0,'is_deleted' => 0]);
                    
                    $cart_item = $this->carts->ger_cart_item($cartWhere)["record"];
                }
               
                
                $post_data['order_id'] = (!empty($post_data['order_id']) ? decrypt($post_data['order_id']) : 0);
                
                $user_filed_name="user_id";
                $user_filed_value=$user_id;
                if(empty($user_id)) {
                    $user_filed_name="session_id";
                    $user_filed_value=$this->user_data['rand'];
                }
                $coupon = $this->carts->ger_cart_item(array('listing_id' => $post_data["listing_id"],'order_id' => $post_data['order_id'],$user_filed_name => $user_filed_value,'is_deleted'=>NOT_DELETED))["record"];
                
                if(!empty($coupon['coupon_id'])){
                    $order_data['discount_value'] = $coupon['discount_value'];
                    $order_data['discount_type'] = $coupon['discount_type'];
                }
                /*
                if(!empty($order_data['order_id'])){
                    $order_data = $this->order_model->getRow($order_data['order_id'],['discount_method','discount_value','waiter_id','order_status']);
                    $order_data['discount_type'] = $order_data['discount_method'];
                    $order_data['discount_value'] = $order_data['discount_value'];
                    
                }
                */
                $extra_data = array('session_id'=>$session_id,'user_id' => $user_id, 'product_id' => $product_id,
                    'listing_id' => $listing_id,
                    'cart_from' => $added_from,
                    'product_order_status' => ( (isset($post_data['product_order_status '])) ? $post_data['product_order_status '] : 0 ),
                    'product_name' => $product_name,
                    'product_price' => $product_price,
                    'order_id' => $post_data['order_id'],
                    'created_by' => $this->user_data['id'],
                    'modified_at' => $this->user_data['id'],
                    'modified_at' => SQL_ADDED_DATE,
                    'created_at' => SQL_ADDED_DATE,
                );

                if(isset($order_data['single_item_discount_value']) && isset($order_data['single_item_discount_type'])

                ){
                    $extra_data['single_item_discount_value'] = $order_data['single_item_discount_value'];
                    $extra_data['single_item_discount_type'] = $order_data['single_item_discount_type'];
                }

                
                if(!empty($cart_item))
                {
                    
                    if($cart_item['product_order_status'] == CART_ITEM_STATUS_ORDERED && ( $this->user_data["group_id"]==SUPERADMIN_GROUP_ID || !empty($this->user_data["is_staff"])  ) && !empty($post_data['cart_item_id']) && false) {//will be changes in future right now not required
                        $changed_value = !empty($order_data['changed_value']) ? '('.$order_data['changed_value'].')' : '';
                        $_POST['cart_id'] = $cartItem['id'];
                        $_POST['cancel_reason'] = 'Ordered Item Changed '.$changed_value;
//                        $this->delete_cart_product(CART_FROM_ADMIN,$extra_data['quantity']);
                        $extra_data['item_status'] = CART_ITEM_STATUS_ORDERED;
                        $this->load->model('orderitems_model');
                        $this->load->model('order_model');
                        $order = $this->orderitems_model->getRow(['cart_id'=>$cartItem['id']],['id as order_item_id', 'order_id']);
                        $orderDiscountData = $this->order_model->getRow($order['order_id'],['discount_method','discount_value']);
//                        $cartItem['id'] = $this->carts_model->insert($extra_data);
                        $this->carts_model->update($extra_data,$order_data['cart_item_id']);
                        $cartItem['id'] = $order_data['cart_item_id'];
                        $cart_id = $cartItem['id'];
                        $cart_item = $this->carts_model->getCartItem($cartItem['id']);
                        
                        $cart_item['single_discount_value'] = $cartItem['single_item_discount_value'];
                        $cart_item['single_discount_type'] = $cartItem['single_item_discount_type'];
                        $this->load->module('main/order_main');
                        $new_item_id = $this->order_main->_save_order_items($cart_item, $order['order_id']);
                        
                        $this->load->model('order_payments_items_model');
                        $this->order_payments_items_model->update(['order_item_id' => $new_item_id['new_id']],['order_item_id' => $order['order_item_id']]);
                        $total = $this->order_model->updateOrderTotal($order['order_id'], $orderDiscountData['discount_method'], $orderDiscountData['discount_value']);
                        //-------------------
                        $this->order_main->update_orderPayments_calculation($order['order_id']); 
                        $this->update_tip($order['order_id']);
                        $notification_data = [
                            'order_id' =>$order['order_id'],
                            'date' => date('Y-m-d h:i:s'),
                        ];

                        // Socket and Cart data

                        $notification_data['table_id'] = $order_data['table_id'];
                        $notification_data['delivery_type'] = $delivery_type;
                       
                        $invoiceNum = '';
                        if(!empty($order['order_id'])){
                            $orderData = $this->order_model->getRow($order['order_id'], ['invoice_id']);
                            $invoiceNum = $orderData['invoice_id'];
                        }

                        $serialize = [
                            'send_to' =>"group",
                            'group_id' =>[ADMIN_GROUP_ID,SUBADMIN_GROUP_ID],
                            'get_cart' =>1, /*To send cart in notification*/
                            'token' => $request_headers['X-Auth-Token'],
                            /* send notification data */
                            'title' => 'Order Updated',
                            'message' => 'Your Order '.$invoiceNum.' is updated',
                            'type' => 'order',
                            't_id' => $order['order_id'],
                            'notification_type' => 'usr_order',
                            'data' => $notification_data, 
                            'is_save' => 1, /*grl implement*/ 
                            'restaurant_id' => $restaurant_id, 
                            'socket_data' => [], 
                            'order_id' => $order['order_id'],
                        ];


                        $this->load->model('table_scan_users_model');
                        $users = [];
                        if(!empty($order_data['table_id']))
                        {
                            $serialize['send_to'] = 'table';
                            $serialize['table_id'] = $order_data['table_id'];
                            /*$users = $this->table_scan_users_model->getScannedUsersByRoles($order_data['table_id'],$restaurant_id, $request_headers['X-Auth-Token']);*/
                        }else if(!empty($cart_item['user_id']))
                        {
                            $serialize['send_to'] = 'user';
                            $serialize['user_id'] = $cart_item['user_id'];
                            /*$users[] = $cart_item['user_id'];*/
                        }

                        $serialize_data = serialize($serialize);
                       
                    }else if( $cart_item['product_order_status'] == CART_ITEM_STATUS_PENDING ){
                        $this->carts->update($extra_data,$cart_id);
                    }else{
                    
                        $cart_id = $this->carts->insert($extra_data);
                    }
                }else {
                    $cart_id = $this->carts->insert($extra_data);
                }
               
                $response['flag'] = FLAG_SUCCESS;
                $response['message'] = $this->lang->line("message_item_cart_add_success");
                
            } else {
               
                $response['errors'] = $validation_array;
                $response['flag'] = FLAG_ERROR;
                $response['message'] = $this->lang->line("message_item_cart_add_error");
            }
        }
        else
        {
            $response['flag'] = 0;
            $response['message'] = $this->lang->line('invalid_request');
        }
       return $response;
    }
    
    public function get_cart($order_data,$from_app = 0, $user_id=null){
        $response = array();
        
        if(!empty($this->input->post('order_id'))){
            $order_id = $this->input->post('order_id');
            $this->load->module("main/order_main");

            $order_data['table_id'] = 0;
            
            $cartitem_count = $this->carts->getCount(['order_id' => $order_id,'is_deleted'=>NOT_DELETED]);
            
            if( $cartitem_count == 0  ) {
                $response = $this->order_main->get_all_order_products();
                
                if( !empty($response['data']) ) {
                    
                    $order_data['user_id'] = $response['user_id'];
                    $order_data['order_id'] =$response['order_id'];
                    $order_data['restaurant_id'] =$response['restaurant_id'];
                    foreach( $response['data'] as $key => $row ) {
                        $new_cart = [];
                        $new_cart['product_id'] = $row['product_id'];
                        $new_cart['listing_id'] = $response['listing_id'];
                        $new_cart['user_id'] = $response['user_id'];
                        $new_cart['order_id'] =$response['order_id'];
                        $new_cart['product_price'] = $row['product_price'];
                        $new_cart['item_status'] = CART_ITEM_STATUS_ORDERED ;
                        
                        $new_cart['product_name'] = stripcslashes($row['product_name']);
                        
                        $_POST = $new_cart;
                        $removed_checked = 1;

                        //$cart_id = $this->add_to_cart($new_cart,$row['cart_from'],0,$removed_checked);
                        if(isset($cart_id['flag']) && $cart_id['flag'] == FLAG_ERROR && $from_app != CART_FROM_POS){
                            $error['flag'] = FLAG_ERROR;
                            $error['message'] = $cart_id['message'];
                            return $error;
                        }else{
                            $this->load->model('order_products_model',"order_products");
                            $this->order_products->update(['cart_id'=>$cart_id],$row['id']);
                        }
        
                    }
                }
            }   

        }
        
        if(empty($response['data'])){
            $odet = $this->orders->getRow($this->input->post("order_id"));

            $data['user_id'] = $odet['user_id'];
            $data['listing_id'] =$odet['listing_id'];
        }
        $order_id = (!empty($this->input->post('order_id')))?$this->input->post('order_id'):0;
        $session_id = (!empty($this->userData['rand'])) ? $this->userData['rand']: session_id();
        $user_id = (!empty($user_id)) ? $user_id : $this->user_data['id'];
        $tmp = $this->carts->get_cart_items($session_id, $user_id,$data['listing_id'],$from_app,$order_id,$lang_code)["records"];
        if(!empty($tmp)) {
            $coupon_id = $tmp[0]['coupon_id'];
            $cart_discount_type = $tmp[0]['cart_discount_type'];
            $cart_discount_value = $tmp[0]['cart_discount_value'];
            $coupon_discount_value = $tmp[0]['coupon_discount_value'];
            $coupon_discount_method = $tmp[0]['coupon_discount_method'];
            foreach ($tmp as $key => $record) {
                $tmp[$key]['product_name'] = stripcslashes($tmp[$key]['product_name']);
                $tmp[$key]['name'] = stripcslashes($tmp[$key]['name']);
                if (empty($currency_symbol)) {
                    $currency_symbol = htmlentities($record['currency_symbol']);
                }
               
                if ($this->user_data['id'] == $record['created_by']) {
                    $tmp[$key]['added_by'] = 'you';
                }
                if (trim($order_id) == "") {
                    if (!empty($record['order_id']) && $record['order_id'] !== "0") {
                        $order_id = $record['order_id'];
                    }
                }

                $tmp[$key]['item_status'] = $this->lang->line("heading_cart_item_status")[$record['item_status']];
                $attributes_string = '';
                $attributes_new = array();
                $attribute_price = 0;
                
                $tmp[$key]['product_price'] = (!empty($record['product_price'])) ? $record['product_price'] : 0;
                $tmp[$key]['original_price'] = $tmp[$key]['product_price'];
                $tmp[$key]['total_price'] = $tmp[$key]['product_price'] ;
                $tmp[$key]['total_price'] = $tmp[$key]['total_price'];
                
                
                $cur_total = $tmp[$key]['total_price'];
                $total += $cur_total;
                $main_total = $total =  $total;
                $subtotal += $cur_total;
            }

            //$discount = $this->carts_model->getOrderDiscount($order_id);
            $discount = [];



            $tmp = array_values($tmp);
            $response['flag'] = FLAG_SUCCESS;
            $response['data'] = $tmp;
            
            $order_details = $this->orders->get_order_details($order_id)["record"];
            
            $total = ($total < 0) ? 0 : $total;
            $response['total'] = $total;
            $response['grand_total'] = $total + $response['tip'];
            $response['paying_amount'] = (empty($order_details["paid_amount"])) ? 0 : $order_details["paid_amount"];
            $response['order_status'] = $order_details["order_status"];
            $response['order_id'] = $order_id;
            $response['currency_type'] = html_entity_decode($curr["symbol"]);
        }else {
            $response['flag'] = 1;
            $response['message'] = $this->lang->line('empty_cart');
            $response['data'] = [];
        } 
        return $response;
    }
}