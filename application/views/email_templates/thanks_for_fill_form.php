<?php 
$paraCSS = 'font-size: 14px; font-weight: normal;color:#000; line-height: 22px;font-family: \'Montserrat\', sans-serif!important;';
$data['body'] = '<tr>
   <td>
    <table style="font-size: 14px; font-weight: normal;color:#000;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important; ">
        <tr>
            <td style="width:95%;display:block;margin:auto;">   <br/>
            <h1 style="font-size: 24px; text-align:center;color:#000; font-family: \'Montserrat\', sans-serif!important; ">Welcome Dear!</h1>             
                <p style="'.$paraCSS.'">
                   Dear '.ucfirst($name).',<br/><br/>
                    Thank you for placing your trust in us again.
                </p>  
            </td>
        </tr>
         <tr>
            <td style="width:95%;display:block;margin:auto;">   <br/>            
                <p style="'.$paraCSS.'">
                   We have received your filled-in registration form for <b>“'.$restaurant_name.'”</b>. We will look into your request and get it verified as quickly as possible. 
                </p>  
            </td>
        </tr>
         <tr>
            <td style="width:95%;display:block;margin:auto;">   <br/>            
                <p style="'.$paraCSS.'">
                  The primary owner id of this restaurant will be <i><b>"'.$email.'"</b></i> and all future updates and information related to the restaurants under this ID will be sent to this email address.<br/><br/>
                  We are excited and look forward to working together with you again. Please let us know if there is anything else we can help you with.
                </p>  
            </td>
        </tr>
          <tr>
            <td style="width:95%;display:block;margin:auto;">   <br/>            
                <p style="'.$paraCSS.'">
                    Kind regards,<br/>
                     Team Y the Wait
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