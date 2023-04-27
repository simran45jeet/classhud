<?php

$lang_arr = getLanguageArray($country_name_code);

$paraCSS = 'font-size: 14px; font-weight: normal;color:#000; line-height: 22px;font-family: \'Montserrat\', sans-serif!important;';
$data['body'] = '<tr>
   <td>
    <table style="font-size: 14px; font-weight: normal;color:#000;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important; ">
        <tr>
            <td style="width:95%;display:block;margin:auto;">   <br/>
            <h1 style="font-size: 24px; text-align:center;color:#000; font-family: \'Montserrat\', sans-serif!important; ">'.$lang_arr['welcome_dear'].'</h1>             
                <p style="'.$paraCSS.'">
                '.$lang_arr['dear'].' '.ucfirst($name).',<br/><br/>
                '.$lang_arr['hv_rec_takeaway_order'].' 
                </p>  
            </td>
        </tr>
         <tr>
            <td style="width:95%;display:block;margin:auto;">   <br/>            
                <p style="'.$paraCSS.'">
                '.$lang_arr['thanks_order_w_ytw'].'
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