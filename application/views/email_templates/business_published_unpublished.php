<?php 
$paraCSS = 'font-size: 14px; font-weight: normal;color:#000; line-height: 22px;font-family: \'Montserrat\', sans-serif !important;';


if($email_data["publishType"] == 'published'){
    $bodyTitle = sprintf($lang_arr['business_publish_title'],$lang_arr[$email_data["businessType"]]);

    $bodyText = sprintf($lang_arr['business_publish_message'],$lang_arr[$email_data["businessType"]]);
}else{
    $bodyTitle = sprintf($lang_arr['business_unpublish_title'],$lang_arr[$email_data["businessType"]]);
    $bodyText = sprintf($lang_arr['business_unpublish_message'],$lang_arr[$email_data["businessType"]]);
}
$data['body'] = '<tr>
   <td>
    <table style="font-size: 14px; font-weight: normal;color:#000;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important; ">
        <tr>
            <td style="width:95%;display:block;margin:auto;">   <br/>
            <h1 style="line-height:32px; font-size: 24px; text-align:center;color:#000; font-family: \'Montserrat\', sans-serif!important; ">'.$bodyTitle.'</h1>             
                <p style="'.$paraCSS.'">
                    '.$lang_arr['dear'].' '.$email_data["name"].',<br/><br/>
                    '.$bodyText.$lang_arr['connect_technical_team'].'.
                </p>  
            </td>
        </tr>
        <tr>
            <td style="width:95%;display:block;margin:auto;">
            <p style="'.$paraCSS.'"><br/>
                '.ucfirst($lang_arr[$email_data["businessType"]]).' '.$lang_arr['name'].' <b>'.$email_data['restaurant_name'].'</b>
            </p>
            </td>
            </tr>
        <tr>
            <td style="width:95%;display:block;margin:auto;"><br/> <br/>       
                <p style="'.$paraCSS.'">'.$lang_arr['system_generated_email'].'<br/>
                '.$lang_arr['thank_you'].'<br/>
                '.$lang_arr['team_ytw'].'</p>
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