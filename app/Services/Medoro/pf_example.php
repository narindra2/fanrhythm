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

$fields = $form->getRequest(array(
	'AutoDeposit' => 'true', // PHP serializes boolean values incorrectly, so send this as string
	'Payment' => array(
		'Mode' => 5
	),
	'Order' => array(
		'ID' 			=> 'aa_h_' . microtime(),
		'Amount'		=> 100, // In minor units, thus 100 equals 1.00 EUR
		'Currency'		=> 'EUR',
		'Description'	=> 'Test transaction'
	),
	'Notification' => 'I\'m a teapot!'
), array(
	'Callback' 		=> 'https://YOU_DOMAIN/callback_example.php',
	'ErrorCallback'		=> 'https://YOU_DOMAIN/error_example.php'
));

$action = 'https://demo.ipsp.lv/form/v2/';

var_dump($fields);

?>

<form action="<?php echo $action; ?>" method="post">
	<?php foreach ($fields as $key => $value) { ?>
		<input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>" />
	<?php } ?>
	<input type="submit" name="SUBMIT" value="SUBMIT" />
	<br>Submitting request to: <b><?php echo $action; ?></b>
</form>
