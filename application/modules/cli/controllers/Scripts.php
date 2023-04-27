<?php  if ( ! defined('BASEPATH')) exit("No direct script access allowed");

class Scripts extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function resetSuperadminPermissions(){
        $this->load->model('grouppermissions_model');
        $this->grouppermissions_model->delete(['group_id'=>SUPERADMIN_GROUP_ID]);
        $permissions = get_permission_list(true);
        $permissions = $permissions[SUPERADMIN];

       // $skip_permission = ['dashboard.topSellingProducts','dashboard.topFiveOrders','dashboard.getWeekSales','dashboard.restaurantViews'];
        $skip_permission = array('users.login');
        foreach($permissions as $key=>$val){
            foreach($val as $pval){
                if( !in_array($pval,$skip_permission) ){
                    $insert_data['group_id'] = SUPERADMIN_GROUP_ID;
                    $insert_data['name'] = $pval;
                    $insert_data['type'] = SUPERADMIN;
                    $insert_data['created_by'] = 0;
                    $insert_data['created_at'] = SQL_ADDED_DATE;
                    $this->grouppermissions_model->insert($insert_data); 
                }
            }
        }
        
//        $permissions = $this->config->item('permissions')['web'];
//        
//        foreach($permissions as $key=>$val){
//            foreach($val as $pval){
//                $insert_data['group_id'] = SUPERADMIN_GROUP_ID;
//                $insert_data['name'] = $pval;
//                $insert_data['type'] = 'web';
//                $this->grouppermissions_model->insert($insert_data); 
//            }
//        }
        echo "Permission added";
    }
    
    public function add_listing_missing_slug(){
        $this->load->model("listing_model","listing");
        $all_listing = $this->listing->getAllWhere(['id >'=>0,"slug"=>""]);
        $config = array(
            'table' => $this->listing->table_name,
            'id' => 'id',
            'field' => 'slug',
            'title' => 'name',
            'replacement' => 'dash' // Either dash or underscore
        );
        $this->load->library('slug', $config);
        foreach( $all_listing as $key=>$listing_data ) {
            $slug = $this->slug->create_uri($listing_data["name"]);
            $this->listing->update(array("slug"=>$slug),$listing_data["id"]);
        }
    }
	
	public function generate_sitemap(){
		generate_sitemap();
	}
	
        public function update_listing_meta_from_log(){
            die;
//		 set_time_limit("-1");
//ini_set('memory_limit ',100000);
        $this->load->model("listing_model","listing");
        $records = $this->db->select("id,name")
                            ->from("{$this->listing->table_name}")
                            ->where( "created_by",1 )
                            ->group_start()
                            ->where("meta_title",null)
                            ->or_where("meta_title","")
                            ->group_end()
							->order_by("id","desc")
                            ->get()->result_array();
		 foreach( $records as $key=>$listing_data ) {
		 	$listing_log_data = $this->db->select("post_data")
			 		->from("tbl_logs")
			 		->where( array(
						"table_name" => $this->listing->table_name,
						"table_id" =>$listing_data["id"],
						"db_action"=>"insert",
						"created_by"=>1
					) )->get()->row_array()["post_data"];
			 
			 $listing_log_data = preg_replace_callback(
							'!s:(\d+):"(.*?)";!s',
							function($m){
								$len = strlen($m[2]);
								$result = "s:$len:\"{$m[2]}\";";
								return $result;

							},
						$listing_log_data);


			 $listing_log_data = unserialize($listing_log_data);
			if( !empty($listing_log_data["meta_title"]) ) {
				$data = array(
						'meta_title' => $listing_log_data["meta_title"],
						'meta_keywords' => $listing_log_data["meta_keywords"],
						'meta_description' => $listing_log_data["meta_description"]
				);

				$this->db->where('id', $listing_data["id"]);
				$this->db->update('tbl_listing', $data);
				echo $listing_data["name"]."<br/>";
			}
		}
	__print($records);
    }
    
    public function read_cbse_listing(){
        $this->load->model("state_model","state");
        $start = 2130001;
        $end = 2230103;
//        $end = 2130002;
        $base_url = "https://saras.cbse.gov.in/cbse_aff/schdir_Report/AppViewdir.aspx?affno=";
        
        for( $i=$start;$i<=$end;$i++ ) {
            
            
            $description = "";
            $exists = false;
                   
            $exists = $this->db->get_where("tbl_listing_copy",array("affiliationl_no"=>$i) )->row_array();
       
       
            if( empty($exists) ) {
                $data = file_get_contents($base_url."$i");
                preg_match_all("/<table (.*?)>(.*?)<\/table>/si",$data,$matches);
                if( !empty($matches[0][0])  ) {
                    $data_table = $matches[0][0];

                    preg_match_all("/<tr>(.*?)<\/tr>/si",$data_table,$matches_tr);
                    if( !empty($matches_tr[0]) ) {
                        $sql_data = array("country"=>101);
                        foreach( $matches_tr[0] as $key => $tr_data) {
                            preg_match_all("/<td(.*?)>(.*?)<\/td>/si",$tr_data,$matches_td);
                            $matches_td = array_filter($matches_td);


                            if( !empty($matches_td[0]) ) {
                                $trName = trim( strip_tags($matches_td[0][0]) );
                                $trValue = trim( stripcslashes(strip_tags($matches_td[0][1])) );                        
                                if( $trName =="Name of Institution" ) {
                                    $description = "";
                                    $sql_data["name"] = $trValue;
                                }elseif( $trName=="State" ) {
                                    $sql_data["state"] = $this->state->getRow( array("name"=>strip_tags($trValue)) )["id"];
                                }elseif( $trName=="Postal Address" ) {
                                    $sql_data["full_address"] = $trValue;
                                    $sql_data["address"] = $trValue;
                                    $json = file_get_contents(GOOGLEAPI_MAP_URL."&address=".  urlencode($trValue));
                                    $location = json_decode($json,true);
                                    $sql_data["google_location"] = $location["results"][0]["formatted_address"]?:"";
                                    $sql_data["place_id"] = $location["results"][0]["place_id"]?:"";
                                    $sql_data["latitude"] = $location["results"][0]["geometry"]["location"]["lat"]?:0;
                                    $sql_data["longitude"] = $location["results"][0]["geometry"]["location"]["lng"]?:0;
                                }elseif( $trName=="Email" ) {
                                    $sql_data["primary_email"] = $trValue?:"";
                                }elseif( $trName=="Affiliation Number" ) {
                                    $sql_data["affiliationl_no"] = $trValue;
                                }

                                $description.="<tr>{$matches_td[0][0]}{$matches_td[0][1]}</tr>";

                                //echo $trName.' : '.$trValue."<br/>";
                            }
                        }
                        //$exists = false;
                        $sql_data["user_id"] = 0;
                        $sql_data["is_claimable"] = 0;
                        
                        $sql_data["description"] = $description;
                        $sql_data["created_by"]=1;
                        $sql_data["created_at"]=SQL_ADDED_DATE;
                        //if($exists == false) {
                            $this->db->insert("tbl_listing_copy",$sql_data);
                            $new_id =  $this->db->insert_id();
                            if( $new_id<=0  ){
                                echo $this->db->last_query()."\n";
                            }else{
                                echo "new id {$new_id}\n";
                            }
                        //}

                        //echo '<pre>';print_R($sql_data);
                    }   
                }else{
                    echo "not found $i\n";
                    continue;
                }
            }else{
                echo "old id {$exists["id"]}"."\n";

            }
        }

    }

    public function read_cbse_listing_temp(){
        $this->load->model("state_model","state");
        $start = 2230000;
        $end = 2230001;
//        $end = 2130002;
        $base_url = "https://saras.cbse.gov.in/cbse_aff/schdir_Report/AppViewdir.aspx?affno=";
        
        for( $i=$end;$i>=$start;$i-- ) {
            
            
            $description = "";
            $exists = false;
                   
            $exists = $this->db->get_where("tbl_listing_copy",array("affiliationl_no"=>$i) )->row_array();
       
       
            if( empty($exists) ) {
                $data = file_get_contents($base_url."$i");
                preg_match_all("/<table (.*?)>(.*?)<\/table>/si",$data,$matches);
                if( !empty($matches[0][0])  ) {
                    $data_table = $matches[0][0];

                    preg_match_all("/<tr>(.*?)<\/tr>/si",$data_table,$matches_tr);
                    if( !empty($matches_tr[0]) ) {
                        $sql_data = array("country"=>101);
                        foreach( $matches_tr[0] as $key => $tr_data) {
                            preg_match_all("/<td(.*?)>(.*?)<\/td>/si",$tr_data,$matches_td);
                            $matches_td = array_filter($matches_td);


                            if( !empty($matches_td[0]) ) {
                                $trName = trim( strip_tags($matches_td[0][0]) );
                                $trValue = trim( stripcslashes(strip_tags($matches_td[0][1])) );                        
                                if( $trName =="Name of Institution" ) {
                                    $description = "";
                                    $sql_data["name"] = $trValue;
                                }elseif( $trName=="State" ) {
                                    $sql_data["state"] = $this->state->getRow( array("name"=>strip_tags($trValue)) )["id"];
                                }elseif( $trName=="Postal Address" ) {
                                    $sql_data["full_address"] = $trValue;
                                    $sql_data["address"] = $trValue;
                                    $json = file_get_contents(GOOGLEAPI_MAP_URL."&address=".  urlencode($trValue));
                                    $location = json_decode($json,true);
                                    $sql_data["google_location"] = $location["results"][0]["formatted_address"]?:"";
                                    $sql_data["place_id"] = $location["results"][0]["place_id"]?:"";
                                    $sql_data["latitude"] = $location["results"][0]["geometry"]["location"]["lat"]?:0;
                                    $sql_data["longitude"] = $location["results"][0]["geometry"]["location"]["lng"]?:0;
                                }elseif( $trName=="Email" ) {
                                    $sql_data["primary_email"] = $trValue?:"";
                                }elseif( $trName=="Affiliation Number" ) {
                                    $sql_data["affiliationl_no"] = $trValue;
                                }

                                $description.="<tr>{$matches_td[0][0]}{$matches_td[0][1]}</tr>";

                                //echo $trName.' : '.$trValue."<br/>";
                            }
                        }
                        //$exists = false;
                        $sql_data["user_id"] = 0;
                        $sql_data["is_claimable"] = 0;
                        
                        $sql_data["description"] = $description;
                        $sql_data["created_by"]=1;
                        $sql_data["created_at"]=SQL_ADDED_DATE;
                        //if($exists == false) {
                            $this->db->insert("tbl_listing_copy",$sql_data);
                            $new_id =  $this->db->insert_id();
                            if( $new_id<=0  ){
                                echo $this->db->last_query()."\n";
                            }else{
                                echo "new id {$new_id}\n";
                            }
                        //}

                        //echo '<pre>';print_R($sql_data);
                    }   
                }else{
                    echo "not found\n";
                    continue;
                }
            }else{
                echo "old id {$exists["id"]}"."\n";

            }
        }

    }

    
    public function read_cbse_reverse(){
        $this->load->model("state_model","state");
        $start = 2130001;
        $end = 2205780;
//        $end = 2130002;
        $base_url = "https://saras.cbse.gov.in/cbse_aff/schdir_Report/AppViewdir.aspx?affno=";
        
        for( $i=$end;$i>=$start;$i-- ) {
            
            $description = "";
            $exists = false;
                   
            $exists = $this->db->get_where("tbl_listing_copy",array("affiliationl_no"=>$i) )->row_array();
       
       
            if( empty($exists) ) {
                $data = file_get_contents($base_url."$i");
                preg_match_all("/<table (.*?)>(.*?)<\/table>/si",$data,$matches);
                if( !empty($matches[0][0])  ) {
                    $data_table = $matches[0][0];

                    preg_match_all("/<tr>(.*?)<\/tr>/si",$data_table,$matches_tr);
                    if( !empty($matches_tr[0]) ) {
                        $sql_data = array("country"=>101);
                        foreach( $matches_tr[0] as $key => $tr_data) {
                            preg_match_all("/<td(.*?)>(.*?)<\/td>/si",$tr_data,$matches_td);
                            $matches_td = array_filter($matches_td);


                            if( !empty($matches_td[0]) ) {
                                $trName = trim( strip_tags($matches_td[0][0]) );
                                $trValue = trim( stripcslashes(strip_tags($matches_td[0][1])) );                        
                                if( $trName =="Name of Institution" ) {
                                    $description = "";
                                    $sql_data["name"] = $trValue;
                                }elseif( $trName=="State" ) {
                                    $sql_data["state"] = $this->state->getRow( array("name"=>strip_tags($trValue)) )["id"];
                                }elseif( $trName=="Postal Address" ) {
                                    $sql_data["full_address"] = $trValue;
                                    $sql_data["address"] = $trValue;
                                    $json = file_get_contents(GOOGLEAPI_MAP_URL."&address=".  urlencode($trValue));
                                    $location = json_decode($json,true);
                                    $sql_data["google_location"] = $location["results"][0]["formatted_address"]?:"";
                                    $sql_data["place_id"] = $location["results"][0]["place_id"]?:"";
                                    $sql_data["latitude"] = $location["results"][0]["geometry"]["location"]["lat"]?:0;
                                    $sql_data["longitude"] = $location["results"][0]["geometry"]["location"]["lng"]?:0;
                                }elseif( $trName=="Email" ) {
                                    $sql_data["primary_email"] = $trValue?:"";
                                }elseif( $trName=="Affiliation Number" ) {
                                    $sql_data["affiliationl_no"] = $trValue;
                                }

                                $description.="<tr>{$matches_td[0][0]}{$matches_td[0][1]}</tr>";

                                //echo $trName.' : '.$trValue."<br/>";
                            }
                        }
                        //$exists = false;
                        $sql_data["user_id"] = 0;
                        $sql_data["is_claimable"] = 0;
                        
                        $sql_data["description"] = $description;
                        $sql_data["created_by"]=1;
                        $sql_data["created_at"]=SQL_ADDED_DATE;
                        //if($exists == false) {
                            $this->db->insert("tbl_listing_copy",$sql_data);
                            $new_id =  $this->db->insert_id();
                            if( $new_id<=0  ){
                                echo $this->db->last_query()."\n";
                            }else{
                                echo "new id {$new_id}\n";
                            }
                        //}

                        //echo '<pre>';print_R($sql_data);
                    }   
                }else{
                    echo "not found $i\n";
                    continue;
                }
            }else{
                echo "old id {$exists["id"]}"."\n";

            }
        }

    }
    
    public function set_listing_users(){
        $this->load->model("listing_model","listing");
        $this->load->model("listing_users_model","listing_users");
        $this->load->model("users_model","users");
        $records = $this->db->select("u.id,u.full_name,u.phone_no,l.id as listing_id")
                                ->from($this->listing->table_name." l")
                                ->join($this->listing_users->table_name." lu","lu.listing_id = l.id and lu.is_deleted = ".NOT_DELETED,"LEFT")
                                ->join($this->users->table_name." u","u.id=l.user_id")
                                
                                ->where(array("u.is_deleted"=>NOT_DELETED,"u.group_id"=>CUSTOMER_GROUP_ID,"lu.id"=>NULL))
                                ->get()->result_array();
        if( !empty($records) ) {
            foreach( $records as $key=>$listing_user ) {
                $listing_user_data = array(
                    "user_id"=>$listing_user["id"],
                    "status"=>ACTIVE,
                );
                
                $this->listing_users->add_listing_user($listing_user["listing_id"],$listing_user_data,$listing_user["id"]);
            }
        }
       
    }
    
    public function convert_svg(){
        $this->load->view("svg2png");
    }
}
