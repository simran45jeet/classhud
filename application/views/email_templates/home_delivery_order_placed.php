<?php 
$paraCSS = 'font-size: 14px; font-weight: normal;color:#000; line-height: 22px;font-family: \'Montserrat\', sans-serif!important;';
$data['body'] = '<tr>
   <td>
    <table style="font-size: 14px; font-weight: normal;color:#000;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important; ">
        <tr>
            <td style="width:95%;display:block;margin:auto;">   <br/>
            <h1 style="font-size: 24px; text-align:center;color:#000; font-family: \'Montserrat\', sans-serif!important; ">Welcome Dear!</h1>             
                <p style="'.$paraCSS.'">
                    Dear '.ucfirst($name).',<br/><br/>
                    Your Home delivery order has been received and is being freshly prepared! Our delivery boy will be ringing your doorbell anytime soon. Can’t wait? You can contact the delivery partner to know about the status of your order anytime.
                </p>  
            </td>
        </tr>
         <tr>
            <td style="width:95%;display:block;margin:auto;">   <br/>            
                <p style="'.$paraCSS.'">
                    Phone number of delivery boy <b>'.$delivery_boy_phone.'</b>
                </p>  
            </td>
        </tr>
         <tr>
            <td style="width:95%;display:block;margin:auto;">   <br/>            
                <p style="'.$paraCSS.'">
                    Address where the order will be received <i>'.$delivery_address.'</i>
                </p>  
            </td>
        </tr>
          <tr>
            <td style="width:95%;display:block;margin:auto;">   <br/>            
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