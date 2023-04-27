<?php
class listing_model extends MY_Model {
    
    function __construct(){
        parent::__construct();
        $this->table_name = "tbl_listing";
        $this->table_title = "Listing";
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
                ->where( array("l.is_deleted"=>NOT_DELETED) );
        
        if( isset($post_data["all_records"]) && $post_data["all_records"]==true ){
        }else{ $record_sql->where("l.status",ACTIVE); }
        if( isset($post_data["request_status"]) && is_numeric($post_data["request_status"]) ){
            $record_sql->where("l.request_status",$post_data["request_status"]);
        }
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
        
        if( !empty($post_data["longitude"]) && !empty($post_data["latitude"]) ) {
            $record_sql->select("(ACOS( SIN( RADIANS( l.latitude ) ) * SIN( RADIANS( {$post_data['latitude']} ) ) + COS( RADIANS( l.latitude ) ) * COS( RADIANS(  {$post_data['latitude']} )) * COS( RADIANS( l.longitude ) - RADIANS(  {$post_data['longitude']} )) ) * 6371 ) as distance");
            
            $record_sql->join($this->timezone->table_name." tz","tz.id = l.time_zone","left")
                        ->join($this->listing_timming->table_name." lt","lt.listing_id = l.id and lt.day_type = ".DAY_TYPE_NORMAl." and lt.day_no = weekday(CONVERT_TZ( CONVERT_TZ('".SQL_ADDED_DATE."','+00:00','-05:30'),'+00:00',concat( if(tz.offset_type=1,'+','-'),tz.offset_time) ))+1 and lt.status='".ACTIVE."' and lt.is_deleted = '".NOT_DELETED."' and time(CONVERT_TZ( CONVERT_TZ('".SQL_ADDED_DATE."','+00:00','-05:30'),'+00:00',concat( if(tz.offset_type=1,'+','-'),tz.offset_time) ))  between  lt.start_time and lt.end_time","left",false)
                    ->select("(case when lt.id is null then ".IS_LISTING_CLOSED." else is_listing_open end) as now_listing_open ");
            //$record_sql->having("distance<=l.radius",null,false);
        }
        if( !empty($post_data["search"]) ) {
            $this->load->model("listing_tags_model","listing_tags");
            $this->load->model("tags_model","tags");
            $record_sql->join($this->listing_tags->table_name." l_t","l_t.table_id = l.id and l_t.type = ".TAGS_TYPES_LISTING." and l_t.is_deleted=".NOT_DELETED." and l_t.status=".ACTIVE,"left");
            $record_sql->join($this->tags->table_name." tag","tag.id = l_t.tag_id and tag.is_deleted = ".NOT_DELETED." and tag.status=".ACTIVE,"left");
            $record_sql->group_start();
            $record_sql->like("l.primary_email",$post_data["search"]);
            $record_sql->like("tag.name",$post_data["search"]);
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
                ->where( array("l.is_deleted"=>NOT_DELETED) )
                ->having("l.id is not ",NULL);
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
    
    
    public function get_request_list($post_data=array(),$pagination = false,$page_no=1 ) {
        //Get Restaurant List
        $this->load->model("organization_types_model","organization_types");
        $record_sql = $this->db->select("l.*,ot.name as orgnization_type")
                            ->from($this->table_name." l")
                            ->join($this->organization_types->table_name." ot","ot.id=l.listing_type")
                            ->where( array("l.is_deleted"=>NOT_DELETED,"l.request_status"=>LISTING_REQUEST_STATUS_REQUESTED) );
        
        if( isset($post_data["only_active"]) && $post_data["only_active"]==true ){
            $record_sql->where("l.status",ACTIVE);
        }
        if( !empty($post_data["start_date"]) && !empty($post_data["end_date"]) ){
            $record_sql->where(" date(l.created_at) BETWEEN '{$post_data["start_date"]}' and '{$post_data["end_date"]}'",null,false);
        }
        
        if( $pagination===true ) {
            $record_count_sql = clone $record_sql;
            $response['count'] = $record_count_sql->get()->num_rows();
            $default_count = (int)$post_data['per_page_count'] ? (int)$post_data['per_page_count'] : DEFAULT_RECORDS_PAGELIMIT;
            
            $data_page = api_paging($default_count,$page_no);
            $record_sql->limit($data_page['limit'],$data_page['start']);
            $response['per_page_count'] = $default_count;
        }
        if( !empty($post_data["start_date"]) && !empty($post_data["end_date"]) ){
            $record_sql->where(" date(l.created_at) BETWEEN '{$post_data["start_date"]}' and '{$post_data["end_date"]}'",null,false);
        }
        
        
        $response['records'] = $record_sql->order_by("l.id","desc")->get()->result_array();
        return $response;
    }
    
    function claim_listing_approve($listing_id,$user_id){
        $update_data = array("user_id"=>$user_id,"is_claimed"=>LISTING_IS_CLAIMED);
        return $this->update($update_data,array("id"=>$listing_id,"is_claimable"=>LISTING_IS_CLAIMED,"is_claimed"=>LISTING_IS_UNCLAIMED));
    }
    
    function delete_record($record_id) {
        $update_data = array("is_deleted"=>DELETED);
        return $this->update($update_data,array("id"=>$record_id));
    }
    
    
    public function get_user_listing($user_id,$post_data=array(),$pagination = false,$page_no=1 ) {
        
        $this->load->model("listing_timming_model","listing_timming");
        $this->load->model("timezone_model","timezone");
        $this->load->model("listing_types_model","listing_types");
        $this->load->model("phone_code_model","phone_code");
        $this->load->model("city_model","city");
        $this->load->model("listing_users_model","listing_users");
        //Get Restaurant List
        
        $record_sql = $this->db->distinct()->select("l.*,t.name as listing_type_name,t.image as listing_type_image,pc.phonecode as primary_phone_code_name,c.name as city_name",false)
                ->from($this->table_name." l")
                ->join($this->listing_types->table_name." t","t.id = l.listing_type","left")
                ->join($this->phone_code->table_name." pc","pc.id = l.primary_phone_code","left")
                ->join($this->city->table_name." c","c.id = l.city","left")
                ->join($this->listing_users->table_name." lu","lu.listing_id = l.id and lu.user_id = '{$user_id}' and lu.status=".ACTIVE." and lu.is_deleted=".NOT_DELETED)
                ->where( array("l.is_deleted"=>NOT_DELETED) );
        
        if( isset($post_data["all_records"]) && $post_data["all_records"]==true ){
        }else{ $record_sql->where("l.status",ACTIVE); }
        if( isset($post_data["request_status"]) && is_numeric($post_data["request_status"]) ){
            $record_sql->where("l.request_status",$post_data["request_status"]);
        }
        if( isset($post_data["listing_type"]) && is_numeric($post_data["listing_type"]) && $post_data["listing_type"]>0 ){
            $record_sql->where("l.listing_type",$post_data["listing_type"]);
        }else if( isset($post_data["listing_type_slug"]) && !empty($post_data["listing_type_slug"]) ){
            $record_sql->where("t.slug",$post_data["listing_type_slug"]);
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
            $record_sql->like("tag.name",$post_data["search"]);
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
    
    
    public function get_listing_order_packages( $listing_id,$pacakages ) {
        $this->load->model("orders_model","orders");
        $this->load->model("listing_users_model","listing_users");
        $this->load->model("order_products_model","order_products");
        $this->load->model("product_packages_model","product_packages");
        $this->load->model("products_model","products");
        $this->load->model("timezone_model","timezone");
        $this->load->model("listing_types_model","listing_types");
        $this->load->model("phone_code_model","phone_code");
        $this->load->model("city_model","city");
        $this->load->model("listing_package_log_model","listing_package_log");
        $record_sql = $this->db->select("l.*,t.name as listing_type_name,t.image as listing_type_image,pc.phonecode as primary_phone_code_name,c.name as city_name,pc2.phonecode as primary_whatsapp_code_name")
                                ->from($this->table_name." l")
                                ->join( $this->listing_users->table_name." lu","lu.listing_id=l.id and lu.status=".ACTIVE." and lu.is_deleted = ".NOT_DELETED,"left")
                                ->join($this->orders->table_name." o","o.listing_id=l.id and o.order_status>".ORDER_STATUS_PENDING." and o.status=".ACTIVE." and o.is_deleted=".NOT_DELETED)
                                ->join($this->order_products->table_name." op","op.order_id=o.id and op.status=".ACTIVE." and op.is_deleted=".NOT_DELETED)
                                ->join($this->products->table_name." p","p.id=op.product_id and op.is_deleted=".NOT_DELETED." and p.type=".PRODUCT_TYPE_FULL_SUBSCRIPTION,"left")
                                ->join($this->products->table_name." p2","p2.id=op.product_id and op.is_deleted=".NOT_DELETED." and p2.type=".PRODUCT_TYPE_PACKAGE_SUBSCRIPTION,"left")
                                ->join($this->listing_types->table_name." t","t.id = l.listing_type","left")
                                ->join($this->phone_code->table_name." pc","pc.id = l.primary_phone_code","left")
                                ->join($this->phone_code->table_name." pc2","pc2.id = l.primary_whatsapp_code","left")
                                ->join($this->city->table_name." c","c.id = l.city","left")
                                
                                ->where( array("l.status"=>ACTIVE,"l.is_deleted"=>NOT_DELETED) );
        
        $record_sql->where("l.id",$listing_id);
        foreach( $pacakages as $key => $package_type ) {
            $alias_name = $key."_package";
            $log_alias_name = $key."_package_log";
//            $record_sql->select(" group_concat( ( case 
//                                        when p.id is not null then op.order_id 
//                                        when ( p2.id is not null and {$alias_name}.id is not null and ( {$alias_name}.total_count = 0 or {$alias_name}.total_count> count(distinct {$log_alias_name}.id) then op.order_id  )   ) 
//                                    end ) ) as $alias_name",false);
            $record_sql->select(" min( case
                                        when p.id is not null then op.order_id 
                                        when p2.id is not null  and ( {$alias_name}.total_count=0 or {$alias_name}.total_count>if({$log_alias_name}.count>0,{$log_alias_name}.count,0) ) then o.id
                                   end 
                                 ) as $alias_name",false);
            $record_sql->join($this->product_packages->table_name." $alias_name","$alias_name.product_id=op.product_id and $alias_name.package_type = $package_type  ","left");
            $record_sql->join($this->listing_package_log->table_name." as {$log_alias_name}","{$log_alias_name}.listing_id = l.id and {$log_alias_name}.package_type = '{$package_type}' and {$log_alias_name}.status=".ACTIVE." and {$log_alias_name}.is_deleted=".NOT_DELETED." and {$log_alias_name}.order_id=op.order_id","left");
        }
        $record_sql->group_by("l.id");
        $record = $record_sql->get()->row_array();
        
        return array("record"=>$record);
    }
    
    public function get_user_paid_listing( $user_id,$pacakages ) {
        $this->load->model("orders_model","orders");
        $this->load->model("listing_users_model","listing_users");
        $this->load->model("order_products_model","order_products");
        $this->load->model("product_packages_model","product_packages");
        $this->load->model("products_model","products");
        $this->load->model("timezone_model","timezone");
        $this->load->model("listing_types_model","listing_types");
        $this->load->model("phone_code_model","phone_code");
        $this->load->model("city_model","city");
        $this->load->model("listing_package_log_model","listing_package_log");
        $record_sql = $this->db->select("l.*,t.name as listing_type_name,t.image as listing_type_image,pc.phonecode as primary_phone_code_name,c.name as city_name,pc2.phonecode as primary_whatsapp_code_name")
                                ->from($this->table_name." l")
                                ->join( $this->listing_users->table_name." lu","lu.listing_id=l.id and lu.status=".ACTIVE." and lu.is_deleted = ".NOT_DELETED)
                                ->join($this->orders->table_name." o","o.listing_id=lu.listing_id and o.order_status>".ORDER_STATUS_PENDING." and o.status=".ACTIVE." and o.is_deleted=".NOT_DELETED)
                                ->join($this->order_products->table_name." op","op.order_id=o.id and op.status=".ACTIVE." and op.is_deleted=".NOT_DELETED)
                                ->join($this->products->table_name." p","p.id=op.product_id and op.is_deleted=".NOT_DELETED." and p.type=".PRODUCT_TYPE_FULL_SUBSCRIPTION,"left")
                                ->join($this->products->table_name." p2","p2.id=op.product_id and op.is_deleted=".NOT_DELETED." and p2.type=".PRODUCT_TYPE_PACKAGE_SUBSCRIPTION,"left")
                                ->join($this->listing_types->table_name." t","t.id = l.listing_type","left")
                                ->join($this->phone_code->table_name." pc","pc.id = l.primary_phone_code","left")
                                ->join($this->phone_code->table_name." pc2","pc2.id = l.primary_whatsapp_code","left")
                                ->join($this->city->table_name." c","c.id = l.city","left")
                                
                                ->where( array("l.status"=>ACTIVE,"l.is_deleted"=>NOT_DELETED) );
        if( !empty($listing_id) ) {
            $record_sql->where("l.id",$listing_id);
        }else{
            $record_sql->where("lu.user_id",$user_id);
        }
        foreach( $pacakages as $key => $package_type ) {
            $alias_name = $key."_package";
            $log_alias_name = $key."_package_log";
//            $record_sql->select(" group_concat( ( case 
//                                        when p.id is not null then op.order_id 
//                                        when ( p2.id is not null and {$alias_name}.id is not null and ( {$alias_name}.total_count = 0 or {$alias_name}.total_count> count(distinct {$log_alias_name}.id) then op.order_id  )   ) 
//                                    end ) ) as $alias_name",false);
            $record_sql->select(" min( case
                                        when p.id is not null then op.order_id 
                                        when p2.id is not null  and ( {$alias_name}.total_count=0 or {$alias_name}.total_count>if({$log_alias_name}.count>0,{$log_alias_name}.count,0) ) then o.id
                                   end 
                                 ) as $alias_name",false);
            $record_sql->join($this->product_packages->table_name." $alias_name","$alias_name.product_id=op.product_id and $alias_name.package_type = $package_type  ","left");
            $record_sql->join($this->listing_package_log->table_name." as {$log_alias_name}","{$log_alias_name}.listing_id = l.id and {$log_alias_name}.package_type = '{$package_type}' and {$log_alias_name}.status=".ACTIVE." and {$log_alias_name}.is_deleted=".NOT_DELETED." and {$log_alias_name}.order_id=op.order_id","left");
        }
        $record_sql->group_by("l.id");
        $record = $record_sql->get()->result_array();
        return array("records"=>$record);
    }
}
