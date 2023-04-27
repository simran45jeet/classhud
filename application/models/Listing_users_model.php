<?php
class Listing_users_model extends MY_Model {
    
    function __construct(){
        parent::__construct();
        $this->table_name = "tbl_listing_users";
        $this->table_title = "Listing User";
    }
    
    public function get_records($listing_id,$post_data=array(),$pagination = false,$page_no=1 ) {
        $today = date("Y-m-d",strtotime(UTC_DATE_TIME));
        $day_no = date("N",strtotime($today));
        $this->load->model("users_model","users");
        $this->load->model("listing_model","listing");
        //Get Restaurant List
        $record_sql = $this->db->select("lu.id,lu.status,u.full_name,u.phone_no,l.name as listing_name,u.id as user_id",false)
                ->from($this->listing->table_name." l")
                ->join($this->table_name." lu","lu.listing_id = l.id")
                ->join($this->users->table_name." u","u.id = lu.user_id")
                
                ->where( array("l.is_deleted"=>NOT_DELETED,"lu.is_deleted"=>NOT_DELETED,"l.id"=>$listing_id) );
        
        if( isset($post_data["all_records"]) && $post_data["all_records"]==true ){
        }else{ $record_sql->where("lu.status",ACTIVE); }
        
        if( !empty($post_data["search"]) ) {
        
            $record_sql->group_start();
            $record_sql->like("u.full_name",$post_data["search"]);
            
            if( is_numeric($post_data["search"]) ) {
                $record_sql->or_where("u.phone_no",$post_data["search"]);
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
        
        $response['records'] = $record_sql->order_by("lu.id","desc")->get()->result_array();
        
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
        $record_sql = $this->db->distinct()->select("l.*,ot.name as listing_type_name,ot.image as listing_type_image,pc.phonecode as primary_phone_code_name,pc2.phonecode as primary_whatsapp_code_name,c.name as city_name,SUBSTRING_INDEX(group_concat(lcr.id),',',1) as listing_claim_request_id,count(lr.id) as total_review ,avg(lr.rating) as average_rating,u.phone_no user_phone_no,pc3.phonecode as user_phone_code",false)
                ->from($this->table_name." l")
                ->join($this->organization_types->table_name." ot","ot.id = l.listing_type","left")
                ->join($this->phone_code->table_name." pc","pc.id = l.primary_phone_code","left")
                ->join($this->phone_code->table_name." pc2","pc2.id = l.primary_whatsapp_code","left")
                ->join($this->city->table_name." c","c.id = l.city","left")
                ->join($this->listing_claim_request->table_name." lcr","lcr.listing_id = l.id and lcr.request_status=".LISTING_CLAIM_REQUEST_REQUESTED,"left")
                ->join($this->listing_reviews->table_name." lr","lr.table_id = l.id and lr.type=".REVIEW_TYPES_LISTING." and lr.status=1 and lr.request_status=".REVIEW_STATUS_APPROVE,"left")
                ->join($this->users->table_name." u","u.id = l.user_id ","left")
                ->join($this->phone_code->table_name." pc3","pc3.id = u.phone_code ","left")
                ->where( array("l.is_deleted"=>NOT_DELETED) );
        if( !empty($slug) ) {
            $record_sql->where("l.slug",$slug);
        }else{
            $record_sql->where("l.id",$listing_id);
        }
        $record_sql->join($this->timezone->table_name." tz","tz.id = l.time_zone","left")
                    ->join($this->listing_timming->table_name." lt","lt.listing_id = l.id and lt.day_type = ".DAY_TYPE_NORMAl." and lt.day_no = weekday(CONVERT_TZ( CONVERT_TZ('".SQL_ADDED_DATE."','+00:00','-05:30'),'+00:00',concat( if(tz.offset_type=1,'+','-'),tz.offset_time) ))+1 and lt.status='".ACTIVE."' and lt.is_deleted = '".NOT_DELETED."' and time(CONVERT_TZ( CONVERT_TZ('".SQL_ADDED_DATE."','+00:00','-05:30'),'+00:00',concat( if(tz.offset_type=1,'+','-'),tz.offset_time) ))  between  lt.start_time and lt.end_time","left",false)
                    ->select("(case when lt.id is null then ".IS_LISTING_CLOSED." else is_listing_open end) as now_listing_open ");
        
        $response['record'] = $record_sql->get()->row_array();        
        return $response;
    }
    
    
    public function get_users_list_for_listing($listing_id,$post_data=array()){
            
        $this->load->model("users_model","users");
        $records_sql = $this->db->select("u.id,u.full_name,u.phone_no")
                                ->from($this->users->table_name." u")
                                ->join($this->table_name." lu","lu.user_id = u.id and lu.is_deleted = ".NOT_DELETED." and lu.listing_id={$listing_id}","LEFT")
                                ->where(array("u.is_deleted"=>NOT_DELETED,"u.group_id"=>CUSTOMER_GROUP_ID,"lu.id"=>NULL));
        if( !empty($post_data["search"]) ) {
            $records_sql->group_start();
            $records_sql->like("u.full_name",$post_data["search"]);
            if( is_numeric($post_data["search"]) ) {
                $records_sql->or_where("u.phone_no",$post_data["search"]);
                
            }
            $records_sql->group_end();
        }
        
        return array("records"=>$records_sql->get()->result_array());   
    }
    
    public function check_listing_user($listing_id,$user_id){
        $this->load->model("users_model","users");
        $records_sql = $this->db->select("u.id,u.full_name,u.phone_no")
                                ->from($this->users->table_name." u")
                                ->join($this->table_name." lu","lu.user_id = u.id and lu.is_deleted = ".NOT_DELETED." and lu.listing_id={$listing_id}","LEFT")
                                ->where(array("u.is_deleted"=>NOT_DELETED,"u.group_id"=>CUSTOMER_GROUP_ID,"lu.user_id"=>$listing_id));
        if( !empty($post_data["search"]) ) {
            $records_sql->group_start();
            $records_sql->like("u.full_name",$post_data["search"]);
            if( is_numeric($post_data["search"]) ) {
                $records_sql->or_where("u.phone_no",$post_data["search"]);
                
            }
            $records_sql->group_end();
        }
        
        return array("record"=>$records_sql->get()->result_array()); 
    }
    
    public function add_listing_user($listing_id,$post_data,$user_id){
        return $this->insert(
                array(
                    "listing_id"  => $listing_id,
                    "user_id" => $post_data["user_id"],
                    "status" => $post_data["status"]?:INACTIVE,
                    "created_at" => SQL_ADDED_DATE,
                    "created_by" => $user_id,
                    "ip_address" => getVisitorIp(),
                )
            );
        
    }
    public function delete_listing_user($listing_user_id){
        return $this->update(array("is_deleted"=>DELETED),$listing_user_id);
        
    }
}

