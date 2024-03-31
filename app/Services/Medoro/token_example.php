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
	'Card' => array(
		'Token' => 'token' . microtime(),
	)
), array(
	'Callback' 		=> 'https://YOU_DOMAIN/callback_example.php',
	'ErrorCallback'		=> 'https://YOU_DOMAIN/error_example.php'
));

$action = 'https://demo.ipsp.lv/form/v2/token/';

var_dump($fields);

?>

<form action="<?php echo $action; ?>" method="post">
	<?php foreach ($fields as $key => $value) { ?>
		<input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>" />
	<?php } ?>
	<input type="submit" name="SUBMIT" value="SUBMIT" />
	<br>Submitting request to: <b><?php echo $action; ?></b>
</form>
