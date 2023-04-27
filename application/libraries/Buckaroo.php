<?php
class Buckaroo 
{
    /*
    Creator:Varun Dhamija
    Custom created for YTHEWAIT ONLY
    */
    private $secretKey = '';
    private $websiteKey = '';
    private $url = '';
    private $paymentPostData = [];
    private $paymentPostjson = '';
    private $headers = [];
    public $transactionId = 0;
    public $redirectUrl = '';
    public $transactionStatus = 0;
    public $errorMessage = '';
    private $returnUrl = FALSE;
    public $debugInfo = [];

    private static $bancontact = "bancontact";
    private static $paypal = "paypal";
    private static $abnanl2a_ideal = "abnanl2a_bcideal";
    private static $asnbn_ideal = "asnbn_bcideal";
    private static $ign_ideal = "ign_bcideal";
    private static $rabo_ideal = "rabo_bcideal";
    private static $snsbn_ideal = "snsbn_bcideal";
    private static $snsregbn_ideal = "snsregbn_bcideal";
    private static $triobn_ideal = "triobn_bcideal";
    private static $vanlan_ideal = "vanlan_bcideal";
    private static $knab_ideal = "knab_bcideal";
    private static $bunq_ideal = "bunq_bcideal";
    private static $monyu_ideal = "monyu_bcideal";
    private static $hanbn_ideal = "hanbn_bcideal";

    public static $transactionStatusPending = 791;
    public static $transactionStatusFailed = 490;
    public static $transactionStatusSuccess = 190;
    public static $transactionStatusCancelled = 890;
    public static $transactionStatusRejected = 690;

    // public static $transactionStatusArray = [
    //     self::$transactionStatusSuccess => "Success",
    //     self::$transactionStatusFailed => "Failed",
    //     self::$transactionStatusCancelled => "Cancelled",
    //     self::$transactionStatusRejected => "Rejected",
    //     self::$transactionStatusPending => "Pending",
    // ];

    public static $actionTransaction = 'transaction';
    public static $actionTransactionStatus = 'transaction_status';

    public function init($keys,$action,$testMode){
        $this->secretKey = $keys['secretKey'];
        $this->websiteKey = $keys['websiteKey'];
        $this->setUrl($testMode,$action);
    }

    public function createTransaction($data,$userId){
        if(!empty($data['currency']['code'])){
            $this->paymentPostData['Currency'] = $data['currency']['code'];
        }
        $this->paymentPostData['AmountDebit'] = sprintf('%0.2f', truncate_number($data['amount']));

        $this->paymentPostData["Invoice"] = transactionNumber($userId);
        $this->paymentPostData["PushURL"] = base_url("orders/gateway_response/buckaroo");
        $this->paymentPostData["ReturnURL"] = $data['redirect_url'];
        $this->setHeaders();
        $this->makeRequest();
        return $this->returnUrl;
    }
    

    private function setUrl($testMode,$action){
        if($testMode == 1){
            if($action === self::$actionTransaction){
                $this->url = 'https://testcheckout.buckaroo.nl/json/Transaction';
            }else if($action === self::$actionTransactionStatus){
                $this->url = 'https://testcheckout.buckaroo.nl/json/transaction/status/';
            }
        }else{
            if($action === self::$actionTransaction){
                $this->url = 'https://checkout.buckaroo.nl/json/Transaction';
            }else if($action === self::$actionTransactionStatus){
                $this->url = 'https://checkout.buckaroo.nl/json/transaction/status/';
            }
        }
    }

