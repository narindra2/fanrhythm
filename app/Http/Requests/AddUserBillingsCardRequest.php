<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardNumber;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardExpirationMonth;

class AddUserBillingsCardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // dd(request()->all());
        return [
            "name_card" => ["required"],
            "card_number" => ["required" , "min:16" ,"max:16"],
            "expired_date" => "required|date_format:m/y",
            "cvv" => ['required', "min:3" ,"max:4"],

            "billing_name" => "required",
            "billing_last_name" => "required",
            // "billing_post_code" => "required",
            // "billing_city" => "required",
            // "country" => "required",
            "billing_phone" => "required",
            "billing_address" => "required",
        ];
    }
    
    // public function messages()
    // {
    //     return [
    //         'credit_card.card_invalid' => 'La longueur de la carte de crédit invalide',
    //         'credit_card.credit_card' => 'Carte invalide',
    //     ];
    // }
    public function withValidator($validator)
    {
        if ($validator->fails()) {
            die(json_encode(["success" => false, "validation" => true,  "message" => $validator->errors()->first()]));
        }
       
    }
}
