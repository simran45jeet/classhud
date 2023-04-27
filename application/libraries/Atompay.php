<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Version 1.0
 */
class Atompay
{
    private $login;

    private $password;

    private $transactionType;

    private $productId;

    private $amount;

    private $transactionCurrency;

    private $transactionAmount;

    private $clientCode;

    private $transactionId;

    private $atomTransactionId;

    private $transactionDate;

    private $customerAccount;

    private $customerName;

    private $customerEmailId;

    private $customerMobile;

    private $customerBillingAddress;

    private $returnUrl;

    private $mode = "test";

    private $transactionUrl;

    private $nbType = "NBFundTransfer";

    private $ccType = "CCFundTransfer";

    private $reqHashKey = "";

    private $salt = "";

    private $requestEncypritonKey = "";

    private $responseEncryptionKey = "";

    private $respHashKey = "";

    private $applicationIdentifier = "";


    public function setRequestEncypritonKey($key){
        $this->requestEncypritonKey = $key;
    }

    public function setResponseEncypritonKey($key){
        $this->responseEncryptionKey = $key;
    }

    public function setSalt($saltEntered){
        $this->salt = $saltEntered;
    }


    /**
     * @return string
     */
    public function getReqHashKey()
    {
        return $this->reqHashKey;
    }

    /**
     * @param string $reqHashKey
     */
    public function setReqHashKey($reqHashKey)
    {
        $this->reqHashKey = $reqHashKey;
    }

    /**
     * @return string
     */
    public function getRespHashKey()
    {
        return $this->respHashKey;
    }

    /**
     * @param string $respHashKey
     */
    public function setRespHashKey($respHashKey)
    {
        $this->respHashKey = $respHashKey;
    }

    public function setApplicationIdentifier($applicationIdentifier)
    {
        $this->applicationIdentifier = $applicationIdentifier;
    }

    public function getApplicationIdentifier(){
        return $this->applicationIdentifier;
    }
    /**
     * @return the $login
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return the $password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return the $transactionType
     */
    public function getTransactionType()
    {
        return $this->transactionType;
    }

    /**
     * @param string $transactionType
     */
    public function setTransactionType($transactionType)
    {
        $this->transactionType = $transactionType;
    }

    /**
     * @return the $productId
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param string $productId
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    /**
     * @return the $amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param string $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return the $transactionCurrency
     */
    public function getTransactionCurrency()
    {
        return $this->transactionCurrency;
    }

    /**
     * @param string $transactionCurrency
     */
    public function setTransactionCurrency($transactionCurrency)
    {
        $this->transactionCurrency = $transactionCurrency;
    }

    /**
     * @return the $transactionAmount
     */
    public function getTransactionAmount()
    {
        return $this->transactionAmount;
    }

    /**
     * @param string $transactionAmount
     */
    public function setTransactionAmount($transactionAmount)
    {
        $this->transactionAmount = $transactionAmount;
    }

    /**
     * @return the $transactionId
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @param string $transactionId
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
    }

    /**
     * @return the $transactionId
     */
    public function getAtomTransactionId()
    {
        return $this->atomTransactionId;
    }

    /**
     * @param string $transactionId
     */
    public function setAtomTransactionId($atomTransactionId)
    {
        $this->atomTransactionId = $atomTransactionId;
    }

    /**
     * @return the $transactionDate
     */
    public function getTransactionDate()
    {
        return $this->transactionDate;
    }

    /**
     * @param string $transactionDate
     */
    public function setTransactionDate($transactionDate)
    {
        $this->transactionDate = $transactionDate;
    }

    /**
     * @return the $customerAccount
     */
    public function getCustomerAccount()
    {
        return $this->customerAccount;
    }

    /**
     * @param string $customerAccount
     */
    public function setCustomerAccount($customerAccount)
    {
        $this->customerAccount = $customerAccount;
    }

