<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

// $printer_width = DEFAULT_PRINTER_WIDTH;
$printer_width = 0;
function getCountryLanguage($retaurant_id){
    $ci = &get_instance();
    $country_name_code = '';
    if($retaurant_id!=''){
        $ci->load->model('country_model');
        $arr = $ci->country_model->getCountryCode($retaurant_id,'');
        $country_name_code = $arr['country_name_code'];
    }
    return getLanguageArray($country_name_code);
}
function print_test($data,$restaurant_id)
{
    $ci = &get_instance();
    $lang_arr = getCountryLanguage($restaurant_id);
    $ci->load->library('printit');
    $ci->printit->textAlign('center');
    if(isset($data['restaurant_logo_path']) && !empty($data['restaurant_logo_path'])){
        $ci->printit->loadFile($data['restaurant_logo_path']);
    }
    $ci->printit->addTextLine($lang_arr['welcome_ythewait']);
    $ci->printit->addTextLine($lang_arr['printer_working_fine']);
    
    $ci->printit->addHashedLine();

    $ci->printit->textAlign('left');
    $ci->printit->addTextLine($lang_arr['avail_option_for_print']);
    $ci->printit->addTextLine($lang_arr['print_qr_code']);
    $ci->printit->addTextLine($lang_arr['print_sale_summary']);
    $ci->printit->addTextLine($lang_arr['print_order_recipt']);
    $ci->printit->addTextLine($lang_arr['print_kitchen_order']);
    $ci->printit->addTextLine($lang_arr['print_order_invoice']);
    $ci->printit->addTextLine($lang_arr['print_xz_report']);
    $file_path = $ci->printit->createPrintFile();
    return base_url().$file_path;    
}

function print_dining_help($data,$restaurant_id)
{
    $ci = &get_instance();
    $lang_arr = getCountryLanguage($restaurant_id);
    $ci->load->library('printit');
    $ci->printit->textAlign('center');
    if(isset($data['restaurant_logo_path']) && !empty($data['restaurant_logo_path'])){
        $ci->printit->loadFile($data['restaurant_logo_path']);
    }
    $ci->printit->setFont(2,2);
    $ci->printit->textAlign('center');
    $ci->printit->addTextLine($lang_arr['qr_code_table_no'].' : '.$data['table_no']);

    $ci->printit->setFont(1,1);
    $ci->printit->addHashedLine();
    $ci->printit->textAlign('center');
    $ci->printit->addTextLine('');
    $ci->printit->addTextLine('');
    if( isset($data['service']) ) {
        $ci->printit->addTextLine( sprintf($lang_arr['print_dinning_help'],$data['service'],$data['table_no']) );
    }else{
        $ci->printit->addTextLine($data['message']);
    }
    $ci->printit->addTextLine('');
    $ci->printit->addTextLine('');
    $file_path = $ci->printit->createPrintFile();
    return base_url().$file_path;    
}

/* Thermal Printer Templates */
function print_qrcode($data)
{
    $ci = &get_instance();
    $ci->load->library('printit');
    $ci->printit->textAlign('center');
    if(!empty($data['header'])){
        foreach ($data['header'] as $header) {
            // $ci->printit->textAlign($header['align']);        
            // $ci->printit->addTextLine($header['text']);        
        }
    }
    if(isset($data['restaurant_logo_path']) && !empty($data['restaurant_logo_path'])){
        // $ci->printit->loadFile($data['restaurant_logo_path']);
    }
    $ci->printit->setFont(2,2);
    if(!empty($data['restaurant_name'])) {
        $ci->printit->addTextLine($data['restaurant_name'] );
    }
    if(!empty($data['table_no'])) {
        $ci->printit->addTextLine('Table No:'.$data['table_no'] );
    }
    if(!empty($data['qrcode_path'])){
        $ci->printit->loadFile($data['qrcode_path']);
    }
    if(!empty($data['footer'])){
        foreach ($data['footer'] as $footer) {
            $ci->printit->setFont(1,1);
            // $ci->printit->textAlign($footer['align']);
            // $ci->printit->addTextLine($footer['text']);        
        }
    }
    $file_path = $ci->printit->createPrintFile();
    return base_url().$file_path;
}

