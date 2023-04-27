<?php 
$paraCSS = 'font-size: 14px; font-weight: normal;color:#000; line-height: 22px;font-family: \'Montserrat\', sans-serif!important;';
$data['body'] = '<tr>
   <td>
    <table style="font-size: 14px; font-weight: normal;color:#000;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important; ">
        <tr>
            <td style="width:95%;display:block;margin:auto;">   <br/>
            <h1 style="font-size: 24px; text-align:center;color:#000; font-family: \'Montserrat\', sans-serif!important; ">Welcome ON BOARD!</h1>             
                <p style="'.$paraCSS.'">
                    Hello Team YTW,<br/><br/>
                    This is to notify you that '.$email_data['gift_card']['email'].' from '.$email_data['gift_card']['country'].' has bought a Gift card worth '.$email_data['currency']['symbol'].$email_data['gift_card']['total'].'. 
                </p>  
            </td>
        </tr>
        <tr>
            <td style="width:95%;display:block;margin:auto;"><br/>        
                <p style="'.$paraCSS.'">Gift Card Details:</p>
                <p style="'.$paraCSS.'">'.$email_data['gift_card']['quantity'].' Gift Cards worth '.$email_data['currency']['symbol'].$email_data['gift_card']['amount'].' each</p><br/>
                <p style="'.$paraCSS.'">Thanks</p>
                <p style="'.$paraCSS.' text-align:center"><br/></p>

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