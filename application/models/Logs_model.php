<?php
class Logs_model extends MY_Model 
{
    public function __construct()
    {
        parent::__construct(); 
        $this->table_name = 'logs';
        $this->logAction = False; //This is incredibly important for this model, always keep it false
    }
    
}
