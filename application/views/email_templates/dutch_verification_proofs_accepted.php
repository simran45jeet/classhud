<?php 
$paraCSS = 'font-size: 14px; font-weight: normal;color:#000; line-height: 22px;font-family: \'Montserrat\', sans-serif !important;';
$data['body'] = '<tr>
   <td>
    <table style="font-size: 14px; font-weight: normal;color:#000;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important; ">
        <tr>
            <td style="width:95%;display:block;margin:auto;">   <br/>
            <h1 style="line-height:32px; font-size: 24px; text-align:center;color:#000; font-family: \'Montserrat\', sans-serif!important; ">Gefeliciteerd jouw bedrijf is toegevoegd aan onze vermelding!</h1>             
                <p style="'.$paraCSS.'">
                    Dear '.$email_data["name"].',<br/><br/>
                    Your business is successfully added to our listing. Once again, welcome to the Ythewait family! for more information, you can connect with the technical team. 
                </p>  
            </td>
        </tr>
        <tr>
            <td style="width:95%;display:block;margin:auto;">
            <p style="'.$paraCSS.'"><br/>
                Restaurant Name: <b>'.$email_data['restaurant_name'].'</b>
            </p>
            </td>
            </tr>
        <tr>
            <td style="width:95%;display:block;margin:auto;"><br/> <br/>       
                <p style="'.$paraCSS.'">It\'s a system generated email so please do not reply to this email.<br/>
                Thank You,<br/>
                Team YTheWait</p>
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