function print_today_sale($data,$width=DEFAULT_PRINTER_WIDTH,$restaurant_id)
{
    global $printer_width;
    $printer_width = $width;
    $ci = &get_instance();
    $lang_arr = getCountryLanguage($restaurant_id);
    $ci->load->library('printit');
    $ci->printit->setLineSpacing(1);
    $ci->printit->textAlign('center');
    if(!empty($data['header'])){
        foreach ($data['header'] as $header) {
            // $ci->printit->textAlign($header['align']);        
            // $ci->printit->addTextLine($header['text']);        
        }
    }
    if(isset($data['restaurant_logo_path']) && !empty($data['restaurant_logo_path'])){
        // $ci->printit->loadFile($data['restaurant_logo_path']);
    }
    $ci->printit->setFont(1,1);
    $ci->printit->textAlign('left');

    $ci->printit->addTextLine(get_aligned_data($lang_arr['restaurant_name'].':', ucfirst(stripcslashes($data['name']))));
    $ci->printit->addTextLine(get_aligned_data($lang_arr['date'].':', $data['date']));
    $ci->printit->addTextLine(get_aligned_data($lang_arr['time'].':', $data['time']));
    
    $ci->printit->textAlign('center');
    $ci->printit->selectPrintMode(32);
    $ci->printit->addTextLine($lang_arr['today_sale']);
    $ci->printit->selectPrintMode();
    $ci->printit->addHashedLine($printer_width);
    
    $ci->printit->textAlign('left');
    $ci->printit->setFont(1,1);
    foreach ($data['types'] as $type => $amount) {
        $ci->printit->addTextLine(get_aligned_data($type, $amount, '', '', $data['currency_image']));
    }
    $ci->printit->setEmphasis();
    $ci->printit->addHashedLine($printer_width);
    $ci->printit->addTextLine(get_aligned_data($lang_arr['total_sale'], $data['total_sale'], '', '', $data['currency_image']));
    $ci->printit->addHashedLine($printer_width);
    $ci->printit->setEmphasis(false); 

    // $ci->printit->addTextLine(get_aligned_data('Refunds', $data['refunds'], '', '', $data['currency_image']));
    // $ci->printit->addTextLine(get_aligned_data('Expenses', $data['expenses'], '', '', $data['currency_image']));
    
    $ci->printit->setEmphasis();
    $ci->printit->addHashedLine($printer_width);
    $ci->printit->addTextLine(get_aligned_data($lang_arr['net_sales'].':', $data['net_sale'], '', '', $data['currency_image']));
    $ci->printit->addHashedLine($printer_width);
    $ci->printit->addTextLine(get_aligned_data($lang_arr['total_cash'].':', $data['total_cash'], '', '', $data['currency_image']));
    $ci->printit->addHashedLine($printer_width);
    $ci->printit->setEmphasis(false);
    if(!empty($data['footer'])){
        foreach ($data['footer'] as $footer) {
            // $ci->printit->setFont(1,1);
            // $ci->printit->textAlign('center');        
            // $ci->printit->addTextLine($footer['text']);        
        }
    }
    $path = $ci->printit->createPrintFile();
    return base_url().$path;
}


