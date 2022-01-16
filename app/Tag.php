<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['user_id', 'title'];

    public function News()
    {
        return $this->belongsToMany('App\News')->withTimestamps();
    }

}
