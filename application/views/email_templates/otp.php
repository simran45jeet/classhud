<?php 
$paraCSS = 'font-size: 14px; font-weight: normal;color:#000; line-height: 22px;font-family: \'Montserrat\', sans-serif!important;';
$data['body'] = '<tr>
   <td>
    <table style="font-size: 14px; font-weight: normal;color:#000;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important; ">
        <tr>
            <td style="width:95%;display:block;margin:auto;">   <br/>
            <h1 style="font-size: 24px; text-align:center;color:#000; font-family: \'Montserrat\', sans-serif!important; ">Verification Code</h1>             
                <p style="'.$paraCSS.'">
                    Dear User,<br/><br/>
                </p>  
            </td>
        </tr>
        <tr>
            <td style="width:95%;display:block;margin:auto;"><br/>   
            <p style="'.$paraCSS.'">We want to make sure it\'s you. Please enter this code on your device to continue purchasing your gift card.:</p>                      
                <p style="'.$paraCSS.' text-align:center"><br/>
                <a href="javascript:;" style="background-color:#ff3300;font-family: \'Montserrat\', sans-serif!important;   color:#fff;padding:10px 20px;text-decoration:none;margin:0 auto;font-weight:bold;border-radius: 5px;letter-spacing:2px;">
                '.$email_data["otp"].'
                </a>  </p>

            </td>
        </tr>
        <tr>
            <td style="width:95%;display:block;margin:auto;"><br/> <br/>   <br/>       
                <p style="'.$paraCSS.'">
                Thank You,<br/>
                Team YTheWait<br/><br/>
                <small>Note: This is a system generated email, please do not reply to this email.</small></p>
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