<?php
class Tags_model extends MY_Model {
    private $type=TAGS_TYPES_LISTING;
    public function __construct() {
        parent::__construct();
        $this->table_name = 'tbl_tags';
        $this->table_title = 'Tag';
    }
    
    public function get_tag_id($tag_name){
        $recordSql = $this->db->select("id")
                    ->from($this->table_name)
                    ->where(array("name"=>$tag_name,"is_deleted"=>NOT_DELETED));
        $record  = $recordSql->order_by("id","asc")->get()->row_array();
        return array("record"=>$record );
    }
    
    public function add_tag($tag_name,$user_id){
        $insert_data = array(
            "name"=>$tag_name,
            "created_by"=>$user_id,
            "created_at"=>SQL_ADDED_DATE,
            "status"=>ACTIVE,
            "ip_address" => getVisitorIp()
        );
        return $this->insert($insert_data);
    }
    
}