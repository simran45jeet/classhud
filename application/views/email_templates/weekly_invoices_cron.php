<?php 
// $paraCSS = 'font-size: 14px; font-weight: normal;color:#000; line-height: 22px;font-family: \'Montserrat\', sans-serif !important;';
$data['body'] = '<h3 style="color:#000;">Weekly commission invoices for last week have been generated.</h3>';
$this->load->view('api/email_templates/layout/layout', $data);