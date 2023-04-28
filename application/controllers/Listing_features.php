<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once FCPATH.'dompdf/vendor/autoload.php';
use Dompdf\Dompdf;
class Listing_features extends MY_Controller { 
    public $layout_view = "layout/dashboard_web";
    
    public function __construct() {
        
        parent::__construct();
        
        $this->data = array("module_name"=>$this->module_name,"controller_name"=>$this->controller_name);
        $this->load->module("main/listing_main");
        $this->load->module("main/users_main");
        
        $user_menu_response = $this->users_main->user_dashboard_menus(encrypt($this->user_data["id"]));
        if( $user_menu_response["flag"]==FLAG_SUCCESS ){
            $this->data["dashboard_menus"] = $user_menu_response["data"];
        }
        
    }
    
    public function listing_banner(){
        $pacakages = array("banner"=>PRODUCT_PACKAGE_TYPE_BANNER);
        $paid_order_packages = $this->listing_main->get_paid_listing($this->user_data["id"],$pacakages );
        $this->data["paid_listing"] = $this->data["paid_order_packages"] = array();
        if( $paid_order_packages["flag"]==FLAG_SUCCESS ) {
//            $pacakages = StaticArrays::$product_packages;
            foreach( $paid_order_packages["data"] as $key=>$listing_packages ){
                //$paid_order_packages["data"]["cover_image_url"] = 
                $listing_id = $listing_packages["id"];
                $package_key = "banner_package";
                $this->data["paid_order_packages"]["package_".PRODUCT_PACKAGE_TYPE_BANNER] = 1;
                $this->data["paid_listing"][$listing_id]["package_".PRODUCT_PACKAGE_TYPE_BANNER]=$listing_packages[$package_key];
            }

            $this->data["records"] = $paid_order_packages["data"];   
        }
        $this->layout->view("{$this->module_name}/listing_features/listing_banner",$this->data);
    }
    
    public function listing_benner_setting($encoded_id){
        $this->load->model("listing_setting_model","listing_setting");
        $listing_id = decrypt($encoded_id);
        $listing_setting = $this->listing_setting->get_record($listing_id)["record"];
        $this->data["post_data"] = $listing_setting;
        $this->data["main_form_url"] = base_url("{$this->controller_name}/listing_benner_setting/{$encoded_id}");
        if( !empty($this->post_data) ){
            
            if( !empty($listing_setting) ){
                $this->listing_setting->upload_banner_setting($this->post_data,$listing_id,$this->user_data["id"]);
                $lang = "message_update_success";
            }else{
                
                $this->listing_setting->insert_banner_setting($this->post_data,$listing_id,$this->user_data["id"]);
                $lang = "message_insert_success";
            }
            success($this->lang->line($lang));
            redirect("{$this->controller_name}/listing_banner");
            
        }
        $this->layout->view("{$this->module_name}/{$this->controller_name}/listing_benner_setting",$this->data);       
    }
    
    public function banner_list($encoded_id){
        $listing_id = decrypt($encoded_id);
        $this->data["encoded_id"] = $encoded_id;
        $paid_listing = $this->listing_main->is_paid_listing($encoded_id,PRODUCT_PACKAGE_TYPE_BANNER);
        if( $paid_listing["flag"]==FLAG_SUCCESS ) {
            $this->load->model("banners_model","banners");
            $banners = $this->banners->get_records(array("date"=>date("Y-m-d")));
            $this->data["banners"] = $banners["records"];
            $this->layout->view("{$this->module_name}/{$this->controller_name}/banner_list",$this->data);
        }else{
            redirect("dashboard");
        }
    }
    
