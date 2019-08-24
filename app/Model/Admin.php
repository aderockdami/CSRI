<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
  public static function isAdmin($token){
  if($token->get('usr') === 'admin'){
    return 1;
  }
  else {
    return 0;
  }
}
}
