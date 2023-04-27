<?php
class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        if(!empty($ci->global_data))
        {
            $ci->load->helper('language');
            $siteLang = $ci->session->userdata('language');
            if ($siteLang) 
            {
                $ci->lang->load('main',$siteLang);
            } 
            else 
            {
                $ci->lang->load('main','english');
            }
        }
    }
}

