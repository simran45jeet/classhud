<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccavenue {
	private $working_key;
	private $access_code;
	private $merchant_id;
	private $amount;
	private $order_id;
	private $url;
	private $billing_name;
	private $billing_address;
	private $billing_country;
	private $billing_state;
	private $billing_city;
	private $billing_zip;
	private $billing_tel;
	private $billing_email;
	private $delivery_name;
	private $delivery_address;
	private $delivery_country;
	private $delivery_state;
	private $delivery_city;
	private $delivery_zip;
	private $delivery_tel;
	private $billing_notes;
	private $mode;
	private $transaction_currency;
	private $gatewayUrl;
	private $tracking_id;

	private $paymentOption;
	private $cardType;


	public function getPaymentOption() {
		return $this->paymentOption;
	}
	public function getCardType() {
		return $this->cardType;
	}
	public function setPaymentOption( $paymentOption = NULL ) {
		$this->paymentOption = $paymentOption;
	}
	public function setCardType( $cardType ) {
		$this->cardType = $cardType;
	}
	public function setPaymentOptionSetCardType( $paymentOption = NULL, $cardType = NULL ) {
		$this->paymentOption = $paymentOption;
		$this->cardType = $cardType;
	}

	public function getWorkingKey() {
		return $this->working_key;
	}
	public function getAccessCode() {
		return $this->access_code;
	}
	public function getMerchantId() {
		return $this->merchant_id;
	}
	public function setWorkingKey( $working_key = NULL ) {
		$this->working_key = $working_key;
	}
	public function setAccessCode( $access_code ) {
		$this->access_code = $access_code;
	}
	public function setTrackingId( $tracking_id ) {
		$this->tracking_id = $tracking_id;
	}
	public function getTrackingId() {
		return $this->tracking_id;
	}
	public function setTransactionCurrency($transaction_currency){
		$this->transaction_currency = $transaction_currency;
	}
	public function SetkeyAndCode(){
		if($_SERVER['HTTP_HOST'] == 'www.ythewait.com'){
			$this->working_key = '07A75137FA327DF304E375889501E6C5';
			$this->access_code = 'AVGV89GL12AD65VGDA';
		// }else if($_SERVER['SERVER_ADDR'] == '::1'){ // for localhost
		// 	$this->working_key = '6E8D909069E4ABCD314A171F71BD1ADA';
		// 	$this->access_code = 'AVHO89GL22AM39OHMA';
		// }else if($_SERVER['SERVER_ADDR'] == '185.104.30.44'){
		// 	$this->working_key = '0C98D10D9A9E3F6A80E3532B771CBBFB';
		// 	$this->access_code = 'AVGO89GL22AM38OGMA';
		// }else if($_SERVER['SERVER_ADDR'] == '157.245.68.160'){
		// 	$this->working_key = '3F54DA3FD83D0FC4E64EA16AE44B02F9';
		// 	$this->access_code = 'AVGO89GL22AM37OGMA';
		}else if($_SERVER['HTTP_HOST'] == 'dev.whythewait.top'){
			$this->working_key = '76BAC08BED2393DFD798F09864825759';
			$this->access_code = 'AVWI03HF28BF14IWFB';
		}else if($_SERVER['HTTP_HOST'] == 'prelive.whythewait.top'){
			$this->working_key = '42524C427C4A4E192E72ABB4EDE9722F';
			$this->access_code = 'AVWI03HF28BF15IWFB';
		}else if($_SERVER['HTTP_HOST'] == 'test.whythewait.top'){
			$this->working_key = 'B97A138ECCD08C73E9F06F288F9EC5FB';
			$this->access_code = 'AVWI03HF28BF13IWFB';
		}
	}
	public function setMerchantId( $merchant_id ) {
		$this->merchant_id = $merchant_id;
	}
	public function setAmount( $amount ) {
		$this->amount = $amount;
	}
	public function getAmount() {
		return $this->amount;
	}
	public function getTransactionCurrency(){
		return $this->transaction_currency;
	}
	public function setOrderId( $order_id ) {
		$this->order_id = $order_id;
	}
	public function getOrderId() {
		return $this->order_id;
	}
	public function setRedirectUrl( $url ) {
		$this->url = $url;
	}
	public function setMode( $mode ) {
		$this->mode = $mode;
	}
	public function getRedirectUrl() {
		return $this->url;
	}
	public function setBillingName( $billing_name ) {
		$this->billing_name = $billing_name;
	}
	public function getBillingName() {
		return $this->billing_name;
	}
	public function setBillingAddress( $billing_address ) {
		$this->billing_address = $billing_address;
	}
	public function getBillingAddress() {
		return $this->billing_address;
	}
	public function setBillingCountry( $billing_country ) {
		$this->billing_country = $billing_country;
	}
	public function getBillingCountry() {
		return $this->billing_country;
	}
	public function setBillingState( $billing_state ) {
		$this->billing_state = $billing_state;
	}
	public function getBillingState() {
		return $this->billing_state;
	}
	public function setBillingCity( $billing_city ) {
		$this->billing_city = $billing_city;
	}
	public function getBillingCity() {
		return $this->billing_city;
	}
	public function setBillingZip( $billing_zip ) {
		$this->billing_zip = $billing_zip;
	}
	public function getBillingZip() {
		return $this->billing_zip;
	}
	public function setBillingTel( $billing_tel ) {
		$this->billing_tel = $billing_tel;
	}
	public function getBillingTel() {
		return $this->billing_tel;
	}
	public function setBillingEmail( $billing_email ) {
		$this->billing_email = $billing_email;
	}
	public function getBillingEmail() {
		return $this->billing_email;
	}
		public function setDeliveryName( $delivery_name ) {
		$this->delivery_name = $delivery_name;
	}
	public function getDeliveryName() {
		return $this->delivery_name;
	}
	public function setDeliveryAddress( $delivery_address ) {
		$this->delivery_address = $delivery_address;
	}
	public function getDeliveryAddress() {
		return $this->delivery_address;
	}
	public function setDeliveryCountry( $delivery_country ) {
		$this->delivery_country = $delivery_country;
	}
	public function getDeliveryCountry() {
		return $this->delivery_country;
	}
	public function setDeliveryState( $delivery_state ) {
		$this->delivery_state = $delivery_state;
	}
	public function getDeliveryState() {
		return $this->delivery_state;
	}
	public function setDeliveryCity( $delivery_city ) {
		$this->delivery_city = $delivery_city;
	}
	public function getDeliveryCity() {
		return $this->delivery_city;
	}
	public function setDeliveryZip( $delivery_zip ) {
		$this->delivery_zip = $delivery_zip;
	}
	public function getDeliveryZip() {
		return $this->delivery_zip;
	}
	public function setDeliveryTel( $delivery_tel ) {
		$this->delivery_tel = $delivery_tel;
	}
	public function getDeliveryTel() {
		return $this->delivery_tel;
	}
	public function setBillingNotes( $billing_notes ) {
		$this->billing_notes = $billing_notes;
	}
	public function getBillingNotes() {
		return $this->billing_notes;
	}
	public function billingSameAsShipping() {
		$this->delivery_name = $this->billing_name;
		$this->delivery_address = $this->billing_address;
		$this->delivery_country = $this->billing_country;
		$this->delivery_state = $this->billing_state;
		$this->delivery_city = $this->billing_city;
		$this->delivery_zip = $this->billing_zip;
		$this->delivery_tel = $this->billing_tel;
	}
	
	private function getMerchantData( $checksum ) {
		$merchant_data= 'merchant_id='.$this->getMerchantId();
		$merchant_data .= '&amount='.$this->getAmount();
		$merchant_data .= '&currency='.$this->getTransactionCurrency();
		$merchant_data .= '&order_id='.$this->getOrderId();
		$merchant_data .= '&redirect_url='.$this->getRedirectUrl();
		if( !empty($this->paymentOption) && !empty($this->cardType) ){
			$merchant_data .= '&payment_option='.$this->paymentOption;
			$merchant_data .= '&card_type='.$this->cardType;
		}
		// $merchant_data .= '&billing_name='.$this->getBillingName();
		// $merchant_data .= '&billing_address='.$this->getBillingAddress();
		$merchant_data .= '&billing_country='.$this->getBillingCountry();
		// $merchant_data .= '&billing_state='.$this->getBillingState();
		// $merchant_data .= '&billing_city='.$this->getBillingCity();
		// $merchant_data .= '&billing_zip='.$this->getBillingZip();
		$merchant_data .= '&billing_tel='.$this->getBillingTel();
		$merchant_data .= '&billing_email='.$this->getBillingEmail();
		// $merchant_data .= '&delivery_name='.$this->getDeliveryName();
		// $merchant_data .= '&delivery_address='.$this->getDeliveryAddress();
		// $merchant_data .= '&delivery_country='.$this->getDeliveryCountry();
		// $merchant_data .= '&delivery_state='.$this->getDeliveryState();
		// $merchant_data .= '&delivery_city='.$this->getDeliveryCity();
		// $merchant_data .= '&delivery_zip='.$this->getDeliveryZip();
		// $merchant_data .= '&delivery_tel='.$this->getDeliveryTel();
		// $merchant_data .= '&billing_cust_notes='.$this->getBillingNotes();
		$merchant_data .= '&Checksum='.$checksum;
		return $merchant_data;
	}
	public function gatewayUrl(){
		if($this->mode == 'test'){
			return 'https://test.ccavenue.com/';
		}else{
			return 'https://secure.ccavenue.com/';
		}
	}
	public function apiUrl(){
		if($this->mode == 'test'){
			return 'https://apitest.ccavenue.com/apis/servlet/DoWebTrans';
		}else{
			return 'https://api.ccavenue.com/apis/servlet/DoWebTrans';
		}
	}

	public function getTransactionUrl(){
		return $this->gatewayUrl().'transaction/transaction.do?command=initiateTransaction&encRequest='.$this->getEncryptedData().'&access_code='.$this->access_code;
	}


	private function getOrderData( $checksum ) {
		$merchant_data = [
			'reference_no' => $this->getTrackingId(), 
			'order_no' => $this->getOrderId()
		];
		$merchant_data = json_encode($merchant_data);
		return $this->api_encrypt($merchant_data,$this->getWorkingKey());
	}

	public function getOrderStatus_bk(){
		$url = $this->apiUrl();		
		$data = [
			'enc_request' => $this->getOrderData($this->getCheckSum()),
			'access_code'=> $this->access_code,
			'request_type' => 'JSON',
			'command' => 'orderStatusTracker',
			'reference_no' => $this->getTrackingId(),
			'version' => '1.1',
			'order_no' => $this->getOrderId(),
		];

		$ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
		curl_close($ch);
		print_r($data);
        $xml = simplexml_load_string($data);
        $curlData = [];
        foreach($xml as $key => $value) {
            $curlData[$key] = (string) $value;
		}
		print_r($xml);
        return $xml;
	}


	public function getEncryptedData(){
		$merchant_data = $this->getMerchantData($this->getCheckSum()); 
	    $this->encrypt($merchant_data,$this->getWorkingKey());
		return $this->encrypt($merchant_data,$this->getWorkingKey());
	}

	public function response( $response ) {
		$rcvdString = $this->decrypt( $response, $this->getWorkingKey() );
		$order_status="";
		$decryptValues=explode('&', $rcvdString);
		$dataSize=sizeof($decryptValues);
		$data = [];
		foreach($decryptValues as $value) 
		{
			$information=explode('=',$value);
			$data[$information[0]] = (isset($information[1]))?$information[1]:'';
		}
		return $data;
	}


	// utils ----------------------------------------------------------------
	public function getChecksum()
	{
		$str = $this->getMerchantId();
		$str .= "|". $this->getOrderId();
		$str .= "|". $this->getAmount();
		$str .= "|". $this->getRedirectUrl();
		$str .= "|". $this->getWorkingKey();
		$adler = 1;
		$adler = $this->adler32($adler,$str);
		return $adler;
	}
	public function genChecksum($str)
	{
		$adler = 1;
		$adler = $this->adler32($adler,$str);
		return $adler;
	}
	public function verifyChecksum($getCheck, $avnChecksum)
	{
		$verify=false;
		if($getCheck==$avnChecksum) $verify=true;
		return $verify;
	}
	private function adler32($adler , $str)
	{
		$BASE =  65521 ;
		$s1 = $adler & 0xffff ;
		$s2 = ($adler >> 16) & 0xffff;
		for($i = 0 ; $i < strlen($str) ; $i++)
		{
			$s1 = ($s1 + Ord($str[$i])) % $BASE ;
			$s2 = ($s2 + $s1) % $BASE ;
		}
		return $this->leftshift($s2 , 16) + $s1;
	}
	private function leftshift($str , $num)
	{
		$str = DecBin($str);
		for( $i = 0 ; $i < (64 - strlen($str)) ; $i++)
			$str = "0".$str ;
		for($i = 0 ; $i < $num ; $i++)
		{
			$str = $str."0";
			$str = substr($str , 1 ) ;
			//echo "str : $str <BR>";
		}
		return $this->cdec($str) ;
	}
	private function cdec($num)
	{
		$dec=0;
		for ($n = 0 ; $n < strlen($num) ; $n++)
		{
		   $temp = $num[$n] ;
		   $dec =  $dec + $temp*pow(2 , strlen($num) - $n - 1);
		}
		return $dec;
	}

	// ----------------- crypto 
	public function encrypt($plainText,$key)
	{
		$key = $this->hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
		$encryptedText = bin2hex($openMode);
		return $encryptedText;
	}

	public function decrypt($encryptedText,$key)
	{
		$key = $this->hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$encryptedText = $this->hextobin($encryptedText);
		$decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
		return $decryptedText;
	}

	private function hextobin($hexString)
   	{
		
		$length = strlen($hexString); 
		$binString="";   
		$count=0; 
		while($count<$length) 
		{       
			$subString =substr($hexString,$count,2);           
			$packedString = pack("H*",$subString); 
			if ($count==0)
			{
				$binString=$packedString;
			} 
			
			else 
			{
				$binString.=$packedString;
			} 
			
			$count+=2; 
		} 
		return $binString; 
		
	}
	


	public function getOrderStatus(){	
		$data = [ 
			'enc_request' => $this->getOrderData($this->getCheckSum()),
			'access_code'=> $this->access_code,
			'request_type' => 'JSON',
			'command' => 'orderStatusTracker',
			'reference_no' => $this->getTrackingId(),
			'version' => '1.1',
			'order_no' => $this->getOrderId(),
		]; 
		return $this->api_response($data);
	}

	private function getRefundData( $checksum ) {
		$merchant_data = [
			'reference_no' => (int) $this->getTrackingId(), 
			'refund_amount' => $this->getAmount(),
			'refund_ref_no' => $this->getOrderId()
		];
		$merchant_data = json_encode($merchant_data);
		return $this->api_encrypt($merchant_data,$this->getWorkingKey());
	}
	
	public function refund(){	
		$data = [ 
			'enc_request' => $this->getRefundData($this->getCheckSum()),
			'access_code'=> $this->access_code,
			'request_type' => 'JSON',
			'command' => 'refundOrder',
			'reference_no' => (int) $this->getTrackingId(),
			'refund_amount' => $this->getAmount(),
			'refund_ref_no' => $this->getOrderId(),
			'version' => '1.1',
		]; 
		return $this->api_response($data);
	}

	public function api_response($data){	
		$url = $this->apiUrl();	 
		$ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
		curl_close($ch);
        $information=explode('&',$result);
		$dataSize=sizeof($information);
		for($i = 0; $i < $dataSize; $i++) 
		{
			$info_value=explode('=',$information[$i]);
			if($info_value[0] == 'enc_response'){
				$status = strip_tags($this->api_decrypt($info_value[1], $this->getWorkingKey()));
			}
		}
		$pos1 = strrpos($status, '{');
		$str = strtok($status, '{');
		$pos2 = strrpos($str, '}');
		if ($pos1 !== false && $pos2 !== false) {
			$jsonStr = substr($str, 0, $pos2); 
			$jSon = '{'.$jsonStr.'}';
			return json_decode($jSon);
		}
        return false;
	}

	function api_encrypt($plainText, $key) {
		$secretKey = $this->hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
		$blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
		$plainPad = $this->_pkcs5_pad($plainText, $blockSize);
		if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1) {
			$encryptedText = mcrypt_generic($openMode, $plainPad);
			mcrypt_generic_deinit($openMode);
		} 
		return bin2hex($encryptedText);
	}
	function api_decrypt($encryptedText, $key) {

		$secretKey = $this->hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$encryptedText = $this->hextobin($encryptedText);
		$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
		mcrypt_generic_init($openMode, $secretKey, $initVector);
		$decryptedText = mdecrypt_generic($openMode, $encryptedText);
		$decryptedText = rtrim($decryptedText, "\0");
		mcrypt_generic_deinit($openMode);
		return $decryptedText;
	}
	function _pkcs5_pad($text, $blocksize)
	{
		$pad = $blocksize - strlen($text) % $blocksize;
		return $text . str_repeat(chr($pad), $pad);
	}
	
 
}