    public function download_banner($encoded_banner_id,$encoded_id){
        
        $listing_id = decrypt($encoded_id);
        $banner_id = decrypt($encoded_banner_id);
        
        $paid_listing = $this->listing_main->is_paid_listing($encoded_id,PRODUCT_PACKAGE_TYPE_BANNER);
        
        if( $paid_listing["flag"]==FLAG_SUCCESS ) {
            $this->load->model("listing_setting_model","listing_setting");
            $this->load->model("banners_model","banners");
            $listing_setting = $this->listing_setting->get_record($listing_id)["record"];
            
            $font_file = FCPATH.BASE_WEB_FONTS_PATH . "/Poppins-SemiBold.ttf"; // CHANGE TO YOUR OWN!
            
            $banner_data = $this->banners->get_record($banner_id)["record"];
            
            if( !empty($banner_data) ) {
                $banner_image = $banner_data["image"];
                $banner_ext = strtolower( end(explode(".",$banner_image)) );
                if( $banner_ext=="jpg" || $banner_ext=="jpeg" ) {
                    $dest = imagecreatefromjpeg(FCPATH.BASE_BANNER_IMAGES_PATH.$banner_image);
                }else if( $banner_ext=="png" ){
                    $dest = imagecreatefrompng(FCPATH.BASE_BANNER_IMAGES_PATH.$banner_image);
                }
                $image_width = imagesx($dest);
                $image_height = imagesy($dest);

                $angle = 0;
                /*write Text 1*/
                $font_size = 32;
                $text_box = imagettfbbox( $font_size, $angle, $font_file, $listing_setting["banner_field_one_value"] );
                $text_width = $text_box[2] - $text_box[0];
                $text_height = $text_box[7] - $text_box[1];
                $pos_y = 915; $font_size = 32;
                //$font_color = imagecolorallocate($dest, 255, 255, 255);;//white
                $font_color="000";
                
                //$pos_x = 0;                 
                $pos_x = ($image_width-50 - $text_width) / 2;
                
                imagettftext($dest, $font_size, $angle, $pos_x, $pos_y, $font_color, $font_file, $listing_setting["banner_field_one_value"]);
                /*write Text 1*/
                
                /*write Text 2*/
                $font_size = 25;
                $text_height = $text_box[7] - $text_box[1];
                $pos_y = 980; 
                $text_box = imagettfbbox( $font_size, $angle, $font_file, $listing_setting["banner_field_two_value"] );
                $text_width = $text_box[2] - $text_box[0];
                $font_color = imagecolorallocate($dest, 255, 255, 255);//white
//                $font_color="000";//black
                $pos_x = ($image_width-25 - $text_width) / 2;
                imagettftext($dest, $font_size, $angle, $pos_x, $pos_y, $font_color, $font_file, $listing_setting["banner_field_two_value"]);
                /*write Text 2*/
                
                
                /*write Text 3*/
                $font_size = 32;
                $text_box = imagettfbbox( $font_size, $angle, $font_file, $listing_setting["banner_field_three_value"] );
                $text_width = $text_box[2] - $text_box[0];
                $text_height = $text_box[7] - $text_box[1];
                $pos_y = 1050; $font_size = 32;
                //$font_color = imagecolorallocate($dest, 255, 255, 255);;//white
                $font_color="000";
                
                //$pos_x = 0;                 
                $pos_x = ($image_width-50 - $text_width) / 2;
                
                imagettftext($dest, $font_size, $angle, $pos_x, $pos_y, $font_color, $font_file, $listing_setting["banner_field_three_value"]);
                /*write Text 3*/
                
                
                if( !empty($listing_setting["logo"]) ) {
                    $listing_logo = FCPATH . BASE_LISTING_LOGO_PATH.$listing_setting["logo"];
                    $listing_logo_detail = getimagesize($listing_logo);
                    $listing_logo_width = $listing_logo_detail[0];
                    $listing_logo_height = $listing_logo_detail[1];
                    $listing_logo_type = $listing_logo_detail['mime'];
                    $png_image = 0;
                    if ( $listing_logo_type == "image/png" ) {
                        $listing_logo_src = imagecreatefrompng($listing_logo);
                        $png_image = 1;
                    } else {
                        $listing_logo_src = imagecreatefromjpeg($listing_logo);
                    }
                    
                    $logo_width = $logo_hidth = 100;
                    $thum_width = $listing_logo_width > $logo_width ? $logo_width : $listing_logo_width;
                    $thum_height = (int) ($thum_width / $listing_logo_width * $listing_logo_height);
                    $thumb_src = imagecreatetruecolor($thum_width, $thum_height);
                    if ($png_image == 1) {
                        imagealphablending($thumb_src, false);
                        imagesavealpha($thumb_src, true);
                        $transparent = imagecolorallocatealpha($thumb_src, 255, 255, 255, 127);
                        imagefilledrectangle($thumb_src, 0, 0, $thum_width, $thum_height, $transparent);
                    }
                    imagecopyresampled($thumb_src, $listing_logo_src, 0, 0, 0, 0, $thum_width, $thum_height, $listing_logo_width, $listing_logo_height); //create thumb
                    if( $listing_setting["logo_position"]==LISTING_LOGO_POSITION_TOP_LEFT || empty($listing_setting["logo_position"]) ) {
                        $left_margin = 20;    
                    }elseif( $listing_setting["logo_position"]==LISTING_LOGO_POSITION_TOP_CENTER ){
                        $left_margin = ($image_width-$thum_width)/2;    
                    }else{
                        $left_margin = ($image_width-$thum_width-20);    
                    }
                    imagecopy($dest, $thumb_src, $left_margin, 20, 0, 0, $thum_width, $thum_height);
                }
                $order_id = $paid_listing["data"]["order_id"];
                $this->listing_main->track_listing_banner_download($order_id,$encoded_id,$encoded_banner_id);
                if( $banner_ext=="jpg" || $banner_ext=="jpeg" ) {
                    header("Content-Type: image/jpeg");
                    imagejpeg($dest);
                }else if( $banner_ext=="png" ){
                    header("Content-Type: image/png");
                    imagepng($dest);
                }
                die;
            }else{
                redirect("dashboard");
            }
        }else{
            redirect("dashboard");
        }
    }
    
