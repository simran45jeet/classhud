<?php
class MY_Model extends CI_Model {

    public $table_name = '';
    public $logAction = True;
    function __construct()
    {
        parent::__construct();
    }

    public function delete($where)
    { 
        // $data = $where; // To avoid consfusions in further code.
        try{
            if(!is_array($where))
            {
                $where = ['id' => $where];
            }

            $prev_data =  $this->getLogData($where)['data'];
            $id = NULL;
            if($prev_data['id']){
                $id = $prev_data['id'];
            }
            $query = $this->db->delete($this->table_name, $where);
            $this->__logIt($this->logAction, $prev_data, [], $this->table_name, $id, ACTION_DELETE);
            if($query){
              return true;
            }else
            {
                return false;
            }
        }catch(Exception $e) {
            return false;
        }
        
    }

    public function insert($data)  {

        $query = $this->db->insert($this->table_name,$data);
        // echo $sql = $this->db->set($data)->get_compiled_insert($this->table_name);
        // die;
        if($query){
            $id =  $this->db->insert_id();
            $new_data =  $this->getLogData($id)['data'];
            $this->__logIt($this->logAction, [], $new_data, $this->table_name, $id, ACTION_INSERT);
            return $id;
        }else
        {
            return false;
        }
    }

    public function insertRows($data)
    {
        $query = $this->db->insert_batch($this->table_name, $data); 
        if($query){
            $this->__logIt($this->logAction, [], $data, $this->table_name, NULL, ACTION_INSERT);
            return true;
        }else
        {
            return false;
        }
    }
    
    public function update_in($data,$where)
    {
        $prev_data =  $this->getLogData($where)['data'];
        $query = $this->db->set($data)
        ->where_in('id',$where)
        ->update($this->table_name);
        if($query)
        {
            $new_data = $this->getLogData($where)['data'];
            $id = NULL;
            if($prev_data['id']){
                $id = $prev_data['id'];
            }
            $this->__logIt($this->logAction, $prev_data, $new_data, $this->table_name, $id, ACTION_UPDATE);            
            return true;
        }else
        {
            return false;
        }
    }
    public function update($data,$where)
    {
        if(!is_array($where))
        {
            $where = ['id' => $where];
        }
        $prev_data =  $this->getLogData($where)['data'];
        $id = NULL;
        if($prev_data['id']){
            $id = $prev_data['id'];
        }
        if(!empty($data)){
            $query = $this->db->set($data)
            ->where($where)
            ->update($this->table_name);
        }
        if($query)
        {
            $new_data =  $this->getLogData($where)['data'];
            $this->__logIt($this->logAction, $prev_data, $new_data, $this->table_name, $id, ACTION_UPDATE);                   
            return true;
        }else
        {
            return false;
        }
    }

    public function updateRows($data,$field)
    {
        $query = $this->db->update_batch($this->table_name, $data, $field);
        if($query){
            return true;
        }else
        {
            return false;
        }
    }

    public function deleteRows($data,$field)
    {
        $query = $this->db->where_in($field, $data)
                    ->delete($this->table_name);
        if($query){
            return true;
        }else
        {
            return false;
        }
    }

    public function get_logs($object_id,$page_no=0,$limit=DEFAULT_API_PAGELIMIT,$pagination=false,$total_records=false) {
        $where = ['table_name' => $this->table_name, 'table_id' => $object_id];
        if( $pagination==true && $total_records===false  ) {
            $paging_data =api_paging($limit,$page_no);
            $this->db->limit($paging_data['limit'],$paging_data['start']);
        }
        $data = $this->db->select('l.*,concat(u.first_name," ",u.last_name) as full_name')
                        ->from('logs l')
                        ->join('users u' ,'u.id = l.created_by','left')
                        ->where($where)
                        ->order_by('l.id DESC')
                        ->get();
        if( $total_records===true ) {
            $result = $data->num_rows() ;
        }else{
            $result = $data->result_array() ;
        }
        return $result;
    }
    
    public function getRow($where,$fields=[],$order_col='id',$order_by='DESC'){
        if(!is_array($where))
        {
            $where = ['id' => $where];
        }
        if(!empty($fields) && is_array($fields))
        {
            $this->db->select(implode(',',$fields));
        }
        $this->db->from($this->table_name);
        $this->db->where($where);
        $this->db->order_by($order_col,$order_by);
        $this->db->limit(1);
        $result = $this->db->get()->row_array() ;
        if(isset( $result))
        {
            return $result;
        }else
        {
            return [];
        }
    }

    public function isExist($where){
        if(!is_array($where))
        {
            $where = ['id' => $where];
        }
        $this->db->select('count(id) as count');
        
        $data = $this->db->get_where( $this->table_name,$where,1);
        $result = $data->row_array() ;
        if( $result['count'] > 0)
        {
            return true;
        }else
        {
            return false;
        }
    }

