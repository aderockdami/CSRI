<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id','user_id','response'
    ];
}