    /*ecard*/
    public function listing_ecard(){
        $pacakages = array("ecard"=>PRODUCT_PACKAGE_TYPE_ECARD);
        $paid_order_packages = $this->listing_main->get_paid_listing($this->user_data["id"],$pacakages );
        
        if( $paid_order_packages["flag"]==FLAG_SUCCESS ) {
            $pacakages = array("ecard"=>PRODUCT_PACKAGE_TYPE_ECARD);
            foreach( $paid_order_packages["data"] as $key=>$listing_packages ){
                //$paid_order_packages["data"]["cover_image_url"] = 
                $listing_id = $listing_packages["id"];
                
                $package_key = "ecard_package";
                if( array_key_exists($package_key, $listing_packages) && !empty($listing_packages[$package_key]) ) {
                    $this->data["paid_order_packages"]["package_{$package_type}"] = 1;
                    $this->data["paid_listing"][$listing_id]["package_{$package_type}"]=$listing_packages[$package_key];
                }else{
                    unset($paid_order_packages["data"][$key]);
                }

            }
            $this->data["records"] = $paid_order_packages["data"];   
        }
        
        $this->layout->view("{$this->module_name}/listing_features/listing_ecard",$this->data);
    }
    
    public function download_ecard($encoded_id){
        $listing_id = decrypt($encoded_id);
        $paid_listing = $this->listing_main->is_paid_listing($encoded_id,PRODUCT_PACKAGE_TYPE_ECARD);
//        __print($paid_listing);
        if( $paid_listing["flag"]==FLAG_SUCCESS ) {
            $this->data["record"] = $this->listing_main->get_record($encoded_id)["data"];
            $this->data["download"] = true;
            $this->load->view("{$this->module_name}/listing_features/download_ecard",$this->data);
            $this->listing_main->package_log_id($paid_listing["data"]["order_id"],$encoded_id,PRODUCT_PACKAGE_TYPE_ECARD);
        }else{
            redirect("dashboard");
        }
    }
    /*ecard*/
    
