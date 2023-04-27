<?php  

if($order_detail['delivery_type'] == DELIVERY_TYPES_DELIVERY){
    $type = $lang_arr['home_delivery_order'];
}else{
    $type = $lang_arr['takeaway_order'];
}

$paraCSS = 'font-size: 14px; font-weight: normal;color:#000; line-height: 22px;font-family: \'Montserrat\', sans-serif!important;';
$data['body'] = '<tr>
   <td>
    <table style="font-size: 14px; font-weight: normal;color:#000;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important; ">
<tr>
    <td>
        <table style="width: 100%;padding: 0px;">
        <tr>
            <td colspan="5">
                <h1 style="font-size: 24px; padding-top:12px;text-align:center;color:#000; font-family: \'Montserrat\', sans-serif!important; ">'.$lang_arr['welcome_dear'].'</h1>             
                
            </td>
        </tr>
            <tr class="top">
                <td colspan="5">
                    <table style="width:100%">
                        <tr>                            
                            <td class="right" style="line-height: 22px;">
                            <p style="'.$paraCSS.'padding-bottom:30px">
                             '.$lang_arr['hi'].' '.ucfirst($name).',<br/><br/>
                            '.$lang_arr['thanks_for_your_order'].'<br />
                            '.sprintf($lang_arr['order_confirmed_message'],$type,$order_detail['other_details']->invoice_number,$order_detail['other_details']->invoice_id).' 
                        </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            </table>

            <table class="table_border" style="width: 100%;padding: 5px;background-color:#f2f2f2">
            <tr class="heading">
                <td style="text-align: left;padding:10px 12px;color:#000;font-size:14px">
                    <b>'.$lang_arr['qty'].'</b>
                </td>
                <td style="text-align: left;padding:10px 12px;color:#000;font-size:14px">
                    <b>'.$lang_arr['item'].'</b>
                </td>
                <td style="padding:10px 12px;color:#000;font-size:14px">
                    <b>'.$lang_arr['total_price'].'</b>
                </td>
            </tr>';
            foreach($order_detail['data'] as $item){
            $data['body'] .= '<tr class="item">
                <td class="qty" style="text-align: left;padding:5px 12px;color:#000;font-size:14px">
                    '.$item['quantity'].'
                </td>
                <td style="text-align: left;padding:5px 12px;color:#000;font-size:14px">
                    '.$item['food_item_name'];
                    if(!empty($item['attributes_new'])){
                        $data['body'] .=  "<br><small>";
                        foreach ($item['attributes_new'] as $attributes_new) {
                            $data['body'] .=  $attributes_new['name']." : <img src='".base_url()."assets/images/currency/".$order_detail['currency_image']."' style='width:9.5px;margin-right:5px;'>".$attributes_new['price']."<br >";
                        }
                        $data['body'] .=  "</small>";
                    }
                $data['body'] .= '</td>
                <td style="padding:5px 12px;color:#000;font-size:14px">
                    <img src="'.base_url().'assets/images/currency/'.$order_detail['currency_image'].'" style="width: 9.5px;margin-right:5px;">
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
                            
                            <img src="'.base_url().'assets/images/currency/'.$order_detail['currency_image'].'" style="width:9.5px;margin-right:5px;">'.truncate_number($tax['tax_amount'],$this->uptodecimal).'
                        </td>
                    </tr>';
                }
            }*/
            if((!empty($order_detail['coupon_amount'])) && $order_detail['coupon_amount'] > 0){
                $data['body'] .= '<tr class="heading">
                        <td colspan="1" style="padding:5px 12px;color:#000;font-size:14px">'.$lang_arr['coupon_name'].':</td>
                <td style="padding:5px 12px;color:#000;font-size:14px">
                    '.$order_detail['coupon_name'].'
                </td>
                <td style="padding:5px 12px;color:#000;font-size:14px">
                    <img src="'.base_url().'assets/images/currency/'.$order_detail['currency_image'].'" style="width: 9.5px;margin-right:5px;">'.price_decimal($order_detail['coupon_amount'], $this->uptodecimal).'
                </td>
            </tr>';
            }
            if((!empty($order_detail['discount_amount'])) && $order_detail['discount_amount'] > 0){
                $data['body'] .= '<tr class="heading">
                        <td colspan="1" style="padding:5px 12px;color:#000;font-size:14px"></td>
                <td style="padding:5px 12px;color:#000;font-size:14px">
                    '.$lang_arr['discount'].'
                </td>
                <td style="padding:5px 12px;color:#000;font-size:14px">
                    <img src="'.base_url().'assets/images/currency/'.$order_detail['currency_image'].'" style="width: 9.5px;margin-right:5px;">
                    '.price_decimal($order_detail['discount_amount'], $this->uptodecimal).'
                </td>
            </tr>';
            }
            if ($order_detail['delivery_type'] == DELIVERY_TYPES_DELIVERY) {
                $data['body'] .= '<tr>
                        <td colspan="1" style="padding:5px 12px;color:#000;font-size:14px"></td>
                    <td style="padding:5px 12px;color:#000;font-size:14px">
                        '.$lang_arr['delivery_charges'].'
                    </td>
                    <td style="padding:5px 12px;color:#000;font-size:14px">
                        <img src="'.base_url().'assets/images/currency/'.$order_detail['currency_image'].'" style="width:9.5px;margin-right:5px;">'.truncate_number($order_detail['delivery_charges'],$this->uptodecimal).'
                    </td>
                </tr>';
            }

            $data['body'] .= '<tr class="total">
                        <td colspan="1" style="padding:5px 12px 10px;"></td>
                <td style="padding:5px 12px 10px;color:#000;font-size:14px"><b>'.$lang_arr['total'].':</b></td>
                <td style="padding:5px 12px 10px;color:#000;font-size:14px">
                    <img src="'.base_url().'assets/images/currency/'.$order_detail['currency_image'].'" style="width: 9.5px;margin-right:5px;">
                    <b>'.$order_detail['total'].'</b>
                </td>
            </tr>';

            if(!empty($order_detail['payment_mod'])) {
            $data['body'] .= '<tr class="heading">
                        <td colspan="1" style="padding:5px 12px"></td>
                <td style="padding:5px 12px;color:#000;font-size:14px">
                    '.$lang_arr['payment_method'].'
                </td>
                <td style="padding:5px 12px;color:#000;font-size:14px">
                    '.$order_detail['payment_mod'].'
                </td>
            </tr>';
            }
            $data['body'] .= '<tr class="heading">
                <td style="padding:5px 12px" colspan="1"></td>
                <td style="padding:5px 12px">
                    Paid Amount
                </td>
                <td style="padding:5px 12px">
                    '.truncate_number($order_detail['payments'][0]['total']).'
                </td>
            </tr>';
        $data['body'] .= '</table>
    </td>
