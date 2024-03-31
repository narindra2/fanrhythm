<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRatesSettingsRequest extends FormRequest
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


    public static function getRules(){
        // Valeurs par défaut
        $defaultMinPrice = 2000;
        $defaultMaxPrice = 100000;
    
        // Utiliser les valeurs par défaut si les paramètres du système ne sont pas définis
        $minPrice = (int)getSetting('payments.minimum_subscription_price') ?: $defaultMinPrice;
        $maxPrice = (int)getSetting('payments.maximum_subscription_price') ?: $defaultMaxPrice;
    
        return [
            'profile_access_price' => 'numeric|min:'.$minPrice.'|max:'.$maxPrice,
            'profile_access_price_3_months' => 'numeric|min:'.$minPrice.'|max:'.$maxPrice,
            'profile_access_price_6_months' => 'numeric|min:'.$minPrice.'|max:'.$maxPrice,
            'profile_access_price_12_months' => 'numeric|min:'.$minPrice.'|max:'.$maxPrice,
        ];
    }    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return self::getRules();
    }
}