    /*certificate*/
    public function listing_certificate(){
        $pacakages = array("ecard"=>PRODUCT_PACKAGE_TYPE_CERTIFICATE);
        $paid_order_packages = $this->listing_main->get_paid_listing($this->user_data["id"],$pacakages );
        if( $paid_order_packages["flag"]==FLAG_SUCCESS ) {
            $pacakages = array("ecard"=>PRODUCT_PACKAGE_TYPE_ECARD);
            foreach( $paid_order_packages["data"] as $key=>$listing_packages ){
                //$paid_order_packages["data"]["cover_image_url"] = 
                $listing_id = $listing_packages["id"];
                
                $package_key = "ecard_package";
                if( array_key_exists($package_key, $listing_packages) && !empty($listing_packages[$package_key]) ) {
                    $this->data["paid_order_packages"]["package_{$package_type}"] = 1;
                    $this->data["paid_listing"][$listing_id]["package_{$package_type}"]=$listing_packages[$package_key];
                }else{
                    unset($paid_order_packages["data"][$key]);
                }

            }
            $this->data["records"] = $paid_order_packages["data"];   
        }
        
        $this->layout->view("{$this->module_name}/listing_features/listing_certificate",$this->data);
    }
    
    public function download_certificate($encoded_id){
        $listing_id = decrypt($encoded_id);
        $paid_listing = $this->listing_main->is_paid_listing($encoded_id,PRODUCT_PACKAGE_TYPE_CERTIFICATE);
        
        if( $paid_listing["flag"]==FLAG_SUCCESS ) {
            $this->data["record"] = $this->listing_main->get_record($encoded_id)["data"];
            
            $font_file = FCPATH.BASE_WEB_FONTS_PATH . "/Khand-Bold.ttf"; // CHANGE TO YOUR OWN!
            $banner_image = BASE_WEB_IMAGES_PATH."certificate-classhud.jpg";
            $dest = imagecreatefromjpeg(FCPATH.$banner_image);

            $image_width = imagesx($dest);
            $image_height = imagesy($dest);
            $angle = 0;
            
            /*write Text*/
            $font_size = 60;
            $text_box = imagettfbbox( $font_size, $angle, $font_file, $this->data["record"]["name"] );            
            $text_width = $text_box[2] - $text_box[0];
            $text_height = $text_box[7] - $text_box[1];
            $pos_y = 735;
            //$font_color = imagecolorallocate($dest, 255, 255, 255);;//white
            $color = $this->__hexToRgb("#9B6F27");
            $font_color = imagecolorallocate($dest, $color['r'], $color['g'], $color['b']);
            //$pos_x = 0;                 
            $pos_x = ($image_width/2) - ($text_width/2);
            imagettftext($dest, $font_size, $angle, $pos_x, $pos_y, $font_color, $font_file, $this->data["record"]["name"] );
            /*write Text 1*/
            
            /*print qrcode*/
            if( !empty($this->data["record"]["qrcode_image"]) ) {
                
                $src = imagecreatefrompng(base_url(BASE_QRCODE_IMAGE_PATH.$this->data["record"]["qrcode_image"]));
                $srcNew = imagecreatetruecolor(262, 262);
                imagecopyresampled($srcNew, $src, 0, 0, 0, 0, 262, 262, 450, 450);
                // Copy and merge
                imagecopymerge($dest, $srcNew, 1038, 1240, 0, 0, 262, 262, 100);
            }
            /*print qrcode*/
            
            header("Content-Type: image/jpeg");
            imagejpeg($dest);
            die;
            $this->listing_main->package_log_id($paid_listing["data"]["order_id"],$encoded_id,PRODUCT_PACKAGE_TYPE_CERTIFICATE);
        }else{
            redirect("dashboard");
        }
    }
    private function __hexToRgb($color) {
        $color = trim($color);
        $result = false;

        $hex = str_replace('#', '', $color);
        if (!$hex)
            return array('r' => 0, 'g' => 0, 'b' => 0);
        if (strlen($hex) == 3) {
            $result['r'] = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $result['g'] = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $result['b'] = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $result['r'] = hexdec(substr($hex, 0, 2));
            $result['g'] = hexdec(substr($hex, 2, 2));
            $result['b'] = hexdec(substr($hex, 4, 2));
        }
        return $result;
    }
    /*certificate*/
}