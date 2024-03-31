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
        "card_number",
        "expired_date",
        "cvv",
        "billing_name",
        "billing_last_name",
        "billing_post_code",
        "billing_city",
        "billing_phone",
        "billing_address",
        "country",
        "status",
    ]; 
}
