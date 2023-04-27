<?php 
$paraCSS = 'font-size: 14px; padding-bottom: 20px; font-weight: normal;color:#000;text-align: left;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important;';
$location = array('address'=>$email_data['address']);

if( !empty($email_data['city']) ) {
    $location['city'] = $email_data['city'];
}
if( !empty($email_data['state']) ) {
    $location['state'] = $email_data['state'];
}
if( !empty($email_data['country']) ) {
    $location['country'] = $email_data['country'];
}

$delivery_address_html = $delivery_cost_html = '';
if( $email_data['delivery_type'] == DELIVERY_TYPES_DELIVERY ) {
    $delivery_cost_html = 'Delivery costs: '.$email_data['delivery_cost'].'<br/>';
    $delivery_address_html = '<tr><td style="width:95%;display:block;margin:auto;"><p>Delivery Address: '.$email_data['delivery_address'].'<br/>Delivery time: '.$email_data['delivery_time'].'</p></td></tr>';
}
$data['body'] = '<tr>
   <td>
    <table style="font-size: 14px; font-weight: normal;color:#000;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important; ">
        <tr>
            <td style="width:95%;display:block;margin:auto;"><br/>   
                <p style="'.$paraCSS.'">
                    Hi Team,<br/><br/>
                    This is to notify you that Restaurant '.stripcslashes($email_data['restaurant_name']).' located at '.implode(', ',$location).' has received a new home delivery order. <br/>The order number is '.$email_data['order_id'].', invoice number is '.$email_data['invoice_id'].' and order was placed on '.$email_data['delivery_time'].'<br/><br/>

                    Refer below for complete order details:

                </p>  
            </td>
        </tr>
        <tr>
            <td style="width:95%;display:block;margin:auto;"> <br/>
                <p>
                    '.$delivery_cost_html.'
                    Total amount: '.$email_data['order_total'].'<br/>
                    Payment method: '.$email_data['payment_method'].'<br/>
                </p>  
            </td>
        </tr>
        '.$delivery_address_html.'
        <tr>
            <td style="width:95%;display:block;margin:auto;"><br/>
                <p>
                    You can contact the restaurant by phone on '.$email_data['restaurant_phone'].' or via email at '.$email_data['restaurant_email'].'
                </p>
            </td>
        </tr>
        <tr>
            <td style="width:95%;display:block;margin:auto;"><br/>
                <p>
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