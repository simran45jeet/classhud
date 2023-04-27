<?php  if ( ! defined('BASEPATH')) exit("No direct script access allowed");

class Migrate extends MY_Controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->library('migration');
  }

  public function index()
  {
    

  
    $this->db->query("SET FOREIGN_KEY_CHECKS = 0");
    if(!$this->migration->latest()) 
    {
      show_error($this->migration->error_string());
    }else
    {
        echo "Migrations added successfully.";
    }
    $this->db->query("SET FOREIGN_KEY_CHECKS = 1");

  }

  /*public function downAll()
    {
        $this->db->query("SET FOREIGN_KEY_CHECKS = 0");
        if ($this->migration->current() === FALSE)
        {
                show_error($this->migration->error_string());
        }
        $this->db->query("SET FOREIGN_KEY_CHECKS = 1");
    }*/

    public function version($version,$pass = '')
    {
        if($pass === 'migrationversion123')
        {
            $this->db->query("SET FOREIGN_KEY_CHECKS = 0");
            $this->migration->version($version, 'down');
            $this->db->query("SET FOREIGN_KEY_CHECKS = 1");
            echo "migration version Changed";
        }else
        {
            echo "Failed to migrate";
        }
        
    }

    public function create($name)
    {
      if(preg_match('/^[a-z_]+$/',$name))
      {
       echo  $file_path = FCPATH.'application/migrations/'.date('YmdHis').'_'.$name.'.php';
        $name = str_replace(' ','_',ucwords(str_replace('_',' ',$name)));
        $migration_class_data = 
        '<?php      
defined(\'BASEPATH\') OR exit(\'No direct script access allowed\');

class Migration_'.$name.' extends CI_Migration {

  public function up()
  {
      
      
  }

  public function down()
  {
      
  }
}';
        if(file_put_contents($file_path,$migration_class_data)){
          chmod($file_path,0777);
          echo 'Migration succefully created.';
        }else{
          echo 'Unable to create file.';
        }
        
      }else
      {
        die('Invalid Name (use small letters and underscore only)');
      }
      
    }

    // function register_migrations(){
    //   $this->migration->_register_migrations();
    // }
}