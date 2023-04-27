<?php
Class Url_Translate {
    static $ci,$replaceCounter,$module_dir;
    private $lang_code,$lang_route,$module;
    public function __construct(){
        if( empty(self::$ci) ){
            self::$ci=& get_instance();
            self::$module_dir = self::$ci->router->directory;
        }
        $this->CI = self::$ci;
        $this->lang_code=$this->CI->router->lang_code;
        $this->lang_route = $this->CI->router->lang_route;
        $this->module = strtolower($this->CI->router->fetch_class());
    }
    
    public function get_lang_code(){
        return $this->lang_code;
    }
    
    public function uri_segment($segment){
        if( !empty($this->get_lang_code()) ) {
            $segment++;
        }
        return $this->CI->uri->segment($segment);
    }
    
    function convertUrl($uri=""){
        $url_parms = array();
        if( strpos($uri,'#') !==false ){
            $url_parms = explode('#',$uri);
            $uri = $url_parms[0];
            $hash_string = $url_parms[1];
            
        }
        
        if( strpos($uri,'?') !==false ){
            $url_parms = explode('?',$uri);
            $uri = $url_parms[0];
            $query_ry_string = $url_parms[1];
        }
        
        $original_url = $uri;
        $uri = trim($uri,'/');
        if( str_replace($uri, '', $original_url)!='' ) {///means still has / at end and it will be return
            $last_char =  str_replace($uri, '', $original_url) ;
        }
        
        foreach( $this->lang_route as $key=>$val_arr ) {
            if( is_array($val_arr) ) {
                $val = key($val_arr);
            }else{
                $val = $val_arr;
            }
           
            
            $pattren = '#^'.preg_replace('/\$([0-9]+)/','([^/]+)',$val).'$#';
            
            if ( preg_match($pattren, $uri, $matches) ) {
                
                $key = str_replace(array('(:any)','(:num)'),':any',$key);
                $key = preg_replace_callback('/:any/', array($this,'replaceCounter'), $key);
                $this->resetReplaceCounter();

                $replace_counter = 0;

                $uri =  preg_replace($pattren,$key,$uri);
                $uri = trim($this->lang_code.'/'.$uri,'/');
                if( isset($last_char) ) {
                    $uri.=$last_char;
                } 
                $uri = trim($uri,'/');
                if( isset($query_ry_string) ) {
                    $uri.='?'.$query_ry_string;
                }
                if( isset($hash_string) ) {
                    $uri.='#'.$hash_string;
                }
                return base_url($uri);
            }
        }
        $uri = trim($uri,'/');
        $uri = trim($this->lang_code.'/'.$uri,'/');
         if( isset($last_char) ) {
            $uri.=$last_char;
        } 
        if( isset($query_ry_string) ) {
            $uri.='?'.$query_ry_string;
        }
        if( isset($hash_string) ) {
            $uri.='#'.$hash_string;
        }
        return base_url($uri);
    }
    
    private function replaceCounter($data){
        static $replace_counter;   
        return '$'.(++self::$replaceCounter);
    }
    private function resetReplaceCounter(){
        self::$replaceCounter = 0;
    }
    function isModuleApi(){
        return isModuleApi($this->module);
    }
    function isModuleSuperadmin(){        
        $dir = str_replace('../','',self::$module_dir);// example : ../modules/superadmin/controllers/
        $dirArr = explode('/',$dir);
        if( in_array($this->uri_segment(1),array(SUPERADMIN,'superadmin','admin_new')) ){
            return true;
        }elseif( in_array($dirArr[1],array(SUPERADMIN,'superadmin','admin_new')) ){
            return true;
        }elseif( in_array($dirArr[0],array(SUPERADMIN,'superadmin','admin_new')) ){
            return true;
        }else{
            return false;
        }        
    }
    
    function convertLangRoute2Url($route,$lang_code='') {
        $route = trim($route,'/');
        $lang_code = empty($lang_code) ? $this->get_lang_code():$lang_code;
        if( $lang_code==$this->get_lang_code() ) {
            $lang_rotes = $this->lang_route;
        }else{;
            $file = is_file(DIR_WS_URL_TRANSLATION_ROUTES.$lang_code.'_url.php')?DIR_WS_URL_TRANSLATION_ROUTES.$lang_code.'_url.php' : DIR_WS_URL_TRANSLATION_ROUTES.DEFAULT_LANGUAUGE_WEB.'_url.php';
            include $file;
            $lang_rotes = $lang_route;
        }
        foreach( $lang_rotes as $key=>$varArr ) {
            if( is_array($varArr) ){
                $val = current($varArr);
            }else{
                $val = $varArr;
            }
            $pattren = '#^'.preg_replace('/\$([0-9]+)/','([^/]+)',$val).'$#';
            if ( preg_match($pattren, $route, $matches) ) {
                $key = str_replace(array('(:any)','(:num)'),':any',$key);
                $key = preg_replace_callback('/:any/', array($this,'replaceCounter'), $key);
                $this->resetReplaceCounter();
                
                $route =  preg_replace($pattren,$key,$route);
                $route = str_replace($lang_code.'/','',$route);
                return trim( base_url($lang_code.'/'.$route),'/' );
            }
        }
        
        return trim( base_url($lang_code.'/'.$route),"/" );
        
    }
    
    function convertSuperadminUrl($uri=''){
        $superadminUrlArr = explode('/', trim( str_replace( base_url(),'', superadmin_url($uri) ) ,'/') );
        $superadminUrlArr[0] = 'superadmin';
        $superadminUrl = implode('/',$superadminUrlArr);
        
        foreach( $this->lang_route as $key=>$val_arr ) {
            
            if( is_array($val_arr) ) {
                $val = key($val_arr);
            }else{
                $val = $val_arr;
            }
            $pattren = '#^'.preg_replace('/\$([0-9]+)/','([^/]+)',$val).'$#';
            if ( preg_match($pattren, $superadminUrl, $matches) ) {
                $key = str_replace(array('(:any)','(:num)','(.*)'),':any',$key);
                $key = preg_replace_callback('/:any/', array($this,'replaceCounter'), $key);
                $this->resetReplaceCounter();
                
                $route =  preg_replace($pattren,$key,$superadminUrl);
                if( !empty( $this->get_lang_code()) ){
                    $route = str_replace($this->get_lang_code().'/','',$route);                    
                }
                
                return base_url($this->get_lang_code().'/'.$route);
            }
        }
        
        $uri = trim($this->get_lang_code().'/'.$uri,'/');
        return base_url($uri);
    }
}
