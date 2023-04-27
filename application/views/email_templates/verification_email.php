<?php 
$paraCSS = 'font-size: 14px; font-weight: normal;color:#000; line-height: 22px;font-family: \'Montserrat\', sans-serif !important;';
$data['body'] = '<tr>
   <td>
    <table style="font-size: 14px; font-weight: normal;color:#000;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important; ">
        <tr>
            <td style="width:95%;display:block;margin:auto;">   <br/>
                   
                <p style="'.$paraCSS.'">                    
                    Greetings,<br/><br/>

Restaurant '.$email_data["restaurant_name"].' has successfully submitted the proof verification documents. Kindly check the proof documents submitted.


                </p>  
            </td>
        </tr>
        
        <tr>
            <td style="width:95%;display:block;margin:auto;"><br/> <br/>       
            <p>Thank You!</p>
          
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