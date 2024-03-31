<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserReport extends Model
{

    public static $typesMap = [
        "C'est un faux compte",
        "Je n'aime pas cette publication",
        'Contenu violent',
        'Le contenu contient du matériel volé',
        'Le contenu est du spam',
        'Signaler un abus',
    ];


    public static $statusMap = [
        'received',
        'seen',
        'solved',
        'false',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['from_user_id', 'user_id', 'post_id', 'type', 'details', 'status'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    /*
     * Relationships
     */

    public function reporterUser()
    {
        return $this->belongsTo('App\User', 'from_user_id');
    }

    public function reportedUser()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function reportedPost()
    {
        return $this->belongsTo('App\Post', 'post_id');
    }
}
