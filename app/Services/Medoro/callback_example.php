<?php

require('ecommerce.php');

$configs = array(
	'ecom-demo' => array(
		'merchant_id'	=> '3720000',
		'gateway_key'	=> './ecom-demo_gateway.pem',
		'merchant_key'	=> './ecom-demo_merchant.pem',
		'key_index'		=> 1
	),
);

$ecom = new Ecommerce($configs['ecom-demo']);
$form = new EcommerceFORM($ecom);

var_dump($form->getResponse($_POST));
