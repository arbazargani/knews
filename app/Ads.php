<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    protected $dates = [
        'publish_at',
        'expired_at',
    ];
}
