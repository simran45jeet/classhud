<?php 
$data['body'] = '<tr>
   <td>
      <table width="100%" style="margin:0 auto;max-width: 450px; ">
         <tr>
            <td style="width:100%;display:block;margin:auto;text-align: center;"><br/><br/>
               <h1 style="font-size: 24px; text-align:center;color:#000; font-family: \'Montserrat\', sans-serif!important; ">Welkom aan boord!</h1>
               <p style="font-size: 14px; padding-bottom: 20px; font-weight: normal;color:#000;text-align: center;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important; ">Bedankt voor het indienen van het registratieformulier voor YtheWait !. Klik op het onderstaande knop om uw verzoek om samen te werken met YtheWait te verifiëren.</p>
               <a clicktracking=off style="background-color:#ff3300;font-family: \'Montserrat\', sans-serif!important;   color:#fff;padding:10px 20px;text-decoration:none;margin:0 auto;font-weight:bold;border-radius: 5px;" href="'.$email_data['link'].'">Klik om te verifiëren</a><br/><br/><br/>
            </td>
         </tr>  
      </table>
   </td>
</tr>';
$this->load->view('api/email_templates/layout/layout', $data);