// For kitchen Order
function print_kitchen_order($data,$width=DEFAULT_PRINTER_WIDTH,$restaurant_id)
{
    global $printer_width;
    $printer_width = $width;
    $ci = &get_instance();
    $lang_arr = getCountryLanguage($restaurant_id);
    $ci->load->library('printit');
    $ci->printit->textAlign('center');
    if(!empty($data['header'])){
        foreach ($data['header'] as $header) {
            // $ci->printit->textAlign($header['align']);        
            // $ci->printit->addTextLine($header['text']);        
        }
    }
    $ci->printit->setFont(2,2);
    $ci->printit->textAlign('center');
    if(isset($data['table_number']) && !empty($data['table_number'])) {
        $ci->printit->addTextLine($lang_arr['qr_code_table_no'].':'.$data['table_number']);
    }
    $ci->printit->setFont(1,1);
    $ci->printit->textAlign('left');
    $ci->printit->addTextLine(
        get_aligned_data(
            $lang_arr['order'].':', $lang_arr[StaticArrays::$order_delivery_types[$data['delivery_type']]]
        )
    );
    $ci->printit->addTextLine(get_aligned_data($lang_arr['date'].':', $data['date']));
    $ci->printit->addTextLine(get_aligned_data($lang_arr['time'].':', $data['time']));

    $ci->printit->setEmphasis();
    $ci->printit->addHashedLine($printer_width);
    $ci->printit->addTextLine(get_aligned_data($lang_arr['items'], '', $lang_arr['qty']));
    $ci->printit->addHashedLine($printer_width);
    $ci->printit->addTextLine('');
    $ci->printit->addTextLine('');
    $ci->printit->setEmphasis(false);
    foreach ($data['items'] as $item) {
        $ci->printit->setEmphasis();
        $ci->printit->addTextLine(get_aligned_data($item['name'], '', $item['qty']-$data['quantity']));
        $ci->printit->setEmphasis(false);
        if(!empty($item['attributes'])){
            $attributes = implode(',', array_map(
                function ($attribute) {
                  return $attribute['name'];
                }, 
                $item['attributes'])
            );
            $ci->printit->selectPrintMode(1);
            $ci->printit->addTextLine(get_aligned_data('', '', '', $attributes));
        }
        if(!empty($item['instructions'])){
            $ci->printit->selectPrintMode(1);
            $ci->printit->addTextLine(get_aligned_data('', '', '', $lang_arr['user_note'].':  '.$item['instructions']));
        }
        if(!empty($item['pos_note'])){
            $ci->printit->selectPrintMode(1);
            $ci->printit->addTextLine(get_aligned_data('', '', '', $lang_arr['note'].':  '.$item['pos_note']));
        }
        $ci->printit->addTextLine(get_aligned_data('',''));
        $ci->printit->selectPrintMode();
    }
    $ci->printit->addTextLine('');
    $ci->printit->addTextLine('');
    if(!empty($data['footer'])){
        foreach ($data['footer'] as $footer) {
            // $ci->printit->setFont(1,1);
            // $ci->printit->textAlign('center');        
            // $ci->printit->addTextLine($footer['text']);        
        }
    }

    $file_path = $ci->printit->createPrintFile();
    return base_url().$file_path;
}

