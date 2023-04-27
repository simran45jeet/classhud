<?php
$paraCSS = 'font-size: 14px; font-weight: normal;color:#000;text-align: left;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important;';
$data['body'] = '<tr>
<td>
    <table width="100%" style="font-size: 14px; padding-bottom: 20px; font-weight: normal;color:#000;text-align: left;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important; background-color: #fff">
        <tr>
            <td style="width:95%;display:block;margin:auto;color: #000">                
            <h1 style="font-size: 24px; line-height:32px;text-align:center;color:#000; font-family: \'Montserrat\', sans-serif!important; ">Thanks for Your Request to Listing your Organization</h1>
                <p style="'.$paraCSS.'">
                    Dear '.$email_data["name"].',<br/><br/>
                    Your YTheWait Organization account has been created. We have received your Organization details. Kindly complete the Organization creation process by clicking on Login button. Your account details are as below:
                </p>
            </td>
        </tr>
        <tr>
            <td style="width:100%;display:block;text-align: center;color: #000"><br/>
                <a href="'.superadmin_url().'" style="background-color:#ff3300;font-family: \'Montserrat\', sans-serif!important;   color:#fff;padding:10px 20px;text-decoration:none;margin:0 auto;font-weight:bold;border-radius: 5px;display: inline-block;">
                Login
                </a>
            </td>
        </tr>
        <tr>
            <td style="width:95%;display:block;margin:auto; font-size: 13px;color: #000">
            <table width="100%">
                <tr>
                <td style="'.$paraCSS.'  padding-bottom:0px;  padding-top:20px;">
                User ID: <b>'.$email_data['email'].'</b>
               </td>
                </tr>
                
                <tr>
                <td style="'.$paraCSS.'  padding-bottom:0px;">
                    Temporary Password:<b>'.$email_data['password'].'</b> 
                </td>
                </tr>
                <tr>
                    <td style="">
                    <br/>
                    </td>
                </tr>
                <tr>
                    <td style="'.$paraCSS.' padding-bottom:0px;"><br/>
                    You are free to change the computer generated password at any time by choosing the "Change Password" button on your YtheWait dashboard.<br/><br/>
                    Warm regards,<br/>
                    Team YtheWait
                    </td>
                </tr>
            </table>
                
            </td>
        </tr>

    </table></td>
</tr>';
$this->load->view('api/email_templates/layout/layout', $data);