<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Userknow extends Model
{
    protected $table = "user_knows";
    public $timestamps = false;

    protected $fillable = [
        "user_id",
        "categories",
        "spoken_languages"
    ];

    public function user(){
        return $this->belongsTo("App\Model\User" , "user_id"); 
    }
}