// For Order Receipt
function print_order_receipt($data,$width=DEFAULT_PRINTER_WIDTH,$restaurant_id,$tax_method=TAX_METHOD_EXCLUSIVE)
{
    global $printer_width;
    $printer_width = $width;
    $ci = &get_instance();
    $lang_arr = getCountryLanguage($restaurant_id);
    $ci->load->library('printit');
    $ci->printit->textAlign('center');
    if(isset($data['restaurant_logo']) && !empty($data['restaurant_logo'])){
        // $ci->printit->loadFile($data['restaurant_logo']);
    }
    $ci->printit->setFont(1,2);
    $ci->printit->addTextLine(ucfirst($data['restaurant_name']));
    $ci->printit->setFont(1,1);
    if(!empty($data['header'])){
        foreach ($data['header'] as $header) {

            // $ci->printit->textAlign($header['align']);        
            $ci->printit->addTextLine($header['text']);        
        }
    }
    $ci->printit->addTextLine("                   ");
    if(isset($data['title'])){
        $ci->printit->addTextLine($data['title']);

    }else{

        $ci->printit->addTextLine($lang_arr['summary']);
    }
    $ci->printit->textAlign('left');
    
    $customer_name = !empty($data['customer_name']) ? ucfirst($data['customer_name']) : $lang_arr['walkin'];
    $customer_phone = !empty($data['customer_phone']) ? ucfirst($data['customer_phone']) : "";
    $customer_address = !empty($data['customer_address']) ? ucfirst($data['customer_address']) : "";
    
    $ci->printit->addTextLine(get_aligned_data($lang_arr['customer_name'].':', $customer_name));
    
    if(!empty($customer_phone)) {
        $ci->printit->addTextLine(get_aligned_data($lang_arr['contact_no'].':', $customer_phone));  
    }

    if(StaticArrays::$order_delivery_types[$data['delivery_type']] == 'delivery'){

	    if(!empty($customer_address)) {
	        $ci->printit->addTextLine(get_aligned_data($lang_arr['address'].':', $customer_address));  
	    }
    }

    if(isset($data['table_number']) && !empty($data['table_number'])) {
        $ci->printit->addTextLine(get_aligned_data($lang_arr['qr_code_table_no'].':', $data['table_number']));
    }
    $ci->printit->addTextLine(
        get_aligned_data(
            $lang_arr['order'].':', $lang_arr[StaticArrays::$order_delivery_types[$data['delivery_type']]]
        )
    );
    $ci->printit->addTextLine(get_aligned_data($lang_arr['date'].':', $data['date']));
    $ci->printit->addTextLine(get_aligned_data($lang_arr['time'].':', $data['time']));
    $ci->printit->addTextLine(get_aligned_data($lang_arr['sale_invoice_no'].' :', $data['invoice_number']));
    
    $ci->printit->setEmphasis();
    $ci->printit->addHashedLine($printer_width);
    $ci->printit->addTextLine(get_aligned_data($lang_arr['items'], $lang_arr['amount'], $lang_arr['qty']));
    $ci->printit->addHashedLine($printer_width);
    $ci->printit->setEmphasis(false);
    foreach ($data['items'] as $item) {
        $ci->printit->addTextLine(
            get_aligned_data(
                $item['name'], price_decimal($item['amount'], $data['uptodecimal']), $item['qty']-$data['quantity'], '', $data['currency'] 
            )
        );
        if(!empty($item['attributes'])){
            foreach($item['attributes'] as  $atr){
                if(strpos($data['currency'], '.png')){
                    $currency_symb = $ci->printit->loadImage(FCPATH.'assets/images/currency/'.$data['currency'],1);
                } else {
                    $currency_symb = $data['currency'];
                }
                $ci->printit->addTextLine(get_aligned_data('',''));
                $ci->printit->selectPrintMode(1);
                if($tax_method == TAX_METHOD_INCLUSIVE){
                    $ci->printit->addTextLine(get_aligned_data('','','',$atr['name'],''));
                }else{

                    $ci->printit->addTextLine(get_aligned_data('','','',$atr['name'],'',' ('.$currency_symb.' '.$atr['price'].')'));
                }
                // $ci->printit->addTextLine("\t".$atr['name'].' ('.$currency_symb.$atr['price'].')');    
            }
        }
        if(!empty($item['instructions'])){
            $ci->printit->selectPrintMode(1);
            $ci->printit->addTextLine(get_aligned_data('', '', '', $lang_arr['user_note'].':  '.$item['instructions']));
        }
        if(!empty($item['pos_note'])){
            $ci->printit->selectPrintMode(1);
            $ci->printit->addTextLine(get_aligned_data('', '', '', $lang_arr['note'].':  '.$item['pos_note']));
        }
        $ci->printit->addTextLine(get_aligned_data('',''));
        $ci->printit->selectPrintMode();
    }
    if($tax_method == TAX_METHOD_INCLUSIVE){
        showTaxInclusiveFields($ci,$data,$lang_arr,$printer_width);
    }else{
        showTaxExclusiveFields($ci,$data,$lang_arr,$printer_width);
    }
    $ci->printit->addHashedLine($printer_width);
    $ci->printit->addTextLine("                   ");
    $ci->printit->setEmphasis(false);
    if(!empty($data['footer'])){
        foreach ($data['footer'] as $footer) {
            // $ci->printit->setFont(1,1);
            $ci->printit->textAlign('center');        
            $ci->printit->addTextLine($footer['text']);        
        }
    }
    $ci->printit->addTextLine("                   ");
    $file_path = $ci->printit->createPrintFile();
    return base_url().$file_path;
}
function showTaxExclusiveFields($ci,$data,$lang_arr,$printer_width){
    if(!empty($data['subtotal'])){
        $ci->printit->addHashedLine($printer_width);
        $ci->printit->addTextLine(get_aligned_data($lang_arr['sub_total'], $data['subtotal'], '', '', $data['currency']));
    }
    if(!empty($data['tax_total'])){
        $ci->printit->addHashedLine($printer_width);
        $ci->printit->addTextLine(get_aligned_data($lang_arr['taxes'], $data['tax_total'], '', '', $data['currency']));
        if(strpos($data['currency'], '.png')){
            $currency_symb = $ci->printit->loadImage(FCPATH.'assets/images/currency/'.$data['currency'],1);
        } else {
            $currency_symb = $data['currency'];
        }
        if(!empty($data['tax_groups'])){
            foreach ($data['tax_groups'] as $key => $value) {
                $ci->printit->addTextLine(get_aligned_data('',''));
                $ci->printit->addTextLine("  ".$value['tax_name'].' ('.$value['tax_rate'].'%)    '.$currency_symb.' '.$value['tax_amount']."\n");
            }
        }
    }
    if(!empty($data['discount'])){
        $ci->printit->addHashedLine($printer_width);
        $ci->printit->addTextLine(get_aligned_data($lang_arr['discount'], $data['discount'], '' ,'', $data['currency']));
    }
    
    if(!empty($data['delivery_charges']) && $data['delivery_charges']>0 ){// added >0 condition because from calling of this function delivery_charges is 0.00 in string format which is not empty
        $ci->printit->addHashedLine($printer_width);
        $ci->printit->addTextLine(get_aligned_data($lang_arr['delivery_charges'], $data['delivery_charges'], '' ,'', $data['currency']));
    }
    $ci->printit->addHashedLine($printer_width);
    $ci->printit->setEmphasis();
    $ci->printit->addTextLine(get_aligned_data($lang_arr['email_grand_total'], $data['total'], '', '', $data['currency']));
    return $ci;
}
function showTaxInclusiveFields($ci,$data,$lang_arr,$printer_width){
    if(!empty((float)$data['discount']) || !empty((float)$data['delivery_charges']) ){

        if(!empty($data['subtotal'])){
            $ci->printit->addHashedLine($printer_width);
            $ci->printit->addTextLine(get_aligned_data($lang_arr['sub_total'], price_decimal($data['subtotal'] + $data['tax_total'],$data['uptodecimal']), '', '', $data['currency']));
        }
        if(!empty($data['discount'])){
            $ci->printit->addHashedLine($printer_width);
            $ci->printit->addTextLine(get_aligned_data($lang_arr['discount'], $data['discount'], '' ,'', $data['currency']));
        }
        
        if(!empty($data['delivery_charges']) && $data['delivery_charges']>0 ){// added >0 condition because from calling of this function delivery_charges is 0.00 in string format which is not empty
            $ci->printit->addHashedLine($printer_width);
            $ci->printit->addTextLine(get_aligned_data($lang_arr['delivery_charges'], $data['delivery_charges'], '' ,'', $data['currency']));
        }
    }
    $ci->printit->addHashedLine($printer_width);
    $ci->printit->addTextLine(get_aligned_data($lang_arr['email_grand_total'], $data['total'], '', '', $data['currency']));

    if(!empty($data['tax_total'])){
        $ci->printit->addTextLine(get_aligned_data('',''));
        $ci->printit->addTextLine(get_aligned_data('',''));        
        $ci->printit->addTextLine(get_aligned_data($lang_arr['total_include_tax'], $data['tax_total'], '', '', $data['currency']));
        if(strpos($data['currency'], '.png')){
            $currency_symb = $ci->printit->loadImage(FCPATH.'assets/images/currency/'.$data['currency'],1);
        } else {
            $currency_symb = $data['currency'];
        }
        if(!empty($data['tax_groups'])){
            foreach ($data['tax_groups'] as $key => $value) {
                $ci->printit->addTextLine(get_aligned_data('',''));
                $ci->printit->addTextLine(get_aligned_data($value['tax_name'].' ('.$value['tax_rate'].'%)', $value['tax_amount'], '', '', $currency_symb));
            }
        }
    }
    return $ci;
}

