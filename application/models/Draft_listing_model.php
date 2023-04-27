<?php
class Draft_listing_model extends MY_Model {
    
    public function __construct(){
        parent::__construct();
        $this->table_name = "tbl_listing_draft";
        $this->table_title = "Draft Listing";
    }
    
    public function get_records($post_data=array(),$pagination = false,$page_no=1 ) {
        $today = date("Y-m-d",strtotime(UTC_DATE_TIME));
        $day_no = date("N",strtotime($today));
        $now_time = UTC_TIME;
        
        $this->load->model("listing_timming_model","listing_timming");
        $this->load->model("timezone_model","timezone");
        $this->load->model("listing_types_model","listing_types");
        $this->load->model("phone_code_model","phone_code");
        $this->load->model("city_model","city");
        //Get Restaurant List
        $record_sql = $this->db->distinct()->select("l.*,t.name as listing_type_name,t.image as listing_type_image,pc.phonecode as primary_phone_code_name,c.name as city_name",false)
                ->from($this->table_name." l")
                ->join($this->listing_types->table_name." t","t.id = l.listing_type","left")
                ->join($this->phone_code->table_name." pc","pc.id = l.primary_phone_code","left")
                ->join($this->city->table_name." c","c.id = l.city","left")
                ->where( array("l.is_deleted"=>NOT_DELETED,"l.listing_id"=>0) );
        
        if( isset($post_data["all_records"]) && $post_data["all_records"]==true ){
        }else{ $record_sql->where("l.status",ACTIVE); }
        
        if( isset($post_data["listing_type"]) && is_numeric($post_data["listing_type"]) && $post_data["listing_type"]>0 ){
            $record_sql->where("l.listing_type",$post_data["listing_type"]);
        }else if( isset($post_data["listing_type_slug"]) && !empty($post_data["listing_type_slug"]) ){
            $record_sql->where("t.slug",$post_data["listing_type_slug"]);
        }
        if( isset($post_data["user_id"]) && is_numeric($post_data["user_id"]) && $post_data["user_id"]>0 ){
            $record_sql->where("l.user_id",$post_data["user_id"]);
        }
        if( !empty($post_data["start_date"]) && !empty($post_data["end_date"]) ){
            $record_sql->where(" date(l.created_at) BETWEEN '{$post_data["start_date"]}' and '{$post_data["end_date"]}'",null,false);
        }
        
        
        if( !empty($post_data["search"]) ) {
            $this->load->model("listing_tags_model","listing_tags");
            $this->load->model("tags_model","tags");
            $record_sql->join($this->listing_tags->table_name." l_t","l_t.table_id = l.id and l_t.type = ".TAGS_TYPES_LISTING." and l_t.is_deleted=".NOT_DELETED." and l_t.status=".ACTIVE,"left");
            $record_sql->join($this->tags->table_name." tag","tag.id = l_t.tag_id and tag.is_deleted = ".NOT_DELETED." and tag.status=".ACTIVE,"left");
            $record_sql->group_start();
            $record_sql->like("l.primary_email",$post_data["search"]);
            $record_sql->like("tags",$post_data["search"]);
            if( is_numeric($post_data["search"]) ) {
                $record_sql->or_where("l.primary_phone_no",$post_data["search"]);
            }
            $record_sql->or_like("l.name",$post_data["search"]);
            $record_sql->group_end();
        }
          
        if( $pagination===true ) {
            $record_count_sql = clone $record_sql;
            $response['count'] = $record_count_sql->get()->num_rows();
            $default_count = (int)$post_data['per_page_count'] ? (int)$post_data['per_page_count'] : DEFAULT_RECORDS_PAGELIMIT;
            
            $data_page = api_paging($default_count,$page_no);
            $record_sql->limit($data_page['limit'],$data_page['start']);
            $response['per_page_count'] = $default_count;
        }
       
        $sort_by = !empty($post_data["sort_by"]) ? $post_data["sort_by"] : "";
        switch($sort_by) {
            case "distance":
                $sort_by="distance";
            break;
            default :
                $sort_by="l.id";
            break;
        }
        
        $sort = !empty($post_data["sort"]) ? $post_data["sort"] : "";
        switch($sort) {
            case "asc":
                $sort="asc";
            break;
            default :
                $sort="desc";
            break;
        }
//        
//        $record_sql->order_by("l.id","desc");
        
        $response['records'] = $record_sql->order_by($sort_by,$sort)->get()->result_array();
        
        return $response;
    }
    
    public function get_record($listing_id="",$slug="") {
        //Get Restaurant List
        $this->load->model("listing_timming_model","listing_timming");
        $this->load->model("timezone_model","timezone");
        $this->load->model("organization_types_model","organization_types");
        $this->load->model("phone_code_model","phone_code");
        $this->load->model("city_model","city");
        $this->load->model("listing_claim_request_model","listing_claim_request");
        $this->load->model("listing_reviews_model","listing_reviews");
        $this->load->model("users_model","users");
        
        //Get Restaurant List
        $record_sql = $this->db->distinct()->select("l.*,ot.name as listing_type_name,ot.image as listing_type_image,pc.phonecode as primary_phone_code_name,pc2.phonecode as primary_whatsapp_code_name,c.name as city_name",false)
                ->from($this->table_name." l")
                ->join($this->organization_types->table_name." ot","ot.id = l.listing_type","left")
                ->join($this->phone_code->table_name." pc","pc.id = l.primary_phone_code","left")
                ->join($this->phone_code->table_name." pc2","pc2.id = l.primary_whatsapp_code","left")
                ->join($this->city->table_name." c","c.id = l.city","left")
                ->where( array("l.is_deleted"=>NOT_DELETED,"l.listing_id"=>0) );
        if( !empty($slug) ) {
            $record_sql->where("l.slug",$slug);
        }else{
            $record_sql->where("l.id",$listing_id);
        }
        
        $response['record'] = $record_sql->get()->row_array();        
        return $response;
    }
}