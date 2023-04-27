<?php 
$paraCSS = 'font-size: 14px; padding-bottom: 20px; font-weight: normal;color:#000;text-align: left;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important;';
if(empty($reset_link)){
    $heading = 'A Warm welcome and thank you for connecting your business with us!';
    $greeting = 'Your YtheWait business account has been successfully created. All your business information has been added. You can complete adding any details of your listing at any time by logging in to your account. Your login information is given below:';
    $loginbtn = '<td style="width:100%;float:left;display:block;text-align: center;color: #000">
                    <a href="'.superadmin_url().'" style="background-color:#ff3300;font-family: \'Montserrat\', sans-serif!important;   color:#fff;padding:10px 20px;text-decoration:none;margin:0 auto;font-weight:bold;border-radius: 5px;">
                    Login
                    </a>
                </td>';

    $userid = '<td style="'.$paraCSS.'  padding-bottom:0px;  padding-top:20px;width:100%;float:left;">
                User ID: <b>'.$email_data['email'].'</b>
               </td>';

    $password = '<td style="'.$paraCSS.'  padding-bottom:0px;">
                    Temporary Password:<b>'.$email_data['password'].'</b> 
                </td>';
    if(!empty($is_staff) && $is_staff==1){
    $pin = '<td style="'.$paraCSS.'  padding-bottom:0px;">
                    Temporary pin:<b>'.$email_data['pin'].'</b> 
                </td>';
            }
    $passDisclaimer = '<tr>
                            <td style="'.$paraCSS.' padding-bottom:0px;"><br/>
                            You are free to change the computer generated password at any time by choosing the "Change Password" button on your YtheWait dashboard.<br/><br/>
                            Warm regards,<br/>
                            Team YtheWait
                            </td>
                        </tr>'; 
}else{
    $heading = 'Bedankt voor uw verzoek om uw bedrijf te registreren';
    $greeting = 'We hebben uw gegevens ontvangen en uw zakelijke YtheWait-account is aangemaakt.<br/>We verzoeken u vriendelijk het het aanmeldingsproces te voltooien te voltooien door op de onderstaande knop te drukken. Uw accountgegevens worden hieronder weergegeven:';
    $loginbtn = '';
    $userid = '<td style="'.$paraCSS.' text-align: center;">
                Gebruikers-ID: <b>'.$email_data['email'].'</b><br/>
              </td>';

    if(!empty($is_staff) && $is_staff==1){
    $pin = '<td style="'.$paraCSS.'  padding-bottom:0px;">
                    Tijdelijke pin:<b>'.$email_data['pin'].'</b> 
                </td>';
            }
    $password = '<td style="width:100%;display:block;text-align: center;color: #000">
                    <a href="'.$reset_link.'" style="background-color:#ff3300;font-family: \'Montserrat\', sans-serif!important;   color:#fff;padding:10px 20px;text-decoration:none;margin:0 auto;font-weight:bold;border-radius: 5px;">
                    Maak een nieuw wachtwoord aan
                    </a>
                </td>';
    $passDisclaimer = '<tr>
                            <td style="'.$paraCSS.' padding-bottom:0px;"><br/>
                            U kunt uw wachtwoord ook gemakkelijk wijzigen door te klikken op de optie "wachtwoord wijzigen" in uw YtheWait-dashboard.<br/><br/>
                            Hartelijke groeten,<br/>
                            Team Y THE WAIT
                            </td>
                        </tr>';
}
$pin_html = '';
if(!empty($is_staff) && $is_staff==1){
    $pin_html = '<tr>'.$pin.'</tr>';
}
$data['body'] = '<tr>
    <td>
        <table width="100%" style="font-size: 14px; padding-bottom: 20px; font-weight: normal;color:#000;text-align: left;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important; background-color: #fff">
            <tr>
                <td style="width:95%;display:block;margin:auto;color: #000">                
                <h1 style="font-size: 24px; line-height:32px;text-align:center;color:#000; font-family: \'Montserrat\', sans-serif!important; ">'.$heading.'</h1>
                    <p style="'.$paraCSS.'">
                    Beste '.$email_data["name"].',<br/><br/>
                    '.$greeting.'
                    </p>
                </td>
            </tr>
            <tr>
                '.$loginbtn.'
            </tr>
            <br>
            <tr>
                <td style="width:95%;display:block;margin:auto; font-size: 13px;color: #000">
                <table width="100%">
                    <tr>
                    <td class="pt_25" style="'.$paraCSS.'width:100%;float:left;text-align:center !important;">
                            <a href="'.superadmin_url().'" style="text-align:center;" target="_blank">'.superadmin_url().'</a>
                        </td>
                    '.$userid.'
                    </tr>
                    
                    <tr>
                    '.$password.'
                    </tr>
                    '.$pin_html.'
                    <tr>
                        <td style="">
                        <br/>
                        </td>
                    </tr>
                    '.$passDisclaimer.'
                </table>
                    
                </td>
            </tr>
        </table></td>
</tr>';
$this->load->view('api/email_templates/layout/layout', $data);