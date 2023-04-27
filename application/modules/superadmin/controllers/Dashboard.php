<?php

class Dashboard extends MY_Controller {

    public $layout_view = "layout/".SUPERADMIN;

    public function __construct() {
        parent :: __construct();
        $this->layout->title('Classhud Dashboard');
        $this->data = array();
    }

    public function index() {
        $this->load->model("listing_model","listing");
        $this->load->model("listing_reviews_model","listing_reviews");
        $listing_request = $this->listing->get_request_list(array(),true,1);
        $this->data["total_pending_listing"] = $listing_request["count"];
        
        $today = date("Y-m-d");
        
        $today_listing = $this->listing->get_records(array("start_date"=>$today,"end_date"=>$today),true,1);
        $this->data["today_total_listing"] = $today_listing["count"];
        
        $total_listing = $this->listing->get_records(array(),true,1);
        $this->data["total_listing"] = $total_listing["count"];
        
        $today_review = $this->listing_reviews->get_records(array("start_date"=>$today,"end_date"=>$today),true,1);
        $this->data["today_total_reviews"] = $today_review["count"];
        
        $total_review = $this->listing_reviews->get_records(array(),true,1);
        $this->data["total_reviews"] = $total_review["count"];
        
        $pending_total_reviews = $this->listing_reviews->get_records( array("request_status"=>REVIEW_STATUS_PENDING),true,1 );
        $this->data["pending_total_reviews"] = $pending_total_reviews["count"];
        
        $this->layout->view(SUPERADMIN."/dashboard/index", $this->data);
    }
    
}
