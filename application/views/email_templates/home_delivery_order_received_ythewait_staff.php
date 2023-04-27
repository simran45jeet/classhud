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
                <h1 style="font-size: 24px; padding-top:12px;text-align:center;color:#000; font-family: \'Montserrat\', sans-serif!important; ">Welcome Y The Wait</h1>             
                <p style="padding:12px 0px;">
                    Dear Team,
                </p>  
            </td>
        </tr>
            <tr class="top">
                <td colspan="5">
                    <table style="width:100%">
                        <tr>                            
                            <td class="right" style="line-height: 22px;">
                                This is to notify you that Restaurant <b>'.$name.'</b> located at <b>'.$rest_address.'</b> has received a new <b>'.ucwords($delivery_type).'</b> order. The order number is <b>'.$order_detail['other_details']->invoice_number.'</b>, invoice number is <b>'.$order_detail['other_details']->invoice_id.'</b> and order was placed on <b>'.date(DEFAULT_DATE_FORMAT,strtotime($order_detail['created_on'])).'</b> At:<b> '.date(DEFAULT_PRINT_TIME_FORMAT,strtotime($order_detail['created_on'])).'</b>
                            </td>
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
                    <img src="'.base_url().'assets/images/currency/'.$order_detail['currency_image'].'" style="margin-right: 5px;width: 9.5px;">
                    '.price_decimal($item['price'], $this->uptodecimal).'
                </td>
            </tr>';
            }
            /*if (!empty($order_detail['taxes'])) {
                foreach ($order_detail['taxes'] as $tax) {
                    $data['body'] .= '<tr>
                        <td colspan="1" style="padding:5px"></td>
                        <td style="padding:5px">
                            '.$tax['tax_name'].' ('.truncate_number($tax['tax_rate'],$this->uptodecimal).'%)';
                            if(!empty($tax['tax_group'])){
                                foreach ($tax['tax_group'] as $tax_group) {
                                    $data['body'] .= "<small>".$tax_group['tax_name']." (".$tax_group['tax_rate'].") : <img src='".base_url()."assets/images/currency/".$order_detail['currency_image']."' style='height:10px'>".truncate_number($tax_group['tax_amount'],$this->uptodecimal)."</small><br >";
                                }
                            } 
                        $data['body'] .='</td>
                        <td style="padding:5px">
                            
                            <img src="'.base_url().'assets/images/currency/'.$order_detail['currency_image'].'" style="width:9.5px">'.truncate_number($tax['tax_amount'],$this->uptodecimal).'
                        </td>
                    </tr>';
                }
            }*/
            if((!empty($order_detail['coupon_amount'])) && $order_detail['coupon_amount'] > 0){
                $data['body'] .= '<tr class="heading">
                        <td colspan="1" style="padding:5px 12px"></td>
                <td style="padding:5px 12px">
                    Coupon: '.$order_detail['coupon_name'].'
                </td>
                <td style="padding:5px 12px">
                    <img src="'.base_url().'assets/images/currency/'.$order_detail['currency_image'].'" style="margin-right: 5px;width: 9.5px;">(-)'.price_decimal($order_detail['coupon_amount'], $this->uptodecimal).'
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
                    <img src="'.base_url().'assets/images/currency/'.$order_detail['currency_image'].'" style="margin-right: 5px;width: 9.5px;">
                    (-)'.price_decimal($order_detail['discount_amount'], $this->uptodecimal).'
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
                        <td colspan="1" style="padding:5px 12px"></td>
                <td style="padding:5px 12px 10px"><b>Total:</b></td>
                <td style="padding:5px 12px 10px">
                    <img src="'.base_url().'assets/images/currency/'.$order_detail['currency_image'].'" style="margin-right: 5px;width: 9.5px;">
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
            </tr>
            <tr>
                <td style="padding-top:30px">
                    <b>Delivery Time: '.date(DEFAULT_DATE_FORMAT,strtotime($order_detail['delivery_date_time'])).'</b> At:<b> '.date(DEFAULT_PRINT_TIME_FORMAT,strtotime($order_detail['delivery_date_time'])).'</b>
                </td>
            </tr>';
        }
        $data['body'] .= '<tr>
            <td style="width:100%;display:block;margin:auto;">   <br/>            
                <p>You can contact the restaurant by phone on <b>'.$rest_phone.'</b> or via email at  <b>'.$email.'</b>
                </p>  
            </td>
        </tr>
          <tr>
            <td style="width:100%;display:block;margin:auto;">   <br/>            
                <p style="'.$paraCSS.'">
                    Regards,<br/>
                    Y THE WAIT
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