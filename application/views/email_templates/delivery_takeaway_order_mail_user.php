<?php 
$paraCSS = 'font-size: 14px; font-weight: normal;color:#000; line-height: 22px;font-family: \'Montserrat\', sans-serif!important;';
$data['body'] = '<tr>
   <td>
    <table style="font-size: 14px; font-weight: normal;color:#000;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important; ">
<tr>
    <td>
        <table style="width: 100%;padding: 0px;">
        <tr>
            <td colspan="5">
                <h1 style="font-size: 24px; text-align:center;color:#000; font-family: \'Montserrat\', sans-serif!important;padding-top:12px; ">Welcome Valuable Partner!</h1>             
                <p style="padding-top: 10px;">
                    Dear '.ucwords($name).',
                </p>  
            </td>
        </tr>
            <tr class="top">
                <td colspan="5">
                    <table style="width:100%">
                        <tr>                            
                            <td class="right">
                                We’ve got your order.<br />
                                We’ll drop you another email when your order is confirmed. We hope you enjoyed ordering with us!<br />
                                Check out the details below:<br />
                                You ordered <b>'.ucwords($delivery_type).'</b> order  <b>'.$order_detail['other_details']->invoice_number.'</b> for Invoice number <b>'.$order_detail['other_details']->invoice_id.'</b> on <b>'.date(DEFAULT_DATE_FORMAT,strtotime($order_detail['created_on'])).'</b> At:<b> '.date(DEFAULT_PRINT_TIME_FORMAT,strtotime($order_detail['created_on'])).'</b>.';
                            $data['body'] .= '</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
            <td colspan="5"><p style="padding-top:25px;padding-bottom:12px;">Refer below for the complete order details:</p></td>
            </tr>
            </table>

            <table class="table_border" style="width: 100%;padding: 5px;background-color:#f2f2f2">
            <tr class="heading">
                <td style="text-align: left;padding:10px 12px;">
                    <b>Qty</b>
                </td>
                <td style="text-align: left;padding:10px 12px;">
                    <b>Item</b>
                </td>
                <td style="padding:10px 12px;">
                    <b>Total Price</b>
                </td>
            </tr>';
            foreach($order_detail['data'] as $item){
            $data['body'] .= '<tr class="item">
                <td class="qty" style="text-align: left;padding:5px 12px">
                    '.$item['quantity'].'
                </td>
                <td style="text-align: left;padding:5px 12px">
                    '.$item['food_item_name'];
                    if(!empty($item['attributes_new'])){
                        $data['body'] .=  "<br><small>";
                        foreach ($item['attributes_new'] as $attributes_new) {
                            $data['body'] .=  $attributes_new['name']." : <img src='".base_url()."assets/images/currency/".$order_detail['currency_image']."' style='width:9.5px;margin-right: 5px;'>".$attributes_new['price']."<br >";
                        }
                        $data['body'] .=  "</small>";
                    }
                $data['body'] .= '</td>
                <td style="padding:5px 12px">
                    <img src="'.base_url().'assets/images/currency/'.$order_detail['currency_image'].'" style="width: 9.5px; margin-right: 5px;">
                    '.price_decimal($item['price'], $this->uptodecimal).'
                </td>
            </tr>';
            }
            if((!empty($order_detail['coupon_amount'])) && $order_detail['coupon_amount'] > 0){
                $data['body'] .= '<tr class="heading">
                        <td colspan="1" style="padding:5px 12px"></td>
                <td style="padding:5px 12px">
                    '.$order_detail['coupon_name'].'
                </td>
                <td style="padding:5px 12px">
                    <img src="'.base_url().'assets/images/currency/'.$order_detail['currency_image'].'" style="width: 9.5px;margin-right: 5px;">'.price_decimal($order_detail['coupon_amount'], $this->uptodecimal).'
                </td>
            </tr>';
            }
            if((!empty($order_detail['discount_amount'])) && $order_detail['discount_amount'] > 0){
                $data['body'] .= '<tr class="heading">
                        <td colspan="1" style="padding:5px 12px"></td>
                <td style="padding:5px 12px">
                    Discount
                </td>
                <td style="padding:5px 12px">
                    <img src="'.base_url().'assets/images/currency/'.$order_detail['currency_image'].'" style="width: 9.5px;margin-right: 5px;">
                    '.price_decimal($order_detail['discount_amount'], $this->uptodecimal).'
                </td>
            </tr>';
            }
            if ($order_detail['delivery_type'] == DELIVERY_TYPES_DELIVERY) {
                $data['body'] .= '<tr>
                        <td colspan="1" style="padding:5px 12px"></td>
                    <td style="padding:5px 12px">
                        Delivery charges
                    </td>
                    <td style="padding:5px 12px">
                        <img src="'.base_url().'assets/images/currency/'.$order_detail['currency_image'].'" style="width:9.5px;margin-right: 5px;">'.truncate_number($order_detail['delivery_charges'],$this->uptodecimal).'
                    </td>
                </tr>';
            }

            $data['body'] .= '<tr class="total">
                        <td colspan="1" style="padding:5px 12px 10px"></td>
                <td style="padding:5px 12px 10px"><b>Total:</b></td>
                <td style="padding:5px 12px 10px">
                    <img src="'.base_url().'assets/images/currency/'.$order_detail['currency_image'].'" style="width: 9.5px;margin-right: 5px;">
                    <b>'.$order_detail['total'].'</b>
                </td>
            </tr>';

            if(!empty($order_detail['payment_mod'])) {
            $data['body'] .= '<tr class="heading">
                <td style="padding:5px 12px" colspan="1"></td>
                <td style="padding:5px 12px">
                    Payment Method
                </td>
                <td style="padding:5px 12px">
                    '.$order_detail['payment_mod'].'
                </td>
            </tr>';
            }
        $data['body'] .= '</table>
    </td>
</tr>';

        if ($order_detail['delivery_type'] == DELIVERY_TYPES_DELIVERY) {
            $data['body'] .= '<tr>
                <td style="padding-top:30px">
                    <b>Delivery Address:</b><br/>
                    '.$order_detail['user_details']['address'].'
                </td>
            </tr><tr>
                <td style="width:100%;display:block;margin:auto;">   <br/>            
                    <p>
                       If you need help with anything please don’t hesitate to drop us an email: <a href="mailto:'.REPLY_TO.'">'.REPLY_TO.'</a>
                    </p>  
                </td>
            </tr>';
        }
        $data['body'] .= '<tr>
            <td style="width:100%;display:block;margin:auto;">   <br/>            
                <p style="'.$paraCSS.'">
                    Warm regards,<br/>
                     Team Y the Wait
                </p>  
            </td>
        </tr>
        <tr>
             <td>
                <hr style="border:0;height:20px" />
            </td>
        </tr>
    </table>
   </td>
</tr>';
$this->load->view('api/email_templates/layout/layout', $data);