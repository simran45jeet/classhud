<?php 
$html = '<table>
<tr>
    <th>Sr.no</th>
    <th>Name</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Total</th>
</tr>';
$i = 1; foreach($order_items as $rec):
    if($rec['is_item_prepared'] == 1):

        $html .= '<tr>
            <td>'.$i.'</td>
            <td>'.$rec['name'].'</td>
            <td>'.$rec['quantity'].'</td>
            <td>'.$rec['item_price'].'</td>
            <td>'.$rec['price'].'</td>
        </tr>';
$i++;
    endif;
endforeach; 

$html .= '</table>
<h4>These Items are not available sorry for inconvience.</h4>
<table>
<tr>
    <th>Sr.no</th>
    <th>Name</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Total</th>
</tr>';
    $i = 1; foreach($order_items as $rec):
    if($rec['is_item_prepared'] == 0):
    
        $html .= ' <tr>
            <td>'.$i.'</td>
            <td>'.$rec['name'].'</td>
            <td>'.$rec['quantity'].'</td>
            <td>'.$rec['item_price'].'</td>
            <td>'.$rec['price'].'</td>
        </tr>';
$i++;
    endif;
endforeach; 
$html .=   '</table>';

$paraCSS = 'font-size: 14px; font-weight: normal;color:#000; line-height: 22px;font-family: \'Montserrat\', sans-serif !important;';
$data['body'] = '<tr>
   <td>
    <table style="font-size: 14px; font-weight: normal;color:#000;line-height: 22px;font-family: \'Montserrat\', sans-serif!important; " width="100%">
        <tr>
            <td style="width:95%;display:block;margin:auto;">   <br/>
            <h1 style="line-height:32px; font-size: 24px; text-align:center;color:#000; font-family: \'Montserrat\', sans-serif!important; ">Order has been completed.</h1>             
                <p style="'.$paraCSS.'">
                    Dear '.$user_name.',<br/><br/>
                    '.$subject.'
                </p>  
            </td>
        </tr>
        <tr>
            <td style="width:95%;display:block;margin:auto;">   <br/>
            '. $html .'
        </tr>
        <tr>
            <td style="width:95%;display:block;margin:auto;"><br/> <br/>       
                <p style="'.$paraCSS.'">This is your a generated email, please do not reply to this email.<br/>
                Thank You,<br/>
                Team YTheWait</p>
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