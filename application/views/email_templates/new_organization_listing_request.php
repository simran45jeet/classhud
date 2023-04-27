<?php 
$paraCSS = 'font-size: 14px; font-weight: normal;color:#000;text-align: left;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif !important;';
$data['body'] = '<tr>
   <td>
      <table width="100%" style="font-family: \'Montserrat\', sans-serif !important;">
        <tr>
            <td style="width:95%;display:block;margin:auto;">
            <h1 style="width:100%;font-size: 24px; line-height:32px;text-align:center;color:#000; font-family: \'Montserrat\', sans-serif !important; ">New Donation Organization listing requrest.</h1>  
                <p style="'.$paraCSS .'">Dear '.ucwords($email_data["user_first_name"].' '.$email_data["user_last_name"]).',<br/><br/> You have recieved a new Donation Organization listing request, details are as below:<br/><br/></p>          
            </td>
        </tr>
        <tr>
            <td style="width:95%;display:block;margin:auto;text-align: left">
            <table>
                <tr>
                    <td style="'.$paraCSS .'">
                    Organization Name: <b>'.$email_data['restaurant_name'].'</b>
                    </td>
                </tr>
                <tr>
                    <td style="'.$paraCSS .'">
                    Contact Person: <b>'.ucwords($email_data['first_name'].' '.$email_data['last_name']).'</b>
                    </td>
                </tr>
                <tr>
                    <td style="'.$paraCSS .'">
                    Phone: <b>'.$email_data['phone'].' '.$email_data['restaurant_phone'].'</b>
                    </td>
                </tr>
                <tr>
                    <td style="'.$paraCSS .'">
                    Email:  <b>'.$email_data['email'].'</b>
                    </td>
                </tr>
                <tr>
                    <td style="'.$paraCSS .'">
                    Address: <b>'.$email_data['house_no'].', '.$email_data['address'].', '.$email_data['city'].', '.$email_data['state'].', '.$email_data['country'].' - '.$email_data['pincode'].'</b>
                    </td>
                
                   
                </tr>
                <tr>    
                <td style="'.$paraCSS .'">
                    Website:  <b>'.$email_data['website'].'</b>
                    </td>
                </tr>
                <tr><td></td>
                </tr>
                <br>

                <tr>
                    <td style="'.$paraCSS .'">
                    <br/>
                    </td>
                </tr>
                <tr>
                    <td style="'.$paraCSS .'">
                    This is a system generated email, please do not reply to this email.<br/>
                    Thank You,<br/>
                    Team YTheWait
                    </td>
                </tr>
                            
            </table>

            </td>
        </tr>
        
    </table>
   </td>
</tr>';
$this->load->view('api/email_templates/layout/layout', $data);