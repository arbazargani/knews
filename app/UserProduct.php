<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProduct extends Model
{

    public function User()
    {
        return $this->hasOne('App\User','id','user_id');
    }

    public function Product()
    {
        return $this->hasOne('App\Product','id','product_id');
    }

}
