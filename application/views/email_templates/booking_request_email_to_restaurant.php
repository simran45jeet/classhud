<?php
$notes = '';
 if(trim($email_data["message"]) != ""){ 
    $notes = '<tr>
    <td style="font-size:13px;">
        '.$lang_arr['bk_note_by_customer'].' '.$email_data['message'].' 
    </td>
</tr>';
}


$paraCSS = 'font-size: 14px; font-weight: normal;color:#000;text-align: left;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important;';
$data['body'] = '<tr>
   <td>
   <table width="100%">
   <tbody>
       <tr>
           <td style="width: 95%; display: block; margin: auto">      
                <h1 style="font-size: 24px; line-height:32px;text-align:center;color:#000; font-family: \'Montserrat\', sans-serif!important; ">'.$lang_arr['bk_new_request'].'</h1>          
               <p style="'.$paraCSS.'">Dear '.ucwords($email_data['name']).',<br/><br/>
               '.$lang_arr['bk_new_request_message'].'</p>
           </td>
       </tr>
       <tr>
            <td style="width:95%;display:block;margin:auto;">                
                <p align="center">'.$lang_arr['bk_request_accept_below_text'].' <br/>  <br/> 
                <a href="'.base_url().'restaurants/acceptrequest/'.urlencode(base64_encode($email_data["unique_id"])).'" style="background:#000000;font-family: \'Montserrat\', sans-serif!important;   color:#fff;padding:10px 20px;text-decoration:none;margin:0 auto;font-weight:bold;border-radius: 5px;">
                    '.$lang_arr['bk_accept'].'
                </a> &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="'.base_url().'restaurants/rejectrequest/'.urlencode(base64_encode($email_data["unique_id"])).'" style="background-color:#ff3300;font-family: \'Montserrat\', sans-serif!important;   color:#fff;padding:10px 20px;text-decoration:none;margin:0 auto;font-weight:bold;border-radius: 5px;"  
                >
                '.$lang_arr['bk_reject'].'
                </a>
            </p>
            </td>
        </tr>
       <tr>
            <th style="'.$paraCSS.' width:95%;display:block;margin:auto;text-align: center">                
            <br/>'.$lang_arr['bk_customer_request_detail'].'
            </th>
        </tr>

        <tr>
            <td>
                <hr style="border:0;height:10px" />
            </td>
        </tr>
       <tr>
           <td style="'.$paraCSS.' width:95%;display:block;margin:auto;">
               <table>
                        <tbody>
                            <tr>
                                <td style="font-size:13px;line-height:18px">
                                '.$lang_arr['contact_name'].': '.ucwords($email_data['contact_name']).'</b>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:13px;line-height:18px">
                                '.$lang_arr['contact_phone'].': <b>'.preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $email_data["contact_phone"]).'</b> 
                                </td>
                            </tr> 
                            <tr>
                                <td style="font-size:13px;line-height:18px">
                                '.$lang_arr['contact_email'].': <b>'.$email_data["contact_email"].'</b> 
                                </td>
                            </tr> 
                            <tr>
                                <td style="font-size:13px;line-height:18px">
                                    '.$lang_arr['no_of_people'].': <b>'.$email_data['no_of_persons'].'</b> 
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:13px;line-height:18px"style="font-size:13px;line-height:18px">
                                    '.sprintf($lang_arr['date_for_booking'],date('l, F d, Y', strtotime($email_data['booking_date'])),date("g:i A", strtotime($email_data['booking_time']))).' 
                                </td>
                            </tr>

                            '.$notes.'
                        </tbody>
                    </table>
           </td>
       </tr>

   </tbody>
</table>
   </td>
</tr>';
$this->load->view('api/email_templates/layout/layout', $data);