function print_invoice($data,$width=DEFAULT_PRINTER_WIDTH,$restaurant_id,$tax_method=TAX_METHOD_EXCLUSIVE,$open_drawer = false)
{
    global $printer_width;
    $printer_width = $width;
    $ci = &get_instance();
    $lang_arr = getCountryLanguage($restaurant_id);
    $ci->load->library('printit');
    $ci->printit->textAlign('center');
    if(!empty($data['restaurant_logo']) && isset($data['restaurant_logo'])) {
        // $ci->printit->loadFile($data['restaurant_logo']);
    }
    $ci->printit->setFont(1,2);
    $ci->printit->addTextLine(ucfirst($data['restaurant_name']));
    $ci->printit->setFont(1,1);
    if(!empty($data['header'])){
        foreach ($data['header'] as $header) {
            // $ci->printit->textAlign($header['align']);        
            $ci->printit->addTextLine($header['text']);        
        }
    }
    if(!empty($data['restaurant_address'])){
        $ci->printit->addTextLine($data['restaurant_address']);
    }
    $ci->printit->addTextLine($lang_arr['invoice'].': #'.$data['invoice_number']);
    $ci->printit->addHashedLine($printer_width);
    $ci->printit->textAlign('left');
    // $ci->printit->addTextLine(get_aligned_data('Restaurant name:',ucfirst($data['restaurant_name'])));
    $customer_name = !empty($data['customer_name']) ? ucfirst($data['customer_name']) : $lang_arr['walkin'];
    $customer_address = !empty($data['customer_address']) ? ucfirst($data['customer_address']) : "";
    
    $ci->printit->addTextLine(get_aligned_data($lang_arr['customer_name'].':', $customer_name));
    if(StaticArrays::$order_delivery_types[$data['delivery_type']] == 'delivery'){

	    if(!empty($customer_address)) {
	        $ci->printit->addTextLine(get_aligned_data($lang_arr['address'].':', $customer_address));  
	    }
    }
    // $ci->printit->addTextLine(get_aligned_data('Table No:', $data['table_number']));
    $ci->printit->addTextLine(
        get_aligned_data(
            $lang_arr['order'].':', $lang_arr[StaticArrays::$order_delivery_types[$data['delivery_type']]]
        )
    );
    $ci->printit->addTextLine(get_aligned_data($lang_arr['date'].':', $data['date']));
    $ci->printit->addTextLine(get_aligned_data($lang_arr['time'].':', $data['time']));
    
    if(!empty($data['payment_mode'])){
        $ci->printit->addTextLine(get_aligned_data($lang_arr['order_no'].' :', $data['invoice_number']));
        $ci->printit->addTextLine(get_aligned_data($lang_arr['payment_mode'].':', $data['payment_mode_value']));
        $ci->printit->addTextLine(get_aligned_data($lang_arr['payment_status_str'].':', $data['payment_status']));
        if($data['payment_mode']==PAYMENT_MODE_ONLINE && !empty($data['transaction_id'])){
            $ci->printit->addTextLine(get_aligned_data($lang_arr['transaction_id'].':', $data['transaction_id']));
        }
    }
    
    $ci->printit->setEmphasis();
    $ci->printit->addHashedLine($printer_width);
    $ci->printit->addTextLine(get_aligned_data($lang_arr['items'], $lang_arr['amount'], $lang_arr['qty']));
    $ci->printit->addHashedLine($printer_width);
    $ci->printit->setEmphasis(false);
    foreach ($data['items'] as $item) {
        $ci->printit->addTextLine(
            get_aligned_data(
                $item['name'], price_decimal($item['amount'], $data['uptodecimal']),  $item['qty']-$data['quantity'], '', $data['currency'] 
            )
        );
        /* if(!empty($item['attributes'])){
            foreach($item['attributes'] as  $atr){
                $ci->printit->addTextLine(get_aligned_data('', '', $atr['price'], $atr['name']));    
            }
            $attributes = implode(',', array_map(
                function ($attribute) {
                  return $attribute['name'];
                }, 
                $item['attributes'])
            );
            $ci->printit->selectPrintMode(1);
            $ci->printit->addTextLine(get_aligned_data('', '', '', $attributes)); 
        } */
        if(!empty($item['attributes'])){
            foreach($item['attributes'] as  $atr){
                if(strpos($data['currency'], '.png')){
                    $currency_symb = $ci->printit->loadImage(FCPATH.'assets/images/currency/'.$data['currency'],1);
                } else {
                    $currency_symb = $data['currency'];
                }
                $ci->printit->addTextLine(get_aligned_data('',''));
                $ci->printit->selectPrintMode(1);
                if($tax_method == TAX_METHOD_INCLUSIVE){
                    $ci->printit->addTextLine(get_aligned_data('','','',$atr['name'],''));
                }else{
                    $ci->printit->addTextLine(get_aligned_data('','','',$atr['name'],'',' ('.$currency_symb.' '.$atr['price'].')'));
                }
                // $ci->printit->addTextLine("\t".$atr['name'].' ('.$currency_symb.$atr['price'].')');    
            }
        }
        if(!empty($item['instructions'])){
            $ci->printit->selectPrintMode(1);
            $ci->printit->addTextLine(get_aligned_data('', '', '', $lang_arr['user_note'].':  '.$item['instructions']));
        }
        if(!empty($item['pos_note'])){
            $ci->printit->selectPrintMode(1);
            $ci->printit->addTextLine(get_aligned_data('', '', '', $lang_arr['note'].':  '.$item['pos_note']));
        }
        $ci->printit->addTextLine(get_aligned_data('',''));
        $ci->printit->selectPrintMode();
    }
    if($tax_method == TAX_METHOD_INCLUSIVE){
        showTaxInclusiveFields($ci,$data,$lang_arr,$printer_width);
    }else{
        showTaxExclusiveFields($ci,$data,$lang_arr,$printer_width);
    }
    $ci->printit->textAlign('center');

    $ci->printit->addHashedLine($printer_width);
    $ci->printit->addTextLine("                   ");
    $ci->printit->setEmphasis(false);
    if(!empty($data['footer'])){
        foreach ($data['footer'] as $footer) {
            // $ci->printit->setFont(1,1);
            $ci->printit->textAlign('center');        
            $ci->printit->addTextLine($footer['text']);        
        }
    }
    $ci->printit->addTextLine($lang_arr['power_by_ythewait']);
    $ci->printit->addTextLine("                   ");
    if($open_drawer){
        $ci->printit->openCashDrawer();
    }
    $file_path = $ci->printit->createPrintFile();
    return base_url().$file_path;
}

