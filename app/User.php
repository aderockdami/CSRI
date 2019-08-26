<?php

namespace App;

use JWTAuth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'sector', 'password','internal_external','date_of_assesment','user_type'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier(){

        return $this->getKey();

    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(){

        return [];

    }

    public static function getUser(){

      return app(AuthController::class)->getUser();

    }

    public static function getId(){

      return JWTAuth::parseToken()->getPayload()->get('sub');

    }

    public static function getToken(){

      return JWTAuth::parseToken()->getPayload();

    }
}
