<?php

namespace App\Services\Medoro;

use Exception;
use SimpleXMLElement;
use stdClass;

class EcommerceP {

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
		
		$sign = $this->sign($clean_data);

		$tmp  = $this->encrypt($clean_data);
		
		/* Base64 encode everything */
		$sign = base64_encode($sign);
		$key  = base64_encode($tmp['key']);
		$data = base64_encode($tmp['data']);
		
		/* Form request */
		$request = new stdClass();
		$request->INTERFACE  = $this->config['merchant_id'];
		$request->KEY_INDEX  = $this->config['key_index'];
		$request->KEY = $key;
		$request->DATA = $data;
		$request->SIGNATURE = $sign;
	
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
		$cipherAlgorithm = "aes-256-cbc";
		$ivSize = openssl_cipher_iv_length($cipherAlgorithm);
		$iv = openssl_random_pseudo_bytes($ivSize);
		if (openssl_seal($cleardata, $data, $ekeys, array($systemkeyid), $cipherAlgorithm,$iv)) {
			$key = $ekeys[0];
		} else {
			throw new Exception('Encryption failed: ' . openssl_error_string());
		}
		openssl_free_key($systemkeyid);
		return array(
			'data' => $data,
			'key' => $key,
		);
	}

	private function decrypt($data, $key) {
		$merchantkeyid = openssl_get_privatekey($this->_merchantkey);
		if (!openssl_open($data, $cleardata, $key, $merchantkeyid)) {
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