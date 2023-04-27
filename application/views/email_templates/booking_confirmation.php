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
$paraCSS = 'font-size: 14px; font-weight: normal;color:#000;text-align: left;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important;';
$data['body'] = '<tr>
   <td>
   <table width="100%" >
   <tbody>
       <tr>
           <td style="width: 95%; display: block; margin: auto">      
                <h1 style="width:100%;font-size: 24px; line-height:32px;text-align:center;color:#000; font-family: \'Montserrat\', sans-serif!important; ">Booking confirmed!</h1>          
               <p style="'.$paraCSS.'">Dear '.$email_data['contact_name'].',<br/><br/> Your table reservation request has been approved by the restaurant. You can find the booking details below:
               </p>
           </td>
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
                        <th>
                            '.ucwords($email_data['name']).'<br/>
                            <h5 style="margin: 0px 0 10px 0;">Table For '.$email_data['no_of_persons'].' on '.date('l, F d, Y', strtotime($email_data['booking_date'])).' at '.date("g:i A", strtotime($email_data['booking_time'])).' </h5>
                        </th>
                        </tr>
                        <tr>
                            <td style="font-size:13px;line-height:18px">
                                Name:<b> '.$email_data['contact_name'].'</b> 
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:13px;line-height:18px">
                                Confirmation:<b>'.$email_data['unique_id'].'</b>   
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
                   </tbody>
               </table>    
           </td>
       </tr>

   </tbody>
</table>
   </td>
</tr>';
$this->load->view('api/email_templates/layout/layout', $data);