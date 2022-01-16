<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCat extends Model
{

    public function children()
    {
        return $this->hasMany('\App\ProductCat', 'parent_id', 'id');
    }
    public function children_rec()
    {
        return $this->children()->with('children_rec');
    }


    public function parent()
    {
        return $this->belongsTo('\App\ProductCat', 'parent_id');
    }
    public function parent_rec()
    {
        return $this->parent()->with('parent_rec');
    }

}
