<?php
class Listing_reviews_model extends MY_Model {
    private $type=REVIEW_TYPES_LISTING;
    public function __construct() {
        parent::__construct();
        $this->table_name = 'tbl_review';
        $this->table_title = 'Lisitng Review';
        
    }

    public function get_records($post_data,$pagination=true,$page_no=1) {
        
        $response = array();
        $this->load->model("listing_model","listing");
        $this->load->model("listing_timming_model","listing_timming");
        $this->load->model("timezone_model","timezone");
        $this->load->model("listing_types_model","listing_types");
        $this->load->model("phone_code_model","phone_code");
        $this->load->model("city_model","city");
        
        $record_sql = $this->db->select("lr.*,lt.name as listing_type_name,lt.image as listing_type_image,pc.phonecode as primary_phone_code_name,c.name as city_name,l.name as listing_name,l.slug,l.cover_image,l.logo,l.id as listing_id ")
                            ->from($this->table_name." lr")
                            ->join($this->listing->table_name." l","l.id=lr.table_id and l.status = ".ACTIVE)
                            ->join($this->listing_types->table_name." lt","lt.id = l.listing_type ","left")
                            ->join($this->phone_code->table_name." pc","pc.id = l.primary_phone_code","left")
                            ->join($this->city->table_name." c","c.id = l.city","left")
                            ->where(["lr.is_deleted"=>NOT_DELETED,"lr.type"=>$this->type]);
        if( isset($post_data["all_records"]) && $post_data["all_records"]==true ){}else{
            $record_sql->where("lr.status",ACTIVE);
        }
        if( isset($post_data["status"]) && $post_data["status"]!="-1"  ) {
            $record_sql->where("lr.status",$post_data["status"]);
        }
        
        if( isset($post_data["request_status"]) && is_numeric($post_data["request_status"])  ) {
            $record_sql->where("lr.request_status",$post_data["request_status"]);
        }
        if( !empty($post_data["start_date"]) && !empty($post_data["end_date"]) ){
            $record_sql->where(" date(lr.created_at) BETWEEN '{$post_data["start_date"]}' and '{$post_data["end_date"]}'",null,false);
        }
        
        if(  isset($post_data["request_status"]) && $post_data["request_status"]!="-1"  ) {
            $record_sql->where("lr.request_status",$post_data["request_status"]);
        }
        if(  isset($post_data["search"]) && !empty($post_data["search"]) ) {
            $record_sql->group_start();
            $record_sql->like("lr.full_name",$post_data["search"]);
            $record_sql->or_like("lr.email",$post_data["search"]);
            $record_sql->or_like("l.primary_email",$post_data["search"]);
            $record_sql->or_like("l.name",$post_data["search"]);
            if(is_numeric($post_data["search"]) ) {
                $record_sql->or_where("l.primary_phone_no",$post_data["search"]);
                
            }
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
        $response['records'] = $record_sql->order_by("lr.id","desc")->get()->result_array();

        return $response;
    }
    
    public function get_record($review_id) {
        $response = array();
        $record_sql = $this->db->select("*")
                            ->from($this->table_name)
                            ->where(["is_deleted"=>NOT_DELETED,"type"=>$this->type,"id"=>$review_id]);
        $response['record'] = $record_sql->get()->row_array();
        
        return $response;
    }
    
    public function get_review_rating_categoriwise($listing_id){
        $this->load->model("review_categories_model","review_categories");
        $this->load->model("review_categories_rating_model","review_categories_rating");
        
        $records = $this->db->select("avg(rcr.rating) as average_rating,count(rcr.id) as count,rc.name")
                    ->from($this->table_name." lr")
                    ->join($this->review_categories_rating->table_name." rcr"," rcr.review_id = lr.id")
                    ->join($this->review_categories->table_name." rc"," rc.id = rcr.category_id")
                    
                    ->where( array("lr.status"=>ACTIVE,"lr.is_deleted"=>NOT_DELETED,"lr.type"=>REVIEW_TYPES_LISTING,"lr.request_status"=>REVIEW_STATUS_APPROVE,"rcr.is_deleted"=>NOT_DELETED,"rcr.status"=>ACTIVE,"rc.status"=>ACTIVE,"rc.is_deleted"=>NOT_DELETED,"rc.type"=>REVIEW_CATEGORIES_TYPES_LISTING,"lr.table_id"=>$listing_id))->group_by("rc.id")->order_by("rc.sort_order","asc")->order_by("rc.id","asc")
                    ->get()->result_array();
        return array("records"=>$records);
    }
    
    public function user_reviews($slug,$post_data,$pagination=true,$page_no=1){
        $this->load->model("review_categories_model","review_categories");
        $this->load->model("review_categories_rating_model","review_categories_rating");
        $this->load->model("listing_model","listing");
        
        $record_sql = $this->db->select("lr.*,group_concat(rcr.rating SEPARATOR '=>' ) category_rating,group_concat(rc.name SEPARATOR '=>') as category_name")
                    ->from($this->table_name." lr")
                    ->join($this->review_categories_rating->table_name." rcr"," rcr.review_id = lr.id")
                    ->join($this->review_categories->table_name." rc"," rc.id = rcr.category_id")
                    ->join($this->listing->table_name." l","l.id=lr.table_id and l.status=".ACTIVE)
                    ->where( array("lr.status"=>ACTIVE,"lr.is_deleted"=>NOT_DELETED,"lr.type"=>REVIEW_TYPES_LISTING,"lr.request_status"=>REVIEW_STATUS_APPROVE,"rcr.is_deleted"=>NOT_DELETED,"rcr.status"=>ACTIVE,"rc.status"=>ACTIVE,"rc.is_deleted"=>NOT_DELETED,"rc.type"=>REVIEW_CATEGORIES_TYPES_LISTING,"l.slug"=>$slug))->group_by("lr.id");
        
        if( $pagination===true ) {
            $record_count_sql = clone $record_sql;
            $response['count'] = $record_count_sql->get()->num_rows();
            $default_count = (int)$post_data['per_page_count'] ? (int)$post_data['per_page_count'] : DEFAULT_RECORDS_PAGELIMIT;
            
            $data_page = api_paging($default_count,$page_no);
            
            $record_sql->limit($data_page['limit'],$data_page['start']);
            $response['per_page_count'] = $default_count;
        }
        
        $response["records"]=$record_sql->order_by("lr.id","desc")->order_by("rc.sort_order","asc")->order_by("rc.id","asc")
                ->get()->result_array();
        
        return $response;
    }
 
    public function delete_record($id) {
        return $this->update(array("is_deleted"=>DELETED),$id);
    }
    
}