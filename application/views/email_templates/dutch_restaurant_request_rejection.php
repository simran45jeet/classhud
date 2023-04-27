<?php 

$rest_row_single = $this->db->get_where('restaurants', array('id' => $email_data['restaurant_id']))->result();
$table_row_single = $this->db->get_where('restaurant_tables', array('id' => $email_data['table_id']))->result();
$email_data['restaurant_name'] = $rest_row_single[0]->name;
$email_data['restaurant_owner'] = $rest_row_single[0]->primary_contact_person;
$email_data['owner_email'] = $rest_row_single[0]->owner_email;

$data['body'] = '<tr>
   <td>
      <table width="100%" style="margin:0 auto;max-width: 450px; ">
         <tr>
            <td style="width:100%;display:block;margin:auto;text-align: center;"><br/><br/>
            <p>Dear '.$email_data['restaurant_owner'].',</p>

            <p>Your Restaurant Registration Request Has Been Rejected. Better luck next time!</p>
            
            <p>This is to inform you that we have received the proposal from your '.$email_data['restaurant_name'].' for becoming our valuable restaurant partner. We appreciate your request and would like to thank you for showing interest in Y the Wait.</p>
            
            <p>We regret to inform you that we cannot accept your registration request due to '.$rejection_reason.'. We hope we work together in future.</p>
            
            <p>We appreciate your interest you have shown in Y the Wait. Thank you again for the request.</p>
            </td>
         </tr>  
      </table>
   </td>
</tr>';
$this->load->view('api/email_templates/layout/layout', $data);