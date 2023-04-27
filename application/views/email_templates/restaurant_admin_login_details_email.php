<?php 
$paraCSS = 'font-size: 14px; padding-bottom: 20px; font-weight: normal;color:#000;text-align: left;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important;';
if(empty($reset_link)){
    $heading = $lang_arr['welcome_connect_heading_message'];
    $greeting = $lang_arr['account_success_created_greeting_message'];
    $loginbtn = '<td style="width:100%;float:left;display:block;text-align: center;color: #000">
                    <a href="'.superadmin_url().'" style="background-color:#ff3300;font-family: \'Montserrat\', sans-serif!important;   color:#fff;padding:10px 20px;text-decoration:none;margin:0 auto;font-weight:bold;border-radius: 5px;">
                    '.$lang_arr['login_submit_btn'].'
                    </a>
                </td>';

    $userid = '<td style="'.$paraCSS.'  padding-bottom:0px;  padding-top:20px;width:100%;float:left;">
                '.$lang_arr['user_id_label'].' <b>'.$email_data['email'].'</b>
               </td>';

    $password = '<td style="'.$paraCSS.'  padding-bottom:0px;">
                    '.$lang_arr['temp_password_label'].'<b>'.$email_data['password'].'</b> 
                </td>';
    if(!empty($is_staff) && $is_staff==1){
        $pin = '<td style="'.$paraCSS.'  padding-bottom:0px;">  
                        '.$lang_arr['temp_pin_label'].'<b>'.$email_data['pin'].'</b> 
                    </td>';
    }
    $passDisclaimer = '<tr>
                            <td style="'.$paraCSS.' padding-bottom:0px;"><br/>
                            '.$lang_arr['change_password_message'].'<br/><br/>
                            '.$lang_arr['warm_regards'].'<br/>
                            '.$lang_arr['team_ytw'].'
                            </td>
                        </tr>'; 
}else{
    $heading = $lang_arr['thanks_for_request_to_list_business_heading'];
    
    $greeting = $lang_arr['receive_your_details_greetings'];
    $loginbtn = '';
    $userid = '<td style="'.$paraCSS.' text-align: center;">
                '.$lang_arr['user_id_label'].' <b>'.$email_data['email'].'</b><br/>
              </td>';
    if(!empty($is_staff) && $is_staff==1){
        /*$pin = '<td style="'.$paraCSS.'  padding-bottom:0px;">
                    '.$lang_arr['temp_pin_label'].'<b>'.$email_data['pin'].'</b> 
                </td>';*/
    }
    $password = '<td style="width:100%;display:block;text-align: center;color: #000">
                    <a href="'.$reset_link.'" style="background-color:#ff3300;font-family: \'Montserrat\', sans-serif!important;   color:#fff;padding:10px 20px;text-decoration:none;margin:0 auto;font-weight:bold;border-radius: 5px;">
                    '.$lang_arr['create_new_password'].'
                    </a>
                </td>';
    $passDisclaimer = '<tr>
                            <td style="'.$paraCSS.' padding-bottom:0px;"><br/>
                            '.$lang_arr['also_change_password_from_dashboard'].'<br/><br/>
                            '.$lang_arr['warm_regards'].'<br/>
                            '.$lang_arr['team_ytw'].'
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
                    Dear '.$email_data["name"].',<br/><br/>
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