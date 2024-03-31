<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Demopost extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['text', 'images'];

    /**
     * Get the images attribute.
     *
     * @param  string  $value
     * @return array
     */
    public function getImagesAttribute($value)
    {
        return json_decode($value, true); // Ajouter true pour obtenir un tableau
    }

    /**
     * Set the images attribute.
     *
     * @param  array  $value
     * @return void
     */
    public function setImagesAttribute($value)
    {
        $this->attributes['images'] = json_encode($value);
    }
}
