<?php
namespace App\Services\Medoro;

use App\Services\Medoro\EcommerceP;
use App\Services\Medoro\EcommerceSOAP;

class DoPayment {

   public  $configs;
    public function __construct() {
		$this->configs = array(
            'ecom-demo' => array(
                'wsdl'			=> 'http://demo.ipsp.lv/api/v2/soap?wsdl',
                'merchant_id'	=> "3798394",
                // 'gateway_key'	=> base_path("App/Services/Medoro/ecom-demo_gateway.pem"),
                'gateway_key'	=> base_path("App/Services/Medoro/ecom-test_live_gateway.pem"),
                // 'merchant_key'	=>  base_path("App/Services/Medoro/ecom-demo_merchant.pem") ,
                'merchant_key'	=> base_path("App/Services/Medoro/ecom-test_live_merchant.pem") ,
                'key_index'		=> 2
            ),
            'ecom-prod' => array(
                'wsdl'			=> 'http://ipsp.lv/api/v2/soap?wsdl',
                'merchant_id'	=> '3798394',
                'gateway_key'	=>  base_path("App/Services/Medoro/ecom-prod_gateway.pem") ,
                'merchant_key'	=>  base_path("App/Services/Medoro/ecom-prod_merchant.pem"),
                'key_index'		=> 1
            ),
        );
	}

   public function executePayment () {
    ini_set("soap.wsdl_cache_enabled", "0");
    $ecom = new EcommerceP($this->configs['ecom-demo']);
    $soap = new EcommerceSOAP($ecom);

       try {
           // Create new payment
           $data = $soap->Payment(array(
               'AutoDeposit' => 'true', // PHP serializes boolean values incorrectly, so send this as string
               'Payment' => array(
                   'Mode' => 4
               ),
               'Order' => array(
                   'ID' => 'aa_h_' . microtime(),
                   'Amount' => 100, // In minor units, thus 100 equals 1.00 EUR
                   'Currency' => 'EUR',
                   'Description' => 'Test transaction'
               ),
               'Card' => array(
                   'Number' =>'4012001038443335', // 13-19 digit number
                   'Name' => 'test', // Under 50 utf8 chars
                   'Expiry' => '1703', // First year, then month
                   'CSC' => '999' // Exactly 3 digits
               ),
               'RemoteAddress' => '89.111.15.218' // This MUST be cardholders IP
           ));
       
           echo "Created new payment:\t\t" . $data->asXML() . PHP_EOL;
       
           // Get payments status
           echo "Got status by payments id:\t" . $soap->GetPayment(array(
               'Payment' => array(
                   'ID' => $data->Payment->ID
               )
           ))->asXML() . PHP_EOL;
       
       }
       catch (SoapFault $e) {
           echo 'SOAP EXCEPTION: ' . $e->faultcode . ' - ' . $e->faultstring . PHP_EOL;
       }
   }
    
}