// For Aligning Strings on LEFT and RIGHT
function get_aligned_data($leftData, $rightData, $qty='', $data_items='', $sign='', $attr_price = ''){
    global $printer_width;
    $ci = &get_instance();
    $ci->load->library('printit');    
    // $char_length = MAX_CHAR_LENGTH; // 48
    $char_length = (int) ((MAX_CHAR_LENGTH / DEFAULT_PRINTER_WIDTH)*$printer_width);
    
    // Initiating length for left and right and quantity
    $qtyCols = MAX_QTY_CHAR_LENGTH;
    $leftCols = $char_length - MAX_RIGHT_CHAR_LENGTH ;
    $rightCols = MAX_RIGHT_CHAR_LENGTH;
    
    // If Characters more than MAX_CHAR_LENGTH
    $left = $right = $partial_left = $partial_right = '';
    
    if(!empty($leftData)){
        $l_length = strlen($leftData);
        if(!empty($rightData)){
            if($leftCols < $l_length){
                list($leftData, $partial_left) = createLines($leftData, $leftCols);
            }
            $r_length = strlen($rightData);
            if(!empty($qty)){
                if($rightCols < $r_length){
                    list($rightData, $partial_right) = createLines($rightData, $rightCols);
                }
            }
        } else {
            list($leftData, $partial_left) = createLines($leftData, ($leftCols+$rightCols-$qtyCols));
        }
        if(!empty($qty)){
            $qty = str_pad($qty, $qtyCols);
            $leftData = $qty.$leftData;
        }
    }

    if(!empty($rightData)){
        $r_length = strlen($rightData);
        // For Adding Currency to Amount
        if(!empty($sign)){
            if(strpos($sign, '.png')){
                $currency = $ci->printit->loadImage(FCPATH.BASE_IMAGE_PATH.'currency/'.$sign,1);
            } else {
                $currency = $sign;
            }
        } else {
            $currency = '';
        }

        if(strpos($leftData, 'Deleted')){
            $rightCols = (int)strlen($rightData) + $rightCols - ($r_length+4);
        }

        if(!empty($currency)) {
            $rightData = $currency.' '.$rightData;
            $leftCols = $leftCols+($rightCols-($r_length+2));
        } else {
            $leftCols = $leftCols+($rightCols-($r_length));
            $rightCols = strlen($rightData);
        }
        $right = str_pad($rightData, $rightCols);
    }
    // Adding Space on Left side 
    $left = str_pad($leftData, $leftCols);

    // If Characters more than MAX_CHAR_LENGTH then adding to next line
    if(!empty($partial_left) || !empty($partial_right)){
        if(!empty($left)){
            $left = "$left$right\n";
        } else {
            $left = '';
        }
        $right = str_repeat(' ', $qtyCols).get_aligned_data($partial_left,$partial_right);
    }
    if(!empty($data_items)){
        $di_length = strlen($data_items);
        $part_len = '';
        if( $leftCols < $di_length || !empty($attr_price)){
            $line_data = createLines($data_items, $leftCols);
            $data_items = $line_data[0];
            unset($line_data[0]);
            $partial_di = implode(' ', $line_data);
        }
        $left = str_pad('', $qtyCols*2);
        $right = $data_items;
        if(!empty($partial_di)){
            $part_len = strlen($partial_di);
            $right .= "\n".get_aligned_data('', '', '', $partial_di);
        }
    }
    if(!empty($attr_price)){
        if($part_len < ($char_length-20)){
            $right .= $attr_price;
        }else{
            $right .= "\n".$attr_price;
        }
    }

    return $left.$right;
}

function createLines($string, $linelength) {
    if(strrpos($string, ' ')){
        $wordsArray = explode(' ', $string);
        $temp = '';
        $lineCount=0;
        $lines = array();
        foreach ($wordsArray as $word) {
            if(empty($temp)){
                $temp = $word;
            } else {
                if(strlen($temp.' '.$word)<$linelength){
                    $temp .= ' '.$word;
                } else {
                    $lineCount++;
                    $temp = $word;
                }
            }
            $lines[$lineCount] = $temp;
        }
        if(count($lines)<2 && !empty($lines)){
            $lines[1] = '';
        }
        return $lines;
    } else {
        return array($string,array());
    }
}