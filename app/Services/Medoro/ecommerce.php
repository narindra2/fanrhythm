<?php

ini_set("soap.wsdl_cache_enabled", "0");

class Ecommerce {

	public $config;

	private $_merchantkey	= null,
			$_systemkey 	= null;
			
	public function __construct($config = array()) {
		$this->config = $config;
		$this->loadKeys();
	}
	public function __call($name, $arguments) {
		return $this->exec($name, $arguments[0]);
	}
	
	public function prepare($array_data, $additional_fields=array()) {
	
		$clean_data = $this->arrayToXml(new SimpleXMLElement('<data />'), $array_data)->asXML();
		//  $clean_data = json_encode($clean_data);
		$sign = $this->sign($clean_data);
		$tmp  = $this->encrypt($clean_data);
		
		/* Base64 encode everything */
		$sign = base64_encode($sign);
		$key  = base64_encode($tmp['key']);
		$data = base64_encode($tmp['data']);
		// $iv = base64_encode($tmp['iv']);
		
		/* Form request */
		$request = new StdClass();
		$request->INTERFACE = $this->config['merchant_id'];
		$request->KEY_INDEX = $this->config['key_index'];
		$request->KEY = $key;
		$request->DATA = $data;
		$request->SIGNATURE = $sign;
		// $request->IV = $iv;
		
		return $request;
		
	}
	
	public function parse($response) {
	
		$sign = base64_decode($response->SIGNATURE);
		$key  = base64_decode($response->KEY);
		$data = base64_decode($response->DATA);
		
		$data = $this->decrypt($data, $key);
		
		if (!$this->checkSignature($data, $sign)) {
			throw new Exception('Decryption failed, invalid signature!');
		}

		return simplexml_load_string($data);
		
	}

	private function sign($clean_data) {
		$merchantkeyid = openssl_get_privatekey($this->_merchantkey);
		if (!openssl_sign($clean_data, $sign, $merchantkeyid)) {
			throw new Exception('Signing failed: ' . openssl_error_string());
		}
		openssl_free_key($merchantkeyid);

		return $sign;
	}

	private function checkSignature($data, $sign) {
		$systemkeyid = openssl_get_publickey($this->_systemkey);
		$res = (openssl_verify($data, $sign, $systemkeyid) == 1);
		openssl_free_key($systemkeyid);

		return $res;
	}

	private function encrypt($cleardata) {
		$systemkeyid = openssl_get_publickey($this->_systemkey);
		// $ivSize = openssl_cipher_iv_length('aes-256-cbc');
    	// $iv = openssl_random_pseudo_bytes($ivSize);
		if (openssl_seal($cleardata, $data, $ekeys, array($systemkeyid), "RC4")) {
			$key = $ekeys[0];
		} else {
			throw new Exception('Encryption failed: ' . openssl_error_string());
		}

		openssl_free_key($systemkeyid);
		return array(
			'data' => $data,
			'key' => $key,
			// 'iv' => $iv,
		);
	}

	private function decrypt($data, $key) {
	
		$merchantkeyid = openssl_get_privatekey($this->_merchantkey);
		if (!openssl_open($data, $cleardata, $key, $merchantkeyid,"RC4")) {
			throw new Exception('Decryption failed: ' . openssl_error_string());
		};
		openssl_free_key($merchantkeyid);

		return $cleardata;
	}

	public function loadKeys() {
	
		$m_keyfile = fopen($this->config['merchant_key'], 'r');
		$this->_merchantkey = fread($m_keyfile, filesize($this->config['merchant_key']));
		fclose($m_keyfile);

		$s_keyfile = fopen($this->config['gateway_key'], 'r');
		$this->_systemkey = fread($s_keyfile, filesize($this->config['gateway_key']));
		fclose($s_keyfile);

		unset($m_keyfile);
		unset($s_keyfile);
	}

	private function arrayToXml($xml, array $children) {
		foreach ($children as $name => $value) {
			(is_array($value)) ? $this->arrayToXml($xml->addChild($name), $value) : $xml->addChild($name, $value);
		}

		return $xml;
	}

}

class EcommerceSOAP {
	
	private $_ecom,
			$_soap;
	
	public function __construct(Ecommerce $ecom) {
		$this->_ecom = $ecom;
		$options = array(
			 "exception" => 1,
			// "soap_version" => SOAP_1_1,
			'stream_context' => stream_context_create(array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			))
		);
		$this->_soap = new SoapClient($ecom->config['wsdl'], $options);
	}
	
	public function __call($method, $arguments) {
		$request  = $this->_ecom->prepare($arguments[0]);
		try {
			$response = $this->_soap->{$method}( (array)$request);
		}
		catch (SoapFault $e) {
			throw $e;
		}
		return $this->_ecom->parse($response);
	}

}

// class EcommerceFORM {
	
// 	private static $required = array('INTERFACE', 'KEY_INDEX', 'KEY', 'DATA', 'SIGNATURE');
	
// 	private static $allowed_additional_fields = array(
// 		'Callback' => 'CALLBACK',
// 		'ErrorCallback' => 'ERROR_CALLBACK',
// 	);
	
// 	private $_ecom;
	
// 	public function __construct(Ecommerce $ecom) {
// 		$this->_ecom = $ecom;
// 	}
	
// 	/**
// 	 * Returns array which should be POST'ed to FORMs URL
// 	 * May throw Exception
// 	 */
// 	public function getRequest($data, $additional) {
		
// 		$request = $this->_ecom->prepare($data);
		
// 		/* Copy additional fields to request */
// 		foreach (array_keys(self::$allowed_additional_fields) as $key) {
// 			if (array_key_exists($key, $additional)) {
// 				$realKey = self::$allowed_additional_fields[$key];
// 				$request->$realKey = $additional[$key];
// 			}
// 		}
		
// 		return (array) $request;
	
// 	}
	
// 	/**
// 	 * Takes POST array as an argument
// 	 * May throw Exception
// 	 */
// 	public function getResponse($response) {
		
// 		if (count(array_diff(self::$required, array_keys($response))) > 0) {
// 			throw new Exception('Some of required POST params are not included!');
// 		}
		
// 		// Convert array to object
// 		$responseObj = new stdClass();
// 		foreach ($response as $key => $value) {
// 			$responseObj->$key = $value;
// 		}
		
// 		return $this->_ecom->parse($responseObj);
		
// 	}
	
// }