<?php
require __DIR__ . '/thermal_printer/autoload.php';
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\ImagickEscposImage;
use Mike42\Escpos\EscposImage;
class Printit
{
    private $data = '';
    private $printer;
    private $align = [
        'center' => 1,
        'left' => 0,
        'right' => 2
    ];
    function __construct()
    {
        $this->init();
    }
    
    public function init()
    {
        $this->printer = new Printer();
        $this->data .= "\x1b"."@";
    }
    public function loadFile($image_path = '')
    {
        if(!empty($image_path))
        {
            $this->loadImage($image_path);
        } 
    }

    public function addBlankLines($line = 1)
    {
        $this->data.= $this->printer->feed($line); 
    }

    public function addText($str)
    {
        $this->data.= $this->printer->text($str); 
    }

    public function addTextLine($str)
    {
        $this->data.= $this->printer->text($str); 
        $this->addBlankLines();
    }

    public function addHashedLine($printer_width = 550)
    {
        $char_length = (int) ((MAX_CHAR_LENGTH / DEFAULT_PRINTER_WIDTH)*$printer_width);
        $this->data.= str_repeat('-', $char_length);
        $this->addBlankLines();
    }

    public function textAlign($align ='center')
    {
        if(isset($this->align[$align]))
        {   
            $this->data.= $this->printer->setJustification($this->align[$align]);
        }
    }
    public function setFont($width =1 ,$height =1)
    {
        $this->data .= $this->printer->setTextSize($width,$height);
    }

    public function createPrintFile()
    {
        $dir = FCPATH.'/assets/temp';
        if(!is_dir($dir))
        {
            mkdir($dir);
        }
        $file_name = time().'_'.rand();
        $this->data .= $this->paperCut();
        file_put_contents($dir.'/'.$file_name,$this->data);
        $this->data = "\x1b"."@";
        return "assets/temp/".$file_name;
    }
    public function openCashDrawer(){
        
        $this->data .= $this->printer->pulse();
        return $this->data;
    }

    public function getPrintData()
    {
        return $this->data;
    }

    public function loadImage($image_path, $return = false)
    {
        $image_data = '';
        if(file_exists($image_path))
        {
            $logo = EscposImage::load($image_path, false);
            if($return){
                $image_data = $this->printer -> bitInlineImageColumnFormat($logo);
                return $image_data;
            }
            $this->data .= $this->printer -> bitImageColumnFormat($logo);
        }
        
    }
    
    public function paperCut()
    {

        $this->data.= "\x1d" . "V" .chr(65). chr(3);
    }

    public function selectPrintMode($mode=0)
    {
        $this->data .=  $this->printer -> selectPrintMode($mode);
    }

    public function setLineSpacing($height)
    {
        $this->data .=  $this->printer -> setLineSpacing($height);
    }

    public function setEmphasis($on=true)
    {
        $this->data .=  $this->printer -> setEmphasis($on);
    }
}