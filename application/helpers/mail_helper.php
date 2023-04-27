<?php
function send_email($to, $subject, $email_template, $data,$bcc_array = [],$file_data = []) 
{
    $ci =& get_instance();
    $data["email_data"] = $data;
    $country_name_code = '';
    
    $email['body'] = $ci->load->view('api/email_templates/'.$email_template, $data, true);
    $html_email = $ci->load->view('api/email_templates/layout/layout', $email,true);
    echo $html_email;
    die;

    $subdomain = explode('.', $_SERVER['HTTP_HOST'])[0];
    $email = new \SendGrid\Mail\Mail(); 
    $email->setFrom(FROM_EMAIL, EMAIL_NAME);
    $email->setSubject($subject);
    $email->setReplyTo(REPLY_TO);
    if(!empty($bcc_array)){
        foreach ($bcc_array as $bcc_email) {
            $email->addBcc($bcc_email);
        }
    }
    if(!empty($file_data)){
        $file_url = file_get_contents($file_data['url']);
        $email->addAttachment($file_url,$file_data['mine_type'],$file_data['file_name']);
    }
    $email->addTo($to);
    $email->addContent("text/html", $html_email);
    $sendgrid = new \SendGrid(SENDGRID_KEY);
    try {
        // if($subdomain != 'dev')
        // {
            $response = $sendgrid->send($email);
            return true;
        // }else
        // {

        // }
        // if($response->statusCode() ==  202)
        // {
        // return true;
        // }else
        // {
        // return false;
        // }
    } catch (Exception $e) {
        return false;
    }
}

function send_email_bk($to, $subject, $email_template, $data) 
{
    $data ["email_data"] = $data;
    $html_email = $this->load->view('api/email_templates/'.$email_template, $data, true);
    //echo $html_email; exit; 
    $this->email->mailtype = "html";
    $this->email->from(FROM_EMAIL, EMAIL_NAME);     
    $this->email->to($to);              
    $this->email->subject($subject);
    $this->email->message($html_email);                     
    $this->email->send();
}