</tr>';

            if ($order_detail['delivery_type'] == DELIVERY_TYPES_DELIVERY) {
                $data['body'] .= '<tr>
                    <td style="padding-top:30px;color:#000;font-size:14px">
                        <b>'.$lang_arr['delivery_address'].':</b><br/>
                        '.$order_detail['user_details']['address'].'
                    </td>
                </tr>
                <tr>
                    <td style="padding-top:30px;color:#000;font-size:14px">
                        <b>'.$lang_arr['delivery_time'].': '.date(DEFAULT_DATE_FORMAT,strtotime($order_detail['delivery_date_time'])).'</b> '.$lang_arr['at'].':<b> '.date(DEFAULT_PRINT_TIME_FORMAT,strtotime($order_detail['delivery_date_time'])).'</b>
                    </td>
                </tr><tr>
                    <td style="padding-top:30px;color:#000;font-size:14px">
                        '.$lang_arr['order_confirm_restaurant_note'].'
                    </td>
                </tr>';
            }
            if (!empty($order_detail['remarks'])) {
                $data['body'] .= '<tr>
                    <td style="padding-top:30px;color:#000;font-size:14px">
                        <b>'.$lang_arr['remarks'].':</b><br/>
                        '.$order_detail['remarks'].'
                    </td>
                </tr>';
            }
        $data['body'] .= '<tr>
            <td style="width:100%;display:block;margin:auto;">   <br/>            
                <p>'.sprintf($lang_arr['any_query'],$rest_phone).'</b>
                </p>  
            </td>
        </tr>
          <tr>
            <td style="width:100%;display:block;margin:auto;">   <br/>            
                <p style="'.$paraCSS.'">
                    '.$lang_arr['enjoy_your_meal'].'
                </p>  
            </td>
        </tr>
        <tr>
            <td style="width:100%;display:block;margin:auto;">   <br/>            
                <p style="'.$paraCSS.'">
                    '.$lang_arr['regards'].'
                    <br/>
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