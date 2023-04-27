<?php 
$paraCSS = 'font-size: 14px; font-weight: normal;color:#000;text-align: left;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif !important;';
$data['body'] = '<tr>
   <td>
      <table width="100%" style="font-family: \'Montserrat\', sans-serif !important;">
        <tr>
            <td style="width:95%;display:block;margin:auto;">
            <h1 style="width:100%;font-size: 24px; line-height:32px;text-align:center;color:#000; font-family: \'Montserrat\', sans-serif !important; ">Reset Password</h1>  
                <p style="'.$paraCSS .'">Dear '.$email_data["first_name"] . ' ' . $email_data["last_name"].',<br/><br/>We have received a request to reset password for your YTheWait account:<br/><br/></p>          
            </td>
        </tr>
        <tr>
            <td style="width:95%;display:block;margin:auto;text-align: center">                
                <p style="'.$paraCSS .'">Your temporary password is : <strong>'.$email_data["new_password"].'</strong> <br/><br/></p> 
                
            </td>
        </tr>
        <tr>
            <td style="width:95%;display:block;margin:auto;text-align: center">
                <p style="'.$paraCSS .'">
                    Please login to your account using the temporary password than delete this email and change your password from temporary password to new one for security reasons.     
                </p>
            </td>
        </tr>
    </table>
   </td>
</tr>';
$this->load->view('api/email_templates/layout/layout', $data);