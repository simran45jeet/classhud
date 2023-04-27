<?php 
$paraCSS = 'font-size: 14px; font-weight: normal;color:#000;text-align: left;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif !important;';
$data['body'] = '<tr>
   <td>
      <table width="100%" style="font-family: \'Montserrat\', sans-serif !important;">
        <tr>
            <td style="width:95%;display:block;margin:auto;">
            <h1 style="width:100%;font-size: 24px; line-height:32px;text-align:center;color:#000; font-family: \'Montserrat\', sans-serif !important; ">Recover Password</h1>  
                <p style="'.$paraCSS .'">Dear '.$email_data["name"].',<br/><br/>We have received a request to reset password for your YTheWait account. Please follow the link below for resetting your password::<br/><br/></p>          
            </td>
        </tr>
        <tr>
            <td style="width:95%;display:block;margin:auto;text-align: center">                
                <a href="'.$email_data['recover_link'].'" style="background-color:#ff3300;font-family: \'Montserrat\', sans-serif!important;   color:#fff;padding:10px 20px;text-decoration:none;margin:0 auto;font-weight:bold;border-radius: 5px;letter-spacing:1px;">
                Recover password
                </a> 
            </td>
        </tr>
        <tr>
            <td style="width:95%;display:block;margin:auto;"><br/> <br/>       
                <p style="'.$paraCSS.'">This is a system generated email, please do not reply to this email.<br/>
                Thank You,<br/>
                Team YTheWait</p>
            </td>
        </tr>
    </table>
   </td>
</tr>';
$this->load->view('api/email_templates/layout/layout', $data);