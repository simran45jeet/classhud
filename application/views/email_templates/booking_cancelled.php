<?php
    $rest_row_single = $this->db->get_where('restaurants', array('id' => $email_data['restaurant_id']))->result();
    $table_row_single = $this->db->get_where('restaurant_tables', array('id' => $email_data['table_id']))->result();
    $email_data['table_number'] = $table_row_single[0]->table_number;
    $email_data['name'] = $rest_row_single[0]->name;
    $email_data['address'] = $rest_row_single[0]->address;
    $email_data['house_no'] = $rest_row_single[0]->house_no;
    $email_data['country'] = $rest_row_single[0]->country;
    $email_data['city'] = $rest_row_single[0]->city;
    $email_data['state'] = $rest_row_single[0]->state;
    $email_data['pincode'] = $rest_row_single[0]->pincode;
    $email_data['phone'] = preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $rest_row_single[0]->phone). "\n";
?>

<?php 
if(!empty($pos_note)){
    $pos_note_tomail = '<tr>
        <td style="font-size:13px;line-height:18px">
            <b>**'.$lang_arr['restaurant_note'].'</b> : '.$pos_note.'
        </td>
    </tr> ';
}else{
  $pos_note_tomail = "";
}
$paraCSS = 'font-size: 14px; font-weight: normal;color:#000;text-align: left;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important;';
$data['body'] = '<tr>
   <td>
        <table width="100%" >
        <tr>
            <td style="width:95%;display:block;margin:auto;">                
            <h1 style="font-size: 24px; line-height:32px;text-align:center;color:#000; font-family: \'Montserrat\', sans-serif!important; ">'.$lang_arr['bk_request_decline'].'</h1>
                <p style="'.$paraCSS.'">
                    '.$lang_arr['dear'].' '.$email_data['contact_name'].',<br/><br/>
                    '.$lang_arr['bk_cancel_message'].'
                </p>
            </td>
        </tr>
        <tr>
            <th style="'.$paraCSS.' width:95%;display:block;margin:auto;text-align: center">                
            <br/>'.$lang_arr['bk_cancel_detail_label'].'
            </th>
        </tr>
        <tr>
            <td>
                <hr style="border:0;height:10px" />
            </td>
        </tr>
        <tr>
            <td style="'.$paraCSS.' width:95%;display:block;margin:auto;">
                <table style="width:100%">
                    
                    <tr>
                        <th>
                            '.ucwords($email_data['name']).'<br/>
                            <h5 style="margin: 0px 0 10px 0;">'.sprintf($lang_arr['bk_date_time'],$email_data['no_of_persons'],date('l, F d, Y', strtotime($email_data['booking_date'])),date("g:i A", strtotime($email_data['booking_time']))).'</h5>
                        </th>
                    </tr>
                    <tr>
                        <td style="font-size:13px;line-height:18px">
                        '.$lang_arr['name'].':<b> '.$email_data['contact_name'].'</b> 
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size:13px;line-height:18px">
                        '.$lang_arr['bk_confirm_lable'].':<b>'.$email_data['unique_id'].'</b>   
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size:13px;line-height:18px">
                            '.$email_data['house_no'].', '.$email_data['address'].', '.$email_data['city'].', '.$email_data['state'].', '.$email_data['pincode'].'
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size:13px;line-height:18px">
                            '.$email_data["phone"].'
                        </td>
                    </tr>  
                        '.$pos_note_tomail.'
                </table>   
            </td>
        </tr>
        </table>
   </td>
</tr>';
$this->load->view('api/email_templates/layout/layout', $data);