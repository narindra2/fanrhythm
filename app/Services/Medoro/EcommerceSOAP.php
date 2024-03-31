<?php

namespace App\Services\Medoro;

use SoapFault;
use SoapClient;
use App\Services\Medoro\EcommerceP;

class EcommerceSOAP
{
	public $_ecom,
		$_soap;

	public function __construct(EcommerceP $ecom)
	{
		ini_set('soap.wsdl_cache_enabled',0);
		ini_set('soap.wsdl_cache_ttl',0);
		$this->_ecom = $ecom;
		// $options = array(
		// 	 "exception" => 1,
		// 	// "soap_version" => SOAP_1_1,
		// 	'stream_context' => stream_context_create(array(
		// 		'ssl' => array(
		// 			'verify_peer' => true,
		// 			'verify_peer_name' => true,
		// 			'allow_self_signed' => false
		// 		)
		// 	))
		// );
		$opts = array(
			'http' => array(
				'user_agent' => 'PHPSoapClient'
			),
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);
		$context = stream_context_create($opts);
		$soapClientOptions = array(
			'stream_context' => $context,
		);
		$this->_soap = new SoapClient($ecom->config['wsdl'] ,$soapClientOptions);
	}

	public function __call($method, $arguments)
	{
		// dd($arguments);
		$request  = $this->_ecom->prepare($arguments[0]);
		try {
			
			$response = $this->_soap->{$method}($request);
		} catch (SoapFault $e) {
			throw $e;
		}
		return $this->_ecom->parse($response);
	}
}