    public function getCount($where = []){
        if(!is_array($where))
        {
            $where = ['id' => $where];
        }
        $this->db->select('count(id) as count');
        if(!empty($where))
        {
            $data = $this->db->get_where( $this->table_name,$where,1);
        }else
        {
            $data = $this->db->from($this->table_name)->get();
        }
        $result = $data->row_array() ;
        if(isset( $result['count']))
        {
            return $result['count'];
        }else
        {
            return 0;
        }
    }

    public function getCountWhereIn($column,$data){
        $this->db->select('count(id) as count');
        $this->db->from($this->table_name);
        
        $data = $this->db->where_in($column,$data)->get();
       
        $result = $data->row_array() ;
        if(isset( $result['count']))
        {
            return $result['count'];
        }else
        {
            return 0;
        }
    }
    
    public function getAllWhere($where,$fields= [],$limit = 0,$offset = 0,$order_col = '',$order_by = 'ASC' ){
        if(!is_array($where))
        {
            $where = ['id' => $where];
        }
        if(!empty($fields) && is_array($fields))
        {
            $this->db->select(implode(',',$fields));
        } 
        if(!empty($order_col))
        {
            $this->db->order_by( $order_col,$order_by);
        }
        if($limit && $offset)
        {
            $data = $this->db->get_where( $this->table_name,$where,$limit,$offset);
        }elseif($limit && !$offset)
        {
            $data = $this->db->get_where( $this->table_name,$where,$limit);
        }else
        {
            $data = $this->db->get_where( $this->table_name,$where);
        }
       
        $result = $data->result_array() ;
        return $result;
    }

    public function getAllWhereIn($where,$fields= [],$limit = 0,$offset = 0,$order_col = '',$order_by = 'ASC' ){
        if(!empty($where) && !is_array($where))
        {
            $where = explode(',', $where);
        } 
        if(!empty($fields) && is_array($fields))
        {
            $this->db->select(implode(',',$fields));
        }else{
            $this->db->select('*');
        } 
        $this->db->from($this->table_name);
        if(!empty($order_col))
        {
            $this->db->order_by($order_col,$order_by);
        }
        $this->db->where_in('id', $where);
        if($limit && $offset)
        {   
           $this->db->limit($limit,$offset);
        }elseif($limit && !$offset)
        {
            $this->db->limit($limit);
        }
        $data = $this->db->get();
        $result = $data->result_array() ;
        return $result;
    }
    public function getAllWhereNotIn($where,$fields= [],$limit = 0,$offset = 0,$order_col = '',$order_by = 'ASC' ){
        if(!empty($where) && !is_array($where))
        {
            $where = explode(',', $where);
        } 
        if(!empty($fields) && is_array($fields))
        {
            $this->db->select(implode(',',$fields));
        }else{
            $this->db->select('*');
        } 
        $this->db->from($this->table_name);
        if(!empty($order_col))
        {
            $this->db->order_by($order_col,$order_by);
        }
        $this->db->where_not_in('id', $where);
        if($limit && $offset)
        {   
           $this->db->limit($limit,$offset);
        }elseif($limit && !$offset)
        {
            $this->db->limit($limit);
        }
        $data = $this->db->get();
        $result = $data->result_array() ;
        return $result;
    }

    public function getAll($fields= [],$limit = 0,$offset = 0 ,$order_col = 'id',$order_by = 'DESC' ){
        if(!empty($fields) &&is_array($fields))
        {   
            $this->db->select(implode(',',$fields));
        }else{
            $this->db->select('*');
        }
        $this->db->from($this->table_name);
        if(!empty($order_col))
        {
            $this->db->order_by($order_col,$order_by);
        }
        if($limit && $offset)
        {   
           $this->db->limit($limit,$offset);
        }elseif($limit && !$offset)
        {
            $this->db->limit($limit);
        }
        $data = $this->db->get();
        $result = $data->result_array() ;
        return $result;
    }

    
    public function beginTransaction()
    {
        $this->db->trans_start();
    }

    public function commitTransaction()
    {
        $this->db->trans_complete();
    }

    public function transactionStatus()
    {
        return $this->db->trans_status();
    }

    private function getLogData($where){
        $data =  $this->getAllWhereIn($where);
        $id = FALSE;
        if(count($data ) == 1){
            $data  = $data [0];
            if(isset($data['id']) && !empty($data['id'])){
                $id = $data['id'];
            }
        }
        return ['data' => $data, 'id' => $id];
    }

    private function __logIt($logAction, $prev_data, $new_data, $table_name, $tableId, $type){
        if(empty($prev_data) && empty($new_data)){
            return;
        }
        
        if($logAction === True)
        { 
            $params = array('prev_data' => $prev_data, 'new_data' => $new_data, 'table_name' => $table_name);  
            if(!empty($tableId)){ 
                $params['table_id'] = $tableId;
            } 
            $params['table_title'] = $this->table_title;
            
            $this->load->library('my_logs');
            $this->my_logs->logIt($params, $type);
        }

    }
   
}