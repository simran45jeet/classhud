<?php 
$paraCSS = 'font-size: 14px; padding-bottom: 20px; font-weight: normal;color:#000;text-align: left;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important;';
$location = array();
if( !empty($email_data['city']) ) {
    $location[] = $email_data['city'];
}
if( !empty($email_data['state']) ) {
    $location[] = $email_data['state'];
}
if( !empty($email_data['country']) ) {
    $location[] = $email_data['country'];
}
$data['body'] = '<tr>
   <td>
    <table style="font-size: 14px; font-weight: normal;color:#000;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important; ">
        <tr>
            <td style="width:95%;display:block;margin:auto;">   <br/>
            <h1 style="font-size: 24px; text-align:center;color:#000; font-family: \'Montserrat\', sans-serif!important; ">Welcome Dear!</h1>             
                <p style="'.$paraCSS.'">
                    Greetings,<br/><br/>
                    We would like to inform you that you have  "'.$email_data['first_name'].' '.$email_data['last_name'].'" wants to claim the Restaurant "'.$email_data['restaurant_name'].'" Location "'.implode(', ',$location).'" .
                </p>  
            </td>
        </tr>
        <tr>
            <td style="width:95%;display:block;margin:auto;">   <br/>            
                <p>
                    Email - "'.$email_data['email'].'"<br/>
                    Phone Number - '.$email_data['phone'].'
                </p>  
            </td>
        </tr>
          <tr>
            <td style="width:95%;display:block;margin:auto;">   <br/>            
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