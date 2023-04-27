<?php

$paraCSS = 'font-size: 14px; font-weight: normal;color:#000; line-height: 22px;font-family: \'Montserrat\', sans-serif!important;';
$data['body'] = '<tr>
   <td>
    <table style="font-size: 14px; font-weight: normal;color:#000;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important; ">
        <tr>
            <td style="width:95%;display:block;margin:auto;">   <br/>
                <p style="'.$paraCSS.'">
                '.$lang_arr['dear'].' '.ucfirst($owner_name).',<br/><br/>
                </p>  
            </td>
        </tr>
        <tr>
        <td style="width:95%;display:block;margin:auto;">   <br/>
            <p style="'.$paraCSS.'">
                <p>
                    '.sprintf($lang_arr['accept_publish_restaurant_content'],$lang_arr[$businessType]).'
                    <br/><br/>
                </p>
                <p>
                    '.$lang_arr['member_of_sale_text'].'<br/><br/>
                </p>
            </p>  
        </td>
    </tr>
         <tr>
            <td style="width:95%;display:block;margin:auto;">   <br/>            
                <p style="'.$paraCSS.'">
                '.$lang_arr['warm_regards'].'<br/>
                '.$lang_arr['team_ytw'].'
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