    /**
     * @return the $customerName
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * @param string $customerName
     */
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;
    }

    /**
     * @return the $customerEmailId
     */
    public function getCustomerEmailId()
    {
        return $this->customerEmailId;
    }

    /**
     * @param string $customerEmailId
     */
    public function setCustomerEmailId($customerEmailId)
    {
        $this->customerEmailId = $customerEmailId;
    }

    /**
     * @return the $customerMobile
     */
    public function getCustomerMobile()
    {
        return $this->customerMobile;
    }

    /**
     * @param string $customerMobile
     */
    public function setCustomerMobile($customerMobile)
    {
        $this->customerMobile = $customerMobile;
    }

    /**
     * @return the $customerBillingAddress
     */
    public function getCustomerBillingAddress()
    {
        return $this->customerBillingAddress;
    }

    /**
     * @param string $customerBillingAddress
     */
    public function setCustomerBillingAddress($customerBillingAddress)
    {
        $this->customerBillingAddress = $customerBillingAddress;
    }

    /**
     * @return the $returnUrl
     */
    public function getReturnUrl()
    {
        return $this->returnUrl;
    }

    /**
     * @param string $returnUrl
     */
    public function setReturnUrl($returnUrl)
    {
        $this->returnUrl = $returnUrl;
    }

    /**
     * @return the $mode
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @param string $mode
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    /**
     * @return the $transactionUrl
     */
    public function getTransactionUrl()
    {
        return $this->transactionUrl;
    }

    /**
     * @param string $transactionUrl
     */
    public function setTransactionUrl($transactionUrl)
    {
        $this->transactionUrl = $transactionUrl;
    }

    public function getnbType() {
        return $this->nbType;
    }

    public function getccType() {
        return $this->ccType;
    }

    public function setUrl($url) {
        $port = 443;		
        $this->setTransactionUrl($url);
        $this->setPort($port);
    }

    public function setClientCode($clientCode) {
        if($clientCode == NULL || $clientCode == ""){
            $this->clientCode = urlencode(base64_encode(123));
        } else {
            $this->clientCode = urlencode(base64_encode($clientCode));
        }
    }

    private function getClientCode() {
        return $this->clientCode;
    }

    private function setPort($port) {
        $this->port = $port;
    }

    private function getPort() {
        return $this->port;
    }


    public function getChecksum(){
        $str = $this->login . $this->password . "NBFundTransfer" . $this->productId . $this->transactionId . $this->amount . "INR";
        $signature = hash_hmac("sha512",$str,$this->reqHashKey);

        return $signature;
    }

    //Change & to | in production
    private function getData(){
        $datenow = date("d/m/Y h:m:s");
        $transactionDate = str_replace(" ", "%20", $datenow);
        $strReqst = "";
        $strReqst .= "login=".$this->getLogin();
        $strReqst .= "&pass=".$this->getPassword();
        $strReqst .= "&ttype=NBFundTransfer";
        $method = $this->getApplicationIdentifier();
        if(!empty($method)){
            $strReqst .= "&mdd=".$this->getApplicationIdentifier();
        }
        $strReqst .= "&prodid=".$this->getProductId();
        $strReqst .= "&amt=".$this->getAmount();
        $strReqst .= "&txncurr=".$this->getTransactionCurrency();
        $strReqst .= "&txnscamt=".$this->getTransactionAmount();
        $strReqst .= "&ru=".$this->getReturnUrl();
        $strReqst .= "&clientcode=".$this->getClientCode();
        $strReqst .= "&txnid=".$this->getTransactionId();
        $strReqst .= "&date=".$this->getTransactionDate();
        // $strReqst .= "&udf1=".$this->getCustomerName();
        // $strReqst .= "&udf2=".$this->getCustomerEmailId();
        // $strReqst .= "&udf3=".$this->getCustomerMobile();
        // $strReqst .= "&udf4=".$this->getCustomerBillingAddress();
        $strReqst .= "&custacc=".$this->getCustomerAccount();
        $strReqst .= "&signature=".$this->getChecksum();
        $encData = $this->encrypt($strReqst, $this->requestEncypritonKey, $this->salt);
        return "login=".$this->getLogin()."&encdata=".strtoupper($encData); // do not change in this line
    }


    public function getDataReQuery(){
        
        $strReqst = "merchantid=".$this->getLogin();
        $strReqst .= "&amt=".$this->getAmount();
        $strReqst .= "&merchanttxnid=".$this->getTransactionId();
        $strReqst .= "&tdate=".$this->getTransactionDate();

        $url =  $this->transactionUrl . "?" .$strReqst;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $data = curl_exec($ch);
        $xml = simplexml_load_string($data);
        curl_close($ch);

        $requeryData = [];
        foreach($xml->attributes() as $key => $value) {
            $requeryData[$key] = (string) $value;
        }
        return $requeryData;
    }

    public function initiateRefund(){
        
        $data = [
            "merchantid" => $this->getLogin(),
            "pwd" => urlencode(base64_encode($this->getPassword())),
            "atomtxnid" =>  $this->getAtomTransactionId(),
            "refundamt" => $this->getAmount(),
            "txndate" => $this->getTransactionDate(),
            "merefundref" => $this->getTransactionId(),
        ];
        $url =  $this->transactionUrl;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
        $xml = simplexml_load_string($data);
        $curlData = [];
        foreach($xml as $key => $value) {
            $curlData[$key] = (string) $value;
        }
        return $xml;
    }

    public function refundStatus(){
        $strReqst = "txnid=".$this->getAtomTransactionId();
        $strReqst .= "&merchantid=".$this->getLogin();
        $strReqst .= "&product=".$this->getProductId();
        $encData = $this->encrypt($strReqst, $this->requestEncypritonKey, $this->salt);
        $params =  "login=".$this->getLogin()."&encdata=".strtoupper($encData); 
        $url = $this->transactionUrl . "?" .$params;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $encdata = curl_exec($ch);
        curl_close($ch);
        $decrypted = $this->decrypt($encdata, $this->responseEncryptionKey, $this->salt);
        $xml = simplexml_load_string($decrypted);
        $curlData = [];

        foreach($xml as $key => $value) {
            if($key == 'DETAILS'){
                $i = 0;
                $refundedAmnt = 0;
                foreach($value as $k=>$v){
                   
                    foreach($v as $refund => $vals){

                        $curlData['refunds'][$i][$refund] = (string) $vals;
                        if($refund == 'REFUNDAMOUNT'){
                            $refundedAmnt +=$curlData['refunds'][$i][$refund];
                        }
                    }
                    $i++;
                }
            }else{
                $curlData[$key] = (string) $value;
            }
        }
        if(isset($refundedAmnt) &&  !empty($refundedAmnt)){
            $curlData['refunded_amount'] = $refundedAmnt;
        }
        return $curlData;
    }

    /**
     * This function returns transaction token url
     * @return string
     */
    public function getPGUrl(){
        if ($this->mode != null && $this->mode != "") {
            try {
                $data = $this->getData();
                // $this->writeLog($data);
                return $this->transactionUrl . "?" .$data;
            } catch ( Exception $ex ) {
                echo "Error while getting transaction token : " . $ex->getMessage();
                return;
            }
        } else {
            return "Please set mode live or test";
        }
    }

    private function writeLog($data){
        $fileName = "date".date("Y-m-d").".txt";
        $fp = fopen("log/".$fileName, 'a+');
        $data = date("Y-m-d H:i:s")." - ".$data;
        fwrite($fp,$data);
        fclose($fp);
    }

    public function encrypt($data = '', $key = NULL, $salt = "") {
        if($key != NULL && $data != "" && $salt != ""){
            
            $method = "AES-256-CBC";
            
            //Converting Array to bytes
            $iv = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];
            $chars = array_map("chr", $iv);
            $IVbytes = join($chars);
            
            
            $salt1 = mb_convert_encoding($salt, "UTF-8"); //Encoding to UTF-8
            $key1 = mb_convert_encoding($key, "UTF-8"); //Encoding to UTF-8
            
            //SecretKeyFactory Instance of PBKDF2WithHmacSHA1 Java Equivalent
            $hash = openssl_pbkdf2($key1,$salt1,'256','65536', 'sha1'); 
            
            $encrypted = openssl_encrypt($data, $method, $hash, OPENSSL_RAW_DATA, $IVbytes);
            
            return bin2hex($encrypted);
        }else{
            return "String to encrypt, Salt and Key is required.";
        }
    }

    public function decrypt($data="", $key = NULL, $salt = "") {
        if($key != NULL && $data != "" && $salt != ""){
            $dataEncypted = hex2bin($data);
            $method = "AES-256-CBC";
            
            //Converting Array to bytes
            $iv = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];
            $chars = array_map("chr", $iv);
            $IVbytes = join($chars);
            
            $salt1 = mb_convert_encoding($salt, "UTF-8");//Encoding to UTF-8
            $key1 = mb_convert_encoding($key, "UTF-8");//Encoding to UTF-8
            
            //SecretKeyFactory Instance of PBKDF2WithHmacSHA1 Java Equivalent
            $hash = openssl_pbkdf2($key1,$salt1,'256','65536', 'sha1'); 
             
            $decrypted = openssl_decrypt($dataEncypted, $method, $hash, OPENSSL_RAW_DATA, $IVbytes);
            return $decrypted;
        }else{

            return "Encrypted String to decrypt, Salt and Key is required.";

        }
    }

    public function decryptResponseIntoArray($encdata){

        $decrypted = $this->decrypt($encdata, $this->responseEncryptionKey, $this->salt);
        $array_response = explode('&', $decrypted); //change & to | for production
        $equalSplit = array();
        foreach ($array_response as $ar) {
            $equalSub = explode('=', $ar);
            if(!empty($equalSub[1]) && !empty($equalSub[0])){
                $temp = array(
                    $equalSub[0] => $equalSub[1],
                );
                $equalSplit += $temp;
            }
        }
        
        return $equalSplit;

    }

    public function validateResponse($responseParams)
    {
        $str = $responseParams["mmp_txn"].$responseParams["mer_txn"].$responseParams["f_code"].$responseParams["prod"].$responseParams["discriminator"].$responseParams["amt"].$responseParams["bank_txn"];
        $signature =  hash_hmac("sha512",$str,$this->respHashKey,false);
        if($signature == $responseParams["signature"]){
            return true;
        } else {
            return false;
        }

    }

}