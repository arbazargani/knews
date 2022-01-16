<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuleCat extends Model
{
    public function children()
    {
        return $this->hasMany('\App\ModuleCat', 'parent_id', 'id');
    }
    public function parent()
    {
        return $this->belongsTo('\App\ModuleCat', 'parent_id');
    }
}
