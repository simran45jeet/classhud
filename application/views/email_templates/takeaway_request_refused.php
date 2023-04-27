<?php

$paraCSS = 'font-size: 14px; font-weight: normal;color:#000; line-height: 22px;font-family: \'Montserrat\', sans-serif!important;';
$data['body'] = '<tr>
   <td>
    <table style="font-size: 14px; font-weight: normal;color:#000;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important; ">
        <tr>
            <td style="width:95%;display:block;margin:auto;">   <br/>
                <p style="'.$paraCSS.'">
                '.$lang_arr['dear'].' '.ucfirst($name).',<br/><br/>
                '.sprintf($lang_arr['we_regret_to_inform_you_that'], $lang_arr[$business_type]).'
                </p>  
            </td>
        </tr>
        <tr>
        <td style="width:95%;display:block;margin:auto;">   <br/>               
            <p style="'.$paraCSS.'">
            '.$lang_arr['cancel_reason'].' '.$cancellation_reason.'  </p>  
        </td>
        </tr>
         <tr>
            <td style="width:95%;display:block;margin:auto;">   <br/>            
                <p style="'.$paraCSS.'"> 
                '.$lang_arr['we_sincerely_apologize_for'].'
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