    private function setHeaders($requestType = "POST"){
        $post = '';
        if($requestType == "POST"){
            $this->paymentPostjson = json_encode($this->paymentPostData);
            $md5  = md5($this->paymentPostjson, true);
            $post = base64_encode($md5);
        }
        $uri        = strtolower(urlencode(str_replace('https://','',$this->url)));
        
        $nonce      = 'nonce_' . rand(0000000, 9999999);
        $time       = time();
        $hmac       = $this->websiteKey . $requestType . $uri . $time . $nonce . $post;
        $s          = hash_hmac('sha256', $hmac, $this->secretKey, true);
        $hmac       = base64_encode($s);
        $authorization =  ("hmac " . $this->websiteKey . ':' . $hmac . ':' . $nonce . ':' . $time);
        $this->headers  = [
            'authorization: '.$authorization,
            'Content-Type: application/json'
        ];
    }


    
    private function makeRequest(){
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL,$this->url);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->paymentPostjson);           
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        $result_raw = $result     = curl_exec ($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $result = json_decode($result);

       
        if(!empty($result) && $result !== NULL){
            if(!empty($result->RequiredAction->RedirectURL)){
                $this->redirectUrl = $result->RequiredAction->RedirectURL;
                $this->transactionId = $result->Key;
                $this->transactionStatus = $result->Status->Code->Code;
                $this->returnUrl = TRUE;
                // __print($result);
            }else{
                $this->debugInfo = $result;
                $this->errorMessage = 'Unable to fetch Payment URL';
                // log_message('error', "buckaroo_debug_".$result_raw);
            }
        }else{
            $this->errorMessage = 'Payment Failed';
        }
    }

    public function checkTransactionStatus($transactionKey){
        $return = FALSE;
        $ch = curl_init();
        $this->url = $this->url.$transactionKey;
        $this->setHeaders("GET");
        curl_setopt($ch, CURLOPT_URL,$this->url);

        // curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: 0'));
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $this->paymentPostjson);           
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        $result     = curl_exec ($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $result = json_decode($result);
        if(!empty($result) && $result !== NULL){
            if(!empty($result->Status->Code->Code)){
                $this->transactionStatus = $result->Status->Code->Code;
                return TRUE;
            }else{
                $this->debugInfo = $result;
                $this->errorMessage = 'Unable to fetch transaction Status';
            }
        }else{
            $this->errorMessage = 'Authentication Failed';
        }
        return $return;
    }


    public function setPaymentmethods($matchString){
        if(!empty($matchString)){
            if($matchString === self::$paypal){
                $this->paymentPostData["Services"] = [
                    "ServiceList" => [
                        [
                            "Action" => "Pay",
                            "Name" => "paypal",
                            
                        ]
                    ]
                ];
            }else if($matchString === self::$bancontact){
                $this->paymentPostData["Services"] = [
                    "ServiceList" => [
                        [
                            "Action" => "Pay",
                            "Name" => "bancontactmrcash",
                            "Parameters" => [
                                [
                                  "Name" => "savetoken",
                                  "Value" => "true"
                                ]
                            ]
                        ]
                    ]
                ];
            }else if($matchString === self::$abnanl2a_ideal){
                $this->paymentPostData["Services"] = [
                    "ServiceList" => [
                        [
                            "Action" => "Pay",
                            "Name" => "ideal",
                            "Parameters" => [
                                [
                                  "Name" => "issuer",
                                  "Value" => "ABNANL2A"
                                ]
                            ]
                        ]
                    ]
                ];
            }else if($matchString === self::$asnbn_ideal){
                $this->paymentPostData["Services"] = [
                    "ServiceList" => [
                        [
                            "Action" => "Pay",
                            "Name" => "ideal",
                            "Parameters" => [
                                [
                                  "Name" => "issuer",
                                  "Value" => "ASNBNL21"
                                ]
                            ]
                        ]
                    ]
                ];
            }else if($matchString === self::$ign_ideal){
                $this->paymentPostData["Services"] = [
                    "ServiceList" => [
                        [
                            "Action" => "Pay",
                            "Name" => "ideal",
                            "Parameters" => [
                                [
                                  "Name" => "issuer",
                                  "Value" => "INGBNL2A"
                                ]
                            ]
                        ]
                    ]
                ];
            }else if($matchString === self::$rabo_ideal){
                $this->paymentPostData["Services"] = [
                    "ServiceList" => [
                        [
                            "Action" => "Pay",
                            "Name" => "ideal",
                            "Parameters" => [
                                [
                                  "Name" => "issuer",
                                  "Value" => "RABONL2U"
                                ]
                            ]
                        ]
                    ]
                ];
            }else if($matchString === self::$snsbn_ideal){
                $this->paymentPostData["Services"] = [
                    "ServiceList" => [
                        [
                            "Action" => "Pay",
                            "Name" => "ideal",
                            "Parameters" => [
                                [
                                  "Name" => "issuer",
                                  "Value" => "SNSBNL2A"
                                ]
                            ]
                        ]
                    ]
                ];
            }else if($matchString === self::$snsregbn_ideal){
                $this->paymentPostData["Services"] = [
                    "ServiceList" => [
                        [
                            "Action" => "Pay",
                            "Name" => "ideal",
                            "Parameters" => [
                                [
                                  "Name" => "issuer",
                                  "Value" => "RBRBNL21"
                                ]
                            ]
                        ]
                    ]
                ];
            }else if($matchString === self::$vanlan_ideal){
                $this->paymentPostData["Services"] = [
                    "ServiceList" => [
                        [
                            "Action" => "Pay",
                            "Name" => "ideal",
                            "Parameters" => [
                                [
                                  "Name" => "issuer",
                                  "Value" => "FVLBNL22"
                                ]
                            ]
                        ]
                    ]
                ];
            }else if($matchString === self::$triobn_ideal){
                $this->paymentPostData["Services"] = [
                    "ServiceList" => [
                        [
                            "Action" => "Pay",
                            "Name" => "ideal",
                            "Parameters" => [
                                [
                                  "Name" => "issuer",
                                  "Value" => "TRIONL2U"
                                ]
                            ]
                        ]
                    ]
                ];
            }else if($matchString === self::$knab_ideal){
                $this->paymentPostData["Services"] = [
                    "ServiceList" => [
                        [
                            "Action" => "Pay",
                            "Name" => "ideal",
                            "Parameters" => [
                                [
                                  "Name" => "issuer",
                                  "Value" => "KNABNL2H"
                                ]
                            ]
                        ]
                    ]
                ];
            }else if($matchString === self::$bunq_ideal){
                $this->paymentPostData["Services"] = [
                    "ServiceList" => [
                        [
                            "Action" => "Pay",
                            "Name" => "ideal",
                            "Parameters" => [
                                [
                                  "Name" => "issuer",
                                  "Value" => "BUNQNL2A"
                                ]
                            ]
                        ]
                    ]
                ];
            }else if($matchString === self::$monyu_ideal){
                $this->paymentPostData["Services"] = [
                    "ServiceList" => [
                        [
                            "Action" => "Pay",
                            "Name" => "ideal",
                            "Parameters" => [
                                [
                                  "Name" => "issuer",
                                  "Value" => "MOYONL21"
                                ]
                            ]
                        ]
                    ]
                ];
            }else if($matchString === self::$hanbn_ideal){
                $this->paymentPostData["Services"] = [
                    "ServiceList" => [
                        [
                            "Action" => "Pay",
                            "Name" => "ideal",
                            "Parameters" => [
                                [
                                  "Name" => "issuer",
                                  "Value" => "HANDNL2A"
                                ]
                            ]
                        ]
                    ]
                ];
            }else{
                $this->paymentPostData["Services"] = [
                    "ServiceList" => [
                        [
                            "Action" => "pay",
                        ]
                    ]
                ];
            }
        }
    }

    
}