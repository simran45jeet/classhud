<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Applozic_lib
{
	private $apiUrl=false;
	private $apiAppId=false;
	private $apiheader=array();
	private $postFields='';
	private $url='';

	public function __construct() {
		$this->apiUrl = APPLOZIC_API_URL;
		$this->apiAppId = APPLOZIC_APP_ID;
		$this->createHeader();
		$this->getUrl();
	}

	private function createHeader(){
		$this->apiheader = array('Content-Type:application/json');
	}

	private function createPostFields( $data=array() ){
		$this->postFields = json_encode($data);
	}

	private function getUrl() {
		$this->url = "register/client";
	}

	public function requestApi($data=array()) {
		$response = array();
		$this->createPostFields($data);

		try {
			$requestUrl = $this->apiUrl.$this->url;

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $requestUrl);
			//curl_setopt($ch, CURLOPT_HEADER, TRUE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $this->apiheader);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $this->postFields );
			$result = curl_exec($ch);
			
			if(curl_errno($ch)){
				throw new Exception('Error: curl error '.curl_error($ch));
			}

			curl_close($ch);

			if($result){
				$response = json_decode($result, true);
			}
		} catch (Exception $e) {
			$response[] = $e->getMessage();
		}

		return $response;
	}

}

?>