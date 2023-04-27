<?php
class Listing_setting_model extends MY_Model {
    private $page_type;
    public function __construct() {
        parent::__construct();
        $this->table_name = 'tbl_listing_settings';
        $this->table_title = 'Listing Setting';
    }

    public function get_record($listring_id) {
        $response = array();
        $this->load->model("listing_model","listing");
        $record_sql = $this->db->select("ls.*,l.logo")
                            ->from($this->table_name." ls")
                            ->join($this->listing->table_name." l","l.id = ls.listing_id")
                            ->where(["ls.is_deleted"=>NOT_DELETED,"ls.listing_id"=>$listring_id,"l.is_deleted"=>NOT_DELETED]);
        $response['record'] = $record_sql->get()->row_array();
        return $response;
    }
    
    public function insert_banner_setting($post_data,$listing_id,$user_id){
        return $this->insert(
                array(
                    "banner_field_one_value"  => $post_data["banner_field_one_value"],
                    "banner_field_two_value"  => $post_data["banner_field_two_value"],
                    "banner_field_three_value"  => $post_data["banner_field_three_value"],
                    "logo_position"  => (int)$post_data["logo_position"],
                    "listing_id"  => $listing_id,
                    "created_by"  => $user_id,
                    "created_at"  => SQL_ADDED_DATE,
                    "ip_address"  => getVisitorIp(),
                )
            );
    }
    public function upload_banner_setting($post_data,$listing_id,$user_id){
        return $this->update(
                array(
                    "banner_field_one_value"  => $post_data["banner_field_one_value"],
                    "banner_field_two_value"  => $post_data["banner_field_two_value"],
                    "banner_field_three_value"  => $post_data["banner_field_three_value"],
                    "logo_position"  => (int)$post_data["logo_position"],
                    "modified_by"  => $user_id,
                    "modified_at"  => SQL_ADDED_DATE,
                ),
                array("listing_id"=>$listing_id)
            );
    }
    
}