<?php 
$paraCSS = 'font-size: 14px; font-weight: normal;color:#000; line-height: 22px;font-family: \'Montserrat\', sans-serif!important;';
$data['body'] = '<tr>
   <td>
    <table style="font-size: 14px; font-weight: normal;color:#000;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important; ">
        <tr>
            <td style="width:95%;display:block;margin:auto;">   <br/>
            <h1 style="font-size: 24px; text-align:center;color:#000; font-family: \'Montserrat\', sans-serif!important; ">Welcome ON BOARD!</h1>             
                <p style="'.$paraCSS.'">
                    Dear '.$email_data["name"].',<br/><br/>
                    Welcome to Y The Wait Community! Your account has been created. You are one step away from activating your account.
                </p>  
            </td>
        </tr>
        <tr>
            <td style="width:95%;display:block;margin:auto;"><br/>        
                <p style="'.$paraCSS.'">Enter this activation code on your device to activate your account:</p>
                 
                <p style="'.$paraCSS.' text-align:center"><br/>
                <a href="javascript:;" style="background-color:#ff3300;font-family: \'Montserrat\', sans-serif!important;   color:#fff;padding:10px 20px;text-decoration:none;margin:0 auto;font-weight:bold;border-radius: 5px;letter-spacing:2px;">
                '.$email_data["account_verified_code"].'
                </a>  </p>

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