<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class MY_Form_validation extends CI_Form_validation {
    public $CI;
    public function __construct(){
        parent::__construct();
    }
    public function is_unique($str, $field) {
        if (substr_count($field, '.') == 3) {
            list($table, $field, $id_field, $id_val) = explode('.', $field);
            $query = $this->CI->db->limit(1)->where($field, $str)->where("is_deleted",NOT_DELETED)->where($id_field . ' != ', $id_val)->get($table);
        } else {
            list($table, $field) = explode('.', $field);
            $query = $this->CI->db->limit(1)->get_where($table, array($field => $str,"is_deleted"=>NOT_DELETED));
        }

        return $query->num_rows() === 0;
    }

    public function is_not_empty($str) {
        return !empty(trim($str));
    }

    public function validate_domain($str) {
        if ((isset($_ENV['SANDBOX']) && $_ENV['SANDBOX'] == 1)) {
            return true;
        } else {
            $domain = substr(strrchr($str, "@"), 1);
            $restricted_domains = array('guerrillamail.com',
                'dispostable.com',
                'mintemail.com',
                'maildrop.cc',
                'harakirimail.com',
                'mailnesia.com',
                'mytrashmail.com',
                'tempr.email',
                'temp-mail.org',
                'getnada.com',
                'mailinator.com',
            );
            if (!in_array($domain, $restricted_domains)) {
                return true;
            } else {
                return false;
            }
        }
    }
    
    public function check_duplicate_phone($str, $field){
        echo $str;
        die;
    }

}

// END MY Form Validation Class

/* End of file MY_Form_validation.php */
/* Location: ./application/libraries/MY_Form_validation.php */  