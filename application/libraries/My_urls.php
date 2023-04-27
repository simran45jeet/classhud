<?php
class My_urls
{
    private $CI;
    function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('short_urls_model');
    }
    
    public function shortit($url,$user_id,$table_name='',$table_id = 0)
    {
        if(!empty($table_name) &&!empty($table_id))
        {
            $data = $this->CI->short_urls_model->getRow(['table' =>$table_name,'t_id' =>$table_id],['id','short_url']);
            if(!empty($data))
            {
                $this->CI->short_urls_model->update(['url' =>$url,'modified_by'=> $user_id,'modified_on' =>date(DEFAULT_DATETIME_FORMAT)],$data['id']);
                return  SHORT_DOMAIN.$data['short_url'];
            }else
            {
                $short_url = $this->uniqueShortUrl();
                $this->CI->short_urls_model->insert(['url' =>$url,'short_url' =>$short_url,'table' =>$table_name,'t_id' =>$table_id,'created_by'=> $user_id,'modified_by'=> $user_id,'created_on' =>date(DEFAULT_DATETIME_FORMAT),'modified_on' =>date(DEFAULT_DATETIME_FORMAT)]);
                return  SHORT_DOMAIN.$short_url;
            }
        }else
        {
            $data = $this->CI->short_urls_model->getRow(['url' =>$url],['short_url']);
            if(!empty($data))
            {
                return  SHORT_DOMAIN.$data['short_url'];
            }else
            {
                $short_url = $this->uniqueShortUrl();
                $this->CI->short_urls_model->insert(['url' =>$url,'short_url' =>$short_url,'table' =>$table_name,'t_id' =>$table_id,'created_by'=> $user_id,'modified_by'=> $user_id,'created_on' =>date(DEFAULT_DATETIME_FORMAT),'modified_on' =>date(DEFAULT_DATETIME_FORMAT)]);
                return  SHORT_DOMAIN.$short_url;
            }
        }
    }

    private function uniqueShortUrl($length = 6 ,$tried_num =1 )
    { 
        $short_url = strtoupper(generateRandomString($length));
        $data = $this->CI->short_urls_model->isExist(['short_url' => $short_url]);
        if($data === false)
        {   
            return $short_url;
        }else
        {
            if($tried_num === 3)
            {
                $length++;
            }
            $tried_num++;
            //If random generated invoice number was found more than 3 times incriment the length of invoice number by one
            return $this->uniqueShortUrl($length ,$tried_num);
        }
    }
}