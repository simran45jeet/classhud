<?php
if (!defined('BASEPATH'))
    exit("No direct script access allowed");

class Crons extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }
    
    ///Generate Site Map Xml File///
    public function generate_sitemap()  {
        error_reporting(E_ALL);
        $data["test_only"] = "0";
        $data["country_id"] = "";
        $this->load->model("listing_model","listing");
        $records = $this->listing->get_records(array("request_status"=>LISTING_CLAIM_REQUEST_APPROVED),false)["records"];
        $generation_date = date('Y-m-d\TH:i:s+05:30');
        $base_url = CLASSHUD_SITE_URL;
        $row = '<?xml version="1.0" encoding="UTF-8"?>
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
            <url>
            <loc>' .$base_url . '</loc>
            <lastmod>' . $generation_date . '</lastmod>
            <priority>1.00</priority>
            </url>
        ' . "\n";
        file_put_contents(FCPATH.'sitemap.xml', $row);
        foreach ($records as $row) {
            $urlPriority = "0.80";
            $xmlRow = '
                <url>
                <loc>' . $base_url."/best/".preg_replace("![\s]+!u","-",strtolower($row["listing_type_name"]))."/{$row["slug"]}/".preg_replace( "![\s]+!u","-",strtolower($row["city_name"]) ).'</loc>
                <lastmod>' . $generation_date . '</lastmod>
                <priority>' . $urlPriority . '</priority>
                </url>
            ';
            file_put_contents(FCPATH.'sitemap.xml', $xmlRow, FILE_APPEND);
        }
        $this->load->model("blogs_model","blogs");
        $blogs = $this->blogs->get_records(array(),false)["records"];
        foreach( $blogs as $key=>$blog ) {
            $urlPriority = "0.80";
            $xmlRow = '
                <url>
                <loc>' . $base_url."/blogs/view/".$blog["slug"].'</loc>
                <lastmod>' . $generation_date . '</lastmod>
                <priority>' . $urlPriority . '</priority>
                </url>
            ';
            file_put_contents(FCPATH.'sitemap.xml', $xmlRow, FILE_APPEND);
            
        }
        //Add Language Links//
        
        //End Add Language links//
        //Add cms pages links//
        
        $cmsPagesLinks = array("about","benefits","contact-us","privacy-policy","terms-conditions","blogs");
        foreach ($cmsPagesLinks as $key => $value) {
            $xmlRow = '
            <url>
            <loc>' . "{$base_url}/{$value}" . '</loc>
            <lastmod>' . $generation_date . '</lastmod>
            <priority>' . $urlPriority . '</priority>
            </url>
        ';
            file_put_contents(FCPATH.'sitemap.xml', $xmlRow, FILE_APPEND);
        }
        //add cms pages links//
        $endHeader = "</urlset>";
        file_put_contents('./sitemap.xml', $endHeader, FILE_APPEND);
//        $data["passwordString"] = $this->generateRandomString(8, 1 - 2, 1);
        /*
        system('zip -P ' . $data["passwordString"] . ' sitemap.zip sitemap.xml');
        //unlink('sitemap.xml') ;
        
        $subject = "Site map file generated.";
        $email_template = "sitemap_generated_email";
        $data["download_file_url"] = base_url() . "sitemap.zip";
        $bcc_array = ["ram.qodemaker@gmail.com", "kuldeep.cmda@gmail.com"];
        //$file_data["url"]= base_url()."sitemap.zip";
        send_email($to, $subject, $email_template, $data, $bcc_array, $file_data = [], $retaurant_id = '', $country_code = ''); 
        */
        echo "Site Map generation done. \n";
    }

    public function set_tags(){
        $table_ids = $this->db->select(" distinct table_id  ",false)
                            ->from("tbl_tags")
                            ->get()->result_array();
        foreach( $table_ids as $table_id ) {
            $table_tags = $this->db->select("name")
                                            ->from("tbl_tags")
                                            ->where("table_id",$table_id["table_id"])
                                            ->get()->result_array();
            foreach( $table_tags as $key=>$table_tag ) {
                $tag_name = $table_tag["name"];
                
                $tag_id = $this->db->get_where("tbl_tags",array("name"=>$tag_name) )->row_array();
                $this->db->insert("tbl_table_tags",array("type"=>2,"table_id"=>$table_id["table_id"],"tag_id"=>$tag_id["id"],"status"=>1,"created_at"=>$tag_id["created_at"],"created_by"=>$tag_id["created_by"]));
            }
            
        }


    }
}
