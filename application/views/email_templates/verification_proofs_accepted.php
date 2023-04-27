<?php 
$paraCSS = 'font-size: 14px; font-weight: normal;color:#000; line-height: 22px;font-family: \'Montserrat\', sans-serif !important;';
$data['body'] = '<tr>
   <td>
    <table style="font-size: 14px; font-weight: normal;color:#000;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important; ">
        <tr>
            <td style="width:95%;display:block;margin:auto;">   <br/>
            <h1 style="line-height:32px; font-size: 24px; text-align:center;color:#000; font-family: \'Montserrat\', sans-serif!important; ">'.$lang_arr["proof_verification_welcome_message"].'</h1>             
                <p style="'.$paraCSS.'">
                     '.$lang_arr["dear"]." ".$email_data["name"].',<br/><br/>
                    '.$lang_arr['proof_verification_message'].'
                </p>  
            </td>
        </tr>
        <tr>
            <td style="width:95%;display:block;margin:auto;">
            <p style="'.$paraCSS.'"><br/>
                '.$lang_arr['restaurant'].$lang['name'].': <b>'.$email_data['restaurant_name'].'</b>
            </p>
            </td>
            </tr>
        <tr>
            <td style="width:95%;display:block;margin:auto;"><br/> <br/>       
             
                 <p style="'.$paraCSS.'">
                '.$lang_arr['system_generated_email'].'<br/>
                '.$lang_arr['warm_regards'].'<br/>
                '.$lang_arr['team_ytw'].'<br/>
                support@ythewait.com www.ythewait.com
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