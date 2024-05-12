<?php



namespace App\Model;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;



class UserBillignCard extends Model

{

    use HasFactory;



    public $table = "user_billings_card";
    


    protected $fillable = [
        "name_card",
        "user_id",
        "customer_info",
        "card_info",
        "status",

    ]; 
    protected $appends = [
        "customerStripe",
        "cardStripe",
        "cardIcon",
    ]; 
    public function getCustomerStripeAttribute(){
        if( $this->customer_info){
            return json_decode($this->customer_info,true);
        }
        return [];
    } 
    public function getCardStripeAttribute(){
        if( $this->card_info){
            return json_decode($this->card_info,true);
        }
        return [];
    } 
    public function getCardIconAttribute(){
        if( $this->card_info){
             $iconCard = [
                "visa"=> asset('img/mc.svg'),
                "mastercard"=> asset('img/mc.svg')
            ];
            try {
                return  $iconCard[strtolower($this->cardStripe["brand"])] ;
            } catch (\Throwable $th) {
              return null;
            }
        }
        return null;
    } 

}

