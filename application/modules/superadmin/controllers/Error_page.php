<?php
class Error_Page extends MY_Controller 
{
    public $layout_view = "layout/".SUPERADMIN."_inner";
    /**
     * Construct
     */
    public function __construct() {
        parent::__construct();

    }

    public function access_forbidden()
    {
        $this->load->view(SUPERADMIN."/error_501");
        die();
    }
    
    
}
